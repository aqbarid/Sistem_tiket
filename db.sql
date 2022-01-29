-- -------------------------------------------------------------
-- TablePlus 4.5.2(403)
--
-- https://tableplus.com/
--
-- Database: sistem_kosan
-- Generation Time: 2022-01-29 20:25:49.2000
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `banks`;
CREATE TABLE `banks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `account_no` varchar(255) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `banks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(11) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `valid` tinyint(1) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `transaction_id` (`transaction_id`),
  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `places`;
CREATE TABLE `places` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` text,
  `contact` text,
  `description` text,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `places_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `request_payments`;
CREATE TABLE `request_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('pending','success','failure') DEFAULT NULL,
  `reason` text,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `request_payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `place_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `type` varchar(255) DEFAULT NULL,
  `price_monthly` int(11) DEFAULT NULL,
  `is_available` tinyint(1) DEFAULT '1',
  `image` varchar(255) DEFAULT NULL,
  `price_daily` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `place_id` (`place_id`),
  CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`place_id`) REFERENCES `places` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `status` enum('pending','success','failure','canceled') DEFAULT NULL,
  `days` int(11) DEFAULT NULL,
  `months` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expired_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `admin_id` (`admin_id`),
  KEY `room_id` (`room_id`),
  CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`),
  CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`),
  CONSTRAINT `transactions_ibfk_4` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text,
  `auth_token` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','customer','seller') NOT NULL,
  `phone` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ballance` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_email` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO `places` (`id`, `user_id`, `name`, `address`, `contact`, `description`, `updated_at`, `created_at`) VALUES
(1, 6, 'Rumah Tepar', 'ssasas', 'asasasas', 'SukabumiSukabumiSukabumiSukabumi', '2022-01-25 14:59:01', '2022-01-25 00:38:27');

INSERT INTO `rooms` (`id`, `place_id`, `name`, `description`, `type`, `price_monthly`, `is_available`, `image`, `price_daily`, `updated_at`, `created_at`) VALUES
(1, 1, 'sopo', 'Opo COK', 'jarwo', 100, 1, '5c7770f3-f2a4-48e0-ad65-e285e7cc9469.png', 10, '2022-01-25 21:11:46', '2022-01-25 21:11:46'),
(2, 1, 'Ruang Ganti', '1212', 'Singaparna', 12, 1, '8c3f1c9f-fae0-447b-88f1-5a94fa0822b5.png', 12, '2022-01-28 21:05:12', '2022-01-28 21:05:12');

INSERT INTO `transactions` (`id`, `customer_id`, `admin_id`, `total`, `room_id`, `status`, `days`, `months`, `updated_at`, `created_at`, `expired_at`) VALUES
(4, 7, NULL, 100, 1, 'pending', 0, 0, '2022-01-29 16:08:06', '2022-01-29 16:08:06', NULL),
(5, 7, NULL, 100, 1, 'pending', 0, 0, '2022-01-29 16:08:35', '2022-01-29 16:08:35', NULL),
(6, 7, NULL, 100, 1, 'pending', 0, 0, '2022-01-29 16:08:43', '2022-01-29 16:08:43', NULL),
(7, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:10:20', '2022-01-29 16:10:20', NULL),
(8, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:18:29', '2022-01-29 16:18:29', NULL),
(9, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:18:46', '2022-01-29 16:18:46', NULL),
(10, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:18:54', '2022-01-29 16:18:54', NULL),
(11, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:18:55', '2022-01-29 16:18:55', NULL),
(12, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:18:55', '2022-01-29 16:18:55', NULL),
(13, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:19:12', '2022-01-29 16:19:12', NULL),
(14, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:19:51', '2022-01-29 16:19:51', NULL),
(15, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:19:53', '2022-01-29 16:19:53', NULL),
(16, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:19:53', '2022-01-29 16:19:53', NULL),
(17, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:19:54', '2022-01-29 16:19:54', NULL),
(18, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:19:54', '2022-01-29 16:19:54', NULL),
(19, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:19:54', '2022-01-29 16:19:54', NULL),
(20, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:19:54', '2022-01-29 16:19:54', NULL),
(21, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:19:54', '2022-01-29 16:19:54', NULL),
(22, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:19:55', '2022-01-29 16:19:55', NULL),
(23, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:19:55', '2022-01-29 16:19:55', NULL),
(24, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:19:55', '2022-01-29 16:19:55', NULL),
(25, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:19:55', '2022-01-29 16:19:55', NULL),
(26, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:19:55', '2022-01-29 16:19:55', NULL),
(27, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:19:56', '2022-01-29 16:19:56', NULL),
(28, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:19:56', '2022-01-29 16:19:56', NULL),
(29, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:19:56', '2022-01-29 16:19:56', NULL),
(30, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:19:56', '2022-01-29 16:19:56', NULL),
(31, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:19:56', '2022-01-29 16:19:56', NULL),
(32, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:19:57', '2022-01-29 16:19:57', NULL),
(33, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:19:57', '2022-01-29 16:19:57', NULL),
(34, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:19:57', '2022-01-29 16:19:57', NULL),
(35, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:19:58', '2022-01-29 16:19:58', NULL),
(36, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:19:58', '2022-01-29 16:19:58', NULL),
(37, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:19:58', '2022-01-29 16:19:58', NULL),
(38, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:19:58', '2022-01-29 16:19:58', NULL),
(39, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:19:58', '2022-01-29 16:19:58', NULL),
(40, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:19:58', '2022-01-29 16:19:58', NULL),
(41, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:19:58', '2022-01-29 16:19:58', NULL),
(42, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:19:58', '2022-01-29 16:19:58', NULL),
(43, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:19:58', '2022-01-29 16:19:58', NULL),
(44, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:19:58', '2022-01-29 16:19:58', NULL),
(45, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:19:59', '2022-01-29 16:19:59', NULL),
(46, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:20:00', '2022-01-29 16:20:00', NULL),
(47, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:20:00', '2022-01-29 16:20:00', NULL),
(48, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:20:00', '2022-01-29 16:20:00', NULL),
(49, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:20:00', '2022-01-29 16:20:00', NULL),
(50, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:20:00', '2022-01-29 16:20:00', NULL),
(51, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:20:00', '2022-01-29 16:20:00', NULL),
(52, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:20:00', '2022-01-29 16:20:00', NULL),
(53, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:20:00', '2022-01-29 16:20:00', NULL),
(54, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:20:00', '2022-01-29 16:20:00', NULL),
(55, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:20:00', '2022-01-29 16:20:00', NULL),
(56, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:20:00', '2022-01-29 16:20:00', NULL),
(57, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:20:01', '2022-01-29 16:20:01', NULL),
(58, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:20:01', '2022-01-29 16:20:01', NULL),
(59, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:20:01', '2022-01-29 16:20:01', NULL),
(60, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:20:01', '2022-01-29 16:20:01', NULL),
(61, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:20:01', '2022-01-29 16:20:01', NULL),
(62, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:20:01', '2022-01-29 16:20:01', NULL),
(63, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:20:01', '2022-01-29 16:20:01', NULL),
(64, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:20:01', '2022-01-29 16:20:01', NULL),
(65, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:20:01', '2022-01-29 16:20:01', NULL),
(66, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:20:01', '2022-01-29 16:20:01', NULL),
(67, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:20:01', '2022-01-29 16:20:01', NULL),
(68, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:20:01', '2022-01-29 16:20:01', NULL),
(69, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:20:02', '2022-01-29 16:20:02', NULL),
(70, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:20:02', '2022-01-29 16:20:02', NULL),
(71, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:20:02', '2022-01-29 16:20:02', NULL),
(72, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:20:02', '2022-01-29 16:20:02', NULL),
(73, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:20:02', '2022-01-29 16:20:02', NULL),
(74, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:35:44', '2022-01-29 16:35:44', NULL),
(75, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:35:57', '2022-01-29 16:35:57', NULL),
(76, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:36:19', '2022-01-29 16:36:19', NULL),
(77, 5, NULL, 240, 2, 'pending', 0, 20, '2022-01-29 16:36:24', '2022-01-29 16:36:24', NULL);

INSERT INTO `users` (`id`, `email`, `name`, `address`, `auth_token`, `password`, `role`, `phone`, `updated_at`, `created_at`, `ballance`) VALUES
(3, 'demo@yahoo.de', 'Tofik', 'demohugfcvbansaS\r\naS\r\na', NULL, '$2y$10$IFiHsR9ufUAGRR81r3bISu/YxI23mgRynU18gCZkUMx/gr5rd5U8K', 'customer', '98765r67', '2022-01-24 12:27:18', '2022-01-24 12:27:18', 0),
(5, 'triad@yahoo.de', 'triad', 'triadtriadtriadtriad', 'e720774d-d4da-45ad-86c0-613d9708729d', '$2y$10$yePurNrAGITy.wxQ5xcgGuCvMEVh7utqMp0YH3yy7KMpkZmC6hwdW', 'customer', '09876543', '2022-01-29 19:42:50', '2022-01-24 20:56:43', 0),
(6, 'owner@test.app', 'owner', 'sukabumi', '5c1299f1-4216-40ed-931d-acfb95c3d427', '$2y$10$yePurNrAGITy.wxQ5xcgGuCvMEVh7utqMp0YH3yy7KMpkZmC6hwdW', 'seller', '0987654', '2022-01-29 20:23:12', '2022-01-24 23:04:14', 0),
(7, 'admin@test.app', 'owner', 'sukabumi', '0fa5a045-e40e-4f48-8b99-4353323fa939', '$2y$10$yePurNrAGITy.wxQ5xcgGuCvMEVh7utqMp0YH3yy7KMpkZmC6hwdW', 'admin', '0987654', '2022-01-29 19:42:02', '2022-01-24 23:04:14', 0);



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;