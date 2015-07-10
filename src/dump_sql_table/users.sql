-- phpMyAdmin SQL Dump
-- version 4.4.7
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июл 02 2015 г., 16:56
-- Версия сервера: 10.1.0-MariaDB
-- Версия PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `c1_laratest`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `activation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `persist_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_subscribed` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `permissions`, `activated`, `image`, `activation_code`, `activated_at`, `last_login`, `persist_code`, `reset_password_code`, `first_name`, `last_name`, `photo`, `created_at`, `updated_at`, `is_subscribed`) VALUES
(3, 'artur@vis-design.com', '$2y$10$wRaKCDnl/MbHUx.KR3BNsO3K4delaf05YRCkxy.XSJhu2AkOgE8tC', NULL, 1, '', NULL, NULL, '2015-07-02 07:42:29', '$2y$10$zVJwg9NR48w9h9bnKtLwHO0ThZOUK00vFbBwSpCkc1LIIsVeNBiRO', NULL, NULL, NULL, '', '2015-06-03 08:34:10', '2015-07-02 07:42:29', 0),
(6, 'anna.dyadkova@vis-design.com', '$2y$10$eqtMGp4rrc5RyomNgMA7uuzxxFWTOTPzCYpXd645Eod7b0CcuaVzG', '', 1, '', NULL, NULL, '2015-06-18 11:13:44', '$2y$10$EtutCOwNllQZho4z0RfEB.m85qL37XssylGT.G5lXwrE56r38QTfC', NULL, 'Anya', 'Dyadkova', '', '2015-06-09 11:51:42', '2015-06-18 11:13:44', 0),
(7, 'test@vis-design.com', '$2y$10$hZeGDlil2pGJrUJbFLxyPeScwDk3zD91VidPmdj/SfRbYbcqOp1pC', '', 0, '', NULL, NULL, NULL, NULL, NULL, 'Алексей', 'Еннер', '', '2015-06-09 11:57:15', '2015-06-09 11:57:15', 0),
(8, 'alena@vis-design.com', '$2y$10$RG0YL9gHYHcM1MOCBbfLaecap3tEZX2yfX39zp6ybw9NxAKY8UVEa', '', 1, '', NULL, NULL, '2015-06-18 08:54:15', '$2y$10$uqQ7edHx8pPsVe2ZXJq4k.Y5yGHvRXxD8vz6JujQIbESwFn5FBFFG', NULL, 'Алена', 'Пухляк', '', '2015-06-10 07:46:11', '2015-06-18 08:54:15', 0),
(9, 'leha@vis-design.com', '$2y$10$FvbhULZQe41SHXLvFS9uRuCIt6mVaHhlmyYmLg3JMllb7l80.BpXm', '', 1, 'storage/user_avatars/00/00/09/7e4b6a5e3669b6f96cc24f9c30e7a295.jpeg', NULL, NULL, '2015-06-18 08:55:05', '$2y$10$HZBbQzRvv4MatH78D0qLT.7XTxdyETP1PsAuOspNr1L7BIm.H/X2y', NULL, 'Леха', 'Тест', '', '2015-06-18 08:52:32', '2015-07-01 15:37:38', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_activation_code_index` (`activation_code`),
  ADD KEY `users_reset_password_code_index` (`reset_password_code`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
