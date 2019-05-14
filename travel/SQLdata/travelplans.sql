-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 
-- サーバのバージョン： 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db1`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `travelplans`
--

CREATE TABLE `travelplans` (
  `id` int(11) NOT NULL,
  `planName` varchar(100) NOT NULL,
  `area` tinyint(3) NOT NULL,
  `terminal` varchar(50) NOT NULL,
  `access` tinyint(2) NOT NULL,
  `accessDetails` varchar(1000) NOT NULL,
  `time` tinyint(2) NOT NULL,
  `budget` mediumint(7) NOT NULL,
  `planDetails` varchar(3000) NOT NULL,
  `photo` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `travelplans`
--

INSERT INTO `travelplans` (`id`, `planName`, `area`, `terminal`, `access`, `accessDetails`, `time`, `budget`, `planDetails`, `photo`) VALUES
(1, '松島', 2, '仙台駅', 0, '仙台駅から仙石線で松島海岸駅まで\r\n約30分', 1, 5000, '遊覧船で島々を見る（約1時間、1500円）\r\nかまぼこや牡蠣などを食べ歩きする\r\n国宝の瑞巌寺を見る', ''),
(2, '太宰府', 8, '博多駅', 0, '鹿児島本線で博多から二日市まで\r\n西鉄太宰府線で西鉄二日市から太宰府まで\r\n約40分、430円', 1, 4000, '太宰府天満宮\r\n九州国立博物館', ''),
(3, '道後温泉', 7, '松山駅', 0, 'JR松山駅前から伊予鉄道５系統 ・道後温泉行で道後温泉駅まで\r\n約30分160円\r\n温泉街の主な観光地は徒歩で30分程度の範囲におさまる。', 3, 20000, '道後温泉本館は格安でお茶菓子でもてなしてもらえる立ち寄り湯。\r\nその他の外湯も風情があり、温泉街や寺社巡りなど一泊したほうが楽しめるだろう。', ''),
(16, 'かのやばら園', 8, '鹿児島中央駅', 1, '鹿児島中央から垂水港もしくは鹿屋まで移動すると、ばら園までのバスがある。\r\n桜島や大隅半島の観光と組み合わせることをお勧めする。', 2, 3000, '広大な公園でバラがたくさん咲いている。', './upfile/IMG_3136.JPG'),
(17, '湯布院', 8, '博多駅', 1, '博多から直通バスがある。', 1, 8000, '写真の金鱗湖はバス停から歩いて30分ほど。\r\n美術館や雑貨店など洗練された温泉街である。\r\n立ち寄り湯だけでも楽しめるが、シャガール美術館や自動車歴史館を楽しむには一泊ほしいかもしれない。', './upfile/IMG_2269.JPG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `travelplans`
--
ALTER TABLE `travelplans`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `travelplans`
--
ALTER TABLE `travelplans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
