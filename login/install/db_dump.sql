--
-- PHP Login Script SQL File
--
-- Run this SQL file to create the neccessary tables and default
-- database entries needed to get the scrip working.
--
-- Created by The Angry Frog - http://www.angry-frog.com

-- --------------------------------------------------------

--
-- Table structure for table `active_guests`
--

CREATE TABLE IF NOT EXISTS `active_guests` (
  `ip` varchar(15) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `active_users`
--

CREATE TABLE IF NOT EXISTS `active_users` (
  `username` varchar(30) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `banned_users`
--

CREATE TABLE IF NOT EXISTS `banned_users` (
  `username` varchar(30) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `configuration`
--

CREATE TABLE IF NOT EXISTS `configuration` (
  `config_name` varchar(20) NOT NULL,
  `config_value` varchar(50) NOT NULL,
  KEY `config_name` (`config_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `configuration`
--

INSERT INTO `configuration` (`config_name`, `config_value`) VALUES
('ACCOUNT_ACTIVATION', '1'),
('TRACK_VISITORS', '1'),
('max_user_chars', '30'),
('min_user_chars', '5'),
('max_pass_chars', '100'),
('min_pass_chars', '6'),
('EMAIL_FROM_NAME', 'PHP Login Script'),
('EMAIL_FROM_ADDR', 'email@yoursite.com'),
('EMAIL_WELCOME', '0'),
('SITE_NAME', 'PHP Login Script V3'),
('SITE_DESC', 'PHP Login Script'),
('WEB_ROOT', 'http://www.yoursite.com/login/'),
('ENABLE_CAPTCHA', '0'),
('COOKIE_EXPIRE', '100'),
('COOKIE_PATH', '/'),
('home_page', 'main.php'),
('ALL_LOWERCASE', '0'),
('Version', '3.1'),
('USER_TIMEOUT', '10'),
('GUEST_TIMEOUT', '5');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(30) NOT NULL,
  `password` varchar(40) default NULL,
  `usersalt` varchar(8) NOT NULL,
  `userid` varchar(32) default NULL,
  `userlevel` tinyint(1) unsigned NOT NULL,
  `email` varchar(50) default NULL,
  `timestamp` int(11) unsigned NOT NULL,
  `actkey` varchar(35) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `regdate` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

