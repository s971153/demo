-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1:3306
-- 產生時間： 
-- 伺服器版本： 10.4.10-MariaDB
-- PHP 版本： 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `demo`
--
CREATE DATABASE IF NOT EXISTS `demo` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `demo`;

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `price` int(10) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- 資料表新增資料前，先清除舊資料 `product`
--

TRUNCATE TABLE `product`;
--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `price`) VALUES
(1, '鑰匙圈', 30),
(2, '布鞋', 390),
(3, '抱枕', 240),
(4, '腰果', 120),
(5, '行動電源', 150),
(6, '花襯衫', 100),
(7, '沙發', 70),
(8, '戒指', 65),
(9, '襪子', 3),
(10, '拖鞋', 200);

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '使用者id',
  `user_name` varchar(255) NOT NULL COMMENT '使用者帳號',
  `password` varchar(255) NOT NULL COMMENT '使用者密碼',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 資料表新增資料前，先清除舊資料 `user`
--

TRUNCATE TABLE `user`;
--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `password`) VALUES
(1, 'user', '$2y$10$dBOES.f21CiegoRsAsLaweqjGmih3IiO2VrUWAU0DaF5W.0ZMMShe');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
