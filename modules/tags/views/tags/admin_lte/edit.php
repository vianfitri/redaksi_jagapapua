<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo __('Master Tags'); ?>
		</h1>
		<ol class="breadcrumb">
			<li><?php echo __('Data Master'); ?></li>
			<li class="active"><a href="/tags"><?php echo __('Master Tags'); ?></a></li>
		</ol>
	</section>
	
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo __('Edit Data'); ?></h3>
					</div>
					<form role="form" method="post" action="/tags/update">
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
								<label for="exampleInputEmail1"><?php echo __('Tags Name') ?></label>
								<input type="text" name="tags" class="form-control" maxlength="65" value="<?php echo !empty($data['name']) ? $data['name'] : ''; ?>">
								<input type="hidden" name="id" value="<?php echo !empty($data['id']) ? $data['id'] : ''; ?>">
							</div>
						</div>
						<!-- /.box-body -->
						<div class="box-footer">
							<button type="submit" class="btn btn-primary"><?php echo __('Update Data'); ?></button>
							<a href="/tags"><button type="button" class="btn btn-danger"><?php echo __('Cancel'); ?></button></a>
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