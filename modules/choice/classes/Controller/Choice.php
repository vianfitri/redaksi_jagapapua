<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Choice extends Controller_Backend {

    public function before() {

        parent::before();

    }

	public function action_sync() {
		Engine_Choice::send_to_web();
		header("location: /choice");
		exit;
	}

    

    public function action_popup() {

        // Load MOdel Choice
        $choice_model = new Model_Choice();

        // Count approved news
        $data['count_approved'] = $count_approved = $choice_model->count_approved();

        // Page
        $page = intval($this->request->param('page'));
        if(empty($page)) {
                $page = 1;
        }

        // Pagination
        $pagination = 	Pagination::factory(array(
                                                'total_items'    		=> $count_approved,
                                                'items_per_page'		=> 20,
                                                'current_page'			=> $page,
                                                'base_url'				=> '/choice/popup/',
                                                'view'					=> 'pagination/admin'
                                        ));

        // List approved news
        $data['list_approved'] = $list_approved = $choice_model->list_approved($pagination->items_per_page, $pagination->offset);

        // Render Pagination
        $data['pagination'] = $pagination->render();

        // Load View
        $view = Briliant::admin_template_plugin('choice/' . Kohana::$config->load('path.main_template') . '/popup', $data);
	$this->response->body($view);

    }

    public function action_popupsearch() {

        $search = base64_encode($this->request->post('search'));
        if(!empty($search)) {
            $this->redirect('/choice/popup/search/' . $search); exit();
        }

        $search = base64_decode($this->request->param('search'));

        // Load MOdel Choice
        $choice_model = new Model_Choice();

        // Count approved news
        $data['count_approved'] = $count_approved = $choice_model->count_approved($search);

        // Page
        $page = intval($this->request->param('page'));
        if(empty($page)) {
                $page = 1;
        }

        // Pagination
        $pagination = 	Pagination::factory(array(
                                                'total_items'    		=> $count_approved,
                                                'items_per_page'		=> 20,
                                                'current_page'			=> $page,
                                                'base_url'				=> '/choice/popup/search/' . $search . '/',
                                                'view'					=> 'pagination/admin'
                                        ));

        // List approved news
        $data['list_approved'] = $list_approved = $choice_model->list_approved($pagination->items_per_page, $pagination->offset, $search);

        // Render Pagination
        $data['pagination'] = $pagination->render();

        $data['search'] = $search;

        // Load View
        $view = Briliant::admin_template_plugin('choice/' . Kohana::$config->load('path.main_template') . '/popup', $data);
	$this->response->body($view);

    }

	public function action_popupchange() {

		$data['id'] = $id = $this->request->param('id');

        // Load MOdel Choice
        $choice_model = new Model_Choice();

        // Count approved news
        $data['count_approved'] = $count_approved = $choice_model->count_approved();

        // Page
        $page = intval($this->request->param('page'));
        if(empty($page)) {
                $page = 1;
        }

        // Pagination
        $pagination = 	Pagination::factory(array(
                                                'total_items'    		=> $count_approved,
                                                'items_per_page'		=> 20,
                                                'current_page'			=> $page,
                                                'base_url'				=> '/choice/popupchange/' . $id . '/',
                                                'view'					=> 'pagination/admin'
                                        ));

        // List approved news
        $data['list_approved'] = $list_approved = $choice_model->list_approved($pagination->items_per_page, $pagination->offset);

        // Render Pagination
        $data['pagination'] = $pagination->render();

        // Load View
        $view = Briliant::admin_template_plugin('choice/' . Kohana::$config->load('path.main_template') . '/popupchange', $data);
		$this->response->body($view);

    }

	public function action_popupchangesearch() {

		$data['id'] = $id = $this->request->param('id');

        $search = base64_encode($this->request->post('search'));
        if(!empty($search)) {
            $this->redirect('/choice/popupchange/search/' . $id . "/" . $search); exit();
        }

        $search = base64_decode($this->request->param('search'));

        // Load MOdel Choice
        $choice_model = new Model_Choice();

        // Count approved news
        $data['count_approved'] = $count_approved = $choice_model->count_approved($search);

        // Page
        $page = intval($this->request->param('page'));
        if(empty($page)) {
                $page = 1;
        }

        // Pagination
        $pagination = 	Pagination::factory(array(
                                                'total_items'    		=> $count_approved,
                                                'items_per_page'		=> 20,
                                                'current_page'			=> $page,
                                                'base_url'				=> '/choice/popupchange/search/' . $id . "/" . $search . '/',
                                                'view'					=> 'pagination/admin'
                                        ));

        // List approved news
        $data['list_approved'] = $list_approved = $choice_model->list_approved($pagination->items_per_page, $pagination->offset, $search);

        // Render Pagination
        $data['pagination'] = $pagination->render();

        $data['search'] = $search;

        // Load View
        $view = Briliant::admin_template_plugin('choice/' . Kohana::$config->load('path.main_template') . '/popupchange', $data);
	$this->response->body($view);

    }

    public function action_delete() {

        // ID From parameter
        $id = $this->request->param('id');

        // Session user
        $session = Session::instance();
        $user_id = $session->get('user_id');

        // Load Model
        $choice_model = new Model_Choice();

        // Delete Data
        $choice_model->delete_data($id, $user_id);

        // Redirect
        $this->redirect('/choice');

    }

	public function action_schedule() {
		// Custom header for daterangepicker
		$data['custom_header'] = '<link rel="stylesheet" href="/assets/plugins/daterangepicker/daterangepicker-bs3.css">';
		$data['custom_footer'] = '
			<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
			<script src="/assets/plugins/daterangepicker/daterangepicker.js"></script>
			<script>
				//Date range picker
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
			</script>
			<script type=\'text/javascript\'>
				// With Scheduling Button Clicked
				$(\'#wsch\').click(function() {
					var pub = $(\'#publish_time\').val()
					if(pub == \'\') {
						alert(\'Jika Memilih Dengan Jadwal Maka Form Penjadwalan Harus Diisi\');
					} else {
						var valOpener = window.opener.document.getElementById(\'dom_hidden\').value;
						window.opener.document.getElementById(\'dom_hidden\').value = valOpener + \'|\' + pub;
						window.opener.doPaste();
						window.close();
					}
				})
				// No Scheduling Button Clicked
				$(\'#nsch\').click(function() {
					var valOpener = window.opener.document.getElementById(\'dom_hidden\').value;
					window.opener.document.getElementById(\'dom_hidden\').value = valOpener;
					window.opener.doPaste();
					window.close();
				})
			</script>
		';
		// Load View
        $view = Briliant::admin_template_plugin('choice/' . Kohana::$config->load('path.main_template') . '/schedule_popup', $data);
		$this->response->body($view);
	}










































    public function action_popuppickup() {

        // Load MOdel Choice
        $choice_model = new Model_Choice();

        // Count approved news
        $data['count_approved'] = $count_approved = $choice_model->count_approved();

        // Page
        $page = intval($this->request->param('page'));
        if(empty($page)) {
                $page = 1;
        }

        // Pagination
        $pagination = 	Pagination::factory(array(
                                                'total_items'    		=> $count_approved,
                                                'items_per_page'		=> 20,
                                                'current_page'			=> $page,
                                                'base_url'				=> '/choice/popuppickup/',
                                                'view'					=> 'pagination/admin'
                                        ));

        // List approved news
        $data['list_approved'] = $list_approved = $choice_model->list_approved($pagination->items_per_page, $pagination->offset);

        // Render Pagination
        $data['pagination'] = $pagination->render();

        // Load View
        $view = Briliant::admin_template_plugin('choice/' . Kohana::$config->load('path.main_template') . '/popuppickup', $data);
	$this->response->body($view);

    }

    public function action_popuppickupsearch() {
        $search = $this->request->post('search');
        if(!empty($search)) {
            $this->redirect('/choice/popuppickup/search/' . $search); exit();
        }

        $search = $this->request->param('search');

        // Load MOdel Choice
        $choice_model = new Model_Choice();

        // Count approved news
        $data['count_approved'] = $count_approved = $choice_model->count_approved($search);

        // Page
        $page = intval($this->request->param('page'));
        if(empty($page)) {
                $page = 1;
        }

        // Pagination
        $pagination = 	Pagination::factory(array(
                                                'total_items'    		=> $count_approved,
                                                'items_per_page'		=> 20,
                                                'current_page'			=> $page,
                                                'base_url'				=> '/choice/popuppickup/search/' . $search . '/',
                                                'view'					=> 'pagination/admin'
                                        ));

        // List approved news
        $data['list_approved'] = $list_approved = $choice_model->list_approved($pagination->items_per_page, $pagination->offset, $search);

        // Render Pagination
        $data['pagination'] = $pagination->render();

        $data['search'] = $search;

        // Load View
        $view = Briliant::admin_template_plugin('choice/' . Kohana::$config->load('path.main_template') . '/popuppickup', $data);
	$this->response->body($view);

    }

	public function action_popuppickupchange() {

		$data['id'] = $id = $this->request->param('id');

        // Load MOdel Choice
        $choice_model = new Model_Choice();

        // Count approved news
        $data['count_approved'] = $count_approved = $choice_model->count_approved();

        // Page
        $page = intval($this->request->param('page'));
        if(empty($page)) {
                $page = 1;
        }

        // Pagination
        $pagination = 	Pagination::factory(array(
                                                'total_items'    		=> $count_approved,
                                                'items_per_page'		=> 20,
                                                'current_page'			=> $page,
                                                'base_url'				=> '/choice/popuppickupchange/' . $id . '/',
                                                'view'					=> 'pagination/admin'
                                        ));

        // List approved news
        $data['list_approved'] = $list_approved = $choice_model->list_approved($pagination->items_per_page, $pagination->offset);

        // Render Pagination
        $data['pagination'] = $pagination->render();

        // Load View
        $view = Briliant::admin_template_plugin('choice/' . Kohana::$config->load('path.main_template') . '/popuppickupchange', $data);
		$this->response->body($view);

    }

	public function action_popuppickupchangesearch() {

		$data['id'] = $id = $this->request->param('id');

        $search = base64_encode($this->request->post('search'));
        if(!empty($search)) {
            $this->redirect('/choice/popuppickupchange/search/' . $id . "/" . $search); exit();
        }

        $search = base64_decode($this->request->param('search'));

        // Load MOdel Choice
        $choice_model = new Model_Choice();

        // Count approved news
        $data['count_approved'] = $count_approved = $choice_model->count_approved($search);

        // Page
        $page = intval($this->request->param('page'));
        if(empty($page)) {
                $page = 1;
        }

        // Pagination
        $pagination = 	Pagination::factory(array(
                                                'total_items'    		=> $count_approved,
                                                'items_per_page'		=> 20,
                                                'current_page'			=> $page,
                                                'base_url'				=> '/choice/popuppickupchange/search/' . $id . "/" . $search . '/',
                                                'view'					=> 'pagination/admin'
                                        ));

        // List approved news
        $data['list_approved'] = $list_approved = $choice_model->list_approved($pagination->items_per_page, $pagination->offset, $search);

        // Render Pagination
        $data['pagination'] = $pagination->render();

        $data['search'] = $search;

        // Load View
        $view = Briliant::admin_template_plugin('choice/' . Kohana::$config->load('path.main_template') . '/popuppickupchange', $data);
	$this->response->body($view);

    }

}
