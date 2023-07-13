-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 13, 2023 lúc 06:38 AM
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
-- Cơ sở dữ liệu: `xss_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `any_input`
--

CREATE TABLE `any_input` (
  `input` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `comment` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`name`, `comment`, `timestamp`) VALUES
('Attacker', '&lt;img src=1 onerror=alert(1)&gt;', '2023-07-13 11:24:59'),
('Attacker', '&quot; ; $alert(1); \\', '2023-07-13 11:26:12'),
('Attacker', 'PGltZyBzcmM9ImEucG5nIiBvbmVycm9yPSJkb2N1bWVudC5jb29raWU9J2FkbWluJyI ', '2023-07-13 11:26:32'),
('Attacker', 'PGltZyBzcmM9ImEucG5nIiBvbmVycm9yPSJkb2N1bWVudC5jb29raWVfbmFtZT0nYWRtaW4nIj4=', '2023-07-13 11:28:01'),
('Attacker', '12', '2023-07-13 11:30:32'),
('Attacker', '&lt;img src= onerror=alert(1)&gt;', '2023-07-13 11:32:07'),
('Attacker', '&lt;svg onload=alert(1)//', '2023-07-13 11:36:16'),
('Attacker', '&lt;/td&gt;\r\n&lt;image src =q onerror=prompt(8)&gt;', '2023-07-13 11:38:29');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
