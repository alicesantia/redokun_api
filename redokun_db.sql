-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versione server:              10.4.22-MariaDB - mariadb.org binary distribution
-- S.O. server:                  Win64
-- HeidiSQL Versione:            11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dump della struttura del database redokun_db
CREATE DATABASE IF NOT EXISTS `redokun_db` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `redokun_db`;

-- Dump della struttura di tabella redokun_db.call_attempts
CREATE TABLE IF NOT EXISTS `call_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(100) NOT NULL,
  `call_method` enum('GET','POST') NOT NULL,
  `date_insert` datetime NOT NULL,
  `call_number` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Dump dei dati della tabella redokun_db.call_attempts: ~0 rows (circa)
/*!40000 ALTER TABLE `call_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `call_attempts` ENABLE KEYS */;

-- Dump della struttura di tabella redokun_db.services
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `value` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dump dei dati della tabella redokun_db.services: ~3 rows (circa)
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` (`id`, `code`, `value`) VALUES
	(1, 'GET', 5),
	(2, 'POST', 3);
/*!40000 ALTER TABLE `services` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
