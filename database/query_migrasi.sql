INSERT INTO `log_transaksi`
(SELECT NULL AS idx, 'SA' AS jns_transaksi, DATE_FORMAT(NOW(),'%Y-%m-%d %H:%i:%s') AS tgl_transaksi, '1' AS no_referensi, `barang_id`,
(`barang_harga_pokok_baru`/`barang_konversi`) AS harga_modal,((`barang_stok_besar`*`barang_konversi`)+`barang_stok_kecil`) AS jml_masuk,0 AS jml_keluar,
`barang_konversi` AS konversi_satuan,'admin' AS userinput FROM `barang`);

ALTER TABLE `barang_hjual` AUTO_INCREMENT=1;
INSERT INTO `barang_hjual`
SELECT NULL AS idx, `barang_id`,`barang_harga_grosir`,`barang_konversi`,`barang_satuan_besar` FROM `barang` UNION 
SELECT NULL AS idx, `barang_id`,`barang_harga_jual`,1 AS `barang_konversi`,`barang_satuan_kecil` FROM `barang` ORDER BY barang_id;

SELECT a.`barang_id`,b.`barang_kode`,b.`barang_nama`,MAX(a.`harga_modal`) AS `harga_modal`,
(SUM(`jml_masuk`)-SUM(`jml_keluar`)) AS stok,`barang_konversi`,
CONCAT(FLOOR(((SUM(`jml_masuk`)-SUM(`jml_keluar`))/`konversi_satuan`)),' ', `barang_satuan_besar`,' ', (((SUM(`jml_masuk`)-SUM(`jml_keluar`))%`konversi_satuan`)),' ',`barang_satuan_kecil`) AS stok_string
FROM `log_transaksi` a JOIN `barang` b ON a.`barang_id`=b.`barang_id` GROUP BY a.`barang_id`;