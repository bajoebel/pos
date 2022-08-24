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

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
