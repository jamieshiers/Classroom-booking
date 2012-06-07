#
# Encoding: Unicode (UTF-8)
#


DROP TABLE IF EXISTS `announce`;
DROP TABLE IF EXISTS `bookings`;
DROP TABLE IF EXISTS `holidays`;
DROP TABLE IF EXISTS `periods`;
DROP TABLE IF EXISTS `rooms`;
DROP TABLE IF EXISTS `settings`;
DROP TABLE IF EXISTS `subjects`;
DROP TABLE IF EXISTS `swap`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `year`;


CREATE TABLE `announce` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_date` date DEFAULT NULL COMMENT '  ',
  `end_date` date DEFAULT NULL,
  `announcement` text,
  `title` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


CREATE TABLE `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class` varchar(128) DEFAULT NULL,
  `lesson` varchar(128) DEFAULT NULL,
  `room_id` varchar(50) DEFAULT '0',
  `period_id` varchar(50) DEFAULT '0',
  `date` date DEFAULT NULL,
  `block` int(2) DEFAULT '0',
  `week_num` int(2) DEFAULT '0',
  `user` varchar(128) DEFAULT NULL,
  `year_id` int(128) NOT NULL DEFAULT '1',
  `staff` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `year_end` date DEFAULT NULL,
  `room_admin` varchar(128) DEFAULT NULL,
  `responded` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=607 DEFAULT CHARSET=utf8;


CREATE TABLE `holidays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;


CREATE TABLE `periods` (
  `periodid` int(11) NOT NULL AUTO_INCREMENT COMMENT '  ',
  `period_name` varchar(128) DEFAULT NULL,
  `start_time` varchar(128) DEFAULT NULL,
  `end_time` varchar(128) DEFAULT NULL,
  `bookable` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`periodid`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;


CREATE TABLE `rooms` (
  `roomid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `bookable` tinyint(2) DEFAULT '0',
  `admin` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`roomid`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;


CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_name` text,
  `setting_value` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;


CREATE TABLE `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


CREATE TABLE `swap` (
  `booking_id` int(11) NOT NULL,
  `user` varchar(128) NOT NULL,
  `request_user` varchar(128) NOT NULL,
  `room_name` varchar(128) NOT NULL,
  `periods` varchar(128) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(128) DEFAULT NULL,
  `last_name` varchar(128) DEFAULT NULL,
  `username` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `user_group` varchar(128) DEFAULT NULL,
  `last_login` date DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `counter` int(128) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


CREATE TABLE `year` (
  `id` int(11) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `years` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year_name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;


SET FOREIGN_KEY_CHECKS = 0;


LOCK TABLES `announce` WRITE;
UNLOCK TABLES;


LOCK TABLES `bookings` WRITE;
UNLOCK TABLES;


LOCK TABLES `holidays` WRITE;
UNLOCK TABLES;


LOCK TABLES `periods` WRITE;
UNLOCK TABLES;


LOCK TABLES `rooms` WRITE;
UNLOCK TABLES;


LOCK TABLES `settings` WRITE;
INSERT INTO `settings` (`id`, `setting_name`, `setting_value`) VALUES (1, 'weeks', '1'), (2, 'Version', '0.1'), (3, 'ldap_standard_users', NULL), (7, 'ldap_disabled_users', 'CN=Students,OU=Groups,OU=CSE,DC=HOE,DC=Local;'), (4, 'ldap_admin_users', NULL), (8, 'ldap', '0'), (17, 'Week_2_name', 'Week 2'), (16, 'Week_1_name', 'Week 1');
UNLOCK TABLES;


LOCK TABLES `subjects` WRITE;
UNLOCK TABLES;


LOCK TABLES `swap` WRITE;
UNLOCK TABLES;


LOCK TABLES `users` WRITE;
INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `user_group`, `last_login`, `password`, `counter`) VALUES (1, 'A', 'User', 'superuser', 'info@digitalschool.co.uk', 'admin', '2011-10-24', '10160d7b5e756752ed0842987e3ad9080c8e369a', 0);
UNLOCK TABLES;


LOCK TABLES `year` WRITE;
INSERT INTO `year` (`id`, `name`, `date_start`, `date_end`) VALUES (1, 'YEAR', '2011-09-05', '2012-07-27');
UNLOCK TABLES;

LOCK TABLES `years` WRITE;
UNLOCK TABLES;


SET FOREIGN_KEY_CHECKS = 1;


