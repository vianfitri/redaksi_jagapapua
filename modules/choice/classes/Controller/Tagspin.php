<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Tagspin extends Controller_Backend {

    public function before() {
        parent::before();
    }

	public function action_sync() {
		$id = intval($this->request->param('id'));
		if(empty($id)) $id='';
		Engine_Tagspin::send_to_web($id);
		$this->redirect('/tagspin/index/'.$id);
		exit;
	}

    public function action_index() {
      $data['main_title'] = __('Newsroom | Data Master | Tags Pin');
  		$data['menu_active'] = 'data_master';
  		$data['menu_active_child'] = 'tagspin';

		    $session = Session::instance();

		$cat = intval($this->request->param('cat'));
		if(empty($cat)) {
			$cat=0;
		}

        // Load Model
        $tags_model = new Model_Tagspin();

        if(!empty($_POST)){
          $tags_model->save_url($_POST);
        }

        // Count List Choice
        $data['count_all'] = $count = $tags_model->count_tags($cat);

        // List Data
        $data['list'] = $tags_model->list_tags($cat);
		      $data['cat'] = $cat;

        // Footer javascript
        $data['custom_footer'] = '
            <script type="text/javascript">
                function image_popup() {
                    var tagsImg = $("#image_popup").val();
                    $.ajax({
                        method: "POST",
                        url: "/ajax/tagspin/save",
                        dataType: "json",
                        data: { "tagsImg": tagsImg, "tagsMaster":'.$cat.' },
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
                                window.location.href="/tagspin/delete/'.$cat.'/" + id;
                        }
                }
            </script>
            <input type="hidden" id="image_popup" />
        ';

        // Load View
        $view = DVH::admin_template('tagspin/' . Kohana::$config->load('path.main_template') . '/list', $data);
	       $this->response->body($view);

    }

    public function action_delete() {

        // ID From parameter
        $id = $this->request->param('id');
        $cat = $this->request->param('cat');
        // Session user
        $session = Session::instance();
        $user_id = $session->get('user_id');

        // Load Model
        $headline_model = new Model_Tagspin();

        // Delete Data
        $headline_model->delete_data($id, $user_id);
        Engine_Tagspin::send_to_delete($id);

        // Redirect
		      $this->redirect('/tagspin/index/'.$cat);
    }

}
