-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2019 at 04:37 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `article` text NOT NULL,
  `date` datetime NOT NULL,
  `likes` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `article`, `date`, `likes`) VALUES
(1, 1, 'Hello World', 'שלום לכולם', '2019-04-02 23:13:18', 10),
(2, 2, 'rdydrydy', 'dfyydfyfdyfdy', '2019-04-02 23:15:23', 16),
(3, 3, 'cvbcxbxh', 'fhfhfh', '2019-04-02 23:16:37', 10),
(4, 4, 'fhfhdfh', 'dfhdhfhfh', '2019-04-02 23:21:57', 10),
(5, 5, 'xxcxgxg', 'sdgsddgdsgdg', '2019-04-02 23:23:52', 12),
(6, 6, 'fhdfhdfh', 'dfhfhfdh', '2019-04-02 23:27:54', 11),
(7, 1, 'jhvjhvjhv', 'mhvj,hvjlhvljk', '2019-04-03 14:09:17', 26),
(8, 1, '.jdgdddddddddddddddddddddddddfdfdgdddddddddddddddddddddddddfdf', 'dgdddddddddddddddddddddddddfdfdgdddddddddddddddddddddddddfdfdgdddddddddddddddddddddddddfdfdgdddddddddddddddddddddddddfdfdgdddddddddddddddddddddddddfdfdgdddddddddddddddddddddddddfdfdgdddddddddddddddddddddddddfdfdgdddddddddddddddddddddddddfdfdgdddddddddddddddddddddddddfdfdgdddddddddddddddddddddddddfdfdgdddddddddddddddddddddddddfdfdgdddddddddddddddddddddddddfdfdgdddddddddddddddddddddddddfdfdgdddddddddddddddddddddddddfdfdgdddddddddddddddddddddddddfdfdgdddddddddddddddddddddddddfdf', '2019-04-03 14:09:44', 83);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(255) NOT NULL DEFAULT 'default_profile.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `profile_image`) VALUES
(1, 'doron', 'doron@gmail.com', '$2y$10$NMe.r.8Ho7HjpgOddWr.duYYIoBm83vDijjLoOeaUyQuDZdjpf6H6', '2019.04.03.12.04.08.000000--bluto.png'),
(2, 'dana', 'dana@gmail.com', '$2y$10$/DdrZqOSRfQ8GST/rmqOT.KPzYkvThEsyXqhs7ZR7n6KCXUJZZbIG', 'default_profile.png'),
(3, 'rom', 'rom@gmail.com', '$2y$10$BNwOEgwmktZhGa8Qwvf6U.8DR4NnqdbYVEisIEe/GeDP0wC9DaCdi', '2019.04.03.20.04.57.000000-popeye.jpg'),
(4, 'oz', 'oz@gmail.com', '$2y$10$uNNxy/EUrNF1D6QbhLpd7.Esd3jpBt7WCqLpa4/HLnH2e3ZaY6pKK', 'default_profile.png'),
(5, 'dani', 'dani@gmail.com', '$2y$10$p8BObnXUXMiJtnPuSKKlIup8VFgnmb8R0vqWNS6adCcoNKpzGLBiS', 'default_profile.png'),
(6, 'dan', 'dan@gmaiil.com', '$2y$10$.dj0lPeng5wj1sMzpapzouOxr4ePeyTdG2d0HjyP0snZyKzA7Y5lK', '2019.04.02.22.04.27.000000-thailand-ancient-architecture-2070485.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
