<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("main/view.php");
require("main/sys.php");

$MainUserr = new MainUser();

$main_sys = new MainSystemData();
if (isset($_GET['TransID'])) {
//  echo "<script>alert('Thank you for your transaction !');</script>";
  $dataa = $_GET['mydata'];

  //           --- PRODUCT ----- AMOUNT  -----PHONE -----USERNAME
  $real_data = explode(",", $dataa);

  $product_sms = ucfirst($real_data[0]);
  $price_sms = number_format($real_data[1]);
  $phone_sms = $real_data[2];
  $username_sms = $real_data[3];

  $tr_adder = $real_data[4];
  $tr_pro = $real_data[5];
  $tr_qnty = $real_data[6];
  $tr_user = $real_data[7];
  
    function send_sms_buy_client($phone_client,$message){
        $data   =   array(
            "sender"=>'E Gura',
            "recipients"=>"$phone_client",
            "message"=>"$message",
        );
        $url = "https://www.intouchsms.co.rw/api/sendsms/.json";
             $data = http_build_query($data);
             $username="E-Gura";
             $password="Kigali12";
             $ch = curl_init();
             curl_setopt($ch,CURLOPT_URL,
                $url);
             curl_setopt($ch,CURLOPT_USERPWD,$username.":".$password);
             curl_setopt($ch,CURLOPT_POST,true);
             curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
             curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
             curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
             $result = curl_exec($ch);
             $httpcode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
             curl_close($ch);
             //echo $result;
             //echo $httpcode;
    }
    function send_sms_buy_egura($phone_egura,$message){
        $data   =   array(
            "sender"=>'E Gura',
            "recipients"=>"$phone_egura",
            "message"=>"$message",
        );
        $url = "https://www.intouchsms.co.rw/api/sendsms/.json";
             $data = http_build_query($data);
             $username="E-Gura";
             $password="Kigali12";
             $ch = curl_init();
             curl_setopt($ch,CURLOPT_URL,
                $url);
             curl_setopt($ch,CURLOPT_USERPWD,$username.":".$password);
             curl_setopt($ch,CURLOPT_POST,true);
             curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
             curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
             curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
             $result = curl_exec($ch);
             $httpcode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
             curl_close($ch);
             //echo $result;
             //echo $httpcode;
    }
    
    
    $message_client = "Hi $username_sms, We got your order! We'll let you know when it ships and is headed your way.Thank you for buying with E-GURA.";
    $message_egura = "Dear E-gura, ($username_sms) has bought ($product_sms) and paid amount of $price_sms Rwf with phone number $phone_sms";
    
    send_sms_buy_client($phone_sms,$message_client);
    send_sms_buy_egura("0782013955,0788312723",$message_egura);
    
    $MainUserr->reg_bought_transactions($tr_user,$tr_pro,$tr_qnty,$price_sms,$tr_adder);

    echo "<script>alert('Thank you for your transaction !');</script>";
    echo "<script>window.location='index';</script>";
 


}

?>
<!DOCTYPE html>
<html>
<head>
  <title>HOME | E-Gura</title>
  <?php require 'header.php'; ?>
  <link rel="stylesheet" type="text/css" href="slick/slick.css">
<header>
<input style="display: none;" type="hidden" id="hdn_lngtd">
<input style="display: none;" type="hidden" id="hdn_lttd"><br>
<input style="display: none;" type="hidden" id="accuracy"><br>
<div style="display: none;" id="result"></div>
<div style="display: none;" id="map"></div>
<div style="display: none;" id="output"></div>

<!--ASUA CODES-->
<!-- <input type="text" id="googleresult"  onclick="valChanged(this)"> -->
<div style="display: none;" id="mapDistance" max-elem="0"></div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1wze2OiCa1reDq7A30vHyxv4bm_qQBi8&callback=initMap&libraries=&v=weekly"
        defer
></script>
    <script src="js/jquery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/location.js"></script>
<script type="text/javascript">
navigator.geolocation.getCurrentPosition(function(location) {
  lt = location.coords.latitude.toPrecision(8);
  lg = location.coords.longitude.toPrecision(8);
  accuracy = location.coords.accuracy;
  //console.log('Your lat is: '+lt);
  //console.log('Your lng is: '+lg);
  saveCoordinates();
},function error(msg) {alert('Please enable your "device/browser" location to show your NEAR BY products.');window.location.reload();},
    {maximumAge:30000, timeout:5000, enableHighAccuracy: true})
function saveCoordinates(){
  document.getElementById("hdn_lttd").value=parseFloat(lt);
  document.getElementById("hdn_lngtd").value=parseFloat(lg);
  document.getElementById("accuracy").value=parseFloat(accuracy);
    loadProducts();
  // console.log(document.getElementById("hdn_lttd").value);
  // console.log(document.getElementById("hdn_lngtd").value);
}
    function testPermissionLoc(){
        navigator.permissions.query({name:'geolocation'}).then(function(result) {
            //console.log("Test permission");
          if (result.state != 'granted'){
           //alert("Allow location to view nearby products");
          function handlePermission() {
            navigator.permissions.query({name:'geolocation'}).then(function(result) {
              if (result.state == 'granted') {
                window.location.reload();
              }
            });
          }
          handlePermission();
          }
        });
    }

      setInterval('testPermissionLoc();', 4000); //call test every 10 seconds.

