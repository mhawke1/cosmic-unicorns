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
-- Database: `cosmicu_db`
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
(1, 1, NULL, 'Join our mailing list to get special LAUNCH coupons ', 1590744550);

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
(2, 1, 'Pre-Paid  Code', 'PREPAID20', '0', '0', 'Prepaid', 1, 1591986036),
(3, 1, 'SAFEATHOME', 'SAFEATHOME', '0', '30', 'Order two books to qualify for FREE SHIPPING', 2, 1592286536),
(4, 1, 'UNICORN10', 'UNICORN10', '10', '29', '10% off entire order', 0, 1592287075),
(5, 1, 'COSMIC20', 'COSMIC20', '20', '100', '20% OFF ORDER', 0, 1592287220);

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
(1, 1, 'cosmicunicorns.com', 0, 0);

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
(1, 1, 'mandi', 1, 0, 0);

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
  `amount` varchar(255) DEFAULT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `coupon_type` int(11) NOT NULL DEFAULT '0',
  `billing_info` text,
  `order_id` int(11) NOT NULL DEFAULT '0',
  `order_count` int(11) NOT NULL DEFAULT '0',
  `ip` bigint(20) UNSIGNED NOT NULL,
  `timestamp` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `status`, `paid`, `refunded`, `shippedtocustomer`, `pdfdownloaded`, `senttoprinters`, `printing`, `paymentintent_response`, `paid_response`, `refunded_response`, `paymentprocessor`, `paymentintentid`, `paymentid`, `refundid`, `hair`, `haircolor`, `eyes`, `eyescolor`, `glasses`, `freckles`, `body`, `bodycolor`, `pages`, `childsname`, `lovenote`, `childspicture`, `quantity`, `type_id`, `amount`, `coupon_code`, `discount`, `coupon_type`, `billing_info`, `order_id`, `order_count`, `ip`, `timestamp`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, '{\"id\":\"pi_1GVpJQEzjqjqGxsYVUQAaj4S\",\"object\":\"payment_intent\",\"amount\":2900,\"amount_capturable\":0,\"amount_received\":0,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges?payment_intent=pi_1GVpJQEzjqjqGxsYVUQAaj4S\"},\"client_secret\":\"pi_1GVpJQEzjqjqGxsYVUQAaj4S_secret_8ubpCByh0NqekrDflhbg6V3ps\",\"confirmation_method\":\"automatic\",\"created\":1586396172,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":false,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":null,\"payment_method_options\":{\"card\":{\"installments\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"requires_payment_method\",\"transfer_data\":null,\"transfer_group\":null}', NULL, NULL, 1, 'pi_1GVpJQEzjqjqGxsYVUQAaj4S', NULL, NULL, 8, 3, 0, 2, 0, 0, 0, 1, '1-2-3-4-5-6-7-8-9-10', 'test', 'test', '/tmp/phpleuCdeimage1.JPG', 1, 1, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 1586396172),
