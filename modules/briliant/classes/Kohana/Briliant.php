<?php defined('SYSPATH') OR die('No direct script access.');

class Kohana_Briliant {
	

	private static $day_indonesia = array(
			'Minggu',
			'Senin',
			'Selasa',
			'Rabu',
			'Kamis',
			'Jum\'at',
			'Sabtu'
		);

	private static  $month_indonesia = array(
			1	=> 'Januari',
			2	=> 'Februari',
			3	=> 'Maret',
			4	=> 'April',
			5	=> 'Mei',
			6	=> 'Juni',
			7	=> 'Juli',
			8	=> 'Agustus',
			9	=> 'September',
			10	=> 'Oktober',
			11	=> 'November',
			12	=> 'Desember'
		);

	public static function admin_template($template = '', $data = array()) {
		
		// Load session
		$session = Session::instance();
		
		$user_detail = array();
		$user_detail['userRealName'] = $session->get('adminName');
		$user_detail['userEmail'] = $session->get('adminEmail');
		
		// Content template
		if(!empty($template)) {
			$content =	View::factory($template)
						->bind('data', $data);
		}

		// Admin template
		$view = View::factory('briliant/' . Kohana::$config->load('path.main_template') . '/template')
				->bind('main_title', $data['main_title'])
				->bind('menu_active', $data['menu_active'])
				->bind('menu_active_child', $data['menu_active_child'])
				->bind('menu_active_child_1', $data['menu_active_child_1'])
				->bind('content', $content)
				->bind('user_detail', $user_detail)
				->bind('custom_header', $data['custom_header'])
				->bind('custom_footer', $data['custom_footer']);

		return $view;

	}
	
	public static function admin_template_plugin($template = '', $data = array()) {
		
		// Load session
		$session = Session::instance();
		
		$user_detail = array();
		$user_detail['userRealName'] = $session->get('adminName');
		$user_detail['userEmail'] = $session->get('adminEmail');
		
		// Content template
		if(!empty($template)) {
			$content =	View::factory($template)
						->bind('data', $data);
		}
		
		// Admin template
		$view = View::factory('briliant/' . Kohana::$config->load('path.main_template') . '/plugin')
				->bind('menu_active', $data['menu_active'])
				->bind('menu_active_child', $data['menu_active_child'])
				->bind('main_title', $data['main_title'])
				->bind('user_detail', $user_detail)
				->bind('custom_header', $data['custom_header'])
				->bind('custom_footer', $data['custom_footer'])
				->bind('content', $content);

		return $view;

	}
	
	public static function admin_template_limit($template = '', $data = array()) {

		// Content template
		if(!empty($template)) {
			$content =	View::factory($template)
						->bind('data', $data);
		}

		// Admin template
		$view = View::factory('briliant/' . Kohana::$config->load('path.main_template') . '/template_limit')
				->bind('main_title', $data['main_title'])
				->bind('menu_active', $data['menu_active'])
				->bind('menu_active_child', $data['menu_active_child'])
				->bind('menu_active_child_1', $data['menu_active_child_1'])
				->bind('content', $content)
				->bind('custom_header', $data['custom_header'])
				->bind('custom_footer', $data['custom_footer']);

		return $view;

	}

	public static function indonesia_full_date($date = '') {

		$return = '';
		if(!empty($date)) {
			$epoh = strtotime($date);
			$return = self::$day_indonesia[date('w', $epoh)] . ' ' . date('d', $epoh) . '/' . self::$month_indonesia[date('n', $epoh)] . '/' . date('Y', $epoh) . ' ' . date('H:i:s', $epoh) . ' WIB';
		}
		return $return;

	}

	public static function date_is_yyyy_mm_dd ($date = '') {

		$return = false;

		if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
			$return = true;
		}

		return $return;

	}

	public static function date_is_yyyy_mm_dd_hh_mm_ss($date = '') {

		$return = false;

		if (preg_match("/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/", $date)) {

			$return = true;

		}

		return $return;

	}

	public static function check_permission($table_select = '', $colum_param = '', $id_param = '', $user_id = '', $colum_session_user = '') {

		$exec = DB::select()
				->from($table_select)
				->where($colum_param, '=', $id_param)
				->execute()
				->as_array();

		if($exec[0][$colum_session_user] != $user_id) {

			header('Location: /view/noaccess'); exit();

		}

	}

        public static function check_controller_access($controller = '', $user_id = '') {

            $return = false;

            $query = DB::select(array('usacAllow', 'allow'))
                    ->from('user_access')
                    ->join('user', 'LEFT')
                    ->on('usacUserId', '=', 'user.userId')
                    ->join('master_module', 'LEFT')
                    ->on('msmdId', '=', 'usacMsmdId')
                    ->where('userId', '=', $user_id)
                    ->where('msmdModuleController', '=', $controller)
                    ->execute()
                    ->as_array();

            if(!empty($query[0]['allow']) AND $query[0]['allow'] == 1) {

                $return = true;

            }

            return $return;

        }

}
