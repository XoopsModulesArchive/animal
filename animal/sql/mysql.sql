-- phpMyAdmin SQL Dump
-- version 2.8.2.4
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generatie Tijd: 03 Feb 2008 om 10:42
-- Server versie: 5.0.24
-- PHP Versie: 5.1.6
-- 
-- Database: `pedigree_candb`
-- 

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `xovdk_eigenaar`
-- 

CREATE TABLE `eigenaar` (
  `ID` int(11) NOT NULL auto_increment,
  `firstname` varchar(30) NOT NULL default '',
  `lastname` varchar(30) NOT NULL default '',
  `postcode` varchar(7) NOT NULL default '',
  `woonplaats` varchar(50) NOT NULL default '',
  `streetname` varchar(40) NOT NULL default '',
  `housenumber` varchar(6) NOT NULL default '',
  `phonenumber` varchar(14) NOT NULL default '',
  `emailadres` varchar(40) NOT NULL default '',
  `website` varchar(60) NOT NULL default '',
  `user` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`ID`),
  KEY `lastname` (`lastname`(5))
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COMMENT='eigenaar gegevens voor stamboom' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `xovdk_stamboom`
-- 

CREATE TABLE `stamboom` (
  `ID` mediumint(7) unsigned NOT NULL auto_increment,
  `NAAM` text NOT NULL,
  `id_eigenaar` smallint(5) NOT NULL default '0',
  `id_fokker` smallint(5) NOT NULL default '0',
  `user` varchar(25) NOT NULL default '',
  `roft` enum('0','1') NOT NULL default '0',
  `moeder` int(5) NOT NULL default '0',
  `vader` int(5) NOT NULL default '0',
  `foto` varchar(255) NOT NULL default '',
  `coi` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`ID`),
  KEY `moeder` (`moeder`),
  KEY `vader` (`vader`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `xovdk_stamboom_config`
-- 

CREATE TABLE `stamboom_config` (
  `ID` tinyint(2) NOT NULL auto_increment,
  `isActive` tinyint(1) NOT NULL default '0',
  `FieldName` varchar(50) NOT NULL default '',
  `FieldType` enum('dateselect','textbox','selectbox','radiobutton','textarea','urlfield','Picture') NOT NULL default 'dateselect',
  `LookupTable` tinyint(1) NOT NULL default '0',
  `DefaultValue` varchar(50) NOT NULL default '',
  `FieldExplenation` tinytext NOT NULL,
  `HasSearch` tinyint(1) NOT NULL default '0',
  `Litter` tinyint(1) NOT NULL default '0',
  `Generallitter` tinyint(1) NOT NULL default '0',
  `SearchName` varchar(50) NOT NULL default '',
  `SearchExplenation` tinytext NOT NULL,
  `ViewInPedigree` tinyint(1) NOT NULL default '0',
  `ViewInAdvanced` tinyint(1) NOT NULL default '0',
  `ViewInPie` tinyint(1) NOT NULL default '0',
  `ViewInList` tinyint(1) NOT NULL default '0',
  `locked` tinyint(1) NOT NULL default '0',
  `order` tinyint(3) NOT NULL default '0',
  UNIQUE KEY `ID` (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `xovdk_stamboom_temp`
-- 

CREATE TABLE `stamboom_temp` (
  `ID` int(11) NOT NULL default '0',
  `NAAM` text NOT NULL,
  `id_eigenaar` int(11) NOT NULL default '0',
  `id_fokker` int(11) NOT NULL default '0',
  `user` varchar(25) NOT NULL default '',
  `roft` tinytext NOT NULL,
  `moeder` int(5) NOT NULL default '0',
  `vader` int(5) NOT NULL default '0',
  `foto` varchar(255) NOT NULL default '',
  `coi` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`ID`),
  KEY `moeder` (`moeder`),
  KEY `vader` (`vader`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='tijdelijke stamboom tabel voor het aanmaken van honden gegev';

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `xovdk_stamboom_trash`
-- 

CREATE TABLE `stamboom_trash` (
  `ID` int(11) NOT NULL auto_increment,
  `NAAM` text NOT NULL,
  `id_eigenaar` int(11) NOT NULL default '0',
  `id_fokker` int(11) NOT NULL default '0',
  `user` varchar(25) NOT NULL default '',
  `roft` char(1) NOT NULL default '',
  `moeder` int(5) NOT NULL default '0',
  `vader` int(5) NOT NULL default '0',
  `foto` varchar(255) NOT NULL default '',
  `coi` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COMMENT='stamboom tabel voor verwijderde honden' AUTO_INCREMENT=1 ;
