-- MySQL dump 10.13  Distrib 5.1.38, for apple-darwin9.5.0 (i386)
--
-- Host: localhost    Database: easyhotspot
-- ------------------------------------------------------
-- Server version	5.1.38

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `billingplan`
--

DROP TABLE IF EXISTS `billingplan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `billingplan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `valid_for` int(11) DEFAULT NULL,
  `price` float NOT NULL,
  `IdleTimeout` int(255) NOT NULL,
  `simultaneous` int(10) NOT NULL,
  `redirect_url` varchar(255) NOT NULL,
  `bw_upload` int(255) NOT NULL,
  `bw_download` int(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `billingplan`
--

LOCK TABLES `billingplan` WRITE;
/*!40000 ALTER TABLE `billingplan` DISABLE KEYS */;
/*!40000 ALTER TABLE `billingplan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `session_data` text,
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ci_sessions`
--

LOCK TABLES `ci_sessions` WRITE;
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
INSERT INTO `ci_sessions` VALUES ('90043b7d49337773ce2cd55a54fecfeb','0.0.0.0','Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.6; en',1259772557,'a:9:{s:2:\"id\";s:1:\"1\";s:9:\"user_name\";s:5:\"admin\";s:10:\"country_id\";s:1:\"0\";s:5:\"email\";s:18:\"root@localhost.com\";s:4:\"role\";s:10:\"superadmin\";s:10:\"last_visit\";s:19:\"2009-11-30 19:29:20\";s:7:\"created\";s:19:\"2009-11-30 19:29:20\";s:8:\"modified\";s:19:\"0000-00-00 00:00:00\";s:7:\"perpage\";s:2:\"10\";}','');
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expiration_account`
--

DROP TABLE IF EXISTS `expiration_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expiration_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `expiration_plan` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expiration_account`
--

LOCK TABLES `expiration_account` WRITE;
/*!40000 ALTER TABLE `expiration_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `expiration_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expirationplan`
--

DROP TABLE IF EXISTS `expirationplan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expirationplan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `amount` varchar(255) NOT NULL,
  `bw_download` int(10) DEFAULT NULL,
  `bw_upload` int(10) DEFAULT NULL,
  `idletimeout` int(10) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expirationplan`
--

LOCK TABLES `expirationplan` WRITE;
/*!40000 ALTER TABLE `expirationplan` DISABLE KEYS */;
/*!40000 ALTER TABLE `expirationplan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fa_country`
--

DROP TABLE IF EXISTS `fa_country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fa_country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=240 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fa_country`
--

LOCK TABLES `fa_country` WRITE;
/*!40000 ALTER TABLE `fa_country` DISABLE KEYS */;
INSERT INTO `fa_country` VALUES (1,'AF','Afghanistan','AFG',4),(2,'AL','Albania','ALB',8),(3,'DZ','Algeria','DZA',12),(4,'AS','American Samoa','ASM',16),(5,'AD','Andorra','AND',20),(6,'AO','Angola','AGO',24),(7,'AI','Anguilla','AIA',660),(8,'AQ','Antarctica',NULL,NULL),(9,'AG','Antigua and Barbuda','ATG',28),(10,'AR','Argentina','ARG',32),(11,'AM','Armenia','ARM',51),(12,'AW','Aruba','ABW',533),(13,'AU','Australia','AUS',36),(14,'AT','Austria','AUT',40),(15,'AZ','Azerbaijan','AZE',31),(16,'BS','Bahamas','BHS',44),(17,'BH','Bahrain','BHR',48),(18,'BD','Bangladesh','BGD',50),(19,'BB','Barbados','BRB',52),(20,'BY','Belarus','BLR',112),(21,'BE','Belgium','BEL',56),(22,'BZ','Belize','BLZ',84),(23,'BJ','Benin','BEN',204),(24,'BM','Bermuda','BMU',60),(25,'BT','Bhutan','BTN',64),(26,'BO','Bolivia','BOL',68),(27,'BA','Bosnia and Herzegovina','BIH',70),(28,'BW','Botswana','BWA',72),(29,'BV','Bouvet Island',NULL,NULL),(30,'BR','Brazil','BRA',76),(31,'IO','British Indian Ocean Territory',NULL,NULL),(32,'BN','Brunei Darussalam','BRN',96),(33,'BG','Bulgaria','BGR',100),(34,'BF','Burkina Faso','BFA',854),(35,'BI','Burundi','BDI',108),(36,'KH','Cambodia','KHM',116),(37,'CM','Cameroon','CMR',120),(38,'CA','Canada','CAN',124),(39,'CV','Cape Verde','CPV',132),(40,'KY','Cayman Islands','CYM',136),(41,'CF','Central African Republic','CAF',140),(42,'TD','Chad','TCD',148),(43,'CL','Chile','CHL',152),(44,'CN','China','CHN',156),(45,'CX','Christmas Island',NULL,NULL),(46,'CC','Cocos (Keeling) Islands',NULL,NULL),(47,'CO','Colombia','COL',170),(48,'KM','Comoros','COM',174),(49,'CG','Congo','COG',178),(50,'CD','Congo, the Democratic Republic of the','COD',180),(51,'CK','Cook Islands','COK',184),(52,'CR','Costa Rica','CRI',188),(53,'CI','Cote D\'Ivoire','CIV',384),(54,'HR','Croatia','HRV',191),(55,'CU','Cuba','CUB',192),(56,'CY','Cyprus','CYP',196),(57,'CZ','Czech Republic','CZE',203),(58,'DK','Denmark','DNK',208),(59,'DJ','Djibouti','DJI',262),(60,'DM','Dominica','DMA',212),(61,'DO','Dominican Republic','DOM',214),(62,'EC','Ecuador','ECU',218),(63,'EG','Egypt','EGY',818),(64,'SV','El Salvador','SLV',222),(65,'GQ','Equatorial Guinea','GNQ',226),(66,'ER','Eritrea','ERI',232),(67,'EE','Estonia','EST',233),(68,'ET','Ethiopia','ETH',231),(69,'FK','Falkland Islands (Malvinas)','FLK',238),(70,'FO','Faroe Islands','FRO',234),(71,'FJ','Fiji','FJI',242),(72,'FI','Finland','FIN',246),(73,'FR','France','FRA',250),(74,'GF','French Guiana','GUF',254),(75,'PF','French Polynesia','PYF',258),(76,'TF','French Southern Territories',NULL,NULL),(77,'GA','Gabon','GAB',266),(78,'GM','Gambia','GMB',270),(79,'GE','Georgia','GEO',268),(80,'DE','Germany','DEU',276),(81,'GH','Ghana','GHA',288),(82,'GI','Gibraltar','GIB',292),(83,'GR','Greece','GRC',300),(84,'GL','Greenland','GRL',304),(85,'GD','Grenada','GRD',308),(86,'GP','Guadeloupe','GLP',312),(87,'GU','Guam','GUM',316),(88,'GT','Guatemala','GTM',320),(89,'GN','Guinea','GIN',324),(90,'GW','Guinea-Bissau','GNB',624),(91,'GY','Guyana','GUY',328),(92,'HT','Haiti','HTI',332),(93,'HM','Heard Island and Mcdonald Islands',NULL,NULL),(94,'VA','Holy See (Vatican City State)','VAT',336),(95,'HN','Honduras','HND',340),(96,'HK','Hong Kong','HKG',344),(97,'HU','Hungary','HUN',348),(98,'IS','Iceland','ISL',352),(99,'IN','India','IND',356),(100,'ID','Indonesia','IDN',360),(101,'IR','Iran, Islamic Republic of','IRN',364),(102,'IQ','Iraq','IRQ',368),(103,'IE','Ireland','IRL',372),(104,'IL','Israel','ISR',376),(105,'IT','Italy','ITA',380),(106,'JM','Jamaica','JAM',388),(107,'JP','Japan','JPN',392),(108,'JO','Jordan','JOR',400),(109,'KZ','Kazakhstan','KAZ',398),(110,'KE','Kenya','KEN',404),(111,'KI','Kiribati','KIR',296),(112,'KP','Korea, Democratic People\'s Republic of','PRK',408),(113,'KR','Korea, Republic of','KOR',410),(114,'KW','Kuwait','KWT',414),(115,'KG','Kyrgyzstan','KGZ',417),(116,'LA','Lao People\'s Democratic Republic','LAO',418),(117,'LV','Latvia','LVA',428),(118,'LB','Lebanon','LBN',422),(119,'LS','Lesotho','LSO',426),(120,'LR','Liberia','LBR',430),(121,'LY','Libyan Arab Jamahiriya','LBY',434),(122,'LI','Liechtenstein','LIE',438),(123,'LT','Lithuania','LTU',440),(124,'LU','Luxembourg','LUX',442),(125,'MO','Macao','MAC',446),(126,'MK','Macedonia, the Former Yugoslav Republic of','MKD',807),(127,'MG','Madagascar','MDG',450),(128,'MW','Malawi','MWI',454),(129,'MY','Malaysia','MYS',458),(130,'MV','Maldives','MDV',462),(131,'ML','Mali','MLI',466),(132,'MT','Malta','MLT',470),(133,'MH','Marshall Islands','MHL',584),(134,'MQ','Martinique','MTQ',474),(135,'MR','Mauritania','MRT',478),(136,'MU','Mauritius','MUS',480),(137,'YT','Mayotte',NULL,NULL),(138,'MX','Mexico','MEX',484),(139,'FM','Micronesia, Federated States of','FSM',583),(140,'MD','Moldova, Republic of','MDA',498),(141,'MC','Monaco','MCO',492),(142,'MN','Mongolia','MNG',496),(143,'MS','Montserrat','MSR',500),(144,'MA','Morocco','MAR',504),(145,'MZ','Mozambique','MOZ',508),(146,'MM','Myanmar','MMR',104),(147,'NA','Namibia','NAM',516),(148,'NR','Nauru','NRU',520),(149,'NP','Nepal','NPL',524),(150,'NL','Netherlands','NLD',528),(151,'AN','Netherlands Antilles','ANT',530),(152,'NC','New Caledonia','NCL',540),(153,'NZ','New Zealand','NZL',554),(154,'NI','Nicaragua','NIC',558),(155,'NE','Niger','NER',562),(156,'NG','Nigeria','NGA',566),(157,'NU','Niue','NIU',570),(158,'NF','Norfolk Island','NFK',574),(159,'MP','Northern Mariana Islands','MNP',580),(160,'NO','Norway','NOR',578),(161,'OM','Oman','OMN',512),(162,'PK','Pakistan','PAK',586),(163,'PW','Palau','PLW',585),(164,'PS','Palestinian Territory, Occupied',NULL,NULL),(165,'PA','Panama','PAN',591),(166,'PG','Papua New Guinea','PNG',598),(167,'PY','Paraguay','PRY',600),(168,'PE','Peru','PER',604),(169,'PH','Philippines','PHL',608),(170,'PN','Pitcairn','PCN',612),(171,'PL','Poland','POL',616),(172,'PT','Portugal','PRT',620),(173,'PR','Puerto Rico','PRI',630),(174,'QA','Qatar','QAT',634),(175,'RE','Reunion','REU',638),(176,'RO','Romania','ROM',642),(177,'RU','Russian Federation','RUS',643),(178,'RW','Rwanda','RWA',646),(179,'SH','Saint Helena','SHN',654),(180,'KN','Saint Kitts and Nevis','KNA',659),(181,'LC','Saint Lucia','LCA',662),(182,'PM','Saint Pierre and Miquelon','SPM',666),(183,'VC','Saint Vincent and the Grenadines','VCT',670),(184,'WS','Samoa','WSM',882),(185,'SM','San Marino','SMR',674),(186,'ST','Sao Tome and Principe','STP',678),(187,'SA','Saudi Arabia','SAU',682),(188,'SN','Senegal','SEN',686),(189,'CS','Serbia and Montenegro',NULL,NULL),(190,'SC','Seychelles','SYC',690),(191,'SL','Sierra Leone','SLE',694),(192,'SG','Singapore','SGP',702),(193,'SK','Slovakia','SVK',703),(194,'SI','Slovenia','SVN',705),(195,'SB','Solomon Islands','SLB',90),(196,'SO','Somalia','SOM',706),(197,'ZA','South Africa','ZAF',710),(198,'GS','South Georgia and the South Sandwich Islands',NULL,NULL),(199,'ES','Spain','ESP',724),(200,'LK','Sri Lanka','LKA',144),(201,'SD','Sudan','SDN',736),(202,'SR','Suriname','SUR',740),(203,'SJ','Svalbard and Jan Mayen','SJM',744),(204,'SZ','Swaziland','SWZ',748),(205,'SE','Sweden','SWE',752),(206,'CH','Switzerland','CHE',756),(207,'SY','Syrian Arab Republic','SYR',760),(208,'TW','Taiwan, Province of China','TWN',158),(209,'TJ','Tajikistan','TJK',762),(210,'TZ','Tanzania, United Republic of','TZA',834),(211,'TH','Thailand','THA',764),(212,'TL','Timor-Leste',NULL,NULL),(213,'TG','Togo','TGO',768),(214,'TK','Tokelau','TKL',772),(215,'TO','Tonga','TON',776),(216,'TT','Trinidad and Tobago','TTO',780),(217,'TN','Tunisia','TUN',788),(218,'TR','Turkey','TUR',792),(219,'TM','Turkmenistan','TKM',795),(220,'TC','Turks and Caicos Islands','TCA',796),(221,'TV','Tuvalu','TUV',798),(222,'UG','Uganda','UGA',800),(223,'UA','Ukraine','UKR',804),(224,'AE','United Arab Emirates','ARE',784),(225,'GB','United Kingdom','GBR',826),(226,'US','United States','USA',840),(227,'UM','United States Minor Outlying Islands',NULL,NULL),(228,'UY','Uruguay','URY',858),(229,'UZ','Uzbekistan','UZB',860),(230,'VU','Vanuatu','VUT',548),(231,'VE','Venezuela','VEN',862),(232,'VN','Viet Nam','VNM',704),(233,'VG','Virgin Islands, British','VGB',92),(234,'VI','Virgin Islands, U.s.','VIR',850),(235,'WF','Wallis and Futuna','WLF',876),(236,'EH','Western Sahara','ESH',732),(237,'YE','Yemen','YEM',887),(238,'ZM','Zambia','ZMB',894),(239,'ZW','Zimbabwe','ZWE',716);
/*!40000 ALTER TABLE `fa_country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fa_user`
--

DROP TABLE IF EXISTS `fa_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fa_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(45) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(120) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `forgotten_password_code` varchar(50) DEFAULT NULL,
  `last_visit` datetime DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_FI_1` (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fa_user`
--

LOCK TABLES `fa_user` WRITE;
/*!40000 ALTER TABLE `fa_user` DISABLE KEYS */;
INSERT INTO `fa_user` VALUES (1,'admin',0,'8709d7dc8f2ba1f9bd2b7140ff7078c2','root@localhost.com','superadmin',0,NULL,'2009-12-02 20:48:11','2009-12-02 13:48:11','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `fa_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fa_user_profile`
--

DROP TABLE IF EXISTS `fa_user_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fa_user_profile` (
  `id` int(11) NOT NULL,
  `field_1` varchar(50) DEFAULT NULL,
  `field_2` varchar(50) DEFAULT NULL,
  `call_me_nicely` varchar(3) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fa_user_profile`
--

LOCK TABLES `fa_user_profile` WRITE;
/*!40000 ALTER TABLE `fa_user_profile` DISABLE KEYS */;
INSERT INTO `fa_user_profile` VALUES (1,'Admin','Mr. Admin','102');
/*!40000 ALTER TABLE `fa_user_profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fa_user_temp`
--

DROP TABLE IF EXISTS `fa_user_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fa_user_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(45) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(120) NOT NULL,
  `activation_code` varchar(50) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_FI_1` (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fa_user_temp`
--

LOCK TABLES `fa_user_temp` WRITE;
/*!40000 ALTER TABLE `fa_user_temp` DISABLE KEYS */;
/*!40000 ALTER TABLE `fa_user_temp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `realname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `used` int(255) NOT NULL,
  `bill_by` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `current_total` decimal(10,4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice`
--

LOCK TABLES `invoice` WRITE;
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_detail`
--

DROP TABLE IF EXISTS `invoice_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `realname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `stop` datetime NOT NULL,
  `used` int(11) NOT NULL,
  `bill_by` varchar(255) NOT NULL,
  `total` decimal(10,4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_detail`
--

LOCK TABLES `invoice_detail` WRITE;
/*!40000 ALTER TABLE `invoice_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nas`
--

DROP TABLE IF EXISTS `nas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nasname` varchar(128) NOT NULL,
  `shortname` varchar(32) DEFAULT NULL,
  `type` varchar(30) DEFAULT 'other',
  `ports` int(5) DEFAULT NULL,
  `secret` varchar(60) NOT NULL DEFAULT 'secret',
  `community` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT 'RADIUS Client',
  PRIMARY KEY (`id`),
  KEY `nasname` (`nasname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nas`
--

LOCK TABLES `nas` WRITE;
/*!40000 ALTER TABLE `nas` DISABLE KEYS */;
/*!40000 ALTER TABLE `nas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `postpaid_account`
--

DROP TABLE IF EXISTS `postpaid_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `postpaid_account` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `realname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `bill_by` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `IdleTimeout` int(10) NOT NULL,
  `valid_until` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postpaid_account`
--

LOCK TABLES `postpaid_account` WRITE;
/*!40000 ALTER TABLE `postpaid_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `postpaid_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `postplan`
--

DROP TABLE IF EXISTS `postplan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `postplan` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postplan`
--

LOCK TABLES `postplan` WRITE;
/*!40000 ALTER TABLE `postplan` DISABLE KEYS */;
INSERT INTO `postplan` VALUES (1,'packet',NULL),(2,'time',1),(3,'bw_download',64000),(4,'bw_upload',32000),(5,'idletimeout',0);
/*!40000 ALTER TABLE `postplan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `radacct`
--

DROP TABLE IF EXISTS `radacct`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `radacct` (
  `radacctid` bigint(21) NOT NULL AUTO_INCREMENT,
  `acctsessionid` varchar(32) NOT NULL DEFAULT '',
  `acctuniqueid` varchar(32) NOT NULL DEFAULT '',
  `username` varchar(64) NOT NULL DEFAULT '',
  `groupname` varchar(64) NOT NULL DEFAULT '',
  `realm` varchar(64) DEFAULT '',
  `nasipaddress` varchar(15) NOT NULL DEFAULT '',
  `nasportid` varchar(15) DEFAULT NULL,
  `nasporttype` varchar(32) DEFAULT NULL,
  `acctstarttime` datetime DEFAULT NULL,
  `acctstoptime` datetime DEFAULT NULL,
  `acctsessiontime` int(12) DEFAULT NULL,
  `acctauthentic` varchar(32) DEFAULT NULL,
  `connectinfo_start` varchar(50) DEFAULT NULL,
  `connectinfo_stop` varchar(50) DEFAULT NULL,
  `acctinputoctets` bigint(20) DEFAULT NULL,
  `acctoutputoctets` bigint(20) DEFAULT NULL,
  `calledstationid` varchar(50) NOT NULL DEFAULT '',
  `callingstationid` varchar(50) NOT NULL DEFAULT '',
  `acctterminatecause` varchar(32) NOT NULL DEFAULT '',
  `servicetype` varchar(32) DEFAULT NULL,
  `framedprotocol` varchar(32) DEFAULT NULL,
  `framedipaddress` varchar(15) NOT NULL DEFAULT '',
  `acctstartdelay` int(12) DEFAULT NULL,
  `acctstopdelay` int(12) DEFAULT NULL,
  `xascendsessionsvrkey` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`radacctid`),
  KEY `username` (`username`),
  KEY `framedipaddress` (`framedipaddress`),
  KEY `acctsessionid` (`acctsessionid`),
  KEY `acctuniqueid` (`acctuniqueid`),
  KEY `acctstarttime` (`acctstarttime`),
  KEY `acctstoptime` (`acctstoptime`),
  KEY `nasipaddress` (`nasipaddress`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `radacct`
--

LOCK TABLES `radacct` WRITE;
/*!40000 ALTER TABLE `radacct` DISABLE KEYS */;
INSERT INTO `radacct` VALUES (8,'4ad2b83900000000','d4cb615e5aca3202','08-00-27-02-31-64','','','0.0.0.0','0','Wireless-802.11','2009-10-12 12:01:45','2009-10-12 12:02:30',45,'','','',34725,293327,'08-00-27-D2-C9-84','08-00-27-02-31-64','Lost-Carrier','','','192.168.182.3',0,0,''),(9,'4ad2b8b500000000','da22abb0ce17a5fa','08-00-27-02-31-64','','','0.0.0.0','0','Wireless-802.11','2009-10-12 12:03:49','2009-10-12 12:25:36',1307,'','','',101684,201401,'08-00-27-D2-C9-84','08-00-27-02-31-64','Idle-Timeout','','','192.168.182.6',0,0,''),(10,'4adbdcb000000000','4500e517a52b8912','08-00-27-02-31-64','','','0.0.0.0','0','Wireless-802.11','2009-10-19 10:27:44','2009-10-19 10:52:22',1478,'','','',46050,342791,'08-00-27-D2-C9-84','08-00-27-02-31-64','Idle-Timeout','','','192.168.182.3',0,0,'');
/*!40000 ALTER TABLE `radacct` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `radcheck`
--

DROP TABLE IF EXISTS `radcheck`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `radcheck` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL DEFAULT '',
  `attribute` varchar(32) NOT NULL DEFAULT '',
  `op` char(2) NOT NULL DEFAULT '==',
  `value` varchar(253) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `username` (`username`(32))
) ENGINE=InnoDB AUTO_INCREMENT=496 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `radcheck`
--

LOCK TABLES `radcheck` WRITE;
/*!40000 ALTER TABLE `radcheck` DISABLE KEYS */;
/*!40000 ALTER TABLE `radcheck` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `radgroupcheck`
--

DROP TABLE IF EXISTS `radgroupcheck`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `radgroupcheck` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `groupname` varchar(64) NOT NULL DEFAULT '',
  `attribute` varchar(32) NOT NULL DEFAULT '',
  `op` char(2) NOT NULL DEFAULT '==',
  `value` varchar(253) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `groupname` (`groupname`(32))
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `radgroupcheck`
--

LOCK TABLES `radgroupcheck` WRITE;
/*!40000 ALTER TABLE `radgroupcheck` DISABLE KEYS */;
/*!40000 ALTER TABLE `radgroupcheck` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `radusergroup`
--

DROP TABLE IF EXISTS `radusergroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `radusergroup` (
  `username` varchar(64) NOT NULL DEFAULT '',
  `groupname` varchar(64) NOT NULL DEFAULT '',
  `priority` int(11) NOT NULL DEFAULT '1',
  KEY `username` (`username`(32))
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `radusergroup`
--

LOCK TABLES `radusergroup` WRITE;
/*!40000 ALTER TABLE `radusergroup` DISABLE KEYS */;
/*!40000 ALTER TABLE `radusergroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `radgroupreply`
--

DROP TABLE IF EXISTS `radgroupreply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `radgroupreply` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `groupname` varchar(64) NOT NULL DEFAULT '',
  `attribute` varchar(32) NOT NULL DEFAULT '',
  `op` char(2) NOT NULL DEFAULT '=',
  `value` varchar(253) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `groupname` (`groupname`(32))
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `radgroupreply`
--

LOCK TABLES `radgroupreply` WRITE;
/*!40000 ALTER TABLE `radgroupreply` DISABLE KEYS */;
/*!40000 ALTER TABLE `radgroupreply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `radpostauth`
--

DROP TABLE IF EXISTS `radpostauth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `radpostauth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL DEFAULT '',
  `pass` varchar(64) NOT NULL DEFAULT '',
  `reply` varchar(32) NOT NULL DEFAULT '',
  `authdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `radpostauth`
--

LOCK TABLES `radpostauth` WRITE;
/*!40000 ALTER TABLE `radpostauth` DISABLE KEYS */;
INSERT INTO `radpostauth` VALUES (1,'08-00-27-60-3F-CA','password','Access-Accept','2009-10-11 15:26:54'),(2,'cubvap14','pinsabip','Access-Accept','2009-10-11 15:41:04'),(3,'pandu','pandu','Access-Accept','2009-10-11 15:43:08'),(4,'pandu','a','Access-Accept','2009-10-11 15:43:31'),(5,'moyvor13','pandu','Access-Accept','2009-10-11 15:53:30'),(6,'pandu','a','Access-Accept','2009-10-12 02:15:54'),(7,'pandu','a','Access-Accept','2009-10-12 02:25:38'),(8,'08-00-27-02-31-64','password','Access-Accept','2009-10-12 05:01:45'),(9,'08-00-27-02-31-64','password','Access-Accept','2009-10-12 05:03:49'),(10,'08-00-27-02-31-64','password','Access-Accept','2009-10-19 03:27:44'),(11,'08-00-27-02-31-64','password','Access-Accept','2009-10-19 16:57:16'),(12,'golpaz11','a','Access-Accept','2009-10-19 16:58:36'),(13,'golpaz11','a','Access-Accept','2009-10-19 16:59:19'),(14,'dulrel15','a','Access-Accept','2009-10-28 11:59:17'),(15,'a','a','Access-Accept','2009-10-28 12:02:07'),(16,'a','a','Access-Accept','2009-10-28 12:11:06'),(17,'a','a','Access-Accept','2009-10-28 12:14:32'),(18,'a','a','Access-Accept','2009-10-28 12:38:15'),(19,'a','a','Access-Accept','2009-10-28 12:40:45'),(20,'a','a','Access-Accept','2009-10-28 12:43:47'),(21,'a','a','Access-Accept','2009-10-28 12:46:04'),(22,'a','a','Access-Accept','2009-10-28 12:51:04'),(23,'a','a','Access-Accept','2009-10-28 12:53:13'),(24,'a','a','Access-Accept','2009-10-28 12:54:44'),(25,'a','a','Access-Accept','2009-10-28 12:55:42'),(26,'a','a','Access-Accept','2009-10-28 12:58:57'),(27,'a','a','Access-Accept','2009-10-28 13:01:53'),(28,'a','a','Access-Accept','2009-10-28 13:11:45'),(29,'a','a','Access-Accept','2009-10-28 13:13:05'),(30,'a','a','Access-Accept','2009-10-28 13:14:24'),(31,'a','a','Access-Accept','2009-10-28 13:41:21'),(32,'a','a','Access-Accept','2009-10-28 13:46:26'),(33,'08-00-27-02-31-64','password','Access-Accept','2009-10-28 13:51:31');
/*!40000 ALTER TABLE `radpostauth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `radreply`
--

DROP TABLE IF EXISTS `radreply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `radreply` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL DEFAULT '',
  `attribute` varchar(32) NOT NULL DEFAULT '',
  `op` char(2) NOT NULL DEFAULT '=',
  `value` varchar(253) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `username` (`username`(32))
) ENGINE=InnoDB AUTO_INCREMENT=209 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `radreply`
--

LOCK TABLES `radreply` WRITE;
/*!40000 ALTER TABLE `radreply` DISABLE KEYS */;
INSERT INTO `radreply` VALUES (18,'08-00-27-02-31-61','WISPr-Session-Terminate-Timev',':=','2009-October-30T24:00:00'),(19,'08-00-27-02-31-6a','WISPr-Session-Terminate-Time',':=','2009-November-9T24:00:00'),(153,'xekgix6','WISPr-Session-Terminate-Time',':=','2009-12-3T24:00:00'),(154,'tamvop6','WISPr-Session-Terminate-Time',':=','2009-12-3T24:00:00'),(155,'sehyuh8','WISPr-Session-Terminate-Time',':=','2009-12-3T24:00:00'),(156,'rikpux10','WISPr-Session-Terminate-Time',':=','2009-12-3T24:00:00'),(157,'yokney6','WISPr-Session-Terminate-Time',':=','2009-12-3T24:00:00'),(158,'xuryec7','WISPr-Session-Terminate-Time',':=','2009-12-3T24:00:00'),(159,'sitsal10','WISPr-Session-Terminate-Time',':=','2009-12-3T24:00:00'),(160,'sambov11','WISPr-Session-Terminate-Time',':=','2009-12-3T24:00:00'),(161,'paymog7','WISPr-Session-Terminate-Time',':=','2009-12-3T24:00:00'),(162,'tubyap15','WISPr-Session-Terminate-Time',':=','2009-12-3T24:00:00'),(164,'00-00-00-00-01','WISPr-Session-Terminate-Time',':=','2009-12-12T24:00:00'),(165,'civsiz15','WISPr-Session-Terminate-Time',':=','2009-12-3T24:00:00'),(166,'xowzud11','WISPr-Session-Terminate-Time',':=','2009-12-3T24:00:00'),(167,'peknim10','WISPr-Session-Terminate-Time',':=','2009-12-3T24:00:00'),(168,'tagxon7','WISPr-Session-Terminate-Time',':=','2009-12-3T24:00:00'),(169,'gewdam9','WISPr-Session-Terminate-Time',':=','2009-12-3T24:00:00'),(170,'soksiz14','WISPr-Session-Terminate-Time',':=','2009-12-3T24:00:00'),(171,'rihsop11','WISPr-Session-Terminate-Time',':=','2009-12-3T24:00:00'),(172,'pirbis5','WISPr-Session-Terminate-Time',':=','2009-12-3T24:00:00'),(173,'kulzob13','WISPr-Session-Terminate-Time',':=','2009-12-3T24:00:00'),(174,'wemben6','WISPr-Session-Terminate-Time',':=','2009-12-3T24:00:00'),(175,'mubcaw15','WISPr-Session-Terminate-Time',':=','2009-12-3T24:00:00'),(176,'wisciy5','WISPr-Session-Terminate-Time',':=','2009-12-3T24:00:00'),(177,'zagpos7','WISPr-Session-Terminate-Time',':=','2009-12-3T24:00:00'),(178,'runyoc11','WISPr-Session-Terminate-Time',':=','2009-12-3T24:00:00'),(179,'yoxdek9','WISPr-Session-Terminate-Time',':=','2009-12-3T24:00:00'),(180,'pecnas10','WISPr-Session-Terminate-Time',':=','2009-12-3T24:00:00'),(181,'yucbel15','WISPr-Session-Terminate-Time',':=','2009-12-3T24:00:00'),(182,'hinmuz14','WISPr-Session-Terminate-Time',':=','2009-12-3T24:00:00'),(183,'kaczus5','WISPr-Session-Terminate-Time',':=','2009-12-3T24:00:00'),(184,'hukgux6','WISPr-Session-Terminate-Time',':=','2009-12-3T24:00:00'),(185,'100','WISPr-Session-Terminate-Time',':=','2009-12-12T24:00:00'),(186,'10','WISPr-Session-Terminate-Time',':=','2009-12-12T24:00:00'),(187,'120','WISPr-Session-Terminate-Time',':=','2009-12-12T24:00:00'),(188,'123','WISPr-Session-Terminate-Time',':=','2009-12-12T24:00:00'),(189,'13','WISPr-Session-Terminate-Time',':=','2009-12-12T24:00:00'),(190,'123123','WISPr-Session-Terminate-Time',':=','2009-12-12T24:00:00'),(191,'43423423','WISPr-Session-Terminate-Time',':=','2009-12-12T24:00:00'),(192,'123131','WISPr-Session-Terminate-Time',':=','2009-12-12T24:00:00'),(193,'1231313','WISPr-Session-Terminate-Time',':=','2009-12-12T24:00:00'),(194,'44241','WISPr-Session-Terminate-Time',':=','2009-12-12T24:00:00'),(195,'23231','WISPr-Session-Terminate-Time',':=','2009-12-12T24:00:00'),(196,'123131323131','WISPr-Session-Terminate-Time',':=','2009-12-12T24:00:00'),(197,'1312311123','WISPr-Session-Terminate-Time',':=','2009-12-12T24:00:00'),(198,'q123123','WISPr-Session-Terminate-Time',':=','2009-12-12T24:00:00');
/*!40000 ALTER TABLE `radreply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `voucher`
--

DROP TABLE IF EXISTS `voucher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voucher` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `billingplan` varchar(255) NOT NULL,
  `valid_until` varchar(255) DEFAULT NULL,
  `isprinted` tinyint(1) NOT NULL DEFAULT '0',
  `isexported` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voucher`
--

LOCK TABLES `voucher` WRITE;
/*!40000 ALTER TABLE `voucher` DISABLE KEYS */;
/*!40000 ALTER TABLE `voucher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `postpaid_account_bill`
--

DROP TABLE IF EXISTS `postpaid_account_bill`;
/*!50001 DROP VIEW IF EXISTS `postpaid_account_bill`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `postpaid_account_bill` (
  `realname` varchar(255),
  `username` varchar(255),
  `password` varchar(255),
  `start` datetime,
  `stop` datetime,
  `time_used` decimal(14,4),
  `packet_used` decimal(24,4),
  `bill_by` varchar(255),
  `time_price` double,
  `packet_price` double
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `postpaid_account_list`
--

DROP TABLE IF EXISTS `postpaid_account_list`;
/*!50001 DROP VIEW IF EXISTS `postpaid_account_list`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `postpaid_account_list` (
  `id` int(255),
  `realname` varchar(255),
  `username` varchar(255),
  `password` varchar(255),
  `time_used` decimal(36,4),
  `packet_used` decimal(46,4),
  `bill_by` varchar(255),
  `time_price` double,
  `packet_price` double,
  `valid_until` varchar(255)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `voucher_list`
--

DROP TABLE IF EXISTS `voucher_list`;
/*!50001 DROP VIEW IF EXISTS `voucher_list`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `voucher_list` (
  `id` int(255),
  `username` varchar(255),
  `password` varchar(255),
  `billingplan` varchar(255),
  `valid_until` varchar(255),
  `type` varchar(255),
  `amount` int(255),
  `valid_for` int(11),
  `price` float,
  `time_used` decimal(36,4),
  `time_remain` varbinary(39),
  `packet_used` decimal(46,4),
  `packet_remain` varbinary(49),
  `isexported` tinyint(4),
  `isprinted` tinyint(1),
  `valid` varchar(5)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `postpaid_account_bill`
--

/*!50001 DROP TABLE IF EXISTS `postpaid_account_bill`*/;
/*!50001 DROP VIEW IF EXISTS `postpaid_account_bill`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`easyhotspot`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `postpaid_account_bill` AS select `postpaid_account`.`realname` AS `realname`,`postpaid_account`.`username` AS `username`,`postpaid_account`.`password` AS `password`,`radacct`.`acctstarttime` AS `start`,`radacct`.`acctstoptime` AS `stop`,(`radacct`.`acctsessiontime` / 60) AS `time_used`,((`radacct`.`acctoutputoctets` + `radacct`.`acctinputoctets`) / 1048576) AS `packet_used`,`postpaid_account`.`bill_by` AS `bill_by`,(`postplan`.`price` * (`radacct`.`acctsessiontime` / 60)) AS `time_price`,(`postplan`.`price` * ((`radacct`.`acctoutputoctets` + `radacct`.`acctinputoctets`) / 1048576)) AS `packet_price` from ((`postpaid_account` left join `radacct` on((`postpaid_account`.`username` = `radacct`.`username`))) join `postplan` on((`postplan`.`name` = `postpaid_account`.`bill_by`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `postpaid_account_list`
--

/*!50001 DROP TABLE IF EXISTS `postpaid_account_list`*/;
/*!50001 DROP VIEW IF EXISTS `postpaid_account_list`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`easyhotspot`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `postpaid_account_list` AS select `postpaid_account`.`id` AS `id`,`postpaid_account`.`realname` AS `realname`,`postpaid_account`.`username` AS `username`,`postpaid_account`.`password` AS `password`,(sum(`radacct`.`acctsessiontime`) / 60) AS `time_used`,(sum((`radacct`.`acctoutputoctets` + `radacct`.`acctinputoctets`)) / 1048576) AS `packet_used`,`postpaid_account`.`bill_by` AS `bill_by`,(`postplan`.`price` * (sum(`radacct`.`acctsessiontime`) / 60)) AS `time_price`,(`postplan`.`price` * (sum((`radacct`.`acctoutputoctets` + `radacct`.`acctinputoctets`)) / 1048576)) AS `packet_price`,`postpaid_account`.`valid_until` AS `valid_until` from ((`postpaid_account` left join `radacct` on((`postpaid_account`.`username` = `radacct`.`username`))) join `postplan` on((`postplan`.`name` = `postpaid_account`.`bill_by`))) group by `postpaid_account`.`username` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `voucher_list`
--

/*!50001 DROP TABLE IF EXISTS `voucher_list`*/;
/*!50001 DROP VIEW IF EXISTS `voucher_list`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`easyhotspot`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `voucher_list` AS select `v`.`id` AS `id`,`v`.`username` AS `username`,`v`.`password` AS `password`,`v`.`billingplan` AS `billingplan`,`v`.`valid_until` AS `valid_until`,`b`.`type` AS `type`,`b`.`amount` AS `amount`,`b`.`valid_for` AS `valid_for`,`b`.`price` AS `price`,(sum(`ra`.`acctsessiontime`) / 60) AS `time_used`,if((`b`.`type` = _latin1'time'),(`b`.`amount` - (sum(`ra`.`acctsessiontime`) / 60)),_latin1'null') AS `time_remain`,((sum(`ra`.`acctoutputoctets`) + sum(`ra`.`acctinputoctets`)) / 1048576) AS `packet_used`,if((`b`.`type` = _latin1'packet'),(`b`.`amount` - (sum((`ra`.`acctoutputoctets` + `ra`.`acctinputoctets`)) / 1048576)),_latin1'null') AS `packet_remain`,`v`.`isexported` AS `isexported`,`v`.`isprinted` AS `isprinted`,if((`b`.`type` = _latin1'time'),if(((sum(`ra`.`acctsessiontime`) / 60) >= `b`.`amount`),_latin1'exp',_latin1'valid'),if((((sum(`ra`.`acctoutputoctets`) + sum(`ra`.`acctinputoctets`)) / 1048576) >= `b`.`amount`),_latin1'exp',_latin1'valid')) AS `valid` from ((`voucher` `v` left join `radacct` `ra` on((`v`.`username` = `ra`.`username`))) join `billingplan` `b` on((`b`.`name` = `v`.`billingplan`))) group by `v`.`username` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2009-12-03 11:38:58
