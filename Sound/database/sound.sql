-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2024 at 11:33 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sound`
--

-- --------------------------------------------------------

--
-- Table structure for table `banned_users`
--

CREATE TABLE `banned_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_role` varchar(15) NOT NULL,
  `profile_pic` varchar(255) NOT NULL DEFAULT 'dp_placeholder.png',
  `date_registered` date NOT NULL DEFAULT current_timestamp(),
  `date_banned` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `category_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `category_img`) VALUES
(13, 'Ringtones', 'TopRingtonesBengali_20220914092338_500x500.jpg'),
(14, 'Qawali', 'kasur-punjabpakistan-june-9-2019-260nw-1841715448.webp'),
(15, 'Songs', 'image.jpg'),
(16, 'Naats', 'maxresdefault.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `comment` varchar(255) NOT NULL,
  `commenter_user_id_FK` int(11) NOT NULL,
  `song_id_FK` int(11) NOT NULL,
  `date_commented` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `commenter_user_id_FK`, `song_id_FK`, `date_commented`) VALUES
(3, 'Me tou Papa hon', 1, 2, '2024-06-17'),
(4, 'dsada', 1, 11, '2024-06-18'),
(5, 'dsaada', 1, 11, '2024-06-18'),
(6, 'Boht Bariya', 2, 10, '2024-06-19'),
(7, 'Hellowwwww', 1, 1, '2024-06-20'),
(8, 'hi', 1, 1, '2024-06-20'),
(9, 'kaise ho', 1, 1, '2024-06-20'),
(10, 'dsad', 1, 9, '2024-06-20'),
(11, 'zabardast', 1, 30, '2024-06-21'),
(12, 'boht khoob', 1, 35, '2024-06-21'),
(13, 'dasda', 1, 35, '2024-06-21'),
(14, 'behtreen', 1, 35, '2024-06-21');

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `id` int(11) NOT NULL,
  `favouriter_user_id_FK` int(11) NOT NULL,
  `song_id_FK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`id`, `favouriter_user_id_FK`, `song_id_FK`) VALUES
(9, 1, 2),
(10, 1, 3),
(11, 1, 29),
(12, 2, 29),
(13, 1, 31),
(14, 1, 35);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) UNSIGNED NOT NULL,
  `liker_user_id_FK` int(11) NOT NULL,
  `song_id_FK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `liker_user_id_FK`, `song_id_FK`) VALUES
(4, 2, 2),
(6, 1, 3),
(23, 1, 5),
(25, 1, 2),
(26, 1, 29),
(27, 2, 29),
(28, 1, 31),
(30, 1, 35);

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `id` int(10) UNSIGNED NOT NULL,
  `song_title` varchar(255) NOT NULL,
  `song_img` varchar(255) NOT NULL,
  `song_path` varchar(255) NOT NULL,
  `is_featured` tinyint(1) NOT NULL,
  `type` varchar(255) NOT NULL,
  `date_added` date NOT NULL DEFAULT current_timestamp(),
  `author` varchar(255) NOT NULL,
  `song_category_id_FK` varchar(100) NOT NULL,
  `adder_admin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`id`, `song_title`, `song_img`, `song_path`, `is_featured`, `type`, `date_added`, `author`, `song_category_id_FK`, `adder_admin`) VALUES
(18, 'New BGM Ringtone', 'hqdefault.webp', 'videoplayback.m4a', 0, 'song', '2024-06-20', 'AR records 123', 'Ringtones', 'admin'),
(19, 'World Best Ringtone', 'hqdefault1.webp', 'videoplayback (1).m4a', 0, 'song', '2024-06-20', 'AR records 123', 'Ringtones', 'admin'),
(20, 'New Instrumental Ringtone', 'hqdefault2.webp', 'videoplayback (2).m4a', 0, 'song', '2024-06-20', 'AR records 123', 'Ringtones', 'admin'),
(21, 'New Bansuri Ringtone', 'hqdefault3.webp', 'videoplayback (3).m4a', 0, 'song', '2024-06-20', 'AR records 123', 'Ringtones', 'admin'),
(22, 'Instrumental Ringtone', 'hqdefault4.webp', 'videoplayback (4).m4a', 0, 'song', '2024-06-20', 'AR records 123', 'Ringtones', 'admin'),
(23, 'Is Karam Ka Karon Shukr Kesy Adaa', 'Untitled.png', 'videoplayback (4) qawali.m4a', 0, 'song', '2024-06-20', 'Nusrat Fateh Ali Khan', 'Qawali', 'admin'),
(24, 'Aastan he ye kis shahe zeeshan ka', 'Untitled1.png', 'videoplayback (3) qawali.m4a', 0, 'song', '2024-06-20', 'Nusrat Fateh Ali Khan', 'Qawali', 'admin'),
(25, 'Unki mehfil me', 'Untitled2.png', 'videoplayback (2) qawali.m4a', 0, 'song', '2024-06-20', 'Nusrat Fateh Ali Khan', 'Qawali', 'admin'),
(26, 'Othe Amlan De Hony Ne Navede', 'Untitled3.png', 'videoplayback qawali.m4a', 0, 'song', '2024-06-20', 'Nusrat Fateh Ali Khan', 'Qawali', 'admin'),
(27, 'Tum Agar Younhi Nazrein Milate Rahe Ustaad Nusrat Fateh Ali Khan', 'Untitled4.png', 'videoplayback (1) qawali.m4a', 0, 'song', '2024-06-20', 'Nusrat Fateh Ali Khan', 'Qawali', 'admin'),
(28, 'Ye Kainat Brai Rasool', 'hq720_qawali_video.webp', 'videoplayback (1) qawali video.mp4', 1, 'video', '2024-06-20', 'Hit Star Records', 'Qawali', 'admin'),
(29, 'Mera Gada Mera Mangta Mera Ghulam Aye', 'hq721_qawali_video.webp', 'Mera Gada Mera Mangta Mera Ghulam Aye _ Best Qawwali _ Nazir Ejaz Faridi Qawwal By Al Khair Video.mp4', 1, 'video', '2024-06-20', 'AR records 123', 'Qawali', 'admin'),
(30, 'Mere Khuwaja Piya', 'hq722.webp', 'Mere Khuwaja Piya.mp4', 1, 'video', '2024-06-21', 'Heera Gold', 'Qawali', 'admin'),
(31, 'Sahara Chahiye Sarkar', 'hq723.webp', 'Sahara Chahiye Sarkar.mp4', 0, 'video', '2024-06-21', 'Hafiz Tahir Qadri', 'Naats', 'admin'),
(32, 'DAR E NABI PAR', 'hq724.webp', 'DAR E NABI PAR.mp4', 0, 'video', '2024-06-21', 'Hafiz Tahir Qadri', 'Naats', 'admin'),
(33, 'Meri Baat Ban Gayi Hai', 'hq725.webp', 'Meri Baat Ban Gayi Hai.mp4', 0, 'video', '2024-06-21', 'Hafiz Tahir Qadri', 'Naats', 'admin'),
(35, 'Hum he muhafiz pak watan ke', 'hq726.webp', 'Hum he muhafiz pak watan ke.mp3', 0, 'song', '2024-06-21', 'Hafiz Tahir Qadri', 'Naats', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_role` varchar(15) NOT NULL,
  `profile_pic` varchar(255) NOT NULL DEFAULT 'dp_placeholder.png',
  `date_registered` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `username`, `email`, `password`, `user_role`, `profile_pic`, `date_registered`) VALUES
