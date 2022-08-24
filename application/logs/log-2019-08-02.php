<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-08-02 08:18:30 --> Severity: Warning --> mysqli::real_connect(): (HY000/1045): Access denied for user 'root'@'localhost' (using password: YES) C:\xampp\htdocs\grosir\system\database\drivers\mysqli\mysqli_driver.php 161
ERROR - 2019-08-02 08:18:30 --> Unable to connect to the database
ERROR - 2019-08-02 08:23:05 --> Query error: Unknown column 'barang_min_stok' in 'field list' - Invalid query: SELECT barang_image,barang_nama,(`barang_stok_besar` *`barang_konversi` + `barang_stok_kecil`) as stok, `barang_satuan_kecil`,`barang_min_stok` FROM `barang` WHERE (`barang_stok_besar` *`barang_konversi` + `barang_stok_kecil`) <= `barang_min_stok`
