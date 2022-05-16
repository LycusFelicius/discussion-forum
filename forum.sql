-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2022 at 09:31 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment_to_post`
--

CREATE TABLE `comment_to_post` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `date` text NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment_to_post`
--

INSERT INTO `comment_to_post` (`id`, `post_id`, `content`, `date`, `user_id`) VALUES
(27, 17, 'Es dir mir gut, dankee!', '16:37 2022/05/11', 25),
(28, 18, 'Halloo, es dir mir gut, dankee!', '16:53 2022/05/11', 18),
(29, 18, 'Suntikan apa yang tinggal dikit padahal belum sampe setengah?', '17:35 2022/05/11', 26);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `category` text NOT NULL,
  `date` text NOT NULL,
  `total_resp` int(11) NOT NULL,
  `last_resp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `user_id`, `content`, `category`, `date`, `total_resp`, `last_resp`) VALUES
(18, 'Haiiii!', 18, '<p>Halo alle, gute nacht, wie geht es dir?</p>\r\n', 'Diskusi', '16:05 2022/05/11', 6, '02:07 2022/05/12');

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `date` text NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`id`, `post_id`, `comment_id`, `content`, `date`, `user_id`) VALUES
(21, 18, 28, 'Bitteschön :)', '16:54 2022/05/11', 4),
(22, 18, 29, 'apa tuhh', '00:43 2022/05/12', 4),
(23, 18, 29, 'Suntikan dana', '02:04 2022/05/12', 26),
(24, 18, 29, 'masuk akal', '02:07 2022/05/12', 18);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `score`, `admin`) VALUES
(4, 'lycusfelicius', 'nalaa@nsa', '$2y$10$ney6hkoYEavjZWPLKsKuueYwOLINtWjcToTzBZ04hOuMcd.XMPlN2', 3, 1),
(18, 'yogarn', 'yogaradityan@gmail.com', '$2y$10$rW5pmmX2B9HzGTk5HV.qJukX5xzMDMT5QLSu76vjjbR7WdFICFM9i', 24, 0),
(26, 'Apalo', 'diktagalaksi14@gmail.com', '$2y$10$YGRIGXHqn5X4T8ap0bg3GeCdaEZpR2Sy314iOvZgK8Tqbmd0qpFIm', 2, 0),
(27, 'Adiraadr_', 'pramesti.dira.andari@gmail.com', '$2y$10$py5IHvmqLgI61iriyuGVGe6dO3YR0G2KDEJALkzv8.iD.eDW0OcGu', 0, 0),
(28, 'Rrell.', 'ravenassyarif2105@gmail.com', '$2y$10$WYQxHNUGBLrE0wDvC6gN4OWTTyiXYGLBjWyGZeLVmqRtxloea9bmG', 1, 0),
(29, 'Gtw gw', 'serlyymel@gmail.com', '$2y$10$GoONyFtbR7UKDhHIVlM9eeK2xK2kR27UGGW6lQUNXDzW5ycB74ArO', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment_to_post`
--
ALTER TABLE `comment_to_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment_to_post`
--
ALTER TABLE `comment_to_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
