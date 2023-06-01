<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Backend extends Controller {
	
	public function before() {
		
		parent::before();
		
		// Check session login, apakah sudah login atau belum
		$session   = Session::instance();
		$was_login = $session->get('adminLogin');
		$access = $session->get('adminAccess');
		
		if ($was_login != 1) { // Jika belum login maka redirect ke halaman login
			
			$this->redirect('/login');
			
		}
		
		$controller = strtolower($this->request->controller());
		
		if($access != 1){
			$list = array('home','comm','login');
			if (!in_array($controller, $list)) {
				$data['main_title'] = __('No Access!');
				$view                   = Briliant::admin_template('briliant/' . Kohana::$config->load('path.main_template') . '/error', $data);
				echo $view;
				exit();
			}
		}
		
		// print_r($controller);exit;
	}
	
	
} // End Welcome