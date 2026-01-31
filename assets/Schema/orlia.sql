-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2026 at 03:14 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orlia`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_key` varchar(255) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_category` varchar(50) NOT NULL,
  `event_type` varchar(50) NOT NULL,
  `day` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_key`, `event_name`, `event_category`, `event_type`, `day`, `status`) VALUES
(1, 'Tamilspeech', 'Tamil Speech', 'Non-Technical', 'Solo', 'day1', 0),
(2, 'Englishspeech', 'English Speech', 'Non-Technical', 'Solo', 'day1', 1),
(3, 'Singing', 'Singing', 'Non-Technical', 'Solo', 'day1', 1),
(4, 'Memecreation', 'Meme Creation', 'Non-Technical', 'Solo', 'day1', 1),
(5, 'Solodance', 'Solo Dance', 'Non-Technical', 'Solo', 'day1', 0),
(6, 'Divideconquer', 'Divide Conquer', 'Technical', 'Group', 'day1', 1),
(7, 'Trailertime', 'Trailer Time', 'Non-Technical', 'Group', 'day1', 1),
(8, 'Groupdance', 'Group Dance', 'Non-Technical', 'Group', 'day1', 1),
(9, 'Shortflim', 'Short Film', 'Non-Technical', 'Solo', 'day2', 1),
(10, 'Bestmanager', 'Best Manager', 'Non-Technical', 'Solo', 'day2', 1),
(11, 'Instrumentalplaying', 'Instrumental Playing', 'Non-Technical', 'Solo', 'day2', 1),
(12, 'Rjvj', 'RJ/VJ Hunt', 'Non-Technical', 'Solo', 'day2', 1),
(13, 'Artfromwaste', 'Art From Waste', 'Non-Technical', 'Group', 'day2', 1),
(14, 'Twindance', 'Twin Dance', 'Non-Technical', 'Group', 'day2', 1),
(15, 'Vegetablefruitart', 'Vegetable Fruit Art', 'Non-Technical', 'Group', 'day2', 1),
(16, 'Mime', 'Mime', 'Non-Technical', 'Both', 'day2', 1),
(38, 'Drawing', 'Drawing', 'Non-Technical', 'Solo', 'day1', 1),
(39, 'Mehandi', 'Mehandi', 'Non-Technical', 'Solo', 'day1', 1),
(43, 'Firelesscooking', 'Fireless Cooking', 'Non-Technical', 'Group', 'day1', 1),
(44, 'Dumpcharades', 'Dump Charades', 'Non-Technical', 'Group', 'day1', 1),
(45, 'Iplauction', 'IPL Auction', 'Non-Technical', 'Group', 'day1', 1),
(46, 'Lyricalhunt', 'Lyrical Hunt', 'Non-Technical', 'Group', 'day1', 1),
(51, 'Photography', 'Photography', 'Non-Technical', 'Solo', 'day2', 0),
(55, 'Rangoli', 'Rangoli', 'Non-Technical', 'Group', 'day2', 0),
(56, 'Sherlockholmes', 'Sherlock Holmes', 'Non-Technical', 'Group', 'day2', 1),
(57, 'Freefire', 'Free Fire', 'Non-Technical', 'Group', 'day2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `groupevents`
--

CREATE TABLE `groupevents` (
  `id` int(11) NOT NULL,
  `teamname` varchar(255) NOT NULL,
  `teamleadname` varchar(255) NOT NULL,
  `tregno` varchar(255) NOT NULL,
  `temail` varchar(255) NOT NULL,
  `events` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'Group',
  `tmembername` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`tmembername`)),
  `year` varchar(255) NOT NULL,
  `phoneno` varchar(255) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `day` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `groupevents`
--

