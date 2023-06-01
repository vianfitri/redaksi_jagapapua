<?php defined('SYSPATH') or die('No direct script access.');

class Model_Foto extends Model {
	
	public function count_all() {
		
		$return = 0;
		
		$query =	DB::select(array(DB::expr('COUNT(1)'), 'COUNT'))
					->from('foto')
					->where('fotoStatus','=',1)
					->execute()
					->as_array();
		
		if(!empty($query[0]['COUNT'])) {
			$return = $query[0]['COUNT'];
		}
		
		return $return;
		
	}
	
	public function count_all_category() {
		
		$return = 0;
		
		$query =	DB::select(array(DB::expr('COUNT(1)'), 'COUNT'))
					->from('foto')
					->where('fotoStatus','=',1)
					->execute()
					->as_array();
		
		if(!empty($query[0]['COUNT'])) {
			$return = $query[0]['COUNT'];
		}
		
		return $return;
		
	}
	
	public function list_data($limit = '', $offset = '') {
		
		$exec = DB::select(
					array('fotoId', 'id'),
					array('fotoTitle', 'title'),
					array('fotoUserId', 'savedId'),
					array('userFullName', 'name_saved')
				)
				->from('foto')
				->where('fotoStatus','=',1)
				->order_by('fotoId', 'DESC')
				->join('user', 'LEFT')
				->on('foto.fotoUserId', '=', 'user.userId')
				//->join('foto_image', 'LEFT')
				//->on('fotoId', '=', 'foto_image.ecimfotoId')
				->limit($limit)
				->offset($offset)
				->execute()
				->as_array();
				
				if(!empty($exec)) {

					foreach($exec as $k_exec => $v_exec) {
						
						if(!empty($v_exec['id'])) {

							// Get images
							$exec[$k_exec]['images'] = 	DB::select(
															array('arimId', 'image_id'),
															array('arimFileType', 'image_type')
														)
														->from('foto_image')
														->join('arsip_images', 'LEFT')
														->on('arsip_images.arimId', '=', 'foto_image.ftimArimId')
														->where('ftimfotoId', '=', $v_exec['id'])
														->execute()
														->as_array();

						}

					}

				}
		
		return $exec;
		
	}
	
	public function list_data_category($limit = '', $offset = '') {
		
		$exec = DB::select(
					array('eccaId', 'id'),
					array('eccaName', 'name')
				)
				->from('foto_category')
				->where('eccaStatus','=',1)
				->order_by('eccaName', 'ASC')
				->limit($limit)
				->offset($offset)
				->execute()
				->as_array();
				
		return $exec;
		
	}
	
	public function save_data($data = array()) {
		
		// Start Transaction
		Database::instance()->begin();
		
		$session = Session::instance();
		$user_id = $session->get('adminId');
		// $data['price'] = str_replace(".","",$data['price']);

		// Save to table
		$save =	DB::insert('foto', array(
						'fotoUserId',
						'fotoTitle',
						'fotoDetail',
						
					))
					->values(array(
						$user_id,
						$data['title'],
						''
						//$data['province'],
						//$data['regency']
					));
		list($lastid, $rows_inserted) = $save->execute();

		if(!empty($lastid)) {

			// Save images
			/*if(!empty($data['image'])) {

				// Get id image from full url image
				$base_image = basename($data['image']).PHP_EOL;
				if(!empty($base_image)) {
					$ex_base = explode('.', $base_image);
					list($id_image, $file_type) = $ex_base;
				}

				if(!empty($id_image)) {
					$image = 	DB::insert('foto_image', array(
									'ecimfotoId',
									'ecimArimId'
								))
								->values(array(
									$lastid,
									$id_image
								))
								->execute();
				}
			} */

			if (!empty($data['image'])) {
                foreach ($data['image'] as $k => $v) {
                    if (!empty($v)) {
                        // Get id image from full url image
                        $base_image = basename($v) . PHP_EOL;
                        if (!empty($base_image)) {
                            $ex_base = explode('.', $base_image);
                            list($id_image, $file_type) = $ex_base;
                        }
                    } else {
                    }


                    if (!empty($v)) {
                        if (!empty($id_image)) {
                            $image = DB::insert('foto_image', array(
                                'ftimfotoId',
								'ftimArimId'
                            ))->values(array(
                                $lastid,
								$id_image
                            ))->execute();
                        }
                    }
                }

                // Engine_Activity::send_to_web($id_article);
                // Kohana_Engine_Activity::send_to_fb("http://www.example.com");
            }
		}

		// Commit transaction
		Database::instance()->commit();
	}
	
