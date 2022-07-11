<?php
session_start();
require("../../main/view.php");
//require("../../js/ajax/main.php");
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
/**
 * =========================================================================================== RESTERING PRODUCT ORDER
 */
class RegProdOrder extends DbConnect
{
    
    function __construct($user,$prod,$qnty,$tr_id,$tr_stts,$dist,$sect,$cell,$phone,$street,$status,$succc_msg,$shipp,$amount)
    {
    	if (!is_numeric($shipp)) {
    		$shipp = 0;
    	}

        $conn = parent::connect();
        $ins_order = $conn->prepare("INSERT INTO egura_orders(order_user,order_product,order_quantity,order_shipping,order_total,order_tr_id,order_tr_status,order_district,order_sector,order_cell,order_mobile,order_street,order_status) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $ins_order->bindValue(1,$user);
        $ins_order->bindValue(2,$prod);
        $ins_order->bindValue(3,$qnty);
        $ins_order->bindValue(4,$shipp);
        $ins_order->bindValue(5,$amount);
        $ins_order->bindValue(6,$tr_id);
        $ins_order->bindValue(7,$tr_stts);
        $ins_order->bindValue(8,$dist);
        $ins_order->bindValue(9,$sect);
        $ins_order->bindValue(10,$cell);
        $ins_order->bindValue(11,$phone);
        $ins_order->bindValue(12,$street);
        $ins_order->bindValue(13,$status);
        $ok_ins_order = $ins_order->execute();
        if ($ok_ins_order) {
            echo "<span style='color:green;font-size:20px;font-weight:bolder'>".$succc_msg."</span>";
        }else{
           echo "Request Failed ....";

        }
    }
}


function sendInTouhcPayment($amount,$phone,$prod,$qnty,$dist,$sect,$cell,$street,$shipp){
	$url = 'https://www.intouchpay.co.rw/api/requestpayment/';
	$reqTransaction = substr(rand()*1000000,0,5);
$data = array("username"=>"testa",
    							"timestamp" => date("Ymdhis",time()),
    							"amount"=>$amount,
						    	"password" => hash("sha256","testa250160000011pass123456789".date("Ymdhis",time())),
						        "mobilephone" => $phone,
						        "requesttransactionid" => $reqTransaction
 
);
$data_string = json_encode($data);
//echo $data_string;
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
//curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER,
    array(
        'Content-Type:application/json'
    )
);

$result = curl_exec($ch);
//echo $result;

// echo "ResCode: ". json_decode($result)->responsecode."<br>";
// echo "Message: ". json_decode($result)->message."<br>";
// echo "Success: ". json_decode($result)->success."<br>";
switch (json_decode($result)->success) {
	case true:
		$succc_msg = json_decode($result)->message;
		$user_id = $_SESSION['egura']['usrid'];
		new RegProdOrder($user_id,$prod,$qnty,$reqTransaction,'Pending',$dist,$sect,$cell,$phone,$street,'E',$succc_msg,$shipp,$amount);
		// echo "<br> ".$amount;
		// echo "<br> ".$phone;
		// echo "<br> ".$prod;
		// echo "<br> ".$qnty;
		// echo "<br> ".$dist;
		// echo "<br>".$sect;
		// echo "<br> ".$cell;
		// echo "<br> ".$street;
		break;
	
	default:
		echo json_decode($result)->message;
		break;
}

curl_close($ch);
}
if (isset($_GET['allPayConfrm']) AND isset($_GET['rJaS']) AND isset($_GET['sAjR'])) {
	//sendInTouhcPayment(100,"250784634118");
	sendInTouhcPayment(dt_dec($_GET['rJaS']),dt_dec($_GET['sAjR']),dt_dec($_GET['prod']),dt_dec($_GET['qnty']),dt_dec($_GET['dist']),dt_dec($_GET['sect']),dt_dec($_GET['cell']),dt_dec($_GET['street']),dt_dec($_GET['shipp']));
}

?>