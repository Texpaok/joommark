CREATE TABLE IF NOT EXISTS `#__joommark_traffic` (
  `id` int(11) NOT NULL auto_increment,
  `ip` varchar(50) NOT NULL DEFAULT '0.0.0.0',
  `browser` varchar(255) NOT NULL,
  `browser_version` varchar(255) NOT NULL,
  `platform` varchar(255) NOT NULL,
  `referer` varchar(255) NOT NULL,
  `country_code` varchar( 10 ) ,
  `country_name` varchar( 50 ) ,
  `city` varchar( 50 ) ,
  PRIMARY KEY  (`id`),
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;