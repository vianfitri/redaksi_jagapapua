<!DOCTYPE html>
<html>
	<!-- interesting with this code? ---- syempunaatgmaildotcom --- -->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<META NAME="robots" CONTENT="noindex,nofollow">
		<title><?php echo !empty($main_title) ? $main_title : __('Dashboard'); ?></title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.5 -->
		<link rel="stylesheet" href="<?php echo URL::base(); ?>assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo URL::base(); ?>assets/plugins/datepicker/datepicker3.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="<?php echo URL::base(); ?>assets/dist/css/AdminLTE.min.css">
		<!-- AdminLTE Skins. Choose a skin from the css/skins
			folder instead of downloading all of them to reduce the load. -->
		<link rel="stylesheet" href="<?php echo URL::base(); ?>assets/dist/css/skins/_all-skins.min.css">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<link rel="shortcut icon" href="<?php echo URL::base(); ?>assets/favicon.ico" type="image/x-icon" />
		<?php echo $custom_header; ?>

	</head>
	<body class="hold-transition skin-blue sidebar-mini fixed">
		<!-- Site wrapper -->
		<div class="wrapper">
			<header class="main-header">
				<!-- Logo -->
				<a href="/" class="logo">
					<!-- mini logo for sidebar mini 50x50 pixels -->
					<span class="logo-mini"><b><?php echo __('CMS'); ?></b></span>
					<!-- logo for regular state and mobile devices -->
					<span class="logo-lg"><b><?php echo __('CMS'); ?></b></span>
				</a>
				<!-- Header Navbar: style can be found in header.less -->
				<nav class="navbar navbar-static-top" role="navigation">
					<!-- Sidebar toggle button-->
					<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</a>
				</nav>
			</header>
			<!-- =============================================== -->
			<!-- Left side column. contains the sidebar -->
			<aside class="main-sidebar">
				<!-- sidebar: style can be found in sidebar.less -->
				<section class="sidebar">
					<div class="user-panel">
						<div class="pull-left image">
							<?php
							$user_avatar = URL::base().'assets/images/user/default.png';
							if(!empty($user_detail['userAvatar'])) {
								$user_avatar = $user_detail['userAvatar'];
							}
							?>
							<img src="<?php echo $user_avatar; ?>" class="img-circle" alt="User Image">
						</div>
						<div class="pull-left info">
							<p><?php echo $user_detail['userRealName'] ?></p>
							<span><?php echo $user_detail['userEmail'] ?></span>
						</div>
					</div>
					<!-- Sidebar user panel -->
					<ul class="sidebar-menu">
						<li class="header"><?php echo __('MAIN NAVIGATION'); ?></li>
						<li class="treeview <?php echo ($menu_active == 'dashboard') ? 'active' : ''; ?>">
							<a href="<?php echo URL::base(); ?>home">
								<i class="fa fa-dashboard"></i> <span><?php echo __('Dashboard'); ?></span>
							</a>
						</li>
                        
                        <li class="treeview <?php echo ($menu_active == 'livestream') ? 'active' : ''; ?>">
							<a href="">
								<i class="fa fa-film"></i> <span><?php echo __('Live Stream'); ?></span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
									<li class="treeview <?php echo ($menu_active_child == 'list') ? 'active' : ''; ?>">
										<a href="<?php echo URL::base(); ?>livestream/list">
											<i class="fa fa-circle-o"></i>
											<span><?php echo __('List'); ?></span>
										</a>
									</li>

									<li class="treeview <?php echo ($menu_active_child == 'add') ? 'active' : ''; ?>">
											<a href="<?php echo URL::base(); ?>livestream/new"><i class="fa fa-circle-o"></i> Add New</a>
									</li>
							</ul>
						</li>
						
						
						
						
						<li class="treeview <?php echo ($menu_active == 'newsroom') ? 'active' : ''; ?>">
							<a href="">
								<i class="fa fa-newspaper-o"></i> <span><?php echo __('News'); ?></span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li class="treeview <?php echo ($menu_active_child == 'article') ? 'active' : ''; ?>">
									<a href="#">
										<i class="fa fa-circle-o"></i>
										<span><?php echo __('Article'); ?></span>
										<i class="fa fa-angle-left pull-right"></i>
									</a>
									<ul class="treeview-menu">
										<li class="treeview <?php echo ($menu_active_child_1 == 'list') ? 'active' : ''; ?>">
											<a href="<?php echo URL::base(); ?>news/search"><i class="fa fa-circle-o"></i> List</a>
										</li>
										<li class="treeview <?php echo ($menu_active_child_1 == 'add') ? 'active' : ''; ?>">
											<a href="<?php echo URL::base(); ?>news/new"><i class="fa fa-circle-o"></i> Add New</a>
										</li>
										<!--<li class="treeview <?php echo ($menu_active_child_1 == 'approve') ? 'active' : ''; ?>">
											<a href="<?php echo URL::base(); ?>news/listapprove"><i class="fa fa-circle-o"></i> CJ</a>
										</li>-->
									</ul>
								</li>
							</ul>
						</li>

						<li class="treeview <?php echo ($menu_active == 'foto') ? 'active' : ''; ?>">
							<a href="">
								<i class="fa fa-file-image-o"></i> <span><?php echo __('Foto'); ?></span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
									<li class="treeview <?php echo ($menu_active_child == 'list') ? 'active' : ''; ?>">
										<a href="<?php echo URL::base(); ?>foto/list">
											<i class="fa fa-circle-o"></i>
											<span><?php echo __('List'); ?></span>
										</a>
									</li>

									<li class="treeview <?php echo ($menu_active_child == 'add') ? 'active' : ''; ?>">
											<a href="<?php echo URL::base(); ?>foto/new"><i class="fa fa-circle-o"></i> Add New</a>
									</li>
							</ul>
						</li>

                        <!--
						<li class="treeview <?php echo ($menu_active == 'slider') ? 'active' : ''; ?>">
							<a href="">
								<i class="fa fa-slideshare"></i> <span><?php echo __('Slider'); ?></span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
									<li class="treeview <?php echo ($menu_active_child == 'list') ? 'active' : ''; ?>">
										<a href="<?php echo URL::base(); ?>slider/list">
											<i class="fa fa-circle-o"></i>
											<span><?php echo __('List'); ?></span>
										</a>
									</li>

									<li class="treeview <?php echo ($menu_active_child == 'add') ? 'active' : ''; ?>">
											<a href="<?php echo URL::base(); ?>slider/new"><i class="fa fa-circle-o"></i> Add New</a>
									</li>
							</ul>
						</li>
                        -->
                        
                        <li class="treeview <?php echo ($menu_active == 'headline') ? 'active' : ''; ?>">
							<a href="">
								<i class="fa fa-slideshare"></i> <span><?php echo __('Headline'); ?></span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
									<li class="treeview <?php echo ($menu_active_child == 'list') ? 'active' : ''; ?>">
										<a href="<?php echo URL::base(); ?>headline">
											<i class="fa fa-circle-o"></i>
											<span><?php echo __('List'); ?></span>
										</a>
									</li>
							</ul>
						</li>


						<li class="treeview <?php echo ($menu_active == 'media') ? 'active' : ''; ?>">
							<a href="">
								<i class="fa fa-keyboard-o"></i> <span><?php echo __('Tools'); ?></span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li class="treeview <?php echo ($menu_active_child == 'library') ? 'active' : ''; ?>">
									<a href="#">
										<i class="fa fa-circle-o"></i>
										<span><?php echo __('Library'); ?></span>
										<i class="fa fa-angle-left pull-right"></i>
									</a>
									<ul class="treeview-menu menu-open">
										<li class="treeview <?php echo ($menu_active_child_1 == 'list') ? 'active' : ''; ?>">
											<a href="<?php echo URL::base(); ?>library/index"><i class="fa fa-circle-o"></i> List</a>
										</li>
										<li class="treeview <?php echo ($menu_active_child_1 == 'add') ? 'active' : ''; ?>">
											<a href="<?php echo URL::base(); ?>library/new"><i class="fa fa-circle-o"></i> Add New</a>
										</li>
									</ul>
								</li>
								<li class="treeview <?php echo ($menu_active_child == 'mascat') ? 'active' : ''; ?>">
									<a href="#">
										<i class="fa fa-circle-o"></i>
										<span><?php echo __('Master Category'); ?></span>
										<i class="fa fa-angle-left pull-right"></i>
									</a>
									<ul class="treeview-menu menu-open">
										<li class="treeview <?php echo ($menu_active_child_1 == 'list') ? 'active' : ''; ?>">
											<a href="<?php echo URL::base(); ?>mascat/list"><i class="fa fa-circle-o"></i> List</a>
										</li>
										<li class="treeview <?php echo ($menu_active_child_1 == 'add') ? 'active' : ''; ?>">
											<a href="<?php echo URL::base(); ?>mascat/new"><i class="fa fa-circle-o"></i> Add New</a>
										</li>
									</ul>
								</li>
                                <li class="treeview <?php echo ($menu_active_child == 'tags') ? 'active' : ''; ?>">
									<a href="#">
										<i class="fa fa-circle-o"></i>
										<span><?php echo __('Master Tags'); ?></span>
										<i class="fa fa-angle-left pull-right"></i>
									</a>
									<ul class="treeview-menu menu-open">
										<li class="treeview <?php echo ($menu_active_child_1 == 'list') ? 'active' : ''; ?>">
											<a href="<?php echo URL::base(); ?>tags"><i class="fa fa-circle-o"></i> List</a>
										</li>
										<li class="treeview <?php echo ($menu_active_child_1 == 'add') ? 'active' : ''; ?>">
											<a href="<?php echo URL::base(); ?>tags/new"><i class="fa fa-circle-o"></i> Add New</a>
										</li>
									</ul>
								</li>
							</ul>
						</li>
						<li class="treeview <?php echo ($menu_active == 'users') ? 'active' : ''; ?>">
							<a href="">
								<i class="fa fa-user"></i> <span><?php echo __('User'); ?></span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li class="treeview <?php echo ($menu_active_child == 'list') ? 'active' : ''; ?>">
									<a href="<?php echo URL::base(); ?>users/list">
										<i class="fa fa-circle-o"></i>
										<span><?php echo __('List'); ?></span>
									</a>
								</li>
								<li class="treeview <?php echo ($menu_active_child == 'new') ? 'active' : ''; ?>">
									<a href="<?php echo URL::base(); ?>users/new">
										<i class="fa fa-circle-o"></i>
										<span><?php echo __('New'); ?></span>
									</a>
								</li>
							</ul>
						</li>

						<li><a href="<?php echo URL::base(); ?>login/logout"><i class="fa fa-sign-out"></i> <span><?php echo __('Log Out'); ?></span></a></li>
					</ul>
				</section>
				<!-- /.sidebar -->
			</aside>
			<!-- =============================================== -->
			<?php echo $content; ?>
			<footer class="main-footer">
				<div class="pull-right hidden-xs">
					<b>Version</b> Beta
				</div>
				<strong>Copyright &copy; <?php echo date('Y'); ?> <a href="http://jagapapua.com">PT. MEDIA JAGA PAPUA</a>.</strong> All rights reserved.
			</footer>
		</div>
		<!-- ./wrapper -->
		<!-- jQuery 2.1.4 -->
		<script src="<?php echo URL::base(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
		<!-- Bootstrap 3.3.5 -->
		<script src="<?php echo URL::base(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
		<!-- SlimScroll -->
		<script src="<?php echo URL::base(); ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
		<!-- FastClick -->
		<script src="<?php echo URL::base(); ?>assets/plugins/fastclick/fastclick.min.js"></script>
		<!-- AdminLTE App -->
		<script src="<?php echo URL::base(); ?>assets/dist/js/app.min.js"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="<?php echo URL::base(); ?>assets/dist/js/demo.js"></script>
		<script src="<?php echo URL::base(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>

		<script>
			function PopupCenter(url, title, w, h) {
				// Fixes dual-screen position                         Most browsers      Firefox
				var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
				var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

				width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
				height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

				var left = ((width / 2) - (w / 2)) + dualScreenLeft;
				var top = ((height / 2) - (h / 2)) + dualScreenTop;
				var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

				// Puts focus on the newWindow
				if (window.focus) {
					newWindow.focus();
				}
			}

			document.addEventListener("DOMContentLoaded", function() {
				var elements = document.getElementsByTagName("INPUT");
				for (var i = 0; i < elements.length; i++) {
					elements[i].oninvalid = function(e) {
						e.target.setCustomValidity("");
						if (!e.target.validity.valid) {
							e.target.setCustomValidity("Tidak boleh kosong, Harus diisi");
						}
						if(e.target.validity.tooShort) {
							e.target.setCustomValidity("Karakter Terlalu Sedikit, Minimal " + e.target['minLength'] +  " Karakter");
						}
					};
					elements[i].oninput = function(e) {
						e.target.setCustomValidity("");
					};
				}

				var elements2 = document.getElementsByTagName("SELECT");
				for (var i = 0; i < elements2.length; i++) {
					elements2[i].oninvalid = function(e) {
						e.target.setCustomValidity("");
						if (!e.target.validity.valid) {
							e.target.setCustomValidity("Harus Dipilih");
						}
					};
					elements2[i].oninput = function(e) {
						e.target.setCustomValidity("");
					};
				}
			})

			$('.amount').keydown(function (e) {
				// Allow: backspace, delete, tab, escape, enter and .
				if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
					// Allow: Ctrl+A
					(e.keyCode == 65 && e.ctrlKey === true) ||
					// Allow: Ctrl+C
					(e.keyCode == 67 && e.ctrlKey === true) ||
					// Allow: Ctrl+X
					(e.keyCode == 88 && e.ctrlKey === true) ||
					// Allow: home, end, left, right
					(e.keyCode >= 35 && e.keyCode <= 39)) {
						// let it happen, don't do anything
						return;
				}
				// Ensure that it is a number and stop the keypress
				if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
					e.preventDefault();
				}
			});
			$('.amount').keyup(function(event) {
			// skip for arrow keys
			if(event.which >= 37 && event.which <= 40){
				event.preventDefault();
			}

			$(this).val(function(index, value) {
				return value
					.replace(/\D/g, '')
					//.replace(/([0-9])([0-9]{2})$/, '$1.$2')
					.replace(/\B(?=(\d{3})+(?!\d)\.?)/g, '.')
				;
				});
			});

		</script>

		<?php echo $custom_footer; ?>
	</body>
</html>
