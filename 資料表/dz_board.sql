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
-- 資料表結構 `dz_board`
--

CREATE TABLE `dz_board` (
  `id` int(11) NOT NULL,
  `board_id` int(11) NOT NULL,
  `account` varchar(32) CHARACTER SET utf8 NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(64) CHARACTER SET utf8 NOT NULL,
  `content` varchar(1024) CHARACTER SET utf8 NOT NULL,
  `ip` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `dz_board`
--

INSERT INTO `dz_board` (`id`, `board_id`, `account`, `time`, `title`, `content`, `ip`) VALUES
(1, 1, 'shelly', '2019-05-16 07:31:52', '有沒有不知道怎麼寫作業的八卦？', '跪求大神降臨\r\n小弟願以豐盛晚餐答謝', ''),
(8, 2, 'shellywu', '2019-05-20 06:56:38', '知否知否應是綠肥紅瘦', '好長我根本看不完＝＝', '::1'),
(10, 3, 'as922425', '2019-05-20 11:38:59', '黑特', '韓導萬歲', '::1'),
(11, 4, 'as922425', '2019-05-20 11:59:51', '長腿高冷模特兒', 'https://i.imgur.com/Nh2Gvw7.jpg', '::1'),
(12, 5, 'as922425', '2019-05-21 05:46:13', ' [心得] 總是能讓我一買再買的Celvoke', '兩天一夜的那種小旅行帶他感覺就可以省去腮紅不用帶了                              \r\n質地也是一如往常的滑順 顯色感也是他們家一如往常的透明感                         \r\nhttps://i.imgur.com/Lwe5kyo.jpg                                                 \r\n這整盤顏色 不得不說我都很喜歡                                                   \r\n硬要推第一名的話是右上角的梅粉色 單擦這層顏色也會很美 溫柔感爆棚                \r\n第二名是右下角我深陷的南瓜橘色 霜狀質地可用來當眼影 頰彩 唇彩都ok               \r\n                                                                                \r\n再來是煥彩潤色條01號                                                            \r\nhttps://i.imgur.com/TFEzLxb.jpg                                                 \r\n潤色條櫃姐跟我說這支可當眼影 頰彩 唇彩                                          \r\n（我怎麼就是受不了這種可以多用的產品XD）                                        \r\nhttps://i.imgur.com/OUxQgwE.jpg                                                 \r\n質地也是超滑順那種                                                              \r\n而且顏色是很可愛的杏桃橘 這種顏色別的專櫃很難看到                               \r\n而且這個東西太特別了啦 一定要收回家試試                                         \r\n所以我一看到就是受不了立刻入手哈哈  ', '::1'),
(41, 1, 'as922425', '2019-05-21 08:53:15', '測試', 'test123\r\ntest12345', '::1'),
(42, 1, 'test1', '2019-05-21 08:55:07', '<script>alert(\"OAO\");</script>', '<script>alert(\"OAO\");</script>', '::1');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `dz_board`
--
ALTER TABLE `dz_board`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動增長(AUTO_INCREMENT)
--

--
-- 使用資料表自動增長(AUTO_INCREMENT) `dz_board`
--
ALTER TABLE `dz_board`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
