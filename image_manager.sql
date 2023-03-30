/*
SQLyog Trial v13.1.9 (64 bit)
MySQL - 10.4.25-MariaDB : Database - image_manager
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `accounts` */

DROP TABLE IF EXISTS `accounts`;

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mobilenumber` bigint(10) NOT NULL,
  `creationdate` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `profilepic` varchar(200) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Data for the table `accounts` */

insert  into `accounts`(`id`,`username`,`password`,`role`,`email`,`mobilenumber`,`creationdate`,`profilepic`) values 
(1,'user1','user1','admin','user1@gmail.com',5454987631,'2023-03-27 13:11:37','d41d8cd98f00b204e9800998ecf8427e1623675469.jpg'),
(2,'user2','user2','admin','user2@gmail.com',7897984564,'2023-03-29 10:59:31','d41d8cd98f00b204e9800998ecf8427e1679794178.jpg'),
(3,'user3','user3','editor','user3@gmail.com',1235424464,'2023-03-27 13:10:28','d41d8cd98f00b204e9800998ecf8427e1623663398.jpg'),
(4,'user4','user4','editor','user4@gmail.com',1233432413,'2023-03-27 13:11:44','7215ee9c7d9dc229d2921a40e899ec5f1679941759jfif');

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT 0,
  `category_name` varchar(255) DEFAULT 'NULL',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

/*Data for the table `categories` */

insert  into `categories`(`id`,`parent_id`,`category_name`) values 
(19,0,'Phone'),
(20,0,'Computer'),
(21,0,'Clothes'),
(22,0,'Sheos'),
(23,0,'Furniture');

/*Table structure for table `images` */

DROP TABLE IF EXISTS `images`;

CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'NULL',
  `sku` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'NULL',
  `created` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Active, 0=Inactive',
  `tag` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'NULL',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `images` */

insert  into `images`(`id`,`file_name`,`category`,`sku`,`created`,`status`,`tag`) values 
(1,'1c1fd25a-262c-486d-ab96-79f56ad3caf0.jfif','NULL','NULL','2023-03-28 12:21:36',1,'NULL'),
(2,'62bdc455-42cb-480d-961c-b47b69bdd7a8.jfif','NULL','NULL','2023-03-28 12:23:19',1,'NULL'),
(3,'537c8c28-ef51-491d-8c5b-a48a7ad2ccd0.jfif','NULL','NULL','2023-03-28 07:37:29',1,'NULL'),
(4,'32782da0-9cc1-452b-a512-80aae25b2719.jfif','Computer','MAC','2023-03-28 21:36:24',1,'Man'),
(5,'192056ab-ee9c-466a-a991-f193f45442d2.jfif','Phone','iPhone XR','2023-03-28 21:30:33',1,'NULL'),
(6,'a2a5216e-3888-4925-a66c-50478bfb1eda.jfif','Clothes','Autumn','2023-03-28 21:50:07',1,'NULL'),
(7,'c3763b0f-9507-46a3-8bb7-7bd48982bcbd.jfif','Sheos','Sports','2023-03-28 21:30:09',1,'NULL'),
(8,'c80293b9-a2e5-4576-9347-433150fe313b.jfif','Computer','DELL','2023-03-28 21:30:00',1,'NULL'),
(13,'d1ef359b-0e61-4840-b17a-88d20928e410.jfif','Computer','ThinkPad','2023-03-28 21:29:53',1,'NULL'),
(14,'e6ad5b07-b897-4d12-8e52-a84091d9e22f.jfif','NULL','NULL','2023-03-29 18:27:38',1,'NULL'),
(15,'fc9746ba-1d02-4449-8da9-b66a798fb710.jfif','NULL','NULL','2023-03-29 18:27:38',1,'NULL'),
(16,'fdf0cbc0-1ef1-4c60-baa6-3b16c58ac1e9.jfif','NULL','NULL','2023-03-29 18:27:38',1,'NULL'),
(17,'dc12b98c-7b32-49f8-8f65-3dec745e1e4c.jfif','Computer','DELL','2023-03-29 09:37:09',1,'Fashion'),
(18,'c3763b0f-9507-46a3-8bb7-7bd48982bcbd.jpg','NULL','NULL','2023-03-29 20:13:39',1,'NULL'),
(19,'6a470e81-e9cf-4839-871b-0ec4835281cd.jfif','NULL','NULL','2023-03-29 20:13:55',1,'NULL'),
(20,'6aa055d9-036e-48df-97af-c8482d2dcd93.jfif','NULL','NULL','2023-03-29 20:14:01',1,'NULL');

/*Table structure for table `sku` */

DROP TABLE IF EXISTS `sku`;

CREATE TABLE `sku` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT 0,
  `sku_name` varchar(255) DEFAULT 'NULL',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

/*Data for the table `sku` */

insert  into `sku`(`id`,`parent_id`,`sku_name`) values 
(27,19,'iPhone'),
(28,19,'iPhone SE'),
(29,19,'iPhone XR'),
(33,21,'Spring'),
(34,21,'Summer'),
(35,21,'Autumn'),
(36,21,'Winter'),
(37,22,'Sports'),
(38,22,'Sandals'),
(39,11,'Spring'),
(40,20,'DELL'),
(41,20,'ThinkPad'),
(44,20,'MAC');

/*Table structure for table `super-admin` */

DROP TABLE IF EXISTS `super-admin`;

CREATE TABLE `super-admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mobilenumber` bigint(10) NOT NULL,
  `creationdate` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `profilepic` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `super-admin` */

insert  into `super-admin`(`id`,`username`,`password`,`role`,`email`,`mobilenumber`,`creationdate`,`profilepic`) values 
(1,'unicorn','unicorn','super-admin','sinceresolution36@gmail.com',1324987631,'2023-03-27 05:42:12','super-admin.jpg');

/*Table structure for table `tag` */

DROP TABLE IF EXISTS `tag`;

CREATE TABLE `tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(255) DEFAULT 'NULL',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `tag` */

insert  into `tag`(`id`,`tag_name`) values 
(2,'Fashion'),
(3,'Man'),
(4,'Women');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
