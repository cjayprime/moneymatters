-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 14, 2019 at 12:41 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moneymatters`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `access` varchar(9) NOT NULL,
  `title` varchar(12) NOT NULL,
  `page` varchar(12) NOT NULL,
  `country` json NOT NULL,
  `currency` json NOT NULL,
  `symbol` json NOT NULL,
  `images` json NOT NULL,
  `category` json NOT NULL,
  `type` json NOT NULL,
  `amenities` json NOT NULL,
  `facilities` json NOT NULL,
  `rating` json NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `password`, `access`, `title`, `page`, `country`, `currency`, `symbol`, `images`, `category`, `type`, `amenities`, `facilities`, `rating`) VALUES
(1, 'nnachijioke@yahoo.com', '1a1dc91c907325c69271ddf0c944bc72', 'root', 'admin', 'settings', '[\"Nigeria\", \"United States of America\", \"United Kingdom\"]', '{\"EUR\": \"1.13\", \"GBP\": \"0.77\", \"NGN\": \"365\", \"USD\": \"1\"}', '{\"EUR\": \"€\", \"GBP\": \"£\", \"NGN\": \"₦\", \"USD\": \"$\"}', 'null', 'null', 'null', 'null', 'null', 'null'),
(2, 'property@moneymatters.com.ng', '%%%%%%%%%%%%%%%%%%', 'system', 'moneymatters', 'property', 'null', 'null', 'null', 'null', 'null', '[\"Bungalow\", \"Duplex\"]', '[\"Essentials\", \"Washer\", \"Elevator\", \"Buzzer/wireless intercom\", \"Cable TV\", \"Washer\"]', '[\"Essentials\", \"Washer\", \"Elevator\", \"Buzzer/wireless intercom\", \"Cable TV\", \"Washer\", \"Radio\"]', 'null'),
(3, 'wedding@moneymatters.com.ng', '%%%%%%%%%%%%%%%%%%', 'system', 'moneymatters', 'wedding', 'null', 'null', 'null', 'null', '[\"Videographer\", \"DJ\", \"Security\", \"Caterer\", \"Venue\", \"Photographer\", \"Makeup Artist\", \"MC\"]', 'null', 'null', 'null', '[5, 4, 3, 2, 1]'),
(4, 'insurance@moneymatters.com.ng', '%%%%%%%%%%%%%%%%%%', 'system', 'moneymatters', 'insurance', 'null', 'null', 'null', 'null', '[\"All Risks Insurance\", \"Householders/Homeowners\' Insurance\", \"Fire & Special Perils Insurance\", \"Burglary or Theft Insurance\", \"Life Assurance\", \"Personal Accident Insurance\", \"Motor Insurance\", \"Travel Insurance\"]', '{\"Life Assurance\": {\"max\": 70, \"min\": 20}, \"Motor Insurance\": {\"Third Party Only\": [\"Private motor car\", \"Own Goods Only\", \"Heavy Duty\"], \"Comprehensive Cover\": [\"Private motor policy\", \"Commercial\", \"Commercial vehicle bus (omnibus)\", \"Commercial vehicle (taxi & buses)\", \"Motorcycle\", \"Ambulance & Sp. Vehicle\", \"Motor Trade - road risk\", \"Motor Trade - premises risk\", \"Combined risks\"]}, \"Travel Insurance\": {\"Schengen\": [\"Travel: age(3333 months - 71 years), (32 - 61 Days) (schengen)\", \"Travel: age(3 months - 71 years), (93 - 180 Days) (schengen)\", \"Travel: age(3 months - 71 years), (1 year) (schengen)\", \"Travel: age(72 - 75 years), (1 - 3 Days) (schengen)\", \"Travel: age(72 - 75 years), (16 - 31 Days) (schengen)\", \"Travel: age(72 - 75 years), (7 - 15 Days) (schengen)\", \"Travel: age(72 - 75 years), (4 - 6 Days) (schengen)\", \"Travel: age(72 - 75 years), (1 Year) (schengen)\", \"Travel: age(72 - 75 years), (62 - 92 Days) (schengen)\", \"Travel: age(72 - 75 years), (32 - 61 Days) (schengen)\", \"Travel: age(72 - 75 years), (93 - 180 Days) (schengen)\", \"Travel: age(76 - 80 years), (7 - 15 Days) (schengen)\", \"Travel: age(3 months - 71 years), (16 - 31 Days) (schengen)\", \"Travel: age(76 - 80 years), (1 - 3 Days) (schengen)\", \"Travel: age(76 - 80 years), (4 - 6 Days) (schengen)\", \"Travel: age(76 - 80 years), (32 - 61 Days) (schengen)\", \"Travel: age(76 - 80 years), (62 - 92 Days) (schengen)\", \"Travel: age(76 - 80 years), (16 - 31 Days) (schengen)\", \"Travel: age(76 - 80 years), (1 Year) (schengen)\", \"Travel: age(76 - 80 years), (93 - 180 Days) (schengen)\", \"Travel: age(3 months - 71 years), (62 - 92 Days) (schengen)\", \"Travel: age(3 months - 71 years), (7 - 15 Days) (schengen)\", \"Travel: age(3 months - 71 years), (4 - 6 Days) (schengen)\", \"Travel: age(3 months - 71 years), (1 - 3 Days) (schengen)\"], \"Non-schengen\": [\"Travel: age(3 months - 71 years), (62 - 92 Days) (non-schengen)\", \"Travel: age(3 months - 71 years), (16 - 31 Days) (non-schengen)\", \"Travel: age(3 months - 71 years), (4 - 6Days) (non-schengen)\", \"Travel: age(3 months - 71 years), (1 - 3 Days) (non-schengen)\", \"Travel: age(3 months - 71 years), (7 - 15 Days) (non-schengen)\", \"Travel: age(3 months - 71 years), (32 - 61 Days) (non-schengen)\", \"Travel: age(3 months - 71 years), (ANNUAL (MULTI TRIP)) (non-schengen)\", \"Travel: age(3 months - 71 years), (93 - 180 Days) (non-schengen)\", \"Travel: age(72- 75 years), (1 - 3 Days) (non-schengen)\", \"Travel: age(72- 75 years), (32 - 61 Days) (non-schengen)\", \"Travel: age(76- 80 years), (4 - 6 Days) (non-schengen)\", \"Travel: age(72- 75 years), (4 - 6 Days) (non-schengen)\", \"Travel: age(72- 75 years), (7 - 15 Days) (non-schengen)\", \"Travel: age(72- 75 years), (16 - 31 Days) (non-schengen)\", \"Travel: age(72- 75 years), (93 - 180 Days) (non-schengen)\", \"Travel: age(72- 75 years), (ANNUAL(MULTI TRIP)) (non-schengen)\", \"Travel: age(72- 75 years), (62 - 92 Days) (non-schengen)\", \"Travel: age(76- 80 years), (1 - 3 Days) (non-schengen)\", \"Travel: age(76- 80 years), (7 - 15 Days) (non-schengen)\", \"Travel: age(76- 80 years), (16 - 31 Days) (non-schengen)\", \"Travel: age(76- 80 years), (32 - 61 Days) (non-schengen)\", \"Travel: age(76- 80 years), (62 - 92 Days) (non-schengen)\", \"Travel: age(76- 80 years), (93 - 180 Days) (non-schengen)\", \"Travel: age(76- 80 years), (ANNUAL(MULTI TRIP)) (non-schengen)\"]}, \"All Risks Insurance\": [\"Phones\", \"Laptops\", \"Jewelleries\"], \"Burglary or Theft Insurance\": [\"Building & Contents\", \"Moveable Plant and Machinery\", \"Stock\", \"Office Furniture\", \"Fittings and Utensils\", \"Office Equipment\", \"Fixtures\"], \"Personal Accident Insurance\": [\"All accidents\", \"Occupational accident\"], \"Fire & Special Perils Insurance\": [\"Special Perils\", \"Building & Contents\"], \"Householders/Homeowners\' Insurance\": [\"Phones\", \"Laptops\", \"Jewelleries\", \"Cameras\"]}', 'null', 'null', 'null'),
(5, 'finance@moneymatters.com.ng', '%%%%%%%%%%%%%%%%%%', 'system', 'moneymatters', 'finance', 'null', 'null', 'null', 'null', 'null', '[\"Savings\", \"Mortgages\", \"Current Accounts\", \"Business Finance\", \"Travel Money\", \"Foreign Transfers\", \"Prepaid Cards\", \"Charge Cards\", \"New cards\", \"Costs\"]', 'null', 'null', 'null'),
(6, 'event@moneymatters.com.ng', '%%%%%%%%%%%%%%%%%%', 'system', 'moneymatters', 'event', 'null', 'null', 'null', 'null', '[\"Workshop\", \"Concert\", \"Art\", \"Food & Drink\", \"Nature\", \"History\", \"Entertainment\", \"Nightlife\", \"Theatre\"]', 'null', 'null', 'null', 'null'),
(7, 'superroot', '%%%%%%%%%%%%%%%%%%', 'superroot', 'greyloft', 'controlpanel', '[\"Nigeria\", \"United States of America\", \"United Kingdom\"]', '{\"EUR\": \"1.13\", \"GBP\": \"0.77\", \"NGN\": \"365\", \"USD\": \"1\"}', '{\"EUR\": \"€\", \"GBP\": \"£\", \"NGN\": \"₦\", \"USD\": \"$\"}', 'null', 'null', 'null', 'null', 'null', 'null');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `booking_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `vendor_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `type_id` bigint(20) NOT NULL,
  `type` varchar(9) NOT NULL,
  `category` longtext NOT NULL,
  `processor` varchar(8) NOT NULL,
  `transaction_id` text NOT NULL,
  `currency` varchar(3) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `receipt` longtext NOT NULL,
  `details` json NOT NULL,
  `status` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`booking_id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `vendor_id`, `user_id`, `type_id`, `type`, `category`, `processor`, `transaction_id`, `currency`, `rate`, `amount`, `fee`, `receipt`, `details`, `status`, `date`) VALUES
