-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 14 Janvier 2013 à 10:56
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `bsmarty`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `type`) VALUES
(1, 'catégorie 1', 'categorie-1', 'post'),
(2, 'Seconde catégorie', 'seconde-categorie', 'page'),
(3, 'La nouvelle catégorie', 'la-nouvelle-categorie', 'post'),
(5, '', '', 'unknown');

-- --------------------------------------------------------

--
-- Structure de la table `configs`
--

CREATE TABLE IF NOT EXISTS `configs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `category` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_UNIQUE` (`slug`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `configs`
--

INSERT INTO `configs` (`id`, `name`, `slug`, `value`, `category`) VALUES
(1, 'Title', 'site_title', 'BSmarty', 'admin_general'),
(2, 'Slogan', 'site_slogan', 'Le slogan de mon site', 'admin_general'),
(3, 'Keywords', 'site_keywords', 'mot 1, mot 2, mot 3', 'admin_general'),
(4, 'Description', 'site_description', 'Une seule phrase de description succinte du site, pour le référencement.', 'admin_general'),
(5, 'emailTo', 'emailto', 'contact.bcabanes@gmail.com', 'admin_general'),
(6, 'emailFrom', 'emailfrom', 'bcabanes@groupeforum.net', 'admin_general'),
(7, 'Site URL', 'site_url', 'http://localhost/bsmarty', 'admin_general'),
(8, 'Number of posts per page', 'posts_per_page', '10', 'admin_general');

-- --------------------------------------------------------

--
-- Structure de la table `download_files`
--

CREATE TABLE IF NOT EXISTS `download_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `file` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `download_files`
--

INSERT INTO `download_files` (`id`, `name`, `description`, `file`, `type`, `status`, `created`) VALUES
(8, 'test', '<p>test</p>', '2012-11/LA DEMARCHE QUALITE Atalante.docx', 'word', 'activated', '2012-11-23 10:06:49');

-- --------------------------------------------------------

--
-- Structure de la table `download_logs`
--

CREATE TABLE IF NOT EXISTS `download_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=57 ;

--
-- Contenu de la table `download_logs`
--

INSERT INTO `download_logs` (`id`, `user_id`, `file_id`, `ip`, `date`) VALUES
(29, 1, 8, '::1', '2012-11-23 10:09:40'),
(30, 1, 8, '::1', '2012-11-23 10:09:54'),
(31, 1, 8, '::1', '2012-11-23 10:09:56'),
(32, 1, 8, '::1', '2012-11-23 10:09:58'),
(33, 1, 8, '::1', '2012-11-23 10:10:00'),
(34, 1, 8, '::1', '2012-11-23 10:10:02'),
(35, 1, 8, '::1', '2012-11-23 10:10:04'),
(36, 1, 8, '::1', '2012-11-23 10:10:06'),
(37, 1, 8, '::1', '2012-11-23 10:10:08'),
(38, 1, 8, '::1', '2012-11-23 10:10:10'),
(39, 1, 8, '::1', '2012-11-23 10:10:27'),
(40, 1, 8, '::1', '2012-11-23 10:10:29'),
(41, 1, 8, '::1', '2012-11-23 10:10:31'),
(42, 1, 8, '::1', '2012-11-23 10:10:33'),
(43, 1, 8, '::1', '2012-11-23 10:10:35'),
(44, 1, 8, '::1', '2012-11-23 10:10:37'),
(45, 1, 8, '::1', '2012-11-23 10:10:39'),
(46, 1, 8, '::1', '2012-11-23 10:10:42'),
(47, 1, 8, '::1', '2012-11-23 10:10:44'),
(48, 1, 8, '::1', '2012-11-23 10:10:46'),
(49, 1, 8, '::1', '2012-11-23 10:10:48'),
(50, 1, 8, '::1', '2012-11-23 13:31:15'),
(51, 1, 8, '::1', '2012-11-23 13:31:20'),
(52, 1, 8, '::1', '2012-11-23 13:32:58'),
(53, 1, 8, '::1', '2012-11-23 13:37:31'),
(54, 1, 8, '::1', '2012-11-23 13:44:39'),
(55, 1, 8, '::1', '2012-11-23 15:37:53'),
(56, 1, 8, '::1', '2012-11-27 09:32:37');

-- --------------------------------------------------------

--
-- Structure de la table `drw`
--

CREATE TABLE IF NOT EXISTS `drw` (
  `id_drw` int(11) NOT NULL AUTO_INCREMENT,
  `id_drw_labo` int(11) NOT NULL,
  `clepatient` int(11) DEFAULT NULL,
  `nom` varchar(90) DEFAULT NULL,
  `prenom` varchar(90) DEFAULT NULL,
  `datnaissance` int(11) DEFAULT NULL,
  `patronyme` varchar(45) DEFAULT NULL,
  `adresse1` varchar(200) DEFAULT NULL,
  `adresse2` varchar(200) DEFAULT NULL,
  `adresse3` varchar(200) DEFAULT NULL,
  `codpostal` varchar(10) DEFAULT NULL,
  `ville` varchar(90) DEFAULT NULL,
  `nusecu` varchar(45) DEFAULT NULL,
  `clenusecu` varchar(45) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `telportable` varchar(20) DEFAULT NULL,
  `email` varchar(90) DEFAULT NULL,
  `typidtfacture` varchar(5) DEFAULT NULL,
  `identfacture` varchar(15) DEFAULT NULL,
  `datfacture` varchar(45) DEFAULT NULL,
  `mtfacture` varchar(45) DEFAULT NULL,
  `mttransaction` varchar(20) NOT NULL,
  `dattransaction` varchar(8) NOT NULL,
  `heuretransaction` varchar(8) NOT NULL,
  `reftransaction` varchar(40) NOT NULL,
  `certiftransaction` varchar(100) NOT NULL,
  `CodeCaisse` varchar(45) NOT NULL,
  `FinValiditeDroit` varchar(40) NOT NULL,
  `RangGemelaire` varchar(10) NOT NULL,
  PRIMARY KEY (`id_drw`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `drw`
--

INSERT INTO `drw` (`id_drw`, `id_drw_labo`, `clepatient`, `nom`, `prenom`, `datnaissance`, `patronyme`, `adresse1`, `adresse2`, `adresse3`, `codpostal`, `ville`, `nusecu`, `clenusecu`, `telephone`, `telportable`, `email`, `typidtfacture`, `identfacture`, `datfacture`, `mtfacture`, `mttransaction`, `dattransaction`, `heuretransaction`, `reftransaction`, `certiftransaction`, `CodeCaisse`, `FinValiditeDroit`, `RangGemelaire`) VALUES
(10, 1, 1916256, 'LAUSSINOT', 'Frédéric', 19720623, 'M.', '61 rue Isaac Newton', 'Technoparc Epsilon', '', '83700', 'SAINT RAPHAEL', '', '', '', '0498113333', '', 'D', '10C28546', '20120413', '18', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `drw_bak`
--

CREATE TABLE IF NOT EXISTS `drw_bak` (
  `id_drw` int(11) NOT NULL AUTO_INCREMENT,
  `id_drw_labo` int(11) NOT NULL,
  `clepatient` int(11) DEFAULT NULL,
  `nom` varchar(90) DEFAULT NULL,
  `prenom` varchar(90) DEFAULT NULL,
  `datnaissance` int(11) DEFAULT NULL,
  `patronyme` varchar(45) DEFAULT NULL,
  `adresse1` varchar(200) DEFAULT NULL,
  `adresse2` varchar(200) DEFAULT NULL,
  `adresse3` varchar(200) DEFAULT NULL,
  `codpostal` varchar(10) DEFAULT NULL,
  `ville` varchar(90) DEFAULT NULL,
  `nusecu` varchar(45) DEFAULT NULL,
  `clenusecu` varchar(45) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `telportable` varchar(20) DEFAULT NULL,
  `email` varchar(90) DEFAULT NULL,
  `typidtfacture` varchar(5) DEFAULT NULL,
  `identfacture` varchar(15) DEFAULT NULL,
  `datfacture` varchar(45) DEFAULT NULL,
  `mtfacture` varchar(45) DEFAULT NULL,
  `mttransaction` varchar(20) NOT NULL,
  `dattransaction` varchar(8) NOT NULL,
  `heuretransaction` varchar(8) NOT NULL,
  `reftransaction` varchar(40) NOT NULL,
  `certiftransaction` varchar(100) NOT NULL,
  `CodeCaisse` varchar(45) NOT NULL,
  `FinValiditeDroit` varchar(40) NOT NULL,
  `RangGemelaire` varchar(10) NOT NULL,
  PRIMARY KEY (`id_drw`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `drw_caisse`
--

CREATE TABLE IF NOT EXISTS `drw_caisse` (
  `code` int(11) NOT NULL,
  `departement` varchar(80) NOT NULL,
  `libelle` varchar(80) NOT NULL,
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `drw_caisse`
--

INSERT INTO `drw_caisse` (`code`, `departement`, `libelle`) VALUES
(1, '83300', 'Caisse 1'),
(2, '83600', 'Caisse 2'),
(3, '83600', 'Caisse 3'),
(4, '83300', 'Caisse 4');

-- --------------------------------------------------------

--
-- Structure de la table `drw_labo`
--

CREATE TABLE IF NOT EXISTS `drw_labo` (
  `id_drw_labo` int(11) NOT NULL AUTO_INCREMENT,
  `numerolabo` int(11) DEFAULT NULL,
  `nomlabo` varchar(70) DEFAULT NULL,
  `numerofichier` int(11) DEFAULT NULL,
  `datefichier` int(11) DEFAULT NULL,
  `heurefichier` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_drw_labo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `drw_labo`
--

INSERT INTO `drw_labo` (`id_drw_labo`, `numerolabo`, `nomlabo`, `numerofichier`, `datefichier`, `heurefichier`) VALUES
(2, 11, 'Cabinet d''Atalante', 1, 20120413, '09:25:40');

-- --------------------------------------------------------

--
-- Structure de la table `medias`
--

CREATE TABLE IF NOT EXISTS `medias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Contenu de la table `medias`
--

INSERT INTO `medias` (`id`, `name`, `file`, `post_id`, `type`) VALUES
(1, 'Mon image', '2011-10/cadeaux.jpg', 16, 'image'),
(2, 'Casque', '2011-10/casque.jpg', 3, 'image'),
(5, 'Mon word pour le boulot', '2012-01/test.doc', 0, 'word'),
(6, 'suicide girl', '2012-11/200948_10151133121734823_529402944_o.jpg', 0, 'image'),
(8, 'test upload ajax', '2012-11/293784_10151159124054823_2081530235_n.jpg', 21, 'image'),
(9, 'ajax 2', '2012-11/149834_10151162876059823_941834541_n.jpg', 21, 'image'),
(10, 'ajax', '2012-11/175986_10151163957684823_673270124_o.jpg', 21, 'image'),
(11, 'ajax3', '2012-11/598952_10151159127194823_1325576985_n.jpg', 21, 'image'),
(12, 'ajax 4', '2012-11/413191_10151007428624823_1043143809_o.jpg', 21, 'image'),
(13, 'ajax 5', '2012-11/304486_10151159679404823_300572870_n.jpg', 21, 'image'),
(14, 'ajax 6', '2012-11/374847_10151157708834823_1087091566_n.jpg', 21, 'image'),
(15, 'ajax 7', '2012-11/66570_10151152340369823_801148153_n.jpg', 21, 'image'),
(16, '12', '2013-01/175740_10151139807304823_1139208999_o.jpg', 21, 'image'),
(17, 'Test2', '2013-01/176547_10151142861809823_640867683_o.jpg', 21, 'image'),
(18, 'test', '2013-01/175619_10151139793839823_2086790877_o.jpg', 21, 'image'),
(19, 'test', '2013-01/197383_10151158090324823_1547997706_n.jpg', 21, 'image'),
(20, 'lol', '2013-01/545785_10151127874659823_1561640084_n.jpg', 21, 'image'),
(21, 'test', '2013-01/554209_10151146704409823_951395627_n.jpg', 21, 'image'),
(22, 'test AJAX', '2013-01/736667_369228976505896_403023078_o.jpg', 17, 'image');

-- --------------------------------------------------------

--
-- Structure de la table `menu_groups`
--

CREATE TABLE IF NOT EXISTS `menu_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `menu_groups`
--

INSERT INTO `menu_groups` (`id`, `name`) VALUES
(1, 'Groupe 1'),
(2, 'Groupe 2'),
(3, 'test'),
(4, 'retest'),
(5, 'Dashboard');

-- --------------------------------------------------------

--
-- Structure de la table `menu_items`
--

CREATE TABLE IF NOT EXISTS `menu_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `target` tinyint(1) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `menu_items`
--

INSERT INTO `menu_items` (`id`, `parent_id`, `group_id`, `name`, `url`, `class`, `target`, `position`) VALUES
(1, 0, 2, 'Menu item 1', 'https://www.google.fr/', 'myclass', 0, 1),
(2, 1, 2, 'Menut item 2', 'https://www.google.fr/', 'myclass', 0, 2),
(3, 1, 2, 'Menu item 3', 'https://www.google.fr/', 'myclass', 0, 3),
(4, 0, 2, 'Menu item 4', 'https://www.google.fr/', 'myclass', 0, 5),
(5, 0, 2, 'Menu item 5', 'https://www.google.fr/', 'myclass', 0, 6),
(6, 0, 2, 'Menu item 6', 'https://www.google.fr/', 'myclass', 0, 4),
(7, 0, 2, 'Menu item 7', 'https://www.google.fr/', 'myclass', 0, 7),
(10, 0, 4, 'test', '', 'myclass', 1, 1),
(11, 10, 4, 'test', 'http://www.google.com', 'myclass', 1, 2),
(12, 0, 5, 'All articles', 'http://localhost/bsmarty/bs-admin/posts/index', '', 0, 1),
(13, 0, 5, 'All pages', 'http://localhost/bsmarty/bs-admin/pages/index', '', 0, 2),
(14, 0, 5, 'All menus', 'http://localhost/bsmarty/bs-admin/menu/index', '', 0, 3);

-- --------------------------------------------------------

--
-- Structure de la table `online_order_categories`
--

CREATE TABLE IF NOT EXISTS `online_order_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `online_order_categories`
--

INSERT INTO `online_order_categories` (`id`, `name`, `slug`, `description`) VALUES
(1, 'Test category 1', 'test-category-1', ''),
(2, 'Test category 2', 'test-category-2', ''),
(3, 'Test category 3', 'test-category-3', ''),
(4, 'Test category 4', 'test-category-4', '');

-- --------------------------------------------------------

--
-- Structure de la table `online_order_items`
--

CREATE TABLE IF NOT EXISTS `online_order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `factor` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `online_order_items`
--

INSERT INTO `online_order_items` (`id`, `category_id`, `name`, `slug`, `factor`, `image`) VALUES
(1, 1, 'item 1', 'item-1', 6, '/bsmarty/medias/image/2012-11/66570_10151152340369823_801148153_n.jpg'),
(2, 1, 'item 2', 'item-2', 2, '/bsmarty/medias/image/2012-11/374847_10151157708834823_1087091566_n.jpg'),
(3, 1, 'item 3', 'item-3', 1, '/bsmarty/medias/image/2012-11/413191_10151007428624823_1043143809_o.jpg'),
(5, 2, 'item 4', 'item-4', 7, '/bsmarty/medias/image/2012-11/175986_10151163957684823_673270124_o.jpg'),
(6, 2, 'item 5', 'item-5', 9, '/bsmarty/medias/image/2012-11/175986_10151163957684823_673270124_o.jpg'),
(7, 3, 'item 6', 'item-6', 4, '/bsmarty/medias/image/2012-11/293784_10151159124054823_2081530235_n.jpg'),
(8, 4, 'item 7', 'item-7', 21, '/bsmarty/medias/image/2012-11/200948_10151133121734823_529402944_o.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cat` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `content` text,
  `created` datetime DEFAULT NULL,
  `online` int(11) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Contenu de la table `posts`
--

INSERT INTO `posts` (`id`, `id_cat`, `name`, `content`, `created`, `online`, `type`, `slug`, `user_id`) VALUES
(1, 2, 'Ma première page', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sodales elit non erat sodales ultricies. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vulputate nunc id lorem semper sollicitudin. Aenean quis diam et dui facilisis tempus nec eu velit. Nulla iaculis lacus sit amet nibh mattis fringilla feugiat nunc commodo. Sed aliquet mi sed tortor mollis euismod. Mauris ligula felis, aliquet id porttitor non, semper nec elit. Morbi nisl nunc, ultrices vel accumsan sit amet, pretium nec elit.</p>\r\n<p>[accordion]<br />[pane title="Titre 1"] Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sodales elit non erat sodales ultricies. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vulputate nunc id lorem semper sollicitudin. Aenean quis diam et dui facilisis tempus nec eu velit. Nulla iaculis lacus sit amet nibh mattis fringilla feugiat nunc commodo. Sed aliquet mi sed tortor mollis euismod. Mauris ligula felis, aliquet id porttitor non, semper nec elit. Morbi nisl nunc, ultrices vel accumsan sit amet, pretium nec elit.[/pane] <br />[pane title="Titre 2"] Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sodales elit non erat sodales ultricies. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vulputate nunc id lorem semper sollicitudin. Aenean quis diam et dui facilisis tempus nec eu velit. Nulla iaculis lacus sit amet nibh mattis fringilla feugiat nunc commodo. Sed aliquet mi sed tortor mollis euismod. Mauris ligula felis, aliquet id porttitor non, semper nec elit. Morbi nisl nunc, ultrices vel accumsan sit amet, pretium nec elit.[/pane] <br />[pane title="Titre 3"] Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sodales elit non erat sodales ultricies. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vulputate nunc id lorem semper sollicitudin. Aenean quis diam et dui facilisis tempus nec eu velit. Nulla iaculis lacus sit amet nibh mattis fringilla feugiat nunc commodo. Sed aliquet mi sed tortor mollis euismod. Mauris ligula felis, aliquet id porttitor non, semper nec elit. Morbi nisl nunc, ultrices vel accumsan sit amet, pretium nec elit.[/pane] <br />[/accordion]</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>[table col1="Title 1" col2="Title 2" col3="Title 3"]<br />[line][col]Content line 1 col 1 [/col]<br />[col]Content line 1 col 2 [/col]<br />[col]Content line 1 col 3 [/col][/line]<br />[line][col]Content line 2 col 1 [/col]<br />[col]Content line 2 col 2 [/col]<br />[col]Content line 2 col 3 [/col][/line]<br />[line][col]Content line 3 col 1 [/col]<br />[col]Content line 3 col 2 [/col]<br />[col]Content line 3 col 3 [/col][/line][/table]</p>\r\n<p>&nbsp;</p>\r\n<p>[table col1="Title 1" col2="Title 2" col3="Title 3" col4="Title 4" col5="Title 5" col6="Title 6" col7="Title 7" col8="Title 8" col9="Title 9" col10="Title 10"]<br />[line][col]Content line 1 col 1 [/col]<br />[col]Content line 1 col 2 [/col]<br />[col]Content line 1 col 3 [/col][col]Content line 1 col 3 [/col][col]Content line 1 col 3 [/col][col]Content line 1 col 3 [/col][col]Content line 1 col 3 [/col][col]Content line 1 col 3 [/col][col]Content line 1 col 3 [/col][col]Content line 1 col 3 [/col][/line]<br />[line][col]Content line 2 col 1 [/col]<br />[col]Content line 2 col 2 [/col]<br />[col]Content line 2 col 3 [/col][col]Content line 1 col 3 [/col][col]Content line 1 col 3 [/col][col]Content line 1 col 3 [/col][col]Content line 1 col 3 [/col][col]Content line 1 col 3 [/col][col]Content line 1 col 3 [/col][col]Content line 1 col 3 [/col][/line]<br />[line][col]Content line 3 col 1 [/col]<br />[col]Content line 3 col 2 [/col]<br />[col]Content line 3 col 3 [/col][col]Content line 1 col 3 [/col][col]Content line 1 col 3 [/col][col]Content line 1 col 3 [/col][col]Content line 1 col 3 [/col][col]Content line 1 col 3 [/col][col]Content line 1 col 3 [/col][col]Content line 1 col 3 [/col][/line][/table]</p>', '2011-10-20 00:00:00', 1, 'page', 'ma-premiere-page', 0),
(2, 2, 'Ma seconde page', '<p>[slider]<br />[slide image_width="" image_height="" link="http://www.google.ca" alt_text="Utiliser Google ?" title="Premi&egrave;re slide" auto_resize="true"]<span class="url">http://lorempixel.com/940/246/sports</span>[/slide] <br />[slide image_width="" image_height="" link="http://www.slapandthink.com" alt_text="My personal Blog" title="Titre 2 : je sais pas quoi mettre ..." auto_resize="true"]<span class="url">http://lorempixel.com/940/246/fashion/8</span>[/slide]</p>\r\n<p>[slide image_width="" image_height="" link="#" alt_text="Encore un caption" title="Blop?" auto_resize="true"]<span class="url">http://lorempixel.com/940/246/fashion</span>/6[/slide]</p>\r\n<p>[slide image_width="" image_height="" link="#" alt_text="Et de 4 !" title="J''aime quand &ccedil;a pique !" auto_resize="true"]<span class="url">http://lorempixel.com/940/246/fashion</span>/7[/slide]<br />[/slider]</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sodales elit non erat sodales ultricies. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vulputate nunc id lorem semper sollicitudin. Aenean quis diam et dui facilisis tempus nec eu velit. Nulla iaculis lacus sit amet nibh mattis fringilla feugiat nunc commodo. Sed aliquet mi sed tortor mollis euismod. Mauris ligula felis, aliquet id porttitor non, semper nec elit. Morbi nisl nunc, ultrices vel accumsan sit amet, pretium nec elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sodales elit non erat sodales ultricies. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vulputate nunc id lorem semper sollicitudin. Aenean quis diam et dui facilisis tempus nec eu velit. Nulla iaculis lacus sit amet nibh mattis fringilla feugiat nunc commodo. Sed aliquet mi sed tortor mollis euismod. Mauris ligula felis, aliquet id porttitor non, semper nec elit. Morbi nisl nunc, ultrices vel accumsan sit amet, pretium nec elit.</p>', '2011-10-21 00:00:00', 1, 'page', 'ma-seconde-page', 0),
(3, 1, 'Mon premier post', '<p><a href="/dev/tuto/site/post/mon-premier-post-3"><img style="margin-left: 10px; margin-right: 10px; float: left;" title="Mon casque" src="/dev/tuto/ga/site-modif/medias/image/2011-10/casque.jpg" alt="" width="200" height="150" /></a>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sodales elit non erat sodales ultricies. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vulputate nunc id lorem semper sollicitudin. Aenean quis diam et dui facilisis tempus nec eu velit. Nulla iaculis lacus sit amet nibh mattis fringilla feugiat nunc commodo. Sed aliquet mi sed tortor mollis euismod. Mauris ligula felis, aliquet id porttitor non, semper nec elit. Morbi nisl nunc, ultrices vel accumsan sit amet, pretium nec elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sodales elit non erat sodales ultricies. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vulputate nunc id lorem semper sollicitudin. Aenean quis diam et dui facilisis tempus nec eu velit. Nulla iaculis lacus sit amet nibh mattis fringilla feugiat nunc commodo. Sed aliquet mi sed tortor mollis euismod. Mauris ligula felis, aliquet id porttitor non, semper nec elit. Morbi nisl nunc, ultrices vel accumsan sit amet, pretium nec elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sodales elit non erat sodales ultricies. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vulputate nunc id lorem semper sollicitudin. Aenean quis diam et dui facilisis tempus nec eu velit. Nulla iaculis lacus sit amet nibh mattis fringilla feugiat nunc commodo. Sed aliquet mi sed tortor mollis euismod. Mauris ligula felis, aliquet id porttitor non, semper nec elit. Morbi nisl nunc, ultrices vel accumsan sit amet, pretium nec elit.</p>', '2011-10-26 04:01:03', 1, 'post', 'mon-premier-post', 0),
(17, 1, 'datepicker', '<p>Quibus ita sceleste patratis Paulus cruore perfusus reversusque ad principis castra multos coopertos paene catenis adduxit in squalorem deiectos atque maestitiam, quorum adventu intendebantur eculei uncosque parabat carnifex et tormenta. et ex is proscripti sunt plures actique in exilium alii, non nullos gladii consumpsere poenales. nec enim quisquam facile meminit sub Constantio, ubi susurro tenus haec movebantur, quemquam absolutum.</p>\r\n<p>&nbsp;<!--more--></p>\r\n<p><img style="float: left;" title="Image title" src="/bsmarty/medias/image/2013-01/545785_10151127874659823_1561640084_n.jpg" alt="Image description" width="250" height="382" /></p>\r\n<p>Quibus ita sceleste patratis Paulus cruore perfusus reversusque ad principis castra multos coopertos paene catenis adduxit in squalorem deiectos atque maestitiam, quorum adventu intendebantur eculei uncosque parabat carnifex et tormenta. et ex is proscripti sunt plures actique in exilium alii, non nullos gladii consumpsere poenales. nec enim quisquam facile meminit sub Constantio, ubi susurro tenus haec movebantur, quemquam absolutum.</p>\r\n<p><img style="float: right;" src="/bsmarty/medias/image/2013-01/736667_369228976505896_403023078_o.jpg" alt="" width="250" height="167" /></p>', '2011-10-31 03:36:34', 1, 'post', 'datepicker', NULL),
(12, 3, 'Mon article d''édition UPDATE ''', '<p>Mon nouveau contenu</p>', '2011-10-26 12:52:49', 1, 'post', 'mon-article-edition', NULL),
(13, 1, 'Mon nouveau article', '<p>Mon nouveau contenu</p>', '2011-10-26 12:25:59', 1, 'post', 'mon-nouveau-article', NULL),
(14, 1, 'Mon premier post test', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sodales elit non erat sodales ultricies. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vulputate nunc id lorem semper sollicitudin. Aenean quis diam et dui facilisis tempus nec eu velit. Nulla iaculis lacus sit amet nibh mattis fringilla feugiat nunc commodo. Sed aliquet mi sed tortor mollis euismod. Mauris ligula felis, aliquet id porttitor non, semper nec elit. Morbi nisl nunc, ultrices vel accumsan sit amet, pretium nec elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sodales elit non erat sodales ultricies. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vulputate nunc id lorem semper sollicitudin. Aenean quis diam et dui facilisis tempus nec eu velit. Nulla iaculis lacus sit amet nibh mattis fringilla feugiat nunc commodo. Sed aliquet mi sed tortor mollis euismod. Mauris ligula felis, aliquet id porttitor non, semper nec elit. Morbi nisl nunc, ultrices vel accumsan sit amet, pretium nec elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sodales elit non erat sodales ultricies. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vulputate nunc id lorem semper sollicitudin. Aenean quis diam et dui facilisis tempus nec eu velit. Nulla iaculis lacus sit amet nibh mattis fringilla feugiat nunc commodo. Sed aliquet mi sed tortor mollis euismod. Mauris ligula felis, aliquet id porttitor non, semper nec elit. Morbi nisl nunc, ultrices vel accumsan sit amet, pretium nec elit.</p>', '2011-10-26 12:26:19', 1, 'post', 'mon-premier-post-test', NULL),
(15, 2, 'Encore un nouvel article', '<p>Encore du contenu, mais cette fois ci, il est en <strong>gras</strong>.</p>', '2011-10-26 12:48:34', 1, 'post', 'encore-un-nouvel-article', NULL),
(16, 2, 'Mon article INSERT', '<p>Je met du <strong>contenu</strong></p>\r\n<ul>\r\n<li>liste</li>\r\n<li>deux</li>\r\n</ul>\r\n<ol>\r\n<li>liste</li>\r\n<li>trois</li>\r\n</ol>\r\n<p>&nbsp;</p>', '2011-10-26 01:35:55', 1, 'post', 'mon-article-insert', NULL),
(21, 2, 'Mentions Légales', '<p>&nbsp;<img style="float: left;" title="test" src="/bsmarty/medias/image/2012-11/374847_10151157708834823_1087091566_n.jpg" alt="test" width="250" height="250" /></p>\r\n<p>Content here...</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>[accordion]<br />[pane title="Accordion Pane 1" active] content [/pane] <br />[pane title="Accordion Pane 2"] content [/pane] <br />[pane title="Accordion Pane 3"] content [/pane] <br />[/accordion]</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<div class="clearfix">&nbsp;\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="bscolumns">\r\n<div class="bscolumn bstwo bsfirst">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</div>\r\n<div class="bscolumn bstwo bslast">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</div>\r\n</div>\r\n<div class="clearfix">&nbsp;</div>\r\n</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="bscolumns">\r\n<div class="bscolumn bsthree bsfirst">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</div>\r\n<div class="bscolumn bsthree">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</div>\r\n<div class="bscolumn bsthree bslast">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</div>\r\n</div>\r\n<div class="clearfix">&nbsp;</div>\r\n</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="bscolumns">\r\n<div class="bscolumn bsfour bsfirst">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</div>\r\n<div class="bscolumn bsfour">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</div>\r\n<div class="bscolumn bsfour">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</div>\r\n<div class="bscolumn bsfour bslast">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</div>\r\n</div>\r\n<div class="clearfix">&nbsp;</div>\r\n</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="bscolumns">\r\n<div class="bscolumn bsfive bsfirst">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</div>\r\n<div class="bscolumn bsfive">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</div>\r\n<div class="bscolumn bsfive">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</div>\r\n<div class="bscolumn bsfive">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</div>\r\n<div class="bscolumn bsfive bslast">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</div>\r\n</div>\r\n<div class="clearfix">&nbsp;</div>\r\n</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="bscolumns">\r\n<div class="bscolumn bstwo-three bsfirst">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</div>\r\n<div class="bscolumn bsthree bslast">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</div>\r\n</div>\r\n<div class="clearfix">&nbsp;</div>\r\n</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="bscolumns">\r\n<div class="bscolumn bsthree-four bsfirst">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</div>\r\n<div class="bscolumn bsfour bslast">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</div>\r\n</div>\r\n<div class="clearfix">&nbsp;</div>\r\n</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="bscolumns">\r\n<div class="bscolumn bsfour-five bsfirst">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</div>\r\n<div class="bscolumn bsfive bslast">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</div>\r\n</div>\r\n<div class="clearfix">&nbsp;</div>\r\n</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">&nbsp;</div>\r\n<div class="clearfix">&nbsp;</div>', '2011-11-02 04:39:18', 1, 'page', 'mentions-legales', NULL),
(23, 0, NULL, NULL, NULL, -1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(45) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `password` varchar(45) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `status` varchar(11) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `login`, `name`, `firstname`, `password`, `email`, `role`, `status`, `created`) VALUES
(1, 'admin', 'Cabanes', 'Benjamin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'bcabanes@groupeforum.net', 'admin', 'activated', '2012-11-04 00:00:00'),
(5, 'ireckovich', 'Ilanov', 'Reckovich', 'ce4e0a6f8f8e2dd9012dae79216a9228cdb95f82', 'irechovich@myrussianhost.com', 'user', 'refused', '2012-11-13 00:00:00'),
(7, 'user', 'Dupond', 'Jean', 'f6d053374c2f3e37c686201a40365e1250f6da11', 'jdupond@host.com', 'user', 'activated', '2012-11-15 09:43:45');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
