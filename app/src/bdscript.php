<?php

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=webmail;charset=utf8', 'root', 'root',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

echo "Hello =)";

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


?>