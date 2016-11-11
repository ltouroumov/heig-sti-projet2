<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('db_connect.php');
include('check_admin_access_right.php');

if(isset($_GET['user_id']))
{
    $req = $bdd->prepare('UPDATE mail_user SET user_status=0 WHERE user_id = ?');
    $req->execute(array($_GET['user_id']));
}
?>

<?php include('footer.html'); ?>
<script type="text/javascript">window.location.href = 'del_user.php'; </script>
