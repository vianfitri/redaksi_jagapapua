<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax_Backend extends Controller {
        
        // List route url yang tidak di cek hak aksesnya
        private $white_list_route_url;
        
        protected $ajax_return;


        public function before() {
            
		parent::before();
                
                $this->ajax_return = array(
                    'error'         => 1,
                    'message'       => '',
                    'data'          => array()
                );
                
		// Check session login, apakah sudah login atau belum
		$session = Session::instance();
		$user_id = $session->get('adminId');
		
		if(empty($user_id)) { // Jika belum login maka redirect ke halaman login
			
			$this->ajax_return['error'] = 1;
			$this->ajax_return['message'] = __('You are not login..!!');
                        
                        echo json_encode($this->ajax_return); exit();
			
		}
//            else { // Jika sudah login maka cek apakah status user masih bisa untuk membuka newsroom (userActive = 1)
//			
//			$user_model = new Model_User();
//			if($user_model->user_active($user_id) !== true) {
//                            
//				// Delete session and redirect to login page
//				$session->delete('was_login');
//				$session->delete('user_id');
//				
//                                $this->ajax_return['error'] = 1;
//                                $this->ajax_return['message'] = __('User is not active..!!');
//
//                                echo json_encode($this->ajax_return); exit();
//                                
//			} else { 
//                                // Jika user masih aktif maka cek apakah user boleh mengkakses module
//                                // Controller harus ada di dalam folder ajax
//				$controller = strtolower($this->request->controller());
//                                if(!empty($controller)) {
//                                    $controller = str_replace('ajax_', '', $controller);
//                                }
//				$action = strtolower($this->request->action());
//                                $route = $controller . '/' . $action;
//                                
//                                // Check controller access
//                                $c_access = DVH::check_controller_access($controller, $user_id);
//                                if($c_access !== true) {
//
//                                    $this->ajax_return['error'] = 1;
//                                    $this->ajax_return['message'] = __('Forbidden access..!!');
//
//                                    echo json_encode($this->ajax_return); exit();
//
//                                }
//
//                                
//			}
			
//		}
		
	}

} // End Welcome