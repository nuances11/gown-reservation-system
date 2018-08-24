<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $title ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/_all-skins.min.css">

	<!-- Date Picker -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-datepicker.min.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/daterangepicker.css">
	<!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap3-wysihtml5.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/toastr.min.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">

    <?php if(isset($additional_css)) : ?>
        <?php foreach($additional_css as $css): ?>
            <link rel="stylesheet" href="<?php echo base_url() . $css ;?>">
        <?php endforeach; ?>
    <?php endif; ?>

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini wysihtml5-supported fixed">
	<div class="wrapper">

		<header class="main-header">
			<!-- Logo -->
			<a href="index2.html" class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini">
					<b>C</b>M</span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg">
					<b>CMOG</b>RMS</span>
			</a>
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>
			</nav>
		</header>
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<!-- Sidebar user panel -->
				<div class="user-panel">
					<div class="pull-left image">
						<img src="<?php echo base_url(); ?>assets/img/user2-160x160.jpg" class="img-circle" alt="User Image">
					</div>
					<div class="pull-left info">
						<p>Casa Moda</p>
						<a href="#">
							<i class="fa fa-circle text-success"></i> Admin</a>
					</div>
				</div>
				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu" data-widget="tree">
					<li class="header">MAIN NAVIGATION</li>
					<li>
						<a href="<?php echo BASE_URL() ;?>products">
							<i class="fa fa-th"></i>
							<span>Products</span>
							<span class="pull-right-container">
								<span class="label label-default pull-right">4</span>
							</span>
						</a>
					</li>
					<li>
						<a href="<?php echo BASE_URL() ;?>categories">
							<i class="fa fa-files-o"></i>
							<span>Categories</span>
							<span class="pull-right-container">
								<span class="label label-default pull-right">4</span>
							</span>
						</a>
					</li>
					<li>
						<a href="#">
							<i class="fa fa-laptop"></i>
							<span>Transactions</span>
							<span class="pull-right-container">
								<span class="label label-default pull-right">4</span>
							</span>
						</a>
					</li>
					<li>
						<a href="<?php echo BASE_URL() ;?>users">
							<i class="fa fa-users"></i>
							<span>Users</span>
							<span class="pull-right-container">
								<span class="label label-default pull-right">4</span>
							</span>
						</a>
					</li>
					<li>
						<a href="<?php echo BASE_URL() ;?>packages">
							<i class="fa fa-gift"></i>
							<span>Packages</span>
							<span class="pull-right-container">
								<span class="label label-default pull-right">4</span>
							</span>
						</a>
					</li>
					<li class="header">SIGNOUT</li>
					<li>
						<a href="#">
							<i class="fa fa-sign-out"></i>
							<span>Signout</span>
							<span class="pull-right-container">
								<span class="label label-default pull-right">4</span>
							</span>
						</a>
					</li>
				</ul>
			</section>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
            <?php echo $content ?>
		</div>
		<!-- /.content-wrapper -->
		<!-- <footer class="main-footer">
			<strong>Copyright &copy; 2018 -
				<a href="#">CASA MODA</a></strong> Online Gown Rental Management System
		</footer> -->
		<!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
		<div class="control-sidebar-bg"></div>
	</div>
	<!-- ./wrapper -->

	<!-- jQuery 3 -->
	<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
		$.widget.bridge('uibutton', $.ui.button);

	</script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<!-- Sparkline -->
	<script src="<?php echo base_url(); ?>assets/js/jquery.sparkline.min.js"></script>
	<!-- daterangepicker -->
	<script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/daterangepicker.js"></script>
	<!-- datepicker -->
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.min.js"></script>
	<!-- Bootstrap WYSIHTML5 -->
	<script src="<?php echo base_url(); ?>assets/js/bootstrap3-wysihtml5.all.min.js"></script>
	<!-- Slimscroll -->
	<script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.min.js"></script>
	<!-- FastClick -->
	<script src="<?php echo base_url(); ?>assets/js/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url(); ?>assets/js/adminlte.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootbox.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/toastr.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>

    <!-- Additional Scripts -->
    <?php if(isset($add_js)) : ?>
		<?php foreach($add_js as $js): ?>
            <script src="<?php echo base_url() . $js; ?>"></script>
        <?php endforeach; ?>
	<?php endif; ?>

    <?php if(isset($extra_js)) : ?>
        <script><?php echo $extra_js; ?></script>
    <?php endif; ?>
</body>

</html>
