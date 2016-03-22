-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 22 март 2016 в 22:45
-- Версия на сървъра: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sportblog`
--

-- --------------------------------------------------------

--
-- Структура на таблица `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `country_name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `country`
--

INSERT INTO `country` (`id`, `country_name`) VALUES
(1, 'Англия'),
(2, 'Италия'),
(3, 'Испания'),
(4, 'Германия'),
(5, 'Франция'),
(6, 'Португалия'),
(8, 'Холандия'),
(9, 'Шотландия'),
(12, 'България');

-- --------------------------------------------------------

--
-- Структура на таблица `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `home_team_id` int(11) NOT NULL,
  `away_team_id` int(11) NOT NULL,
  `score` varchar(20) NOT NULL,
  `date_play` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `games`
--

INSERT INTO `games` (`id`, `home_team_id`, `away_team_id`, `score`, `date_play`) VALUES
(2, 2, 3, '0:0', 1454797505),
(25, 29, 30, '0:2', 1458681465),
(13, 12, 15, '0:0', 1455837750),
(5, 2, 11, '1:0', 1454942082),
(10, 10, 7, '2:1', 1455113709),
(24, 19, 17, '1:0', 1458681185),
(9, 5, 14, '1:0', 1454945399),
(14, 2, 11, '2:0', 1455837913),
(15, 8, 9, '0:1', 1456041158),
(16, 23, 24, '2:1', 1456181244),
(19, 24, 25, '0:0', 1457130148),
(20, 6, 10, '2:0', 1457130262),
(21, 26, 30, '1:1', 1457471204),
(22, 26, 29, '4:2', 1457471230),
(23, 10, 22, '1:0', 1457476433);

-- --------------------------------------------------------

--
-- Структура на таблица `games_players`
--

CREATE TABLE `games_players` (
  `game_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `goals_ongame` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `games_players`
--

INSERT INTO `games_players` (`game_id`, `player_id`, `goals_ongame`) VALUES
(5, 2, 1),
(5, 3, 0),
(5, 4, 0),
(5, 5, 0),
(5, 75, 0),
(5, 76, 0),
(5, 77, 0),
(5, 78, 0),
(5, 80, 0),
(10, 72, 0),
(10, 69, 0),
(10, 73, 0),
(10, 68, 0),
(10, 74, 2),
(10, 70, 0),
(10, 71, 0),
(10, 49, 0),
(10, 52, 0),
(10, 53, 1),
(10, 47, 0),
(10, 51, 0),
(10, 48, 0),
(10, 50, 0),
(11, 35, 0),
(11, 33, 0),
(11, 39, 0),
(11, 37, 1),
(11, 38, 0),
(11, 34, 0),
(11, 90, 0),
(11, 94, 0),
(11, 95, 0),
(11, 89, 0),
(11, 92, 0),
(11, 93, 0),
(9, 35, 0),
(9, 33, 0),
(9, 39, 0),
(9, 37, 1),
(9, 38, 0),
(9, 34, 0),
(9, 102, 0),
(9, 97, 0),
(9, 99, 0),
(9, 98, 0),
(16, 153, 0),
(16, 151, 0),
(16, 146, 0),
(16, 150, 1),
(16, 149, 0),
(16, 147, 0),
(16, 152, 1),
(16, 155, 0),
(16, 157, 0),
(16, 159, 1),
(16, 156, 0),
(16, 154, 0),
(16, 160, 0),
(2, 3, 0),
(2, 5, 0),
(2, 4, 0),
(2, 2, 0),
(2, 9, 0),
(2, 8, 0),
(2, 7, 0),
(2, 6, 0),
(1, 22, 0),
(1, 25, 0),
(1, 21, 0),
(1, 19, 0),
(1, 24, 2),
(1, 9, 1),
(1, 8, 0),
(1, 7, 1),
(1, 6, 0),
(1, 1, 2),
(13, 88, 0),
(13, 83, 0),
(13, 82, 0),
(13, 85, 0),
(13, 86, 0),
(13, 84, 0),
(13, 116, 0),
(13, 110, 0),
(13, 115, 0),
(13, 114, 0),
(13, 113, 0),
(15, 55, 0),
(15, 57, 0),
(15, 58, 0),
(15, 54, 0),
(15, 56, 0),
(15, 66, 1),
(15, 64, 0),
(15, 67, 0),
(15, 61, 0),
(24, 141, 0),
(24, 142, 1),
(24, 127, 0),
(24, 128, 0),
(24, 126, 0),
(25, 168, 0),
(25, 170, 0),
(25, 169, 0),
(25, 171, 0),
(25, 172, 0),
(25, 173, 0),
(25, 175, 1),
(25, 176, 0),
(25, 174, 1),
(23, 72, 0),
(23, 73, 1),
(23, 74, 0),
(23, 106, 0),
(23, 107, 0),
(23, 108, 0),
(23, 109, 0),
(14, 2, 0),
(14, 5, 0),
(14, 164, 0),
(14, 162, 2),
(14, 75, 0),
(14, 76, 0),
(14, 77, 0),
(14, 78, 0),
(14, 80, 0),
(14, 81, 0),
(20, 42, 0),
(20, 40, 0),
(20, 41, 0),
(20, 43, 2),
(20, 44, 0),
(20, 46, 0),
(20, 72, 0),
(20, 73, 0),
(20, 74, 0);

-- --------------------------------------------------------

--
-- Структура на таблица `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reg_time` int(11) NOT NULL,
  `message` text NOT NULL,
  `title` text NOT NULL,
  `team_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `reg_time`, `message`, `title`, `team_id`) VALUES
