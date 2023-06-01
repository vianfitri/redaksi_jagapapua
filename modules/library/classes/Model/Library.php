<?php defined('SYSPATH') or die('No direct script access.');

class Model_Library extends Model {

	public function count_all($search='') {
		$return = 0;
		$search = str_replace("'","",$search);
		$src = explode(",", $search);
		$qsearch=array();
		if(!empty($src)) {
			foreach($src as $v){
				$qsearch[] = "arimTitle LIKE '%{$v}%' OR arimCaption LIKE '%{$v}%'";
			}
		}
		if(!empty($qsearch)) $qsearch = 'AND ('.implode('',$qsearch).')';
		$query = DB::query(Database::SELECT, "SELECT COUNT(1) as total FROM arsip_images WHERE arimActive = 1 {$qsearch}");
			$exec = $query->execute()->as_array();
		if(!empty($exec[0]['total'])) {
			$return = $exec[0]['total'];
		}
		return $return;
	}

	public function list_data($limit = '', $offset = '', $search='') {
		$search = str_replace("'","",$search);
		$src = explode(",", $search);
		$qsearch=array();
		if(!empty($src)) {
			foreach($src as $v){
				$qsearch[] = "arimTitle LIKE '%{$v}%' OR arimCaption LIKE '%{$v}%'";
			}
		}
		if(!empty($qsearch)) $qsearch = 'AND ('.implode('',$qsearch).')';
		$query = DB::query(Database::SELECT, "SELECT arimId AS id, arimTitle AS title, arimFileType AS fileType, arimCaption AS caption, arimSaved AS saved, arimActive AS active FROM arsip_images WHERE arimActive = 1 {$qsearch} ORDER BY arimSaved DESC LIMIT {$limit} OFFSET {$offset}");
			$exec = $query->execute()->as_array();
		return $exec;

	}

	public function save_data($param = array()) {
		if(empty($param['id'])){
			$table = array(
				'arimTitle',
				'arimFileType',
				'arimCaption',
				'arimUserIdSaved'
			);
			$value = array(
				$param['title'],
				$param['fileType'],
				$param['caption'],
				// $param['userId']
				1
			);
			list($insert_id, $affected_rows) =	DB::insert('arsip_images', $table)
					->values($value)
					->execute();
			// Engine_Arsipimage::send_to_web($insert_id);
			return $insert_id;
		}else{
			// print_r($param);exit;
			$query =	DB::update('arsip_images')
					->set(array('arimTitle' => $param['title']))
					->set(array('arimCaption' => $param['caption']))
					->set(array('arimUserIdSaved' => $param['userId']));
			if(!empty($param['fileType'])) {
				$query = $query->set(array('arimFileType' => $param['fileType']));
			}
			$query = $query
					->where('arimId', '=', $param['id'])
					->execute();
			return $param['id'];
		}
	}
    
    public function save_data_with_id($param = array()) {
		$table = array(
				'arimId',
				'arimTitle',
				'arimFileType',
				'arimCaption',
				'arimUserIdSaved'
			);
			$value = array(
				$param['id'],
				$param['title'],
				$param['fileType'],
				$param['caption'],
				// $param['userId']
				1
			);
			list($insert_id, $affected_rows) =	DB::insert('arsip_images', $table)
					->values($value)
					->execute();
			// Engine_Arsipimage::send_to_web($insert_id);
			return $param['id'];
		
	}

	public function data_by_id($id = '') {

		$return  = array();

		$exec = DB::select(
					array('arimId', 'id'),
					array('arimTitle', 'title'),
					array('arimFileType', 'fileType'),
					array('arimCaption', 'caption')
				)
				->from('arsip_images')
				->where('arimId', '=', $id)
				->execute()
				->as_array();
		if(!empty($exec[0])) {
			$return = $exec[0];
		}

		return $return;

	}

	public function delete_data($id = '') {
		$query = 	DB::update('arsip_images')
					->set(array('arimActive' => 0))
					->where('arimId', '=', $id)
					->execute();
	}

	public function my_count_all($search='', $user_id) {
		$return = 0;
		$src = explode(",", $search);
		$qsearch=array();
		if(!empty($src)) {
			foreach($src as $v){
				$qsearch[] = "arimTitle LIKE '%{$v}%' OR arimCaption LIKE '%{$v}%'";
			}
		}
		if(!empty($qsearch)) $qsearch = 'AND ('.implode('',$qsearch).')';
		$query = DB::query(Database::SELECT, "SELECT COUNT(1) as total FROM arsip_images WHERE arimUserIdSaved={$user_id} and arimActive = 1 {$qsearch}");
			$exec = $query->execute()->as_array();
		if(!empty($exec[0]['total'])) {
			$return = $exec[0]['total'];
		}
		return $return;
	}

	public function my_list_data($user_id, $limit = '', $offset = '', $search='') {
		$src = explode(",", $search);
		$qsearch=array();
		if(!empty($src)) {
			foreach($src as $v){
				$qsearch[] = "arimTitle LIKE '%{$v}%' OR arimCaption LIKE '%{$v}%'";
			}
		}
		if(!empty($qsearch)) $qsearch = 'AND ('.implode('',$qsearch).')';
		$query = DB::query(Database::SELECT, "SELECT arimId AS id, arimTitle AS title, arimFileType AS fileType, arimCaption AS caption, userRealName AS user, arimSaved AS saved, arimActive AS active FROM arsip_images LEFT JOIN user ON (arsip_images.arimUserIdSaved = user.userId) WHERE arimUserIdSaved={$user_id} and arimActive = 1 {$qsearch} ORDER BY arimSaved DESC LIMIT {$limit} OFFSET {$offset}");
			$exec = $query->execute()->as_array();
		return $exec;

	}

	
	}
