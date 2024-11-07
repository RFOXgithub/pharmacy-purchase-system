<!DOCTYPE html>
<html lang="en">

<head>

    <!-- start: Meta -->
    <meta charset="utf-8">
    <title><?php echo $title; ?> - Toko Alat Kesehatan</title>

    <!-- start: Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- end: Mobile Specific -->

    <!-- start: CSS -->
    <link id="bootstrap-style" href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/bootstrap-responsive.min.css" rel="stylesheet">
    <link id="base-style" href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">
    <link id="base-style-responsive" href="<?php echo base_url(); ?>css/style-responsive.css" rel="stylesheet">
    <!-- end: CSS -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- start: Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>img/favicon.ico">
    <!-- end: Favicon -->

    <script src="<?php echo base_url() ?>js/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url() ?>js/jquery-migrate-1.0.0.min.js"></script>
    <script src="<?php echo base_url() ?>js/jquery-ui-1.10.0.custom.min.js"></script>
    <script src="<?php echo base_url() ?>js/jquery.ui.touch-punch.js"></script>
    <script src="<?php echo base_url() ?>js/modernizr.js"></script>
    <script src="<?php echo base_url() ?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>js/jquery.cookie.js"></script>
    <script src='<?php echo base_url() ?>js/fullcalendar.min.js'></script>
    <script src='<?php echo base_url() ?>js/jquery.dataTables.min.js'></script>
    <script src="<?php echo base_url() ?>js/excanvas.js"></script>
    <script src="<?php echo base_url() ?>js/jquery.flot.js"></script>
    <script src="<?php echo base_url() ?>js/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url() ?>js/jquery.flot.stack.js"></script>
    <script src="<?php echo base_url() ?>js/jquery.flot.resize.min.js"></script>
    <script src="<?php echo base_url() ?>js/jquery.chosen.min.js"></script>
    <script src="<?php echo base_url() ?>js/jquery.uniform.min.js"></script>
    <script src="<?php echo base_url() ?>js/jquery.cleditor.min.js"></script>
    <script src="<?php echo base_url() ?>js/jquery.noty.js"></script>
    <script src="<?php echo base_url() ?>js/jquery.elfinder.min.js"></script>
    <script src="<?php echo base_url() ?>js/jquery.raty.min.js"></script>
    <script src="<?php echo base_url() ?>js/jquery.iphone.toggle.js"></script>
    <script src="<?php echo base_url() ?>js/jquery.uploadify-3.1.min.js"></script>
    <script src="<?php echo base_url() ?>js/jquery.gritter.min.js"></script>
    <script src="<?php echo base_url() ?>js/jquery.imagesloaded.js"></script>
    <script src="<?php echo base_url() ?>js/jquery.masonry.min.js"></script>
    <script src="<?php echo base_url() ?>js/jquery.knob.modified.js"></script>
    <script src="<?php echo base_url() ?>js/jquery.sparkline.min.js"></script>
    <script src="<?php echo base_url() ?>js/counter.js"></script>
    <script src="<?php echo base_url() ?>js/retina.js"></script>
    <script src="<?php echo base_url() ?>js/custom.js"></script>
    <script src="<?php echo base_url() ?>js/script.js"></script>
    <script src="<?php echo base_url() ?>js/filter.js"></script>
    <script src="<?php echo base_url('js/modalEdit.js'); ?>" defer></script>
</head>

<body>
    <!-- start: Header -->
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>img/logo_bnsp_cutted.jpg" width="200" /></a>

                <!-- start: Header Menu -->
                <div class="nav-no-collapse header-nav">
                    <ul class="nav pull-right">
                        <!-- start: User Dropdown -->
                        <li class="dropdown">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="halflings-icon white user"></i>
                                <?php
                                $username = $this->session->userdata('username');
                                $pengguna = $this->authentication_model->dataPengguna($username);
                                echo $username ?>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-menu-title">
                                    <span>Pengaturan Akun</span>
                                </li>
                                <?php if (empty($username)) : ?>
                                    <li>
                                        <a href="<?php echo base_url('authentication/process_login'); ?>">
                                            <i class="halflings-icon lock"></i> Login
                                        </a>
                                        <a href="<?php echo base_url('authentication/register'); ?>">
                                            <i class="halflings-icon plus-sign"></i> Daftar Akun
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (!empty($username)) : ?>
                                    <li>
                                        <a href="<?php echo base_url('akses/detail/' . $this->session->userdata('username')); ?>">
                                            <i class="halflings-icon user"></i>Profile
                                        </a>
                                        <a href="<?php echo base_url('authentication/logout'); ?>">
                                            <i class="halflings-icon off"></i>Logout
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>

                    </ul>
                    </li>
                    <!-- end: User Dropdown -->
                    </ul>
                </div>
                <!-- end: Header Menu -->

            </div>
        </div>
    </div>
    <!-- start: Header -->

    <div class="container-fluid-full">
        <div class="row-fluid"></div>