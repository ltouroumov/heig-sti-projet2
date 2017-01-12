-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jan 12, 2017 at 06:03 PM
-- Server version: 10.1.20-MariaDB-1~jessie
-- PHP Version: 7.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `messaging`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `recipient` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `sent_date` datetime NOT NULL,
  `is_read` tinyint(1) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `recipient`, `sender`, `sent_date`, `is_read`, `subject`, `content`) VALUES
(2, 2, 1, '2017-01-12 00:00:00', 1, 'Hello Bob :)', 'How are you?'),
(3, 2, 1, '2017-01-12 00:00:00', 0, 'bob', 'bob'),
(4, 3, 1, '2017-01-12 00:00:00', 0, '1234', '1234'),
(5, 3, 1, '2017-01-12 00:00:00', 0, 'bye', 'bye'),
(6, 1, 3, '2017-01-12 00:00:00', 1, 'I\'m Alive :)', 'List?\r\n\r\n  * Hello\r\n  * World'),
(7, 3, 1, '2017-01-12 00:00:00', 0, 'bop', 'bop'),
(8, 5, 1, '2017-01-12 00:00:00', 0, 'Hello Lisa', '# Hello :P'),
(9, 2, 1, '2017-01-12 17:01:13', 0, 'a', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `roles`, `enabled`) VALUES
(1, 'admin', 'toto', 'ROLE_ADMIN', 1),
(2, 'bob', 'bob', 'ROLE_USER', 1),
(3, 'steve', 'steve', 'ROLE_USER', 1),
(5, 'lisa', 'lisa', 'ROLE_USER', 1),
(6, 'eve', 'eve', 'ROLE_USER', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;