CREATE TABLE `TileServer` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `url` varchar(256) character set utf8 collate utf8_unicode_ci NOT NULL,
  `urlName` varchar(256) character set utf8 collate utf8_unicode_ci NOT NULL,
  `name` varchar(256) character set utf8 collate utf8_unicode_ci NOT NULL,
  `cacheSize` int(11) NOT NULL default '10',
  `tileHeight` int(11) NOT NULL,
  `tileWidth` int(11) NOT NULL,
  `minZoom` int(11) NOT NULL,
  `maxZoom` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `urlName` (`urlName`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;


INSERT INTO `TileServer` VALUES (1, 'http://tile.openstreetmap.org/<zoom>/<x>/<y>.png', 'mapnik', 'Mapnik', 10, 256, 256, 0, 18);
INSERT INTO `TileServer` VALUES (8, 'http://andy.sandbox.cloudmade.com/tiles/cycle/<zoom>/<x>/<y>.png', 'cycle', 'cycle', 10, 256, 256, 0, 18);
INSERT INTO `TileServer` VALUES (10, 'http://tah.openstreetmap.org/Tiles/tile/<zoom>/<x>/<y>.png', 'osmarender', 'osmarender', 10, 256, 256, 0, 17);

CREATE TABLE `User` (
  `id` int(11) NOT NULL auto_increment,
  `login` varchar(40) character set utf8 collate utf8_unicode_ci NOT NULL,
  `password` char(32) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2;

INSERT INTO `User` VALUES (1, 'test', '098f6bcd4621d373cade4e832627b4f6');

