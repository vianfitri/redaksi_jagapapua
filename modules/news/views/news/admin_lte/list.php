<div class="content-wrapper">
	<section class="content-header">
		<h1>
			<?php echo __('List Article'); ?>
		</h1>
		<ol class="breadcrumb">
			<li><?php echo __('Newsroom'); ?></li>
			<li class="active"><a href="/news"><?php echo __('News'); ?></a></li>
		</ol>
	</section>
	
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-body">
						<div class="form-group">
							<form method="post" id="publishForm">
								<label>Range 
									<select name="publisher" onChange="document.getElementById('publishForm').submit();">
										<option value="newsPublishTime" <?php echo ($data['publish']!='newsPublishTime'?'':'selected'); ?>>Publish</option>
										<option value="newsSaved" <?php echo ($data['publish']!='newsSaved'?'':'selected'); ?>>Saved</option>
									</select> Date
								</label>
							</form>
							
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" name="date_range" required value="<?php echo !empty($_GET['date_range']) ? $_GET['date_range'] : '2001/01/01' . ' - ' . date('d/m/Y') ; ?>" class="form-control pull-right" id="reservation">
							</div>
							<br/>
							<form method="post" id="catForm">
								<?php echo News::select_list('category', 1, @$data['category'], "onChange=document.getElementById('catForm').submit();", 'lite'); ?>
							</form>
						</div>
					</div>
					<div class="box-body">
						<a href="<?php echo URL::base(); ?>news/new"><button type="button" style="width:150px" class="btn btn-success btn-sm"><?php echo __('Add New Data'); ?></button></a>
					</div>
				</div>
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo $data['count_all'] . ' ' . __('Data Found'); ?></h3>
						<div class="box-tools" style="float: right;">
							<form method="post" action="<?php echo URL::Base(); ?>news/search?date_range=<?php echo !empty($data['date_range']) ? $data['date_range'] : ''; ?>">
								<div class="input-group" style="width: 150px;">
									<input type="text" name="search" class="form-control input-sm pull-right" placeholder="<?php echo __('Search'); ?>" value="<?php echo !empty($data['search']) ? $data['search'] : ''; ?>">
									<div class="input-group-btn">
										<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<?php 
					echo !empty($data['pagination']) ? $data['pagination'] : '';
					if($data['version']=='lite'){
						include('lite_template.php');
					}else{
						include('full_template.php');
					}
					echo !empty($data['pagination']) ? $data['pagination'] : ''; 
					?>
				</div>
			</div>
		</div>
	</section>
</div>
