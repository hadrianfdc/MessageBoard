-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 10, 2024 at 10:33 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `message_board`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `profile_post_id` int(11) NOT NULL,
  `comment` varchar(1000) DEFAULT NULL,
  `images` varchar(500) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `profile_post_id`, `comment`, `images`, `created`, `updated`) VALUES
(1, 2, 28, 'This is Just a try try try comment', NULL, '2024-11-29 07:31:44', NULL),
(4, 2, 28, 'dsadasdasdasdasd', 'images/cutecats.jpg', '2024-11-29 10:11:10', '2024-11-29 10:11:10'),
(5, 2, 28, 'Omkieee', NULL, '2024-12-09 03:34:43', '2024-12-09 03:34:43'),
(6, 2, 28, 'HAHHAHHAAHAHHa', NULL, '2024-12-09 03:36:48', '2024-12-09 03:36:48'),
(7, 2, 28, 'HAHAHAHAHAHHA', NULL, '2024-12-09 03:37:11', '2024-12-09 03:37:11'),
(8, 2, 28, 'hehhehheee', NULL, '2024-12-09 03:43:50', '2024-12-09 03:43:50'),
(9, 2, 28, 'Wow this is amazing!', NULL, '2024-12-10 02:32:31', '2024-12-10 02:32:31'),
(10, 2, 28, 'Test test test!', NULL, '2024-12-10 02:33:28', '2024-12-10 02:33:28'),
(11, 2, 28, 'Woahhh niceeeee', NULL, '2024-12-10 02:36:46', '2024-12-10 02:36:46'),
(12, 2, 28, 'testnapud_ni', NULL, '2024-12-10 06:30:09', '2024-12-10 06:30:09'),
(13, 2, 28, 'Okay!', NULL, '2024-12-10 06:32:58', '2024-12-10 06:32:58'),
(14, 2, 28, 'Okay 2', NULL, '2024-12-10 06:33:47', '2024-12-10 06:33:47'),
(15, 2, 28, 'Okay 2', NULL, '2024-12-10 06:33:52', '2024-12-10 06:33:52'),
(16, 2, 28, 'Okay 2', NULL, '2024-12-10 06:33:53', '2024-12-10 06:33:53'),
(17, 2, 28, 'Errort naspud!', NULL, '2024-12-10 06:36:40', '2024-12-10 06:36:40'),
(18, 2, 28, 'Hayssssss', NULL, '2024-12-10 06:37:30', '2024-12-10 06:37:30');

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `conversation_id` int(11) NOT NULL,
  `user1_id` int(11) DEFAULT NULL,
  `user2_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `friends_list`
--

CREATE TABLE `friends_list` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'user who initiated the request',
  `acceptor` int(11) NOT NULL COMMENT 'The ID of the friend',
  `status` varchar(20) NOT NULL COMMENT '''pending'', ''accepted'', ''blocked''',
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friends_list`
--

INSERT INTO `friends_list` (`id`, `user_id`, `acceptor`, `status`, `created`) VALUES
(19, 30, 2, 'accepted', '2024-12-03 09:05:48'),
(21, 20, 27, 'pending', '2024-12-06 05:04:42'),
(22, 20, 2, 'accepted', '2024-12-06 08:14:47');

-- --------------------------------------------------------

--
-- Table structure for table `friends_list_notification`
--

