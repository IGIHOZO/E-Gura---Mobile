<?php
session_start();
require("../../main/view.php");
$MainUser = new MainUser();
//GETTING SAFE INPUT VARIABLES
function get_input($inpt){
    return stripslashes($_GET[$inpt]);
}
//====================================================================================================== CONNECTION
class DbConnect
{

    private $host='localhost';
    private $dbName = 'eguraco1_egura';
    private $user = 'eguraco1';
    private $pass = 'sV.GemLj,X3Y';
    public $conn;
    
    // private $host='localhost';
    // private $dbName = 'eguraco1_egura';
    // private $user = 'eguraco1';
    // private $pass = 'sV.GemLj,X3Y';
    // public $conn;


    public function connect()
    {
        try {
         $conn = new PDO('mysql:host='.$this->host.';dbname='.$this->dbName, $this->user, $this->pass);
         return $conn;
        } catch (PDOException $e) {
            echo "Database Error ".$e->getMessage();
            return null;
        }
    }
}

//================================================================================================================ USER SIGNUP

class user_signup extends DbConnect{
    function send_email($email_to,$email_cc_1,$email_cc_2,$names){

        // the message
        $headers = "MIME-Version: 1.0 " . "\r\n" .
        "Content-type: text/html; charset=iso-8859-1" . "\r\n" .
        "From: TESTER <ddrigihozo@gmail.com> " . "\r\n" .
        "CC: $email_cc_1 " . "\r\n" .
        "CC: $email_cc_2 ";
        // subject
        $subject = "Welcome To E-Gura.";
        // use wordwrap() if lines are longer than 70 characters
        $msg = "
        <center>
        <img src='http://e-gura.com/images/logo/logo1.jpg' style='width:200px ;height:200px;margin-top:-100px'/>
        <h1>Hello <b><i>".$names." !</i></b></h1>


        <h3>
        <p> The whole community of E-GURA we'd like to personally thank you for signing up to our service. </p>
        <p>We established E-GURA Solution in order to enable our customers to sell/buy used and new products on affordable products.</p>
        <p>We’d love to hear what you think of our services and if there is anything we can improve. If you have any questions, please reply to this email: info@e-gura.com  . We're always happy to help!</p>
        </h3>

        <br><br> 

        <h4>Thank you for partning with E-Gura.</h4>


        </center>
        ";

        // send email
        try {
            mail($email_to,$subject,$msg,$headers);
        } catch (Exception $e) {
            echo "Email server problem ...";
        }

    }
    function __construct($fnm,$lnm,$eml,$nps,$cps){
        $conn = parent::connect();
        $sel_exist = $conn->prepare("SELECT * FROM egura_users WHERE egura_users.user_email='$eml'");
        $sel_exist->execute();
        if ($sel_exist->rowCount()<1) {
            $insrt_usr = $conn->prepare("INSERT INTO egura_users(user_fname,user_lname,user_email,user_pass,user_status) VALUES(?,?,?,?,?)");
            $insrt_usr->bindValue(1,$fnm);
            $insrt_usr->bindValue(2,$lnm);
            $insrt_usr->bindValue(3,$eml);
            $insrt_usr->bindValue(4,$nps);
            $insrt_usr->bindValue(5,'E');
            $ok_insrt_usr = $insrt_usr->execute();
            $lastId = $conn->lastInsertId();
            if ($ok_insrt_usr) {
                echo "<label id='respns_suc'>Signup Successfully ||  Login Now </label>";
                echo "<script>setCont('sgn_fname','');setCont('sgn_lname','');setCont('sgn_email','');setCont('sgn_npass','');setCont('sgn_cpass','');setCont('load1','');</script>";
                $eml_cc1 = "prutijana4@gmail.com";
                $eml_cc2 = "ddrigihozo@gmail.com";
                self::send_email($eml,$eml_cc1,$eml_cc2,strtoupper($fnm));
                $ft_insrt_usr = $insrt_usr->fetch(PDO::FETCH_ASSOC);
                //echo $lastId." - ".$eml;
                $_SESSION['egura']['all_name']=strtoupper($fnm).' '.ucfirst($lnm);
                $_SESSION['egura']['email']=$eml;
                $_SESSION['egura']['usrid']=$lastId;
                echo "<script>window.location='.?st=1/'</script>";
            }else{
                echo "Data recording failed ...";
            }

        }else{
            echo "User alredy exists ...";
        }
    }
}

