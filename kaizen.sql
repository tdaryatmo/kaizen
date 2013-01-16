# HeidiSQL Dump 
#
# --------------------------------------------------------
# Host:                 127.0.0.1
# Database:             kaizen
# Server version:       5.5.8
# Server OS:            Win32
# Target-Compatibility: MySQL 5.0
# max_allowed_packet:   1048576
# HeidiSQL version:     3.2 Revision: 1129
# --------------------------------------------------------

/*!40100 SET CHARACTER SET latin1*/;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0*/;


#
# Database structure for database 'kaizen'
#

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `kaizen` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `kaizen`;


#
# Table structure for table 'tbl_users'
#

CREATE TABLE tbl_users (
  id int(10) NOT NULL AUTO_INCREMENT,
  email varchar(100) NOT NULL,
  password varchar(100) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=2 /*!40100 DEFAULT CHARSET=latin1*/;



#
# Dumping data for table 'tbl_users'
#

LOCK TABLES `tbl_users` WRITE;
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS*/;
REPLACE INTO tbl_users (`id`, `email`, `password`) VALUES
	(1,'tdaryatmo@gmail.com','0a834d514e44387811619f0b0b0d15e5');
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS*/;
UNLOCK TABLES;


#
# Table structure for table 'tbl_users_temp'
#

CREATE TABLE tbl_users_temp (
  id int(11) NOT NULL,
  email varchar(100) NOT NULL,
  temp_key varchar(100) NOT NULL
) ENGINE=InnoDB /*!40100 DEFAULT CHARSET=latin1*/;



#
# Dumping data for table 'tbl_users_temp'
#

# (No data found.)

/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS*/;
