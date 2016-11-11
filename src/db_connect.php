<?php

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=webmail;charset=utf8', 'root', '123_Soleil',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
    die('Error : '.$e->getMessage());
}
