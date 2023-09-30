-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2023 at 12:42 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinema`
--

-- --------------------------------------------------------

--
-- Table structure for table `cinema`
--

CREATE TABLE `cinema` (
  `cinema_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cinema`
--

INSERT INTO `cinema` (`cinema_name`) VALUES
('Cine-Zea');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `movie_name` varchar(40) NOT NULL,
  `movie_descr` varchar(250) DEFAULT NULL,
  `movie_genre` varchar(40) DEFAULT NULL,
  `movie_duration` varchar(20) DEFAULT NULL,
  `cinema_cinema_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`movie_name`, `movie_descr`, `movie_genre`, `movie_duration`, `cinema_cinema_name`) VALUES
('Black Swan', 'A committed dancer struggles to maintain her sanity after winning the lead role.', 'Thriller', '107 minutes', 'Cine-Zea'),
('Bride of Chucky', 'Chucky, the doll possessed by a serial killer, discovers the perfect mate to kill and revive into the body of another doll.', 'Horror', '89 minutes', 'Cine-Zea'),
('Happy Death Day 2U', 'Tree Gelbman discovers that dying over and over was surprisingly easier than the dangers that lie ahead.', 'Thriller', '120 minutes', 'Cine-Zea'),
('Precious', 'An overweight, abused, illiterate teen who is pregnant with her second child is invited to enroll in an alternative school in hopes that she can re-route her life in a better direction.', 'Drama', '150 minutes', 'Cine-Zea'),
('Scream 6', 'In the next installment, the survivors of the Ghostface killings leave Woodsboro behind and start a fresh chapter in New York City.', 'Horror', '114 minutes', 'Cine-Zea'),
('The Menu', 'A young couple travels to a remote island to eat at an exclusive restaurant where the chef has prepared a lavish menu, with some shocking surprises.', 'Comedy', '107 minutes', 'Cine-Zea'),
('Thor: Love and Thunder', 'Thor enlists the help of Valkyrie, Korg and ex-girlfriend Jane Foster to fight Gorr the God Butcher, who intends to make the gods extinct.', 'Action', '119 minutes', 'Cine-Zea');

-- --------------------------------------------------------

--
-- Table structure for table `screening`
--

