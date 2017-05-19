-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Май 19 2017 г., 10:44
-- Версия сервера: 10.1.9-MariaDB
-- Версия PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `school`
--

-- --------------------------------------------------------

--
-- Структура таблицы `classes`
--

CREATE TABLE `classes` (
  `id` int(3) UNSIGNED NOT NULL,
  `name` varchar(3) NOT NULL,
  `teacher_name` varchar(65) NOT NULL,
  `av_mark` float UNSIGNED DEFAULT '0',
  `students_count` int(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `classes`
--

INSERT INTO `classes` (`id`, `name`, `teacher_name`, `av_mark`, `students_count`) VALUES
(0, '11А', 'James Bond', 3.5, 4),
(1, '10Б', 'Дональд Дак', 4, 3),
(2, '11Г', 'Mickey Mouse', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE `students` (
  `id` int(3) UNSIGNED NOT NULL,
  `student_name` varchar(65) NOT NULL,
  `class_id` varchar(3) NOT NULL,
  `mark` int(1) UNSIGNED NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`id`, `student_name`, `class_id`, `mark`, `start_date`, `end_date`) VALUES
(1, 'Маша', '10Б', 3, '2017-05-01', '0000-00-00'),
(2, 'Саша', '10Б', 5, '0000-00-00', '2017-05-05'),
(3, 'Паша', '11А', 4, '2017-04-03', '0000-00-00'),
(4, 'Вася', '11А', 3, '2017-04-10', '0000-00-00'),
(25, 'Катя', '11А', 2, '2017-05-12', '0000-00-00'),
(26, 'Коля', '11А', 5, '0000-00-00', '2017-05-10');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
