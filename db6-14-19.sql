-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.3.15-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for puffio
CREATE DATABASE IF NOT EXISTS `puffio` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `puffio`;

-- Dumping structure for table puffio.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table puffio.admin: ~3 rows (approximately)
DELETE FROM `admin`;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `created_at`, `updated_at`, `username`, `password`) VALUES
	(7, '2019-06-13 13:33:01', '2019-06-13 13:33:01', 'budopod', '$2y$10$ekXdMeMzOQzMMZ2/j3diEOQUJ1XiT0VXtqXJfPsD4Q6aay6X6R0wi'),
	(8, '2019-06-14 11:14:12', '2019-06-14 11:14:12', 'admin2', '$2y$10$dH2..g6cYibF6McXB9OMb.e8f2.xmec4PyB.5VyZXMbqela0W0UmC'),
	(9, '2019-06-14 11:21:22', '2019-06-14 11:21:22', 'admin3', '$2y$10$dm0dJLGiXKYUUnUVLIynJum7zTgby.ab043v1ut8kM0GQVNmggxpi');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table puffio.bugs
CREATE TABLE IF NOT EXISTS `bugs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Untitled',
  `content` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No content',
  `resolved` tinyint(3) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table puffio.bugs: ~2 rows (approximately)
DELETE FROM `bugs`;
/*!40000 ALTER TABLE `bugs` DISABLE KEYS */;
INSERT INTO `bugs` (`id`, `created_at`, `updated_at`, `title`, `content`, `resolved`) VALUES
	(9, '2019-06-13 13:54:06', '2019-06-14 11:03:51', 'PF 1: TEST', 'This is test #1. EDIT: This is a test edit #1 EDIT: This is a test edit #2 EDIT: This is a test edit #3 EDIT: dfghdsfghdsfg EDIT: ffdg\'gg', 1),
	(10, '2019-06-14 10:11:07', '2019-06-14 11:04:17', 'PF 2: TEST', 'This is test bug 2', 1);
/*!40000 ALTER TABLE `bugs` ENABLE KEYS */;

-- Dumping structure for table puffio.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `comment` longtext COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Whoops, no comment submited',
  `userid` int(11) unsigned NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `userid on comments` (`userid`),
  CONSTRAINT `userid on comments` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='This will hold the comments';

-- Dumping data for table puffio.comments: ~0 rows (approximately)
DELETE FROM `comments`;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Dumping structure for table puffio.img
CREATE TABLE IF NOT EXISTS `img` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `img_url` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table puffio.img: ~4 rows (approximately)
DELETE FROM `img`;
/*!40000 ALTER TABLE `img` DISABLE KEYS */;
INSERT INTO `img` (`id`, `created_at`, `updated_at`, `img_url`, `title`) VALUES
	(1, '2019-06-12 14:41:15', '2019-06-12 14:41:15', './img/1560375675_.png', ''),
	(2, '2019-06-12 14:45:59', '2019-06-12 14:45:59', '', 'HI'),
	(3, '2019-06-12 14:47:19', '2019-06-12 14:47:19', '', 'HI'),
	(4, '2019-06-12 14:47:53', '2019-06-12 14:47:53', './img/1560376073_.png', 'HI');
/*!40000 ALTER TABLE `img` ENABLE KEYS */;

-- Dumping structure for table puffio.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `password` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='This table will store the user data';

-- Dumping data for table puffio.users: ~9 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `created_at`, `updated_at`, `password`, `email`, `notes`) VALUES
	(1, '2019-06-12 14:24:43', '2019-06-13 09:52:32', '', '', NULL),
	(2, '2019-06-12 14:24:47', '2019-06-13 09:52:36', '', '', NULL),
	(3, '2019-06-13 09:51:03', '2019-06-13 09:52:37', '', '', NULL),
	(4, '2019-06-13 09:51:04', '2019-06-13 09:52:40', '', '', NULL),
	(5, '2019-06-13 09:51:05', '2019-06-13 09:52:42', '', '', NULL),
	(6, '2019-06-13 09:51:07', '2019-06-13 09:52:44', '', '', NULL),
	(7, '2019-06-13 09:51:07', '2019-06-13 09:52:46', '', '', NULL),
	(8, '2019-06-13 09:51:07', '2019-06-13 09:52:49', '', '', NULL),
	(9, '2019-06-13 09:51:13', '2019-06-13 09:52:51', 'g', 'hi@hi', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
