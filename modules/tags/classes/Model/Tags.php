<?php defined('SYSPATH') or die('No direct script access.');

class Model_Tags extends Model {
	
	public function count_all() {
		
		$return = 0;
		
		$query =	DB::select(array(DB::expr('COUNT(1)'), 'COUNT'))
					->from('master_tags')
					->where('mstgActive', '=', 1)
					->execute()
					->as_array();
		
		if(!empty($query[0]['COUNT'])) {
			$return = $query[0]['COUNT'];
		}
		
		return $return;
		
	}
	
	public function list_data($limit = '', $offset = '') {
		
		$exec = DB::select(
					array('mstgId', 'id'),
					array('mstgName', 'name'),
					array('mstgSaved', 'saved'),
					array('mstgActive', 'active'),
					array('userFullName', 'user')
				)
				->from('master_tags')
				->join('user', 'LEFT')
				->on('master_tags.mstgUserIdSaved', '=', 'user.userId')
				->where('mstgActive', '=', 1)
				->order_by('mstgId', 'DESC')
				->limit($limit)
				->offset($offset)
				->execute()
				->as_array();
		
		return $exec;
		
	}
	
	public function count_search_data($search = '') {
		
		$return = 0;
		
		$query =	DB::select(array(DB::expr('COUNT(1)'), 'COUNT'))
					->from('master_tags')
					->where('master_tags.mstgName', 'LIKE', '%' . $search . '%')
					->where('mstgActive', '=', 1)
					->execute()
					->as_array();
		
		if(!empty($query[0]['COUNT'])) {
			$return = $query[0]['COUNT'];
		}
		
		return $return;
		
	}
	
	public function search_data($search = '', $limit = '', $offset = '') {
		
		$exec = DB::select(
					array('mstgId', 'id'),
					array('mstgName', 'name'),
					array('mstgSaved', 'saved'),
					array('mstgActive', 'active'),
					array('userFullName', 'user')
				)
				->from('master_tags')
				->join('user', 'LEFT')
				->on('master_tags.mstgUserIdSaved', '=', 'user.userId')
				->where('master_tags.mstgName', 'LIKE', '%' . $search . '%')
				->where('mstgActive', '=', 1)
				//->order_by('mstgId', 'DESC')
				->order_by('LENGTH(mstgName)', 'ASC')
				->limit($limit)
				->offset($offset)
				->execute()
				->as_array();
		
		return $exec;
		
	}
	
	public function save_data($param = array()) {
		
		list($insert_id, $affected_rows) =	DB::insert('master_tags', array(
						'mstgName',
						'mstgUserIdSaved',
						'mstgActive'
					))
					->values(array(
						$param['tags'],
						$param['user_id'],
						1
					))
					->execute();
		//if(!empty($insert_id)) Engine_Tags::send_to_web($insert_id);
		return $insert_id;
	
	}
	
	public function data_by_id($id = '') {
		
		$return  = array();
		
		$exec = DB::select(
					array('mstgId', 'id'),
					array('mstgName', 'name')
				)
				->from('master_tags')
				->where('mstgId', '=', $id)
				->execute()
				->as_array();
		if(!empty($exec[0])) {
			$return = $exec[0];
		}
		
		return $return;
		
	}
	
	public function update_data($user_id = '', $id = '', $tags = '') {
		$query =	DB::update('master_tags')
					->set(
						array('mstgName' => $tags),
						array('mstgUserIdSaved' => $user_id)
					)
					->where('mstgId', '=', $id)
					->execute();
		//Engine_Tags::send_to_web($id);
	}
	
	public function delete_data($id = '') {
		$query = 	DB::update('master_tags')
					->set(array('mstgActive' => 0))
					->where('mstgId', '=', $id)
					->execute();
		//Engine_Tags::send_to_delete($id);
	}
	
	public function check_duplicate($title = '') {
		
		$return = 0;
	
		$query =	DB::select(array(DB::expr('COUNT(1)'), 'COUNT'))
					->from('master_tags')
					->where('mstgName', '=', $title)
					->execute()
					->as_array();
		
		if(!empty($query[0]['COUNT'])) {
			$return = $query[0]['COUNT'];
		}
		
		return $return;
		
	}
	
	public function search_dataid($search = '', $limit = '', $offset = '') {
		
		$exec = DB::select(
					array('mstgId', 'id'),
					array('mstgName', 'name'),
					array('mstgSaved', 'saved'),
					array('mstgActive', 'active'),
					array('userFullName', 'user')
				)
				->from('master_tags')
				->join('user', 'LEFT')
				->on('master_tags.mstgUserIdSaved', '=', 'user.userId')
				->where('master_tags.mstgId', '=', $search)
				->where('mstgActive', '=', 1)
				->order_by('mstgId', 'DESC')
				->limit($limit)
				->offset($offset)
				->execute()
				->as_array();
		
		return $exec;
		
	}
        
}