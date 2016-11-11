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
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="jumbotron">
                    <h2>Check your emails:</h2>
                    <br/>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>From</th>
                                <th>Subject</th>
                                <th>Read</th>
                                <th>Answer</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>

                                <?php
                                $req = $bdd->prepare('SELECT mail_id, sent_date, subject, user_name FROM mail_client 
                                                      INNER JOIN mail_user ON user_id = from_id 
                                                      WHERE to_id = ? ORDER BY sent_date DESC');
                                $req->execute(array($_SESSION['user_id']));

                                while($data = $req->fetch())
                                {
                                ?>
                                <tr>
                                    <td><?php echo $data['sent_date']; ?></td>
                                    <td><?php echo $data['user_name']; ?></td>
                                    <td><?php echo $data['subject']; ?></td>
                                    <td><a href="display_email.php?mail_id=<?php echo $data['mail_id']; ?>" class="btn btn-primary btn-lg" role="button">Display &raquo;</a></td>
                                    <td><a href="write_email.php?to_id=<?php echo $data['user_name']; ?>" class="btn btn-primary btn-lg" role="button">Answer &raquo;</a></td>
                                    <td><a href="delete_email.php?mail_id=<?php echo $data['mail_id']; ?>" class="btn btn-primary btn-lg" role="button">Delete &raquo;</a></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.html'); ?>
