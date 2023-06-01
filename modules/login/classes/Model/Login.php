<?php defined('SYSPATH') or die('No direct script access.');

class Model_Login extends Model {
	
	public function do_login($email = '', $password = '') {
		
		$return = false;
		$exec =	DB::select(DB::expr('COUNT(1) as COUNT'))
				->from('user')
				->where('userEmail', '=', $email)
				->where('userPassword', '=', $password)
				->where('userAdmin', '=', 1)
				->execute()
				->as_array();
		if(!empty($exec[0]['COUNT'])) {
			$return = true;
		}
		return $return;
	
	}
	
	public function get_admin_detail($email = '', $password ='') {
		
		$return = '';
		$exec =	DB::select('userId, userEmail, userFullName, userAdminAccess')
				->from('user')
				->where('userEmail', '=', $email)
				->where('userPassword', '=', $password)
				// ->where('userStatus', '=', 1)
				->execute()
				->as_array();
		if(!empty($exec[0])) {
			$return = $exec[0];
		}
		return $return;
		
	}
	
}