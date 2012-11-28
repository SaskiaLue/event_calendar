-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 28. Nov 2012 um 20:33
-- Server Version: 5.5.16
-- PHP-Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `db372066379`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_type_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `details` text COLLATE utf8_unicode_ci NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `participants` int(11) NOT NULL,
  `repeated` int(11) DEFAULT NULL,
  `title_english` text COLLATE utf8_unicode_ci NOT NULL,
  `details_english` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=54 ;

--
-- Daten für Tabelle `events`
--

INSERT INTO `events` (`id`, `event_type_id`, `date`, `title`, `details`, `start`, `end`, `active`, `participants`, `repeated`, `title_english`, `details_english`) VALUES
(1, 3, '2012-11-26', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 2, 'test', 'test'),
(2, 3, '2012-11-26', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(3, 3, '2012-12-03', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(4, 3, '2012-12-10', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(5, 3, '2012-12-17', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(6, 3, '2012-12-24', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(7, 3, '2012-12-31', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(8, 3, '2013-01-07', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(9, 3, '2013-01-14', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(10, 3, '2013-01-21', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(11, 3, '2013-01-28', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(12, 3, '2013-02-04', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(13, 3, '2013-02-11', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(14, 3, '2013-02-18', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(15, 3, '2013-02-25', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(16, 3, '2013-03-04', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(17, 3, '2013-03-11', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(18, 3, '2013-03-18', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(19, 3, '2013-03-25', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(20, 3, '2013-04-01', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(21, 3, '2013-04-08', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(22, 3, '2013-04-15', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(23, 3, '2013-04-22', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(24, 3, '2013-04-29', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(25, 3, '2013-05-06', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(26, 3, '2013-05-13', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(27, 3, '2013-05-20', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(28, 3, '2013-05-27', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(29, 3, '2013-06-03', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(30, 3, '2013-06-10', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(31, 3, '2013-06-17', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(32, 3, '2013-06-24', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(33, 1, '2012-11-29', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 2, 'hihi', 'hihi'),
(34, 1, '2012-11-29', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 0, 'hihi', 'hihi'),
(35, 1, '2012-12-06', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 0, 'hihi', 'hihi'),
(36, 1, '2012-12-13', 'eded', 'eded', '11:00:00', '12:00:00', 1, 23, 0, 'bgbg', 'bgbg'),
(37, 1, '2012-12-20', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 0, 'hihi', 'hihi'),
(38, 1, '2012-12-27', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 0, 'hihi', 'hihi'),
(39, 1, '2013-01-03', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 0, 'hihi', 'hihi'),
(40, 1, '2013-01-10', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 0, 'hihi', 'hihi'),
(41, 1, '2013-01-17', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 0, 'hihi', 'hihi'),
(42, 1, '2013-01-24', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 0, 'hihi', 'hihi'),
(43, 1, '2013-01-31', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 0, 'hihi', 'hihi'),
(44, 1, '2013-02-07', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 0, 'hihi', 'hihi'),
(45, 1, '2013-02-14', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 0, 'hihi', 'hihi'),
(46, 1, '2013-02-21', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 0, 'hihi', 'hihi'),
(47, 1, '2013-02-28', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 0, 'hihi', 'hihi'),
(48, 1, '2013-03-07', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 0, 'hihi', 'hihi'),
(49, 1, '2013-03-14', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 0, 'hihi', 'hihi'),
(50, 1, '2013-03-21', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 0, 'hihi', 'hihi'),
(51, 1, '2013-03-28', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 0, 'hihi', 'hihi'),
(52, 1, '2012-12-06', 'huhu', 'huhu', '12:00:00', '13:00:00', 1, 23, 0, 'hihi', 'hihi'),
(53, 1, '2012-12-07', 'huhu', 'huhu', '08:00:00', '09:00:00', 1, 0, 0, 'huhu', 'huhu');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `event_delete_month`
--

DROP TABLE IF EXISTS `event_delete_month`;
CREATE TABLE IF NOT EXISTS `event_delete_month` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastdelete` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `event_delete_month`
--

INSERT INTO `event_delete_month` (`id`, `lastdelete`) VALUES
(1, '2012-11-26');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `event_repeat`
--

DROP TABLE IF EXISTS `event_repeat`;
CREATE TABLE IF NOT EXISTS `event_repeat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name_eng` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `event_repeat`
--

INSERT INTO `event_repeat` (`id`, `name`, `name_eng`) VALUES
(1, 'täglich', 'daily'),
(2, 'wöchentlich', 'weekly'),
(3, 'monatlich', 'monthly');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `event_types`
--

DROP TABLE IF EXISTS `event_types`;
CREATE TABLE IF NOT EXISTS `event_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `color_code` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `name_english` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Daten für Tabelle `event_types`
--

INSERT INTO `event_types` (`id`, `name`, `color`, `color_code`, `name_english`) VALUES
(1, 'Licht', 'gelb', 'ffffcc', 'light'),
(2, 'Leben', 'gruen', 'ccff99', 'life'),
(3, 'Liebe', 'rosa', 'ffccff', 'love'),
(4, 'Frieden', 'blau', 'ccffff', 'peace');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `event_user`
--

DROP TABLE IF EXISTS `event_user`;
CREATE TABLE IF NOT EXISTS `event_user` (
  `id` int(14) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '',
  `pwd` varchar(50) NOT NULL DEFAULT '',
  `mail` varchar(100) DEFAULT '',
  `sid` varchar(32) NOT NULL DEFAULT '',
  `autologin` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Daten für Tabelle `event_user`
--

INSERT INTO `event_user` (`id`, `username`, `pwd`, `mail`, `sid`, `autologin`) VALUES
(1, 'phpadmin', 'adminpw', 'admin@admin.de', '3b47gfluakbqnbv1ccl784a7n2', NULL),
(22, 'Bla1', 'pw', 'bl@bla.com', '', NULL),
(16, 'test', 'test', 'test@test.de', '', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `event_user_rights`
--

DROP TABLE IF EXISTS `event_user_rights`;
CREATE TABLE IF NOT EXISTS `event_user_rights` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `user_right` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Daten für Tabelle `event_user_rights`
--

INSERT INTO `event_user_rights` (`id`, `userid`, `user_right`) VALUES
(1, 1, 'admin'),
(4, 1, 'events'),
(5, 16, 'events'),
(11, 22, 'events');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
