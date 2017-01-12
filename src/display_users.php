<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('db_connect.php');
include('header.html');
?>
<body>

    <?php include('menu.php'); ?>

    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="jumbotron">
                    <h2>User administration:</h2>
                    <br/>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $req = $bdd->query('SELECT user_id, user_name, user_role, user_status 
                                                FROM mail_user 
                                                ORDER BY user_name ASC');

                            while($data = $req->fetch())
                            {
                                ?>
                                <tr>
                                    <td><?php echo $data['user_id']; ?></td>
                                    <td><?php echo $data['user_name']; ?></td>
                                    <td><?php echo $data['user_role']; ?></td>
                                    <td><?php echo $data['user_status']; ?></td>
                                    <td><a href="del_user.php?mail_id=<?php echo $data['mail_id']; ?>" class="btn btn-primary btn-lg" role="button">Display &raquo;</a></td>
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