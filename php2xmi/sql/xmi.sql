# phpMyAdmin MySQL-Dump
# version 2.5.0
# http://www.phpmyadmin.net/ (download page)
#
# Host: localhost
# Generation Time: Apr 27, 2004 at 01:14 PM
# Server version: 4.0.14
# PHP Version: 5.0.0RC2
# Database : `xmi`
# --------------------------------------------------------

#
# Table structure for table `class`
#
# Creation: Apr 27, 2004 at 12:59 PM
# Last update: Apr 27, 2004 at 01:10 PM
#

DROP TABLE IF EXISTS `class`;
CREATE TABLE `class` (
  `name` varchar(100) NOT NULL default '',
  `extends` varchar(100) NOT NULL default '',
  `internal` tinyint(4) NOT NULL default '0',
  `final` tinyint(4) NOT NULL default '0',
  `abstract` tinyint(4) NOT NULL default '0',
  `package` varchar(50) NOT NULL default '',
  `documentation` text NOT NULL,
  PRIMARY KEY  (`name`)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `class_implement`
#
# Creation: Apr 27, 2004 at 12:59 PM
# Last update: Apr 27, 2004 at 01:10 PM
#

DROP TABLE IF EXISTS `class_implement`;
CREATE TABLE `class_implement` (
  `class` varchar(100) NOT NULL default '',
  `interface` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`class`,`interface`)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `class_property`
#
# Creation: Apr 27, 2004 at 12:59 PM
# Last update: Apr 27, 2004 at 01:10 PM
#

DROP TABLE IF EXISTS `class_property`;
CREATE TABLE `class_property` (
  `name` varchar(100) NOT NULL default '',
  `owner` varchar(100) NOT NULL default '',
  `visibility` varchar(25) NOT NULL default '',
  `static` tinyint(4) NOT NULL default '0',
  `type` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`name`,`owner`)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `interface`
#
# Creation: Apr 27, 2004 at 12:59 PM
# Last update: Apr 27, 2004 at 01:10 PM
#

DROP TABLE IF EXISTS `interface`;
CREATE TABLE `interface` (
  `name` varchar(100) NOT NULL default '',
  `extends` varchar(100) NOT NULL default '',
  `internal` tinyint(4) NOT NULL default '0',
  `final` tinyint(4) NOT NULL default '0',
  `package` varchar(50) NOT NULL default '',
  `abstract` tinyint(4) NOT NULL default '0',
  `documentation` text NOT NULL,
  PRIMARY KEY  (`name`)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `method`
#
# Creation: Apr 27, 2004 at 12:59 PM
# Last update: Apr 27, 2004 at 01:10 PM
#

DROP TABLE IF EXISTS `method`;
CREATE TABLE `method` (
  `name` varchar(100) NOT NULL default '',
  `owner` varchar(100) NOT NULL default '',
  `internal` tinyint(4) NOT NULL default '0',
  `final` tinyint(4) NOT NULL default '0',
  `abstract` tinyint(4) NOT NULL default '0',
  `visibility` varchar(25) NOT NULL default '',
  `constructor` tinyint(4) NOT NULL default '0',
  `return` varchar(100) NOT NULL default 'void',
  `reference` tinyint(4) NOT NULL default '0',
  `documentation` text NOT NULL,
  PRIMARY KEY  (`name`,`owner`)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `method_param`
#
# Creation: Apr 27, 2004 at 12:59 PM
# Last update: Apr 27, 2004 at 01:10 PM
#

DROP TABLE IF EXISTS `method_param`;
CREATE TABLE `method_param` (
  `name` varchar(100) NOT NULL default '',
  `owner` varchar(100) NOT NULL default '',
  `method` varchar(100) NOT NULL default '',
  `position` tinyint(4) NOT NULL default '0',
  `reference` tinyint(4) NOT NULL default '0',
  `type` varchar(100) NOT NULL default 'void',
  PRIMARY KEY  (`name`,`owner`,`method`)
) TYPE=MyISAM;