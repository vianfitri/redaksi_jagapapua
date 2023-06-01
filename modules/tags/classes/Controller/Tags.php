<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Tags extends Controller_Backend {
	
	private $custom_footer;
	
	public function before() {
		
		parent::before();
		
		// Javascript for delete data
		$this->custom_footer = '
			<script type="text/javascript">
				function del_confirm(id) {
					var dialog = confirm("' . __('Are you sure for delete this data ?') . '");
					if (dialog == true) {
						window.location.href="/tags/delete/" + id;
					}
				}
			</script>
		';
		
	}
	
	public function action_index() {
		
		$data['main_title'] = __('Newsroom | Data Master | Master Tags');
		$data['menu_active'] = 'media';
		$data['menu_active_child'] = 'tags';
		$data['menu_active_child_1'] = 'list';
		
		// Page from parameter
		$page = intval($this->request->param('page'));
		if(empty($page)) {
			$page = 1;
		}
		
		// Load model
		$tags_model = new Model_Tags();
		
		// Count all data
		$count_all = $tags_model->count_all();
		
		// Pagination
		$pagination = 	Pagination::factory(array(
							'total_items'    		=> $count_all,
							'items_per_page'		=> 20,
							'current_page'			=> $page,
							'base_url'				=> '/tags/index/',
							'view'					=> 'pagination/admin'
						));
						
		$data['list'] = $tags_model->list_data($pagination->items_per_page, $pagination->offset);
		
		$data['pagination'] =  $pagination->render();
		
		$data['custom_footer'] = $this->custom_footer;
		
		$view = Briliant::admin_template('tags/' . Kohana::$config->load('path.main_template') . '/list', $data);
		$this->response->body($view);
		
	}
	
	public function action_search() {
		
		$data['main_title'] = __('Newsroom | Data Master | Master Tags | Search');
		$data['menu_active'] = 'media';
		$data['menu_active_child'] = 'tags';
		$data['menu_active_child_1'] = 'list';
		
		// Redirect jika mengepost search agar bisa menggunakan paginasi dengan beauty url
		$post_search = $this->request->post('search');
		if(!empty($post_search)) {
			$this->redirect('tags/search/' . $post_search);
		}
		
		// Param search
		$search = $this->request->param('search');
		
		// Param page
		$page = intval($this->request->param('page'));
		if(empty($page)) {
			$page = 1;
		}
		
		// Load data from model
		$tags_model = new Model_Tags();
		
		// Count All Data
		$count_all = $tags_model->count_search_data($search);
		
		// Pagination
		$pagination = 	Pagination::factory(array(
							'total_items'    		=> $count_all,
							'items_per_page'		=> 20,
							'current_page'			=> $page,
							'base_url'				=> '/tags/search/' . $search . '/',
							'view'					=> 'pagination/admin'
						));
		
		$data['list'] = $tags_model->search_data($search, $pagination->items_per_page, $pagination->offset);
		$data['search'] = $search;
		
		$data['pagination'] =  $pagination->render();
		
		$data['custom_footer'] = $this->custom_footer;
		
		$view = Briliant::admin_template('tags/' . Kohana::$config->load('path.main_template') . '/list', $data);
		$this->response->body($view);
		
	}
	
	public function action_popup() {
		
		$data['main_title'] = __('Newsroom | Data Master | Master Tags | Search');
		$data['menu_active'] = 'media';
		$data['menu_active_child'] = 'tags';
		$data['menu_active_child_1'] = 'list';
		
		$dom = $this->request->param('dom');
		
		// Param page
		$page = intval($this->request->param('page'));
		if(empty($page)) {
			$page = 1;
		}
		
		// Redirect jika mengepost search agar bisa menggunakan paginasi dengan beauty url
		$post_search = $this->request->post('search');
		if(!empty($post_search)) {
			$this->redirect("tags/popup/{$post_search}/{$page}/{$dom}");
		}
		
		// Param search
		$search = $this->request->param('search');
		
		
		
		// Load data from model
		$tags_model = new Model_Tags();
		
		// Count All Data
		$count_all = $tags_model->count_search_data($search);
		
		// Pagination
		$pagination = 	Pagination::factory(array(
							'total_items'    		=> $count_all,
							'items_per_page'		=> 20,
							'current_page'			=> $page,
							'base_url'				=> '/tags/search/' . $search . '/',
							'view'					=> 'pagination/admin'
						));
		
		$data['list'] = $tags_model->search_data($search, $pagination->items_per_page, $pagination->offset);
		$data['search'] = $search;
		$data['dom'] = $dom;
		
		$data['pagination'] =  $pagination->render();
		
		$data['custom_footer'] = $this->custom_footer;
		
		$view = Briliant::admin_template_plugin('tags/' . Kohana::$config->load('path.main_template') . '/popup', $data);
		$this->response->body($view);
		
	}
	
	public function action_new() {
		
		$data['main_title'] = __('Newsroom | Data Master | Master Tags | Add New Data');
		$data['menu_active'] = 'media';
		$data['menu_active_child'] = 'tags';
		$data['menu_active_child_1'] = 'new';
		
		$view = Briliant::admin_template('tags/' . Kohana::$config->load('path.main_template') . '/new', $data);
		$this->response->body($view);
		
	}
	
	public function action_save() {
		
		$validation = 	Validation::factory($this->request->post())
						->rule('tags', 'not_empty')
						->rule('tags', 'max_length', array(':value', '65'));
						
		if($validation->check()) {
			
                        // Check Duplicate
                        $tags_model = new Model_Tags();
                        
                        $duplicate = $tags_model->check_duplicate($this->request->post('tags'));
                        
                        if(empty($duplicate)) { // No Duplicate
                            
                                $session = Session::instance();
                                $user_id = $session->get('adminId');

                                $param['tags'] = $this->request->post('tags');
                                $param['user_id'] = $user_id;
                                $save_tags = $tags_model->save_data($param);

                                $this->redirect('/tags');
                            
                        } else { // Duplicate
                            
                                $data['errors'] = array(
                                                            __('Duplicate Tags')
                                                    );
                                $data['main_title'] = __('Newsroom | Data Master | Master Tags | Add New Data');
                                $data['menu_active'] = 'data_master';
                                $data['menu_active_child'] = 'tags';

                                $data['tags'] = $this->request->post('tags');

                                $view = Briliant::admin_template('tags/' . Kohana::$config->load('path.main_template') . '/new', $data);
                                $this->response->body($view);
                            
                        }
                    
			
		
		} else {
			
			$data['errors'] = $validation->errors('validation');
			$data['main_title'] = __('Newsroom | Data Master | Master Tags | Add New Data');
			$data['menu_active'] = 'media';
            $data['menu_active_child'] = 'tags';
            $data['menu_active_child_1'] = 'new';
			
			$data['tags'] = $this->request->post('tags');
			
			$view = Briliant::admin_template('tags/' . Kohana::$config->load('path.main_template') . '/new', $data);
			$this->response->body($view);
			
		}
		
	}
	
	public function action_edit() {
		
		// Param edit
		$id = $this->request->param('id');
		
		// Load Model
		$tags_model = new Model_Tags();
		$data = $tags_model->data_by_id($id);
		
		$data['main_title'] = __('Newsroom | Data Master | Master Tags | Edit Data');
		$data['menu_active'] = 'media';
		$data['menu_active_child'] = 'tags';
		$data['menu_active_child_1'] = 'new';
		
		$view = Briliant::admin_template('tags/' . Kohana::$config->load('path.main_template') . '/edit', $data);
		$this->response->body($view);
		
	}
	
	public function action_update() {
		
		$validation = 	Validation::factory($this->request->post())
						->rule('tags', 'not_empty')
						->rule('tags', 'max_length', array(':value', '65'))
						->rule('id', 'not_empty')
						->rule('id', 'numeric');
						
		if($validation->check()) {
			
			$session = Session::instance();
			$user_id = $session->get('adminId');
			
			$tags_model = new Model_Tags();
			$tags = $this->request->post('tags');
			$id = $this->request->post('id');
			$user_id = $user_id;
			$update_tags = $tags_model->update_data($user_id, $id, $tags);
			
			$this->redirect('/tags');
		
		} else {
			
			$data = $this->request->post();
			
			$data['errors'] = $validation->errors('validation');
			$data['main_title'] = __('Newsroom | Data Master | Master Tags | Edit Data');
			$data['menu_active'] = 'media';
            $data['menu_active_child'] = 'tags';
            $data['menu_active_child_1'] = 'new';
			
			// Before input form
			$data['tags'] = $this->request->post('tags');
			$data['name'] = $this->request->post('tags');
			$data['id'] = $this->request->post('id');
			
			$view = Briliant::admin_template('tags/' . Kohana::$config->load('path.main_template') . '/edit', $data);
			$this->response->body($view);
			
		}
		
	}
	
	public function action_delete() {
		
		// Parameter ID
		$id = $this->request->param('id');
		
		// Execute model
		$tags_model = new Model_Tags();
		$tags_model->delete_data(intval($id));
		
		// Redirect to tags list
		$this->redirect('/tags');
		
	}
	
	public function action_ajax() {
		
		$search = $this->request->param('search');
		
		if(empty($search)) {
			echo json_encode(array()); exit();
		}
		
		// Load Model Tag
		$tag_model = new Model_Tags();
		
		// List data
		$list_data = $tag_model->search_data($search, 50, 0);
		
		echo json_encode($list_data); exit();
		
	}
	
	public function action_ajaxid() {
		
		$search = $this->request->param('search');
		
		if(empty($search)) {
			echo json_encode(array()); exit();
		}
		
		// Load Model Tag
		$tag_model = new Model_Tags();
		
		// List data
		$list_data = $tag_model->search_dataid($search, 99999999, 0);
		
		echo json_encode($list_data); exit();
		
	}
        
}