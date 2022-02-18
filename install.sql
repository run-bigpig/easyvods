-- MySQL dump 10.13  Distrib 5.7.34, for Linux (x86_64)
--
-- Host: localhost    Database: shujuku
-- ------------------------------------------------------
-- Server version	5.7.34-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ev_admins`
--

DROP TABLE IF EXISTS `ev_admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ev_admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '账号名称',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '密码',
  `nowloginip` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '当前登录IP',
  `nowlogintime` datetime DEFAULT NULL COMMENT '当前登录时间',
  `lastloginip` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '上次登录IP',
  `lastlogintime` datetime DEFAULT NULL COMMENT '上次登录时间',
  `api_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'token',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ev_admins`
--

LOCK TABLES `ev_admins` WRITE;
/*!40000 ALTER TABLE `ev_admins` DISABLE KEYS */;
INSERT INTO `ev_admins` VALUES (1,'admin','25f9e794323b453885f5181f1b624d0b','127.0.0.1','2022-02-18 15:13:38','127.0.0.1','2022-02-17 12:09:37','5nyjQyCq5yMO4wlAWUsB','2022-02-17 12:01:14','2022-02-18 15:13:38');
/*!40000 ALTER TABLE `ev_admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ev_configs`
--

DROP TABLE IF EXISTS `ev_configs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ev_configs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'EasyVod' COMMENT '网站名称',
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '网站logo',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin@easyvods.com' COMMENT '站长邮箱',
  `icp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ICP',
  `keywords` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'easyvod' COMMENT '网站关键字',
  `content` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'easyvod' COMMENT '网站描述',
  `tj` mediumtext COLLATE utf8mb4_unicode_ci COMMENT '统计代码',
  `notice` mediumtext COLLATE utf8mb4_unicode_ci COMMENT '网站公告',
  `cache` tinyint(4) DEFAULT NULL COMMENT '全站缓存 0关闭 1开启',
  `method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'qihu' COMMENT '目标站',
  `template` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'dyxs' COMMENT '模板',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '网站状态 0关闭 1开启',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ev_configs`
--

LOCK TABLES `ev_configs` WRITE;
/*!40000 ALTER TABLE `ev_configs` DISABLE KEYS */;
INSERT INTO `ev_configs` VALUES (1,'easyvod','https://s3.bmp.ovh/imgs/2021/12/2b10e5863ed2cfae.png','admin@admin.com','xxxx','easyvod','easyvod','xxxx','测试公告',1,'qihu','dyxs',1,'2022-02-17 12:01:14','2022-02-17 12:01:14');
/*!40000 ALTER TABLE `ev_configs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ev_links`
--

DROP TABLE IF EXISTS `ev_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ev_links` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '友链名称',
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '友链地址',
  `sort` int(11) NOT NULL COMMENT '排序 数字越大越靠前',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态 0隐藏 1开启',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ev_links`
--

LOCK TABLES `ev_links` WRITE;
/*!40000 ALTER TABLE `ev_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `ev_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ev_players`
--

DROP TABLE IF EXISTS `ev_players`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ev_players` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '播放器名称',
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '播放器地址',
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '播放器分类',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ev_players`
--

LOCK TABLES `ev_players` WRITE;
/*!40000 ALTER TABLE `ev_players` DISABLE KEYS */;
INSERT INTO `ev_players` VALUES (1,'番茄资源站播放器','https://jiexi.8b5q.cn/player/jx.php?url=','fanqie','2022-02-18 15:44:08','2022-02-18 15:44:08'),(2,'QQ播放器','https://m3u8.okjx.cc:3389/ok.php?url=','qq','2022-02-18 15:46:21','2022-02-18 15:46:21'),(3,'乐视播放器','https://m3u8.okjx.cc:3389/ok.php?url=','le','2022-02-18 15:46:29','2022-02-18 15:46:29'),(4,'爱奇艺播放器','https://m3u8.okjx.cc:3389/ok.php?url=','iqiyi','2022-02-18 15:46:35','2022-02-18 15:46:35'),(5,'360kan播放器','https://m3u8.okjx.cc:3389/ok.php?url=','360kan','2022-02-18 15:46:42','2022-02-18 15:46:42'),(6,'PPTV播放器','https://m3u8.okjx.cc:3389/ok.php?url=','pptv','2022-02-18 15:46:50','2022-02-18 15:46:50'),(7,'M1905播放器','https://m3u8.okjx.cc:3389/ok.php?url=','1905','2022-02-18 15:46:58','2022-02-18 15:46:58'),(8,'优酷播放器','https://m3u8.okjx.cc:3389/ok.php?url=','youku','2022-02-18 15:47:05','2022-02-18 15:47:05'),(9,'芒果TV播放器','https://m3u8.okjx.cc:3389/ok.php?url=','mgtv','2022-02-18 15:47:14','2022-02-18 15:47:14'),(10,'华数播放器','https://m3u8.okjx.cc:3389/ok.php?url=','wasu','2022-02-18 15:47:29','2022-02-18 15:47:29'),(11,'搜狐播放器','https://m3u8.okjx.cc:3389/ok.php?url=','sohu','2022-02-18 15:47:35','2022-02-18 15:47:35'),(12,'乐多播放器','https://api.ldjx.cc/wp-api/ifr.php?vid=','leduo','2022-02-18 15:50:38','2022-02-18 15:50:38'),(14,'聚合资源播放器','https://jx.juhesys.com/jiexi/?url=','tpm3u8','2022-02-18 15:55:26','2022-02-18 15:55:26'),(15,'无尽云播放器','https://jx.xhswglobal.com/dplayer/?url=','wjm3u8','2022-02-18 15:57:21','2022-02-18 15:57:21');
/*!40000 ALTER TABLE `ev_players` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ev_sources`
--

DROP TABLE IF EXISTS `ev_sources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ev_sources` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '资源站名称',
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '资源站api地址',
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '播放器类型',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态 0关闭 1开启',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ev_sources`
--

LOCK TABLES `ev_sources` WRITE;
/*!40000 ALTER TABLE `ev_sources` DISABLE KEYS */;
INSERT INTO `ev_sources` VALUES (1,'乐多资源站','http://cj.leduocaiji.com/inc/api.php','leduo',1,'2022-02-18 15:24:47','2022-02-18 15:24:47'),(2,'无尽资源站','https://api.wujinapi.com/api.php/provide/vod/from/wjm3u8/at/xml/','wjm3u8',1,'2022-02-18 15:29:46','2022-02-18 15:56:03'),(3,'番茄资源站','https://api.fqzy.cc/api.php/provide/vod','fanqie',1,'2022-02-18 15:34:40','2022-02-18 15:34:40'),(4,'聚合资源站','https://ziyuan.juhesys.com/api.php/provide/vod/','tpm3u8',1,'2022-02-18 15:38:41','2022-02-18 15:38:41');
/*!40000 ALTER TABLE `ev_sources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2021_12_29_142401_create_ev_admins_table',1),(2,'2021_12_29_143327_create_ev_configs_table',1),(3,'2021_12_29_143334_create_ev_links_table',1),(4,'2021_12_29_143419_create_ev_sources_table',1),(5,'2021_12_29_144432_create_ev_players_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'shujuku'
--

--
-- Dumping routines for database 'shujuku'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-02-18 16:02:06
