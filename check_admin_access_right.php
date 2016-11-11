<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('check_user_access_right.php');

if($_SESSION['user_role'] != 'Admin')
{
    header('Location: bad_access_right.html');
    exit();
}