class user_signup_andr extends DbConnect{
    function send_email($email_to,$email_cc_1,$email_cc_2,$names){

        // the message
        $headers = "MIME-Version: 1.0 " . "\r\n" .
        "Content-type: text/html; charset=iso-8859-1" . "\r\n" .
        "From: TESTER <ddrigihozo@gmail.com> " . "\r\n" .
        "CC: $email_cc_1 " . "\r\n" .
        "CC: $email_cc_2 ";
        // subject
        $subject = "Welcome To E-Gura.";
        // use wordwrap() if lines are longer than 70 characters
        $msg = "
        <center>
        <img src='http://e-gura.com/images/logo/logo1.jpg' style='width:200px ;height:200px;margin-top:-100px'/>
        <h1>Hello <b><i>".$names." !</i></b></h1>


        <h3>
        <p> The whole community of E-GURA we'd like to personally thank you for signing up to our service. </p>
        <p>We established E-GURA Solution in order to enable our customers to sell/buy used and new products on affordable products.</p>
        <p>We’d love to hear what you think of our services and if there is anything we can improve. If you have any questions, please reply to this email: info@e-gura.com  . We're always happy to help!</p>
        </h3>

        <br><br> 

        <h4>Thank you for partning with E-Gura.</h4>


        </center>
        ";

        // send email
        try {
            mail($email_to,$subject,$msg,$headers);
        } catch (Exception $e) {
            echo "Email server problem ...";
        }

    }
    function __construct($fnm,$lnm,$eml,$nps,$cps){
        $conn = parent::connect();
        $sel_exist = $conn->prepare("SELECT * FROM egura_users WHERE egura_users.user_email='$eml'");
        $sel_exist->execute();
        if ($sel_exist->rowCount()<1) {
            $insrt_usr = $conn->prepare("INSERT INTO egura_users(user_fname,user_lname,user_email,user_pass,user_status) VALUES(?,?,?,?,?)");
            $insrt_usr->bindValue(1,$fnm);
            $insrt_usr->bindValue(2,$lnm);
            $insrt_usr->bindValue(3,$eml);
            $insrt_usr->bindValue(4,$nps);
            $insrt_usr->bindValue(5,'E');
            $ok_insrt_usr = $insrt_usr->execute();
            $lastId = $conn->lastInsertId();
            if ($ok_insrt_usr) {
                echo "success";
                // echo "<script>setCont('sgn_fname','');setCont('sgn_lname','');setCont('sgn_email','');setCont('sgn_npass','');setCont('sgn_cpass','');setCont('load1','');</script>";
                // $eml_cc1 = "prutijana4@gmail.com";
                // $eml_cc2 = "ddrigihozo@gmail.com";
                //self::send_email($eml,$eml_cc1,$eml_cc2,strtoupper($fnm));
                //$ft_insrt_usr = $insrt_usr->fetch(PDO::FETCH_ASSOC);
                //echo $lastId." - ".$eml;
                // $_SESSION['egura']['all_name']=strtoupper($fnm).' '.ucfirst($lnm);
                // $_SESSION['egura']['email']=$eml;
                // $_SESSION['egura']['usrid']=$lastId;
                // echo "<script>window.location='.?st=1/'</script>";
            }else{
                echo "failed";
            }

        }else{
            echo "User alredy exists ...";
        }
    }
}

if (isset($_GET['onSubSignup'])) {
    new user_signup(get_input('sgnFnme'),get_input('sgnLnme'),get_input('sgnEmail'),get_input('sgnNPass'),get_input('sgnCPass'));
}elseif (isset($_POST['and_fname'])) {
    new user_signup_andr($_POST['and_fname'],$_POST['and_lname'],$_POST['and_email'],$_POST['and_npass'],$_POST['and_cpass']);
}


//==================================================================================================================== USER LOGIN


class user_login extends DbConnect{
    function __construct($eml,$ps){
        $conn = parent::connect();
        $sel_lgn = $conn->prepare("SELECT * FROM egura_users WHERE egura_users.user_email='$eml' AND egura_users.user_pass='$ps'");
        $sel_lgn->execute();
        if ($sel_lgn->rowCount()==1) {
            $ft_sel_lgn = $sel_lgn->fetch(PDO::FETCH_ASSOC);
            $_SESSION['egura']['all_name']=strtoupper($ft_sel_lgn['user_fname']).' '.ucfirst($ft_sel_lgn['user_lname']);
            if ($ft_sel_lgn['user_status']=="E") {
                $_SESSION['egura']['email']=$eml;
                $_SESSION['egura']['usrid']=$ft_sel_lgn['user_id'];
                echo "<script>window.location='.?st=1/'</script>";
            }else if ($ft_sel_lgn['user_status']=="A") {
                $_SESSION['egura_admin']['email']=$eml;
                $_SESSION['egura_admin']['usrid']=$ft_sel_lgn['user_id'];
                echo "<script>window.location='./admin'</script>";
            }else{
                echo "<b>".$ft_sel_lgn['user_status']."</b>";
            }
            //echo "<script>window.location='./'</script>";
        }else{
            echo "Wrong Email or Password ...";
        }
    }
}
class user_login_and extends DbConnect{
    function __construct($eml,$ps){
        $conn = parent::connect();
        $sel_lgn = $conn->prepare("SELECT * FROM egura_users WHERE egura_users.user_email='$eml' AND egura_users.user_pass='$ps'");
        $sel_lgn->execute();
        if ($sel_lgn->rowCount()==1) {
            $ft_sel_lgn = $sel_lgn->fetch(PDO::FETCH_ASSOC);
            $_SESSION['egura']['all_name']=strtoupper($ft_sel_lgn['user_fname']).' '.ucfirst($ft_sel_lgn['user_lname']);
            if ($ft_sel_lgn['user_status']=="E") {
                // $_SESSION['egura']['email']=$eml;
                // $_SESSION['egura']['usrid']=$ft_sel_lgn['user_id'];
                // echo "<script>window.location='.?st=1/'</script>";
                echo "success";
            }
            //echo "<script>window.location='./'</script>";
        }else{
            echo "failed";
        }
    }
}
if (isset($_GET['onSubLogin'])) {
    new user_login(get_input('logNme'),get_input('logPas'));
}elseif (isset($_POST['username']) AND isset($_POST['password'])) {
    new user_login_and($_POST['username'],$_POST['password']);
}

//================================================ AUTOLOAD ===== SELECT COUNTRIES
class CountriesSel extends DbConnect
{

    function __construct()
    {
        $conn=parent::connect();
        $cnts=$conn->query("SELECT num_code,en_short_name FROM egura_countries");
        if (($cnts->rowCount())>=1) {
            echo "<option value=''>---Select Country---</option>";
            while ($ft_cnts=$cnts->fetch(PDO::FETCH_ASSOC)) {
                if ($ft_cnts['num_code']==646) {
                    echo "<option selected='true' value='".$ft_cnts['num_code']."'>".$ft_cnts['en_short_name']."</option>";
                }else{
                    echo "<option value='".$ft_cnts['num_code']."'>".$ft_cnts['en_short_name']."</option>";
                }
            }
        }
    }
}
if (isset($_GET['autCountrie'])) {
    $CountriesSel = new CountriesSel();
}


