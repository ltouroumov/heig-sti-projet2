<?php
include('check_admin_access_right.php');
include('header.html');
?>

<body>

<?php include('menu.php'); ?>

    <div id="wrapper">
        <!--Page wrapper-->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="jumbotron">
                    <h1>New User</h1>

                    <form method="post" action="add_user_ctrl.php" role="form">

                        <div class="form-group">
                            <label for="user_name">Username</label>
                            <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Username">
                        </div>

                        <div class="form-group">
                            <label for="user_pwd">Password</label>
                            <input type="password" name="user_pwd" id="user_pwd" class="form-control" placeholder="Password">
                        </div>

                        <div class="form-group">
                            <label for="user_role">Role</label>
                            <select name="user_role" id="user_role" class="form-control">
                                    <option selected="selected" value="User">User</option>
                                    <option value="Admin">Admin</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="user_status">Status</label>
                            <select name="user_status" id="user_status" class="form-control">
                                    <option value=0>Passive</option>
                                    <option selected="selected" value=1>Active</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>

                </div>
            </div>
        </div>
        <!--/Page Wrapper-->
    </div>
<?php include('footer.html'); ?>


