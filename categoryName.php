<?php
session_start();
require("main/view.php");
$main_sys = new MainSystemData();

$MainUser = new MainUser();
$sub_cat = dt_dec($_GET['sub_cat']);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Categories | E-Gura</title>
  <?php require 'header.php'; ?>
<header class="cat">
	<i class="fa fa-arrow-left" onclick="history.back();"></i>
  <div class="search pane">
    <i class="fa fa-search"></i>
    <input type="search" placeholder="Search here" name="">
    <span class="fa fa-times"></span>
  </div>
  <div class="headdata">
	<b>Shopping Cart</b>
	<div class="right">
	<i class="fa fa-search searchbtn"></i>
	<a href="cart.php"><i class="fa fa-shopping-cart"><span><?php echo $MainUser->myCountCart();?></span></i></a>
</div>
</header>
<div class="filter">
	<div class="drop">Best Match <i class="fa fa-caret-down"></i>
<!-- 		<ul>
			<li>Link to filter</li>
			<li>Link to filter</li>
			<li>Link</li>
			<li>Link</li>
		</ul> -->
	</div>
	<div class="filterRight">
		<i class="fa fa-th-large view"></i>
		<i class="fa fa-filter"></i>
	</div>
</div>
<div class="contain">
<div class="categoryList">	
<?php echo $MainUser->mob_pro_cat($sub_cat);?>
</div>		
</div>
  <?php require 'footer.php'; ?>
