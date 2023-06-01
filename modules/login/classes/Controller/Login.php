<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Login extends Controller {
	
	public function action_index() {
		
		$this->response->body(View::factory('login/login')->render());
		
	}
	
	protected function post_api($url = '', $header = '', $request = '') {
		$data = array();
		if (!empty($url)) {
			$ch      = curl_init($url);
			$options = array(
				CURLOPT_RETURNTRANSFER 		=> true, // return web page
				CURLOPT_HEADER 				=> false, // don't return headers
				CURLOPT_FOLLOWLOCATION 		=> false, // follow redirects
				// CURLOPT_ENCODING       	=> "utf-8",           // handle all encodings
				CURLOPT_AUTOREFERER 		=> true, // set referer on redirect
				CURLOPT_CONNECTTIMEOUT 		=> 20, // timeout on connect
				CURLOPT_TIMEOUT 			=> 20, // timeout on response
				CURLOPT_POST 				=> 1, // i am sending post data
				CURLOPT_POSTFIELDS 			=> $request, // this are my post vars
				CURLOPT_SSL_VERIFYHOST 		=> 0, // don't verify ssl
				CURLOPT_SSL_VERIFYPEER 		=> false, //
				CURLOPT_VERBOSE 			=> 1,
				CURLOPT_HTTPHEADER 			=> $header
				
			);
			curl_setopt_array($ch, $options);
			$data       = curl_exec($ch);
			$curl_errno = curl_errno($ch);
			$curl_error = curl_error($ch);
			//echo $curl_errno;
			//echo $curl_error;
			curl_close($ch);
		}
		return json_decode($data, TRUE);
	}
	
	public function action_auth() {

		$email = $this->request->post('email');
		$password = SHA1($this->request->post('password'));
		$login_model = new Model_Login();

		if($login_model->do_login($email, $password) === true) { // Login Sukses
			
			$admin_detail = $login_model->get_admin_detail($email, $password);
			
			//$data_post = $this->post_api('https://rest.wirausahabrilian.id/user/login', array('uuid: web') , array("username" => $email, "password" => $this->request->post('password')));
			
			$session = Session::instance();
			// Set session was login
			$session->set('adminLogin', 1);
			$session->set('adminId', $admin_detail['userId']);
			$session->set('adminName', $admin_detail['userFullName']);
			$session->set('adminEmail', $admin_detail['userEmail']);
			//$session->set('adminToken', $data_post['data']['token']);
			$session->set('adminAccess', $admin_detail['userAdminAccess']);
			
			$this->redirect('/home');
		} else { // Login gagal
			$this->redirect('/login');
		}

	}
	
	public function action_logout() {

		$session = Session::instance();
		$session->delete('adminLogin');
		$session->delete('adminId');
		$session->delete('adminName');
		Session::instance()->destroy();
		$this->redirect('/login');

	}
	
}
