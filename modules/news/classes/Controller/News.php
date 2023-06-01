<?php defined('SYSPATH') or die('No direct script access.');

class Controller_News extends Controller_Backend {

	private $custom_header_form;

	private $custom_footer_form;

	public function before() {

		parent::before();

		// Header Multiple SElect
		$this->custom_header_form = '
			<link rel="stylesheet" href="/assets/plugins/select2/select2.min.css">
			<link rel="stylesheet" href="/assets/dist/css/AdminLTE.min.css">
		';

		// Custom header for daterangepicker
		$this->custom_header_form .= '<link rel="stylesheet" href="/assets/plugins/daterangepicker/daterangepicker-bs3.css">';

		// Tinymce
		$this->custom_footer_form = '
			<script src="/assets/tinymce/tinymce.min.js"></script>
			<script>
				$(function() {
					$(\'#publish_time\').daterangepicker({
						format: \'DD/MM/YYYY HH:mm:ss\',
						timePicker: true,
						singleDatePicker: true,
						timePickerIncrement: 1,
						timePicker12Hour: false,
						//minDate: \'' . date('d-m-Y H:i:s') . '\'
					});
				});
				tinymce.init({
					paste_data_images: true,
					valid_elements : \'*[*]\',
					selector: \'.f_tinymce\',
					theme: \'modern\',
                    templates: [{title: \'Berita Lainnya\', description: \'Berita Lainnya\', url: \'/template/terkait.html\'},{title: \'Button Selengkapnya\', description: \'Button Selengkapnya\', url: \'/template/selengkapnya.html\'},{title: \'Sharing\', description: \'Sharing Information\', url: \'/template/sharing.html\'},{title: \'Mutiara\', description: \'Informasi Mutiara\', url: \'/template/komunitas.html\'},{title: \'Download Arena\', description: \'Link Download Aplikasi Arena\', url: \'/template/arena.html\'}],
					plugins: [
						\'example advlist autolink lists link image charmap print preview hr anchor pagebreak\',
						\'searchreplace wordcount visualblocks visualchars code fullscreen\',
						\'insertdatetime media nonbreaking save table contextmenu directionality\',
						\'emoticons template paste textcolor colorpicker textpattern imagetools\'
					],
					toolbar1: \'insertfile undo redo | styleselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image\',
					toolbar2: \'fullscreen preview media | forecolor backcolor emoticons | pagebreak | my_image\',
					image_advtab: true,
                                        pagebreak_separator: "<!--PAGE_SEPARATOR-->",
                                        pagebreak_split_block: true,
                                        setup: function (editor) {
                                        editor.addButton(\'my_image\', {
                                            text: \'Add Image From Gallery\',
                                            icon: false,
                                            onclick: function () {
                                                open_popup_img_tmce();
                                            }
                                        });
                                      },
				});
			</script>
		';

		// Multiple SElect
		$this->custom_footer_form .= '
			<script src="/assets/plugins/select2/select2.full.min.js"></script>
			<script>
				$(".select2").select2();
			</script>
		';

		// Custom footer for daterangepicker
		$this->custom_footer_form .= '
			<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
			<script src="/assets/plugins/daterangepicker/daterangepicker.js"></script>
			<!--Tinymce hidden for append image textarea-->
			<input type="hidden" id="image_popup_tmce" />
			<script>
				function open_popup_img() {
					PopupCenter("/library/index/1/0/image_popup", "google", "840", "576");
				}

				function open_popup_img_tmce() {
					PopupCenter("/library/index/1/0/image_popup_tmce", "google", "640", "480");
				}

				function image_popup_tmce() {
					var str = $(\'#image_popup_tmce\').val();
					var n = str.lastIndexOf(".");
					var res = str.substring(0, n)+"_512x351"+str.substring(n);
					tinyMCE.activeEditor.insertContent(\'<img src="\' + res + \'" width="100%" />\');
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
                
                $(\'.refresh_tags\').click(function() {
                    $(this).html(\'Loading ...\');
                    $(\'select[name="tags[]"]\').empty();

                    $.getJSON( "/tags/ajax", function( data ) {
                        $.each( data, function( key, val ) {
                            $(\'select[name="tags[]"]\').append(\'<option value="\' + val.id + \'">\' + val.name + \'</option>\')
                        }, chlabel());
                    });
                })

                $(document).ready(function(){
                    //$(\'select[name="tags[]"]\').empty();
                    ajax_tags()
                });

                $(\'select[name="tags[]"]\').change(function() {ajax_tags()})

                function ajax_tags() {
                    $(\'.select2-search__field\').on("keyup", function(e){
                        if (e.which <= 90 && e.which >= 48) {
                            var str = $(\'.select2-search__field\').val();
                            var n = str.length;
                            if(n >= 2) {
                                $(\'.refresh_tags\').html(\'Loading ...\');
                                console.log("Ajax Search : " + $(\'.select2-search__field\').val());
                                $.getJSON( "/tags/ajax/" + $(\'.select2-search__field\').val(), function( data ) {
                                    var arrJs = [];
                                    $(\'select[name="tags[]"] option\').each(function() {
                                        arrJs.push($(this).val())
                                    });
                                    $.each( data, function( key, val ) {
                                        var id_data = val.id;
                                        var sid_data = id_data.toString();
                                        if(arrJs.indexOf(sid_data) == -1) {
                                            $(\'select[name="tags[]"]\').append(\'<option value="\' + val.id + \'">\' + val.name + \'</option>\')
                                        }
                                    }, chlabel());
                                });
                            }
                        }
                    })
                }

                // Jika Diakses dari mobile
                if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                    var oldData = "";
                    setInterval(function(){
                        var newData = $(\'.select2-search__field\').val();
                        if(oldData != newData) {
                            oldData = newData
                            var n = newData.length;
                            if(n >= 3) {
                                $(\'.refresh_tags\').html(\'Loading ...\');
                                console.log("Ajax Search : " + $(\'.select2-search__field\').val());
                                $.getJSON( "/tags/ajax/" + $(\'.select2-search__field\').val(), function( data ) {
                                    var arrJs = [];
                                    $(\'select[name="tags[]"] option\').each(function() {
                                        arrJs.push($(this).val())
                                    });
                                    $.each( data, function( key, val ) {
                                        var id_data = val.id;
                                        var sid_data = id_data.toString();
                                        if(arrJs.indexOf(sid_data) == -1) {
                                            $(\'select[name="tags[]"]\').append(\'<option value="\' + val.id + \'">\' + val.name + \'</option>\')
                                        }
                                    }, chlabel());
                                });
                            }
                        }
                    }, 500);
                }

                function chlabel() {
                    $(\'.refresh_tags\').html(\'( Click Here For Refresh Tags )\');
                }

			</script>
		';

	}

	public function action_index() {
		// Redirect
		$this->redirect('/news/search');
	}

	public function action_search() {

		$session = Session::instance();

		if(isset($_POST['version'])) $session->set('version_news', $_POST['version']);
		$data['version'] = $version = $session->get("version_news", "");

		if(isset($_POST['publisher'])) $session->set('publish_news', $_POST['publisher']);
		$data['publish'] = $publish = $session->get("publish_news", "newsPublishTime");

		if(isset($_POST['category'])) $session->set('category_news', $_POST['category']);
		$data['category'] = $category = $session->get("category_news", "");

		if(isset($_POST['search'])) $session->set('search_news', $_POST['search']);
		$data['search'] = $search = $session->get("search_news", "");

		if(isset($_GET['date_range'])) $session->set('date_range_news', $_GET['date_range']);
		$data['date_range'] = $date_range = $session->get("date_range_news", "");

		// print_r($_GET);exit();

		$data['main_title'] = __('News List');
		$data['menu_active'] = 'newsroom';
		$data['menu_active_child'] = 'article';
		$data['menu_active_child_1'] = 'list';

		// Redirect jika mengepost search agar bisa menggunakan paginasi dengan beauty url
		// $post_search = $this->request->post('search');

		/* if(!empty($post_search)) {
			$this->redirect('news/search/' . base64_encode($post_search) . '/?date_range=' . $date_range);
		} */

		// Param search
		// $data['search'] = $search = base64_decode($this->request->param('search'));

		// Custom header for daterangepicker
		$data['custom_header'] = '<link rel="stylesheet" href="/assets/plugins/daterangepicker/daterangepicker-bs3.css">';

		// Custom footer for daterangepicker
		$data['custom_footer'] = '
			<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
			<script src="/assets/plugins/daterangepicker/daterangepicker.js"></script>
			<script>
				//Date range picker
				$(function() {
					$(\'#reservation\').daterangepicker(
						{
							format: \'DD/MM/YYYY\'
						}, function (start, end) {
							window.location = "' . URL::Base() . 'news/search/?date_range=" + $(\'#reservation\').val();
						}
					);
				});
			</script>
		';

		// Yes No Confirm
		$data['custom_footer'] .= '
			<script type="text/javascript">
				function del_confirm(id) {
					var dialog = confirm("' . __('Are you sure for delete this data ?') . '");
					if (dialog == true) {
						window.location.href="' . URL::Base() . 'news/delete/" + id;
					}
				}
			</script>
		';

		// Date parameter
		/* $date_range = $this->request->post('date_range');
		$date_range = !empty($_GET['date_range']) ? $_GET['date_range'] : $date_range; */
		if(empty($date_range)) {
			//$date1 = date('Y-m-d');
			$date1 = '2001-01-01';
            $date2 = date('Y-m-d');
		} else {
			$ex_range = explode(' - ', $date_range);
			if(!empty($ex_range)) {
				$date1 = DateTime::createFromFormat('d/m/Y', $ex_range[0]);
				$date1 = $date1->format('Y-m-d');
				$date2 = DateTime::createFromFormat('d/m/Y', $ex_range[1]);
				$date2 = $date2->format('Y-m-d');
			}
		}

		// Date adding time
		$date1 = $date1 . ' 00:00:00';
		$date2 = $date2 . ' 00:00:00';

		// Page
		$page = intval($this->request->param('page'));
		if(empty($page)) {
			$page = 1;
		}

		// $user_model = new Model_User();
        // $data['all_user'] = $user_model->list_all();

		// Load model news
		$news_model = new Model_News();

		// Count all data
		$count_all = $news_model->count_search($date1, $date2, $search);
		$data['count_all'] = $count_all;

		// Pagination
		$pagination = 	Pagination::factory(array(
							'total_items'    		=> $count_all,
							'items_per_page'		=> 20,
							'current_page'			=> $page,
							'base_url'				=> '/news/search/',
							'view'					=> 'pagination/admin'
							// 'suffix'				=> '?date_range=' . $date_range,
						));

		$data['list'] = $news_model->list_search($date1, $date2, $search, $pagination->items_per_page, $pagination->offset);

		$data['pagination'] = $pagination->render();

		// print_r($data['list']);exit;

		// Session
		$data['session_user_id'] = $session->get('user_id');

		$view = Briliant::admin_template('news/' . Kohana::$config->load('path.main_template') . '/list', $data);

		$this->response->body($view);

	}

	public function action_new() {
		$data['main_title'] = __('News | Add New Data');
		$data['menu_active'] = 'newsroom';
		$data['menu_active_child'] = 'article';
		$data['menu_active_child_1'] = 'add';

		$data['custom_header'] = $this->custom_header_form;
		$data['custom_footer'] = $this->custom_footer_form;

		$data['custom_footer'] .=  '
			<script type="text/javascript">
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

		$view = Briliant::admin_template('news/' . Kohana::$config->load('path.main_template') . '/new', $data);
		$this->response->body($view);
	}

	public function action_save() {
		// print_r($this->request->post());exit;
		$session = Session::instance();

		// Validation
		$validation = News::validation($this->request->post());

		if($validation !== TRUE) { // Error Validation

			$data['main_title'] = __('Newsroom | Newsroom | News | Add New Data');
			$data['menu_active'] = 'newsroom';
			$data['menu_active_child'] = 'news';

			$data['custom_header'] = $this->custom_header_form;
			$data['custom_footer'] = $this->custom_footer_form;

			$data['errors'] = $validation;

			$data['post'] = $this->request->post();

			$view = Briliant::admin_template('news/' . Kohana::$config->load('path.main_template') . '/new', $data);

			$this->response->body($view);

		} else { // Validation Success

			// Get user id from session

			$user_id = $session->get('adminId');

			// Load Model
			$news_model = new Model_News();

			// Save data
			$save_data = $news_model->save_data($this->request->post(), $user_id);

			$this->redirect('/news/search');
		}

	}

	public function action_edit() {
		$session = Session::instance();

		$data['main_title'] = __('News | Edit Data');
		$data['menu_active'] = 'newsroom';
		$data['menu_active_child'] = 'article';

		$data['custom_header'] = $this->custom_header_form;
		$data['custom_footer'] = $this->custom_footer_form;

		// Paramter ID
		$id = $this->request->param('id');

		// Get user id from session
		$user_id = $session->get('adminId');

		// Load Model
		$news_model = new Model_News();

		// Detail Data
		$news_detail = $news_model->detail_data($id);

		$data['detail'] = $news_detail;
		$data['detail']['publishTime'] = date("d/m/Y H:i:s", strtotime($data['detail']['publishTime']));
		$view = Briliant::admin_template('news/' . Kohana::$config->load('path.main_template') . '/edit', $data);
		$this->response->body($view);

	}

	public function action_update() {

		// Get user id from session
		$session = Session::instance();
		$user_id = $session->get('adminId');

		// Check permission data
		$id_parameter = $this->request->post('id');

		// Validation
		$validation = News::validation($this->request->post());

		if($validation !== TRUE) { // Error Validation

			$data['main_title'] = __('Newsroom | Newsroom | News | Edit Data');
			$data['menu_active'] = 'newsroom';
			$data['menu_active_child'] = 'article';

			$data['custom_header'] = $this->custom_header_form;
			$data['custom_footer'] = $this->custom_footer_form;

			$data['errors'] = $validation;

			$data['detail'] = $this->request->post();
			if(!empty($data['detail']['category'])) {
				$data['detail']['category_id'] = $data['detail']['category'];
			}

			$view = Briliant::admin_template('news/' . Kohana::$config->load('path.main_template') . '/edit', $data);

			$this->response->body($view);

		} else { // Validation Success

			// Load Model
			$news_model = new Model_News();

			// Update Data
			$update_data = $news_model->update_data($this->request->post(), $user_id);

			$this->redirect('/news/search');

		}

	}

	public function action_delete() {

		// ID Parameter
		$id = $this->request->param('id');

		// Get user id from session
		$session = Session::instance();
		$user_id = $session->get('adminId');

		// Load Model News
		$news_model = new Model_News();

		// Change status to 0
		$news_model->delete_data($id);

		// Redirect
		$this->redirect('/news/search');

	}

	public function action_detail() {
		$session = Session::instance();

		$data['main_title'] = __('News | Detail');
		$data['menu_active'] = 'newsroom';
		$data['menu_active_child'] = 'article';

		$id = $this->request->param('id');

		// Load model news
		$news_model = new Model_News();

		// Detail data
		$data['detail'] = $news_model->detail_data($id);

		$member = $session->get('member');
		$view = Briliant::admin_template('news/' . Kohana::$config->load('path.main_template') . '/detail', $data);
		$this->response->body($view);

	}

	public function action_listapprove() {

		$session = Session::instance();

		if(isset($_POST['version'])) $session->set('version_news', $_POST['version']);
		$data['version'] = $version = $session->get("version_news", "");

		if(isset($_POST['publisher'])) $session->set('publish_news', $_POST['publisher']);
		$data['publish'] = $publish = $session->get("publish_news", "newsPublishTime");

		if(isset($_POST['category'])) $session->set('category_news', $_POST['category']);
		$data['category'] = $category = $session->get("category_news", "");

		if(isset($_POST['search'])) $session->set('search_news', $_POST['search']);
		$data['search'] = $search = $session->get("search_news", "");

		if(isset($_GET['date_range'])) $session->set('date_range_news', $_GET['date_range']);
		$data['date_range'] = $date_range = $session->get("date_range_news", "");

		$data['main_title'] = __('Approve News List');
		$data['menu_active'] = 'newsroom';
		$data['menu_active_child'] = 'article';
		$data['menu_active_child_1'] = 'approve';

		// Custom header for daterangepicker
		$data['custom_header'] = '<link rel="stylesheet" href="/assets/plugins/daterangepicker/daterangepicker-bs3.css">';

		// Custom footer for daterangepicker
		$data['custom_footer'] = '
			<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
			<script src="/assets/plugins/daterangepicker/daterangepicker.js"></script>
			<script>
				//Date range picker
				$(function() {
					$(\'#reservation\').daterangepicker(
						{
							format: \'DD/MM/YYYY\'
						}, function (start, end) {
							window.location = "' . URL::Base() . 'news/search/?date_range=" + $(\'#reservation\').val();
						}
					);
				});
			</script>
		';

		// Yes No Confirm
		$data['custom_footer'] .= '
			<script type="text/javascript">
				function del_confirm(id) {
					var dialog = confirm("' . __('Are you sure for delete this data ?') . '");
					if (dialog == true) {
						window.location.href="' . URL::Base() . 'news/delete/" + id;
					}
				}
			</script>
		';

		// Date parameter
		if(empty($date_range)) {
			$date1 = date('Y-m-d');
			$date2 = date('Y-m-d');
		} else {
			$ex_range = explode(' - ', $date_range);
			if(!empty($ex_range)) {
				$date1 = DateTime::createFromFormat('d/m/Y', $ex_range[0]);
				$date1 = $date1->format('Y-m-d');
				$date2 = DateTime::createFromFormat('d/m/Y', $ex_range[1]);
				$date2 = $date2->format('Y-m-d');
			}
		}

		// Date adding time
		$date1 = $date1 . ' 00:00:00';
		$date2 = $date2 . ' 00:00:00';

		// Page
		$page = intval($this->request->param('page'));
		if(empty($page)) {
			$page = 1;
		}

		// Load model news
		$news_model = new Model_News();

		// Count all data
		$data['count_all'] = $count_all = $news_model->count_search_approve($search);

		// Pagination
		$pagination = 	Pagination::factory(array(
							'total_items'    		=> $count_all,
							'items_per_page'		=> 20,
							'current_page'			=> $page,
							'base_url'				=> '/news/search/',
							'view'					=> 'pagination/admin'
							// 'suffix'				=> '?date_range=' . $date_range,
						));

		$data['list'] = $news_model->list_search_approve($search, $pagination->items_per_page, $pagination->offset);

		$data['pagination'] = $pagination->render();

		// Session
		$data['session_user_id'] = $session->get('user_id');

		$view = Briliant::admin_template('news/' . Kohana::$config->load('path.main_template') . '/list_approve', $data);

		$this->response->body($view);

	}

	public function action_approve() {

		$data['main_title'] = __('Approve News');
		$data['menu_active'] = 'newsroom';
		$data['menu_active_child'] = 'approve';

		$data['custom_header'] = $this->custom_header_form;
		$data['custom_footer'] = $this->custom_footer_form;

		// Paramter ID
		$id = $this->request->param('id');

		// Load Model
		$news_model = new Model_News();

		// Detail Data
		$data['detail'] = $news_detail = $news_model->detail_data_approve($id);

		$view = Briliant::admin_template('news/' . Kohana::$config->load('path.main_template') . '/edit_approve', $data);
		$this->response->body($view);

	}

	public function action_approvesubmit() {
		$data = $this->request->post();
		$type = pathinfo($data['image'], PATHINFO_EXTENSION);
		// header("content-type: image/".$type."");
		$file = file_get_contents($data['image']);

		$param['title'] = $data['title'];
		$param['caption'] = $data['description'];
		$base64 = 'data:image/' . $type . ';base64,' . base64_encode($file);

		$data['id_img'] = $this->base64_to_jpeg_and_save_image($param, $base64);

		$session = Session::instance();

		// Get user id from session
		$user_id = $session->get('adminId');

		$news_model = new Model_News();

		// Save data
		$save_data = $news_model->save_data_approve($data, $user_id);

		$this->redirect('/news/listapprove');

	}

	protected function base64_to_jpeg_and_save_image($param, $base64_string) {
		// open the output file for writing
		$output_file = getcwd()."/uploads/editor/temp.jpg";
		$ifp = fopen( $output_file, 'wb' );

		// split the string on commas
		// $data[ 0 ] == "data:image/png;base64"
		// $data[ 1 ] == <actual base64 string>
		$data = explode( ',', $base64_string );

		// we could add validation here with ensuring count( $data ) > 1
		fwrite( $ifp, base64_decode( $data[ 1 ] ) );

		// clean up the file resource
		fclose( $ifp );

		$param['fileType'] = $imageFileType = "jpg";

		$library_model = new Model_Library();
		$arimId = $library_model->save_data($param);
		if(empty($arimId)) return FALSE;

		$directory = DOCROOT.'uploads/library';
		$arimId_arr = str_split($arimId);
		foreach($arimId_arr as $v){
			$directory.="/{$v}";
			if(!is_dir($directory)) mkdir($directory, 0777);
		}

		$filename = "{$arimId}.{$imageFileType}";
        if (copy($output_file, $directory."/".$filename)){
            return $this->_resize($imageFileType, $directory, $arimId);
        }
        return FALSE;
	}

	protected function _resize($imageFileType, $directory, $arimId) {
		$filename = "{$arimId}.{$imageFileType}";
		$file = "{$directory}/{$filename}";

		$size_image = array();
		$size_image[] = array(512, 351);
		$size_image[] = array(300, 206);
		$size_image[] = array(224, 153);
		$size_image[] = array(263, 180);

		if($imageFileType=='gif'){
			$filenameJPG = "{$arimId}_683x468.jpg";
			Image::factory($file)->resize(683, 468, Image::AUTO)->save("{$directory}/{$filenameJPG}");
			list($orig_width, $orig_height, $type) = getimagesize($file);
			$coalesce = "{$directory}/{$arimId}_coalesce.gif";
			exec("convert {$file} -coalesce {$coalesce}", $output);
			foreach($size_image as $z){
				/* $imagick = new Imagick($file);
				$imagick = $imagick->coalesceImages();
				$file_name = "{$arimId}_{$z[0]}x{$z[1]}.{$imageFileType}";
				foreach ($imagick as $frames) {
				  $frames->thumbnailImage($z[0], $z[1]);
				  $frames->setImagePage($z[0], $z[1], 0, 0);
				}
				$imagick = $imagick->deconstructImages();
				$imagick->writeImages("{$directory}/{$file_name}", true); */

				$file_name = "{$arimId}_{$z[0]}x{$z[1]}.{$imageFileType}";
				error_log("convert -size {$orig_width}x{$orig_height} {$coalesce} -resize {$z[0]}x{$z[1]} {$directory}/{$file_name}", 3, "./../temp/{$arimId}_{$z[0]}x{$z[1]}.sh");
			}
		}else{
			$size_image[] = array(840, 576);
			$size_image[] = array(683, 468);
			foreach($size_image as $z){
				$filename = "{$arimId}_{$z[0]}x{$z[1]}.{$imageFileType}";
				Image::factory($file)
					->resize($z[0], $z[1], Image::AUTO)
					//->render(NULL, 60)
					->save("{$directory}/{$filename}");
			}
		}
		// Engine_Arsipimage::send_to_web($arimId);
		// Engine_Library::send_to_web($arimId, $directory);
		return $arimId;
	}

}
