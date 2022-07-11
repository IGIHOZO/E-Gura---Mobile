<?php
include('google_config.php');
$login_button = '';
if (isset($_GET["code"])) {
	$token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
	if (!isset($token['error'])) {
		$google_client->setAccessToken($token['access_token']);
		$_SESSION['access_token'] = $token['access_token'];
		$google_service = new Google_Service_Oauth2($google_client);
		$data = $google_service->userinfo->get();
		if (!empty($data['given_name'])) {
			$_SESSION['user_first_name'] = $data['given_name'];
		}

		if (!empty($data['family_name'])) {
			$_SESSION['user_last_name'] = $data['family_name'];
		}

		if (!empty($data['email'])) {
			$_SESSION['user_email_address'] = $data['email'];
		}

		if (!empty($data['gender'])) {
			$_SESSION['user_gender'] = $data['gender'];
		}

		if (!empty($data['picture'])) {
			$_SESSION['user_image'] = $data['picture'];
		}


$con = new PDO('mysql:host=localhost;dbname=eguraco1_egura', 'eguraco1', 'sV.GemLj,X3Y');
$sel_user = $con->prepare("SELECT * FROM egura_users WHERE user_email=? AND user_status=?");
$sel_user->bindValue(1,$data['email']);
$sel_user->bindValue(2,"E");
$sel_user->execute();
if ($sel_user->rowCount()==0) {
	$ins_user = $con->prepare("INSERT INTO egura_users(user_fname,user_lname,user_email,user_pass,user_status,user_latitude,user_longitude) VALUES(?,?,?,?,?,?,?)");
	$ins_user->bindValue(1,$data['given_name']);
	$ins_user->bindValue(2,$data['family_name']);
	$ins_user->bindValue(3,$data['email']);
	$ins_user->bindValue(4,"");
	$ins_user->bindValue(5,"E");
	$ins_user->bindValue(6,$_COOKIE['egura_lat']);
	$ins_user->bindValue(7,$_COOKIE['egura_long']);
	$ins_user->execute();
}

$aft_sel_user = $con->prepare("SELECT * FROM egura_users WHERE user_email=? AND user_status=?");
$aft_sel_user->bindValue(1,$data['email']);
$aft_sel_user->bindValue(2,"E");
$aft_sel_user->execute();
if ($aft_sel_user->rowCount()>=1) {
	$ft_aft_sel_user = $aft_sel_user->fetch(PDO::FETCH_ASSOC);

     $nnme = strtoupper($ft_aft_sel_user['user_fname']).' '.ucfirst(strtolower($ft_aft_sel_user['user_lname']));
     $eml = $ft_aft_sel_user['user_email'];
     $lastId = $ft_aft_sel_user['user_id'];

                $eg_name_ck = 'egura_user_name';
                $eg_email_ck = 'egura_user_email';
                $eg_id_ck = 'egura_user_id';


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
	if (!isset($_COOKIE['egura_lat']) OR !isset($_COOKIE['egura_long'])) {
	echo "<script>alert('Please enable your browser location to allow us to provide you near by products.')</script>";
	echo "<script>window.location='https://mobile.e-gura.com/account.php'</script>";
}else{
	//echo "<script>alert('Gooooooooooooooddddd !!!!!!!!!!')</script>";
	header("location:index");
}
}
if (!isset($_SESSION['access_token'])) {
	$login_button = '<a href ="'.$google_client->createAuthUrl().'"><img src="img/GoogleSignUpDark.png" /></a>';
}

if (!isset($_GET['code'])) {
					if ($login_button == '') {
						// echo '<div class="panel-heading">Welcome User</div><div class"panel-body">';
						// echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />';
						// echo '<h3><b>Name :</b> '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</h3>';
						// echo'<h3><b>Email : </b>'.$_SESSION['user_email_address'].'<h3>';
						// echo '<h3><a href="logout.php">Logout</h3></div>';
					}else{
					//echo'<div align="center">'.$login_button.'</div>';
					}
}
					if ($login_button == '') {
						// echo '<div class="panel-heading">Welcome User</div><div class"panel-body">';
						// echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />';
						// echo '<h3><b>Name :</b> '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</h3>';
						// echo'<h3><b>Email : </b>'.$_SESSION['user_email_address'].'<h3>';
						// echo '<h3><a href="logout.php">Logout</h3></div>';
					}else{
					//	echo'<div align="center">'.$login_button.'</div>';
					}


?>

