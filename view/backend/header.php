<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="<?php echo get_directory(dirname(__FILE__),'assets/');?>images/favicon_1.ico">

    <title><?=title();?></title>
    
        <!-- Sweet Alert -->
        <link href="<?php echo get_directory(dirname(__FILE__),'assets/');?>plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">

        <link href="<?php echo get_directory(dirname(__FILE__),'assets/');?>css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo get_directory(dirname(__FILE__),'assets/');?>css/core.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo get_directory(dirname(__FILE__),'assets/');?>css/components.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo get_directory(dirname(__FILE__),'assets/');?>css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo get_directory(dirname(__FILE__),'assets/');?>css/pages.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo get_directory(dirname(__FILE__),'assets/');?>css/responsive.css" rel="stylesheet" type="text/css" />

        <!--datepicker css-->
        <link href="<?php echo get_directory(dirname(__FILE__),'assets/');?>plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

        <!-- X-editable css -->
        <link type="text/css" href="<?php echo get_directory(dirname(__FILE__),'assets/');?>plugins/x-editable/css/bootstrap-editable.css" rel="stylesheet">

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="<?php echo get_directory(dirname(__FILE__),'assets/');?>js/modernizr.min.js"></script>
<script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','../../../www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-69506598-1', 'auto');
          ga('send', 'pageview');
</script>
</head>

  <body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="<?=set_url('dashboard');?>" class="logo"><span>Inventaris</span></a>
                    </div>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <button class="button-menu-mobile open-left waves-effect waves-light">
                                    <i class="md md-menu"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>

                            <ul class="nav navbar-nav hidden-xs">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown"
                                       role="button" aria-haspopup="true" aria-expanded="false">Pintas<span
                                            class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?=set_url('barang#tambah');?>">Tambah Barang</a></li>
                                        <li><a href="<?=set_url('keluar/riwayat');?>">Riwayat Barang Keluar</a></li>
                                        <li><a href="<?=set_url('kerusakan/riwayat');?>">Riwayat Kerusakan</a></li>
                                    </ul>
                                </li>
                            </ul>

                            <ul class="nav navbar-nav navbar-right pull-right">
                                <li class="hidden-xs">
                                    <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="icon-size-fullscreen"></i></a>
                                </li>
                                <li class="dropdown top-menu-item-xs">
                                    <a href="#" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><img src="<?php echo get_directory(dirname(__FILE__),'assets/');?>img/logo.png" class="img-circle"></a>
                                    <ul class="dropdown-menu">
                                        <li><a><i class="ti-user m-r-10 text-custom"></i><?=get_user_info('nama_user');?></a></li>
                                        <li><a href="<?=set_url('user#edit?id='.get_user_info('id_user'));?>"><i class="ti-user m-r-10 text-custom"></i>Setting Akun</a></li>
                                        <li><a href="<?=set_url('logout');?>"><i class="ti-power-off m-r-10 text-danger"></i> Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->

            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>

                          <li class="text-muted menu-title">Menu</li>

                            <li class="has_sub">
                                <a href="<?=set_url('dashboard');?>" class="waves-effect"><i class="ti-home"></i> <span> Halaman Utama </span></a>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-pencil-alt"></i><span> Menu Barang </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="<?=set_url('barang/jenis');?>">Jenis Barang</a></li>
                                    <li><a href="<?=set_url('barang');?>">Data Barang</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-menu-alt"></i><span> Master Data </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="<?=set_url('user');?>">User</a></li>
                                    <li><a href="<?=set_url('witel');?>">Witel & Datel</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-menu-alt"></i><span> Manajemen Barang </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="<?=set_url('keluar');?>">Barang Keluar</a></li>
                                    <li><a href="<?=set_url('kerusakan');?>">Kerusakan Barang</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-files"></i><span> Riwayat </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="<?=set_url('keluar/riwayat');?>">Riwayat Barang Keluar</a></li>
                                    <li><a href="<?=set_url('kerusakan/riwayat');?>">Riwayat Kerusakan</a></li>
                                </ul>
                            </li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
      <!-- Left Sidebar End -->

      <!-- ============================================================== -->
      <!-- Start right Content here -->
      <!-- ============================================================== -->
      <div class="content-page">