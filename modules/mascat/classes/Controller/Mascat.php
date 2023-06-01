<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Mascat extends Controller_Backend {
	
	public function before() {
		
		parent::before();
		
		// Javascript for delete data
		$this->custom_footer = '
			<script type="text/javascript">
				function del_confirm(id) {
					var dialog = confirm("' . __('Are you sure for delete this data ?') . '");
					if (dialog == true) {
						window.location.href="'.URL::base().'mascat/delete/" + id;
					}
				}
			</script>
		';
		
	}

	public function action_index() {

	}
	
	public function action_new() {

		$data['main_title'] = "Master Category New";
		$data['menu_active'] = "media";
		$data['menu_active_child'] = "mascat";
		$data['menu_active_child_1'] = "add";
		$view = Briliant::admin_template('mascat/' . Kohana::$config->load('path.main_template') . '/new', $data);
		$this->response->body($view);
	}
	
	public function action_submit() {
		
		$mascat_model = new Model_Mascat();
		$result = $mascat_model->save_data($this->request->post());
		$this->redirect('/mascat/list');
	}
	
	public function action_list() {
		
		// Page from parameter
		$page = intval($this->request->param('page'));
		if(empty($page)) {
			$page = 1;
		}
		
		$data['main_title'] = "Master Category List";
		$data['menu_active'] = "media";
		$data['menu_active_child'] = "mascat";
		$data['menu_active_child_1'] = "list";
		
		$mascat_model = new Model_Mascat();
		$data['count_all'] = $mascat_model->count_all();
		
		// Pagination
		$pagination = Pagination::factory(array(
							'total_items'    		=> $data['count_all'],
							'items_per_page'	=> 20,
							'current_page'		=> $page,
							'base_url'				=> '/mascat/list/',
							'view'					=> 'pagination/admin'
						));
				
		$data['list'] = $mascat_model->list_data($pagination->items_per_page, $pagination->offset);
		
		$data['pagination'] =  $pagination->render();
		
		$data['custom_footer'] = $this->custom_footer;
		
		$view = Briliant::admin_template('mascat/' . Kohana::$config->load('path.main_template') . '/list', $data);
		$this->response->body($view);
	}
	
	public function action_edit() {
		
		// Id from parameter
		$id = intval($this->request->param('id'));
		
		$mascat_model = new Model_Mascat();
		$data = $mascat_model->data_by_id($id);
		
		$data['main_title'] = "Master Category Edit";
		$data['menu_active'] = "media";
		$data['menu_active_child'] = "mascat";
		
		$view = Briliant::admin_template('mascat/' . Kohana::$config->load('path.main_template') . '/edit', $data);
		$this->response->body($view);
	}
	
	public function action_update() {
		
		$id = $this->request->post('id');
		$mascat_model = new Model_Mascat();
		$update = $mascat_model->update_data($id, $this->request->post());
		
		$this->redirect('/mascat/list');
	}
	
	public function action_search() {
		
		$data['main_title'] = "Master Category List";
		$data['menu_active'] = "media";
		$data['menu_active_child'] = "mascat";
		
		// Redirect jika mengepost search agar bisa menggunakan paginasi dengan beauty url
		$post_search = $this->request->post('search');
		if(!empty($post_search)) {
			$this->redirect('/mascat/search/' . $post_search);
		}
		
		// Param search
		$search = $this->request->param('search');
		
		// Param page
		$page = intval($this->request->param('page'));
		if(empty($page)) {
			$page = 1;
		}
		
		// Load data from model
		$mascat_model = new Model_Mascat();
		
		// Count All Data
		$data['count_all'] = $mascat_model->count_search_data($search);
		
		// Pagination
		$pagination = 	Pagination::factory(array(
							'total_items'    		=> $data['count_all'],
							'items_per_page'	=> 20,
							'current_page'		=> $page,
							'base_url'				=> '/mascat/search/' . $search . '/',
							'view'					=> 'pagination/admin'
						));
		
		$data['list'] = $mascat_model->search_data($search, $pagination->items_per_page, $pagination->offset);
		$data['search'] = $search;
		$data['pagination'] =  $pagination->render();
		$data['custom_footer'] = $this->custom_footer;
		
		$view = Briliant::admin_template('mascat/' . Kohana::$config->load('path.main_template') . '/list', $data);
		$this->response->body($view);
		
	}
	
	public function action_delete() {
		$id = $this->request->param('id');
		$mascat_model = new Model_Mascat();
		$update = $mascat_model->delete_data($id);
		
		$this->redirect('/mascat/list');
	}
	
}
