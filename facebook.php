<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	include("facebook_config.php");
$facebook_output = '';
$facebook_helper = $facebook->getRedirectLoginHelper();

if (isset($_GET['code'])) {

	if (isset($_SESSION['access_token'])) {
		$access_token = $_SESSION['access_token'];
	}
	else
	{
		$access_token = $facebook_helper->getAccessToken();

		$_SESSION['access_token'] = $access_token;
		$facebook->setDefaultAccessToken($_SESSION['access_token']);
	}
	$graph_response = $facebook->get("/me?fields=name,email", $access_token);
	$facebook_user_info = $graph_response->getGraphUser();
	if (!empty($facebook_user_info['id'])) {
		$_SESSION['user_image'] = 'http://graph.facebook.com'.$facebook_user_info['id'].'/picture';
	}
	if (!empty(($facebook_user_info['name']))) {
		$_SESSION['user_name'] = $facebook_user_info['name'];
	}
	if (!empty(($facebook_user_info['email']))) {

		$_SESSION['user_email_address'] = $facebook_user_info['email'];
	} 
}else{
	$facebook_permissions = ['email'];

		$facebook_login_url = $facebook_helper->getLoginUrl('https://e-gura.com/facebook.php', $facebook_permissions);
		$facebook_login_url = '<div align="center"><a href="'.$facebook_login_url.'"><img style="width: 70%;height: 40px;margin-top: 0px;border-radius:5px" src="img/loginWithFacebook.png" /></a></div>';

}







if (isset($facebook_login_url)) {
	echo $facebook_login_url;
}else{
	// echo '<div class="panel-heading">Welcome User</div><div class="panel-body">';
	// echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />';
	// echo'<h3><b>Name :</b> '.$_SESSION['user_name'].'</h3>';
	// echo'<h3><b>Email :</b> '.$_SESSION['user_email_address'].'</h3>';
	// echo '<h3></a href="logout.php">Logout</a></h3></div>';
	// //var_dump($_SESSION);

    $one = strtok($facebook_user_info['name'], ' ');
    $fname = trim($one);

    $two = strstr($facebook_user_info['name'], ' ');
    $lname =  trim($two);
    // echo $fname."<br>";
    // echo $lname."<br>";


$con = new PDO('mysql:host=localhost;dbname=eguraco1_egura', 'eguraco1', 'sV.GemLj,X3Y');
$sel_user = $con->prepare("SELECT * FROM egura_users WHERE user_email=? AND user_status=?");
$sel_user->bindValue(1,$facebook_user_info['email']);
$sel_user->bindValue(2,"E");
$sel_user->execute();
if ($sel_user->rowCount()==0) {
	$ins_user = $con->prepare("INSERT INTO egura_users(user_fname,user_lname,user_email,user_pass,user_status) VALUES(?,?,?,?,?)");
	$ins_user->bindValue(1,$fname);
	$ins_user->bindValue(2,$lname);
	$ins_user->bindValue(3,$facebook_user_info['email']);
	$ins_user->bindValue(4,"");
	$ins_user->bindValue(5,"E");
	$ins_user->execute();
}

$aft_sel_user = $con->prepare("SELECT * FROM egura_users WHERE user_email=? AND user_status=?");
$aft_sel_user->bindValue(1,$facebook_user_info['email']);
$aft_sel_user->bindValue(2,"E");
$aft_sel_user->execute();
if ($aft_sel_user->rowCount()>=1) {
	$ft_aft_sel_user = $aft_sel_user->fetch(PDO::FETCH_ASSOC);

     $nnme = strtoupper($ft_aft_sel_user['user_fname']).' '.ucfirst(strtolower($ft_aft_sel_user['user_lname']));
     $eml = $ft_aft_sel_user['user_email'];
     $lastId = $ft_aft_sel_user['user_id'];
     $eg_name_ck = 'egura_allname';
     $eg_email_ck = 'egura_email';
     $eg_id_ck = 'egura_usrid';
     if(!isset($_COOKIE[$eg_name_ck])){
         setcookie($eg_name_ck, $nnme, time()+2592000,'/');      // One month or 31 days
     }
     if(!isset($_COOKIE[$eg_email_ck])){
         setcookie($eg_email_ck, $eml, time()+2592000,'/');  // One month or 31 days
     }
     if(!isset($_COOKIE[$eg_id_ck])){
         setcookie($eg_id_ck, $lastId, time()+2592000,'/');  // One month or 31 days
     } 

}

}
	@header("location:index");
?>