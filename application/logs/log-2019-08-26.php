<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-08-26 21:57:00 --> Severity: Notice --> Undefined property: stdClass::$tmp_harga C:\xampp\htdocs\grosir\application\views\admin\barang_jual\penjualan_temp.php 25
ERROR - 2019-08-26 22:12:43 --> Query error: Unknown column 'session_id' in 'where clause' - Invalid query: DELETE FROM `tmp_jual`
WHERE `session_id` = '6ee6b224df4cabf53d83750a6a8c8dc30fcd3f9b'
ERROR - 2019-08-26 22:34:04 --> Severity: Notice --> Undefined variable: data C:\xampp\htdocs\grosir\application\controllers\Penjualan.php 285
ERROR - 2019-08-26 22:35:15 --> Query error: Unknown column 'piutang_transkasi' in 'field list' - Invalid query: INSERT INTO `piutang` (`piutang_transkasi`, `piutang_koderef`, `piutang_jml`) VALUES ('PJ', 31, '2480000')
ERROR - 2019-08-26 22:45:33 --> Query error: Table 'db_grosir.$this->table' doesn't exist - Invalid query: SELECT COUNT(*) AS `numrows`
FROM `$this->table`
JOIN `pelanggan` ON `jual_pelanggan_id`=`pelanggan_id`
WHERE `jual_invoice` LIKE '%%' ESCAPE '!'
OR  `jual_tipe` LIKE '%%' ESCAPE '!'
OR  `pelanggan_nama` LIKE '%%' ESCAPE '!'
OR  `jual_tanggal` LIKE '%%' ESCAPE '!'
OR  `jual_userinput` LIKE '%%' ESCAPE '!'