(1, 'ADMIN', 'admin', 'admin@mail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'dp_placeholder.png', '2024-06-01'),
(2, 'user', 'user', 'user@user.com', 'ee11cbb19052e40b07aac0ca060c23ee', 'user', 'dp_placeholder.png', '2024-06-18');

-- --------------------------------------------------------

--
-- Table structure for table `user_requests`
--

CREATE TABLE `user_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `song_name` varchar(255) NOT NULL,
  `song_path` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `song_category_id_FK` int(11) NOT NULL,
  `requester_user_id_FK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `id` int(11) NOT NULL,
  `viewer_user_id_FK` int(11) NOT NULL,
  `song_id_FK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `views`
--

INSERT INTO `views` (`id`, `viewer_user_id_FK`, `song_id_FK`) VALUES
(2, 2, 2),
(3, 2, 11),
(4, 2, 10),
(5, 2, 12),
(9, 2, 6),
(10, 2, 6),
(11, 1, 6),
(12, 1, 10),
(13, 1, 4),
(14, 1, 6),
(15, 1, 6),
(16, 1, 6),
(17, 1, 3),
(18, 1, 3),
(19, 1, 3),
(20, 1, 3),
(21, 1, 3),
(22, 1, 3),
(23, 1, 3),
(24, 1, 5),
(25, 1, 5),
(26, 1, 5),
(27, 1, 5),
(28, 1, 5),
(29, 1, 5),
(30, 1, 5),
(31, 1, 5),
(32, 1, 5),
(33, 1, 5),
(34, 1, 1),
(35, 1, 1),
(36, 1, 1),
(37, 1, 1),
(38, 1, 8),
(39, 1, 7),
(40, 1, 9),
(41, 1, 11),
(42, 1, 2),
(43, 1, 2),
(44, 1, 12),
(45, 1, 12),
(46, 1, 12),
(47, 1, 1),
(48, 1, 28),
(49, 1, 29),
(50, 2, 28),
(51, 2, 29),
(52, 2, 19),
(53, 1, 30),
(54, 1, 31),
(55, 1, 32),
(56, 1, 35),
(57, 1, 18),
(58, 1, 19),
(59, 1, 21),
(60, 1, 24),
(61, 1, 20),
(62, 1, 26),
(63, 1, 27),
(64, 1, 23),
(65, 1, 22),
(66, 1, 25);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banned_users`
--
ALTER TABLE `banned_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_requests`
--
ALTER TABLE `user_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banned_users`
--
ALTER TABLE `banned_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_requests`
--
ALTER TABLE `user_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
