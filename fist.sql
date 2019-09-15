-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.6.41-log - MySQL Community Server (GPL)
-- Операционная система:         Win64
-- HeidiSQL Версия:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных mysqltest
CREATE DATABASE IF NOT EXISTS `mysqltest` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `mysqltest`;

-- Дамп структуры для таблица mysqltest.messages
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `room_id` int(10) NOT NULL DEFAULT '1',
  `message` text,
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_messages_user` (`user_id`),
  KEY `Индекс 3` (`room_id`),
  CONSTRAINT `FK_messages_room` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`),
  CONSTRAINT `FK_messages_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=576 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы mysqltest.messages: ~7 rows (приблизительно)
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` (`id`, `user_id`, `room_id`, `message`, `add_time`) VALUES
	(567, 24, 1, 'ты дно я знал это', '2019-09-04 22:04:42'),
	(568, 24, 1, '35464\r\n', '2019-09-04 23:38:00'),
	(569, 24, 1, '3213', '2019-09-05 00:46:42'),
	(570, 24, 1, '321321', '2019-09-05 00:56:45'),
	(571, 24, 1, '09780890', '2019-09-05 00:56:55'),
	(572, 24, 1, '31231', '2019-09-05 00:57:08'),
	(573, 24, 1, '[f[f', '2019-09-05 01:44:03'),
	(574, 1, 7, 'sasay', '2019-09-07 13:40:05'),
	(575, 24, 7, 'бан сука', '2019-09-07 13:40:29');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;

-- Дамп структуры для таблица mysqltest.permission_room
CREATE TABLE IF NOT EXISTS `permission_room` (
  `user_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  KEY `FK_permission_room_user` (`user_id`),
  KEY `FK_permission_room_room` (`room_id`),
  CONSTRAINT `FK_permission_room_room` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`),
  CONSTRAINT `FK_permission_room_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы mysqltest.permission_room: ~8 rows (приблизительно)
/*!40000 ALTER TABLE `permission_room` DISABLE KEYS */;
INSERT INTO `permission_room` (`user_id`, `room_id`) VALUES
	(1, 1),
	(24, 1),
	(24, 2),
	(24, 3),
	(24, 7),
	(24, 5),
	(24, 6),
	(1, 7),
	(1, 6);
/*!40000 ALTER TABLE `permission_room` ENABLE KEYS */;

-- Дамп структуры для таблица mysqltest.privilege
CREATE TABLE IF NOT EXISTS `privilege` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы mysqltest.privilege: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `privilege` DISABLE KEYS */;
INSERT INTO `privilege` (`id`, `name`) VALUES
	(1, 'deleted_message'),
	(2, 'deleted'),
	(3, 'edit_message');
/*!40000 ALTER TABLE `privilege` ENABLE KEYS */;

-- Дамп структуры для таблица mysqltest.privilege_roles
CREATE TABLE IF NOT EXISTS `privilege_roles` (
  `roles_id` int(10) NOT NULL,
  `privilege_id` int(10) NOT NULL,
  KEY `priv` (`privilege_id`),
  KEY `id_roles` (`roles_id`),
  CONSTRAINT `id_roles` FOREIGN KEY (`roles_id`) REFERENCES `user` (`rol_id`),
  CONSTRAINT `priv` FOREIGN KEY (`privilege_id`) REFERENCES `privilege` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы mysqltest.privilege_roles: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `privilege_roles` DISABLE KEYS */;
INSERT INTO `privilege_roles` (`roles_id`, `privilege_id`) VALUES
	(1, 1),
	(3, 2),
	(1, 3);
/*!40000 ALTER TABLE `privilege_roles` ENABLE KEYS */;

-- Дамп структуры для таблица mysqltest.room
CREATE TABLE IF NOT EXISTS `room` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name_room` varchar(50) DEFAULT '0',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `Индекс 2` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы mysqltest.room: ~6 rows (приблизительно)
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
INSERT INTO `room` (`id`, `name_room`, `create_time`) VALUES
	(1, 'Основной', '2019-08-25 18:49:42'),
	(2, 'Флудилка', '2019-08-25 18:52:26'),
	(3, 'Модерка', '2019-08-25 14:30:08'),
	(4, 'пвп или зассал', '2019-08-25 18:53:13'),
	(5, 'Важное', '2019-09-07 00:24:48'),
	(6, 'Политика', '2019-09-07 00:25:22'),
	(7, '+18', '2019-09-07 00:25:37');
/*!40000 ALTER TABLE `room` ENABLE KEYS */;

-- Дамп структуры для таблица mysqltest.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '0',
  `rol_id` int(10) NOT NULL DEFAULT '3',
  `password` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `Индекс 2` (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы mysqltest.user: ~12 rows (приблизительно)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `name`, `rol_id`, `password`) VALUES
	(1, '111', 3, 'f6e0a1e2ac41945a9aa7ff8a8aaa0cebc12a3bcc981a929ad5cf810a090e11ae'),
	(24, 'Admin', 1, '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918'),
	(26, '222', 3, '9b871512327c09ce91dd649b3f96a63b7408ef267c8cc5710114e629730cb61f'),
	(27, 'Вася', 3, 'f6e0a1e2ac41945a9aa7ff8a8aaa0cebc12a3bcc981a929ad5cf810a090e11ae'),
	(28, 'Инна', 3, 'f6e0a1e2ac41945a9aa7ff8a8aaa0cebc12a3bcc981a929ad5cf810a090e11ae'),
	(29, 'Nagibator2010', 3, 'f6e0a1e2ac41945a9aa7ff8a8aaa0cebc12a3bcc981a929ad5cf810a090e11ae'),
	(30, 'Alexxx111', 3, 'f6e0a1e2ac41945a9aa7ff8a8aaa0cebc12a3bcc981a929ad5cf810a090e11ae'),
	(31, 'qwqw', 3, '282a9a2d4e9b273f6874000a93d030aefc1c622a128be6a9c4c254e494be721c'),
	(32, 'qwqw', 3, '282a9a2d4e9b273f6874000a93d030aefc1c622a128be6a9c4c254e494be721c'),
	(33, 'ПЭтро', 3, 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
	(34, 'Вася Пупкин', 3, 'f6e0a1e2ac41945a9aa7ff8a8aaa0cebc12a3bcc981a929ad5cf810a090e11ae'),
	(35, 'Вася1', 3, 'f6e0a1e2ac41945a9aa7ff8a8aaa0cebc12a3bcc981a929ad5cf810a090e11ae'),
	(36, 'Vasya', 3, 'f6e0a1e2ac41945a9aa7ff8a8aaa0cebc12a3bcc981a929ad5cf810a090e11ae');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
