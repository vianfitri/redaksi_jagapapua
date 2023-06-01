<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Library extends Controller_Backend {

	private $custom_footer;

	public function before() {

		parent::before();

		// Javascript for delete data
		$this->custom_footer = '
			<script type="text/javascript">
				function del_confirm(url) {
					var dialog = confirm("' . __('Are you sure for delete this data ?') . '");
					if (dialog == true) {
						window.location.href=url;
					}
				}
			</script>
		';

	}

	public function action_index() {
	    //echo "Library Index";
	    
		$session = Session::instance();

		$data['main_title'] = __('Library | List');
		$data['menu_active'] = 'media';
		$data['menu_active_child'] = 'library';
		$data['menu_active_child_1'] = 'list';

		$config = Kohana::$config->load('path');
		// $data['options'] = $config->get('cdn');
		$data['options'] = "/uploads";

		$session = Session::instance();
		if(isset($_POST['search'])) $session->set('search_image', $_POST['search']);
		$data['search'] = $search = $session->get("search_image", "");

		// Page from parameter
		$page = intval($this->request->param('page'));
		if(empty($page)) $page = 1;
		$data['page'] = $page;

		$id = intval($this->request->param('id'));
		if(empty($id)) $id = 0;
		$data['id'] = $id;

		$data['dom'] = $dom = $this->request->param('dom');
		if(!empty($dom)) $dom = '/'.$dom;

		// Load data from model
		$library_model = new Model_Library();

		// Count All Data
		$count_all = $library_model->count_all($search);

		// Pagination
		$pagination = 	Pagination::factory(array(
							'total_items'    		=> $count_all,
							'items_per_page'	=> 20,
							'current_page'		=> $page,
							'suffix'					=> "{$id}{$dom}",
							'base_url'				=> "/library/index/",
							'view'					=> 'pagination/admin'
						));
		$data['list'] = $library_model->list_data($pagination->items_per_page, $pagination->offset, $search);

		$data['pagination'] =  $pagination->render();

		$data['custom_footer'] = $this->custom_footer;
		$member = $session->get('member');
		$data['member'] = $member;

		if(empty($dom)){
			$view = Briliant::admin_template('library/' . Kohana::$config->load('path.main_template') . '/list', $data);
		}else{
			$view = Briliant::admin_template_plugin('library/' . Kohana::$config->load('path.main_template') . '/list', $data);
		}
		$this->response->body($view);
		
	}

	public function action_new() {
		$library_model = new Model_Library();

		// Page from parameter
		$page = intval($this->request->param('page'));
		if(empty($page)) $page = 1;
		$data['page'] = $page;

		$id = intval($this->request->param('id'));
		if(empty($id)) {
			$id = 0;
		}else{
			$data['library'] = $library_model->data_by_id($id);
		}
		$data['id'] = $id;

		$data['dom'] = $dom = $this->request->param('dom');

		if ($this->request->method() == Request::POST) {
			
			// print_r($_FILES['fileName']);exit;

			$validation = 	Validation::factory($this->request->post())
							->rule('title', 'not_empty')
							->rule('caption', 'not_empty');

			if($validation->check()) {
				$session = Session::instance();
				$user_id = $session->get('adminId');

				$param['id'] = $this->request->post('id');
				$data['library']['title'] = $param['title'] = $this->request->post('title');
				$data['library']['caption'] = $param['caption'] = $this->request->post('caption');
				$param['userId'] = $user_id;

				// Edit By IRUL FZ
				if(!empty($this->request->post('is_edit'))) {

					if(!empty($this->request->post('image_editor'))) {
						$filename = $this->base64_to_jpeg_and_save_image($param, $this->request->post('image_editor'));
					}
					else{
						if (!empty($_FILES['fileName']['size'])) {
							$filename = $this->_save_image($param, $_FILES['fileName']);
						}
					}
					$filename = $library_model->save_data($param);

					header("location: " . URL::Base() . "library/index/{$page}/0/{$dom}");
					exit;
				} else {
					if(!empty($this->request->post('image_editor'))) {
						//print_r($_FILES['fileName']); 
						$filename = $this->base64_to_jpeg_and_save_image($param, $this->request->post('image_editor'));
					}
					else{
						if (!empty($_FILES['fileName'])) {
							$filename = $this->_save_image($param, $_FILES['fileName']);
						}elseif(!empty($param['id'])){
							$filename = $library_model->save_data($param);
						}
					}

					if (empty($filename)) {
						$data['errors'][] = ' There was a problem while uploading the image.
							Make sure it is uploaded and must be JPG/PNG/GIF file.';
					}else{
						if(!empty($param['id'])){
							header("location: " . URL::Base() . "library/index/{$page}/{$id}/{$dom}");
							exit;
						}else{
							header("location: " . URL::Base() . "library/index/{$page}/0/{$dom}");
							exit;
						}
					}
				}

			}else{
				$data['errors'] = $validation->errors('validation');
			}
		}

		$data['main_title'] = __('Library | Add New Data');
		$data['menu_active'] = 'media';
		$data['menu_active_child'] = 'library';
		$data['menu_active_child_1'] = 'add';

		if(empty($dom)){
			$view = Briliant::admin_template('library/' . Kohana::$config->load('path.main_template') . '/edit', $data);
		}else{
			$view = Briliant::admin_template_plugin('library/' . Kohana::$config->load('path.main_template') . '/edit', $data);
		}
		$this->response->body($view);

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

	protected function _save_image($param, $image){
        if (
            ! Upload::valid($image) OR
            ! Upload::not_empty($image) OR
            ! Upload::type($image, array('jpg', 'jpeg', 'png', 'gif'))
			) {
            return FALSE;
        }

		$param['fileType'] = $imageFileType = pathinfo(basename($image["name"]),PATHINFO_EXTENSION);

		$library_model = new Model_Library();
		$arimId = $library_model->save_data($param);
		if(empty($arimId)) return FALSE;

		$directory = DOCROOT.'uploads/library';
		
		$arimId_arr = str_split($arimId);
		foreach($arimId_arr as $v){
			$directory.="/{$v}";
			if(!is_dir($directory)) mkdir($directory, 0777);
		}
		
		/* $files = glob($directory.'/*'); // get all file names
		foreach($files as $file){ // iterate files
		  if(is_file($file))
			@unlink($file); // delete file
		} */
		$filename = "{$arimId}.{$imageFileType}";
        if ($file = Upload::save($image, $filename, $directory))
        {

            // Delete the temporary file
            //unlink($file);
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
		return $filename;
	}

	public function action_delete() {

		$page = intval($this->request->param('page'));
		if(empty($page)) $page = 1;

		$id = intval($this->request->param('id'));
		if(empty($id)) $id = 0;

		$dom = $this->request->param('dom');

		// Execute model
		$library_model = new Model_Library();
		$library_model->delete_data($id);

		$directory = DOCROOT.'uploads/library';
		$arimId_arr = str_split($id);
		foreach($arimId_arr as $v){
			$directory.="/{$v}";
		}

		$files = glob($directory.'/*'); // get all file names
		foreach($files as $file){ // iterate files
		  if(is_file($file))
			@unlink($file); // delete file
		}

		// Redirect to category list
		//header("location: /library/index/{$page}/{$id}/{$dom}");
		header("location: ".URL::Base()."/library/index/{$page}/{$id}/{$dom}");
		// header("location: " . URL::Base() . "/library/index/{$page}/0/{$dom}");
		exit;
	}
	
}
