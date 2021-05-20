-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 20, 2021 at 01:03 AM
-- Server version: 10.1.48-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cosmicu_test_cosmicu_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `title` char(255) CHARACTER SET utf8 DEFAULT NULL,
  `description` text CHARACTER SET utf8,
  `timestamp` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `status`, `title`, `description`, `timestamp`) VALUES
(1, 1, NULL, 'Order two books to qualify for FREE SHIPPING with code SAFEATHOME', 1590744550);

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `title` char(255) CHARACTER SET utf8 DEFAULT NULL,
  `code` char(255) CHARACTER SET utf8 DEFAULT NULL,
  `discount` char(255) CHARACTER SET utf8 DEFAULT NULL,
  `min` varchar(255) NOT NULL DEFAULT '0',
  `description` text CHARACTER SET utf8,
  `type_id` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `timestamp` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`id`, `status`, `title`, `code`, `discount`, `min`, `description`, `type_id`, `timestamp`) VALUES
(1, 1, '10% OFF', 'UNICORN20', '20', '100', '', 0, 1590763035),
(2, 1, 'PreOrder', 'PREORDER', '0', '0', 'Free order', 1, 1591211219),
(3, 1, 'Free Shipping', 'FREESHIPPING', '0', '0', NULL, 2, 1591211246),
(4, 1, 'Free Shipping', 'SAFEATHOME', '0', '30', 'Order two books to get free shipping. ', 2, 1591233105);

-- --------------------------------------------------------

--
-- Table structure for table `domains`
--

CREATE TABLE `domains` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `name` char(64) CHARACTER SET utf8 NOT NULL,
  `ip` bigint(20) UNSIGNED NOT NULL,
  `timestamp` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `domains`
--

INSERT INTO `domains` (`id`, `status`, `name`, `ip`, `timestamp`) VALUES
(1, 1, 'cosmicunicorns.com', 0, 0),
(2, 1, 'lakesidecreates.com', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `name` char(64) CHARACTER SET utf8 NOT NULL,
  `domain` bigint(20) UNSIGNED NOT NULL,
  `ip` bigint(20) UNSIGNED NOT NULL,
  `timestamp` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `status`, `name`, `domain`, `ip`, `timestamp`) VALUES
