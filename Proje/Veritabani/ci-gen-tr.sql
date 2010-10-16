-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Anamakine: localhost
-- Üretim Zamanı: 16 Ekim 2010 saat 16:20:44
-- Sunucu sürümü: 5.1.41
-- PHP Sürümü: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Veritabanı: `ci-gen-tr`
--

-- --------------------------------------------------------

--
-- Tablo yapısı: `adminler`
--

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

-- --------------------------------------------------------

--
-- Tablo yapısı: `editorler`
--

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

-- --------------------------------------------------------

--
-- Tablo yapısı: `etiketler`
--

CREATE TABLE IF NOT EXISTS `etiketler` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adi` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `adi` (`adi`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Tablo yapısı: `iletisim_konulari`
--

CREATE TABLE IF NOT EXISTS `iletisim_konulari` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adi` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `adi` (`adi`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Tablo yapısı: `iletisim_mesajlari`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Tablo yapısı: `kategoriler`
--

CREATE TABLE IF NOT EXISTS `kategoriler` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adi` varchar(50) NOT NULL,
  `meta_aciklama` text,
  `meta_arama` text,
  PRIMARY KEY (`id`),
  KEY `adi` (`adi`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Tablo yapısı: `kullanicilar`
--

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
-- Tablo yapısı: `yazarlar`
--

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

-- --------------------------------------------------------

--
-- Tablo yapısı: `yazilar`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Tablo yapısı: `yazi_etiketleri`
--

CREATE TABLE IF NOT EXISTS `yazi_etiketleri` (
  `yazi_id` int(10) unsigned NOT NULL,
  `etiket_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`yazi_id`,`etiket_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
