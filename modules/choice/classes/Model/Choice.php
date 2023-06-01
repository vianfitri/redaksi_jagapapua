<?php defined('SYSPATH') or die('No direct script access.');

class Model_Choice extends Model {
    
    // If debug user status = 1
    private $status = 1;
    
    public function count_approved($search = '') {		
        $return = 0;
        
        $and_where1 = '';
        $and_where2 = '';
        $and_where3 = '';
		
		$session = Session::instance();
		
        if(!empty($search)) {
            $and_where1 .= ' AND (';
            $ex_search = explode(',', $search);
            if(!empty($ex_search)) {
                $c_search = 1;
                foreach ($ex_search as $v_search) {
                    if($c_search > 1) {
                        $and_where1 .= ' OR';
                    }
                    $and_where1 .= ' `newsTitle` LIKE "%' . trim($v_search) . '%" OR `newsExcerpt` LIKE "%' . trim($v_search) . '%"';
                    $c_search ++;
                }
            }
            $and_where1 .= ')';
        }
        
		$sql = 'SELECT COUNT(1) as COUNT FROM'
                . '(SELECT DISTINCT `newsId` FROM `news` WHERE `newsStatus` = "' . $this->status . '"' . $and_where1 . ')'
                . ' AS COUNT';
        
        $exec = DB::query(Database::SELECT, $sql)->execute()->as_array();
        
        if(!empty($exec[0]['COUNT'])) {
            $return = $exec[0]['COUNT'];
        }
        
        return $return;
        
    }
    
    public function list_approved($limit = 20, $offset = 0, $search = '') {
        
		$session = Session::instance();
		
        // Query select news
        $exec_news = DB::select(
                                array('newsId', 'id'),
                                array('newsTitle', 'title'),
                                array('newsExcerpt', 'description'),
                                array('newsDetail', 'detail'),
                                array('newsPublishTime', 'publish'),
                                array('newsSaved', 'saved'),
                                array('newsStatus', 'status'),
                                array('newsMsctId', 'category_id'),
                                array('msctName', 'category_name'),
                                array('newsAdmiId', 'user_id'),
                                array('userFullName', 'user_name'),
                                array(DB::expr('"news"'), 'type')
                        )
                        ->from('news')
                        ->join('user', 'LEFT')
                        ->on('news.newsAdmiId', '=', 'user.userId')
                        ->join('master_category', 'LEFT')
                        ->on('news.newsMsctId', '=', 'master_category.msctId')
                        ->where('newsStatus', '=', $this->status);
		
        if(!empty($search)) {
            $exec_news = $exec_news->and_where_open();
            $ex_search = explode(',', $search);
            if(!empty($ex_search)) {
                foreach($ex_search as $v_search) {
                    $exec_news = $exec_news->or_where('newsTitle', 'LIKE', '%' . trim($v_search) . '%')
                                                ->or_where('newsExcerpt', 'LIKE', '%' . trim($v_search) . '%');
                }
            }
            $exec_news = $exec_news->and_where_close();
        }
        
        $exec_news = $exec_news->__toString();
        
        $custom_query = $exec_news . ' ORDER BY id DESC LIMIT ' . $limit . ' OFFSET ' . $offset;       
        
		// Edit By Irul
		echo '<div style="display:none">' . $custom_query . '</div>';
		
        $exec = DB::query(Database::SELECT, $custom_query)->execute()->as_array();
        
        return $exec;        
        
    }
    
    public function count_choice() {    
        $return = 0;

        $query =	DB::select(array(DB::expr('COUNT(1)'), 'COUNT'))
                                ->from('editor_choice')
                                ->where('echoStatus', '=', '1')
                                ->execute()
                                ->as_array();

        if(!empty($query[0]['COUNT'])) {
                $return = $query[0]['COUNT'];
        }

        return $return;
        
    }
    
    public function list_choice($limit = 20, $offset = 0) {
        
        return         DB::select()
                                ->from('editor_choice')
                                ->where('echoStatus', '=', '1')
                                ->order_by('echoId', 'DESC')
                                ->limit($limit)
                                ->offset($offset)
                                ->execute()
                                ->as_array();
        
    }
    
    public function save_data($data = '', $user_id = '') {
        
        $return = FALSE;
        
        list($type, $id) = explode('|', $data['post_val']);
        
        $table = array(
            'echoUserIdSaved'
        );
        
        if($type == 'article') {
            array_unshift($table, 'echoArtcId');
        } else if($type == 'gallery') {
            array_unshift($table, 'echoGlryId');
        } else if($type == 'video') {
            array_unshift($table, 'echoVdeoId');
        }
        
        
        $save = DB::insert('editor_choice', $table)
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
	
	public function change_data($id ='', $id_src = '', $user_id = '') {
	
		$update = DB::update('editor_choice')
			->set(array('echoArtcId' => $id))
			->set(array('echoUserIdSaved' =>  $user_id))
			->where('echoId', '=', $id_src)->execute();
        
    }
    
    public function delete_data($id = '', $user_id = '') {
        
        return DB::delete('editor_choice')
                ->where('echoId', '=', $id)
                ->execute();
        
    }
    
}