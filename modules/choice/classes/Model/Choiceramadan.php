<?php defined('SYSPATH') or die('No direct script access.');

class Model_Choiceramadan extends Model {

    // If debug user status = 1
    private $status = 2;

    public function count_approved($search = '') {
        $return = 0;

        $and_where1 = '';
        $and_where2 = '';
        $and_where3 = '';

		$session = Session::instance();
		$cat = 53;

			$cfg_kanal = Kohana::$config->load('kanal');
			$kanal = $cfg_kanal->get('group');
			$kanal_category = array();
			foreach($kanal as $key=>$v){
				$kanal_category[$v][]=$key;
			}

			if(empty($kanal_category[$cat])){
				$cat = array($cat);
			}else{
				$cat = $kanal_category[$cat];
			}

			$and_where1 .= ' and artcMsctId in ('.implode(',',$cat).')';
			$and_where2 .= ' and glryMsctId in ('.implode(',',$cat).')';
			$and_where3 .= ' and vdeoMsctId in ('.implode(',',$cat).')';


        if(!empty($search)) {
            $and_where1 .= ' AND (';
            $and_where2 .= ' AND (';
            $and_where3 .= ' AND (';
            $ex_search = explode(',', $search);
            if(!empty($ex_search)) {
                $c_search = 1;
                foreach ($ex_search as $v_search) {
                    if($c_search > 1) {
                        $and_where1 .= ' OR';
                        $and_where2 .= ' OR';
                        $and_where3 .= ' OR';
                    }
                    $and_where1 .= ' `artcTitle` LIKE "%' . trim($v_search) . '%" OR `artcExcerpt` LIKE "%' . trim($v_search) . '%"';
                    $and_where2 .= ' `glryTitle` LIKE "%' . trim($v_search) . '%" OR `glryExcerpt` LIKE "%' . trim($v_search) . '%"';
                    $and_where3 .= ' `vdeoTitle` LIKE "%' . trim($v_search) . '%" OR `vdeoExcerpt` LIKE "%' . trim($v_search) . '%"';
                    $c_search ++;
                }
            }
            $and_where1 .= ')';
            $and_where2 .= ')';
            $and_where3 .= ')';
        }

        $sql = 'SELECT COUNT(1) as COUNT FROM'
                . '( '
                . '(SELECT DISTINCT `artcId` FROM `article` WHERE `artcStatus` = "' . $this->status . '"' . $and_where1 . ') '
                . 'UNION ALL '
                . '(SELECT DISTINCT `glryId` FROM `gallery` WHERE `glryStatus` = "' . $this->status . '"' . $and_where2 . ') '
                . 'UNION ALL '
                . '(SELECT DISTINCT `vdeoId` FROM `video` WHERE `vdeoStatus` = "' . $this->status . '"' . $and_where3 . ') '
                . ') AS COUNT';

        $exec = DB::query(Database::SELECT, $sql)->execute()->as_array();

        if(!empty($exec[0]['COUNT'])) {
            $return = $exec[0]['COUNT'];
        }

        return $return;

    }

