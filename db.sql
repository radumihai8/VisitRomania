-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Gazdă: localhost:3306
-- Timp de generare: mai 28, 2020 la 02:13 PM
-- Versiune server: 10.3.23-MariaDB
-- Versiune PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `hustworl_top`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `comments`
--

CREATE TABLE `comments` (
  `postid` int(11) DEFAULT NULL,
  `username` text DEFAULT NULL,
  `commentid` int(11) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `comments`
--

INSERT INTO `comments` (`postid`, `username`, `commentid`, `comment`, `date`) VALUES
(16, 'RaduMihai', 2017, '123qweasdzxc', '2019-05-26 20:26:35'),
(16, 'RaduMihai', 2018, '123qweasdzxc', '2019-05-26 20:26:40'),
(1, '', 2019, 'testcomentariu', '2019-06-19 22:19:54'),
(1, '', 2020, 'test3', '2019-06-19 22:20:03'),
(15, 'hust1', 2021, 'test', '2020-05-11 21:48:46'),
(27, 'RaduM', 2022, 'Superb!', '2020-05-25 21:04:13');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `servers`
--

CREATE TABLE `servers` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `website` text NOT NULL,
  `category` int(11) NOT NULL,
  `youtube` text NOT NULL,
  `banner` text NOT NULL,
  `votes` int(11) DEFAULT 0,
  `rating` int(11) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL,
  `clicks` int(11) DEFAULT 0,
  `city` int(11) NOT NULL DEFAULT 14
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `servers`
--

INSERT INTO `servers` (`id`, `username`, `title`, `description`, `website`, `category`, `youtube`, `banner`, `votes`, `rating`, `date`, `clicks`, `city`) VALUES
(27, 'Radu', '5 To Go ', 'Strada Vasile Alecsandri, 7, Timisoara', 'https://fivetogo.ro/menu/', 2, '0EIv4rO_VM0', 'https://hust.world/atestat/uploads/24.png', 2, 5, '2020-05-25 20:14:49', 15, 13),
(26, 'Radu', 'Delfinariu Constanta', 'Bulevardul Mamaia 255, ConstanÈ›a 900552', 'https://www.delfinariu.ro/', 4, 'uAAN435Ysmc', 'https://hust.world/atestat/uploads/26.png', 0, 0, '2020-05-25 20:19:52', 35, 5),
(25, 'Radu', 'MOVe Club', 'Strada Mihail KogÄƒlniceanu 15', 'http://moveclub.ro/', 3, 'pxrsz1TQYJg', 'https://hust.world/atestat/uploads/25.png', 0, 0, '2020-05-25 20:18:30', 20, 2),
(24, 'Radu', '5 To Go ', 'Strada Alexandru Ioan Cuza 9-7, Craiova 200402', 'https://fivetogo.ro/menu/', 2, '0EIv4rO_VM0', 'https://hust.world/atestat/uploads/24.png', 0, 0, '2020-05-25 20:14:49', 6, 6),
(23, 'Radu', 'KFC - Bucuresti', 'Kentucky Fried Chicken - KFC Romania. | Bulevardul Iuliu Maniu 560, BucureÈ™ti 061129', 'https://www.kfc.ro/', 1, 'YN2URsx8gIs', 'https://hust.world/atestat/uploads/23.png', 1, 5, '2020-05-25 20:11:41', 45, 3),
(28, 'Radu', 'Turnul cu ceas', 'Strada Turnului, Sighisoara 545400', 'https://ro.wikipedia.org/wiki/Turnul_cu_Ceas_din_Sighi%C8%99oara', 4, 'tMQKk0PqgnM', 'https://hust.world/atestat/uploads/28.png', 1, 5, '2020-05-25 20:25:06', 12, 10),
(29, 'Radu', 'PUB 13 - Restaurantul Cetatii', 'Aleea SfÃ¢ntul Capistrano nr.1, Alba Iulia 510011', 'https://www.pub13.ro/', 1, '7u5rJgeuPp0', 'https://hust.world/atestat/uploads/29.png', 0, 0, '2020-05-25 20:26:38', 25, 1),
(30, 'Radu', 'Ristretto Caffe', 'Calea Republicii 11', 'https://www.ristrettocaffe.ro/', 2, '7VAhwl8zpyo', 'https://hust.world/atestat/uploads/30.png', 0, 0, '2020-05-25 20:28:13', 9, 8),
(31, 'Radu', 'Mc Donald`s', 'Strada Ana Ipatescu 10', 'https://mcdonalds.ro', 1, 'Lf7fUkhOnzo', 'https://hust.world/atestat/uploads/31.png', 0, 0, '2020-05-25 20:30:48', 8, 11);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `level` int(11) NOT NULL,
  `postcount` int(11) DEFAULT 0,
  `passwordkey` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `level`, `postcount`, `passwordkey`) VALUES
