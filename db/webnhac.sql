-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 18, 2025 lúc 12:21 PM
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
-- Cấu trúc bảng cho bảng `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `song_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `song_id`, `created_at`) VALUES
(29, 24, 71, '2025-11-18 10:49:38'),
(30, 24, 38, '2025-11-18 15:58:49'),
(31, 24, 20, '2025-11-18 17:32:05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `playlists`
--

CREATE TABLE `playlists` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `playlists`
--

INSERT INTO `playlists` (`id`, `user_id`, `name`, `created_at`) VALUES
(3, 24, 'gsggssg', '2025-11-18 06:03:17'),
(4, 24, 'Nhac hay', '2025-11-18 06:05:00'),
(9, 24, 'Nhac tre', '2025-11-18 10:31:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `playlist_songs`
--

CREATE TABLE `playlist_songs` (
  `id` int(11) NOT NULL,
  `playlist_id` int(11) NOT NULL,
  `song_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `playlist_songs`
--

INSERT INTO `playlist_songs` (`id`, `playlist_id`, `song_id`) VALUES
(4, 4, 57),
(6, 4, 12);

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
  `duration` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `songs`
--

INSERT INTO `songs` (`id`, `name`, `fileSong`, `image`, `artist`, `duration`) VALUES
(5, 'Tràn bộ nhớ', './../public/uploads/audio/tbn.mp3', './../public/uploads/img/duongdomic.jpg', 'Dương Domic', '02:52'),
(6, 'Mất kết nối', './../public/uploads/audio/', './../public/uploads/img/', 'Dương D', '03:27'),
(8, 'BIGTEAM BIGDREAM', './../public/uploads/audio/BIGTEAMBIGDREAM.mp3', './../public/uploads/img/bigteam.jpg', 'BIGTEAM ALL STARS', '08:50'),
(9, 'Wrong Times', './../public/uploads/audio/WrongTimes.mp3', './../public/uploads/img/wrongtime.jpg', ' PUPPY & DANGRANGTO', '03:31'),
(10, 'TIM ANH GHEN', './../public/uploads/audio/timanhghen.mp3', './../public/uploads/img/timanhghen.jpg', ' Wxrdie (ft. LVK, Dangrangto, TeuYungBoy)', '04:39'),
(11, 'Em chỉ là', './../public/uploads/audio/ecl.mp3', './../public/uploads/img/ecl.jpg', 'EXSH', '05:14'),
(12, 'Gã săn cá', './../public/uploads/audio/gsc.mp3', './../public/uploads/img/gsc.jpg', 'EXSH', '03:52'),
(13, 'GODS', './../public/uploads/audio/GODS.mp3', './../public/uploads/img/GODS.jpg', 'League of Legend, NewJeans', '03:40'),
(14, 'Phép Màu', './../public/uploads/audio/pm.mp3', './../public/uploads/img/pm.jpg', 'MAYDAYs ft. Minh Tốc', '04:26'),
(15, 'Tâm trí lang thang', './../public/uploads/audio/ttlt.mp3', './../public/uploads/img/ttlt.jpg', 'Ánh Sáng AZA ft. Negav', '03:57'),
(16, 'Từng Quen', './../public/uploads/audio/Từng Quen.mp3', './../public/uploads/img/tungquen.jpg', 'WREN EVANS', '02:55'),
(17, 'Nước Mắt Cá Sấu', './../public/uploads/audio/Nước Mắt Cá Sấu.mp3', './../public/uploads/img/nuocmatcasau.jpg', 'HIEUTHUHAI', '03:26'),
(18, 'Không Đau Nữa Rồi', './../public/uploads/audio/kdnr.mp3', './../public/uploads/img/kdnr.jpg', 'EXSH', '04:51'),
(19, 'Không Phải Gu', './../public/uploads/audio/KhongPhaiGu-HIEUTHUHAI.mp3', './../public/uploads/img/KHONGPHAIGU.jpg', 'HIEUTHUHAI', '03:21'),
(20, 'Exit Sign', './../public/uploads/audio/ExitSign-HIEUTHUHAI.mp3', './../public/uploads/img/HIEUTHUHAI.jpg', 'HIEUTHUHAI', '03:21'),
(21, 'NOLOVENOLIFE', './../public/uploads/audio/NOLOVENOLIFE-HIEUTHUHAI-11966374.mp3', './../public/uploads/img/HIEUTHUHAI.jpg', 'HIEUTHUHAI', '02:50'),
(22, 'TRÌNH', './../public/uploads/audio/TRINH.mp3', './../public/uploads/img/TRINH.jpg', 'HIEUTHUHAI', '04:35'),
(23, 'Không Thể Say', './../public/uploads/audio/KhongTheSay-HIEUTHUHAI-9293024.mp3', './../public/uploads/img/KHONGTHESAY.jpg', 'HIEUTHUHAI', '03:48'),
(24, 'Love Is', './../public/uploads/audio/LoveIs-Dangrangto-9784305.mp3', './../public/uploads/img/Love Is.jpg', 'Dangrangto', '04:26'),
(25, 'NGỰA Ô', './../public/uploads/audio/NguaO-DangrangtoTeuYungBoyDONAL-16262158.mp3', './../public/uploads/img/NGUA O.jpg', 'TeuYungBoy, Dangrangto (Prod. DONAL)', '03:35'),
(26, 'Âm Thầm Bên Em', './../public/uploads/audio/AmThamBenEm-SonTungMTP-4066476.mp3', './../public/uploads/img/amthambenem.jpg', 'Sơn Tùng MTP', '04:51'),
(27, 'Chúng Ta Của Hiện Tại', './../public/uploads/audio/ChungTaCuaHienTai-SonTungMTP-6892340.mp3', './../public/uploads/img/ChungTaCuaHienTai.jpg', 'Sơn Tùng MTP', '05:01'),
(28, 'Lạc Trôi', './../public/uploads/audio/LacTroi-SonTungMTP-4725907.mp3', './../public/uploads/img/LacTroi.jpg', 'Sơn Tùng MTP', '03:53'),
(29, 'Nơi Này Có Anh', './../public/uploads/audio/NoiNayCoAnh-SonTungMTP-4772041.mp3', './../public/uploads/img/NoiNayCoAnh.jpg', 'Sơn Tùng MTP', '04:20'),
(30, 'Quả Chín Quá', './../public/uploads/audio/QuaChinQua.mp3', './../public/uploads/img/QuaChinQua.jpg', 'EXSH', '04:38'),
(31, 'Not My Fault', './../public/uploads/audio/NotMyFault.mp3', './../public/uploads/img/NotMyFault.jpg', 'EXSH', '04:05'),
(32, 'Chập Chờn', './../public/uploads/audio/ChapChon-DuongDomic-16783110.mp3', './../public/uploads/img/duongdomic.jpg', 'Dương Domic', '03:12'),
(33, 'Pin Dự Phòng', './../public/uploads/audio/PinDuPhong-DuongDomicLouHoang-16783112.mp3', './../public/uploads/img/duongdomic.jpg', 'Dương Domic, Lou Hoàng', '03:46'),
(34, 'Phóng Đổ Tim Em', './../public/uploads/audio/PHONGDOTIMEM.mp3', './../public/uploads/img/Album LOI CHOI.jpg', 'Wren Evans, Itsnk ', '02:14'),
(35, 'Call Me', './../public/uploads/audio/CallMe-WrenEvans-13081940.mp3', './../public/uploads/img/Album LOI CHOI.jpg', 'WREN EVANS', '03:34'),
(36, 'Cầu Vĩnh Tuy', './../public/uploads/audio/CauVinhTuy-WrenEvans-13082061.mp3', './../public/uploads/img/Album LOI CHOI.jpg', 'Wren Evans, Itsnk ', '02:31'),
(37, 'Bé Ơi Từ Từ', './../public/uploads/audio/BE OI TU TU.mp3', './../public/uploads/img/Album LOI CHOI.jpg', 'Wren Evans, Itsnk ', '03:20'),
(38, 'Cứu Lấy Âm Nhạc', './../public/uploads/audio/CuuLayAmNhac-WrenEvansitsnk-35083141.mp3', './../public/uploads/img/CUULAYAMNHAC.jpg', 'WREN EVANS', '03:03'),
(39, '3107 3', './../public/uploads/audio/31073-WnDuongGNauTitie-7058449.mp3', './../public/uploads/img/31073.jpg', 'W/n ft. 267, Nâu, Duongg', '04:00'),
(40, '3107-2 (Lofi Ver.)', './../public/uploads/audio/31072LofiVersion-DuonggNauWn-6944268.mp3', './../public/uploads/img/31072.jpg', 'DuongG x NÂU x W/N', '03:31'),
(41, '3107 4', './../public/uploads/audio/31074-WnERIKNau-7663728.mp3', './../public/uploads/img/31074.jpg', 'W/n x Erik ft Nâu', '03:33'),
(42, 'id 072019', './../public/uploads/audio/Id072019-WN-10597501.mp3', './../public/uploads/img/id072019.jpg', 'W/n x 3107 ft. 267', '04:31'),
(43, 'Mashup Túy Âm x Lục Hải Vi Vương', './../public/uploads/audio/TuyAmLocHaiViVuongTuyAmLive-PhuongMyChiKhaLauKeLou-37699682.mp3', './../public/uploads/img/singasia.jpg', ' Phương Mỹ Chi x Kelou', '04:19'),
(48, 'Yêu Người Có Ước Mơ', './../public/uploads/audio/YeuNguoiCoUocMo-buitruonglinh-8396692.mp3', './../public/uploads/img/cover_688a445bebc753.46755043.jpg', 'buitruonglinh', '04:56'),
(49, 'Bóng Phù Hoa (Live)', './../public/uploads/audio/BongPhuHoaLive-PhuongMyChi-37382168.mp3', './../public/uploads/img/cover_688a447f0dde26.93473391.jpg', 'Phương Mỹ Chi', '04:48'),
(50, 'Buôn Trăng (Live)', './../public/uploads/audio/BuonTrangLive-PhuongMyChi-37122984.mp3', './../public/uploads/img/cover_688a448d50d1f8.75998932.jpg', 'Phương Mỹ Chi', '03:44'),
(51, 'Chúng Ta Của Tương Lai', './../public/uploads/audio/Chung Ta Cua Tuong Lai - Son Tung M-TP - NhacHayVN.mp3', './../public/uploads/img/cover_688a44abb9f7e5.08857574.jpg', 'Sơn Tùng M-TP', '04:09'),
(52, 'Giấc Mơ Không Có Thật', './../public/uploads/audio/GiacMoKhongCoThat-NgocDac-7663178.mp3', './../public/uploads/img/GiacMoKhongCoThat-NgocDac.jpg', 'Ngọc Đắc', '04:00'),
(53, 'Eyes, Nose, Lips', './../public/uploads/audio/EyesNoseLips-TAEYANG-6293041.mp3', './../public/uploads/img/EyesNoseLips-TAEYANG.jpg', 'TAEYANG', '03:50'),
(54, 'Chuyện Đôi Ta', './../public/uploads/audio/ChuyenDoiTa-EmceeLDaLAB-7120974.mp3', './../public/uploads/img/cover_688a4850749b20.71990452.jpg', 'Emcee L (Da LAB)', '03:28'),
(55, 'Gió (Lofi)', './../public/uploads/audio/GioLofi-Jank1967-8874174.mp3', './../public/uploads/img/cover_688a48627e5951.17460895.jpg', 'Jank, 1 9 6 7', '02:53'),
(57, 'See You Later (Spring Of Youth Ost)', './../public/uploads/audio/SeeYouLaterSpringOfYouthOst-DangCapNhat-36999050.mp3', './../public/uploads/img/cover_688a490205ad23.36196999.jpg', 'Đang Cập Nhật', '02:40'),
(58, 'Vibeglo', './../public/uploads/audio/Vibeglo-A1JDiitonHanSaraMuoiiAnhSangAZA-37793674.mp3', './../public/uploads/img/vibeglo.jpg', '桃子A1J, Diiton, Han Sara, Muộii, Ánh Sáng AZA', '03:02'),
(59, 'NGƯỜI NHƯ ANH XỨNG ĐÁNG CÔ ĐƠN', './../public/uploads/audio/NGƯỜI NHƯ ANH XỨNG ĐÁNG CÔ ĐƠN.mp3', './../public/uploads/img/nnaxdcd.jpg', 'ANH TRAI \"SAY HI\", Vũ Cát Tường, Karik, Negav, Ngô Kiến Huy, Jey B', '05:16'),
(61, 'Không Buông', './../public/uploads/audio/Không Buông.mp3', './../public/uploads/img/khongbuong.jpg', 'Hngle,Ari (Việt Nam)', '02:54'),
(62, 'Ngày Này Năm Ấy', './../public/uploads/audio/Ngày Này Năm Ấy.mp3', './../public/uploads/img/Ngày Này Năm Ấy.jpg', 'Việt Anh', '03:59'),
(63, '跳楼机', './../public/uploads/audio/跳楼机.mp3', './../public/uploads/img/跳楼机.jpg', 'LBI', '03:21'),
(64, 'ĐỘC NHẤT VÔ NHỊ', './../public/uploads/audio/ĐỘC NHẤT VÔ NHỊ.mp3', './../public/uploads/img/ĐỘC NHẤT VÔ NHỊ.jpg', 'nvtu1906', '04:19'),
(69, 'ĐỘC NHẤT VÔ NHỊ', './../public/uploads/audio/ĐỘC NHẤT VÔ NHỊ.mp3', './../public/uploads/img/T1con.png', 'Nguyễn Đức Trọng', '04:19'),
(71, 'See You Later (Spring Of Youth Ost)', './../public/uploads/audio/SeeYouLaterSpringOfYouthOst-DangCapNhat-36999050.mp3', './../public/uploads/img/T1con.png', 'Nguyễn Đức Trọng', '02:40'),
(72, 'NGƯỜI NHƯ ANH XỨNG ĐÁNG CÔ ĐƠN', './../public/uploads/audio/NGƯỜI NHƯ ANH XỨNG ĐÁNG CÔ ĐƠN.mp3', './../public/uploads/img/T1con.png', 'Nguyễn Đức Trọng', '05:16'),
(77, 'Bóng Phù Hoa (Live)', './../public/uploads/audio/BongPhuHoaLive-PhuongMyChi-37382168.mp3', './../public/uploads/img/T1con.png', 'Nguyễn Đức Trọng', '04:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `song_genres`
--

CREATE TABLE `song_genres` (
  `song_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `sodienthoai` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `sodienthoai`, `image`) VALUES
(1, 'nvtu1906', 'tutue9692@gmail.com', '123', 372016584, ''),
(2, 'Tứ Nguyễn', 'tutue96922@gmail.com', '123', 372016584, ''),
(3, 'Tứ Nguyễn', 'tutue96922@gmail.com', '123', 372016584, ''),
(4, 'Tứ Nguyễn', 'tutue96922@gmail.com', '123', 372016584, ''),
(24, 'Nguyễn Đức Trọng', 'ductrong34end@gmail.com', '123', 968843380, './../public/uploads/img/T1con.png'),
(25, 'E.N.D', 'natsudragneeletherious11@gmail.com', '123', 968843380, './../public/uploads/img/Untitled-3.jpg');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favorites_ibfk_1` (`user_id`),
  ADD KEY `favorites_ibfk_2` (`song_id`);

--
-- Chỉ mục cho bảng `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `playlist_songs`
--
ALTER TABLE `playlist_songs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `playlist_id` (`playlist_id`),
  ADD KEY `song_id` (`song_id`);

--
-- Chỉ mục cho bảng `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `song_genres`
--
ALTER TABLE `song_genres`
  ADD PRIMARY KEY (`song_id`,`genre_id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `playlist_songs`
--
ALTER TABLE `playlist_songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`song_id`) REFERENCES `songs` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `playlists`
--
ALTER TABLE `playlists`
  ADD CONSTRAINT `playlists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `playlist_songs`
--
ALTER TABLE `playlist_songs`
  ADD CONSTRAINT `playlist_songs_ibfk_1` FOREIGN KEY (`playlist_id`) REFERENCES `playlists` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `playlist_songs_ibfk_2` FOREIGN KEY (`song_id`) REFERENCES `songs` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `song_genres`
--
ALTER TABLE `song_genres`
  ADD CONSTRAINT `song_genres_ibfk_1` FOREIGN KEY (`song_id`) REFERENCES `songs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `song_genres_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
