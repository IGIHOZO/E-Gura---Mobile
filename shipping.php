<?php
session_start();
require("main/view.php");
$MainUser = new MainUser();
$MainUserr = new MainUser();
$MainSystemData = new MainSystemData();
if (!isset($_GET['prr']) AND !isset($_GET['proos']) OR !isset($_GET['usr']) OR !isset($_GET['qnt'])) {
    echo "<script>window.location='index'</script>";
}else{
    
    if (isset($_GET['proos'])) {
        $pro = dt_dec($_GET['proos']);
    }else{
        $pro = dt_dec($_GET['prr']);
    }
    $usr = dt_dec($_GET['usr']);
    $qnt = dt_dec($_GET['qnt']);
}


if (!isset($_COOKIE['egura_user_email'])) {
    echo "<script>window.location='account'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Checkout | E-GURA</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
        #chp_cntry,#chp_dst,#chp_sctr,#chp_cll,#chp_strt{
            border:1px #956 solid;
        }
    </style>

</head><!--/head-->

<body>
<?php
//include("libs/header.php");
?>

    <section id="cart_items" style="margin-top: -100px">
        <div class="container">

            <div class="register-req" style="border-radius: 100px;margin-left: -100px">
                <p align="center" style="font-weight: bolder;color: black;font-size: 26px;">BILL TO  /  BIGEZWE KURI: <span id="respns_suc" style="float: right;margin-top: 2px;font-weight: bold;font-size: 15px;"> &nbsp;&nbsp;&nbsp;</span> </p>
            </div><!--/register-req-->

            <?php 

            //echo $MainUser->proceed_with_pay_pr_details($pro,$usr,$qnt);
if (isset($_GET['proos'])) {
    $MainUser->proceed_with_pay_pr_details_cart($pro,$usr,$qnt);
}elseif (isset($_GET['prr'])) {
    $MainUser->proceed_with_pay_pr_details($pro,$usr,$qnt);
}
            ?>

        </div>
    </section> <!--/#cart_items-->

    
<?php include("libs/footer.php");?>+
    

</body>
</html>