-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2021 at 01:11 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poktube`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` varchar(255) NOT NULL,
  `commentid` int(11) NOT NULL,
  `comment` text NOT NULL,
  `user` text NOT NULL,
  `date` text NOT NULL,
  `hidden` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registeredon` text NOT NULL,
  `profpic` text NOT NULL,
  `aboutme` text NOT NULL,
  `prof_name` text NOT NULL,
  `prof_age` text NOT NULL,
  `prof_city` text NOT NULL,
  `prof_hometown` text NOT NULL,
  `prof_country` text NOT NULL,
  `prof_occupation` text NOT NULL,
  `prof_interests` text NOT NULL,
  `prof_music` text NOT NULL,
  `prof_books` text NOT NULL,
  `prof_movies` text NOT NULL,
  `prof_website` text NOT NULL,
  `featured_vid` varchar(255) NOT NULL,
  `recent_vid` varchar(255) NOT NULL,
  `videos_watched` int(11) NOT NULL,
  `subscribers` int(11) NOT NULL,
  `videos` int(11) NOT NULL,
  `channel_color` varchar(255) NOT NULL,
  `channel_bg` text NOT NULL,
  `brandingpic` text NOT NULL,
  `brandingurl` text NOT NULL,
  `is_partner` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `videodb`
--

CREATE TABLE `videodb` (
  `VideoID` varchar(255) NOT NULL,
  `VideoName` text NOT NULL,
  `VideoDesc` text NOT NULL,
  `Uploader` text NOT NULL,
  `UploadDate` text NOT NULL,
  `ViewCount` int(11) NOT NULL,
  `VideoCategory` text NOT NULL,
  `VideoFile` text NOT NULL,
  `HQVideoFile` text NOT NULL,
  `CustomThumbnail` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
