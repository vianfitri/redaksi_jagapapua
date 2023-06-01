<div class="box-body">
	<table class="table table-bordered">
		<!-- List isi artikel -->
		<tr>
			<th style="width:210px;text-align:center;"><?php echo __('News Image'); ?></th>
			<th style="text-align:center;"><?php echo __('News Article'); ?></th>
			<th style="width:20%;text-align:center;"><?php echo __('Upload'); ?></th>
			<th colspan="2" style="width:20%;text-align:center;"><?php echo __('Actions'); ?></th>
		</tr>
		<?php
		if(!empty($data['list'])) {
			$c_bg_list = 1;
			$bg_list = '';
			foreach($data['list'] as $v_list) {
				// Background color
				if($c_bg_list % 2 == 0) {
					$bg_list = '';
				} else {
					$bg_list = 'style="background-color: #ECF0F5;"';
				}
				// Image article
				$img_article = '<center> ' . __('[ No Image Available ]') . ' </center>';
				if(!empty($v_list['images'][0]['image_id'])) {
					$split_id = str_split($v_list['images'][0]['image_id']);
					$path_folder_image = implode('/', $split_id);
					$img_article = '<img src="' . URL::base() .'uploads/library/' . $path_folder_image . '/' . $v_list['images'][0]['image_id'] . '_224x153.' . $v_list['images'][0]['image_type'] . '" />';
				}
				
				// Article tags
				$article_tags = '';
				if(!empty($v_list['tags'])) {
					foreach($v_list['tags'] as $v_list_tags) {
						$article_tags .= '<u>' . $v_list_tags['tags_name'] . '</u>, ';
					}
				}
				
				// Status
				$article_status = '';
				if($v_list['status'] == 1) {
					$article_status = '<span class="label label-info">Saved</span> <b>' . date('d M Y H:i', strtotime($v_list['saved'])) . '</b><br>';
					$article_status .= '<span class="label label-success">Publish</span> <b>' . date('d M Y H:i', strtotime($v_list['publishTime'])) . '</b>';
				} else {
					$article_status = '<span class="label label-danger">Deleted</span> <b>' . date('d M Y H:i', strtotime($v_list['saved'])) . '</b>';
				}
				
				$btn_prg = '';
				if($v_list['status'] == 2){
					$btn_prg = '<a href="javascript:void(0)" onclick="PopupCenter(\'http://baca.bismillah.web.id/engine/purge/cache.php?web=arah&id=' . $v_list['id'] . '\', \'Purge\', 600, 300)"><button class="btn btn-block btn-danger btn-xs">' . __('Purge Cache') . '</button></a></br>';
				}
				
				// Default Button
				$button = '
					<td>
						<a href="' . URL::base() .'news/detail/' . $v_list['id'] . '"><button class="btn btn-block btn-success btn-xs">' . __('Preview') . '</button></a> </br>
						<a href="' . URL::base() .'news/edit/' . $v_list['id'] . '"><button class="btn btn-block btn-warning btn-xs">' . __('Edit') . '</button></a> </br>
						<a href="javascript:del_confirm(' . $v_list['id'] . ')"><button class="btn btn-block btn-danger btn-xs">' . __('Delete') . '</button></a> </br></br>
						'.$btn_prg.'
					</td>
				';
				
				// Button If Status 0
				if($v_list['status'] == 0) {
					$button = '
						<td>
							<a href="' . URL::base() .'news/detail/' . $v_list['id'] . '"><button class="btn btn-block btn-success btn-xs">' . __('Preview') . '</button></a> </br>
							<a href="javascript:void()"><button disabled class="btn btn-block btn-warning btn-xs">' . __('Edit') . '</button></a> </br>
							<a href="javascript:void()"><button disabled class="btn btn-block btn-danger btn-xs">' . __('Delete') . '</button></a> </br></br>
						</td>
					';
				}
				
				$article_title = $v_list['title'];
				$article_desc = $v_list['description'];
				if(!empty($data['search'])) {
					$ex_search = explode(',',$data['search']);
					foreach($ex_search as $v_search) {
						$article_title = str_ireplace(trim($v_search), '<span style="color:red"><b><i>' . trim($v_search). '</i></b></span>', $article_title);
						
					}
				}
				
				echo '
					<tr ' . $bg_list . '>
						<td>' . $img_article . '</td>
						<td>
							<strong>' . $article_title . '</strong></br>
							Description: <BR><i>' . $article_desc . '</i> </br></br>
							Category : <strong><i>' . $v_list['category_name'] . '</i></strong></br></br>
						</td>
						<td>' . $article_status . ' <BR><BR><strong>by: ' . $v_list['name_saved'] . '</strong></td>
						' . $button . '
					</tr>
				';
				$c_bg_list++;
			}
		}
		?>
	</table>
</div>