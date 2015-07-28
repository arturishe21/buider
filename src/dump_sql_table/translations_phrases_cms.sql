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
-- Структура таблицы `translations_phrases_cms`
--

CREATE TABLE IF NOT EXISTS `translations_phrases_cms` (
  `id` int(10) unsigned NOT NULL,
  `phrase` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `translations_phrases_cms`
--

INSERT INTO `translations_phrases_cms` (`id`, `phrase`) VALUES
(8, 'Фраза'),
(9, 'Код'),
(10, 'Переводы'),
(11, 'Добавить'),
(12, 'Удалить'),
(13, 'Каталог пустой'),
(14, 'Показано'),
(15, 'записей'),
(16, 'из'),
(17, 'Главная'),
(18, 'Переводы CMS'),
(19, 'О нас'),
(20, 'Переменые'),
(21, 'Настройки'),
(22, 'Пресса'),
(23, 'Структура сайта'),
(24, 'Кейсы'),
(25, 'Команда'),
(26, 'Упр. пользователями'),
(27, 'Пользователи'),
(28, 'Группы'),
(29, 'Показывать по'),
(30, 'Все'),
(31, 'Административная часть сайта'),
(32, 'Служба поддержки'),
(33, 'Войти'),
(34, 'Эл.почта'),
(35, 'Пароль'),
(36, 'Запомнить меня'),
(37, 'Введите адрес эл.почты'),
(38, 'Введите валидный адрес эл.почты'),
(39, 'Введите пароль'),
(40, 'Пользователь не найден'),
(41, 'Создать'),
(42, 'Тип'),
(43, 'Группа'),
(44, 'Значение'),
(45, 'Редактировать'),
(46, 'Редактирование'),
(47, 'Название'),
(48, 'Клонировать'),
(49, 'Дата создания'),
(50, 'Статья активна'),
(51, 'Общие'),
(52, 'Телефоны'),
(54, 'Новости'),
(55, 'Создание'),
(56, 'Отмена'),
(57, 'Сохранить'),
(58, 'Показать дерево'),
(59, 'Спрятать дерево'),
(60, 'Шаблон'),
(61, 'Активный'),
(62, 'Предпросмотр'),
(63, 'ДА'),
(64, 'НЕТ'),
(65, 'Выберите шаблон'),
(66, 'Общая'),
(67, 'Текст'),
(68, 'Выберите изображение для загрузки'),
(69, 'Нет изображений'),
(70, 'Выбрать'),
(71, 'Нет изображения'),
(72, 'Код(для вставки)'),
(73, 'Большой текст'),
(74, 'Большой текст с редактором'),
(75, 'Список'),
(76, 'Двойной список'),
(77, 'Тройной список'),
(78, 'Файл'),
(79, 'Шаблоны писем'),
(80, 'Тема письма'),
(81, 'Пусто'),
(82, 'Тело письма'),
(83, 'Загрузка...'),
(84, 'Выберите время'),
(85, 'Время'),
(86, 'Часы'),
(87, 'Минуты'),
(88, 'Секунды'),
(89, 'Миллисекунды'),
(90, 'Часовой пояс'),
(91, 'Сейчас'),
(92, 'Закрыть');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `translations_phrases_cms`
--
ALTER TABLE `translations_phrases_cms`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `translations_phrases_cms`
--
ALTER TABLE `translations_phrases_cms`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=93;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
