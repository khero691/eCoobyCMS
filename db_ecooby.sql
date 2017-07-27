-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 27 2017 г., 23:45
-- Версия сервера: 5.7.13
-- Версия PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `db_ecooby`
--

-- --------------------------------------------------------

--
-- Структура таблицы `ec_admins`
--

CREATE TABLE IF NOT EXISTS `ec_admins` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `level` varchar(3) NOT NULL,
  `specialization` varchar(128) NOT NULL,
  `country` varchar(128) NOT NULL,
  `about` mediumtext NOT NULL,
  `vk_id` varchar(28) NOT NULL,
  `email` varchar(128) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ec_admins`
--

INSERT INTO `ec_admins` (`id`, `user_id`, `level`, `specialization`, `country`, `about`, `vk_id`, `email`) VALUES
(1, 1, 'max', 'Developer', 'None, Country', 'Тестовый пользователь', '255237807', 'support@ecooby.ru');

-- --------------------------------------------------------

--
-- Структура таблицы `ec_categorys`
--

CREATE TABLE IF NOT EXISTS `ec_categorys` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `hide` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ec_categorys`
--

INSERT INTO `ec_categorys` (`id`, `name`, `hide`) VALUES
(1, 'Main', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `ec_comments`
--

CREATE TABLE IF NOT EXISTS `ec_comments` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `text` mediumtext NOT NULL,
  `email` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL,
  `time` int(11) NOT NULL,
  `author_id` varchar(128) NOT NULL,
  `hide` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `ec_navigation_items`
--

CREATE TABLE IF NOT EXISTS `ec_navigation_items` (
  `id` int(11) NOT NULL,
  `text` varchar(128) NOT NULL,
  `url` mediumtext NOT NULL,
  `hide` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ec_navigation_items`
--

INSERT INTO `ec_navigation_items` (`id`, `text`, `url`, `hide`) VALUES
(1, 'Главная', '/', 0),
(2, 'Поиск', '/search', 0),
(3, 'О нас', '/page?id=about', 0),
(4, 'Обратная связь', '/page?id=contact', 0),
(5, 'Test', '', 1),
(6, 'Test', '#', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `ec_news`
--

CREATE TABLE IF NOT EXISTS `ec_news` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `sdesc` mediumtext NOT NULL,
  `fdesc` mediumtext NOT NULL,
  `author_id` int(11) NOT NULL,
  `image_url` mediumtext NOT NULL,
  `time` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `hide` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ec_news`
--

INSERT INTO `ec_news` (`id`, `title`, `sdesc`, `fdesc`, `author_id`, `image_url`, `time`, `category`, `hide`) VALUES
(1, 'Open eCooby!', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1, 'http://blog.cooby.ru/ec-tpl/default/images/2.jpg', 1482974374, 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `ec_pages`
--

CREATE TABLE IF NOT EXISTS `ec_pages` (
  `id` int(11) NOT NULL,
  `url` varchar(128) NOT NULL,
  `title` varchar(128) NOT NULL,
  `content` mediumtext NOT NULL,
  `time` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `hide` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ec_pages`
--

INSERT INTO `ec_pages` (`id`, `url`, `title`, `content`, `time`, `author_id`, `hide`) VALUES
(1, 'contact', 'Обратная связь', '<div class="box-body">\n				<form method="POST">\n					<div class="form">\n						<input class="halfinput" name="name" type="text" placeholder="Your Name">\n						<input class="halfinput" name="email" type="email" placeholder="Email">\n						<input name="subject" type="text" placeholder="Subject">\n						<textarea name="message" placeholder="Your Message"></textarea>\n						<button type="submit" class="btn btn-main">Отправить сообщение</button>\n					</div>\n				</form>\n			</div>', 1480373338, 1, 0),
(2, 'about', 'О нас', '<div class="box-body">\n	<center><img src="https://cs7053.vk.me/c604625/v604625807/16242/lUIjrQlIgnA.jpg"><br>\n	<p><strong>eCooby Blog</strong> - это микро блог, в котором мы выкладываем наши новости.</p></center>\n</div>', 1480373338, 1, 0),
(3, 'test', 'Тест страница', 'Test content for test page', 1483053133, 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `ec_pages_title`
--

CREATE TABLE IF NOT EXISTS `ec_pages_title` (
  `id` int(11) NOT NULL,
  `url` varchar(64) NOT NULL,
  `title` varchar(128) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ec_pages_title`
--

INSERT INTO `ec_pages_title` (`id`, `url`, `title`, `type`) VALUES
(1, 'index', 'Панель управления', 1),
(2, 'posts', 'Список постов', 1),
(3, 'pages', 'Список страниц', 1),
(4, 'posts&id=new', 'Добавить новость', 1),
(5, 'index', 'Главная', 0),
(6, 'search', 'Поиск по сайту', 0),
(7, '', 'Авторизация', 1),
(8, 'console', 'Консоль', 1),
(9, 'mods', 'Модули', 1),
(10, 'cogs', 'Настройки профиля', 1),
(11, 'version', 'Версия', 1),
(12, 'upgrade', 'Обновления', 1),
(13, 'auth', 'Авторизация', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `ec_page_views`
--

CREATE TABLE IF NOT EXISTS `ec_page_views` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  `ip` varchar(128) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ec_page_views`
--

INSERT INTO `ec_page_views` (`id`, `type`, `object_id`, `ip`) VALUES
(1, 1, 7, '127.0.0.1'),
(2, 1, 4, '127.0.0.1'),
(3, 2, 1, '127.0.0.1'),
(4, 2, 2, '127.0.0.1'),
(5, 1, 1, '127.0.0.1'),
(6, 1, 8, '127.0.0.1'),
(7, 2, 3, '127.0.0.1');

-- --------------------------------------------------------

--
-- Структура таблицы `ec_settings`
--

CREATE TABLE IF NOT EXISTS `ec_settings` (
  `id` int(11) NOT NULL,
  `op_name` varchar(128) NOT NULL,
  `value` mediumtext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ec_settings`
--

INSERT INTO `ec_settings` (`id`, `op_name`, `value`) VALUES
(1, 'title', 'eCooby'),
(2, 'template', 'default'),
(3, 'vkLink', 'https://vk.com/ecooby'),
(4, 'fbLink', '#'),
(5, 'reg_comment', 'on'),
(6, 'license', '000-000-001'),
(7, 'hash', ''),
(8, 'webtags', 'test, ecooby, other'),
(9, 'update', '1500813820');

-- --------------------------------------------------------

--
-- Структура таблицы `ec_tags`
--

CREATE TABLE IF NOT EXISTS `ec_tags` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `tag` varchar(128) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ec_tags`
--

INSERT INTO `ec_tags` (`id`, `type`, `post_id`, `tag`) VALUES
(1, 1, 1, 'test');

-- --------------------------------------------------------

--
-- Структура таблицы `ec_users`
--

CREATE TABLE IF NOT EXISTS `ec_users` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `avatar` mediumtext NOT NULL,
  `registration_date` int(11) NOT NULL,
  `registration_ip` varchar(128) NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ec_users`
--

INSERT INTO `ec_users` (`id`, `name`, `password`, `avatar`, `registration_date`, `registration_ip`, `age`) VALUES
(1, 'Admin', '21232f297a57a5a743894a0e4a801fc3', '', 1470371587, '127.0.0.1', 17);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `ec_admins`
--
ALTER TABLE `ec_admins`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ec_categorys`
--
ALTER TABLE `ec_categorys`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ec_comments`
--
ALTER TABLE `ec_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ec_navigation_items`
--
ALTER TABLE `ec_navigation_items`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ec_news`
--
ALTER TABLE `ec_news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ec_pages`
--
ALTER TABLE `ec_pages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ec_pages_title`
--
ALTER TABLE `ec_pages_title`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ec_page_views`
--
ALTER TABLE `ec_page_views`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ec_settings`
--
ALTER TABLE `ec_settings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ec_tags`
--
ALTER TABLE `ec_tags`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ec_users`
--
ALTER TABLE `ec_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `ec_admins`
--
ALTER TABLE `ec_admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `ec_categorys`
--
ALTER TABLE `ec_categorys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `ec_comments`
--
ALTER TABLE `ec_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `ec_navigation_items`
--
ALTER TABLE `ec_navigation_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `ec_news`
--
ALTER TABLE `ec_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `ec_pages`
--
ALTER TABLE `ec_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `ec_pages_title`
--
ALTER TABLE `ec_pages_title`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `ec_page_views`
--
ALTER TABLE `ec_page_views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `ec_settings`
--
ALTER TABLE `ec_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `ec_tags`
--
ALTER TABLE `ec_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `ec_users`
--
ALTER TABLE `ec_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
