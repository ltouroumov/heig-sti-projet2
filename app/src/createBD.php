<?php

include('db_connect.php');

echo "Creating data base...\n";

//Delete des tables
$sql = "DROP TABLE IF EXISTS `mail_client`;";
$req = $bdd->exec($sql);

$sql = "DROP TABLE IF EXISTS `mail_user`;";
$req = $bdd->exec($sql);

// Création des tables:
//----------------------------------------------------------------------------------------
$sql = "CREATE TABLE IF NOT EXISTS `mail_client` (
  `mail_id` INT(11) NOT NULL,
  `to_id` INT(11) NOT NULL,
  `from_id` INT(11) NOT NULL,
  `sent_date` DATE NOT NULL,
  `subject` VARCHAR(255) NOT NULL,
  `content` TEXT NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;";
$req = $bdd->exec($sql);

$sql = "CREATE TABLE IF NOT EXISTS `mail_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_pwd` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `user_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
$req = $bdd->exec($sql);
    
$sql = "ALTER TABLE `mail_client` ADD PRIMARY KEY (`mail_id`);";
$req = $bdd->exec($sql);

$sql = "ALTER TABLE `mail_user` ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `user_name` (`user_name`);";
$req = $bdd->exec($sql);

$sql = "ALTER TABLE `mail_client` MODIFY `mail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;";
$req = $bdd->exec($sql);

$sql = "ALTER TABLE `mail_user` MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;";
$req = $bdd->exec($sql);
//----------------------------------------------------------------------------------------
// Peuplement de la base de donnée
//----------------------------------------------------------------------------------------

$user_name = "mike";
$user_pwd = "1234";
$user_role = "User";
$user_status = 1;

$req = $bdd->prepare('INSERT INTO mail_user (user_name, user_pwd, user_role, user_status) VALUES (?, ?, ?, ?)');
$req->execute(array($user_name, $user_pwd, $user_role, $user_status));


$user_name = "sam";
$user_pwd = "4321";
$user_role = "Admin";
$user_status = 1;

$req = $bdd->prepare('INSERT INTO mail_user (user_name, user_pwd, user_role, user_status) VALUES (?, ?, ?, ?)');
$req->execute(array($user_name, $user_pwd, $user_role, $user_status));


$to_id = 1;
$from_id = 2;
$sent_date = '2010-04-02 15:28:22';
$subject = "Hello";
$content = "Salut comment tu vas ?";

$req = $bdd->prepare('INSERT INTO mail_client (to_id, from_id, sent_date, subject, content) VALUES (?, ?, ?, ?, ?)');
$req->execute(array($to_id, $from_id, $sent_date, $subject, $content));

$to_id = 1;
$from_id = 2;
$sent_date = '2010-04-02 15:28:50';
$subject = "Mais Hello !";
$content = "Salut comment tu vas ? Mais bien bien écoute !";

$req = $bdd->prepare('INSERT INTO mail_client (to_id, from_id, sent_date, subject, content) VALUES (?, ?, ?, ?, ?)');
$req->execute(array($to_id, $from_id, $sent_date, $subject, $content));
//----------------------------------------------------------------------------------------

echo "Database created !\n";

?>
