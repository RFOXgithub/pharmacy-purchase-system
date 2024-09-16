<!DOCTYPE html>
<html lang="en">

<head>

	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Login - Fasilkom Asset Inventory Management</title>
	<meta name="description" content="Fasilkom Asset Inventory Management">
	<meta name="author" content="Budi Mukhamad Mulyo">
	<meta name="keyword" content="Fasilkom, asset inventory, asset tracking">
	<!-- end: Meta -->

	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->

	<!-- start: CSS -->
	<link id="bootstrap-style" href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="<?php echo base_url(); ?>css/style-responsive.css" rel="stylesheet">
	<link href='<?php echo base_url(); ?>css/fontgoogle.css' rel='stylesheet' type='text/css'>
	<!-- end: CSS -->

	<!-- start: Favicon -->
	<link rel="shortcut icon" href="<?php echo base_url(); ?>img/favicon.ico">
	<!-- end: Favicon -->

	<style type="text/css">
		body {
			background: url(<?php echo base_url(); ?>img/bg-login.jpg) !important;
		}

		.h1 {
			font-size: 18px;
			font-family: verdana;
			font-style: oblique;
			color: #666666
		}
	</style>



</head>

<body>
	<div class="container-fluid-full">
		<div class="row-fluid">

			<div class="row-fluid">
				<div class="login-box">
					<div class="icons">
						<a href="<?php echo base_url(); ?>"><i class="halflings-icon home"></i></a>

					</div>
					<div align="center">
						<img src="<?php echo base_url(); ?>img/logo_bnsp.jpg" height="150" width="200">
						<br><br>
						<h1 class="h1">Selamat Datang di Toko Alat Kesehatan</h1>
					</div>

					<?php echo form_open('login/process_login'); ?>

					<?php
					$message = $this->session->flashdata('message');
					echo $message == '' ? '' : '<p id="message">' . $message . '</p>';
					?>

					<div class="input-prepend" title="Username">
						<span class="add-on"><i class="halflings-icon user"></i></span>
						<input class="input-large span10" name="nik" id="username" type="text" placeholder="NIK" style="font-color:black !important;color:black !important;" />
					</div>

					<div class="input-prepend" title="Password">
						<span class="add-on"><i class="halflings-icon lock"></i></span>
						<input class="input-large span10" name="password" id="password" type="password" placeholder="Password" style="font-color:black !important;color:black !important;" />
					</div>
					<div class="clearfix"></div>

					<div class="button-login">
						<button type="submit" class="btn btn-primary">Login</button>
					</div>

					<div class="clearfix"></div>
					<?php echo form_close(); ?>
				</div>
				<!--/span-->
			</div>
			<!--/row-->


		</div>
		<!--/.fluid-container-->

	</div>
	<!--/fluid-row-->
	<div class="common-modal modal fade" id="common-Modal1" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-content">
			<ul class="list-inline item-details">
				<li><a href="http://themifycloud.com">Admin templates</a></li>
				<li><a href="http://themescloud.org">Bootstrap themes</a></li>
			</ul>
		</div>
	</div>
	<!-- start: JavaScript-->

	<script src="<?php echo base_url(); ?>js/jquery-1.9.1.min.js"></script>
	<!-- end: JavaScript-->

</body>

</html>