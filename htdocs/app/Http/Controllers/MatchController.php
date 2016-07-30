<?php
/**
 * Created by PhpStorm.
 * User: yuqian
 * Date: 16/6/7
 * Time: 下午9:52
 */

namespace App\Http\Controllers;

use DB;
use App\Basic;
use App\Target;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BasicRepository;
use App\Repositories\TargetRepository;

class MatchController extends Controller {

	protected $basic;
	protected $target;

	protected $originMap = [
		'basics' => [
			'user_id', 'gender', 'city', 'birth_year',
		],
		'abouts' => [
			'summary', 'routine', 'skills', 'favorite', 'necessities', 'concerns', 'friday'
		],
		'details' => [
			'orientation', 'status', 'height', 'weight', 'smoking', 'drinking', 'religion', 'education', 'offspring', 'pet',
		],
		'refers' => [
			'why', 'description', 'story'
		],
		'targets' => [
			'target_gender', 'ageMin', 'ageMax', 'isSingle', 'isNearBy', 'relationship'
		],
	];

	protected $baseField = [
		'gender', 'city', 'ageMin', 'ageMax', 'target_gender',
	];

	/**
	 * Create a new controller instance.
	 * @return void
	 */
	public function __construct(BasicRepository $basic, TargetRepository $target) {
		$this->middleware('auth');
		$this->dbMap = $this->reverseMap($this->originMap);
		$this->basic = $basic;
		$this->target = $target;
	}

	/**
	 * Display the user's basic info
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function index(Request $request) {
		$raw = array_merge($this->basic->forUser($request->user()), $this->target->forUser($request->user()));
		$defaultBaseData = [];
		foreach ($this->baseField as $baseField) {
			if(isset($raw[$baseField])) {
				$defaultBaseData[$baseField] = $raw[$baseField];
			}
		}
		return view('match.index', [
			'defaultBase' => $defaultBaseData,
			'location' => 'match',
		]);
	}

	/**
	 * $fields = [
	 * 'city'    => '北京',
	 * 'gender'  => '男',
	 * 'smoking' => '有时',
	 * ...
	 * ]
	 */

	protected function search(Request $request) {
		// remove empty field
		$fields = [];
		foreach($request->all() as $key => $value) {
			if($value) {
				$fields[$key] = $value;
			}
		}
		$groupFields = $this->groupFields($fields);
		$users = $this->getUsers($groupFields);

		return $users;

	}

	private function groupFields($fields) {
		$ret = [];
		if(isset($fields['latestBirth']) || isset($fields['earliestBirth'])) {
			$currentYear = date("Y");
			$latestBirth = isset($fields['latestBirth']) ? ($currentYear - intval($fields['latestBirth'])) : $currentYear - 15;
			$earliestBirth = isset($fields['earliestBirth']) ? ($currentYear - intval($fields['earliestBirth'])) : $currentYear - 100;
			$ret['basics'] = [];
			$ret['basics']['birth_year'] = ['birth_year', [$earliestBirth, $latestBirth]];
		}
		if(isset($fields['heightMin']) || isset($fields['heightMax'])) {
			$heightMin = isset($fields['heightMin']) ? $fields['heightMin'] : 0;
			$heightMax = isset($fields['heightMax']) ? $fields['heightMax'] : 300;
			$ret['details'] = [];
			$ret['details']['height'] = ['height', [$heightMin, $heightMax]];
		}

		$removeKeys = ['latestBirth', 'earliestBirth', 'heightMin', 'heightMax'];
		$fields = array_diff_key($fields, array_flip($removeKeys));

		foreach($fields as $key => $value) {
			$dbName = $this->dbMap[$key];
			if($dbName) {
				if(!isset($ret[$dbName])) {
					$ret[$dbName] = [];
				}
				$ret[$dbName][$key] = [$key, $value];
			}
		}
		return $ret;
	}

	private function reverseMap($map) {
		$ret = [];
		foreach($map as $key => $fields) {
			foreach($fields as $field) {
				$ret[$field] = $key;
			}
		}
		return $ret;
	}

	private function getUsers($groupFields) {
		$ret = [
			'id'    => [],
			'data'  => [],
			'total' => 0,
		];
		foreach($groupFields as $table => $groupField) {
			$item = [
				'id' => [],
				'data' => [],
			];

			$hits = $this->query($table, $groupField);

			// 某个表的query无结果
			if(!count($hits)) {
				break;
			}

			foreach($hits as $hit) {
				$id = $hit->user_id;
				$item['id'][] = $id;
				$item['data'][$id] = $hit;
			}
			if(empty($ret['id'])) { // 第一次query
				$ret['id'] = $item['id'];
				$ret['data'] = $item['data'];
			} else {
				$ret['id'] = array_intersect($ret['id'], $item['id']);
				if(count($ret['id'])) {
					foreach($ret['data'] as $id => $attr) {
						if (in_array($id, $ret['id'])) {
							$ret['data'][$id] = (object) array_merge((array) $ret['data'][$id], (array) $item['data'][$id]);
						} else {
							unset($ret['data'][$id]);
						}
					}
				} else {
					$ret['data'] = [];
					break;
				}
			}
		}
		$registerHits = $this->inQuery('users', 'id', $ret['id']);
		$referHits = $this->inQuery('refers', 'user_id', $ret['id']);
		$names = [];
		$refers = [];
		foreach($registerHits as $hit) {
			$id = $hit->id; // uid
			$names[$id] = $hit->name;
		}
		foreach($referHits as $hit) {
			$id = $hit->user_id; // uid
			$refers[$id] = $hit;
		}
		foreach($ret['data'] as $id => $attr) {
			$ret['data'][$id]->name = $names[$id];
			if(isset ($refers[$id])) {
				$ret['data'][$id]->why = $refers[$id]->why;
				$ret['data'][$id]->description = $refers[$id]->description;
				$ret['data'][$id]->story = $refers[$id]->story;
			}
		}
		$ret['total'] = count($ret['id']);
		return $ret;
	}

	// TODO abstract
	private function query($table, $fields) {
		$qr1 = [];
		$qr2 = [];
		if($table == 'basics' && in_array('birth_year', array_keys($fields))) {
			$r1 = $this->betweenQuery($table, 'birth_year', $fields['birth_year'][1]);
			foreach ($r1 as $hit) {
				$qr1[$hit->user_id] = $hit;
			}
			unset($fields['birth_year']);
			$r2 = $this->baseQuery($table, array_values($fields));
			foreach ($r2 as $hit) {
				$qr2[$hit->user_id] = $hit;
			}
			$qr = array_intersect_key($qr1, $qr2);
		} else if ($table == 'details' && in_array('height', array_keys($fields))) {
			$r1 = $this->betweenQuery($table, 'height', $fields['height'][1]);
			foreach ($r1 as $hit) {
				$qr1[$hit->user_id] = $hit;
			}
			unset($fields['height']);
			$r2 = $this->baseQuery($table, array_values($fields));
			foreach ($r2 as $hit) {
				$qr2[$hit->user_id] = $hit;
			}
			$qr = array_intersect_key($qr1, $qr2);
		} else {
			$qr = $this->baseQuery($table, array_values($fields));
		}

		return $qr;
	}
	private function baseQuery($table, $fields) {
		$qr = DB::table($table)->where($fields)->get();
		return $qr;
	}

	private function inQuery($table, $key, $arr) {
		$qr = DB::table($table)->whereIn($key, $arr)->get();
		return $qr;
	}

	private function betweenQuery($table, $key, $arr) {
		$qr = DB::table($table)->whereBetween($key, $arr)->get();
		return $qr;
	}
}
