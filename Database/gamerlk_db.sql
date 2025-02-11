-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.37 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.7.0.6850
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for gamerlk
CREATE DATABASE IF NOT EXISTS `gamerlk` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `gamerlk`;

-- Dumping structure for table gamerlk.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `email` varchar(100) NOT NULL,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `verification_code` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table gamerlk.admin: ~1 rows (approximately)
INSERT INTO `admin` (`email`, `fname`, `lname`, `verification_code`) VALUES
	('gamerlk888@gmail.com', 'Gamer', 'LK', '666464d9ab4c6');

-- Dumping structure for table gamerlk.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `users_email` varchar(100) NOT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `fk_cart_product1_idx` (`product_id`),
  KEY `fk_cart_users1_idx` (`users_email`),
  CONSTRAINT `fk_cart_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_cart_users1` FOREIGN KEY (`users_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table gamerlk.cart: ~6 rows (approximately)
INSERT INTO `cart` (`cart_id`, `product_id`, `users_email`) VALUES
	(60, 4, 'lawantha@gmail.com'),
	(61, 5, 'lawantha@gmail.com'),
	(121, 13, 'hesa@gmail.com'),
	(122, 7, 'hesa@gmail.com'),
	(123, 4, 'hesa@gmail.com'),
	(125, 3, 'mandujayaweera2003@gmail.com'),
	(126, 21, 'mandujayaweera2003@gmail.com'),
	(127, 20, 'mandujayaweera2003@gmail.com'),
	(128, 22, 'mandujayaweera2003@gmail.com'),
	(129, 23, 'mandujayaweera2003@gmail.com'),
	(130, 15, 'mandujayaweera2003@gmail.com'),
	(131, 16, 'mandujayaweera2003@gmail.com');

-- Dumping structure for table gamerlk.category
CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table gamerlk.category: ~5 rows (approximately)
INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
	(1, 'Windows'),
	(2, 'Android'),
	(3, 'Play station'),
	(4, 'Other'),
	(5, 'TV');

-- Dumping structure for table gamerlk.chat
CREATE TABLE IF NOT EXISTS `chat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `content` text,
  `date_time` datetime DEFAULT NULL,
  `status` int DEFAULT NULL,
  `from` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_chat_users1_idx` (`from`),
  CONSTRAINT `fk_chat_users1` FOREIGN KEY (`from`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table gamerlk.chat: ~2 rows (approximately)
INSERT INTO `chat` (`id`, `content`, `date_time`, `status`, `from`) VALUES
	(30, 'fdhgf', '2024-06-08 18:20:37', 1, 'mandujayaweera2003@gmail.com');

-- Dumping structure for table gamerlk.contry
CREATE TABLE IF NOT EXISTS `contry` (
  `contry_id` int NOT NULL AUTO_INCREMENT,
  `contry_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`contry_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table gamerlk.contry: ~3 rows (approximately)
INSERT INTO `contry` (`contry_id`, `contry_name`) VALUES
	(1, 'Sri Lanka'),
	(2, 'U.S.A'),
	(3, 'U.K');

-- Dumping structure for table gamerlk.feedback
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` int DEFAULT NULL,
  `feedback` text,
  `date` datetime DEFAULT NULL,
  `product_id` int NOT NULL,
  `users_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_feedback_product1_idx` (`product_id`),
  KEY `fk_feedback_users1_idx` (`users_email`),
  CONSTRAINT `fk_feedback_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_feedback_users1` FOREIGN KEY (`users_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table gamerlk.feedback: ~29 rows (approximately)
INSERT INTO `feedback` (`id`, `type`, `feedback`, `date`, `product_id`, `users_email`) VALUES
	(1, 1, 'Wow that\'s good', '2023-10-10 17:03:25', 12, 'mandujayaweera2003@gmail.com'),
	(2, 1, 'i like this game', '2023-10-21 11:56:16', 6, 'mandujayaweera2003@gmail.com'),
	(3, 1, 'It\'s the creszy', '2023-10-21 11:57:00', 2, 'mandujayaweera2003@gmail.com'),
	(4, 1, 'Love this Game', '2023-10-21 12:02:45', 3, 'mandujayaweera2003@gmail.com'),
	(5, 1, 'WOOW', '2023-10-21 12:08:35', 5, 'mandujayaweera2003@gmail.com'),
	(6, 2, 'no Bad', '2023-10-21 12:10:00', 4, 'mandujayaweera2003@gmail.com'),
	(7, 1, 'Love', '2023-10-21 12:15:20', 13, 'mandujayaweera2003@gmail.com'),
	(8, 1, 'shoot babyy', '2023-10-21 12:21:42', 11, 'mandujayaweera2003@gmail.com'),
	(9, 2, 'nice', '2023-10-21 12:22:50', 10, 'mandujayaweera2003@gmail.com'),
	(10, 3, 'mmm', '2023-10-21 12:25:15', 9, 'mandujayaweera2003@gmail.com'),
	(11, 2, 'no bad', '2023-10-21 12:29:01', 8, 'mandujayaweera2003@gmail.com'),
	(12, 3, 'Eww', '2023-10-21 12:30:35', 7, 'mandujayaweera2003@gmail.com'),
	(13, 1, 'Love Creazzy', '2023-10-21 12:31:10', 6, 'mandujayaweera2003@gmail.com'),
	(14, 1, 'Love', '2023-10-21 12:32:49', 6, 'mandujayaweera2003@gmail.com'),
	(15, 1, 'Good Software', '2023-10-21 12:34:57', 16, 'mandujayaweera2003@gmail.com'),
	(16, 2, 'good', '2023-10-21 15:40:32', 15, 'mandujayaweera2003@gmail.com'),
	(17, 1, 'Love', '2023-10-21 15:59:37', 14, 'mandujayaweera2003@gmail.com'),
	(18, 1, 'wow babyy', '2023-10-21 16:11:32', 17, 'mandujayaweera2003@gmail.com'),
	(19, 2, 'good app but gamerlk is best', '2024-05-28 09:00:46', 18, 'mandujayaweera2003@gmail.com'),
	(20, 1, 'aww', '2024-05-28 09:02:28', 19, 'mandujayaweera2003@gmail.com'),
	(21, 2, 'humm', '2024-05-28 09:05:48', 23, 'mandujayaweera2003@gmail.com'),
	(22, 3, 'bad', '2024-05-28 09:06:20', 22, 'mandujayaweera2003@gmail.com'),
	(23, 1, 'love', '2024-05-28 09:06:59', 21, 'mandujayaweera2003@gmail.com'),
	(24, 1, 'best', '2024-05-28 09:07:16', 20, 'mandujayaweera2003@gmail.com'),
	(25, 1, 'lovee', '2024-05-28 09:52:34', 3, 'abc@gmail.com'),
	(26, 2, 'nice', '2024-06-06 00:59:12', 17, 'mandujayaweera2003@gmail.com'),
	(27, 1, 'wow', '2024-06-06 01:02:28', 17, 'mandujayaweera2003@gmail.com'),
	(28, 1, 'good', '2024-06-06 01:18:55', 1, 'mandujayaweera2003@gmail.com'),
	(29, 1, 'good', '2024-06-06 02:36:31', 12, 'mandujayaweera2003@gmail.com'),
	(30, 2, 'no', '2024-06-06 14:07:14', 9, 'mandujayaweera2003@gmail.com'),
	(31, 2, 'wow', '2024-06-06 20:51:06', 5, 'hesa@gmail.com'),
	(32, 2, 'yo', '2024-06-07 10:01:55', 12, 'mandujayaweera2003@gmail.com'),
	(33, 1, 'good', '2024-06-07 10:32:14', 17, 'mandujayaweera2003@gmail.com'),
	(34, 3, 'bad', '2024-06-07 13:31:01', 22, 'mandujayaweera2003@gmail.com'),
	(35, 2, 'mm', '2024-06-07 21:34:37', 5, 'hesa@gmail.com'),
	(36, 1, 'nice', '2024-06-07 23:05:21', 14, 'hesa@gmail.com');

-- Dumping structure for table gamerlk.game_type
CREATE TABLE IF NOT EXISTS `game_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table gamerlk.game_type: ~6 rows (approximately)
INSERT INTO `game_type` (`id`, `type_name`) VALUES
	(1, 'Action'),
	(2, 'Shooting'),
	(3, 'Strategy'),
	(4, 'Puzzle'),
	(5, 'Horror'),
	(6, 'Application ');

-- Dumping structure for table gamerlk.gender
CREATE TABLE IF NOT EXISTS `gender` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gender_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table gamerlk.gender: ~2 rows (approximately)
INSERT INTO `gender` (`id`, `gender_name`) VALUES
	(1, 'Male'),
	(2, 'Female');

-- Dumping structure for table gamerlk.invoice
CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` varchar(50) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `total` double DEFAULT NULL,
  `status` int DEFAULT NULL,
  `product_id` int NOT NULL,
  `users_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_invoice_product1_idx` (`product_id`),
  KEY `fk_invoice_users1_idx` (`users_email`),
  CONSTRAINT `fk_invoice_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_invoice_users1` FOREIGN KEY (`users_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table gamerlk.invoice: ~23 rows (approximately)
INSERT INTO `invoice` (`id`, `order_id`, `date`, `total`, `status`, `product_id`, `users_email`) VALUES
	(1, '6660c0a03259e', '2024-06-06 01:17:00', 9000, 0, 1, 'mandujayaweera2003@gmail.com'),
	(2, '6660c0f06550a', '2024-06-06 01:18:21', 9000, 0, 1, 'mandujayaweera2003@gmail.com'),
	(3, '6660c25763425', '2024-06-06 01:24:25', 8508, 0, 3, 'mandujayaweera2003@gmail.com'),
	(4, '6660c275096cb', '2024-06-06 01:24:52', 25000, 0, 17, 'mandujayaweera2003@gmail.com'),
	(5, '6660c4830f6c9', '2024-06-06 01:33:47', 8000, 0, 4, 'mandujayaweera2003@gmail.com'),
	(6, '6660c4934bf53', '2024-06-06 01:34:09', 8000, 0, 5, 'mandujayaweera2003@gmail.com'),
	(7, '6660c4c1abdb3', '2024-06-06 01:34:47', 25000, 0, 17, 'mandujayaweera2003@gmail.com'),
	(8, '6660c4c36d14b', '2024-06-06 01:34:56', 25000, 0, 17, 'mandujayaweera2003@gmail.com'),
	(18, '6660d1e85e60b', '2024-06-06 02:30:51', 1500, 0, 12, 'mandujayaweera2003@gmail.com'),
	(19, '6660d392eb143', '2024-06-06 02:37:59', 4500, 0, 14, 'mandujayaweera2003@gmail.com'),
	(20, '666162fe3ff02', '2024-06-06 12:49:52', 3000, 0, 13, 'mandujayaweera2003@gmail.com'),
	(21, '66616ae9f0ad4', '2024-06-06 13:23:45', 8000, 0, 4, 'mandujayaweera2003@gmail.com'),
	(22, '66617407a3604', '2024-06-06 14:02:35', 4100, 0, 9, 'mandujayaweera2003@gmail.com'),
	(23, '666187cb9f32a', '2024-06-06 15:27:32', 3000, 0, 13, 'mandujayaweera2003@gmail.com'),
	(24, '6661d3b4f0a02', '2024-06-06 20:50:41', 8000, 0, 5, 'hesa@gmail.com'),
	(25, '6661e470e22ec', '2024-06-06 22:02:13', 9009, 0, 1, 'mandujayaweera2003@gmail.com'),
	(26, '6661ece244b4d', '2024-06-06 22:38:22', 8000, 0, 19, 'mandujayaweera2003@gmail.com'),
	(27, '6661ed8f1fbd8', '2024-06-06 22:41:14', 9755, 0, 6, 'mandujayaweera2003@gmail.com'),
	(28, '66628d0c75a71', '2024-06-07 10:01:28', 1500, 0, 12, 'mandujayaweera2003@gmail.com'),
	(29, '66629414132c3', '2024-06-07 10:31:31', 25000, 0, 17, 'mandujayaweera2003@gmail.com'),
	(30, '6662bda950a79', '2024-06-07 13:28:53', 1000, 0, 22, 'mandujayaweera2003@gmail.com'),
	(31, '66632f31ccdb0', '2024-06-07 21:33:46', 8008, 0, 5, 'hesa@gmail.com'),
	(32, '666344655bd0d', '2024-06-07 23:03:56', 8000, 0, 4, 'hesa@gmail.com'),
	(33, '6663449a9c3ed', '2024-06-07 23:04:45', 4500, 0, 14, 'hesa@gmail.com');

-- Dumping structure for table gamerlk.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `price` double DEFAULT NULL,
  `description` text,
  `title` varchar(100) DEFAULT NULL,
  `datetime_added` datetime DEFAULT NULL,
  `category_cat_id` int NOT NULL,
  `status_status_id` int NOT NULL,
  `game_type_id` int DEFAULT NULL,
  `game_link` text,
  PRIMARY KEY (`id`),
  KEY `fk_product_category1_idx` (`category_cat_id`),
  KEY `fk_product_status1_idx` (`status_status_id`),
  KEY `fk_product_game_type1_idx` (`game_type_id`),
  CONSTRAINT `fk_product_category1` FOREIGN KEY (`category_cat_id`) REFERENCES `category` (`cat_id`),
  CONSTRAINT `fk_product_game_type1` FOREIGN KEY (`game_type_id`) REFERENCES `game_type` (`id`),
  CONSTRAINT `fk_product_status1` FOREIGN KEY (`status_status_id`) REFERENCES `status` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table gamerlk.product: ~23 rows (approximately)
INSERT INTO `product` (`id`, `price`, `description`, `title`, `datetime_added`, `category_cat_id`, `status_status_id`, `game_type_id`, `game_link`) VALUES
	(1, 9009, 'Call of Duty is a military video game series and media franchise published by Activision, starting in 2003. The games were first developed by Infinity Ward, then by Treyarch and Sledgehammer Games. Several spin-off and handheld games were made by other developers. The most recent title, Call of Duty: Modern Warfare III, was released on November 10, 2023. The upcoming title, Call of Duty: Black Ops 6, is scheduled to be released in October 2024.', 'Call of Duty ', '2023-10-11 19:11:38', 1, 1, 1, 'https://oceansofgamess.com/call-duty-modern-warfare-2-campaign-remastered-free-download'),
	(2, 9900, 'FarCry 5 is a first-person shooter video game developed by Ubisoft Montreal and published by Ubisoft. It is set in the fictional Hope County, Montana, where a cult called Eden\'s Gate has taken over and the player must work with local resistance fighters to liberate the county from the cult\'s control.', 'Far cry 5', '2023-09-05 15:38:33', 1, 1, 1, 'https://oceansofgamess.com/far-cry-5-dead-living-zombies-free-download/'),
	(3, 8508, 'Minecraft is a popular sandbox video game that allows players to build and explore virtual worlds made up of blocks.', 'Minecraft', '2023-09-05 15:39:46', 1, 1, 3, 'https://oceansofgamess.com/minecraft-free-download/download'),
	(4, 8000, 'Assistant creeds are statements of beliefs or principles that guide the behavior and actions of assistants in their work.', 'Assassin\'s Creed', '2023-09-05 15:41:10', 1, 1, 1, 'https://www.gamesradar.com/best-assassins-creed-games/'),
	(5, 8008, 'Far Cry Primal is a first-person action-adventure video game developed by Ubisoft Montreal and published by Ubisoft. It was released in 2016 and is set in the Stone Age, where players control a hunter named Takkar as he tries to survive in a hostile environment filled with dangerous animals and rival tribes.', 'Far cry Primal', '2023-09-05 15:43:11', 1, 1, 2, 'https://oceansofgamess.com/far-cry-primal-free-download/'),
	(6, 9755, 'Grand Theft Auto V is an action-adventure game played from either a third-person or first-person perspective. Players complete missions—linear scenarios with set objectives—to progress through the story. Outside of the missions, players may freely roam the open world.', 'Grand Theft Auto V', '2023-09-05 16:03:22', 3, 1, 3, 'https://store.epicgames.com/en-US/p/grand-theft-auto-v'),
	(7, 3000, 'Blood & Truth is a virtual reality action-adventure video game developed by Sony Interactive Entertainment\'s London Studio and released in May 2019.', 'Blood & Truth', '2023-09-05 16:04:42', 3, 1, 2, 'https://www.ign.com/articles/2019/05/29/blood-and-truth-psvr-review'),
	(8, 2500, 'Jumanji The Board Game takes you and your fellow adventurers on a quest through the jungle, solving riddles and completing challenges while trying not to lose your Life Tokens. Each player races to be the first to reach the center of the jungle and yell “JUMANJI!” to win.', 'Jumanji', '2023-09-05 16:05:44', 3, 1, 4, 'https://outrightgames.com/games/jumanji-the-video-game/'),
	(9, 4100, 'Astro Bot Rescue Mission is a 3D platform game in which the player takes control of Astro Bot, a small robot using the DualShock 4. Astro is able to jump, hover, punch and charge his punch into a spinning attack.', 'Astro Bot', '2023-09-05 16:06:26', 3, 1, 1, 'https://www.playstation.com/en-us/games/astro-bot-rescue-mission/'),
	(10, 2500, 'Temple Run is a video game franchise of 3D endless running video games developed and published by Imangi Studios. The primary theme of the series is an explorer chased from a group of demon monkeys, however, the characters and theme vary between spin-offs.', 'Temple Run', '2023-09-05 16:07:23', 2, 1, 1, 'https://temple-run.en.uptodown.com/android/download'),
	(11, 4500, 'Arena Breakout is a next-gen immersive tactical first-person shooter, and a first-of-its-kind extraction looter shooter that pushes the limits of war simulation on mobile.', 'Arena Breakout', '2023-09-05 16:08:21', 2, 1, 2, 'https://arena-breakout.en.uptodown.com/android/download'),
	(12, 1500, 'Mekorama is a puzzle game developed by indie developer Martin Magni. Players control the movement of a robot through paths and various obstacles to reach the end of a level by tapping or clicking the screen. The game features a level editing tool, where players can create custom levels and share them online.', 'Mekorama', '2023-09-05 16:08:45', 2, 1, 4, 'https://mekorama.en.uptodown.com/android'),
	(13, 3000, 'Clash of Clans is a popular mobile strategy game developed and published by Supercell. It involves building and upgrading a village, training troops, and attacking other players\' villages to earn resources.', 'Clash of Clan', '2023-09-05 16:09:40', 2, 1, 3, 'https://clash-of-clans.en.uptodown.com/android'),
	(14, 4500, 'Master match 3 puzzles with quick thinking and smart matching moves to be rewarded with sugar bonuses and tasty candy combos. Plan your moves by matching 3 or more candies in a row and blast your way through the extra sticky puzzles using lollipop hammers!', 'Candy Crush', '2023-09-05 16:10:46', 2, 1, 4, 'https://candy-crush-saga.en.uptodown.com/android'),
	(15, 2800, 'Nox App Player is a powerful Android emulator for Windows. Now your Windows PC can run any of the hundreds of apps originally created just for Android -- the most widely used smartphone operating system in the world.', 'Nox Player', '2023-09-05 16:12:20', 4, 1, 6, 'https://www.bignox.com/'),
	(16, 1000, 'The game loop is the primary mechanism that moves the game forward in time. Before we learn how to create this important component, let\'s briefly take a look at the structure of most games.', 'Game Loop', '2023-09-05 16:13:07', 4, 1, 6, 'https://www.gameloop.com/'),
	(17, 25000, 'As of my last knowledge update in September 2021, there was no official information about the release of Grand Theft Auto 6 (GTA 6) from Rockstar Games. Rockstar is known for being secretive about their game development, and they haven\'t made any official announcements regarding GTA 6 at that time.', 'GTA VI', '2023-10-21 15:55:01', 1, 2, 3, 'https://www.rockstargames.com/VI'),
	(18, 2000, 'Steam is the ultimate destination for playing, discussing, and creating games, with thousands of games from AAA to indie and everything in-between. Join for free and enjoy exclusive deals, automatic game updates, and other great perks.', 'Steam', '2024-05-28 08:51:36', 4, 1, 6, 'https://store.steampowered.com/'),
	(19, 8000, 'Discord is an instant messaging and VoIP social platform which allows communication through voice calls, video calls, text messaging, and media and files. Communication can be private or take place in virtual communities called "servers".[note 2] A server is a collection of persistent chat rooms and voice channels which can be accessed via invite links. Discord runs on Windows, macOS, Android, iOS, iPadOS, Linux, and in web browsers.', 'Discord', '2024-05-28 08:41:06', 4, 1, 6, 'https://discord.com/'),
	(20, 1200, 'Sonic the Hedgehog[b] is a 2020 action-adventure comedy film based on the video game series of the same name published by Sega. The film was directed by Jeff Fowler and written by Pat Casey and Josh Miller. It stars Ben Schwartz (as the voice of Sonic the Hedgehog), James Marsden, and Jim Carrey. The plot follows Sonic, a blue anthropomorphic hedgehog who can run at supersonic speeds, who teams up with a town sheriff to stop mad scientist Dr. Robotnik.', 'Sonic The Hedgehog', '2024-05-28 08:48:05', 5, 1, 1, 'https://www.sonicthehedgehog.com/'),
	(21, 2000, 'Super Mario Bros.[b] is a platform game developed and published in 1985 by Nintendo for the Famicom in Japan and for the Nintendo Entertainment System (NES) in North America. It is the successor to the 1983 arcade game Mario Bros. and the first game in the Super Mario series. Following a US test market release for the NES, it was converted to international arcades on the Nintendo VS. System in early 1986. The NES version received a wide release in North America that year and in PAL regions in 1987.', 'Super Mario', '2024-05-28 08:49:23', 5, 1, 1, 'https://supermario-game.com/'),
	(22, 1000, 'Tetris (Russian: Тетрис[a]) is a puzzle video game created in 1985 by Alexey Pajitnov, a Soviet software engineer.[1] It has been published by several companies for multiple platforms, most prominently during a dispute over the appropriation of the rights in the late 1980s. After a significant period of publication by Nintendo, in 1996 the rights reverted to Pajitnov, who co-founded the Tetris Company with Henk Rogers to manage licensing.', 'Tetris', '2024-05-28 08:51:13', 5, 1, 4, 'https://tetris.com/play-tetris'),
	(23, 1000, 'Overwatch (retroactively referred to as Overwatch 1[b]) was a 2016 team-based multiplayer first-person shooter game by Blizzard Entertainment. The game was first released for PlayStation 4, Windows, and Xbox One in May 2016 and Nintendo Switch in October 2019. Cross-platform play was supported across all platforms.', 'Overwatch 2', '2024-05-28 08:51:55', 5, 1, 2, 'https://overwatch.blizzard.com/en-gb/');

-- Dumping structure for table gamerlk.product_img
CREATE TABLE IF NOT EXISTS `product_img` (
  `img_path` varchar(100) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`img_path`),
  KEY `fk_product_img_product1_idx` (`product_id`),
  CONSTRAINT `fk_product_img_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table gamerlk.product_img: ~23 rows (approximately)
INSERT INTO `product_img` (`img_path`, `product_id`) VALUES
	('resourses\\game\\ww (1).jpg', 1),
	('resourses\\game\\w (1).jpg', 2),
	('resourses\\game\\w (1).webp', 3),
	('resourses\\game\\w (2).jpeg', 4),
	('resourses\\game\\w (3).jpeg', 5),
	('resourses\\game\\p1.jpg', 6),
	('resourses\\game\\p2.jpg', 7),
	('resourses\\game\\p3.webp', 8),
	('resourses\\game\\p4.webp', 9),
	('resourses\\game\\a (1).jpg', 10),
	('resourses\\game\\a (1).webp', 11),
	('resourses\\game\\a (2).jpg', 12),
	('resourses\\game\\a (2).png', 13),
	('resourses\\game\\a (3).png', 14),
	('resourses\\game\\o (1).webp', 15),
	('resourses\\game\\o (2).jpg', 16),
	('resourses\\game\\gta.jpg', 17),
	('resourses\\game\\streme.jpg', 18),
	('resourses\\game\\discod.png', 19),
	('resourses\\game\\tv (1).jpg', 20),
	('resourses\\game\\tv (3).jpg', 21),
	('resourses\\game\\tv (1).png', 22),
	('resourses\\game\\tv (2).jpg', 23);

-- Dumping structure for table gamerlk.profile_img
CREATE TABLE IF NOT EXISTS `profile_img` (
  `path` varchar(100) NOT NULL,
  `users_email` varchar(100) NOT NULL,
  PRIMARY KEY (`path`),
  KEY `fk_profile_img_User1_idx` (`users_email`),
  CONSTRAINT `fk_profile_img_User1` FOREIGN KEY (`users_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table gamerlk.profile_img: ~4 rows (approximately)
INSERT INTO `profile_img` (`path`, `users_email`) VALUES
	('resourses//profile_images//Nawarathna_0712654112_66633b0ad4efc.png', 'hesa@gmail.com'),
	('resourses//profile_images//manuhas_0753374157_6655616338621.jpeg', 'lawantha@gmail.com'),
	('resourses//profile_images//Madumal_0712654117_6660a27172573.png', 'mandujayaweera2003@gmail.com'),
	('resourses//profile_images//Pushpamali_0716499118_6533e4ec50873.jpeg', 'yasho@gmail.com');

-- Dumping structure for table gamerlk.status
CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int NOT NULL,
  `status_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table gamerlk.status: ~2 rows (approximately)
INSERT INTO `status` (`status_id`, `status_name`) VALUES
	(1, 'Available'),
	(2, 'Non-Available');

-- Dumping structure for table gamerlk.users
CREATE TABLE IF NOT EXISTS `users` (
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(20) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `joined_date` datetime DEFAULT NULL,
  `verification_code` varchar(20) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `gender_id` int NOT NULL,
  `contry_contry_id` int DEFAULT NULL,
  PRIMARY KEY (`email`),
  KEY `fk_User_gender_idx` (`gender_id`),
  KEY `fk_users_contry1_idx` (`contry_contry_id`),
  CONSTRAINT `fk_User_gender` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`),
  CONSTRAINT `fk_users_contry1` FOREIGN KEY (`contry_contry_id`) REFERENCES `contry` (`contry_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table gamerlk.users: ~6 rows (approximately)
INSERT INTO `users` (`fname`, `lname`, `email`, `password`, `mobile`, `joined_date`, `verification_code`, `status`, `gender_id`, `contry_contry_id`) VALUES
	('vindula', 'sasmitha', 'abc@gmail.com', '00000', '0711536662', '2023-10-21 20:16:54', NULL, 1, 1, NULL),
	('Heshan', 'Nawarathna', 'hesa@gmail.com', '00000', '0712654112', '2024-06-06 20:48:32', NULL, 1, 1, NULL),
	('madu', 'jaya', 'jaya@gmail.com', '00000', '0712654115', '2024-05-30 19:06:18', NULL, 1, 1, NULL),
	('Lawantha', 'manuhas', 'lawantha@gmail.com', '00000', '0753374157', '2024-05-28 10:13:58', NULL, 1, 1, NULL),
	('Lakshitha', 'Madumal', 'mandujayaweera2003@gmail.com', '00000', '0712654117', '2023-09-05 12:48:48', '66645f5a4108d', 1, 1, 1),
	('Yasho', 'Pushpamali', 'yasho@gmail.com', '00000', '0716499118', '2023-10-21 20:15:59', NULL, 1, 2, 2);

-- Dumping structure for table gamerlk.watchlist
CREATE TABLE IF NOT EXISTS `watchlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `users_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_watchlist_product1_idx` (`product_id`),
  KEY `fk_watchlist_users1_idx` (`users_email`),
  CONSTRAINT `fk_watchlist_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_watchlist_users1` FOREIGN KEY (`users_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table gamerlk.watchlist: ~14 rows (approximately)
INSERT INTO `watchlist` (`id`, `product_id`, `users_email`) VALUES
	(45, 1, 'lawantha@gmail.com'),
	(46, 3, 'lawantha@gmail.com'),
	(78, 11, 'mandujayaweera2003@gmail.com'),
	(79, 13, 'mandujayaweera2003@gmail.com'),
	(82, 8, 'mandujayaweera2003@gmail.com'),
	(83, 5, 'mandujayaweera2003@gmail.com'),
	(84, 3, 'mandujayaweera2003@gmail.com'),
	(85, 12, 'mandujayaweera2003@gmail.com'),
	(86, 7, 'mandujayaweera2003@gmail.com'),
	(87, 9, 'mandujayaweera2003@gmail.com'),
	(91, 19, 'mandujayaweera2003@gmail.com'),
	(92, 4, 'mandujayaweera2003@gmail.com'),
	(95, 4, 'hesa@gmail.com');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
