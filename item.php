<?php
session_start();
require("main/view.php");
$main_sys = new MainSystemData();

$MainUser = new MainUser();
$prod = dt_dec($_GET['pro']);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Product details | E-Gura</title>
  <?php require 'header.php'; ?>
<header class="cat item" id="resp_bynw">
	<i class="fa fa-arrow-left" onclick="history.back();"></i>
	<div class="right">
	<a href="cart.php"><i class="fa fa-shopping-cart"><span><?php echo $MainUser->myCountCart();?></span></i></a>
</header>
<?php echo $MainUser->mob_product_details($prod);?>
<script type="" src="js/jquery.js"></script>
<script type="text/javascript" src="slick/slick.js"></script>
<script type="" src="js/query.js"></script>
<script type="" src="js/web.js"></script>
