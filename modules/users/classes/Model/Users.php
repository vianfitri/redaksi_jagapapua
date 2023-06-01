<?php defined('SYSPATH') or die('No direct script access.');

class Model_Users extends Model {
	
	public function count_all() {
		
		$return = 0;
		
		$query =	DB::select(array(DB::expr('COUNT(1)'), 'COUNT'))
					->from('user')
					->where('userAdmin','=',1)
					->execute()
					->as_array();
		
		if(!empty($query[0]['COUNT'])) {
			$return = $query[0]['COUNT'];
		}
		
		return $return;
		
	}
	
	public function checkValid($email = '') {
		
		$exec = DB::select()
				->from('user')
				->where('userEmail','=',$email)
				// ->where('userAdmin','=',1)
				->execute()
				->as_array();
		
		return $exec;
		
	}
	
	public function list_data($limit = '', $offset = '') {
		
		$exec = DB::select(
					array('userId', 'id'),
					array('userFullName', 'name'),
					array('userEmail', 'email')
				)
				->from('user')
				->where('userAdmin','=',1)
				->order_by('userId', 'DESC')
				->limit($limit)
				->offset($offset)
				->execute()
				->as_array();
		
		return $exec;
		
	}
	
	public function save_data($data = array()) {
		$query =	DB::insert('user', array(
						'userFullName',
						'userEmail',
						'userPassword',
						'userAdmin',
						'userAdminAccess'
					))
					->values(array(
						$data['name'],
						$data['email'],
						SHA1($data['password']),
						1,
						1
					))
					->execute();
		return $query;
	}
	
	public function data_by_id($id = '') {
		
		$return  = array();
		
		$exec = DB::select(
					array('userId', 'id'),
					array('userFullName', 'name'),
					array('userEmail', 'email'),
					array('userPassword', 'password'),
					array('userAdminAccess', 'access')
				)
				->from('user')
				->where('userId', '=', $id)
				->execute()
				->as_array();
		if(!empty($exec[0])) {
			$return = $exec[0];
		}
		
		return $return;
		
	}
	
	public function update_data($id = '', $data = '') {
		$query =	DB::update('user')
					->set(array('userFullName' => $data['name']))
					->set(array('userEmail' => $data['email']))
					->set(array('userAdminAccess' => 1))
					->where('userId', '=', $id)
					->execute();
	}
	
	public function delete_data($id = '') {
		// $query =	DB::update('user')
					// ->set(array('userAdmin' => 0))
					// ->where('userId', '=', $id)
					// ->execute();
		$query =	DB::delete('user')
					->where('userId', '=', $id)
					->execute();
	}
	
	public function count_search_data($search = '') {
		
		$return = 0;
		
		$query =	DB::select(array(DB::expr('COUNT(1)'), 'COUNT'))
					->from('user')
					->where('userAdmin','=',1)
					->where('userFullName', 'LIKE', '%' . $search . '%')
					->execute()
					->as_array();
		
		if(!empty($query[0]['COUNT'])) {
			$return = $query[0]['COUNT'];
		}
		
		return $return;
		
	}
	
	public function search_data($search = '', $limit = '', $offset = '') {
		
		$exec = DB::select(
					array('userId', 'id'),
					array('userFullName', 'name'),
					array('userEmail', 'email')
				)
				->from('user')
				->where('userAdmin','=',1)
				->where('userFullName', 'LIKE', '%' . $search . '%')
				->order_by('userFullName', 'ASC')
				->limit($limit)
				->offset($offset)
				->execute()
				->as_array();
		
		return $exec;
		
	}
	
	public function change_password($id = '', $password = '') {
		$query =	DB::update('user')
					->set(
						array('userPassword' => SHA1($password))
					)
					->where('userId', '=', $id)
					->execute();
	}

}