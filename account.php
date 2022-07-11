<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require("main/view.php");
$main_sys = new MainSystemData();
$MainUser = new MainUser();
include("google.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login | E-Gura</title>
  <?php require 'header.php'; ?>
<header class="cat">
	<i class="fa fa-arrow-left" onclick="history.back();"></i>
	<b>E-Gura</b><span style="float: right;margin-right: 20%;font-weight: bolder;color: red;" id="respns_1">  </span>
</header>
<input type="hidden" id="hdn_lngtd">
<input type="hidden" id="hdn_lttd">
<script type="text/javascript">
navigator.geolocation.getCurrentPosition(function(location) {
  lt = location.coords.latitude;
  lg = location.coords.longitude;
  //console.log('Your lat is: '+lt);
  //console.log('Your lng is: '+lg);
  saveCoordinates();
})
function saveCoordinates(){
  document.getElementById("hdn_lttd").value=lt;
  document.getElementById("hdn_lngtd").value=lg;
  document.cookie = "egura_lat="+lt;
  document.cookie = "egura_long="+lg;
  // console.log(document.getElementById("hdn_lttd").value);
  // console.log(document.getElementById("hdn_lngtd").value);
}

</script>
<div class="contain">
<div class="account">
	<input type="radio" id="signuptab" name="tab">
	<input type="radio" id="signintab" name="tab" checked="">
	<label for="signuptab" class="active">Register</label>
	<label for="signintab">Sign in</label>
	<div class="signup">
		<h1>Register</h1>
		<form>
			<input type="text" placeholder="Firstname" name="" id="sgn_fname">
			<input type="text" placeholder="Lastname" name="" id="sgn_lname">
			<input type="number" placeholder="Phone (0788940718)" name="" id="sgn_email">
			<input type="password" placeholder="New password" name="" id="sgn_npass">
			<input type="password" placeholder="Confirm password" name="" id="sgn_cpass">
			
		</form>
		<button class="btn" onclick="return MobonSubSignup();">Register</button>
	</div>
	<div class="signin">
		<h1>Sign In</h1>
		<form>
			<input type="number" placeholder="Phone" id="logNme" name="">
			<input type="password" placeholder="Password" id="logPass" name="">
			
		</form>
		<button class="btn" onclick="return MobOnSubLogin();">Sign In</button>
	<button style="background-color: transparent;color: #22f;margin-top: -10px;font-weight: bolder;font-size: 14px" id="mobFrgtLink">Forgot Password</button>
	<div style="display: none;background-color: #def;height: 80px" id="mobForgDiv">
		<h3 style="width: 80%;float: left;" id="frg_ttl">Enter your account phone number</h3>
		<llabel style="width: 10%;float: right;color: #f00;font-weight: bolder;text-align: right;font-size: 20px">
			<i class="fa fa-times-circle-o" onclick="return mobCloseFrtgPss();"></i>
		</llabel><br>
				<input style="width: 64%;float: left;margin-top: 5px" type="number" placeholder="Phone (0788940718)" id="mobuser_email" name="">
				<button style="width: 32%;float: right;margin-top: 5px" class="btn" onclick="return mobOnSbmtFrgPss();">Reset</button>

	</div>
											<?php
											// $login_button = '<a href ="'.$google_client->createAuthUrl().'"><img src="img/GoogleSignUpDark.png" style="width: 200px;height: 100px;padding: 50px;margin-top: -40px" /></a>';
											// echo'<div align="center">'.$login_button.'</div>';


if (!isset($_SESSION['access_token'])) {
	$login_button = '<a href ="'.$google_client->createAuthUrl().'"><img src="img/GoogleSignUpDark.png" style="width: 90%;height: 140px;padding: 50px;margin-top: -40px" /></a>';
}


					if ($login_button == '') {
						// echo '<div class="panel-heading">Welcome User</div><div class"panel-body">';
						// echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />';
						// echo '<h3><b>Name :</b> '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</h3>';
						// echo'<h3><b>Email : </b>'.$_SESSION['user_email_address'].'<h3>';
						// echo '<h3><a href="logout.php">Logout</h3></div>';
					}else{
						echo'<div align="center">'.$login_button.'</div>';
					}
											
											?>
	</div>

</div>		
</div>
  <?php require 'footer.php'; ?>
