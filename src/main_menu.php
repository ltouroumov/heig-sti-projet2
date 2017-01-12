<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('check_user_access_right.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>WEB MAIL HEIG-VD</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!--Navigation-->
        <?php include('menu.php'); ?>
        <!--/Navigation-->


    	<!--Page wrapper-->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="jumbotron">
                    <h1>Mail Box</h1>
                    <p>Welcome to your mail box <?php echo $_SESSION['user_name']; ?>!</p>
                </div>
            </div>
        </div>
        <!--/Page Wrapper-->


    </div>
    <?php include('footer.html'); ?>
