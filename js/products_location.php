<?php
if(isset($_GET['fetch'])){
    fetchProducts();
}
function fetchProducts(){
    header("Content-Type:application/json");
    try{
        $conn = new PDO("mysql:host=localhost;dbname=eguraco1_egura","eguraco1","sV.GemLj,X3Y");
        //user information
        $userQy = $conn->query("SELECT * FROM egura_users eu WHERE eu.user_id IN (SELECT product_adder FROM egura_products) LIMIT 30");
        $userQy->execute();
        $userInfo = $userQy->fetchAll(PDO::FETCH_ASSOC);

        for($i=0;$i<count($userInfo);$i++){
            $user = $userInfo[$i];
            $r = $conn->prepare("SELECT * FROM egura_products ep WHERE ep.product_adder=:users ORDER BY ep.product_cat");
            $r->execute(['users'=>$user['user_id']]);
            $userInfo[$i]['products'] = $r->fetchAll(PDO::FETCH_ASSOC);
        }
        echo json_encode($userInfo);
    }catch (PDOException $ex){
        echo "Can't connect to db ".$ex->getMessage();
    }
}
?>