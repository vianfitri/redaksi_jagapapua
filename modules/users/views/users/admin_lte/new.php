<div class="content-wrapper">
	<section class="content-header">
		<h1>
			<?php echo __('Users'); ?>
		</h1>
		<ol class="breadcrumb">
			<li><?php echo __('Users'); ?></li>
			<li class="active"><a href="/"><?php echo __('New'); ?></a></li>
		</ol>
	</section>
	
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo __('New User'); ?></h3>
					</div>
					<form role="form" method="post" action="<?php echo URL::Base(); ?>users/submit" onsubmit="return checkValid()">
						<div class="box-body">
							<div class="form-group">
								<label for="exampleInputEmail1"><?php echo __('Name') ?></label>
								<input type="text" name="name" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1"><?php echo __('Email') ?></label>
								<input type="text" name="email" id="email" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1"><?php echo __('Password') ?></label>
								<input type="password" name="password" class="form-control" minlength="8" required>
							</div>
							<!--<div class="form-group">
								<label>Type</label>
								<div class="radio">
									<label>
										<input type="radio" name="type" class="optionsRadios" value="0" checked> Community Only
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="type" class="optionsRadios" value="1"> Full Access
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