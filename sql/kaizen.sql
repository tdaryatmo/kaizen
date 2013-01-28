
/*!40000 DROP DATABASE IF EXISTS `kaizen`*/;

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `kaizen` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `kaizen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `key` varchar(100) DEFAULT NULL,
  `emailtype` varchar(20) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
INSERT INTO `tbl_users` VALUES (1,'rikih.gunawan@gmail.com','a1b9c5bf39571b4583c7fa181ad18009','Rikih','Gunawan','5d2dde803f34b7c0516899249d1d2b03','Home','Male'),(2,'tia_daryatmo@yahoo.com',NULL,'Tia','Daryatmo',NULL,'Home','female');
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_users_temp` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `key` varchar(100) DEFAULT NULL,
  `emailtype` varchar(20) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
