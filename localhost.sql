-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 31, 2015 at 02:50 PM
-- Server version: 5.5.44-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `yii_tour`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_general`
--

CREATE TABLE IF NOT EXISTS `tbl_general` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(200) NOT NULL,
  `company_id` varchar(200) NOT NULL,
  `year` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Dumping data for table `tbl_general`
--

INSERT INTO `tbl_general` (`id`, `company_name`, `company_id`, `year`) VALUES
(61, 'FASTRACK SDN BHD', '111', 2010),
(60, 'FASTRACK SDN BHD', '111', 2011),
(62, 'FASTRACK SDN BHD', '111', 2009);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item`
--

CREATE TABLE IF NOT EXISTS `tbl_item` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `isMandatory` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=131 ;

--
-- Dumping data for table `tbl_item`
--

INSERT INTO `tbl_item` (`id`, `name`, `category`, `isMandatory`) VALUES
(1, 'Property, Plant & Equipment (PPE)', 'NON CURRENT ASSET', b'1'),
(2, 'Investment in Subsidiary Companies', 'NON CURRENT ASSET', b'1'),
(3, 'Development Cost', 'NON CURRENT ASSET', b'0'),
(4, 'Other Investment', 'NON CURRENT ASSET', b'0'),
(5, 'Trade Receivables', 'CURRENT ASSETS', b'1'),
(6, ' Other Receivables', 'CURRENT ASSETS', b'1'),
(7, 'Account Receivables', 'CURRENT ASSETS', b'1'),
(8, 'Account Payables', 'CURRENT ASSETS', b'1'),
(9, 'Inventory', 'CURRENT ASSETS', b'1'),
(10, 'Cash & Bank Balance', 'CURRENT ASSETS', b'1'),
(11, 'Income tax recoverable', 'CURRENT ASSETS', b'0'),
(12, ' Other Assets', 'CURRENT ASSETS', b'1'),
(13, 'Trade Payables', 'CURRENT LIABILITIES', b'1'),
(14, 'Tax payable', 'CURRENT LIABILITIES', b'1'),
(15, 'Short Term Debt', 'CURRENT LIABILITIES', b'1'),
(16, 'Hire Purchase Payables', 'CURRENT LIABILITIES', b'0'),
(17, 'Bank Overdrafts', 'CURRENT LIABILITIES', b'0'),
(18, '(Accumulated Loss)/Retained Profit', 'FINANCED BY / EQUITY', b'1'),
(19, 'Share Capital', 'FINANCED BY / EQUITY', b'1'),
(20, 'Preference Shares Shareholders Fund', 'FINANCED BY / EQUITY', b'1'),
(21, 'Foreign Exchange Reserve', 'FINANCED BY / EQUITY', b'1'),
(23, 'Minority Interests', 'FINANCED BY / EQUITY', b'1'),
(24, 'Working Capital', 'FINANCED BY / EQUITY', b'1'),
(25, 'Revenue', 'REVENUE', b'1'),
(26, 'Opening Stock', 'COST OF GOOD SOLD', b'1'),
(27, 'Purchases', 'COST OF GOOD SOLD', b'1'),
(28, 'Closing Stock', 'COST OF GOOD SOLD', b'1'),
(36, 'Other Operating Income', 'OTHER INCOME', b'1'),
(40, 'Interest Expenses', 'EXPENSES', b'0'),
(41, 'Gain on Disposal of Long-Term Investment', 'EXPENSES', b'0'),
(42, 'Dividend Income (growth)', 'EXPENSES', b'0'),
(43, 'Interest Income', 'EXPENSES', b'0'),
(44, 'Direct operating expenses', 'EXPENSES', b'0'),
(46, 'Cash Paid To Supplier and Employees', 'CASH FLOW FROM OPERATING ACTIVITIES', b'0'),
(47, 'Interest Paid', 'CASH FLOW FROM OPERATING ACTIVITIES', b'0'),
(49, 'Disposal of Plant', 'CASH FLOW FROM INVESTING ACTIVITIES', b'0'),
(50, 'Acquisition of Plant', 'CASH FLOW FROM INVESTING ACTIVITIES', b'0'),
(51, 'Disposal of Long-Term Investment', 'CASH FLOW FROM INVESTING ACTIVITIES', b'0'),
(52, 'Interest Received', 'CASH FLOW FROM INVESTING ACTIVITIES', b'0'),
(53, 'Dividend Received', 'CASH FLOW FROM INVESTING ACTIVITIES', b'0'),
(54, 'Net Cash Inflow for the Period', 'NET CASH INFLOW FROM FINANCING ACTIVITIES', b'1'),
(55, 'Opening Cash and Cash Equivalent', 'NET CASH INFLOW FROM FINANCING ACTIVITIES', b'1'),
(56, 'Hire Purchase Payables N.C.L', 'NON-CURRENT LIABILITIES', b'0'),
(57, 'Deferred Tax Liabilities', 'NON-CURRENT LIABILITIES', b'0'),
(110, 'Share Premium', 'FINANCED BY / EQUITY', b'1'),
(112, 'Investment in Associated Companies', 'NON CURRENT ASSET', b'0'),
(114, 'Intangible Assets', 'NON CURRENT ASSET', b'0'),
(115, 'Amount Owning by Subsidiary Companies', 'CURRENT ASSETS', b'0'),
(116, 'Amount Owning by Associated Companies', 'CURRENT ASSETS', b'0'),
(117, 'Fixed Deposits with Licensed Banks', 'CURRENT ASSETS', b'0'),
(118, 'Cash & Bank Balances', 'CURRENT ASSETS', b'0'),
(119, 'Other Payables', 'CURRENT LIABILITIES', b'0'),
(120, 'Amount Owing to Subsidiary Companies', 'CURRENT LIABILITIES', b'0'),
(121, 'Amount Owing to Directors Companies', 'CURRENT LIABILITIES', b'0'),
(122, 'Tax / Taxation', 'CURRENT LIABILITIES', b'0'),
(123, 'Administrative Expenses', 'EXPENSES', b'0'),
(124, 'Other Operating Expenses', 'EXPENSES', b'0'),
(125, 'Finance Costs', 'EXPENSES', b'0'),
(126, 'Share of (loss) Profit in an Associated Company', 'EXPENSES', b'0'),
(127, 'Taxation', 'EXPENSES', b'0'),
(128, 'Minority Shareholder''s Interest', 'EXPENSES', b'0'),
(129, 'Preference Shares Shareholders Equity', 'FINANCED BY / EQUITY', b'1'),
(130, 'Shareholders Fund', 'FINANCED BY / EQUITY', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_value`
--

CREATE TABLE IF NOT EXISTS `tbl_item_value` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `item_id` int(10) DEFAULT NULL,
  `value` double DEFAULT NULL,
  `company_id` varchar(20) DEFAULT NULL,
  `year` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=285 ;

--
-- Dumping data for table `tbl_item_value`
--

INSERT INTO `tbl_item_value` (`id`, `item_id`, `value`, `company_id`, `year`) VALUES
(138, 5, 477007, '111', '2011'),
(139, 6, 675607, '111', '2011'),
(140, 115, 602867, '111', '2011'),
(141, 116, 504614, '111', '2011'),
(142, 117, 240000, '111', '2011'),
(143, 118, 50405, '111', '2011'),
(144, 1, 4826518, '111', '2011'),
(145, 2, 6477608, '111', '2011'),
(146, 3, 15171506, '111', '2011'),
(147, 4, 0, '111', '2011'),
(148, 112, 20000, '111', '2011'),
(149, 114, 260000, '111', '2011'),
(150, 16, 40721, '111', '2011'),
(151, 17, 2894580, '111', '2011'),
(152, 119, 2466300, '111', '2011'),
(153, 120, 3775779, '111', '2011'),
(154, 121, 389033, '111', '2011'),
(155, 122, 48069, '111', '2011'),
(156, 18, -152909, '111', '2011'),
(157, 19, 11031879, '111', '2011'),
(158, 20, 2750000, '111', '2011'),
(159, 21, 0, '111', '2011'),
(160, 23, 0, '111', '2011'),
(161, 110, 6000000, '111', '2011'),
(162, 129, 0, '111', '2011'),
(163, 56, 62680, '111', '2011'),
(164, 57, 0, '111', '2011'),
(165, 25, 9648953, '111', '2011'),
(166, 36, 19546, '111', '2011'),
(167, 44, -1903622, '111', '2011'),
(168, 123, -4631796, '111', '2011'),
(169, 124, -2407462, '111', '2011'),
(170, 125, -201002, '111', '2011'),
(171, 126, 0, '111', '2011'),
(172, 127, 0, '111', '2011'),
(173, 128, 0, '111', '2011'),
(210, 5, 502860, '111', '2010'),
(211, 6, 600318, '111', '2010'),
(212, 115, 353531, '111', '2010'),
(213, 116, 477712, '111', '2010'),
(214, 117, 240000, '111', '2010'),
(215, 118, 2041491, '111', '2010'),
(216, 1, 6331997, '111', '2010'),
(217, 2, 6452608, '111', '2010'),
(218, 3, 12627270, '111', '2010'),
(219, 4, 0, '111', '2010'),
(220, 112, 20000, '111', '2010'),
(221, 114, 260000, '111', '2010'),
(222, 16, 108941, '111', '2010'),
(223, 17, 2869513, '111', '2010'),
(224, 119, 3359333, '111', '2010'),
(225, 120, 3787468, '111', '2010'),
(226, 121, 557986, '111', '2010'),
(227, 122, 72069, '111', '2010'),
(228, 18, -677526, '111', '2010'),
(229, 19, 11031879, '111', '2010'),
(230, 20, 2750000, '111', '2010'),
(231, 21, 0, '111', '2010'),
(232, 23, 0, '111', '2010'),
(233, 110, 6000000, '111', '2010'),
(234, 129, 0, '111', '2010'),
(235, 56, 48124, '111', '2010'),
(236, 57, 0, '111', '2010'),
(237, 25, 6032046, '111', '2010'),
(238, 36, 2516220, '111', '2010'),
(239, 44, -1948201, '111', '2010'),
(240, 123, -4942827, '111', '2010'),
(241, 124, -2507053, '111', '2010'),
(242, 125, -224295, '111', '2010'),
(243, 126, 0, '111', '2010'),
(244, 127, 751363, '111', '2010'),
(245, 128, 0, '111', '2010'),
(246, 130, 19104353, '111', '2010'),
(247, 130, 19628970, '111', '2011'),
(248, 5, 2088738, '111', '2009'),
(249, 6, 1103114, '111', '2009'),
(250, 115, 336943, '111', '2009'),
(251, 116, 321365, '111', '2009'),
(252, 117, 100000, '111', '2009'),
(253, 118, 1918942, '111', '2009'),
(254, 1, 6758266, '111', '2009'),
(255, 2, 6552608, '111', '2009'),
(256, 3, 9058657, '111', '2009'),
(257, 4, 0, '111', '2009'),
(258, 112, 20000, '111', '2009'),
(259, 114, 260000, '111', '2009'),
(260, 16, 306980, '111', '2009'),
(261, 17, 2849446, '111', '2009'),
(262, 119, 1395348, '111', '2009'),
(263, 120, 3112780, '111', '2009'),
(264, 121, 641146, '111', '2009'),
(265, 122, 845423, '111', '2009'),
(266, 18, -571964, '111', '2009'),
(267, 19, 11031879, '111', '2009'),
(268, 20, 0, '111', '2009'),
(269, 21, 0, '111', '2009'),
(270, 23, 0, '111', '2009'),
(271, 110, 6000000, '111', '2009'),
(272, 129, 2750000, '111', '2009'),
(273, 130, 16459915, '111', '2009'),
(274, 56, 157595, '111', '2009'),
(275, 57, 0, '111', '2009'),
(276, 25, 8966172, '111', '2009'),
(277, 36, 16959, '111', '2009'),
(278, 44, -894662, '111', '2009'),
(279, 123, -4037467, '111', '2009'),
(280, 124, -9803461, '111', '2009'),
(281, 125, -271199, '111', '2009'),
(282, 126, 0, '111', '2009'),
(283, 127, 1248092, '111', '2009'),
(284, 128, 0, '111', '2009');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_level`
--

CREATE TABLE IF NOT EXISTS `tbl_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_level`
--

INSERT INTO `tbl_level` (`id`, `level`) VALUES
(1, 'admin'),
(2, 'officer');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_registration`
--

CREATE TABLE IF NOT EXISTS `tbl_registration` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(200) NOT NULL,
  `company_id` varchar(200) NOT NULL,
  `company_email` varchar(20) NOT NULL,
  `address` varchar(200) NOT NULL,
  `postcode` int(45) NOT NULL,
  `city` text NOT NULL,
  `state_id` int(11) NOT NULL,
  `no_tel` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tbl_registration`
--

INSERT INTO `tbl_registration` (`id`, `company_name`, `company_id`, `company_email`, `address`, `postcode`, `city`, `state_id`, `no_tel`) VALUES
(1, 'FASTRACK SDN BHD', '111', '', 'No 13 Jalan Semarak', 43000, 'Setapak', 2, '126744511');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_select_ledger_item`
--

CREATE TABLE IF NOT EXISTS `tbl_select_ledger_item` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `company_id` varchar(200) NOT NULL DEFAULT '',
  `item_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `tbl_select_ledger_item`
--

INSERT INTO `tbl_select_ledger_item` (`id`, `company_id`, `item_id`) VALUES
(1, '111', 1),
(2, '111', 2),
(3, '111', 3),
(4, '111', 4),
(5, '111', 112),
(6, '111', 114),
(7, '111', 5),
(8, '111', 6),
(9, '111', 115),
(10, '111', 116),
(11, '111', 117),
(12, '111', 118),
(13, '111', 16),
(14, '111', 17),
(15, '111', 119),
(16, '111', 120),
(17, '111', 121),
(18, '111', 122),
(19, '111', 18),
(20, '111', 19),
(21, '111', 20),
(22, '111', 21),
(23, '111', 23),
(24, '111', 110),
(25, '111', 56),
(26, '111', 57),
(27, '111', 25),
(28, '111', 36),
(29, '111', 44),
(30, '111', 123),
(31, '111', 124),
(32, '111', 125),
(33, '111', 126),
(34, '111', 127),
(35, '111', 128),
(36, '111', 129),
(37, '111', 130);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_state`
--

CREATE TABLE IF NOT EXISTS `tbl_state` (
  `state_id` int(11) NOT NULL AUTO_INCREMENT,
  `state` varchar(45) NOT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tbl_state`
--

INSERT INTO `tbl_state` (`state_id`, `state`) VALUES
(1, 'Kedah'),
(2, 'Perlis'),
(3, 'Pulau Pinang'),
(4, 'Perak'),
(5, 'Kelantan'),
(6, 'Terengganu'),
(7, 'Pahang'),
(8, 'Selangor'),
(9, 'Melaka'),
(10, 'Negeri Sembilan'),
(11, 'Kuala Lumpur'),
(12, 'Johor Baharu'),
(13, 'Sarawak'),
(14, 'Sabah');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `saltPassword` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `joinDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `level_id` int(11) NOT NULL,
  `avatar` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `level_id` (`level_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `saltPassword`, `email`, `joinDate`, `level_id`, `avatar`) VALUES
