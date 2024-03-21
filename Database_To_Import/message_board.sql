-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 21, 2024 at 09:49 AM
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
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `conversation_id` int(11) NOT NULL,
  `user1_id` int(11) DEFAULT NULL,
  `user2_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `conversation_id`, `sender_id`, `receiver_id`, `message_content`, `timestamp`) VALUES
(1113, NULL, 2, 20, 'Hello Clint kamusta? Ako Okay ra hehehe', '2024-03-18 06:00:40'),
(1134, NULL, 23, 2, 'Bai kmusta?', '2024-03-18 07:48:15'),
(1140, NULL, 2, 23, 'cxvcxvcxv', '2024-03-18 08:24:04'),
(1146, NULL, 2, 23, '5\r\n', '2024-03-18 08:35:59'),
(1155, NULL, 23, 2, 'OHHHH?', '2024-03-18 08:43:38'),
(1156, NULL, 23, 2, 'Unsa man?', '2024-03-18 08:50:06'),
(1159, NULL, 20, 2, 'bccvbv', '2024-03-18 09:24:43'),
(1160, NULL, 2, 20, 'Yeah?', '2024-03-18 09:26:57'),
(1162, NULL, 2, 20, 'hehehehee', '2024-03-19 07:50:37'),
(1168, NULL, 2, 20, 'Hello ?', '2024-03-19 08:28:04'),
(1170, NULL, 2, 23, 'wa ra hehe', '2024-03-19 08:28:39'),
(1171, NULL, 20, 2, 'Naa ko sa balay', '2024-03-19 08:47:12'),
(1172, NULL, 20, 2, 'Ikaw asa naman ka?', '2024-03-19 08:47:18'),
(1173, NULL, 20, 21, 'Kamusta Janrae?\r\n', '2024-03-19 08:48:21'),
(1174, NULL, 21, 20, 'Bai Clint okay ra, ikaw kamusta?', '2024-03-19 08:50:57'),
(1175, NULL, 20, 21, 'Gwapo man lagi tag profile pic ron? heehhee', '2024-03-19 08:51:39'),
(1176, NULL, 24, 2, 'Hello ang? How are me?', '2024-03-19 09:38:51'),
(1177, NULL, 2, 24, 'Ohh kamusta man ko?', '2024-03-19 09:39:22'),
(1182, NULL, 24, 2, 'My dearest [Recipient\'s Name],\n\nAs I sit here pondering the depths of my affection for you, words seem insufficient to capture the vastness of my emotions. From the moment our paths intertwined, you\'ve become the brightest star in the constellation of my life. Your presence is a melody that soothes my soul, a gentle breeze that carries away my worries, and a beacon of light guiding me through life\'s uncertainties. Every laugh we share, every tear we wipe away together, strengthens the bond between us, weaving a tapestry of love and understanding.\n\nIn your eyes, I find solace; in your embrace, I find home. Your kindness knows no bounds, and your compassion touches the deepest recesses of my heart. With you, I\'ve discovered the true essence of love – a love that is patient, nurturing, and unconditional. As we journey through life hand in hand, know that my love for you will only grow stronger with each passing day. You are not just my partner, but my confidant, my best friend, and the embodiment of all that is good in this world. I am endlessly grateful for your presence in my life and cherish every moment we share together.\n\nForever yours,\n[Your Name]', '2024-03-20 07:07:14'),
(1183, NULL, 25, 2, 'Hey How are you today?', '2024-03-20 03:10:16'),
(1184, NULL, 26, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ut blandit ligula, ac porta dui. Cras in blandit libero. Ut consequat fermentum quam vel fringilla. Nunc aliquet est eget lobortis interdum. Aenean et enim ac arcu efficitur aliquet. Aenean commodo suscipit ante, quis aliquet enim vehicula a. Proin enim quam, suscipit in hendrerit vitae, fermentum in purus. Suspendisse hendrerit eleifend metus, quis hendrerit risus fringilla in. Integer varius tempus nisl id dapibus. Sed consectetur nulla id sagittis fermentum. Fusce bibendum laoreet sapien. Nam sed tellus vel nibh fringilla dignissim et sit amet dolor. Sed posuere mollis odio, eget pellentesque erat sodales aliquet.\r\n\r\n', '2024-03-20 03:12:23'),
(1185, NULL, 27, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ut blandit ligula, ac porta dui. Cras in blandit libero. Ut consequat fermentum quam vel fringilla. Nunc aliquet est eget lobortis interdum. Aenean et enim ac arcu efficitur aliquet. Aenean commodo suscipit ante, quis aliquet enim vehicula a. Proin enim quam, suscipit in hendrerit vitae, fermentum in purus. Suspendisse hendrerit eleifend metus, quis hendrerit risus fringilla in. Integer varius tempus nisl id dapibus. Sed consectetur nulla id sagittis fermentum. Fusce bibendum laoreet sapien. Nam sed tellus vel nibh fringilla dignissim et sit amet dolor. Sed posuere mollis odio, eget pellentesque erat sodales aliquet.\r\n\r\nCurabitur ut ipsum lobortis, faucibus leo eget, consequat diam. Cras mollis tempus mollis. Ut rhoncus eros nec orci ornare volutpat. Sed placerat, lectus vitae sollicitudin convallis, ex purus fermentum massa, at eleifend justo ex in nibh. Curabitur rutrum mi non magna luctus ullamcorper. Pellentesque quis tortor eget ligula varius laoreet et eget felis. Duis a elementum dui. Nullam ut tristique risus. Duis vel odio lacus. Nullam eleifend iaculis velit, gravida efficitur elit efficitur eget. Maecenas tristique ex augue, ut varius nulla efficitur quis.\r\n\r\nClass aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut accumsan, magna eu feugiat dapibus, ipsum ligula molestie augue, sit amet fringilla nisi urna ac turpis. Aliquam nec facilisis neque. Aenean at ipsum ut augue semper maximus porttitor ac enim. Nullam venenatis eget magna iaculis elementum. Maecenas id porta tortor. Suspendisse non nisi ut lorem aliquet laoreet at sed mi. Aliquam luctus erat in est imperdiet dictum. Nulla consectetur auctor sapien, eget pretium libero scelerisque eget. Morbi sit amet malesuada nulla, a semper libero. Quisque ac euismod tortor.\r\n\r\nNam viverra fringilla quam eu pulvinar. Vestibulum nisi magna, placerat id nisi vel, sodales volutpat mauris. Donec pulvinar iaculis est, vel malesuada dui porta consectetur. Morbi pulvinar eget dolor fringilla sodales. Suspendisse vel magna nec justo lobortis ornare. Nulla id placerat nulla. Integer placerat rhoncus velit hendrerit elementum. Pellentesque feugiat fringilla felis quis iaculis. Aenean viverra a turpis et finibus. Maecenas mattis metus quis ipsum dignissim, non scelerisque ligula vehicula. Vestibulum ut efficitur dui.\r\n\r\nFusce mollis mauris est, a vehicula augue convallis vel. Phasellus rutrum eget sapien consectetur hendrerit. Fusce consequat massa sit amet est ultrices, eu suscipit mi placerat. Nam lobortis metus sed massa ullamcorper, elementum gravida sem mattis. Integer efficitur erat est, vitae elementum mi lacinia et. Etiam euismod ex non enim pellentesque, in efficitur est tristique. Donec ac nisl felis. Duis a sem dui.\r\n\r\n', '2024-03-20 03:14:54'),
(1186, NULL, 28, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ut blandit ligula, ac porta dui. Cras in blandit libero. Ut consequat fermentum quam vel fringilla. Nunc aliquet est eget lobortis interdum. Aenean et enim ac arcu efficitur aliquet. Aenean commodo suscipit ante, quis aliquet enim vehicula a. Proin enim quam, suscipit in hendrerit vitae, fermentum in purus. Suspendisse hendrerit eleifend metus, quis hendrerit risus fringilla in. Integer varius tempus nisl id dapibus. Sed consectetur nulla id sagittis fermentum. Fusce bibendum laoreet sapien. Nam sed tellus vel nibh fringilla dignissim et sit amet dolor. Sed posuere mollis odio, eget pellentesque erat sodales aliquet.\r\n\r\nCurabitur ut ipsum lobortis, faucibus leo eget, consequat diam. Cras mollis tempus mollis. Ut rhoncus eros nec orci ornare volutpat. Sed placerat, lectus vitae sollicitudin convallis, ex purus fermentum massa, at eleifend justo ex in nibh. Curabitur rutrum mi non magna luctus ullamcorper. Pellentesque quis tortor eget ligula varius laoreet et eget felis. Duis a elementum dui. Nullam ut tristique risus. Duis vel odio lacus. Nullam eleifend iaculis velit, gravida efficitur elit efficitur eget. Maecenas tristique ex augue, ut varius nulla efficitur quis.\r\n\r\nClass aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut accumsan, magna eu feugiat dapibus, ipsum ligula molestie augue, sit amet fringilla nisi urna ac turpis. Aliquam nec facilisis neque. Aenean at ipsum ut augue semper maximus porttitor ac enim. Nullam venenatis eget magna iaculis elementum. Maecenas id porta tortor. Suspendisse non nisi ut lorem aliquet laoreet at sed mi. Aliquam luctus erat in est imperdiet dictum. Nulla consectetur auctor sapien, eget pretium libero scelerisque eget. Morbi sit amet malesuada nulla, a semper libero. Quisque ac euismod tortor.\r\n\r\nNam viverra fringilla quam eu pulvinar. Vestibulum nisi magna, placerat id nisi vel, sodales volutpat mauris. Donec pulvinar iaculis est, vel malesuada dui porta consectetur. Morbi pulvinar eget dolor fringilla sodales. Suspendisse vel magna nec justo lobortis ornare. Nulla id placerat nulla. Integer placerat rhoncus velit hendrerit elementum. Pellentesque feugiat fringilla felis quis iaculis. Aenean viverra a turpis et finibus. Maecenas mattis metus quis ipsum dignissim, non scelerisque ligula vehicula. Vestibulum ut efficitur dui.\r\n\r\nFusce mollis mauris est, a vehicula augue convallis vel. Phasellus rutrum eget sapien consectetur hendrerit. Fusce consequat massa sit amet est ultrices, eu suscipit mi placerat. Nam lobortis metus sed massa ullamcorper, elementum gravida sem mattis. Integer efficitur erat est, vitae elementum mi lacinia et. Etiam euismod ex non enim pellentesque, in efficitur est tristique. Donec ac nisl felis. Duis a sem dui.\r\n\r\n', '2024-03-20 03:16:47'),
(1188, NULL, 23, 2, 'In tempus, dolor in blandit malesuada, orci quam auctor libero, blandit tincidunt orci eros sed nisl. Pellentesque leo urna, hendrerit quis massa at, viverra lacinia neque. Nam scelerisque odio a vestibulum venenatis. Quisque sed urna felis. Phasellus aliquet a sem at vehicula. Nunc justo nulla, egestas id cursus ut, aliquet id diam. Aenean dignissim, tortor vel blandit porta, arcu arcu bibendum odio, ut tempor eros tortor eget velit. Nulla facilisi. Maecenas ut rhoncus dolor.', '2024-03-20 06:10:19'),
(1189, NULL, 23, 2, 'Curabitur vel congue magna, eu iaculis sapien. Cras placerat elit nec molestie faucibus. Duis purus ipsum, aliquet ac lacus vel, consequat consectetur elit. In molestie ornare velit, non dignissim justo. Aenean sagittis massa massa, eu tincidunt sem facilisis ut. Quisque in elit aliquam, euismod velit ac, feugiat arcu. Nunc vel lacinia lectus. In hac habitasse platea dictumst. Nam id tincidunt dui. Phasellus sed diam purus. Morbi sed urna pharetra, varius eros eget, scelerisque eros. Nam semper dapibus molestie. Donec diam nunc, fermentum id tellus imperdiet, bibendum ornare massa. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Quisque risus diam, porttitor vitae dui quis, pharetra sagittis odio.', '2024-03-20 06:10:47'),
(1190, NULL, 23, 2, 'Suspendisse tortor felis, dictum lacinia erat eget, hendrerit consequat velit. Pellentesque sagittis odio non lorem sodales, vel pretium arcu lacinia. Nullam id volutpat justo. Vestibulum tempor accumsan turpis, quis aliquet urna pretium at. Proin viverra porta justo eu hendrerit. Morbi eget neque finibus, imperdiet libero auctor, accumsan quam. Duis massa nibh, porttitor quis libero et, cursus interdum lorem. Quisque accumsan lacus nec fringilla tempor. Ut eget sapien eu purus finibus dictum ut imperdiet risus. Nam sit amet hendrerit dolor. Vestibulum sed finibus sapien. Nunc urna diam, mollis ac lacinia sed, faucibus sed lacus. Proin at lacus sem.', '2024-03-20 06:10:55'),
(1193, NULL, 2, 24, 'ok', '2024-03-20 07:12:44'),
(1195, NULL, 2, 2, 'Test', '2024-03-20 08:14:15'),
(1197, NULL, 2, 26, 'What I don\'t understand', '2024-03-20 09:10:27'),
(1198, NULL, 2, 23, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '2024-03-20 09:19:25'),
(1200, NULL, 2, 23, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', '2024-03-21 03:39:49'),
(1201, NULL, 2, 21, 'Hello?', '2024-03-21 06:57:37'),
(1202, NULL, 2, 20, 'Nagduty pako bai ari hehehe ', '2024-03-21 07:07:11');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `path` varchar(200) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `name`, `path`, `created`, `modified`) VALUES
(2, 'Avatars.jpeg', 'images/Avatars.jpeg', '2024-03-19 10:15:05', '2024-03-19 10:15:05'),
(4, 'download1.jpeg', 'images/download1.jpeg', '2024-03-15 09:01:18', '2024-03-15 09:01:18'),
(13, 'download.jpeg', 'images/download.jpeg', '2024-03-18 04:11:53', '2024-03-18 04:11:53'),
(20, 'download.jpeg', 'images/download.jpeg', '2024-03-18 06:56:04', '2024-03-18 06:56:04'),
(23, 'download (1).jpeg', 'images/download (1).jpeg', '2024-03-18 08:49:09', '2024-03-18 08:49:09'),
(21, 'avatar.jpeg', 'images/avatar.jpeg', '2024-03-19 09:50:39', '2024-03-19 09:50:39'),
(24, 'avatar.jpeg', 'images/avatar.jpeg', '2024-03-19 10:36:20', '2024-03-19 10:36:20'),
(25, 'download1.jpeg', 'images/download1.jpeg', '2024-03-20 04:09:58', '2024-03-20 04:09:58'),
(26, 'download (1).jpeg', 'images/download (1).jpeg', '2024-03-20 04:11:46', '2024-03-20 04:11:46'),
(28, 'download1.jpeg', 'images/download1.jpeg', '2024-03-20 07:40:17', '2024-03-20 07:40:17'),
(27, 'avatar.jpeg', 'images/avatar.jpeg', '2024-03-20 07:40:51', '2024-03-20 07:40:51');

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
  `hobby` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `gender`, `birthdate`, `email`, `password`, `date_created`, `last_login_time`, `hobby`) VALUES
(2, 'Hadrian Evarula', 'Male', '2002-03-28', 'hadrian.fdc@gmail.com', '$2a$10$ojbx34OuIM8cq18.M9L79eJiljMUWHQZNHsJx708m6qKXwnIrwYYa', '2024-03-12 09:38:48', '2024-03-21 08:24:23', 'Delve into the world of miniature painting, where each stroke of the brush brings tiny worlds to life on your canvas. From intricate fantasy creatures to historical figures, this hobby offers endless opportunities for creativity and self-expression. With a palette of vibrant colors at your fingertips, you\'ll find joy in blending shades and mastering techniques to add depth and detail to your miniatures. Whether you\'re recreating scenes from your favorite games or crafting original works of art\r\n'),
(20, 'Clint Anthony Savilla', 'Male', '2024-03-18', 'clint.savilla@gmail.com', '$2a$10$bFTlh11ZQYgk..DSgB4uVugnpdIRJbh6F6C1N6LpYViDmh59J9wBC', '2024-03-18 06:52:53', '2024-03-19 09:51:13', 'Delve into the captivating world of terrarium crafting, where miniature landscapes come to life within glass containers. Cultivate your creativity as you design lush ecosystems using a variety of plants, rocks, and decorative elements. From serene woodland scenes to vibrant desert vistas, terrariums offer endless possibilities for expression. Experiment with different plant species, substrates, and arrangements to craft unique and visually stunning terrariums. Whether you\'re drawn to the tranqui'),
(21, 'Janrae Fagaragan', 'Male', '2024-03-18', 'janrae.fagaragan@gmail.com', '$2a$10$bFTlh11ZQYgk..DSgB4uVugnpdIRJbh6F6C1N6LpYViDmh59J9wBC', '2024-03-18 06:53:41', '2024-03-19 09:48:56', 'Embark on the captivating journey of web development, where lines of code transform into dynamic digital landscapes. Dive into the intricate dance of HTML, CSS, and JavaScript, weaving together the fabric of interactive websites and applications. Unleash your creativity as you design captivating user interfaces, meticulously crafting each element to engage and delight visitors. Embrace the thrill of problem-solving as you debug and optimize your code, transforming challenges into triumphs. Wheth'),
(22, 'Jefritz Alberca', 'Male', '2024-03-18', 'jefritz.alberca@gmail.com', '$2a$10$bFTlh11ZQYgk..DSgB4uVugnpdIRJbh6F6C1N6LpYViDmh59J9wBC', '2024-03-18 06:54:09', NULL, NULL),
(23, 'Dave Gwapo', 'Male', '2024-03-18', 'dave.gwapolagika@gmail.com', '$2a$10$UyComCUp4ff5sVPKI/BsZe8CvuIt7bU/WUaJ9ttvLHHujArZuR6JC', '2024-03-18 08:47:23', '2024-03-20 07:09:25', 'Wala ra gud hehehe'),
(24, 'John Doe', 'Male', '2024-03-19', 'john.doe@gmail.com', '$2a$10$5BWGCu.v1YomPEcl.gG.HeRchSw1xeOFe5.UNn5kwJ8jWqL/WHB/2', '2024-03-19 04:22:06', '2024-03-20 03:40:50', 'Delve into the captivating world of cosplay with ANG, inspired by the character Aang from Avatar: The Last Airbender. Embrace the artistry of crafting detailed costumes, mastering intricate hairstyles, and embodying the spirit of ANG through conventions and photo shoots. Dive into the realm of prop-making, channeling ANG\'s elemental bending skills by creating stunning replicas of his iconic staff or intricate airbending glider. Explore the vibrant community of fellow enthusiasts, participating i'),
(25, 'Joseph Savilla', 'Male', '2002-03-20', 'joseph.savilla@gmail.com', '$2a$10$qmMtEf12ami6Vz62vlbJWeCcSXWXPj3sigkUOVeoOkUe6QPrOgaze', '2024-03-20 04:02:15', '2024-03-20 04:09:39', 'Wala ra gud'),
(26, 'Andrea B', 'Female', '2004-03-20', 'andrea.b@gmail.com', '$2a$10$mtGocg0Xf2W9SivpSsHecer4cakRwImKODFK3Kim7JD0EkYkhbfC.', '2024-03-20 04:10:25', '2024-03-20 07:41:09', 'Wala ra pud\r\n'),
(27, 'Jan Baoc', 'Male', '2024-03-20', 'jan.baoc@gmail.com', '$2a$10$GEyEX2SdT.9oxG8vFiEp5.bStmYvSqOvvk7XCwqCkkB2ou5igtSai', '2024-03-20 04:13:11', '2024-03-20 07:40:41', NULL),
(28, 'June Michael Jordan', 'Male', '2024-03-20', 'june@gmail.com', '$2a$10$A12XVRUmKv9iq1N8TIV0HuLZfRVZf89TJsspxnl0xo2vkwyP9sUzu', '2024-03-20 04:15:54', '2024-03-20 07:40:06', NULL),
(29, 'Wa Ra Gud', 'Male', '2024-03-21', 'waragud@gmail.com', '$2a$10$E8iId1ZF8utpuBNrurZ8n.M79eLjWG6HHpL1Nd5tF9YJf.v/S6hx6', '2024-03-21 03:52:15', '2024-03-21 03:52:53', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`conversation_id`),
  ADD KEY `user1_id` (`user1_id`),
  ADD KEY `user2_id` (`user2_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `conversation_id` (`conversation_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `conversation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1203;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
