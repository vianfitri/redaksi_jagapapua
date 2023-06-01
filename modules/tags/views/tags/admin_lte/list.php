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
					<div class="box-body">
						<a href="/tags/new"><button style="width:150px" class="btn btn-block btn-primary btn-sm"><?php echo __('Add New Data'); ?></button></a>
					</div>
				</div>

				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo __('List Data'); ?></h3>
						<div class="box-tools">
							<form method="post" action="/tags/search">
								<div class="input-group" style="width: 150px;">
									<input type="text" name="search" class="form-control input-sm pull-right" placeholder="<?php echo __('Search'); ?>" value="<?php echo !empty($data['search']) ? $data['search'] : ''; ?>">
									<div class="input-group-btn">
										<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table class="table table-bordered">
							<tr>
								<th><?php echo __('Tags Name'); ?></th>
								<th><?php echo __('User Saved'); ?></th>
								<!--<th><?php echo __('Status'); ?></th>-->
								<th colspan="2" style="width:30%"><?php echo __('Actions'); ?></th>
							</tr>
							<?php
							if(!empty($data['list'])) {
								foreach($data['list'] as $v_list) {
									if($v_list['active'] == 1) {
										$status = '<span class="label label-success">Active</span>';
									} else {
										$status = '<span class="label label-danger">Non Active</span>';
									}
									echo '
										<tr>
											<td>' . $v_list['name'] . '</td>
											<td>' . $v_list['user'] . '</td>
											<!--<td>' . $status . '</td>-->
											<!--<td><a href="/tagspin/index/' . $v_list['id'] . '"><button class="btn btn-block btn-info btn-xs">' . __('Pin') . '</button></a></td>-->
											<td><a href="/tags/edit/' . $v_list['id'] . '"><button class="btn btn-block btn-warning btn-xs">' . __('Edit') . '</button></a></td>
											<td><a href="javascript:del_confirm(' . $v_list['id'] . ')"><button class="btn btn-block btn-danger btn-xs">' . __('Delete') . '</button></a></td>
										</tr>
									';
								}
							}
							?>
						</table>
					</div>
					<!-- /.box-body -->
					<?php echo !empty($data['pagination']) ? $data['pagination'] : ''; ?>
				</div>
				<!-- /.box -->
				<div class="box box-primary">
					<div class="box-body">
						<a href="/tags/new"><button style="width:150px" class="btn btn-block btn-primary btn-sm"><?php echo __('Add New Data'); ?></button></a>
					</div>
				</div>
			</div>
			<!-- /.col -->
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