(4, 'kupu', '47a8943ecb3be20c14f575d34f9037be', '5271c9a01bb383.58745735', 'kupu@yahoo.com', '2013-10-31 03:12:42', 1, 'kupu.JPG'),
(6, 'lala', 'e4f6d3686fe0dc8666ac763f7747b823', '527bb4f92d67f5.87270547', 'yuna@gmail.com', '2013-11-07 14:39:09', 2, 'yuna.JPG'),
(7, 'rozaimy', '35de23a56fa6f15cd0bc5cfc8b67776d', '528148174062e9.91431989', 'toyol_roy@yahoo.com', '2013-11-11 18:35:06', 1, 'rozaimy.jpg'),
(8, 'ben', '77db99973eba0b20988ce823c4e1813b', '528a69d10c93a5.28834828', 'ben@gmail.com', '2013-11-18 18:26:09', 1, 'ben.JPG'),
(11, 'benak', '512526028cfe7514f6ed83821392d1fe', '528a6dc4764a27.55133906', 'benak@gmail', '2013-11-18 18:43:00', 1, 'benak.png'),
(12, 'ucop', '56c1e8b7dd704f02764137ada3f62e93', '528a6fa47fe3b4.25823472', 'cop', '2013-11-18 18:51:00', 1, 'ucop.JPG'),
(13, 'amin', 'f176c4b4c97ad0e6ff522a75b4ed2c93', '528a731c390e11.97353086', 'amin@gmail.com', '2013-11-18 19:05:48', 1, 'amin.JPG'),
(14, 'maha', 'e13293e9dca4ddaeeb0878b4c2c539db', '528e4ee04027d0.19981712', 'maha@gmail.com', '2013-11-21 17:20:16', 1, 'maha.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_year`
--

CREATE TABLE IF NOT EXISTS `tbl_year` (
  `year_id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(11) NOT NULL,
  PRIMARY KEY (`year_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_year`
--

INSERT INTO `tbl_year` (`year_id`, `year`) VALUES
(1, 2010),
(2, 2011),
(3, 2012),
(4, 2013),
(10, 2009);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
