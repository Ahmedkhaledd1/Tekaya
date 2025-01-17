-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 18, 2024 at 10:45 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tekaya_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `address_id` int NOT NULL AUTO_INCREMENT,
  `street` varchar(255) DEFAULT NULL, -- Added column
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zipcode` varchar(10) DEFAULT NULL,
  `parent_address_id` int DEFAULT NULL,
  PRIMARY KEY (`address_id`),
  KEY `parent_address_id` (`parent_address_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `street`, `city`, `state`, `zipcode`, `parent_address_id`) VALUES
(1, NULL, 'New York', 'NY', '10001', NULL),
(2, NULL, 'Los Angeles', 'CA', '90001', NULL),
(3, NULL, 'Chicago', 'IL', '60601', NULL),
(4, NULL, 'Brooklyn', 'NY', '11201', 1),
(5, NULL, 'Beverly Hills', 'CA', '90210', 2);

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

DROP TABLE IF EXISTS `donation`;
CREATE TABLE IF NOT EXISTS `donation` (
  `donation_id` int NOT NULL AUTO_INCREMENT,
  `donor_id` int DEFAULT NULL,
  `beneficiary_id` int DEFAULT NULL,
  `volunteer_id` int DEFAULT NULL, -- Added column
  `delivered` tinyint(1) DEFAULT NULL, -- Added column
  `state` ENUM('NotAssignedToBenefeciary', 'AssignedToBenefeciary', 'ReadyWithVolunteer', 'PendingBenefeciaryConfirm', 'ConfirmedByBenefeciary') DEFAULT 'NotAssignedToBenefeciary', -- Added column
  PRIMARY KEY (`donation_id`),
  KEY `donor_id` (`donor_id`),
  KEY `beneficiary_id` (`beneficiary_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `donation`
--

INSERT INTO `donation` (`donation_id`, `donor_id`, `beneficiary_id`, `volunteer_id`, `delivered`, `state`) VALUES
(1, 1, 2, NULL, 0, 'NotAssignedToBenefeciary'),
(2, 2, 1, NULL, 1, 'ConfirmedByBenefeciary'),
(3, 3, 2, NULL, 0, 'PendingBenefeciaryConfirm');

-- --------------------------------------------------------

--
-- Table structure for table `donationdetails`
--

DROP TABLE IF EXISTS `donationdetails`;
CREATE TABLE IF NOT EXISTS `donationdetails` (
  `donation_details_id` int NOT NULL AUTO_INCREMENT,
  `donation_id` int DEFAULT NULL,
  `foodtype` tinyint(1) DEFAULT NULL,
  `food_item_id` int DEFAULT NULL,
  PRIMARY KEY (`donation_details_id`),
  KEY `donation_id` (`donation_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `donationdetails`
--

INSERT INTO `donationdetails` (`donation_details_id`, `donation_id`, `foodtype`, `food_item_id`) VALUES
(1, 1, 1, 1),
(2, 1, 0, 1),
(3, 2, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `foodset`
--

DROP TABLE IF EXISTS `foodset`;
CREATE TABLE IF NOT EXISTS `foodset` (
  `food_set_id` int NOT NULL AUTO_INCREMENT,
  `description` text,
  `cost` decimal(10,2) NOT NULL,
  `paid` tinyint(1) DEFAULT NULL, -- Added column
  PRIMARY KEY (`food_set_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `foodset`
--

INSERT INTO `foodset` (`food_set_id`, `description`, `cost`, `paid`) VALUES
(1, 'Basic Food Set - Rice, Meat, Oil', 15.00, 0),
(2, 'Deluxe Food Set - Rice, Meat, Oil, Vegetables', 25.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `freshmeal`
--

DROP TABLE IF EXISTS `freshmeal`;
CREATE TABLE IF NOT EXISTS `freshmeal` (
  `fresh_meal_id` int NOT NULL AUTO_INCREMENT,
  `expiry_date` datetime NOT NULL,
  PRIMARY KEY (`fresh_meal_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `freshmeal`
--

INSERT INTO `freshmeal` (`fresh_meal_id`, `expiry_date`) VALUES
(1, '2024-12-31 00:00:00'),
(2, '2024-11-15 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `individual`
--

DROP TABLE IF EXISTS `individual`;
CREATE TABLE IF NOT EXISTS `individual` (
  `ssn` varchar(20) NOT NULL,
  `user_id` int DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ssn`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `individual`
--

INSERT INTO `individual` (`ssn`, `user_id`, `first_name`, `last_name`, `gender`) VALUES
('123-45-6789', 1, 'John', 'Doe', 1),
('987-65-4321', 2, 'Jane', 'Doe', 0),
('547647868', 20, 'zeft', 'rat', 1);

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

DROP TABLE IF EXISTS `organization`;
CREATE TABLE IF NOT EXISTS `organization` (
  `tax_number` varchar(20) NOT NULL,
  `user_id` int DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `orgtype` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`tax_number`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`tax_number`, `user_id`, `title`, `orgtype`) VALUES
('TAX123456', 3, 'Charity Org', 'Non-Profit'),
('5464646', 19, 'man', 'restaurant');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(191) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address_id` int DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `address_id` (`address_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `address_id`, `mobile`, `role`) VALUES
(1, 'johndoe@example.com', 'password123', 1, '123-456-7890', 'Individual'),
(2, 'janedoe@example.com', 'password123', 2, '234-567-8901', 'Individual'),
(3, 'charity@example.com', 'securepass', 3, '345-678-9012', 'Organization'),
(19, 'youssef.mahmoud.eng@gmail.com', '123', NULL, '01017261198', 'Organization'),
(20, 'zef@gmail.com', '123', NULL, '01017261198', 'Beneficiary');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
