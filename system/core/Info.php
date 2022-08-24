<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php if($error=="KEY APP Atau KEY INFO masih kosong") echo "Registrasi Aplikasi"; else echo "Error Info";?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="robots" content="none" />
    <link rel="shortcut icon" href="'favicon.png' ?>">
    <?php $uri = explode('/',$_SERVER['REQUEST_URI']) ?>
    <link rel="stylesheet" href="<?= "http://" . $_SERVER['SERVER_NAME'] .'/'. $uri[1].'/';?>assets/bower_components/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="<?= "http://" . $_SERVER['SERVER_NAME'] .'/'. $uri[1].'/';?>assets/bower_components/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="<?= "http://" . $_SERVER['SERVER_NAME'] .'/'. $uri[1].'/';?>assets/bower_components/fonts.googleapis/fonts.css">
    <link rel="stylesheet" href="<?= "http://" . $_SERVER['SERVER_NAME'] .'/'. $uri[1].'/';?>assets/bower_components/Ionicons/css/ionicons.css">
    <link rel="stylesheet" href="<?= "http://" . $_SERVER['SERVER_NAME'] .'/'. $uri[1].'/';?>assets/dist/css/AdminLTE.css">
    <link rel="stylesheet" href="<?= "http://" . $_SERVER['SERVER_NAME'] .'/'. $uri[1].'/';?>assets/plugins/iCheck/square/blue.css">
    <style type="text/css">
        .text-error{
            color: #db1e14;
        }
    </style>
</head>

