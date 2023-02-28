-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 24, 2021 at 11:19 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `melbourneBlog`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postsId` int(11) NOT NULL,
  `rname` tinytext,
  `imageUrl` text,
  `postComment` text,
  `rating` int(11) DEFAULT NULL,
  `usersId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postsId`, `rname`, `imageUrl`, `postComment`, `rating`, `usersId`) VALUES
(1, 'The Big burger', 'https://images.unsplash.com/photo-1598182198871-d3f4ab4fd181?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=870&q=80', 'This was an excellent discovery. The place is simple but nice, the staff is very friendly and the burgers are awesome. The options are all good and you can\'t go wrong if you are looking for a nice tasty burger with an oriental twist or if you like a great quality classic.', 5, 6),
(2, 'Squires Loft South Yarra', 'https://images.unsplash.com/photo-1600891964092-4316c288032e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80', 'The best steak restaurant in Melbourne!', 5, 6),
(3, 'Beautiful food ', 'https://images.unsplash.com/photo-1432139555190-58524dae6a55?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1476&q=80', 'Amazing food but a little bit expensive. Anyway, I recommend it.', 4, 7),
(4, 'My seafood Restaurant', 'https://images.unsplash.com/photo-1563372522-8e97eac82f62?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80', 'The food was delicious, lovely wine and wonderful service at this restaurant. We really enjoyed ourselves', 4, 9);

-- --------------------------------------------------------

--
-- Table structure for table `profileimage`
--

CREATE TABLE `profileimage` (
  `idImage` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profileimage`
--

INSERT INTO `profileimage` (`idImage`, `userId`, `status`) VALUES
(3, 6, 1),
(4, 9, 1),
(5, 9, 1),
(6, 6, 1),
(7, 9, 1),
(8, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `usersId` int(11) NOT NULL,
  `usersEmail` varchar(255) NOT NULL,
  `usersUid` varchar(255) NOT NULL,
  `usersPwd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usersId`, `usersEmail`, `usersUid`, `usersPwd`) VALUES
(5, 'testuser2@test.com', 'testuser2', '$2y$10$.4e8soSbNIdfeXeogb3m7.u97/RRRViZ1XDpjVaE562edlzToC8IO'),
(6, 'pameposada@gmail.com', 'pam', '$2y$10$w38WVzJzQQzScWuVZBwGQ.ts9zuC.HHGkHMAMMFlb1.S6s1kbjclq'),
(7, 'scotty@scotty.com', 'scotty', '$2y$10$QFBPfIUysVldmhv0tUhYce5a0lizuG33m.s5.jRUlmTnTUJK8hthK'),
(8, 'tom@tom.com', 'tom', '$2y$10$pW7F3QTZNe0VJOoOe2eYbOz4MzTFazbFkthytBcCELFev8by2xf6O'),
(9, 'alex@alex.com', 'alex', '$2y$10$xl7b6yT.pljQi9mfzXRXOuQ1QcqnfGrPWLGWk7uY80QSxInwoeJgO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postsId`),
  ADD KEY `usersId` (`usersId`);

--
-- Indexes for table `profileimage`
--
ALTER TABLE `profileimage`
  ADD PRIMARY KEY (`idImage`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `profileimage`
--
ALTER TABLE `profileimage`
  MODIFY `idImage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`usersId`) REFERENCES `users` (`usersId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
