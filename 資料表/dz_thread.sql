-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2019 年 05 月 21 日 11:00
-- 伺服器版本： 10.1.38-MariaDB
-- PHP 版本： 7.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `shellytest`
--

-- --------------------------------------------------------

--
-- 資料表結構 `dz_thread`
--

CREATE TABLE `dz_thread` (
  `id` int(11) NOT NULL,
  `board_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `account` varchar(32) CHARACTER SET utf8 NOT NULL,
  `content` varchar(1024) CHARACTER SET utf8 NOT NULL,
  `ip` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `dz_thread`
--

INSERT INTO `dz_thread` (`id`, `board_id`, `article_id`, `time`, `account`, `content`, `ip`) VALUES
(2, 1, 2, '2019-05-18 06:38:56', '阿緯', '麥克風測試', '::1'),
(6, 1, 1, '2019-05-18 07:41:27', 'test1', '嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿', '::1'),
(7, 1, 2, '2019-05-18 07:41:51', 'test1', '試試八寶粥', '::1'),
(10, 1, 3, '2019-05-19 09:10:31', 'shellywu', '我來陪你聊天～～～', '::1'),
(11, 1, 2, '2019-05-19 16:24:35', 'as922425', '週週有獎週週抽', '::1'),
(12, 1, 2, '2019-05-20 06:55:56', 'shellywu', 'jjjjjjjjjjjjjjwow', '::1'),
(13, 2, 8, '2019-05-20 06:56:50', 'shellywu', '推薦直接看電視版', '::1'),
(14, 1, 1, '2019-05-20 06:57:47', 'as922425', '笑你寫不出來', '::1'),
(15, 3, 10, '2019-05-20 11:39:10', 'as922425', '韓導保佑我發大財', '::1'),
(16, 3, 10, '2019-05-20 11:50:02', 'test1', '考試考得過 分數進得來  ', '::1'),
(17, 1, 1, '2019-05-20 11:58:44', 'as922425', '哈哈哈哈哈哈哈', '::1'),
(18, 1, 2, '2019-05-20 11:59:03', 'as922425', '樓上不合群', '::1'),
(19, 4, 11, '2019-05-20 12:41:28', 'test1', '高冷是指高麗菜嗎？？', '::1'),
(20, 4, 11, '2019-05-20 12:42:11', 'as922425', '看圖片應該是指茭白筍', '::1'),
(22, 1, 2, '2019-05-21 05:57:51', 'as922425', '測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試測試', '::1'),
(26, 1, 41, '2019-05-21 08:53:44', 'as922425', '新增', '::1'),
(27, 1, 42, '2019-05-21 08:55:15', 'test1', '壞壞', '::1');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `dz_thread`
--
ALTER TABLE `dz_thread`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動增長(AUTO_INCREMENT)
--

--
-- 使用資料表自動增長(AUTO_INCREMENT) `dz_thread`
--
ALTER TABLE `dz_thread`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
