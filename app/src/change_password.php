<?php
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
                    <h2>Change password:</h2>
                    <br/>
                    <form method="post" action="change_password_ctrl.php" role="form">

                        <div class="form-group">
                            <label for="password0">Old password</label>
                            <input type="password" name="password0" id="password0" class="form-control" placeholder="Old Password">
                        </div>

                        <div class="form-group">
                            <label for="password1">New Password</label>
                            <input type="password" name="password1" id="password1" class="form-control" placeholder="New Password">
                        </div>

                        <div class="form-group">
                            <label for="password2">Confirm Password</label>
                            <input type="password" name="password2" id="password2" class="form-control" placeholder="Confirm">
                        </div>

                        <button type="submit" class="btn btn-primary">Change</button>
                    </form>

                </div>
            </div>
        </div>
        <!--/Page Wrapper-->
    </div>
<?php include('footer.html'); ?>