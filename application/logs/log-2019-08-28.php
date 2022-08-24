<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


ERROR - 2019-08-28 04:55:05 --> Query error: Unknown column 'user_password1' in 'where clause' - Invalid query: SELECT *
FROM `users`
JOIN `group` ON `users`.`user_group_id`=`group`.`group_id`
WHERE `username` = 'admin'
AND `user_password1` = '4e483f033710620913c088e775ef4757'
AND `user_status` = 'Aktif'
ERROR - 2019-08-28 04:55:34 --> Query error: Unknown column 'user_password1' in 'where clause' - Invalid query: SELECT *
FROM `users`
JOIN `group` ON `users`.`user_group_id`=`group`.`group_id`
WHERE `username` = 'admin'
AND `user_password1` = '4e483f033710620913c088e775ef4757'
AND `user_status` = 'Aktif'
ERROR - 2019-08-28 05:19:11 --> Severity: Notice --> Undefined variable: list_kategori C:\xampp\htdocs\grosir\application\views\admin\laporan\laporan_barang.php 293
ERROR - 2019-08-28 05:19:11 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\grosir\application\views\admin\laporan\laporan_barang.php 293
ERROR - 2019-08-28 05:19:11 --> Severity: Notice --> Undefined variable: list_rak C:\xampp\htdocs\grosir\application\views\admin\laporan\laporan_barang.php 310
ERROR - 2019-08-28 05:19:11 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\grosir\application\views\admin\laporan\laporan_barang.php 310
ERROR - 2019-08-28 05:44:06 --> Severity: Notice --> Undefined variable: auth C:\xampp\htdocs\grosir\application\controllers\Dasboard.php 28
ERROR - 2019-08-28 05:44:06 --> Severity: Notice --> Undefined variable: auth C:\xampp\htdocs\grosir\application\controllers\Dasboard.php 29
ERROR - 2019-08-28 05:44:06 --> Severity: Notice --> Undefined variable: auth C:\xampp\htdocs\grosir\application\controllers\Dasboard.php 30
ERROR - 2019-08-28 05:44:06 --> Query error: Unknown column 'hutang_tgl' in 'where clause' - Invalid query: SELECT SUM(piutang_jml) as piutang
FROM `piutang`
WHERE `hutang_tgl` = '2019-08-28'
AND `piutang_userinput` IS NULL
ERROR - 2019-08-28 05:45:03 --> Query error: Unknown column 'hutang_tgl' in 'where clause' - Invalid query: SELECT SUM(piutang_jml) as piutang
FROM `piutang`
WHERE `hutang_tgl` = '2019-08-28'
AND `piutang_userinput` = 'test'
ERROR - 2019-08-28 05:46:41 --> Severity: 4096 --> Object of class stdClass could not be converted to string C:\xampp\htdocs\grosir\application\views\admin\dasboard\view_dasboard.php 8
ERROR - 2019-08-28 05:46:41 --> Severity: 4096 --> Object of class stdClass could not be converted to string C:\xampp\htdocs\grosir\application\views\admin\dasboard\view_dasboard.php 21
ERROR - 2019-08-28 05:46:41 --> Severity: 4096 --> Object of class stdClass could not be converted to string C:\xampp\htdocs\grosir\application\views\admin\dasboard\view_dasboard.php 38
ERROR - 2019-08-28 05:46:41 --> Severity: 4096 --> Object of class stdClass could not be converted to string C:\xampp\htdocs\grosir\application\views\admin\dasboard\view_dasboard.php 51
ERROR - 2019-08-28 05:49:28 --> Severity: Notice --> Undefined property: stdClass::$hutang C:\xampp\htdocs\grosir\application\views\admin\dasboard\view_dasboard.php 51
ERROR - 2019-08-28 05:58:06 --> Severity: Notice --> Undefined variable: list_kategori C:\xampp\htdocs\grosir\application\views\admin\laporan\laporan_barang.php 293
ERROR - 2019-08-28 05:58:06 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\grosir\application\views\admin\laporan\laporan_barang.php 293
ERROR - 2019-08-28 05:58:06 --> Severity: Notice --> Undefined variable: list_rak C:\xampp\htdocs\grosir\application\views\admin\laporan\laporan_barang.php 310
ERROR - 2019-08-28 05:58:06 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\grosir\application\views\admin\laporan\laporan_barang.php 310
ERROR - 2019-08-28 05:58:08 --> Severity: Notice --> Undefined variable: list_kategori C:\xampp\htdocs\grosir\application\views\admin\laporan\laporan_barang_rusak.php 293
ERROR - 2019-08-28 05:58:08 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\grosir\application\views\admin\laporan\laporan_barang_rusak.php 293
ERROR - 2019-08-28 05:58:08 --> Severity: Notice --> Undefined variable: list_rak C:\xampp\htdocs\grosir\application\views\admin\laporan\laporan_barang_rusak.php 310
ERROR - 2019-08-28 05:58:08 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\grosir\application\views\admin\laporan\laporan_barang_rusak.php 310
ERROR - 2019-08-28 05:58:09 --> Severity: Notice --> Undefined variable: list_kategori C:\xampp\htdocs\grosir\application\views\admin\laporan\laporan_barang_exp.php 293
ERROR - 2019-08-28 05:58:09 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\grosir\application\views\admin\laporan\laporan_barang_exp.php 293
ERROR - 2019-08-28 05:58:09 --> Severity: Notice --> Undefined variable: list_rak C:\xampp\htdocs\grosir\application\views\admin\laporan\laporan_barang_exp.php 310
ERROR - 2019-08-28 05:58:09 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\grosir\application\views\admin\laporan\laporan_barang_exp.php 310
