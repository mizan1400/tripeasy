-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2019 at 05:19 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `videon_demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin@admin.comvddf', '$2y$10$BA/uLRWVWRriCBNwxqmCG.ER0A2UGE61aWXGciYekc6crCohZ4gTG');

-- --------------------------------------------------------

--
-- Table structure for table `admob`
--

CREATE TABLE `admob` (
  `id` int(11) NOT NULL,
  `banner_id` varchar(100) NOT NULL,
  `banner_unit_id` varchar(100) NOT NULL,
  `interstitial_id` varchar(100) NOT NULL,
  `interstitial_unit_id` varchar(100) NOT NULL,
  `video_id` varchar(100) NOT NULL,
  `video_unit_id` varchar(100) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admob`
--

INSERT INTO `admob` (`id`, `banner_id`, `banner_unit_id`, `interstitial_id`, `interstitial_unit_id`, `video_id`, `video_unit_id`, `admin_id`) VALUES
(1, 'rgrgdvvdnnnhngbbbbbngngvd', 'ngggggggggggg', 'cdcdgrttngnng', '1uuubbb', '1yyhgtgtngng', '1fdfebbbbbbngng', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `image_name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `image_name`, `status`, `admin_id`) VALUES
(3, 'y6y6', '1.PNG', 1, 1),
(4, 'cssc', '5ukfabs13wg00s0w.PNG', 2, 1),
(5, 'cssc', '5c541b9a07673.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `push_notification`
--

CREATE TABLE `push_notification` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `push_notification`
--

INSERT INTO `push_notification` (`id`, `title`, `message`, `admin_id`) VALUES
(5, 'eee', 'eeee', 1),
(17, 'grrg', 'grrg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `banner_ad` int(1) NOT NULL,
  `interstitial_ad` int(1) NOT NULL,
  `video_ad` int(1) NOT NULL,
  `api_token` varchar(100) NOT NULL,
  `popular_view_count` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `banner_ad`, `interstitial_ad`, `video_ad`, `api_token`, `popular_view_count`, `admin_id`) VALUES
(2, 1, 1, 2, 'www', 444434444, 1);

-- --------------------------------------------------------

--
-- Table structure for table `site_config`
--

CREATE TABLE `site_config` (
  `id` int(11) NOT NULL,
  `image_name` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `tag_line` varchar(100) NOT NULL,
  `firebase_auth` text NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_config`
--

INSERT INTO `site_config` (`id`, `image_name`, `title`, `tag_line`, `firebase_auth`, `admin_id`) VALUES
(1, '1_3.PNG', 'cssc', 'cscs', 'ngggggggggggg ddcsschth', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `type` int(11) NOT NULL,
  `social_id` varchar(50) NOT NULL,
  `verification_token` varchar(10) NOT NULL,
  `status` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `type`, `social_id`, `verification_token`, `status`, `admin_id`) VALUES
(1, ' username', ' email', '$2y$10$Dn/lPg4yLtcbEaDgtQQDIevGtYWFulKtv9JcW9m.r8UYX7P.NyLSy', 1, 'ss', '', 0, 0),
(2, ' username', ' email', '$2y$10$sjlV9iUp89rF1/0ccuYymuuvnbyaiUrxK5NHBq/8Kk1g7qjYc1F4K', 1, 'ss', '', 0, 0),
(3, ' username', ' email', '$2y$10$F4J2oZRwTsGItj.xsBCqH.PK/iZyJEeqonsuEAZq4fyVVjMCfvzPW', 1, 'ss', '', 0, 0),
(4, ' username', ' email', '$2y$10$iKcwpZYyKjIq/pXuD05v4evSN/fZdzMNBsgJhvd03sLmp1yOuMt5a', 1, '', '', 0, 0),
(5, ' username', ' email', '$2y$10$8PsQTMaF7Tv3EqGow8AK0O9iiDbSf21F5O.IRk3Ep2RsnCHnFEPUG', 1, '', '', 0, 0),
(6, ' username', ' email', '$2y$10$yFK3jG46shqRRsY9vlfLKO.VjZ1haGMI01pE44MqMxyEnbrchuRMe', 2, '', '', 0, 0),
(7, 'username', 'email', '$2y$10$VIdmIFJye6L7mQ00mxx6Q.8JiqfllR4lgDX3UqW8FW8wAYBooKJwS', 2, 'fefe', '', 0, 0),
(8, 'username', 'email', '$2y$10$C51MF1N62E5OnoKYjkGYy.NcbE7Bbk4RYB4my8L6x6TlKebTApfXu', 2, 'fefefefe', '', 0, 0),
(9, 'e', 'w', '$2y$10$yGDYlg/htF7olA72IN6Tv.JNnBQfIkyrN8FlkNA8qf.omDAD8IIMG', 1, '', '', 0, 0),
(10, 'e', 'w', '$2y$10$2mcz7GEPdW5I7r34yJI//.LGjZ.XnC.hyggsrWqiPYf.ukeHVaCyK', 1, '', '', 0, 0),
(11, 'e', 'w', '$2y$10$BjifdWpW89.wkxBs/8pkc.KG0ulOFM6tuXAE/pYeN4j/CLs13gv4y', 1, '', '', 0, 0),
(12, 'e', 'qq', '$2y$10$s8knwvCxZKHD6Pr5BOA/Z.lCEGSWIaNsYkp8MDItew9Uzo7t/TY3q', 1, '', '', 0, 2),
(13, 'e', 'qq', '$2y$10$6Ufim8dv2IKDbrt.OMvPpuEYxxWdxaTJ982bw1tVUAD/wqVRsO.YC', 1, '', '', 0, 1),
(14, 'e', 'qqq', '$2y$10$MJVHtF3MB.FJt2I5sIz9x.CIeu9jB6rBbU.EfM4NaH45y7iEs69bC', 1, '', '', 0, 1),
(15, 'e', 'qqqq', '$2y$10$UChxe8okMdsg8sOnmHilZO5rjZYiPdAlwvdUM/X8UQcMKewaAdcfC', 1, '', '', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admob`
--
ALTER TABLE `admob`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `push_notification`
--
ALTER TABLE `push_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_config`
--
ALTER TABLE `site_config`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admob`
--
ALTER TABLE `admob`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `push_notification`
--
ALTER TABLE `push_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `site_config`
--
ALTER TABLE `site_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
