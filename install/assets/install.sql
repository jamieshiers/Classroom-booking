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
  `start_date` date DEFAULT NULL COMMENT '	',
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
  `periodid` int(11) NOT NULL AUTO_INCREMENT COMMENT '	',
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
  `periods` varchar(128) NOT NULL
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


CREATE TABLE `year` (
  `id` int(11) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




SET FOREIGN_KEY_CHECKS = 0;




LOCK TABLES `users` WRITE;
INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `user_group`, `last_login`, `password`) VALUES  (1, 'A', 'User', 'superuser', 'jamie@jamieshiers.co.uk', 'admin', '0000-00-00', '10160d7b5e756752ed0842987e3ad9080c8e369a');
UNLOCK TABLES;


SET FOREIGN_KEY_CHECKS = 1;


