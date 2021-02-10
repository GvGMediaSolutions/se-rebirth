CREATE TABLE IF NOT EXISTS `account_images` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `type` varchar(25) NOT NULL DEFAULT '',
  `data` mediumblob NOT NULL,
  `account_id` int(8) NOT NULL,
  PRIMARY KEY (`id`)
)
