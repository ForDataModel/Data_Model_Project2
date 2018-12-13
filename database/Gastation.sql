-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- 主機: localhost:8889
-- 產生時間： 2018 年 12 月 13 日 11:41
-- 伺服器版本: 5.7.23
-- PHP 版本： 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `Gastation`
--

-- --------------------------------------------------------

--
-- 資料表結構 `Buy`
--

CREATE TABLE `Buy` (
  `Buy_ID` int(11) NOT NULL,
  `Buy_amount` int(11) NOT NULL,
  `Oil_ID` int(11) NOT NULL,
  `Customer_ID` int(11) NOT NULL,
  `Value` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Tax_id_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `Buy`
--

INSERT INTO `Buy` (`Buy_ID`, `Buy_amount`, `Oil_ID`, `Customer_ID`, `Value`, `Date`, `Tax_id_number`) VALUES
(1, 123, 62, 8, 123, '2018-12-11', 123),
(2, 123, 31, 8, 123, '2018-12-11', 123),
(11, 2222, 93, 39, 2222, '2018-12-09', 12322);

-- --------------------------------------------------------

--
-- 資料表結構 `Customer`
--

CREATE TABLE `Customer` (
  `Customer_ID` int(11) NOT NULL,
  `Phone_number` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `Customer`
--

INSERT INTO `Customer` (`Customer_ID`, `Phone_number`) VALUES
(1, '0'),
(2, '1'),
(5, '46758'),
(8, '0931960318'),
(9, '092456789'),
(10, '098764334'),
(11, '09876567'),
(31, '12331231'),
(38, '2222'),
(39, '333333');

-- --------------------------------------------------------

--
-- 資料表結構 `Fulltime`
--

CREATE TABLE `Fulltime` (
  `Staff_ID` int(11) NOT NULL,
  `Salary` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `Fulltime`
--

INSERT INTO `Fulltime` (`Staff_ID`, `Salary`) VALUES
(1, 65000),
(2, 70000),
(3, 55000),
(4, 60000),
(5, 58000),
(6, 48000),
(7, 45000),
(8, 45000),
(9, 31000),
(34, 100000);

-- --------------------------------------------------------

--
-- 資料表結構 `Member`
--

CREATE TABLE `Member` (
  `Customer_ID` int(11) NOT NULL,
  `Member_name` char(10) NOT NULL,
  `Member_gender` tinyint(1) NOT NULL,
  `Member_address` varchar(20) NOT NULL,
  `Member_birthday` date NOT NULL,
  `Member_start_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Card_name` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `Member`
--

INSERT INTO `Member` (`Customer_ID`, `Member_name`, `Member_gender`, `Member_address`, `Member_birthday`, `Member_start_time`, `Card_name`) VALUES
(8, '羅靖婷', 0, '台北市文山區羅斯福路', '1996-03-18', '2018-12-08 14:57:07', 1),
(9, '張一輪', 1, '台中', '1996-01-30', '2018-12-08 14:57:47', 0),
(10, '盧昱均', 1, '新北市板橋', '1996-05-08', '2018-12-08 14:58:30', 1),
(11, '林顯宗', 1, '台灣', '1996-04-10', '2018-12-08 14:59:15', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `Normal`
--

CREATE TABLE `Normal` (
  `Customer_ID` int(11) NOT NULL,
  `Serial_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `Normal`
--

INSERT INTO `Normal` (`Customer_ID`, `Serial_number`) VALUES
(31, 905436596),
(38, 813603989),
(39, 956341539);

-- --------------------------------------------------------

--
-- 資料表結構 `Oil`
--

CREATE TABLE `Oil` (
  `Oil_ID` int(11) NOT NULL,
  `Name` char(10) NOT NULL,
  `Oil_cost` float NOT NULL,
  `Oil_price` float NOT NULL,
  `Oil_amount` float NOT NULL,
  `Station_ID` int(11) NOT NULL,
  `Date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `Oil`
--

INSERT INTO `Oil` (`Oil_ID`, `Name`, `Oil_cost`, `Oil_price`, `Oil_amount`, `Station_ID`, `Date`) VALUES
(1, '95', 27, 28.4, 8682.75, 1, '2018-10-01 00:00:00'),
(2, '95', 27, 28.4, 9363.57, 1, '2018-10-02 00:00:00'),
(3, '95', 27, 28.4, 8340.11, 1, '2018-10-03 00:00:00'),
(4, '95', 27, 28.4, 7971.14, 1, '2018-10-04 00:00:00'),
(5, '95', 27, 28.4, 11104.4, 1, '2018-10-05 00:00:00'),
(6, '95', 27, 28.4, 9956.54, 1, '2018-10-06 00:00:00'),
(7, '95', 27, 28.4, 10703.8, 1, '2018-10-07 00:00:00'),
(8, '95', 27, 28.4, 8798.73, 1, '2018-10-08 00:00:00'),
(9, '95', 27, 28.4, 9295.32, 1, '2018-10-09 00:00:00'),
(10, '95', 27, 28.4, 7561.05, 1, '2018-10-10 00:00:00'),
(11, '95', 27, 28.4, 8751.37, 1, '2018-10-11 00:00:00'),
(12, '95', 27, 28.4, 9454.26, 1, '2018-10-12 00:00:00'),
(13, '95', 27, 28.4, 10002.7, 1, '2018-10-13 00:00:00'),
(14, '95', 27, 28.4, 9382.04, 1, '2018-10-14 00:00:00'),
(15, '95', 27, 28.4, 10258.5, 1, '2018-10-15 00:00:00'),
(16, '95', 27, 28.4, 9985.17, 1, '2018-10-16 00:00:00'),
(17, '95', 27, 28.4, 9492.73, 1, '2018-10-17 00:00:00'),
(18, '95', 27, 28.4, 10044, 1, '2018-10-18 00:00:00'),
(19, '95', 27, 28.4, 9869.04, 1, '2018-10-19 00:00:00'),
(20, '95', 27, 28.4, 9621.95, 1, '2018-10-20 00:00:00'),
(21, '95', 27, 28.4, 8852.95, 1, '2018-10-21 00:00:00'),
(22, '95', 27, 28.4, 9710.65, 1, '2018-10-22 00:00:00'),
(23, '95', 27, 28.4, 8225.48, 1, '2018-10-23 00:00:00'),
(24, '95', 27, 28.4, 9313.43, 1, '2018-10-24 00:00:00'),
(25, '95', 27, 28.4, 9034.22, 1, '2018-10-25 00:00:00'),
(26, '95', 27, 28.4, 9097.24, 1, '2018-10-26 00:00:00'),
(27, '95', 27, 28.4, 9107.8, 1, '2018-10-27 00:00:00'),
(28, '95', 27, 28.4, 8605.74, 1, '2018-10-28 00:00:00'),
(29, '95', 27, 28.4, 9622.6, 1, '2018-10-29 00:00:00'),
(30, '95', 27, 28.4, 8850.32, 1, '2018-10-30 00:00:00'),
(31, '95', 27, 28.4, 9163.56, 1, '2018-10-31 00:00:00'),
(32, '92', 25, 26.9, 3302.57, 1, '2018-10-01 00:00:00'),
(33, '92', 25, 26.9, 3574.67, 1, '2018-10-02 00:00:00'),
(34, '92', 25, 26.9, 2894.22, 1, '2018-10-03 00:00:00'),
(35, '92', 25, 26.9, 2791.11, 1, '2018-10-04 00:00:00'),
(36, '92', 25, 26.9, 3470.8, 1, '2018-10-05 00:00:00'),
(37, '92', 25, 26.9, 2595.4, 1, '2018-10-06 00:00:00'),
(38, '92', 25, 26.9, 2513.21, 1, '2018-10-07 00:00:00'),
(39, '92', 25, 26.9, 3394.13, 1, '2018-10-08 00:00:00'),
(40, '92', 25, 26.9, 3204.87, 1, '2018-10-09 00:00:00'),
(41, '92', 25, 26.9, 2360.04, 1, '2018-10-10 00:00:00'),
(42, '92', 25, 26.9, 2662.64, 1, '2018-10-11 00:00:00'),
(43, '92', 25, 26.9, 2688.48, 1, '2018-10-12 00:00:00'),
(44, '92', 25, 26.9, 2452.29, 1, '2018-10-13 00:00:00'),
(45, '92', 25, 26.9, 2218.73, 1, '2018-10-14 00:00:00'),
(46, '92', 25, 26.9, 3498.45, 1, '2018-10-15 00:00:00'),
(47, '92', 25, 26.9, 3478.05, 1, '2018-10-16 00:00:00'),
(48, '92', 25, 26.9, 2667.62, 1, '2018-10-17 00:00:00'),
(49, '92', 25, 26.9, 3695.53, 1, '2018-10-18 00:00:00'),
(50, '92', 25, 26.9, 3648.13, 1, '2018-10-19 00:00:00'),
(51, '92', 25, 26.9, 2436.26, 1, '2018-10-20 00:00:00'),
(52, '92', 25, 26.9, 2411.11, 1, '2018-10-21 00:00:00'),
(53, '92', 25, 26.9, 3456.05, 1, '2018-10-22 00:00:00'),
(54, '92', 25, 26.9, 3119.52, 1, '2018-10-23 00:00:00'),
(55, '92', 25, 26.9, 3136.25, 1, '2018-10-24 00:00:00'),
(56, '92', 25, 26.9, 3702, 1, '2018-10-25 00:00:00'),
(57, '92', 25, 26.9, 3624.39, 1, '2018-10-26 00:00:00'),
(58, '92', 25, 26.9, 2601.37, 1, '2018-10-27 00:00:00'),
(59, '92', 25, 26.9, 2245.47, 1, '2018-10-28 00:00:00'),
(60, '92', 25, 26.9, 4095.81, 1, '2018-10-29 00:00:00'),
(61, '92', 25, 26.9, 3619.13, 1, '2018-10-30 00:00:00'),
(62, '92', 25, 26.9, 3588.03, 1, '2018-10-31 00:00:00'),
(63, '98', 29, 30.4, 809.14, 1, '2018-10-01 00:00:00'),
(64, '98', 29, 30.4, 643.17, 1, '2018-10-02 00:00:00'),
(65, '98', 29, 30.4, 857, 1, '2018-10-03 00:00:00'),
(66, '98', 29, 30.4, 871.7, 1, '2018-10-04 00:00:00'),
(67, '98', 29, 30.4, 917.59, 1, '2018-10-05 00:00:00'),
(68, '98', 29, 30.4, 1414.85, 1, '2018-10-06 00:00:00'),
(69, '98', 29, 30.4, 1020.77, 1, '2018-10-07 00:00:00'),
(70, '98', 29, 30.4, 876.32, 1, '2018-10-08 00:00:00'),
(71, '98', 29, 30.4, 1324.51, 1, '2018-10-09 00:00:00'),
(72, '98', 29, 30.4, 779.11, 1, '2018-10-10 00:00:00'),
(73, '98', 29, 30.4, 871.66, 1, '2018-10-11 00:00:00'),
(74, '98', 29, 30.4, 1510.85, 1, '2018-10-12 00:00:00'),
(75, '98', 29, 30.4, 872.74, 1, '2018-10-13 00:00:00'),
(76, '98', 29, 30.4, 1078.96, 1, '2018-10-14 00:00:00'),
(77, '98', 29, 30.4, 938.55, 1, '2018-10-15 00:00:00'),
(78, '98', 29, 30.4, 1088.71, 1, '2018-10-16 00:00:00'),
(79, '98', 29, 30.4, 530.04, 1, '2018-10-17 00:00:00'),
(80, '98', 29, 30.4, 1007.99, 1, '2018-10-18 00:00:00'),
(81, '98', 29, 30.4, 1615.01, 1, '2018-10-19 00:00:00'),
(82, '98', 29, 30.4, 1269.83, 1, '2018-10-20 00:00:00'),
(83, '98', 29, 30.4, 935.53, 1, '2018-10-21 00:00:00'),
(84, '98', 29, 30.4, 1186.38, 1, '2018-10-22 00:00:00'),
(85, '98', 29, 30.4, 965.65, 1, '2018-10-23 00:00:00'),
(86, '98', 29, 30.4, 942.07, 1, '2018-10-24 00:00:00'),
(87, '98', 29, 30.4, 1095.84, 1, '2018-10-25 00:00:00'),
(88, '98', 29, 30.4, 1011.03, 1, '2018-10-26 00:00:00'),
(89, '98', 29, 30.4, 854.69, 1, '2018-10-27 00:00:00'),
(90, '98', 29, 30.4, 1049.82, 1, '2018-10-28 00:00:00'),
(91, '98', 29, 30.4, 1249.69, 1, '2018-10-29 00:00:00'),
(92, '98', 29, 30.4, 1055.29, 1, '2018-10-30 00:00:00'),
(93, '98', 29, 30.4, 1101.44, 1, '2018-10-31 00:00:00'),
(94, '超柴', 23, 24.9, 3025.08, 1, '2018-10-01 00:00:00'),
(95, '超柴', 23, 24.9, 3022.59, 1, '2018-10-02 00:00:00'),
(96, '超柴', 23, 24.9, 5928.54, 1, '2018-10-03 00:00:00'),
(97, '超柴', 23, 24.9, 4857.64, 1, '2018-10-04 00:00:00'),
(98, '超柴', 23, 24.9, 5543.77, 1, '2018-10-05 00:00:00'),
(99, '超柴', 23, 24.9, 3523.25, 1, '2018-10-06 00:00:00'),
(100, '超柴', 23, 24.9, 1366.92, 1, '2018-10-07 00:00:00'),
(101, '超柴', 23, 24.9, 3483.9, 1, '2018-10-08 00:00:00'),
(102, '超柴', 23, 24.9, 4517.92, 1, '2018-10-09 00:00:00'),
(103, '超柴', 23, 24.9, 1736.98, 1, '2018-10-10 00:00:00'),
(104, '超柴', 23, 24.9, 5273.84, 1, '2018-10-11 00:00:00'),
(105, '超柴', 23, 24.9, 5360.66, 1, '2018-10-12 00:00:00'),
(106, '超柴', 23, 24.9, 3177.74, 1, '2018-10-13 00:00:00'),
(107, '超柴', 23, 24.9, 541.65, 1, '2018-10-14 00:00:00'),
(108, '超柴', 23, 24.9, 5464.15, 1, '2018-10-15 00:00:00'),
(109, '超柴', 23, 24.9, 4373.24, 1, '2018-10-16 00:00:00'),
(110, '超柴', 23, 24.9, 5403.19, 1, '2018-10-17 00:00:00'),
(111, '超柴', 23, 24.9, 4738.15, 1, '2018-10-18 00:00:00'),
(112, '超柴', 23, 24.9, 5161.61, 1, '2018-10-19 00:00:00'),
(113, '超柴', 23, 24.9, 2339.26, 1, '2018-10-20 00:00:00'),
(114, '超柴', 23, 24.9, 693.89, 1, '2018-10-21 00:00:00'),
(115, '超柴', 23, 24.9, 6061.32, 1, '2018-10-22 00:00:00'),
(116, '超柴', 23, 24.9, 4827.73, 1, '2018-10-23 00:00:00'),
(117, '超柴', 23, 24.9, 4255.33, 1, '2018-10-24 00:00:00'),
(118, '超柴', 23, 24.9, 6208.1, 1, '2018-10-25 00:00:00'),
(119, '超柴', 23, 24.9, 4500.69, 1, '2018-10-26 00:00:00'),
(120, '超柴', 23, 24.9, 2664.6, 1, '2018-10-27 00:00:00'),
(121, '超柴', 23, 24.9, 2200.82, 1, '2018-10-28 00:00:00'),
(122, '超柴', 23, 24.9, 4945.35, 1, '2018-10-29 00:00:00'),
(123, '超柴', 23, 24.9, 5801.46, 1, '2018-10-30 00:00:00'),
(124, '超柴', 23, 24.9, 3985.33, 1, '2018-10-31 00:00:00'),
(125, '超柴', 23, 24.9, 100000, 6, '2018-12-12 23:43:56'),
(126, '超柴', 23, 1000, 24.9, 6, '2018-12-12 23:44:32'),
(127, '超柴', 23, 24.9, 1000000, 2, '2018-12-12 23:45:38'),
(128, '92', 25, 26.9, 1000, 4, '2018-12-13 13:32:50');

-- --------------------------------------------------------

--
-- 資料表結構 `Parttime`
--

CREATE TABLE `Parttime` (
  `Staff_ID` int(11) NOT NULL,
  `Hourpay` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `Parttime`
--

INSERT INTO `Parttime` (`Staff_ID`, `Hourpay`) VALUES
(10, 150),
(11, 150),
(12, 150),
(38, 160);

-- --------------------------------------------------------

--
-- 資料表結構 `Product`
--

CREATE TABLE `Product` (
  `Product_ID` int(11) NOT NULL,
  `Product_name` char(20) NOT NULL,
  `Price` int(11) NOT NULL,
  `Product_amount` int(11) NOT NULL,
  `Cost` float NOT NULL,
  `Product_Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Station_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `Product`
--

INSERT INTO `Product` (`Product_ID`, `Product_name`, `Price`, `Product_amount`, `Cost`, `Product_Date`, `Station_ID`) VALUES
(1, '去漬油', 35, 74, 31.5, '2018-12-10 19:48:59', 1),
(2, '環保二行程機油-0.7L', 120, 25, 80.41, '2018-12-10 19:48:59', 1),
(3, '二行程機油-0.7L', 91, 40, 61, '2018-12-10 19:48:59', 1),
(4, '二行程機油-1L', 0, 0, 0, '2018-12-10 19:48:59', 1),
(5, '特優機油SAE30#-1L', 113, 13, 75.75, '2018-12-10 19:48:59', 1),
(6, '特優機油SAE40#-1L', 113, 12, 75.75, '2018-12-10 19:48:59', 1),
(7, '特優機油15/40-1L', 120, 18, 80.41, '2018-12-10 19:48:59', 1),
(8, 'DOT-3高級煞車油', 0, 0, 0, '2018-12-10 19:48:59', 1),
(9, '自動變速器油', 0, 0, 0, '2018-12-10 19:48:59', 1),
(10, '特優機油SAE40#4L', 420, 3, 281.5, '2018-12-10 19:48:59', 1),
(11, '特優機油15/40-4L', 455, 3, 304.83, '2018-12-10 19:48:59', 1),
(12, '超重機油CF30#-4L', 415, 2, 278, '2018-12-10 19:48:59', 1),
(13, '超重機油CF40#-4L', 430, 2, 288, '2018-12-10 19:48:59', 1),
(14, '超優CH4車用-4L', 0, 0, 0, '2018-12-10 19:48:59', 1),
(15, '多效齒輪油80/90-4L', 0, 0, 0, '2018-12-10 19:48:59', 1),
(16, 'R32循環油-4L', 385, 5, 276.5, '2018-12-10 19:48:59', 1),
(17, 'R68循環油-4L', 385, 3, 283.5, '2018-12-10 19:48:59', 1),
(18, '煤油-4L', 239, 6, 223, '2018-12-10 19:48:59', 1),
(19, 'R32循環油-18L', 1550, 2, 1120, '2018-12-10 19:48:59', 1),
(20, 'R68循環油-19L', 1720, 2, 1243, '2018-12-10 19:48:59', 1),
(21, '環保去漬油19公升(5加侖)', 1150, 0, 1000, '2018-12-10 19:48:59', 1),
(22, '煤油20公升', 1024, 0, 940, '2018-12-10 19:48:59', 1),
(23, '超重CF40-19公升(5加侖)', 1810, 1, 1213, '2018-12-10 19:48:59', 1),
(24, '汽車油精', 200, 23, 95, '2018-12-10 19:48:59', 1),
(25, '機車油精', 59, 46, 35, '2018-12-10 19:48:59', 1),
(26, '柴油油精', 200, 19, 95, '2018-12-10 19:48:59', 1),
(27, '操作機油CF10W200L', 0, 0, 0, '2018-12-10 19:48:59', 1),
(28, '特優機油20W/50-1L', 0, 0, 0, '2018-12-10 19:48:59', 1),
(29, '超優CI4車用機油-4L', 0, 0, 0, '2018-12-10 19:48:59', 1),
(30, '滑道68循環油-19公升(5加侖)', 1960, 1, 1568, '2018-12-10 19:48:59', 1),
(31, '超重機油CF30-19公升(5加侖)', 1810, 1, 1213, '2018-12-10 19:48:59', 1),
(32, '2號多效脂', 0, 0, 0, '2018-12-10 19:48:59', 1),
(33, '汽油清淨劑', 250, 2, 200, '2018-12-10 19:48:59', 1),
(34, '9000SJ車用機油-5W/50-1L', 400, 1, 268, '2018-12-10 19:48:59', 1),
(35, '9000SL車用機油-10W/40-1L', 400, 0, 300, '2018-12-10 19:48:59', 1),
(36, 'DOT-4高級煞車油', 0, 0, 0, '2018-12-10 19:48:59', 1),
(37, '多效齒輪油85W/140-4L', 0, 0, 0, '2018-12-10 19:48:59', 1),
(38, '去漬油19公升(5加侖)', 700, 0, 650, '2018-12-10 19:48:59', 1),
(39, 'R68-200公升', 11310, 0, 10000, '2018-12-10 19:48:59', 1),
(40, '車用多效滑脂15kg', 2295, 0, 1836, '2018-12-10 19:48:59', 1),
(41, '特級3號杯脂', 2275, 0, 1820, '2018-12-10 19:48:59', 1),
(42, '蘋果傳輸線', 590, 3, 210, '2018-12-10 19:48:59', 1),
(43, '安卓傳輸線', 290, 0, 126, '2018-12-10 19:48:59', 1),
(44, '胎壓器', 5990, 1, 3780, '2018-12-10 19:48:59', 1),
(45, '50元洗車券', 50, 0, 0, '2018-12-10 19:48:59', 1),
(46, '80元洗車券', 80, 1975, 0, '2018-12-10 19:48:59', 1),
(47, '100元洗車券', 100, 465, 0, '2018-12-10 19:48:59', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `Required`
--

CREATE TABLE `Required` (
  `Transaction_ID` int(11) NOT NULL,
  `Transaction_amount` int(11) NOT NULL,
  `Product_ID` int(11) NOT NULL,
  `Customer_ID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Value` int(11) NOT NULL,
  `Tax_id_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `Required`
--

INSERT INTO `Required` (`Transaction_ID`, `Transaction_amount`, `Product_ID`, `Customer_ID`, `Date`, `Value`, `Tax_id_number`) VALUES
(1, 123, 47, 9, '2018-12-13', 123, 123);

-- --------------------------------------------------------

--
-- 資料表結構 `Staff`
--

CREATE TABLE `Staff` (
  `Staff_ID` int(11) NOT NULL,
  `Name` varchar(10) NOT NULL,
  `Gender` tinyint(1) NOT NULL,
  `Personal_ID` char(10) NOT NULL,
  `Birthday` date DEFAULT NULL,
  `Station_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `Staff`
--

INSERT INTO `Staff` (`Staff_ID`, `Name`, `Gender`, `Personal_ID`, `Birthday`, `Station_ID`) VALUES
(1, '王小明', 1, 'F284930483', '1980-12-18', 1),
(2, '黃美美', 0, 'A950384594', '1986-04-12', 2),
(3, '許雅婷', 0, 'A293626248', '1969-05-09', 3),
(4, '林文昌', 1, 'A294652359', '1970-12-06', 2),
(5, '賴力昕', 1, 'B296037977', '1977-04-12', 5),
(6, '羅雅婷', 0, 'A294035947', '1985-06-07', 5),
(7, '李映州', 0, 'H291548346', '1987-10-17', 3),
(8, '羅碧竹', 0, 'D194141156', '1975-11-07', 2),
(9, '戴政儒', 1, 'C297531199', '1980-02-02', 1),
(10, '張俊穎', 1, 'G293613470', '1995-01-03', 2),
(11, '許郁婷', 0, 'B198534397', '1997-04-12', 3),
(12, '黃仁杰', 1, 'A192773559', '1996-12-21', 4),
(34, 'tinaluo', 0, 'A527384950', '1996-09-03', 3),
(38, '羅', 0, 'a89', '1998-02-03', 2),
(40, 'erests', 1, 'dhtfh', '2007-02-01', 2);

-- --------------------------------------------------------

--
-- 資料表結構 `Station`
--

CREATE TABLE `Station` (
  `Station_ID` int(11) NOT NULL,
  `Address` varchar(30) DEFAULT NULL,
  `Name` char(10) DEFAULT NULL,
  `Manager_ID` int(11) NOT NULL,
  `Phone_number` varchar(20) DEFAULT NULL,
  `Oil_Supplier_ID` int(11) DEFAULT NULL,
  `Product_Supplier_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `Station`
--

INSERT INTO `Station` (`Station_ID`, `Address`, `Name`, `Manager_ID`, `Phone_number`, `Oil_Supplier_ID`, `Product_Supplier_ID`) VALUES
(1, '新北市泰山區泰林路二段47號', '永錡加油站', 1, '(02)2297-4554', 1, 2),
(2, '新北市樹林區八德街395號', '永錡彭厝加油站', 2, '(02)2247-5693', 1, 2),
(3, '新北市樹林區大安路179號', '永錡保安加油站', 3, '(02)2203-5888', 1, 2),
(4, '新北市新莊區中正路692之8號', '永錡中正加油站', 4, '(02)2903-2955', 1, 2),
(5, '新北市樹林區大安路576號', '永綺大安加油站', 5, '(02)8675-1897', 1, 2),
(6, '台北市', '測試加油站', 34, '(12)1234-1234', 1, 2);

-- --------------------------------------------------------

--
-- 資料表結構 `Supplier`
--

CREATE TABLE `Supplier` (
  `Supplier_ID` int(11) NOT NULL,
  `Phone_number` varchar(20) NOT NULL,
  `Address` varchar(20) NOT NULL,
  `Supplier_name` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `Supplier`
--

INSERT INTO `Supplier` (`Supplier_ID`, `Phone_number`, `Address`, `Supplier_name`) VALUES
(1, '(03)338-7350', '桃園市桃園區中山路522號', '台灣中油股份有限公司'),
(2, '(02)2297-4679', '泰山區泰林路二段29號', '有挺企業股份有限公司');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `Buy`
--
ALTER TABLE `Buy`
  ADD PRIMARY KEY (`Buy_ID`),
  ADD KEY `buytoCustomer` (`Customer_ID`);

--
-- 資料表索引 `Customer`
--
ALTER TABLE `Customer`
  ADD PRIMARY KEY (`Customer_ID`);

--
-- 資料表索引 `Fulltime`
--
ALTER TABLE `Fulltime`
  ADD PRIMARY KEY (`Staff_ID`);

--
-- 資料表索引 `Member`
--
ALTER TABLE `Member`
  ADD PRIMARY KEY (`Customer_ID`);

--
-- 資料表索引 `Normal`
--
ALTER TABLE `Normal`
  ADD PRIMARY KEY (`Customer_ID`);

--
-- 資料表索引 `Oil`
--
ALTER TABLE `Oil`
  ADD PRIMARY KEY (`Oil_ID`),
  ADD KEY `oiltoStation` (`Station_ID`);

--
-- 資料表索引 `Parttime`
--
ALTER TABLE `Parttime`
  ADD PRIMARY KEY (`Staff_ID`);

--
-- 資料表索引 `Product`
--
ALTER TABLE `Product`
  ADD PRIMARY KEY (`Product_ID`),
  ADD KEY `producttoStation` (`Station_ID`);

--
-- 資料表索引 `Required`
--
ALTER TABLE `Required`
  ADD PRIMARY KEY (`Transaction_ID`),
  ADD KEY `requiretoProduct` (`Product_ID`),
  ADD KEY `requiretoCustomer` (`Customer_ID`);

--
-- 資料表索引 `Staff`
--
ALTER TABLE `Staff`
  ADD PRIMARY KEY (`Staff_ID`),
  ADD KEY `IDX_Staff_Station_ID` (`Station_ID`);

--
-- 資料表索引 `Station`
--
ALTER TABLE `Station`
  ADD PRIMARY KEY (`Station_ID`),
  ADD KEY `stationToManagement` (`Manager_ID`),
  ADD KEY `stationtooil` (`Oil_Supplier_ID`),
  ADD KEY `stationtoproduct` (`Product_Supplier_ID`);

--
-- 資料表索引 `Supplier`
--
ALTER TABLE `Supplier`
  ADD PRIMARY KEY (`Supplier_ID`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `Buy`
--
ALTER TABLE `Buy`
  MODIFY `Buy_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用資料表 AUTO_INCREMENT `Customer`
--
ALTER TABLE `Customer`
  MODIFY `Customer_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- 使用資料表 AUTO_INCREMENT `Fulltime`
--
ALTER TABLE `Fulltime`
  MODIFY `Staff_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- 使用資料表 AUTO_INCREMENT `Member`
--
ALTER TABLE `Member`
  MODIFY `Customer_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用資料表 AUTO_INCREMENT `Oil`
--
ALTER TABLE `Oil`
  MODIFY `Oil_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- 使用資料表 AUTO_INCREMENT `Parttime`
--
ALTER TABLE `Parttime`
  MODIFY `Staff_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- 使用資料表 AUTO_INCREMENT `Product`
--
ALTER TABLE `Product`
  MODIFY `Product_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- 使用資料表 AUTO_INCREMENT `Required`
--
ALTER TABLE `Required`
  MODIFY `Transaction_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表 AUTO_INCREMENT `Staff`
--
ALTER TABLE `Staff`
  MODIFY `Staff_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- 使用資料表 AUTO_INCREMENT `Station`
--
ALTER TABLE `Station`
  MODIFY `Station_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用資料表 AUTO_INCREMENT `Supplier`
--
ALTER TABLE `Supplier`
  MODIFY `Supplier_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 已匯出資料表的限制(Constraint)
--

--
-- 資料表的 Constraints `Buy`
--
ALTER TABLE `Buy`
  ADD CONSTRAINT `buytoCustomer` FOREIGN KEY (`Customer_ID`) REFERENCES `Customer` (`Customer_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的 Constraints `Fulltime`
--
ALTER TABLE `Fulltime`
  ADD CONSTRAINT `fullTimetoStaff` FOREIGN KEY (`Staff_ID`) REFERENCES `Staff` (`Staff_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的 Constraints `Member`
--
ALTER TABLE `Member`
  ADD CONSTRAINT `membertoCustomer` FOREIGN KEY (`Customer_ID`) REFERENCES `Customer` (`Customer_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的 Constraints `Normal`
--
ALTER TABLE `Normal`
  ADD CONSTRAINT `normaltoCusomer` FOREIGN KEY (`Customer_ID`) REFERENCES `Customer` (`Customer_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的 Constraints `Oil`
--
ALTER TABLE `Oil`
  ADD CONSTRAINT `oiltoStation` FOREIGN KEY (`Station_ID`) REFERENCES `Station` (`Station_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的 Constraints `Parttime`
--
ALTER TABLE `Parttime`
  ADD CONSTRAINT `partTimetoStaff` FOREIGN KEY (`Staff_ID`) REFERENCES `Staff` (`Staff_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的 Constraints `Product`
--
ALTER TABLE `Product`
  ADD CONSTRAINT `producttoStation` FOREIGN KEY (`Station_ID`) REFERENCES `Station` (`Station_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的 Constraints `Required`
--
ALTER TABLE `Required`
  ADD CONSTRAINT `requiretoCustomer` FOREIGN KEY (`Customer_ID`) REFERENCES `Customer` (`Customer_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `requiretoProduct` FOREIGN KEY (`Product_ID`) REFERENCES `Product` (`Product_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的 Constraints `Staff`
--
ALTER TABLE `Staff`
  ADD CONSTRAINT `stafftoStation` FOREIGN KEY (`Station_ID`) REFERENCES `Station` (`Station_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的 Constraints `Station`
--
ALTER TABLE `Station`
  ADD CONSTRAINT `stationToManagement` FOREIGN KEY (`Manager_ID`) REFERENCES `Staff` (`Staff_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stationtooil` FOREIGN KEY (`Oil_Supplier_ID`) REFERENCES `Supplier` (`Supplier_ID`),
  ADD CONSTRAINT `stationtoproduct` FOREIGN KEY (`Product_Supplier_ID`) REFERENCES `Product` (`Product_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
