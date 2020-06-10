-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 04 2020 г., 14:05
-- Версия сервера: 5.5.53
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `My_bd`
--

-- --------------------------------------------------------

--
-- Структура таблицы `1`
--

CREATE TABLE `1` (
  `id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `1`
--

INSERT INTO `1` (`id`) VALUES
(1);

-- --------------------------------------------------------

--
-- Структура таблицы `ages`
--

CREATE TABLE `ages` (
  `id` int(11) NOT NULL,
  `age` varchar(50) NOT NULL,
  `text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ages`
--

INSERT INTO `ages` (`id`, `age`, `text`) VALUES
(1, '1 день', 'родился'),
(2, '14 дней', 'открылись ушки'),
(3, '16 дней', 'открылись глазки'),
(4, '4 недели', 'вас узнает'),
(5, '20 день', 'появляются первые зубки'),
(6, '1 месяц', 'уже ест. резцы и клыки уже есть'),
(7, '45 дней', 'актировка, можно продать'),
(8, '1,5 месяца', 'из щенка в молодняк'),
(9, '2 месяца', ''),
(10, '3 месяца', 'соревнования в классе \"Бэби\"'),
(11, '4 месяца', 'соревнования в классе \"Бэби\"'),
(12, '5 месяцев', 'соревнования в классе \"Бэби\"'),
(13, '6 месяцев ', 'соревнования в классе \"Бэби\"/\"Щенки\"'),
(14, '7 месяцев', 'соревнования в классе \"Щенки\"'),
(15, '8 месяцев', 'соревнования в классе \"Щенки\"'),
(16, '9 месяцев', 'соревнования в классе \"Щенки\"/\"Юниоры\"'),
(17, '1 год', 'соревнования в классе \"Юниоры\" КОБЕЛЬ может вязаться'),
(18, '1 год 3 месяца', 'соревнования в классе \"Юниоры\"/\"Промежуточный№/\"Открытый\" СУКА вяжется до 7.5 лет'),
(19, '1 год 4 месяца', 'соревнования в классе \"Юниоры\"/\"Промежуточный№/\"Открытый\"'),
(20, '1 год 5 месяцев', 'соревнования в классе \"Юниоры\"/\"Промежуточный№/\"Открытый\"'),
(21, '1 год 6 месяцев', 'соревнования в классе \"Юниоры\"/\"Промежуточный№/\"Открытый\"'),
(22, '1 год 9 месяцев', 'соревнования в классе \"Промежуточный№/\"Открытый\"'),
(23, '1 год 10 месяцев', 'соревнования в классе \"Промежуточный№/\"Открытый\"'),
(24, '2 года', 'соревнования в классе \"Промежуточный№/\"Открытый\"'),
(25, '2 года 1 месяц', 'соревнования в классе \"Открытый\"'),
(26, '2 года 2 месяца', 'соревнования в классе \"Открытый\"'),
(27, '2 года 4 месяца', 'соревнования в классе \"Открытый\"'),
(28, '2 года 6 месяцев ', 'соревнования в классе \"Открытый\"'),
(29, '2 года 8 месяцев', 'соревнования в классе \"Открытый\"'),
(30, '2 года 10 месяцев', 'соревнования в классе \"Открытый\"'),
(31, '3 года', 'соревнования в классе \"Открытый\"'),
(32, '3 года 2 месяца', 'соревнования в классе \"Открытый\"'),
(33, '3 года 4 месяца', 'соревнования в классе \"Открытый\"'),
(34, '3 года 6 месяцев', 'соревнования в классе \"Открытый\"'),
(35, '3 года 8 месяцев', 'соревнования в классе \"Открытый\"'),
(36, '3 года 10 месяцев', 'соревнования в классе \"Открытый\"'),
(37, '4 года', 'соревнования в классе \"Открытый\"'),
(38, '4 года 2 месяца', 'соревнования в классе \"Открытый\"'),
(39, '4 года 4 месяца', 'соревнования в классе \"Открытый\"'),
(40, '4 года 6 месяцев', 'соревнования в классе \"Открытый\"'),
(41, '4 года 8 месяцев', 'соревнования в классе \"Открытый\"'),
(42, '4 года 10 месяцев', 'соревнования в классе \"Открытый\"'),
(43, '5 лет', 'соревнования в классе \"Открытый\"'),
(44, '5 лет 2 месяца', 'соревнования в классе \"Открытый\"'),
(45, '5 лет 4 месяца', 'соревнования в классе \"Открытый\"'),
(46, '5 лет 6 месяцев', 'соревнования в классе \"Открытый\"'),
(47, '5 лет 8 месяцев', 'соревнования в классе \"Открытый\"'),
(48, '5 лет 10 месяцев', 'соревнования в классе \"Открытый\"'),
(49, '6 лет', 'соревнования в классе \"Открытый\"'),
(50, '6 лет 2 месяца', 'соревнования в классе \"Открытый\"'),
(51, '6 лет 4 месяца', 'соревнования в классе \"Открытый\"'),
(52, '6 лет 6 месяцев', 'соревнования в классе \"Открытый\"'),
(53, '6 лет 8 месяцев', 'соревнования в классе \"Открытый\"'),
(54, '6 лет 10 месяцев', 'соревнования в классе \"Открытый\"'),
(55, '7 лет', 'соревнования в классе \"Открытый\"'),
(56, '7 лет 2 месяца', 'соревнования в классе \"Открытый\"'),
(57, '7 лет 4 месяца', 'соревнования в классе \"Открытый\"'),
(58, '7 лет 6 месяцев', 'соревнования в классе \"Открытый\" ЗАКРЫТЫ вязки для суки'),
(59, '7 лет 8 месяцев', 'соревнования в классе \"Открытый\"'),
(60, '7 лет 10 месяцев', 'соревнования в классе \"Открытый\"'),
(61, '8 лет', 'соревнования в классе \"Ветераны\"'),
(62, '8 лет 2 месяца', 'соревнования в классе \"Ветераны\"'),
(63, '8 лет 4 месяца', 'соревнования в классе \"Ветераны\"'),
(64, '8 лет 6 месяцев', 'соревнования в классе \"Ветераны\"'),
(65, '8 лет 8 месяцев', 'соревнования в классе \"Ветераны\"'),
(66, '8 лет 10 месяцев', 'соревнования в классе \"Ветераны\"'),
(67, '9 лет', 'соревнования в классе \"Ветераны\"'),
(68, '9 лет 2 месяца', 'соревнования в классе \"Ветераны\"'),
(69, '9 лет 4 месяца', 'соревнования в классе \"Ветераны\"'),
(70, '9 лет 6 месяцев', 'соревнования в классе \"Ветераны\"'),
(71, '9 лет 8 месяцев', 'соревнования в классе \"Ветераны\"'),
(72, '9 лет 10 месяцев', 'соревнования в классе \"Ветераны\"'),
(73, '10 лет', 'соревнования в классе \"Ветераны\"');

-- --------------------------------------------------------

--
-- Структура таблицы `animals`
--

CREATE TABLE `animals` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT 'без имени',
  `race` varchar(100) NOT NULL,
  `origin` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'происхождение РКФ',
  `breeder` varchar(100) NOT NULL COMMENT 'заводчик',
  `owner` varchar(100) NOT NULL COMMENT 'владелец',
  `kennel` varchar(255) NOT NULL,
  `estrus` int(10) NOT NULL COMMENT 'течка у сук',
  `reg_id` int(11) NOT NULL COMMENT 'ссылка на помет',
  `age_id` int(50) NOT NULL DEFAULT '1' COMMENT 'ссылка на возраст',
  `dna_id` int(11) NOT NULL COMMENT 'ссылка на днк',
  `family_id` int(11) NOT NULL COMMENT 'ссылка на семью',
  `mark_id` int(11) NOT NULL COMMENT 'ссылка на оценку',
  `weight` int(11) NOT NULL COMMENT 'вес собаки',
  `height` int(11) NOT NULL COMMENT 'рост собаки',
  `vitality` int(11) NOT NULL DEFAULT '100',
  `hp` int(11) DEFAULT '100',
  `joy` int(11) NOT NULL DEFAULT '100',
  `birth` varchar(100) NOT NULL DEFAULT '00.00.0000',
  `now` int(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `puppy` int(11) NOT NULL DEFAULT '0',
  `litter` int(11) NOT NULL DEFAULT '0',
  `url` varchar(255) NOT NULL COMMENT 'путь к картинке собаки',
  `url_puppy` varchar(255) NOT NULL COMMENT 'путь к ссылке щенка'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `animals`
--

INSERT INTO `animals` (`id`, `name`, `race`, `origin`, `breeder`, `owner`, `kennel`, `estrus`, `reg_id`, `age_id`, `dna_id`, `family_id`, `mark_id`, `weight`, `height`, `vitality`, `hp`, `joy`, `birth`, `now`, `status`, `puppy`, `litter`, `url`, `url_puppy`) VALUES
(1, 'Шоко', 'Китайская хохлатая собака', 0, 'nesh', 'nesh', 'Чарующий соблазн', 14, 0, 14, 11, 1, 2, 3830, 25, 100, 1, 4, '15.09.2017', 1380, 1, 2, 2, 'pici/TT/hr1w0f0b0t1m0_01.png', 'pici/puppy/hr1b0_02.png'),
(2, 'Маленькая', 'Китайская хохлатая собака', 1, 'nesh', 'nesh', 'Чарующий соблазн', 15, 0, 15, 12, 2, 2, 3973, 26, -2, 90, 100, '17.09.2017', 0, 1, 3, 3, 'pici/hr1w0f1b0t0m0_04.png', 'pici/puppy/hr1f1_01.png'),
(3, '3шоколадкин', 'Китайская хохлатая собака', 0, 'nesh', 'nesh', 'Чарующий соблазн', 0, 0, 16, 13, 3, 2, 4547, 30, 100, 100, 100, '17.09.2017', 0, 1, 1, 1, 'pici/hr1w0f0b0t0m0_05.png', 'pici/puppy/hr1b0_01.png'),
(4, '4 кобель', 'Китайская хохлатая собака', 1, 'nesh', 'nesh', 'Чарующий соблазн', 0, 1, 1, 14, 4, 0, 4547, 30, 100, 100, 100, '17.09.2017', 0, 1, 0, 0, 'pici/hrhr/hr0w0f0b0t0m0_01.png', 'pici/puppy/hr0b0_01.png'),
(5, '5он', 'Китайская хохлатая собака', 0, 'nesh', 'nesh', 'Чарующий соблазн', 0, 0, 14, 15, 5, 0, 4547, 30, 100, 100, 100, '17.09.2017', 0, 1, 1, 1, 'pici/hr1w0f0b0t0m0_03.png', 'pici/puppy/hr1b0_02.png'),
(6, 'шестой пух', 'Китайская хохлатая собака', 1, 'nesh', 'nesh', 'Чарующий соблазн', 0, 2, 17, 16, 6, 2, 0, 0, 100, 100, 100, '10.01.2018', 0, 1, 2, 2, 'pici/hrhr/hr0w0f0b0t0m0_01.png', 'pici/puppy/hr0b0_01.png'),
(7, 'Семь', 'Китайская хохлатая собака', 1, 'nesh', 'nesh', 'Чарующий соблазн', 0, 3, 1, 17, 7, 0, 0, 0, 100, 100, 100, '10.01.2018', 0, 1, 0, 0, 'pici/hr1w0f0b0t0m0_05.png', 'pici/puppy/hr1b0_01.png'),
(8, 'Зяма', 'Китайская хохлатая собака', 1, 'nesh', 'nesh', 'Чарующий соблазн', 0, 4, 14, 18, 9, 0, 0, 0, 100, 100, 100, '22.11.2018', 0, 1, 0, 0, 'pici/hrhr/hr0w0f0b0t0m0_01.png', 'pici/puppy/hr0b0_03.png'),
(9, 'Новый Мальчик', 'Китайская хохлатая собака', 1, 'nesh', 'nesh', 'Чарующий соблазн', 0, 0, 18, 19, 10, 2, 0, 0, 100, 100, 100, '28.01.2019', 0, 1, 0, 0, 'pici/hr1w0f1b0t0m0_04.png', 'pici/puppy/hr1f1_03.png');

-- --------------------------------------------------------

--
-- Структура таблицы `characteristics`
--

CREATE TABLE `characteristics` (
  `id` int(11) NOT NULL,
  `dog_id` int(11) NOT NULL,
  `charact_ru` varchar(100) NOT NULL COMMENT 'характеристика',
  `charact_en` varchar(100) NOT NULL COMMENT 'характер англ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `characteristics`
--

INSERT INTO `characteristics` (`id`, `dog_id`, `charact_ru`, `charact_en`) VALUES
(0, 0, 'веселый', 'happy'),
(0, 0, 'обжора', 'gluttonous'),
(0, 0, 'ласковый', 'tender'),
(0, 0, 'лежебока', 'lazy');

-- --------------------------------------------------------

--
-- Структура таблицы `dna_agt`
--

CREATE TABLE `dna_agt` (
  `id` int(11) NOT NULL COMMENT 'индекс',
  `a` varchar(4) NOT NULL COMMENT 'Локус А',
  `b` varchar(4) NOT NULL COMMENT 'Локус B',
  `c` varchar(4) NOT NULL COMMENT 'Локус C',
  `d` varchar(4) NOT NULL COMMENT 'Локус D',
  `p` varchar(4) NOT NULL COMMENT 'Локус P',
  `m` varchar(4) NOT NULL COMMENT 'Локус M',
  `t` varchar(4) NOT NULL COMMENT 'Локус T',
  `sex` varchar(2) NOT NULL COMMENT 'пол 0сука 1 кобель'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `dna_agt`
--

INSERT INTO `dna_agt` (`id`, `a`, `b`, `c`, `d`, `p`, `m`, `t`, `sex`) VALUES
(1, 'Aa', 'bb', 'CC', 'dd', 'pp', 'mm', 'tt', '0'),
(2, 'aa', 'Bb', 'CC', 'dd', 'Pp', 'mm', 'tt', '1');

-- --------------------------------------------------------

--
-- Структура таблицы `family`
--

CREATE TABLE `family` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mum` int(11) DEFAULT '0',
  `dad` int(11) NOT NULL DEFAULT '0',
  `g1dad` int(11) NOT NULL DEFAULT '0',
  `g1mum` int(11) NOT NULL DEFAULT '0',
  `g0dad` int(11) NOT NULL DEFAULT '0',
  `g0mum` int(11) NOT NULL DEFAULT '0',
  `gg1dad1` int(11) NOT NULL DEFAULT '0',
  `gg1mum2` int(11) NOT NULL DEFAULT '0',
  `gg1dad3` int(11) NOT NULL DEFAULT '0',
  `gg1mum4` int(11) NOT NULL DEFAULT '0',
  `gg0dad1` int(11) NOT NULL DEFAULT '0',
  `gg0mum2` int(11) NOT NULL DEFAULT '0',
  `gg0dad3` int(11) NOT NULL DEFAULT '0',
  `gg0mum4` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `family`
--

INSERT INTO `family` (`id`, `mum`, `dad`, `g1dad`, `g1mum`, `g0dad`, `g0mum`, `gg1dad1`, `gg1mum2`, `gg1dad3`, `gg1mum4`, `gg0dad1`, `gg0mum2`, `gg0dad3`, `gg0mum4`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 1, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 2, 6, 5, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 1, 6, 5, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(10, 2, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `female`
--

CREATE TABLE `female` (
  `wt` int(11) NOT NULL COMMENT 'вес суки',
  `ht` int(11) NOT NULL COMMENT 'рост суки'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `female`
--

INSERT INTO `female` (`wt`, `ht`) VALUES
(3544, 23),
(3687, 24),
(3830, 25),
(3973, 26),
(4116, 27),
(4259, 28),
(4402, 29),
(4545, 30);

-- --------------------------------------------------------

--
-- Структура таблицы `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `icons` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `items`
--

INSERT INTO `items` (`id`, `name`, `icons`) VALUES
(1, 'coins', '/pic/coins_mini.png'),
(2, 'logo', '/Pic/logo_mini.png'),
(3, 'food', '/Pic/food_mini.png'),
(4, 'water', '/Pic/water.png'),
(5, 'badd', '/Pic/badd_mini.png\r\n'),
(6, 'comp', '/Pic/comp.png'),
(7, 'walk', '/Pic/walk.png'),
(8, 'zzz', '/Pic/zzz.png'),
(9, 'up', '/Pic/up.png');

-- --------------------------------------------------------

--
-- Структура таблицы `kennels`
--

CREATE TABLE `kennels` (
  `id` int(11) NOT NULL,
  `name_k` varchar(20) NOT NULL,
  `owner_k` varchar(155) NOT NULL,
  `date` varchar(100) NOT NULL DEFAULT '00.00.0000',
  `dogs` int(11) NOT NULL,
  `l_litter` varchar(11) NOT NULL,
  `email` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `kennels`
--

INSERT INTO `kennels` (`id`, `name_k`, `owner_k`, `date`, `dogs`, `l_litter`, `email`) VALUES
(29, 'Чарующий соблазн', 'nesh', '02.09.2017', 2, 'E', 'stepanova@mail.ru'),
(30, 'Тестики', 'test', '03.09.2017', 2, 'A', 'test@test');

-- --------------------------------------------------------

--
-- Структура таблицы `litters`
--

CREATE TABLE `litters` (
  `id` int(11) NOT NULL,
  `litters` varchar(25) NOT NULL,
  `date` date NOT NULL COMMENT 'дата вязки',
  `stigma` varchar(25) NOT NULL COMMENT 'буква помета',
  `inspecttt` int(11) NOT NULL COMMENT 'осмотренно',
  `cull` int(11) NOT NULL COMMENT 'отбраковано',
  `reexamination` int(11) NOT NULL COMMENT 'пересмотрт',
  `mum` int(11) NOT NULL COMMENT 'мать',
  `dad` int(11) NOT NULL COMMENT 'отец',
  `puppy1` int(11) NOT NULL,
  `puppy2` int(11) NOT NULL,
  `puppy3` int(11) NOT NULL,
  `puppy4` int(11) NOT NULL,
  `puppy5` int(11) NOT NULL,
  `puppy6` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `male`
--

CREATE TABLE `male` (
  `wt` int(11) NOT NULL COMMENT 'вес кобеля',
  `ht` int(11) NOT NULL COMMENT 'рост кобеля'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `male`
--

INSERT INTO `male` (`wt`, `ht`) VALUES
(4245, 28),
(4396, 29),
(4547, 30),
(4698, 31),
(4849, 32),
(5000, 33);

-- --------------------------------------------------------

--
-- Структура таблицы `marks`
--

CREATE TABLE `marks` (
  `id` int(11) NOT NULL,
  `mark` varchar(35) NOT NULL,
  `namerus` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `marks`
--

INSERT INTO `marks` (`id`, `mark`, `namerus`) VALUES
(1, 'excellent', 'отлично '),
(2, 'very good', 'очень хорошо'),
(3, 'good', 'хорошо'),
(4, 'satisfactory', 'удовлетворительно '),
(5, 'out of the ring', 'снят с ринга '),
(6, 'disqualification', 'дисквалифицирующий порок ');

-- --------------------------------------------------------

--
-- Структура таблицы `owner_items`
--

CREATE TABLE `owner_items` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `count` int(20) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `owner_items`
--

INSERT INTO `owner_items` (`id`, `owner_id`, `item_id`, `count`) VALUES
(1, 1, 1, 1320000);

-- --------------------------------------------------------

--
-- Структура таблицы `races`
--

CREATE TABLE `races` (
  `id` int(20) NOT NULL,
  `name_race` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `races`
--

INSERT INTO `races` (`id`, `name_race`) VALUES
(0, 'АГТ'),
(4, 'дог'),
(1, 'КХС'),
(3, 'пудель'),
(2, 'шпиц');

-- --------------------------------------------------------

--
-- Структура таблицы `randodna`
--

CREATE TABLE `randodna` (
  `id` int(11) NOT NULL,
  `hr` varchar(4) NOT NULL COMMENT 'гол/пух',
  `ww` varchar(3) NOT NULL COMMENT 'белый',
  `ff` varchar(3) NOT NULL COMMENT 'рыжий',
  `bb` varchar(3) NOT NULL COMMENT 'черн/шоко',
  `tt` varchar(3) NOT NULL COMMENT 'крап',
  `mm` varchar(3) NOT NULL COMMENT 'пятна',
  `sex` varchar(10) NOT NULL COMMENT '0-сука/1-кобель',
  `lucky` int(11) NOT NULL COMMENT 'удача',
  `spd` float NOT NULL COMMENT 'скорость',
  `agl` float NOT NULL COMMENT 'уворот',
  `tch` float NOT NULL COMMENT 'обучение',
  `jmp` float NOT NULL COMMENT 'прыжки',
  `nuh` float NOT NULL COMMENT 'обоняние',
  `fnd` float NOT NULL COMMENT 'поиск',
  `mut` int(11) NOT NULL COMMENT 'мутации',
  `dna` varchar(255) NOT NULL COMMENT 'генетический код',
  `about` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `randodna`
--

INSERT INTO `randodna` (`id`, `hr`, `ww`, `ff`, `bb`, `tt`, `mm`, `sex`, `lucky`, `spd`, `agl`, `tch`, `jmp`, `nuh`, `fnd`, `mut`, `dna`, `about`) VALUES
(1, 'hrhr', 'Ww', 'Ff', 'Bb', 'tt', 'Mm', '1', 13, 11, 10, 11, 9, 10, 10, 17, 'hr0w1f0b1t0m0', 'shop'),
(2, '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(3, '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(4, '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(5, '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(6, '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(7, '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(8, '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(9, '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(10, '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
(11, 'Hrhr', 'ww', 'ff', 'bb', 'Tt', 'mm', '0', 12, 10, 10, 9, 9, 9, 11, 0, 'hr1w0f0b0t1m0', 'owner'),
(12, 'Hrhr', 'ww', 'Ff', 'bb', 'tt', 'mm', '0', 13, 11, 11, 11, 9, 9, 8, 0, 'hr1w0f1b0t0m0', 'owner'),
(13, 'Hrhr', 'ww', 'ff', 'bb', 'tt', 'mm', '1', 15, 11, 11, 11, 11, 11, 9, 0, 'hr1w0f0b0t0m0', 'owner'),
(14, 'hrhr', 'ww', 'ff', 'bb', 'tt', 'mm', '1', 12, 11.6, 11.6, 11.6, 9.05, 10.6, 9.05, 1, 'hr0w0f0b0t0m0', 'owner'),
(15, 'Hrhr', 'ww', 'ff', 'bb', 'tt', 'mm', '1', 75, 10, 9, 11, 11, 11, 10, 0, 'hr1w0f0b0t0m0', 'owner'),
(16, 'hrhr', 'ww', 'ff', 'bb', 'tt', 'mm', '1', 27, 10.55, 10.05, 11.05, 10.05, 10.55, 9.55, 0, 'hr0w0f0b0t0m0', 'owner'),
(17, 'Hrhr', 'ww', 'ff', 'bb', 'tt', 'mm', '1', 13, 10.87, 10.62, 11.12, 9.61, 10.37, 9.36, 1, 'hr1w0f0b0t0m0', 'owner'),
(18, 'hrhr', 'ww', 'ff', 'bb', 'Tt', 'mm', '1', 74, 10.25, 10, 10, 9.5, 9.75, 10.25, 0, 'hr0w0f0b0t1m0', 'owner'),
(19, 'Hrhr', 'ww', 'Ff', 'bb', 'tt', 'mm', '1', 97, 10.42, 9.92, 10.91, 9.92, 9.92, 8.93, 1, 'hr1w0f1b0t0m0', 'owner');

-- --------------------------------------------------------

--
-- Структура таблицы `registry`
--

CREATE TABLE `registry` (
  `id` int(11) NOT NULL,
  `lit` varchar(5) NOT NULL COMMENT 'Буква помета',
  `date` date NOT NULL COMMENT 'дата вязки',
  `mum` int(11) NOT NULL COMMENT 'id мамы',
  `dad` int(11) NOT NULL COMMENT 'id папы',
  `datebirth` varchar(10) NOT NULL COMMENT 'сколько носила 55-70',
  `count` int(11) NOT NULL COMMENT 'родилось',
  `count45` int(11) NOT NULL COMMENT 'выращено до 45 дней',
  `female` int(11) NOT NULL COMMENT 'кол-во сук',
  `male` int(11) NOT NULL COMMENT 'кол-во кобелей',
  `tatoo` int(11) NOT NULL COMMENT '№ клейма'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `registry`
--

INSERT INTO `registry` (`id`, `lit`, `date`, `mum`, `dad`, `datebirth`, `count`, `count45`, `female`, `male`, `tatoo`) VALUES
(1, 'a', '2017-09-17', 2, 3, '55', 1, 1, 0, 1, 0),
(2, 'b', '2018-01-10', 1, 5, '60', 1, 1, 0, 1, 0),
(3, 'c', '2018-01-07', 2, 6, '55', 1, 1, 0, 1, 0),
(4, 'd', '2018-11-22', 1, 6, '57', 1, 1, 0, 1, 0),
(5, 'e', '0000-00-00', 1, 5, '67', 2, 2, 0, 2, 0),
(6, 'f', '2019-04-28', 1, 5, '57', 3, 3, 2, 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `login` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kennel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f_time` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '00.00.0000',
  `l_time` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '00.00.0000',
  `online` tinyint(1) NOT NULL,
  `sign` int(6) NOT NULL,
  `visits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `password`, `kennel`, `f_time`, `l_time`, `online`, `sign`, `visits`) VALUES
(1, 'nesh', 'stepanova@mail.ru', '$2y$10$pinvDspcODn0zxHMfyEUoufayxxNfwrQoqHGX2.Ky1I.fB7FnDan.', 'Чарующий соблазн', '03.09.2017', '29.05.2020', 1, 0, 158),
(2, 'test', 'test@test', '$2y$10$Vy0Am7CkZj5SYrzoNR26W.XsiO21HWtuQezqns20CfpcqAqdlm7D.', 'Тестики', '04.09.2017', '10.09.2017', 0, 0, 4);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `1`
--
ALTER TABLE `1`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ages`
--
ALTER TABLE `ages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `race` (`race`),
  ADD KEY `breeder` (`breeder`),
  ADD KEY `owner` (`owner`);

--
-- Индексы таблицы `dna_agt`
--
ALTER TABLE `dna_agt`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `family`
--
ALTER TABLE `family`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `kennels`
--
ALTER TABLE `kennels`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `litters`
--
ALTER TABLE `litters`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `owner_items`
--
ALTER TABLE `owner_items`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `races`
--
ALTER TABLE `races`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `name_race` (`name_race`);

--
-- Индексы таблицы `randodna`
--
ALTER TABLE `randodna`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `registry`
--
ALTER TABLE `registry`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `1`
--
ALTER TABLE `1`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `ages`
--
ALTER TABLE `ages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT для таблицы `animals`
--
ALTER TABLE `animals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `dna_agt`
--
ALTER TABLE `dna_agt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'индекс', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `family`
--
ALTER TABLE `family`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `kennels`
--
ALTER TABLE `kennels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT для таблицы `litters`
--
ALTER TABLE `litters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `marks`
--
ALTER TABLE `marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `owner_items`
--
ALTER TABLE `owner_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `randodna`
--
ALTER TABLE `randodna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT для таблицы `registry`
--
ALTER TABLE `registry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;