-- phpMyAdmin SQL Dump
-- version 4.4.15
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 22 2015 г., 15:08
-- Версия сервера: 10.1.0-MariaDB
-- Версия PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

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
  `group_type` enum('general','seo','graphics','price','security') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `type`, `title`, `slug`, `value`, `group_type`) VALUES
(15, 0, 'Окончание title', 'end-title', '- Название сайта', 'seo'),
(16, 0, 'Ссылка на facebook', 'link-to-facebook', 'https://www.facebook.com/?_rdr=p', 'seo'),
(17, 0, 'Адрес в футере', 'adres-v-futere', 'г. Киев, пр-т Победы, 67, корпус Д, 2 этаж', 'general'),
(19, 0, 'Телефоны в шапке', 'telefony-v-shapke', '(044) 555-55-55', 'seo'),
(20, 0, 'Ссылка на VK', 'link-to-vk', 'https://vk.com/feed', 'seo'),
(21, 0, 'Ссылка на google', 'link-to-google', 'https://www.google.com.ua/?', 'seo'),
(22, 0, 'Название сайта в футере', 'name-site-in-footer', 'Название компании', 'general'),
(23, 0, 'Email в шапке', 'email-v-shapke', 'mail@vis-design.com1', 'general'),
(24, 0, 'Кол.статей в каталоге новостей', 'kol_statei-v-kataloge-novostei', '10', 'general'),
(25, 4, 'Нет фото', 'no-foto', '/storage/settings/3953c4aa4bc4e8f9351f34871fa8418b.png', 'graphics'),
(26, 0, 'Email администратора', 'email-administratora', 'arturishe@ukr.net', 'general'),
(27, 0, 'Ед. валюты', 'ed_-valyuty', 'грн.1', 'price'),
(28, 4, 'Фавикон', 'favikon', '/storage/settings/c400d407d1d73d9f0450fa679490548b.ico', 'graphics'),
(29, 1, 'Код перед </head> (google analitics, yandex metrika и т.д.)', 'kod-pered-head', '', 'seo'),
(30, 1, 'Код перед </body>(статистика, аналитика, чаты...)', 'kod-pered-finish-body', '', 'seo'),
(31, 0, 'Доступ в админку по IP', 'access-by-ip', '', 'security'),
(32, 4, 'Логотип', 'logo', '/storage/settings/4d65144a58a3a76b2bb8d027dbf2a7b7.png', 'graphics'),
(33, 0, 'Ссылка на twitter', 'ssylka-na-twitter', '', 'seo');

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
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
