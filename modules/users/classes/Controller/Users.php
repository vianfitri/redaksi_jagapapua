<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Users extends Controller_Backend {
	
	public function before() {
		
		parent::before();
		
		// Javascript for delete data
		$this->custom_footer = '
			<script type="text/javascript">
				function del_confirm(id) {
					var dialog = confirm("' . __('Are you sure for delete this data ?') . '");
					if (dialog == true) {
						window.location.href="'.URL::base().'users/delete/" + id;
					}
				}
			</script>
		';
		
	}

	public function action_index() {
		
	}
	
	public function action_new() {
		$data['main_title'] = "Users New";
		$data['menu_active'] = "users";
		$data['menu_active_child'] = "new";
		
		$data['custom_footer'] =  '
												<script>
												function checkValid(){
													var email = document.getElementById("email").value;
													$.post("/users/checkvalid",{email: email}, function(data,status){
														if(data.length != 0){
															alert("Email sudah terdaftar");
															return false;
														}
													}, "json");
												}
												</script>
											  ';
		
		$view = Briliant::admin_template('users/' . Kohana::$config->load('path.main_template') . '/new', $data);
		$this->response->body($view);
	}
	
	public function action_submit() {
		
		// Load Model Users
		$users_model = new Model_Users();
		$result = $users_model->save_data($this->request->post());
		$this->redirect('/users/list');
	}
	
	public function action_list() {
		
		// Page from parameter
		$page = intval($this->request->param('page'));
		if(empty($page)) {
			$page = 1;
		}
		
		$session = Session::instance();
		$data['main_title'] = "Users List";
		$data['menu_active'] = "users";
		$data['menu_active_child'] = "list";
		$data['userId'] = $session->get('adminId');
		
		$users_model = new Model_Users();
		$data['count_all'] = $users_model->count_all();
		
		// Pagination
		$pagination = Pagination::factory(array(
							'total_items'    		=> $data['count_all'],
							'items_per_page'	=> 20,
							'current_page'		=> $page,
							'base_url'				=> '/users/list/',
							'view'					=> 'pagination/admin'
						));
				
		$data['list'] = $users_model->list_data($pagination->items_per_page, $pagination->offset);
		
		$data['pagination'] =  $pagination->render();
		
		$data['custom_footer'] = $this->custom_footer;
		
		$view = Briliant::admin_template('users/' . Kohana::$config->load('path.main_template') . '/list', $data);
		$this->response->body($view);
	}
	
	public function action_edit() {
		
		// Id from parameter
		$id = intval($this->request->param('id'));
		
		$users_model = new Model_Users();
		$data = $users_model->data_by_id($id);
		
		$data['main_title'] = "Users Edit";
		$data['menu_active'] = "users";
		$data['menu_active_child'] = "edit";
		
		$view = Briliant::admin_template('users/' . Kohana::$config->load('path.main_template') . '/edit', $data);
		$this->response->body($view);
	}
	
	public function action_update() {
		
		$id = $this->request->post('id');
		$users_model = new Model_Users();
		$update = $users_model->update_data($id, $this->request->post());
		
		$this->redirect('/users/list');
	}
	
	public function action_search() {
		
		$session = Session::instance();
		$data['userId'] = $session->get('adminId');
		$data['main_title'] = "Users List";
		$data['menu_active'] = 'users';
		$data['menu_active_child'] = 'list';
		
		// Redirect jika mengepost search agar bisa menggunakan paginasi dengan beauty url
		$post_search = $this->request->post('search');
		if(!empty($post_search)) {
			$this->redirect('/users/search/' . $post_search);
		}
		
		// Param search
		$search = $this->request->param('search');
		
		// Param page
		$page = intval($this->request->param('page'));
		if(empty($page)) {
			$page = 1;
		}
		
		// Load data from model
		$users_model = new Model_Users();
		
		// Count All Data
		$data['count_all'] = $users_model->count_search_data($search);
		
		// Pagination
		$pagination = 	Pagination::factory(array(
							'total_items'    		=> $data['count_all'],
							'items_per_page'	=> 20,
							'current_page'		=> $page,
							'base_url'				=> '/users/search/' . $search . '/',
							'view'					=> 'pagination/admin'
						));
		
		$data['list'] = $users_model->search_data($search, $pagination->items_per_page, $pagination->offset);
		$data['search'] = $search;
		$data['pagination'] =  $pagination->render();
		$data['custom_footer'] = $this->custom_footer;
		
		$view = Briliant::admin_template('users/' . Kohana::$config->load('path.main_template') . '/list', $data);
		$this->response->body($view);
		
	}
	
	public function action_cpas() {
		
		// Id from parameter
		$id = intval($this->request->param('id'));
		
		$users_model = new Model_Users();
		$data = $users_model->data_by_id($id);
		
		$data['main_title'] = "Users Edit";
		$data['menu_active'] = "users";
		$data['menu_active_child'] = "edit";
		
		$view = Briliant::admin_template('users/' . Kohana::$config->load('path.main_template') . '/cpas', $data);
		$this->response->body($view);
	}
	
	public function action_cpas_submit(){
		// Id from parameter
		$id = intval($this->request->post('id'));
		
		 // Load Model Users
		$users_model = new Model_Users();
		$data = $users_model->data_by_id($id);
		
		$data['main_title'] = "Users Edit";
		$data['menu_active'] = "users";
		$data['menu_active_child'] = "edit";
		
        $validation = Validation::factory($this->request->post())
                        ->rule('password', 'not_empty')
                        ->rule('retype_password', 'not_empty')
                        ->rule('retype_password',  'matches', array(':validation', 'retype_password', 'password'));
        
        if($validation->check()) {
            
           
			$password = $this->request->post('password');
                
			// Change password
			$users_model->change_password($id, $this->request->post('password'));
			
			$data['success'] = 1;
                
        } else { // Validation Error
            
            $data['errors'] = $validation->errors('validation');
            
        }

		$view = Briliant::admin_template('users/' . Kohana::$config->load('path.main_template') . '/cpas', $data);
		$this->response->body($view);
	}
	
	public function action_delete() {
		$id = $this->request->param('id');
		$users_model = new Model_Users();
		$update = $users_model->delete_data($id);
		
		$this->redirect('/users/list');
	}
	
	public function action_checkValid(){
		// $email = $this->request->param('email');
		$email = $this->request->post("email");
		// print_r(json_encode($data));exit;
		$users_model = new Model_Users();
		$valid = $users_model->checkValid($email);
		
		print_r(json_encode($valid));
		
	}
	
}
