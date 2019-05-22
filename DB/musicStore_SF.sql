-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 22, 2019 at 04:51 PM
-- Server version: 5.7.26-0ubuntu0.18.04.1
-- PHP Version: 7.3.5-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `musicStore_SF`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id` int(11) NOT NULL,
  `artists_id` int(11) DEFAULT NULL,
  `types_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_size` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `artists_id`, `types_id`, `name`, `date`, `image_name`, `image_size`, `updated_at`, `price`) VALUES
(1, 1, 1, 'Get Behind Me Satan', '2003-01-01', 'getbehindmesatan.jpg', 295943, '2019-04-01 13:19:54', 10.99),
(2, 2, 1, 'Let It Bleed', '1966-06-10', 'letitbleed.jpg', 94402, '2019-04-01 13:21:16', 12.99),
(3, 6, 1, 'Mellon Collie And The Infinite Sadness', '1997-05-03', 'melloncollie.jpg', 68372, '2019-04-01 13:22:37', 9.99),
(4, 3, 1, 'Achtung Baby', '2000-10-17', 'achtungbaby.jpg', 317997, '2019-04-01 13:23:50', 14.99),
(5, 11, 1, 'London Callin', '1982-11-16', 'londoncalling.jpg', 122698, '2019-04-01 13:25:57', 10.99),
(6, 7, 1, 'Bossonova', '1991-04-01', 'bossanova.jpg', 86447, '2019-04-01 13:27:22', 9.99),
(7, 4, 1, 'Definitely Maybe', '1994-12-24', 'definitelymaybe.jpg', 185476, '2019-04-01 13:28:45', 16.99),
(8, 5, 1, 'Pacific Ocean Blue', '1973-08-07', 'pacificoceanblue.jpg', 38588, '2019-04-01 13:29:57', 10.99),
(9, 8, 1, 'The Beatles (White Album)', '1969-07-10', 'thebeatles.jpg', 14697, '2019-04-01 13:31:33', 11.99),
(10, 9, 1, 'Nebraska', '1977-07-08', 'nebraska.jpg', 131538, '2019-04-01 13:32:59', 12.99),
(11, 10, 1, 'Ziggy Stardust', '1984-03-23', 'ziggystardust.jpg', 113985, '2019-04-01 13:34:09', 14.99);

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE `artist` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`id`, `name`) VALUES
(1, 'The White Stripes'),
(2, 'The Rolling Stones'),
(3, 'U2'),
(4, 'Oasis'),
(5, 'Dennis Wilson'),
(6, 'The Smashing Pumpkins'),
(7, 'Pixies'),
(8, 'The Beatles'),
(9, 'Bruce Springsteen'),
(10, 'David Bowie'),
(11, 'The Clash');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `album_id`, `content`, `date`) VALUES
(64, 12, 1, 'Wahou ! Quel super album :-)', '2019-05-22 16:42:57'),
(65, 12, 2, 'hello world !', '2019-05-22 16:43:36');

-- --------------------------------------------------------

--
-- Table structure for table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190401090443', '2019-04-01 09:04:55');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'ROLE_ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`) VALUES
(1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'Pop/Rock'),
(2, 'Classique'),
(3, 'Blues'),
(4, 'R&B'),
(5, 'Rap'),
(6, 'Reggae'),
(7, 'Electro'),
(8, 'Country'),
(9, 'Folk');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` int(11) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `first_name`, `address`, `number`, `postal_code`, `city`, `email`, `password`) VALUES
(6, 'super-test', 'test', 'rue du chmod', 644, 777, 'Linux', 'test@super-test.com', '$2y$13$Yt6149ktKQWjWINeF3oF6OSalEm7Ht9cz/j1nCM3Wk8QTfiZ6YOQO'),
(12, 'De pneu', 'Marc', 'Rue du Cric', 4, 9000, 'Cric/pneu', 'marc@super-test.com', '$2y$13$5e9KgpFgV1e/rqGax6.4cOwFD0JQ7itDtMyimSkGyLTzIL7nIZS/G');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_39986E4354A05007` (`artists_id`),
  ADD KEY `IDX_39986E438EB23357` (`types_id`);

--
-- Indexes for table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9474526CA76ED395` (`user_id`),
  ADD KEY `IDX_9474526C1137ABCF` (`album_id`);

--
-- Indexes for table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`role_id`,`user_id`),
  ADD KEY `IDX_332CA4DDD60322AC` (`role_id`),
  ADD KEY `IDX_332CA4DDA76ED395` (`user_id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `artist`
--
ALTER TABLE `artist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `FK_39986E4354A05007` FOREIGN KEY (`artists_id`) REFERENCES `artist` (`id`),
  ADD CONSTRAINT `FK_39986E438EB23357` FOREIGN KEY (`types_id`) REFERENCES `type` (`id`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526C1137ABCF` FOREIGN KEY (`album_id`) REFERENCES `album` (`id`),
  ADD CONSTRAINT `FK_9474526CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `FK_332CA4DDA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_332CA4DDD60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