(1, 2, 1454715348, 'Lorem Ipsum е елементарен примерен текст, използван в печатарската и типографската индустрия. Lorem Ipsum е индустриален стандарт от около 1500 година, когато неизвестен печатар взема няколко печатарски букви и ги разбърква, за да напечата с тях книга с примерни шрифтове.', 'Lorem Impsum', 3),
(2, 1, 1455197306, 'Lorem Ipsum е елементарен примерен текст, използван в печатарската и типографската индустрия. Lorem Ipsum е индустриален стандарт от около 1500 година, когато неизвестен печатар взема няколко печатарски букви и ги разбърква, за да напечата с тях книга с примерни шрифтове.', 'Lorem', 3),
(3, 1, 1455201120, 'Lorem Ipsum е елементарен примерен текст, използван в печатарската и типографската индустрия. Lorem Ipsum е индустриален стандарт от около 1500 година, когато неизвестен печатар взема няколко печатарски букви и ги разбърква, за да напечата с тях книга с примерни шрифтове.', 'индустриален стандарт от около 1500 година', 4),
(4, 3, 1458333961, 'По-рано през кампанията Силва пропусна 6 седмици заради подобна контузия и сега се твърди, че продължава да изпитва дискомфорт, което със сигурност е притеснително за отбора му. \r\nЗасега се смята, че операция не е необходима, но самият играч се надява, че ще бъде излекуван напълно. В Сити пък стискат силно палци това да се случи, тъй като футболистът е ключова фигура в стремежа на състава да завърши успешно сезона, в който продължава борбата на 4 фронта.', 'Силва се лекува в Испания', 2),
(10, 6, 1458335723, 'Младият футболист на Бенфика Ренато Санчес получи първа повиквателна за националния отбор на Португалия за контролите срещу България и Белгия,', 'Младият футболист', 19),
(5, 3, 1458321305, 'По-рано през кампанията Силва пропусна 6 седмици заради подобна контузия и сега се твърди, че продължава да изпитва дискомфорт, което със сигурност е притеснително за отбора му. Засега се смята, че операция не е необходима, но самият играч се надява, че ще бъде излекуван напълно. В Сити пък стискат силно палци това да се случи,', 'По-рано през кампанията Силва пропусна 6 седмици', 2),
(6, 3, 1458329884, 'Капитанът на Манчестър Сити Венсан Компани може да не играе два месеца и така на практика да пропусне остатъка от сезона. Това обяви селекционерът на Белгия Марк Вилмотс. \r\nЗащитникът получи нова травма в прасеца във вторник срещу Динамо Киев, след като пропусна голяма част от сезона заради подобен проблем. Първоначално бе обявено, че ще се възстановява около месец, но сега се оказва, че ситуацията може и да е по-сериозна и според Вилмотс Компани ще липсва между 6 и 8 седмици\r\n\r\nПрочети още на: http://www.gol.bg/mancity/2016-03-18/kompani-mozhe-da-e-aut-i-za-2-dva-mesetsa', 'Компани може да е аут и за 2 месеца  !!!', 2),
(7, 6, 1458331899, 'Техническият директор на Манчестър Сити Чики Бегиристайн коментира жребия за четвъртфиналите на Шампионската лига по футбол, в който "гражданите" се паднаха да играят с Пари Сен Жермен.\r\n\r\n"Много е трудно да се каже, че има добър жребий, когато си се класирал за четвъртфиналите на Шампионската лиг"а, каза Бегиристийн.\r\n"Видяхме какво направи Пари Сен Жермен в предишния кръг срещу Челси. ПСЖ е вече шампион на Франция с много точки аванс. Те винаги са играли добре срещу английски отбори".', 'Ман Сити се стресна от ПСЖ', 2),
(9, 6, 1458333325, 'Техническият директор на Манчестър Сити Чики Бегиристайн коментира жребия за четвъртфиналите на Шампионската лига по футбол, в който "гражданите" се паднаха да играят с Пари Сен Жермен.\r\n\r\n"Много е трудно да се каже, че има добър жребий, когато си се класирал за четвъртфиналите на Шампионската лиг"а, каза Бегиристийн.\r\n"Видяхме какво направи Пари Сен Жермен в предишния кръг срещу Челси. ПСЖ е вече шампион на Франция с много точки аванс. Те винаги са играли добре срещу английски отбори".', 'Ман Сити се стресна от ПСЖ!', 2);

