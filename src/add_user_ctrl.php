<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('db_connect.php');
include('check_admin_access_right.php');

if(isset($_POST['user_name']) && isset($_POST['user_pwd']) && isset($_POST['user_role']))
{
    $req = $bdd->prepare('INSERT INTO mail_user (user_name, user_pwd, user_role, user_status) VALUES (?, ?, ?, ?)');
    $req->execute(array($_POST['user_name'], $_POST['user_pwd'], $_POST['user_role'], $_POST['user_status']));
    header('Location: main_menu.php');
}
else
{
    echo "User already exists...";
}




