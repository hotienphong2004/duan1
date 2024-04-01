-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 19, 2024 lúc 02:40 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ecommerce`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` float NOT NULL,
  `product_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `cat_name`, `status`) VALUES
(4, 'Đồng hồ cơ', 1),
(5, 'Đồng hồ điện tử', 1),
(6, 'Đồng hồ thể thao', 1),
(8, 'Casio', 1),
(9, 'G-Shock', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(3000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `contact`
--

INSERT INTO `contact` (`contact_id`, `name`, `email`, `subject`, `message`) VALUES
(48, 'Jennie Nguyen', 'quanhoang5202@gmail.com', 'abc', '123');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_code` varchar(255) NOT NULL,
  `order_date` varchar(255) NOT NULL,
  `order_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`order_id`, `customer_id`, `order_code`, `order_date`, `order_status`) VALUES
(28, 1, '3859', '18/12/2023 01:40:03pm', 2),
(29, 1, '9446', '18/12/2023 06:27:38pm', 2),
(30, 1, '855', '18/12/2023 06:37:14pm', 2),
(31, 1, '1016', '18/12/2023 07:28:45pm', 1),
(32, 1, '6458', '19/03/2024 07:31:03pm', 1),
(33, 1, '507', '19/03/2024 08:38:15pm', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `order_detall_id` int(11) NOT NULL,
  `order_code` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `phone` varchar(1000) NOT NULL,
  `fee_shipping` varchar(3000) NOT NULL,
  `product_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
--

INSERT INTO `order_detail` (`order_detall_id`, `order_code`, `product_id`, `product_quantity`, `name`, `address`, `country`, `zipcode`, `phone`, `fee_shipping`, `product_price`) VALUES
(10, '3859', 20, 1, 'Jennie Nguyen', '72 Long Tri Street, Ban Long Commue', 'Việt Nam', '7777', '0389938935', 'free', 4047000),
(11, '9446', 12, 1, 'Jennie Nguyen', '72 Long Tri Street, Ban Long Commue', 'Việt Nam', '7777', '0795921369', 'free', 5194000),
(12, '9446', 15, 2, 'Jennie Nguyen', '72 Long Tri Street, Ban Long Commue', 'Việt Nam', '7777', '0795921369', 'free', 13385000),
(13, '855', 15, 1, 'Jennie Nguyen', '72 Long Tri Street, Ban Long Commue', 'Việt Nam', '7777', '0389948946', 'free', 13385000),
(14, '1016', 20, 1, 'Jennie Nguyen', '72 Long Tri Street, Ban Long Commue', 'Việt Nam', '7777', '0389948946', 'free', 4047000),
(15, '1016', 15, 1, 'Jennie Nguyen', '72 Long Tri Street, Ban Long Commue', 'Việt Nam', '7777', '0389948946', 'free', 13385000),
(16, '6458', 20, 1, 'Jennie Nguyen', '72 Long Tri Street, Ban Long Commue', 'Việt Nam', '7777', '0795921369', 'free', 4047000),
(17, '6458', 18, 2, 'Jennie Nguyen', '72 Long Tri Street, Ban Long Commue', 'Việt Nam', '7777', '0795921369', 'free', 4276000),
(18, '507', 15, 1, 'Jennie Nguyen', '72 Long Tri Street, Ban Long Commue', 'Việt Nam', '8888', '0389938935', 'free', 13385000),
(19, '507', 14, 1, 'Jennie Nguyen', '72 Long Tri Street, Ban Long Commue', 'Việt Nam', '8888', '0389938935', 'free', 466000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `p_id` int(11) NOT NULL,
  `category_name` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `MRP` float DEFAULT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `product_sold` int(11) DEFAULT NULL,
  `img` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`p_id`, `category_name`, `product_name`, `MRP`, `price`, `qty`, `product_sold`, `img`, `description`, `status`) VALUES
(9, 5, 'Casio World Time AE-1200WHD', 500, 1373000, 100, NULL, 'dhdt1.jpg', 'Mẫu Orient', 1),
(10, 6, 'Casio - Nam AE-1200WHD', 500, 1020000, 100, NULL, 'dhtt1.jpg', 'Đồng hồ nam ', 1),
(11, 8, 'Casio - Nam GA-2100', 500, 2720000, 100, NULL, 'casio1.jpg', 'Casio', 1),
(12, 9, 'G-SHOCK GA-2100NNJ', 500, 5194000, 99, 1, 'gshock2.jpg', 'gshock', 1),
(13, 4, 'Seiko 5 Sports', 500, 13170000, 100, NULL, 'dhc2.jpg', 'Seiko 5', 1),
(14, 5, 'Casio F-201WA-9ADF', 500, 466000, 100, NULL, 'casio2.jpg', 'Casio', 1),
(15, 4, 'Citizen Tsuyosa', 500, 13385000, 88, 12, 'dhc3.jpg', 'Citizen', 1),
(16, 6, 'Seiko 5', 500, 8760000, 100, NULL, 'dhtt2.jpg', 'Seiko', 1),
(17, 8, 'Casio MTP-1381L', 500, 1607000, 100, NULL, 'casio3.jpg', 'Casio', 1),
(18, 9, 'G-Shock GA', 500, 4276000, 100, 0, 'gshock3.jpg', 'G-Shock', 1),
(19, 9, 'G-Shock B2100', 500, 5280000, 100, NULL, 'gshock4.jpg', 'GA-B2100', 1),
(20, 9, 'G-Shock 100BP', 500, 4047000, 99, 1, 'gshock5.jpg', 'GA-100BP', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(8, 'admin', 'admin@gmail.com', '123456', 1),
(11, 'user', 'user@gmail.com', '123456', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_registers`
--

CREATE TABLE `user_registers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user_registers`
--

INSERT INTO `user_registers` (`id`, `name`, `email`, `password`) VALUES
(1, 'quanhoang', 'quanhoang12@gmail.com', '$2y$10$saU000Jq7z7Cwi65Nl1re.13IinLFimaJnOsdEtDIKUojorjaU7dS'),
(2, 'quanhoang', 'quanhoang13@gmail.com', '$2y$10$71rJIbSItB6LeHSVUALnqurrt7c1HKwhz6AlH65Hfl9H0JOsekiSG'),
(7, 'Nguyễn Hoàng Quân', 'hquan200209@gmail.com', '$2y$10$UVJhy0iYh3oGLXYcHmna4.t4Yd.YbdK4Iyrx2ra8vlOKEJI9P7dUu'),
(8, 'quan13', 'hquan2002092215@gmail.com', '$2y$10$879ciXADk9.UoAGDvZX6UOvRJInD9gzQ/TRMqd5a0VWamdwfvywAu');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_detall_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user_registers`
--
ALTER TABLE `user_registers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_detall_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `user_registers`
--
ALTER TABLE `user_registers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
