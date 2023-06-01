<div class="content-wrapper">
	<section class="content-header">
		<h1>
			<?php echo __('Users'); ?>
		</h1>
		<ol class="breadcrumb">
			<li><?php echo __('Users'); ?></li>
			<li class="active"><a href="#"><?php echo __('Edit'); ?></a></li>
		</ol>
	</section>
	
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo __('Users Edit'); ?></h3>
					</div>
					<form role="form" method="post" action="<?php echo URL::Base(); ?>users/update">
						<div class="box-body">
							<div class="form-group">
								<label for="exampleInputEmail1"><?php echo __('Name') ?></label>
								<input type="text" name="name" class="form-control" value="<?php echo $data['name']; ?>" required>
								<input type="hidden" name="id" value="<?php echo $data['id']; ?>">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1"><?php echo __('Email') ?></label>
								<input type="text" name="email" class="form-control" value="<?php echo $data['email']; ?>" required>
							</div>
							<!--<div class="form-group">
								<label><?php echo __('Type') ?></label>
								<div class="radio">
									<label>
										<input type="radio" name="type" class="optionsRadios" value="0" <?php if($data['access'] == 0){ echo "checked"; }?>> Community Only
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="type" class="optionsRadios" value="1" <?php if($data['access'] == 1){ echo "checked"; }?>> Full Access
									</label>
								</div>
							</div>-->
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