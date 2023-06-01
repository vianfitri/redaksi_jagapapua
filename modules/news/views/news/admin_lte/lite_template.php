<div class="box-body">
						<table class="table table-bordered">
							<!-- List isi artikel -->
							<tr>
								<th style="text-align:center;"><?php echo __('News Article'); ?></th>
								<th style="text-align:center;"><?php echo __('Uploader'); ?></th>
								<th style="width:18%;text-align:center;"><?php echo __('Status'); ?></th>
								<th colspan="4" style="width:40%;text-align:center;"><?php echo __('Actions'); ?></th>
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

									// Status
									$article_status = $url_live = '';
									if($v_list['status'] == 1) {
										$article_status = '<span class="label label-info">Saved</span> <b>' . date('d M Y H:i', strtotime($v_list['saved'])) . '</b>';
									} else if($v_list['status'] == 0) {
										$article_status = '<span class="label label-danger">Deleted</span> <b>' . date('d M Y H:i', strtotime($v_list['saved'])) . '</b>';
									} else if($v_list['status'] == 2) {
										$url_live = Kohana::$config->load('path.arah')."/article/{$v_list['id']}/".URL::title($v_list['title']).'.html';
										$article_status = '<span class="label label-success">Publish</span> <b>' . date('d M Y H:i', strtotime($v_list['publish'])). '</b>';
										$article_status .= '<br><br><b><i>Approved By :<br>' . News::get_user_approver($v_list['id']) . '<i></b>';
								}

									// Default Button
									$button = '
										<td>
											<a href="/news/detail/' . $v_list['id'] . '"><button class="btn btn-block btn-success btn-xs">' . __('Preview') . '</button></a>
										</td>
										<td>
											<a href="/news/edit/' . $v_list['id'] . '"><button class="btn btn-block btn-warning btn-xs">' . __('Edit') . '</button></a>
										</td>
										<td>
											<a href="javascript:del_confirm(' . $v_list['id'] . ')"><button class="btn btn-block btn-danger btn-xs">' . __('Delete') . '</button></a>
										</td>
									';

									// Button If Status 0
									if($v_list['status'] == 0) {
										$button = '
											<td>
												<a href="/news/detail/' . $v_list['id'] . '"><button class="btn btn-block btn-success btn-xs">' . __('Preview') . '</button></a>
											</td>
											<td>
												<a href="javascript:void()"><button disabled class="btn btn-block btn-warning btn-xs">' . __('Edit') . '</button></a>
											</td>
											<td>
												<a href="javascript:void()"><button disabled class="btn btn-block btn-danger btn-xs">' . __('Delete') . '</button></a>
											</td>
										';
									}

							$article_title = $v_list['title'];
							$article_desc = $v_list['description'];
							if(!empty($data['search'])) {
								$ex_search = explode(',',$data['search']);
								foreach($ex_search as $v_search) {
									$article_title = str_ireplace(trim($v_search), '<span style="color:red"><b><i>' . trim($v_search). '</i></b></span>', $article_title);

									$article_desc = str_ireplace(trim($v_search), '<span style="color:red"><b><i>' . trim($v_search) . '</i></b></span>', $article_desc);
								}
							}
							if(!empty($url_live)){
								$article_title = "<a href='{$url_live}' target='_BLANK'>{$article_title}</a>";
							}

									echo '
										<tr ' . $bg_list . '>
											<td>
												<strong>' . $article_title . '</strong></br></br>
												Category : <strong><i>' . $v_list['category_name'] . '</i></strong></br>
											</td>
											<td>' . $v_list['name_saved'] . '</td>
											<td>' . $article_status . '</td>
											' . $button . '
										</tr>
									';
                                                                        $c_bg_list++;
								}
							}
							?>
						</table>
					</div>
