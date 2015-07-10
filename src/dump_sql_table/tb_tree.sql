-- phpMyAdmin SQL Dump
-- version 4.4.7
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июл 02 2015 г., 15:14
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
-- Структура таблицы `tb_tree`
--

CREATE TABLE IF NOT EXISTS `tb_tree` (
  `id` int(10) unsigned NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `depth` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `template` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seo_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seo_keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `map` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `tb_tree`
--

INSERT INTO `tb_tree` (`id`, `parent_id`, `lft`, `rgt`, `depth`, `title`, `description`, `slug`, `template`, `is_active`, `seo_title`, `seo_description`, `seo_keywords`, `created_at`, `updated_at`, `map`) VALUES
(1, NULL, 1, 18, 0, 'Главная', '<p>Профессиональная команда по аутсорсингу продаж недвижимости в Украине. \r\nМы предлагаем организацию отдела продаж «под ключ», мы умеем грамотно \r\nстроить процесс продажи портфеля вашей недвижимости, точно\r\nв срок, с максимальной выручкой и с максимальной маржинальной прибылью. \r\nНаша мотивация гораздо больше, чем мотивация специалистов отделов продаж\r\n компаний. Наш партнерский опыт работы по аутсорсингу отдела продаж \r\nнедвижимости с крупными девелоперами, банками, инвестиционными \r\nкомпаниями (фондами) — более пяти лет. </p>', '/', 'главная', 1, '', '', '', '2015-06-02 09:01:32', '2015-06-26 09:57:40', ''),
(2, 1, 2, 7, 1, 'О нас', '<p class="fr-tag">77<br></p>', 'about', 'О нас', 1, '', 'wer\r\nwer"ddd"  ''aaaaaaaaa''\r\nwer', '', '2015-06-02 10:45:03', '2015-06-26 09:57:41', ''),
(3, 1, 16, 17, 1, 'Команда', '<p class="fr-tag">Наша команда профессионалов с многолетним опытом работы на рынке. Фокусируясь       на продажах, мы регулярно организовываем различные тренинги и приглашаем лучших специалистов для обучения персонала. Квалификация наших сотрудников – это результаты       наших продаж.</p>', 'team', 'Команда', 1, '', '', '', '2015-06-02 10:47:49', '2015-06-26 02:27:41', ''),
(4, 1, 10, 11, 1, 'Пресса', '', 'pressa', 'Пресса', 1, '', '', '', '2015-06-02 10:49:01', '2015-06-26 02:26:55', ''),
(5, 1, 8, 9, 1, 'Портфель', '', 'portfolio', 'Портфель', 1, '', '', '', '2015-06-02 10:50:59', '2015-06-26 02:26:50', ''),
(6, 1, 12, 13, 1, 'Кейсы', '', 'cases', 'Кейсы', 1, '', '', '', '2015-06-02 10:53:06', '2015-06-26 02:26:55', ''),
(7, 1, 14, 15, 1, 'Контакты', '<p>По всем вопросам обращайтесь к нам по телефону</p><p style="font-size: 1.28rem;  color: #ee585d;">+380 (44) 597-1-597</p><p>Skype: ARPA Real Estate</p><p>Эл.адрес: <a href="mailto:info@arpa.com.ua">info@arpa.com.ua</a></p><p>Возможно, Вам удобнее будет обратиться в наш офис:</p><p>Киев,  ул. Старокиевская, 10 Г, секция А, 2 этаж.</p>', 'contacts', 'Контакты', 1, 'контакты сео', '', '', '2015-06-02 10:58:19', '2015-06-26 02:26:58', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2540.6223506399624!2d30.522339799999997!3d50.448134599999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d4ce56b2456d3b%3A0xd062ae171b57e947!2z0JrQuNC10LI!5e0!3m2!1sru!2sua!4v1433860105801" width="460" height="550" frameborder="0" style="border:0"></iframe>'),
(8, 2, 5, 6, 2, 'Почему аутсорсинг', '<p class="fr-tag">текст<br></p>', 'why-outsor', 'О нас (каталог)', 1, '', '', '', '2015-06-04 04:36:51', '2015-06-23 07:45:03', ''),
(9, 2, 3, 4, 2, 'Почему аутсорсинг с ARPA', '<p class="fr-tag">ARPA Real Estate - профессиональная команда по аутсорсингу продаж недвижимости в Украине.1. Мы заслужили репутацию надежных и эффективных партнеров на рынке аутсорсинга продажи недвижимости.  2. Мы умеем грамотно организовать процесс продажи портфеля вашей недвижимости, точно в срок, с максимальной выручкой и с максимальной маржинальной прибылью. </p>', 'why-outsor-arpa', 'О нас (каталог)', 1, '', '', '', '2015-06-04 04:38:55', '2015-06-23 07:44:47', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tb_tree`
--
ALTER TABLE `tb_tree`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_tree_parent_id_index` (`parent_id`),
  ADD KEY `tb_tree_lft_index` (`lft`),
  ADD KEY `tb_tree_rgt_index` (`rgt`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tb_tree`
--
ALTER TABLE `tb_tree`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
