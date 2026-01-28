-- MySQL dump 10.13  Distrib 5.7.43, for Linux (x86_64)
--
-- Host: localhost    Database: dev_mcmsf_com
-- ------------------------------------------------------
-- Server version	5.7.43-log

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
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `server_id` int(11) DEFAULT NULL,
  `content` text,
  `rating` tinyint(4) DEFAULT '0',
  `approved` tinyint(4) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,3,1,'测试',5,0,'2025-11-09 17:31:36');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_verifications`
--

DROP TABLE IF EXISTS `email_verifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_verifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_verifications`
--

LOCK TABLES `email_verifications` WRITE;
/*!40000 ALTER TABLE `email_verifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `email_verifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nteam_admin`
--

DROP TABLE IF EXISTS `nteam_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nteam_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `adminUser` varchar(255) NOT NULL COMMENT '管理员账号',
  `adminPwd` char(32) NOT NULL COMMENT '管理员密码',
  `adminQq` bigint(20) DEFAULT '1601349' COMMENT '管理员QQ',
  `adminLoginIp` varchar(15) DEFAULT NULL COMMENT '管理员IP',
  `adminRank` int(11) NOT NULL COMMENT '管理员等级',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nteam_admin`
--

LOCK TABLES `nteam_admin` WRITE;
/*!40000 ALTER TABLE `nteam_admin` DISABLE KEYS */;
INSERT INTO `nteam_admin` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3',1601349,'39.144.247.15',1);
/*!40000 ALTER TABLE `nteam_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nteam_config`
--

DROP TABLE IF EXISTS `nteam_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nteam_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `SiteName` varchar(255) NOT NULL COMMENT '网站名称',
  `Name` varchar(255) NOT NULL COMMENT '网站简称',
  `Descriptison` varchar(255) NOT NULL COMMENT '网站描述',
  `Keywords` varchar(255) NOT NULL COMMENT '网站关键词',
  `ICP` varchar(255) NOT NULL COMMENT 'ICP备案号',
  `Url` varchar(255) NOT NULL COMMENT '网址',
  `Index_Image` varchar(255) NOT NULL COMMENT '首页背景图',
  `Mail_Smtp` varchar(255) NOT NULL COMMENT 'SMTP地址',
  `Mail_Port` varchar(255) NOT NULL COMMENT 'SMTP端口',
  `Mail_Name` varchar(255) NOT NULL COMMENT '邮箱账号',
  `Mail_Pwd` varchar(255) NOT NULL COMMENT '邮箱密码（授权码）',
  `Captcha_Open` int(1) DEFAULT '1' COMMENT '是否启用人机验证',
  `hCaptcha_Sitekey` varchar(255) DEFAULT '' COMMENT 'hCaptcha Site Key',
  `Index_Fang` int(11) DEFAULT NULL COMMENT '防止xxs扒站JS开关',
  `Jump` int(11) DEFAULT NULL COMMENT 'QQVX打开提示跳转',
  `hCaptcha_Secretkey` varchar(255) DEFAULT 'ES_e8d2..' COMMENT 'hCaptcha Secret Key',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nteam_config`
--

LOCK TABLES `nteam_config` WRITE;
/*!40000 ALTER TABLE `nteam_config` DISABLE KEYS */;
INSERT INTO `nteam_config` VALUES (1,' MCMSF','浆果服 ','开源版','开源版','京ICP备1234566','dev.mcmsf.com','https://image.mcmsf.com/file/1767782927781_IMG_1125.png','smtp.qq.com','465','1233949940@qq.com','114514',1,'114514',0,0,'11414');
/*!40000 ALTER TABLE `nteam_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nteam_config_theme`
--

DROP TABLE IF EXISTS `nteam_config_theme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nteam_config_theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Index_About` varchar(255) NOT NULL COMMENT '首页的About模块',
  `Index_Services_t1` varchar(255) NOT NULL COMMENT '首页服务第一个板块的标题',
  `Index_Services_d1` varchar(255) NOT NULL COMMENT '首页服务第一个板块的内容',
  `Index_Services_t2` varchar(255) NOT NULL COMMENT '首页服务第二个板块的标题',
  `Index_Services_d2` varchar(255) NOT NULL COMMENT '首页服务第二个板块的内容',
  `Index_Services_t3` varchar(255) NOT NULL COMMENT '首页服务第三个板块的标题',
  `Index_Services_d3` varchar(255) NOT NULL COMMENT '首页服务第三个板块的内容',
  `Index_Services_t4` varchar(255) NOT NULL COMMENT '首页服务第四个板块的标题',
  `Index_Services_d4` varchar(255) NOT NULL COMMENT '首页服务第四个板块的内容',
  `Statistics_Id` varchar(255) NOT NULL COMMENT '统计ID',
  `Statistics_Dm` varchar(255) NOT NULL COMMENT '统计代码',
  `Index_Music` varchar(255) NOT NULL COMMENT '首页音乐',
  `Index_Tc` varchar(255) NOT NULL COMMENT '弹窗公告',
  `Notice` varchar(255) NOT NULL COMMENT '后台公告',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nteam_config_theme`
--

LOCK TABLES `nteam_config_theme` WRITE;
/*!40000 ALTER TABLE `nteam_config_theme` DISABLE KEYS */;
INSERT INTO `nteam_config_theme` VALUES (1,'开放的 Minecraft 服务器宣传平台，致力于连接服务器与玩家，提供服务器展示、资源共享与互动支持，共建自由协作的 Minecraft 多元生态','自行修改','自行修改.','自行修改','自行修改.','自行修改','自行修改.','自行修改','自行修改.','','','','欢迎来到mcmsf的beta页面!','欢迎使用 CoCo-Team<br>本程序适用于团队/工作室等类型<br>全站由Layui强力驱动，及Codebase后台模板的使用');
/*!40000 ALTER TABLE `nteam_config_theme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nteam_log`
--

DROP TABLE IF EXISTS `nteam_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nteam_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adminUser` varchar(255) NOT NULL COMMENT '操作者',
  `type` varchar(255) NOT NULL COMMENT '操作内容',
  `data` varchar(255) NOT NULL COMMENT '操作时间',
  `ip` varchar(255) NOT NULL COMMENT '操作ip',
  `city` varchar(255) NOT NULL COMMENT '操作地点',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nteam_log`
--

LOCK TABLES `nteam_log` WRITE;
/*!40000 ALTER TABLE `nteam_log` DISABLE KEYS */;
INSERT INTO `nteam_log` VALUES (1,'admin','登录后台中心','2025-12-02 18:08:48','39.144.102.101',''),(2,'admin','登录后台中心','2025-12-02 18:28:01','39.144.102.101',''),(3,'admin','修改了网站配置','2025-12-02 18:28:34','39.144.102.101',''),(4,'admin','修改了网站配置','2025-12-02 18:28:57','39.144.102.101',''),(5,'admin','修改了网站配置','2025-12-02 18:30:15','39.144.102.101',''),(6,'admin','修改了首页配置','2025-12-02 18:32:02','39.144.102.101',''),(7,'admin','登录后台中心','2025-12-05 12:56:19','111.25.241.153',''),(8,'admin','登录后台中心','2025-12-05 12:59:13','127.0.0.1',''),(9,'admin','修改了网站配置','2025-12-05 12:59:38','127.0.0.1',''),(10,'admin','修改了网站配置','2025-12-05 13:31:09','127.0.0.1',''),(11,'admin','登录后台中心','2025-12-05 16:41:36','127.0.0.1',''),(12,'admin','修改了ID为1的项目','2025-12-05 16:43:59','127.0.0.1',''),(13,'admin','登录后台中心','2025-12-16 06:05:48','39.144.100.186','吉林省长春市'),(14,'admin','修改了ID为1的项目','2025-12-16 06:07:32','39.144.100.186','吉林省长春市'),(15,'admin','登录后台中心','2025-12-20 17:01:59','127.0.0.1',''),(16,'admin','修改了ID为1的项目','2025-12-20 17:13:02','127.0.0.1',''),(17,'admin','修改了ID为1的项目','2025-12-20 17:25:53','127.0.0.1',''),(18,'admin','修改了ID为1的项目','2025-12-20 17:38:16','127.0.0.1',''),(19,'admin','修改了ID为1的项目','2025-12-20 17:47:08','127.0.0.1',''),(20,'admin','登录后台中心','2025-12-20 17:54:43','127.0.0.1',''),(21,'admin','修改了ID为1的项目','2025-12-20 18:01:44','127.0.0.1',''),(22,'admin','登录后台中心','2025-12-20 18:05:02','127.0.0.1',''),(23,'admin','添加了名为123456的项目','2025-12-20 18:06:39','127.0.0.1',''),(24,'admin','登录后台中心','2025-12-21 08:53:56','127.0.0.1',''),(25,'admin','登录后台中心','2025-12-21 11:24:16','127.0.0.1',''),(26,'admin','修改了ID为1的项目','2025-12-21 11:25:51','127.0.0.1',''),(27,'admin','修改了ID为1的项目','2025-12-21 11:36:07','127.0.0.1',''),(28,'admin','登录后台中心','2025-12-27 18:48:41','127.0.0.1',''),(29,'admin','登录后台中心','2026-01-01 23:05:40','39.144.100.118',''),(30,'admin','登录后台中心','2026-01-10 08:43:57','221.9.69.181','吉林省长春市'),(31,'admin','登录后台中心','2026-01-10 11:47:26','221.9.69.181',''),(32,'admin','添加了名为方联小世界 - MineFusion的项目','2026-01-10 12:07:14','221.9.69.181',''),(33,'admin','登录后台中心','2026-01-11 12:17:02','39.144.100.222','吉林省长春市'),(34,'admin','登录后台中心','2026-01-11 12:23:26','39.144.100.222',''),(35,'admin','添加了名为JDCmax服务器的项目','2026-01-11 12:32:07','39.144.100.222',''),(36,'admin','登录后台中心','2026-01-11 12:58:15','39.144.100.222',''),(37,'admin','删除了ID为3的项目','2026-01-11 12:58:24','39.144.100.222',''),(38,'admin','删除了ID为2的项目','2026-01-11 12:58:29','39.144.100.222','吉林省长春市'),(39,'admin','添加了名为FunnyArenaPixel服务器的项目','2026-01-11 13:03:34','39.144.100.222','吉林省长春市'),(40,'admin','添加了名为Orient服务器的项目','2026-01-11 13:11:51','124.234.164.56',''),(41,'admin','登录后台中心','2026-01-11 13:11:55','124.234.164.56','吉林省长春市'),(42,'admin','登录后台中心','2026-01-18 07:05:12','123.173.21.232','吉林省长春市'),(43,'admin','登录后台中心','2026-01-20 15:24:11','111.25.49.102',''),(44,'admin','登录后台中心','2026-01-22 17:06:45','111.25.248.235',''),(45,'admin','修改了网站配置','2026-01-22 17:08:15','111.25.248.235',''),(46,'admin','登录后台中心','2026-01-22 19:24:17','39.144.247.39',''),(47,'admin','登录后台中心','2026-01-23 12:59:49','111.25.248.191','吉林省吉林市'),(48,'admin','登录后台中心','2026-01-23 15:48:10','223.104.88.139',''),(49,'admin','登录后台中心','2026-01-23 20:54:26','223.74.10.74',''),(50,'admin','添加了一位名为admin的成员','2026-01-23 21:33:21','223.74.10.74',''),(51,'admin','登录后台中心','2026-01-24 15:37:15','223.74.10.74',''),(52,'admin','登录后台中心','2026-01-25 10:12:40','223.74.10.74','广东省湛江市'),(53,'admin','登录后台中心','2026-01-25 21:52:07','223.74.10.74',''),(54,'admin','登录后台中心','2026-01-25 22:52:07','223.74.10.74',''),(55,'admin','登录后台中心','2026-01-26 23:53:29','39.144.247.15',''),(56,'admin','删除了ID为1的项目','2026-01-26 23:53:43','39.144.247.15',''),(57,'admin','删除了ID为4的项目','2026-01-26 23:53:48','39.144.247.15',''),(58,'admin','删除了ID为5的项目','2026-01-26 23:53:51','39.144.247.15',''),(59,'admin','删除了ID为6的项目','2026-01-26 23:53:54','39.144.247.15',''),(60,'admin','删除了ID为7的项目','2026-01-26 23:53:57','39.144.247.15',''),(61,'admin','修改了网站配置','2026-01-26 23:54:23','39.144.247.15',''),(62,'admin','删除了ID为2的成员','2026-01-26 23:55:12','39.144.247.15',''),(63,'admin','删除了ID为1的成员','2026-01-26 23:55:16','39.144.247.15',''),(64,'admin','修改了首页配置','2026-01-26 23:56:37','39.144.247.15','');
/*!40000 ALTER TABLE `nteam_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nteam_project_list`
--

DROP TABLE IF EXISTS `nteam_project_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nteam_project_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '项目名',
  `url` varchar(255) NOT NULL COMMENT '项目网址',
  `img` varchar(255) NOT NULL COMMENT '项目图片地址',
  `img2` varchar(255) NOT NULL COMMENT '项目图片2',
  `img3` varchar(255) NOT NULL COMMENT '项目图片3',
  `sketch` varchar(255) NOT NULL COMMENT '项目简述（显示于首页）',
  `descriptison` varchar(255) NOT NULL COMMENT '项目描述',
  `money` varchar(255) NOT NULL COMMENT '项目售价',
  `version` varchar(255) NOT NULL COMMENT '项目版本号',
  `type` varchar(255) NOT NULL COMMENT '项目类型',
  `paycontact` varchar(255) DEFAULT NULL COMMENT '购买联系方式',
  `is_show` int(11) NOT NULL DEFAULT '0' COMMENT '是否显示首页',
  `Audit_status` int(11) NOT NULL DEFAULT '0' COMMENT '审核状态',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '项目运行状态',
  `intime` varchar(255) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nteam_project_list`
--

LOCK TABLES `nteam_project_list` WRITE;
/*!40000 ALTER TABLE `nteam_project_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `nteam_project_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nteam_team_member`
--

DROP TABLE IF EXISTS `nteam_team_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nteam_team_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '成员名称',
  `qq` varchar(255) NOT NULL COMMENT '成员QQ',
  `describe` varchar(255) NOT NULL COMMENT '成员简述',
  `teamimg` text COMMENT '成员背景图',
  `is_show` int(11) NOT NULL DEFAULT '0' COMMENT '是否显示首页',
  `Audit_status` int(11) NOT NULL DEFAULT '0' COMMENT '审核状态',
  `intime` varchar(255) NOT NULL COMMENT '加入时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nteam_team_member`
--

LOCK TABLES `nteam_team_member` WRITE;
/*!40000 ALTER TABLE `nteam_team_member` DISABLE KEYS */;
INSERT INTO `nteam_team_member` VALUES (3,'admin','qqqq','6:/^v8\"NrAJbu^\r\n7¥ MF168 iiBPUgUCmZq¥:/ \r\n##X-1hi828BedG8n59##','q',1,1,'2026-01-23 21:33:21');
/*!40000 ALTER TABLE `nteam_team_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rate_limits`
--

DROP TABLE IF EXISTS `rate_limits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rate_limits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rate_limits`
--

LOCK TABLES `rate_limits` WRITE;
/*!40000 ALTER TABLE `rate_limits` DISABLE KEYS */;
/*!40000 ALTER TABLE `rate_limits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servers`
--

DROP TABLE IF EXISTS `servers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `port` int(11) DEFAULT '25565',
  `description` text,
  `tags` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `status` enum('online','offline') DEFAULT 'offline',
  `online_players` int(11) DEFAULT '0',
  `max_players` int(11) DEFAULT '100',
  `votes` int(11) DEFAULT '0',
  `views` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `owner_id` (`owner_id`),
  CONSTRAINT `servers_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servers`
--

LOCK TABLES `servers` WRITE;
/*!40000 ALTER TABLE `servers` DISABLE KEYS */;
INSERT INTO `servers` VALUES (1,2,'生存天堂','play.example.com',25565,'示例生存服','生存,经济','png/logo.png',NULL,'offline',0,100,5,0,'2025-11-09 17:10:54'),(2,2,'PVP之都','pvp.example.com',25565,'示例PVP','pvp,竞技','png/logo.png',NULL,'offline',0,100,12,0,'2025-11-09 17:10:54');
/*!40000 ALTER TABLE `servers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `key` varchar(100) NOT NULL,
  `value` text,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(190) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('player','owner','admin') NOT NULL DEFAULT 'player',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `email_verified` tinyint(4) DEFAULT '0',
  `totp_secret` varchar(255) DEFAULT NULL,
  `totp_enabled` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin@mcmsf.local','$2y$10$H50Dn8eDbxLLtaP0IcBiieJXnlAFHQuLJ7dGnQsdSlE74ot.hSNOC','admin','2025-11-09 17:10:54',1,NULL,0),(2,'owner@mcmsf.local','$2y$10$1ZszJwvtXthfa9DFi5y2kOAvo4W1L24TdTFkc3rjlMCGxeowfqPFK','owner','2025-11-09 17:10:54',1,NULL,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `votes`
--

DROP TABLE IF EXISTS `votes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `server_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `server_id` (`server_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `votes`
--

LOCK TABLES `votes` WRITE;
/*!40000 ALTER TABLE `votes` DISABLE KEYS */;
/*!40000 ALTER TABLE `votes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'dev_mcmsf_com'
--

--
-- Dumping routines for database 'dev_mcmsf_com'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-01-27  0:03:54