(1, 1, 1, 1, 'hotel', '', 'paystack', '1xsedsijijijija', 'NGN', '365.43', '13.00', '45.00', '', '{\"checkin\": \"2019-03-01 00:08:00\", \"checkout\": \"2019-03-30 00:08:00\"}', 0, '2019-03-30 00:08:00'),
(2, 1, 1, 1, 'travel', '', 'paystack', '1xsedsijijijija', 'NGN', '365.43', '127.50', '2.00', '', '{\"arrival\": \"2019-03-01 00:08:00\", \"departure\": \"2019-03-30 00:08:00\"}', 0, '2019-03-28 00:08:00'),
(3, 1, 1, 1, 'travel', '', 'paystack', '1xsedsijijijija', 'GBP', '0.77', '56.25', '1.00', '', '{\"arrival\": \"2019-03-01 00:08:00\", \"departure\": \"2019-03-30 00:08:00\"}', 1, '2019-03-29 00:08:00'),
(4, 1, 1, 1, 'finance', '', 'paystack', '1xsedsijijijija', 'NGN', '365.43', '1.00', '34.45', '', '[]', -1, '2019-03-29 00:08:00'),
(5, 1, 1, 1, 'finance', '', 'paystack', '1xsedsijijijija', 'GHC', '5.15', '1.00', '6.00', '', '[]', 1, '2019-03-29 00:08:00'),
(6, 1, 1, 1, 'insurance', '', 'paystack', '1xsedsijijijija', 'NGN', '365.43', '1.00', '1.00', '', '[]', -1, '2019-03-29 00:08:00'),
(7, 1, 1, 1, 'insurance', '', 'paystack', '1xsedsijijijija', 'USD', '1.00', '1234.56', '12.00', '', '[]', 1, '2019-03-24 00:08:00'),
(8, 1, 1, 1, 'wedding', '', 'paystack', '1xsedsijijijija', 'NGN', '365.43', '1.00', '1.00', '', '[]', 1, '2019-03-23 00:08:00'),
(9, 1, 1, 1, 'wedding', '', 'paystack', '1xsedsijijijija', 'NGN', '365.43', '1.00', '1.00', '', '[]', 1, '2019-03-22 00:08:00'),
(10, 1, 1, 1, 'event', '', 'paystack', '1xsedsijijijija', 'NGN', '365.43', '1.00', '1.00', '', '[]', 1, '2019-03-21 00:08:00'),
(11, 1, 1, 1, 'event', '', 'paystack', '1xsedsijijijija', 'NGN', '365.43', '1.00', '1.00', '', '[]', 1, '2019-03-20 00:08:00'),
(12, 1, 1, 1, 'property', '', 'paystack', '1xsedsijijijija', 'NGN', '365.43', '1.00', '1.00', '', '[]', 1, '2019-03-19 00:08:00'),
(13, 1, 1, 1, 'property', '', 'paystack', '1xsedsijijijija', 'NGN', '365.43', '1.00', '1.00', '', '[]', 1, '2019-03-18 00:08:00'),
(14, 1, 1, 1, 'event', '', 'paystack', '1xsedsijijijija', 'NGN', '365.43', '1.00', '1.00', '', '{\"checkin\": \"2019-03-01 00:08:00\", \"checkout\": \"2019-03-30 00:08:00\"}', 1, '2019-03-17 00:08:00'),
(15, 1, 1, 1, 'hotel', '', 'paystack', '1xsedsijijijija', 'NGN', '365.43', '1.00', '1.00', '', '{\"checkin\": \"2019-03-01 00:08:00\", \"checkout\": \"2019-03-30 00:08:00\"}', 1, '2019-03-16 00:08:00'),
(16, 1, 1, 1, 'hotel', '', 'paystack', '1xsedsijijijija', 'NGN', '365.43', '1.00', '1.00', '', '{\"checkin\": \"2019-03-01 00:08:00\", \"checkout\": \"2019-03-30 00:08:00\"}', 1, '2019-03-15 00:08:00'),
(17, 1, 1, 1, 'hotel', '', 'paystack', '1xsedsijijijija', 'NGN', '365.43', '1.00', '1.00', '', '{\"checkin\": \"2019-03-01 00:08:00\", \"checkout\": \"2019-03-30 00:08:00\"}', 1, '2019-03-14 00:08:00'),
(18, 1, 1, 1, 'hotel', '', 'paystack', '1xsedsijijijija', 'NGN', '365.43', '1.00', '1.00', '', '{\"checkin\": \"2019-03-01 00:08:00\", \"checkout\": \"2019-03-30 00:08:00\"}', 1, '2019-03-13 00:08:00'),
(19, 1, 1, 1, 'hotel', '', 'paystack', '1xsedsijijijija', 'NGN', '365.43', '317.00', '1.00', '', '{\"checkin\": \"2019-03-01 00:08:00\", \"checkout\": \"2019-03-30 00:08:00\"}', 1, '2019-03-12 00:08:00'),
(20, 1, 1, 1, 'hotel', '', 'paystack', '1xsedsijijijija', 'NGN', '365.43', '1.00', '1.00', '', '{\"checkin\": \"2019-03-01 00:08:00\", \"checkout\": \"2019-03-30 00:08:00\"}', 1, '2019-03-11 00:08:00'),
(21, 1, 1, 1, 'hotel', '', 'paystack', '1xsedsijijijija', 'NGN', '365.43', '1.00', '1.00', '', '{\"checkin\": \"2019-03-01 00:08:00\", \"checkout\": \"2019-03-30 00:08:00\"}', 1, '2019-03-10 00:08:00'),
(22, 1, 1, 1, 'hotel', '', 'paystack', '1xsedsijijijija', 'NGN', '365.43', '1.00', '1.00', '', '{\"checkin\": \"2019-03-01 00:08:00\", \"checkout\": \"2019-03-30 00:08:00\"}', 1, '2019-03-09 00:08:00'),
(23, 1, 1, 1, 'hotel', '', 'paystack', '1xsedsijijijija', 'NGN', '365.43', '1.00', '1.00', '', '{\"checkin\": \"2019-03-01 00:08:00\", \"checkout\": \"2019-03-30 00:08:00\"}', 1, '2019-03-08 00:08:00'),
(24, 1, 1, 1, 'hotel', '', 'paystack', '1xsedsijijijija', 'NGN', '365.43', '1.00', '1.00', '', '{\"checkin\": \"2019-03-01 00:08:00\", \"checkout\": \"2019-03-30 00:08:00\"}', 1, '2019-03-08 00:08:00'),
(25, 1, 1, 1, 'hotel', '', 'paystack', '1xsedsijijijija', 'NGN', '365.43', '1.00', '1.00', '', '{\"checkin\": \"2019-03-01 00:08:00\", \"checkout\": \"2019-03-30 00:08:00\"}', 1, '2019-03-07 00:08:00'),
(26, 1, 1, 1, 'hotel', '', 'paystack', '1xsedsijijijija', 'NGN', '365.43', '1.00', '1.00', '', '{\"checkin\": \"2019-03-01 00:08:00\", \"checkout\": \"2019-03-30 00:08:00\"}', 1, '2019-03-06 00:08:00'),
(27, 1, 1, 1, 'hotel', '', 'paystack', '1xsedsijijijija', 'NGN', '365.43', '1.00', '1.00', '', '{\"checkin\": \"2019-03-01 00:08:00\", \"checkout\": \"2019-03-30 00:08:00\"}', 1, '2019-03-05 00:08:00'),
(28, 1, 1, 1, 'hotel', '', 'paystack', '1xsedsijijijija', 'NGN', '365.43', '1.00', '1.00', '', '{\"checkin\": \"2019-03-01 00:08:00\", \"checkout\": \"2019-03-30 00:08:00\"}', 1, '2019-03-04 00:08:00'),
(29, 1, 1, 1, 'hotel', '', 'paystack', '1xsedsijijijija', 'NGN', '365.43', '1.00', '1.00', '', '{\"checkin\": \"2019-03-01 00:08:00\", \"checkout\": \"2019-03-30 00:08:00\"}', 1, '2019-03-03 00:08:00'),
(30, 1, 1, 1, 'hotel', '', 'paystack', '1xsedsijijijija', 'NGN', '365.43', '1.00', '2.00', '', '{\"checkin\": \"2019-03-01 00:08:00\", \"checkout\": \"2019-03-30 00:08:00\"}', 1, '2019-03-02 00:08:00'),
(31, 1, 1, 1, 'hotel', '', 'paystack', '1xsedsijijijija', 'NGN', '365.43', '2.00', '1.00', '', '{\"checkin\": \"2019-03-01 00:08:00\", \"checkout\": \"2019-03-30 00:08:00\"}', 1, '2019-03-01 00:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `event_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `vendor_id` bigint(20) NOT NULL,
  `title` longtext NOT NULL,
  `description` longtext NOT NULL,
  `category` json NOT NULL,
  `time` datetime NOT NULL,
  `guests` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `pictures` json NOT NULL,
  `country` varchar(25) NOT NULL,
  `state` varchar(25) NOT NULL,
  `city` varchar(25) NOT NULL,
  `district` varchar(25) NOT NULL,
  `full_address` longtext NOT NULL,
  `views` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `vendor_id`, `title`, `description`, `category`, `time`, `guests`, `duration`, `price`, `pictures`, `country`, `state`, `city`, `district`, `full_address`, `views`, `status`, `date`) VALUES