(20, 'RaduM', '*4ACFE3202A5FF5CF467898FC58AAB1D615029441', 'danut_mihai8@yahoo.fr', 9, 9, 'VXYhbiPn0Ws5');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `votes`
--

CREATE TABLE `votes` (
  `vid` int(11) NOT NULL,
  `ip` text NOT NULL,
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `votes`
--

INSERT INTO `votes` (`vid`, `ip`, `id`, `date`) VALUES
(82, '86.127.25.26', 19, '2020-05-11 20:08:48'),
(53, '86.127.3.10', 15, '2019-06-04 16:40:43'),
(52, '86.127.3.10', 16, '2019-06-04 16:40:40'),
(51, '86.127.3.10', 1, '2019-05-30 16:58:54'),
(50, '86.127.3.10', 16, '2019-05-30 14:47:00'),
(49, '82.78.216.201', 16, '2019-05-29 07:53:58'),
(47, '86.127.3.10', 8, '2019-05-26 21:15:07'),
(46, '86.127.3.10', 5, '2019-05-26 21:14:57'),
(45, '86.127.3.10', 4, '2019-05-26 20:52:05'),
(44, '86.127.3.10', 2, '2019-05-26 20:52:02'),
(43, '86.127.3.10', 14, '2019-05-26 20:51:56'),
(42, '86.127.3.10', 3, '2019-05-26 20:49:08'),
(41, '86.127.3.10', 16, '2019-05-26 20:45:46'),
(40, '86.127.3.10', 15, '2019-05-26 20:43:31'),
(39, '86.127.3.10', 1, '2019-05-26 20:42:14'),
(54, '86.127.3.10', 16, '2019-06-05 18:30:41'),
(55, '86.127.3.10', 15, '2019-06-05 18:37:02'),
(56, '86.127.3.10', 16, '2019-06-05 18:39:46'),
(57, '86.127.3.10', 16, '2019-06-05 18:40:26'),
(58, '86.127.3.10', 14, '2019-06-06 11:47:15'),
(59, '86.127.3.10', 1, '2019-06-06 16:19:46'),
(60, '86.127.3.10', 2, '2019-06-06 16:19:48'),
(61, '86.127.3.10', 1, '2019-06-07 21:46:49'),
(62, '86.127.3.10', 15, '2019-06-18 14:03:18'),
(63, '86.127.3.10', 1, '2019-06-18 14:34:33'),
(64, '86.127.3.10', 2, '2019-06-18 14:35:24'),
(65, '86.127.3.10', 3, '2019-06-18 14:40:44'),
(66, '86.127.3.10', 16, '2019-06-18 16:27:29'),
(67, '86.127.3.10', 13, '2019-06-18 16:53:16'),
(68, '86.127.3.10', 14, '2019-06-19 00:00:39'),
(69, '86.127.3.10', 17, '2019-06-20 21:36:24'),
(70, '86.127.3.10', 16, '2019-06-20 23:37:12'),
(71, '86.127.3.10', 15, '2019-06-20 23:41:26'),
(72, '86.127.3.10', 17, '2019-06-21 23:38:40'),
(73, '86.127.3.10', 18, '2019-06-22 00:00:44'),
(74, '86.127.3.10', 1, '2019-06-23 11:26:55'),
(75, '82.137.14.174', 15, '2019-06-25 17:14:08'),
(76, '46.177.61.89', 15, '2019-07-18 04:30:37'),
(77, '82.78.216.201', 15, '2019-09-16 08:17:21'),
(81, '86.127.25.26', 15, '2020-05-11 19:54:49'),
(83, '86.127.25.26', 23, '2020-05-25 20:12:50'),
(84, '86.127.25.26', 28, '2020-05-25 23:38:49');

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentid`);

--
-- Indexuri pentru tabele `servers`
--
ALTER TABLE `servers`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`vid`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `comments`
--
ALTER TABLE `comments`
  MODIFY `commentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2023;

--
-- AUTO_INCREMENT pentru tabele `servers`
--
ALTER TABLE `servers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pentru tabele `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pentru tabele `votes`
--
ALTER TABLE `votes`
  MODIFY `vid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
