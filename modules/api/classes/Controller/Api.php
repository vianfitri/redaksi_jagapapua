<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Api extends Controller {
		
	public function action_image() {
		
		$data = $this->request->post();
        
        if(!empty($data['id'])) {
            $id_img = $data['id'];
            $this->_save_image_with_id($data, $_FILES['image']);
        } else {
            $id_img = $this->_save_image($data, $_FILES['image']);   
        }
		
		echo $id_img;
		
		// print_r($data);
		// print_r($_FILES['image']);
		
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

		$filename = "{$arimId}.{$imageFileType}";
        if ($file = Upload::save($image, $filename, $directory))
        {
            return $this->_resize($imageFileType, $directory, $arimId);
        }

        return FALSE;
    }
    
    protected function _save_image_with_id($param, $image){
        if (
            ! Upload::valid($image) OR
            ! Upload::not_empty($image) OR
            ! Upload::type($image, array('jpg', 'jpeg', 'png', 'gif'))
			) {
            return FALSE;
        }

		$param['fileType'] = $imageFileType = pathinfo(basename($image["name"]),PATHINFO_EXTENSION);

		$library_model = new Model_Library();
		$arimId = $library_model->save_data_with_id($param);
		if(empty($arimId)) return FALSE;

		$directory = DOCROOT.'uploads/library';
		$arimId_arr = str_split($arimId);
		foreach($arimId_arr as $v){
			$directory.="/{$v}";
			if(!is_dir($directory)) mkdir($directory, 0777);
		}

		$filename = "{$arimId}.{$imageFileType}";
        if ($file = Upload::save($image, $filename, $directory))
        {
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

		return $arimId;
	}
	
	
} // End Welcome