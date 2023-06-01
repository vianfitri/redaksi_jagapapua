<?php defined('SYSPATH') or die('No direct script access.');

class Model_Slider extends Model {

	public function count_all() {

		$return = 0;

		$query =	DB::select(array(DB::expr('COUNT(1)'), 'COUNT'))
					->from('slider')
					->where('sldrActive','=',1)
					->execute()
					->as_array();

		if(!empty($query[0]['COUNT'])) {
			$return = $query[0]['COUNT'];
		}

		return $return;

	}

	public function list_data($limit = '', $offset = '') {

		$exec = DB::select(
					array('sldrId', 'id'),
					array('sldrArimId', 'image'),
					array('sliderTitle', 'title'),
					array('sldrLinkApps', 'link_apps'),
					array('sldrLinkWeb', 'link_web'),
					array('sldrSaved', 'saved'),
					array('sldrUserId', 'savedId'),
					array('arimFileType', 'image_type'),
					array('userFullName', 'name_saved')
				)
				->from('slider')
				->where('sldrActive','=',1)
				->order_by('sldrId', 'DESC')
				->join('user', 'LEFT')
				->on('slider.sldrUserId', '=', 'user.userId')
				->join('arsip_images', 'LEFT')
				->on('arsip_images.arimId', '=', 'slider.sldrArimId')
				->limit($limit)
				->offset($offset)
				->execute()
				->as_array();

		return $exec;

	}

	public function save_data($data = array()) {

		$session = Session::instance();

		if(!empty($data['image'])) {

			// Get id image from full url image
			$base_image = basename($data['image']).PHP_EOL;
			if(!empty($base_image)) {
				$ex_base = explode('.', $base_image);
				list($id_image, $file_type) = $ex_base;
			}

		}

		$query =	DB::insert('slider', array(
						'sldrArimId',
						'sliderTitle',
						// 'sldrLinkApps',
						 'sldrLinkWeb',
						'sldrUserId'
					))
					->values(array(
						$id_image,
						$data['title_slider'],
						// $data['link_app'],
						 $data['link_web'],
						$session->get('adminId')
					))
					->execute();
		return $query;
	}

	public function data_by_id($id = '') {

		$return  = array();

		$exec = DB::select(
					array('sldrId', 'id'),
					array('sldrArimId', 'image'),
					array('sliderTitle', 'title'),
					array('sldrLinkApps', 'link_apps'),
					array('sldrLinkWeb', 'link_web'),
					array('sldrSaved', 'saved'),
					array('sldrUserId', 'savedId'),
					array('arimFileType', 'image_type'),
					array('userFullName', 'name_saved')
				)
				->from('slider')
				->where('sldrActive','=',1)
				->where('sldrId','=',$id)
				->join('user', 'LEFT')
				->on('slider.sldrUserId', '=', 'user.userId')
				->join('arsip_images', 'LEFT')
				->on('arsip_images.arimId', '=', 'slider.sldrArimId')
				->execute()
				->as_array();

		if(!empty($exec[0])) {
			$return = $exec[0];
		}

		return $return;

	}

	public function update_data($id = '', $data = '') {

		$session = Session::instance();

		if(!empty($data['image'])) {

			// Get id image from full url image
			$base_image = basename($data['image']).PHP_EOL;
			if(!empty($base_image)) {
				$ex_base = explode('.', $base_image);
				list($id_image, $file_type) = $ex_base;
			}

		}

		$query =	DB::update('slider')
						->set(array('sldrArimId' => $id_image))
						->set(array('sliderTitle' => $data['title_slider']))
						// ->set(array('sldrLinkApps' => $data['link_apps']))
						 ->set(array('sldrLinkWeb' => $data['link_web']))
						->where('sldrId', '=', $id)
						->execute();

	}

	public function delete_data($id = '') {
		$query =	DB::update('slider')
					->set(array('sldrActive' => 0))
					->where('sldrId', '=', $id)
					->execute();
	}

	public function count_search_data($search = '') {

		$return = 0;

		$query =	DB::select(array(DB::expr('COUNT(1)'), 'COUNT'))
					->from('slider')
					->where('slider.sldrLinkApps', 'LIKE', '%' . $search . '%')
					->execute()
					->as_array();

		if(!empty($query[0]['COUNT'])) {
			$return = $query[0]['COUNT'];
		}

		return $return;

	}

	public function search_data($search = '', $limit = '', $offset = '') {

		$exec = DB::select(
					array('sldrId', 'id'),
					array('sldrArimId', 'image'),
					array('sldrLinkApps', 'link_apps'),
					array('sldrLinkWeb', 'link_web'),
					array('sldrSaved', 'saved'),
					array('sldrUserId', 'savedId'),
					array('arimFileType', 'image_type'),
					array('userFullName', 'name_saved')
				)
				->from('slider')
				->where('sldrActive','=',1)
				->where('slider.sldrLinkApps', 'LIKE', '%' . $search . '%')
				->order_by('sldrId', 'DESC')
				->join('user', 'LEFT')
				->on('slider.sldrUserId', '=', 'user.userId')
				->join('arsip_images', 'LEFT')
				->on('arsip_images.arimId', '=', 'slider.sldrArimId')
				->limit($limit)
				->offset($offset)
				->execute()
				->as_array();

		return $exec;

	}

}