CREATE TABLE `friends_list_notification` (
  `id` int(11) NOT NULL,
  `for_who_acceptor` int(11) NOT NULL COMMENT 'user id',
  `from_who_user_id` int(11) NOT NULL COMMENT 'sender of request',
  `type` int(1) NOT NULL COMMENT '1: sent_request  2: accept_request',
  `is_seen` int(1) NOT NULL DEFAULT 0 COMMENT '0:not seen, 1: seen',
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friends_list_notification`
--

INSERT INTO `friends_list_notification` (`id`, `for_who_acceptor`, `from_who_user_id`, `type`, `is_seen`, `created`) VALUES
(1, 2, 30, 1, 1, '2024-12-03 09:05:48'),
(2, 2, 20, 1, 1, '2024-12-03 10:10:36'),
(5, 20, 2, 2, 1, '2024-12-06 02:18:56'),
(6, 30, 2, 2, 0, '2024-12-06 02:19:05'),
(7, 27, 20, 1, 0, '2024-12-06 05:04:42'),
(8, 2, 20, 1, 1, '2024-12-06 08:14:47'),
(9, 20, 2, 2, 0, '2024-12-06 08:15:17');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `conversation_id` int(11) DEFAULT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `message_content` text DEFAULT NULL,
  `is_seen` int(1) NOT NULL,
  `created` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `conversation_id`, `sender_id`, `receiver_id`, `message_content`, `is_seen`, `created`) VALUES
(1113, NULL, 2, 20, 'Hello Clint kamusta? Ako Okay ra hehehe', 1, '2024-11-22 07:53:07'),
(1134, NULL, 23, 2, 'Bai kmusta?', 0, '2024-03-18 07:48:15'),
(1140, NULL, 2, 23, 'cxvcxvcxv', 0, '2024-03-18 08:24:04'),
(1146, NULL, 2, 23, '5\r\n', 0, '2024-03-18 08:35:59'),
(1155, NULL, 23, 2, 'OHHHH?', 0, '2024-03-18 08:43:38'),
(1156, NULL, 23, 2, 'Unsa man?', 0, '2024-03-18 08:50:06'),
(1159, NULL, 20, 2, 'bccvbv', 1, '2024-11-22 07:37:31'),
(1160, NULL, 2, 20, 'Yeah?', 1, '2024-11-22 07:53:07'),
(1170, NULL, 2, 23, 'wa ra hehe', 0, '2024-03-19 08:28:39'),
(1171, NULL, 20, 2, 'Naa ko sa balay', 1, '2024-11-22 07:37:31'),
(1172, NULL, 20, 2, 'Ikaw asa naman ka?', 1, '2024-11-22 07:37:31'),
(1173, NULL, 20, 21, 'Kamusta Janrae?\r\n', 0, '2024-03-19 08:48:21'),
(1174, NULL, 21, 20, 'Bai Clint okay ra, ikaw kamusta?', 0, '2024-03-19 08:50:57'),
(1175, NULL, 20, 21, 'Gwapo man lagi tag profile pic ron? heehhee', 0, '2024-03-19 08:51:39'),
(1176, NULL, 24, 2, 'Hello ang? How are me?', 0, '2024-03-19 09:38:51'),
(1177, NULL, 2, 24, 'Ohh kamusta man ko?', 0, '2024-03-19 09:39:22'),
(1182, NULL, 24, 2, 'My dearest [Recipient\'s Name],\n\nAs I sit here pondering the depths of my affection for you, words seem insufficient to capture the vastness of my emotions. From the moment our paths intertwined, you\'ve become the brightest star in the constellation of my life. Your presence is a melody that soothes my soul, a gentle breeze that carries away my worries, and a beacon of light guiding me through life\'s uncertainties. Every laugh we share, every tear we wipe away together, strengthens the bond between us, weaving a tapestry of love and understanding.\n\nIn your eyes, I find solace; in your embrace, I find home. Your kindness knows no bounds, and your compassion touches the deepest recesses of my heart. With you, I\'ve discovered the true essence of love – a love that is patient, nurturing, and unconditional. As we journey through life hand in hand, know that my love for you will only grow stronger with each passing day. You are not just my partner, but my confidant, my best friend, and the embodiment of all that is good in this world. I am endlessly grateful for your presence in my life and cherish every moment we share together.\n\nForever yours,\n[Your Name]', 0, '2024-03-20 07:07:14'),
(1183, NULL, 25, 2, 'Hey How are you today?', 0, '2024-03-20 03:10:16'),
(1184, NULL, 26, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ut blandit ligula, ac porta dui. Cras in blandit libero. Ut consequat fermentum quam vel fringilla. Nunc aliquet est eget lobortis interdum. Aenean et enim ac arcu efficitur aliquet. Aenean commodo suscipit ante, quis aliquet enim vehicula a. Proin enim quam, suscipit in hendrerit vitae, fermentum in purus. Suspendisse hendrerit eleifend metus, quis hendrerit risus fringilla in. Integer varius tempus nisl id dapibus. Sed consectetur nulla id sagittis fermentum. Fusce bibendum laoreet sapien. Nam sed tellus vel nibh fringilla dignissim et sit amet dolor. Sed posuere mollis odio, eget pellentesque erat sodales aliquet.\n\n', 1, '2024-11-22 07:46:04'),
(1185, NULL, 27, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ut blandit ligula, ac porta dui. Cras in blandit libero. Ut consequat fermentum quam vel fringilla. Nunc aliquet est eget lobortis interdum. Aenean et enim ac arcu efficitur aliquet. Aenean commodo suscipit ante, quis aliquet enim vehicula a. Proin enim quam, suscipit in hendrerit vitae, fermentum in purus. Suspendisse hendrerit eleifend metus, quis hendrerit risus fringilla in. Integer varius tempus nisl id dapibus. Sed consectetur nulla id sagittis fermentum. Fusce bibendum laoreet sapien. Nam sed tellus vel nibh fringilla dignissim et sit amet dolor. Sed posuere mollis odio, eget pellentesque erat sodales aliquet.\r\n\r\nCurabitur ut ipsum lobortis, faucibus leo eget, consequat diam. Cras mollis tempus mollis. Ut rhoncus eros nec orci ornare volutpat. Sed placerat, lectus vitae sollicitudin convallis, ex purus fermentum massa, at eleifend justo ex in nibh. Curabitur rutrum mi non magna luctus ullamcorper. Pellentesque quis tortor eget ligula varius laoreet et eget felis. Duis a elementum dui. Nullam ut tristique risus. Duis vel odio lacus. Nullam eleifend iaculis velit, gravida efficitur elit efficitur eget. Maecenas tristique ex augue, ut varius nulla efficitur quis.\r\n\r\nClass aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut accumsan, magna eu feugiat dapibus, ipsum ligula molestie augue, sit amet fringilla nisi urna ac turpis. Aliquam nec facilisis neque. Aenean at ipsum ut augue semper maximus porttitor ac enim. Nullam venenatis eget magna iaculis elementum. Maecenas id porta tortor. Suspendisse non nisi ut lorem aliquet laoreet at sed mi. Aliquam luctus erat in est imperdiet dictum. Nulla consectetur auctor sapien, eget pretium libero scelerisque eget. Morbi sit amet malesuada nulla, a semper libero. Quisque ac euismod tortor.\r\n\r\nNam viverra fringilla quam eu pulvinar. Vestibulum nisi magna, placerat id nisi vel, sodales volutpat mauris. Donec pulvinar iaculis est, vel malesuada dui porta consectetur. Morbi pulvinar eget dolor fringilla sodales. Suspendisse vel magna nec justo lobortis ornare. Nulla id placerat nulla. Integer placerat rhoncus velit hendrerit elementum. Pellentesque feugiat fringilla felis quis iaculis. Aenean viverra a turpis et finibus. Maecenas mattis metus quis ipsum dignissim, non scelerisque ligula vehicula. Vestibulum ut efficitur dui.\r\n\r\nFusce mollis mauris est, a vehicula augue convallis vel. Phasellus rutrum eget sapien consectetur hendrerit. Fusce consequat massa sit amet est ultrices, eu suscipit mi placerat. Nam lobortis metus sed massa ullamcorper, elementum gravida sem mattis. Integer efficitur erat est, vitae elementum mi lacinia et. Etiam euismod ex non enim pellentesque, in efficitur est tristique. Donec ac nisl felis. Duis a sem dui.\r\n\r\n', 0, '2024-03-20 03:14:54'),
(1186, NULL, 28, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ut blandit ligula, ac porta dui. Cras in blandit libero. Ut consequat fermentum quam vel fringilla. Nunc aliquet est eget lobortis interdum. Aenean et enim ac arcu efficitur aliquet. Aenean commodo suscipit ante, quis aliquet enim vehicula a. Proin enim quam, suscipit in hendrerit vitae, fermentum in purus. Suspendisse hendrerit eleifend metus, quis hendrerit risus fringilla in. Integer varius tempus nisl id dapibus. Sed consectetur nulla id sagittis fermentum. Fusce bibendum laoreet sapien. Nam sed tellus vel nibh fringilla dignissim et sit amet dolor. Sed posuere mollis odio, eget pellentesque erat sodales aliquet.\r\n\r\nCurabitur ut ipsum lobortis, faucibus leo eget, consequat diam. Cras mollis tempus mollis. Ut rhoncus eros nec orci ornare volutpat. Sed placerat, lectus vitae sollicitudin convallis, ex purus fermentum massa, at eleifend justo ex in nibh. Curabitur rutrum mi non magna luctus ullamcorper. Pellentesque quis tortor eget ligula varius laoreet et eget felis. Duis a elementum dui. Nullam ut tristique risus. Duis vel odio lacus. Nullam eleifend iaculis velit, gravida efficitur elit efficitur eget. Maecenas tristique ex augue, ut varius nulla efficitur quis.\r\n\r\nClass aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut accumsan, magna eu feugiat dapibus, ipsum ligula molestie augue, sit amet fringilla nisi urna ac turpis. Aliquam nec facilisis neque. Aenean at ipsum ut augue semper maximus porttitor ac enim. Nullam venenatis eget magna iaculis elementum. Maecenas id porta tortor. Suspendisse non nisi ut lorem aliquet laoreet at sed mi. Aliquam luctus erat in est imperdiet dictum. Nulla consectetur auctor sapien, eget pretium libero scelerisque eget. Morbi sit amet malesuada nulla, a semper libero. Quisque ac euismod tortor.\r\n\r\nNam viverra fringilla quam eu pulvinar. Vestibulum nisi magna, placerat id nisi vel, sodales volutpat mauris. Donec pulvinar iaculis est, vel malesuada dui porta consectetur. Morbi pulvinar eget dolor fringilla sodales. Suspendisse vel magna nec justo lobortis ornare. Nulla id placerat nulla. Integer placerat rhoncus velit hendrerit elementum. Pellentesque feugiat fringilla felis quis iaculis. Aenean viverra a turpis et finibus. Maecenas mattis metus quis ipsum dignissim, non scelerisque ligula vehicula. Vestibulum ut efficitur dui.\r\n\r\nFusce mollis mauris est, a vehicula augue convallis vel. Phasellus rutrum eget sapien consectetur hendrerit. Fusce consequat massa sit amet est ultrices, eu suscipit mi placerat. Nam lobortis metus sed massa ullamcorper, elementum gravida sem mattis. Integer efficitur erat est, vitae elementum mi lacinia et. Etiam euismod ex non enim pellentesque, in efficitur est tristique. Donec ac nisl felis. Duis a sem dui.\r\n\r\n', 0, '2024-03-20 03:16:47'),
(1188, NULL, 23, 2, 'In tempus, dolor in blandit malesuada, orci quam auctor libero, blandit tincidunt orci eros sed nisl. Pellentesque leo urna, hendrerit quis massa at, viverra lacinia neque. Nam scelerisque odio a vestibulum venenatis. Quisque sed urna felis. Phasellus aliquet a sem at vehicula. Nunc justo nulla, egestas id cursus ut, aliquet id diam. Aenean dignissim, tortor vel blandit porta, arcu arcu bibendum odio, ut tempor eros tortor eget velit. Nulla facilisi. Maecenas ut rhoncus dolor.', 0, '2024-03-20 06:10:19'),
(1189, NULL, 23, 2, 'Curabitur vel congue magna, eu iaculis sapien. Cras placerat elit nec molestie faucibus. Duis purus ipsum, aliquet ac lacus vel, consequat consectetur elit. In molestie ornare velit, non dignissim justo. Aenean sagittis massa massa, eu tincidunt sem facilisis ut. Quisque in elit aliquam, euismod velit ac, feugiat arcu. Nunc vel lacinia lectus. In hac habitasse platea dictumst. Nam id tincidunt dui. Phasellus sed diam purus. Morbi sed urna pharetra, varius eros eget, scelerisque eros. Nam semper dapibus molestie. Donec diam nunc, fermentum id tellus imperdiet, bibendum ornare massa. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Quisque risus diam, porttitor vitae dui quis, pharetra sagittis odio.', 0, '2024-03-20 06:10:47'),
(1190, NULL, 23, 2, 'Suspendisse tortor felis, dictum lacinia erat eget, hendrerit consequat velit. Pellentesque sagittis odio non lorem sodales, vel pretium arcu lacinia. Nullam id volutpat justo. Vestibulum tempor accumsan turpis, quis aliquet urna pretium at. Proin viverra porta justo eu hendrerit. Morbi eget neque finibus, imperdiet libero auctor, accumsan quam. Duis massa nibh, porttitor quis libero et, cursus interdum lorem. Quisque accumsan lacus nec fringilla tempor. Ut eget sapien eu purus finibus dictum ut imperdiet risus. Nam sit amet hendrerit dolor. Vestibulum sed finibus sapien. Nunc urna diam, mollis ac lacinia sed, faucibus sed lacus. Proin at lacus sem.', 0, '2024-03-20 06:10:55'),
(1193, NULL, 2, 24, 'ok', 0, '2024-03-20 07:12:44'),
(1195, NULL, 2, 2, 'Test', 0, '2024-03-20 08:14:15'),
(1197, NULL, 2, 26, 'What I don\'t understand', 0, '2024-03-20 09:10:27'),
(1198, NULL, 2, 23, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 0, '2024-03-20 09:19:25'),
(1200, NULL, 2, 23, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 0, '2024-03-21 03:39:49'),
(1201, NULL, 2, 21, 'Hello?', 0, '2024-03-21 06:57:37'),
(1202, NULL, 2, 20, 'Nagduty pako bai ari hehehe ', 1, '2024-11-22 07:53:07'),
(1203, NULL, 29, 2, 'Test Message', 0, '2024-03-22 01:05:44'),
(1205, NULL, 2, 21, 'Hello where are you now ?\r\n', 0, '2024-11-22 05:49:57');

-- --------------------------------------------------------

--
-- Table structure for table `my_day_story`
--

CREATE TABLE `my_day_story` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `path` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `my_day_story`
--

INSERT INTO `my_day_story` (`id`, `user_id`, `path`, `date_created`) VALUES
(1, 20, 'images/download1.jpeg', '2024-12-06 05:27:47'),
(2, 2, 'images/download1.jpeg', '2024-12-06 05:27:47'),
(3, 29, 'images/download (1).jpeg', '2024-12-06 05:27:47'),
(4, 30, 'images/avatar.jpeg', '2024-12-06 05:27:47');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `author` int(11) NOT NULL COMMENT 'for whom this',
  `profile_post_id` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1: react 2: comment 3: add_friend 4: accept_friend 5:change_pass\r\n',
  `description` varchar(500) NOT NULL,
  `is_seen` int(1) NOT NULL DEFAULT 0 COMMENT '0: not seen, 1: seen',
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `user_id`, `author`, `profile_post_id`, `type`, `description`, `is_seen`, `created`) VALUES
(51, 30, 30, 24, 1, 'Reacted Heart to your Post', 0, '2024-12-03 09:27:15'),
(52, 2, 20, 44, 1, 'Reacted Heart to your Post', 1, '2024-12-06 03:12:00'),
(53, 20, 20, 17, 1, 'Reacted Heart to your Post', 0, '2024-12-06 07:31:58'),
(54, 20, 2, 40, 1, 'Reacted Heart to your Post', 1, '2024-12-06 07:35:38'),
(55, 2, 2, 28, 1, 'Reacted Heart to your Post', 1, '2024-12-06 08:08:43'),
(56, 20, 2, 28, 1, 'Reacted Wow to your Post', 0, '2024-12-06 08:26:21'),
(57, 2, 30, 24, 1, 'Reacted Care to your Post', 0, '2024-12-09 03:53:14'),
(58, 2, 20, 17, 1, 'Reacted Angry to your Post', 0, '2024-12-09 03:55:38'),
(59, 2, 30, 22, 1, 'Reacted Wow to your Post', 0, '2024-12-09 03:57:56'),
(60, 2, 2, 28, 1, 'Reacted Haha to your Post', 1, '2024-12-10 05:06:40'),
(61, 2, 2, 28, 2, 'commented on your post', 0, '2024-12-10 06:30:09'),
(62, 2, 2, 28, 2, 'commented on your post', 0, '2024-12-10 06:32:58'),
(63, 2, 2, 28, 2, 'commented on your post', 0, '2024-12-10 06:33:47'),
(64, 2, 2, 28, 2, 'commented on your post', 0, '2024-12-10 06:33:52'),
(65, 2, 2, 28, 2, 'commented on your post', 0, '2024-12-10 06:33:53'),
(66, 2, 2, 28, 2, 'commented on your post', 1, '2024-12-10 06:36:40'),
(67, 2, 2, 28, 2, 'commented on your post', 1, '2024-12-10 06:37:30'),
(68, 2, 2, 25, 1, 'Reacted Haha to your Post', 1, '2024-12-10 09:42:15'),
(69, 2, 2, 0, 5, 'You have successfully changed your password. If you did not initiate this, please contact support immediately.', 1, '2024-12-10 09:59:30'),
(70, 2, 2, 0, 5, 'You have successfully changed your password. If you did not initiate this, please contact support immediately.', 1, '2024-12-10 10:01:51'),
(71, 2, 2, 0, 6, 'You have successfully login. If you did not initiate this, please contact support immediately.', 0, '2024-12-10 10:10:26');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(200) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `path` varchar(200) NOT NULL,
  `background_img` varchar(250) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `name`, `path`, `background_img`, `created`, `modified`) VALUES
(2, 'test8.jpeg', 'images/test8.jpeg', 'images/cutecats.jpg', '2024-11-25 10:13:25', '2024-11-26 01:50:21'),
(4, 'download1.jpeg', 'images/download1.jpeg', '', '2024-03-15 09:01:18', '2024-03-15 09:01:18'),
(13, 'download.jpeg', 'images/download.jpeg', '', '2024-03-18 04:11:53', '2024-03-18 04:11:53'),
(20, 'download.jpeg', 'images/download.jpeg', '', '2024-03-18 06:56:04', '2024-03-18 06:56:04'),
(21, 'avatar.jpeg', 'images/avatar.jpeg', '', '2024-03-19 09:50:39', '2024-03-19 09:50:39'),
(23, 'download (1).jpeg', 'images/download (1).jpeg', '', '2024-03-18 08:49:09', '2024-03-18 08:49:09'),
(24, 'avatar.jpeg', 'images/avatar.jpeg', '', '2024-03-19 10:36:20', '2024-03-19 10:36:20'),
(25, 'download1.jpeg', 'images/download1.jpeg', '', '2024-03-20 04:09:58', '2024-03-20 04:09:58'),
(26, 'download (1).jpeg', 'images/download (1).jpeg', '', '2024-03-20 04:11:46', '2024-03-20 04:11:46'),
(27, 'avatar.jpeg', 'images/avatar.jpeg', '', '2024-03-20 07:40:51', '2024-03-20 07:40:51'),
(28, 'download1.jpeg', 'images/download1.jpeg', '', '2024-03-20 07:40:17', '2024-03-20 07:40:17'),
(30, 'avatartest.jpeg', 'images/avatartest.jpeg', 'images/avatartest.jpeg', '2024-11-26 03:03:45', '2024-11-26 03:03:45');

-- --------------------------------------------------------

--
-- Table structure for table `profile_posts`
--

CREATE TABLE `profile_posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `captions` varchar(1000) NOT NULL,
  `file_paths` varchar(250) NOT NULL,
  `privacy` int(1) NOT NULL COMMENT '1:Only me , 2:Public , 3: Friends',
  `react` varchar(300) DEFAULT NULL COMMENT '1:like, 2:haha, 3:heart, 4:sad, 5:angry',
  `is_pinned` int(1) NOT NULL DEFAULT 0 COMMENT '0: not, 1:yes',
  `is_saved` int(11) NOT NULL DEFAULT 0 COMMENT '0:no, 1: yes',
  `is_archieve` int(1) NOT NULL DEFAULT 0 COMMENT '0: not, 1: nes',
  `is_shared` int(1) NOT NULL DEFAULT 0 COMMENT '0: not, 1: shared',
  `shared_id` int(11) DEFAULT NULL,
  `sharer_caption` varchar(1000) DEFAULT NULL,
  `sharer_id` int(11) DEFAULT NULL,
  `sharer_full_name` varchar(200) DEFAULT NULL,
  `date_shared` datetime DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile_posts`
--

INSERT INTO `profile_posts` (`id`, `user_id`, `fullname`, `captions`, `file_paths`, `privacy`, `react`, `is_pinned`, `is_saved`, `is_archieve`, `is_shared`, `shared_id`, `sharer_caption`, `sharer_id`, `sharer_full_name`, `date_shared`, `created_date`, `updated_date`) VALUES
(15, 27, 'Jan Baoc', 'I am Nino Baoc and This is my test trial post!', '[\"images\\/test4.png\",\"images\\/test5.jpeg\",\"images\\/test5.jpg\",\"images\\/test3.jpg\",\"images\\/test2.png\"]', 2, '{\"Like\":0,\"Love\":0,\"Care\":0,\"Haha\":0,\"Wow\":0,\"Sad\":0,\"Angry\":0}', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '2024-11-25 08:12:22', NULL),
(16, 2, 'Hadrian Evarula', 'My Second Tryal Attempt!', '[\"images\\/test5.jpg\",\"images\\/test5.jpeg\",\"images\\/test4.png\"]', 2, '{\"Like\":0,\"Love\":0,\"Care\":0,\"Haha\":0,\"Wow\":0,\"Sad\":0,\"Angry\":0}', 1, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '2024-11-25 08:48:01', '2024-12-10 05:06:27'),
(17, 20, 'Clint Anthony Savilla', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '[\"images\\/test6.jpeg\",\"images\\/test7.jpeg\",\"images\\/test8.jpeg\"]', 2, '{\"Like\":0,\"Love\":\"1\",\"Care\":0,\"Haha\":0,\"Wow\":0,\"Sad\":0,\"Angry\":\"1\"}', 1, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '2024-11-25 09:40:46', '2024-12-06 04:41:21'),
(22, 30, 'FDC Tester', 'Velit vivamus facilisi sem ex bibendum est elementum tincidunt. Volutpat nulla tristique scelerisque imperdiet varius himenaeos vitae. Nostra ultrices consequat felis dignissim ultricies. Vestibulum integer dictum pretium nisi ut; efficitur orci. Parturient congue nec non sollicitudin ultricies netus. Pretium suspendisse semper pharetra sociosqu hac. Eleifend volutpat nec feugiat lectus turpis aliquet tempor porttitor? Elit hendrerit magna sem auctor erat a. Neque efficitur taciti vulputate quam quis ex nostra.', '[\"images\\/cutetest.webp\",\"images\\/cutecats.jpg\"]', 1, '{\"Like\":0,\"Love\":0,\"Care\":0,\"Haha\":0,\"Wow\":\"1\",\"Sad\":0,\"Angry\":0}', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '2024-11-26 03:17:59', NULL),
(23, 30, 'FDC Tester', 'Test phost', '[\"images\\/cutecats.jpg\",\"images\\/cutetest.webp\",\"images\\/test.png\"]', 3, '{\"Like\":0,\"Love\":0,\"Care\":0,\"Haha\":0,\"Wow\":0,\"Sad\":0,\"Angry\":0}', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '2024-11-26 03:25:53', NULL),
(24, 30, 'FDC Tester', 'Post Test!', '[\"images\\/Angpic.jpeg\",\"images\\/avatartest.jpeg\",\"images\\/test8.jpeg\"]', 3, '{\"Like\":0,\"Love\":\"1\",\"Care\":\"1\",\"Haha\":0,\"Wow\":0,\"Sad\":0,\"Angry\":0}', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '2024-11-26 03:26:35', NULL),
(25, 2, 'Hadrian Evarula', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', '[\"images\\/cutecats.jpg\",\"images\\/cutetest.webp\",\"images\\/avatartest.jpeg\",\"images\\/test7.jpeg\",\"images\\/cutetest.webp\"]', 2, '{\"Like\":0,\"Love\":0,\"Care\":0,\"Haha\":\"1\",\"Wow\":0,\"Sad\":0,\"Angry\":0}', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '2024-11-26 08:01:13', NULL),
(28, 2, 'Hadrian Evarula', 'My Third Tryal Attemp! I will achieve this one! On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, ', '[\"images\\/cutetest.webp\",\"images\\/cutecats.jpg\",\"images\\/avatartest.jpeg\"]', 2, '{\"Like\":0,\"Love\":0,\"Care\":0,\"Haha\":\"1\",\"Wow\":\"1\",\"Sad\":0,\"Angry\":0}', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '2024-11-27 02:54:51', '2024-12-10 05:08:42'),
(40, 20, 'Clint Anthony Savilla', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '[\"images\\/test6.jpeg\",\"images\\/test7.jpeg\",\"images\\/test8.jpeg\"]', 3, '{\"Like\":0,\"Love\":\"1\",\"Care\":0,\"Haha\":0,\"Wow\":0,\"Sad\":0,\"Angry\":0}', 0, 0, 0, 1, 17, 'With the online text generator you can process your personal Lorem Ipsum enriching it with html elements that define its structure, with the possibility to insert external links, but not only.\r\n\r\nNow to compose a text Lorem Ipsum is much more fun!\r\n\r\nIn fact, inserting any fantasy text or a famous text, be it a poem, a speech, a literary passage, a song\'s text, etc., our text generator will provide the random extraction of terms and steps to compose your own exclusive Lorem Ipsum.\r\n\r\nBe original, test your imagination... our Lorem Ipsum generator will amaze you. Try it now! Copy and Paste!', 2, 'Hadrian Evarula', '2024-11-29 02:07:50', '2024-11-25 09:40:46', '2024-12-03 02:38:05'),
(43, 20, 'Clint Anthony Savilla', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '[\"images\\/test6.jpeg\",\"images\\/test7.jpeg\",\"images\\/test8.jpeg\"]', 3, '{\"Like\":0,\"Love\":0,\"Care\":0,\"Haha\":0,\"Wow\":0,\"Sad\":0,\"Angry\":0}', 0, 0, 0, 1, 17, '1212Ab blanditiis ratione et dolores provident rem nulla aliquid est velit totam nam alias aliquam aut magni obcaecati. Id delectus omnis eum dolorem laboriosam ut iste delectus qui repellendus reiciendis eos tenetur molestiae eum quia alias. Aut illum unde vel voluptatibus sapiente quo galisum nobis sed porro praesentium ab enim iure. Non culpa autem ut omnis provident ut omnis voluptatem qui modi ipsa.', 30, 'FDC Tester', '2024-11-29 04:09:00', '2024-11-25 09:40:46', '2024-11-29 04:50:02'),
(44, 2, 'Hadrian Evarula', 'My Second Tryal Attempt!', '[\"images\\/test5.jpg\",\"images\\/test5.jpeg\",\"images\\/test4.png\"]', 2, '{\"Like\":0,\"Love\":\"1\",\"Care\":0,\"Haha\":0,\"Wow\":0,\"Sad\":0,\"Angry\":0}', 0, 0, 0, 1, 16, NULL, 20, 'Clint Anthony Savilla', '2024-12-06 02:33:46', '2024-11-25 08:48:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reactions`
--

CREATE TABLE `reactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `profile_post_id` int(11) NOT NULL,
  `reaction_type` int(11) NOT NULL COMMENT '1: like\r\n2: heart\r\n3: care\r\n4: haha\r\n5: wow\r\n6: sad\r\n7: angry',
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reactions`
--

INSERT INTO `reactions` (`id`, `user_id`, `profile_post_id`, `reaction_type`, `created`) VALUES
(55, 30, 24, 2, '2024-12-03 09:27:15'),
(56, 2, 44, 2, '2024-12-06 03:12:00'),
(57, 20, 17, 2, '2024-12-06 07:31:58'),
(58, 20, 40, 2, '2024-12-06 07:35:38'),
(60, 20, 28, 5, '2024-12-06 08:26:21'),
(61, 2, 24, 3, '2024-12-09 03:53:14'),
(62, 2, 17, 7, '2024-12-09 03:55:38'),
(63, 2, 22, 5, '2024-12-09 03:57:56'),
(64, 2, 28, 4, '2024-12-10 05:06:40'),
(66, 2, 25, 4, '2024-12-10 09:42:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `last_login_time` datetime DEFAULT NULL,
  `hobby` longtext DEFAULT NULL,
  `location` varchar(300) DEFAULT NULL,
  `education` varchar(300) DEFAULT NULL,
  `work` varchar(300) DEFAULT NULL,
  `links` varchar(500) DEFAULT NULL,
  `relationship` varchar(200) DEFAULT NULL,
  `account_type` int(1) NOT NULL DEFAULT 2 COMMENT '1: private, 2: public',
  `is_online` int(1) NOT NULL DEFAULT 0 COMMENT '0: offline, 1: online',
  `is_dark_setting` int(1) NOT NULL COMMENT '0: white 1: dark\r\n',
  `search_visibility` int(1) NOT NULL DEFAULT 1 COMMENT '1: Everyone , 2: Friends',
  `who_can_send_message` int(1) NOT NULL DEFAULT 1 COMMENT '1: Everyone, 2: Friends Only 0:No one',
  `location_sharing` int(1) NOT NULL DEFAULT 0 COMMENT '0: disable , 1: enable ',
  `profile_tagging` int(1) NOT NULL DEFAULT 1 COMMENT '1: Allow Friends, 2: Approval for Tags',
  `timeline_permision` int(1) NOT NULL DEFAULT 1 COMMENT 'Who can post on my timeline? 1:Everyone, 2:Friends, 3:Only Me',
  `who_can_see_myfriends` int(1) NOT NULL DEFAULT 3 COMMENT '1: Only me, 2:Friends, 3: Public',
  `show_birthday` int(1) NOT NULL DEFAULT 1 COMMENT '0:no 1:yes',
  `show_location_details` int(1) NOT NULL DEFAULT 1 COMMENT '0:No, 1:Yes',
  `show_inrelationship` int(1) NOT NULL DEFAULT 1 COMMENT '0: No, 1: Yes',
  `friend_req_notif` int(1) NOT NULL DEFAULT 1 COMMENT 'Friend Request 0: No, 1: Yes',
  `people_u_may_know_notif` int(1) NOT NULL DEFAULT 1 COMMENT 'Suggested People 0:No, 1:Yes',
  `birthday_notif` int(1) NOT NULL DEFAULT 1 COMMENT 'Birthday Notification 0:Disable 1:Enable',
  `events_notif` int(1) NOT NULL DEFAULT 1 COMMENT 'Event Notification 0:Disable 1:Enable',
  `highlights_notif` int(1) NOT NULL DEFAULT 1 COMMENT 'Suggested Highlighs 0:Disable 1:Enable',
  `comment_notif` int(1) NOT NULL DEFAULT 1 COMMENT 'Comment Notification 0:Disable 1:Enable',
  `reaction_notif` int(1) NOT NULL DEFAULT 1 COMMENT 'Reaction Notification 0:Disable 1:Enable',
  `login_notif` int(1) NOT NULL DEFAULT 1 COMMENT 'Login Notification 0:Disable 1:Enable',
  `change_password_notif` int(1) NOT NULL DEFAULT 1 COMMENT 'Change Password Notification 0:Disable 1:Enable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `gender`, `birthdate`, `email`, `password`, `date_created`, `last_login_time`, `hobby`, `location`, `education`, `work`, `links`, `relationship`, `account_type`, `is_online`, `is_dark_setting`, `search_visibility`, `who_can_send_message`, `location_sharing`, `profile_tagging`, `timeline_permision`, `who_can_see_myfriends`, `show_birthday`, `show_location_details`, `show_inrelationship`, `friend_req_notif`, `people_u_may_know_notif`, `birthday_notif`, `events_notif`, `highlights_notif`, `comment_notif`, `reaction_notif`, `login_notif`, `change_password_notif`) VALUES
(2, 'Hadrian Evarula', 'Male', '2005-03-22', 'hadrian.fdc@gmail.com', '$2a$10$9JeEBo5UQyImi5O8UOF0FOYd06YBJCH4iyG0PSOWe/Mu.Fbe6XyUS', '2024-03-12 09:38:48', '2024-12-10 10:11:02', '<Software> Web Developer </Engineer>', 'Cebu City', 'Studied Software Engineering at University of San Carlos - Talamban Campus', 'Web Developer at Forty Degrees Celsius Inc. 123', 'http://localhost/MessageBoard/UserProfiles/user_profile', 'Secret Ra Ni', 2, 1, 1, 1, 1, 0, 1, 1, 2, 1, 1, 1, 1, 1, 1, 0, 0, 0, 1, 0, 0),
(20, 'Clint Anthony Savilla', 'Male', '2024-03-18', 'clint.savilla@gmail.com', '$2a$10$6qyVUGIe4Npr9.nmKFwVs.adSzYbQksRe3rDtQUMlZz.fEvYaYuL6', '2024-03-18 06:52:53', '2024-12-06 08:15:44', 'Delve into the captivating world of terrarium crafting, where miniature landscapes come to life within glass containers. Cultivate your creativity as you design lush ecosystems using a variety of plants, rocks, and decorative elements. From serene woodland scenes to vibrant desert vistas, terrariums offer endless possibilities for expression. Experiment with different plant species, substrates, and arrangements to craft unique and visually stunning terrariums. Whether you\'re drawn to the tranqui', NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 1, 1, 0, 1, 1, 3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(21, 'Janrae Fagaragan', 'Male', '2024-03-18', 'janrae.fagaragan@gmail.com', '$2a$10$6qyVUGIe4Npr9.nmKFwVs.adSzYbQksRe3rDtQUMlZz.fEvYaYuL6', '2024-03-18 06:53:41', '2024-03-19 09:48:56', 'Embark on the captivating journey of web development, where lines of code transform into dynamic digital landscapes. Dive into the intricate dance of HTML, CSS, and JavaScript, weaving together the fabric of interactive websites and applications. Unleash your creativity as you design captivating user interfaces, meticulously crafting each element to engage and delight visitors. Embrace the thrill of problem-solving as you debug and optimize your code, transforming challenges into triumphs. Wheth', NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 1, 1, 0, 1, 1, 3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(22, 'Jefritz Alberca', 'Male', '2024-03-18', 'jefritz.alberca@gmail.com', '$2a$10$6qyVUGIe4Npr9.nmKFwVs.adSzYbQksRe3rDtQUMlZz.fEvYaYuL6', '2024-03-18 06:54:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 1, 1, 0, 1, 1, 3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(23, 'Dave Gwapo', 'Male', '2024-03-18', 'dave.gwapolagika@gmail.com', '$2a$10$6qyVUGIe4Npr9.nmKFwVs.adSzYbQksRe3rDtQUMlZz.fEvYaYuL6', '2024-03-18 08:47:23', '2024-03-20 07:09:25', 'Wala ra gud hehehe', NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 1, 1, 0, 1, 1, 3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(24, 'John Doe', 'Male', '2024-03-19', 'john.doe@gmail.com', '$2a$10$6qyVUGIe4Npr9.nmKFwVs.adSzYbQksRe3rDtQUMlZz.fEvYaYuL6', '2024-03-19 04:22:06', '2024-03-20 03:40:50', 'Delve into the captivating world of cosplay with ANG, inspired by the character Aang from Avatar: The Last Airbender. Embrace the artistry of crafting detailed costumes, mastering intricate hairstyles, and embodying the spirit of ANG through conventions and photo shoots. Dive into the realm of prop-making, channeling ANG\'s elemental bending skills by creating stunning replicas of his iconic staff or intricate airbending glider. Explore the vibrant community of fellow enthusiasts, participating i', NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 1, 1, 0, 1, 1, 3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(25, 'Joseph Savilla', 'Male', '2002-03-20', 'joseph.savilla@gmail.com', '$2a$10$6qyVUGIe4Npr9.nmKFwVs.adSzYbQksRe3rDtQUMlZz.fEvYaYuL6', '2024-03-20 04:02:15', '2024-11-29 06:33:51', 'Wala ra gud', NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 1, 1, 0, 1, 1, 3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(26, 'Andrea B', 'Female', '2004-03-20', 'andrea.b@gmail.com', '$2a$10$6qyVUGIe4Npr9.nmKFwVs.adSzYbQksRe3rDtQUMlZz.fEvYaYuL6', '2024-03-20 04:10:25', '2024-11-28 07:51:03', 'Wala ra pud\r\n', NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 1, 1, 0, 1, 1, 3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(27, 'Jan Baoc', 'Male', '2024-03-20', 'jan.baoc@gmail.com', '$2a$10$6qyVUGIe4Npr9.nmKFwVs.adSzYbQksRe3rDtQUMlZz.fEvYaYuL6', '2024-03-20 04:13:11', '2024-11-28 06:27:02', '', NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 1, 1, 0, 1, 1, 3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(28, 'June Michael Jordan', 'Male', '2024-03-20', 'june@gmail.com', '$2a$10$6qyVUGIe4Npr9.nmKFwVs.adSzYbQksRe3rDtQUMlZz.fEvYaYuL6', '2024-03-20 04:15:54', '2024-11-29 06:33:25', NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 1, 1, 0, 1, 1, 3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(29, 'Wa Ra Gud', 'Male', '2024-03-21', 'waragud@gmail.com', '$2a$10$6qyVUGIe4Npr9.nmKFwVs.adSzYbQksRe3rDtQUMlZz.fEvYaYuL6', '2024-03-21 03:52:15', '2024-11-28 06:25:55', NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 1, 1, 0, 1, 1, 3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(30, 'FDC Tester', 'Male', '2005-03-22', 'fdc-tester@gmail.com', '$2a$10$6qyVUGIe4Npr9.nmKFwVs.adSzYbQksRe3rDtQUMlZz.fEvYaYuL6', '2024-11-22 06:47:51', '2024-12-03 10:00:27', NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 1, 1, 0, 1, 1, 3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`conversation_id`),
  ADD KEY `user1_id` (`user1_id`),
  ADD KEY `user2_id` (`user2_id`);

--
-- Indexes for table `friends_list`
--
ALTER TABLE `friends_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friends_list_notification`
--
ALTER TABLE `friends_list_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `conversation_id` (`conversation_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `my_day_story`
--
ALTER TABLE `my_day_story`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_posts`
--
ALTER TABLE `profile_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reactions`
--
ALTER TABLE `reactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `conversation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `friends_list`
--
ALTER TABLE `friends_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `friends_list_notification`
--
ALTER TABLE `friends_list_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1206;

--
-- AUTO_INCREMENT for table `my_day_story`
--
ALTER TABLE `my_day_story`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `profile_posts`
--
ALTER TABLE `profile_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `reactions`
--
ALTER TABLE `reactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `conversations_ibfk_1` FOREIGN KEY (`user1_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `conversations_ibfk_2` FOREIGN KEY (`user2_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`conversation_id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `messages_ibfk_3` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `profile_posts`
--
ALTER TABLE `profile_posts`
  ADD CONSTRAINT `profile_posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
