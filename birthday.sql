ALTER TABLE `clients` ADD `birthday` DATETIME NULL AFTER `address`;
INSERT INTO `menu` (`id`, `parent_id`, `title`, `handler`) VALUES (NULL, '5', 'Дни рождения', 'templates/viewBirthdays.php');
