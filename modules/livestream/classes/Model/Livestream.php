<?php defined('SYSPATH') or die('No direct script access.');

class Model_Livestream extends Model {

	public function count_all() {

		$return = 0;

		$query =	DB::select(array(DB::expr('COUNT(1)'), 'COUNT'))
					->from('live_stream')
					->where('lvstActive','=',1)
					->execute()
					->as_array();

		if(!empty($query[0]['COUNT'])) {
			$return = $query[0]['COUNT'];
		}

		return $return;

	}

	public function list_data($limit = '', $offset = '') {

		$exec = DB::select(
					array('lvstId', 'id'),
					array('lvstArimId', 'image'),
					array('lvstEmbed', 'embed'),
					array('lvstSaved', 'saved'),
					array('lvstUserId', 'savedId'),
					array('arimFileType', 'image_type'),
					array('userFullName', 'name_saved')
				)
				->from('live_stream')
				->where('lvstActive','=',1)
				->order_by('lvstId', 'DESC')
				->join('user', 'LEFT')
				->on('live_stream.lvstUserId', '=', 'user.userId')
				->join('arsip_images', 'LEFT')
				->on('arsip_images.arimId', '=', 'live_stream.lvstArimId')
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

		$query =	DB::insert('live_stream', array(
						'lvstArimId',
				        'lvstEmbed',
						'lvstUserId'
					))
					->values(array(
						$id_image,
						 $data['embed'],
						$session->get('adminId')
					))
					->execute();
		return $query;
	}

	public function data_by_id($id = '') {

		$return  = array();

		$exec = DB::select(
					array('lvstId', 'id'),
					array('lvstArimId', 'image'),
					array('lvstEmbed', 'embed'),
					array('lvstSaved', 'saved'),
					array('lvstUserId', 'savedId'),
					array('arimFileType', 'image_type'),
					array('userFullName', 'name_saved')
				)
				->from('live_stream')
				->where('lvstActive','=',1)
				->where('lvstId','=',$id)
				->join('user', 'LEFT')
				->on('live_stream.lvstUserId', '=', 'user.userId')
				->join('arsip_images', 'LEFT')
				->on('arsip_images.arimId', '=', 'live_stream.lvstArimId')
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

		$query =	DB::update('live_stream')
						->set(array('lvstArimId' => $id_image))
						 ->set(array('lvstEmbed' => $data['embed']))
						->where('lvstId', '=', $id)
						->execute();

	}

	public function delete_data($id = '') {
		$query =	DB::update('live_stream')
					->set(array('lvstActive' => 0))
					->where('lvstId', '=', $id)
					->execute();
	}

	public function count_search_data($search = '') {

		$return = 0;

		$query =	DB::select(array(DB::expr('COUNT(1)'), 'COUNT'))
					->from('live_stream')
					->where('live_stream.lvstEmbed', 'LIKE', '%' . $search . '%')
					->execute()
					->as_array();

		if(!empty($query[0]['COUNT'])) {
			$return = $query[0]['COUNT'];
		}

		return $return;

	}

	public function search_data($search = '', $limit = '', $offset = '') {

		$exec = DB::select(
					array('lvstId', 'id'),
					array('lvstArimId', 'image'),
					array('lvstEmbed', 'embed'),
					array('lvstSaved', 'saved'),
					array('lvstUserId', 'savedId'),
					array('arimFileType', 'image_type'),
					array('userFullName', 'name_saved')
				)
				->from('live_stream')
				->where('lvstActive','=',1)
				->where('live_stream.lvstEmbed', 'LIKE', '%' . $search . '%')
				->order_by('lvstId', 'DESC')
				->join('user', 'LEFT')
				->on('live_stream.lvstUserId', '=', 'user.userId')
				->join('arsip_images', 'LEFT')
				->on('arsip_images.arimId', '=', 'live_stream.lvstArimId')
				->limit($limit)
				->offset($offset)
				->execute()
				->as_array();

		return $exec;

	}

}
