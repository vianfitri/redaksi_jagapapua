<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo __('Add Article'); ?>
		</h1>
		<ol class="breadcrumb">
			<li><?php echo __('Newsroom'); ?></li>
			<li class="active"><a href="/cms/news"><?php echo __('News'); ?></a></li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo __('Add New Data'); ?></h3>
					</div>
					<form role="form" method="post"  onsubmit="return checkValid()" action="/news/save">
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
							<div class="form-group">
								<label><?php echo __('Publish Time Schedule') ?></label>
								<div class="input-group">
									<input type="text" name="publish_time" id="publish_time" value="<?php echo !empty($data['post']['publish_time']) ? $data['post']['publish_time'] : ''; ?>" placeholder="<?php echo __('Optional'); ?>" class="form-control">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label><?php echo __('Title') ?></label>
								<input type="text" name="title" value="<?php echo !empty($data['post']['title']) ? $data['post']['title'] : ''; ?>" minlength="3" maxlength="90" placeholder="<?php echo __('Only 90 Characters'); ?>" class="form-control" required>
							</div>
							<div class="form-group">
								<label><?php echo __('Image') ?></label>
								<div id="previewImage" style="width: 100%; height: auto; margin-bottom: 10px;">
									<?php
									$val_hidden_image = '';
									// Image preview edit
									if(!empty($data['post']['image'])) {
										// Get id image from full url image
										$base_image = basename($data['post']['image']).PHP_EOL;
										if(!empty($base_image)) {
											$ex_base = explode('.', $base_image);
											list($id_image, $file_type) = $ex_base;
										}
										$split_id = str_split($id_image);
										$path_folder_image = implode('/', $split_id);
										echo '<div style=" position: absolute; width: 20px; height: 20px; left: 186px; margin-top: 4px; background-color: rgb(255, 0, 0); "><center><span style="color: #FFFFFF;cursor: pointer;" onclick="javascript:delPreview();">X</span></center></div><img src="uploads/library/' . $path_folder_image . '/' . $id_image . '.' . $file_type . '" style="width:200px;">';
										$val_hidden_image = $data['post']['image'];
									}
									?>
								</div>
								<input type="hidden" name="image" id="image_popup" value="<?php echo $val_hidden_image; ?>" class="form-control">
								<a href="javascript:open_popup_img()"><button type="button" class="btn btn-block btn-default" id="image_popup_btn" style="width:200px"><?php echo __('Browse'); ?></button></a>
							</div>
							<?php
								$sl_category = '';
								if(!empty($data['post']['category'])) {
									$sl_category = $data['post']['category'];
								}
								echo News::select_list('category', 1, $sl_category);
							?>
							<div class="form-group">
								<label><?php echo __('Description') ?></label>
								<textarea class="form-control" rows="3" name="description" maxlength="165" placeholder="<?php echo __('Only 165 Characters'); ?>" minlength="3" required><?php echo !empty($data['post']['wording']) ? $data['post']['wording'] : ''; ?></textarea>
							</div>
							<div class="form-group">
								<label><?php echo __('Detail') ?></label>
								<textarea id="wysiwyg" class="form-control f_tinymce" rows="15" name="detail" minlength="3" required><?php echo !empty($data['post']['detail']) ? $data['post']['detail'] : '<strong style="color:#999">JAGAPAPUA.COM - </strong>&nbsp;'; ?></textarea>
							</div>
                            <div class="form-group">
								<label><?php echo __('Tags') ?></label>
                                                                <label style="float: right; cursor: pointer" class="refresh_tags"><?php echo __('( Click Here For Refresh Tags )') ?></label>
								<?php
									$msl_tags = '';
									if(!empty($data['post']['tags'])) {
										$msl_tags = $data['post']['tags'];
									}
									echo Tags::multiple('tags', 1, $msl_tags);
								?>
							</div>
						</div>
						<!-- /.box-body -->

						<div class="box-footer">
							<button type="submit" class="btn btn-primary"><?php echo __('Save Data'); ?></button>
							<a href="/news"><button type="button" class="btn btn-danger"><?php echo __('Cancel'); ?></button></a>
						</div>
					</form>
					<!-- /.box-header -->
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col -->
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
