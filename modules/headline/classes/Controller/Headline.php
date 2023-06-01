<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Headline extends Controller_Backend {
    
    public function before() {
        
        parent::before();
    
    }	
	
    
    public function action_index() {		
		$data['main_title'] = __('Headline');		
		$data['menu_active'] = 'headline';
		$data['menu_active_child'] = 'list';
		
		$session = Session::instance();
		
        $headline_model = new Model_Headline();
        
        // Count List Choice
        $data['count_all'] = $count = $headline_model->count_Headline();
        
        // List Data
        $data['list'] = $headline_model->list_headline(99999, 0);
        
        // Footer javascript
        $data['custom_footer'] = '
            <script type="text/javascript">
                function push_ajax() {
                    var hide_val = $("#dom_hidden").val();
                    $.ajax({
                        method: "POST",
                        url: "/ajax/headline/save",
                        dataType: "json",
                        data: { "post_val": hide_val },
                        beforeSend: function() { $("#overlay_custom").show() },
                        complete: function() { $("#overlay_custom").hide() },
                        success: function (res) {
                            if(res.error == 0) {
                                location.reload();
                            }
                        }
                    })
                }
                function del_confirm(id) {
                        var dialog = confirm("' . __('Are you sure for delete this data ?') . '");
                        if (dialog == true) {
                                window.location.href="/headline/delete/" + id; 
                        }
                }
            </script>
            <input type="hidden" id="dom_hidden" />
        ';
        
        // Load View 
        $view = Briliant::admin_template('headline/' . Kohana::$config->load('path.main_template') . '/list', $data);
	$this->response->body($view);
        
    }
    
    public function action_delete() {
        
        // ID From parameter
        $id = $this->request->param('id');
        
        // Session user
        $session = Session::instance();
        $user_id = $session->get('adminId');
        
        // Load Model
        $headline_model = new Model_Headline();
        
        // Delete Data
        $headline_model->delete_data($id, $user_id);
        
        // Redirect
		if(empty($cat)){
			$this->redirect('/headline');
		}else{
			$this->redirect('/headline/index/'.$cat);
		}
        
    }
    
}