<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('db_connect.php');
include('check_user_access_right.php');

if(isset($_GET['mail_id']))
{

    $req = $bdd->prepare('DELETE FROM mail_client WHERE mail_id = ?');
    $req->execute(array($_GET['mail_id']));
}
?>

<?php include('footer.html'); ?>
<script type="text/javascript">window.location.href = 'read_email.php'; </script>
