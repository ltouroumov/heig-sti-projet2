<?php
include('check_admin_access_right.php');
include('db_connect.php');
include('header.html');

if(isset($_GET['user_id']) && !isset($_GET['update']))
{
    $req = $bdd->prepare('SELECT * FROM mail_user WHERE user_id= ?');
    $req->execute(array($_GET['user_id']));
    $data = $req->fetch();

    ?>

    <body>

    <?php include('menu.php'); ?>

    <div id="wrapper">
        <!--Page wrapper-->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="jumbotron">
                    <h2>Update user:</h2>

                    <form method="post" action="update_user_ctrl.php?update=1&user_id=<?php echo $_GET['user_id']; ?>" role="form">

                        <div class="form-group">
                            <label for="user_name">Username</label>
                            <input type="text" name="user_name" id="user_name" class="form-control" value=<?php echo $data['user_name']; ?>>
                        </div>

                        <div class="form-group">
                            <label for="user_pwd">Password</label>
                            <input type="text" name="user_pwd" id="user_pwd" class="form-control" value=<?php echo $data['user_pwd']; ?>>
                        </div>

                        <div class="form-group">
                            <label for="user_role">Role</label>
                            <select name="user_role" id="user_role" class="form-control">
                                <?php
                                if($data['user_role'] == "User")
                                {
                                    ?>
                                    <option selected="selected" value="User">User</option>
                                    <option value="Admin">Admin</option>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <option value="User">User</option>
                                    <option selected="selected" value="Admin">Admin</option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="user_status">Status</label>
                            <select name="user_status" id="user_status" class="form-control">
                                <?php
                                if($data['user_status'] == 0)
                                {
                                    ?>
                                    <option selected="selected" value=0>Passive</option>
                                    <option value=1>Active</option>
                                    <?php

                                }
                                else
                                {
                                    ?>
                                    <option value=0>Passive</option>
                                    <option selected="selected" value=1>Active</option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>

                </div>
            </div>
        </div>
        <!--/Page Wrapper-->
    </div>
    <?php include('footer.html');

}
elseif(isset($_GET['user_id']) && isset($_GET['update']))
{
    if($_GET['update'] == 1)
    {
        $req = $bdd->prepare('UPDATE mail_user SET user_name = ?, user_pwd = ?, user_role = ?, user_status = ? WHERE user_id = ?');
        $req->execute(array($_POST['user_name'], $_POST['user_pwd'], $_POST['user_role'], $_POST['user_status'], $_GET['user_id']));
    }
    ?>
    <script type="text/javascript">window.location.href = 'update_user.php';</script>
    <?php
}
?>