(1, 1, 'mandi', 1, 0, 0),
(2, 1, 'laura', 2, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ip`
--

CREATE TABLE `ip` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `ip` varbinary(16) NOT NULL,
  `timestamp` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `paid` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `refunded` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `shippedtocustomer` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `pdfdownloaded` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `senttoprinters` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `printing` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `paymentintent_response` text CHARACTER SET utf8,
  `paid_response` text CHARACTER SET utf8,
  `refunded_response` text CHARACTER SET utf8,
  `paymentprocessor` tinyint(1) UNSIGNED NOT NULL,
  `paymentintentid` char(255) CHARACTER SET utf8 DEFAULT NULL,
  `paymentid` char(255) CHARACTER SET utf8 DEFAULT NULL,
  `refundid` char(255) CHARACTER SET utf8 DEFAULT NULL,
  `hair` tinyint(2) UNSIGNED NOT NULL DEFAULT '0',
  `haircolor` tinyint(2) UNSIGNED NOT NULL DEFAULT '0',
  `eyes` tinyint(2) UNSIGNED NOT NULL DEFAULT '0',
  `eyescolor` tinyint(2) UNSIGNED NOT NULL DEFAULT '0',
  `glasses` tinyint(2) UNSIGNED NOT NULL DEFAULT '0',
  `freckles` tinyint(2) UNSIGNED NOT NULL DEFAULT '0',
  `body` tinyint(2) UNSIGNED NOT NULL DEFAULT '0',
  `bodycolor` tinyint(2) UNSIGNED NOT NULL DEFAULT '0',
  `pages` char(64) CHARACTER SET ascii NOT NULL,
  `childsname` varchar(128) CHARACTER SET utf8 NOT NULL,
  `lovenote` varchar(1024) CHARACTER SET utf8 NOT NULL,
  `childspicture` varchar(1024) CHARACTER SET utf8 NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `type_id` int(11) NOT NULL DEFAULT '1',
  `billing_info` text,
  `order_id` int(11) NOT NULL DEFAULT '0',
  `order_count` int(11) NOT NULL DEFAULT '0',
  `amount` varchar(255) DEFAULT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `coupon_type` int(11) NOT NULL DEFAULT '0',
  `ip` bigint(20) UNSIGNED NOT NULL,
  `timestamp` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `status`, `paid`, `refunded`, `shippedtocustomer`, `pdfdownloaded`, `senttoprinters`, `printing`, `paymentintent_response`, `paid_response`, `refunded_response`, `paymentprocessor`, `paymentintentid`, `paymentid`, `refundid`, `hair`, `haircolor`, `eyes`, `eyescolor`, `glasses`, `freckles`, `body`, `bodycolor`, `pages`, `childsname`, `lovenote`, `childspicture`, `quantity`, `type_id`, `billing_info`, `order_id`, `order_count`, `amount`, `coupon_code`, `discount`, `coupon_type`, `ip`, `timestamp`) VALUES
(10, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 5, 3, 0, 4, 0, 0, 1, 2, '6-7-8-9-10-12-13-14-15-16', 'River', 'test', 'Cosmic-Unicorns.png', 1, 1, '{\"name\":\"Amanda (Crossroads) Amanda (Crossroads)\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"FL\",\"country\":\"United States\",\"phone\":\"19542137112\",\"email\":\"mandihawke@gmail.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1591233889),
(11, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 12, 1, 0, 2, 0, 0, 0, 4, '7-8-9-10-12-13-14-15-16-17', 'River', 'test', 'Cosmic-UnicornsHiRes-01.png', 1, 1, '{\"name\":\"Amanda (Dragon) Amanda (Dragon)\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"FL\",\"country\":\"United States\",\"phone\":\"19542137112\",\"email\":\"mandihawke@gmail.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1591233988),
(12, 0, 1, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 9, 6, 0, 0, 0, 1, 0, 5, '10-12-13-14-15-16-17-19-20-9', 'River', 'test', 'Cosmic-UnicornsHiRes-01.png', 1, 1, '{\"name\":\"Amanda (Music) Amanda (Music)\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"FL\",\"country\":\"United States\",\"phone\":\"19542137112\",\"email\":\"mandihawke@gmail.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '66.00', 1, 0, 1591234167),
(13, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 9, 6, 0, 0, 0, 1, 1, 5, '7-8-9-10-12-13-14-15-16-17', '0', 'test', 'Cosmic-Unicorns.png', 1, 1, '{\"name\":\"Amanda (Music) Amanda (Music)\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"FL\",\"country\":\"United States\",\"phone\":\"19542137112\",\"email\":\"mandihawke@gmail.com\",\"postal_code\":\"33312\"}', 12, 2, '0', 'preorder', '66.00', 1, 0, 1591234167),
(7, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 3, 1, 3, 0, 0, 0, 2, '1-2-3-4-5-6-7-8-9-10', 'River', 'test', 'Cosmic-UnicornsHiRes-01.png', 1, 1, '{\"name\":\"Amanda (Camping) Amanda (Camping)\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"FL\",\"country\":\"United States\",\"phone\":\"19542137112\",\"email\":\"mandihawke@gmail.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1591233482),
(8, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 10, 0, 0, 1, 0, 0, 0, 1, '5-6-7-8-9-10-12-13-14-15', 'River', 'test', 'Cosmic-Unicorns.png', 1, 1, '{\"name\":\"Amanda (Super Hero) Amanda (Super Hero)\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"FL\",\"country\":\"United States\",\"phone\":\"19542137112\",\"email\":\"mandihawke@gmail.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1591233579),
(9, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 2, 2, 0, 2, 1, 0, 0, 3, '12-13-14-15-16-17-19-20-9-10', 'River', 'test', 'Cosmic-Unicorns.png', 1, 1, '{\"name\":\"Amanda (Picking Flowers) Amanda (Picking Flowers)\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"FL\",\"country\":\"United States\",\"phone\":\"19542137112\",\"email\":\"mandihawke@gmail.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1591233805),
(6, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 7, 2, 1, 1, 0, 0, 0, 0, '1-2-3-4-5-6-8-7-9-10', 'River', 'test', 'Cosmic-Unicorns.png', 1, 1, '{\"name\":\"Amanda (Basketball) Amanda (Basketball)\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"FL\",\"country\":\"United States\",\"phone\":\"19542137112\",\"email\":\"mandihawke@gmail.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1591233371),
(5, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 3, 1, 0, 2, 0, 0, 1, 5, '1-2-3-4-5-6-7-8-9-10', 'River', 'tes test ', 'Cosmic-Unicorns.png', 1, 1, '{\"name\":\"Amanda Amanda\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"FL\",\"country\":\"United States\",\"phone\":\"19542137112\",\"email\":\"mandihawke@gmail.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1591233129),
(14, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 0, 3, 0, 1, 0, 0, 0, 1, '10-12-13-9-14-15-16-17-19-20', 'River', 'test', 'Cosmic-Unicorns.png', 1, 1, '{\"name\":\"Amanda (Playground) Amanda (Playground)\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"FL\",\"country\":\"United States\",\"phone\":\"19542137112\",\"email\":\"mandihawke@gmail.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1591234244),
(15, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 4, 1, 0, 0, 0, 0, 0, 3, '9-10-8-12-13-14-15-16-17-19', 'River', 'test', 'Cosmic-UnicornsHiRes-01.png', 1, 1, '{\"name\":\"Amanda (Space) Amanda (Space)\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"FL\",\"country\":\"United States\",\"phone\":\"19542137112\",\"email\":\"mandihawke@gmail.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1591234326),
(16, 0, 0, 0, 0, 0, 0, 0, '{\"id\":\"pi_1Gq7yAKElFovmXYcTUt2GsTy\",\"object\":\"payment_intent\",\"amount\":3400,\"amount_capturable\":0,\"amount_received\":0,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges?payment_intent=pi_1Gq7yAKElFovmXYcTUt2GsTy\"},\"client_secret\":\"pi_1Gq7yAKElFovmXYcTUt2GsTy_secret_peD8wvykyHMEJwnGLXtTdH7M9\",\"confirmation_method\":\"automatic\",\"created\":1591234450,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":false,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":null,\"payment_method_options\":{\"card\":{\"installments\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"requires_payment_method\",\"transfer_data\":null,\"transfer_group\":null}', NULL, NULL, 1, 'pi_1Gq7yAKElFovmXYcTUt2GsTy', NULL, NULL, 8, 3, 0, 2, 0, 0, 0, 1, '1-2-3-4-5-6-7-8-9-10', 'Test', 'tests', 'Cosmic-Unicorns.png', 1, 1, NULL, 0, 1, '34.00', '', '', 0, 0, 1591234450),
(17, 0, 0, 0, 0, 0, 0, 0, '{\"id\":\"pi_1GqO93KElFovmXYcKoqzsGJ9\",\"object\":\"payment_intent\",\"amount\":3400,\"amount_capturable\":0,\"amount_received\":0,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges?payment_intent=pi_1GqO93KElFovmXYcKoqzsGJ9\"},\"client_secret\":\"pi_1GqO93KElFovmXYcKoqzsGJ9_secret_SCaM2hPGfhqaepYECEcfOsKeH\",\"confirmation_method\":\"automatic\",\"created\":1591296629,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":false,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":null,\"payment_method_options\":{\"card\":{\"installments\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"requires_payment_method\",\"transfer_data\":null,\"transfer_group\":null}', NULL, NULL, 1, 'pi_1GqO93KElFovmXYcKoqzsGJ9', NULL, NULL, 8, 3, 0, 2, 0, 0, 0, 1, '1-2-3-4-5-6-7-8-9-10', 'ghh', 'vbc', '43680054335_840e380120_b.jpg', 1, 1, NULL, 0, 1, '34.00', '', '', 0, 0, 1591296630),
(18, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 4, 0, 1, 1, 0, 0, 0, 1, '17-1-2-3-16-15-14-20-8-10', 'Himan', 'tttttt', 'CanICountOnYourSupport.png', 1, 1, '{\"name\":\"Mandi Mandi\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"FL\",\"country\":\"United States\",\"phone\":\"19542137112\",\"email\":\"mandihawke@gmail.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1592510070),
(19, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 8, 3, 0, 2, 0, 0, 0, 1, '1-2-3-4-5-6-7-8-9-10', 'Sample', 'test  ', '75252833_10153040776264979_4895517428944994304_o.jpg', 1, 1, '{\"name\":\"Mandi (Test order) Hawke (Test Order)\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"FL\",\"country\":\"United States\",\"phone\":\"19542137112\",\"email\":\"mandihawke@gmail.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'PREorder', '34.00', 1, 0, 1592806855),
(20, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 7, 2, 0, 3, 0, 0, 0, 1, '1-6-7-8-9-10-2-3-4-5', 'Your Child', 'etes', '75252833_10153040776264979_4895517428944994304_o.jpg', 1, 1, '{\"name\":\"Mandi (Your Childs Big Adventure) Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"FL\",\"country\":\"United States\",\"phone\":\"19542137112\",\"email\":\"mandihawke@gmail.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1592810787),
(21, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 8, 3, 0, 2, 0, 0, 0, 1, '1-2-3-4-5-6-7-8-9-10', 'Lisa', 'Dear Lisa \r\nwe love you \r\ntest test test', '1594086521.jpg', 1, 1, '{\"name\":\"Mandi Test\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"7543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1594086750),
(22, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 7, 3, 0, 2, 0, 0, 0, 1, '16-2-3-4-5-1-6-7-8-9', 'testpagesize', 'test', '1594967259.png', 1, 1, '{\"name\":\"TEST Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"7543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1594967279),
(23, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, '0', '', '', '', 1, 2, '{\"name\":\"Test Test\",\"line1\":\"Test\",\"line2\":\"Test\",\"city\":\"Test\",\"state\":\"Test\",\"country\":\"Test\",\"phone\":\"9690667772\",\"email\":\"Test@gmail.com\",\"postal_code\":\"Test\"}', 0, 1, '0', 'PreOrder', '52.00', 1, 0, 1594967410),
(24, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 6, 1, 0, 2, 1, 0, 1, 1, '2-3-4-5-1-6-7-8-9-10', 'tesdt', 'test', '1594967358.png', 1, 1, '{\"name\":\"Test Test\",\"line1\":\"Test\",\"line2\":\"Test\",\"city\":\"Test\",\"state\":\"Test\",\"country\":\"Test\",\"phone\":\"9690667772\",\"email\":\"Test@gmail.com\",\"postal_code\":\"Test\"}', 23, 2, '0', 'PreOrder', '52.00', 1, 0, 1594967410),
(25, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 10, 3, 0, 2, 0, 0, 0, 1, '19-15-16-10-9-8-3-1-2-4', 'Test', 'yrdy yrdy yrdy', '1595378524.jpg', 1, 1, '{\"name\":\"Mandi Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"7543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'PREorder', '34.00', 1, 0, 1595378671),
(26, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 10, 3, 0, 2, 0, 0, 0, 1, '19-15-16-10-8-17-20-12-13-14', 'Test', 'test test test', '1595382004.jpg', 1, 1, '{\"name\":\"Mandi Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"7543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'PREorder', '34.00', 1, 0, 1595382033),
(27, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 10, 3, 0, 2, 0, 0, 0, 1, '17-16-3-8-15-10-19-20-14-13', 'Test2', 'rsdhfgghbn,m,', '1595430836.jpg', 1, 1, '{\"name\":\"Amanda Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"FL\",\"country\":\"United States\",\"phone\":\"9542137112\",\"email\":\"mandihawke@gmail.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'PREorder', '34.00', 1, 0, 1595430852),
(28, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 10, 3, 1, 3, 0, 0, 0, 2, '3-4-8-10-15-16-17-19-20-14', 'Test3', 'tsdfdsfsd', '1595433404.jpg', 1, 1, '{\"name\":\"Amanda Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"FL\",\"country\":\"United States\",\"phone\":\"9542137112\",\"email\":\"mandihawke@gmail.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'PREorder', '34.00', 1, 0, 1595433416),
(29, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 10, 3, 1, 3, 0, 0, 0, 2, '3-4-8-10-15-16-17-19-20-14', 'MandiHiman', 'teststetst', '1595446429.jpg', 1, 1, '{\"name\":\"Amanda Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"FL\",\"country\":\"United States\",\"phone\":\"9542137112\",\"email\":\"mandihawke@gmail.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1595446444),
(30, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 10, 3, 0, 2, 0, 0, 1, 1, '1-2-5-6-7-13-12-14-15-16', 'Test22', 'gfgfdg', '1595474940.jpg', 1, 1, '{\"name\":\"Amanda Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"FL\",\"country\":\"United States\",\"phone\":\"9542137112\",\"email\":\"mandihawke@gmail.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1595483307),
(31, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 5, 3, 0, 2, 1, 1, 0, 1, '1-2-3-4-5-6-7-8-9-10', 'LowBunBuns', 'TEST', '1596063130.jpg', 1, 1, '{\"name\":\"Amanda Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"FL\",\"country\":\"United States\",\"phone\":\"9542137112\",\"email\":\"mandihawke@gmail.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1596063155),
(32, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 5, 3, 0, 2, 1, 1, 0, 1, '12-13-14-15-16-17-19-20-9-10', 'LowBunBuns', 'test', '1596063227.jpg', 1, 1, '{\"name\":\"Mandi Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"17543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '162.00', 1, 0, 1596063622),
(33, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 5, 3, 0, 2, 1, 1, 0, 1, '12-13-14-15-16-17-19-20-9-10', 'LowBunBuns', 'test', '1596063227.jpg', 1, 1, '{\"name\":\"Mandi Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"17543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 32, 2, '0', 'preorder', '162.00', 1, 0, 1596063622),
(34, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 6, 3, 0, 2, 1, 1, 0, 1, '12-13-14-15-16-17-19-20-9-10', 'LowPigtails2', 'test', '1596063388.jpg', 1, 1, '{\"name\":\"Mandi Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"17543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 32, 3, '0', 'preorder', '162.00', 1, 0, 1596063622),
(35, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 7, 3, 0, 2, 1, 1, 0, 1, '12-13-14-15-16-17-19-20-9-10', 'HighBunBuns2', 'test', '1596063428.jpg', 1, 1, '{\"name\":\"Mandi Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"17543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 32, 4, '0', 'preorder', '162.00', 1, 0, 1596063622),
(36, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 8, 3, 0, 2, 1, 1, 0, 1, '12-13-14-15-16-17-19-20-9-10', 'ShortSpikey2', 'test', '1596063457.jpg', 1, 1, '{\"name\":\"Mandi Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"17543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 32, 5, '0', 'preorder', '162.00', 1, 0, 1596063622),
(37, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 10, 3, 0, 2, 1, 1, 0, 1, '12-13-14-15-16-17-19-20-9-10', 'Short2', 'test', '1596063657.jpg', 1, 1, '{\"name\":\"Mandi Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"17543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '162.00', 1, 0, 1596063877),
(38, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 11, 3, 0, 2, 1, 1, 0, 1, '12-13-14-15-16-17-19-20-9-10', 'ShortWavy2', 'test', '1596063692.jpg', 1, 1, '{\"name\":\"Mandi Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"17543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 37, 2, '0', 'preorder', '162.00', 1, 0, 1596063877),
(39, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 12, 3, 0, 2, 1, 1, 0, 1, '12-13-14-15-16-17-19-20-9-10', 'ShortLayered2', 'test', '1596063796.jpg', 1, 1, '{\"name\":\"Mandi Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"17543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 37, 3, '0', 'preorder', '162.00', 1, 0, 1596063877),
(40, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 3, 0, 2, 1, 1, 0, 1, '12-13-14-15-16-17-19-20-9-10', 'Hijab2', 'test', '1596063829.jpg', 1, 1, '{\"name\":\"Mandi Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"17543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 37, 4, '0', 'preorder', '162.00', 1, 0, 1596063877),
(41, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 4, 3, 0, 2, 1, 1, 0, 1, '12-13-14-15-16-17-19-20-9-10', 'ShortFro2', 'test', '1596063865.jpg', 1, 1, '{\"name\":\"Mandi Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"17543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 37, 5, '0', 'preorder', '162.00', 1, 0, 1596063877),
(42, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 3, 3, 0, 2, 1, 1, 0, 1, '12-13-14-15-16-17-19-20-9-10', 'LongPonytail2', 'test', '1596063909.jpg', 1, 1, '{\"name\":\"Mandi Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"7543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1596063920),
(43, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 2, 3, 1, 2, 0, 1, 0, 1, '12-13-14-15-16-17-19-20-9-10', 'Braids2', 'test', '1596063958.jpg', 1, 1, '{\"name\":\"Mandi Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"17543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '162.00', 1, 0, 1596064201),
(44, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 3, 0, 2, 0, 0, 0, 3, '4-3-2-1-6-7-8-9-10-5-11-12-13-14-15-16-17-18-19-20-21-22', 'Cornrow2', 'test', '1596064020.jpg', 1, 1, '{\"name\":\"Mandi Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"17543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 43, 2, '0', 'preorder', '162.00', 1, 0, 1596064201),
(45, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 3, 3, 0, 2, 0, 0, 0, 1, '9-10-8-7-6-5-4-1-2-3', 'LongPonytail1', 'test', '1596064109.jpg', 1, 1, '{\"name\":\"Mandi Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"17543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 43, 3, '0', 'preorder', '162.00', 1, 0, 1596064201),
(46, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 2, 3, 0, 2, 1, 1, 0, 1, '9-10-8-7-6-5-4-1-2-3', 'Braids1', 'test', '1596064144.jpg', 1, 1, '{\"name\":\"Mandi Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"17543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 43, 4, '0', 'preorder', '162.00', 1, 0, 1596064201),
(47, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 0, 3, 0, 2, 1, 1, 0, 1, '9-10-8-7-6-5-4-1-2-3', 'CornRow1', 'test', '1596064186.jpg', 1, 1, '{\"name\":\"Mandi Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"17543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 43, 5, '0', 'preorder', '162.00', 1, 0, 1596064201),
(48, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 6, 3, 0, 2, 1, 1, 0, 1, '9-10-8-7-6-5-4-1-2-3', 'LowPigtails1', 'test', '1596064805.jpg', 1, 1, '{\"name\":\"Mandi Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"7543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1596064837),
(49, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 7, 3, 0, 2, 1, 1, 0, 1, '9-10-8-7-6-5-4-1-2-3', 'HighBunBuns1', 'test', '1596064897.jpg', 1, 1, '{\"name\":\"Mandi Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"17543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '162.00', 1, 0, 1596065178),
(50, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 9, 3, 0, 2, 1, 1, 0, 1, '9-10-8-7-6-5-4-1-2-3', 'ShortCurly1', 'test', '1596065065.jpg', 1, 1, '{\"name\":\"Mandi Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"17543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 49, 2, '0', 'preorder', '162.00', 1, 0, 1596065178),
(51, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 10, 3, 0, 2, 1, 1, 0, 1, '9-10-8-7-6-5-4-1-2-3', 'Short1', 'test', '1596065102.jpg', 1, 1, '{\"name\":\"Mandi Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"17543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 49, 3, '0', 'preorder', '162.00', 1, 0, 1596065178),
(52, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 11, 3, 0, 2, 1, 1, 0, 1, '9-10-8-7-6-5-4-1-2-3', 'ShortWavy1', 'test', '1596065133.jpg', 1, 1, '{\"name\":\"Mandi Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"17543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 49, 4, '0', 'preorder', '162.00', 1, 0, 1596065178),
(53, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 12, 3, 0, 2, 1, 1, 0, 1, '9-10-8-7-6-5-4-1-2-3', 'ShortLayered1', 'test', '1596065167.jpg', 1, 1, '{\"name\":\"Mandi Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"17543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 49, 5, '0', 'preorder', '162.00', 1, 0, 1596065178),
(54, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 4, 3, 0, 2, 0, 0, 0, 1, '1-2-3-4-5-6-7-8-9-10', 'Afro1', 'test', '1600481492.png', 1, 1, '{\"name\":\"MandiaAfro1  Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"7543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1600481540),
(55, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 6, 3, 0, 2, 0, 0, 0, 1, '1-2-3-4-5-6-7-8-9-10', 'Afro1', 'test', '1600481563.png', 1, 1, '{\"name\":\"MandiPigtail1 Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"7543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1600481580),
(56, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 8, 3, 0, 2, 0, 0, 0, 1, '1-2-3-4-5-6-7-8-9-10', 'Afro1', 'test', '1600481604.png', 1, 1, '{\"name\":\"MandiMedSpikey Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"7543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1600481627),
(57, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 5, 3, 0, 2, 0, 0, 0, 1, '1-2-3-4-5-6-7-8-9-10', 'Poms Down', 'test', '1601065197.png', 1, 1, '{\"name\":\"Mandi Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"7543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1601065219),
(58, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 3, 1, 3, 0, 0, 0, 2, '1-2-3-4-5-6-7-8-9-10', 'River', '\r\nCosmic Unicorns exists because families of all diverse make-ups deserve representation and inclusion. \r\n\r\nThe positive impact of seeing someone who looks like you in\r\nbooks, images, and videos cannot be highlighted enough!\r\n\r\nJoin the Movement!\r\nFB @cosmicunicorns\r\nIG cosmic_unicorns_official\r\nCosmicUnicorns.com ', '1601751668.png', 1, 1, '{\"name\":\"River Camping\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"7543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1601751963),
(59, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 10, 2, 0, 1, 0, 0, 0, 0, '1-2-3-4-5-6-7-8-9-10', 'River', 'test', '1601752048.gif', 1, 1, '{\"name\":\"River SuperHero\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"7543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1601752124),
(60, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 5, 3, 0, 4, 0, 1, 1, 2, '1-2-3-4-5-6-7-8-9-10', 'River', 'test', '1601752842.gif', 1, 1, '{\"name\":\"River Crossroads\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"7543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1601752884),
(61, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 4, 1, 0, 0, 1, 1, 0, 3, '1-2-3-4-5-6-7-8-9-16', 'River', 'test', '1601753007.png', 1, 1, '{\"name\":\"River Space\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"7543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1601753026),
(62, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 2, 2, 0, 1, 0, 0, 0, 3, '1-2-3-4-5-6-7-8-9-12', 'River', 'test', '1601753268.jpg', 1, 1, '{\"name\":\"River PickingFlowers\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"7543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1601753296),
(63, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 3, 1, 1, 2, 0, 0, 1, 3, '1-2-3-4-5-6-7-8-9-12', 'River', 'test', '1601753398.jpg', 1, 1, '{\"name\":\"River Airship\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"7543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1601753420),
(64, 0, 1, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 7, 2, 1, 1, 0, 0, 0, 0, '1-2-3-4-5-6-7-8-9-12', 'River', 'test', '1601753531.jpg', 1, 1, '{\"name\":\"River Basketball\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"7543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1601753552),
(65, 0, 1, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 12, 3, 0, 1, 0, 0, 0, 4, '1-2-3-4-5-6-7-8-9-12', 'River', 'test', '1601753734.jpg', 1, 1, '{\"name\":\"River Dragon\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"7543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1601753750),
(66, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 9, 6, 1, 0, 0, 1, 1, 5, '1-2-3-4-5-6-7-8-9-10', 'River', 'test', '1601753842.jpg', 1, 1, '{\"name\":\"River Music\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"7543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1601753857),
(67, 0, 0, 0, 0, 0, 0, 0, '{\"id\":\"pi_1HYGZyKElFovmXYcDUYuYuHZ\",\"object\":\"payment_intent\",\"amount\":3400,\"amount_capturable\":0,\"amount_received\":0,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges?payment_intent=pi_1HYGZyKElFovmXYcDUYuYuHZ\"},\"client_secret\":\"pi_1HYGZyKElFovmXYcDUYuYuHZ_secret_vLdqnnQRBSABkI4UqDWEzHNpw\",\"confirmation_method\":\"automatic\",\"created\":1601753978,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":false,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":null,\"payment_method_options\":{\"card\":{\"installments\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"requires_payment_method\",\"transfer_data\":null,\"transfer_group\":null}', NULL, NULL, 1, 'pi_1HYGZyKElFovmXYcDUYuYuHZ', NULL, NULL, 0, 3, 0, 1, 0, 1, 1, 1, '1-2-3-4-5-6-7-8-9-13', 'River', 'test', '1601753934.jpg', 1, 1, NULL, 0, 1, '34.00', '', '', 0, 0, 1601753978),
(68, 0, 1, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 0, 3, 0, 1, 2, 1, 1, 1, '2-4-6-8-10-12-14-15-16-17-18-19-20-21', 'River', 'test', '1601753934.jpg', 1, 1, '{\"name\":\"River Playground\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"7543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1601753983),
(69, 0, 0, 0, 0, 0, 0, 0, '{\"id\":\"pi_1HdJr9KElFovmXYc3Gdj1tMZ\",\"object\":\"payment_intent\",\"amount\":3400,\"amount_capturable\":0,\"amount_received\":0,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges?payment_intent=pi_1HdJr9KElFovmXYc3Gdj1tMZ\"},\"client_secret\":\"pi_1HdJr9KElFovmXYc3Gdj1tMZ_secret_dZB0Roklx5N6agqJHNrU5rX9x\",\"confirmation_method\":\"automatic\",\"created\":1602958215,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":false,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":null,\"payment_method_options\":{\"card\":{\"installments\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"requires_payment_method\",\"transfer_data\":null,\"transfer_group\":null}', NULL, NULL, 1, 'pi_1HdJr9KElFovmXYc3Gdj1tMZ', NULL, NULL, 9, 2, 0, 1, 0, 0, 0, 4, '2-1-4-3-6-8-7-10-15-16', 'Hichem', 'Dear Hichem,\r\nThank you for everything man.', '1602958150.jpg', 1, 1, NULL, 0, 1, '34.00', '', '', 0, 0, 1602958215),
(70, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 7, 3, 0, 1, 3, 1, 1, 2, '1-2-3-4-5-6-7-8-9-13', 'Bharvi', 'Dear Bharvi,\r\n.\r\nSending best wishes for a wonderful birthday.\r\n\r\nWe hope your day is filled with love, laughter, and friends and family all around you!\r\n\r\nLove,\r\nMom and Dad', '1602964984.jpeg', 1, 1, '{\"name\":\"Mandi Hawke (Bharvi)\",\"line1\":\"7810\",\"line2\":\"NW 72nd Avenue\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"7543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1602965148),
(71, 0, 0, 0, 0, 0, 0, 0, '{\"id\":\"pi_1HdRhbKElFovmXYcWG50YTzV\",\"object\":\"payment_intent\",\"amount\":3400,\"amount_capturable\":0,\"amount_received\":0,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges?payment_intent=pi_1HdRhbKElFovmXYcWG50YTzV\"},\"client_secret\":\"pi_1HdRhbKElFovmXYcWG50YTzV_secret_YigRS7sbZpCQPBDxIBZqbOwxl\",\"confirmation_method\":\"automatic\",\"created\":1602988375,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":false,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":null,\"payment_method_options\":{\"card\":{\"installments\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"requires_payment_method\",\"transfer_data\":null,\"transfer_group\":null}', NULL, NULL, 1, 'pi_1HdRhbKElFovmXYcWG50YTzV', NULL, NULL, 9, 2, 0, 1, 0, 0, 0, 4, '2-1-4-3-6-8-7-10-15-16', 'Hichem', 'Dear Hichem,\r\nI\'m testing this file bla bla bla, I hope you enjoy the stories.', '1602988304.jpg', 1, 1, NULL, 0, 1, '34.00', '', '', 0, 0, 1602988375),
(72, 0, 1, 0, 1, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 9, 2, 0, 1, 0, 0, 0, 4, '2-1-4-3-6-8-7-10-15-16', 'Hichem', 'Dear Hichem,\r\nI\'m testing this file bla bla bla, I hope you enjoy the stories.', '1602988304.jpg', 1, 1, '{\"name\":\"Hichem Razgallah\",\"line1\":\"Tunis\",\"line2\":\"Tunis\",\"city\":\"Tunis\",\"state\":\"Tunis\",\"country\":\"Tunisia\",\"phone\":\"0021658195444\",\"email\":\"hichemraz@gmail.com\",\"postal_code\":\"01013\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1602988388),
(73, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 7, 3, 0, 1, 3, 1, 1, 2, '1-2-3-4-5-6-7-8-9-13', 'MandiBharviTest', '\r\nDear Mandi Bharvi, \r\n\r\nTest test test test test\r\ntest test test test\r\ntest test test\r\ntest test\r\ntest\r\n1\r\n2\r\n3\r\nLove Person', '1603124713.png', 1, 1, '{\"name\":\"MandiBharviTest Hawke\",\"line1\":\"7810\",\"line2\":\"NW 72nd Avenue\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"7543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1603124914),
(74, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 3, 1, 1, 0, 0, 0, 1, '1-2-3-4-5-6-7-8-9-10', 'Tabatha', '\r\nDear Tabatha, \r\n\r\n1\r\n2\r\n3\r\n4\r\n5\r\nLove Note Test\r\n\r\nLove Family', '1603130544.jpeg', 1, 1, '{\"name\":\"Mandi Hawke\",\"line1\":\"7810\",\"line2\":\"NW 72nd Avenue\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"7543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1603130615),
(75, 0, 0, 0, 0, 0, 0, 0, '{\"id\":\"pi_1HeLTkKElFovmXYcSTxxPElZ\",\"object\":\"payment_intent\",\"amount\":3400,\"amount_capturable\":0,\"amount_received\":0,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges?payment_intent=pi_1HeLTkKElFovmXYcSTxxPElZ\"},\"client_secret\":\"pi_1HeLTkKElFovmXYcSTxxPElZ_secret_EkABgvFpg6OwFFHg0VhjtPlpT\",\"confirmation_method\":\"automatic\",\"created\":1603202780,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":false,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":null,\"payment_method_options\":{\"card\":{\"installments\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"requires_payment_method\",\"transfer_data\":null,\"transfer_group\":null}', NULL, NULL, 1, 'pi_1HeLTkKElFovmXYcSTxxPElZ', NULL, NULL, 6, 3, 0, 2, 0, 0, 0, 1, '1-2-3-4-5-8-7-6-9-10', 'Bharvi', '', '1603202692.jpg', 1, 1, NULL, 0, 1, '34.00', '', '', 0, 0, 1603202781),
(76, 0, 0, 0, 0, 0, 0, 0, '{\"id\":\"pi_1HeLWQKElFovmXYc5BarOoNe\",\"object\":\"payment_intent\",\"amount\":6600,\"amount_capturable\":0,\"amount_received\":0,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges?payment_intent=pi_1HeLWQKElFovmXYc5BarOoNe\"},\"client_secret\":\"pi_1HeLWQKElFovmXYc5BarOoNe_secret_a4WegfcC3PV75Z3kN8VN9NOE1\",\"confirmation_method\":\"automatic\",\"created\":1603202946,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":false,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":null,\"payment_method_options\":{\"card\":{\"installments\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"requires_payment_method\",\"transfer_data\":null,\"transfer_group\":null}', NULL, NULL, 1, 'pi_1HeLWQKElFovmXYc5BarOoNe', NULL, NULL, 6, 3, 0, 2, 0, 0, 0, 1, '1-2-3-4-5-8-7-6-9-10', 'Bharvi', '', '1603202692.jpg', 1, 1, NULL, 0, 1, '66.00', '', '', 0, 0, 1603202946),
(77, 0, 0, 0, 0, 0, 0, 0, '{\"id\":\"pi_1HeLWQKElFovmXYc5BarOoNe\",\"object\":\"payment_intent\",\"amount\":6600,\"amount_capturable\":0,\"amount_received\":0,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges?payment_intent=pi_1HeLWQKElFovmXYc5BarOoNe\"},\"client_secret\":\"pi_1HeLWQKElFovmXYc5BarOoNe_secret_a4WegfcC3PV75Z3kN8VN9NOE1\",\"confirmation_method\":\"automatic\",\"created\":1603202946,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":false,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":null,\"payment_method_options\":{\"card\":{\"installments\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"requires_payment_method\",\"transfer_data\":null,\"transfer_group\":null}', NULL, NULL, 1, 'pi_1HeLWQKElFovmXYc5BarOoNe', NULL, NULL, 6, 3, 0, 2, 0, 0, 0, 1, '1-2-3-4-5-8-7-6-9-10', 'Bharvi', '', '1603202931.jpg', 1, 1, NULL, 76, 2, '66.00', '', '', 0, 0, 1603202946),
(78, 0, 0, 0, 0, 0, 0, 0, '{\"id\":\"pi_1HeNRCKElFovmXYcsZk50FCS\",\"object\":\"payment_intent\",\"amount\":3400,\"amount_capturable\":0,\"amount_received\":0,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges?payment_intent=pi_1HeNRCKElFovmXYcsZk50FCS\"},\"client_secret\":\"pi_1HeNRCKElFovmXYcsZk50FCS_secret_t1WqQjT4eNGsO1JImugcL57rt\",\"confirmation_method\":\"automatic\",\"created\":1603210310,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":false,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":null,\"payment_method_options\":{\"card\":{\"installments\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"requires_payment_method\",\"transfer_data\":null,\"transfer_group\":null}', NULL, NULL, 1, 'pi_1HeNRCKElFovmXYcsZk50FCS', NULL, NULL, 8, 3, 0, 2, 0, 0, 0, 1, '1-2-3-4-5-8-7-6-9-10', 'Bharvi', 'Dear Bharvi \r\nWishing you the h \r\nLove grandma and pap', '1603210255.jpg', 1, 1, NULL, 0, 1, '34.00', '', '', 0, 0, 1603210310),
(79, 0, 0, 0, 0, 0, 0, 0, '{\"id\":\"pi_1HeNwoKElFovmXYcnFChudLK\",\"object\":\"payment_intent\",\"amount\":3400,\"amount_capturable\":0,\"amount_received\":0,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges?payment_intent=pi_1HeNwoKElFovmXYcnFChudLK\"},\"client_secret\":\"pi_1HeNwoKElFovmXYcnFChudLK_secret_zjhqXaaBaJsMcFkUga5hhkQ62\",\"confirmation_method\":\"automatic\",\"created\":1603212270,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":false,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":null,\"payment_method_options\":{\"card\":{\"installments\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"requires_payment_method\",\"transfer_data\":null,\"transfer_group\":null}', NULL, NULL, 1, 'pi_1HeNwoKElFovmXYcnFChudLK', NULL, NULL, 8, 3, 0, 2, 0, 0, 0, 1, '1-2-3-4-5-8-7-6-9-10', 'Bharvi', 'Dear Bharvi\r\n\r\n\r\nWishing you the happiest \r\nbirthday\r\n\r\nLove you', '1603212192.jpg', 1, 1, NULL, 0, 1, '34.00', '', '', 0, 0, 1603212270),
(80, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 7, 3, 1, 0, 0, 0, 1, 1, '1-2-3-4-5-6-7-8-9-10', 'Final Test!', '\r\nDear Mandi, \r\n\r\nI am so looking forward to this \r\nbooks success!\r\n\r\nLove, Me\r\n\r\nxoxoxo', '1603214273.jpg', 1, 1, '{\"name\":\"Mandi Hawke\",\"line1\":\"7810\",\"line2\":\"NW 72nd Avenue\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"7543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, '0', 'preorder', '34.00', 1, 0, 1603214290);

-- --------------------------------------------------------

--
-- Table structure for table `timestamps`
--

CREATE TABLE `timestamps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `timestamp` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `useremails`
--

CREATE TABLE `useremails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `email` bigint(20) UNSIGNED DEFAULT NULL,
  `user` bigint(20) UNSIGNED DEFAULT NULL,
  `ip` bigint(20) UNSIGNED NOT NULL,
  `timestamp` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `useremails`
--

INSERT INTO `useremails` (`id`, `status`, `email`, `user`, `ip`, `timestamp`) VALUES
(1, 1, 1, 1, 0, 0),
(2, 1, 2, 2, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `role` int(11) NOT NULL DEFAULT '0',
  `fname` char(32) DEFAULT '',
  `lname` char(32) DEFAULT '',
  `password` char(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `ip` bigint(20) UNSIGNED NOT NULL,
  `timestamp` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `status`, `role`, `fname`, `lname`, `password`, `ip`, `timestamp`) VALUES
(1, 1, 0, 'Cosmic', 'Unicorns', '$2y$10$wBrgCnIuJ2I5YM/zqb9TGOQRyqn0gEUa/gfkYjXT/P1Sz6HQoc7v6', 0, 0),
(2, 1, 1, 'laura', 'laura', '$2y$10$wBrgCnIuJ2I5YM/zqb9TGOQRyqn0gEUa/gfkYjXT/P1Sz6HQoc7v6', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `timestamp` (`timestamp`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `timestamp` (`timestamp`);

--
-- Indexes for table `domains`
--
ALTER TABLE `domains`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `status` (`status`),
  ADD KEY `ip` (`ip`),
  ADD KEY `timestamp` (`timestamp`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `status` (`status`),
  ADD KEY `domain` (`domain`),
  ADD KEY `ip` (`ip`),
  ADD KEY `timestamp` (`timestamp`);

--
-- Indexes for table `ip`
--
ALTER TABLE `ip`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ip` (`ip`),
  ADD KEY `status` (`status`),
  ADD KEY `timestamp` (`timestamp`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `paid` (`paid`),
  ADD KEY `refunded` (`refunded`),
  ADD KEY `shippedtocustomer` (`shippedtocustomer`),
  ADD KEY `pdfdownloaded` (`pdfdownloaded`),
  ADD KEY `senttoprinters` (`senttoprinters`),
  ADD KEY `printing` (`printing`),
  ADD KEY `paymentprocessor` (`paymentprocessor`),
  ADD KEY `hair` (`hair`),
  ADD KEY `haircolor` (`haircolor`),
  ADD KEY `eyes` (`eyes`),
  ADD KEY `eyescolor` (`eyescolor`),
  ADD KEY `glasses` (`glasses`),
  ADD KEY `freckles` (`freckles`),
  ADD KEY `body` (`body`),
  ADD KEY `bodycolor` (`bodycolor`),
  ADD KEY `ip` (`ip`),
  ADD KEY `timestamp` (`timestamp`);

--
-- Indexes for table `timestamps`
--
ALTER TABLE `timestamps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `timestamp` (`timestamp`);

--
-- Indexes for table `useremails`
--
ALTER TABLE `useremails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `email` (`email`),
  ADD KEY `user` (`user`),
  ADD KEY `ip` (`ip`),
  ADD KEY `timestamp` (`timestamp`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `fname` (`fname`),
  ADD KEY `lname` (`lname`),
  ADD KEY `password` (`password`),
  ADD KEY `ip` (`ip`),
  ADD KEY `timestamp` (`timestamp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `domains`
--
ALTER TABLE `domains`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ip`
--
ALTER TABLE `ip`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `timestamps`
--
ALTER TABLE `timestamps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `useremails`
--
ALTER TABLE `useremails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
