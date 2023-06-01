<div class="content-wrapper">
	<section class="content-header">
		<h1>
			<?php echo __('Live Stream'); ?>
		</h1>
		<ol class="breadcrumb">
			<li><?php echo __('Live Stream'); ?></li>
			<li class="active"><a href="/"><?php echo __('New'); ?></a></li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo __('New Live Stream'); ?></h3>
					</div>
					<form role="form" method="post" action="<?php echo URL::Base(); ?>livestream/submit">
						<div class="box-body">
							<div class="form-group">
								<label><?php echo __('Cover') ?></label>
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

							<div class="form-group">
								<label for="exampleInputEmail1"><?php echo __('Embed Tag Live Stream') ?></label>
								<input type="text" name="embed" class="form-control">
							</div>

						</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-primary"><?php echo __('Save'); ?></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
