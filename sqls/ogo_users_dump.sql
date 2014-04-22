-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Фев 19 2014 г., 17:16
-- Версия сервера: 5.1.73
-- Версия PHP: 5.3.3-7+squeeze18

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `ogoBase`
--

-- --------------------------------------------------------

--
-- Структура таблицы `ogo_users`
--

CREATE TABLE IF NOT EXISTS `ogo_users` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `flogin` varchar(16) NOT NULL,
  `fpassword` varchar(32) NOT NULL,
  `fname` varchar(32) NOT NULL,
  `fgroup` varchar(16) NOT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Таблица пользователей' AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `ogo_users`
--

INSERT INTO `ogo_users` (`fid`, `flogin`, `fpassword`, `fname`, `fgroup`) VALUES
(1, 'admin', '4297f44b13955235245b2497399d7a93', 'Владимир', 'администраторы');
