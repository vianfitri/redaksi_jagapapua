<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends Controller_Backend {

	public function action_index() {
		$data['main_title'] = "Home";
		$data['menu_active'] = "dashboard";
		// Load data from model
		$home_model = new Model_Home();

		// Count All Data
		$data['news'] = $home_model->count_all_two("news","newsStatus");
		$data['foto'] = $home_model->count_all_two("foto","fotoStatus");
		$data['library'] = $home_model->count_all_two("arsip_images","arimActive");
		$data['users'] = $home_model->count_all_two("user","userStatus");
		//$data['comm'] = $home_model->count_all_two("community","commStatus");
		//$data['product'] = $home_model->count_all("bri_product","bripStatus");
		//$data['quiz'] = $home_model->count_all("quiz","quizStatus");
		//$data['thread'] = $home_model->count_all("thread","thrdStatus");

		$session   = Session::instance();
		$access = $session->get('adminAccess');

		if($access == 1){
			$view = Briliant::admin_template('home/' . Kohana::$config->load('path.main_template') . '/template', $data);
		}else{
			$view = Briliant::admin_template_limit('home/' . Kohana::$config->load('path.main_template') . '/template', $data);
		}
		$this->response->body($view);
	}

}
