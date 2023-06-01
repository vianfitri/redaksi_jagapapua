<div class="content-wrapper">
	<section class="content-header">
		<h1>
			<?php echo __('Home'); ?>
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3><?php echo $data['news']; ?></h3>
						<p>Article</p>
					</div>
					<div class="icon">
						<i class="fa fa-newspaper-o"></i>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-green">
					<div class="inner">
						<h3><?php echo $data['foto']; ?></h3>
						<p>Foto</p>
					</div>
					<div class="icon">
						<i class="fa fa-photo"></i>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3><?php echo $data['library']; ?></h3>
						<p>Library</p>
					</div>
					<div class="icon">
						<i class="fa fa-keyboard-o"></i>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-red">
					<div class="inner">
						<h3><?php echo $data['users']; ?></h3>
						<p>User</p>
					</div>
					<div class="icon">
						<i class="fa fa-user"></i>
					</div>
				</div>
			</div>

		</div>
	</section>
</div>
