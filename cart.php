<?php
session_start();
require("main/view.php");
$main_sys = new MainSystemData();
$MainUser = new MainUser();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cart | E-Gura</title>
  <?php require 'header.php'; ?>
<header class="cat">
	<i class="fa fa-arrow-left" onclick="history.back();"></i>
  <div class="search pane">
    <i class="fa fa-search"></i>
    <input type="search" placeholder="Search here" name="">
    <span class="fa fa-times"></span>
  </div>
  <div class="headdata">
	<b id="reviews">Shopping Cart</b>
	<div class="right">
	<i class="fa fa-search searchbtn"></i>
	<a href="cart.php"><i class="fa fa-shopping-cart"><span><?php echo $MainUser->myCountCart();?></span></i></a>
</div>
</header>
<div class="contain">
	<div class="cart">
		<?php 
		echo $MainUser->mob_display_my_cart();
		?>

	</div>
</div>		
</div>
  <?php require 'footer.php'; ?>
