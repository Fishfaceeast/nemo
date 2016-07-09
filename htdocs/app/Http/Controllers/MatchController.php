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
			'user_id', 'gender', 'city', 'birth_year'
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
		'gender', 'city', 'target_gender',
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
		]);
	}

//	$fields = [
//		'gender'  => '男',
//		'city'    => '北京',
//		'smoking' => '有时',
//		'drinking' => '否',
//		'isSingle' => '1',
//	]
	protected function search(Request $request) {
		$fields = $request->all();
		$groupFields = $this->groupFields($fields);
		$users = $this->getUsers($groupFields);

		return $users;

	}

	private function groupFields($fields) {
		$ret = [];
		foreach($fields as $key => $value) {
			$dbName = $this->dbMap[$key];
			if($dbName) {
				if(!isset($ret[$dbName])) {
					$ret[$dbName] = [];
				}
				$ret[$dbName][] = [$key, $value];
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
		$names = [];
		foreach($registerHits as $hit) {
			$id = $hit->id;
			$names[$id] = $hit->name;
		}
		foreach($ret['data'] as $id => $attr) {
			$ret['data'][$id]->name = $names[$id];
		}
		$ret['total'] = count($ret['id']);
		return $ret;
	}

	private function query($table, $fields) {
		$qr = DB::table($table)->where($fields)->get();
		return $qr;
	}

	private function inQuery($table, $key, $arr) {
		$qr = DB::table($table)->whereIn($key, $arr)->get();
		return $qr;
	}
}
