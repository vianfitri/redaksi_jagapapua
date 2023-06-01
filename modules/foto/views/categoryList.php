<div class="content-wrapper">
	<section class="content-header">
		<h1>
			<?php echo __($data['main_title']); ?>
		</h1>
	</section>
	
	<section class="content">
		<div class="box box-solid">
			<div class="box-body">
				<a href="<?php echo URL::Base(); ?>ecommerce/category/new/"><button style="width:150px" class="btn btn-block btn-primary btn-sm"><?php echo __('Add New Data'); ?></button></a>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-solid">
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo $data['count_all'] . ' ' . __('Data'); ?></h3>
						<div class="box-tools" style="float: right;">
							<form method="post" action="<?php echo URL::Base(); ?>ecommerce/category/search">
								<div class="input-group" style="width: 150px;">
									<input type="text" name="search" class="form-control input-sm pull-right" placeholder="<?php echo __('Search'); ?>" value="<?php echo !empty($data['search']) ? $data['search'] : ''; ?>">
									<div class="input-group-btn">
										<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="box-body">
						<table class="table table-bordered">
							<tr>
								<th style="text-align:center;"><?php echo __('Name'); ?></th>
								<th style="width: 20%;text-align:center;" colspan="2"><?php echo __('Actions'); ?></th>
							</tr>
							<?php
							if(!empty($data['list'])) {
								foreach($data['list'] as $v_list) {
									
									echo '
										<tr>
											<td>' . $v_list['name'] . '</td>
											<td>
												<a href="'.URL::Base().'ecommerce/category/edit/' . $v_list['id'] . '"><button class="btn btn-block btn-warning btn-xs">' . __('Edit') . '</button></a>
											</td>
											<td>
												<a href="javascript:del_category_confirm(' . $v_list['id'] . ')"><button class="btn btn-block btn-danger btn-xs">' . __('Delete') . '</button></a>
											</td>
										</tr>
									';
								}
							}
							?>
						</table>
					</div>
					<?php echo !empty($data['pagination']) ? $data['pagination'] : ''; ?>
				</div>
			</div>
		</div>
	</section>
</div>