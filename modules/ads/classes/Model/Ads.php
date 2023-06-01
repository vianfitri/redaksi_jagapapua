<?php defined('SYSPATH') or die('No direct script access.');

class Model_Ads extends Model {
	
	public function count_all() {
		
		$return = 0;
		
		$query =	DB::select(array(DB::expr('COUNT(1)'), 'COUNT'))
					->from('ads')
					->where('adsStatus','=',1)
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
					->from('ads')
					->where('adsStatus','=',1)
					->execute()
					->as_array();
		
		if(!empty($query[0]['COUNT'])) {
			$return = $query[0]['COUNT'];
		}
		
		return $return;
		
	}
	
	public function list_data($limit = '', $offset = '') {
		
		$exec = DB::select(
					array('adsId', 'id'),
					array('adsTitle', 'title'),
					array('adsUserId', 'savedId'),
					array('userFullName', 'name_saved')
				)
				->from('ads')
				->where('adsStatus','=',1)
				->order_by('adsId', 'DESC')
				->join('user', 'LEFT')
				->on('ads.adsUserId', '=', 'user.userId')
				//->join('ads_image', 'LEFT')
				//->on('adsId', '=', 'ads_image.ecimadsId')
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
														->from('ads_image')
														->join('arsip_images', 'LEFT')
														->on('arsip_images.arimId', '=', 'ads_image.ftimArimId2')
														->where('ftimadsId2', '=', $v_exec['id'])
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
				->from('ads_category')
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
		$save =	DB::insert('ads', array(
						'adsUserId',
						'adsTitle',
						'adsDetail',
						
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
					$image = 	DB::insert('ads_image', array(
									'ecimadsId',
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
                            $image = DB::insert('ads_image', array(
                                'ftimadsId2',
								'ftimArimId2'
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
		$save =	DB::insert('ads_category', array(
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
					array('adsId', 'id'),
					array('adsTitle', 'title'),
					array('adsDetail', 'detail'),
					array('adsUserId', 'savedId'),
					array('adsEccaId', 'category'),
					array('userFullName', 'name_saved')
				)
				->from('ads')
				->where('adsStatus','=',1)
				->where('adsId','=',$id)
				->order_by('adsId', 'DESC')
				->join('user', 'LEFT')
				->on('ads.adsUserId', '=', 'user.userId')
				->join('ads_image', 'LEFT')
				->on('adsId', '=', 'ads_image.ftimadsId2')
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
														->from('ads_image')
														->join('arsip_images', 'LEFT')
														->on('arsip_images.arimId', '=', 'ads_image.ftimArimId2')
														->where('ftimadsId2', '=', $v_exec['id'])
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
				->from('ads_category')
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
			DB::delete('ads_image')
				->where('ftimadsId2', '=', $id)
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
					$image = 	DB::insert('ads_image', array(
									'ecimadsId',
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
                            $image = DB::insert('ads_image', array(
                                'ftimadsId2',
								'ftimArimId2'
                            ))->values(array(
                                $id,
								$id_image
                            ))->execute();
                        }

                    }
                }
			}
		}
		
		$query =	DB::update('ads')
						//->set(array('adsEccaId' => $data['category']))
						->set(array('adsTitle' => $data['title']))
						//->set(array('adsDetail' => $data['detail']))
						->where('adsId', '=', $id)
						->execute();
		
	}
	
	public function update_data_category($id = '', $data = '') {
		
		$query =	DB::update('ads_category')
						->set(array(
							'eccaName' => $data['name'],
							'eccaIcon' => $data['icon'])
							)
						->where('eccaId', '=', $id)
						->execute();
		
	}
	
	public function delete_data($id = '') {
		$query =	DB::update('ads')
					->set(array('adsStatus' => 0))
					->where('adsId', '=', $id)
					->execute();
	}
	
	public function delete_data_category($id = '') {
		$query =	DB::update('ads_category')
					->set(array('eccaStatus' => 0))
					->where('eccaId', '=', $id)
					->execute();
	}
	
	public function count_search_data($search = '') {
		
		$return = 0;
		
		$query =	DB::select(array(DB::expr('COUNT(1)'), 'COUNT'))
					->from('ads')
					->where('adsStatus','=',1)
					->where('adsTitle', 'LIKE', '%' . $search . '%')
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
					->from('ads_category')
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
					array('adsId', 'id'),
					array('adsTitle', 'title'),
					array('userFullName', 'name_saved')
				)
				->from('ads')
				->where('adsStatus','=',1)
				->where('adsTitle', 'LIKE', '%' . $search . '%')
				->order_by('adsId', 'DESC')
				->join('user', 'LEFT')
				->on('ads.adsUserId', '=', 'user.userId')
				->join('ads_image', 'LEFT')
				->on('adsId', '=', 'ads_image.ftimadsId2')
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
														->from('ads_image')
														->join('arsip_images', 'LEFT')
														->on('arsip_images.arimId', '=', 'ads_image.ftimArimId2')
														->where('ftimadsId2', '=', $v_exec['id'])
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
				->from('ads_category')
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