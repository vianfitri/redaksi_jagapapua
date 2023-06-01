<!DOCTYPE html>
<html>
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
					<span class="logo-mini"><b><?php echo __('BRI'); ?></b></span>
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
					<!-- Sidebar user panel -->
					<ul class="sidebar-menu">
						<li class="header"><?php echo __('MAIN NAVIGATION'); ?></li>
						<li class="treeview <?php echo ($menu_active == 'dashboard') ? 'active' : ''; ?>">
							<a href="<?php echo URL::base(); ?>home">
								<i class="fa fa-dashboard"></i> <span><?php echo __('Dashboard'); ?></span>
							</a>
						</li>
						<li class="treeview <?php echo ($menu_active == 'comm') ? 'active' : ''; ?>">
							<a href="">
								<i class="fa fa-group"></i> <span><?php echo __('Community'); ?></span>
							</a>
							<ul class="treeview-menu">
								<li class="treeview <?php echo ($menu_active_child == 'list') ? 'active' : ''; ?>">
									<a href="<?php echo URL::base(); ?>comm/list">
										<i class="fa fa-circle-o"></i>
										<span><?php echo __('List'); ?></span>
									</a>
								</li>
								<li class="treeview <?php echo ($menu_active_child == 'new') ? 'active' : ''; ?>">
									<a href="<?php echo URL::base(); ?>comm/new">
										<i class="fa fa-circle-o"></i>
										<span><?php echo __('New'); ?></span>
									</a>
								</li>
								<li class="treeview <?php echo ($menu_active_child == 'wait') ? 'active' : ''; ?>">
									<a href="<?php echo URL::base(); ?>comm/listwaiting">
										<i class="fa fa-circle-o"></i>
										<span><?php echo __('Waiting'); ?></span>
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
					<b>Version</b> Public Tester
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
			
		</script>
		<?php echo $custom_footer; ?>
	</body>
</html>
