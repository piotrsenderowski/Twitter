-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 20 Lip 2016, 08:00
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
-- Struktura tabeli dla tabeli `Tweet`
--

CREATE TABLE IF NOT EXISTS `Tweet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL,
  `tweetText` varchar(140) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Zrzut danych tabeli `Tweet`
--

INSERT INTO `Tweet` (`id`, `userId`, `tweetText`) VALUES
(1, 3, 'Próbuję zapisać swojego pierwszego Tweeta.'),
(2, 3, 'Próbuję zapisać swojego drugiego Tweeta.'),
(3, 3, 'Próbuję zapisać swojego drugiego Tweeta.'),
(4, 3, 'Próbuję zapisać swojego drugiego Tweeta.'),
(5, 3, 'Dodaję Tweeta'),
(6, 3, 'Dodaję Tweeta'),
(7, 3, 'Tweet12345'),
(8, 3, 'asdk asd asd kasd kasd kjasd kjasd kjasd kjasd kjasd kjasd kjasd kjasd kjasd jkasdj kjasd kjasd kjasd kjasd kjasd kjasd kjasd jk asd asd asd'),
(9, 3, 'asdk asd asd kasd kasd kjasd kjasd kjasd kjasd kjasd kjasd kjasd kjasd kjasd jkasdj kjasd kjasd kjasd kjasd kjasd kjasd kjasd jk asd asd asd'),
(10, 3, 'asdk asd asd kasd kasd kjasd kjasd kjasd kjasd kjasd kjasd kjasd kjasd kjasd jkasdj kjasd kjasd kjasd kjasd kjasd kjasd kjasd jk asd asd asd'),
(11, 3, 'aasdk asd asd kasd kasd kjasd kjasd kjasd kjasd kjasd kjasd kjasd kjasd kjasd jkasdj kjasd kjasd kjasd kjasd kjasd kjasd kjasd jk asd asd as'),
(12, 1, 'Użytkownik 1 właśnie dodaje pierwszego Tweeta.'),
(13, 3, 'Testowy'),
(14, 3, 'Testowy'),
(15, 3, 'Testowy'),
(16, 3, 'Testowy'),
(17, 3, 'Testowy'),
(18, 3, 'TESTOWY2'),
(19, 3, 'TESTOWY2'),
(20, 3, 'TESTOWY2'),
(21, 3, 'TESTOWY2'),
(22, 3, 'TESTOWY2'),
(23, 3, 'TESTOWY2'),
(24, 3, 'TESTOWY2'),
(25, 3, 'TESTOWY2'),
(26, 3, 'TESTOWY2'),
(27, 3, 'TESTOWY2'),
(28, 3, 'Dodaję Tweeta'),
(29, 3, 'Dodaję Tweeta'),
(30, 3, 'Dodaję Tweeta'),
(31, 3, 'Dodaję Tweeta'),
(32, 3, 'Dodaję Tweeta'),
(33, 3, 'Dodaję Tweeta'),
(34, 3, 'Dodaję Tweeta'),
(35, 3, 'Dodaję Tweeta'),
(36, 3, 'Dodaję Tweeta'),
(37, 3, 'Dodaję Tweeta'),
(38, 3, 'Dodaję Tweeta'),
(39, 3, 'Dodaję Tweeta'),
(40, 3, 'Dodaję Tweeta'),
(41, 3, 'Dodaję Tweeta'),
(42, 3, 'Dodaję Tweeta'),
(43, 3, 'Dodaję Tweeta'),
(44, 3, 'Ale jaja');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Zrzut danych tabeli `User`
--

INSERT INTO `User` (`id`, `email`, `password`, `fullName`, `active`) VALUES
(1, 'coderslab@coderlsab.pl', '$2y$10$q74xncRzfH/JxQ7JmeuW/.f6HpWbjXUFFLYOTSBGkWGGO/eMO2lJq', 'Coderslab', 1),
(2, 'abc@coderslab.pl', '$2y$10$kWeRget.x93QLWnB82lcGOzfj0LMUGFyZk3zj9StZpqR93biQN84G', 'CodersLab', 1),
(3, 'test', '$2y$10$.XcPcFkIZtng5WawTkPfbeoJGxcD1InSjQqPQU7t0Sp9x/R4Uf99q', 'TestAccount', 1),
(4, 'test2', '$2y$10$IMVrF0oSzRKRsZSh9V3X5eJMk6Zh6MnGR7tlIULLQsM1qXC9kgjVu', 'TestAccount2', 1),
(5, 'test3', '$2y$10$WHYHmuRVoALI4AWCBVgJ4O4etCKPQyZ3G.c2tW3nLSV/GQ9hcVG82', 'TestAccount3', 1),
(6, 'test4', '$2y$10$UnbvDCFHcY.wc1FhZQhIGu1d/WevnXBY7cjXOqZgudbgk3uz6QvAW', 'TestAccount4', 1),
(7, 'test5', '$2y$10$k.7QVOJyu8tgazE1FPYLVunh6p33Oyd0KFsY2gfPb1ormLHVkKNwi', 'TestAccount5', 1);

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `Tweet`
--
ALTER TABLE `Tweet`
  ADD CONSTRAINT `Tweet_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `User` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