	public function save_data_category($data = array()) {
		
		// Save to table
		$save =	DB::insert('foto_category', array(
						'eccaName',
						'eccaIcon'
					))
					->values(array(
						$data['name'],
						$data['icon']
					))
					->execute();
	}
	
	public function data_by_id($id = '') {
		
		$return = array();
		
		$exec = DB::select(
					array('fotoId', 'id'),
					array('fotoTitle', 'title'),
					array('fotoDetail', 'detail'),
					array('fotoUserId', 'savedId'),
					array('fotoEccaId', 'category'),
					array('userFullName', 'name_saved')
				)
				->from('foto')
				->where('fotoStatus','=',1)
				->where('fotoId','=',$id)
				->order_by('fotoId', 'DESC')
				->join('user', 'LEFT')
				->on('foto.fotoUserId', '=', 'user.userId')
				->join('foto_image', 'LEFT')
				->on('fotoId', '=', 'foto_image.ftimfotoId')
				->execute()
				->as_array();
				
				if(!empty($exec)) {

					foreach($exec as $k_exec => $v_exec) {
						
						if(!empty($v_exec['id'])) {

							// Get images
							$exec[$k_exec]['images'] = 	DB::select(
															array('arimId', 'image_id'),
															array('arimFileType', 'image_type')
														)
														->from('foto_image')
														->join('arsip_images', 'LEFT')
														->on('arsip_images.arimId', '=', 'foto_image.ftimArimId')
														->where('ftimfotoId', '=', $v_exec['id'])
														->execute()
														->as_array();

						}

					}

				}
		
		if(!empty($exec[0])) {
			$return = $exec[0];
		}
		
		return $return;
		
	}
	
	public function data_by_id_category($id = '') {
		
		$return = array();
		
		$exec = DB::select(
					array('eccaId', 'id'),
					array('eccaName', 'name')
				)
				->from('foto_category')
				->where('eccaStatus','=',1)
				->where('eccaId','=',$id)
				->execute()
				->as_array();
				
		if(!empty($exec[0])) {
			$return = $exec[0];
		}
		
		return $return;
		
	}
	
	public function update_data($id = '', $data = '') {
		
		$session = Session::instance();
		
		// Id article
		$id = $data['id'];

		// Start Transaction
		Database::instance()->begin();

		// Check old image
		if($data['image'] != @$data['image_old']) {

			// Delete Data Old
			DB::delete('foto_image')
				->where('ftimfotoId', '=', $id)
				->execute();

			// Check new image
			/*if(!empty($data['image'])) {

				// Get id image from full url image
				$base_image = basename($data['image']).PHP_EOL;
				if(!empty($base_image)) {
					$ex_base = explode('.', $base_image);
					list($id_image, $file_type) = $ex_base;
				}

				if(!empty($id_image)) {
					$image = 	DB::insert('foto_image', array(
									'ecimfotoId',
									'ecimArimId'
								))
								->values(array(
									$id,
									$id_image
								))
								->execute();
				}

			}*/

			if (!empty($data['image'])) {
                foreach ($data['image'] as $k => $v) {
                    if (!empty($v)) {
                        $base_image = basename($v) . PHP_EOL;
                        if (!empty($base_image)) {
                            $ex_base = explode('.', $base_image);
                            list($id_image, $file_type) = $ex_base;
                        }
                    }

                    if (!empty($v)) {

                        if (!empty($id_image)) {
                            $image = DB::insert('foto_image', array(
                                'ftimfotoId',
								'ftimArimId'
                            ))->values(array(
                                $id,
								$id_image
                            ))->execute();
                        }

                    }
                }
			}
		}
		
		$query =	DB::update('foto')
						//->set(array('fotoEccaId' => $data['category']))
						->set(array('fotoTitle' => $data['title']))
						//->set(array('fotoDetail' => $data['detail']))
						->where('fotoId', '=', $id)
						->execute();
		
	}
	
