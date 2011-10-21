-- phpMyAdmin SQL Dump
-- version 3.4.3.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 21, 2011 at 10:24 AM
-- Server version: 5.1.57
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cigentr_www`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminler`
--

DROP TABLE IF EXISTS `adminler`;
CREATE TABLE IF NOT EXISTS `adminler` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adi` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `sifre` char(32) NOT NULL,
  `temp` char(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mail` (`mail`,`sifre`),
  KEY `temp` (`temp`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `adminler`
--

-- --------------------------------------------------------

--
-- Table structure for table `editorler`
--

DROP TABLE IF EXISTS `editorler`;
CREATE TABLE IF NOT EXISTS `editorler` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adi` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `sifre` char(32) NOT NULL,
  `referanslari` text,
  `temp` char(32) NOT NULL,
  `is_onayli` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `kayit_zamani` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mail` (`mail`,`sifre`,`is_onayli`),
  KEY `temp` (`temp`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `editorler`
--

-- --------------------------------------------------------

--
-- Table structure for table `etiketler`
--

DROP TABLE IF EXISTS `etiketler`;
CREATE TABLE IF NOT EXISTS `etiketler` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adi` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `adi` (`adi`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `etiketler`
--

-- --------------------------------------------------------

--
-- Table structure for table `iletisim_konulari`
--

DROP TABLE IF EXISTS `iletisim_konulari`;
CREATE TABLE IF NOT EXISTS `iletisim_konulari` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adi` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `adi` (`adi`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `iletisim_konulari`
--

INSERT INTO `iletisim_konulari` (`id`, `adi`) VALUES
(1, 'Diğer');

-- --------------------------------------------------------

--
-- Table structure for table `iletisim_mesajlari`
--

DROP TABLE IF EXISTS `iletisim_mesajlari`;
CREATE TABLE IF NOT EXISTS `iletisim_mesajlari` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adi` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `mesaj` text NOT NULL,
  `zaman` int(10) unsigned NOT NULL,
  `ip` varchar(15) NOT NULL,
  `is_okundu` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `konu_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `is_okundu` (`is_okundu`,`konu_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `iletisim_mesajlari`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategoriler`
--

DROP TABLE IF EXISTS `kategoriler`;
CREATE TABLE IF NOT EXISTS `kategoriler` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adi` varchar(50) NOT NULL,
  `meta_aciklama` text,
  `meta_arama` text,
  PRIMARY KEY (`id`),
  KEY `adi` (`adi`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `kategoriler`
--

-- --------------------------------------------------------

--
-- Table structure for table `kullanicilar`
--

DROP TABLE IF EXISTS `kullanicilar`;
CREATE TABLE IF NOT EXISTS `kullanicilar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adi` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `sifre` char(32) NOT NULL,
  `temp` char(32) NOT NULL,
  `is_onayli` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `uye_olma_zamani` int(10) unsigned NOT NULL,
  `turu` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0: misafir, 1: editör, 10: yazar, 100: admin',
  PRIMARY KEY (`id`),
  KEY `mail` (`mail`,`sifre`,`is_onayli`,`turu`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `yazarlar`
--

DROP TABLE IF EXISTS `yazarlar`;
CREATE TABLE IF NOT EXISTS `yazarlar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adi` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `sifre` char(32) NOT NULL,
  `favori_konulari` text,
  `referanslari` text,
  `temp` char(32) NOT NULL,
  `is_onayli` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `kayit_zamani` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mail` (`mail`,`sifre`,`is_onayli`),
  KEY `temp` (`temp`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `yazarlar`
--

-- --------------------------------------------------------

--
-- Table structure for table `yazilar`
--

DROP TABLE IF EXISTS `yazilar`;
CREATE TABLE IF NOT EXISTS `yazilar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `baslik` varchar(255) NOT NULL,
  `ozet` text NOT NULL,
  `icerik` text NOT NULL,
  `eklenme_zamani` int(10) unsigned NOT NULL,
  `guncellenme_zamani` int(10) unsigned NOT NULL,
  `hit` int(10) unsigned NOT NULL DEFAULT '0',
  `durum` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `yazar_id` int(10) unsigned NOT NULL,
  `kategori_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `eklenme_zamani` (`eklenme_zamani`,`guncellenme_zamani`,`hit`,`durum`,`yazar_id`,`kategori_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `yazilar`
--

-- --------------------------------------------------------

--
-- Table structure for table `yazi_etiketleri`
--

DROP TABLE IF EXISTS `yazi_etiketleri`;
CREATE TABLE IF NOT EXISTS `yazi_etiketleri` (
  `yazi_id` int(10) unsigned NOT NULL,
  `etiket_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`yazi_id`,`etiket_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `yazi_etiketleri`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
