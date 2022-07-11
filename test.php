<?php


 // //-- Very simple variant
// $useragent = $_SERVER['HTTP_USER_AGENT']; 
// $iPod = stripos($useragent, "iPod"); 
// $iPad = stripos($useragent, "iPad"); 
// $iPhone = stripos($useragent, "iPhone");
// $Android = stripos($useragent, "Android"); 
// $iOS = stripos($useragent, "iOS");
// $Blackberry = stripos($useragent, "BlackBerry");
// $webOS = stripos($useragent, "webOS");
// $IEMobile = stripos($useragent, "IEMobile");
// $OperaMini = stripos($useragent, "OperaMini");
// //-- You can add billion devices 

// $DEVICE = ($iPod||$iPad||$iPhone||$Android||$iOS||$webOS||$Blackberry||$IEMobile||$OperaMini);

// if ($DEVICE !=true) {
// 	echo "Desktop ...";
// }else{
// 	echo "Mobile ...";
//  } 


//                 $eg_name_ck = 'egura_allname';
//                 $eg_email_ck = 'egura_email';
//                 $eg_id_ck = 'egura_usrid';
//                 $nnme = 'Cardinal Kabaka';
//                 $eml = '0788353563';
//                 $lastId = 14;
//                 if(!isset($_COOKIE[$eg_name_ck])){
//                     setcookie($eg_name_ck, $nnme, time()+604800,'/');      // One month or 31 days
//                 }
//                 if(!isset($_COOKIE[$eg_email_ck])){
//                     setcookie($eg_email_ck, $eml, time()+604800,'/');  // One month or 31 days
//                 }
//                 if(!isset($_COOKIE[$eg_id_ck])){
//                     setcookie($eg_id_ck, $lastId, time()+604800,'/');  // One month or 31 days
//                 }     

// echo $_COOKIE['egura_allname']."<br>";
// echo $_COOKIE['egura_email']."<br>";
// echo $_COOKIE['egura_usrid']."<br>";

// $name = "IMPUNDU ISHEJA Arlette";

//     $one = strtok($name, ' ');
//     $fname = trim($one);

//     $two = strstr($name, ' ');
//     $lname =  trim($two);
//     echo $fname."<br>";
//     echo $lname."<br>";


echo $_SERVER['DOCUMENT_ROOT'];
 ?>