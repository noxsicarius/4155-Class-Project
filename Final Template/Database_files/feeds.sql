-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2014 at 03:18 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `a_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `feeds`
--

CREATE TABLE IF NOT EXISTS `feeds` (
`FeedID` int(11) NOT NULL,
  `FeedDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `FeedTitle` varchar(60) NOT NULL,
  `FeedAuthor` varchar(100) NOT NULL,
  `FeedContant` text NOT NULL,
  `FeedShow` int(11) DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `feeds`
--

INSERT INTO `feeds` (`FeedID`, `FeedDate`, `FeedTitle`, `FeedAuthor`, `FeedContant`, `FeedShow`) VALUES
(37, '2014-12-01 01:16:10', 'update', 'update', 'update', 1),
(38, '2014-12-03 01:24:57', 'Feed One', 'Asif Subhan', 'this should first feed from webiste', 1),
(42, '2014-12-03 01:53:51', 'Asif Subhan', 'Asif Subhan', 'this should first feed from webiste', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feeds`
--
ALTER TABLE `feeds`
 ADD PRIMARY KEY (`FeedID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feeds`
--
ALTER TABLE `feeds`
MODIFY `FeedID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
