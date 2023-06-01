<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_News {

	public static function validation($post) {
		
		$validation = 	Validation::factory($post)
						->rule('title', 'not_empty')
						->rule('title', 'max_length', array(':value', '65'))
						->rule('description', 'not_empty')
						->rule('description', 'max_length', array(':value', '165'))
						->rule('detail', 'not_empty')
						;
						
		if($validation->check()) {
			
			$return = TRUE;
		
		} else {
		
			$return = $validation->errors('validation');
		
		}
		
		return $return;
	}
    
    public static function get_user_approver($article_id = '') {
        
        $return = '';
		
        $exec = DB::select(
                        array('userRealName', 'name')
                )
                ->from('article')
                ->join('user', 'LEFT')
		->on('article.artcUserIdApproved', '=', 'user.userId')
                ->where('artcId', '=', $article_id)
                ->execute()
                ->as_array();

        if(!empty($exec[0]['name'])) {
                $return = $exec[0]['name'];
        }

        return $return;
        
    }
    
	public static function get_user_saved($article_id = '') {
		
		$return = '';
		
        $exec = DB::select(
                        array('userRealName', 'name')
                )
                ->from('article')
                ->join('user', 'LEFT')
		->on('article.artcUserIdSaved', '=', 'user.userId')
                ->where('artcId', '=', $article_id)
                ->execute()
                ->as_array();

        if(!empty($exec[0]['name'])) {
                $return = $exec[0]['name'];
        }

        return $return;
		
	}
	
    public static function get_image($article_id = '') {
        
        $return = '';
        
        $exec = DB::select(
                        array('arimId', 'image_id'),
                        array('arimFileType', 'image_type')
                )
                ->from('news_images')
                ->join('arsip_images', 'LEFT')
                ->on('arsip_images.arimId', '=', 'news_images.neimArimId')
                ->where('neimNewsId', '=', $article_id)
                ->limit(1)
                ->execute()
                ->as_array();

        if(!empty($exec[0]['image_id'])) {
            $split = str_split($exec[0]['image_id']);
            $path = implode('/', $split);
            $return = '/uploads/library/' . $path . '/' . $exec[0]['image_id'] . '.' . $exec[0]['image_type'];
        }
        
        return $return;
        
    }
    
    public static function detail($article_id = '') {
        
        // Load MOdel News
        $news_model = New Model_News();
        
        //Detail
        return $news_model->detail_data($article_id);
        
    }
	
	public static function select_list($dom_name = '', $status = '', $id_selected = '', $custom = '', $version='') {
		$session = Session::instance();
		$return = '';
		
		$exec = DB::select(
					array('msctId', 'id'),
					// array('msctAds', 'status'),
					array('msctName', 'name')
				)
				->from('master_category');
				
		if($status === 0 OR $status === 1) {
			$exec = $exec->where('msctStatus', '=', $status);
		}
		
		//$member = $session->get('member');
		//if($member == 2) {
			//$exec = $exec->where('msctAds', '=', 1);
		//}
		// $exec = $exec->order_by('msctAds', 'ASC')
		$exec = $exec->order_by('msctName', 'ASC')
				->execute()
				->as_array();

		if($version=='lite'){
			$return .= '<div style="width: 200px;float: left;">
					<select ' . $custom . ' class="form-control" name="' . $dom_name . '" required>
							<option value="">-- ' . __('Choose Category') . ' --</option>';
		}else{
			$return .= '<div class="form-group">
						<label>' . __('Category') . '</label>
						<select ' . $custom . ' class="form-control" name="' . $dom_name . '" required>
							<option value="">-- ' . __('Choose Category') . ' --</option>';
		}

		$status=0;
		if(!empty($exec)) {
			foreach($exec as $v_exec) {
				$selected_val = '';
				if($id_selected == $v_exec['id']) {
					$selected_val = 'selected';
				}
				$return .= '<option value="' . $v_exec['id'] . '" ' . $selected_val . '>' . $v_exec['name'] . '</option>';
			}
		}

		$return .= '	</select></div>';
		return $return;

	}
    
}