(2, 0, 0, 0, 0, 0, 0, 0, '{\"id\":\"pi_1GdMn1KElFovmXYcNK9Dylur\",\"object\":\"payment_intent\",\"amount\":2900,\"amount_capturable\":0,\"amount_received\":0,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges?payment_intent=pi_1GdMn1KElFovmXYcNK9Dylur\"},\"client_secret\":\"pi_1GdMn1KElFovmXYcNK9Dylur_secret_MsN1R5wUWMoiuEQRDS78lAHcT\",\"confirmation_method\":\"automatic\",\"created\":1588193155,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":true,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":null,\"payment_method_options\":{\"card\":{\"installments\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"requires_payment_method\",\"transfer_data\":null,\"transfer_group\":null}', NULL, NULL, 1, 'pi_1GdMn1KElFovmXYcNK9Dylur', NULL, NULL, 8, 3, 0, 2, 0, 0, 0, 1, '1-2-3-5-4-6-7-9-8-10', 'tab', 'yytatrtr', '/tmp/phpFFq76M6330938_thumb.png', 1, 1, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 1588193155),
(3, 0, 0, 0, 0, 0, 0, 0, '{\"id\":\"pi_1GjiN4KElFovmXYcJztryyR4\",\"object\":\"payment_intent\",\"amount\":2900,\"amount_capturable\":0,\"amount_received\":0,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges?payment_intent=pi_1GjiN4KElFovmXYcJztryyR4\"},\"client_secret\":\"pi_1GjiN4KElFovmXYcJztryyR4_secret_B9K7dYVz1ukm14aiSOWjHhtaZ\",\"confirmation_method\":\"automatic\",\"created\":1589706082,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":true,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":null,\"payment_method_options\":{\"card\":{\"installments\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"requires_payment_method\",\"transfer_data\":null,\"transfer_group\":null}', NULL, NULL, 1, 'pi_1GjiN4KElFovmXYcJztryyR4', NULL, NULL, 8, 6, 1, 2, 0, 0, 1, 2, '4-5-3-2-1-6-7-8-9-10', 'gfggf', 'ghhjjgjg hghfffffffffffffffffffffffffffffffffffffffg', '/tmp/phpS0gwdTdadc7677ce1ccf6d4fbc85615d768c1f.jpg', 1, 1, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 1589706082),
(4, 0, 0, 0, 0, 0, 0, 0, '{\"id\":\"pi_1Gk0Q2KElFovmXYcr4FQpM7Y\",\"object\":\"payment_intent\",\"amount\":2900,\"amount_capturable\":0,\"amount_received\":0,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges?payment_intent=pi_1Gk0Q2KElFovmXYcr4FQpM7Y\"},\"client_secret\":\"pi_1Gk0Q2KElFovmXYcr4FQpM7Y_secret_kJcw5WJ8YTfTSGjnlfcrL7JtD\",\"confirmation_method\":\"automatic\",\"created\":1589775458,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":true,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":null,\"payment_method_options\":{\"card\":{\"installments\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"requires_payment_method\",\"transfer_data\":null,\"transfer_group\":null}', NULL, NULL, 1, 'pi_1Gk0Q2KElFovmXYcr4FQpM7Y', NULL, NULL, 8, 1, 0, 2, 1, 1, 0, 2, '1-2-3-4-5-6-7-8-9-10', 'rocky', 'bvbnvbnbvnbvbbn  cvbvnvbnb n bnvbnvnbn vnvbnhghgh ghghg hghghghghghghghgttttrtr56789asdfghjkl;\' \nghghghg\nhjhjhjhj\n', '/tmp/phpRNPrzIuser-lg.jpg', 1, 1, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 1589775458),
(5, 0, 1, 0, 0, 0, 0, 0, '{\"id\":\"pi_1Gn5a0KElFovmXYcals1Ycn2\",\"object\":\"payment_intent\",\"amount\":2900,\"amount_capturable\":0,\"amount_received\":0,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges?payment_intent=pi_1Gn5a0KElFovmXYcals1Ycn2\"},\"client_secret\":\"pi_1Gn5a0KElFovmXYcals1Ycn2_secret_saIeBLtc16Lgrf8XzZr8sKk4a\",\"confirmation_method\":\"automatic\",\"created\":1590510280,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":true,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":null,\"payment_method_options\":{\"card\":{\"installments\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"requires_payment_method\",\"transfer_data\":null,\"transfer_group\":null}', '{\"id\":\"evt_1Gn5anKElFovmXYcd8YkTeCI\",\"object\":\"event\",\"api_version\":\"2019-11-05\",\"created\":1590510328,\"data\":{\"object\":{\"id\":\"ch_1Gn5alKElFovmXYc99hxKQAj\",\"object\":\"charge\",\"amount\":2900,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_1Gn5amKElFovmXYcun8rD69a\",\"billing_details\":{\"address\":{\"city\":null,\"country\":null,\"line1\":null,\"line2\":null,\"postal_code\":\"92405\",\"state\":null},\"email\":null,\"name\":null,\"phone\":null},\"calculated_statement_descriptor\":\"COSMICUNICORNS.COM\",\"captured\":true,\"created\":1590510327,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"destination\":null,\"dispute\":null,\"disputed\":false,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":null,\"livemode\":true,\"metadata\":[],\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":\"pi_1Gn5a0KElFovmXYcals1Ycn2\",\"payment_method\":\"pm_1Gn5akKElFovmXYcglfQNjiV\",\"payment_method_details\":{\"card\":{\"brand\":\"visa\",\"checks\":{\"address_line1_check\":null,\"address_postal_code_check\":\"fail\",\"cvc_check\":\"pass\"},\"country\":\"US\",\"exp_month\":6,\"exp_year\":2022,\"fingerprint\":\"9gTtgo1grBq2LIG1\",\"funding\":\"prepaid\",\"installments\":null,\"last4\":\"0841\",\"network\":\"visa\",\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":\"vargassarai13@gmail.com\",\"receipt_number\":\"1048-5548\",\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/acct_1FfFkpKElFovmXYc\\/ch_1Gn5alKElFovmXYc99hxKQAj\\/rcpt_HLnBsIEIjnVDIZcYM6xBj4pPte05DaJ\",\"refunded\":false,\"refunds\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges\\/ch_1Gn5alKElFovmXYc99hxKQAj\\/refunds\"},\"review\":null,\"shipping\":{\"address\":{\"city\":\"Banning\",\"country\":\"United States\",\"line1\":\"525 N 4th street\",\"line2\":\"B\",\"postal_code\":\"92220\",\"state\":\"CA\"},\"carrier\":null,\"name\":\"Sarai Vargas\",\"phone\":\"(513) 253-5197\",\"tracking_number\":null},\"source\":null,\"source_transfer\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}},\"livemode\":true,\"pending_webhooks\":1,\"request\":{\"id\":\"req_3xcjOxFPcYusmB\",\"idempotency_key\":null},\"type\":\"charge.succeeded\"}', NULL, 1, 'pi_1Gn5a0KElFovmXYcals1Ycn2', 'ch_1Gn5alKElFovmXYc99hxKQAj', NULL, 10, 0, 0, 1, 0, 0, 0, 2, '1-2-3-5-7-8-14-15-16-17', 'Jesus', 'Jesus, \n\nFrom the moment you were born I knew you were special. Mommy loves you no matter what. Stay open minded and let your imagination explode with adventure. \n\nLove, \nMom', '/tmp/phpA8H6Bx3212EA9D-F55D-4D8D-B96C-79EC91666743.jpeg', 1, 1, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 1590510280),
(6, 0, 1, 0, 0, 0, 0, 0, '{\"id\":\"pi_1Gn5tBKElFovmXYcsbnk1ywF\",\"object\":\"payment_intent\",\"amount\":2900,\"amount_capturable\":0,\"amount_received\":0,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges?payment_intent=pi_1Gn5tBKElFovmXYcsbnk1ywF\"},\"client_secret\":\"pi_1Gn5tBKElFovmXYcsbnk1ywF_secret_Lke2pJ3Y6XKTJSzKnDzIVYhCV\",\"confirmation_method\":\"automatic\",\"created\":1590511469,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":true,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":null,\"payment_method_options\":{\"card\":{\"installments\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"requires_payment_method\",\"transfer_data\":null,\"transfer_group\":null}', '{\"id\":\"evt_1Gn5ujKElFovmXYcBvy1yuca\",\"object\":\"event\",\"api_version\":\"2019-11-05\",\"created\":1590511564,\"data\":{\"object\":{\"id\":\"ch_1Gn5uhKElFovmXYc22FEa0cG\",\"object\":\"charge\",\"amount\":2900,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_1Gn5uiKElFovmXYciXhLhMIs\",\"billing_details\":{\"address\":{\"city\":null,\"country\":null,\"line1\":null,\"line2\":null,\"postal_code\":\"24066\",\"state\":null},\"email\":null,\"name\":null,\"phone\":null},\"calculated_statement_descriptor\":\"COSMICUNICORNS.COM\",\"captured\":true,\"created\":1590511563,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"destination\":null,\"dispute\":null,\"disputed\":false,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":null,\"livemode\":true,\"metadata\":[],\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":\"pi_1Gn5tBKElFovmXYcsbnk1ywF\",\"payment_method\":\"pm_1Gn5uhKElFovmXYcAvTFbpkh\",\"payment_method_details\":{\"card\":{\"brand\":\"visa\",\"checks\":{\"address_line1_check\":null,\"address_postal_code_check\":\"pass\",\"cvc_check\":\"pass\"},\"country\":\"US\",\"exp_month\":8,\"exp_year\":2023,\"fingerprint\":\"RxiRaFhJVt571T3X\",\"funding\":\"debit\",\"installments\":null,\"last4\":\"1641\",\"network\":\"visa\",\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":\"Chris@chrisgdesign.com\",\"receipt_number\":\"1652-0834\",\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/acct_1FfFkpKElFovmXYc\\/ch_1Gn5uhKElFovmXYc22FEa0cG\\/rcpt_HLnVR7l3ZFTCCHwYHAdRm6hZxGgKt2P\",\"refunded\":false,\"refunds\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges\\/ch_1Gn5uhKElFovmXYc22FEa0cG\\/refunds\"},\"review\":null,\"shipping\":{\"address\":{\"city\":\"Buchanan\",\"country\":\"US\",\"line1\":\"5736 Lithia Road\",\"line2\":\"\",\"postal_code\":\"24066\",\"state\":\"VA\"},\"carrier\":null,\"name\":\"Chris Gilbo\",\"phone\":\"9545523006\",\"tracking_number\":null},\"source\":null,\"source_transfer\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}},\"livemode\":true,\"pending_webhooks\":1,\"request\":{\"id\":\"req_CrdbgI9ojsWzzd\",\"idempotency_key\":null},\"type\":\"charge.succeeded\"}', NULL, 1, 'pi_1Gn5tBKElFovmXYcsbnk1ywF', 'ch_1Gn5uhKElFovmXYc22FEa0cG', NULL, 6, 1, 0, 0, 0, 0, 0, 5, '5-7-9-13-14-15-16-17-19-20', 'Evie', 'Dear Evie,\nWe are so proud of how hard you have worked to learn to read. We love you so much!\nLove,\nMommy and Daddy', '/tmp/phpAVaXG0inbound7470308266166872565.jpg', 1, 1, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 1590511470),
(7, 0, 1, 0, 0, 0, 0, 0, '{\"id\":\"pi_1Gn6tWKElFovmXYc4SN3akLE\",\"object\":\"payment_intent\",\"amount\":2900,\"amount_capturable\":0,\"amount_received\":0,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges?payment_intent=pi_1Gn6tWKElFovmXYc4SN3akLE\"},\"client_secret\":\"pi_1Gn6tWKElFovmXYc4SN3akLE_secret_HKc8GMqvkSQBX0SvDiBnNSTov\",\"confirmation_method\":\"automatic\",\"created\":1590515334,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":true,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":null,\"payment_method_options\":{\"card\":{\"installments\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"requires_payment_method\",\"transfer_data\":null,\"transfer_group\":null}', '{\"id\":\"evt_1Gn6u5KElFovmXYch8WbVDIC\",\"object\":\"event\",\"api_version\":\"2019-11-05\",\"created\":1590515368,\"data\":{\"object\":{\"id\":\"ch_1Gn6u3KElFovmXYcOGSS0fTu\",\"object\":\"charge\",\"amount\":2900,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_1Gn6u4KElFovmXYcZootMLlw\",\"billing_details\":{\"address\":{\"city\":null,\"country\":null,\"line1\":null,\"line2\":null,\"postal_code\":\"92405\",\"state\":null},\"email\":null,\"name\":null,\"phone\":null},\"calculated_statement_descriptor\":\"COSMICUNICORNS.COM\",\"captured\":true,\"created\":1590515367,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"destination\":null,\"dispute\":null,\"disputed\":false,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":null,\"livemode\":true,\"metadata\":[],\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":\"pi_1Gn6tWKElFovmXYc4SN3akLE\",\"payment_method\":\"pm_1Gn6u2KElFovmXYcs7asUGAp\",\"payment_method_details\":{\"card\":{\"brand\":\"visa\",\"checks\":{\"address_line1_check\":null,\"address_postal_code_check\":\"fail\",\"cvc_check\":\"pass\"},\"country\":\"US\",\"exp_month\":6,\"exp_year\":2022,\"fingerprint\":\"9gTtgo1grBq2LIG1\",\"funding\":\"prepaid\",\"installments\":null,\"last4\":\"0841\",\"network\":\"visa\",\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":\"vargassarai13@gmail.com\",\"receipt_number\":\"1941-3445\",\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/acct_1FfFkpKElFovmXYc\\/ch_1Gn6u3KElFovmXYcOGSS0fTu\\/rcpt_HLoXQpekdxeHFKMZCDr6s13VE5qdE1t\",\"refunded\":false,\"refunds\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges\\/ch_1Gn6u3KElFovmXYcOGSS0fTu\\/refunds\"},\"review\":null,\"shipping\":{\"address\":{\"city\":\"Banning\",\"country\":\"United States\",\"line1\":\"525 N 4th street\",\"line2\":\"B\",\"postal_code\":\"92220\",\"state\":\"CA\"},\"carrier\":null,\"name\":\"Sarai Vargas\",\"phone\":\"(513) 253-5197\",\"tracking_number\":null},\"source\":null,\"source_transfer\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}},\"livemode\":true,\"pending_webhooks\":1,\"request\":{\"id\":\"req_qe2a4gw8E3JhQj\",\"idempotency_key\":null},\"type\":\"charge.succeeded\"}', NULL, 1, 'pi_1Gn6tWKElFovmXYc4SN3akLE', 'ch_1Gn6u3KElFovmXYcOGSS0fTu', NULL, 6, 4, 1, 1, 0, 0, 0, 4, '3-7-6-9-10-12-14-19-20-17', 'Ella ', 'My Dearest Daughter, \n\nElla when they told me you were a girl, I was so scared. Mommy didnâ€™t know what todo with a mini me. But you are growing to be so beautiful/strong & courageous.  I am truly blessed to have you baby girl. \n\nRemember, never let anyone take you beauty or Self a steam away. \n\nAlways remember to fly Mariposa. \n\nLove, \nMommy ', '/tmp/phpdQrtUnCD98AB54-8EE4-433B-B8FB-8968B85ABACC.jpeg', 1, 1, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 1590515334),
(8, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 5, 3, 0, 4, 0, 0, 1, 2, '6-7-8-9-10-12-13-14-15-16', 'River', 'test', 'Cosmic-Unicorns.png', 1, 1, '0', 'preorder', '34.00', 1, '{\"name\":\"Amanda (Crossroads) Amanda (Crossroads)\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"FL\",\"country\":\"United States\",\"phone\":\"19542137112\",\"email\":\"mandihawke@gmail.com\",\"postal_code\":\"33312\"}', 0, 1, 0, 1591233889),
(9, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 12, 1, 0, 2, 0, 0, 0, 4, '7-8-9-10-12-13-14-15-16-17', 'River', 'test', 'Cosmic-UnicornsHiRes-01.png', 1, 1, '0', 'preorder', '34.00', 1, '{\"name\":\"Amanda (Dragon) Amanda (Dragon)\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"FL\",\"country\":\"United States\",\"phone\":\"19542137112\",\"email\":\"mandihawke@gmail.com\",\"postal_code\":\"33312\"}', 0, 1, 0, 1591233988),
(10, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 9, 6, 0, 0, 0, 1, 0, 5, '10-12-13-14-15-16-17-19-20-9', 'River', 'test', 'Cosmic-UnicornsHiRes-01.png', 1, 1, '0', 'preorder', '66.00', 1, '{\"name\":\"Amanda (Music) Amanda (Music)\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"FL\",\"country\":\"United States\",\"phone\":\"19542137112\",\"email\":\"mandihawke@gmail.com\",\"postal_code\":\"33312\"}', 0, 1, 0, 1591234167),
(11, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 9, 6, 0, 0, 0, 1, 1, 5, '7-8-9-10-12-13-14-15-16-17', '0', 'test', 'Cosmic-Unicorns.png', 1, 1, '0', 'preorder', '66.00', 1, '{\"name\":\"Amanda (Music) Amanda (Music)\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"FL\",\"country\":\"United States\",\"phone\":\"19542137112\",\"email\":\"mandihawke@gmail.com\",\"postal_code\":\"33312\"}', 12, 2, 0, 1591234167),
(12, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 3, 1, 3, 0, 0, 0, 2, '1-2-3-4-5-6-7-8-9-10', 'River', 'test', 'Cosmic-UnicornsHiRes-01.png', 1, 1, '0', 'preorder', '34.00', 1, '{\"name\":\"Amanda (Camping) Amanda (Camping)\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"FL\",\"country\":\"United States\",\"phone\":\"19542137112\",\"email\":\"mandihawke@gmail.com\",\"postal_code\":\"33312\"}', 0, 1, 0, 1591233482),
(13, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 10, 0, 0, 1, 0, 0, 0, 1, '5-6-7-8-9-10-12-13-14-15', 'River', 'test', 'Cosmic-Unicorns.png', 1, 1, '0', 'preorder', '34.00', 1, '{\"name\":\"Amanda (Super Hero) Amanda (Super Hero)\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"FL\",\"country\":\"United States\",\"phone\":\"19542137112\",\"email\":\"mandihawke@gmail.com\",\"postal_code\":\"33312\"}', 0, 1, 0, 1591233579),
(14, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 2, 2, 0, 2, 1, 0, 0, 3, '12-13-14-15-16-17-19-20-9-10', 'River', 'test', 'Cosmic-Unicorns.png', 1, 1, '0', 'preorder', '34.00', 1, '{\"name\":\"Amanda (Picking Flowers) Amanda (Picking Flowers)\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"FL\",\"country\":\"United States\",\"phone\":\"19542137112\",\"email\":\"mandihawke@gmail.com\",\"postal_code\":\"33312\"}', 0, 1, 0, 1591233805),
(15, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 7, 2, 1, 1, 0, 0, 0, 0, '1-2-3-4-5-6-8-7-9-10', 'River', 'test', 'Cosmic-Unicorns.png', 1, 1, '0', 'preorder', '34.00', 1, '{\"name\":\"Amanda (Basketball) Amanda (Basketball)\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"FL\",\"country\":\"United States\",\"phone\":\"19542137112\",\"email\":\"mandihawke@gmail.com\",\"postal_code\":\"33312\"}', 0, 1, 0, 1591233371),
(16, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 3, 1, 0, 2, 0, 0, 1, 5, '1-2-3-4-5-6-7-8-9-10', 'River', 'tes test ', 'Cosmic-Unicorns.png', 1, 1, '0', 'preorder', '34.00', 1, '{\"name\":\"Amanda Amanda\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"FL\",\"country\":\"United States\",\"phone\":\"19542137112\",\"email\":\"mandihawke@gmail.com\",\"postal_code\":\"33312\"}', 0, 1, 0, 1591233129),
(17, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 0, 3, 0, 1, 0, 0, 0, 1, '10-12-13-9-14-15-16-17-19-20', 'River', 'test', 'Cosmic-Unicorns.png', 1, 1, '0', 'preorder', '34.00', 1, '{\"name\":\"Amanda (Playground) Amanda (Playground)\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"FL\",\"country\":\"United States\",\"phone\":\"19542137112\",\"email\":\"mandihawke@gmail.com\",\"postal_code\":\"33312\"}', 0, 1, 0, 1591234244),
(18, 0, 1, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 4, 1, 0, 0, 0, 0, 0, 3, '9-10-8-12-13-14-15-16-17-19', 'River', 'test', 'Cosmic-UnicornsHiRes-01.png', 1, 1, '0', 'preorder', '34.00', 1, '{\"name\":\"Amanda (Space) Amanda (Space)\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"FL\",\"country\":\"United States\",\"phone\":\"19542137112\",\"email\":\"mandihawke@gmail.com\",\"postal_code\":\"33312\"}', 0, 1, 0, 1591234326),
(19, 0, 0, 0, 0, 0, 0, 0, '{\"id\":\"pi_1Gq7yAKElFovmXYcTUt2GsTy\",\"object\":\"payment_intent\",\"amount\":3400,\"amount_capturable\":0,\"amount_received\":0,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges?payment_intent=pi_1Gq7yAKElFovmXYcTUt2GsTy\"},\"client_secret\":\"pi_1Gq7yAKElFovmXYcTUt2GsTy_secret_peD8wvykyHMEJwnGLXtTdH7M9\",\"confirmation_method\":\"automatic\",\"created\":1591234450,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":false,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":null,\"payment_method_options\":{\"card\":{\"installments\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"requires_payment_method\",\"transfer_data\":null,\"transfer_group\":null}', NULL, NULL, 1, 'pi_1Gq7yAKElFovmXYcTUt2GsTy', NULL, NULL, 8, 3, 0, 2, 0, 0, 0, 1, '1-2-3-4-5-6-7-8-9-10', 'Test', 'tests', 'Cosmic-Unicorns.png', 1, 1, '34.00', '', '', 0, NULL, 0, 1, 0, 1591234450),
(20, 0, 0, 0, 0, 0, 0, 0, '{\"id\":\"pi_1GqO93KElFovmXYcKoqzsGJ9\",\"object\":\"payment_intent\",\"amount\":3400,\"amount_capturable\":0,\"amount_received\":0,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges?payment_intent=pi_1GqO93KElFovmXYcKoqzsGJ9\"},\"client_secret\":\"pi_1GqO93KElFovmXYcKoqzsGJ9_secret_SCaM2hPGfhqaepYECEcfOsKeH\",\"confirmation_method\":\"automatic\",\"created\":1591296629,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":false,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":null,\"payment_method_options\":{\"card\":{\"installments\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"requires_payment_method\",\"transfer_data\":null,\"transfer_group\":null}', NULL, NULL, 1, 'pi_1GqO93KElFovmXYcKoqzsGJ9', NULL, NULL, 8, 3, 0, 2, 0, 0, 0, 1, '1-2-3-4-5-6-7-8-9-10', 'ghh', 'vbc', '43680054335_840e380120_b.jpg', 1, 1, '34.00', '', '', 0, NULL, 0, 1, 0, 1591296630),
(21, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 6, 2, 1, 4, 1, 0, 0, 4, '1-3-4-5-6-7-12-14-17-16', 'Jessica', '\r\nCosmic Unicorns exists because\r\nfamilies of all diverse make-ups\r\ndeserve representation and\r\ninclusion. \r\n\r\nThe positive impact of seeing\r\nsomeone who looks like you\r\nin media cannot be \r\nhighlighted enough! \r\n\r\nJoin the Movement!\r\nFB @cosmicunicorns\r\nIG cosmic_unicorns_official\r\nCosmicUnicorns.com', 'Cosmic-Unicorns Logo White Letter HiRes-01.png', 1, 1, '0', 'prepaid20', '34.00', 1, '{\"name\":\"Mandi & Jessica Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"FL\",\"country\":\"United States\",\"phone\":\"9542137112\",\"email\":\"mandihawke@gmail.com\",\"postal_code\":\"33312\"}', 0, 1, 0, 1593662239),
(22, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 6, 5, 0, 0, 0, 1, 0, 4, '1-5-6-7-9-14-15-19-16-17', 'Evie', 'Dear Evie,\r\n\r\nAlways dream big...we love you to the moon and back!\r\n\r\nMommy & Daddy', 'family-pic-1.jpg', 1, 1, '0', 'prepaid20', '34.00', 1, '{\"name\":\"Chris Gilbo\",\"line1\":\"5736 Lithia Road\",\"line2\":\"\",\"city\":\"Buchanan\",\"state\":\"VA\",\"country\":\"United States\",\"phone\":\"9545523006\",\"email\":\"chris@chrisgdesign.com\",\"postal_code\":\"24066\"}', 0, 1, 0, 1593805235),
(23, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 8, 3, 0, 2, 0, 0, 0, 1, '1-2-3-4-5-6-7-8-9-10', 'Dedication', '\r\nCosmic Unicorns exists because\r\nfamilies of all diverse make-ups\r\ndeserve representation and\r\ninclusion. \r\n\r\nThe positive impact of seeing\r\nsomeone who looks like you\r\nin books, photos, and video \r\ncannot be highlighted enough!\r\n\r\nJoin the Movement!\r\nFB @CosmicUnicorns\r\nIG @Cosmic_Unicorns_Official\r\nCosmicUnicorns.com\r\n', '1594355917.png', 1, 1, '0', 'prepaid20', '34.00', 1, '{\"name\":\"Mandi Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"7543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, 0, 1594356551),
(24, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 8, 3, 0, 2, 0, 0, 0, 1, '1-2-3-4-5-6-7-8-9-10', 'Evie', 'test', '1594357172.jpg', 1, 1, '0', 'prepaid20', '34.00', 1, '{\"name\":\"Chris PhotoPage\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"7543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, 0, 1594357253),
(25, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 2, 1, 1, 2, 0, 0, 1, 5, '4-3-2-1-5-6-7-8-9-10', 'TestDocumentSize', 'test', '1594967007.png', 1, 1, '0', 'prepaid20', '34.00', 1, '{\"name\":\"Test Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"7543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, 0, 1594967030),
(26, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 2, 1, 1, 2, 0, 0, 1, 5, '4-3-15-2-1-5-6-7-8-9', 'Aspen', 'testtt', '1594967160.png', 1, 1, '0', 'prepaid20', '34.00', 1, '{\"name\":\"AspenTest Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"7543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, 0, 1594967178),
(27, 0, 1, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 10, 0, 0, 1, 0, 0, 0, 2, '1-2-3-8-14-15-16-17-7-5', 'Jesus', '\r\nJesus, \r\n\r\nFrom the moment you were born, I knew you were special. Mommy loves you no matter what. Stay open-minded and let your imagination explode with adventure. \r\n\r\nLove \r\nMom', '1595277395.jpeg', 1, 1, '0', 'prepaid20', '34.00', 1, '{\"name\":\"JesseTestOrder Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"7543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, 0, 1595277441),
(28, 0, 1, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 6, 1, 2, 1, 0, 1, 2, '4-6-9-10-12-13-19-20-17-16', 'Test7', 'test', '1595279120.jpeg', 1, 1, '0', 'prepaid20', '34.00', 1, '{\"name\":\"Mandi Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"7543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, 0, 1595279163),
(29, 0, 1, 0, 0, 0, 0, 0, '{\"id\":\"pi_1HB0asKElFovmXYcrF5O9Kll\",\"object\":\"payment_intent\",\"amount\":3400,\"amount_capturable\":0,\"amount_received\":0,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges?payment_intent=pi_1HB0asKElFovmXYcrF5O9Kll\"},\"client_secret\":\"pi_1HB0asKElFovmXYcrF5O9Kll_secret_X3kOaktX2YW8wJCCitELiFsCp\",\"confirmation_method\":\"automatic\",\"created\":1596210986,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":true,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":null,\"payment_method_options\":{\"card\":{\"installments\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"requires_payment_method\",\"transfer_data\":null,\"transfer_group\":null}', '{\"id\":\"evt_1HB0bBKElFovmXYcOXSkauvs\",\"object\":\"event\",\"api_version\":\"2019-11-05\",\"created\":1596211005,\"data\":{\"object\":{\"id\":\"ch_1HB0bAKElFovmXYci1OkwvUS\",\"object\":\"charge\",\"amount\":3400,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_1HB0bBKElFovmXYcFb8HHRqd\",\"billing_details\":{\"address\":{\"city\":null,\"country\":null,\"line1\":null,\"line2\":null,\"postal_code\":\"44312\",\"state\":null},\"email\":null,\"name\":null,\"phone\":null},\"calculated_statement_descriptor\":\"COSMICUNICORNS.COM\",\"captured\":true,\"created\":1596211004,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"destination\":null,\"dispute\":null,\"disputed\":false,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":null,\"livemode\":true,\"metadata\":[],\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":\"pi_1HB0asKElFovmXYcrF5O9Kll\",\"payment_method\":\"pm_1HB0b9KElFovmXYcSxSlLdqj\",\"payment_method_details\":{\"card\":{\"brand\":\"amex\",\"checks\":{\"address_line1_check\":null,\"address_postal_code_check\":\"pass\",\"cvc_check\":\"pass\"},\"country\":\"US\",\"exp_month\":6,\"exp_year\":2025,\"fingerprint\":\"EyyoHwCeNygeAvTe\",\"funding\":\"credit\",\"installments\":null,\"last4\":\"1008\",\"network\":\"amex\",\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":\"sarah.theliteracyloop@gmail.com\",\"receipt_number\":\"1928-1731\",\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/acct_1FfFkpKElFovmXYc\\/ch_1HB0bAKElFovmXYci1OkwvUS\\/rcpt_HkVcKpHFTAgMUHnp3w0u6Hxxqri8OLx\",\"refunded\":false,\"refunds\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges\\/ch_1HB0bAKElFovmXYci1OkwvUS\\/refunds\"},\"review\":null,\"shipping\":{\"address\":{\"city\":\"Akron\",\"country\":\"United States\",\"line1\":\"211 Hilbish Ave\",\"line2\":\"\",\"postal_code\":\"44312\",\"state\":\"OH\"},\"carrier\":null,\"name\":\"Sarah McIntyre\",\"phone\":\"9013346687\",\"tracking_number\":null},\"source\":null,\"source_transfer\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}},\"livemode\":true,\"pending_webhooks\":2,\"request\":{\"id\":\"req_G6fzouICvzOqEJ\",\"idempotency_key\":null},\"type\":\"charge.succeeded\"}', NULL, 1, 'pi_1HB0asKElFovmXYcrF5O9Kll', 'ch_1HB0bAKElFovmXYci1OkwvUS', NULL, 3, 4, 1, 1, 1, 0, 0, 2, '14-19-10-7-12-9-5-6-17-3', 'Miss Mack', 'Dear Little Rainbows, \r\n\r\nI created this book just to share with you! I am excited to watch you grow and learn this school year. \r\nRemember that I love you so much!\r\n\r\n- Miss Mack', '1596210945.jpg', 1, 1, '34.00', '', '', 0, NULL, 0, 1, 0, 1596210986),
(30, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 3, 0, 2, 0, 0, 1, 2, '2-3-4-5-8-9-10-13-14-15', 'Test', 'test', '1596575116.jpg', 1, 1, '0', 'prepaid20', '34.00', 1, '{\"name\":\"Mandi Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"7543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, 0, 1596575130),
(31, 0, 1, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 7, 0, 1, 1, 0, 0, 0, 2, '14-19-7-3-5-9-10-20-12-13', 'Azuri', 'Little Muffin, \r\nI hope you enjoy your book of adventures. One day when you get older we will take you on them.\r\nLove,\r\nPop pop & Gamma', '1596590698.jpeg', 1, 1, '0', 'PREPAID20', '34.00', 1, '{\"name\":\"Aspen Hawke\",\"line1\":\"7810 NW 72nd Ave\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"3053084260\",\"email\":\"hawke.aspen@gmail.com\",\"postal_code\":\"33321\"}', 0, 1, 0, 1596590751),
(32, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 12, 1, 0, 0, 0, 0, 0, 5, '5-7-10-13-14-15-16-19-20-1', 'James', 'James,\r\n\r\nYou are such a smart and caring young man.  You impress us everyday.  We are very proud of you!\r\n\r\nLove,\r\n\r\nMom & Dad', '1597621182.jpg', 1, 1, '0', 'PREPAID20', '66.00', 1, '{\"name\":\"Sarah Clark\",\"line1\":\"4157 Mendenhall Drive\",\"line2\":\"\",\"city\":\"Dallas\",\"state\":\"TX\",\"country\":\"United States\",\"phone\":\"2144982339\",\"email\":\"seclark99@gmail.com\",\"postal_code\":\"75244\"}', 0, 1, 0, 1597621619),
(33, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 8, 1, 0, 0, 0, 0, 0, 5, '1-3-4-5-7-10-13-15-16-20', 'Thomas', 'Thomas,\r\n\r\nBig adventures await.  You impress us everyday as you grow.  You are able to express yourself very well at 3 years old.  We love you!  \r\n\r\nMom & Dad', '1597621505.jpg', 1, 1, '0', 'PREPAID20', '66.00', 1, '{\"name\":\"Sarah Clark\",\"line1\":\"4157 Mendenhall Drive\",\"line2\":\"\",\"city\":\"Dallas\",\"state\":\"TX\",\"country\":\"United States\",\"phone\":\"2144982339\",\"email\":\"seclark99@gmail.com\",\"postal_code\":\"75244\"}', 32, 2, 0, 1597621619),
(34, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 6, 4, 1, 1, 0, 0, 0, 4, '3-6-7-9-10-12-14-17-19-20', 'Ella', 'My Dearest Daughter, \r\n\r\nElla when they told me you were a girl, I was so scared. Mommy didn\'t know what to do with a mini-me. But you are growing to be so beautiful/strong & courageous. I am truly blessed to have you, baby girl. \r\n\r\nRemember, never let anyone take your beauty or self-esteem away. \r\n\r\nAlways remember to fly Mariposa. \r\n\r\nLove, Mommy', '1599542390.jpg', 1, 1, '0', 'prepaid20', '34.00', 1, '{\"name\":\"Sarai Vargas\",\"line1\":\"525 N 4th Street\",\"line2\":\"B\",\"city\":\"Banning\",\"state\":\"CA\",\"country\":\"United states\",\"phone\":\"5132535197\",\"email\":\"vargassarai13@gmail.com\",\"postal_code\":\"92220\"}', 0, 1, 0, 1599542780),
(35, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 5, 3, 0, 2, 0, 0, 0, 1, '1-2-3-4-5-6-7-8-9-10', 'Hair down', 'test', '1601064983.png', 1, 1, '0', 'prepaid20', '34.00', 1, '{\"name\":\"Mandi Hawke\",\"line1\":\"7810 NW 72nd Avenue\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"Florida\",\"country\":\"United States\",\"phone\":\"7543009292\",\"email\":\"mandi@cosmicunicorns.com\",\"postal_code\":\"33312\"}', 0, 1, 0, 1601065013),
(36, 0, 0, 0, 0, 0, 0, 0, '{\"id\":\"pi_1Ha3YqKElFovmXYcD96Mv6pI\",\"object\":\"payment_intent\",\"amount\":3400,\"amount_capturable\":0,\"amount_received\":0,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges?payment_intent=pi_1Ha3YqKElFovmXYcD96Mv6pI\"},\"client_secret\":\"pi_1Ha3YqKElFovmXYcD96Mv6pI_secret_V6U2CpIRq6ZZLBFER8LJkD9ft\",\"confirmation_method\":\"automatic\",\"created\":1602180592,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":true,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":null,\"payment_method_options\":{\"card\":{\"installments\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"requires_payment_method\",\"transfer_data\":null,\"transfer_group\":null}', NULL, NULL, 1, 'pi_1Ha3YqKElFovmXYcD96Mv6pI', NULL, NULL, 8, 6, 0, 2, 0, 0, 0, 1, '4-5-3-2-1-6-7-8-9-10', 'Amira', 'afsd dsfsdf', '1602180585.png', 1, 1, '34.00', '', '', 0, NULL, 0, 1, 0, 1602180593),
(37, 0, 0, 0, 0, 0, 0, 0, '{\"id\":\"pi_1He2BpKElFovmXYc50RT3E44\",\"object\":\"payment_intent\",\"amount\":3400,\"amount_capturable\":0,\"amount_received\":0,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges?payment_intent=pi_1He2BpKElFovmXYc50RT3E44\"},\"client_secret\":\"pi_1He2BpKElFovmXYc50RT3E44_secret_v43yzWm4dXa5t8EowueLEQj5V\",\"confirmation_method\":\"automatic\",\"created\":1603128633,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":true,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":null,\"payment_method_options\":{\"card\":{\"installments\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"requires_payment_method\",\"transfer_data\":null,\"transfer_group\":null}', NULL, NULL, 1, 'pi_1He2BpKElFovmXYc50RT3E44', NULL, NULL, 1, 1, 0, 2, 1, 0, 0, 4, '2-3-4-7-15-17-19-20-13-14', 'Mohammed', 'Test test test test test test test', '1603128619.jpg', 1, 1, '34.00', '', '', 0, NULL, 0, 1, 0, 1603128633),
(38, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 4, 4, 1, 1, 0, 0, 0, 2, '14-13-12-10-19-20-6-17-4-3', 'Luna', 'Blessings Luna & Flacon Birds!\r\n\r\nWishing you all the kind and curious adventures in learning, loving, jumping, swimming, laughing, hugging, eating, sleeping, and reading! \r\nI miss you all dearly and look forward to our next adventure together, full flight and a howl at the moon. \r\nUntil then, sending pages and pages of colorful joys!\r\n\r\nBig LOVE & HUGS, \r\nTia Tab-wahhhhhhh-tha! \r\n(2020)', '1603144061.jpg', 1, 1, '0', 'prepaid20', '34.00', 1, '{\"name\":\"Tabatha Mudra\",\"line1\":\"1310 SW 2nd Court\",\"line2\":\"#112\",\"city\":\"Fort Lauderdale\",\"state\":\"FL\",\"country\":\"USA\",\"phone\":\"954-612-4489\",\"email\":\"TabathaMudra@gmail.com\",\"postal_code\":\"33312\"}', 0, 1, 0, 1603144624),
(39, 0, 0, 0, 0, 0, 0, 0, '{\"id\":\"pi_1HfJUCKElFovmXYcE26C8yDK\",\"object\":\"payment_intent\",\"amount\":3400,\"amount_capturable\":0,\"amount_received\":0,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges?payment_intent=pi_1HfJUCKElFovmXYcE26C8yDK\"},\"client_secret\":\"pi_1HfJUCKElFovmXYcE26C8yDK_secret_a7v72DFsTIiOcsgpuAiJc3VpA\",\"confirmation_method\":\"automatic\",\"created\":1603433448,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":true,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":null,\"payment_method_options\":{\"card\":{\"installments\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"requires_payment_method\",\"transfer_data\":null,\"transfer_group\":null}', NULL, NULL, 1, 'pi_1HfJUCKElFovmXYcE26C8yDK', NULL, NULL, 1, 5, 0, 2, 2, 0, 0, 5, '6-7-8-5-4-3-2-1-10-12', 'chintu', '\r\nDear Skyler,\r\n				   \r\nwishing you the Happiest Birthay! We hope you love this personalized book as much as we do! We can\'t wait to see you in a few months and read this to you! Love you so much!\r\n\r\nLove Grandma and Papa', '1603433345.png', 1, 1, '34.00', '', '', 0, NULL, 0, 1, 0, 1603433448),
(40, 0, 0, 0, 0, 0, 0, 0, '{\"id\":\"pi_1HfQJgKElFovmXYc9WikNIsE\",\"object\":\"payment_intent\",\"amount\":6600,\"amount_capturable\":0,\"amount_received\":0,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges?payment_intent=pi_1HfQJgKElFovmXYc9WikNIsE\"},\"client_secret\":\"pi_1HfQJgKElFovmXYc9WikNIsE_secret_GirxVKh815fLtN93igoDq8Rwg\",\"confirmation_method\":\"automatic\",\"created\":1603459704,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":true,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":null,\"payment_method_options\":{\"card\":{\"installments\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"requires_payment_method\",\"transfer_data\":null,\"transfer_group\":null}', NULL, NULL, 1, 'pi_1HfQJgKElFovmXYc9WikNIsE', NULL, NULL, 5, 1, 1, 2, 2, 1, 0, 4, '1-2-3-4-5-8-9-10-12-7', 'Test123', 'test', '1603439117.jpg', 1, 1, '66.00', '', '', 0, NULL, 0, 1, 0, 1603459704),
(41, 0, 0, 0, 0, 0, 0, 0, '{\"id\":\"pi_1HfQJgKElFovmXYc9WikNIsE\",\"object\":\"payment_intent\",\"amount\":6600,\"amount_capturable\":0,\"amount_received\":0,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges?payment_intent=pi_1HfQJgKElFovmXYc9WikNIsE\"},\"client_secret\":\"pi_1HfQJgKElFovmXYc9WikNIsE_secret_GirxVKh815fLtN93igoDq8Rwg\",\"confirmation_method\":\"automatic\",\"created\":1603459704,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":true,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":null,\"payment_method_options\":{\"card\":{\"installments\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"requires_payment_method\",\"transfer_data\":null,\"transfer_group\":null}', NULL, NULL, 1, 'pi_1HfQJgKElFovmXYc9WikNIsE', NULL, NULL, 7, 1, 1, 2, 2, 1, 0, 0, '1-2-3-4-5-8-9-10-12-7', 'prash', 'edvvcxv', '1603459637.jpg', 1, 1, '66.00', '', '', 0, NULL, 40, 2, 0, 1603459704),
(42, 0, 0, 0, 0, 0, 0, 0, '{\"id\":\"pi_1HfQpiKElFovmXYcov7imY46\",\"object\":\"payment_intent\",\"amount\":6600,\"amount_capturable\":0,\"amount_received\":0,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges?payment_intent=pi_1HfQpiKElFovmXYcov7imY46\"},\"client_secret\":\"pi_1HfQpiKElFovmXYcov7imY46_secret_j5AVwsb1fe95cEYSdTcCFEVAC\",\"confirmation_method\":\"automatic\",\"created\":1603461690,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":true,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":null,\"payment_method_options\":{\"card\":{\"installments\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"requires_payment_method\",\"transfer_data\":null,\"transfer_group\":null}', NULL, NULL, 1, 'pi_1HfQpiKElFovmXYcov7imY46', NULL, NULL, 5, 1, 1, 2, 2, 1, 0, 4, '1-2-3-4-5-8-9-10-12-7', 'Test123', 'test', '1603439117.jpg', 1, 1, '66.00', '', '', 0, NULL, 0, 1, 0, 1603461690);
INSERT INTO `payments` (`id`, `status`, `paid`, `refunded`, `shippedtocustomer`, `pdfdownloaded`, `senttoprinters`, `printing`, `paymentintent_response`, `paid_response`, `refunded_response`, `paymentprocessor`, `paymentintentid`, `paymentid`, `refundid`, `hair`, `haircolor`, `eyes`, `eyescolor`, `glasses`, `freckles`, `body`, `bodycolor`, `pages`, `childsname`, `lovenote`, `childspicture`, `quantity`, `type_id`, `amount`, `coupon_code`, `discount`, `coupon_type`, `billing_info`, `order_id`, `order_count`, `ip`, `timestamp`) VALUES
(43, 0, 0, 0, 0, 0, 0, 0, '{\"id\":\"pi_1HfQpiKElFovmXYcov7imY46\",\"object\":\"payment_intent\",\"amount\":6600,\"amount_capturable\":0,\"amount_received\":0,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges?payment_intent=pi_1HfQpiKElFovmXYcov7imY46\"},\"client_secret\":\"pi_1HfQpiKElFovmXYcov7imY46_secret_j5AVwsb1fe95cEYSdTcCFEVAC\",\"confirmation_method\":\"automatic\",\"created\":1603461690,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":true,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":null,\"payment_method_options\":{\"card\":{\"installments\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"requires_payment_method\",\"transfer_data\":null,\"transfer_group\":null}', NULL, NULL, 1, 'pi_1HfQpiKElFovmXYcov7imY46', NULL, NULL, 7, 1, 1, 2, 2, 1, 0, 0, '1-2-3-4-5-8-9-10-12-7', 'prash', 'edvvcxv', '1603459637.jpg', 1, 1, '66.00', '', '', 0, NULL, 42, 2, 0, 1603461690),
(44, 0, 0, 0, 0, 0, 0, 0, '{\"id\":\"pi_1HfjeJKElFovmXYcvCLDnqKH\",\"object\":\"payment_intent\",\"amount\":6600,\"amount_capturable\":0,\"amount_received\":0,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges?payment_intent=pi_1HfjeJKElFovmXYcvCLDnqKH\"},\"client_secret\":\"pi_1HfjeJKElFovmXYcvCLDnqKH_secret_IFsmPB8u2ZTBOZH9N7vRCkSTE\",\"confirmation_method\":\"automatic\",\"created\":1603534019,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":true,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":null,\"payment_method_options\":{\"card\":{\"installments\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"requires_payment_method\",\"transfer_data\":null,\"transfer_group\":null}', NULL, NULL, 1, 'pi_1HfjeJKElFovmXYcvCLDnqKH', NULL, NULL, 1, 5, 0, 2, 2, 0, 0, 5, '6-7-8-5-4-3-2-1-10-12', 'chintu', '\r\nDear Skyler,\r\n				   \r\nwishing you the Happiest Birthay! We hope you love this personalized book as much as we do! We can\'t wait to see you in a few months and read this to you! Love you so much!\r\n\r\nLove Grandma and Papa', '1603433345.png', 1, 1, '66.00', '', '', 0, NULL, 0, 1, 0, 1603534019),
(45, 0, 0, 0, 0, 0, 0, 0, '{\"id\":\"pi_1HfjeJKElFovmXYcvCLDnqKH\",\"object\":\"payment_intent\",\"amount\":6600,\"amount_capturable\":0,\"amount_received\":0,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges?payment_intent=pi_1HfjeJKElFovmXYcvCLDnqKH\"},\"client_secret\":\"pi_1HfjeJKElFovmXYcvCLDnqKH_secret_IFsmPB8u2ZTBOZH9N7vRCkSTE\",\"confirmation_method\":\"automatic\",\"created\":1603534019,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":true,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":null,\"payment_method_options\":{\"card\":{\"installments\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"requires_payment_method\",\"transfer_data\":null,\"transfer_group\":null}', NULL, NULL, 1, 'pi_1HfjeJKElFovmXYcvCLDnqKH', NULL, NULL, 1, 6, 1, 2, 2, 0, 0, 1, '15-16-17-19-20-14-13-12-10-9', 'Fakru', 'asdasd s af ', '1603533998.png', 1, 1, '66.00', '', '', 0, NULL, 44, 2, 0, 1603534019),
(46, 0, 0, 0, 0, 0, 0, 0, '{\"id\":\"pi_1HgYMLKElFovmXYc6Z0RqTEQ\",\"object\":\"payment_intent\",\"amount\":6600,\"amount_capturable\":0,\"amount_received\":0,\"application\":null,\"application_fee_amount\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic\",\"charges\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges?payment_intent=pi_1HgYMLKElFovmXYc6Z0RqTEQ\"},\"client_secret\":\"pi_1HgYMLKElFovmXYc6Z0RqTEQ_secret_yyw0iiH0jKIosPpuIGWtD8A2B\",\"confirmation_method\":\"automatic\",\"created\":1603728949,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"livemode\":true,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":null,\"payment_method_options\":{\"card\":{\"installments\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"requires_payment_method\",\"transfer_data\":null,\"transfer_group\":null}', NULL, NULL, 1, 'pi_1HgYMLKElFovmXYc6Z0RqTEQ', NULL, NULL, 1, 1, 0, 2, 0, 0, 0, 5, '2-5-14-13-12-10-9-7-6-8', 'fqwqfq', 'dearrr', '1603728854.png', 2, 1, '66.00', '', '', 0, NULL, 0, 1, 0, 1603728949),
(47, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 8, 3, 0, 2, 0, 0, 0, 1, '1-2-3-4-5-6-7-8-9-10', 'River', 'test', '1604006267.jpg', 1, 1, '0', 'prepaid20', '34.00', 1, '{\"name\":\"Mandi Hawke\",\"line1\":\"7810 NW 72nd Ave\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"FL\",\"country\":\"USA\",\"phone\":\"9542137112\",\"email\":\"mandihawke@gmail.com\",\"postal_code\":\"33321\"}', 0, 1, 0, 1604006362),
(48, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, 8, 3, 0, 2, 0, 0, 0, 1, '1-2-3-4-5-6-7-8-9-10', 'River', 'test', '1604007044.jpg', 1, 1, '0', 'prepaid20', '34.00', 1, '{\"name\":\"Mandi Hawke\",\"line1\":\"7810 NW 72nd Ave\",\"line2\":\"\",\"city\":\"Tamarac\",\"state\":\"FL\",\"country\":\"United States\",\"phone\":\"9542137112\",\"email\":\"mandihawke@gmail.com\",\"postal_code\":\"33321\"}', 0, 1, 0, 1604007082);

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
(1, 1, 1, 1, 0, 0);

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
(1, 1, 0, 'Cosmic', 'Unicorns', '$2y$10$G59zXoPRaFqLrwsjvGVr3eKfXA4j.UgODWrWhVO8GEVQ8W8tvkFdC', 0, 0);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `domains`
--
ALTER TABLE `domains`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ip`
--
ALTER TABLE `ip`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `timestamps`
--
ALTER TABLE `timestamps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `useremails`
--
ALTER TABLE `useremails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
