<!DOCTYPE html>
<html>
<?php $INFO=AUTHORITY::validateKey(KEY_INFO); ?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $INFO['data']->nama_toko ?> | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/Ionicons/css/ionicons.min.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/select2/dist/css/select2.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/skins/_all-skins.min.css" />
    <link async rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/plugins/sweetalert/sweetalert.css">
    <script src="<?php echo base_url() ?>assets/plugins/sweetalert/sweetalert.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery/css/jquery-ui.css">
    <script src="<?php echo base_url() ?>assets/bower_components/jquery/dist/jquery.js"></script>
    <script src="<?php echo base_url() ?>assets/jquery/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url() ?>assets/jquery/js/jquery-ui.min.js"></script>
    <!--link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/editor.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/timepicker/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/morris.js/morris.css"-->
    <!-- jvectormap -->
    <!--link rel="stylesheet" href="<?php // base_url() 
                                    ?>assets/bower_components/jvectormap/jquery-jvectormap.css"-->
    <!--link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"-->
    <!-- Daterange picker -->
    <!--link rel="stylesheet" href="<?php // base_url() 
                                    ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css"-->
    <!-- bootstrap wysihtml5 - text editor -->
    <!--link rel="stylesheet" href="<?= base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"-->
    <style type="text/css">
        .must {
            color: red;
        }
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="<?= base_url() ?>assets/https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="<?= base_url() ?>assets/https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <!--link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"-->
    <!--script src="<?= base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script-->
    <!-- jQuery UI 1.11.4 -->
    <!--script src="<?php echo base_url() ?>assets/jquery/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url() ?>assets/jquery/js/jquery-ui.min.js"></script>
    <script src="<?= base_url() ?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery/css/jquery-ui.css"-->
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        var base_url = "<?= base_url() ?>";
    </script>
</head>

<body class="hold-transition skin-green-light sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="<?= base_url() . "dasboard"; ?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>POS</b>APP</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b><?= $INFO['data']->app_name ?></b>App</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="assets/#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        <li class="dropdown user user-menu">
                            <a href="assets/#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?= base_url() ?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?= $this->session->userdata('nama_lengkap') ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?= base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                                    <p>
                                        <?= $this->session->userdata('nama_lengkap') ?>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?= base_url() . "auth/log_out" ?>" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->
                        <li>
                            <a href="assets/#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?= base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><?= $this->session->userdata('nama') ?></p>
                        <a href="/#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <!-- search form -->
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">

                    <li class="header">MAIN NAVIGATION <?php //echo $indukid 
                                                        ?></li>
                    <?php if (!empty($menu)) echo $menu; ?>

                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Dashboard
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <?php //if (!empty($content)) echo $content 
                        ?>
                        <?php
                        $error = $this->session->flashdata('error');
                        if (!empty($error)) {
                            if (is_array($error)) {
                                foreach ($error as $key => $value) {
                        ?>
                                    <div class="alert alert-error">
                                        <h4><i class="icon fa fa-ban"></i> Error</h4>
                                        <p>
                                            <?php
                                            $err = $error[$key];
                                            if (is_array($err)) {
                                                foreach ($err as $e) {
                                                    echo $e;
                                                }
                                            } else {
                                                echo $error[$key];
                                            }

                                            ?>

                                        </p>
                                    </div>
                                <?php
                                }
                                //echo "<p align='center'><span class='btn btn-sq btn-danger'>" .$error[$key] ."</p></span>";
                            } else {
                                ?>
                                <div class="alert alert-error">
                                    <h4><i class="icon fa fa-ban"></i> Error</h4>
                                    <p><?php echo $error; ?></p>
                                </div>
                                <?php
                            }
                        }

                        $warning = $this->session->flashdata('warning');
                        if (!empty($warning)) {
                            if (is_array($error)) {
                                foreach ($warning as $key => $value) {
                                ?>
                                    <div class="alert alert-warning">
                                        <h4><i class="icon fa fa-ban"></i> Warning</h4>
                                        <p><?php echo $warning[$key] ?></p>
                                    </div>
                                <?php
                                    //echo "<p align='center'><span class='btn btn-sq btn-danger'>" .$error[$key] ."</p></span>";
                                }
                            } else {
                                ?>
                                <div class="alert alert-warning">
                                    <h4><i class="icon fa fa-ban"></i> Warning</h4>
                                    <p><?php echo $warning; ?></p>
                                </div>
                        <?php
                            }
                        }

                        ?>

                        <?php
                        $success = $this->session->flashdata('message');
                        if (!empty($success)) {
                            if (is_array($success)) {
                                foreach ($success as $key => $value) {
                        ?>
                                    <div class="alert alert-success">
                                        <h4><i class="fa fa-thumbs-up"></i>Success</h4>
                                        <p><?php echo $success[$key] ?></p>
                                    </div>
                                <?php
                                }
                            } else {
                                ?>
                                <div class="alert alert-success">
                                    <h4><i class="fa fa-thumbs-up"></i>Success</h4>
                                    <p><?php echo $success; ?></p>
                                </div>
                        <?php
                            }
                        }
                        ?>
                        <?php
                        echo $content;
                        ?>
                    </div>
                </div>


            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> <?= $INFO['data']->version ?>
            </div>
            <strong>Copyright &copy; <?= date('Y') ?> <a href="<?= base_url() ?>"><?= $INFO['data']->nama_toko ?></a>.</strong> All rights
            reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Create the tabs -->
            <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                <li><a href="<?= base_url() ?>assets/#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
                <li><a href="<?= base_url() ?>assets/#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
            </ul>
        </aside>
        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->

    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?= base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="<?= base_url() ?>assets/bower_components/raphael/raphael.min.js"></script>
    <script src="<?= base_url() ?>assets/bower_components/morris.js/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="<?= base_url() ?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="<?= base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?= base_url() ?>assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="<?= base_url() ?>assets/bower_components/moment/min/moment.min.js"></script>
    <script src="<?= base_url() ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="<?= base_url() ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    >
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?= base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->-=
    <script src="<?= base_url() ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?= base_url() ?>assets/bower_components/chart.js/Chart.js"></script>
    <script src="<?= base_url() ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!--script src="<?= base_url() ?>assets/dist/js/pages/dashboard.js"></script-->
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url() ?>assets/dist/js/demo.js"></script>
    <script src="<?= base_url(); ?>assets/parser_rules/advanced_unwrap.js"></script>
    <script src="<?= base_url(); ?>assets/dist/wysihtml-toolbar.min.js"></script>
    <script async src="<?php echo base_url() ?>assets/inputmask/dist/jquery.inputmask.bundle.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <script type="text/javascript">
        var base_url = "<?= base_url() ?>";
        //console.clear();
    </script>

    <?php if (!empty($lib)) {

        foreach ($lib as $lib) {
            echo '<script src="' . base_url() . $lib . '" type="text/javascript"></script>';
        }
    }
    ?>
    <script type="text/javascript">
        <?php if (!empty($ajaxdata)) echo $ajaxdata; ?>
    </script>
</body>

</html>