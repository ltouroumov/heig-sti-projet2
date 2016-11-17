<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('db_connect.php');
include('check_user_access_right.php');


$req = $bdd->prepare('SELECT user_id FROM mail_user WHERE user_name = ?');
$req->execute(array($_POST['user_name']));

if($data = $req->fetch()){
    $req1 = $bdd->prepare('INSERT INTO mail_client (to_id, from_id, sent_date, subject, content) VALUES (?, ?, ?, ?, ?)');
    $req1->execute(array($data['user_id'], $_SESSION['user_id'], date("Y-m-d H:i:s"), $_POST['subject'], $_POST['content']));
}
else{
    echo "Impossible to send the message to the destination... Unknown user !";
}

?>

<script type="text/javascript">window.location.href = 'main_menu.php';</script>





