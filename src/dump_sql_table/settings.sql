-- phpMyAdmin SQL Dump
-- version 4.4.7
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июл 28 2015 г., 07:44
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
-- Структура таблицы `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) unsigned NOT NULL,
  `type` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `group_type` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `type`, `title`, `slug`, `value`, `group_type`) VALUES
(15, 0, 'Окончание title', 'okonchanie-title', '- Название сайта', 0),
(16, 0, 'Ссылка на facebook', 'ssylka-na-facebook', 'https://www.facebook.com/?_rdr=p', 1),
(17, 0, 'Адрес в футере', 'adres-v-futere', 'г. Киев, пр-т Победы, 67, корпус Д, 2 этаж', 0),
(18, 0, 'Телефон в футере', 'telefon-v-futere', '(044) 206-1014', 2),
(19, 0, 'Телефоны в шапке', 'telefony-v-shapke', '(044) 555-55-55', 2),
(20, 0, 'Ссылка на VK', 'ssylka-na-vk', 'https://vk.com/feed', 1),
(21, 0, 'Ссылка на google', 'ssylka-na-google', 'https://www.google.com.ua/?', 1),
(22, 0, 'Название сайта в футере', 'nazvanie-saita-v-futere', 'Название компании', 0),
(23, 0, 'Email в шапке', 'email-v-shapke', 'mail@vis-design.com', 0),
(24, 0, 'Кол.статей в каталоге новостей', 'kol_statei-v-kataloge-novostei', '10', 0),
(25, 4, 'Нет фото', 'net-foto', '/storage/settings/3953c4aa4bc4e8f9351f34871fa8418b.png', 0),
(26, 0, 'Email администратора', 'email-administratora', 'arturishe@ukr.net', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_slug_unique` (`slug`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
