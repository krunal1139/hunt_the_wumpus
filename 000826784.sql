-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2020 at 05:32 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
--
-- Database: `000826784`
--

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `email` varchar(200) NOT NULL,
  `wins` int(11) NOT NULL DEFAULT 0,
  `losses` int(11) NOT NULL DEFAULT 0,
  `last_played_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`email`, `wins`, `losses`, `last_played_date`) VALUES
('', 2, 0, '2020-10-24'),
('anjalipatel3757@gmail.com', 1, 0, '2020-10-24'),
('himani-rajeshkumar.patel@mohawkcollege.ca', 1, 0, '2020-10-24'),
('krunal1139@gmail.com', 1, 0, '2020-10-24');

-- --------------------------------------------------------

--
-- Table structure for table `wumpuses`
--

CREATE TABLE `wumpuses` (
  `id` int(11) NOT NULL,
  `rows` int(11) NOT NULL,
  `columns` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wumpuses`
--

INSERT INTO `wumpuses` (`id`, `rows`, `columns`) VALUES
(1, 0, 2),
(2, 0, 4),
(3, 1, 3),
(4, 2, 2),
(5, 2, 4),
(6, 3, 1),
(7, 3, 3),
(8, 4, 2),
(9, 4, 4),
(10, 3, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `wumpuses`
--
ALTER TABLE `wumpuses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wumpuses`
--
ALTER TABLE `wumpuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
