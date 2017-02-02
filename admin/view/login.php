<?php include '../include/constants.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Eco Nutrivet</title>

    <!-- Bootstrap core CSS -->

    <link href="<?=SERVER_PATH?>css/bootstrap.min.css" rel="stylesheet">

    <link href="<?=SERVER_PATH?>fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?=SERVER_PATH?>css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?=SERVER_PATH?>css/custom.css" rel="stylesheet">
    <link href="<?=SERVER_PATH?>css/icheck/flat/green.css" rel="stylesheet">


    <script src="<?=SERVER_PATH?>js/jquery.min.js"></script>
    <script src="<?=SERVER_PATH?>js/actions.js"></script>
    <link href="<?=SERVER_PATH?>css/sujit.css" rel="stylesheet">

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
<style type="text/css">
.form-control.has-feedback-left {
    padding-left: 60px!important;
}
</style>
</head>

<body style="background:#F7F7F7;">
    
    <div class="">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>

        <div id="wrapper">
            <div id="login" class="animate form">
                <section class="login_content">
                    <form name="frm_login" id="frm_login" >
                        <h1>Eco Nutrivet</h1>
                        <div class="form-group alert alert-success frm_error_message" >
                                                                         
                        </div>
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left" id="txt_username" name="txt_username" placeholder="Username">
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class=" form-group has-feedback">
                            <input type="password" class="form-control has-feedback-left" id="txt_password" name="txt_password" placeholder="****">
                            <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div>
                            <a class="btn btn-success btn-lg pull-left submit" href="#" id="btn_login" frm_id="frm_login" call_link="<?=SERVER_PATH?>controller/controller.php?method=login-API" >Log in</a>
                            <a class="reset_pass" href="#">Lost your password?</a>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">

                           <!--  <p class="change_link">New to site?
                                <a href="#toregister" class="to_register"> Create Account </a>
                            </p> -->
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <!-- <h1><i class="fa fa-paw" style="font-size: 26px;"></i>Equator Appliances!</h1> -->

                                <p>©2015 All Rights Reserved. Bedmutha Industries</p>
                            </div>
                        </div>
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
            <div id="register" class="animate form">
                <section class="login_content">
                    <form>
                        <h1>Create Account</h1>
                        <div>
                            <input type="text" class="form-control" placeholder="Username" required="" />
                        </div>
                        <div>
                            <input type="email" class="form-control" placeholder="Email" required="" />
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Password" required="" />
                        </div>
                        <div>
                            <a class="btn btn-default submit" href="manager_website.php">Submit</a>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">

                            <p class="change_link">Already a member ?
                                <a href="#tologin" class="to_register"> Log in </a>
                            </p>
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <h1><i class="fa fa-paw" style="font-size: 26px;"></i> Bedmutha Industries</h1>

                                <p>©2016 All Rights Reserved. </p>
                            </div>
                        </div>
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
        </div>
    </div>

</body>

</html>