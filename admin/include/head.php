<?php
session_start();
if(isset($_SESSION["user_data"]) && !empty($_SESSION["user_data"])){
    $user_data = $_SESSION["user_data"];

} else {
    header( 'Location: ./login.php' );
    exit();
}

?>
<?php include '../include/constants.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Eco Nutrivet Industries</title>

    <!-- Bootstrap core CSS -->

    <link href="<?=SERVER_PATH?>css/bootstrap.min.css" rel="stylesheet">

    <link href="<?=SERVER_PATH?>fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?=SERVER_PATH?>css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?=SERVER_PATH?>css/custom.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?=SERVER_PATH?>css/maps/jquery-jvectormap-2.0.1.css" />
    <link href="<?=SERVER_PATH?>css/icheck/flat/green.css" rel="stylesheet" />
    <link href="<?=SERVER_PATH?>css/floatexamples.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVER_PATH?>css/sujit.css" rel="stylesheet">
   
    <!-- select2 -->
    <link href="<?=SERVER_PATH?>css/select/select2.min.css" rel="stylesheet">
   

    <script src="<?=SERVER_PATH?>js/jquery.min.js"></script>
    <script src="<?=SERVER_PATH?>js/nprogress.js"></script>
    <script src="<?=SERVER_PATH?>js/actions.js"></script>

    
    <!--- CKEditor -->
    <script src="//cdn.ckeditor.com/4.5.9/standard/ckeditor.js"></script>

    
    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