//========================================================================= Proceed With Payment

class proc_paymeny extends DbConnect{

    function __construct($cntry,$distr,$sectr,$cll,$phne,$strt,$ppr,$uuusr,$qqnt){
    //  require("../../main/view.php");
$MainSystemData = new MainSystemData();
$MainUser = new MainUser();
        $conn = parent::connect();
        $u_eml = $_SESSION['egura']['email'];
        $sel_user = $conn->prepare("SELECT * FROM egura_users WHERE egura_users.user_email='$u_eml'");
        $sel_user->execute();
        if ($sel_user->rowCount()==1) {
            $ft_sel_user = $sel_user->fetch(PDO::FETCH_ASSOC);
            $user_id = $ft_sel_user['user_id'];
            $upd_usr = $conn->prepare("UPDATE egura_users SET egura_users.user_country=?,egura_users.user_district=?,egura_users.user_sector=?,egura_users.user_cell=?,egura_users.user_phone=?,egura_users.user_street=? WHERE egura_users.user_email=? AND egura_users.user_id=?");
            $upd_usr->bindValue(1,$cntry);
            $upd_usr->bindValue(2,$distr);
            $upd_usr->bindValue(3,$sectr);
            $upd_usr->bindValue(4,$cll);
            $upd_usr->bindValue(5,$phne);
            $upd_usr->bindValue(6,$strt);
            $upd_usr->bindValue(7,$u_eml);
            $upd_usr->bindValue(8,$user_id);
            $ok_upd_usr = $upd_usr->execute();

            if ($ok_upd_usr) {
                // echo "<label id='respns_suc'>Billing Details recorded Successfully || We'll contact you soon. </label>";
switch ($MainUser->user_street($uuusr)) {
    case '':
        $user_street="-";
        break;
    
    default:
        $user_street=$MainUser->user_street($uuusr);
        break;
}

switch ($MainSystemData->product_chipping($ppr)) {
    case 0:
        $pr_shiipping = "Free";
        break;
    
    default:
        $pr_shiipping = number_format($MainSystemData->product_chipping($ppr));
        break;
}

?>
<div class="container">
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" id="clck_mdl" data-target="#myModal" style="display: none; width: 900px">Open Large Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><label style="font-weight: bolder;font-size: 20px" class="modal-title" id="resp_mdl_ttl">Confirm to buy</label></center>
        </div>
        <div class="modal-body" id="resp_mdl_cnt">
         <!--  <p>This is a large modal.</p> -->
         <table style="color: black;" width="100%">  
            <tr style="font-weight: bolder;text-decoration: underline;font-size:25px;font-weight:bolderwidth: 100%">
                <td colspan="4" style="background-color: #000;color: #fff;text-decoration: underline;font-size:25px;font-weight:bolder">
                    <center>Product Details</center>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Product: 
                </td>
                <td colspan="2" style="font-weight: bolder;">
                    <?php echo $MainSystemData->product_name($ppr);?>
                </td>
            </tr>
            <tr style="background-color: #dee0df;">
                <td>
                    Price: 
                </td>
                <td style="font-weight: bolder;">
                    <?php echo number_format($MainSystemData->product_price($ppr));?>
                </td>
                <td>
                    &nbsp;&nbsp;&nbsp; Shipping:  
                </td>
                <td style="font-weight: bolder;">
                    <?php echo $pr_shiipping;?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Quantity: 
                </td>
                <td colspan="2" style="font-weight: bolder;">
                    <?php echo $qqnt;?>
                </td>
            </tr>
            <tr style="background-color: #dee0df;">
                <td colspan="2">
                    Details: 
                    
                </td>
                <td colspan="2">
                    <?php echo "<b>#Rwf &nbsp;</b>".number_format($MainSystemData->product_price($ppr))."  <b>(</b>".$qqnt."<b>)</b> + ".number_format($MainSystemData->product_chipping($ppr))."" ;?>
                </td>
            </tr>
            <tr>
                <td colspan="1">
                    Total: 
                </td>
                <td colspan="3" style="font-weight: bolder;">
                    <center>
                    <?php 
                    $total_amount = ($MainSystemData->product_price($ppr)*$qqnt)+$MainSystemData->product_chipping($ppr);
                    echo number_format($total_amount)."&nbsp;Rwf";
                    ?>
                    </center>
                </td>
            </tr>
            <tr><td colspan="4">&nbsp;&nbsp;&nbsp;</td></tr>
            <tr style="background-color: #000;color: #fff;font-weight: bolder;text-decoration: underline;font-size:25px;font-weight:bolder">
                <td colspan="4">
                    <center>Client Address</center>
                </td>
            </tr>
            <tr>
                <td>
                    Names: 
                </td>
                <td colspan="3" style="font-weight: bolder;">
                    <center>
                    <?php echo strtoupper($MainUser->user_fname($uuusr))." ".ucfirst($MainUser->user_lname($uuusr));?>
                    </center>
                </td>
            </tr>
            <tr style="background-color: #dee0df;">
                <td>
                    Phone: 
                </td>
                <td style="font-weight: bolder;">
                    <center>
                    <?php
                       // $phone = $MainUser->user_phone($uuusr);
                     echo $phne;
                     ?>
                    </center>
                </td>
                <td>
                    Email:
                </td>
                <td style="font-weight: bolder;text-transform: lowercase;">
                    <center>
                    <?php echo strtolower($MainUser->user_email($uuusr));?>
                    </center>
                </td>
            </tr>
            <tr><td colspan="4">&nbsp;&nbsp;&nbsp;</td></tr>
            <tr><td colspan="4">&nbsp;&nbsp;&nbsp;</td></tr>
            <tr style="background-color: #000;color: #fff;font-weight: bolder;text-decoration: underline;font-size:25px;font-weight:bolder">
                <td colspan="4" style="">
                    <center>Shipping Address</center>
                </td>
            </tr>
            <tr>
                <td>
                    District: 
                </td>
                <td style="font-weight: bolder;">
                    <center>
                    <?php echo $MainUser->user_district($uuusr);?>
                    </center>
                </td>
                <td>
                    Sector:
                </td>
                <td style="font-weight: bolder;text-transform: lowercase;">
                    <center>
                    <?php echo strtolower($MainUser->user_sector($uuusr));?>
                    </center>
                </td>
            </tr>
            <tr style="background-color: #dee0df;">
                <td colspan="2">
                    Cell: 
                </td>
                <td style="font-weight: bolder;">
                    <center>
                    <?php echo ucfirst(strtolower($MainUser->user_cell($uuusr)));?>
                    </center>
                </td>
                <td>
                    Street:
                </td>
                <td style="font-weight: bolder;text-transform: lowercase;text-align: center;">
                    <center style="float: left;">
                    <?php echo $user_street;?>
                    </center>
                </td>
            </tr>
         </table>

         <input type="hidden" id="pymt_data_phone" value="<?php echo $phne;?>">
         <input type="hidden" id="pymt_data_amount" value="<?php echo $total_amount;?>">

         <div style="float: right;margin-top: 4%">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button id="allPayConfrm" onclick="return allPayConfrm('<?php echo dt_enc($phne)?>','<?php echo dt_enc($total_amount)?>','<?php echo dt_enc($ppr)?>','<?php echo dt_enc($qqnt)?>','<?php echo dt_enc(ucfirst(strtolower($MainUser->user_district($uuusr))))?>','<?php echo dt_enc(ucfirst(strtolower($MainUser->user_sector($uuusr))))?>','<?php echo dt_enc(ucfirst(strtolower($MainUser->user_cell($uuusr))))?>','<?php echo dt_enc($user_street)?>','<?php echo dt_enc($pr_shiipping)?>');" class="btn btn-success" style="font-weight: bolder">Confirm and Pay</button>
         </div>
        </div>
<!--         <div class="modal-footer">

        </div> -->
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$("#clck_mdl").click();
</script>
<?php

            }else{
                echo "Billing records failed ...";
                //print_r($upd_usr->errorInfo());
            }
        }else{
            echo "Nooooooooo";
        }
    }
}