INSERT INTO `groupevents` (`id`, `teamname`, `teamleadname`, `tregno`, `temail`, `events`, `type`, `tmembername`, `year`, `phoneno`, `dept`, `day`) VALUES
(1, 'Leks.AI', 'Jayanthan', '927622BAL', 'itsmejayanthan@gmail.com', 'Firelesscooking', 'Group', '[{\"name\":\"Lekaa\",\"roll\":\"8524\"}]', 'IV year', '8825756388', 'AIML', 'day1'),
(2, 'Leks.AI', 'Jayanthan Senthilkumar', '927625BCS056', 'kf@gmail.com', 'Firelesscooking', 'Group', '[{\"name\":\"Lekaa\",\"roll\":\"da\",\"phone\":\"ad\"}]', 'I year', '08825756388', 'CSE', 'day1'),
(3, 'Leks.AI', 'JAYANTHAN S', '927624BAM556', 'jah@gmail.com', 'Firelesscooking', 'Group', '[{\"name\":\"Lekaa\",\"roll\":\"8524\",\"phone\":\"08825756388\",\"dept\":\"CSE\",\"year\":\"I year\"}]', 'II year', '08825756388', 'AIML', 'day1'),
(4, 'BHjl', 'bklj', '927624BAD583', 'jah@gmail.com', 'Firelesscooking', 'Group', '[{\"name\":\"zdvf\",\"roll\":\"927625BAM856\",\"phone\":\"865\",\"dept\":\"AIML\",\"year\":\"I year\"}]', 'II year', '9865', 'AIDS', 'day1'),
(5, 'd5ruty', 'ftugkbhjnk', '927625BAM120', 'uftygbhjn@gmail.com', 'Groupdance', 'Group', '[{\"name\":\"ryfvgibhj\",\"roll\":\"927625BAD222\",\"phone\":\"cfuvgbhj\",\"dept\":\"AIDS\",\"year\":\"I year\"},{\"name\":\"hcfjhb jn\",\"roll\":\"927624BAM521\",\"phone\":\"ctyfvgjbh\",\"dept\":\"AIML\",\"year\":\"II year\"},{\"name\":\"rdfyvgbhj\",\"roll\":\"927624BAM865\",\"phone\":\"xrdcfgvhb \",\"dept\":\"AIML\",\"year\":\"II year\"},{\"name\":\"yfgvbjhn \",\"roll\":\"927625BAM85\",\"phone\":\"rryvgj\",\"dept\":\"AIML\",\"year\":\"I year\"},{\"name\":\"yvgkbj \",\"roll\":\"927625BAM49865\",\"phone\":\"xeytdgh \",\"dept\":\"AIML\",\"year\":\"I year\"}]', 'I year', 'tcfvgyjbnk', 'AIML', 'day1');

-- --------------------------------------------------------

--
-- Table structure for table `soloevents`
--

CREATE TABLE `soloevents` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `regno` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `phoneno` varchar(255) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `day` varchar(255) NOT NULL,
  `events` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `soloevents`
--

INSERT INTO `soloevents` (`id`, `name`, `regno`, `year`, `phoneno`, `dept`, `day`, `events`, `mail`) VALUES
(1, 'Jayan', '852741', 'IV year', '65934626', 'AIML', '', '', 'jah@gmail.com'),
(2, 'Jayan', '852741', 'IV year', '65934626', 'AIML', '', '', 'jah@gmail.com'),
(3, 'Jayan', '852741', 'IV year', '65934626', 'AIML', '', '', 'jah@gmail.com'),
(4, 'Jayan', '852741', 'IV year', '65934626', 'AIML', '', '', 'jah@gmail.com'),
(5, 'Jayan', '852741', 'IV year', '8825756388', 'AIML', 'day1', 'Singing', 'jah@gmail.com'),
(6, 'Jayanthan', '927622BAL016', 'IV year', '8825756388', 'AIML', 'day1', 'Singing', 'itsmejayanthan@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userid`, `password`, `role`) VALUES
(1, 'admin', '123456@', '0'),
(2, 'admin123', '123456@', '0'),
(3, 'Iplauction', '123', '1'),
(4, 'Groupdance', '123', '1'),
(5, 'Divideconquer', '123', '1'),
(6, 'Firelesscooking', '123', '1'),
(7, 'Trailertime', '123', '1'),
(8, 'Lyricalhunt', '123', '1'),
(9, 'Dumpcharades', '123', '1'),
(10, 'Rangoli', '123', '1'),
(11, 'Sherlockholmes', '123', '1'),
(12, 'Freefire', '123', '1'),
(13, 'Treasurehunt', '123', '1'),
(14, 'Artfromwaste', '123', '1'),
(15, 'Twindance', '123', '1'),
(16, 'Mime', '123', '1'),
(17, 'Tamilspeech', '123', '1'),
(18, 'Englishspeech', '123', '1'),
(19, 'Singing', '123', '1'),
(20, 'Drawing', '123', '1'),
(21, 'Mehandi', '123', '1'),
(22, 'Memecreation', '123', '1'),
(23, 'Solodance', '123', '1'),
(24, 'Photography', '123', '1'),
(25, 'Bestmanager', '123', '1'),
(26, 'Instrumentalplaying', '123', '1'),
(27, 'Rjvj', '123', '1'),
(28, 'Shortflim', '123', '1'),
(29, 'superadmin', '12345', '2'),
(30, 'Vegetablefruitart', '123', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `event_key` (`event_key`);

--
-- Indexes for table `groupevents`
--
ALTER TABLE `groupevents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soloevents`
--
ALTER TABLE `soloevents`
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
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `groupevents`
--
ALTER TABLE `groupevents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `soloevents`
--
ALTER TABLE `soloevents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
