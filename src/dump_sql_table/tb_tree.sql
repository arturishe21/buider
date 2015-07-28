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
  `map` text COLLATE utf8_unicode_ci NOT NULL,
  `show_in_menu` tinyint(4) NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `additional_pictures` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `tb_tree`
--

INSERT INTO `tb_tree` (`id`, `parent_id`, `lft`, `rgt`, `depth`, `title`, `description`, `slug`, `template`, `is_active`, `seo_title`, `seo_description`, `seo_keywords`, `created_at`, `updated_at`, `map`, `show_in_menu`, `picture`, `additional_pictures`) VALUES
(1, NULL, 1, 10, 0, 'Главная', '<p>Профессиональная команда по аутсорсингу продаж недвижимости в Украине. Мы предлагаем организацию отдела продаж «под ключ», мы умеем грамотно строить процесс продажи портфеля вашей недвижимости, точнов срок, с максимальной выручкой и с максимальной маржинальной прибылью. Наша мотивация гораздо больше, чем мотивация специалистов отделов продаж компаний. Наш партнерский опыт работы по аутсорсингу отдела продаж недвижимости с крупными девелоперами, банками, инвестиционными компаниями (фондами) — более пяти лет. </p>', '/', 'Главная', 1, '', '', '', '2015-06-02 09:01:32', '2015-07-24 07:35:45', '', 0, '', '[]'),
(2, 1, 2, 3, 1, 'О нас', '<h3 class="fr-tag">Стандартний Lorem Ipsum, використовуваний з XVI ст.</h3><p class="fr-tag">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p><h3 class="fr-tag">Розділ 1.10.32 "de Finibus Bonorum et Malorum", написаного Цицероном у 45 році до н.е.</h3><p class="fr-tag">"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"</p><h3 class="fr-tag">Переклад Х.Рекема англійською, 1914</h3><p class="fr-tag">"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?"</p><h3 class="fr-tag">Розділ 1.10.33 "de Finibus Bonorum et Malorum", написаного Цицероном у 45 році до н.е.</h3><p class="fr-tag">"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat."</p><h3 class="fr-tag">Переклад Х.Рекема англійською, 1914</h3><p class="fr-tag">"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains."</p><p class="fr-tag"><br></p>', 'about', 'О нас', 1, '', 'Сео текст', '', '2015-06-02 10:45:03', '2015-07-25 14:38:43', '', 1, 'storage/tb-articles/2015/07/23/ce57bd67fbec8f78e1a147246ea84293_1437669450.jpeg', '["storage\\/tb-articles\\/2015\\/07\\/23\\/94bd77020e8d723657e1bcf3a8d70c86_1437669477.jpeg","storage\\/tb-articles\\/2015\\/07\\/23\\/37952db1dbb79b87cf23db882bfc5657_1437669478.jpeg"]'),
(4, 1, 8, 9, 1, 'Новости', '<p><br></p>', 'news', 'Новости', 1, '', '', '', '2015-06-02 10:49:01', '2015-07-25 14:43:28', '', 1, '', ''),
(6, 1, 4, 5, 1, 'Статьи', '<p><br></p>', 'articles', 'Статьи', 1, '', '', '', '2015-06-02 10:53:06', '2015-07-25 14:38:43', '', 1, '', ''),
(7, 1, 6, 7, 1, 'Контакты', '<p class="fr-tag">По всем вопросам обращайтесь к нам по телефону</p><p class="fr-tag" style="font-size: 1.28rem;  color: #ee585d;">+380 (44) 111-11-11</p><p class="fr-tag">Skype: test<br></p><p class="fr-tag">Эл.адрес: <a href="mailto:info@vis-desing.com">info@vis-design.com</a></p><p class="fr-tag">Возможно, Вам удобнее будет обратиться в наш офис:</p><p class="fr-tag">Киев, Адрес<br></p>', 'contacts', 'Контакты', 1, 'контакты сео', 'Сео текст на странице контакты', '', '2015-06-02 10:58:19', '2015-07-25 14:43:28', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2540.6223506399624!2d30.522339799999997!3d50.448134599999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d4ce56b2456d3b%3A0xd062ae171b57e947!2z0JrQuNC10LI!5e0!3m2!1sru!2sua!4v1433860105801" width="100%" height="550" frameborder="0" style="border:0"></iframe>', 1, '', '');

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
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
