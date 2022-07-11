<?php

// //====================================================================================================== CONNECTION
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
// /**
//  * =====================================test RECEIVED
//  */
class UpdateOrder extends DbConnect
{
	
	function __construct($tr_id)
	{
		$conn = parent::connect();
		$upd_record = $conn->prepare("UPDATE egura_orders SET order_tr_status=? WHERE order_tr_id=?");
		
		$upd_record->bindValue(1,"Success");
		$upd_record->bindValue(2,$tr_id);
		$ok_upd_record = $upd_record->execute();
		if ($ok_upd_record) {
			echo "Transaction Received and recorded by e-gura";
		}else{
			//echo "Transaction hasn't been recorded by e-gura ...";
			print_r($upd_record->errorInfo());
		}

	}
}


header('Content-Type: application/json;charset=utf-8');
$data = file_get_contents('php://input');
$da=json_decode($data,true);
//echo json_encode($da);
$tr_id = $da['data']['requesttransactionid'];


new UpdateOrder($tr_id);




?>