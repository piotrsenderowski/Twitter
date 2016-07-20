-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 20 Lip 2016, 22:46
-- Wersja serwera: 5.5.49-0ubuntu0.14.04.1
-- Wersja PHP: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `twitter`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Comment`
--

CREATE TABLE IF NOT EXISTS `Comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL,
  `postId` int(11) DEFAULT NULL,
  `creationDate` datetime NOT NULL,
  `commentText` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `postId` (`postId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Zrzut danych tabeli `Comment`
--

INSERT INTO `Comment` (`id`, `userId`, `postId`, `creationDate`, `commentText`) VALUES
(1, 1, 4, '2016-07-20 21:07:21', 'To jest drugi komentarz do Tweeta nr 4.'),
(2, 1, 4, '2016-07-20 21:07:28', 'To jest drugi komentarz do Tweeta nr 4.'),
(3, 1, 4, '2016-07-20 21:07:10', 'asdasdasd'),
(4, 1, 4, '2016-07-20 21:07:11', 'asdasdasd'),
(5, 1, 4, '2016-07-20 22:07:21', 'Dodam kolejny komentarz i zobaczę co się stanie.'),
(6, 1, 4, '2016-07-20 22:07:32', 'Jeszcze jeden dla przetestowania.'),
(7, 2, 5, '2016-07-20 22:07:19', 'To jest pierwszy komentarz do pierwszego tweeta Pawła'),
(8, 3, 6, '2016-07-20 22:07:56', 'To jest pierwszy comment pierwszego tweeta Jana.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Message`
--

CREATE TABLE IF NOT EXISTS `Message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `senderId` int(11) DEFAULT NULL,
  `receiverId` int(11) DEFAULT NULL,
  `messageText` text NOT NULL,
  `messageStatus` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `senderId` (`senderId`),
  KEY `receiverId` (`receiverId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Tweet`
--

CREATE TABLE IF NOT EXISTS `Tweet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL,
  `tweetText` varchar(140) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Zrzut danych tabeli `Tweet`
--

INSERT INTO `Tweet` (`id`, `userId`, `tweetText`) VALUES
(1, 1, 'To treść pierwszego Tweeta Piotra.'),
(2, 1, 'To treść drugiego Tweeta Piotra.'),
(3, 1, 'To treść trzeciego Tweeta Piotra.'),
(4, 1, 'To treść czwartego Tweeta Piotra.'),
(5, 2, 'To jest pierwszy Tweet Pawła.'),
(6, 3, 'To jest pierwszy Tweet Jana');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullName` varchar(100) DEFAULT NULL,
  `active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `User`
--

INSERT INTO `User` (`id`, `email`, `password`, `fullName`, `active`) VALUES
(1, 'piotr@test.pl', '$2y$10$pWmA/iMvuTHgKVfskwDjQ.FCLVMqQCDtxuQysW6kIu1rdY0wsuHg.', 'PiotrTestowy', 1),
(2, 'pawel@test.pl', '$2y$10$BesHHnoum8T4.ONold.HiuNUb5In6dg/fHr6lNIyOvNixrFHvHKqa', 'PawelTestowy', 1),
(3, 'jan@test.pl', '$2y$10$4oYwGg6FM7l/eWPcuBIq/O4J9WdIA0GKQ.EJzICzMgR2Cp.VjhjNu', 'JanTestowy', 1);

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `Comment_ibfk_1` FOREIGN KEY (`postId`) REFERENCES `Tweet` (`id`),
  ADD CONSTRAINT `Comment_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `User` (`id`);

--
-- Ograniczenia dla tabeli `Message`
--
ALTER TABLE `Message`
  ADD CONSTRAINT `Message_ibfk_1` FOREIGN KEY (`senderId`) REFERENCES `User` (`id`),
  ADD CONSTRAINT `Message_ibfk_2` FOREIGN KEY (`receiverId`) REFERENCES `User` (`id`);

--
-- Ograniczenia dla tabeli `Tweet`
--
ALTER TABLE `Tweet`
  ADD CONSTRAINT `Tweet_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `User` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
