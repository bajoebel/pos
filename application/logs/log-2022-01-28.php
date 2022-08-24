<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-01-28 00:10:14 --> Severity: Notice --> Undefined variable: list_kategori C:\xampp\htdocs\iraokapp\application\views\admin\laporan\laporan_kartustok_barang.php 302
ERROR - 2022-01-28 00:10:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\iraokapp\application\views\admin\laporan\laporan_kartustok_barang.php 302
ERROR - 2022-01-28 00:10:14 --> Severity: Notice --> Undefined variable: list_rak C:\xampp\htdocs\iraokapp\application\views\admin\laporan\laporan_kartustok_barang.php 319
ERROR - 2022-01-28 00:10:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\iraokapp\application\views\admin\laporan\laporan_kartustok_barang.php 319
ERROR - 2022-01-28 00:53:57 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'GROUP BY a.`barang_id` ORDER BY a.idx' at line 4 - Invalid query: SELECT a.idx,`jns_transaksi`,DATE_FORMAT(`tgl_transaksi`,'%Y-%m-%d') AS `tgl_transaksi`,a.`barang_id`,`barang_nama`,
                SUM(`jml_masuk`) AS jml_masuk, SUM(`jml_keluar`) AS jml_keluar, `barang_satuan_kecil`,`barang_satuan_besar`,`a`.`konversi_satuan`
                FROM `log_transaksi` a JOIN `barang` b ON a.barang_id=b.barang_id  WHERE a.barang_id=18 AND DATE_FORMAT(`tgl_transaksi`,'%Y-%m-%d') < '01/12/2021' ;
                GROUP BY a.`barang_id` ORDER BY a.idx
ERROR - 2022-01-28 00:54:31 --> Severity: Notice --> Undefined variable: barang_data C:\xampp\htdocs\iraokapp\application\views\admin\laporan\laporan_kartustok_barang.php 4
ERROR - 2022-01-28 00:54:31 --> Severity: Notice --> Trying to get property 'barang_nama' of non-object C:\xampp\htdocs\iraokapp\application\views\admin\laporan\laporan_kartustok_barang.php 4
ERROR - 2022-01-28 00:54:31 --> Severity: Notice --> Trying to get property 'jml_masuk' of non-object C:\xampp\htdocs\iraokapp\application\views\admin\laporan\laporan_kartustok_barang.php 26
ERROR - 2022-01-28 00:54:31 --> Severity: Notice --> Trying to get property 'jml_keluar' of non-object C:\xampp\htdocs\iraokapp\application\views\admin\laporan\laporan_kartustok_barang.php 26
ERROR - 2022-01-28 00:56:00 --> Severity: Notice --> Trying to get property 'jml_masuk' of non-object C:\xampp\htdocs\iraokapp\application\views\admin\laporan\laporan_kartustok_barang.php 26
ERROR - 2022-01-28 00:56:00 --> Severity: Notice --> Trying to get property 'jml_keluar' of non-object C:\xampp\htdocs\iraokapp\application\views\admin\laporan\laporan_kartustok_barang.php 26
