<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-10-09 00:22:24 --> Severity: Notice --> Undefined property: stdClass::$detail_satuan C:\xampp\htdocs\iraokapp\application\controllers\Return_barang.php 86
ERROR - 2021-10-09 00:22:24 --> Severity: Notice --> Undefined property: stdClass::$detail_satuan C:\xampp\htdocs\iraokapp\application\controllers\Return_barang.php 86
ERROR - 2021-10-09 00:22:26 --> Severity: Notice --> Undefined property: stdClass::$detail_satuan C:\xampp\htdocs\iraokapp\application\controllers\Return_barang.php 86
ERROR - 2021-10-09 00:22:26 --> Severity: Notice --> Undefined property: stdClass::$detail_satuan C:\xampp\htdocs\iraokapp\application\controllers\Return_barang.php 86
ERROR - 2021-10-09 00:22:38 --> Severity: Notice --> Undefined property: stdClass::$detail_satuan C:\xampp\htdocs\iraokapp\application\controllers\Return_barang.php 86
ERROR - 2021-10-09 00:22:38 --> Severity: Notice --> Undefined property: stdClass::$detail_satuan C:\xampp\htdocs\iraokapp\application\controllers\Return_barang.php 86
ERROR - 2021-10-09 00:23:14 --> Query error: Column 'detail_satuan' in field list is ambiguous - Invalid query: SELECT `pelanggan_nama`, `detail_return`.`detail_id` as `detail_return_id`, `jual_tipe`, `detail_harga_satuan`, `barang_diskon`, `barang_nama`, `detail_return`.`detail_jumlah` as `jml_return`, `detail_alasan_return`, `detail_return_harga`, `return_tanggal`, `barang_satuan_besar`, `barang_satuan_kecil`, `detail_satuan`
FROM `barang_return`
JOIN `detail_return` ON `detail_return_id`=`return_id`
JOIN `detail_jual` ON `detail_detail_jual_id`=`detail_jual`.`detail_id`
JOIN `barang_jual` ON `jual_id`=`detail_jual_id`
JOIN `barang` ON `detail_barang_id`=`barang_id`
JOIN `pelanggan` ON `jual_pelanggan_id`=`pelanggan_id`
WHERE `barang_nama` LIKE '%%' ESCAPE '!'
OR  `detail_return`.`detail_jumlah` LIKE '%%' ESCAPE '!'
OR  `detail_alasan_return` LIKE '%%' ESCAPE '!'
OR  `detail_return_harga` LIKE '%%' ESCAPE '!'
OR  `return_tanggal` LIKE '%%' ESCAPE '!'
OR  `barang_satuan_besar` LIKE '%%' ESCAPE '!'
OR  `barang_satuan_kecil` LIKE '%%' ESCAPE '!'
ORDER BY `return_id`
 LIMIT 10
ERROR - 2021-10-09 15:34:56 --> Query error: Unknown column 'min_stok' in 'where clause' - Invalid query: SELECT *
FROM `v_barang`
WHERE `barang_kode` LIKE '%%' ESCAPE '!'
OR  `barang_nama` LIKE '%%' ESCAPE '!'
OR  `harga_modal` LIKE '%%' ESCAPE '!'
OR  `stok_string` LIKE '%%' ESCAPE '!'
OR  `min_stok` LIKE '%%' ESCAPE '!'
ORDER BY `barang_id`
 LIMIT 10
ERROR - 2021-10-09 15:37:25 --> Query error: Unknown column 'min_stok' in 'where clause' - Invalid query: SELECT *
FROM `v_barang`
WHERE `barang_kode` LIKE '%%' ESCAPE '!'
OR  `barang_nama` LIKE '%%' ESCAPE '!'
OR  `harga_modal` LIKE '%%' ESCAPE '!'
OR  `stok_string` LIKE '%%' ESCAPE '!'
OR  `min_stok` LIKE '%%' ESCAPE '!'
ORDER BY `barang_id`
 LIMIT 10
ERROR - 2021-10-09 15:37:33 --> Query error: Unknown column 'min_stok' in 'where clause' - Invalid query: SELECT *
FROM `v_barang`
WHERE `barang_kode` LIKE '%%' ESCAPE '!'
OR  `barang_nama` LIKE '%%' ESCAPE '!'
OR  `harga_modal` LIKE '%%' ESCAPE '!'
OR  `stok_string` LIKE '%%' ESCAPE '!'
OR  `min_stok` LIKE '%%' ESCAPE '!'
ORDER BY `barang_id`
 LIMIT 10
ERROR - 2021-10-09 16:13:04 --> Severity: Notice --> Undefined variable: log C:\xampp\htdocs\iraokapp\application\controllers\Barang.php 138
ERROR - 2021-10-09 16:13:04 --> Severity: Notice --> Undefined variable: log C:\xampp\htdocs\iraokapp\application\controllers\Barang.php 139