(1, 1, 'The after party', 'A boy was walking down the road and he picked an apple from the floor and eat it', '[\"Entertainment\", \"Nightlife\"]', '2019-03-27 00:00:00', 2, 12, '12.00', '[\"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\"]', 'Nigeria', 'Lagos', 'Shomolu', 'Backyard', 'No 23, there herqq', 1, 0, '2019-03-30 00:00:00'),
(2, 1, 'The after party', 'A boy was walking down the road and he picked an apple from the floor and eat it', '[\"Entertainment\", \"Nightlife\"]', '2019-03-27 00:00:00', 2, 12, '12.00', '[\"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\"]', 'Nigeria', 'Lagos', 'Shomolu', 'Backyard', 'No 23, there herqq', 1, 1, '2019-03-30 00:00:00'),
(3, 1, 'The after party', 'A boy was walking down the road and he picked an apple from the floor and eat it', '[\"Entertainment\", \"Nightlife\"]', '2019-03-27 00:00:00', 2, 12, '12.00', '[\"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\"]', 'Nigeria', 'Abuja', 'Shomolu', 'Backyard', 'No 23, there herqq', 1, 1, '2019-03-30 00:00:00'),
(4, 1, 'The after party', 'A boy was walking down the road and he picked an apple from the floor and eat it', '[\"Entertainment\", \"Nightlife\"]', '2019-03-27 00:00:00', 2, 12, '12.00', '[\"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\"]', 'Nigeria', 'Lagos', 'Shomolu', 'Backyard', 'No 23, there herqq', 1, 1, '2019-03-30 00:00:00'),
(5, 1, 'The after party', 'A boy was walking down the road and he picked an apple from the floor and eat it', '[\"Entertainment\", \"Nightlife\"]', '2019-03-27 00:00:00', 2, 12, '12.00', '[\"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\"]', 'Nigeria', 'Lagos', 'Shomolu', 'Backyard', 'No 23, there herqq', 1, 1, '2019-03-30 00:00:00'),
(6, 1, 'The after party', 'A boy was walking down the road and he picked an apple from the floor and eat it', '[\"Entertainment\", \"Nightlife\"]', '2019-03-27 00:00:00', 2, 12, '12.00', '[\"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\"]', 'Nigeria', 'Lagos', 'Shomolu', 'Backyard', 'No 23, there herqq', 1, 1, '2019-03-30 00:00:00'),
(7, 1, 'The after party', 'A boy was walking down the road and he picked an apple from the floor and eat it', '[\"Entertainment\", \"Nightlife\"]', '2019-03-27 00:00:00', 2, 12, '12.00', '[\"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\"]', 'Nigeria', 'Lagos', 'Shomolu', 'Backyard', 'No 23, there herqq', 1, 1, '2019-03-30 00:00:00'),
(8, 1, 'The after party', 'A boy was walking down the road and he picked an apple from the floor and eat it', '[\"Entertainment\", \"Nightlife\"]', '2019-03-27 00:00:00', 2, 12, '12.00', '[\"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\"]', 'Nigeria', 'Kaduna', 'Shomolu', 'Backyard', 'No 23, there herqq', 1, 1, '2019-03-30 00:00:00'),
(9, 1, 'The after party', 'A boy was walking down the road and he picked an apple from the floor and eat it', '[\"Entertainment\", \"Nightlife\"]', '2019-03-27 00:00:00', 2, 12, '12.00', '[\"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\"]', 'Nigeria', 'Lagos', 'Shomolu', 'Backyard', 'No 23, there herqq', 1, 1, '2019-03-30 00:00:00'),
(10, 1, 'The after party', 'A boy was walking down the road and he picked an apple from the floor and eat it', '[\"Entertainment\", \"Nightlife\"]', '2019-03-27 00:00:00', 2, 12, '12.00', '[\"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\"]', 'Nigeria', 'Lagos', 'Shomolu', 'Backyard', 'No 23, there herqq', 1, 1, '2019-03-30 00:00:00'),
(22, 1, '23', 'des', '[\"Art\", \"Nature\"]', '2019-03-29 12:00:00', 2, 4, '12.00', '[\"../vendor/storage/2/0.png\", \"../vendor/storage/2/1.png\", \"../vendor/storage/2/2.png\", \"../vendor/storage/2/3.png\", \"../vendor/storage/2/4.png\", \"../vendor/storage/2/5.png\", \"../vendor/storage/2/6.png\"]', 'Nigeria', 'sdd', 'ssde', 'dde', 'rfrfr', 0, 1, '2019-03-28 12:17:28'),
(21, 1, '23', 'des', '[\"Art\", \"Nature\"]', '2019-03-29 12:00:00', 2, 4, '12.00', '[\"../vendor/storage/2/0.png\"]', 'Nigeria', 'sdd', 'ssde', 'dde', 'rfrfr', 0, 1, '2019-03-28 12:16:40'),
(23, 1, 'ee', 'ss', '[\"History\"]', '2019-03-29 12:00:00', 2, 2, '12.00', '[\"../vendor/storage//1554894818.png\", \"../vendor/storage//1554894818.png\"]', 'United States of America', 'ddede', 'wdwd', '1', 'wdw', 0, 0, '2019-04-10 12:13:38'),
(24, 1, 'ee', 'ss', '[\"History\"]', '2019-03-29 12:00:00', 2, 2, '12.00', '[\"../vendor/storage/1/1554894853.png\", \"../vendor/storage/1/1554894853.png\"]', 'United States of America', 'ddede', 'wdwd', '1', 'wdw', 0, 0, '2019-04-10 12:14:13');

-- --------------------------------------------------------

--
-- Table structure for table `finance`
--

