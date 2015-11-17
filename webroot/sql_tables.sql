-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 17 nov 2015 kl 11:09
-- Serverversion: 5.6.21
-- PHP-version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `project`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `project_answers`
--

CREATE TABLE IF NOT EXISTS `project_answers` (
`id` int(11) NOT NULL,
  `content` text,
  `author` varchar(80) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `questionId` int(11) DEFAULT NULL,
  `accepted` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT '0',
  `timestamp` datetime DEFAULT NULL,
  `gravatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `project_comments`
--

CREATE TABLE IF NOT EXISTS `project_comments` (
`id` int(11) NOT NULL,
  `content` text,
  `author` varchar(80) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  `questionId` int(11) DEFAULT NULL,
  `answerId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `project_question`
--

CREATE TABLE IF NOT EXISTS `project_question` (
`id` int(11) NOT NULL,
  `title` varchar(80) DEFAULT NULL,
  `content` text,
  `author` varchar(80) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `project_question2tags`
--

CREATE TABLE IF NOT EXISTS `project_question2tags` (
  `idQuestion` int(11) NOT NULL,
  `idTag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONER FÖR TABELL `project_question2tags`:
--   `idQuestion`
--       `project_question` -> `id`
--   `idTag`
--       `project_tags` -> `id`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `project_tags`
--

CREATE TABLE IF NOT EXISTS `project_tags` (
`id` int(11) NOT NULL,
  `tag` varchar(80) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `project_tags`
--

INSERT INTO `project_tags` (`id`, `tag`, `description`) VALUES
(1, 'Skötsel', 'Skötsel av hängbukssvin kan vara både givande och komplicerad. Det är inte alltid det lättaste att veta hur man ska gå tillväga. '),
(2, 'Husdjur', 'Att ha hängbukssvin som husdjur är kanske inte det vanligaste, men det existerar. Frågor kan vara t.ex. hur man hanterar ett inneboende hängbukssvin, både små och stora frågor är tillåtna.'),
(3, 'Vård', 'Har ditt hängbukssvin börjat visa konstiga symptom? Eller vill du bara ha tips om hur du kan förebygga vissa sjukdomar eller andra åkommor som hängbukssvin kan drabbas av.'),
(4, 'Säljes', 'Det blir inte alltid som man tänkt sig. I säljes hör frågor kring säljandet av hängbukssvin, det kan vara såväl önskemål om att sälja som generella tips och råd att tänka på.'),
(5, 'Köpes', 'Vill du skaffa ett hängbukssvin? Grattis, då är det här platsen för dig. Här samlas frågor kring vad du bör tänka på inför köpet, du kan även fråga om priser, utbud och så vidare.'),
(6, 'Bytes', 'Kanske vill du hellre ha ett annat hängbukssvin än det du har? Finns det någon annan som vill byta? Kanske det, här samlar vi frågor kring byten.'),
(7, 'Föda', 'Vad äter egentligen ett hängbukssvin? Är det potatisskal som gäller eller finns det andra födor som är nödvändiga? Är det något som är giftigt? Här samlas frågor kring föda.'),
(8, 'Uppfödning', 'Här finns frågor för dig som håller på med uppfödning eller är intresserad av att starta. Alla frågor som rör uppfödning är tillåtna, försäljning undanbedes dock.'),
(9, 'Utrustning', 'Vad behöver du egentligen för utrustning? Här samlas frågor om olika tillbehör och utrustning som du kan behöva antingen till vardags eller speciella tillfällen.'),
(10, 'Övrigt', 'I övrigt samlas alla frågor som inte tillhör någon av de andra kategorierna.'),
(11, 'Event', 'Har du varit på, planerar att gå till eller vill veta mer om olika event som rör hängbukssvin? Här samlas frågor kring event.'),
(12, 'Aktiviteter', 'Det finns flera olika aktiviteter du kan göra med ditt hängbukssvin, det behöver inte bara vara ett husdjur, utan kanske även en reskamrat t.ex? Här samlas frågor som rör aktiviteter av olika slag, dock ej event.');

-- --------------------------------------------------------

--
-- Tabellstruktur `project_user`
--

CREATE TABLE IF NOT EXISTS `project_user` (
`id` int(11) NOT NULL,
  `acronym` varchar(20) NOT NULL,
  `email` varchar(80) DEFAULT NULL,
  `name` varchar(80) DEFAULT NULL,
  `gravatar` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `profile` text,
  `activityScore` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `project_uservoting`
--

CREATE TABLE IF NOT EXISTS `project_uservoting` (
  `idUser` int(11) NOT NULL,
  `idQuestion` int(11) NOT NULL DEFAULT '0',
  `idAnswer` int(11) NOT NULL DEFAULT '0',
  `idComment` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONER FÖR TABELL `project_uservoting`:
--   `idUser`
--       `project_user` -> `id`
--

-- --------------------------------------------------------

--
-- Ersättningsstruktur för vy `project_vactivity`
--
CREATE TABLE IF NOT EXISTS `project_vactivity` (
`id` int(11)
,`acronym` varchar(20)
,`activityScore` int(11)
,`votes` bigint(21)
,`questions` bigint(21)
,`answers` bigint(21)
,`comments` bigint(21)
,`questionScore` decimal(32,0)
,`answerScore` decimal(32,0)
,`commentScore` decimal(32,0)
);
-- --------------------------------------------------------

--
-- Ersättningsstruktur för vy `project_vquestions`
--
CREATE TABLE IF NOT EXISTS `project_vquestions` (
`id` int(11)
,`title` varchar(80)
,`content` text
,`author` varchar(80)
,`timestamp` datetime
,`tag` text
,`tagId` text
,`gravatar` varchar(255)
,`userId` int(11)
,`qScore` int(11)
);
-- --------------------------------------------------------

--
-- Ersättningsstruktur för vy `project_vtags`
--
CREATE TABLE IF NOT EXISTS `project_vtags` (
`id` int(11)
,`tag` varchar(80)
,`description` text
,`nrQuestions` bigint(21)
);
-- --------------------------------------------------------

--
-- Struktur för vy `project_vactivity`
--
DROP TABLE IF EXISTS `project_vactivity`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `project_vactivity` AS select `u`.`id` AS `id`,`u`.`acronym` AS `acronym`,`u`.`activityScore` AS `activityScore`,(select count(0) from `project_uservoting` where (`project_uservoting`.`idUser` = `u`.`id`)) AS `votes`,(select count(0) from `project_question` where (`project_question`.`userId` = `u`.`id`)) AS `questions`,(select count(0) from `project_answers` where (`project_answers`.`userId` = `u`.`id`)) AS `answers`,(select count(0) from `project_comments` where (`project_comments`.`userId` = `u`.`id`)) AS `comments`,(select sum(`project_question`.`score`) from `project_question` where (`project_question`.`userId` = `u`.`id`)) AS `questionScore`,(select sum(`project_answers`.`score`) from `project_answers` where (`project_answers`.`userId` = `u`.`id`)) AS `answerScore`,(select sum(`project_comments`.`score`) from `project_comments` where (`project_comments`.`userId` = `u`.`id`)) AS `commentScore` from `project_user` `u` group by `u`.`id`;

-- --------------------------------------------------------

--
-- Struktur för vy `project_vquestions`
--
DROP TABLE IF EXISTS `project_vquestions`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `project_vquestions` AS select `q`.`id` AS `id`,`q`.`title` AS `title`,`q`.`content` AS `content`,`q`.`author` AS `author`,`q`.`timestamp` AS `timestamp`,group_concat(`t`.`tag` separator ',') AS `tag`,group_concat(`t`.`id` separator ',') AS `tagId`,`u`.`gravatar` AS `gravatar`,`u`.`id` AS `userId`,`q`.`score` AS `qScore` from (((`project_question` `q` left join `project_question2tags` `q2t` on((`q`.`id` = `q2t`.`idQuestion`))) left join `project_tags` `t` on((`q2t`.`idTag` = `t`.`id`))) left join `project_user` `u` on((`u`.`acronym` = `q`.`author`))) group by `q`.`id`;

-- --------------------------------------------------------

--
-- Struktur för vy `project_vtags`
--
DROP TABLE IF EXISTS `project_vtags`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `project_vtags` AS select `t`.`id` AS `id`,`t`.`tag` AS `tag`,`t`.`description` AS `description`,(select count(0) from `project_question2tags` where (`project_question2tags`.`idTag` = `t`.`id`)) AS `nrQuestions` from `project_tags` `t` group by `t`.`id`;

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `project_answers`
--
ALTER TABLE `project_answers`
 ADD PRIMARY KEY (`id`);

--
-- Index för tabell `project_comments`
--
ALTER TABLE `project_comments`
 ADD PRIMARY KEY (`id`);

--
-- Index för tabell `project_question`
--
ALTER TABLE `project_question`
 ADD PRIMARY KEY (`id`);

--
-- Index för tabell `project_question2tags`
--
ALTER TABLE `project_question2tags`
 ADD PRIMARY KEY (`idQuestion`,`idTag`), ADD KEY `idTag` (`idTag`);

--
-- Index för tabell `project_tags`
--
ALTER TABLE `project_tags`
 ADD PRIMARY KEY (`id`);

--
-- Index för tabell `project_user`
--
ALTER TABLE `project_user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `acronym` (`acronym`);

--
-- Index för tabell `project_uservoting`
--
ALTER TABLE `project_uservoting`
 ADD PRIMARY KEY (`idUser`,`idQuestion`,`idAnswer`,`idComment`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `project_answers`
--
ALTER TABLE `project_answers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `project_comments`
--
ALTER TABLE `project_comments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `project_question`
--
ALTER TABLE `project_question`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `project_tags`
--
ALTER TABLE `project_tags`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT för tabell `project_user`
--
ALTER TABLE `project_user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `project_question2tags`
--
ALTER TABLE `project_question2tags`
ADD CONSTRAINT `project_question2tags_ibfk_1` FOREIGN KEY (`idQuestion`) REFERENCES `project_question` (`id`),
ADD CONSTRAINT `project_question2tags_ibfk_2` FOREIGN KEY (`idTag`) REFERENCES `project_tags` (`id`);

--
-- Restriktioner för tabell `project_uservoting`
--
ALTER TABLE `project_uservoting`
ADD CONSTRAINT `project_uservoting_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `project_user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
