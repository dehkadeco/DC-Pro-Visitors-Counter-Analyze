CREATE TABLE IF NOT EXISTS `#__pro_counter_browsers` (
`id` int(11)   NOT NULL AUTO_INCREMENT,
  `browser_name` varchar(50) NOT NULL,
  `count_uniq_visits` int(11) NOT NULL,
  `is_mobile` tinyint(1) NOT NULL,
  `is_robot` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__pro_counter_latest_visitors` (
`id` int(11)   NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(25) NOT NULL,
  `user_agent` varchar(200) NOT NULL,
  `date_time` datetime NOT NULL,
   PRIMARY KEY (`id`),
   KEY (`ip_address`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `#__pro_counter_platforms` (
`id` int(11)  NOT NULL AUTO_INCREMENT,
  `platform` varchar(50) NOT NULL,
  `count_uniq_visits` int(11) NOT NULL,
  `is_mobile` tinyint(1) NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;




CREATE TABLE IF NOT EXISTS `#__pro_counter_visitors_days` (
`id` int(11)   NOT NULL AUTO_INCREMENT,
  `date_day` date NOT NULL,
  `counter_hits` int(11) NOT NULL,
  `counter_uniq_visitor` int(11) NOT NULL,
   PRIMARY KEY (`id`),
   KEY (`date_day`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `#__pro_counter_platforms` (`platform`, `count_uniq_visits`, `is_mobile`) VALUES
( 'Windows 10', 0, 0),
( 'Windows 8.1', 0, 0),
( 'Windows 8', 0, 0),
( 'Windows 7', 0, 0),
('Windows Vista', 0, 0),
( 'Windows Server 2003/XP x64', 0, 0),
('Windows XP', 0, 0),
( 'Windows 2000', 0, 0),
( 'Windows ME', 0, 0),
( 'Windows 98', 0, 0),
( 'Windows 95', 0, 0),
( 'Windows 3.11', 0, 0),
( 'Mac OS X', 0, 0),
( 'Mac OS 9', 0, 0),
( 'Linux', 0, 0),
( 'Ubuntu', 0, 0),
('Googlebot', 0, 0),
('Bingbot', 0,0),
('yahoobot', 0, 0),
( 'iPhone', 0, 1),
( 'iPod', 0, 1),
( 'iPad', 0, 1),
( 'Android', 0, 1),
('BlackBerry', 0, 1),
('Mobile', 0, 1),
('Windows Phone', 0, 1),
('other platform', 0, 0);
