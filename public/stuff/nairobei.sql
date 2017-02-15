-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 15, 2017 at 11:03 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nairobei`
--
CREATE DATABASE IF NOT EXISTS `nairobei` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `nairobei`;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `body` text NOT NULL,
  `slug` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `main_image` varchar(100) NOT NULL,
  `author` int(11) NOT NULL COMMENT 'author_id from user_admin table',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 is published 0 is draft',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `body`, `slug`, `category`, `main_image`, `author`, `type`, `created`, `modified`) VALUES
(1, 'Hello world', 'Greatings!!<br /><br /><img src="/nairobe/public/tinymce/blog_media/Adriana-lima-emily-browning-twitter-1920x1200-wallpaper15698.jpg" alt="" />', 'hello-world', 'history', '/tinymce/blog_media/8ef8ed64169fb0ce23ba7026166594c4.jpg', 1, 1, '2017-02-15 10:57:19', '2017-02-15 10:57:19'),
(2, 'New Engine', 'a dolphin<br /><img src="/nairobe/public/tinymce/blog_media/dolphin.jpg" alt="" />', 'new-engine', 'gava_kilo_nusu', '/tinymce/blog_media/524253f4a39ddf81ad512b864a047954.jpg', 1, 1, '2017-02-15 10:58:55', '2017-02-15 10:58:55');

-- --------------------------------------------------------

--
-- Table structure for table `articles_categories`
--

CREATE TABLE IF NOT EXISTS `articles_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `articles_likes`
--

CREATE TABLE IF NOT EXISTS `articles_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `like_ip_address` varchar(100) NOT NULL,
  `liked` tinyint(1) NOT NULL COMMENT '1 if they liked, 0 if they unliked',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `backgrounds`
--

CREATE TABLE IF NOT EXISTS `backgrounds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner` varchar(100) NOT NULL,
  `ig_link` varchar(100) NOT NULL,
  `twitter_link` varchar(100) NOT NULL,
  `image_url` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('03d3230c8d12592c6d16ee65552d98a4106d5b87', '127.0.0.1', 1487064143, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373036343134333b),
('4f053c1cee87ff77b4defa09be821bc651ca147b', '127.0.0.1', 1487156149, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373135353931303b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343837303739373033223b),
('5ea1a5e18bc9b6bc2da15238e497eea8740bfdfa', '127.0.0.1', 1486976505, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438363937363238313b),
('63e9917a6c3a32cf18c15a6f1c468631eae7f6fc', '127.0.0.1', 1486976185, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438363937353935353b),
('76e64240ea095a1ace9da89c231fde1614c7b6be', '127.0.0.1', 1487156420, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373135363233393b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343837303739373033223b),
('8472461802729a81bfd0044af7aa79bed7918b1d', '127.0.0.1', 1486977803, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438363937373739383b),
('9f1a0934b205890aa6f45c65ed6fc35d6890edae', '127.0.0.1', 1486976664, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438363937363632333b6d6573736167657c733a32323a223c703e496e636f7272656374204c6f67696e3c2f703e223b5f5f63695f766172737c613a313a7b733a373a226d657373616765223b733a333a226f6c64223b7d),
('acddfbdc4a42ff6cbca4ce586bc9b9445067af27', '127.0.0.1', 1487079722, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438373037393639373b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343837303637393338223b);

-- --------------------------------------------------------

--
-- Table structure for table `gava_ads`
--

CREATE TABLE IF NOT EXISTS `gava_ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `link` varchar(100) NOT NULL,
  `image_link` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `gava_ads`
--

INSERT INTO `gava_ads` (`id`, `text`, `link`, `image_link`, `active`) VALUES
(1, 'Nolonger taking queues', 'huduma.gov', '/img/b61fbd65cc1184bdcb0642e89c603127.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User'),
(3, 'super_admin', 'The super administrators'),
(4, 'histo_admin', 'administrators to contribute to history section'),
(5, 'gava_admin', 'administrators to contribute to gava-kilo-nusu section'),
(6, 'music_admin', 'music section administrator');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(1, '127.0.0.1', 'admin@admin.com', 1484874035),
(2, '127.0.0.1', 'admin@admin.com', 1484874834),
(3, '127.0.0.1', 'admin@admin.com', 1484875495);

