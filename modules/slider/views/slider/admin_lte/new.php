<div class="content-wrapper">
	<section class="content-header">
		<h1>
			<?php echo __('Slider'); ?>
		</h1>
		<ol class="breadcrumb">
			<li><?php echo __('Slider'); ?></li>
			<li class="active"><a href="/"><?php echo __('New'); ?></a></li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo __('New Slider'); ?></h3>
					</div>
					<form role="form" method="post" action="<?php echo URL::Base(); ?>slider/submit">
						<div class="box-body">
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

							<div class="form-group">
								<label for="exampleInputEmail1"><?php echo __('Title Slider') ?></label>
								<input type="text" name="title_slider" class="form-control" required>
							</div>

							<!-- <div class="form-group">
								<label for="exampleInputEmail1"><?php echo __('Link App') ?></label>
								<input type="text" name="link_app" class="form-control" required>
							</div> -->
							<div class="form-group">
								<label for="exampleInputEmail1"><?php echo __('Link Web') ?></label>
								<input type="text" name="link_web" class="form-control" required>
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
