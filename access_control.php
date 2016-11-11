<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('db_connect.php');

if (isset($_POST['user_name']) AND isset($_POST['user_pwd']))
{
    //TODO Vérifier entrée utilisateur !
echo "prepare requete";

    $req = $bdd->prepare('SELECT user_id, user_name, user_role, user_status 
                          FROM mail_user WHERE user_name = ? AND user_pwd = ?');
    $req->execute(array($_POST['user_name'], $_POST['user_pwd']));

    if($data = $req->fetch())
    {

	echo "bon user";       
 if ($data['user_status'] == 1)
        {
            $_SESSION['user_id'] = $data['user_id'];
            $_SESSION['user_name'] = $data['user_name'];
            $_SESSION['user_role'] = $data['user_role'];
            header('Location: main_menu.php');
            exit();
        }
    }
echo "Mauvais user";
    header('Location: login.php');
    exit();
}

