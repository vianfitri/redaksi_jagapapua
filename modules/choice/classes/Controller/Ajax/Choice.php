<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax_Choice extends Controller_Ajax_Backend {
    
    public function before() {
        parent::before();
    }
    
    public function action_save() {
        
        $post = $this->request->post();
        
        // Load model 
        $choice_model = new Model_Choice();
        
        // Session user
        $session = Session::instance();
        $user_id = $session->get('user_id');
        
        // Save data
        $save = $choice_model->save_data($post, $user_id);
        
        if($save === TRUE) {
            list($type, $id) = explode('|', $post['post_val']);
            if($type == 'article') {
                $this->ajax_return['data'] = News::detail($id);
            } else if($type == 'gallery') {
                $this->ajax_return['data'] = Photo::detail($id);
            } else if($type == 'video') {
                $this->ajax_return['data'] = Video::detail($id);
            }
            $this->ajax_return['error'] = 0;
            $this->ajax_return['message'] = __('Data Saved');
        } else {
            $this->ajax_return['error'] = 1;
            $this->ajax_return['message'] = __('Save failed..!!');
        }
        
        echo json_encode($this->ajax_return); exit();
        
    }
	
	public function action_change() {
		
		$id = $this->request->param('id');
		$id_src = $this->request->param('id_src');
        
        // Load model 
        $choice_model = new Model_Choice();
        
        // Session user
        $session = Session::instance();
        $user_id = $session->get('user_id');
        
        // Change data
        $change = $choice_model->change_data($id, $id_src, $user_id);
		
		echo "<script>window.close();</script>";
    }
    
}