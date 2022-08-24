/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 10.1.37-MariaDB : Database - db_grosir
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `akun` */

DROP TABLE IF EXISTS `akun`;

CREATE TABLE `akun` (
  `akun_id` int(11) NOT NULL AUTO_INCREMENT,
  `akun_kode` varchar(15) DEFAULT NULL,
  `akun_nama` varchar(100) DEFAULT NULL,
  `akun_jenis` enum('Kredit','Debet') DEFAULT NULL,
  `akun_status` enum('Aktif','Tidak Aktif') DEFAULT NULL,
  PRIMARY KEY (`akun_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `akun` */

insert  into `akun`(`akun_id`,`akun_kode`,`akun_nama`,`akun_jenis`,`akun_status`) values 
(1,'100','KAS AWAL','Debet','Aktif'),
(2,'101','PIUTANG','Kredit','Aktif'),
(3,'102','ASET BARANG DAGANG','Debet','Aktif'),
(4,'103','PENJUALAN BARANG','Debet','Aktif'),
(5,'104','PEMBELIAN BARANG','Kredit','Aktif'),
(6,'105','RETURN BARANG','Kredit','Aktif'),
(7,'106','HUTANG','Debet','Aktif'),
(8,'107','PENERIMAAN PIUTANG','Debet','Aktif'),
(9,'108','PEMBAYARAN HUTANG','Kredit','Aktif');

/*Table structure for table `barang` */

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `barang_id` int(11) NOT NULL AUTO_INCREMENT,
  `barang_kode` varchar(15) DEFAULT NULL,
  `barang_kategori_id` int(11) DEFAULT NULL,
  `barang_rak_id` int(11) DEFAULT NULL,
  `barang_nama` varchar(100) DEFAULT NULL,
  `barang_description` varchar(250) DEFAULT NULL,
  `barang_harga_pokok_lama` decimal(11,2) DEFAULT NULL,
  `barang_harga_pokok_baru` decimal(11,2) DEFAULT NULL,
  `barang_harga_jual` decimal(11,2) DEFAULT NULL,
  `barang_harga_grosir` decimal(11,2) DEFAULT NULL,
  `barang_diskon` decimal(11,2) DEFAULT '0.00',
  `barang_stok_besar` decimal(11,2) DEFAULT NULL,
  `barang_stok_kecil` decimal(11,2) DEFAULT NULL,
  `barang_satuan_besar` varchar(35) DEFAULT NULL,
  `barang_satuan_kecil` varchar(35) DEFAULT NULL,
  `barang_konversi` decimal(11,2) DEFAULT NULL,
  `barang_min_stok` decimal(11,2) DEFAULT NULL,
  `barang_image` varchar(100) DEFAULT NULL,
  `barang_userinput` char(32) DEFAULT NULL,
  `barang_status` enum('Aktif','Tidak Aktif') DEFAULT NULL,
  PRIMARY KEY (`barang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `barang` */

insert  into `barang`(`barang_id`,`barang_kode`,`barang_kategori_id`,`barang_rak_id`,`barang_nama`,`barang_description`,`barang_harga_pokok_lama`,`barang_harga_pokok_baru`,`barang_harga_jual`,`barang_harga_grosir`,`barang_diskon`,`barang_stok_besar`,`barang_stok_kecil`,`barang_satuan_besar`,`barang_satuan_kecil`,`barang_konversi`,`barang_min_stok`,`barang_image`,`barang_userinput`,`barang_status`) values 
(17,'MLW-0001',1,3,'MIE PADEH','',110000.00,110000.00,9000.00,216000.00,0.00,-9.00,-4.00,'DUS','PCS',24.00,24.00,NULL,'admin','Aktif'),
(18,'MLW-0002',2,3,'TELUR','',40000.00,40000.00,3000.00,90000.00,0.00,-7.00,0.00,'SAK','Butir',30.00,5.00,NULL,'admin','Aktif');

/*Table structure for table `barang_exp` */

DROP TABLE IF EXISTS `barang_exp`;

CREATE TABLE `barang_exp` (
  `exp_id` int(11) NOT NULL AUTO_INCREMENT,
  `exp_barang_id` int(11) DEFAULT NULL,
  `exp_exp_date` date DEFAULT NULL,
  `exp_jml` int(11) DEFAULT NULL,
  `exp_inputat` date DEFAULT NULL,
  `exp_userinput` char(32) DEFAULT NULL,
  PRIMARY KEY (`exp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `barang_exp` */

/*Table structure for table `barang_hjual` */

DROP TABLE IF EXISTS `barang_hjual`;

CREATE TABLE `barang_hjual` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `barang_id` int(11) DEFAULT NULL,
  `harga_jual` decimal(19,2) DEFAULT NULL,
  `jml_item_perpcs` decimal(19,2) DEFAULT NULL,
  `satuan` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

/*Data for the table `barang_hjual` */

insert  into `barang_hjual`(`idx`,`barang_id`,`harga_jual`,`jml_item_perpcs`,`satuan`) values 
(29,17,9000.00,1.00,'PCS (Level 1-3)'),
(30,17,10000.00,1.00,'PCS (Level 4)'),
(31,17,11000.00,1.00,'PCS (Level 5)'),
(32,17,12000.00,1.00,'PCS (Level 6)'),
(33,18,3000.00,1.00,'Butir'),
(34,18,90000.00,30.00,'SAK');

/*Table structure for table `barang_jual` */

DROP TABLE IF EXISTS `barang_jual`;

CREATE TABLE `barang_jual` (
  `jual_id` int(11) NOT NULL AUTO_INCREMENT,
  `jual_invoice` varchar(30) DEFAULT NULL,
  `jual_tipe` enum('Ecer','Grosir') DEFAULT NULL,
  `jual_carabayar` enum('Tunai','Kredit') DEFAULT 'Tunai',
  `jual_pelanggan_id` int(11) DEFAULT NULL,
  `jual_tanggal` date DEFAULT NULL,
  `jual_tutup_buku` enum('Sudah','Belum') DEFAULT 'Belum',
  `jual_userinput` char(32) DEFAULT NULL,
  PRIMARY KEY (`jual_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `barang_jual` */

insert  into `barang_jual`(`jual_id`,`jual_invoice`,`jual_tipe`,`jual_carabayar`,`jual_pelanggan_id`,`jual_tanggal`,`jual_tutup_buku`,`jual_userinput`) values 
(1,'INV/OK/XII/2021/0001','Grosir','',2,'2021-12-18','Belum','admin');

/*Table structure for table `barang_masuk` */

DROP TABLE IF EXISTS `barang_masuk`;

CREATE TABLE `barang_masuk` (
  `masuk_id` int(11) NOT NULL AUTO_INCREMENT,
  `masuk_nofaktur` char(15) DEFAULT NULL,
  `masuk_pemasok_id` int(11) DEFAULT NULL,
  `masuk_carabayar` enum('Tunai','Kredit') DEFAULT NULL,
  `masuk_tanggal` date DEFAULT NULL,
  `masuk_tutup_buku` enum('Sudah','Belum') DEFAULT 'Belum',
  `masuk_userinput` char(32) DEFAULT NULL,
  PRIMARY KEY (`masuk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `barang_masuk` */

/*Table structure for table `barang_return` */

DROP TABLE IF EXISTS `barang_return`;

CREATE TABLE `barang_return` (
  `return_id` int(11) NOT NULL AUTO_INCREMENT,
  `return_jual_id` int(11) DEFAULT NULL,
  `return_tanggal` datetime DEFAULT NULL,
  `return_tutup_buku` enum('Sudah','Belum') DEFAULT 'Belum',
  `return_userinput` char(32) DEFAULT NULL,
  PRIMARY KEY (`return_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `barang_return` */

/*Table structure for table `barang_rusak` */

DROP TABLE IF EXISTS `barang_rusak`;

CREATE TABLE `barang_rusak` (
  `rusak_id` int(11) NOT NULL AUTO_INCREMENT,
  `rusak_barang_id` int(11) DEFAULT NULL,
  `rusak_jumlah` int(11) DEFAULT NULL,
  `rusak_inputat` date DEFAULT NULL,
  `rusak_userinput` char(32) DEFAULT NULL,
  PRIMARY KEY (`rusak_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `barang_rusak` */

/*Table structure for table `detail_jual` */

DROP TABLE IF EXISTS `detail_jual`;

CREATE TABLE `detail_jual` (
  `detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `detail_jual_id` int(11) DEFAULT NULL,
  `detail_jual_tipe` enum('Ecer','Grosir') DEFAULT NULL,
  `detail_barang_id` int(11) DEFAULT NULL,
  `detail_jumlah` decimal(19,2) DEFAULT NULL,
  `detail_tipe_harga` int(11) DEFAULT NULL,
  `detail_harga_satuan` decimal(19,2) DEFAULT NULL,
  `detail_konversi_satuan` int(11) DEFAULT NULL,
  `detail_jmlsatuan` double DEFAULT NULL,
  `detail_diskon` decimal(19,2) DEFAULT NULL,
  `detail_satuan` varchar(20) DEFAULT NULL,
  `detail_status` enum('Pending','Return','Checkout') DEFAULT 'Pending',
  PRIMARY KEY (`detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `detail_jual` */

insert  into `detail_jual`(`detail_id`,`detail_jual_id`,`detail_jual_tipe`,`detail_barang_id`,`detail_jumlah`,`detail_tipe_harga`,`detail_harga_satuan`,`detail_konversi_satuan`,`detail_jmlsatuan`,`detail_diskon`,`detail_satuan`,`detail_status`) values 
(1,1,'Grosir',17,10.00,32,12000.00,1,10,0.00,'PCS (Level 6)','Checkout'),
(2,1,'Grosir',18,8.00,33,3000.00,1,8,0.00,'Butir','Checkout');

/*Table structure for table `detail_masuk` */

DROP TABLE IF EXISTS `detail_masuk`;

CREATE TABLE `detail_masuk` (
  `detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `detail_masuk_id` int(11) DEFAULT NULL,
  `detail_barang_id` int(11) DEFAULT NULL,
  `detail_jumlah` decimal(19,2) DEFAULT '0.00',
  `detail_diskon` decimal(19,2) DEFAULT NULL,
  `detail_harga_satuan` decimal(19,2) DEFAULT NULL,
  `detail_hpppcs` decimal(19,2) DEFAULT NULL,
  `detail_konversi` int(11) DEFAULT NULL,
  `detail_satuan` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `detail_masuk` */

/*Table structure for table `detail_return` */

DROP TABLE IF EXISTS `detail_return`;

CREATE TABLE `detail_return` (
  `detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `detail_return_id` int(11) DEFAULT NULL,
  `detail_detail_jual_id` int(11) DEFAULT NULL,
  `detail_alasan_return` varchar(200) DEFAULT NULL,
  `detail_jumlah` double DEFAULT NULL,
  `detail_satuan` varchar(50) DEFAULT NULL,
  `detail_konversi_satuan` int(11) DEFAULT NULL,
  `detail_return_harga` double DEFAULT NULL,
  PRIMARY KEY (`detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `detail_return` */

/*Table structure for table `group` */

DROP TABLE IF EXISTS `group`;

CREATE TABLE `group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) NOT NULL DEFAULT '',
  `status` enum('Active','Non Active') NOT NULL DEFAULT 'Active',
  `admin` enum('Y','N') NOT NULL DEFAULT 'Y',
  `info1` varchar(50) NOT NULL DEFAULT '',
  `info2` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `group` */

insert  into `group`(`group_id`,`group_name`,`status`,`admin`,`info1`,`info2`) values 
(1,'Administrator','Active','Y','','');

/*Table structure for table `hutang` */

DROP TABLE IF EXISTS `hutang`;

CREATE TABLE `hutang` (
  `hutang_id` int(11) NOT NULL AUTO_INCREMENT,
  `hutang_tgl` date DEFAULT NULL,
  `hutang_transaksi` varchar(3) DEFAULT 'PB' COMMENT 'PB=PEMBELIAN',
  `hutang_koderef` int(11) DEFAULT NULL,
  `hutang_jml` double DEFAULT NULL,
  `hutang_tutupbuku` enum('Sudah','Belum') DEFAULT 'Belum',
  `hutang_userinput` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`hutang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `hutang` */

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_nama` varchar(100) DEFAULT NULL,
  `kategori_status` enum('Aktif','Tidak Aktif') DEFAULT NULL,
  `kategori_userinput` char(32) DEFAULT NULL,
  PRIMARY KEY (`kategori_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `kategori` */

insert  into `kategori`(`kategori_id`,`kategori_nama`,`kategori_status`,`kategori_userinput`) values 
(1,'Mie','Aktif',''),
(2,'Toping','Aktif','');

/*Table structure for table `log_transaksi` */

DROP TABLE IF EXISTS `log_transaksi`;

CREATE TABLE `log_transaksi` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `jns_transaksi` varchar(3) DEFAULT NULL,
  `tgl_transaksi` datetime DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `no_referensi` int(11) DEFAULT NULL,
  `barang_id` int(11) DEFAULT NULL,
  `harga_modal` decimal(19,2) DEFAULT NULL,
  `jml_masuk` decimal(19,2) DEFAULT NULL COMMENT 'Dalam Satuan Kecil',
  `jml_keluar` decimal(19,2) DEFAULT NULL COMMENT 'Dalam Satuan Kecil',
  `konversi_satuan` int(11) DEFAULT NULL,
  `userinput` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

/*Data for the table `log_transaksi` */

insert  into `log_transaksi`(`idx`,`jns_transaksi`,`tgl_transaksi`,`tgl_masuk`,`no_referensi`,`barang_id`,`harga_modal`,`jml_masuk`,`jml_keluar`,`konversi_satuan`,`userinput`) values 
(44,'SA','2021-11-13 12:24:36','2021-11-13',17,17,4583.33,44.00,0.00,24,'admin'),
(45,'SA','2021-11-13 12:29:33','2021-11-13',18,18,1333.33,30.00,0.00,30,'admin'),
(46,'JL','2021-12-18 12:16:10','2021-11-13',1,17,4583.33,0.00,10.00,1,'admin'),
(47,'JL','2021-12-18 12:16:10','2021-11-13',1,18,1333.33,0.00,8.00,1,'admin');

/*Table structure for table `moduls` */

DROP TABLE IF EXISTS `moduls`;

CREATE TABLE `moduls` (
  `moduls_id` int(11) NOT NULL AUTO_INCREMENT,
  `moduls_title` varchar(50) NOT NULL DEFAULT '',
  `moduls_url` varchar(50) NOT NULL DEFAULT '',
  `moduls_parent_idx` int(11) NOT NULL,
  `moduls_child_idx` int(11) NOT NULL,
  `moduls_status` enum('Active','Non Active') NOT NULL DEFAULT 'Active',
  `info1` varchar(50) NOT NULL DEFAULT '',
  `info2` varchar(50) NOT NULL,
  `icon` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`moduls_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

/*Data for the table `moduls` */

insert  into `moduls`(`moduls_id`,`moduls_title`,`moduls_url`,`moduls_parent_idx`,`moduls_child_idx`,`moduls_status`,`info1`,`info2`,`icon`) values 
(1,'Setting','#',100,0,'Active','','','fa fa-gear'),
(2,'Modul','moduls',100,1,'Active','','',NULL),
(3,'Group','group',100,2,'Active','','',NULL),
(4,'User','users',100,3,'Active','','',NULL),
(5,'Dasboard','dasboard',1,0,'Active','','','fa fa-home'),
(6,'Moduls','#',2,0,'Non Active','','',NULL),
(7,'Rak','rak',3,1,'Active','','',NULL),
(8,'Kategori','kategori',3,2,'Active','','',NULL),
(11,'Pemasok','pemasok',3,4,'Active','','',NULL),
(12,'Pelanggan','pelanggan',3,5,'Active','','',NULL),
(13,'Akun','akun',5,1,'Active','','',NULL),
(18,'Pembelian','pembelian_barang',4,2,'Active','','',NULL),
(20,'Barang','barang',3,3,'Active','','',NULL),
(21,'Daftar barang masuk','daftar_barang_masuk',2,1,'Active','','',NULL),
(24,'Penjualan','penjualan',4,1,'Active','','',NULL),
(25,'Return','return_barang',4,3,'Active','','',NULL),
(26,'Transaksi','transaksi',5,2,'Active','','','fa fa-bars'),
(27,'Tutup Buku','tutupbuku',5,3,'Active','','',NULL),
(28,'Barang Rusak','barang_rusak',3,6,'Active','','',NULL),
(29,'Barang Expire','barang_exp',3,7,'Active','','',NULL),
(30,'Laporan Barang','laporan/barang',6,1,'Active','','',NULL),
(31,'Master','#',3,0,'Active','','','fa fa-bars'),
(32,'Transaksi','#',4,0,'Active','','','fa fa-shopping-cart '),
(33,'Report','#',6,0,'Active','','','fa fa-file-o'),
(34,'Keuangan','#',5,0,'Active','','','fa fa fa-credit-card'),
(35,'Laporan Barang Rusak','laporan/barang_rusak',6,2,'Active','','',NULL),
(36,'Laporan Barang Expire','laporan/barang_exp',6,3,'Active','','',NULL),
(37,'Laporan Penjualan','laporan/penjualan',6,4,'Active','','',NULL),
(38,'Laporan Pembelian','laporan/pembelian',6,5,'Active','','',NULL),
(39,'Laporan Return Barang','laporan/return_barang',6,6,'Active','','',NULL),
(40,'Laporan Keuangan','laporan/keuangan',6,7,'Active','','',NULL),
(41,'Penerimaan Piutang','piutang',4,4,'Active','','',NULL),
(42,'Pembayaran Hutang','hutang',4,5,'Active','','',NULL);

/*Table structure for table `moduls_group` */

DROP TABLE IF EXISTS `moduls_group`;

CREATE TABLE `moduls_group` (
  `moduls_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `moduls_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `add1` enum('Y','N') NOT NULL DEFAULT 'Y',
  `update1` enum('Y','N') NOT NULL DEFAULT 'Y',
  `delete1` enum('Y','N') NOT NULL DEFAULT 'Y',
  `report1` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`moduls_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

/*Data for the table `moduls_group` */

insert  into `moduls_group`(`moduls_group_id`,`moduls_id`,`group_id`,`add1`,`update1`,`delete1`,`report1`) values 
(1,1,1,'Y','Y','Y','Y'),
(2,2,1,'Y','Y','Y','Y'),
(3,3,1,'Y','Y','Y','Y'),
(4,4,1,'Y','Y','Y','Y'),
(5,5,1,'Y','Y','Y','Y'),
(6,6,1,'Y','Y','Y','Y'),
(7,7,1,'Y','Y','Y','Y'),
(8,8,1,'Y','Y','Y','Y'),
(9,9,1,'Y','Y','Y','Y'),
(10,10,1,'Y','Y','Y','Y'),
(11,11,1,'Y','Y','Y','Y'),
(12,12,1,'Y','Y','Y','Y'),
(13,13,1,'Y','Y','Y','Y'),
(14,14,1,'Y','Y','Y','Y'),
(15,15,1,'Y','Y','Y','Y'),
(16,16,1,'Y','Y','Y','Y'),
(17,17,1,'Y','Y','Y','Y'),
(18,18,1,'Y','Y','Y','Y'),
(19,19,1,'Y','Y','Y','Y'),
(20,20,1,'Y','Y','Y','Y'),
(21,21,1,'Y','Y','Y','Y'),
(22,22,1,'Y','Y','Y','Y'),
(23,23,1,'Y','Y','Y','Y'),
(24,24,1,'Y','Y','Y','Y'),
(25,25,1,'Y','Y','Y','Y'),
(26,26,1,'Y','Y','Y','Y'),
(27,27,1,'Y','Y','Y','Y'),
(28,28,1,'Y','Y','Y','Y'),
(29,29,1,'Y','Y','Y','Y'),
(30,30,1,'Y','Y','Y','Y'),
(31,31,1,'Y','Y','Y','Y'),
(32,32,1,'Y','Y','Y','Y'),
(33,33,1,'Y','Y','Y','Y'),
(34,35,1,'Y','Y','Y','Y'),
(35,36,1,'Y','Y','Y','Y'),
(36,37,1,'Y','Y','Y','Y'),
(37,38,1,'Y','Y','Y','Y'),
(38,39,1,'Y','Y','Y','Y'),
(39,34,1,'Y','Y','Y','Y'),
(40,40,1,'Y','Y','Y','Y'),
(41,41,1,'Y','Y','Y','Y'),
(42,42,1,'Y','Y','Y','Y');

/*Table structure for table `pelanggan` */

DROP TABLE IF EXISTS `pelanggan`;

CREATE TABLE `pelanggan` (
  `pelanggan_id` int(11) NOT NULL AUTO_INCREMENT,
  `pelanggan_nama` varchar(100) DEFAULT NULL,
  `pelanggan_alamat` varchar(200) DEFAULT NULL,
  `peanggan_kontak` varchar(15) DEFAULT NULL,
  `pelanggan_email` varchar(100) DEFAULT NULL,
  `pelanggan_image` varchar(100) DEFAULT NULL,
  `pelanggan_userinput` char(32) DEFAULT NULL,
  `pelanggan_status` enum('Aktif','Tidak Aktif') DEFAULT NULL,
  PRIMARY KEY (`pelanggan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `pelanggan` */

insert  into `pelanggan`(`pelanggan_id`,`pelanggan_nama`,`pelanggan_alamat`,`peanggan_kontak`,`pelanggan_email`,`pelanggan_image`,`pelanggan_userinput`,`pelanggan_status`) values 
(2,'Kadai Pak Mantab','Jl Mampang','0813-1046-0892','bajoebel@gmail.com',NULL,NULL,'Aktif'),
(3,'Kadai Pak Udin','Jl Mampang','0813-1046-0892','bajoebel@gmail.com',NULL,NULL,'Aktif');

/*Table structure for table `pemasok` */

DROP TABLE IF EXISTS `pemasok`;

CREATE TABLE `pemasok` (
  `pemasok_id` int(11) NOT NULL AUTO_INCREMENT,
  `pemasok_nama` varchar(100) DEFAULT NULL,
  `pemasok_alamat` varchar(100) DEFAULT NULL,
  `pemasok_kontak` varchar(15) DEFAULT NULL,
  `pemasok_userinput` char(32) DEFAULT NULL,
  `pemasok_status` enum('Aktif','Tidak Aktif') DEFAULT NULL,
  PRIMARY KEY (`pemasok_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `pemasok` */

insert  into `pemasok`(`pemasok_id`,`pemasok_nama`,`pemasok_alamat`,`pemasok_kontak`,`pemasok_userinput`,`pemasok_status`) values 
(1,'Default','JL. SUDIRMAN','0813-1046-0892','','Aktif');

/*Table structure for table `pembayaran_hutang` */

DROP TABLE IF EXISTS `pembayaran_hutang`;

CREATE TABLE `pembayaran_hutang` (
  `bayar_id` int(11) NOT NULL AUTO_INCREMENT,
  `bayar_tgl` date DEFAULT NULL,
  `bayar_hutangid` int(11) DEFAULT NULL,
  `bayar_jml` double DEFAULT NULL,
  `bayar_tutupbuku` enum('Belum','Sudah') DEFAULT 'Belum',
  `bayar_userinput` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`bayar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pembayaran_hutang` */

/*Table structure for table `penerimaan_piutang` */

DROP TABLE IF EXISTS `penerimaan_piutang`;

CREATE TABLE `penerimaan_piutang` (
  `terima_id` int(11) NOT NULL AUTO_INCREMENT,
  `terima_tgl` date DEFAULT NULL,
  `terima_piutangid` int(11) DEFAULT NULL,
  `terima_jumlah` double DEFAULT NULL,
  `terima_tutupbuku` enum('Belum','Sudah') DEFAULT 'Belum',
  `terima_userinput` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`terima_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `penerimaan_piutang` */

/*Table structure for table `piutang` */

DROP TABLE IF EXISTS `piutang`;

CREATE TABLE `piutang` (
  `piutang_id` int(11) NOT NULL AUTO_INCREMENT,
  `piutang_tgl` date DEFAULT NULL,
  `piutang_transaksi` varchar(3) DEFAULT 'PJ' COMMENT 'PJ=PENJUALAN',
  `piutang_koderef` int(11) DEFAULT NULL,
  `piutang_jml` double DEFAULT NULL,
  `piutang_tutupbuku` enum('Belum','Sudah') DEFAULT 'Belum',
  `piutang_userinput` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`piutang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `piutang` */

insert  into `piutang`(`piutang_id`,`piutang_tgl`,`piutang_transaksi`,`piutang_koderef`,`piutang_jml`,`piutang_tutupbuku`,`piutang_userinput`) values 
(1,'2021-12-18','PJ',1,144000,'Belum','admin');

/*Table structure for table `rak` */

DROP TABLE IF EXISTS `rak`;

CREATE TABLE `rak` (
  `rak_id` int(11) NOT NULL AUTO_INCREMENT,
  `rak_nama` varchar(100) DEFAULT NULL,
  `rak_status` enum('Aktif','Tidak Aktif') DEFAULT NULL,
  `rak_userinput` char(32) DEFAULT NULL,
  PRIMARY KEY (`rak_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `rak` */

insert  into `rak`(`rak_id`,`rak_nama`,`rak_status`,`rak_userinput`) values 
(3,'RAK 1','Aktif','admin'),
(4,'Rak 2','Aktif','');

/*Table structure for table `tmp_beli` */

DROP TABLE IF EXISTS `tmp_beli`;

CREATE TABLE `tmp_beli` (
  `tmp_id` int(11) NOT NULL AUTO_INCREMENT,
  `tmp_barangid` int(11) DEFAULT NULL,
  `tmp_jumlah` double DEFAULT NULL,
  `tmp_hargasatuan` decimal(19,2) DEFAULT NULL,
  `tmp_hpppcs` decimal(19,2) DEFAULT NULL,
  `tmp_konversisatuan` int(11) DEFAULT NULL,
  `tmp_diskon` double DEFAULT NULL,
  `tmp_satuan` varchar(20) DEFAULT NULL,
  `tmp_session` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`tmp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tmp_beli` */

/*Table structure for table `tmp_jual` */

DROP TABLE IF EXISTS `tmp_jual`;

CREATE TABLE `tmp_jual` (
  `tmp_id` int(11) NOT NULL AUTO_INCREMENT,
  `tmp_jualtipe` enum('Ecer','Grosir') DEFAULT NULL,
  `tmp_tipeharga` int(11) DEFAULT NULL,
  `tmp_barangid` int(11) DEFAULT NULL,
  `tmp_jumlah` double DEFAULT NULL,
  `tmp_hargasatuan` double DEFAULT NULL,
  `tmp_konversisatuan` int(11) DEFAULT NULL,
  `tmp_diskon` double DEFAULT NULL,
  `tmp_satuan` varchar(20) DEFAULT NULL,
  `tmp_session` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`tmp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tmp_jual` */

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `transaksi_id` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi_tgl` date DEFAULT NULL,
  `transaksi_akun_id` int(11) DEFAULT NULL,
  `transaksi_jumlah` double DEFAULT NULL,
  `transaksi_catatan` varchar(200) DEFAULT NULL,
  `transksi_tglinput` date DEFAULT NULL,
  `transaksi_tglupdate` date DEFAULT NULL,
  `transksi_userinput` char(32) DEFAULT NULL,
  `transaksi_userupdate` char(32) DEFAULT NULL,
  PRIMARY KEY (`transaksi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

/*Table structure for table `tutupbuku` */

DROP TABLE IF EXISTS `tutupbuku`;

CREATE TABLE `tutupbuku` (
  `tutupbuku_id` int(11) NOT NULL AUTO_INCREMENT,
  `penjualan_akun_id` int(11) DEFAULT NULL,
  `pembelian_akun_id` int(11) DEFAULT NULL,
  `perkiraan_akun_id` int(11) DEFAULT NULL,
  `return_akun_id` int(11) DEFAULT NULL,
  `piutang_akun_id` int(11) DEFAULT NULL,
  `hutang_akun_id` int(11) DEFAULT NULL,
  `penerimaan_piutang` int(11) DEFAULT NULL,
  `pembayaran_hutang` int(11) DEFAULT NULL,
  PRIMARY KEY (`tutupbuku_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tutupbuku` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `username` char(32) NOT NULL,
  `user_password` char(32) NOT NULL DEFAULT '',
  `user_nama_lengkap` varchar(50) NOT NULL DEFAULT '',
  `user_jekel` enum('Laki-Laki','Perempuan') NOT NULL,
  `user_alamat` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_kontak` varchar(15) NOT NULL DEFAULT '',
  `user_status` enum('Aktif','Tidak Aktif') NOT NULL DEFAULT 'Tidak Aktif',
  `user_photo` varchar(15) NOT NULL DEFAULT '',
  `admin` enum('Y','N') NOT NULL DEFAULT 'Y',
  `user_group_id` int(11) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`username`,`user_password`,`user_nama_lengkap`,`user_jekel`,`user_alamat`,`user_email`,`user_kontak`,`user_status`,`user_photo`,`admin`,`user_group_id`) values 
('admin','4e483f033710620913c088e775ef4757','Administrator','Laki-Laki','Alamat','info@info.com','0813-1046-0892','Aktif','','Y',1),
('test','fd52150cae9cd60f6465d182d501f819','testing','Laki-Laki','test','test','8080','Aktif','','Y',1);

/* Trigger structure for table `barang_exp` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_insert_barang_exp` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_insert_barang_exp` AFTER INSERT ON `barang_exp` FOR EACH ROW BEGIN
	DECLARE new_stok_besar INT(11);
	DECLARE new_stok_kecil INT(11);
    
    UPDATE barang SET `barang_stok_kecil`=`barang_stok_kecil`-new.`exp_jml` WHERE `barang_id`=new.`exp_barang_id`;
    
	SELECT FLOOR(((`barang_stok_besar`*`barang_konversi`) + `barang_stok_kecil`) / `barang_konversi`) INTO new_stok_besar FROM barang WHERE `barang_id`=new.`exp_barang_id`;
	SELECT ((`barang_stok_besar`*`barang_konversi`) + `barang_stok_kecil`) % `barang_konversi` INTO new_stok_kecil FROM barang WHERE `barang_id`=new.`exp_barang_id`;
    
    UPDATE `barang` 
	SET `barang_stok_besar` = new_stok_besar,
	`barang_stok_kecil`= new_stok_kecil
	WHERE barang_id=new.exp_barang_id;
END */$$


DELIMITER ;

/* Trigger structure for table `barang_exp` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_update_barang_exp` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_update_barang_exp` AFTER UPDATE ON `barang_exp` FOR EACH ROW BEGIN
	DECLARE new_stok_besar INT(11);
	DECLARE new_stok_kecil INT(11);
    
    UPDATE barang SET `barang_stok_kecil`=`barang_stok_kecil`+old.`exp_jml`-new.`exp_jml` WHERE `barang_id`=new.`exp_barang_id`;
    
	SELECT FLOOR(((`barang_stok_besar`*`barang_konversi`) + `barang_stok_kecil`) / `barang_konversi`) INTO new_stok_besar FROM barang WHERE `barang_id`=new.`exp_barang_id`;
	SELECT ((`barang_stok_besar`*`barang_konversi`) + `barang_stok_kecil`) % `barang_konversi` INTO new_stok_kecil FROM barang WHERE `barang_id`=new.`exp_barang_id`;
    
    UPDATE `barang` 
	SET `barang_stok_besar` = new_stok_besar,
	`barang_stok_kecil`= new_stok_kecil
	WHERE barang_id=new.exp_barang_id;
END */$$


DELIMITER ;

/* Trigger structure for table `barang_exp` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_delete_barang_exp` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_delete_barang_exp` AFTER DELETE ON `barang_exp` FOR EACH ROW BEGIN
	DECLARE new_stok_besar INT(11);
	DECLARE new_stok_kecil INT(11);
    
    UPDATE barang SET `barang_stok_kecil`=`barang_stok_kecil`+old.`exp_jml` WHERE `barang_id`=old.`exp_barang_id`;
    
	SELECT FLOOR(((`barang_stok_besar`*`barang_konversi`) + `barang_stok_kecil`) / `barang_konversi`) INTO new_stok_besar FROM barang WHERE `barang_id`=old.`exp_barang_id`;
	SELECT ((`barang_stok_besar`*`barang_konversi`) + `barang_stok_kecil`) % `barang_konversi` INTO new_stok_kecil FROM barang WHERE `barang_id`=old.`exp_barang_id`;
    
    UPDATE `barang` 
	SET `barang_stok_besar` = new_stok_besar,
	`barang_stok_kecil`= new_stok_kecil
	WHERE barang_id=old.exp_barang_id;
END */$$


DELIMITER ;

/* Trigger structure for table `barang_rusak` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_insert_barang_rusak` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_insert_barang_rusak` AFTER INSERT ON `barang_rusak` FOR EACH ROW BEGIN
	DECLARE new_stok_besar INT(11);
	DECLARE new_stok_kecil INT(11);
    UPDATE barang SET `barang_stok_kecil`=`barang_stok_kecil`-new.`rusak_jumlah` WHERE `barang_id`=new.`rusak_barang_id`;
    
	SELECT FLOOR(((`barang_stok_besar`*`barang_konversi`) + `barang_stok_kecil`) / `barang_konversi`) INTO new_stok_besar FROM barang WHERE `barang_id`=new.`rusak_barang_id`;
	SELECT ((`barang_stok_besar`*`barang_konversi`) + `barang_stok_kecil`) % `barang_konversi` INTO new_stok_kecil FROM barang WHERE `barang_id`=new.`rusak_barang_id`;
    
    UPDATE `barang` 
	SET `barang_stok_besar` = new_stok_besar,
	`barang_stok_kecil`= new_stok_kecil
	WHERE barang_id=new.rusak_barang_id;
END */$$


DELIMITER ;

/* Trigger structure for table `barang_rusak` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_update_barang_rusak` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_update_barang_rusak` AFTER UPDATE ON `barang_rusak` FOR EACH ROW BEGIN
	DECLARE new_stok_besar INT(11);
	DECLARE new_stok_kecil INT(11);
    UPDATE barang SET `barang_stok_kecil`=`barang_stok_kecil` + old.`rusak_jumlah`-new.`rusak_jumlah` WHERE `barang_id`=new.`rusak_barang_id`;
    
	SELECT FLOOR(((`barang_stok_besar`*`barang_konversi`) + `barang_stok_kecil`) / `barang_konversi`) INTO new_stok_besar FROM barang WHERE `barang_id`=new.`rusak_barang_id`;
	SELECT ((`barang_stok_besar`*`barang_konversi`) + `barang_stok_kecil`) % `barang_konversi` INTO new_stok_kecil FROM barang WHERE `barang_id`=new.`rusak_barang_id`;
    
    UPDATE `barang` 
	SET `barang_stok_besar` = new_stok_besar,
	`barang_stok_kecil`= new_stok_kecil
	WHERE barang_id=new.rusak_barang_id;
END */$$


DELIMITER ;

/* Trigger structure for table `barang_rusak` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_delete_barang_rusak` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_delete_barang_rusak` AFTER DELETE ON `barang_rusak` FOR EACH ROW BEGIN
	DECLARE new_stok_besar INT(11);
	DECLARE new_stok_kecil INT(11);
    UPDATE barang SET `barang_stok_kecil`=`barang_stok_kecil`+old.`rusak_jumlah` WHERE `barang_id`=old.`rusak_barang_id`;
    
	SELECT FLOOR(((`barang_stok_besar`*`barang_konversi`) + `barang_stok_kecil`) / `barang_konversi`) INTO new_stok_besar FROM barang WHERE `barang_id`=old.`rusak_barang_id`;
	SELECT ((`barang_stok_besar`*`barang_konversi`) + `barang_stok_kecil`) % `barang_konversi` INTO new_stok_kecil FROM barang WHERE `barang_id`=old.`rusak_barang_id`;
    
    UPDATE `barang` 
	SET `barang_stok_besar` = new_stok_besar,
	`barang_stok_kecil`= new_stok_kecil
	WHERE barang_id=old.rusak_barang_id;
END */$$


DELIMITER ;

/* Trigger structure for table `detail_jual` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_insert_detail_jual` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_insert_detail_jual` AFTER INSERT ON `detail_jual` FOR EACH ROW BEGIN
	declare new_stok_besar int(11);
	declare new_stok_kecil int(11);
	
	if new.`detail_jual_tipe`='Ecer' then
		UPDATE barang SET `barang_stok_kecil`=`barang_stok_kecil` - new.`detail_jumlah` WHERE `barang_id`=new.`detail_barang_id`;
	else
		UPDATE barang SET `barang_stok_besar`=`barang_stok_besar` - new.`detail_jumlah` WHERE `barang_id`=new.`detail_barang_id`;
	end if;
	
	SELECT FLOOR(((`barang_stok_besar`*`barang_konversi`) + `barang_stok_kecil`) / `barang_konversi`) INTO new_stok_besar FROM barang WHERE `barang_id`=new.`detail_barang_id`;
	SELECT ((`barang_stok_besar`*`barang_konversi`) + `barang_stok_kecil`) % `barang_konversi` INTO new_stok_kecil FROM barang WHERE `barang_id`=new.`detail_barang_id`;
	UPDATE `barang` 
	SET `barang_stok_besar` = new_stok_besar,
	`barang_stok_kecil`= new_stok_kecil
	WHERE barang_id=new.detail_barang_id;
    END */$$


DELIMITER ;

/* Trigger structure for table `detail_jual` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_update_detail_jual` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_update_detail_jual` AFTER UPDATE ON `detail_jual` FOR EACH ROW BEGIN
	DECLARE new_stok_besar INT(11);
	DECLARE new_stok_kecil INT(11);
	IF new.`detail_jual_tipe`='Ecer' THEN
		UPDATE barang SET `barang_stok_kecil`=(`barang_stok_kecil` + old.`detail_jumlah`) - new.`detail_jumlah` WHERE `barang_id`=new.`detail_barang_id`;
		
	ELSE
		UPDATE barang SET `barang_stok_besar`=(`barang_stok_besar` + old.`detail_jumlah`) - new.`detail_jumlah` WHERE `barang_id`=new.`detail_barang_id`;
	END IF;
	
	SELECT FLOOR(((`barang_stok_besar`*`barang_konversi`) + `barang_stok_kecil`) / `barang_konversi`) INTO new_stok_besar FROM barang WHERE `barang_id`=new.`detail_barang_id`;
	SELECT ((`barang_stok_besar`*`barang_konversi`) + `barang_stok_kecil`) % `barang_konversi` INTO new_stok_kecil FROM barang WHERE `barang_id`=new.`detail_barang_id`;
	UPDATE `barang` 
	SET `barang_stok_besar` = new_stok_besar,
	`barang_stok_kecil`= new_stok_kecil
	WHERE barang_id=new.detail_barang_id;
    END */$$


DELIMITER ;

/* Trigger structure for table `detail_jual` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_delete_detail_jual` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_delete_detail_jual` AFTER DELETE ON `detail_jual` FOR EACH ROW BEGIN
	DECLARE new_stok_besar INT(11);
	DECLARE new_stok_kecil INT(11);
	
	IF old.`detail_jual_tipe`='Ecer' THEN
		UPDATE barang SET `barang_stok_kecil`=`barang_stok_kecil` + old.`detail_jumlah` WHERE `barang_id`=old.`detail_barang_id`;
	ELSE
		UPDATE barang SET `barang_stok_besar`=`barang_stok_besar` + old.`detail_jumlah` WHERE `barang_id`=old.`detail_barang_id`;
	END IF;
	
	SELECT FLOOR(((`barang_stok_besar`*`barang_konversi`) + `barang_stok_kecil`) / `barang_konversi`) INTO new_stok_besar FROM barang WHERE `barang_id`=old.`detail_barang_id`;
	SELECT ((`barang_stok_besar`*`barang_konversi`) + `barang_stok_kecil`) % `barang_konversi` INTO new_stok_kecil FROM barang WHERE `barang_id`=old.`detail_barang_id`;
	UPDATE `barang` 
	SET `barang_stok_besar` = new_stok_besar,
	`barang_stok_kecil`= new_stok_kecil
	WHERE barang_id=old.detail_barang_id;
    END */$$


DELIMITER ;

/* Trigger structure for table `detail_masuk` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_insert_detail_masuk` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_insert_detail_masuk` AFTER INSERT ON `detail_masuk` FOR EACH ROW begin
	DECLARE new_stok_besar INT(11);
	DECLARE new_stok_kecil INT(11);
	UPDATE barang SET barang_harga_pokok_lama=barang_harga_pokok_baru, barang_harga_pokok_baru=new.detail_harga_satuan, barang_stok_besar=barang_stok_besar + new.detail_jumlah WHERE barang_id=new.detail_barang_id;
	
	
	SELECT FLOOR(((`barang_stok_besar`*`barang_konversi`) + `barang_stok_kecil`) / `barang_konversi`) INTO new_stok_besar FROM barang WHERE `barang_id`=new.`detail_barang_id`;
	SELECT ((`barang_stok_besar`*`barang_konversi`) + `barang_stok_kecil`) % `barang_konversi` INTO new_stok_kecil FROM barang WHERE `barang_id`=new.`detail_barang_id`;
	UPDATE `barang` 
	SET `barang_stok_besar` = new_stok_besar,
	`barang_stok_kecil`= new_stok_kecil
	WHERE barang_id=new.detail_barang_id;
    end */$$


DELIMITER ;

/* Trigger structure for table `detail_masuk` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_update_detail_masuk` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_update_detail_masuk` AFTER UPDATE ON `detail_masuk` FOR EACH ROW begin 
	DECLARE new_stok_besar INT(11);
	DECLARE new_stok_kecil INT(11);
	UPDATE barang SET barang_harga_pokok_lama=barang_harga_pokok_baru, barang_harga_pokok_baru=old.detail_harga_satuan, barang_stok_besar=barang_stok_besar - old.detail_jumlah + new.detail_jumlah WHERE barang_id=new.detail_barang_id;
	
	SELECT FLOOR(((`barang_stok_besar`*`barang_konversi`) + `barang_stok_kecil`) / `barang_konversi`) INTO new_stok_besar FROM barang WHERE `barang_id`=new.`detail_barang_id`;
	SELECT ((`barang_stok_besar`*`barang_konversi`) + `barang_stok_kecil`) % `barang_konversi` INTO new_stok_kecil FROM barang WHERE `barang_id`=new.`detail_barang_id`;
	UPDATE `barang` 
	SET `barang_stok_besar` = new_stok_besar,
	`barang_stok_kecil`= new_stok_kecil
	WHERE barang_id=new.detail_barang_id;
    end */$$


DELIMITER ;

/* Trigger structure for table `detail_masuk` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_delete_detail_masuk` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_delete_detail_masuk` AFTER DELETE ON `detail_masuk` FOR EACH ROW begin
	DECLARE new_stok_besar INT(11);
	DECLARE new_stok_kecil INT(11);
	UPDATE barang SET barang_harga_pokok_lama=barang_harga_pokok_baru, barang_harga_pokok_baru=old.detail_harga_satuan, barang_stok_besar=barang_stok_besar - old.detail_jumlah WHERE barang_id=old.detail_barang_id;
	
	
	SELECT FLOOR(((`barang_stok_besar`*`barang_konversi`) + `barang_stok_kecil`) / `barang_konversi`) INTO new_stok_besar FROM barang WHERE `barang_id`=old.`detail_barang_id`;
	SELECT ((`barang_stok_besar`*`barang_konversi`) + `barang_stok_kecil`) % `barang_konversi` INTO new_stok_kecil FROM barang WHERE `barang_id`=old.`detail_barang_id`;
	UPDATE `barang` 
	SET `barang_stok_besar` = new_stok_besar,
	`barang_stok_kecil`= new_stok_kecil
	WHERE barang_id=old.detail_barang_id;
    end */$$


DELIMITER ;

/* Trigger structure for table `detail_return` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `after_insert_return_barang` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `after_insert_return_barang` AFTER INSERT ON `detail_return` FOR EACH ROW BEGIN
	declare id INT(11);
	declare jual_tipe VARCHAR(200);
    declare username VARCHAR(100);
    SELECT return_userinput INTO username FROM barang_return WHERE return_id=new.detail_return_id;
	SELECT detail_jual_tipe INTO jual_tipe FROM detail_jual WHERE detail_id=new.`detail_detail_jual_id`;
	select detail_barang_id INTO id from detail_jual where detail_id=new.`detail_detail_jual_id`;
	if new.`detail_alasan_return`='Rusak' then
		insert into `barang_rusak`(rusak_barang_id,rusak_jumlah,rusak_inputat,rusak_userinput) value(id,new.detail_jumlah,now(),username);
	elseif new.`detail_alasan_return` = 'Expire' THEN
		insert into `barang_exp` (exp_barang_id,exp_exp_date,exp_jml,exp_inputat,exp_userinput) value(id, now(), new.detail_jumlah,NOW(),username);
	
	end if;
    
	UPDATE barang SET `barang_stok_kecil`=`barang_stok_kecil`+ new.`detail_jumlah` WHERE `barang_id`=id;
    
	UPDATE `barang` 
	SET `barang_stok_besar` = FLOOR(((`barang_stok_besar`*`barang_konversi`) + `barang_stok_kecil`) / `barang_konversi`),
	`barang_stok_kecil`= ((`barang_stok_besar`*`barang_konversi`) + `barang_stok_kecil`) % `barang_konversi`
	WHERE `barang_id`=id;
    END */$$


DELIMITER ;

/*Table structure for table `v_barang` */

DROP TABLE IF EXISTS `v_barang`;

/*!50001 DROP VIEW IF EXISTS `v_barang` */;
/*!50001 DROP TABLE IF EXISTS `v_barang` */;

/*!50001 CREATE TABLE  `v_barang`(
 `barang_id` int(11) ,
 `barang_kode` varchar(15) ,
 `barang_kategori_id` int(11) ,
 `barang_rak_id` int(11) ,
 `barang_nama` varchar(100) ,
 `harga_modal` decimal(19,2) ,
 `stok` decimal(42,2) ,
 `barang_konversi` decimal(11,2) ,
 `barang_satuan_besar` varchar(35) ,
 `barang_satuan_kecil` varchar(35) ,
 `barang_min_stok` decimal(11,2) ,
 `stok_string` varchar(134) 
)*/;

/*Table structure for table `v_stokbarang` */

DROP TABLE IF EXISTS `v_stokbarang`;

/*!50001 DROP VIEW IF EXISTS `v_stokbarang` */;
/*!50001 DROP TABLE IF EXISTS `v_stokbarang` */;

/*!50001 CREATE TABLE  `v_stokbarang`(
 `barang_id` int(11) ,
 `barang_kode` varchar(15) ,
 `barang_nama` varchar(100) ,
 `tgl_masuk` date ,
 `harga_modal` decimal(19,2) ,
 `stok` decimal(42,2) ,
 `barang_konversi` decimal(11,2) ,
 `barang_satuan_besar` varchar(35) ,
 `barang_satuan_kecil` varchar(35) ,
 `stok_string` varchar(134) 
)*/;

/*Table structure for table `view_barang` */

DROP TABLE IF EXISTS `view_barang`;

/*!50001 DROP VIEW IF EXISTS `view_barang` */;
/*!50001 DROP TABLE IF EXISTS `view_barang` */;

/*!50001 CREATE TABLE  `view_barang`(
 `barang_id` int(11) ,
 `barang_nama` varchar(100) ,
 `barang_stok_besar` decimal(11,2) ,
 `barang_satuan_besar` varchar(35) ,
 `barang_stok_kecil` decimal(11,2) ,
 `barang_satuan_kecil` varchar(35) ,
 `barang_konversi` decimal(11,2) ,
 `jml_stok_pcs` decimal(23,4) ,
 `harga_pokok_perbox` decimal(11,2) ,
 `harga_pokok_perpcs` decimal(17,6) ,
 `harga_jual_pcs` decimal(11,2) ,
 `harga_jual_grosir` decimal(11,2) ,
 `barang_diskon` decimal(11,2) 
)*/;

/*Table structure for table `view_hutang` */

DROP TABLE IF EXISTS `view_hutang`;

/*!50001 DROP VIEW IF EXISTS `view_hutang` */;
/*!50001 DROP TABLE IF EXISTS `view_hutang` */;

/*!50001 CREATE TABLE  `view_hutang`(
 `hutang_id` int(11) ,
 `hutang_faktur` char(15) ,
 `pemasok_nama` varchar(100) ,
 `hutang_tgl` date ,
 `hutang_jml` double ,
 `jml_bayar` double 
)*/;

/*Table structure for table `view_piutang` */

DROP TABLE IF EXISTS `view_piutang`;

/*!50001 DROP VIEW IF EXISTS `view_piutang` */;
/*!50001 DROP TABLE IF EXISTS `view_piutang` */;

/*!50001 CREATE TABLE  `view_piutang`(
 `piutang_id` int(11) ,
 `piutang_invoice` varchar(30) ,
 `pelanggan_nama` varchar(100) ,
 `piutang_tgl` date ,
 `piutang_jml` double ,
 `jumlah_bayar` double 
)*/;

/*View structure for view v_barang */

/*!50001 DROP TABLE IF EXISTS `v_barang` */;
/*!50001 DROP VIEW IF EXISTS `v_barang` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_barang` AS (select `a`.`barang_id` AS `barang_id`,`b`.`barang_kode` AS `barang_kode`,`b`.`barang_kategori_id` AS `barang_kategori_id`,`b`.`barang_rak_id` AS `barang_rak_id`,`b`.`barang_nama` AS `barang_nama`,max(`a`.`harga_modal`) AS `harga_modal`,(sum(`a`.`jml_masuk`) - sum(`a`.`jml_keluar`)) AS `stok`,`b`.`barang_konversi` AS `barang_konversi`,`b`.`barang_satuan_besar` AS `barang_satuan_besar`,`b`.`barang_satuan_kecil` AS `barang_satuan_kecil`,`b`.`barang_min_stok` AS `barang_min_stok`,concat(floor(((sum(`a`.`jml_masuk`) - sum(`a`.`jml_keluar`)) / `a`.`konversi_satuan`)),' ',`b`.`barang_satuan_besar`,' ',((sum(`a`.`jml_masuk`) - sum(`a`.`jml_keluar`)) % `a`.`konversi_satuan`),' ',`b`.`barang_satuan_kecil`) AS `stok_string` from (`log_transaksi` `a` join `barang` `b` on((`a`.`barang_id` = `b`.`barang_id`))) group by `a`.`barang_id`) */;

/*View structure for view v_stokbarang */

/*!50001 DROP TABLE IF EXISTS `v_stokbarang` */;
/*!50001 DROP VIEW IF EXISTS `v_stokbarang` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_stokbarang` AS (select `a`.`barang_id` AS `barang_id`,`b`.`barang_kode` AS `barang_kode`,`b`.`barang_nama` AS `barang_nama`,`a`.`tgl_masuk` AS `tgl_masuk`,max(`a`.`harga_modal`) AS `harga_modal`,(sum(`a`.`jml_masuk`) - sum(`a`.`jml_keluar`)) AS `stok`,`b`.`barang_konversi` AS `barang_konversi`,`b`.`barang_satuan_besar` AS `barang_satuan_besar`,`b`.`barang_satuan_kecil` AS `barang_satuan_kecil`,concat(floor(((sum(`a`.`jml_masuk`) - sum(`a`.`jml_keluar`)) / `a`.`konversi_satuan`)),' ',`b`.`barang_satuan_besar`,' ',((sum(`a`.`jml_masuk`) - sum(`a`.`jml_keluar`)) % `a`.`konversi_satuan`),' ',`b`.`barang_satuan_kecil`) AS `stok_string` from (`log_transaksi` `a` join `barang` `b` on((`a`.`barang_id` = `b`.`barang_id`))) group by `a`.`barang_id`,`a`.`harga_modal`,`a`.`tgl_masuk`) */;

/*View structure for view view_barang */

/*!50001 DROP TABLE IF EXISTS `view_barang` */;
/*!50001 DROP VIEW IF EXISTS `view_barang` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_barang` AS (select `barang`.`barang_id` AS `barang_id`,`barang`.`barang_nama` AS `barang_nama`,`barang`.`barang_stok_besar` AS `barang_stok_besar`,`barang`.`barang_satuan_besar` AS `barang_satuan_besar`,`barang`.`barang_stok_kecil` AS `barang_stok_kecil`,`barang`.`barang_satuan_kecil` AS `barang_satuan_kecil`,`barang`.`barang_konversi` AS `barang_konversi`,((`barang`.`barang_stok_besar` * `barang`.`barang_konversi`) + `barang`.`barang_stok_kecil`) AS `jml_stok_pcs`,`barang`.`barang_harga_pokok_baru` AS `harga_pokok_perbox`,(`barang`.`barang_harga_pokok_baru` / `barang`.`barang_konversi`) AS `harga_pokok_perpcs`,`barang`.`barang_harga_jual` AS `harga_jual_pcs`,`barang`.`barang_harga_grosir` AS `harga_jual_grosir`,`barang`.`barang_diskon` AS `barang_diskon` from `barang`) */;

/*View structure for view view_hutang */

/*!50001 DROP TABLE IF EXISTS `view_hutang` */;
/*!50001 DROP VIEW IF EXISTS `view_hutang` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_hutang` AS (select `hutang`.`hutang_id` AS `hutang_id`,`barang_masuk`.`masuk_nofaktur` AS `hutang_faktur`,`pemasok`.`pemasok_nama` AS `pemasok_nama`,`hutang`.`hutang_tgl` AS `hutang_tgl`,`hutang`.`hutang_jml` AS `hutang_jml`,sum(`pembayaran_hutang`.`bayar_jml`) AS `jml_bayar` from (((`hutang` left join `barang_masuk` on((`hutang`.`hutang_koderef` = `barang_masuk`.`masuk_id`))) left join `pemasok` on((`barang_masuk`.`masuk_pemasok_id` = `pemasok`.`pemasok_id`))) left join `pembayaran_hutang` on((`pembayaran_hutang`.`bayar_hutangid` = `hutang`.`hutang_id`))) group by `hutang`.`hutang_id`) */;

/*View structure for view view_piutang */

/*!50001 DROP TABLE IF EXISTS `view_piutang` */;
/*!50001 DROP VIEW IF EXISTS `view_piutang` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_piutang` AS (select `piutang`.`piutang_id` AS `piutang_id`,`barang_jual`.`jual_invoice` AS `piutang_invoice`,`pelanggan`.`pelanggan_nama` AS `pelanggan_nama`,`piutang`.`piutang_tgl` AS `piutang_tgl`,`piutang`.`piutang_jml` AS `piutang_jml`,sum(`penerimaan_piutang`.`terima_jumlah`) AS `jumlah_bayar` from (((`piutang` left join `barang_jual` on((`piutang`.`piutang_koderef` = `barang_jual`.`jual_id`))) left join `pelanggan` on((`barang_jual`.`jual_pelanggan_id` = `pelanggan`.`pelanggan_id`))) left join `penerimaan_piutang` on((`penerimaan_piutang`.`terima_piutangid` = `piutang`.`piutang_id`))) group by `piutang`.`piutang_id`) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