    public function list_approved($limit = 20, $offset = 0, $search = '') {

		$session = Session::instance();
		$cat = 53;

			$cfg_kanal = Kohana::$config->load('kanal');
			$kanal = $cfg_kanal->get('group');
			$kanal_category = array();
			foreach($kanal as $key=>$v){
				$kanal_category[$v][]=$key;
			}

			if(empty($kanal_category[$cat])){
				$cat = array($cat);
			}else{
				$cat = $kanal_category[$cat];
			}


        // Query select foto
        $exec_photo = DB::select(
                                    array('glryId', 'id'),
                                    array('glryTitle', 'title'),
                                    array('glryExcerpt', 'description'),
                                    array('glryKeyword', 'keyword'),
                                    array('glryDetail', 'detail'),
                                    array('glryViewer', 'viewer'),
                                    array('glryPublishTime', 'publish'),
                                    array('glrySaved', 'saved'),
                                    array('glryStatus', 'status'),
                                    array('glryMsctId', 'category_id'),
                                    array('msctName', 'category_name'),
                                    array('glryUserIdSaved', 'user_id'),
                                    array('userRealName', 'user_name'),
                                    array(DB::expr('"gallery"'), 'type')
                            )
                            ->from('gallery')
                            ->join('user', 'LEFT')
                            ->on('gallery.glryUserIdSaved', '=', 'user.userId')
                            ->join('master_category', 'LEFT')
                            ->on('gallery.glryMsctId', '=', 'master_category.msctId')
                            ->where('glryStatus', '=', $this->status)
                            ->where('glryMsctId', 'in', $cat);

        if(!empty($search)) {
            $exec_photo = $exec_photo->and_where_open();
            $ex_search = explode(',', $search);
            if(!empty($ex_search)) {
                foreach($ex_search as $v_search) {
                    $exec_photo = $exec_photo->or_where('glryTitle', 'LIKE', '%' . trim($v_search) . '%')
                                                ->or_where('glryExcerpt', 'LIKE', '%' . trim($v_search) . '%');
                }
            }
            $exec_photo = $exec_photo->and_where_close();
        }

        // Query select video
        $exec_video = DB::select(
                                    array('vdeoId', 'id'),
                                    array('vdeoTitle', 'title'),
                                    array('vdeoExcerpt', 'description'),
                                    array('vdeoKeyword', 'keyword'),
                                    array('vdeoDetail', 'detail'),
                                    array('vdeoViewer', 'viewer'),
                                    array('vdeoPublishTime', 'publish'),
                                    array('vdeoSaved', 'saved'),
                                    array('vdeoStatus', 'status'),
                                    array('vdeoMsctId', 'category_id'),
                                    array('msctName', 'category_name'),
                                    array('vdeoUserIdSaved', 'user_id'),
                                    array('userRealName', 'user_name'),
                                    array(DB::expr('"video"'), 'type')
                            )
                            ->from('video')
                            ->join('user', 'LEFT')
                            ->on('video.vdeoUserIdSaved', '=', 'user.userId')
                            ->join('master_category', 'LEFT')
                            ->on('video.vdeoMsctId', '=', 'master_category.msctId')
                            ->where('vdeoStatus', '=', $this->status)
                            ->where('vdeoMsctId', 'in', $cat);

        if(!empty($search)) {
            $exec_video = $exec_video->and_where_open();
            $ex_search = explode(',', $search);
            if(!empty($ex_search)) {
                foreach($ex_search as $v_search) {
                    $exec_video = $exec_video->or_where('vdeoTitle', 'LIKE', '%' . trim($v_search) . '%')
                                                ->or_where('vdeoExcerpt', 'LIKE', '%' . trim($v_search) . '%');
                }
            }
            $exec_video = $exec_video->and_where_close();
        }

        // Query select news
        $exec_news = DB::select(
                                array('artcId', 'id'),
                                array('artcTitle', 'title'),
                                array('artcExcerpt', 'description'),
                                array('artcKeyword', 'keyword'),
                                array('artcDetail', 'detail'),
                                array('artcViewer', 'viewer'),
                                array('artcPublishTime', 'publish'),
                                array('artcSaved', 'saved'),
                                array('artcStatus', 'status'),
                                array('artcMsctId', 'category_id'),
                                array('msctName', 'category_name'),
                                array('artcUserIdSaved', 'user_id'),
                                array('userRealName', 'user_name'),
                                array(DB::expr('"article"'), 'type')
                        )
                        ->from('article')
                        ->join('user', 'LEFT')
                        ->on('article.artcUserIdSaved', '=', 'user.userId')
                        ->join('master_category', 'LEFT')
                        ->on('article.artcMsctId', '=', 'master_category.msctId')
                        ->where('artcParentId', '=', NULL)
                        ->where('artcStatus', '=', $this->status)
                        ->where('artcMsctId', 'in', $cat);

		$exec_news=$exec_news->union($exec_photo, TRUE)->union($exec_video, TRUE);

        if(!empty($search)) {
            $exec_news = $exec_news->and_where_open();
            $ex_search = explode(',', $search);
            if(!empty($ex_search)) {
                foreach($ex_search as $v_search) {
                    $exec_news = $exec_news->or_where('artcTitle', 'LIKE', '%' . trim($v_search) . '%')
                                                ->or_where('artcExcerpt', 'LIKE', '%' . trim($v_search) . '%');
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
                                ->from('editor_choice_ramadan')
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
                                ->from('editor_choice_ramadan')
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


        $save = DB::insert('editor_choice_ramadan', $table)
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

        return DB::delete('editor_choice_ramadan')
                ->where('echoId', '=', $id)
                ->execute();

    }

}
