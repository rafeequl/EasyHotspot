-- phpMyAdmin SQL Dump
-- version 2.9.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Feb 27, 2008 at 06:43 PM
-- Server version: 5.0.45
-- PHP Version: 5.2.3-1ubuntu6.3
-- 
-- Database: `easyhotspot`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `billingplan`
-- 

CREATE TABLE `billingplan` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `price` float NOT NULL,
  `IdleTimeout` int(255) NOT NULL,
  `simultaneous` int(10) NOT NULL,
  `redirect_url` varchar(255) NOT NULL,
  `bw_upload` int(255) NOT NULL,
  `bw_download` int(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `billingplan`
-- 

INSERT INTO `billingplan` (`id`, `name`, `type`, `amount`, `price`, `IdleTimeout`, `simultaneous`, `redirect_url`, `bw_upload`, `bw_download`, `created_by`) VALUES 
(1, '1 jam', 'time', 60, 10000, 10, 0, '', 640, 128, 'admin'),
(2, '20 Mega', 'packet', 20, 10000, 10, 0, '', 640, 128, 'admin');

-- --------------------------------------------------------

-- 
-- Table structure for table `ci_sessions`
-- 

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL default '0',
  `ip_address` varchar(16) NOT NULL default '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL default '0',
  `session_data` text,
  PRIMARY KEY  (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `ci_sessions`
-- 

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `session_data`) VALUES 
('0b039ff91ae41abf2142265ae0fde530', '127.0.0.1', 'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.8.1.1', 1203753281, 'a:8:{s:10:"country_id";s:1:"0";s:5:"email";s:18:"rafeequl@gmail.com";s:10:"last_visit";s:19:"2008-02-23 13:59:08";s:7:"created";s:19:"2008-02-23 13:59:08";s:8:"modified";s:19:"0000-00-00 00:00:00";s:6:"search";s:1:"e";s:22:"flash:old:flashMessage";s:33:"You have successfully logged out.";s:24:"flash:new:requested_page";b:0;}'),
('28820548ad4820240b8156524e88120b', '127.0.0.1', 'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.8.1.1', 1203829424, 'a:8:{s:2:"id";s:1:"1";s:9:"user_name";s:5:"admin";s:10:"country_id";s:1:"0";s:5:"email";s:18:"root@localhost.com";s:4:"role";s:10:"superadmin";s:10:"last_visit";s:19:"2008-02-23 13:59:45";s:7:"created";s:19:"2008-02-23 13:59:45";s:8:"modified";s:19:"0000-00-00 00:00:00";}'),
('007666509514f818bf491c96d37f061e', '127.0.0.1', 'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.8.1.1', 1204106291, 'a:8:{s:10:"country_id";s:1:"0";s:5:"email";s:18:"rafeequl@gmail.com";s:10:"last_visit";s:19:"2008-02-27 15:42:29";s:7:"created";s:19:"2008-02-27 15:42:29";s:8:"modified";s:19:"0000-00-00 00:00:00";s:2:"id";s:1:"7";s:9:"user_name";s:5:"vcool";s:4:"role";s:4:"user";}');

-- --------------------------------------------------------

-- 
-- Table structure for table `fa_country`
-- 

CREATE TABLE `fa_country` (
  `id` int(11) NOT NULL auto_increment,
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `iso3` char(3) default NULL,
  `numcode` smallint(6) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=240 ;

-- 
-- Dumping data for table `fa_country`
-- 

INSERT INTO `fa_country` (`id`, `iso`, `name`, `iso3`, `numcode`) VALUES 
(1, 'AF', 'Afghanistan', 'AFG', 4),
(2, 'AL', 'Albania', 'ALB', 8),
(3, 'DZ', 'Algeria', 'DZA', 12),
(4, 'AS', 'American Samoa', 'ASM', 16),
(5, 'AD', 'Andorra', 'AND', 20),
(6, 'AO', 'Angola', 'AGO', 24),
(7, 'AI', 'Anguilla', 'AIA', 660),
(8, 'AQ', 'Antarctica', NULL, NULL),
(9, 'AG', 'Antigua and Barbuda', 'ATG', 28),
(10, 'AR', 'Argentina', 'ARG', 32),
(11, 'AM', 'Armenia', 'ARM', 51),
(12, 'AW', 'Aruba', 'ABW', 533),
(13, 'AU', 'Australia', 'AUS', 36),
(14, 'AT', 'Austria', 'AUT', 40),
(15, 'AZ', 'Azerbaijan', 'AZE', 31),
(16, 'BS', 'Bahamas', 'BHS', 44),
(17, 'BH', 'Bahrain', 'BHR', 48),
(18, 'BD', 'Bangladesh', 'BGD', 50),
(19, 'BB', 'Barbados', 'BRB', 52),
(20, 'BY', 'Belarus', 'BLR', 112),
(21, 'BE', 'Belgium', 'BEL', 56),
(22, 'BZ', 'Belize', 'BLZ', 84),
(23, 'BJ', 'Benin', 'BEN', 204),
(24, 'BM', 'Bermuda', 'BMU', 60),
(25, 'BT', 'Bhutan', 'BTN', 64),
(26, 'BO', 'Bolivia', 'BOL', 68),
(27, 'BA', 'Bosnia and Herzegovina', 'BIH', 70),
(28, 'BW', 'Botswana', 'BWA', 72),
(29, 'BV', 'Bouvet Island', NULL, NULL),
(30, 'BR', 'Brazil', 'BRA', 76),
(31, 'IO', 'British Indian Ocean Territory', NULL, NULL),
(32, 'BN', 'Brunei Darussalam', 'BRN', 96),
(33, 'BG', 'Bulgaria', 'BGR', 100),
(34, 'BF', 'Burkina Faso', 'BFA', 854),
(35, 'BI', 'Burundi', 'BDI', 108),
(36, 'KH', 'Cambodia', 'KHM', 116),
(37, 'CM', 'Cameroon', 'CMR', 120),
(38, 'CA', 'Canada', 'CAN', 124),
(39, 'CV', 'Cape Verde', 'CPV', 132),
(40, 'KY', 'Cayman Islands', 'CYM', 136),
(41, 'CF', 'Central African Republic', 'CAF', 140),
(42, 'TD', 'Chad', 'TCD', 148),
(43, 'CL', 'Chile', 'CHL', 152),
(44, 'CN', 'China', 'CHN', 156),
(45, 'CX', 'Christmas Island', NULL, NULL),
(46, 'CC', 'Cocos (Keeling) Islands', NULL, NULL),
(47, 'CO', 'Colombia', 'COL', 170),
(48, 'KM', 'Comoros', 'COM', 174),
(49, 'CG', 'Congo', 'COG', 178),
(50, 'CD', 'Congo, the Democratic Republic of the', 'COD', 180),
(51, 'CK', 'Cook Islands', 'COK', 184),
(52, 'CR', 'Costa Rica', 'CRI', 188),
(53, 'CI', 'Cote D''Ivoire', 'CIV', 384),
(54, 'HR', 'Croatia', 'HRV', 191),
(55, 'CU', 'Cuba', 'CUB', 192),
(56, 'CY', 'Cyprus', 'CYP', 196),
(57, 'CZ', 'Czech Republic', 'CZE', 203),
(58, 'DK', 'Denmark', 'DNK', 208),
(59, 'DJ', 'Djibouti', 'DJI', 262),
(60, 'DM', 'Dominica', 'DMA', 212),
(61, 'DO', 'Dominican Republic', 'DOM', 214),
(62, 'EC', 'Ecuador', 'ECU', 218),
(63, 'EG', 'Egypt', 'EGY', 818),
(64, 'SV', 'El Salvador', 'SLV', 222),
(65, 'GQ', 'Equatorial Guinea', 'GNQ', 226),
(66, 'ER', 'Eritrea', 'ERI', 232),
(67, 'EE', 'Estonia', 'EST', 233),
(68, 'ET', 'Ethiopia', 'ETH', 231),
(69, 'FK', 'Falkland Islands (Malvinas)', 'FLK', 238),
(70, 'FO', 'Faroe Islands', 'FRO', 234),
(71, 'FJ', 'Fiji', 'FJI', 242),
(72, 'FI', 'Finland', 'FIN', 246),
(73, 'FR', 'France', 'FRA', 250),
(74, 'GF', 'French Guiana', 'GUF', 254),
(75, 'PF', 'French Polynesia', 'PYF', 258),
(76, 'TF', 'French Southern Territories', NULL, NULL),
(77, 'GA', 'Gabon', 'GAB', 266),
(78, 'GM', 'Gambia', 'GMB', 270),
(79, 'GE', 'Georgia', 'GEO', 268),
(80, 'DE', 'Germany', 'DEU', 276),
(81, 'GH', 'Ghana', 'GHA', 288),
(82, 'GI', 'Gibraltar', 'GIB', 292),
(83, 'GR', 'Greece', 'GRC', 300),
(84, 'GL', 'Greenland', 'GRL', 304),
(85, 'GD', 'Grenada', 'GRD', 308),
(86, 'GP', 'Guadeloupe', 'GLP', 312),
(87, 'GU', 'Guam', 'GUM', 316),
(88, 'GT', 'Guatemala', 'GTM', 320),
(89, 'GN', 'Guinea', 'GIN', 324),
(90, 'GW', 'Guinea-Bissau', 'GNB', 624),
(91, 'GY', 'Guyana', 'GUY', 328),
(92, 'HT', 'Haiti', 'HTI', 332),
(93, 'HM', 'Heard Island and Mcdonald Islands', NULL, NULL),
(94, 'VA', 'Holy See (Vatican City State)', 'VAT', 336),
(95, 'HN', 'Honduras', 'HND', 340),
(96, 'HK', 'Hong Kong', 'HKG', 344),
(97, 'HU', 'Hungary', 'HUN', 348),
(98, 'IS', 'Iceland', 'ISL', 352),
(99, 'IN', 'India', 'IND', 356),
(100, 'ID', 'Indonesia', 'IDN', 360),
(101, 'IR', 'Iran, Islamic Republic of', 'IRN', 364),
(102, 'IQ', 'Iraq', 'IRQ', 368),
(103, 'IE', 'Ireland', 'IRL', 372),
(104, 'IL', 'Israel', 'ISR', 376),
(105, 'IT', 'Italy', 'ITA', 380),
(106, 'JM', 'Jamaica', 'JAM', 388),
(107, 'JP', 'Japan', 'JPN', 392),
(108, 'JO', 'Jordan', 'JOR', 400),
(109, 'KZ', 'Kazakhstan', 'KAZ', 398),
(110, 'KE', 'Kenya', 'KEN', 404),
(111, 'KI', 'Kiribati', 'KIR', 296),
(112, 'KP', 'Korea, Democratic People''s Republic of', 'PRK', 408),
(113, 'KR', 'Korea, Republic of', 'KOR', 410),
(114, 'KW', 'Kuwait', 'KWT', 414),
(115, 'KG', 'Kyrgyzstan', 'KGZ', 417),
(116, 'LA', 'Lao People''s Democratic Republic', 'LAO', 418),
(117, 'LV', 'Latvia', 'LVA', 428),
(118, 'LB', 'Lebanon', 'LBN', 422),
(119, 'LS', 'Lesotho', 'LSO', 426),
(120, 'LR', 'Liberia', 'LBR', 430),
(121, 'LY', 'Libyan Arab Jamahiriya', 'LBY', 434),
(122, 'LI', 'Liechtenstein', 'LIE', 438),
(123, 'LT', 'Lithuania', 'LTU', 440),
(124, 'LU', 'Luxembourg', 'LUX', 442),
(125, 'MO', 'Macao', 'MAC', 446),
(126, 'MK', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807),
(127, 'MG', 'Madagascar', 'MDG', 450),
(128, 'MW', 'Malawi', 'MWI', 454),
(129, 'MY', 'Malaysia', 'MYS', 458),
(130, 'MV', 'Maldives', 'MDV', 462),
(131, 'ML', 'Mali', 'MLI', 466),
(132, 'MT', 'Malta', 'MLT', 470),
(133, 'MH', 'Marshall Islands', 'MHL', 584),
(134, 'MQ', 'Martinique', 'MTQ', 474),
(135, 'MR', 'Mauritania', 'MRT', 478),
(136, 'MU', 'Mauritius', 'MUS', 480),
(137, 'YT', 'Mayotte', NULL, NULL),
(138, 'MX', 'Mexico', 'MEX', 484),
(139, 'FM', 'Micronesia, Federated States of', 'FSM', 583),
(140, 'MD', 'Moldova, Republic of', 'MDA', 498),
(141, 'MC', 'Monaco', 'MCO', 492),
(142, 'MN', 'Mongolia', 'MNG', 496),
(143, 'MS', 'Montserrat', 'MSR', 500),
(144, 'MA', 'Morocco', 'MAR', 504),
(145, 'MZ', 'Mozambique', 'MOZ', 508),
(146, 'MM', 'Myanmar', 'MMR', 104),
(147, 'NA', 'Namibia', 'NAM', 516),
(148, 'NR', 'Nauru', 'NRU', 520),
(149, 'NP', 'Nepal', 'NPL', 524),
(150, 'NL', 'Netherlands', 'NLD', 528),
(151, 'AN', 'Netherlands Antilles', 'ANT', 530),
(152, 'NC', 'New Caledonia', 'NCL', 540),
(153, 'NZ', 'New Zealand', 'NZL', 554),
(154, 'NI', 'Nicaragua', 'NIC', 558),
(155, 'NE', 'Niger', 'NER', 562),
(156, 'NG', 'Nigeria', 'NGA', 566),
(157, 'NU', 'Niue', 'NIU', 570),
(158, 'NF', 'Norfolk Island', 'NFK', 574),
(159, 'MP', 'Northern Mariana Islands', 'MNP', 580),
(160, 'NO', 'Norway', 'NOR', 578),
(161, 'OM', 'Oman', 'OMN', 512),
(162, 'PK', 'Pakistan', 'PAK', 586),
(163, 'PW', 'Palau', 'PLW', 585),
(164, 'PS', 'Palestinian Territory, Occupied', NULL, NULL),
(165, 'PA', 'Panama', 'PAN', 591),
(166, 'PG', 'Papua New Guinea', 'PNG', 598),
(167, 'PY', 'Paraguay', 'PRY', 600),
(168, 'PE', 'Peru', 'PER', 604),
(169, 'PH', 'Philippines', 'PHL', 608),
(170, 'PN', 'Pitcairn', 'PCN', 612),
(171, 'PL', 'Poland', 'POL', 616),
(172, 'PT', 'Portugal', 'PRT', 620),
(173, 'PR', 'Puerto Rico', 'PRI', 630),
(174, 'QA', 'Qatar', 'QAT', 634),
(175, 'RE', 'Reunion', 'REU', 638),
(176, 'RO', 'Romania', 'ROM', 642),
(177, 'RU', 'Russian Federation', 'RUS', 643),
(178, 'RW', 'Rwanda', 'RWA', 646),
(179, 'SH', 'Saint Helena', 'SHN', 654),
(180, 'KN', 'Saint Kitts and Nevis', 'KNA', 659),
(181, 'LC', 'Saint Lucia', 'LCA', 662),
(182, 'PM', 'Saint Pierre and Miquelon', 'SPM', 666),
(183, 'VC', 'Saint Vincent and the Grenadines', 'VCT', 670),
(184, 'WS', 'Samoa', 'WSM', 882),
(185, 'SM', 'San Marino', 'SMR', 674),
(186, 'ST', 'Sao Tome and Principe', 'STP', 678),
(187, 'SA', 'Saudi Arabia', 'SAU', 682),
(188, 'SN', 'Senegal', 'SEN', 686),
(189, 'CS', 'Serbia and Montenegro', NULL, NULL),
(190, 'SC', 'Seychelles', 'SYC', 690),
(191, 'SL', 'Sierra Leone', 'SLE', 694),
(192, 'SG', 'Singapore', 'SGP', 702),
(193, 'SK', 'Slovakia', 'SVK', 703),
(194, 'SI', 'Slovenia', 'SVN', 705),
(195, 'SB', 'Solomon Islands', 'SLB', 90),
(196, 'SO', 'Somalia', 'SOM', 706),
(197, 'ZA', 'South Africa', 'ZAF', 710),
(198, 'GS', 'South Georgia and the South Sandwich Islands', NULL, NULL),
(199, 'ES', 'Spain', 'ESP', 724),
(200, 'LK', 'Sri Lanka', 'LKA', 144),
(201, 'SD', 'Sudan', 'SDN', 736),
(202, 'SR', 'Suriname', 'SUR', 740),
(203, 'SJ', 'Svalbard and Jan Mayen', 'SJM', 744),
(204, 'SZ', 'Swaziland', 'SWZ', 748),
(205, 'SE', 'Sweden', 'SWE', 752),
(206, 'CH', 'Switzerland', 'CHE', 756),
(207, 'SY', 'Syrian Arab Republic', 'SYR', 760),
(208, 'TW', 'Taiwan, Province of China', 'TWN', 158),
(209, 'TJ', 'Tajikistan', 'TJK', 762),
(210, 'TZ', 'Tanzania, United Republic of', 'TZA', 834),
(211, 'TH', 'Thailand', 'THA', 764),
(212, 'TL', 'Timor-Leste', NULL, NULL),
(213, 'TG', 'Togo', 'TGO', 768),
(214, 'TK', 'Tokelau', 'TKL', 772),
(215, 'TO', 'Tonga', 'TON', 776),
(216, 'TT', 'Trinidad and Tobago', 'TTO', 780),
(217, 'TN', 'Tunisia', 'TUN', 788),
(218, 'TR', 'Turkey', 'TUR', 792),
(219, 'TM', 'Turkmenistan', 'TKM', 795),
(220, 'TC', 'Turks and Caicos Islands', 'TCA', 796),
(221, 'TV', 'Tuvalu', 'TUV', 798),
(222, 'UG', 'Uganda', 'UGA', 800),
(223, 'UA', 'Ukraine', 'UKR', 804),
(224, 'AE', 'United Arab Emirates', 'ARE', 784),
(225, 'GB', 'United Kingdom', 'GBR', 826),
(226, 'US', 'United States', 'USA', 840),
(227, 'UM', 'United States Minor Outlying Islands', NULL, NULL),
(228, 'UY', 'Uruguay', 'URY', 858),
(229, 'UZ', 'Uzbekistan', 'UZB', 860),
(230, 'VU', 'Vanuatu', 'VUT', 548),
(231, 'VE', 'Venezuela', 'VEN', 862),
(232, 'VN', 'Viet Nam', 'VNM', 704),
(233, 'VG', 'Virgin Islands, British', 'VGB', 92),
(234, 'VI', 'Virgin Islands, U.s.', 'VIR', 850),
(235, 'WF', 'Wallis and Futuna', 'WLF', 876),
(236, 'EH', 'Western Sahara', 'ESH', 732),
(237, 'YE', 'Yemen', 'YEM', 887),
(238, 'ZM', 'Zambia', 'ZMB', 894),
(239, 'ZW', 'Zimbabwe', 'ZWE', 716);

-- --------------------------------------------------------

-- 
-- Table structure for table `fa_user`
-- 

CREATE TABLE `fa_user` (
  `id` int(11) NOT NULL auto_increment,
  `user_name` varchar(45) NOT NULL,
  `country_id` int(11) default NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(120) NOT NULL,
  `role` varchar(50) NOT NULL default 'user',
  `banned` tinyint(1) NOT NULL default '0',
  `forgotten_password_code` varchar(50) default NULL,
  `last_visit` datetime default NULL,
  `created` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `user_FI_1` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- 
-- Dumping data for table `fa_user`
-- 

INSERT INTO `fa_user` (`id`, `user_name`, `country_id`, `password`, `email`, `role`, `banned`, `forgotten_password_code`, `last_visit`, `created`, `modified`) VALUES 
(1, 'admin', 0, '8709d7dc8f2ba1f9bd2b7140ff7078c2', 'root@localhost.com', 'superadmin', 0, NULL, '2008-02-27 15:42:48', '2008-02-27 15:42:48', '0000-00-00 00:00:00'),
(7, 'vcool', 0, 'f1dd6cb27c75c626fb56d8d8fbd232ea', 'rafeequl@gmail.com', 'user', 0, NULL, '2008-02-27 15:43:58', '2008-02-27 15:43:58', '0000-00-00 00:00:00'),
(8, 'supervisor', 0, '8730b46e10650dffe2284c1450a3017a', 'rafeequl@yahoo.com', 'superadmin', 0, NULL, '2008-02-19 15:44:51', '2008-02-19 15:44:51', '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- Table structure for table `fa_user_profile`
-- 

CREATE TABLE `fa_user_profile` (
  `id` int(11) NOT NULL,
  `field_1` varchar(50) default NULL,
  `field_2` varchar(50) default NULL,
  `call_me_nicely` varchar(3) default NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `fa_user_profile`
-- 

INSERT INTO `fa_user_profile` (`id`, `field_1`, `field_2`, `call_me_nicely`) VALUES 
(1, 'Rafeequl', 'Rafeequl Rahman Awan', '102'),
(5, 'aa', 'aa', 'aa'),
(7, 'vcool', 'Rafeequl Rahman', '123'),
(8, 'Rafeequl', 'Rafeequl Rahman Awan', '007');

-- --------------------------------------------------------

-- 
-- Table structure for table `fa_user_temp`
-- 

CREATE TABLE `fa_user_temp` (
  `id` int(11) NOT NULL auto_increment,
  `user_name` varchar(45) NOT NULL,
  `country_id` int(11) default NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(120) NOT NULL,
  `activation_code` varchar(50) NOT NULL,
  `created` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `user_FI_1` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `fa_user_temp`
-- 

INSERT INTO `fa_user_temp` (`id`, `user_name`, `country_id`, `password`, `email`, `activation_code`, `created`) VALUES 
(1, '123456', 100, 'ecdd9981841fa22896d34776a5249535', 'rafeequl@gmsail.com', 'llprt', '2007-12-11 04:28:17');

-- --------------------------------------------------------

-- 
-- Table structure for table `invoice`
-- 

CREATE TABLE `invoice` (
  `id` int(5) NOT NULL auto_increment,
  `realname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `used` int(255) NOT NULL,
  `bill_by` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `current_total` decimal(10,4) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- 
-- Dumping data for table `invoice`
-- 

INSERT INTO `invoice` (`id`, `realname`, `username`, `used`, `bill_by`, `date`, `current_total`) VALUES 
(1, 'linkor', 'linkor5', 397, 'time', '2008-02-19', 79306.6667),
(2, 'test', 'a', 384, 'time', '2008-02-19', 76733.3333),
(3, 'e', 'e', 384, 'time', '2008-02-19', 76733.3333),
(4, 'eee', 'aea', 384, 'time', '2008-02-19', 76733.3333),
(5, 'q', 'q', 384, 'time', '2008-02-19', 76733.3333),
(6, 'eeee', 'qeqe', 384, 'time', '2008-02-19', 76733.3333),
(7, 'qw', 'qw', 384, 'time', '2008-02-19', 76733.3333),
(8, 'r', 'r', 384, 'time', '2008-02-19', 76733.3333),
(9, 's', 's', 384, 'time', '2008-02-19', 76733.3333),
(10, 't', 't', 384, 'time', '2008-02-19', 76733.3333);

-- --------------------------------------------------------

-- 
-- Table structure for table `invoice_detail`
-- 

CREATE TABLE `invoice_detail` (
  `id` int(11) NOT NULL auto_increment,
  `realname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `stop` datetime NOT NULL,
  `used` int(11) NOT NULL,
  `bill_by` varchar(255) NOT NULL,
  `total` decimal(10,4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- 
-- Dumping data for table `invoice_detail`
-- 

INSERT INTO `invoice_detail` (`id`, `realname`, `username`, `start`, `stop`, `used`, `bill_by`, `total`) VALUES 
(1, 'linkor', 'linkor5', '2008-01-25 17:40:42', '2008-01-25 17:53:34', 13, 'time', 2573.3333),
(2, 'linkor', 'linkor5', '2008-01-25 16:40:42', '2008-01-25 17:19:04', 384, 'time', 76733.3333),
(3, 'test', 'a', '2008-01-25 16:40:42', '2008-01-25 17:19:04', 384, 'time', 76733.3333),
(4, 'e', 'e', '2008-01-25 16:40:42', '2008-01-25 17:19:04', 384, 'time', 76733.3333),
(5, 'eee', 'aea', '2008-01-25 16:40:42', '2008-01-25 17:19:04', 384, 'time', 76733.3333),
(6, 'q', 'q', '2008-01-25 16:40:42', '2008-01-25 17:19:04', 384, 'time', 76733.3333),
(7, 'eeee', 'qeqe', '2008-01-25 16:40:42', '2008-01-25 17:19:04', 384, 'time', 76733.3333),
(8, 'qw', 'qw', '2008-01-25 16:40:42', '2008-01-25 17:19:04', 384, 'time', 76733.3333),
(9, 'r', 'r', '2008-01-25 16:40:42', '2008-01-25 17:19:04', 384, 'time', 76733.3333),
(10, 's', 's', '2008-01-25 16:40:42', '2008-01-25 17:19:04', 384, 'time', 76733.3333),
(11, 't', 't', '2008-01-25 16:40:42', '2008-01-25 17:19:04', 384, 'time', 76733.3333);

-- --------------------------------------------------------

-- 
-- Table structure for table `nas`
-- 

CREATE TABLE `nas` (
  `id` int(10) NOT NULL auto_increment,
  `nasname` varchar(128) NOT NULL,
  `shortname` varchar(32) default NULL,
  `type` varchar(30) default 'other',
  `ports` int(5) default NULL,
  `secret` varchar(60) NOT NULL default 'secret',
  `community` varchar(50) default NULL,
  `description` varchar(200) default 'RADIUS Client',
  PRIMARY KEY  (`id`),
  KEY `nasname` (`nasname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `nas`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `postpaid_account`
-- 

CREATE TABLE `postpaid_account` (
  `id` int(255) NOT NULL auto_increment,
  `realname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `bill_by` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

-- 
-- Dumping data for table `postpaid_account`
-- 

INSERT INTO `postpaid_account` (`id`, `realname`, `username`, `password`, `bill_by`, `created_by`) VALUES 
(7, 'Tesing Acc', 'test', 'testing', 'time', 'vcool'),
(17, 'w', 'w', 'w', 'packet', 'vcool'),
(20, 'we', 'we', 'e', 'time', 'vcool'),
(22, 'ewew', 'eqq', 'e', 'time', 'vcool'),
(24, 'ee', 'eqqqq', 'e', 'time', 'vcool'),
(25, 'eqeee', 'eeeeee', 'ee', 'time', 'vcool'),
(26, 'eee', 'eeeeeee', 'eee', 'time', 'vcool'),
(27, 'Tanta', 'quro', 'quro123', 'time', 'vcool');

-- --------------------------------------------------------

-- 
-- Table structure for table `postplan`
-- 

CREATE TABLE `postplan` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(9) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `postplan`
-- 

INSERT INTO `postplan` (`id`, `name`, `price`) VALUES 
(1, 'packet', 100),
(2, 'time', 200);

-- --------------------------------------------------------

-- 
-- Table structure for table `radacct`
-- 

CREATE TABLE `radacct` (
  `radacctid` bigint(21) NOT NULL auto_increment,
  `acctsessionid` varchar(32) NOT NULL default '',
  `acctuniqueid` varchar(32) NOT NULL default '',
  `username` varchar(64) NOT NULL default '',
  `groupname` varchar(64) NOT NULL default '',
  `realm` varchar(64) default '',
  `nasipaddress` varchar(15) NOT NULL default '',
  `nasportid` varchar(15) default NULL,
  `nasporttype` varchar(32) default NULL,
  `acctstarttime` datetime default NULL,
  `acctstoptime` datetime default NULL,
  `acctsessiontime` int(12) default NULL,
  `acctauthentic` varchar(32) default NULL,
  `connectinfo_start` varchar(50) default NULL,
  `connectinfo_stop` varchar(50) default NULL,
  `acctinputoctets` bigint(20) default NULL,
  `acctoutputoctets` bigint(20) default NULL,
  `calledstationid` varchar(50) NOT NULL default '',
  `callingstationid` varchar(50) NOT NULL default '',
  `acctterminatecause` varchar(32) NOT NULL default '',
  `servicetype` varchar(32) default NULL,
  `framedprotocol` varchar(32) default NULL,
  `framedipaddress` varchar(15) NOT NULL default '',
  `acctstartdelay` int(12) default NULL,
  `acctstopdelay` int(12) default NULL,
  `xascendsessionsvrkey` varchar(10) default NULL,
  PRIMARY KEY  (`radacctid`),
  KEY `username` (`username`),
  KEY `framedipaddress` (`framedipaddress`),
  KEY `acctsessionid` (`acctsessionid`),
  KEY `acctuniqueid` (`acctuniqueid`),
  KEY `acctstarttime` (`acctstarttime`),
  KEY `acctstoptime` (`acctstoptime`),
  KEY `nasipaddress` (`nasipaddress`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- 
-- Dumping data for table `radacct`
-- 

INSERT INTO `radacct` (`radacctid`, `acctsessionid`, `acctuniqueid`, `username`, `groupname`, `realm`, `nasipaddress`, `nasportid`, `nasporttype`, `acctstarttime`, `acctstoptime`, `acctsessiontime`, `acctauthentic`, `connectinfo_start`, `connectinfo_stop`, `acctinputoctets`, `acctoutputoctets`, `calledstationid`, `callingstationid`, `acctterminatecause`, `servicetype`, `framedprotocol`, `framedipaddress`, `acctstartdelay`, `acctstopdelay`, `xascendsessionsvrkey`) VALUES 
(1, '4796f2b100000000', '7d6fbaf1d6734e39', 'thc_oi', '', '', '0.0.0.0', '0', 'Wireless-802.11', '2008-01-23 14:59:37', '2008-01-23 15:59:40', 3603, '', '', '', 2091835, 45583745, '00-E0-1C-3B-5C-91', '00-16-D3-5E-8F-F3', 'Session-Timeout', '', '', '192.168.182.2', 0, 0, NULL),
(2, '479701fc00000000', '8cf35d2c1eb0ce3f', 'thc_oi', '', '', '0.0.0.0', '0', 'Wireless-802.11', '2008-01-23 16:02:04', '0000-00-00 00:00:00', 0, '', '', '', 0, 0, '00-E0-1C-3B-5C-91', '00-16-D3-5E-8F-F3', '', '', '', '192.168.182.2', 0, 0, NULL),
(3, '4799ae2e00000000', '709a2a0cdfa2754b', 'thc_oi', '', '', '0.0.0.0', '0', 'Wireless-802.11', '2008-01-25 16:40:42', '2008-01-25 17:19:04', 2302, '', '', '', 32318, 94438, '00-E0-1C-3B-5C-91', '00-16-D3-5E-8F-F3', 'Lost-Carrier', '', '', '192.168.182.2', 0, 0, NULL),
(4, '4799bb9900000000', 'd6949cef6d6fd111', 'thc_oi', '', '', '0.0.0.0', '0', 'Wireless-802.11', '2008-01-25 17:40:42', '2008-01-25 17:53:34', 772, '', '', '', 13986, 37970, '00-E0-1C-3B-5C-91', '00-16-D3-5E-8F-F3', 'Lost-Carrier', '', '', '192.168.182.3', 0, 0, NULL),
(5, '4799bb9900000000', 'd6949cef6d6fd111', 'linkor5', '', '', '0.0.0.0', '0', 'Wireless-802.11', '2008-01-25 17:40:42', '2008-01-25 17:53:34', 772, '', '', '', 13986, 37970, '00-E0-1C-3B-5C-91', '00-16-D3-5E-8F-F3', 'Lost-Carrier', '', '', '192.168.182.3', 0, 0, NULL),
(8, '4799ae2e00000000', '709a2a0cdfa2754b', 'eee', '', '', '0.0.0.0', '0', 'Wireless-802.11', '2008-01-25 16:40:42', '2008-01-25 17:19:04', 23020, '', '', '', 32318, 94438, '00-E0-1C-3B-5C-91', '00-16-D3-5E-8F-F3', 'Lost-Carrier', '', '', '192.168.182.2', 0, 0, NULL),
(9, '4799ae2e00000000', '709a2a0cdfa2754b', 'e', '', '', '0.0.0.0', '0', 'Wireless-802.11', '2008-01-25 16:40:42', '2008-01-25 17:19:04', 23020, '', '', '', 32318, 94438, '00-E0-1C-3B-5C-91', '00-16-D3-5E-8F-F3', 'Lost-Carrier', '', '', '192.168.182.2', 0, 0, NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `radcheck`
-- 

CREATE TABLE `radcheck` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `username` varchar(64) NOT NULL default '',
  `attribute` varchar(32) NOT NULL default '',
  `op` char(2) NOT NULL default '==',
  `value` varchar(253) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `username` (`username`(32))
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100 ;

-- 
-- Dumping data for table `radcheck`
-- 

INSERT INTO `radcheck` (`id`, `username`, `attribute`, `op`, `value`) VALUES 
(29, 'test', 'User-Password', ':=', 'goncukq'),
(39, 'w', 'User-Password', ':=', 'goncukq'),
(42, 'we', 'User-Password', ':=', 'goncukq'),
(44, 'eqq', 'User-Password', ':=', 'goncukq'),
(46, 'eqqqq', 'User-Password', ':=', 'goncukq'),
(47, 'eeeeee', 'User-Password', ':=', 'goncukq'),
(48, 'eeeeeee', 'User-Password', ':=', 'goncukq'),
(89, 'quro', 'User-Password', ':=', 'quro123'),
(90, 'petpom9', 'User-Password', ':=', 'nekpuden'),
(91, 'kakkag8', 'User-Password', ':=', 'bucbotot'),
(92, 'kalcoc5', 'User-Password', ':=', 'nepnodun'),
(93, 'porcak14', 'User-Password', ':=', 'kubnodal'),
(94, 'vahpim9', 'User-Password', ':=', 'rucpelur'),
(95, 'zewziv13', 'User-Password', ':=', 'ducditid'),
(96, 'rirxil9', 'User-Password', ':=', 'sigpagap'),
(97, 'muskup15', 'User-Password', ':=', 'mutkipen'),
(98, 'pazpog11', 'User-Password', ':=', 'puctomit'),
(99, 'xucgav8', 'User-Password', ':=', 'namkonap');

-- --------------------------------------------------------

-- 
-- Table structure for table `radgroupcheck`
-- 

CREATE TABLE `radgroupcheck` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `groupname` varchar(64) NOT NULL default '',
  `attribute` varchar(32) NOT NULL default '',
  `op` char(2) NOT NULL default '==',
  `value` varchar(253) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `groupname` (`groupname`(32))
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- 
-- Dumping data for table `radgroupcheck`
-- 

INSERT INTO `radgroupcheck` (`id`, `groupname`, `attribute`, `op`, `value`) VALUES 
(5, '10 mega', 'ChilliSpot-Max-Total-Octets', ':=', '10485760'),
(6, '1 jam', 'Max-All-Session', ':=', '3600'),
(7, '1 jam', 'Simultaneous-Use', ':=', '1'),
(8, '20 Mega', 'Max-All-MB', ':=', '20971520'),
(9, '20 Mega', 'Simultaneous-Use', ':=', '1');

-- --------------------------------------------------------

-- 
-- Table structure for table `radgroupreply`
-- 

CREATE TABLE `radgroupreply` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `groupname` varchar(64) NOT NULL default '',
  `attribute` varchar(32) NOT NULL default '',
  `op` char(2) NOT NULL default '=',
  `value` varchar(253) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `groupname` (`groupname`(32))
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `radgroupreply`
-- 

INSERT INTO `radgroupreply` (`id`, `groupname`, `attribute`, `op`, `value`) VALUES 
(1, '1 jam', 'WISPr-Bandwidth-Max-Down', ':=', '128000'),
(2, '1 jam', 'WISPr-Bandwidth-Max-Up', ':=', '640000'),
(3, '1 jam', 'Idle-Timeout', ':=', '600'),
(4, '20 Mega', 'WISPr-Bandwidth-Max-Down', ':=', '128000'),
(5, '20 Mega', 'WISPr-Bandwidth-Max-Up', ':=', '640000'),
(6, '20 Mega', 'Idle-Timeout', ':=', '600');

-- --------------------------------------------------------

-- 
-- Table structure for table `radpostauth`
-- 

CREATE TABLE `radpostauth` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(64) NOT NULL default '',
  `pass` varchar(64) NOT NULL default '',
  `reply` varchar(32) NOT NULL default '',
  `authdate` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `radpostauth`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `radreply`
-- 

CREATE TABLE `radreply` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `username` varchar(64) NOT NULL default '',
  `attribute` varchar(32) NOT NULL default '',
  `op` char(2) NOT NULL default '=',
  `value` varchar(253) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `username` (`username`(32))
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `radreply`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `usergroup`
-- 

CREATE TABLE `usergroup` (
  `username` varchar(64) NOT NULL default '',
  `groupname` varchar(64) NOT NULL default '',
  `priority` int(11) NOT NULL default '1',
  KEY `username` (`username`(32))
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `usergroup`
-- 

INSERT INTO `usergroup` (`username`, `groupname`, `priority`) VALUES 
('petpom9', '1 jam', 1),
('kakkag8', '1 jam', 1),
('kalcoc5', '1 jam', 1),
('porcak14', '1 jam', 1),
('vahpim9', '1 jam', 1),
('zewziv13', '20 Mega', 1),
('rirxil9', '20 Mega', 1),
('muskup15', '20 Mega', 1),
('pazpog11', '20 Mega', 1),
('xucgav8', '20 Mega', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `voucher`
-- 

CREATE TABLE `voucher` (
  `id` int(255) NOT NULL auto_increment,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `billingplan` varchar(255) NOT NULL,
  `isprinted` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- 
-- Dumping data for table `voucher`
-- 

INSERT INTO `voucher` (`id`, `username`, `password`, `billingplan`, `isprinted`) VALUES 
(1, 'petpom9', 'nekpuden', '1 jam', 0),
(2, 'kakkag8', 'bucbotot', '1 jam', 0),
(3, 'kalcoc5', 'nepnodun', '1 jam', 0),
(4, 'porcak14', 'kubnodal', '1 jam', 0),
(5, 'vahpim9', 'rucpelur', '1 jam', 0),
(6, 'zewziv13', 'ducditid', '20 Mega', 0),
(7, 'rirxil9', 'sigpagap', '20 Mega', 0),
(8, 'muskup15', 'mutkipen', '20 Mega', 0),
(9, 'pazpog11', 'puctomit', '20 Mega', 1),
(10, 'xucgav8', 'namkonap', '20 Mega', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `postpaid_account_bill`
-- 

CREATE  VIEW `easyhotspot`.`postpaid_account_bill` AS select `easyhotspot`.`postpaid_account`.`realname` AS `realname`,`easyhotspot`.`postpaid_account`.`username` AS `username`,`easyhotspot`.`postpaid_account`.`password` AS `password`,`easyhotspot`.`radacct`.`acctstarttime` AS `start`,`easyhotspot`.`radacct`.`acctstoptime` AS `stop`,(`easyhotspot`.`radacct`.`acctsessiontime` / 60) AS `time_used`,((`easyhotspot`.`radacct`.`acctoutputoctets` + `easyhotspot`.`radacct`.`acctinputoctets`) / 1048576) AS `packet_used`,`easyhotspot`.`postpaid_account`.`bill_by` AS `bill_by`,(`easyhotspot`.`postplan`.`price` * (`easyhotspot`.`radacct`.`acctsessiontime` / 60)) AS `time_price`,(`easyhotspot`.`postplan`.`price` * ((`easyhotspot`.`radacct`.`acctoutputoctets` + `easyhotspot`.`radacct`.`acctinputoctets`) / 1048576)) AS `packet_price` from ((`easyhotspot`.`postpaid_account` left join `easyhotspot`.`radacct` on((`easyhotspot`.`postpaid_account`.`username` = `easyhotspot`.`radacct`.`username`))) join `easyhotspot`.`postplan` on((`easyhotspot`.`postplan`.`name` = `easyhotspot`.`postpaid_account`.`bill_by`)));

-- --------------------------------------------------------

-- 
-- Table structure for table `postpaid_account_list`
-- 

CREATE  VIEW `easyhotspot`.`postpaid_account_list` AS select `easyhotspot`.`postpaid_account`.`id` AS `id`,`easyhotspot`.`postpaid_account`.`realname` AS `realname`,`easyhotspot`.`postpaid_account`.`username` AS `username`,`easyhotspot`.`postpaid_account`.`password` AS `password`,(sum(`easyhotspot`.`radacct`.`acctsessiontime`) / 60) AS `time_used`,(sum((`easyhotspot`.`radacct`.`acctoutputoctets` + `easyhotspot`.`radacct`.`acctinputoctets`)) / 1048576) AS `packet_used`,`easyhotspot`.`postpaid_account`.`bill_by` AS `bill_by`,(`easyhotspot`.`postplan`.`price` * (sum(`easyhotspot`.`radacct`.`acctsessiontime`) / 60)) AS `time_price`,(`easyhotspot`.`postplan`.`price` * (sum((`easyhotspot`.`radacct`.`acctoutputoctets` + `easyhotspot`.`radacct`.`acctinputoctets`)) / 1048576)) AS `packet_price` from ((`easyhotspot`.`postpaid_account` left join `easyhotspot`.`radacct` on((`easyhotspot`.`postpaid_account`.`username` = `easyhotspot`.`radacct`.`username`))) join `easyhotspot`.`postplan` on((`easyhotspot`.`postplan`.`name` = `easyhotspot`.`postpaid_account`.`bill_by`))) group by `easyhotspot`.`postpaid_account`.`username`;

-- --------------------------------------------------------

-- 
-- Table structure for table `voucher_list`
-- 

CREATE  VIEW `easyhotspot`.`voucher_list` AS select `v`.`id` AS `id`,`v`.`username` AS `username`,`v`.`password` AS `password`,`v`.`billingplan` AS `billingplan`,`b`.`type` AS `type`,`b`.`amount` AS `amount`,`b`.`price` AS `price`,(sum(`ra`.`acctsessiontime`) / 60) AS `time_used`,if((`b`.`type` = _latin1'time'),(`b`.`amount` - (sum(`ra`.`acctsessiontime`) / 60)),_latin1'null') AS `time_remain`,((sum(`ra`.`acctoutputoctets`) + sum(`ra`.`acctinputoctets`)) / 1048576) AS `packet_used`,if((`b`.`type` = _latin1'packet'),(`b`.`amount` - (sum((`ra`.`acctoutputoctets` + `ra`.`acctinputoctets`)) / 1048576)),_latin1'null') AS `packet_remain`,`v`.`isprinted` AS `isprinted`,if((`b`.`type` = _latin1'time'),if(((sum(`ra`.`acctsessiontime`) / 60) >= `b`.`amount`),_latin1'exp',_latin1'valid'),if((((sum(`ra`.`acctoutputoctets`) + sum(`ra`.`acctinputoctets`)) / 1048576) >= `b`.`amount`),_latin1'exp',_latin1'valid')) AS `valid` from ((`easyhotspot`.`voucher` `v` left join `easyhotspot`.`radacct` `ra` on((`v`.`username` = `ra`.`username`))) join `easyhotspot`.`billingplan` `b` on((`b`.`name` = `v`.`billingplan`))) group by `v`.`username`;
