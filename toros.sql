-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 05 Ara 2018, 19:06:54
-- Sunucu sürümü: 10.1.30-MariaDB
-- PHP Sürümü: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `toros`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `to_customers`
--

CREATE TABLE `to_customers` (
  `id` int(11) NOT NULL COMMENT 'Customer ID',
  `username` varchar(25) NOT NULL COMMENT 'Customer Username',
  `adress` text NOT NULL COMMENT 'Customer Adress',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `del` enum('0','1') NOT NULL DEFAULT '0' COMMENT 'Delete Status 0:active 1:deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Customer Table';

--
-- Tablo döküm verisi `to_customers`
--

INSERT INTO `to_customers` (`id`, `username`, `adress`, `created_at`, `del`) VALUES
(1, 'developer', 'Test Mah. Test Sok. Test Apt. B Blk. No:2/2', '2018-12-01 10:42:04', '0'),
(2, 'test', 'test', '2018-12-02 02:35:26', '0');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `to_orderdetails`
--

CREATE TABLE `to_orderdetails` (
  `id` int(11) NOT NULL,
  `oid` int(11) NOT NULL COMMENT 'Order ID',
  `pid` int(11) NOT NULL COMMENT 'Product ID',
  `number` int(11) NOT NULL COMMENT 'Unit',
  `totalp` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Order Details Table';

--
-- Tablo döküm verisi `to_orderdetails`
--

INSERT INTO `to_orderdetails` (`id`, `oid`, `pid`, `number`, `totalp`) VALUES
(1, 1, 1, 5, '2.00'),
(2, 1, 5, 1, '6.00'),
(3, 1, 10, 10, '9.00'),
(4, 2, 1, 2, '4.00'),
(5, 2, 2, 1, '8.00'),
(6, 2, 3, 1, '14.00'),
(7, 2, 4, 1, '17.00'),
(8, 3, 2, 1, '4.00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `to_orders`
--

CREATE TABLE `to_orders` (
  `id` int(11) NOT NULL COMMENT 'Price ID',
  `cid` int(11) DEFAULT NULL COMMENT 'Customer ID',
  `totalprice` decimal(10,2) DEFAULT NULL COMMENT 'Total Price',
  `region` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL COMMENT 'Created Date',
  `del` enum('0','1') NOT NULL DEFAULT '0' COMMENT 'Delete Status 0:active 1:deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Orders Table';

--
-- Tablo döküm verisi `to_orders`
--

INSERT INTO `to_orders` (`id`, `cid`, `totalprice`, `region`, `created_at`, `del`) VALUES
(1, 2, '10.62', 2, '2018-12-03 03:50:51', '0'),
(2, 1, '20.06', 4, '2018-12-03 03:52:25', '0'),
(3, 1, '4.72', 1, '2018-12-03 19:28:46', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `to_products`
--

CREATE TABLE `to_products` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL COMMENT 'Product Name',
  `price` decimal(10,2) NOT NULL COMMENT 'Product Price',
  `stock` int(11) NOT NULL DEFAULT '100' COMMENT 'Stock',
  `updated_at` datetime DEFAULT NULL COMMENT 'Last Updated Time',
  `del` enum('0','1') NOT NULL DEFAULT '0' COMMENT 'Delete Status 0:active 1:deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `to_products`
--

INSERT INTO `to_products` (`id`, `name`, `price`, `stock`, `updated_at`, `del`) VALUES
(1, 'test', '5.00', 25, '2018-12-03 19:29:40', '0'),
(2, 'test', '5.00', 25, '2018-12-03 19:29:40', '0'),
(3, 'test', '5.00', 25, '2018-12-03 19:29:40', '0'),
(4, 'test', '5.00', 25, '2018-12-03 19:29:40', '1'),
(5, 'test', '5.00', 25, '2018-12-03 19:29:40', '0'),
(6, 'test', '5.00', 25, '2018-12-03 19:29:40', '0'),
(7, 'test', '5.00', 25, '2018-12-03 19:29:40', '0'),
(8, 'test', '5.00', 25, '2018-12-03 19:29:40', '0'),
(9, 'test', '5.00', 25, '2018-12-03 19:29:40', '0'),
(10, 'test', '5.00', 5, '2018-12-03 19:30:41', '0'),
(11, 'test', '5.00', 25, '2018-12-03 19:29:40', '0'),
(12, 'test', '5.00', 25, '2018-12-03 19:29:40', '0'),
(13, 'test', '5.00', 25, '2018-12-03 19:29:40', '0'),
(14, 'test', '5.00', 25, '2018-12-03 19:29:40', '0'),
(15, 'test', '5.00', 25, '2018-12-03 19:29:40', '0'),
(16, 'test', '5.00', 25, '2018-12-03 19:29:40', '0');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `to_profits`
--

CREATE TABLE `to_profits` (
  `id` int(11) NOT NULL COMMENT 'Profit ID',
  `totalsale` decimal(10,2) DEFAULT NULL COMMENT 'Total Sales',
  `grosssale` decimal(10,2) DEFAULT NULL COMMENT 'Gross Sales',
  `netincome` decimal(10,2) DEFAULT NULL COMMENT 'Net Income',
  `start_at` datetime DEFAULT NULL COMMENT 'Calculate Start Date',
  `end_at` datetime DEFAULT NULL COMMENT 'Calculate End Date'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Profit Table';

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `to_regions`
--

CREATE TABLE `to_regions` (
  `id` int(11) NOT NULL COMMENT 'Region ID',
  `region` varchar(100) NOT NULL COMMENT 'Region Name',
  `estimatedt` int(3) NOT NULL COMMENT 'Estimated Time',
  `del` enum('0','1') NOT NULL DEFAULT '0' COMMENT 'Delete Status 0:active 1:deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Region Table';

--
-- Tablo döküm verisi `to_regions`
--

INSERT INTO `to_regions` (`id`, `region`, `estimatedt`, `del`) VALUES
(1, 'Toros University', 10, '0'),
(2, 'Pozcu', 20, '0'),
(3, 'Mezitli', 30, '0'),
(4, 'Others', 45, '0'),
(5, 'X University', 60, '0');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `to_customers`
--
ALTER TABLE `to_customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Tablo için indeksler `to_orderdetails`
--
ALTER TABLE `to_orderdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oid` (`oid`);

--
-- Tablo için indeksler `to_orders`
--
ALTER TABLE `to_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cid` (`cid`);

--
-- Tablo için indeksler `to_products`
--
ALTER TABLE `to_products`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `to_profits`
--
ALTER TABLE `to_profits`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `to_regions`
--
ALTER TABLE `to_regions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `region` (`region`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `to_customers`
--
ALTER TABLE `to_customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Customer ID', AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `to_orderdetails`
--
ALTER TABLE `to_orderdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `to_orders`
--
ALTER TABLE `to_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Price ID', AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `to_products`
--
ALTER TABLE `to_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Tablo için AUTO_INCREMENT değeri `to_profits`
--
ALTER TABLE `to_profits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Profit ID';

--
-- Tablo için AUTO_INCREMENT değeri `to_regions`
--
ALTER TABLE `to_regions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Region ID', AUTO_INCREMENT=6;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `to_orderdetails`
--
ALTER TABLE `to_orderdetails`
  ADD CONSTRAINT `to_orderdetails_ibfk_1` FOREIGN KEY (`oid`) REFERENCES `to_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `to_orders`
--
ALTER TABLE `to_orders`
  ADD CONSTRAINT `to_orders_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `to_customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
