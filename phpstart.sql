-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июн 13 2018 г., 10:58
-- Версия сервера: 5.7.22-0ubuntu0.16.04.1
-- Версия PHP: 7.0.30-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `phpstart`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`, `sort_order`, `status`) VALUES
(1, 'Pубашки', 1, 1),
(2, 'Платья', 5, 1),
(3, 'Футболки', 3, 1),
(4, 'Майки', 4, 1),
(5, 'Сумки', 2, 1),
(6, 'Чемоданы', 6, 1),
(7, 'Брюки ', 7, 1),
(8, 'Пиджаки', 8, 1),
(9, 'Галстуки', 9, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `price` float NOT NULL,
  `availability` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `is_new` int(11) NOT NULL DEFAULT '0',
  `is_recommended` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `is_active` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `name`, `category_id`, `code`, `price`, `availability`, `brand`, `image`, `description`, `is_new`, `is_recommended`, `status`, `is_active`) VALUES
(1, 'Product 1', 1, 12555, 59, 1, 'Brand 1', '/upload/images/products/1.jpg', 'Description', 1, 1, 1, 0),
(2, 'Product 2', 2, 125585, 60, 1, 'Brand 2', '/upload/images/products/2.jpg', 'Description', 0, 0, 1, 1),
(3, 'Product 3', 1, 125585, 65, 1, 'Brand 2', '/upload/images/products/no-image.jpg\n', 'Description', 0, 1, 1, 0),
(4, 'Product 4', 5, 125585, 48, 1, 'Brand 3', '/upload/images/products/4.jpg', 'Description', 1, 1, 1, 1),
(5, 'Product 5', 1, 125585, 59, 1, 'Brand 1', '/upload/images/products/no-image.jpg', 'Description', 0, 1, 1, 0),
(6, 'Product 6', 3, 125585, 70, 1, 'Brand 3', '/upload/images/products/6.jpg', 'Description', 0, 0, 1, 0),
(7, 'Product 7', 4, 125585, 74, 1, 'Brand 4', '/upload/images/products/7.jpg', 'Description', 0, 0, 1, 0),
(8, 'Product 8', 6, 125585, 59, 1, 'Brand 4', '/upload/images/products/no-image.jpg', 'Description', 1, 0, 1, 0),
(9, 'Product 9', 7, 125585, 60, 1, 'Brand 3', '/upload/images/products/9.jpg', 'Description', 0, 0, 1, 1),
(10, 'Product 10', 8, 125585, 48, 1, 'Brand 1', '/upload/images/products/no-image.jpg', 'Description', 0, 0, 1, 0),
(11, 'Product 11', 1, 125585, 48, 1, 'Brand 4', '/upload/images/products/11.jpg', 'Description', 1, 0, 1, 0),
(12, 'Product 12', 1, 125585, 59, 1, 'Brand 2', '/upload/images/products/12.jpg', 'Description', 0, 0, 1, 0),
(13, 'Product 14', 1, 125585, 74, 1, 'Brand 3', '/upload/images/products/14.jpg', 'Description', 1, 0, 1, 0),
(14, 'Product 15', 1, 125585, 48, 1, 'Brand 3', '/upload/images/products/15.jpg', 'Description', 0, 0, 1, 0),
(15, 'Product 29', 1, 125585, 70, 1, 'Brand 4', '/upload/images/products/29.jpg', 'Description', 1, 0, 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `product_order`
--

CREATE TABLE `product_order` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_comment` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `products` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'Dmytro', 'dimaoag@gmail.com', '123456', 'admin'),
(2, 'user', 'dimaoa@mail.ru', '123456', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT для таблицы `product_order`
--
ALTER TABLE `product_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