CREATE TABLE `screening` (
  `scr_id` varchar(20) NOT NULL,
  `scr_hall` varchar(10) DEFAULT NULL,
  `scr_capacity` decimal(38,0) DEFAULT NULL,
  `scr_date` datetime DEFAULT NULL,
  `scr_price` decimal(6,2) DEFAULT NULL,
  `movie_movie_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `screening`
--

INSERT INTO `screening` (`scr_id`, `scr_hall`, `scr_capacity`, `scr_date`, `scr_price`, `movie_movie_name`) VALUES
('B1', 'Hall 2', '95', '2023-12-23 20:00:00', '8.00', 'Black Swan'),
('D1', 'Hall 3', '100', '2023-12-26 12:20:00', '10.00', 'Scream 6'),
('D2', 'Hall 4', '100', '2023-12-26 12:20:00', '8.00', 'Scream 6'),
('H1', 'Hall 4', '96', '2023-12-24 10:30:00', '8.00', 'Happy Death Day 2U'),
('P1', 'Hall 1', '100', '2023-12-23 21:00:00', '8.00', 'Precious'),
('S1', 'Hall 1', '100', '2023-12-23 12:20:00', '8.00', 'Bride of Chucky'),
('T1', 'Hall 1', '100', '2023-02-23 19:00:00', '8.00', 'The Menu'),
('TH1', 'Hall 5', '97', '2023-12-23 11:00:00', '10.00', 'Thor: Love and Thunder');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` varchar(20) NOT NULL,
  `user_user_username` varchar(20) DEFAULT NULL,
  `user_cinema_cinema_name` varchar(20) DEFAULT NULL,
  `ticket_number` decimal(38,0) DEFAULT NULL,
  `ticket_total_price` decimal(6,2) DEFAULT NULL,
  `screening_scr_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `user_user_username`, `user_cinema_cinema_name`, `ticket_number`, `ticket_total_price`, `screening_scr_id`) VALUES
('1676849853', 'AliceWonderland', NULL, '5', '40.00', 'B1'),
('1676849893', 'Killer99', NULL, '3', '30.00', 'TH1'),
('1676849918', 'Anna23', NULL, '4', '32.00', 'H1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_username` varchar(20) NOT NULL,
  `user_password` varchar(20) DEFAULT NULL,
  `user_name` varchar(20) DEFAULT NULL,
  `user_lastname` varchar(20) DEFAULT NULL,
  `user_country` varchar(20) DEFAULT NULL,
  `user_city` varchar(20) DEFAULT NULL,
  `user_address` varchar(20) DEFAULT NULL,
  `user_email` varchar(50) DEFAULT NULL,
  `cinema_cinema_name` varchar(20) NOT NULL,
  `user_trait` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_username`, `user_password`, `user_name`, `user_lastname`, `user_country`, `user_city`, `user_address`, `user_email`, `cinema_cinema_name`, `user_trait`) VALUES
('Adam5150', '1234', 'Adam', 'Levis', 'Greece', 'Moskháton', 'Psaron 45', 'adam11@hotmail.com', 'Cine-Zea', 'Unassigned'),
('Alex20', 'ad1234', 'Alex', 'Michaels', 'Greece', 'Piraeus', 'Ipollitou 6', 'alex20@hotmail.com', 'Cine-Zea', 'Admin'),
('AliceWonderland', '1234', 'Alikh', 'Dhmhtriou', 'Greece', 'Korydallós', 'Ypodromou 32', 'alicewonderland@hotmail.com', 'Cine-Zea', 'User'),
('Anna23', '1234', 'Anna', 'Harris', 'Greece', 'Glyfáda', 'Martinou 12', 'anna11@hotmail.com', 'Cine-Zea', 'User'),
('CineZea', 'ad1234', 'Harry', 'Labropoulos', 'Greece', 'Kallithéa', 'Dabakh 17', 'cinezea@hotmail.com', 'Cine-Zea', 'Admin'),
('Don15', '1234', 'Don', 'Lothario ', 'Greece', 'Aigáleo', 'Nafpliou', 'donhorrorfan@hotmail.com', 'Cine-Zea', 'Unassigned'),
('Killer99', '1234', 'Nikos', 'Alexopoulos', 'Greece', 'Keratsíni', 'Galhnou 56', 'killer99@hotmail.com', 'Cine-Zea', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cinema`
--
ALTER TABLE `cinema`
  ADD PRIMARY KEY (`cinema_name`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`movie_name`),
  ADD KEY `movie_cinema_fk` (`cinema_cinema_name`);

--
-- Indexes for table `screening`
--
ALTER TABLE `screening`
  ADD PRIMARY KEY (`scr_id`),
  ADD KEY `screening_movie_fk` (`movie_movie_name`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `ticket_screening_fk` (`screening_scr_id`),
  ADD KEY `ticket_user_fk` (`user_user_username`,`user_cinema_cinema_name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_username`,`cinema_cinema_name`),
  ADD KEY `user_cinema_fk` (`cinema_cinema_name`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movie`
--
ALTER TABLE `movie`
  ADD CONSTRAINT `movie_cinema_fk` FOREIGN KEY (`cinema_cinema_name`) REFERENCES `cinema` (`cinema_name`);

--
-- Constraints for table `screening`
--
ALTER TABLE `screening`
  ADD CONSTRAINT `screening_movie_fk` FOREIGN KEY (`movie_movie_name`) REFERENCES `movie` (`movie_name`);

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_screening_fk` FOREIGN KEY (`screening_scr_id`) REFERENCES `screening` (`scr_id`),
  ADD CONSTRAINT `ticket_user_fk` FOREIGN KEY (`user_user_username`,`user_cinema_cinema_name`) REFERENCES `user` (`user_username`, `cinema_cinema_name`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_cinema_fk` FOREIGN KEY (`cinema_cinema_name`) REFERENCES `cinema` (`cinema_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
