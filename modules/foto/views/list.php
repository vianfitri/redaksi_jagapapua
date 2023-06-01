<div class="content-wrapper">
	<section class="content-header">
		<h1>
			<?php echo __($data['main_title']); ?>
		</h1>
		<ol class="breadcrumb">
			<li><?php echo __('Foto'); ?></li>
			<li class="active"><a href=""><?php echo __('List'); ?></a></li>
		</ol>
	</section>
	
	<section class="content">
		<div class="box box-primary">
			<div class="box-body">
				<a href="<?php echo URL::Base(); ?>foto/new/"><button style="width:150px" class="btn btn-block btn-primary btn-sm"><?php echo __('Add New Data'); ?></button></a>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo $data['count_all'] . ' ' . __('Data'); ?></h3>
						<div class="box-tools" style="float: right;">
							<form method="post" action="<?php echo URL::Base(); ?>foto/search">
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
								<th style="width:210px;text-align:center;"><?php echo __('Image'); ?></th>
								<th style="text-align:center;"><?php echo __('Description'); ?></th>
								<th style="width:15%;text-align:center;"><?php echo __('Actions'); ?></th>
							</tr>
							<?php
							if(!empty($data['list'])) {
								foreach($data['list'] as $v_list) {
									
									$img = '<center> ' . __('[ No Image Available ]') . ' </center>';
									if(!empty($v_list['images'])) {
										$split_id = str_split($v_list['images'][0]['image_id']);
										$path_folder_image = implode('/', $split_id);
										$img = '<img src="' . URL::base() .'uploads/library/' . $path_folder_image . '/' . $v_list['images'][0]['image_id'] . '_224x153.' . $v_list['images'][0]['image_type'] . '" />';
									}
				
									echo '
										<tr>
											<td>' . $img . '</td>
											<td>
												<strong>By : </strong>' . $v_list['name_saved'] . ' </br>
												<strong>Title : </strong>' . $v_list['title'] . ' </br>
												
											</td>
											<td>
												<a href="'.URL::Base().'foto/edit/' . $v_list['id'] . '"><button class="btn btn-block btn-warning btn-xs">' . __('Edit') . '</button></a></br>
												<a href="javascript:del_confirm(' . $v_list['id'] . ')"><button class="btn btn-block btn-danger btn-xs">' . __('Delete') . '</button></a>
											</td>
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