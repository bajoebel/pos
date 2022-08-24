<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-08-06 15:31:20 --> Query error: Unknown column 'barang_min_stok' in 'field list' - Invalid query: SELECT barang_image,barang_nama,(`barang_stok_besar` *`barang_konversi` + `barang_stok_kecil`) as stok, `barang_satuan_kecil`,`barang_min_stok` FROM `barang` WHERE (`barang_stok_besar` *`barang_konversi` + `barang_stok_kecil`) <= `barang_min_stok`
