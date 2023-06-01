<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo __('Live Stream List'); ?>
		</h1>
		<ol class="breadcrumb">
			<li><?php echo __('Live Stream'); ?></li>
			<li class="active"><a href="/livestream/list"><?php echo __('List'); ?></a></li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo $data['count_all'] . ' ' . __('Data'); ?></h3>
						<div class="box-tools" style="float: right;">
							
						</div>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table class="table table-bordered">
							<!-- List isi artikel -->
							<tr>
								<th style="width:210px;text-align:center;"><?php echo __('Cover'); ?></th>
								 <th style="text-align:center;"><?php echo __('Embed Tag'); ?></th> 
								<th colspan="3" style="width:30%;text-align:center;"><?php echo __('Actions'); ?></th>
							</tr>
							<?php
							if(!empty($data['list'])) {
								foreach($data['list'] as $v_list) {

									$img = '<center> ' . __('[ No Image Available ]') . ' </center>';
									if(!empty($v_list['image'])) {
										$split_id = str_split($v_list['image']);
										$path_folder_image = implode('/', $split_id);
										$img = '<img src="' . URL::base() .'uploads/library/' . $path_folder_image . '/' . $v_list['image'] . '_224x153.' . $v_list['image_type'] . '" />';
									}

									echo '
										<tr>
											<td>' . $img . '</td>
											<td>' . $v_list['embed'] . '</td>
											<td><a href="'.URL::Base().'livestream/edit/' . $v_list['id'] . '"><button class="btn btn-block btn-warning btn-xs">' . __('Edit') . '</button></a></td>
											<td><a href="javascript:del_confirm(' . $v_list['id'] . ')"><button class="btn btn-block btn-danger btn-xs">' . __('Delete') . '</button></a></td>
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
