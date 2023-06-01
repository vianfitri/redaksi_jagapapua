<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Slider extends Controller_Backend {
	
	public function before() {
		
		parent::before();
		
		// Javascript for delete data
		$this->custom_footer = '
			<script type="text/javascript">
				function del_confirm(id) {
					var dialog = confirm("' . __('Are you sure for delete this data ?') . '");
					if (dialog == true) {
						window.location.href="'.URL::base().'slider/delete/" + id;
					}
				}
			</script>
		';
		
	}

	public function action_index() {
		
	}
	
	public function action_new() {
		$data['custom_footer'] =  '
			<script type="text/javascript">
				function open_popup_img() {
					PopupCenter("'.URL::base().'/library/index/1/0/image_popup", "google", "840", "576");
				}
				function image_popup() {
					$(\'#previewImage\').html(\'\');
					$(\'#previewImage\').append(\'<div style=" position: absolute; width: 20px; height: 20px; left: 186px; margin-top: 4px; background-color: rgb(255, 0, 0); "><center><span style="color: #FFFFFF;cursor: pointer;" onclick="javascript:delPreview();">X</span></center></div>\');
					$(\'#previewImage\').append(\'<img src="\' + $(\'#image_popup\').val() + \'" style="width:200px;"/>\');
				}
			</script>
		';
		
		$data['main_title'] = "Slider New";
		$data['menu_active'] = "slider";
		$data['menu_active_child'] = "new";
		$view = Briliant::admin_template('slider/' . Kohana::$config->load('path.main_template') . '/new', $data);
		$this->response->body($view);
	}
	
	public function action_submit() {
		
		$slider_model = new Model_Slider();
		$result = $slider_model->save_data($this->request->post());
		$this->redirect('/slider/list');
	}
	
	public function action_list() {
		
		// Page from parameter
		$page = intval($this->request->param('page'));
		if(empty($page)) {
			$page = 1;
		}
		
		$data['main_title'] = "Slider List";
		$data['menu_active'] = "slider";
		$data['menu_active_child'] = "list";
		
		$slider_model = new Model_Slider();
		$data['count_all'] = $slider_model->count_all();
		
		// Pagination
		$pagination = Pagination::factory(array(
							'total_items'    		=> $data['count_all'],
							'items_per_page'	=> 20,
							'current_page'		=> $page,
							'base_url'				=> '/slider/list/',
							'view'					=> 'pagination/admin'
						));
				
		$data['list'] = $slider_model->list_data($pagination->items_per_page, $pagination->offset);
		
		$data['pagination'] =  $pagination->render();
		
		$data['custom_footer'] = $this->custom_footer;
		
		$view = Briliant::admin_template('slider/' . Kohana::$config->load('path.main_template') . '/list', $data);
		$this->response->body($view);
	}
	
	public function action_edit() {
		
		// Id from parameter
		$id = intval($this->request->param('id'));
		
		$slider_model = new Model_Slider();
		$data = $slider_model->data_by_id($id);
		
		$data['custom_footer'] =  '
				<script type="text/javascript">
					function open_popup_img() {
						PopupCenter("/library/index/1/0/image_popup", "google", "840", "576");
					}
					function delPreview() {
						$(\'#previewImage\').html(\'\');
						$(\'#image_popup\').val(\'\');
					}
					function image_popup() {
						$(\'#previewImage\').html(\'\');
						$(\'#previewImage\').append(\'<div style=" position: absolute; width: 20px; height: 20px; left: 186px; margin-top: 4px; background-color: rgb(255, 0, 0); "><center><span style="color: #FFFFFF;cursor: pointer;" onclick="javascript:delPreview();">X</span></center></div>\');
						$(\'#previewImage\').append(\'<img src="\' + $(\'#image_popup\').val() + \'" style="width:200px;"/>\');
					}
				</script>
			';
		
		$data['main_title'] = "Slider Edit";
		$data['menu_active'] = "slider";
		$data['menu_active_child'] = "edit";
		
		$view = Briliant::admin_template('slider/' . Kohana::$config->load('path.main_template') . '/edit', $data);
		$this->response->body($view);
	}
	
	public function action_update() {
		
		$id = $this->request->post('id');
		$slider_model = new Model_Slider();
		$update = $slider_model->update_data($id, $this->request->post());
		
		$this->redirect('/slider/list');
	}
	
	public function action_search() {
		
		$data['main_title'] = "slider List";
		$data['menu_active'] = 'slider';
		$data['menu_active_child'] = 'list';
		
		// Redirect jika mengepost search agar bisa menggunakan paginasi dengan beauty url
		$post_search = $this->request->post('search');
		if(!empty($post_search)) {
			$this->redirect('/slider/search/' . $post_search);
		}
		
		// Param search
		$search = $this->request->param('search');
		
		// Param page
		$page = intval($this->request->param('page'));
		if(empty($page)) {
			$page = 1;
		}
		
		// Load data from model
		$slider_model = new Model_Slider();
		
		// Count All Data
		$data['count_all'] = $slider_model->count_search_data($search);
		
		// Pagination
		$pagination = 	Pagination::factory(array(
							'total_items'    		=> $data['count_all'],
							'items_per_page'	=> 20,
							'current_page'		=> $page,
							'base_url'				=> URL::Base() . '/list/search/' . $search . '/',
							'view'					=> 'pagination/admin'
						));
		
		$data['list'] = $slider_model->search_data($search, $pagination->items_per_page, $pagination->offset);
		$data['search'] = $search;
		$data['pagination'] =  $pagination->render();
		$data['custom_footer'] = $this->custom_footer;
		
		$view = Briliant::admin_template('slider/' . Kohana::$config->load('path.main_template') . '/list', $data);
		$this->response->body($view);
		
	}
	
	public function action_delete() {
		$id = $this->request->param('id');
		$slider_model = new Model_Slider();
		$update = $slider_model->delete_data($id);
		
		$this->redirect('/slider/list');
	}
	
}
