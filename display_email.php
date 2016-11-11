<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('db_connect.php');
include('check_user_access_right.php');
include('header.html');
?>

<body>

<?php include('menu.php'); ?>

<div id="wrapper">
    <!--Page wrapper-->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="jumbotron">

                <?php
                    if (isset($_GET['mail_id']))
                    {
                        $req = $bdd->prepare('SELECT sent_date, subject, content, user_name FROM mail_client 
                                              INNER JOIN mail_user ON user_id = from_id 
                                              WHERE mail_id = ? ORDER BY sent_date DESC');
                        $req->execute(array($_GET['mail_id']));

                        if ($data = $req->fetch())
                        {
                            ?>
                            <p><b>From: </b><?php echo $data['user_name']; ?></p>
                            <p><b>Subject: </b><?php echo $data['subject']; ?></p>
                            <p><b>Date: </b><?php echo $data['sent_date']; ?></p>
                            <p><b>Content:</b></p>
                            <div class="well">
                                <p><?php echo $data['content']; ?></p>
                            </div>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                        <p><?php echo "Error nothing to display!"; ?></p>
                        <?php
                    }
                    ?>

                    <p>
                        <a href="read_email.php" class="btn btn-primary btn-lg" role="button">Back &raquo;</a>
                        <a href="write_email.php?to_id=<?php echo $data['user_name']; ?>" class="btn btn-primary btn-lg" role="button">Answer &raquo;</a>
                        <a href="delete_email.php?mail_id=<?php echo $_GET['mail_id']; ?>" class="btn btn-primary btn-lg" role="button">Delete &raquo;</a>
                    </p>
                </div>
            </div>
        </div>
        <!--/Page Wrapper-->
    </div>
<?php include('footer.html'); ?>


