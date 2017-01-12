DROP TABLE IF EXISTS `mail_client`;
DROP TABLE IF EXISTS `mail_user`;

CREATE TABLE IF NOT EXISTS `mail_client` (
  `mail_id` INT(11) NOT NULL,
  `to_id` INT(11) NOT NULL,
  `from_id` INT(11) NOT NULL,
  `sent_date` DATE NOT NULL,
  `subject` VARCHAR(255) NOT NULL,
  `content` TEXT NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `mail_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_pwd` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `user_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `mail_client` ADD PRIMARY KEY (`mail_id`);
ALTER TABLE `mail_user` ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `user_name` (`user_name`);

ALTER TABLE `mail_client` MODIFY `mail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE `mail_user` MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

INSERT INTO mail_user(user_name, user_pwd, user_role, user_status)
VALUES ("admin", "admin", "ROLE_ADMIN", 1);