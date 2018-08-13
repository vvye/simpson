SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
CREATE DATABASE IF NOT EXISTS `simpson` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `simpson`;

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `addressee` int(11) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `post_time` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email_public` tinyint(4) NOT NULL DEFAULT '0',
  `bio` longtext NOT NULL,
  `registration_time` int(11) NOT NULL,
  `last_activity_time` int(11) NOT NULL,
  `csrf_token` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id` (`id`);


ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
