<?php
    include('check_user_access_right.php');
    include('db_connect.php');
    include('header.html');
?>

<body>
    <?php include('menu.php'); ?>
    <!--Page wrapper-->
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="jumbotron">
                    <h2>New email:</h2>
                    <br/>

                    <form method="post" action="write_email_ctrl.php" role="form">

                        <div class="form-group">
                            <label for="user_name">To</label>
                            <select name="user_name" id="user_name" class="form-control">
                                <?php
                                $req = $bdd->query("SELECT user_name, user_status FROM mail_user ORDER BY user_name");
                                while($data = $req->fetch())
                                {
									if($data['user_status'] == 0) continue;
                                    if(isset($_GET['to_id']) && $data['user_name'] == $_GET['to_id'])
                                    {
                                        ?>
                                        <option selected="selected"><?php echo $data['user_name']; ?></option>
                                        <?php
                                        $_GET['to_id'] = null;
                                    }
                                    else
                                    {
                                        ?>
                                        <option><?php echo $data['user_name']; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject">
                        </div>

                        <div class="form-group">
                            <label for="content">Write your email here</label>
                            <textarea name="content" id="content" class="form-control" rows="3"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>

                </div>
            </div>
        </div>
        <!--/Page Wrapper-->
    </div>
<?php include('footer.html'); ?>


