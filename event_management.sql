-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2024 at 05:04 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `venue_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `time` time NOT NULL DEFAULT current_timestamp(),
  `guest_count` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `adminremark` varchar(225) DEFAULT NULL,
  `bookingStatus` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `venue_id`, `username`, `name`, `email`, `date`, `time`, `guest_count`, `message`, `adminremark`, `bookingStatus`) VALUES
(61, 1, 'gagard', 'Gardenia Concillo', 'gagard@gmail.com', '2024-03-14', '16:39:37', 80, ' njbhj', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event` text NOT NULL,
  `description` text NOT NULL,
  `schedule` datetime NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Public, 2=Private',
  `audience_capacity` int(30) NOT NULL,
  `payment_type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Free, 2=Payable',
  `amount` double NOT NULL DEFAULT 0,
  `banner` text NOT NULL,
  `date_created` datetime NOT NULL,
  `venue_id` int(11) NOT NULL,
  `issued` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `user_id`, `event`, `description`, `schedule`, `type`, `audience_capacity`, `payment_type`, `amount`, `banner`, `date_created`, `venue_id`, `issued`) VALUES
(2, 1, 'Birthday', 'gfghcfxhdr', '2024-02-22 17:03:00', 1, 6, 2, 300, './imagesfront.jpg', '2024-02-21 13:06:24', 6, 1),
(3, 1, 'Marriage', 'klmegvkrge', '2024-02-23 16:13:00', 1, 100, 1, 0, './images1698040284004.jpg', '2024-02-21 23:14:44', 4, 0),
(4, 1, 'vdsfgf', 'sdgs', '2024-02-07 03:13:00', 2, 453, 2, 3442, './imagesFB_IMG_1677926579524.jpg', '2024-02-25 03:14:20', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `event_record`
--

CREATE TABLE `event_record` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `issue_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_logs`
--

CREATE TABLE `login_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `login_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_logs`
--

INSERT INTO `login_logs` (`id`, `user_id`, `username`, `login_time`) VALUES
(101, 6, 'admin', '2024-03-10 14:46:45'),
(102, 13, 'gagard', '2024-03-10 14:52:29'),
(103, 6, 'admin', '2024-03-11 08:57:37'),
(104, 13, 'gagard', '2024-03-11 09:01:18'),
(105, 6, 'admin', '2024-03-11 23:12:22'),
(106, 13, 'gagard', '2024-03-11 23:13:11');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `venue_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `cover_img` varchar(255) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `cover_img`, `contact`, `email`) VALUES
(1, 'bjhbh', 'gardenia.jpg', '45046905', 'Concillo@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `store` enum('Italian','Japanese','Mediterranean','Vegetarian','American') DEFAULT NULL,
  `type` enum('client','vendor','staff','admin') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `pic` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `store`, `type`, `created_at`, `pic`) VALUES
(6, 'admin', 'admin@gmail.com', '$2y$10$5yiEGOtl498JVfRe.nKrgO0b3EvxzBxPwPTCX/DdqkfA.PxMVpv0e', NULL, 'admin', '2024-02-14 08:27:21', ''),
(13, 'gagard', 'gagard@gmail.com', '$2y$10$O1oKBYX8bFuYNtjNz.2cY.HhTIGLj7b.eN3O0gFNe8/rPwxr4RuLy', 'American', 'client', '2024-03-08 02:26:25', '1698040445094.jpg'),
(14, 'student', 'student@gmail.com', '$2y$10$6YCwWSKZFK4rkn7o8vT8Ge0Nm60JP3fYFFO3SBqFiN/NT63q1oesW', 'Italian', 'client', '2024-03-08 18:11:09', '1698040445094.jpg'),
(15, 'melca', 'melca@gmail.com', '$2y$10$3pwf.ovzUCGfvykwMKbQperqNsTyR.5SKXS4YCwEjDbr186dzIRfG', 'Japanese', 'client', '2024-03-08 18:22:22', '1698040445094.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_requests`
--

CREATE TABLE `user_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `venue` varchar(255) DEFAULT NULL,
  `event_type` enum('wedding','birthday','corporate','other') DEFAULT NULL,
  `event_style` varchar(50) DEFAULT NULL,
  `guest_count` int(11) DEFAULT NULL,
  `preferred_cuisine` enum('italian','mexican','chinese','american','other') DEFAULT NULL,
  `budget` decimal(10,2) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `ambiance` enum('cozy','elegant','lively','modern','other') DEFAULT NULL,
  `alcohol_and_beverage` text DEFAULT NULL,
  `special_requests` text DEFAULT NULL,
  `admin_response` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_requests`
--