DROP TABLE IF EXISTS `finance`;
CREATE TABLE IF NOT EXISTS `finance` (
  `finance_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `vendor_id` bigint(20) NOT NULL,
  `type` varchar(34) NOT NULL,
  `title` longtext NOT NULL,
  `description` longtext NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `tags` longtext NOT NULL,
  `inquiry` json NOT NULL,
  `tenure` tinytext NOT NULL,
  `value` bigint(20) NOT NULL,
  `views` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`finance_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finance`
--

INSERT INTO `finance` (`finance_id`, `vendor_id`, `type`, `title`, `description`, `price`, `tags`, `inquiry`, `tenure`, `value`, `views`, `status`, `date`) VALUES
(1, 2, 'All Risks Insurance', 'ensure', 'Laptops are for coding ', '10.00', '', '[{\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}]', 'null', 0, 0, 0, '2019-03-27 00:00:00'),
(2, 1, 'All Risks Insurance', 'ensure', 'Laptops are for coding ', '152.00', '', '[{\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}]', 'null', 0, 0, 1, '2019-03-27 00:00:00'),
(3, 5, 'All Risks Insurance', 'ensure', 'Laptops are for coding ', '152.00', '', '[{\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}]', 'null', 0, 0, 1, '2019-03-27 00:00:00'),
(4, 6, 'All Risks Insurance', 'ensure', 'Laptops are for coding ', '152.00', '', '[{\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}]', 'null', 0, 0, 1, '2019-03-27 00:00:00'),
(5, 0, 'All Risks Insurance', 'ensure', 'Laptops are for coding ', '152.00', '', '[{\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}]', 'null', 0, 0, 1, '2019-03-27 00:00:00'),
(6, 0, 'All Risks Insurance', 'ensure', 'Laptops are for coding ', '152.00', '', '[{\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}]', 'null', 0, 0, 1, '2019-03-27 00:00:00'),
(7, 0, 'All Risks Insurance', 'ensure', 'Laptops are for coding ', '152.00', '', '[{\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}]', 'null', 0, 0, 1, '2019-03-27 00:00:00'),
(8, 0, 'All Risks Insurance', 'ensure', 'Laptops are for coding ', '152.00', '', '[{\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}]', 'null', 0, 0, 1, '2019-03-27 00:00:00'),
(9, 0, 'All Risks Insurance', 'ensure', 'Laptops are for coding ', '152.00', '', '[{\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}]', 'null', 0, 0, 1, '2019-03-27 00:00:00'),
(10, 0, 'All Risks Insurance', 'ensure', 'Laptops are for coding ', '152.00', '', '[{\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}]', 'null', 0, 0, 1, '2019-03-27 00:00:00'),
(11, 2, 'All Risks Insurance', '23kdk', 'ede edejdej', '2.00', 'dfkdk', '[{\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}]', '2 year(s)', 23, 0, 0, '2019-04-06 13:48:34'),
(12, 2, 'All Risks Insurance', '23kdk', 'ede edejdej', '2.00', 'dfkdk', '[{\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}]', '2 year(s)', 23, 0, 0, '2019-04-06 13:57:05'),
(13, 2, 'Savings', '2ij2i', 'eijd', '2.00', 'fjeiej', '[{\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}]', '2 year(s)', 2, 0, 0, '2019-04-06 17:40:53'),
(14, 2, 'Savings', '2ij2i', 'eijd', '2.00', 'fjeiej', '[{\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}]', '2 year(s)', 2, 0, 0, '2019-04-06 17:41:01'),
(15, 1, 'Savings', '3', '2', '2.00', '2', '[{\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}]', '2 year(s)', 1, 0, 1, '2019-04-10 10:37:31'),
(16, 1, 'Savings', '3', '2', '2.00', '2', '[{\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}, {\"date\": \"2019-03-27 13:03:00\", \"email\": \"nna@yahoo.com\", \"phone\": \"08179222327\", \"message\": \"Message Message\", \"lastname\": \"Nna\", \"firstname\": \"Chijioke\"}]', '2 year(s)', 1, 0, 0, '2019-04-10 10:37:39');

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

DROP TABLE IF EXISTS `hotel`;
CREATE TABLE IF NOT EXISTS `hotel` (
  `hotel_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`hotel_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

DROP TABLE IF EXISTS `inquiry`;
CREATE TABLE IF NOT EXISTS `inquiry` (
  `inquiry_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `firstname` longtext NOT NULL,
  `lastname` longtext NOT NULL,
  `email` longtext NOT NULL,
  `phone` longtext NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`inquiry_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `insurance`
--

DROP TABLE IF EXISTS `insurance`;
CREATE TABLE IF NOT EXISTS `insurance` (
  `insurance_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `vendor_id` bigint(20) NOT NULL,
  `category` varchar(34) NOT NULL,
  `type` json NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `tags` text NOT NULL,
  `tenure` tinytext NOT NULL,
  `value` bigint(20) NOT NULL,
  `views` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`insurance_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `insurance`
--

INSERT INTO `insurance` (`insurance_id`, `vendor_id`, `category`, `type`, `title`, `description`, `price`, `tags`, `tenure`, `value`, `views`, `status`, `date`) VALUES
(1, 2, 'All Risks Insurance', 'null', 'ensures', 'Laptops are for coding Laptops are for coding Laptops are for coding Laptops are for coding Laptops are for coding Laptops are for coding Laptops are for coding Laptops are for coding Laptops are for coding Laptops are for coding Laptops are for coding Laptops are for coding Laptops are for coding Laptops are for coding Laptops are for coding Laptops are for coding Laptops are for coding Laptops are for coding Laptops are for coding Laptops are for coding Laptops are for coding Laptops are for coding Laptops are for coding Laptops are for coding Laptops are for coding Laptops are for coding Laptops are for coding Laptops are for coding Laptops are for coding Laptops are for coding Laptops are for coding Laptops are for coding Laptops are for coding Laptops are for coding ', '152.00', '', 'null', 0, 0, 1, '2019-03-27 00:00:00'),
(2, 1, 'All Risks Insurance', 'null', 'ensure', 'Laptops are for coding ', '152.00', '', 'null', 0, 0, 1, '2019-03-27 00:00:00'),
(3, 5, 'All Risks Insurance', 'null', 'ensure', 'Laptops are for coding ', '152.00', '', 'null', 0, 0, 1, '2019-03-27 00:00:00'),
(4, 6, 'All Risks Insurance', 'null', 'ensure', 'Laptops are for coding ', '152.00', '', 'null', 0, 0, 1, '2019-03-27 00:00:00'),
(5, 0, 'All Risks Insurance', 'null', 'ensure', 'Laptops are for coding ', '152.00', '', 'null', 0, 0, 1, '2019-03-27 00:00:00'),
(6, 0, 'All Risks Insurance', 'null', 'ensure', 'Laptops are for coding ', '152.00', '', 'null', 0, 0, 1, '2019-03-27 00:00:00'),
(7, 0, 'All Risks Insurance', 'null', 'ensure', 'Laptops are for coding ', '152.00', '', 'null', 0, 0, 1, '2019-03-27 00:00:00'),
(8, 0, 'All Risks Insurance', 'null', 'ensure', 'Laptops are for coding ', '152.00', '', 'null', 0, 0, 1, '2019-03-27 00:00:00'),
(9, 0, 'All Risks Insurance', 'null', 'ensure', 'Laptops are for coding ', '152.00', '', 'null', 0, 0, 1, '2019-03-27 00:00:00'),
(10, 0, 'All Risks Insurance', 'null', 'ensure', 'Laptops are for coding ', '152.00', '', 'null', 0, 0, 1, '2019-03-27 00:00:00'),
(11, 2, 'All Risks Insurance', '[\"Laptops\"]', '23kdk', 'ede edejdej', '2.00', 'dfkdk', '2 year(s)', 23, 0, 0, '2019-04-06 13:48:34'),
(12, 2, 'All Risks Insurance', '[\"Laptops\"]', '23kdk', 'ede edejdej', '2.00', 'dfkdk', '2 year(s)', 23, 0, 0, '2019-04-06 13:57:05'),
(13, 1, 'Personal Accident Insurance', '[\"Occupational accident\"]', '1', 'qsqs', '1.00', '1', '2 year(s)', 2, 0, 0, '2019-04-10 11:13:55');

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

DROP TABLE IF EXISTS `offer`;
CREATE TABLE IF NOT EXISTS `offer` (
  `order_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(11) NOT NULL,
  `title` longtext NOT NULL,
  `description` longtext NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` tinyint(4) NOT NULL,
  `duration` tinytext NOT NULL,
  `features` longtext NOT NULL,
  `deal` tinyint(4) NOT NULL,
  `coupon` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `views` bigint(20) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `payment_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `platform` varchar(30) NOT NULL,
  `identification` longtext NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

DROP TABLE IF EXISTS `property`;
CREATE TABLE IF NOT EXISTS `property` (
  `property_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `vendor_id` bigint(20) NOT NULL,
  `ownership` varchar(6) NOT NULL,
  `rules` longtext NOT NULL,
  `type` json NOT NULL,
  `amenities` json NOT NULL,
  `facilities` json NOT NULL,
  `bedroom` tinyint(4) NOT NULL,
  `bathroom` tinyint(4) NOT NULL,
  `guests` tinyint(4) NOT NULL,
  `duration` tinytext NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `pictures` json NOT NULL,
  `country` varchar(25) NOT NULL,
  `state` varchar(25) NOT NULL,
  `city` varchar(25) NOT NULL,
  `district` varchar(25) NOT NULL,
  `full_address` varchar(25) NOT NULL,
  `featured` tinyint(4) NOT NULL,
  `views` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`property_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`property_id`, `vendor_id`, `ownership`, `rules`, `type`, `amenities`, `facilities`, `bedroom`, `bathroom`, `guests`, `duration`, `price`, `pictures`, `country`, `state`, `city`, `district`, `full_address`, `featured`, `views`, `status`, `date`) VALUES
(1, 1, 'Sale', 'Don\'t do that', '[\"Duplex\", \"Bungalow\"]', '[\"Essentials\", \"Washer\", \"Elevator\", \"Buzzer/wireless intercom\", \"Cable TV\", \"Washer\"]', '[\"Essentials\", \"Washer\", \"Elevator\", \"Buzzer/wireless intercom\", \"Cable TV\", \"Washer\"]', 2, 3, 4, 'month', '2.00', '[\"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\"]', 'Nigeria', 'Lagos', 'Ikeja', 'Koni', 'No 23', 1, 11, 0, '2019-03-18 00:00:00'),
(2, 1, 'Sale', 'Don\'t do that', '[\"Duplex\", \"Bungalow\"]', '[\"Essentials\", \"Washer\", \"Elevator\", \"Buzzer/wireless intercom\", \"Cable TV\", \"Washer\"]', '[\"Essentials\", \"Washer\", \"Elevator\", \"Buzzer/wireless intercom\", \"Cable TV\", \"Washer\"]', 2, 3, 4, '', '2.00', '[\"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\"]', 'Nigeria', 'Lagos', 'Ikeja', 'Koni', 'No 23', 1, 11, 1, '2019-03-18 00:00:00'),
(3, 1, 'Rental', 'Don\'t do that', '[\"Duplex\", \"Bungalow\"]', '[\"Essentials\", \"Washer\", \"Elevator\", \"Buzzer/wireless intercom\", \"Cable TV\", \"Washer\"]', '[\"Essentials\", \"Washer\", \"Elevator\", \"Buzzer/wireless intercom\", \"Cable TV\", \"Washer\"]', 2, 3, 4, '', '2.00', '[\"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\"]', 'Nigeria', 'Lagos', 'Ikeja', 'Koni', 'No 23', 0, 11, 1, '2019-03-18 00:00:00'),
(4, 1, 'Rental', 'Don\'t do that', '[\"Duplex\", \"Bungalow\"]', '[\"Essentials\", \"Washer\", \"Elevator\", \"Buzzer/wireless intercom\", \"Cable TV\", \"Washer\"]', '[\"Essentials\", \"Washer\", \"Elevator\", \"Buzzer/wireless intercom\", \"Cable TV\", \"Washer\"]', 2, 3, 4, '', '2.00', '[\"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\"]', 'Nigeria', 'Lagos', 'Ikeja', 'Koni', 'No 23', 1, 11, 1, '2019-03-18 00:00:00'),
(5, 1, 'Sale', 'Don\'t do that', '[\"Duplex\", \"Bungalow\"]', '[\"Essentials\", \"Washer\", \"Elevator\", \"Buzzer/wireless intercom\", \"Cable TV\", \"Washer\"]', '[\"Essentials\", \"Washer\", \"Elevator\", \"Buzzer/wireless intercom\", \"Cable TV\", \"Washer\"]', 2, 3, 4, '', '2.00', '[\"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\"]', 'Nigeria', 'Lagos', 'Ikeja', 'Koni', 'No 23', 0, 11, 1, '2019-03-18 00:00:00'),
(6, 1, 'Rental', 'Don\'t do that', '[\"Duplex\", \"Bungalow\"]', '[\"Essentials\", \"Washer\", \"Elevator\", \"Buzzer/wireless intercom\", \"Cable TV\", \"Washer\"]', '[\"Essentials\", \"Washer\", \"Elevator\", \"Buzzer/wireless intercom\", \"Cable TV\", \"Washer\"]', 2, 3, 4, '', '2.00', '[\"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\"]', 'Nigeria', 'Lagos', 'Ikeja', 'Koni', 'No 23', 0, 11, 1, '2019-03-18 00:00:00'),
(7, 1, 'Rental', 'Don\'t do that', '[\"Duplex\", \"Bungalow\"]', '[\"Essentials\", \"Washer\", \"Elevator\", \"Buzzer/wireless intercom\", \"Cable TV\", \"Washer\"]', '[\"Essentials\", \"Washer\", \"Elevator\", \"Buzzer/wireless intercom\", \"Cable TV\", \"Washer\"]', 2, 3, 4, '', '2.00', '[\"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\"]', 'Nigeria', 'Lagos', 'Ikeja', 'Koni', 'No 23', 0, 11, 1, '2019-03-18 00:00:00'),
(8, 1, 'Rental', 'Don\'t do that', '[\"Duplex\", \"Bungalow\"]', '[\"Essentials\", \"Washer\", \"Elevator\", \"Buzzer/wireless intercom\", \"Cable TV\", \"Washer\"]', '[\"Essentials\", \"Washer\", \"Elevator\", \"Buzzer/wireless intercom\", \"Cable TV\", \"Washer\"]', 2, 3, 4, '', '2.00', '[\"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\"]', 'Nigeria', 'Lagos', 'Ikeja', 'Koni', 'No 23', 0, 11, 1, '2019-03-18 00:00:00'),
(9, 1, 'Rental', 'Don\'t do that', '[\"Duplex\", \"Bungalow\"]', '[\"Essentials\", \"Washer\", \"Elevator\", \"Buzzer/wireless intercom\", \"Cable TV\", \"Washer\"]', '[\"Essentials\", \"Washer\", \"Elevator\", \"Buzzer/wireless intercom\", \"Cable TV\", \"Washer\"]', 2, 3, 4, '', '2.00', '[\"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\"]', 'Nigeria', 'Lagos', 'Ikeja', 'Koni', 'No 23', 0, 11, 1, '2019-03-18 00:00:00'),
(10, 1, 'Rental', 'Don\'t do that', '[\"Duplex\", \"Bungalow\"]', '[\"Essentials\", \"Washer\", \"Elevator\", \"Buzzer/wireless intercom\", \"Cable TV\", \"Washer\"]', '[\"Essentials\", \"Washer\", \"Elevator\", \"Buzzer/wireless intercom\", \"Cable TV\", \"Washer\"]', 2, 3, 4, '', '2.00', '[\"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\", \"../img/zoe4nviem4_800x600.jpg\"]', 'Nigeria', 'Lagos', 'Ikeja', 'Koni', 'No 23', 0, 11, 1, '2019-03-18 00:00:00'),
(11, 2, 'Rental', 'rules', '[\"Bungalow\"]', '[\"Essentials\", \"Washer\"]', '[\"Washer\", \"Buzzer/wireless intercom\"]', 1, 4, 2, '12 year(s)', '6.00', '[\"../vendor/storage/2/1553879825.png\", \"../vendor/storage/2/1553879825.png\"]', 'Nigeria', 'state', 'city', 'district', 'address', 0, 0, 0, '2019-03-29 18:17:05'),
(12, 2, 'Rental', 'rules', '[\"Bungalow\"]', '[\"Essentials\", \"Washer\"]', '[\"Washer\", \"Buzzer/wireless intercom\"]', 1, 4, 2, '12 year(s)', '6.00', '[\"../vendor/storage/2/1553879997.png\", \"../vendor/storage/2/1553879997.png\"]', 'Nigeria', 'state', 'city', 'district', 'address', 0, 0, 0, '2019-03-29 18:19:57'),
(13, 2, 'Rental', 'sdc', '[\"Bungalow\"]', '[\"Elevator\"]', '[\"Buzzer/wireless intercom\"]', 2, 2, 44, '34 year(s)', '33.00', '[\"../vendor/storage/2/1554033977.png\", \"../vendor/storage/2/1554033977.png\"]', 'Nigeria', 'statre', 'dfgf', 'ygg', 'gyyy', 0, 0, 0, '2019-03-31 13:06:17'),
(14, 1, 'Rental', 'wwdwd', '[\"Duplex\"]', '[\"Buzzer/wireless intercom\"]', '[\"Washer\"]', 2, 3, 2, '2 year(s)', '1.00', '[\"../vendor/storage/1/1554895861.png\", \"../vendor/storage/1/1554895861.png\"]', 'United States of America', '2', '213', '11', 'wdwd', 0, 0, 0, '2019-04-10 12:31:01'),
(15, 1, 'Rental', 'wwdwd', '[\"Duplex\"]', '[\"Buzzer/wireless intercom\"]', '[\"Washer\"]', 2, 3, 2, '2 year(s)', '1.00', '[\"../vendor/storage/1/1554895870.png\", \"../vendor/storage/1/1554895870.png\"]', 'United States of America', '2', '213', '11', 'wdwd', 0, 0, 0, '2019-04-10 12:31:10');

-- --------------------------------------------------------

--
-- Table structure for table `reset`
--

DROP TABLE IF EXISTS `reset`;
CREATE TABLE IF NOT EXISTS `reset` (
  `reset_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` tinytext NOT NULL,
  `type` tinytext NOT NULL,
  `identification` varchar(32) NOT NULL,
  `used` tinyint(4) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`reset_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reset`
--

INSERT INTO `reset` (`reset_id`, `email`, `type`, `identification`, `used`, `date`) VALUES
(1, 'nnachijioke@yahoo.com', 'admin', 'c4ca4238a0b923820dcc509a6f75849b', 1, '2019-05-13 00:00:00'),
(2, 'nnachijioke@yahoo.com', 'admin', '665f644e43731ff9db3d341da5c827e1', 1, '2019-05-14 07:59:19'),
(3, 'nnachijioke@yahoo.com', 'admin', '38026ed22fc1a91d92b5d2ef93540f20', 1, '2019-05-14 07:59:59'),
(4, 'nnachijioke@yahoo.com', 'admin', '011ecee7d295c066ae68d4396215c3d0', 1, '2019-05-14 11:45:55'),
(5, 'nnachijioke@yahoo.com', 'admin', '4e44f1ac85cd60e3caa56bfd4afb675e', 0, '2019-05-14 12:17:21'),
(6, 'nnachijioke@yahoo.com', 'vendor', '3d2f8900f2e49c02b481c2f717aa9020', 0, '2019-05-14 12:18:18'),
(7, 'nnachijioke@yahoo.com', 'vendor', 'cd7fd1517e323f26c6f1b0b6b96e3b3d', 0, '2019-05-14 12:19:20'),
(8, 'nnachijioke@yahoo.com', 'user', '815e6212def15fe76ed27cec7a393d59', 0, '2019-05-14 13:16:06'),
(9, 'nnachijioke@yahoo.com', 'user', '4c0d13d3ad6cc317017872e51d01b238', 0, '2019-05-14 13:19:12'),
(10, 'nnachijioke@yahoo.com', 'user', '8d8e353b98d5191d5ceea1aa3eb05d43', 0, '2019-05-14 13:19:48'),
(11, 'nnachijioke@yahoo.com', 'user', '7bfc85c0d74ff05806e0b5a0fa0c1df1', 0, '2019-05-14 13:20:57'),
(12, 'nnachijioke@yahoo.com', 'user', 'c8b2f17833a4c73bb20f88876219ddcd', 0, '2019-05-14 13:23:55'),
(13, 'nnachijioke@yahoo.com', 'user', '7e51746feafa7f2621f71943da8f603c', 0, '2019-05-14 13:24:33'),
(14, 'nnachijioke@yahoo.com', 'user', 'f93b8bbbac89ea22bac0bf188ba49a61', 0, '2019-05-14 13:24:57'),
(15, 'nnachijioke@yahoo.com', 'user', 'ad8b68a55505a09ac7578f32418904b3', 0, '2019-05-14 13:24:59'),
(16, 'nnachijioke@yahoo.com', 'user', '93b6deed95aca08ab22dae75e28592b1', 0, '2019-05-14 13:26:12'),
(17, 'nnachijioke@yahoo.com', 'user', '27a989a1aeab2b96cedd2b6c4a7cba2f', 0, '2019-05-14 13:27:17');

-- --------------------------------------------------------

--
-- Table structure for table `travel`
--

DROP TABLE IF EXISTS `travel`;
CREATE TABLE IF NOT EXISTS `travel` (
  `travel_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`travel_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `profile_picture` longtext NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `other_names` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `currency` varchar(3) NOT NULL,
  `notifications` json NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `email_2` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `profile_picture`, `first_name`, `last_name`, `other_names`, `email`, `password`, `phone`, `currency`, `notifications`, `status`, `date`) VALUES
(1, 'storage/1/1554999057.png', 'Chijioke', 'Nna', 'Ezeugos', 'nnachijioke@yahoo.com', '1a1dc91c907325c69271ddf0c944bc72', '0817922232711', 'EUR', '{\"deals\": true, \"offers\": true, \"survey\": true, \"reminders\": true, \"announcements\": false, \"recommendations\": false}', 1, '2019-03-26 00:19:00'),
(2, 'storage/1/1554998890.png', 'Chijioke', 'Nna', 'Ezeugo', 'nnachijioke1@yahoo.com', 'dc647eb65e6711e155375218212b3964', '08179222327', 'NGN', '{\"deals\": true, \"offers\": true, \"survey\": true, \"reminders\": true, \"announcements\": true, \"recommendations\": true}', 1, '2019-03-26 00:19:00'),
(3, 'storage/1/1554998890.png', 'Chijioke', 'Nna', 'Ezeugo', 'nnachijioke2@yahoo.com', 'dc647eb65e6711e155375218212b3964', '08179222327', 'NGN', '{\"deals\": true, \"offers\": true, \"survey\": true, \"reminders\": true, \"announcements\": true, \"recommendations\": true}', 1, '2019-03-26 00:19:00'),
(4, 'storage/1/1554998890.png', 'Chijioke', 'Nna', 'Ezeugo', 'nnachijioke3@yahoo.com', 'dc647eb65e6711e155375218212b3964', '08179222327', 'NGN', '{\"deals\": true, \"offers\": true, \"survey\": true, \"reminders\": true, \"announcements\": true, \"recommendations\": true}', 1, '2019-03-26 00:19:00'),
(5, 'storage/1/1554998890.png', 'Chijioke', 'Nna', 'Ezeugo', 'nnachijioke4@yahoo.com', 'dc647eb65e6711e155375218212b3964', '08179222327', 'NGN', '{\"deals\": true, \"offers\": true, \"survey\": true, \"reminders\": true, \"announcements\": true, \"recommendations\": true}', 1, '2019-03-26 00:19:00'),
(6, 'storage/1/1554998890.png', 'Chijioke', 'Nna', 'Ezeugo', 'nnachijioke5@yahoo.com', 'dc647eb65e6711e155375218212b3964', '08179222327', 'NGN', '{\"deals\": true, \"offers\": true, \"survey\": true, \"reminders\": true, \"announcements\": true, \"recommendations\": true}', 1, '2019-03-26 00:19:00'),
(7, 'storage/1/1554998890.png', 'Chijioke', 'Nna', 'Ezeugo', 'nnachijioke6@yahoo.com', 'dc647eb65e6711e155375218212b3964', '08179222327', 'NGN', '{\"deals\": true, \"offers\": true, \"survey\": true, \"reminders\": true, \"announcements\": true, \"recommendations\": true}', 1, '2019-03-26 00:19:00'),
(8, 'storage/1/1554998890.png', 'Chijioke', 'Nna', 'Ezeugo', 'nnachijioke7@yahoo.com', 'dc647eb65e6711e155375218212b3964', '08179222327', 'NGN', '{\"deals\": true, \"offers\": true, \"survey\": true, \"reminders\": true, \"announcements\": true, \"recommendations\": true}', 1, '2019-03-26 00:19:00'),
(9, 'storage/1/1554998890.png', 'Chijioke', 'Nna', 'Ezeugo', 'nnachijioke8@yahoo.com', 'dc647eb65e6711e155375218212b3964', '08179222327', 'NGN', '{\"deals\": true, \"offers\": true, \"survey\": true, \"reminders\": true, \"announcements\": true, \"recommendations\": true}', 1, '2019-03-26 00:19:00'),
(10, 'storage/1/1554998890.png', 'Chijioke', 'Nna', 'Ezeugo', 'nnachijioke9@yahoo.com', 'dc647eb65e6711e155375218212b3964', '08179222327', 'NGN', '{\"deals\": true, \"offers\": true, \"survey\": true, \"reminders\": true, \"announcements\": true, \"recommendations\": true}', 1, '2019-03-26 00:19:00'),
(11, '../img/48x48.png', 'sjsj', 'sjjsj', 'sjsjsj', 'ssjsj', '3691308f2a4c2f6983f2880d32e29c84', 's', 'NGN', '{\"deals\": false, \"offers\": false, \"survey\": false, \"reminders\": false, \"announcements\": false, \"recommendations\": false}', 1, '2019-04-20 17:45:44'),
(12, '../img/48x48.png', 'jddjj', 'sjsjs', 'jsj', 'aaja', '3691308f2a4c2f6983f2880d32e29c84', 'nnachijioke@yahoo.com', 'NGN', '{\"deals\": false, \"offers\": false, \"survey\": false, \"reminders\": false, \"announcements\": false, \"recommendations\": false}', 1, '2019-04-20 17:46:20'),
(13, '../img/48x48.png', 'jddjj', 'sjsjs', 'jsj', 'aajaf', '3691308f2a4c2f6983f2880d32e29c84', 'nnachijioke@yahoo.com', 'NGN', '{\"deals\": false, \"offers\": false, \"survey\": false, \"reminders\": false, \"announcements\": false, \"recommendations\": false}', 1, '2019-04-20 17:46:36'),
(14, '../img/48x48.png', 'jj', 'jjj', 'jjjj', 'jjj', 'bf2bc2545a4a5f5683d9ef3ed0d977e0', 'j', 'NGN', '{\"deals\": false, \"offers\": false, \"survey\": false, \"reminders\": false, \"announcements\": false, \"recommendations\": false}', 1, '2019-04-20 21:29:52');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

DROP TABLE IF EXISTS `vendor`;
CREATE TABLE IF NOT EXISTS `vendor` (
  `vendor_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` varchar(9) NOT NULL,
  `business_name` varchar(100) NOT NULL,
  `business_logo` longtext NOT NULL,
  `business_address` longtext NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `notifications` json NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`vendor_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `type`, `business_name`, `business_logo`, `business_address`, `email`, `password`, `phone`, `notifications`, `status`, `date`) VALUES
(1, 'property', 'Evo Ventures', '../img/zoe4nviem4_800x600.jpg', 'Business Addresss', 'nnachijioke@yahoo.com', '1a1dc91c907325c69271ddf0c944bc72', '08179222327', '[{\"date\": \"March 1st, 2018\", \"read\": true, \"content\": \"Welcome to Moneymatters\", \"category\": \"admin\"}, {\"date\": \"March 1st, 2018\", \"read\": true, \"content\": \"You can now edit your profile\", \"category\": \"admin\"}]', 1, '2019-03-26 00:19:00'),
(2, 'event', 'Business Name', '../img/zoe4nviem4_800x600.jpg', 'Business Address', 'nnachijioke1@yahoo.com', 'dc647eb65e6711e155375218212b3964', '08179222327', '[{\"date\": \"March 1st, 2018\", \"read\": false, \"content\": \"Welcome to Moneymatters\", \"category\": \"admin\"}]', 0, '2019-03-26 00:19:00'),
(3, 'finance', 'Business Name', '../img/zoe4nviem4_800x600.jpg', 'Business Address', 'nnachijioke2@yahoo.com', 'dc647eb65e6711e155375218212b3964', '08179222327', '[{\"date\": \"March 1st, 2018\", \"read\": false, \"content\": \"Welcome to Moneymatters\", \"category\": \"admin\"}]', 1, '2019-03-26 00:19:00'),
(4, 'event', 'Business Name', '../img/zoe4nviem4_800x600.jpg', 'Business Address', 'nnachijioke3@yahoo.com', 'dc647eb65e6711e155375218212b3964', '08179222327', '[{\"date\": \"March 1st, 2018\", \"read\": false, \"content\": \"Welcome to Moneymatters\", \"category\": \"admin\"}]', 1, '2019-03-26 00:19:00'),
(5, 'finance', 'Business Name', '../img/zoe4nviem4_800x600.jpg', 'Business Address', 'nnachijioke4@yahoo.com', 'dc647eb65e6711e155375218212b3964', '08179222327', '[{\"date\": \"March 1st, 2018\", \"read\": false, \"content\": \"Welcome to Moneymatters\", \"category\": \"admin\"}]', 1, '2019-03-26 00:19:00'),
(6, 'insurance', 'Business Name', '../img/zoe4nviem4_800x600.jpg', 'Business Address', 'nnachijioke5@yahoo.com', 'dc647eb65e6711e155375218212b3964', '08179222327', '[{\"date\": \"March 1st, 2018\", \"read\": false, \"content\": \"Welcome to Moneymatters\", \"category\": \"admin\"}]', 1, '2019-03-26 00:19:00'),
(7, 'wedding', 'Business Name', '../img/zoe4nviem4_800x600.jpg', 'Business Address', 'nnachijioke6@yahoo.com', 'dc647eb65e6711e155375218212b3964', '08179222327', '[{\"date\": \"March 1st, 2018\", \"read\": false, \"content\": \"Welcome to Moneymatters\", \"category\": \"admin\"}]', 1, '2019-03-26 00:19:00'),
(8, 'insurance', 'Business Name', '../img/zoe4nviem4_800x600.jpg', 'Business Address', 'nnachijiok7e@yahoo.com', 'dc647eb65e6711e155375218212b3964', '08179222327', '[{\"date\": \"March 1st, 2018\", \"read\": false, \"content\": \"Welcome to Moneymatters\", \"category\": \"admin\"}]', 1, '2019-03-26 00:19:00'),
(9, 'property', 'Business Name', '../img/zoe4nviem4_800x600.jpg', 'Business Address', 'nnachijioke8@yahoo.com', 'dc647eb65e6711e155375218212b3964', '08179222327', '[{\"date\": \"March 1st, 2018\", \"read\": false, \"content\": \"Welcome to Moneymatters\", \"category\": \"admin\"}]', 1, '2019-03-26 00:19:00'),
(10, 'property', 'Business Name', '../img/zoe4nviem4_800x600.jpg', 'Business Address', 'nnachijioke9@yahoo.com', 'dc647eb65e6711e155375218212b3964', '08179222327', '[{\"date\": \"March 1st, 2018\", \"read\": false, \"content\": \"Welcome to Moneymatters\", \"category\": \"admin\"}]', 1, '2019-03-26 00:19:00'),
(11, 'finance', 'h', '', 'h', 't', '1a1dc91c907325c69271ddf0c944bc72', 'nnachijioke@yahoo.com', '[{\"date\": \"March 1st, 2018\", \"read\": false, \"content\": \"Welcome to Moneymatters\", \"category\": \"admin\"}]', 1, '2019-04-20 17:38:44'),
(12, 'finance', 'h', '', 'h', 'h', '1a1dc91c907325c69271ddf0c944bc72', 'nnachijioke@yahoo.com', '[{\"date\": \"March 1st, 2018\", \"read\": false, \"content\": \"Welcome to Moneymatters\", \"category\": \"admin\"}]', 1, '2019-04-20 17:40:37');

-- --------------------------------------------------------

--
-- Table structure for table `wedding`
--

DROP TABLE IF EXISTS `wedding`;
CREATE TABLE IF NOT EXISTS `wedding` (
  `wedding_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `vendor_id` bigint(20) NOT NULL,
  `title` longtext NOT NULL,
  `description` longtext NOT NULL,
  `category` json NOT NULL,
  `time` datetime NOT NULL,
  `rating` json NOT NULL,
  `messages` json NOT NULL,
  `pictures` json NOT NULL,
  `country` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `district` varchar(50) NOT NULL,
  `full_address` longtext NOT NULL,
  `views` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`wedding_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wedding`
--

INSERT INTO `wedding` (`wedding_id`, `vendor_id`, `title`, `description`, `category`, `time`, `rating`, `messages`, `pictures`, `country`, `state`, `city`, `district`, `full_address`, `views`, `status`, `date`) VALUES
(1, 1, 'TRIPLE K EVENT CENTRE', 'TRIPLE K EVENT CENTRE THE BEST', '[\"DJ\", \"Videographer\"]', '2019-03-06 00:00:00', '[{\"id\": 2322, \"rating\": 5}, {\"id\": 1322, \"rating\": 4}]', 'null', '[\"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\"]', 'Nigeria', 'Alimosho', 'Shomolu', 'Ifako', 'No 21, Babarinda Street, Ilaje', 10, 0, '2019-03-28 00:00:00'),
(2, 1, 'TRIPLE K EVENT CENTRE', 'TRIPLE K EVENT CENTRE THE BEST', '[\"DJ\", \"Videographer\"]', '2019-03-06 00:00:00', '[{\"id\": 2322, \"rating\": 5}, {\"id\": 1322, \"rating\": 4}]', 'null', '[\"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\"]', 'Nigeria', 'Alimosho', 'Shomolu', 'Ifako', 'No 21, Babarinda Street, Ilaje', 10, 1, '2019-03-28 00:00:00'),
(3, 1, 'TRIPLE K EVENT CENTRE', 'TRIPLE K EVENT CENTRE THE BEST', '[\"DJ\", \"Videographer\"]', '2019-03-06 00:00:00', '[{\"id\": 2322, \"rating\": 5}, {\"id\": 1322, \"rating\": 4}]', 'null', '[\"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\"]', 'Nigeria', 'Alimosho', 'Shomolu', 'Ifako', 'No 21, Babarinda Street, Ilaje', 10, 0, '2019-03-28 00:00:00'),
(4, 1, 'TRIPLE K EVENT CENTRE', 'TRIPLE K EVENT CENTRE THE BEST', '[\"DJ\", \"Videographer\"]', '2019-03-06 00:00:00', '[{\"id\": 2322, \"rating\": 5}, {\"id\": 1322, \"rating\": 4}]', 'null', '[\"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\"]', 'Nigeria', 'Alimosho', 'Shomolu', 'Ifako', 'No 21, Babarinda Street, Ilaje', 10, 1, '2019-03-28 00:00:00'),
(5, 1, 'TRIPLE K EVENT CENTRE', 'TRIPLE K EVENT CENTRE THE BEST', '[\"DJ\", \"Videographer\"]', '2019-03-06 00:00:00', '[{\"id\": 2322, \"rating\": 5}, {\"id\": 1322, \"rating\": 4}]', 'null', '[\"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\"]', 'Nigeria', 'Alimosho', 'Shomolu', 'Ifako', 'No 21, Babarinda Street, Ilaje', 10, 0, '2019-03-28 00:00:00'),
(6, 1, 'TRIPLE K EVENT CENTRE', 'TRIPLE K EVENT CENTRE THE BEST', '[\"DJ\", \"Videographer\"]', '2019-03-06 00:00:00', '[{\"id\": 2322, \"rating\": 5}, {\"id\": 1322, \"rating\": 4}]', 'null', '[\"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\"]', 'Nigeria', 'Alimosho', 'Shomolu', 'Ifako', 'No 21, Babarinda Street, Ilaje', 10, 0, '2019-03-28 00:00:00'),
(7, 1, 'TRIPLE K EVENT CENTRE', 'TRIPLE K EVENT CENTRE THE BEST', '[\"DJ\", \"Videographer\"]', '2019-03-06 00:00:00', '[{\"id\": 2322, \"rating\": 5}, {\"id\": 1322, \"rating\": 4}]', 'null', '[\"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\"]', 'Nigeria', 'Alimosho', 'Shomolu', 'Ifako', 'No 21, Babarinda Street, Ilaje', 10, 0, '2019-03-28 00:00:00'),
(8, 1, 'TRIPLE K EVENT CENTRE', 'TRIPLE K EVENT CENTRE THE BEST', '[\"DJ\", \"Videographer\"]', '2019-03-06 00:00:00', '[{\"id\": 2322, \"rating\": 5}, {\"id\": 1322, \"rating\": 4}]', 'null', '[\"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\"]', 'Nigeria', 'Alimosho', 'Shomolu', 'Ifako', 'No 21, Babarinda Street, Ilaje', 10, 0, '2019-03-28 00:00:00'),
(9, 1, 'TRIPLE K EVENT CENTRE', 'TRIPLE K EVENT CENTRE THE BEST', '[\"DJ\", \"Videographer\"]', '2019-03-06 00:00:00', '[{\"id\": 2322, \"rating\": 5}, {\"id\": 1322, \"rating\": 4}]', 'null', '[\"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\"]', 'Nigeria', 'Alimosho', 'Shomolu', 'Ifako', 'No 21, Babarinda Street, Ilaje', 10, 0, '2019-03-28 00:00:00'),
(10, 1, 'TRIPLE K EVENT CENTRE', 'TRIPLE K EVENT CENTRE THE BEST', '[\"DJ\", \"Videographer\"]', '2019-03-06 00:00:00', '[{\"id\": 2322, \"rating\": 5}, {\"id\": 1322, \"rating\": 4}]', 'null', '[\"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\", \"../img/skyscrapper.jpg\"]', 'Nigeria', 'Alimosho', 'Shomolu', 'Ifako', 'No 21, Babarinda Street, Ilaje', 10, 0, '2019-03-28 00:00:00'),
(11, 1, 'tit', 'des', '[\"DJ\"]', '2019-03-29 12:03:00', '[]', '[]', '[\"../vendor/storage/2/1554628871.png\", \"../vendor/storage/2/1554628871.png\"]', 'Nigeria', 'stat', 'city', 'dist', 'addr', 0, 0, '2019-04-07 10:21:11'),
(12, 1, 'tit', 'des', '[\"DJ\"]', '2019-03-29 12:03:00', '[]', '[]', '[\"../vendor/storage/2/1554628882.png\", \"../vendor/storage/2/1554628882.png\"]', 'Nigeria', 'stat', 'city', 'dist', 'addr', 0, 0, '2019-04-07 10:21:22'),
(13, 1, 'tit', 'des', '[\"DJ\"]', '2019-03-29 12:03:00', '[]', '[]', '[\"../vendor/storage/2/1554628942.png\", \"../vendor/storage/2/1554628942.png\"]', 'Nigeria', 'stat', 'city', 'dist', 'addr', 0, 0, '2019-04-07 10:22:22'),
(14, 1, 'e', 'ss', '[\"Photographer\"]', '2019-03-29 12:00:00', '[]', '[]', '[\"../vendor/storage//1554892224.png\"]', 'United Kingdom', 'ajaj', 'jsshsh', 'ssshh', 'hshs', 0, 0, '2019-04-10 11:30:24'),
(15, 1, 'e', 'ss', '[\"Photographer\"]', '2019-03-29 12:00:00', '[]', '[]', '[\"../vendor/storage/1/1554892248.png\"]', 'United Kingdom', 'ajaj', 'jsshsh', 'ssshh', 'hshs', 0, 0, '2019-04-10 11:30:48'),
(16, 1, 'e', 'ss', '[\"Photographer\"]', '2019-03-29 12:00:00', '[]', '[]', '[\"../vendor/storage/1/1554892284.png\"]', 'United Kingdom', 'ajaj', 'jsshsh', 'ssshh', 'hshs', 0, 0, '2019-04-10 11:31:24'),
(17, 1, 'e', 'ss', '[\"Photographer\"]', '2019-03-29 12:00:00', '[]', '[]', '[\"../vendor/storage/1/1554894298.png\"]', 'United Kingdom', 'ajaj', 'jsshsh', 'ssshh', 'hshs', 0, 0, '2019-04-10 12:04:58');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
