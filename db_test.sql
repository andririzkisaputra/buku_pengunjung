/*
SQLyog Professional v12.5.1 (64 bit)
MySQL - 10.1.48-MariaDB-0ubuntu0.18.04.1 : Database - db_test
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_test` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_test`;

/*Table structure for table `anggota` */

DROP TABLE IF EXISTS `anggota`;

CREATE TABLE `anggota` (
  `anggota_id` int(45) NOT NULL AUTO_INCREMENT,
  `nomor_anggota` varchar(7) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `gambar` text,
  `is_active` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0 suspend\r\n1 aktif',
  `created_by` int(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`anggota_id`),
  KEY `created_by` (`created_by`),
  CONSTRAINT `anggota_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=187 DEFAULT CHARSET=utf8mb4;

/*Data for the table `anggota` */

insert  into `anggota`(`anggota_id`,`nomor_anggota`,`nama`,`gambar`,`is_active`,`created_by`,`created_at`,`updated_at`) values
(186,'43069','Andri Rizki','andri-rizki.jpg','1',49,'2021-11-22 11:41:03','2021-11-22 11:41:18');

/*Table structure for table `email_sent` */

DROP TABLE IF EXISTS `email_sent`;

CREATE TABLE `email_sent` (
  `email_sent_id` int(45) NOT NULL AUTO_INCREMENT,
  `email_to` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `pre_title` varchar(255) DEFAULT NULL,
  `msg_title` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `button` varchar(255) DEFAULT NULL,
  `attach` varchar(255) DEFAULT NULL,
  `is_sent` enum('0','1') DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_on` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`email_sent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `email_sent` */

/*Table structure for table `kehadiran` */

DROP TABLE IF EXISTS `kehadiran`;

CREATE TABLE `kehadiran` (
  `kehadiran_id` int(45) NOT NULL AUTO_INCREMENT,
  `anggota_id` int(15) DEFAULT NULL,
  `created_by` int(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(25) NOT NULL,
  PRIMARY KEY (`kehadiran_id`),
  KEY `nomor_anggota` (`anggota_id`),
  KEY `created_by` (`created_by`),
  CONSTRAINT `kehadiran_ibfk_2` FOREIGN KEY (`anggota_id`) REFERENCES `anggota` (`anggota_id`),
  CONSTRAINT `kehadiran_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4;

/*Data for the table `kehadiran` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` int(45) NOT NULL AUTO_INCREMENT,
  `client_id` varchar(255) DEFAULT NULL,
  `client_secret` varchar(40) DEFAULT NULL,
  `expires_in` varchar(255) DEFAULT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0.Tidak Aktif 1.Aktif',
  `role` enum('1','2') DEFAULT '2' COMMENT '1. Master 2.User',
  `auth_key` varchar(45) DEFAULT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  `refresh_token` varchar(255) DEFAULT NULL,
  `token_type` varchar(255) DEFAULT NULL,
  `scope` varchar(255) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user` */

insert  into `user`(`user_id`,`client_id`,`client_secret`,`expires_in`,`nama`,`username`,`email`,`password_hash`,`status`,`role`,`auth_key`,`password_reset_token`,`access_token`,`refresh_token`,`token_type`,`scope`,`created_at`) values
(45,'prS2VyDDFMjwhbcS1pVsnTeae','MEDmLBl7jmbjAh-XDuodqqAyy0dbGWkEPqy',NULL,'andri','andri1997','andri.rizki007@gmail.com','$2y$13$i8VQ2.H5cs.HMjd6YB8Fu.txL1LQ7Xb/Cg9n4M6Nd8F1OQ9/V6WHe','1','1','KPcHGH3lNbrLXNX0tK5j4QoODr3hUmfJk0-10AAL',NULL,NULL,NULL,'Bearer','app','2021-11-22 11:17:11'),
(49,'Sjv-sTUc__3gS788akkXpu8lX','9V8KYwNuRIEBP8Mk_Sr1qLSgqxx6R-i8w01',NULL,'rapli','rapli007','rapli@gmail.com','$2y$13$2u1VKrU/YG8f92zETyOC7e8sHU3HNdWaoHr14emTDopVwt74WXeMG','1','2','JB3vmk3cU6MognefTTXoeuo2yXapauy8y_fXBd1O',NULL,NULL,NULL,'Bearer','app','2021-11-22 11:55:40');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
