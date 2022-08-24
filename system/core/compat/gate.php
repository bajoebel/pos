<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(BASEPATH.'core/compat/jwt.php');
require_once(BASEPATH.'core/compat/9b40893feaeef4adcc6636019473aab0.php');
if(empty(KEY_INFO) || empty(KEY_APP)){
    // echo "KEY APP Atau KEY INFO masih kosong"; 
    $error="KEY APP Atau KEY INFO masih kosong";
    require_once(BASEPATH.'core/Info.php');
    exit;
}else{
    $INFO=AUTHORITY::validateKey(KEY_INFO);
    // print_r($INFO);exit;
    if(!$INFO['status']) {
        // print_r($INFO);
        $error = $INFO["data"];
        require_once(BASEPATH.'core/Info.php');
        exit;
    }else{
        if($INFO["data"]->verified==true){
            if($INFO["data"]->expire!="unlimited"){
                $sekarang=date('Y-m-d');
                if(strtotime($sekarang)>strtotime($INFO["data"]->expire)){
                    $error="Masa Aktif Aplikasi Sudah Berakhir Silahkan Hub. Developer";
                    require_once(BASEPATH.'core/Info.php');
                    exit;
                }
            }
        }else{
            $error="KEY INFO unlimited Aplikasi Belum diverifikasi untuk mengupgrade key info silahkan kirim KEY INFO Saat ini ke email bajoebel@gmail.com atau WA 0813-1046-0892";
            require_once(BASEPATH.'core/Info.php');
            exit;
        }
    }
}
