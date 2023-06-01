<!-- Content Wrapper. Contains page content -->
<?php if(empty($data['dom'])): ?>
	<div class="content-wrapper">
<?php else: ?>
	<script>
			function paste(dom_id, id){
				window.opener.document.getElementById(dom_id).value = id;
				window.opener.<?php echo $data['dom']; ?>();
				window.close();
			}

		</script>
	<div class="content-wrapper" style="margin-left: 0;">
<?php endif; ?>
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo __('Library'); ?>
		</h1>
		<?php if(!empty($data['dom'])): ?>
			<ol class="breadcrumb">
				<li><?php echo __('Media'); ?></li>
				<li class="active"><a href="<?php echo URL::Base(); ?>library"><?php echo __('Library'); ?></a></li>
			</ol>
		<?php endif; ?>
	</section>

	<section class="content">

		<div class="box box-primary">
			<div class="box-body">
				<a href="<?php echo URL::Base(); ?>library/new/<?php echo $data['page']; ?>/<?php echo $data['id']; ?>/<?php echo $data['dom']; ?>"><button style="width:150px" class="btn btn-block btn-primary btn-sm"><?php echo __('Add New Data'); ?></button></a>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo __('List Data'); ?></h3>
						<div class="box-tools">
							<form method="post">
								<div class="input-group" style="width: 150px;">
									<input type="text" name="search" class="form-control input-sm pull-right" placeholder="<?php echo __('Search'); ?>" value="<?php echo !empty($data['search']) ? $data['search'] : ''; ?>" minlength=3>
									<div class="input-group-btn">
										<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<?php echo !empty($data['pagination']) ? $data['pagination'] : ''; ?>
					<!-- /.box-header -->
					<div class="box-body">
						<table class="table table-bordered">
							<tr>
								<?php if(empty($data['dom'])): ?>
								<th><?php echo __('Title'); ?></th>
								<th><?php echo __('Image'); ?></th>
								<th><?php echo __('Caption'); ?></th>
								<th><?php echo __('Actions'); ?></th>
								<?php else: ?>
								<th></th>
								<th><?php echo __('Actions'); ?></th>
								<?php endif; ?>
							</tr>
							<?php
							if(!empty($data['list'])) {
								foreach($data['list'] as $v_list) {

									$img='';
									$img_url='';
									if(!empty($v_list['fileType'])){
										$split_id = str_split($v_list['id']);

										$title = $v_list['title'];
										$caption = $v_list['caption'];
										$caption = substr($caption, 0, 100);;

										if(!empty($data['search'])){
											$search = str_replace("'","",$data['search']);
											$search = explode(",",$search);
											foreach($search as $v ){
												$title = str_ireplace($v, "<span style='color:red;'><b><i>{$v}</i></b></span>", $title);
												$caption = str_ireplace($v, "<span style='color:red;'><b><i>{$v}</i></b></span>", $caption);
											}
										}

										if(empty($data['dom'])){

											$size='_224x153';

											$img = "<img style='width:200px;height:auto;' src='/uploads/library/".implode('/', $split_id)."/{$v_list['id']}{$size}.{$v_list['fileType']}'>";

											echo '
												<tr>
													<td>' . $title . '</td>
													<td>' . $img . '</td>
													<td>' . $caption . '</td>
													<td>
													<a href="'.URL::Base().'library/new/' . "{$data['page']}/{$v_list['id']}" . '"><button class="btn btn-block btn-warning btn-xs">' . __('Edit') . '</button></a>
													<br/>
													<a href="javascript:del_confirm(\''.URL::Base().'library/delete/'."{$data['page']}/{$v_list['id']}".'\')"><button class="btn btn-block btn-danger btn-xs">' . __('Delete') . '</button></a>
													</td>
												</tr>
											';
										}else{
											$img_url="/uploads/library/".implode('/', $split_id)."/{$v_list['id']}_224x153.{$v_list['fileType']}";
											$img_paste="{$data['options']}/library/".implode('/', $split_id)."/{$v_list['id']}.{$v_list['fileType']}";

											$img = "<a href='javascript:paste(\"{$data['dom']}\",\"{$img_paste}\")'><img style='width:200px;height:auto;' src='{$img_url}'></a>";
											$copy = '<a href="javascript:paste(\''.$data['dom'].'\', \''.$img_paste.'\')"><button class="btn btn-block btn-success btn-xs">' . __('Set as Image') . '</button></a><br/>';

											echo '
											<tr>
												<td>' . "{$title}<br/>{$img}<br/>{$caption}" . '</td>
												<td>
												'.$copy.'
												<a><button disabled="disabled" class="btn btn-block btn-warning btn-xs">' . __('Edit') . '</button></a>
												<br/>
												<a><button disabled="disabled" class="btn btn-block btn-danger btn-xs">' . __('Delete') . '</button></a>
												</td>
											</tr>';

										}


									}


								}
							}
							?>
						</table>
					</div>
					<!-- /.box-body -->
					<?php echo !empty($data['pagination']) ? $data['pagination'] : ''; ?>
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col -->
		</div>

		<div class="box box-primary">
			<div class="box-body">
				<a href="<?php echo URL::Base(); ?>library/new/<?php echo $data['page']; ?>/<?php echo $data['id']; ?>/<?php echo $data['dom']; ?>"><button style="width:150px" class="btn btn-block btn-primary btn-sm"><?php echo __('Add New Data'); ?></button></a>
			</div>
		</div>

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
