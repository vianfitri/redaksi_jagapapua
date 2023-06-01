<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo __('Users List'); ?>
		</h1>
		<ol class="breadcrumb">
			<li><?php echo __('Users'); ?></li>
			<li class="active"><a href="/users/list"><?php echo __('List'); ?></a></li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo $data['count_all'] . ' ' . __('Data'); ?></h3>
						<div class="box-tools" style="float: right;">
							<form method="post" action="<?php echo URL::Base(); ?>users/search">
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
							<!-- List isi artikel -->
							<tr>
								<th style="width:210px;text-align:center;"><?php echo __('Name'); ?></th>
								<th style="text-align:center;"><?php echo __('Email'); ?></th>
								<th colspan="3" style="width:30%;text-align:center;"><?php echo __('Actions'); ?></th>
							</tr>
							<?php
							if(!empty($data['list'])) {
								foreach($data['list'] as $v_list) {
									$disabled = "";
									if($data['userId'] != $v_list['id']){
										//$disabled = "disabled";
									}
									echo '
										<tr>
											<td>' . $v_list['name'] . '</td>
											<td>' . $v_list['email'] . '</td>
											<td><a href="'.URL::Base().'users/cpas/' . $v_list['id'] . '"><button class="btn btn-block btn-success btn-xs" '.$disabled.'>' . __('Change Password') . '</button></a></td>
											<td><a href="'.URL::Base().'users/edit/' . $v_list['id'] . '"><button class="btn btn-block btn-warning btn-xs" '.$disabled.'>' . __('Edit') . '</button></a></td>
											<td><a href="javascript:del_confirm(' . $v_list['id'] . ')"><button class="btn btn-block btn-danger btn-xs" '.$disabled.'>' . __('Delete') . '</button></a></td>
										</tr>
									';
								}
							}
							?>
						</table>
					</div>
					<?php echo !empty($data['pagination']) ? $data['pagination'] : ''; ?>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col -->
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
