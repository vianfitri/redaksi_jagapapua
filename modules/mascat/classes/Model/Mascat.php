<?php defined('SYSPATH') or die('No direct script access.');

class Model_Mascat extends Model {
	
	public function count_all() {
		
		$return = 0;
		
		$query =	DB::select(array(DB::expr('COUNT(1)'), 'COUNT'))
					->from('master_category')
					->where('msctStatus','=',1)
					->execute()
					->as_array();
		
		if(!empty($query[0]['COUNT'])) {
			$return = $query[0]['COUNT'];
		}
		
		return $return;
		
	}
	
	public function list_data($limit = '', $offset = '') {
		
		$exec = DB::select(
					array('msctId', 'id'),
					array('msctName', 'name'),
					array('msctSaved', 'saved'),
					array('msctStatus', 'status')
				)
				->from('master_category')
				->where('msctStatus','=',1)
				->order_by('msctId', 'DESC')
				->limit($limit)
				->offset($offset)
				->execute()
				->as_array();
		
		return $exec;
		
	}
	
	public function save_data($data = array()) {
		
		$query =	DB::insert('master_category', array(
						'msctName'
					))
					->values(array(
						$data['name']
					))
					->execute();
		return $query;
	}
	
	public function data_by_id($id = '') {
		
		$return  = array();
		
		$exec = DB::select(
					array('msctId', 'id'),
					array('msctName', 'name')
				)
				->from('master_category')
				->where('msctStatus','=',1)
				->where('msctId','=',$id)
				->execute()
				->as_array();
		
		if(!empty($exec[0])) {
			$return = $exec[0];
		}
		
		return $return;
		
	}
	
	public function update_data($id = '', $data = '') {
		
		$query =	DB::update('master_category')
						->set(array('msctName' => $data['name']))
						->where('msctId', '=', $id)
						->execute();
		
	}
	
	public function delete_data($id = '') {
		$query =	DB::update('master_category')
					->set(array('msctStatus' => 0))
					->where('msctId', '=', $id)
					->execute();
	}
	
	public function count_search_data($search = '') {
		
		$return = 0;
		
		$query =	DB::select(array(DB::expr('COUNT(1)'), 'COUNT'))
					->from('master_category')
					->where('master_category.msctName', 'LIKE', '%' . $search . '%')
					->execute()
					->as_array();
		
		if(!empty($query[0]['COUNT'])) {
			$return = $query[0]['COUNT'];
		}
		
		return $return;
		
	}
	
	public function search_data($search = '', $limit = '', $offset = '') {
		
		
		$exec = DB::select(
					array('msctId', 'id'),
					array('msctName', 'name'),
					array('msctSaved', 'saved'),
					array('msctStatus', 'status')
				)
				->from('master_category')
				->where('msctStatus','=',1)
				->where('master_category.msctName', 'LIKE', '%' . $search . '%')
				->order_by('msctId', 'DESC')
				->limit($limit)
				->offset($offset)
				->execute()
				->as_array();
		
		return $exec;
		
	}
	
}