<div class="content-wrapper">
	<section class="content-header">
		<h1>
			<?php echo __('Citizen Jurnalist'); ?>
		</h1>
	</section>
	
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-solid">
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo $data['count_all'] . ' ' . __('Data Found'); ?></h3>
						<div class="box-tools" style="float: right;">
							<form method="post" action="<?php echo URL::Base(); ?>news/search?date_range=<?php echo !empty($data['date_range']) ? $data['date_range'] : ''; ?>">
								<div class="input-group" style="width: 150px;">
									<input type="text" name="search" class="form-control input-sm pull-right" placeholder="<?php echo __('Search'); ?>" value="<?php echo !empty($data['search']) ? $data['search'] : ''; ?>">
									<div class="input-group-btn">
										<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="box-body" style="overflow">
						<table class="table table-bordered" style="border-collapse:collapse;">
							<tr>
								<th style="width:210px;text-align:center;"><?php echo __('News Image'); ?></th>
								<th style="text-align:center;"><?php echo __('News Article'); ?></th>
								<th style="text-align:center;"><?php echo __('Upload'); ?></th>
								<th style="width:20%;text-align:center;"><?php echo __('Actions'); ?></th>
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
											<td><img src="' .  $v_list['image'] . '" style="max-width: 300px;max-height: 400px;"></td>
											<td style="{border:solid 1px #fab; width:100px; word-wrap:break-word;">
												<strong>' . $article_title . '</strong></br>
												Description: <BR><i>' . $article_desc . '</i> </br></br>
											</td>
											<td><strong>by: ' . $v_list['name'] . '</strong></td>
											<td>
												<a href="/news/approve/' . $v_list['id'] . '"><button class="btn btn-block btn-success btn-xs">' . __('Preview') . '</button></a></strong>
											</td>
										</tr>
									';
									$c_bg_list++;
								}
							}
							?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
