<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('db_connect.php');
include('check_user_access_right.php');

if($_POST['password1'] == $_POST['password2'])
{
    //TODO contrôle que le password 0 corresponde bien à la session

    $req = $bdd->prepare('UPDATE mail_user SET user_pwd = ? WHERE user_id = ? AND user_pwd = ?');
    $req->execute(array($_POST['password1'], $_SESSION['user_id'], $_POST['password0']));

    header('Location: main_menu.php');
    exit;
}