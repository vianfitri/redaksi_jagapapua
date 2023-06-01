<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Foto extends Controller_Backend {

	public function before() {

		parent::before();

		// Javascript for delete data
		$this->custom_footer = '
			<script type="text/javascript">
				function del_confirm(id) {
					var dialog = confirm("' . __('Are you sure for delete this data ?') . '");
					if (dialog == true) {
						window.location.href="'.URL::base().'foto/delete/" + id;
					}
				}
			</script>
		';

		for ($k = 0; $k <= 5; $k++)  {
			$this->custom_footer .= '
				<!--Tinymce hidden for append image textarea-->
				<input type="hidden" id="image_popup_tmce" />
				<script>
					function open_popup_img'.  $k .'() {
						PopupCenter("'.URL::Base().'library/index/1/0/image_popup'.  $k .'", "google", "840", "576");
					}

					function open_popup_img_tmce() {
						PopupCenter("'.URL::Base().'library/index/1/0/image_popup_tmce", "google", "640", "480");
					}

					function image_popup_tmce() {
						var str = $(\'#image_popup_tmce\').val();
						var n = str.lastIndexOf(".");
						var res = str.substring(0, n)+"_512x351"+str.substring(n);
						tinyMCE.activeEditor.insertContent(\'<img src="\' + res + \'" width="100%" />\');
					}

					function image_popup'.  $k .'() {
						$(\'#previewImage'.  $k .'\').html(\'\');
						$(\'#previewImage'.  $k .'\').append(\'<div style=" position: absolute; width: 20px; height: 20px; left: 186px; margin-top: 4px; background-color: rgb(255, 0, 0); "><center><span style="color: #FFFFFF;cursor: pointer;" onclick="javascript:delPreview'.  $k .'();">X</span></center></div>\');
						$(\'#previewImage'.  $k .'\').append(\'<img src="\' + $(\'#image_popup'.  $k .'\').val() + \'" style="width:200px;"/>\');
						//add_form_image()
					}

					function delPreview'.  $k .'() {
						$(\'#previewImage'.  $k .'\').html(\'\');
						$(\'#image_popup'.  $k .'\').val(\'\');
					}

					function remove_form_image'.  $k .'() {

						$(".gbr_'. $k .'").css("display","none");
						$("#add_form_image").attr("disabled",false);
						delPreview'. $k .'();


					}

					function remove_form_image_edit'.  $k .'() {

						$(".gbr_'. $k .'").css("display","none");
						$("#add_form_image_edit").attr("disabled",false);
						delPreview'. $k .'();
					}

				</script>
			';
			}
	}

	public function action_index() {
		$this->redirect('/foto/list');
	}

	public function action_new() {
		$data['custom_footer'] =  '
			<script type="text/javascript">
				function open_popup_img() {
					PopupCenter("'.URL::Base().'library/index/1/0/image_popup", "google", "840", "576");
				}
				function image_popup() {
					$(\'#previewImage\').html(\'\');
					$(\'#previewImage\').append(\'<div style=" position: absolute; width: 20px; height: 20px; left: 186px; margin-top: 4px; background-color: rgb(255, 0, 0); "><center><span style="color: #FFFFFF;cursor: pointer;" onclick="javascript:delPreview();">X</span></center></div>\');
					$(\'#previewImage\').append(\'<img src="\' + $(\'#image_popup\').val() + \'" style="width:200px;"/>\');
				}
				function delPreview() {
					$(\'#previewImage\').html(\'\');
					$(\'#image_popup\').val(\'\');
				}
				function add_form_image() {
					for(i = 1; i <= $(".gbr").length; i ++) {
						if (i == $(".gbr").length) {
						$("#add_form_image").attr("disabled",true);
						}
						if(typeof $(".gbr_" + i).attr("style") !== "undefined") {
						$(".gbr_" + i).removeAttr("style");
						break;
						}
					}
				}
				$(".amount").keydown(function (e) {
					// Allow: backspace, delete, tab, escape, enter and .
					if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
						// Allow: Ctrl+A
						(e.keyCode == 65 && e.ctrlKey === true) ||
						// Allow: Ctrl+C
						(e.keyCode == 67 && e.ctrlKey === true) ||
						// Allow: Ctrl+X
						(e.keyCode == 88 && e.ctrlKey === true) ||
						// Allow: home, end, left, right
						(e.keyCode >= 35 && e.keyCode <= 39)) {
						// let it happen, don\'t do anything
						return;
					}
					// Ensure that it is a number and stop the keypress
					if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
						e.preventDefault();
					}
				});
				$(".amount").keyup(function(event) {
					// skip for arrow keys
					if(event.which >= 37 && event.which <= 40){
						event.preventDefault();
					}
					$(this).val(function(index, value) {
						return value
							.replace(/\D/g, "")
							//.replace(/([0-9])([0-9]{2})$/, "$1.$2")
							.replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".")
						;
					});
				});
				
				$("#province").change(function () {
					$("#regency").empty();
					$("#province option:selected").each(function() {
						$.get("/comm/ajax_regency/" + $( this ).val(), function( data ) {
							$.each(data, function (i, item) {
								$("#regency").append($("<option>", {
									value: item.msrgId,
									text : item.msrgName
								}));
							});
						}, "json");
					});
				})

				function checkValid(){
					var img = document.getElementById("image_popup").value;
					var detail = document.getElementById("wysiwyg").value;
					if(img == "" || img === undefined){
						alert("belum memilih gambar");
						return false;
					}
					if(detail == "" || detail === undefined){
						alert("detail belum diisi");
						return false;
					}
				}
			</script>
		';

		$data['custom_footer'] .= '<script>
			function add_form_image() {
					for(i = 1; i <= $(".gbr").length; i ++) {
						if (i == $(".gbr").length) {
						$("#add_form_image").attr("disabled",true);
						}
						if(typeof $(".gbr_" + i).attr("style") !== "undefined") {
						$(".gbr_" + i).removeAttr("style");
						break;
						}
					}
			}
			</script>';

		$data['custom_footer'] .= $this->custom_footer;

		//$comm_model = new Model_Comm();
		//$data['province'] = $comm_model->read_data('master_province','msprStatus','msprName');

		$data['main_title'] = "New Foto ";
		$data['menu_active'] = "foto";
		$data['menu_active_child'] = "add";
		$view = Briliant::admin_template('/new', $data);
		$this->response->body($view);
	}

	public function action_categoryNew() {
		$data['main_title'] = "New Category foto";
		$data['menu_active'] = "foto";
		$data['menu_active_child'] = "category";
		$view = Briliant::admin_template('/categoryNew', $data);
		$this->response->body($view);
	}

	public function action_submit() {

		$foto_model = new Model_Foto();
		$result = $foto_model->save_data($this->request->post());
		$this->redirect('/foto/list');
	}

	public function action_categorySubmit() {

		$foto_model = new Model_Foto();
		$result = $foto_model->save_data_category($this->request->post());
		$this->redirect('/foto/category/list');
	}

	public function action_list() {

		// Page from parameter
		$page = intval($this->request->param('page'));
		if(empty($page)) {
			$page = 1;
		}

		$data['main_title'] = "List Foto";
		$data['menu_active'] = "foto";
		$data['menu_active_child'] = "list";

		$foto_model = new Model_Foto();
		$data['count_all'] = $foto_model->count_all();

		// Pagination
		$pagination = Pagination::factory(array(
							'total_items'    		=> $data['count_all'],
							'items_per_page'		=> 20,
							'current_page'			=> $page,
							'base_url'				=> '/foto/list/',
							'view'					=> 'pagination/admin'
						));

		$data['list'] = $foto_model->list_data($pagination->items_per_page, $pagination->offset);

		// print_r($data['list']);exit;

		$data['pagination'] =  $pagination->render();

		$data['custom_footer'] = $this->custom_footer;

		$view = Briliant::admin_template('/list', $data);
		// print_r(View::factory("foto/list"));exit;
		// print_r($view);exit;
		$this->response->body($view);
	}

	public function action_categoryList() {

		// Page from parameter
		$page = intval($this->request->param('page'));
		if(empty($page)) {
			$page = 1;
		}

		$data['main_title'] = "List Category foto";
		$data['menu_active'] = "foto";
		$data['menu_active_child'] = "category";

		$foto_model = new Model_Foto();
		$data['count_all'] = $foto_model->count_all_category();

		// Pagination
		$pagination = Pagination::factory(array(
							'total_items'    		=> $data['count_all'],
							'items_per_page'	=> 20,
							'current_page'		=> $page,
							'base_url'				=> '/foto/category/list/',
							'view'					=> 'pagination/admin'
						));

		$data['list'] = $foto_model->list_data_category($pagination->items_per_page, $pagination->offset);

		$data['pagination'] =  $pagination->render();

		$data['custom_footer'] =  '
												<script type="text/javascript">
													function del_category_confirm(id) {
														var dialog = confirm("' . __('Are you sure for delete this data ?') . '");
														if (dialog == true) {
															window.location.href="'.URL::base().'foto/category/delete/" + id;
														}
													}
												</script>
											';

		$view = Briliant::admin_template('/categoryList', $data);
		$this->response->body($view);
	}

	public function action_edit() {

		// Id from parameter
		$id = intval($this->request->param('id'));

		$foto_model = new Model_Foto();
		$data['detail'] = $foto_model->data_by_id($id);

		//print_r($data['detail']);die;

		$data['custom_footer'] =  '
				<script type="text/javascript">
					function open_popup_img() {
						PopupCenter("'.URL::Base().'library/index/1/0/image_popup", "google", "840", "576");
					}
					function delPreview() {
						$(\'#previewImage\').html(\'\');
						$(\'#image_popup\').val(\'\');
					}
					function image_popup() {
						for(var i=1; i<=2; i++){
							$(\'#previewImage_\'+i).html(\'\');
							$(\'#previewImage_\'+i).append(\'<div style=" position: absolute; width: 20px; height: 20px; left: 186px; margin-top: 4px; background-color: rgb(255, 0, 0); "><center><span style="color: #FFFFFF;cursor: pointer;" onclick="javascript:delPreview();">X</span></center></div>\');
							$(\'#previewImage_\'+i).append(\'<img src="\' + $(\'#image_popup\').val() + \'" style="width:200px;"/>\');

						}
					}
					
					$("#province").change(function () {
						$("#regency").empty();
						$("#province option:selected").each(function() {
							$.get("/comm/ajax_regency/" + $( this ).val(), function( data ) {
								$.each(data, function (i, item) {
									$("#regency").append($("<option>", {
										value: item.msrgId,
										text : item.msrgName
									}));
								});
							}, "json");
						});
					})

					function add_form_image_edit() {
						for(i = 1; i <= $(".gbr").length; i ++) {
							if (i == $(".gbr").length) {
							$("#add_form_image_edit").attr("disabled",true);
							}
							if(typeof $(".gbr_" + i).attr("style") !== "undefined") {
							$(".gbr_" + i).removeAttr("style");
							break;
							}

						}
					}
				</script>
			';

		$data['custom_footer'] .= $this->custom_footer;

		//$comm_model = new Model_Comm();
		//$data['province'] = $comm_model->read_data('master_province','msprStatus','msprName');
		//$data['regency'] =  $comm_model->ajax('master_regency','msrgStatus','msrgName',$data['detail']['province_id']);
		$data['main_title'] = "Edit Foto";
		$data['menu_active'] = "foto";
		$data['menu_active_child'] = "edit";

		//count image
		$a = count($data['detail']['images']);
		//print_r($a);die;
		$data['image_count'] = $a;

		$view = Briliant::admin_template('/edit', $data);
		$this->response->body($view);
	}

	public function action_categoryEdit() {

		// Id from parameter
		$id = intval($this->request->param('id'));

		$foto_model = new Model_Foto();
		$data = $foto_model->data_by_id_category($id);

		$data['main_title'] = "Edit Category foto";
		$data['menu_active'] = "foto";
		$data['menu_active_child'] = "category";

		$view = Briliant::admin_template('/categoryEdit', $data);
		$this->response->body($view);
	}

	public function action_update() {

		$id = $this->request->post('id');
		$foto_model = new Model_Foto();
		$update = $foto_model->update_data($id, $this->request->post());

		$this->redirect('/foto/list');
	}

	public function action_categoryUpdate() {

		$id = $this->request->post('id');
		$foto_model = new Model_Foto();
		$update = $foto_model->update_data_category($id, $this->request->post());

		$this->redirect('/foto/category/list');
	}

	public function action_search() {

		$data['main_title'] = "Search foto";
		$data['menu_active'] = 'foto';
		$data['menu_active_child'] = 'list';

		// Redirect jika mengepost search agar bisa menggunakan paginasi dengan beauty url
		$post_search = $this->request->post('search');
		if(!empty($post_search)) {
			$this->redirect('/foto/search/' . $post_search);
		}

		// Param search
		$search = $this->request->param('search');

		// Param page
		$page = intval($this->request->param('page'));
		if(empty($page)) {
			$page = 1;
		}

		// Load data from model
		$foto_model = new Model_Foto();

		// Count All Data
		$data['count_all'] = $foto_model->count_search_data($search);

		// Pagination
		$pagination = 	Pagination::factory(array(
							'total_items'    		=> $data['count_all'],
							'items_per_page'	=> 20,
							'current_page'		=> $page,
							'base_url'				=> '/foto/search/' . $search . '/',
							'view'					=> 'pagination/admin'
						));

		$data['list'] = $foto_model->search_data($search, $pagination->items_per_page, $pagination->offset);
		$data['search'] = $search;
		$data['pagination'] =  $pagination->render();
		$data['custom_footer'] = $this->custom_footer;

		$view = Briliant::admin_template('/list', $data);
		$this->response->body($view);

	}

	public function action_categorySearch() {

		$data['main_title'] = "Search Category foto";
		$data['menu_active'] = 'foto';
		$data['menu_active_child'] = 'category';

		// Redirect jika mengepost search agar bisa menggunakan paginasi dengan beauty url
		$post_search = $this->request->post('search');
		if(!empty($post_search)) {
			$this->redirect('/foto/category/search/' . $post_search);
		}

		// Param search
		$search = $this->request->param('search');

		// Param page
		$page = intval($this->request->param('page'));
		if(empty($page)) {
			$page = 1;
		}

		// Load data from model
		$foto_model = new Model_Foto();

		// Count All Data
		$data['count_all'] = $foto_model->count_search_data_category($search);

		// Pagination
		$pagination = 	Pagination::factory(array(
							'total_items'    		=> $data['count_all'],
							'items_per_page'	=> 20,
							'current_page'		=> $page,
							'base_url'				=> '/foto/category/search/' . $search . '/',
							'view'					=> 'pagination/admin'
						));

		$data['list'] = $foto_model->search_data_category($search, $pagination->items_per_page, $pagination->offset);
		$data['search'] = $search;
		$data['pagination'] =  $pagination->render();
		$data['custom_footer'] =  '
												<script type="text/javascript">
													function del_category_confirm(id) {
														var dialog = confirm("' . __('Are you sure for delete this data ?') . '");
														if (dialog == true) {
															window.location.href="'.URL::base().'foto/category/delete/" + id;
														}
													}
												</script>
											';

		$view = Briliant::admin_template('/categoryList', $data);
		$this->response->body($view);

	}

	public function action_delete() {
		$id = $this->request->param('id');
		$foto_model = new Model_Foto();
		$update = $foto_model->delete_data($id);

		$this->redirect('/foto/list');
	}

	public function action_categoryDelete() {
		$id = $this->request->param('id');
		$foto_model = new Model_Foto();
		$update = $foto_model->delete_data_category($id);

		$this->redirect('/foto/category/list');
	}

}