if (isset($_GET['proPayment'])) {
    new proc_paymeny(get_input('cntr'),get_input('dstr'),get_input('sctr'),get_input('cll'),get_input('phn'),get_input('strt'),get_input('pprro'),get_input('uusr'),get_input('qqnty'));
}

//================================================================================================================== BUY NOW BTN

class BuyNow extends DbConnect
{
    
    function __construct($pro,$usr,$qntt)
    {
        $pro = dt_dec($pro);
        $usr = dt_dec($usr);
        // $qntt = dt_dec($qntt);
        $conn = parent::connect();
        $sel_qntt = $conn->prepare("SELECT product_qnty FROM egura_products WHERE product_id='$pro' ");
        $sel_qntt->execute();
        if ($sel_qntt->rowCount()!=1) {
            echo $pro;
        }else{
            $ft_sel_qntt = $sel_qntt->fetch(PDO::FETCH_ASSOC);
            $prqt = $ft_sel_qntt['product_qnty'];
            if ($prqt >= $qntt) {
                ?>
                <script type="text/javascript">
                    var pro = "<?php echo dt_enc($pro);?>";
                    var usr = "<?php echo dt_enc($usr);?>";
                    var qnty = "<?php echo dt_enc($qntt);?>";
                    window.location="shipping.php?prr="+pro+"&usr="+usr+"&qnt="+qnty;
                </script>
                <?php
            }else{
                echo "Quantity entered is more than available in stock ...";
            }
        }
    }
}

if (isset($_GET['BuyNow'])) {
    new BuyNow(get_input('prid'),get_input('usrid'),get_input('prqnntty'));
}


// =========================================================================================================================== PRODUCT ADD


