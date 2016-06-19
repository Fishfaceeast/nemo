<?php
/**
 * Created by PhpStorm.
 * User: yuqian
 * Date: 16/6/7
 * Time: 下午9:52
 */

namespace App\Http\Controllers;

use DB;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MatchController extends Controller {

	protected $originMap = [
		'basics' => [
			'user_id', 'gender', 'city', 'birth_year'
		],
		'abouts' => [
			'summary', 'routine', 'skills', 'favorite', 'necessities', 'concerns', 'friday'
		],
		'details' => [
			'orientation', 'status', 'nationality', 'height', 'weight', 'smoking', 'drinking', 'religion', 'education', 'offspring', 'pet',
		],
		'refers' => [
			'why', 'description', 'story'
		],
		'targets' => [
			'target_gender', 'ageMin', 'ageMax', 'isSingle', 'isNearBy', 'relationship'
		],
	];

	/**
	 * Create a new controller instance.
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
		$this->dbMap = $this->reverseMap($this->originMap);
	}

	/**
	 * Display the user's basic info
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function index(Request $request) {
		$fields = [
			'gender'  => '男',
			'city'    => '北京',
			'smoking' => '有时',
			'drinking' => '否',
			'isSingle' => '1',
		];
		$groupFields = $this->groupFields($fields);
		$users = $this->getUsers($groupFields);

		var_dump($users);
		die;

		return view('match.index');
	}

	protected function search(Request $request) {
		$fields = $request->all();

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
		$ret['total'] = count($ret['id']);
		return $ret;
	}

	private function query($table, $fields) {
		$users = DB::table($table)->where($fields)->get();
		return $users;
	}
}
