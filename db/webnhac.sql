-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 12, 2025 lúc 02:54 PM
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
  `artist` varchar(255) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `songs`
--

INSERT INTO `songs` (`id`, `name`, `fileSong`, `image`, `artist`, `duration`) VALUES
(5, 'Tràn bộ nhớ', './../public/uploads/audio/tbn.mp3', './../public/uploads/img/duongdomic.jpg', 'Dương Domic', 0),
(6, 'Mất kết nối', './../public/uploads/audio/mkn.mp3', './../public/uploads/img/duongdomic.jpg', 'Dương Domic', 0),
(7, 'Đóa hoa', './../public/uploads/audio/doahoa.mp3', './../public/uploads/img/doahoa.jpg', 'BigWind ft TeuYungBoy (prod. DONAL)', 0),
(8, 'BIGTEAM BIGDREAM', './../public/uploads/audio/BIGTEAMBIGDREAM.mp3', './../public/uploads/img/bigteam.jpg', 'BIGTEAM ALL STARS', 0),
(9, 'Wrong Times', './../public/uploads/audio/WrongTimes.mp3', './../public/uploads/img/wrongtime.jpg', ' PUPPY & DANGRANGTO', 0),
(10, 'TIM ANH GHEN', './../public/uploads/audio/timanhghen.mp3', './../public/uploads/img/timanhghen.jpg', ' Wxrdie (ft. LVK, Dangrangto, TeuYungBoy)', 0),
(11, 'Em chỉ là', './../public/uploads/audio/ecl.mp3', './../public/uploads/img/ecl.jpg', 'EXSH', NULL),
(12, 'Gã săn cá', './../public/uploads/audio/gsc.mp3', './../public/uploads/img/gsc.jpg', 'EXSH', NULL),
(13, 'GODS', './../public/uploads/audio/GODS.mp3', './../public/uploads/img/GODS.jpg', 'League of Legend, NewJeans', NULL),
(14, 'Phép Màu', './../public/uploads/audio/pm.mp3', './../public/uploads/img/pm.jpg', 'MAYDAYs ft. Minh Tốc', NULL),
(15, 'Tâm trí lang thang', './../public/uploads/audio/ttlt.mp3', './../public/uploads/img/ttlt.jpg', 'Ánh Sáng AZA ft. Negav', NULL),
(16, 'Từng Quen', './../public/uploads/audio/Từng Quen.mp3', './../public/uploads/img/tungquen.jpg', 'WREN EVANS', NULL),
(17, 'Nước Mắt Cá Sấu', './../public/uploads/audio/Nước Mắt Cá Sấu.mp3', './../public/uploads/img/nuocmatcasau.jpg', 'HIEUTHUHAI', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
