-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 18, 2022 at 02:33 PM
-- Server version: 10.5.12-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id18794961_forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment_to_post`
--

CREATE TABLE `comment_to_post` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `date` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment_to_post`
--

INSERT INTO `comment_to_post` (`id`, `post_id`, `content`, `date`, `user_id`) VALUES
(27, 17, 'Es dir mir gut, dankee!', '16:37 2022/05/11', 25),
(28, 18, 'Halloo, es dir mir gut, dankee!', '16:53 2022/05/11', 18),
(29, 18, 'Suntikan apa yang tinggal dikit padahal belum sampe setengah?', '17:35 2022/05/11', 26),
(31, 18, 'yaaa', '10:57 2022/05/16', 18),
(32, 20, 'ya benar, kalian hrs smgt', '11:05 2022/05/16', 30),
(33, 21, 'syap', '11:08 2022/05/16', 18),
(34, 22, 'yhh', '05:22 2022/05/18', 18);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `category` text DEFAULT NULL,
  `date` text DEFAULT NULL,
  `total_resp` int(11) DEFAULT NULL,
  `last_resp` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `user_id`, `content`, `category`, `date`, `total_resp`, `last_resp`) VALUES
(18, 'Haiiii!', 18, '<p>Halo alle, gute nacht, wie geht es dir?</p>\r\n', 'Diskusi', '16:05 2022/05/11', 7, '10:57 2022/05/16'),
(20, 'Haloo, besok uh 3 mapel yaa', 18, '<p>haii, jgn lupa ya guys besok uh 3 mapel</p>\r\n', 'Menfess', '11:05 2022/05/16', 2, '11:07 2022/05/16'),
(21, 'Minggu depan PAT semester 3', 18, '<p>jgn lupa belajar y gais, mingdep udh pat</p>\r\n', 'Menfess', '11:05 2022/05/16', 1, '11:08 2022/05/16'),
(22, 'Bangsta', 32, '<p>Sejujurnya aku dah lama suka ama kmu,cinta bat dari kls 4 sd. Jeon jungkook,tunggu aku di koren:)</p>\r\n', 'Menfess', '02:05 2022/05/18', 1, '05:22 2022/05/18');

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `date` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`id`, `post_id`, `comment_id`, `content`, `date`, `user_id`) VALUES
(21, 18, 28, 'Bitteschön :)', '16:54 2022/05/11', 4),
(22, 18, 29, 'apa tuhh', '00:43 2022/05/12', 4),
(23, 18, 29, 'Suntikan dana', '02:04 2022/05/12', 26),
(24, 18, 29, 'masuk akal', '02:07 2022/05/12', 18),
(27, 20, 32, 'tch', '11:07 2022/05/16', 18);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `score`, `admin`) VALUES
(4, 'lycusfelicius', 'nalaa@nsa', '$2y$10$ney6hkoYEavjZWPLKsKuueYwOLINtWjcToTzBZ04hOuMcd.XMPlN2', 3, 1),
(18, 'yogarn', 'yogaradityan@gmail.com', '$2y$10$rW5pmmX2B9HzGTk5HV.qJukX5xzMDMT5QLSu76vjjbR7WdFICFM9i', 28, 0),
(26, 'Apalo', 'diktagalaksi14@gmail.com', '$2y$10$YGRIGXHqn5X4T8ap0bg3GeCdaEZpR2Sy314iOvZgK8Tqbmd0qpFIm', 2, 0),
(27, 'Adiraadr_', 'pramesti.dira.andari@gmail.com', '$2y$10$py5IHvmqLgI61iriyuGVGe6dO3YR0G2KDEJALkzv8.iD.eDW0OcGu', 0, 0),
(28, 'Rrell.', 'ravenassyarif2105@gmail.com', '$2y$10$WYQxHNUGBLrE0wDvC6gN4OWTTyiXYGLBjWyGZeLVmqRtxloea9bmG', 1, 0),
(29, 'Gtw gw', 'serlyymel@gmail.com', '$2y$10$GoONyFtbR7UKDhHIVlM9eeK2xK2kR27UGGW6lQUNXDzW5ycB74ArO', 0, 0),
(30, 'admin', 'admin@nsa', '$2y$10$JKwPQa3Aw/LuHGlgRLJzFOY.QXuHGIcFEXbnAW64z0f4FOmldriy.', 1, NULL),
(31, 'zeyra', 'zeyrahmalivia@gmail.com', '$2y$10$0Y2bkJ4aLMbms8.PB3/PTOwyCwXkcZy8AFyhOU1JcuciLc8z8bv/a', NULL, NULL),
(32, 'Diluar naral', 'zyzyx@gmail.com', '$2y$10$tfTTHnEZ/mrnNkOwVWx.pupLL/T1dtgi8leslM.lDddF9kZDNbWmW', NULL, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
