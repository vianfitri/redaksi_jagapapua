<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax_Tagspin extends Controller_Ajax_Backend {

    public function before() {
        parent::before();
    }

    public function action_save() {

        $post = $this->request->post();

        // Load model
        $headline_model = new Model_Tagspin();

        // Session user
        $session = Session::instance();
        $user_id = $session->get('user_id');

        // Save data
        $save = $headline_model->save_data($post, $user_id);

        if($save === TRUE) {
            $this->ajax_return['error'] = 0;
            $this->ajax_return['message'] = __('Data Saved');
        } else {
            $this->ajax_return['error'] = 1;
            $this->ajax_return['message'] = __('Save failed..!!');
        }

        echo json_encode($this->ajax_return); exit();

    }

}