INSERT INTO `user_requests` (`id`, `user_id`, `event_name`, `event_date`, `start_time`, `end_time`, `venue`, `event_type`, `event_style`, `guest_count`, `preferred_cuisine`, `budget`, `location`, `ambiance`, `alcohol_and_beverage`, `special_requests`, `admin_response`) VALUES
(10, 13, 'Her Party', '2024-03-20', '11:27:00', '23:29:00', 'Terrace', 'corporate', NULL, 9, NULL, '9000.00', 'dkbhfbvdfl', 'modern', 'hgbuj', 'jnjhk', 'Good morning. I\'m happy to inform you that this request of you have been approved. '),
(11, 13, 'Her Party', '2024-03-20', '11:27:00', '23:29:00', 'Terrace', 'corporate', NULL, 9, NULL, '9000.00', 'dkbhfbvdfl', 'modern', 'hgbuj', 'jnjhk', NULL),
(12, 13, 'Her Party', '2024-03-20', '11:27:00', '23:29:00', 'Terrace', 'corporate', NULL, 9, NULL, '9000.00', 'dkbhfbvdfl', 'modern', 'hgbuj', 'jnjhk', 'fgbghnhgn'),
(13, 13, 'Chanak', '2024-03-27', '14:59:00', '02:58:00', 'Dining Area', 'wedding', NULL, 20, NULL, '8000.00', 'hhb', 'cozy', 'b hvg', 'ghjh', NULL),
(14, 13, 'Chanak', '2024-03-27', '14:59:00', '02:58:00', 'Dining Area', 'wedding', NULL, 20, NULL, '8000.00', 'hhb', 'cozy', 'b hvg', 'ghjh', NULL),
(15, 13, 'Chanak', '2024-03-27', '14:59:00', '02:58:00', 'Dining Area', 'wedding', NULL, 20, NULL, '8000.00', 'hhb', 'cozy', 'b hvg', 'ghjh', NULL),
(16, 13, 'Chanak', '2024-03-27', '14:59:00', '02:58:00', 'Dining Area', 'wedding', NULL, 20, NULL, '8000.00', 'hhb', 'cozy', 'b hvg', 'ghjh', NULL),
(17, 13, 'Chanak', '2024-03-27', '14:59:00', '02:58:00', 'Dining Area', 'wedding', NULL, 20, NULL, '8000.00', 'hhb', 'cozy', 'b hvg', 'ghjh', NULL),
(18, 13, 'gagard', '2024-03-22', '03:17:00', '15:15:00', 'Outdoor Patio', 'corporate', NULL, 20, NULL, '8000.00', 'hhb', 'cozy', 'b hvg', 'ghjh', NULL),
(19, 13, 'gagard', '2024-03-22', '03:17:00', '15:15:00', 'Outdoor Patio', 'corporate', NULL, 20, NULL, '8000.00', 'hhb', 'cozy', 'b hvg', 'ghjh', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `facilities` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`id`, `name`, `description`, `location`, `contact`, `capacity`, `facilities`, `image`) VALUES
(1, 'The Culinary Haven', 'Join us for an exquisite five-course tasting menu curated by our executive chef, showcasing the finest seasonal ingredients paired with premium wines.', '123 Main Street, Cityville', 'reservations@culinaryhaven.com, (555) 123-4567', 10, 'Private dining room, sommelier service, audiovisual equipment for presentations', '../venue/1.webp'),
(2, 'The Jazz Lounge', 'Enjoy smooth jazz performances every Friday and Saturday night while savoring our signature cocktails and small plates.', '456 Elm Avenue, Townsville', 'info@thejazzlounge.com, (555) 987-6543', 100, 'Stage for performers, sound system, dance floor', '../venue/2.jpg'),
(3, 'Chef&#039;s Table Kitchen', 'Learn from our expert chefs in hands-on cooking classes covering a variety of cuisines and techniques.', '789 Oak Street, Villagetown', 'hefstablekitchen@gmail.com, (555) 789-0123', 20, 'Fully equipped kitchen, demonstration area, cooking stations for attendees', '../venue/3.jpg'),
(4, 'Festive Feast Restaurant', 'Celebrate the holiday season with our special Christmas Eve dinner featuring traditional favorites and festive desserts.', '101 Pine Lane, Holidayville', 'reservations@festivefeast.com, (555) 456-7890', 80, 'Festive decor, customizable menu options, private dining rooms available', '../venue/4.jpg'),
(5, 'Community Bistro', 'Support a good cause at our charity dinner event benefiting the local homeless shelter, featuring a multi-course meal and silent auction.', '234 Maple Road, Communityville', 'events@communitybistro.org, (555) 234-5678', 50, 'Banquet hall, audiovisual equipment for presentations, on-site event coordinator', '../venue/5.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `event_record`
--
ALTER TABLE `event_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venue_id` (`venue_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_requests_user_id` (`user_id`);

--
-- Indexes for table `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `event_record`
--
ALTER TABLE `event_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_requests`
--
ALTER TABLE `user_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`venue_id`) REFERENCES `venues` (`id`);

--
-- Constraints for table `event_record`
--
ALTER TABLE `event_record`
  ADD CONSTRAINT `event_record_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `event_record_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`venue_id`) REFERENCES `venues` (`id`),
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_requests`
--
ALTER TABLE `user_requests`
  ADD CONSTRAINT `fk_user_requests_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
