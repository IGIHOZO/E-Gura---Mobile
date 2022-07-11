<!DOCTYPE html>
<html>
<head>
	<title>Document Title</title>
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
	<a href="cart.php"><i class="fa fa-shopping-cart"><span>32</span></i></a>
</div>
</header>
<div class="contain">
	<div class="cart">
		<h1>Checkout</h1>
		<h2>My cart [9]</h2>
		<?php for ($j=1; $j <= 3 ; $j++) {  ?>
		<table>
			<caption>Table Caption</caption>
			<?php for ($i=1; $i <= 4 ; $i++) {  ?>
			<tr>
				<td>Row name</td>
				<td>Row Data</td>
			</tr>
			<?php } ?>
		</table>
		<?php } ?>
		<a href="checkout.php" class="link">Submit</a>
	</div>
</div>		
</div>
  <?php require 'footer.php'; ?>