function loadProducts(){
    $.ajax({url: "js/products_location.php?fetch", type:'GET',dataType: 'json', success: function(result){
        dataObj = result;
        console.log("Response product");
        console.log(dataObj);
        calculateProductDistance();
        // setLoadedData();
        }});
}
function setLoadedData(dataObj){
    var row="";
    for(var usersIndex=0;usersIndex<dataObj.length;usersIndex++){
        let productsArr = dataObj[usersIndex].products;
        for(var productIndex=0;productIndex<productsArr.length;productIndex++){
            let ftsel_pros = productsArr[productIndex];


var distance_og = dataObj[usersIndex].actual_distance+" "+dataObj[usersIndex].actual_distance_unit;
var og_current_loc = dataObj[usersIndex].client_current_location;
var real_city_client_location = og_current_loc.split(",");
//console.log("Real client locaiton: "+real_city_client_location[1]+"<br>");
var og_product_loc = dataObj[usersIndex].product_seller_location;
var real_city_seller_location = og_product_loc.split(",");
//console.log("Real seller locaiton: "+real_city_seller_location[1]+"<sfg>");
//console.log("Distance og "+dataObj[usersIndex].actual_distance+"<br>");
            row+='<a href="item.php?pro='+ftsel_pros.product_id+'">'
            +'<div class="proHodler" style="width: ;height: 240px;width:  46%;">'
            +'<center><i class="fa fa-map-marker" aria-hidden="true" style="color:green;font-size:11px"></i>&nbsp;&nbsp; in <span style="color:#fc5203;font-weight:bolder">'+distance_og+'</span> <span style="color:#2b1513;font-weight:bolder">  <span style="font-size:11px;">('+real_city_seller_location[1]+') </span></span></center>'
            +'<div class="thumb pro">'
            +'<img style="width: 100%;height: 120px" src="https://e-gura.com/images/products/'+ftsel_pros.product_file+'">'
            +'</div>'
            +'<div class="proinfo index">'
            +'<b>'+ftsel_pros.product_name+'</b> <br>'
            +'<p>'+ftsel_pros.product_descr.substr(0,20)+' ...</p>'
            +'<b>RWF '+ftsel_pros.product_price+'</b> <br>'
            +'<i> <ss style="color:#019409">3<ss/>Sold in <ss style="color:#016d94">'+ftsel_pros.product_qnty+'</ss></i>'
            +'</div>'
            +'</div>'
            +'</a>';
        }
    }

    $("#resp_iimgs").html(row);
}
function number_format(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}

</script>
  <div class="search">
    <i class="fa fa-search"></i>
    <input type="search" placeholder="Search here" id="search_cont">
    <i class="fa fa-chevron-right" style="font-weight:bolder;color:#000;font-size:30px;" onclick="return mobSearch();"></i>
  </div>
</header>
<div class="toggleContent">
  <i class="fa fa-bars toggle"></i>
  <div class="cover">
    <div class="thumb pro">
      <img src="img/1.jpg">
    </div>
    <span>
        <a href="account.php">Sign In</a> | 
        <a href="account.php">Join here</a></span>
  </div>
  <ul>
    <a href=""><li><i class="fa fa-home"></i> Home</li></a>
<!--     <a href=""><li><i class="fa fa-list"></i> My Orders</li></a> -->
    <a href="cart.php"><li><i class="fa fa-shopping-cart"></i> Cart</li></a>
  <!--   <a href=""><li><i class="fa fa-heart"></i> Wishlist</li></a> -->
  </ul>
  <ul>
    <a href="https://e-gura.com"><li><i class="fa fa-dollar-sign"></i> Buy / Gura</li></a>
    <a href="https://e-gura.com/user_sell/index"><li><i class="fa fa-dollar-sign"></i> Sell / Gurisha</li></a>
  </ul>
<!--   <ul>
    <a href=""><li><i class="fa fa-question"></i> Help</li></a>
    <a href=""><li><i class="fa fa-star"></i> Feedback</li></a>
  </ul>
  <ul>
    <a href=""><li><i class="fa fa-lock"></i> Privacy Policy</li></a>
  </ul> -->
</div>
<div id="sch_resp">
  <div class="swiper-container">
    <div class="swiper-wrapper">
      <?php for ($i=1; $i < 9; $i++) {  ?>
       <div class="swiper-slide"> 
          <img src="img/<?php echo $i; ?>.jpg">
       </div>
       <?php } ?>
      </div>
      <div class="swiper-pagination"></div>
    </div>
    <!-- Add Arrows -->
<script type="text/javascript" src="js/swiper.min.js"></script>
 <script>
    var swiper = new Swiper('.swiper-container', {
      spaceBetween: 5,
      centeredSlides: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      }
    });
  </script>
  <div class="container">
  <!-- aha niho nashyize ama category ukandaho turiya two hejuru nakoresheje ifoto ubwo uzajya uyikur db -->
  <div class="categoryIcons">
    <?php
      echo $main_sys->mob_pro_cat_list();
    ?>
  </div>
<h1>More To Love</h1>
<div id="resp_iimgs">
  <?php
  echo $main_sys->mob_products_images();
  ?>
</div>
 </div>
</div>
 <?php require'footer.php'; ?>
</body>
</html>