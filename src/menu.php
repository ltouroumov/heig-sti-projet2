<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    include('check_user_access_right.php');
?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">WEB MAIL HEIG-VD</a>
    </div>

    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['user_name']; ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">

                <li>
                    <a href="write_email.php"><i class="fa fa-fw fa-plus-circle"></i> New</a>
                </li>

                <li>
                    <a href="read_email.php"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                </li>

                <li>
                    <a href="change_password.php"><i class="fa fa-fw fa-gear"></i> Settings</a>
                </li>

                <?php if($_SESSION['user_role'] == 'Admin')
                {
                    ?>
                    <li>
                        <a href="add_user.php""><i class="fa fa-users"></i> Add User</a>
                    </li>
                    <li>
                        <a href="del_user.php""><i class="fa fa-user"></i> Delete User</a>
                    </li>
                    <li>
                        <a href="update_user.php""><i class="fa fa-user-md"></i> Update User</a>
                    </li>
                    <?php
                }
                ?>

                <li class="divider"></li>
                <li>
                    <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>

    <!-- Sidebar Menu Items-->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">

            <li class="active">
                <a href="write_email.php"><i class="fa fa-plus-circle""></i> New</a>
            </li>

            <li>
                <a href="read_email.php"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
            </li>

            <li>
                <a href="change_password.php"><i class="fa fa-fw fa-gear"></i> Settings</a>
            </li>

            <?php if($_SESSION['user_role'] == 'Admin')
            {
                ?>
                <li>
                    <a href="add_user.php""><i class="fa fa-users"></i> Add User</a>
                </li>
                <li>
                    <a href="del_user.php""><i class="fa fa-user"></i> Delete User</a>
                </li>
                <li>
                    <a href="update_user.php""><i class="fa fa-user-md"></i> Update User</a>
                </li>
                <?php
            }
            ?>

            <li>
                <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Logout</a>
            </li>

        </ul>
    </div>
</nav>