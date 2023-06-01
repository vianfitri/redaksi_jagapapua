<div class="content-wrapper">
	<section class="content-header">
		<h1>
			<?php echo __('Newsroom Article'); ?>
		</h1>
		<ol class="breadcrumb">
			<li><?php echo __('Newsroom'); ?></li>
			<li class="active"><a href="/news"><?php echo __('News'); ?></a></li>
		</ol>
	</section>
	
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo __('Edit Data'); ?></h3>
					</div>
					<form role="form" method="post" action="<?php echo URL::Base(); ?>news/update">
						<div class="box-body">
							<?php
							if(!empty($data['errors'])) {
								?>
								<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-ban"></i> <?php echo __('Alert!'); ?></h4>
									<?php
									foreach($data['errors'] as $v_errors) {
										echo ucfirst($v_errors) . '</br>';
									}
									?>
								</div>
								<?php
							}
							?>
							<input type="hidden" name="id" value="<?php echo !empty($data['detail']['id']) ? $data['detail']['id'] : ''; ?>" />
							<input type="hidden" name="is_edit" value="1" />
							<div class="form-group">
								<label><?php echo __('Publish Time Schedule'); ?></label>
								<div class="input-group">
									<input type="text" name="publish_time" id="publish_time" value="<?php echo !empty($data['detail']['publishTime']) ? $data['detail']['publishTime'] : ''; ?>" placeholder="<?php echo __('Non Mandatory'); ?>" class="form-control">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label><?php echo __('Title') ?></label>
								<input type="text" name="title" value="<?php echo !empty($data['detail']['title']) ? $data['detail']['title'] : ''; ?>" maxlength="90" placeholder="<?php echo __('Only 90 Characters'); ?>" class="form-control" minlength="3" required>
							</div>
							<div class="form-group">
								<label><?php echo __('Image') ?></label>
								<div id="previewImage" style="width: 100%; height: auto; margin-bottom: 10px;">
									<?php
									$val_hidden_image = '';
									// Image preview edit
									if(!empty($data['detail']['images'][0]['image_id'])) {
										$split_id = str_split($data['detail']['images'][0]['image_id']);
										$path_folder_image = implode('/', $split_id);
										echo '<div style=" position: absolute; width: 20px; height: 20px; left: 186px; margin-top: 4px; background-color: rgb(255, 0, 0); "><center><span style="color: #FFFFFF;cursor: pointer;" onclick="javascript:delPreview();">X</span></center></div><img src="' . URL::Base() . 'uploads/library/' . $path_folder_image . '/' . $data['detail']['images'][0]['image_id'] . '_224x153.' . $data['detail']['images'][0]['image_type'] . '">';
										$val_hidden_image = URL::Base() . 'uploads/library/' . $path_folder_image . '/' . $data['detail']['images'][0]['image_id'] . '.' . $data['detail']['images'][0]['image_type'] . '';
									} else if(!empty($data['detail']['image'])) {
										// Get id image from full url image
										$base_image = basename($data['detail']['image']).PHP_EOL;
										if(!empty($base_image)) {
											$ex_base = explode('.', $base_image);
											list($id_image, $file_type) = $ex_base;
										}
										$split_id = str_split($id_image);
										$path_folder_image = implode('/', $split_id);
										$data['detail']['images'][0]['image_id'] = $id_image;
										$data['detail']['images'][0]['image_type'] = $file_type;
										echo '<div style=" position: absolute; width: 20px; height: 20px; left: 186px; margin-top: 4px; background-color: rgb(255, 0, 0); "><center><span style="color: #FFFFFF;cursor: pointer;" onclick="javascript:delPreview();">X</span></center></div><img src="' . URL::Base() . 'uploads/library/' . $path_folder_image . '/' . $data['detail']['images'][0]['image_id'] . '_224x153.' . $data['detail']['images'][0]['image_type'] . '">';
										$val_hidden_image = URL::Base() . 'uploads/library/' . $path_folder_image . '/' . $data['detail']['images'][0]['image_id'] . '.' . $data['detail']['images'][0]['image_type'] . '';
									}
									?>
								</div>
								<input type="hidden" name="image" id="image_popup" value="<?php echo $val_hidden_image; ?>" class="form-control">
								<input type="hidden" name="image_old" value="<?php echo $val_hidden_image; ?>" class="form-control">
								<a href="javascript:open_popup_img()"><button type="button" class="btn btn-block btn-default" id="image_popup_btn" style="width:200px"><?php echo __('Browse'); ?></button></a>
							</div>
							<div class="form-group">
								<label><?php echo __('Description') ?></label>
								<textarea class="form-control" rows="3" name="description" maxlength="165" placeholder="<?php echo __('Only 165 Characters'); ?>" minlength="3" required><?php echo !empty($data['detail']['description']) ? $data['detail']['description'] : ''; ?></textarea>
							</div>
							<?php 
								$sl_category = '';
								if(!empty($data['detail']['category_id'])) {
									$sl_category = $data['detail']['category_id'];
								}
								echo News::select_list('category', 1, $sl_category); 
							?>						
							<input type="hidden" name="category_old" value="<?php echo $data['detail']['category_id']; ?>">
							<div class="form-group">
								<label><?php echo __('Detail') ?></label>
								<textarea class="form-control f_tinymce" rows="15" name="detail" minlength="3" required><?php echo !empty($data['detail']['detail']) ? $data['detail']['detail'] : ''; ?></textarea>
							</div>
                            <div class="form-group">
								<label><?php echo __('Tags') ?></label>
                                                                <label style="float: right; cursor: pointer" class="refresh_tags"><?php echo __('( Click Here For Refresh Tags )') ?></label>
								<?php 
									$msl_tags = array();
									if(!empty($data['detail']['tags'])) {
										foreach($data['detail']['tags'] as $v_tags) {
											if(!empty($v_tags['tags_id'])) {
												$msl_tags[] = $v_tags['tags_id'];
											} else if(!is_array($v_tags)) {
												$msl_tags[] = $v_tags;
											} else {
												$msl_tags = '';
											}
										}
									}
									echo Tags::multiple('tags', 1, $msl_tags); 
									echo Tags::multiple('tags_old', 1, $msl_tags, true); 
								?>
							</div>
						</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-primary"><?php echo __('Update Data'); ?></button>
							<a href="<?php echo URL::Base(); ?>news"><button type="button" class="btn btn-danger"><?php echo __('Cancel'); ?></button></a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>