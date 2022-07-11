<?php
require_once("vendor/autoload.php");
$google_client = new Google_Client();
$google_client->setClientId('115299328773-hs8ljn7hbgl2q42giqfpasv8kvohvorg.apps.googleusercontent.com');
$google_client->setClientSecret('GFBvxICo-dOftTVlHxDKk5KV');
$google_client->setRedirectUri('https://mobile.e-gura.com/google.php');
$google_client->addScope('email');
$google_client->addScope('profile');
session_start();

?>