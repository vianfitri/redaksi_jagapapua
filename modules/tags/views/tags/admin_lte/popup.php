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
						<h3 class="box-title"><?php echo __('List Data'); ?></h3>
						<div class="box-tools">
							<form method="post" action="">
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
							</tr>
							<?php
							if(!empty($data['list'])) {
								foreach($data['list'] as $v_list) {
									echo '<tr>
											<td><a href="javascript:paste('.$v_list['id'].')">' . $v_list['name'] . '</a></td>
										</tr>';
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
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
			function paste(id){
				//window.opener.document.location.replace("/topic/add/<?php echo $data['dom']; ?>/"+id);
				window.opener.paste("<?php echo $data['dom']; ?>/"+id);
				window.close();
			}

		</script>
