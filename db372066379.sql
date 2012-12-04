-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 04. Dez 2012 um 19:40
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
  `repeatable_event_id` int(11) NOT NULL,
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11421 ;

--
-- Daten für Tabelle `events`
--

INSERT INTO `events` (`id`, `repeatable_event_id`, `event_type_id`, `date`, `title`, `details`, `start`, `end`, `active`, `participants`, `repeated`, `title_english`, `details_english`) VALUES
(1, 1, 3, '2012-11-26', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 2, 'test', 'test'),
(2, 1, 3, '2012-11-26', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(3, 1, 3, '2012-12-03', 'test', 'test', '19:30:00', '20:30:00', 1, 2, 0, 'test', 'test'),
(4, 1, 3, '2012-12-10', 'test', 'test', '19:30:00', '20:30:00', 1, 2, 0, 'test', 'test'),
(5, 1, 3, '2012-12-17', 'test', 'test', '19:30:00', '20:30:00', 1, 1, 0, 'test', 'test'),
(6, 1, 3, '2012-12-24', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(7, 1, 3, '2012-12-31', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(8, 1, 3, '2013-01-07', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(9, 1, 3, '2013-01-14', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(10, 1, 3, '2013-01-21', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(11, 1, 3, '2013-01-28', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(12, 1, 3, '2013-02-04', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(13, 1, 3, '2013-02-11', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(14, 1, 3, '2013-02-18', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(15, 1, 3, '2013-02-25', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(16, 1, 3, '2013-03-04', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(17, 1, 3, '2013-03-11', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(18, 1, 3, '2013-03-18', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(19, 1, 3, '2013-03-25', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(33, 0, 4, '2012-11-29', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 2, 'hihi', 'hihi'),
(34, 0, 1, '2012-11-29', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 0, 'hihi', 'hihi'),
(35, 0, 4, '2012-12-06', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 24, 0, 'hihi', 'hihi'),
(36, 0, 1, '2012-12-13', 'eded', 'eded', '11:00:00', '12:00:00', 1, 23, 0, 'bgbg', 'bgbg'),
(37, 0, 1, '2012-12-20', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 24, 0, 'hihi', 'hihi'),
(38, 0, 4, '2012-12-27', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 0, 'hihi', 'hihi'),
(39, 0, 1, '2013-01-03', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 24, 0, 'hihi', 'hihi'),
(40, 0, 1, '2013-01-10', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 24, 0, 'hihi', 'hihi'),
(41, 0, 4, '2013-01-17', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 0, 'hihi', 'hihi'),
(42, 0, 4, '2013-01-24', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 0, 'hihi', 'hihi'),
(43, 0, 4, '2013-01-31', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 0, 'hihi', 'hihi'),
(44, 0, 4, '2013-02-07', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 0, 'hihi', 'hihi'),
(45, 0, 4, '2013-02-14', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 0, 'hihi', 'hihi'),
(46, 0, 4, '2013-02-21', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 0, 'hihi', 'hihi'),
(47, 0, 4, '2013-02-28', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 0, 'hihi', 'hihi'),
(48, 0, 4, '2013-03-07', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 0, 'hihi', 'hihi'),
(49, 0, 4, '2013-03-14', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 0, 'hihi', 'hihi'),
(50, 0, 4, '2013-03-21', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 0, 'hihi', 'hihi'),
(51, 0, 4, '2013-03-28', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 0, 'hihi', 'hihi'),
(52, 0, 1, '2012-12-06', 'huhu', 'huhu', '12:00:00', '13:00:00', 1, 23, 0, 'hihi', 'hihi'),
(53, 0, 1, '2012-12-07', 'huhu', 'huhu', '08:00:00', '09:00:00', 1, 2, 0, 'huhu', 'huhu'),
(166, 0, 4, '2012-12-01', 'Frieden1', 'Frieden fÃ¼r alle', '22:00:00', '24:00:00', 1, 123, 2, 'Peace', 'Peace for everyone'),
(167, 0, 4, '2012-12-01', 'Frieden1', 'Frieden fÃ¼r alle', '22:00:00', '24:00:00', 1, 123, 0, 'Peace', 'Peace for everyone'),
(175, 0, 4, '2012-12-22', 'Frieden1', 'Frieden fÃ¼r alle', '22:00:00', '24:00:00', 1, 123, 0, 'Peace', 'Peace for everyone'),
(174, 0, 4, '2012-12-15', 'Frieden1', 'Frieden fÃ¼r alle', '22:00:00', '24:00:00', 1, 123, 0, 'Peace', 'Peace for everyone'),
(173, 0, 4, '2012-12-08', 'Frieden1', 'Frieden fÃ¼r alle', '22:00:00', '24:00:00', 1, 123, 0, 'Peace', 'Peace for everyone'),
(176, 0, 4, '2012-12-29', 'Frieden1', 'Frieden fÃ¼r alle', '22:00:00', '24:00:00', 1, 123, 0, 'Peace', 'Peace for everyone'),
(177, 0, 4, '2013-01-05', 'Frieden1', 'Frieden fÃ¼r alle', '22:00:00', '24:00:00', 1, 123, 0, 'Peace', 'Peace for everyone'),
(178, 0, 4, '2013-01-12', 'Frieden1', 'Frieden fÃ¼r alle', '22:00:00', '24:00:00', 1, 123, 0, 'Peace', 'Peace for everyone'),
(179, 0, 4, '2013-01-19', 'Frieden1', 'Frieden fÃ¼r alle', '22:00:00', '24:00:00', 1, 123, 0, 'Peace', 'Peace for everyone'),
(180, 0, 4, '2013-01-26', 'Frieden1', 'Frieden fÃ¼r alle', '22:00:00', '24:00:00', 1, 123, 0, 'Peace', 'Peace for everyone'),
(181, 0, 4, '2013-02-02', 'Frieden1', 'Frieden fÃ¼r alle', '22:00:00', '24:00:00', 1, 123, 0, 'Peace', 'Peace for everyone'),
(182, 0, 4, '2013-02-09', 'Frieden1', 'Frieden fÃ¼r alle', '22:00:00', '24:00:00', 1, 123, 0, 'Peace', 'Peace for everyone'),
(183, 0, 4, '2013-02-16', 'Frieden1', 'Frieden fÃ¼r alle', '22:00:00', '24:00:00', 1, 123, 0, 'Peace', 'Peace for everyone'),
(184, 0, 4, '2013-02-23', 'Frieden1', 'Frieden fÃ¼r alle', '22:00:00', '24:00:00', 1, 123, 0, 'Peace', 'Peace for everyone'),
(185, 0, 4, '2013-03-02', 'Frieden1', 'Frieden fÃ¼r alle', '22:00:00', '24:00:00', 1, 123, 0, 'Peace', 'Peace for everyone'),
(186, 0, 4, '2013-03-09', 'Frieden1', 'Frieden fÃ¼r alle', '22:00:00', '24:00:00', 1, 123, 0, 'Peace', 'Peace for everyone'),
(187, 0, 4, '2013-03-16', 'Frieden1', 'Frieden fÃ¼r alle', '22:00:00', '24:00:00', 1, 123, 0, 'Peace', 'Peace for everyone'),
(188, 0, 4, '2013-03-23', 'Frieden1', 'Frieden fÃ¼r alle', '22:00:00', '24:00:00', 1, 123, 0, 'Peace', 'Peace for everyone'),
(189, 0, 4, '2013-03-30', 'Frieden1', 'Frieden fÃ¼r alle', '22:00:00', '24:00:00', 1, 123, 0, 'Peace', 'Peace for everyone'),
(11220, 0, 2, '2013-02-04', 'Leben', 'hih', '11:00:00', '00:00:00', 1, 0, 0, 'kmk', 'nknk'),
(11221, 0, 2, '2013-03-04', 'Leben', 'hih', '11:00:00', '00:00:00', 1, 0, 0, 'kmk', 'nknk'),
(11218, 0, 2, '2012-12-04', 'Leben', 'hih', '11:00:00', '00:00:00', 1, 0, 0, 'kmk', 'nknk'),
(11219, 0, 2, '2013-01-04', 'Leben', 'hih', '11:00:00', '00:00:00', 1, 0, 0, 'kmk', 'nknk'),
(11217, 0, 2, '2012-12-04', 'Leben', 'hih', '11:00:00', '00:00:00', 1, 0, 3, 'kmk', 'nknk'),
(11397, 0, 2, '2012-12-26', 'Leben', 'Leben', '08:00:00', '00:00:00', 1, 888, 0, 'Life', 'Life'),
(11398, 0, 2, '2013-01-02', 'Leben', 'Leben', '08:00:00', '00:00:00', 1, 888, 0, 'Life', 'Life'),
(11399, 0, 2, '2013-01-09', 'Leben', 'Leben', '08:00:00', '00:00:00', 1, 888, 0, 'Life', 'Life'),
(11400, 0, 2, '2013-01-16', 'Leben', 'Leben', '08:00:00', '00:00:00', 1, 888, 0, 'Life', 'Life'),
(11401, 0, 2, '2013-01-23', 'Leben', 'Leben', '08:00:00', '00:00:00', 1, 888, 0, 'Life', 'Life'),
(11402, 0, 2, '2013-01-30', 'Leben', 'Leben', '08:00:00', '00:00:00', 1, 888, 0, 'Life', 'Life'),
(11403, 0, 2, '2013-02-06', 'Leben', 'Leben', '08:00:00', '00:00:00', 1, 888, 0, 'Life', 'Life'),
(11404, 0, 2, '2013-02-13', 'Leben', 'Leben', '08:00:00', '00:00:00', 1, 888, 0, 'Life', 'Life'),
(11405, 0, 2, '2013-02-20', 'Leben', 'Leben', '08:00:00', '00:00:00', 1, 888, 0, 'Life', 'Life'),
(11406, 0, 2, '2013-02-27', 'Leben', 'Leben', '08:00:00', '00:00:00', 1, 888, 0, 'Life', 'Life'),
(11407, 0, 2, '2013-03-06', 'Leben', 'Leben', '08:00:00', '00:00:00', 1, 888, 0, 'Life', 'Life'),
(11408, 0, 2, '2013-03-13', 'Leben', 'Leben', '08:00:00', '00:00:00', 1, 888, 0, 'Life', 'Life'),
(11409, 0, 2, '2013-03-20', 'Leben', 'Leben', '08:00:00', '00:00:00', 1, 888, 0, 'Life', 'Life'),
(11410, 0, 2, '2013-03-27', 'Leben', 'Leben', '08:00:00', '00:00:00', 1, 888, 0, 'Life', 'Life'),
(11411, 0, 2, '2013-04-03', 'Leben', 'Leben', '08:00:00', '00:00:00', 1, 888, 0, 'Life', 'Life'),
(11412, 0, 2, '2013-04-10', 'Leben', 'Leben', '08:00:00', '00:00:00', 1, 888, 0, 'Life', 'Life'),
(11413, 0, 2, '2013-04-17', 'Leben', 'Leben', '08:00:00', '00:00:00', 1, 888, 0, 'Life', 'Life'),
(11414, 0, 2, '2013-04-24', 'Leben', 'Leben', '08:00:00', '00:00:00', 1, 888, 0, 'Life', 'Life'),
(11223, 0, 1, '2013-01-01', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 1, 'sfsf', 'sfdf'),
(11224, 0, 1, '2013-01-01', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11392, 0, 1, '2013-04-01', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11391, 1, 3, '2013-04-01', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(11390, 0, 3, '2013-04-04', 'Liebe liegt in der Luft', 'Liebe liegt in der Luft', '09:00:00', '12:00:00', 1, 100, 0, 'love is in the air', 'love is in the air today'),
(11389, 0, 1, '2013-04-30', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11388, 0, 1, '2013-04-29', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11387, 0, 1, '2013-04-28', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11386, 0, 1, '2013-04-27', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11385, 0, 1, '2013-04-26', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11384, 0, 1, '2013-04-25', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11383, 0, 1, '2013-04-24', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11382, 0, 1, '2013-04-23', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11381, 0, 1, '2013-04-22', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11380, 0, 1, '2013-04-21', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11379, 0, 1, '2013-04-20', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11378, 0, 1, '2013-04-19', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11377, 0, 1, '2013-04-18', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11376, 0, 1, '2013-04-17', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11375, 0, 1, '2013-04-16', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11374, 0, 1, '2013-04-15', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11373, 0, 1, '2013-04-14', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11372, 0, 1, '2013-04-13', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11371, 0, 1, '2013-04-12', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11370, 0, 1, '2013-04-11', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11369, 0, 1, '2013-04-10', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11368, 0, 1, '2013-04-09', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11367, 0, 1, '2013-04-08', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11366, 0, 1, '2013-04-07', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11365, 0, 1, '2013-04-06', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11364, 0, 1, '2013-04-05', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11363, 0, 1, '2013-04-04', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11362, 0, 1, '2013-04-03', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11361, 0, 1, '2013-04-02', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11396, 0, 2, '2012-12-19', 'Leben', 'Leben', '08:00:00', '00:00:00', 1, 888, 0, 'Life', 'Life'),
(11395, 0, 2, '2012-12-12', 'Leben', 'Leben', '08:00:00', '00:00:00', 1, 888, 0, 'Life', 'Life'),
(11393, 0, 2, '2012-12-05', 'Leben', 'Leben', '08:00:00', '00:00:00', 1, 888, 2, 'Life', 'Life'),
(11356, 0, 2, '2013-04-04', 'Leben', 'hih', '11:00:00', '00:00:00', 1, 0, 0, 'kmk', 'nknk'),
(11355, 0, 4, '2013-04-27', 'Frieden1', 'Frieden fÃ¼r alle', '22:00:00', '24:00:00', 1, 123, 0, 'Peace', 'Peace for everyone'),
(11354, 0, 4, '2013-04-20', 'Frieden1', 'Frieden fÃ¼r alle', '22:00:00', '24:00:00', 1, 123, 0, 'Peace', 'Peace for everyone'),
(11353, 0, 4, '2013-04-13', 'Frieden1', 'Frieden fÃ¼r alle', '22:00:00', '24:00:00', 1, 123, 0, 'Peace', 'Peace for everyone'),
(11352, 0, 4, '2013-04-06', 'Frieden1', 'Frieden fÃ¼r alle', '22:00:00', '24:00:00', 1, 123, 0, 'Peace', 'Peace for everyone'),
(11351, 0, 4, '2013-04-25', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 0, 'hihi', 'hihi'),
(11350, 0, 4, '2013-04-18', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 0, 'hihi', 'hihi'),
(11349, 0, 4, '2013-04-11', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 0, 'hihi', 'hihi'),
(11348, 0, 4, '2013-04-04', 'huhu', 'huhu', '11:00:00', '12:00:00', 1, 23, 0, 'hihi', 'hihi'),
(11347, 1, 3, '2013-04-29', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(11346, 1, 3, '2013-04-22', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(11345, 1, 3, '2013-04-15', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(11344, 1, 3, '2013-04-08', 'test', 'test', '19:30:00', '20:30:00', 1, 0, 0, 'test', 'test'),
(11313, 0, 1, '2013-03-31', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11312, 0, 1, '2013-03-30', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11311, 0, 1, '2013-03-29', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11310, 0, 1, '2013-03-28', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11309, 0, 1, '2013-03-27', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11308, 0, 1, '2013-03-26', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11307, 0, 1, '2013-03-25', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11306, 0, 1, '2013-03-24', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11305, 0, 1, '2013-03-23', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11304, 0, 1, '2013-03-22', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11303, 0, 1, '2013-03-21', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11302, 0, 1, '2013-03-20', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11301, 0, 1, '2013-03-19', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11300, 0, 1, '2013-03-18', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11299, 0, 1, '2013-03-17', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11298, 0, 1, '2013-03-16', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11297, 0, 1, '2013-03-15', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11296, 0, 1, '2013-03-14', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11295, 0, 1, '2013-03-13', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11294, 0, 1, '2013-03-12', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11293, 0, 1, '2013-03-11', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11292, 0, 1, '2013-03-10', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11291, 0, 1, '2013-03-09', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11290, 0, 1, '2013-03-08', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11289, 0, 1, '2013-03-07', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11288, 0, 1, '2013-03-06', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11287, 0, 1, '2013-03-05', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11286, 0, 1, '2013-03-04', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11285, 0, 1, '2013-03-03', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11284, 0, 1, '2013-03-02', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11283, 0, 1, '2013-03-01', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11282, 0, 1, '2013-02-28', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11281, 0, 1, '2013-02-27', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11280, 0, 1, '2013-02-26', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11279, 0, 1, '2013-02-25', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11278, 0, 1, '2013-02-24', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11277, 0, 1, '2013-02-23', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11276, 0, 1, '2013-02-22', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11275, 0, 1, '2013-02-21', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11274, 0, 1, '2013-02-20', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11273, 0, 1, '2013-02-19', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11272, 0, 1, '2013-02-18', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11271, 0, 1, '2013-02-17', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11270, 0, 1, '2013-02-16', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11269, 0, 1, '2013-02-15', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11268, 0, 1, '2013-02-14', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11267, 0, 1, '2013-02-13', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11266, 0, 1, '2013-02-12', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11265, 0, 1, '2013-02-11', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11264, 0, 1, '2013-02-10', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11263, 0, 1, '2013-02-09', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11262, 0, 1, '2013-02-08', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11261, 0, 1, '2013-02-07', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11260, 0, 1, '2013-02-06', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11259, 0, 1, '2013-02-05', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11258, 0, 1, '2013-02-04', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11257, 0, 1, '2013-02-03', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11256, 0, 1, '2013-02-02', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11255, 0, 1, '2013-02-01', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11254, 0, 1, '2013-01-31', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11253, 0, 1, '2013-01-30', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11252, 0, 1, '2013-01-29', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11251, 0, 1, '2013-01-28', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11250, 0, 1, '2013-01-27', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11249, 0, 1, '2013-01-26', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11248, 0, 1, '2013-01-25', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11247, 0, 1, '2013-01-24', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11246, 0, 1, '2013-01-23', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11245, 0, 1, '2013-01-22', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11244, 0, 1, '2013-01-21', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11243, 0, 1, '2013-01-20', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11242, 0, 1, '2013-01-19', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11241, 0, 1, '2013-01-18', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11240, 0, 1, '2013-01-17', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11239, 0, 1, '2013-01-16', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11238, 0, 1, '2013-01-15', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11237, 0, 1, '2013-01-14', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11236, 0, 1, '2013-01-13', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11235, 0, 1, '2013-01-12', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11234, 0, 1, '2013-01-11', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11233, 0, 1, '2013-01-10', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11232, 0, 1, '2013-01-09', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11231, 0, 1, '2013-01-08', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11230, 0, 1, '2013-01-07', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11229, 0, 1, '2013-01-06', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11228, 0, 1, '2013-01-05', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11226, 0, 1, '2013-01-03', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11227, 0, 1, '2013-01-04', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(11225, 0, 1, '2013-01-02', 'fdfs', 'sfs', '22:00:00', '00:00:00', 1, 0, 0, 'sfsf', 'sfdf'),
(5297, 0, 3, '2013-03-04', 'Liebe liegt in der Luft', 'Liebe liegt in der Luft', '09:00:00', '12:00:00', 1, 100, 0, 'love is in the air', 'love is in the air today'),
(5296, 0, 3, '2013-02-04', 'Liebe liegt in der Luft', 'Liebe liegt in der Luft', '09:00:00', '12:00:00', 1, 100, 0, 'love is in the air', 'love is in the air today'),
(5295, 0, 3, '2013-01-04', 'Liebe liegt in der Luft', 'Liebe liegt in der Luft', '09:00:00', '12:00:00', 1, 100, 0, 'love is in the air', 'love is in the air today'),
(5294, 0, 3, '2012-12-04', 'Liebe liegt in der Luft', 'Liebe liegt in der Luft', '09:00:00', '12:00:00', 1, 100, 0, 'love is in the air', 'love is in the air today'),
(5293, 0, 3, '2012-12-04', 'Liebe liegt in der Luft', 'Liebe liegt in der Luft', '09:00:00', '12:00:00', 1, 100, 3, 'love is in the air', 'love is in the air today');

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
(1, '2012-12-02');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Daten für Tabelle `event_user`
--

INSERT INTO `event_user` (`id`, `username`, `pwd`, `mail`, `sid`, `autologin`) VALUES
(1, 'phpadmin', 'adminpw', 'admin@admin.de', '8q9g5lqd94ur7drqo1ib70ggd5', NULL),
(22, 'Bla1', 'pw', 'bl@bla.com', '', NULL),
(23, 'Test', 'tut', 'te@ju.de', '', NULL),
(26, 'user', 'huhu', 'hu@hi.de', '', NULL),
(24, 'newdb', 'pw', 'new@db.de', '', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Daten für Tabelle `event_user_rights`
--

INSERT INTO `event_user_rights` (`id`, `userid`, `user_right`) VALUES
(1, 1, 'admin'),
(4, 1, 'events'),
(11, 22, 'events'),
(12, 23, 'events'),
(13, 0, 'events');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