	public function update_data_category($id = '', $data = '') {
		
		$query =	DB::update('foto_category')
						->set(array(
							'eccaName' => $data['name'],
							'eccaIcon' => $data['icon'])
							)
						->where('eccaId', '=', $id)
						->execute();
		
	}
	
	public function delete_data($id = '') {
		$query =	DB::update('foto')
					->set(array('fotoStatus' => 0))
					->where('fotoId', '=', $id)
					->execute();
	}
	
	public function delete_data_category($id = '') {
		$query =	DB::update('foto_category')
					->set(array('eccaStatus' => 0))
					->where('eccaId', '=', $id)
					->execute();
	}
	
	public function count_search_data($search = '') {
		
		$return = 0;
		
		$query =	DB::select(array(DB::expr('COUNT(1)'), 'COUNT'))
					->from('foto')
					->where('fotoStatus','=',1)
					->where('fotoTitle', 'LIKE', '%' . $search . '%')
					->execute()
					->as_array();
		
		if(!empty($query[0]['COUNT'])) {
			$return = $query[0]['COUNT'];
		}
		
		return $return;
		
	}
	
	public function count_search_data_category($search = '') {
		
		$return = 0;
		
		$query =	DB::select(array(DB::expr('COUNT(1)'), 'COUNT'))
					->from('foto_category')
					->where('eccaName', 'LIKE', '%' . $search . '%')
					->execute()
					->as_array();
		
		if(!empty($query[0]['COUNT'])) {
			$return = $query[0]['COUNT'];
		}
		
		return $return;
		
	}
	
	public function search_data($search = '', $limit = '', $offset = '') {
		
		$exec = DB::select(
					array('fotoId', 'id'),
					array('fotoTitle', 'title'),
					array('userFullName', 'name_saved')
				)
				->from('foto')
				->where('fotoStatus','=',1)
				->where('fotoTitle', 'LIKE', '%' . $search . '%')
				->order_by('fotoId', 'DESC')
				->join('user', 'LEFT')
				->on('foto.fotoUserId', '=', 'user.userId')
				->join('foto_image', 'LEFT')
				->on('fotoId', '=', 'foto_image.ftimfotoId')
				->limit($limit)
				->offset($offset)
				->execute()
				->as_array();
				
				if(!empty($exec)) {

					foreach($exec as $k_exec => $v_exec) {
						
						if(!empty($v_exec['id'])) {

							// Get images
							$exec[$k_exec]['images'] = 	DB::select(
															array('arimId', 'image_id'),
															array('arimFileType', 'image_type')
														)
														->from('foto_image')
														->join('arsip_images', 'LEFT')
														->on('arsip_images.arimId', '=', 'foto_image.ftimArimId')
														->where('ftimfotoId', '=', $v_exec['id'])
														->execute()
														->as_array();

						}

					}

				}
		
		return $exec;
		
	}
	
	public function search_data_category($search = '', $limit = '', $offset = '') {
		
		$exec = DB::select(
					array('eccaId', 'id'),
					array('eccaName', 'name')
				)
				->from('foto_category')
				->where('eccaStatus','=',1)
				->where('eccaName', 'LIKE', '%' . $search . '%')
				->order_by('eccaName', 'ASC')
				->limit($limit)
				->offset($offset)
				->execute()
				->as_array();
		
		return $exec;
		
	}
	
}