<div class="content-wrapper">
<section class="content-header">
		<h1>
			<?php echo __('Foto'); ?>
		</h1>
		<ol class="breadcrumb">
			<li><?php echo __('Foto'); ?></li>
			<li class="active"><a href=""><?php echo __('New'); ?></a></li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo __($data['main_title']); ?></h3>
					</div>
					<form role="form" method="post" action="<?php echo URL::Base(); ?>foto/submit" onsubmit="return checkValid()">
						<div class="box-body">

							<?php
								for($i=1; $i<=2; $i++){
							?>

							<!-- <div class="form-group">
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
								}
							?> -->

							<!-- multiple image -->
							<?php for ($k = 0; $k <= 5; $k++)  {?>

							<div <?php if ($k >0) { ?> class="form-group gbr gbr_<?php echo $k ?>" style="display:none" <?php } else { ?> class="form-group" <?php } ?> >

								<label><?php echo __('Image ') ?></label>
								<div id="previewImage<?php echo $k ?>" style="width: 100%; height: auto; margin-bottom: 10px;">
									<?php
									$val_hidden_image = '';
									// Image preview edit
									if(!empty($data['post']['image'][0])) {
										// Get id image from full url image
										$base_image = basename($data['post']['image']).PHP_EOL;
										if(!empty($base_image)) {
											$ex_base = explode('.', $base_image);
											list($id_image, $file_type) = $ex_base;
										}
										$split_id = str_split($id_image);
										$path_folder_image = implode('/', $split_id);
										echo '<div style=" position: absolute; width: 20px; height: 20px; left: 186px; margin-top: 4px; background-color: rgb(255, 0, 0); "><center><span style="color: #FFFFFF;cursor: pointer;" onclick="javascript:delPreview'.  $k .'();">X</span></center></div><img src="uploads/library/' . $path_folder_image . '/' . $id_image . '.' . $file_type . '" style="width:200px;">';
										$val_hidden_image = $data['post']['image'];
									}
									?>
								</div>
								<input type="hidden" name="image[]" id="image_popup<?php echo $k ?>" value="<?php echo $val_hidden_image; ?>" class="form-control">
								<div class ="button-group">
								<a href="javascript:open_popup_img<?php echo $k ?>()"><button type="button" class="btn btn-default" id="image_popup_btn<?php echo $k ?>" style="width:200px"><?php echo __('Browse'); ?></button></a>
								<?php if ($k > 0): ?><a onclick="javascript:remove_form_image<?php echo $k ?>()"><button type="button" class="btn btn-danger" id="remove_image_form"><?php echo __('X'); ?></button></a><?php endif; ?>
								</div>
							</div>

							<?php } ?>

							<!--<a href="javascript:add_form_image()"><button type="button" class="btn btn-block btn-success btn-xs" id="add_form_image" style="width:200px"><?php echo __('Add More Image'); ?></button></a>-->

                            
							<div style="margin-top: 20px" class="form-group">
								<label for="exampleInputEmail1"><?php echo __('Title') ?></label>
								<input type="text" name="title" class="form-control" placeholder="Title" required >
							</div>
							
                            <!--
							<div class="form-group">
								<label><?php echo __('Detail') ?></label>
								<textarea id="wysiwyg" class="form-control f_tinymce" rows="15" name="detail" minlength="3"></textarea>
							</div>
                            -->
							
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