<body class="hold-transition login-page" style="background-image: url(<?= "http://" . $_SERVER['SERVER_NAME'] .'/'. $uri[1].'/';?>images/bg.jpg);background-size:cover">
    <?php 
    if($error=="KEY APP Atau KEY INFO masih kosong"){
        ?>
        <div class="login-box">
            <div class="login-box-body">
                <p class="login-box-msg">
                    <img src="<?= "http://" . $_SERVER['SERVER_NAME'] .'/'. $uri[1].'/';?>images/logo.png">
                    <br>
                    <!-- <div class="callout callout-success">Halaman Login Administrator</div> -->
                </p>
                <?php 
                $token="";
                if(isset($_POST['nama_toko'])) {
                    if($_POST['nama_toko']=="") $err1="Nama Toko Masih Kosong"; else $err1="";
                    if($_POST['alamat_toko']=="") $err2="Alamat Toko Masih Kosong"; else $err2="";
                    if($_POST['telp']=="") $err3="Telp Masih Kosong"; else $err3="";
                    if($_POST['logo']=="") $err4="Logo Masih Kosong"; else $err4="";
                    
                    if(!empty($err1)||!empty($err2)||!empty($err3)||!empty($err4)||!empty($err5)){
                        ?>
                        <div class="callout callout-danger">
                            <strong>Penting!</strong> Gagal Generate KEY INFO Karena Isian Belum Lengkap
                        </div>
                        <?php
                    }else{
                        if($_POST['jenislisensi']=="1"){
                            $sekarang=date('Y-m-d');
                            $date=date_create($sekarang);
                            date_add($date,date_interval_create_from_date_string("7 days"));
                            $expdate = date_format($date,"Y-m-d");
                            $data=array(
                                'verified'=>true,
                                'nama_toko'=>$_POST['nama_toko'],
                                'logo'=>'images/'.$_POST['logo'],
                                'app_name'=>'Point Of Sales',
                                'alamat'=>$_POST['alamat_toko'],
                                'telp'=>$_POST['telp'],
                                'version'=>'1.1',
                                'expire'=>$expdate
                            );
                            $token=AUTHORITY::generateKey($data);
                            ?>
                            <div class="callout callout-success">
                                <strong>Informasi !</strong> KEY INFO Berhasil Dibuat Silahkan Masukkan KEY INFO Pada file ../application/config/constants.php<br>
                                Copy File <?= $_POST['logo'] ?> kedalam folder images, KEY INFO Ini berlaku selama 7 Hari
                            </div>
                            <?php
                        }else{
                            $data=array(
                                'verified'=>false,
                                'nama_toko'=>$_POST['nama_toko'],
                                'logo'=>'images/'.$_POST['logo'],
                                'app_name'=>'Point Of Sales',
                                'alamat'=>$_POST['alamat_toko'],
                                'telp'=>$_POST['telp'],
                                'version'=>'1.1',
                                'expire'=>'unlimited'
                            );
                            $token=AUTHORITY::generateKey($data);
                            ?>
                            <div class="callout callout-warning">
                            <strong>Penting!</strong> KEY INFO Berhasil Dibuat Silahkan Masukkan KEY INFO Pada file ../application/config/constants.php<br>
                                Copy File <?= $_POST['logo'] ?> kedalam folder images, Untuk aktivasi KEY INFO permanen silahkan kirim KEY INFO ini ke email bajoebel@gmail.com atau WA ke 0813-1046-0892
                            </div>
                            <?php
                        }
                        
                        ?>
                        

                        <textarea class="form-control" rows="10"><?= $token ?></textarea>
                        <?php
                    }
                }else{
                    $err1="";$err2="";$err3="";$err4="";$err5="";

                    ?>
                    <div class="callout callout-info">
                    <p class="text-center"><strong>Penting!</strong> Lengkapi Isian Untuk Mendapatkan KEY INFO</p>
                    </div>
                    <?php
                }
                if($token==""){
                    ?>
                    <form id="form1" method="post" action="">

                        <div class="form-group has-feedback">
                            <input name="nama_toko" type="text" class="form-control" placeholder="Masukkan Nama Toko" value="<?php if(isset($_POST['nama_toko'])) echo $_POST['nama_toko']; ?>">
                            <span class="fa fa-building form-control-feedback"></span>
                            <span class="text-error"><?= $err1 ?></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input name="alamat_toko" type="text" class="form-control" placeholder="Masukkan alamat" value="<?php if(isset($_POST['alamat_toko'])) echo $_POST['alamat_toko']; ?>">
                            <span class="fa fa-map-marker form-control-feedback"></span>
                            <span class="text-error"><?= $err2 ?></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input name="telp" type="text" class="form-control" placeholder="Masukkan Telp" value="<?php if(isset($_POST['telp'])) echo $_POST['telp']; ?>">
                            <span class="fa fa-phone form-control-feedback"></span>
                            <span class="text-error"><?= $err3 ?></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input name="logo" type="text" class="form-control" placeholder="Masukkan Logo" value="<?php if(isset($_POST['logo'])) echo $_POST['logo']; ?>" >
                            <span class="fa fa fa-camera-retro form-control-feedback"></span>
                            <span class="text-error"><?= $err4 ?></span>
                        </div>
                        <div class="form-group has-feedback">
                            <select name="jenislisensi" id="jenislisensi" class="form-control">
                                <option value="1">Trial</option>
                                <option value="2">Permanen</option>
                            </select>
                            <span class="fa fa-certificate form-control-feedback"></span>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <!-- <button type="button" onclick="toBeranda()" class="btn btn-success btn-block btn-flat"> -->
                                    <!-- <span class="fa fa-building"></span> Halaman Utama</button> -->
                            </div>
                            <div class="col-xs-6">    
                                <button type="submit" class="btn btn-danger btn-block btn-flat">
                                    <span class="fa fa-key"></span> Generate Key</button>
                            </div>
                        </div>
                        </form>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }else{
        ?>
        <div class="login-box">
            <div class="login-box-body">
                <p class="login-box-msg">
                    <img src="<?= "http://" . $_SERVER['SERVER_NAME'] .'/'. $uri[1].'/';?>images/logo.png">
                    <br>
                    <div class="callout callout-danger"><strong>Info!</strong> <?= $error ?>
                </p>
                
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    

    <script src="<?= "http://" . $_SERVER['SERVER_NAME'] .'/'. $uri[1].'/';?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?= "http://" . $_SERVER['SERVER_NAME'] .'/'. $uri[1].'/';?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= "http://" . $_SERVER['SERVER_NAME'] .'/'. $uri[1].'/';?>assets/plugins/iCheck/icheck.min.js"></script>
    
</body>

</html>