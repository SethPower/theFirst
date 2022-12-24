-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2022 at 02:58 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_authentic_shoes`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(1, 'Adidas'),
(2, 'Coverse'),
(3, 'Fila'),
(4, 'Gucci'),
(5, 'MLB'),
(6, 'Nike'),
(7, 'Puma'),
(8, 'Vans');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comm_id` int(11) NOT NULL,
  `prd_id` int(11) NOT NULL,
  `comm_name` varchar(255) NOT NULL,
  `comm_mail` varchar(255) NOT NULL,
  `comm_date` datetime NOT NULL,
  `comm_details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comm_id`, `prd_id`, `comm_name`, `comm_mail`, `comm_date`, `comm_details`) VALUES
(1, 1, 'Nguyễn Văn A', 'nguyenvana@gmail.com', '2022-09-28 20:59:56', 'Đây thực sự là một sản phẩm tuyệt vời'),
(2, 2, 'Nguyễn Thị Nhung', 'nhung1@gmail.com', '2022-12-12 18:33:47', 'Giày rất đẹp'),
(3, 3, 'Đào Duy Tùng', 'tunggg@gmail.com', '2022-12-01 18:40:00', 'Giày đi êm chân'),
(4, 3, 'Nguyễn Thị Thanh', 'thanh21@gmail.com', '2022-11-30 18:40:33', 'Đi rất vừa chân'),
(5, 4, 'Mai Ánh Thùy', 'thuy29@gmail.com', '2022-11-16 18:40:52', 'Perfect'),
(6, 5, 'Phương Mai', 'maiham@gmail.com', '2022-11-06 18:41:11', 'Giày rất đẹp'),
(7, 6, 'Thu Huệ', 'huehue@gmail.com', '2022-10-31 18:41:21', 'Giày okela'),
(48, 43, 'Nguyễn Văn Thái', '', '2022-12-15 00:01:08', '1111111111');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_full` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `customer_mail` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `customer_pass` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_full`, `customer_mail`, `customer_pass`) VALUES
(1, 'Nguyễn Thị Nhung', 'nhung_beo@gmail.com', '123456'),
(2, 'Nguyễn Thị Nhung', 'nhung_beo@gmail.com', '123456'),
(3, 'admin', 'nhung_beo@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(4, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(5, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(6, 'admin', 'nhung_beo@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(7, 'admin', 'nhung_beo@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(8, 'admin', 'admin', 'e10adc3949ba59abbe56e057f20f883e'),
(9, 'admin', 'admin', 'e10adc3949ba59abbe56e057f20f883e'),
(10, 'admin', 'admin', 'e10adc3949ba59abbe56e057f20f883e'),
(11, 'Nguyễn Văn Thái', 'nguyenthai.utt@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(12, 'Nguyễn Văn Thái', 'nguyenthai.utt@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(13, 'Nguyễn Văn Thái', 'nguyenthai.utt1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reason` varchar(1000) DEFAULT NULL,
  `total_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `name`, `email`, `address`, `phone`, `status`, `created_at`, `reason`, `total_price`) VALUES
(42, 'Nguyễn Văn Thái', 'nguyenthaiutt@gmail.com', 'Hà Nội', '0399839986', 0, '2022-12-01 01:42:41', NULL, 3600000),
(43, 'Nguyễn Văn Thái', 'nguyenthaiutt@gmail.com', 'Hà Nội', '0399839986', 0, '2022-12-08 01:42:53', NULL, 7600000),
(44, 'Nguyễn Văn Thái', 'nguyenthaiutt@gmail.com', 'Hà Nội', '0399839986', 0, '2022-12-16 01:43:05', NULL, 1590000),
(45, 'Nguyễn Văn Thái', 'nguyenthaiutt@gmail.com', 'Hà Nội', '0399839986', 0, '2022-12-24 01:43:22', NULL, 14500000),
(46, 'Nguyễn Văn Thái', 'nguyenthaiutt@gmail.com', 'Hà Nội', '0399839986', 0, '2022-12-19 01:43:32', NULL, 2550000),
(47, 'Nguyễn Văn Thái', 'nguyenthaiutt@gmail.com', 'Hà Nội', '0399839986', 0, '2022-11-10 01:43:54', NULL, 6090000),
(48, 'Nguyễn Văn Thái', 'nguyenthaiutt@gmail.com', 'Hà Nội', '0399839986', 0, '2022-11-29 01:46:02', NULL, 1200000);

-- --------------------------------------------------------

--
-- Table structure for table `order_mapping`
--

CREATE TABLE `order_mapping` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `number_product` int(11) NOT NULL,
  `total_price_map` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_mapping`
--

INSERT INTO `order_mapping` (`id`, `order_id`, `product_id`, `number_product`, `total_price_map`) VALUES
(44, 42, 43, 3, 3600000),
(45, 43, 36, 4, 7600000),
(46, 44, 28, 1, 1590000),
(47, 45, 21, 2, 0),
(48, 45, 26, 4, 9400000),
(49, 46, 21, 1, 2550000),
(50, 47, 16, 1, 0),
(51, 47, 40, 2, 4400000),
(52, 48, 41, 1, 1200000);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prd_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `prd_name` varchar(255) NOT NULL,
  `prd_image` varchar(255) NOT NULL,
  `prd_price` int(11) UNSIGNED NOT NULL,
  `prd_warranty` varchar(255) NOT NULL,
  `prd_accessories` varchar(255) NOT NULL,
  `prd_promotion` varchar(255) NOT NULL,
  `prd_status` int(1) NOT NULL,
  `prd_featured` int(1) NOT NULL,
  `prd_details` text NOT NULL,
  `prd_original_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prd_id`, `cat_id`, `prd_name`, `prd_image`, `prd_price`, `prd_warranty`, `prd_accessories`, `prd_promotion`, `prd_status`, `prd_featured`, `prd_details`, `prd_original_price`) VALUES
(1, 9, 'Giày Vans Comfort Old Skool Mule White/Red', 'vans2.png', 1490000, '6 Tháng', 'Hộp', '5%', 1, 1, 'Sản phẩm này chúng tôi đang cập nhật nội dung chi tiết, các bạn có thể qua trực tiếp cửa hàng để xem sản phẩm, vì hàng chúng tôi luôn có sẵn.', 1000000),
(2, 9, 'Giày Vans Comfort Old Skool Mule Black ', 'vans1.png', 1490000, '6 Tháng', 'Hộp', '5%', 1, 1, 'Sản phẩm này chúng tôi đang cập nhật nội dung chi tiết, các bạn có thể qua trực tiếp cửa hàng để xem sản phẩm, vì hàng chúng tôi luôn có sẵn.', 1000000),
(3, 3, 'Giày Fila Z Buffer 2 White/ Green Red', 'fila4.png', 1550000, '6 Tháng', 'Hộp', '6%', 1, 0, 'Sản phẩm này chúng tôi đang cập nhật nội dung chi tiết, các bạn có thể qua trực tiếp cửa hàng để xem sản phẩm, vì hàng chúng tôi luôn có sẵn.', 1000000),
(4, 3, 'Giày Fila Ray Tracer Beige Yellow Blue', 'fila3.png', 1550000, '6Tháng', 'Hộp', 'New 100%', 1, 0, 'Sản phẩm này chúng tôi đang cập nhật nội dung chi tiết, các bạn có thể qua trực tiếp cửa hàng để xem sản phẩm, vì hàng chúng tôi luôn có sẵn.', 1000000),
(5, 3, 'Giày Fila Ray Shiny Pink 1RM01142-154', 'fila2.png', 1490000, '6 Tháng', 'Hộp', 'New 100%', 1, 0, 'Sản phẩm này chúng tôi đang cập nhật nội dung chi tiết, các bạn có thể qua trực tiếp cửa hàng để xem sản phẩm, vì hàng chúng tôi luôn có sẵn.', 1000000),
(6, 3, 'Giày Fila Ray Prism 1RM01148-956', 'fila1.png', 1450000, '6 Tháng', 'Hộp', 'New 100%', 1, 1, 'Sản phẩm này chúng tôi đang cập nhật nội dung chi tiết, các bạn có thể qua trực tiếp cửa hàng để xem sản phẩm, vì hàng chúng tôi luôn có sẵn.', 1000000),
(7, 7, 'Giày Puma Smash Vulc Mule – Black', 'puma5.png', 1190000, '6 Tháng', 'Hộp', 'New 100%', 0, 0, 'Sản phẩm này chúng tôi đang cập nhật nội dung chi tiết, các bạn có thể qua trực tiếp cửa hàng để xem sản phẩm, vì hàng chúng tôi luôn có sẵn.', 1000000),
(8, 7, 'Giày Puma W Basket Heart Patent White', 'puma4.png', 1390000, '6 Tháng', 'Hộp', '5%', 1, 0, 'Sản phẩm này chúng tôi đang cập nhật nội dung chi tiết, các bạn có thể qua trực tiếp cửa hàng để xem sản phẩm, vì hàng chúng tôi luôn có sẵn.', 1000000),
(9, 7, 'Giày Puma Skye Clean Pink', 'puma3.png', 1490000, '6 Tháng', 'Hộp', 'New 100%', 1, 0, 'Sản phẩm này chúng tôi đang cập nhật nội dung chi tiết, các bạn có thể qua trực tiếp cửa hàng để xem sản phẩm, vì hàng chúng tôi luôn có sẵn.', 1000000),
(10, 7, 'Giày Puma Carina All White', 'puma2.png', 1490000, '6 Tháng', 'Hộp', 'New 100%', 1, 0, 'Sản phẩm này chúng tôi đang cập nhật nội dung chi tiết, các bạn có thể qua trực tiếp cửa hàng để xem sản phẩm, vì hàng chúng tôi luôn có sẵn.', 1000000),
(11, 7, 'Gìay Puma Bari CV 374362-02', 'puma1.png', 1190000, '6 Tháng', 'Hộp', 'New 100%', 1, 1, 'Sản phẩm này chúng tôi đang cập nhật nội dung chi tiết, các bạn có thể qua trực tiếp cửa hàng để xem sản phẩm, vì hàng chúng tôi luôn có sẵn.', 1000000),
(12, 6, 'Giày MLB Chunky High New York Yankees Black', 'MLB5.png', 1990000, '6 Tháng', 'Hộp', '5%', 0, 0, 'Sản phẩm này chúng tôi đang cập nhật nội dung chi tiết, các bạn có thể qua trực tiếp cửa hàng để xem sản phẩm, vì hàng chúng tôi luôn có sẵn.', 1000000),
(13, 6, 'Giày MLB Bigball Chunky Monogram LT New York Yankees', 'MLB4.png', 2450000, '6 Tháng', 'Hộp', '6%', 1, 0, 'Sản phẩm này chúng tôi đang cập nhật nội dung chi tiết, các bạn có thể qua trực tiếp cửa hàng để xem sản phẩm, vì hàng chúng tôi luôn có sẵn.', 1000000),
(14, 6, 'Giày MLB Big Ball Chunky A Line New York Yankees', 'MLB3.png', 2650000, '6 Tháng', 'Hộp', '5%', 1, 0, 'Sản phẩm này chúng tôi đang cập nhật nội dung chi tiết, các bạn có thể qua trực tiếp cửa hàng để xem sản phẩm, vì hàng chúng tôi luôn có sẵn.', 1000000),
(15, 5, 'Giày MLB Playball Mule Monogram New York Yankees', 'MLB2.png', 1790000, '6 Tháng', 'Hộp', 'New 100%', 1, 0, 'Sản phẩm này chúng tôi đang cập nhật nội dung chi tiết, các bạn có thể qua trực tiếp cửa hàng để xem sản phẩm, vì hàng chúng tôi luôn có sẵn.', 1000000),
(16, 5, 'Giày MLB Mule Dia Monogram New York Yankees Black White', 'MLB1.png', 1690000, '3 tháng', 'Hộp', 'New 100%', 1, 1, 'Sản phẩm này chúng tôi đang cập nhật nội dung chi tiết, các bạn có thể qua trực tiếp cửa hàng để xem sản phẩm, vì hàng chúng tôi luôn có sẵn.', 1000000),
(17, 6, 'Giày Nike Air Jordan 1 Low GS ‘White Gym Red’', 'nike6.png', 3190000, '6 Tháng', 'Hộp', 'New 100%', 1, 0, 'Sản phẩm này chúng tôi đang cập nhật nội dung chi tiết, các bạn có thể qua trực tiếp cửa hàng để xem sản phẩm, vì hàng chúng tôi luôn có sẵn.', 1000000),
(18, 6, 'Giày Nike Air Force 1 ’07 White Metallic Silver', 'nike5.png', 2990000, '6 Tháng', 'Hộp', 'New 100%', 1, 0, 'Sản phẩm này chúng tôi đang cập nhật nội dung chi tiết, các bạn có thể qua trực tiếp cửa hàng để xem sản phẩm, vì hàng chúng tôi luôn có sẵn.', 1000000),
(19, 6, 'Giày Nike Court Legacy Next Nature', 'nike4.png', 1450000, '6 Tháng', 'Hộp', 'New 100%', 1, 0, 'Sản phẩm này chúng tôi đang cập nhật nội dung chi tiết, các bạn có thể qua trực tiếp cửa hàng để xem sản phẩm, vì hàng chúng tôi luôn có sẵn.', 1000000),
(21, 6, 'Giày Nike Air Force 1 GS White Pink Glaze', 'nike2.png', 2550000, '6 tháng', 'Hộp', 'New 100%', 1, 1, 'Sản phẩm này chúng tôi đang cập nhật nội dung chi tiết, các bạn có thể qua trực tiếp cửa hàng để xem sản phẩm, vì hàng chúng tôi luôn có sẵn.', 1000000),
(22, 6, 'Giày Nike Air Force 1 ’07 LX Lucky Charms', 'nike1.png', 3850000, '6 tháng', 'Hộp', 'New 100%', 1, 0, 'Sản phẩm này chúng tôi đang cập nhật nội dung chi tiết, các bạn có thể qua trực tiếp cửa hàng để xem sản phẩm, vì hàng chúng tôi luôn có sẵn.', 1000000),
(23, 1, 'Giày Adidas Forum Low Grey White GW0694', 'adidas4.png', 1890000, '6 tháng', 'Hộp', '5%', 1, 0, 'Sản phẩm này chúng tôi đang cập nhật nội dung chi tiết, các bạn có thể qua trực tiếp cửa hàng để xem sản phẩm, vì hàng chúng tôi luôn có sẵn.', 1000000),
(24, 1, 'Giày Adidas Ultraboost Summer.Rdy White Glory Blue EG0751', 'adidas5.png', 1890000, '3 tháng', 'Hộp', '0%', 1, 0, 'Sản phẩm này chúng tôi đang cập nhật nội dung chi tiết, các bạn có thể qua trực tiếp cửa hàng để xem sản phẩm, vì hàng chúng tôi luôn có sẵn.', 1000000),
(25, 1, 'Giày Adidas X_PLR All White CQ2964', 'adidas3.png', 1490000, '6 tháng', 'Hộp', '6%', 0, 0, 'Sản phẩm này chúng tôi đang cập nhật nội dung chi tiết, các bạn có thể qua trực tiếp cửa hàng để xem sản phẩm, vì hàng chúng tôi luôn có sẵn.', 1000000),
(26, 1, 'Giày Adidas Ultraboost 20 W Core Black EG0714', 'adidas2.png', 2350000, '6 tháng', 'Hộp', '5%', 1, 1, 'Sản phẩm này chúng tôi đang cập nhật nội dung chi tiết, các bạn có thể qua trực tiếp cửa hàng để xem sản phẩm, vì hàng chúng tôi luôn có sẵn.', 1000000),
(27, 1, 'Giày Adidas Forum Low CL Talc/Sesame/Cbrown HQ1506', 'adidas1.png', 1990000, '6 tháng', 'Hộp', '5%', 1, 0, 'Sản phẩm này chúng tôi đang cập nhật nội dung chi tiết, các bạn có thể qua trực tiếp cửa hàng để xem sản phẩm, vì hàng chúng tôi luôn có sẵn.', 1000000),
(28, 9, 'Giày Vans Style 36 Decon Orange', 'vans3.png', 1590000, '6 Tháng', 'Hộp', '5%', 1, 1, '<p><strong>Gi&agrave;y Vans Style 36 Decon Orange</strong></p>\r\n\r\n<p><strong>Thương hiệu</strong>: Vans</p>\r\n\r\n<p><strong>M&atilde; sản phẩm:</strong>&nbsp;VN0A5HFFZGD</p>\r\n\r\n<p><strong>Chất liệu</strong>: Vải</p>\r\n\r\n<p><strong>T&igrave;nh trạng:</strong>&nbsp;H&agrave;ng Fullbox - New&nbsp;100%</p>\r\n\r\n<p><strong>Cam kết ch&iacute;nh h&atilde;ng 100%</strong></p>\r\n', 1000000),
(29, 9, 'Giày Vans Style 36 Decon SF Black Pont', 'vans4.png', 1790000, '6 tháng', 'Hộp', '5%', 1, 0, '<p><strong>Gi&agrave;y Vans Style 36 Decon SF Black Pont</strong></p>\r\n\r\n<p><strong>Thương hiệu</strong>: Vans</p>\r\n\r\n<p><strong>M&atilde; sản phẩm:</strong>&nbsp;VN0A3MVL226</p>\r\n\r\n<p><strong>Chất liệu</strong>: Vải</p>\r\n\r\n<p><strong>T&igrave;nh trạng:</strong>&nbsp;H&agrave;ng Fullbox - New&nbsp;100%</p>\r\n\r\n<p><strong>Cam kết ch&iacute;nh h&atilde;ng 100%</strong></p>\r\n', 1000000),
(30, 4, 'Giày Gucci Rhyton Logo Leather GNG18', 'gucci1.png', 2790000, '6 tháng', 'Hộp', 'New 100%', 1, 0, '', 1000000),
(31, 4, 'Giày Gucci Men’s Rhyton Sneaker With Mouth', 'gucci2.png', 2790000, '6 tháng', 'Hộp', 'New 100%', 0, 0, '', 1000000),
(32, 4, 'Giày Gucci ACE Leather Blue', 'gucci3.png', 2190000, '6 tháng', 'Hộp', 'New 100%', 1, 0, '', 1000000),
(33, 2, 'Giày Thể Thao Unisex CONVERSE Chuck 70 Canvas', 'converse1.png', 2000000, '6 tháng', 'Hộp', 'New 100%', 1, 0, '<p><strong>Gi&agrave;y Thể Thao Unisex CONVERSE Chuck 70 Canvas 162050C</strong></p>\r\n\r\n<p><strong>100% ch&iacute;nh h&atilde;ng CONVERSE</strong></p>\r\n', 1000000),
(34, 2, 'Converse Chuck Taylor All Star 1970s Archive Paint Splatter', 'converse2.png', 2500000, '6 tháng', 'Hộp', 'New 100%', 1, 0, '<p>SKU:&nbsp;A01170C</p>\r\n\r\n<p>Chất liệu:&nbsp;Canvas</p>\r\n\r\n<p>M&agrave;u sắc:&nbsp;Egret/Black/Amarillo</p>\r\n', 1000000),
(35, 2, 'Converse Chuck Taylor All Star Keith Haring', 'converse3.png', 1600000, '6 Tháng', 'Hộp', 'New 100%', 0, 0, '<p>Converse x Keith Haring Chuck Taylor All Star Optical White mang thiết kế ấn tượng độc đ&aacute;o với phần upper được phủ to&agrave;n bộ họa tiết của Keith Haring v&ocirc; c&ugrave;ng sinh động. Những hình vẽ con người với nhi&ecirc;̀u tư th&ecirc;́ khác nhau cùng c&aacute;c đường vẽ đỏ sinh đ&ocirc;̣ng càng làm cho ph&acirc;̀n họa ti&ecirc;́t trở n&ecirc;n n&ocirc;̉i b&acirc;̣t và thu hút hơn. Đ&acirc;y có th&ecirc;̉ chỉ là những hình vẽ ng&acirc;̃u nhi&ecirc;n nhưng nó chứa đựng v&ocirc; vàn các c&acirc;u chuy&ecirc;̣n khác nhau dựa tr&ecirc;n sự sáng tạo của nh&agrave; thiết kế.</p>\r\n', 1000000),
(36, 2, 'Converse Chuck Taylor All Star 1970s Archive Paint Splatte', 'converse4.png', 1900000, '6 Tháng', 'Hộp', 'New 100%', 1, 1, '<p>Ch&agrave;o h&egrave; bằng những thiết kế Converse Archive Paint Splatter, thương hiệu b&oacute;ng rổ đ&igrave;nh đ&aacute;m đ&atilde; c&oacute; dịp chinh phục c&aacute;c bạn trẻ đang hướng đến sự mới lạ v&agrave; phong c&aacute;ch c&aacute; t&iacute;nh. Ứng dụng xu hướng Paint Splatter với h&igrave;nh ảnh những tia sơn m&agrave;u được phun một c&aacute;ch kh&ocirc;ng cần trật tự l&ecirc;n bản in cho thiết kế mới, Converse mang đến item đầy sắc m&agrave;u để bạn &ldquo;hết m&igrave;nh&rdquo; với style trẻ trung, năng động nhất.</p>\r\n', 1000000),
(37, 2, 'Converse Chuck Taylor All Star Gamer Low-Top', 'converse5.png', 1000000, '6 Tháng', 'Hộp', 'New 100%', 1, 0, '<p>Mẫu gi&agrave;y Converse Kid Gamer Low Top sử dụng họa tiết đa m&agrave;u sắc vui nhộn, được lấy cảm hứng từ những tr&ograve; chơi điện tử ăn kh&aacute;ch từ thập kỷ trước, được trẻ em tr&ecirc;n khắp thế giới y&ecirc;u th&iacute;ch. Thiết kế mang phong c&aacute;ch đơn giản nhưng cũng v&ocirc; c&ugrave;ng thu h&uacute;t, sẽ l&agrave; một m&oacute;n qu&agrave; đặc biệt để l&agrave;m c&aacute;c bạn nhỏ bất ngờ.</p>\r\n', 1000000),
(38, 2, 'Converse Chuck Taylor All Star Move Low Top', 'converse6.png', 1900000, '6 tháng', 'Hộp', 'New 100%', 1, 0, '<p>Converse Chuck Taylor All Star Move đ&atilde; quay trở lại trước sự mong đợi của c&aacute;c fan với phi&ecirc;n bản Low Top đầy c&aacute; t&iacute;nh. Đế Platform d&agrave;y dặn nhưng được gia giảm trọng lượng nhờ v&agrave;o chất liệu v&agrave; c&ocirc;ng nghệ hiện đại để trở n&ecirc;n tiện nghi hơn. Mẫu sneakers v&ocirc; c&ugrave;ng trẻ trung gi&uacute;p n&agrave;ng t&ocirc;n d&aacute;ng v&agrave; nổi bật hơn, sẽ trở th&agrave;nh &ldquo;ch&igrave;a kh&oacute;a&rdquo; cho mọi phong c&aacute;ch mix&amp;match khi xuống phố.</p>\r\n', 1000000),
(39, 2, 'Converse Chuck Taylor All Star Seasonal Color', 'converse7.png', 1400000, '6 tháng', 'Hộp', 'New 100%', 1, 0, '<p>Converse Seasonal Color đ&atilde; trở lại với phi&ecirc;n bản Farro cực bắt mắt. Kế thừa những đặc điểm vốn c&oacute; của d&ograve;ng Classic, nay những mẫu gi&agrave;y Seasonal kh&ocirc;ng chỉ thật thời thượng m&agrave; c&ograve;n cho bạn vẻ ngo&agrave;i bắt trend như mong muốn. C&ugrave;ng đ&ocirc;i gi&agrave;y sống-ảo cực chất check-in qua từng địa điểm ưa th&iacute;ch nh&eacute;!</p>\r\n', 1000000),
(40, 8, 'Vans UA Old Skool Pig Suede', 'vans1.png', 2200000, '6 Tháng', 'Hộp', '5%', 1, 0, '<p>Mang trở lại thiết kế Old Skool đ&igrave;nh đ&aacute;m được phủ l&ecirc;n phối m&agrave;u Zephyr v&ocirc; c&ugrave;ng ngọt ng&agrave;o v&agrave; thời thượng ch&iacute;nh l&agrave; si&ecirc;u phẩm Vans Old Skool Pig Suede. Thiết kế n&agrave;y được ho&agrave;n thiện từ chất liệu 100% da lộn mềm mại tựa nhung kết hợp c&ugrave;ng đế gi&agrave;y Waffle Tread v&agrave; c&ocirc;ng nghệ chống thấm nước HEIQ Eco Dry hiện đại mang đến một tổng thể vừa đẹp vừa xịn.</p>\r\n', 1000000),
(41, 8, 'Vans UA Authentic Stackform', 'vans2.png', 1500000, '6 Tháng', 'Hộp', '5%', 1, 0, '<p>Vans Authentic Stackform được gia tăng phần đế trở n&ecirc;n cao v&agrave; d&agrave;y dặn hơn đ&atilde; l&agrave;m cho thiết kế n&agrave;y trở n&ecirc;n thu h&uacute;t ngay từ những &aacute;nh mắt đầu ti&ecirc;n. Phần đế cao n&agrave;y đ&atilde; tạo được một vẻ ngo&agrave;i đậm chất &ldquo;Off The Wall&rdquo; đầy mới mẻ cho diện mạo Authentic quen thuộc. B&ecirc;n cạnh đ&oacute; thiết kế c&ograve;n sử dụng chất liệu 100% Textile cho tổng thể đ&ocirc;i gi&agrave;y mang để một vẻ đẹp bền bỉ, chất lượng hơn so với những c&aacute;c thiết kế Authentic cổ điển kh&aacute;c. Đ&acirc;y l&agrave; một trong những thiết kế hứa hẹn &ldquo;l&agrave;m mưa l&agrave;m gi&oacute;&rdquo; trong cộng đồng thời trang hiện nay.</p>\r\n', 1000000),
(42, 8, 'Vans UA Authentic Vans Collage', 'vans3.png', 1550000, '6 tháng', 'Hộp', '5%', 1, 0, '<p>Hiện đại, thẩm mỹ, s&aacute;ng tạo, Vans Collage tiếp tục bước v&agrave;o thế giới nghệ thuật đương đại với kỹ thuật Collage mang đến hiệu ứng thị gi&aacute;c độc đ&aacute;o. Đa dạng với c&aacute;c bản in được cắt gh&eacute;p kh&eacute;o l&eacute;o c&ugrave;ng biểu tượng logo Vans v&agrave; họa tiết Checkerboard đặc trưng thể hiện t&iacute;nh di sản của thương hiệu. BST được tạo n&ecirc;n với những mảnh gh&eacute;p mộc mạc li&ecirc;n kết với nhau một c&aacute;ch bất quy tắc với c&aacute;ch tạo h&igrave;nh tự do, ph&oacute;ng kho&aacute;ng v&agrave; kh&ocirc;ng theo một trật tự n&agrave;o.&nbsp;</p>\r\n', 1000000),
(43, 8, 'Vans UA Era Color Theory Shale Green', 'vans4.png', 1450000, '6 Tháng', 'Hộp', '5%', 1, 1, '<p>Đ&atilde; đến l&uacute;c x&oacute;a bỏ sự tr&ugrave;ng lặp v&agrave; đến với thiết kế mới, đơn giản nhưng kh&ocirc;ng k&eacute;m phần thời trang của Vans Color Theory Shale Green. Phối m&agrave;u đơn sắc Shale Green nhẹ nh&agrave;ng, thanh m&aacute;t, mang t&iacute;nh thời thượng cho sự trẻ trung c&ugrave;ng phong c&aacute;ch năng động, những mẫu Vans mới n&agrave;y sẽ l&agrave; item định hướng bạn hội nhập với trend đang l&ecirc;n ng&ocirc;i trong năm nay.</p>\r\n', 1000000),
(44, 8, 'Vans MN Skate Old Skool', 'vans5.png', 2200000, '6 Tháng', 'Hộp', '5%', 1, 0, '<p>H&igrave;nh mẫu Old Skool cổ điển t&aacute;i xuất trong phi&ecirc;n bản Vans Skate Old Skool với h&agrave;ng loạt cải tiến mang t&iacute;nh đột ph&aacute; cho d&ograve;ng gi&agrave;y trượt v&aacute;n. T&aacute;i sinh bằng một c&aacute;i t&ecirc;n mới, mẫu gi&agrave;y kh&ocirc;ng chỉ g&acirc;y ấn tượng bởi những chi tiết nhỏ nhất được thay đổi, m&agrave; c&ograve;n l&agrave;m dậy s&oacute;ng l&agrave;ng skaters với c&ocirc;ng nghệ đỉnh cao t&iacute;ch hợp trong miếng l&oacute;t Duracap, đệm l&oacute;t PopCush hay keo cao su SickStick, mang lại sự thoải m&aacute;i v&agrave; tiện nghi đối đa cho c&aacute;c skate-thủ.</p>\r\n', 1000000),
(45, 8, 'Vans UA Classic Slip-On Paradise Floral', 'vans6.png', 1500000, '6 Tháng', 'Hộp', '5%', 1, 0, '<p>Vans Paradise Floral ứng dụng tone m&agrave;u lạnh cho những b&ocirc;ng hoa, c&acirc;y cỏ miền &ocirc;n đới, với sức h&uacute;t k&igrave; lạ đến từ sự thanh cao của c&aacute;c lo&agrave;i hoa xứ lạnh. Kh&ocirc;ng c&ograve;n sắc hoa sặc sỡ như những phi&ecirc;n bản trước đ&oacute;, thiết kế lần n&agrave;y của Vans tập trung v&agrave;o đường n&eacute;t, lựa chọn từng mẫu hoa văn cũng như ch&uacute; trọng phong c&aacute;ch phối m&agrave;u k&iacute;ch th&iacute;ch thị gi&aacute;c. BST mang đến những item ho&agrave;n hảo cho phong c&aacute;ch nhẹ nh&agrave;ng, tinh tế hơn, kết hợp c&aacute;c loại chất liệu bền bỉ c&ugrave;ng kh&acirc;u gia c&ocirc;ng tỉ mỉ để sản phẩm đạt độ thoải m&aacute;i, tiện nghi nhất.</p>\r\n', 1000000);

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `product_id` int(11) NOT NULL,
  `sale_price` int(11) NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `end_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`product_id`, `sale_price`, `start_date`, `end_date`) VALUES
(43, 1200000, '2022-12-13 10:00:00', '2022-12-30 10:00:00'),
(42, 1400000, '2022-12-16 17:00:00', '2022-12-30 17:00:00'),
(41, 1200000, '2022-12-20 17:00:00', '2022-12-30 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_full` varchar(255) NOT NULL,
  `user_mail` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_full`, `user_mail`, `user_pass`, `user_level`) VALUES
(1, 'Vietpro Academy', 'vietpro.edu.vn@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1),
(2, 'Administrator', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1),
(3, 'Nguyễn Van A', 'nguyenvana@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2),
(4, 'Nguyễn Van B', 'nguyenvanb@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2),
(5, 'Nguyễn Van C', 'nguyenvanc@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2),
(6, 'Nguyễn Van D', 'nguyenvand@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2),
(7, 'Kế toán 01', 'ketoan01@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`),
  ADD UNIQUE KEY `cat_name` (`cat_name`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comm_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `order_mapping`
--
ALTER TABLE `order_mapping`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prd_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_mail` (`user_mail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `order_mapping`
--
ALTER TABLE `order_mapping`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
