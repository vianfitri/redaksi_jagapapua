<?php defined('SYSPATH') or die('No direct script access.');

class Model_Tagspin extends Model {

    // If debug user status = 1
    private $status = 2;
    public function count_tags($id) {

        $return = 0;
		      if(empty($id)) $id=NULL;
        $query =	DB::select(array(DB::expr('COUNT(1)'), 'COUNT'))
                                ->from('tagspin')
								->where('tagsMaster', '=', $id)
								->execute()->as_array();

        if(!empty($query[0]['COUNT'])) {
                $return = $query[0]['COUNT'];
        }

        return $return;

    }

    public function list_tags($id, $limit = 20, $offset = 0) {
		if(empty($id)) $id=NULL;
        $query =	DB::select('arimId','arimTitle','arimCaption','arimFileType','tagsUrl', 'tagsId', 'tagsTitle')
                ->from('tagspin')
                ->where('tagsMaster', '=', $id)
                ->join('arsip_images', 'LEFT')
                ->on('arsip_images.arimId', '=', 'tagspin.tagsImg')
                ->limit($limit)
                ->offset($offset)
								->execute()
								->as_array();

        return $query;
    }

    public function save_data($data = '', $user_id = '') {

        $return = FALSE;
        list($file, $type) = explode('.',basename($data['tagsImg']));
        $save = DB::insert('tagspin', array('tagsImg','tagsUrl','tagsUserIdSaved','tagsMaster','tagsTitle'))
                    ->values(array(
                        $file,
                        @$data['tagsUrl'],
						            $user_id,
						            $data['tagsMaster'],
						            @$data['tagsTitle']
                    ));
        list($lastid, $rows_inserted) = $save->execute();

        if(!empty($rows_inserted)) {
            $return = TRUE;
        }

        return $return;

    }

    public function save_url($data = '', $user_id = '') {
        $return = FALSE;
        $update = DB::update('tagspin')
    			->set(array('tagsUrl' => $data['tagsUrl']))
    			->set(array('tagsTitle' => $data['tagsTitle']))
          ->where('tagsId', '=', $data['tagsId'])->execute();

        return $return;
    }

    public function delete_data($id = '', $user_id = '') {
        $query = DB::delete('tagspin')
                ->where('tagsId', '=', $id)
				->execute();
		//echo Debug::vars((string) $query);
        return $query;
    }

}