-- --------------------------------------------------------

--
-- Table structure for table `music`
--

CREATE TABLE IF NOT EXISTS `music` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `artist` varchar(100) NOT NULL,
  `embed_link` text NOT NULL,
  `buy_link` varchar(100) DEFAULT NULL,
  `coment` text,
  `hidden` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `music_active`
--

CREATE TABLE IF NOT EXISTS `music_active` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table` varchar(100) NOT NULL,
  `setting_list` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `music_likes`
--

CREATE TABLE IF NOT EXISTS `music_likes` (
  `id` int(11) NOT NULL,
  `music_id` int(11) NOT NULL,
  `like_ip_address` varchar(100) NOT NULL,
  `liked` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `music_sites`
--

CREATE TABLE IF NOT EXISTS `music_sites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `link_to_logo` varchar(100) NOT NULL,
  `link_to_site` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `site_active_background`
--

CREATE TABLE IF NOT EXISTS `site_active_background` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `background_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `photo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `photo`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$08$Rgee58Ji4OYPue2lmnwm4Og5eKLCk26jbGcaVncMJPhZBD16psZTW', '', 'admin@admin.com', '', NULL, NULL, 'dT53ew2tRafXdQtYQrOvpu', 1268889823, 1487155932, 1, 'Admin', 'istrator', 'ADMIN', '0', ''),
(4, '127.0.0.1', 'sam', '$2y$08$03.on56bAnt6qArYwSbh/uEFo0BCkTCO8tmPkGXBGTs1/wOK7/G6y', NULL, 'test@tesst.test', NULL, NULL, NULL, NULL, 1484768500, 1486972322, 1, 'sam', 'someone', 'some company', '0711111111', ''),
(5, '127.0.0.1', '', '$2y$08$f5UdFwBK.PktefyaDXRGx.dtZueAK2mhC2Sz9YufdjYc6g5MgqP8u', NULL, 'gabu@gggg.gg', NULL, NULL, NULL, NULL, 1485030703, 1485030876, 1, 'gabu', 'msee', 'some company', '200', ''),
(6, '127.0.0.1', '', '$2y$08$63w6eMyAjs9gnpq5nw8OHu3ifAMS0pAAHXM0wVw/jm2s3Mo4gVGce', NULL, 'histo@admin.com', NULL, NULL, NULL, NULL, 1486229959, 1486992710, 1, 'histo', 'ry', 'nairobei', '0', ''),
(7, '127.0.0.1', '', '$2y$08$UYNHPos5IqNnJizBta7bEuHyqddaXuEMSkcnazGvZry22sR.iJ4jW', NULL, 'gava@admin.com', NULL, NULL, NULL, NULL, 1486230070, 1486979198, 1, 'gava', 'admin', 'nairobei', '0', ''),
(8, '127.0.0.1', '', '$2y$08$XSk8.UrNtPgwImizxuqRve09CARIK7I8Cec/sQlin5C0ZpdJHQy86', NULL, 'music@admin.nai', NULL, NULL, NULL, NULL, 1486971768, 1486983877, 1, 'music', 'admin', 'nairobei', '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(33, 1, 1),
(34, 1, 3),
(35, 4, 2),
(36, 5, 2),
(37, 6, 1),
(38, 6, 4),
(39, 7, 1),
(40, 7, 5),
(31, 8, 1),
(32, 8, 6);

-- --------------------------------------------------------

--
-- Table structure for table `user_admin`
--

CREATE TABLE IF NOT EXISTS `user_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `f_name` varchar(100) NOT NULL,
  `l_name` varchar(100) NOT NULL,
  `n_name` varchar(100) NOT NULL,
  `about` text NOT NULL,
  `photo_url` varchar(100) NOT NULL,
  `type` int(2) NOT NULL COMMENT '0 for super admin',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
