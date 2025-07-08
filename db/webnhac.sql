-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 08, 2025 lúc 07:22 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `webnhac`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `songs`
--

CREATE TABLE `songs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `fileSong` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `artist` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `songs`
--

INSERT INTO `songs` (`id`, `name`, `fileSong`, `image`, `artist`) VALUES
(1, 'Gã săn cá', './../public/uploads/audio/gsc.mp3', './../public/uploads/img/gsc.jpg', 'EXSH'),
(4, 'Phép màu', './../public/uploads/audio/pm.mp3', './../public/uploads/img/pm.jpg', 'MAYDAYs ft. Minh Tốc'),
(5, 'Tràn bộ nhớ', './../public/uploads/audio/tbn.mp3', './../public/uploads/img/duongdomic.jpg', 'Dương Domic'),
(6, 'Mất kết nối', './../public/uploads/audio/mkn.mp3', './../public/uploads/img/duongdomic.jpg', 'Dương Domic'),
(7, 'Đóa hoa', './../public/uploads/audio/doahoa.mp3', './../public/uploads/img/doahoa.jpg', 'BigWind ft TeuYungBoy (prod. DONAL)'),
(8, 'BIGTEAM BIGDREAM', './../public/uploads/audio/BIGTEAMBIGDREAM.mp3', './../public/uploads/img/bigteam.jpg', 'BIGTEAM ALL STARS'),
(9, 'Wrong Times', './../public/uploads/audio/WrongTimes.mp3', './../public/uploads/img/wrongtime.jpg', ' PUPPY & DANGRANGTO'),
(10, 'TIM ANH GHEN', './../public/uploads/audio/timanhghen.mp3', './../public/uploads/img/timanhghen.jpg', ' Wxrdie (ft. LVK, Dangrangto, TeuYungBoy)');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