-- --------------------------------------------------------

--
-- Структура на таблица `players`
--

CREATE TABLE `players` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `position_player` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `games` int(11) NOT NULL,
  `goals` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `team_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `players`
--

INSERT INTO `players` (`id`, `first_name`, `last_name`, `position_player`, `country`, `games`, `goals`, `image`, `team_id`) VALUES
(1, 'Aaron', 'Ramsey', 'M', 'Wales', 6, 7, 'http://cache.images.core.optasports.com/soccer/players/150x150/66532.png', 3),
(2, 'Samir', 'Nasri', 'M', 'France', 6, 2, 'http://cache.images.core.optasports.com/soccer/players/150x150/1538.png', 2),
(168, 'Felix', 'Wiedwald', 'G', 'Germany', 27, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/85380.png', 29),
(5, 'Joe', 'Hart', 'G', 'England', 6, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/2842.png', 2),
(6, 'David', 'Ospina', 'G', 'Colombia', 5, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/22426.png', 3),
(7, 'Per', 'Mertesacker', 'D', 'Germany', 5, 3, 'http://cache.images.core.optasports.com/soccer/players/150x150/16.png', 3),
(8, 'Santiago', 'Cazorla', 'M', 'Spain', 5, 2, 'http://cache.images.core.optasports.com/soccer/players/150x150/18102.png', 3),
(9, 'Joel', 'Campbell', 'F', 'Costa Rica', 5, 3, 'http://cache.images.core.optasports.com/soccer/players/150x150/102896.png', 3),
(164, 'Bacary', 'Sagna', 'D', 'France', 25, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/1407.png', 2),
(162, 'Sergio', 'Agüero', 'F', 'Argentina', 23, 10, 'http://cache.images.core.optasports.com/soccer/players/150x150/3051.png', 2),
(19, 'Kasper', 'Schmeichel', 'G', 'Denmark', 3, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/2841.png', 35),
(20, 'Robert', 'Huth', 'D', 'Germany', 2, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/11.png', 35),
(21, 'Wes', 'Morgan', 'D', 'Jamaica', 3, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/47493.png', 35),
(22, 'Gökhan', 'İnler', 'M', 'Switzerland', 3, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/11496.png', 35),
(23, 'Marc', 'Albrighton', 'M', 'England', 1, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/73931.png', 35),
(24, 'Jamie', 'Vardy', 'F', 'England', 3, 6, 'http://cache.images.core.optasports.com/soccer/players/150x150/159732.png', 35),
(25, 'Riyad', 'Mahrez', 'F', 'Algeria', 3, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/156662.png', 36),
(26, 'Hugo', 'Lloris', 'G', 'France', 0, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/1255.png', 36),
(27, 'Jan', 'Vertonghen', 'D', 'Belgium', 0, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/2190.png', 36),
(28, 'Kyle', 'Walker', 'D', 'England', 0, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/68532.png', 36),
(29, 'Nacer', 'Chadli', 'M', 'Belgium', 0, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/49530.png', 36),
(30, 'Christian', 'Eriksen', 'M', 'Denmark', 0, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/95871.png', 36),
(31, 'Harry', 'Kane', 'F', 'England', 0, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/158575.png', 36),
(32, 'Heung-Min', 'Son', 'F', 'Korea Republic', 0, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/103043.png', 36),
(33, 'David', 'De Gea', 'G', 'Spain', 5, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/61954.png', 5),
(34, 'Chris', 'Smalling', 'D', 'England', 4, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/79474.png', 5),
(35, 'Matteo', 'Darmian', 'D', 'Italy', 7, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/17720.png', 5),
(36, 'Bastian', 'Schweinsteiger', 'M', 'Germany', 2, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/35.png', 5),
(37, 'Juan Manuel', 'Mata', 'M', 'Spain', 7, 5, 'http://cache.images.core.optasports.com/soccer/players/150x150/19106.png', 5),
(38, 'Wayne', 'Rooney', 'F', 'England', 6, 2, 'http://cache.images.core.optasports.com/soccer/players/150x150/193.png', 5),
(39, 'Anthony', 'Martial', 'F', 'France', 6, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/215647.png', 5),
(40, 'Adrián', 'San Miguel', 'G', 'Spain', 1, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/60036.png', 6),
(41, 'Angelo', 'Ogbonna', 'D', 'Italy', 1, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/9770.png', 6),
(42, 'Aaron', 'Cresswell', 'D', 'England', 1, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/51175.png', 6),
(43, 'Dimitri', 'Payet', 'M', 'France', 1, 2, 'http://cache.images.core.optasports.com/soccer/players/150x150/1394.png', 6),
(44, 'Mark', 'Noble', 'M', 'England', 1, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/5320.png', 6),
(45, 'Andy', 'Carroll', 'F', 'England', 0, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/5310.png', 6),
(46, 'Enner', 'Valencia', 'F', 'Ecuador', 1, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/113400.png', 6),
(47, 'Maarten', 'Stekelenburg', 'G', 'Netherlands', 1, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/4.png', 7),
(48, 'Virgil', 'van Dijk', 'D', 'Netherlands', 1, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/188624.png', 7),
(49, 'José', 'Fonte', 'D', 'Portugal', 1, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/15805.png', 7),
(50, 'Victor', 'Wanyama', 'M', 'Kenya', 1, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/53437.png', 7),
(51, 'Dušan', 'Tadić', 'M', 'Serbia', 1, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/40709.png', 7),
(52, 'Sadio', 'Mané', 'F', 'Senegal', 1, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/201602.png', 7),
(53, 'Graziano', 'Pellè', 'F', 'Italy', 1, 1, 'http://cache.images.core.optasports.com/soccer/players/150x150/17312.png', 7),
(54, 'Tim', 'Howard', 'G', 'USA', 1, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/632.png', 8),
(55, 'Leighton', 'Baines', 'D', 'England', 3, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/2672.png', 8),
(56, 'Phil', 'Jagielka', 'D', 'England', 1, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/2600.png', 8),
(57, 'Ross', 'Barkley', 'M', 'England', 3, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/154068.png', 8),
(58, 'Gareth', 'Barry', 'M', 'England', 3, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/2800.png', 8),
(59, 'Romelu', 'Lukaku', 'F', 'Belgium', 0, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/79495.png', 8),
(60, 'Arouna', 'Koné', 'F', 'Côte d''Ivoire', 0, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/8862.png', 8),
(61, 'Simon', 'Mignolet', 'G', 'Belgium', 2, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/13465.png', 9),
(62, 'Martin', 'Škrtel', 'D', 'Slovakia', 0, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/5940.png', 9),
(63, 'Mamadou', 'Sakho', 'D', 'France', 0, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/13118.png', 9),
(64, 'Philippe', 'Coutinho', 'M', 'Brazil', 3, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/82507.png', 9),
(65, 'James', 'Milner', 'M', 'England', 0, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/2899.png', 9),
(66, 'Christian', 'Benteke', 'F', 'Belgium', 3, 3, 'http://cache.images.core.optasports.com/soccer/players/150x150/53423.png', 9),
(67, 'Roberto', 'Firmino', 'F', 'Brazil', 3, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/103265.png', 9),
(68, 'Heurelho', 'Gomes', 'G', 'Brazil', 3, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/2386.png', 10),
(69, 'Craig', 'Cathcart', 'D', 'Northern Ireland', 3, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/53407.png', 10),
(70, 'Allan', 'Nyom', 'D', 'Cameroon', 3, 2, 'http://cache.images.core.optasports.com/soccer/players/150x150/44285.png', 10),
(71, 'Ben', 'Watson', 'M', 'England', 2, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/15796.png', 10),
(72, 'Etienne', 'Capoue', 'M', 'France', 4, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/39171.png', 10),
(73, 'Troy', 'Deeney', 'F', 'England', 4, 1, 'http://cache.images.core.optasports.com/soccer/players/150x150/51197.png', 10),
(74, 'Odion', 'Ighalo', 'F', 'Nigeria', 4, 2, 'http://cache.images.core.optasports.com/soccer/players/150x150/20010.png', 10),
(75, 'Jack', 'Butland', 'G', 'England', 4, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/192419.png', 11),
(76, 'Erik', 'Pieters', 'D', 'Netherlands', 4, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/2487.png', 11),
(77, 'Glen', 'Johnson', 'D', 'England', 4, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/2641.png', 11),
(78, 'Glenn', 'Whelan', 'M', 'Republic of Ireland', 4, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/15518.png', 11),
(80, 'Jonathan', 'Walters', 'F', 'Republic of Ireland', 4, 1, 'http://cache.images.core.optasports.com/soccer/players/150x150/15748.png', 11),
(81, 'Marko', 'Arnautović', 'F', 'Austria', 3, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/21018.png', 11),
(82, 'Wayne', 'Hennessey', 'G', 'Wales', 2, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/15380.png', 12),
(83, 'Scott', 'Dann', 'D', 'England', 2, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/26006.png', 12),
(84, 'Pape', 'Souaré', 'D', 'Senegal', 2, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/95905.png', 12),
(85, 'James', 'McArthur', 'M', 'Scotland', 2, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/46511.png', 12),
(86, 'Jason', 'Puncheon', 'M', 'England', 2, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/46474.png', 12),
(87, 'Wilfried', 'Zaha', 'M', 'England', 0, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/123878.png', 12),
(88, 'Marouane', 'Chamakh', 'F', 'Morocco', 2, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/1495.png', 12),
(89, 'Thibaut', 'Courtois', 'G', 'Belgium', 1, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/77294.png', 13),
(90, 'César', 'Azpilicueta', 'D', 'Spain', 1, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/18099.png', 13),
(91, 'Branislav', 'Ivanović', 'D', 'Serbia', 0, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/6456.png', 13),
(92, 'Francesc', 'Fàbregas', 'M', 'Spain', 1, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/328.png', 13),
(93, 'Eden', 'Hazard', 'M', 'Belgium', 1, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/39358.png', 13),
(94, 'Willian', 'Borges', 'M', 'Brazil', 1, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/9051.png', 13),
(95, 'Diego', 'Costa', 'F', 'Spain', 1, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/60977.png', 13),
(96, 'Glyn', 'Myhill', 'G', 'Wales', 2, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/15756.png', 14),
(97, 'Craig', 'Dawson', 'D', 'England', 6, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/88227.png', 14),
(98, 'Gareth', 'McAuley', 'D', 'Northern Ireland', 5, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/15703.png', 14),
(99, 'Darren', 'Fletcher', 'M', 'Scotland', 6, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/2911.png', 14),
(100, 'James', 'McClean', 'M', 'Northern Ireland', 2, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/75127.png', 14),
(101, 'José', 'Rondón', 'F', 'Venezuela', 2, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/58710.png', 14),
(102, 'Saido', 'Berahino', 'F', 'England', 5, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/149485.png', 14),
(103, 'Artur', 'Boruc', 'G', 'Poland', 3, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/724.png', 22),
(104, 'Simon', 'Francis', 'D', 'England', 2, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/51102.png', 22),
(105, 'Adam', 'Smith', 'D', 'England', 2, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/88146.png', 22),
(106, 'Andrew', 'Surman', 'M', 'South Africa', 2, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/15494.png', 22),
(107, 'Dan', 'Gosling', 'M', 'England', 2, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/15647.png', 22),
(108, 'Joshua', 'King', 'F', 'Norway', 3, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/93432.png', 22),
(109, 'Benik', 'Afobe', 'F', 'England', 6, 2, 'http://cache.images.core.optasports.com/soccer/players/150x150/158576.png', 22),
(110, 'Łukasz', 'Fabiański', 'G', 'Poland', 2, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/725.png', 15),
(111, 'Neil', 'Taylor', 'D', 'Wales', 1, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/36434.png', 15),
(112, 'Ashley', 'Williams', 'D', 'Wales', 0, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/47555.png', 15),
(113, 'Gylfi', 'Sigurðsson', 'M', 'Iceland', 2, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/57707.png', 15),
(114, 'Sung-Yeung', 'Ki', 'M', 'Korea Republic', 2, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/26915.png', 15),
(115, 'Bafetimbi', 'Gomis', 'F', 'France', 2, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/1331.png', 15),
(116, 'André', 'Ayew', 'F', 'Ghana', 2, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/20572.png', 15),
(117, 'Tim', 'Krul', 'G', 'Netherlands', 0, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/5256.png', 16),
(118, 'Daryl', 'Janmaat', 'D', 'Netherlands', 0, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/59416.png', 16),
(119, 'Fabricio', 'Coloccini', 'D', 'Argentina', 0, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/105.png', 16),
(120, 'Georginio', 'Wijnaldum', 'M', 'Netherlands', 0, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/8828.png', 16),
(121, 'Moussa', 'Sissoko', 'M', 'France', 0, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/13622.png', 16),
(122, 'Ayoze', 'Pérez', 'F', 'Spain', 0, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/262852.png', 16),
(123, 'Aleksandar', 'Mitrović', 'F', 'Serbia', 0, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/203471.png', 16),
(126, 'Russell', 'Martin', 'D', 'England', 5, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/51076.png', 17),
(127, 'Nathan', 'Redmond', 'M', 'England', 3, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/148697.png', 17),
(128, 'Jonathan', 'Howson', 'M', 'England', 5, 2, 'http://cache.images.core.optasports.com/soccer/players/150x150/53096.png', 17),
(130, 'Cameron', 'Jerome', 'F', 'England', 1, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/16031.png', 17),
(131, 'Vito', 'Mannone', 'G', 'Italy', 0, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/16086.png', 18),
(132, 'Patrick', 'van Aanholt', 'D', 'Netherlands', 0, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/88136.png', 18),
(133, 'Billy', 'Jones', 'D', 'England', 0, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/15631.png', 18),
(134, 'Yann', 'M''Vila', 'M', 'France', 0, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/39223.png', 18),
(135, 'Lee', 'Cattermole', 'M', 'England', 0, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/2834.png', 18),
(136, 'Jermain', 'Defoe', 'F', 'England', 0, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/2950.png', 18),
(137, 'Fabio', 'Borini', 'F', 'Italy', 0, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/95826.png', 18),
(170, 'Jonathan', 'Tah', 'D', 'Germany', 28, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/261653.png', 30),
(169, 'Bernd', 'Leno', 'G', 'Germany', 30, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/102533.png', 30),
(140, 'Micah', 'Richards', 'D', 'England', 2, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/2852.png', 19),
(141, 'Idrissa', 'Gueye', 'M', 'Senegal', 4, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/95907.png', 19),
(142, 'Leandro', 'Bacuna', 'M', 'Netherlands', 5, 3, 'http://cache.images.core.optasports.com/soccer/players/150x150/88003.png', 19),
(144, 'Rudy', 'Gestede', 'F', 'Benin', 4, 5, 'http://cache.images.core.optasports.com/soccer/players/150x150/37908.png', 19),
(146, 'Íñigo', 'Martínez', 'D', 'Spain', 25, 1, 'http://cache.images.core.optasports.com/soccer/players/150x150/146693.png', 23),
(147, 'Gerónimo', 'Rulli', 'G', 'Argentina', 27, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/152109.png', 23),
(148, 'Alex', 'Oxlade-Chamberlain', 'F', 'England', 0, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/120695.png', 3),
(149, 'Diego', 'Reyes', 'D', 'Mexico', 18, 1, 'http://cache.images.core.optasports.com/soccer/players/150x150/53096.png', 23),
(150, 'Xabier', 'Prieto', 'M', 'Spain', 25, 6, 'http://cache.images.core.optasports.com/soccer/players/150x150/4503.png', 23),
(151, 'Asier', 'Illarramendi', 'M', 'Spain', 25, 1, 'http://cache.images.core.optasports.com/soccer/players/150x150/62758.png', 23),
(152, 'Carlos', 'Vela', 'F', 'Mexico', 27, 8, 'http://cache.images.core.optasports.com/soccer/players/150x150/3370.png', 23),
(153, 'Armindo', 'Bruna', 'F', 'Portugal', 27, 2, 'http://cache.images.core.optasports.com/soccer/players/150x150/159042.png', 23),
(154, 'Pau', 'López', 'G', 'Spain', 28, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/280411.png', 24),
(155, 'Víctor', 'Álvarez', 'D', 'Spain', 26, 1, 'http://cache.images.core.optasports.com/soccer/players/150x150/176575.png', 24),
(156, 'Álvaro', 'González', 'D', 'Spain', 28, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/183963.png', 24),
(157, 'Marco', 'Asensio', 'M', 'Spain', 25, 1, 'http://cache.images.core.optasports.com/soccer/players/150x150/320586.png', 24),
(158, 'Víctor', 'Sánchez', 'M', 'Spain', 18, 1, 'http://cache.images.core.optasports.com/soccer/players/150x150/26263.png', 24),
(159, 'Felipe', 'Caicedo', 'F', 'Ecuador', 26, 10, 'http://cache.images.core.optasports.com/soccer/players/150x150/23232.png', 24),
(160, 'Hernán', 'Pérez', 'F', 'Paraguay', 24, 5, 'http://cache.images.core.optasports.com/soccer/players/150x150/23737.png', 24),
(171, 'Wendell', 'Borges', 'D', 'Brazil', 28, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/171186.png', 30),
(172, 'Karim', 'Bellarabi', 'M', 'Germany', 30, 4, 'http://cache.images.core.optasports.com/soccer/players/150x150/79410.png', 30),
(173, 'Christoph', 'Kramer', 'M', 'Germany', 26, 0, 'http://cache.images.core.optasports.com/soccer/players/150x150/130205.png', 30),
(174, 'Javier', 'Hernández', 'F', 'Mexico', 33, 15, 'http://cache.images.core.optasports.com/soccer/players/150x150/53937.png', 30),
(175, 'Hakan', 'Çalhanoğlu', 'M', 'Turkey', 28, 5, 'http://cache.images.core.optasports.com/soccer/players/150x150/155410.png', 30),
(176, 'Stefan', 'Kießling', 'F', 'Germany', 26, 4, 'http://cache.images.core.optasports.com/soccer/players/150x150/1897.png', 30);

-- --------------------------------------------------------

--
-- Структура на таблица `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `team_name` varchar(50) NOT NULL,
  `country_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `image` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `teams`
--

INSERT INTO `teams` (`id`, `team_name`, `country_id`, `address`, `image`) VALUES
(35, 'Leicester City', 1, 'King Power Stadium', 'http://cache.images.core.optasports.com/soccer/teams/150x150/682.png'),
(2, 'Manchester City', 1, 'Etihad Stadium', 'http://cache.images.core.optasports.com/soccer/teams/150x150/676.png'),
(3, 'Arsenal', 1, 'Emiratesa Stadium', 'http://cache.images.core.optasports.com/soccer/teams/150x150/660.png'),
(36, 'Tottenham', 1, 'White Hart Lane', 'http://cache.images.core.optasports.com/soccer/teams/150x150/675.png'),
(5, 'Manchester United', 1, 'Old Trafford', 'http://cache.images.core.optasports.com/soccer/teams/150x150/662.png'),
(6, 'West Ham United', 1, 'Boleyn Ground', 'http://cache.images.core.optasports.com/soccer/teams/150x150/684.png'),
(7, 'Southampton', 1, 'St. Mary''s Stadium', 'http://cache.images.core.optasports.com/soccer/teams/150x150/670.png'),
(8, 'Everton', 1, 'Goodison Park', 'http://cache.images.core.optasports.com/soccer/teams/150x150/674.png'),
(9, 'Liverpool', 1, 'Anfield', 'http://cache.images.core.optasports.com/soccer/teams/150x150/663.png'),
(10, 'Watford', 1, 'Vicarage Road Stadium', 'http://cache.images.core.optasports.com/soccer/teams/150x150/696.png'),
(11, 'Stoke City', 1, 'Britannia Stadium', 'http://cache.images.core.optasports.com/soccer/teams/150x150/690.png'),
(12, 'Crystal Palace', 1, 'Selhurst Park', 'http://cache.images.core.optasports.com/soccer/teams/150x150/679.png'),
(13, 'Chelsea', 1, 'Stamford Bridge', 'http://cache.images.core.optasports.com/soccer/teams/150x150/661.png'),
(14, 'West Bromwich Albion', 1, 'The Hawthorns', 'http://cache.images.core.optasports.com/soccer/teams/150x150/678.png'),
(15, 'Swansea City', 1, 'Liberty Stadium', 'http://cache.images.core.optasports.com/soccer/teams/150x150/738.png'),
(16, 'Newcastle United', 1, 'St. James'' Park', 'http://cache.images.core.optasports.com/soccer/teams/150x150/664.png'),
(17, 'Norwich City', 1, 'Carrow Road', 'http://cache.images.core.optasports.com/soccer/teams/150x150/677.png'),
(18, 'Sunderland', 1, 'Stadium of Light', 'http://cache.images.core.optasports.com/soccer/teams/150x150/683.png'),
(19, 'Aston Villa', 1, 'Villa Park', 'http://cache.images.core.optasports.com/soccer/teams/150x150/665.png'),
(22, 'AFC Bournemouth', 1, 'Vitality Stadium', 'http://cache.images.core.optasports.com/soccer/teams/150x150/711.png'),
(23, 'Real Sociedad', 3, 'Estadio Municipal de Anoeta', 'http://cache.images.core.optasports.com/soccer/teams/150x150/2028.png'),
(24, 'Espanyol', 3, 'RCDE Stadium', 'http://cache.images.core.optasports.com/soccer/teams/150x150/2032.png'),
(25, 'Atlético Madrid', 3, 'Estadio Vicente Calderón', 'http://cache.images.core.optasports.com/soccer/teams/150x150/2020.png'),
(26, 'Stuttgart', 4, 'Mercedes-Benz-Arena', 'http://cache.images.core.optasports.com/soccer/teams/150x150/962.png'),
(27, 'Atalanta', 2, 'Stadio Atleti Azzurri d''Italia', 'http://cache.images.core.optasports.com/soccer/teams/150x150/1255.png'),
(29, 'Werder Bremen', 4, 'Weserstadion', 'http://cache.images.core.optasports.com/soccer/teams/150x150/960.png'),
(30, 'Bayer Leverkusen', 4, 'BayArena', 'http://cache.images.core.optasports.com/soccer/teams/150x150/963.png'),
(34, 'Schalke 04', 4, 'Gelsenkirchen', 'http://cache.images.core.optasports.com/soccer/teams/150x150/966.png');

-- --------------------------------------------------------

--
-- Структура на таблица `teams_images`
--

CREATE TABLE `teams_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `team_id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `teams_images`
--

INSERT INTO `teams_images` (`id`, `team_id`, `image_name`, `title`) VALUES
(5, 4, '464c2d915122002410efd8c85a70d5a8f6ac3ad9.jpg', '2013'),
(6, 4, '1ed0865aefe52cfbdd22e5481ac2251861eb634a.jpg', '2015'),
(7, 19, '60772be3da49074c8571c32432cee4cb71a95ef6.jpg', ''),
(8, 19, '5f85ff8d9d6e06d551db49dbb7c8669db46e2fee.jpg', ''),
(9, 19, '5a0f76ff3560730c858a665d1d42b01d40637f60.jpg', '1983'),
(12, 3, 'df228647eb4714b510ebd33587423525d3884a1c.jpg', ''),
(14, 26, 'd5c97acd4cfcab0a22839e663887769102d987f5.jpg', '2016');

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `reg_time` int(11) NOT NULL,
  `permition` int(11) NOT NULL DEFAULT '0',
  `gender` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `reg_time`, `permition`, `gender`, `email`) VALUES
(1, 'admin', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 1454361732, 1, 'male', 'dadsd@kasnkla.bg'),
(2, 'gogo', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 1454537273, 0, 'male', 'gogo@gogo.bg'),
(3, 'Pancho', '695f4a70eba026832fe8904ea2c5e1a8c96384ab', 1454537419, 0, 'male', 'gtajuve@jks.bg'),
(6, 'dani', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 1455044845, 0, 'female', 'dani@dani.com'),
(11, 'gogoto', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 1455175406, 0, 'female', 'asss@as.sss'),
(27, 'momo', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 1458245532, 0, 'male', 'kolio@majd.com');

-- --------------------------------------------------------

--
-- Структура на таблица `user_teams`
--

CREATE TABLE `user_teams` (
  `user_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `user_teams`
--

INSERT INTO `user_teams` (`user_id`, `team_id`) VALUES
(2, 1),
(4, 2),
(3, 2),
(2, 3),
(3, 17),
(3, 12),
(3, 4),
(6, 5),
(6, 4),
(6, 7),
(7, 15),
(9, 8),
(10, 12),
(11, 11),
(15, 11),
(3, 25),
(27, 22),
(3, 22),
(6, 2),
(6, 19),
(11, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams_images`
--
ALTER TABLE `teams_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;
--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `teams_images`
--
ALTER TABLE `teams_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
