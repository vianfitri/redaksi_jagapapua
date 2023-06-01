<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-solid">
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo __($data['main_title']); ?></h3>
					</div>
					<form role="form" method="post" action="<?php echo URL::Base(); ?>ecommerce/category/submit">
						<div class="box-body">
							<div class="form-group">
								<label for="exampleInputEmail1"><?php echo __('Name') ?></label>
								<input type="text" name="name" class="form-control" placeholder="Lifestyle" required>
							</div>
							<div class="form-group">
								<label><?php echo __('Icon') ?></label>
								<input type="text" name="icon" class="form-control" placeholder="Icon">
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