class onProAdd extends DbConnect
{
        function dt_encc($dt_enc_tda){
            return base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode($dt_enc_tda)))))))));
        }
        function send_email($emlto,$pro_idd,$email_cc_1,$email_cc_2){
            $enc_pro = self::dt_encc($pro_idd);
        // the message
        $headers = "MIME-Version: 1.0 " . "\r\n" .
        "Content-type: text/html; charset=iso-8859-1" . "\r\n" .
        "From: TESTER <ddrigihozo@gmail.com> " . "\r\n" .
        "CC: $email_cc_1 " . "\r\n" .
        "CC: $email_cc_2 ";
        // subject
        $subject = "E-GURA, Checkout New Product.";
        // use wordwrap() if lines are longer than 70 characters
        $msg = "
        <center>
        <img src='http://e-gura.com/images/logo/logo1.jpg' style='width:200px ;height:200px;margin-top:-100px'/>
        


        <h3>
        <p> Checkout Yhis new product uploaded On E-GURA by <a href='http://e-gura.com/product_details.php?pdd=$enc_pro'>Clicking Here !</>. </p>

        </h3>

        <br><br> 

        <h4>Thank you for partning with E-Gura.</h4>


        </center>
        ";

        // send email
        try {
            mail($emlto,$subject,$msg,$headers);
        } catch (Exception $e) {
            echo "Email server problem ...";
        }

    }
   
   function sys_prod_add($cat,$name,$price,$ship,$qnt,$desc,$file_name,$file_size,$file_type,$file_temp,$file_name_2,$file_size_2,$file_type_2,$file_temp_2,$file_name_3,$file_size_3,$file_type_3,$file_temp_3,$pr_color,$pr_sex,$pr_size){
    $currentDir = getcwd();
    $uploadDirectory = "/../../images/products/";

    $errors = []; // Store all foreseen and unforseen errors here

    $fileExtensions = ['jpeg','jpg','png','gif']; // Get all the file extensions

    $fileName = $file_name;
    $fileSize = $file_size;
    $fileTmpName  = $file_temp;
    $fileType = $file_type;
    $fileExtension = strtolower(end(explode('.',$fileName)));

    $uploadPath = $currentDir . $uploadDirectory . basename($fileName); 

    //===========

    $currentDir_2 = getcwd();
    $uploadDirectory_2 = "/../../images/products/";
    $errors_2 = []; // Store all foreseen and unforseen errors here

    $fileExtensions_2 = ['jpeg','jpg','png','gif']; // Get all the file extensions

    $fileName_2 = $file_name_2;
    $fileSize_2 = $file_size_2;
    $fileTmpName_2  = $file_temp_2;
    $fileType_2 = $file_type_2;
    $fileExtension_2 = strtolower(end(explode('.',$fileName_2)));

    $uploadPath_2 = $currentDir_2 . $uploadDirectory_2 . basename($fileName_2); 

    //============
    $currentDir_3 = getcwd();
    $uploadDirectory_3 = "/../../images/products/";
    $errors_3 = []; // Store all foreseen and unforseen errors here

    $fileExtensions_3 = ['jpeg','jpg','png','gif']; // Get all the file extensions

    $fileName_3 = $file_name_3;
    $fileSize_3 = $file_size_3;
    $fileTmpName_3  = $file_temp_3;
    $fileType_3 = $file_type_3;
    $fileExtension_3 = strtolower(end(explode('.',$fileName_3)));

    $uploadPath_3 = $currentDir_3 . $uploadDirectory_3 . basename($fileName_3); 

   // if (isset($_POST['submit'])) {

        if (! in_array($fileExtension,$fileExtensions) OR ! in_array($fileExtension_2,$fileExtensions_2) OR ! in_array($fileExtension_3,$fileExtensions_3)) {
            $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
            $errors_2[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
            $errors_3[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
        }

        if (($fileSize > 2000000) OR ($fileSize_2 > 2000000) OR ($fileSize_3 > 2000000)) {
            $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
            $errors_2[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
            $errors_3[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
        }

        if (empty($errors) OR empty($errors_2) OR empty($errors_3)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
            $didUpload_2 = move_uploaded_file($fileTmpName_2, $uploadPath_2);
            $didUpload_3 = move_uploaded_file($fileTmpName_3, $uploadPath_3);

            if ($didUpload AND $didUpload_2 AND $didUpload_3) {
                // echo "The file " . basename($fileName) . " has been uploaded";
               $pr_img_name = basename($fileName);
               $pr_img_name_2 = basename($fileName_2);
               $pr_img_name_3 = basename($fileName_3);
               $conn = parent::connect();
               //$pr_adder = $_SESSION['egura']['usrid'];
               $ins_pro = $conn->prepare("INSERT INTO egura_products(product_name,product_cat,product_qnty,product_price,product_chipping,product_descr,product_file,product_file_2,product_file_3,product_color,product_adder,product_sex,product_size,product_status) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
               $ins_pro->bindValue(1,$name);
               $ins_pro->bindValue(2,$cat);
               $ins_pro->bindValue(3,$qnt);
               $ins_pro->bindValue(4,$price);
               $ins_pro->bindValue(5,$ship);
               $ins_pro->bindValue(6,$desc);
               $ins_pro->bindValue(7,$pr_img_name);
               $ins_pro->bindValue(8,$pr_img_name_2);
               $ins_pro->bindValue(9,$pr_img_name_3);
               $ins_pro->bindValue(10,$pr_color);
               $ins_pro->bindValue(11,$_SESSION['egura_admin']['usrid']);
               $ins_pro->bindValue(12,$pr_sex);
               $ins_pro->bindValue(13,$pr_size);
               $ins_pro->bindValue(14,"E");
               $ok_ins_pro = $ins_pro->execute();
               if ($ok_ins_pro) {
                //================================= SEND ALL Email UPDATES
                $pro_id = 20;
                $sel_all_usrs = $conn->prepare("SELECT * FROM egura_users WHERE user_status='E'");
                $sel_all_usrs->execute();
                if ($sel_all_usrs->rowCount()>=1) {
                    while ($ft_sel_all_usrs = $sel_all_usrs->fetch(PDO::FETCH_ASSOC)) {
                        $usr_email = $ft_sel_all_usrs['user_email'];
                        //$this->send_email($usr_email,$pro_id,"didierigihozo07@gmail.com","prutijana3@gmail.com");
                        $this->send_email($usr_email,$pro_id,"ddrigihozo@gmail.com","prutijana4@gmail.com");
                    }
                }
                  ?>
                  <script type="text/javascript">window.location="../../admin/add_product.php?res=true"</script>
                  <?php
               }else{
                  echo "FAILED TO RECORD ...";
               }

            } else {
                echo "An error occurred somewhere. Try again or contact the admin";
            }
        } else {
            foreach ($errors as $error) {
                echo $error . "These are the errors" . "\n";
            }
        }
    //}


   }
}


if (isset($_POST['onProAdd'])) {
   $onProAdd = new onProAdd();
   $onProAdd->sys_prod_add($_POST['pr_cat'],$_POST['pr_name'],$_POST['pr_price'],$_POST['pr_ship'],$_POST['pr_qnty'],$_POST['pr_descr'],$_FILES['pro_pic']['name'],$_FILES['pro_pic']['size'],$_FILES['pro_pic']['type'],$_FILES['pro_pic']['tmp_name'],$_FILES['pro_pic_2']['name'],$_FILES['pro_pic_2']['size'],$_FILES['pro_pic_2']['type'],$_FILES['pro_pic_2']['tmp_name'],$_FILES['pro_pic_3']['name'],$_FILES['pro_pic_3']['size'],$_FILES['pro_pic_3']['type'],$_FILES['pro_pic_3']['tmp_name'],$_POST['pr_color'],$_POST['pr_sex'],$_POST['pr_size']);
}



// =========================================================================================================================== USER SELL


class userSell extends DbConnect
{
   
   function sys_prod_add($cat,$name,$price,$ship,$qnt,$desc,$file_name,$file_size,$file_type,$file_temp,$file_name_2,$file_size_2,$file_type_2,$file_temp_2,$file_name_3,$file_size_3,$file_type_3,$file_temp_3,$pr_color,$pr_sex,$pr_size){
    $currentDir = getcwd();
    $uploadDirectory = "/../../images/products/";

    $errors = []; // Store all foreseen and unforseen errors here

    $fileExtensions = ['jpeg','jpg','png','gif']; // Get all the file extensions

    $fileName = $file_name;
    $fileSize = $file_size;
    $fileTmpName  = $file_temp;
    $fileType = $file_type;
    $fileExtension = strtolower(end(explode('.',$fileName)));

    $uploadPath = $currentDir . $uploadDirectory . basename($fileName); 

    //===========

    $currentDir_2 = getcwd();
    $uploadDirectory_2 = "/../../images/products/";
    $errors_2 = []; // Store all foreseen and unforseen errors here

    $fileExtensions_2 = ['jpeg','jpg','png','gif']; // Get all the file extensions

    $fileName_2 = $file_name_2;
    $fileSize_2 = $file_size_2;
    $fileTmpName_2  = $file_temp_2;
    $fileType_2 = $file_type_2;
    $fileExtension_2 = strtolower(end(explode('.',$fileName_2)));

    $uploadPath_2 = $currentDir_2 . $uploadDirectory_2 . basename($fileName_2); 

    //============
    $currentDir_3 = getcwd();
    $uploadDirectory_3 = "/../../images/products/";
    $errors_3 = []; // Store all foreseen and unforseen errors here

    $fileExtensions_3 = ['jpeg','jpg','png','gif']; // Get all the file extensions

    $fileName_3 = $file_name_3;
    $fileSize_3 = $file_size_3;
    $fileTmpName_3  = $file_temp_3;
    $fileType_3 = $file_type_3;
    $fileExtension_3 = strtolower(end(explode('.',$fileName_3)));

    $uploadPath_3 = $currentDir_3 . $uploadDirectory_3 . basename($fileName_3); 

   // if (isset($_POST['submit'])) {

        if (! in_array($fileExtension,$fileExtensions) OR ! in_array($fileExtension_2,$fileExtensions_2) OR ! in_array($fileExtension_3,$fileExtensions_3)) {
            $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
            $errors_2[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
            $errors_3[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
        }

        if (($fileSize > 2000000) OR ($fileSize_2 > 2000000) OR ($fileSize_3 > 2000000)) {
            $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
            $errors_2[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
            $errors_3[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
        }

        if (empty($errors) OR empty($errors_2) OR empty($errors_3)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
            $didUpload_2 = move_uploaded_file($fileTmpName_2, $uploadPath_2);
            $didUpload_3 = move_uploaded_file($fileTmpName_3, $uploadPath_3);

            if ($didUpload AND $didUpload_2 AND $didUpload_3) {
                // echo "The file " . basename($fileName) . " has been uploaded";
               $pr_img_name = basename($fileName);
               $pr_img_name_2 = basename($fileName_2);
               $pr_img_name_3 = basename($fileName_3);
               $conn = parent::connect();
               $pr_adder = $_SESSION['egura']['usrid'];
               $ins_pro = $conn->prepare("INSERT INTO egura_products(product_name,product_cat,product_qnty,product_price,product_chipping,product_descr,product_file,product_file_2,product_file_3,product_adder,product_color,product_sex,product_size,product_status) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
               $ins_pro->bindValue(1,$name);
               $ins_pro->bindValue(2,$cat);
               $ins_pro->bindValue(3,$qnt);
               $ins_pro->bindValue(4,$price);
               $ins_pro->bindValue(5,$ship);
               $ins_pro->bindValue(6,$desc);
               $ins_pro->bindValue(7,$pr_img_name);
               $ins_pro->bindValue(8,$pr_img_name_2);
               $ins_pro->bindValue(9,$pr_img_name_3);
               $ins_pro->bindValue(10,$pr_adder);
               $ins_pro->bindValue(11,$pr_color);
               $ins_pro->bindValue(12,$pr_sex);
               $ins_pro->bindValue(13,$pr_size);
               $ins_pro->bindValue(14,"NY");
               $ok_ins_pro = $ins_pro->execute();
               if ($ok_ins_pro) {
                  ?>
                  <script type="text/javascript">window.location="../../user_sell/?res=true"</script>
                  <?php
               }else{
                  echo "FAILED TO RECORD ...";
               }

            } else {
                echo "An error occurred somewhere. Try again or contact the admin";
            }
        } else {
            foreach ($errors as $error) {
                echo $error . "These are the errors" . "\n";
            }
        }
    //}


   }
}


if (isset($_POST['userSell'])) {
   $userSell = new userSell();
   $userSell->sys_prod_add($_POST['pr_cat'],$_POST['pr_name'],$_POST['pr_price'],$_POST['pr_ship'],$_POST['pr_qnty'],$_POST['pr_descr'],$_FILES['pro_pic']['name'],$_FILES['pro_pic']['size'],$_FILES['pro_pic']['type'],$_FILES['pro_pic']['tmp_name'],$_FILES['pro_pic_2']['name'],$_FILES['pro_pic_2']['size'],$_FILES['pro_pic_2']['type'],$_FILES['pro_pic_2']['tmp_name'],$_FILES['pro_pic_3']['name'],$_FILES['pro_pic_3']['size'],$_FILES['pro_pic_3']['type'],$_FILES['pro_pic_3']['tmp_name'],$_POST['pr_color'],$_POST['pr_sex'],$_POST['pr_size']);
}


//======================================================================================================================================================

/**
 * ================================================================================================ CONFIRM PRODUCT
 */
class ConfirmProduct extends DbConnect
{
    
    function __construct($prod,$page)
    {
        $conn = parent::connect();
        $upd_pro = $conn->prepare("UPDATE egura_products SET product_status=? WHERE product_id=?");
        $upd_pro->bindValue(1,"E");
        $upd_pro->bindValue(2,$prod);
        $upd_pro->execute();
        $ok_upd_pro = $upd_pro->execute();
        if ($ok_upd_pro) {

                // if ($page==true) {
                //     # code...
                // }else{

                // }
            }else{
                echo "Confirmation Failed ...";
            }
    }
}
if (isset($_GET['confirmProduct'])) {
    new ConfirmProduct(get_input("prd"),get_input("pge"));
}

/**
 * ================================================================================================ CONFIRM PRODUCT
 */
class deleteProduct extends DbConnect
{
    
    function __construct($prod,$page)
    {
        $conn = parent::connect();
        $upd_pro = $conn->prepare("DELETE FROM egura_products WHERE product_id=?");
        $upd_pro->bindValue(1,$prod);
        $upd_pro->execute();
        $ok_upd_pro = $upd_pro->execute();
        if ($ok_upd_pro) {

                // if ($page==true) {
                //     # code...
                // }else{

                // }
            }else{
                echo "Confirmation Failed ...";
            }
    }
}
if (isset($_GET['deleteProduct'])) {
    new deleteProduct(get_input("prd"),get_input("pge"));
}

/**
 * ======================================================================== Final Request Deny
 */
class condProdReq extends DbConnect
{
    
    function __construct($prod)
    {
        $conn = parent::connect();
        $upd_pro = $conn->prepare("UPDATE egura_products SET product_status=? WHERE product_id=?");
        $upd_pro->bindValue(1,"Deny");
        $upd_pro->bindValue(2,$prod);
        $upd_pro->execute();
        $ok_upd_pro = $upd_pro->execute();
        if ($ok_upd_pro) {

                // if ($page==true) {
                //     # code...
                // }else{

                // }
            }else{
                echo "Confirmation Failed ...";
            }
    }
}
//=============================================================== Confirm OR Denny Product Request
if (isset($_GET['condProdReq']) AND isset($_GET['status'])) {
    switch ($_GET['status']) {
        case 'Confirm':
            new ConfirmProduct(get_input("product"),'true');
            break;
        case 'Deny':
            new condProdReq(dt_dec(get_input("product")));
            break;
        
        default:
            # code...
            break;
    }
}

//================================================================================================================ Sub Select Category
if (isset($_GET['selSubCat'])) {
    echo $MainUser->sel_pr_cat_sub($_GET['mnCat']);
}


/**
 * =========================================================================================================================  SEARCH PRODUCT
 */
class SearchProduct extends DbConnect
{
    
    function __construct($content)
    {
        $conn = parent::connect();
        $ssel_pr = $conn->prepare("SELECT egura_products.* FROM egura_products WHERE egura_products.product_name LIKE '$content%' OR egura_products.product_descr LIKE '$content%' OR egura_products.product_cat=(SELECT prod_sub_cat.sub_cat_id FROM prod_sub_cat WHERE prod_sub_cat.sub_cat_name LIKE '$content%')");
        $ssel_pr->execute();
        if ($ssel_pr->rowCount()>=1) {
            while ($ft_ssel_pr = $ssel_pr->fetch(PDO::FETCH_ASSOC)) {
                $pr_id = $ft_ssel_pr['product_id'];
?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img style="width: 200px;height: 200px" src="images/products/<?php echo $ft_ssel_pr['product_file'];?>" alt="" />
                                            <h2><?php echo number_format($ft_ssel_pr['product_price'])." <span style='color:#c28763'> Rwf</span>"?></h2>
                                            <p><?php echo $ft_ssel_pr['product_name']?></p>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Buy / Gura</a>
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2><?php echo $ft_ssel_pr['product_price']?></h2>
                                                <p><?php echo $ft_ssel_pr['product_descr']?></p>
                                                <?php
                                                if (isset($_SESSION['egura']['email'])) {
                                                    ?>
                                                        <a href="product_details.php?pdd=<?php echo dt_enc($pr_id);?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Buy / Gura</a>
                                                    <?php
                                                }else{
                                                    ?>
                                                        <a href="login.php" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Buy / Gura</a>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                </div>

                            </div>
                        </div>
<?php
            }
        }else{
            echo "<center style='color:#e45453;font-size:200%;font-weight:bolder'>No Result Found ...</center>";
        }

    }
}
if (isset($_GET['searchEgura'])) {
    new SearchProduct(get_input("conttent"));
}


/**
 * ============================================================================================================== PRODUCT CATEGORY
 */
class SearchProductCategory extends DbConnect
{
    
    function __construct($category)
    {
        $conn = parent::connect();
        $ssel_pr = $conn->prepare("SELECT * FROM egura_products WHERE product_cat='$category'");
        $ssel_pr->execute();
        if ($ssel_pr->rowCount()>=1) {
            while ($ft_ssel_pr = $ssel_pr->fetch(PDO::FETCH_ASSOC)) {
                $pr_id = $ft_ssel_pr['product_id'];
?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img style="width: 200px;height: 200px" src="images/products/<?php echo $ft_ssel_pr['product_file'];?>" alt="" />
                                            <h2><?php echo number_format($ft_ssel_pr['product_price'])." <span style='color:#c28763'> Rwf</span>"?></h2>
                                            <p><?php echo $ft_ssel_pr['product_name']?></p>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Buy / Gura</a>
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2><?php echo $ft_ssel_pr['product_price']?></h2>
                                                <p><?php echo $ft_ssel_pr['product_descr']?></p>
                                                <?php
                                                if (isset($_SESSION['egura']['email'])) {
                                                    ?>
                                                        <a href="product_details.php?pdd=<?php echo dt_enc($pr_id);?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Buy / Gura</a>
                                                    <?php
                                                }else{
                                                    ?>
                                                        <a href="login.php" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Buy / Gura</a>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                </div>

                            </div>
                        </div>
<?php
            }
        }else{
            echo "<center style='color:#e45453;font-size:200%;font-weight:bolder'>No Result Found ...</center>";
        }

    }
}
if (isset($_GET['searchProductCategory'])) {
    new SearchProductCategory(get_input("category"));
}
/**
 * ======================================================================================================== UPDATE PRODUCT
 */
class updProduct extends DbConnect
{
    
    function __construct($proName,$proPrice,$proDescr,$proShip,$proIdd)
    {
        $pro_id = dt_dec($proIdd);
        $conn = parent::connect();
        $upd_pr = $conn->prepare("UPDATE egura_products SET product_name=?,product_price=?,product_descr=?,product_chipping=? WHERE product_id=?");
        $upd_pr->bindValue(1,$proName);
        $upd_pr->bindValue(2,$proPrice);
        $upd_pr->bindValue(3,$proDescr);
        $upd_pr->bindValue(4,$proShip);
        $upd_pr->bindValue(5,$pro_id);
        $ok_upd_pr = $upd_pr->execute();
        if ($ok_upd_pr) {
            echo "<script>window.location='all_products.php'</script>";
        }
    }
}



if (isset($_GET['updProduct'])) {
   new updProduct(get_input('proName'),get_input('proPrice'),get_input('proDescr'),get_input('proShip'),get_input('proIdd'));
}


/**
 * ========================================================================================== FORGOT PASSWORD
 */
class onSbmtFrgPss extends DbConnect
{

    function send_email($email_to,$email_cc_1,$email_cc_2,$new_pass){

        // the message
        $headers = "MIME-Version: 1.0 " . "\r\n" .
        "Content-type: text/html; charset=iso-8859-1" . "\r\n" .
        "From: TESTER <ddrigihozo@gmail.com> " . "\r\n" .
        "CC: $email_cc_1 " . "\r\n" .
        "CC: $email_cc_2 ";
        // subject
        $subject = "New Password from password recovery.";
        // use wordwrap() if lines are longer than 70 characters
        $nw_ps = $new_pass;
        $msg = "
        <center>
        <img src='http://e-gura.com/images/logo/logo1.jpg' style='width:200px ;height:200px;margin-top:-100px'/>
        <h2>
        Your New Account Password is:
        </h2>

         <h1><b><i><u>
        ".$nw_ps."
        </u></i></b></h1>.  
        <h3>
        You are allowed to change it to your prefered one.
        </h3>

        <br><br> 

        <h4>Thank you for partning with E-Gura.</h4>


        </center>
        ";

        // send email
        try {
            mail($email_to,$subject,$msg,$headers);
        } catch (Exception $e) {
            echo "Email server problem ...";
        }

    }
    
    function __construct($email)
    {
        $conn = parent::connect();
        $sel_email = $conn->prepare("SELECT * FROM egura_users WHERE user_email='$email' AND user_status='E'");
        $sel_email->execute();
        if ($sel_email->rowCount()==1) {
           $ft_sel_email = $sel_email->fetch(PDO::FETCH_ASSOC);
           $usr_id = $ft_sel_email['user_id'];
            $new_usr_pass = rand(10000000, 99999999);
          $upd_pss = $conn->prepare("UPDATE egura_users SET user_pass=? WHERE user_id=? AND user_status=?");
          $upd_pss->bindValue(1,$new_usr_pass);
          $upd_pss->bindValue(2,$usr_id);
          $upd_pss->bindValue(3,"E");
          $ok_upd_pss = $upd_pss->execute();
          if ($ok_upd_pss) {
            $to_email = $ft_sel_email['user_email'];
                // $eml_cc1 = "prutijana3@gmail.com";
                // $eml_cc2 = "didierigihozo07@gmail.com";
                $eml_cc1 = "prutijana4@gmail.com";
                $eml_cc2 = "ddrigihozo@gmail.com";
              self::send_email($to_email,$eml_cc1,$eml_cc2,$new_usr_pass);

              echo "<span style='color:green;'>Check new password on your email.</span>";
          }else{
            echo "Failed, try again later ...";
          }

        }else{
            echo "<span style='color:green;'>Check new password on your email.</span>";
        }
    }
}

if (isset($_GET['onSbmtFrgPss'])) {
   new onSbmtFrgPss(get_input('usr_email'));
}

































































?>