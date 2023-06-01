<div class="content-wrapper">
	<section class="content-header">
		<h1>
			<?php echo __('Master Category'); ?>
		</h1>
		<ol class="breadcrumb">
			<li><?php echo __('Master Category'); ?></li>
			<li class="active"><a href="/mascat/new"><?php echo __('New'); ?></a></li>
		</ol>
	</section>
	
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo __('New Master Category'); ?></h3>
					</div>
					<form role="form" method="post" action="<?php echo URL::Base(); ?>mascat/submit">
						<div class="box-body">
							<div class="form-group">
								<label for="exampleInputEmail1"><?php echo __('Name') ?></label>
								<input type="text" name="name" class="form-control" required>
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