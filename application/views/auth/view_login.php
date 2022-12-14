<!DOCTYPE html>
<html>
<?php $INFO=AUTHORITY::validateKey(KEY_INFO); ?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $INFO['data']->nama_toko ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url() . "assets/"; ?>plugins/iCheck/square/blue.css">
</head>

<body class="hold-transition login-page" style="background-image: url(<?php echo base_url(); ?>images/bg.jpg);background-size:cover">
    
    <div class="login-box">
        <div class="login-logo"></div>
        <div class="login-box-body">
            <p class="login-box-msg">
                <img src="<?php echo base_url() . $INFO['data']->logo; ?>">
                <br>
            <div class="callout callout-success">Halaman Login Administrator</div>
            </p>

            <form method="post" action="<?php echo base_url() . "auth/cekuser"; ?>">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Username" name="username">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="user_password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck"></div>
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-success btn-block btn-flat">Sign In</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="<?= base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url() ?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- Bootstrap 3.3.6 -->
    <!-- Bootstrap 3.3.7 -->
    <script src="<?= base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url() . "assets/"; ?>plugins/iCheck/icheck.min.js"></script>
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>

</html>
<!--========================================================================================================
End of file .application/views/auth/view_login.php 
Location: ./application/views/auth/view_login.php 
Please DO NOT modify this information : 
Generated by Codeigniter CRUD Generator V1 19 Oct 2017 10:54:07 
Copyright @ 2017 By Wanhar Azri S.Kom 
============================================================================================================-->