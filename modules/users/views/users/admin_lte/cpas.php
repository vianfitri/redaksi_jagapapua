<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo __('Users'); ?>
		</h1>
		<ol class="breadcrumb">
			<li><?php echo __('Users'); ?></li>
			<li class="active"><a href="#"><?php echo __('Change Password'); ?></a></li>
		</ol>
	</section>
	
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo __('Change Password User '); ?></h3>
					</div>
					<form role="form" method="post" action="<?php echo URL::Base(); ?>users/cpas_submit">
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
							<?php
							if(!empty($data['success'])) {
								?>
								<div class="alert alert-success alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<h4><i class="icon fa fa-ban"></i> <?php echo __('Alert!'); ?></h4>
										<?php echo 'Password was changed'; ?>
								</div>
								<?php
							}
							?>
							<div class="form-group">
								<label for="exampleInputEmail1">Change Password For : <?php echo $data['name']; ?></label>
								<input type="hidden" name="id" value="<?php echo $data['id']; ?>">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1"><?php echo __('Password') ?></label>
								<input type="password" name="password" class="form-control" minlength="8" required>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1"><?php echo __('Retype Password') ?></label>
								<input type="password" name="retype_password" class="form-control" minlength="8" required>
							</div>
						</div>
						<!-- /.box-body -->
						<div class="box-footer">
							<button type="submit" class="btn btn-primary"><?php echo __('Save'); ?></button>
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