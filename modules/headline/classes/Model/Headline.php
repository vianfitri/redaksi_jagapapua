<?php defined('SYSPATH') or die('No direct script access.');

class Model_Headline extends Model {
    
    public function count_headline() {
        
        $return = 0;
        $query =	DB::select(array(DB::expr('COUNT(1)'), 'COUNT'))
                                ->from('headline')
                                ->where('headStatus', '=', '1')
								->execute()->as_array();

        if(!empty($query[0]['COUNT'])) {
                $return = $query[0]['COUNT'];
        }

        return $return;
        
    }
    
    public function list_headline($limit = 20, $offset = 0) {
        $query =	DB::select()
                                ->from('headline')
                                ->where('headStatus', '=', '1')
								->order_by('headId', 'DESC')
                                ->limit($limit)
                                ->offset($offset)
								->execute()
								->as_array();
		
        return $query;
    }
    
    public function save_data($data = '', $user_id = '') {
        
        $return = FALSE;
        
        //list($type, $id) = explode('|', $data['post_val']);
        $ex = explode('|', $data['post_val']);
		$type = '';
		if(!empty($ex[0])) {
			$type = $ex[0];
		}
		$id = '';
		if(!empty($ex[1])) {
			$id = $ex[1];
		}
		$pub = date('1970-01-01 00:00:00');
		if(!empty($ex[2])) {
			$publish_time = DateTime::createFromFormat('d/m/Y H:i:s', $ex[2]);
			$pub = $publish_time->format('Y-m-d H:i:s');
		}
		
        $table = array(
            'headAdmiId',
        );
        
        if($type == 'news') {
            array_unshift($table, 'headNewsId');
        }
		
        $save = DB::insert('headline', $table)
                    ->values(array(
						$id,
                        $user_id
                    ));
        list($lastid, $rows_inserted) = $save->execute();
        
        if(!empty($rows_inserted)) {
            $return = TRUE;
        }
        
        return $return;
        
    }
    
    public function delete_data($id = '', $user_id = '') {
        DB::update('headline')
			->set(array('headStatus' => 0))
			->where('headId', '=', $id)
			->execute();
    }
    
}