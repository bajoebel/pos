/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.1.28-MariaDB : Database - db_grosir
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_grosir` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_grosir`;

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

insert  into `akun`(`akun_id`,`akun_kode`,`akun_nama`,`akun_jenis`,`akun_status`) values (1,'100','KAS AWAL','Debet','Aktif'),(2,'101','PIUTANG','Kredit','Aktif'),(3,'102','ASET BARANG DAGANG','Debet','Aktif'),(4,'103','PENJUALAN BARANG','Debet','Aktif'),(5,'104','PEMBELIAN BARANG','Kredit','Aktif'),(6,'105','RETURN BARANG','Kredit','Aktif'),(7,'106','HUTANG','Debet','Aktif'),(8,'107','PENERIMAAN PIUTANG','Debet','Aktif'),(9,'108','PEMBAYARAN HUTANG','Kredit','Aktif');

/*Table structure for table `barang` */

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `barang_id` int(11) NOT NULL AUTO_INCREMENT,
  `barang_kode` varchar(15) DEFAULT NULL,
  `barang_kategori_id` int(11) DEFAULT NULL,
  `barang_rak_id` int(11) DEFAULT NULL,
  `barang_nama` varchar(100) DEFAULT NULL,
  `barang_description` varchar(250) DEFAULT NULL,
  `barang_harga_pokok_lama` double DEFAULT NULL,
  `barang_harga_pokok_baru` double DEFAULT NULL,
  `barang_harga_jual` double DEFAULT NULL,
  `barang_harga_grosir` double DEFAULT NULL,
  `barang_diskon` int(11) DEFAULT '0',
  `barang_stok_besar` double DEFAULT NULL,
  `barang_stok_kecil` double DEFAULT NULL,
  `barang_satuan_besar` varchar(35) DEFAULT NULL,
  `barang_satuan_kecil` varchar(35) DEFAULT NULL,
  `barang_konversi` int(11) DEFAULT NULL,
  `barang_min_stok` int(11) DEFAULT NULL,
  `barang_image` varchar(100) DEFAULT NULL,
  `barang_userinput` char(32) DEFAULT NULL,
  `barang_status` enum('Aktif','Tidak Aktif') DEFAULT NULL,
  PRIMARY KEY (`barang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `barang` */

insert  into `barang`(`barang_id`,`barang_kode`,`barang_kategori_id`,`barang_rak_id`,`barang_nama`,`barang_description`,`barang_harga_pokok_lama`,`barang_harga_pokok_baru`,`barang_harga_jual`,`barang_harga_grosir`,`barang_diskon`,`barang_stok_besar`,`barang_stok_kecil`,`barang_satuan_besar`,`barang_satuan_kecil`,`barang_konversi`,`barang_min_stok`,`barang_image`,`barang_userinput`,`barang_status`) values (1,'809807',2,4,'Energen','Minuman Untuk Sarapan',20000,20000,1500,25000,0,4,2,'Kotak','PCS',20,5,'BRG_20171209203827.jpg','admin','Aktif'),(2,'809808',4,3,'Gulaku','Gula',144000,144000,15000,160000,0,2,3,'Lusin','PCS',12,5,'BRG_20171209210409.jpg','admin','Aktif'),(3,'809809',1,3,'Rinso 700Gr','Risnso',200000,200000,25000,250000,0,5,0,'Karton','PCS',10,5,'BRG_20171209204733.jpg','admin','Aktif'),(4,'998900',3,3,'Flecy','Flecy',300000,300000,17500,350000,0,3,0,'Box','Botol',20,5,'BRG_20171209211923.jpg','admin','Aktif'),(5,'7897009',3,3,'Downy','Downy',150000,150000,17500,175000,0,12,2,'Box','Pcs',10,5,'BRG_20171209210245.jpg','test','Aktif'),(6,'7897080',2,3,'Biskuat','Biskuat',100000,100000,6500,120000,0,27,18,'Box','Pcs',20,5,'BRG_20171209211613.jpg','admin','Aktif'),(7,'0099898789',1,3,'TEST','test',200000,200000,12000,250000,0,10,0,'BOX','PCS',20,10,'','test','Aktif');

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
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

/*Data for the table `barang_jual` */

insert  into `barang_jual`(`jual_id`,`jual_invoice`,`jual_tipe`,`jual_carabayar`,`jual_pelanggan_id`,`jual_tanggal`,`jual_tutup_buku`,`jual_userinput`) values (28,'INV/OK/VIII/2019/0001','Grosir',NULL,1,'2019-08-26','Sudah','test'),(29,'INV/OK/VIII/2019/0002','Grosir',NULL,1,'2019-08-26','Sudah','test'),(30,'INV/OK/VIII/2019/0003','Grosir',NULL,1,'2019-08-26','Sudah','test'),(31,'INV/OK/VIII/2019/0004','Grosir',NULL,1,'2019-08-26','Sudah','test'),(32,'INV/OK/VIII/2019/0005','Grosir','Kredit',1,'2019-08-26','Sudah','test'),(33,'INV/OK/VIII/2019/0006','Ecer','',1,'2019-08-27','Sudah','test'),(34,'INV/OK/VIII/2019/0007','Ecer','',1,'2019-08-28','Sudah','test'),(35,'INV/OK/III/2021/0008','Grosir','',1,'2021-03-04','Sudah','admin'),(36,'INV/OK/III/2021/0009','Grosir','',2,'2021-03-04','Sudah','admin'),(37,'INV/OK/IV/2021/0010','Grosir','',1,'2021-04-11','Sudah','admin');

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `barang_masuk` */

insert  into `barang_masuk`(`masuk_id`,`masuk_nofaktur`,`masuk_pemasok_id`,`masuk_carabayar`,`masuk_tanggal`,`masuk_tutup_buku`,`masuk_userinput`) values (9,'F-0000001',1,NULL,'2017-12-09','Sudah','admin'),(11,'00124545',1,NULL,'2019-08-16','Sudah','test'),(12,'00124545',1,NULL,'2019-08-16','Sudah','test'),(13,'99090889',1,NULL,'2019-08-27','Sudah','test'),(14,'FK00987878',1,'Tunai','2019-08-27','Sudah','test'),(15,'000154545',2,'Kredit','2019-08-27','Sudah','test'),(16,'9991988199',2,'Kredit','2019-08-27','Sudah','test'),(17,'',1,'Tunai','2021-04-11','Sudah','admin');

/*Table structure for table `barang_return` */

DROP TABLE IF EXISTS `barang_return`;

CREATE TABLE `barang_return` (
  `return_id` int(11) NOT NULL AUTO_INCREMENT,
  `return_jual_id` int(11) DEFAULT NULL,
  `return_tanggal` datetime DEFAULT NULL,
  `return_tutup_buku` enum('Sudah','Belum') DEFAULT 'Belum',
  `return_userinput` char(32) DEFAULT NULL,
  PRIMARY KEY (`return_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `barang_return` */

insert  into `barang_return`(`return_id`,`return_jual_id`,`return_tanggal`,`return_tutup_buku`,`return_userinput`) values (1,36,'2021-03-04 08:41:00','Sudah','admin');

/*Table structure for table `barang_rusak` */

DROP TABLE IF EXISTS `barang_rusak`;

CREATE TABLE `barang_rusak` (
  `rusak_id` int(11) NOT NULL AUTO_INCREMENT,
  `rusak_barang_id` int(11) DEFAULT NULL,
  `rusak_jumlah` int(11) DEFAULT NULL,
  `rusak_inputat` date DEFAULT NULL,
  `rusak_userinput` char(32) DEFAULT NULL,
  PRIMARY KEY (`rusak_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `barang_rusak` */

insert  into `barang_rusak`(`rusak_id`,`rusak_barang_id`,`rusak_jumlah`,`rusak_inputat`,`rusak_userinput`) values (1,5,10,'2021-03-04','admin');

/*Table structure for table `detail_jual` */

DROP TABLE IF EXISTS `detail_jual`;

CREATE TABLE `detail_jual` (
  `detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `detail_jual_id` int(11) DEFAULT NULL,
  `detail_jual_tipe` enum('Ecer','Grosir') DEFAULT NULL,
  `detail_barang_id` int(11) DEFAULT NULL,
  `detail_jumlah` double DEFAULT NULL,
  `detail_harga_satuan` double DEFAULT NULL,
  `detail_diskon` double DEFAULT NULL,
  `detail_status` enum('Pending','Return','Checkout') DEFAULT 'Pending',
  PRIMARY KEY (`detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

/*Data for the table `detail_jual` */

insert  into `detail_jual`(`detail_id`,`detail_jual_id`,`detail_jual_tipe`,`detail_barang_id`,`detail_jumlah`,`detail_harga_satuan`,`detail_diskon`,`detail_status`) values (42,28,'Grosir',5,10,150000,0,'Checkout'),(43,28,'Grosir',6,10,100000,0,'Checkout'),(44,29,'Grosir',2,10,140000,0,'Checkout'),(45,29,'Grosir',6,10,100000,0,'Checkout'),(46,30,'Grosir',5,10,150000,0,'Checkout'),(47,30,'Grosir',1,15,25000,10000,'Checkout'),(48,31,'Grosir',6,10,100000,0,'Checkout'),(49,31,'Grosir',5,10,150000,20000,'Checkout'),(50,32,'Grosir',6,10,100000,15000,'Checkout'),(51,32,'Grosir',5,15,150000,10000,'Checkout'),(52,33,'Ecer',5,3,17500,0,'Checkout'),(53,33,'Ecer',6,2,6500,0,'Checkout'),(54,34,'Ecer',5,5,17500,0,'Checkout'),(55,34,'Ecer',1,10,1500,0,'Checkout'),(56,35,'Grosir',6,1,6500,0,'Checkout'),(57,36,'Grosir',5,1,175000,0,'Checkout'),(58,37,'Grosir',6,1,120000,0,'Checkout'),(59,37,'Grosir',7,1,250000,0,'Checkout');

/*Table structure for table `detail_masuk` */

DROP TABLE IF EXISTS `detail_masuk`;

CREATE TABLE `detail_masuk` (
  `detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `detail_masuk_id` int(11) DEFAULT NULL,
  `detail_barang_id` int(11) DEFAULT NULL,
  `detail_jumlah` double DEFAULT '0',
  `detail_diskon` double DEFAULT NULL,
  `detail_harga_satuan` double DEFAULT NULL,
  PRIMARY KEY (`detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

/*Data for the table `detail_masuk` */

insert  into `detail_masuk`(`detail_id`,`detail_masuk_id`,`detail_barang_id`,`detail_jumlah`,`detail_diskon`,`detail_harga_satuan`) values (14,9,1,10,NULL,20000),(15,9,2,3,NULL,144000),(16,9,3,5,NULL,200000),(17,9,4,3,NULL,300000),(18,9,5,4,NULL,150000),(19,9,6,4,NULL,100000),(20,11,5,10,NULL,150000),(21,11,6,10,NULL,100000),(22,12,5,10,NULL,150000),(23,12,6,10,NULL,100000),(24,13,5,10,NULL,150000),(25,13,6,10,NULL,100000),(26,14,2,10,NULL,144000),(27,14,1,10,NULL,20000),(28,14,5,15,NULL,150000),(29,14,6,10,NULL,100000),(30,15,5,10,NULL,150000),(31,15,6,15,NULL,100000),(32,16,6,10,NULL,100000),(33,17,6,1,NULL,100000),(34,17,7,1,NULL,200000);

/*Table structure for table `detail_return` */

DROP TABLE IF EXISTS `detail_return`;

CREATE TABLE `detail_return` (
  `detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `detail_return_id` int(11) DEFAULT NULL,
  `detail_detail_jual_id` int(11) DEFAULT NULL,
  `detail_alasan_return` varchar(200) DEFAULT NULL,
  `detail_jumlah` double DEFAULT NULL,
  `detail_return_harga` double DEFAULT NULL,
  PRIMARY KEY (`detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `detail_return` */

insert  into `detail_return`(`detail_id`,`detail_return_id`,`detail_detail_jual_id`,`detail_alasan_return`,`detail_jumlah`,`detail_return_harga`) values (1,1,57,'Rusak',10,175000);

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

insert  into `group`(`group_id`,`group_name`,`status`,`admin`,`info1`,`info2`) values (1,'Administrator','Active','Y','','');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `hutang` */

insert  into `hutang`(`hutang_id`,`hutang_tgl`,`hutang_transaksi`,`hutang_koderef`,`hutang_jml`,`hutang_tutupbuku`,`hutang_userinput`) values (1,'2019-08-27','PB',12,2400000,'Sudah','test'),(2,'2019-08-27','PB',13,2400000,'Sudah','test'),(3,'2019-08-27','PB',15,2950000,'Sudah','test'),(4,'2019-08-27','PB',16,990000,'Sudah','test');

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_nama` varchar(100) DEFAULT NULL,
  `kategori_status` enum('Aktif','Tidak Aktif') DEFAULT NULL,
  `kategori_userinput` char(32) DEFAULT NULL,
  PRIMARY KEY (`kategori_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `kategori` */

insert  into `kategori`(`kategori_id`,`kategori_nama`,`kategori_status`,`kategori_userinput`) values (1,'Deterjen','Aktif',''),(2,'Biscuit','Aktif',''),(3,'Pewangi','Aktif',''),(4,'Sembako','Aktif','');

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

insert  into `moduls`(`moduls_id`,`moduls_title`,`moduls_url`,`moduls_parent_idx`,`moduls_child_idx`,`moduls_status`,`info1`,`info2`,`icon`) values (1,'Setting','#',100,0,'Active','','','fa fa-gear'),(2,'Modul','moduls',100,1,'Active','','',NULL),(3,'Group','group',100,2,'Active','','',NULL),(4,'User','users',100,3,'Active','','',NULL),(5,'Dasboard','dasboard',1,0,'Active','','','fa fa-home'),(6,'Moduls','#',2,0,'Non Active','','',NULL),(7,'Rak','rak',3,1,'Active','','',NULL),(8,'Kategori','kategori',3,2,'Active','','',NULL),(11,'Pemasok','pemasok',3,4,'Active','','',NULL),(12,'Pelanggan','pelanggan',3,5,'Active','','',NULL),(13,'Akun','akun',5,1,'Active','','',NULL),(18,'Pembelian','pembelian_barang',4,2,'Active','','',NULL),(20,'Barang','barang',3,3,'Active','','',NULL),(21,'Daftar barang masuk','daftar_barang_masuk',2,1,'Active','','',NULL),(24,'Penjualan','penjualan',4,1,'Active','','',NULL),(25,'Return','return_barang',4,3,'Active','','',NULL),(26,'Transaksi','transaksi',5,2,'Active','','','fa fa-bars'),(27,'Tutup Buku','tutupbuku',5,3,'Active','','',NULL),(28,'Barang Rusak','barang_rusak',3,6,'Active','','',NULL),(29,'Barang Expire','barang_exp',3,7,'Active','','',NULL),(30,'Laporan Barang','laporan/barang',6,1,'Active','','',NULL),(31,'Master','#',3,0,'Active','','','fa fa-bars'),(32,'Transaksi','#',4,0,'Active','','','fa fa-shopping-cart '),(33,'Report','#',6,0,'Active','','','fa fa-file-o'),(34,'Keuangan','#',5,0,'Active','','','fa fa fa-credit-card'),(35,'Laporan Barang Rusak','laporan/barang_rusak',6,2,'Active','','',NULL),(36,'Laporan Barang Expire','laporan/barang_exp',6,3,'Active','','',NULL),(37,'Laporan Penjualan','laporan/penjualan',6,4,'Active','','',NULL),(38,'Laporan Pembelian','laporan/pembelian',6,5,'Active','','',NULL),(39,'Laporan Return Barang','laporan/return_barang',6,6,'Active','','',NULL),(40,'Laporan Keuangan','laporan/keuangan',6,7,'Active','','',NULL),(41,'Penerimaan Piutang','piutang',4,4,'Active','','',NULL),(42,'Pembayaran Hutang','hutang',4,5,'Active','','',NULL);

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

insert  into `moduls_group`(`moduls_group_id`,`moduls_id`,`group_id`,`add1`,`update1`,`delete1`,`report1`) values (1,1,1,'Y','Y','Y','Y'),(2,2,1,'Y','Y','Y','Y'),(3,3,1,'Y','Y','Y','Y'),(4,4,1,'Y','Y','Y','Y'),(5,5,1,'Y','Y','Y','Y'),(6,6,1,'Y','Y','Y','Y'),(7,7,1,'Y','Y','Y','Y'),(8,8,1,'Y','Y','Y','Y'),(9,9,1,'Y','Y','Y','Y'),(10,10,1,'Y','Y','Y','Y'),(11,11,1,'Y','Y','Y','Y'),(12,12,1,'Y','Y','Y','Y'),(13,13,1,'Y','Y','Y','Y'),(14,14,1,'Y','Y','Y','Y'),(15,15,1,'Y','Y','Y','Y'),(16,16,1,'Y','Y','Y','Y'),(17,17,1,'Y','Y','Y','Y'),(18,18,1,'Y','Y','Y','Y'),(19,19,1,'Y','Y','Y','Y'),(20,20,1,'Y','Y','Y','Y'),(21,21,1,'Y','Y','Y','Y'),(22,22,1,'Y','Y','Y','Y'),(23,23,1,'Y','Y','Y','Y'),(24,24,1,'Y','Y','Y','Y'),(25,25,1,'Y','Y','Y','Y'),(26,26,1,'Y','Y','Y','Y'),(27,27,1,'Y','Y','Y','Y'),(28,28,1,'Y','Y','Y','Y'),(29,29,1,'Y','Y','Y','Y'),(30,30,1,'Y','Y','Y','Y'),(31,31,1,'Y','Y','Y','Y'),(32,32,1,'Y','Y','Y','Y'),(33,33,1,'Y','Y','Y','Y'),(34,35,1,'Y','Y','Y','Y'),(35,36,1,'Y','Y','Y','Y'),(36,37,1,'Y','Y','Y','Y'),(37,38,1,'Y','Y','Y','Y'),(38,39,1,'Y','Y','Y','Y'),(39,34,1,'Y','Y','Y','Y'),(40,40,1,'Y','Y','Y','Y'),(41,41,1,'Y','Y','Y','Y'),(42,42,1,'Y','Y','Y','Y');

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

insert  into `pelanggan`(`pelanggan_id`,`pelanggan_nama`,`pelanggan_alamat`,`peanggan_kontak`,`pelanggan_email`,`pelanggan_image`,`pelanggan_userinput`,`pelanggan_status`) values (1,'None','None','None','None',NULL,NULL,'Aktif'),(2,'Kadai Pak Mantab','Jl Mampang','0813-1046-0892','bajoebel@gmail.com',NULL,NULL,'Aktif'),(3,'Kadai Pak Udin','Jl Mampang','0813-1046-0892','bajoebel@gmail.com',NULL,NULL,'Aktif');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `pemasok` */

insert  into `pemasok`(`pemasok_id`,`pemasok_nama`,`pemasok_alamat`,`pemasok_kontak`,`pemasok_userinput`,`pemasok_status`) values (1,'Default','JL. SUDIRMAN','0813-1046-0892','','Aktif'),(2,'Toko Bagus','Jl. Bla Ba','0813-1046-0892','','Tidak Aktif');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `pembayaran_hutang` */

insert  into `pembayaran_hutang`(`bayar_id`,`bayar_tgl`,`bayar_hutangid`,`bayar_jml`,`bayar_tutupbuku`,`bayar_userinput`) values (5,'2019-08-27',4,200000,'Sudah','test'),(6,'2019-08-27',3,300000,'Sudah','test'),(7,'2019-08-27',4,100000,'Sudah','test'),(8,'2019-08-27',2,10000,'Sudah','test'),(9,'2019-08-27',1,20000,'Sudah','test');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `penerimaan_piutang` */

insert  into `penerimaan_piutang`(`terima_id`,`terima_tgl`,`terima_piutangid`,`terima_jumlah`,`terima_tutupbuku`,`terima_userinput`) values (1,'2019-08-27',2,10000,'Sudah','test'),(2,'2019-08-27',2,20000,'Sudah','test'),(3,'2019-08-27',2,10000,'Sudah','test'),(4,'2021-04-11',6,70000,'Sudah','admin'),(5,'2021-04-11',6,100000,'Sudah','admin'),(6,'2021-04-11',6,100000,'Sudah','admin'),(7,'2021-04-11',6,150000,'Sudah','admin');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `piutang` */

insert  into `piutang`(`piutang_id`,`piutang_tgl`,`piutang_transaksi`,`piutang_koderef`,`piutang_jml`,`piutang_tutupbuku`,`piutang_userinput`) values (2,'2019-08-27','PJ',33,65500,'Sudah','test'),(3,'2019-08-28','PJ',34,102500,'Sudah','test'),(4,'2021-03-04','PJ',35,6500,'Sudah','admin'),(5,'2021-03-04','PJ',36,175000,'Sudah','admin'),(6,'2021-04-11','PJ',37,370000,'Sudah','admin');

/*Table structure for table `rak` */

DROP TABLE IF EXISTS `rak`;

CREATE TABLE `rak` (
  `rak_id` int(11) NOT NULL AUTO_INCREMENT,
  `rak_nama` varchar(100) DEFAULT NULL,
  `rak_status` enum('Aktif','Tidak Aktif') DEFAULT NULL,
  `rak_userinput` char(32) DEFAULT NULL,
  PRIMARY KEY (`rak_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `rak` */

insert  into `rak`(`rak_id`,`rak_nama`,`rak_status`,`rak_userinput`) values (3,'RAK 1','Aktif','admin'),(4,'Rak 2','Aktif','');

/*Table structure for table `tmp_beli` */

DROP TABLE IF EXISTS `tmp_beli`;

CREATE TABLE `tmp_beli` (
  `tmp_id` int(11) NOT NULL AUTO_INCREMENT,
  `tmp_barangid` int(11) DEFAULT NULL,
  `tmp_jumlah` double DEFAULT NULL,
  `tmp_hargasatuan` double DEFAULT NULL,
  `tmp_diskon` double DEFAULT NULL,
  `tmp_session` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`tmp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tmp_beli` */

insert  into `tmp_beli`(`tmp_id`,`tmp_barangid`,`tmp_jumlah`,`tmp_hargasatuan`,`tmp_diskon`,`tmp_session`) values (2,6,10,100000,0,'65c70090452879d02f134525199a1f8d6c7c236d'),(3,5,15,150000,0,'65c70090452879d02f134525199a1f8d6c7c236d');

/*Table structure for table `tmp_jual` */

DROP TABLE IF EXISTS `tmp_jual`;

CREATE TABLE `tmp_jual` (
  `tmp_id` int(11) NOT NULL AUTO_INCREMENT,
  `tmp_jualtipe` enum('Ecer','Grosir') DEFAULT NULL,
  `tmp_barangid` int(11) DEFAULT NULL,
  `tmp_jumlah` double DEFAULT NULL,
  `tmp_hargasatuan` double DEFAULT NULL,
  `tmp_diskon` double DEFAULT NULL,
  `tmp_session` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`tmp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `tmp_jual` */

insert  into `tmp_jual`(`tmp_id`,`tmp_jualtipe`,`tmp_barangid`,`tmp_jumlah`,`tmp_hargasatuan`,`tmp_diskon`,`tmp_session`) values (1,'Ecer',5,2,17500,0,'0935b7e8139d999b51c5206c6cee5d077e22c365'),(2,'Grosir',6,1,120000,0,'b0737ibsfsud9pe31baejai8fgqh1ui7');

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
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

insert  into `transaksi`(`transaksi_id`,`transaksi_tgl`,`transaksi_akun_id`,`transaksi_jumlah`,`transaksi_catatan`,`transksi_tglinput`,`transaksi_tglupdate`,`transksi_userinput`,`transaksi_userupdate`) values (1,'2017-12-06',1,100000,'Kas Awal','2017-12-06','2017-12-06','admin','admin'),(78,NULL,3,8926000,'Barang Return Tanggal 2021-04-11','2021-04-11','2021-04-11','admin','admin'),(79,'2017-12-09',5,3532000,'Barang Masuk Tanggal 2017-12-09','2019-08-28','2019-08-28','admin','admin'),(80,'2019-08-26',4,12525000,'Penjualan Tanggal 2019-08-26','2019-08-28','2019-08-28','test','test'),(81,'2019-08-27',4,65500,'Penjualan Tanggal 2019-08-27','2019-08-28','2019-08-28','test','test'),(82,'2019-08-28',4,102500,'Penjualan Tanggal 2019-08-28','2019-08-28','2019-08-28','test','test'),(83,'2019-08-16',5,5000000,'Barang Masuk Tanggal 2019-08-16','2019-08-28','2019-08-28','test','test'),(84,'2019-08-27',5,11390000,'Barang Masuk Tanggal 2019-08-27','2019-08-28','2019-08-28','test','test'),(85,'2019-08-27',7,8740000,'Pembelian Kredit Tanggal 2019-08-27','2019-08-28','2019-08-28','test','test'),(86,'2019-08-27',2,65500,'Penjualan Kredit Tanggal 2019-08-27','2019-08-28','2019-08-28','test','test'),(87,'2019-08-28',2,102500,'Penjualan Kredit Tanggal 2019-08-28','2019-08-28','2019-08-28','test','test'),(88,'2019-08-27',9,630000,'Pembayaran Hutang Tanggal 2019-08-27','2019-08-28','2019-08-28','test','test'),(89,'2019-08-27',8,40000,'Pembayaran Hutang Tanggal 2019-08-27','2019-08-28','2019-08-28','test','test'),(90,'2021-03-04',4,181500,'Penjualan Tanggal 2021-03-04','2021-04-11','2021-04-11','admin','admin'),(91,'2021-04-11',4,370000,'Penjualan Tanggal 2021-04-11','2021-04-11','2021-04-11','admin','admin'),(92,'2021-04-11',5,300000,'Barang Masuk Tanggal 2021-04-11','2021-04-11','2021-04-11','admin','admin'),(93,'2021-03-04',6,175000,'Barang Return Tanggal 2021-03-04 08:41:00','2021-04-11','2021-04-11','admin','admin'),(94,'2021-03-04',2,181500,'Penjualan Kredit Tanggal 2021-03-04','2021-04-11','2021-04-11','admin','admin'),(95,'2021-04-11',2,370000,'Penjualan Kredit Tanggal 2021-04-11','2021-04-11','2021-04-11','admin','admin'),(96,'2021-04-11',8,420000,'Pembayaran Hutang Tanggal 2021-04-11','2021-04-11','2021-04-11','admin','admin');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tutupbuku` */

insert  into `tutupbuku`(`tutupbuku_id`,`penjualan_akun_id`,`pembelian_akun_id`,`perkiraan_akun_id`,`return_akun_id`,`piutang_akun_id`,`hutang_akun_id`,`penerimaan_piutang`,`pembayaran_hutang`) values (1,4,5,3,6,2,7,8,9);

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

insert  into `users`(`username`,`user_password`,`user_nama_lengkap`,`user_jekel`,`user_alamat`,`user_email`,`user_kontak`,`user_status`,`user_photo`,`admin`,`user_group_id`) values ('admin','4e483f033710620913c088e775ef4757','Administrator','Laki-Laki','Alamat','info@info.com','0813-1046-0892','Aktif','','Y',1),('test','fd52150cae9cd60f6465d182d501f819','testing','Laki-Laki','test','test','8080','Aktif','','Y',1);

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

/*Table structure for table `view_barang` */

DROP TABLE IF EXISTS `view_barang`;

/*!50001 DROP VIEW IF EXISTS `view_barang` */;
/*!50001 DROP TABLE IF EXISTS `view_barang` */;

/*!50001 CREATE TABLE  `view_barang`(
 `barang_id` int(11) ,
 `barang_nama` varchar(100) ,
 `barang_stok_besar` double ,
 `barang_satuan_besar` varchar(35) ,
 `barang_stok_kecil` double ,
 `barang_satuan_kecil` varchar(35) ,
 `barang_konversi` int(11) ,
 `jml_stok_pcs` double ,
 `harga_pokok_perbox` double ,
 `harga_pokok_perpcs` double ,
 `harga_jual_pcs` double ,
 `harga_jual_grosir` double ,
 `barang_diskon` int(11) 
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
