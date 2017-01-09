-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 08, 2017 at 09:19 PM
-- Server version: 10.0.28-MariaDB-0+deb8u1
-- PHP Version: 5.6.29-0+deb8u1

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`category_id` int(20) unsigned NOT NULL,
  `category_type_id` int(20) unsigned NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_slug` varchar(100) NOT NULL,
  `category_parent_id` int(20) unsigned NOT NULL,
  `category_root_id` int(20) unsigned NOT NULL,
  `category_level` int(3) unsigned NOT NULL,
  `category_active` int(3) unsigned NOT NULL
) ENGINE=InnoDB;

--
-- RELATIONS FOR TABLE `category`:
--   `category_type_id`
--       `category_type` -> `category_type_id`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`category_id`), ADD UNIQUE KEY `category_slug` (`category_slug`), ADD KEY `category_parent_id` (`category_parent_id`,`category_active`), ADD KEY `category_type_id` (`category_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `category_id` int(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
ADD CONSTRAINT `fk_category_type_id` FOREIGN KEY (`category_type_id`) REFERENCES `category_type` (`category_type_id`);
SET FOREIGN_KEY_CHECKS=1;
