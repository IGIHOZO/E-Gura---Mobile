<?php
// function dt_enc($dt_enc_tda){
//     return base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode($dt_enc_tda)))))))));
// }

// //BASE_64 DECODE
// function dt_dec($dt_dec_tda){
//     return base64_decode(base64_decode(base64_decode(base64_decode(base64_decode(base64_decode(base64_decode(base64_decode(base64_decode($dt_dec_tda)))))))));
// }

function dt_enc($dt_enc_tda){
    return $dt_enc_tda;
}

//BASE_64 DECODE
function dt_dec($dt_dec_tda){
    return $dt_dec_tda;
}
//====================================================================================================== CONNECTION
class DbConnectt
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
 * ======================================================================================================== MAIN SYSTEM DATA CLASS
 */
class MainSystemData extends DbConnectt
{
        //================================================== DISPLAYING PRODUCTS    
    function products_images($st,$end)
    {
        $conn = parent::connect();
        $sel_pros = $conn->prepare("SELECT * FROM egura_products WHERE product_status='E' order by RAND() DESC LIMIT $st,$end");
        $sel_pros->execute();
        if ($sel_pros->rowCount()>=1) {
            while ($ftsel_pros = $sel_pros->fetch(PDO::FETCH_ASSOC)) {
                $pr_id = $ftsel_pros['product_id'];
                ?>
                        <div class="col-sm-4 col-md-4" style="height: 430px;position: relative;margin-top: 0px;float: left;">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img style="width: 98%;height: 240px;position: relative;" src="images/products/<?php echo $ftsel_pros['product_file'];?>" alt="" />
                                            <h2><?php echo number_format($ftsel_pros['product_price'])." <span style='color:#c28763'> Rwf</span>"?></h2>
                                            <p style="font-weight: bolder;font-size: 20px"><?php echo $ftsel_pros['product_name']?></p>
                                            <?php
                                            if (isset($_COOKIE['egura_user_email'])) {
                                                ?>
                                                <a id="mn_by_btn" style="background-color: #cc361f;color: #fff;border-radius: 40px;" href="product_details?pdd=<?php echo dt_enc($pr_id);?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-bag"></i>Buy / Gura</a>

                                                &nbsp;

                                                <button onclick="return window.location='add_to_cart?pdd=<?php echo dt_enc($pr_id);?>'" style="opacity: 1;font-weight:bolder;background-color: #fff;color: #cc361f;border-radius: 40px;width: 120px;" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>

                                                <?php
                                            }else{
                                                ?>
                                                <a id="mn_by_btn" href="login" style="background-color: #cc361f;color: #fff;border-radius: 40px;" class="btn btn-default add-to-cart"><i class="fa fa-shopping-bag"></i>Buy / Gura</a>

                                                <button onclick="return window.location='login'" style="opacity: 1;font-weight:bolder;background-color: #fff;color: #cc361f;border-radius: 40px;width: 120px;float: right;" href="product_details?pdd=<?php echo dt_enc($pr_id);?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                <?php
                                            }
                                            ?>
                                                
                                        </div>
                                        <div class="product-overlay" style="opacity: 0.8;">
                                            <div class="overlay-content" style="opacity: 0.8;">
                                                <h2><?php echo $ftsel_pros['product_price']?></h2>
                                                <p style="opacity: 1;font-weight:bolder;"><?php echo $ftsel_pros['product_descr']?></p>
                                                <?php
                                                if (isset($_COOKIE['egura_user_email'])) {
                                                    ?>
                                                        <a style="opacity: 1;font-weight:bolder;background-color: #fff;color: #cc361f;border-radius: 40px;width: 120px;" href="product_details?pdd=<?php echo dt_enc($pr_id);?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-bag"></i>Buy / Gura</a>

                                                        &nbsp;

                                                        <button onclick="return window.location='add_to_cart?pdd=<?php echo dt_enc($pr_id);?>'" style="opacity: 1;font-weight:bolder;background-color: #fff;color: #cc361f;border-radius: 40px;width: 120px;" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                    <?php
                                                }else{
                                                    ?>
                                                        <a href="login" style="opacity: 1;font-weight:bolder;background-color: #fff;color: #cc361f;border-radius: 40px;width: 120px;" class="btn btn-default add-to-cart"><i class="fa fa-shopping-bag"></i>Buy / Gura</a>

                                                        &nbsp;

                                                        <button onclick="return window.location='login'" style="opacity: 1;font-weight:bolder;background-color: #fff;color: #cc361f;border-radius: 40px;width: 120px;" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>

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
        }
    }
        //================================================================================================================================= IMAGE NAME ONE
    function image_name($img_id){
        $conn = parent::connect();
        $sel_imgpr = $conn->prepare("SELECT egura_products.product_file FROM egura_products WHERE egura_products.product_id='$img_id'");
        $sel_imgpr->execute();
        if ($sel_imgpr->rowCount()==1) {
            $ftsel_imgpr = $sel_imgpr->fetch(PDO::FETCH_ASSOC);
            $pf_file = $ftsel_imgpr['product_file'];
            return $pf_file;
        }else{
            return null;
        }
    }
        //================================================================================================================================= IMAGE NAME TWO 
    function image_name_2($img_id){
        $conn = parent::connect();
        $sel_imgpr = $conn->prepare("SELECT egura_products.product_file_2 FROM egura_products WHERE egura_products.product_id='$img_id'");
        $sel_imgpr->execute();
        if ($sel_imgpr->rowCount()==1) {
            $ftsel_imgpr = $sel_imgpr->fetch(PDO::FETCH_ASSOC);
            $pf_file = $ftsel_imgpr['product_file_2'];
            return $pf_file;
        }else{
            return null;
        }
    }
        //================================================================================================================================= IMAGE NAME THREE
    function image_name_3($img_id){
        $conn = parent::connect();
        $sel_imgpr = $conn->prepare("SELECT egura_products.product_file_3 FROM egura_products WHERE egura_products.product_id='$img_id'");
        $sel_imgpr->execute();
        if ($sel_imgpr->rowCount()==1) {
            $ftsel_imgpr = $sel_imgpr->fetch(PDO::FETCH_ASSOC);
            $pf_file = $ftsel_imgpr['product_file_3'];
            return $pf_file;
        }else{
            return null;
        }
    }

        //================================================================================================================================= PRODUCT CATEGORY
    function product_cat($img_id){
        $conn = parent::connect();
        $sel_imgpr = $conn->prepare("SELECT egura_products.product_cat AS aa,prod_sub_cat.sub_cat_category AS bb,pro_categories.cat_name AS cc FROM egura_products,prod_sub_cat,pro_categories WHERE egura_products.product_cat=prod_sub_cat.sub_cat_id AND prod_sub_cat.sub_cat_category=pro_categories.cat_id AND egura_products.product_id='$img_id'");
        $sel_imgpr->execute();
        if ($sel_imgpr->rowCount()==1) {
            $ftsel_imgpr = $sel_imgpr->fetch(PDO::FETCH_ASSOC);
            $pf_file = $ftsel_imgpr['cc'];
            return $pf_file;
        }else{
            return null;
        }
    }

        //================================================================================================================================= PRODUCT NAME
    function product_name($img_id){
        $conn = parent::connect();
        $sel_imgpr = $conn->prepare("SELECT egura_products.product_name FROM egura_products WHERE egura_products.product_id='$img_id'");
        $sel_imgpr->execute();
        if ($sel_imgpr->rowCount()==1) {
            $ftsel_imgpr = $sel_imgpr->fetch(PDO::FETCH_ASSOC);
            $pf_file = $ftsel_imgpr['product_name'];
            return $pf_file;
        }else{
            return null;
        }
    }

        //================================================================================================================================= PRODUCT QNTTY
    function product_qnty($img_id){
        $conn = parent::connect();
        $sel_imgpr = $conn->prepare("SELECT egura_products. product_qnty FROM egura_products WHERE egura_products.product_id='$img_id'");
        $sel_imgpr->execute();
        if ($sel_imgpr->rowCount()==1) {
            $ftsel_imgpr = $sel_imgpr->fetch(PDO::FETCH_ASSOC);
            $pf_file = $ftsel_imgpr['product_qnty'];
            return $pf_file;
        }else{
            return null;
        }
    }
        //================================================================================================================================= PRODUCT PRICE
    function product_price($img_id){
        $conn = parent::connect();
        $sel_imgpr = $conn->prepare("SELECT egura_products.product_price FROM egura_products WHERE egura_products.product_id='$img_id'");
        $sel_imgpr->execute();
        if ($sel_imgpr->rowCount()==1) {
            $ftsel_imgpr = $sel_imgpr->fetch(PDO::FETCH_ASSOC);
            $pf_file = $ftsel_imgpr['product_price'];
            return $pf_file;
        }else{
            return null;
        }
    }
        //================================================================================================================================= PRODUCT CHIPPING
    function product_chipping($img_id){
        $conn = parent::connect();
        $sel_imgpr = $conn->prepare("SELECT egura_products.product_chipping FROM egura_products WHERE egura_products.product_id='$img_id'");
        $sel_imgpr->execute();
        if ($sel_imgpr->rowCount()==1) {
            $ftsel_imgpr = $sel_imgpr->fetch(PDO::FETCH_ASSOC);
            $pf_file = $ftsel_imgpr['product_chipping'];
            // if ($pf_file==0) {
            //  $pf_file = "Free";
            // }
            return $pf_file;
        }else{
            return null;
        }
    }

        //================================================================================================================================= PRODUCT LOCATION
    function product_location($img_id){
        $conn = parent::connect();
        $sel_loc = $conn->prepare("SELECT egura_products.product_adder,egura_users.user_district,egura_users.user_sector,egura_users.user_cell FROM egura_products,egura_users WHERE egura_products.product_adder=egura_users.user_id AND egura_products.product_id='$img_id'");
        $sel_loc->execute();
        if ($sel_loc->rowCount()==1) {
            $ft_sel_loc = $sel_loc->fetch(PDO::FETCH_ASSOC);
            $pro_location = ucfirst(strtolower($ft_sel_loc['user_district']))." - ".ucfirst(strtolower($ft_sel_loc['user_sector']))." - ".ucfirst(strtolower($ft_sel_loc['user_cell']));
            return $pro_location;
        }else{
            return "Kigali - Kimironko";
        }
    }

        //================================================================================================================================= PRODUCT DESCRIPTION
    function product_descr($img_id){
        $conn = parent::connect();
        $sel_imgpr = $conn->prepare("SELECT egura_products.product_descr FROM egura_products WHERE egura_products.product_id='$img_id'");
        $sel_imgpr->execute();
        if ($sel_imgpr->rowCount()==1) {
            $ftsel_imgpr = $sel_imgpr->fetch(PDO::FETCH_ASSOC);
            $pf_file = $ftsel_imgpr['product_descr'];
            return $pf_file;
        }else{
            return null;
        }
    }
        //================================================================================================================================= PRODUCT ADDER
    function product_adder($img_id){
        $conn = parent::connect();
        $sel_add = $conn->prepare("SELECT egura_products.product_adder,egura_users.user_fname,egura_users.user_lname FROM egura_products,egura_users WHERE egura_products.product_adder=egura_users.user_id AND egura_products.product_id='$img_id'");
        $sel_add->execute();
        if ($sel_add->rowCount()==1) {
            $ft_sel_add = $sel_add->fetch(PDO::FETCH_ASSOC);
            $uder_names = strtoupper($ft_sel_add['user_fname'])."&nbsp;&nbsp;".ucfirst(strtolower($ft_sel_add['user_lname']));
            return $uder_names;
        }else{
            return "E-Gura Solution";
        }
    }
        //================================================================================================================================= PRODUCT DATE
    function product_date($img_id){
        $conn = parent::connect();
        $sel_imgpr = $conn->prepare("SELECT egura_products.product_date FROM egura_products WHERE egura_products.product_id='$img_id'");
        $sel_imgpr->execute();
        if ($sel_imgpr->rowCount()==1) {
            $ftsel_imgpr = $sel_imgpr->fetch(PDO::FETCH_ASSOC);
            $pf_file = $ftsel_imgpr['product_date'];
            return $pf_file;
        }else{
            return null;
        }
    }
        //================================================================================================================================= PRODUCT STATUS
    function product_status($img_id){
        $conn = parent::connect();
        $sel_imgpr = $conn->prepare("SELECT egura_products.product_status FROM egura_products WHERE egura_products.product_id='$img_id'");
        $sel_imgpr->execute();
        if ($sel_imgpr->rowCount()==1) {
            $ftsel_imgpr = $sel_imgpr->fetch(PDO::FETCH_ASSOC);
            $pf_file = $ftsel_imgpr['product_status'];
            return $pf_file;
        }else{
            return null;
        }
    }

        //======================================================================================================================== PRODUCTS RELATED CATEGORIES

        function related_cat_pr_a($cat){        //   First Slide
            $conn = parent::connect();
            $sel_c_one = $conn->prepare("SELECT * FROM egura_products WHERE egura_products.product_cat='$cat' AND egura_products.product_status='E' ORDER BY egura_products.product_id DESC LIMIT 3");
            $sel_c_one->execute();
            if ($sel_c_one->rowCount()>0) {
                echo "<div class='item active'><center>";
                while ($ft_sel_c_one = $sel_c_one->fetch(PDO::FETCH_ASSOC)) {
                    $img_name = $ft_sel_c_one['product_file'];
                    ?>
                     <a href="product_details?pdd=<?php echo dt_enc($ft_sel_c_one['product_id']);?>"><img style="width: 260px;height: 200px;" src="images/products/<?php echo $img_name;?>" alt=""></a>

                    <?php
                }
                echo "</center></div>";
            }
        }

        function related_cat_pr_b($cat){        //   Second Slide
            $conn = parent::connect();
            $sel_c_one = $conn->prepare("SELECT * FROM egura_products WHERE egura_products.product_cat='$cat' AND egura_products.product_status='E' ORDER BY egura_products.product_id DESC LIMIT 3,3");
            $sel_c_one->execute();
            if ($sel_c_one->rowCount()>0) {
                echo "<div class='item'><center>";
                while ($ft_sel_c_one = $sel_c_one->fetch(PDO::FETCH_ASSOC)) {
                    $img_name = $ft_sel_c_one['product_file'];
                    ?>
                      <a href="product_details?pdd=<?php echo dt_enc($ft_sel_c_one['product_id']);?>"><img style="width: 260px;height: 200px;" src="images/products/<?php echo $img_name;?>" alt=""></a>
                    <?php
                }
                echo "</center></div>";
            }
        }

        function related_cat_pr_c($cat){        //   Third Slide
            $conn = parent::connect();
            $sel_c_one = $conn->prepare("SELECT * FROM egura_products WHERE egura_products.product_cat='$cat' AND egura_products.product_status='E' ORDER BY egura_products.product_id DESC LIMIT 6,3");
            $sel_c_one->execute();
            if ($sel_c_one->rowCount()>0) {
                echo "<div class='item'><center>";
                while ($ft_sel_c_one = $sel_c_one->fetch(PDO::FETCH_ASSOC)) {
                    $img_name = $ft_sel_c_one['product_file'];
                    ?>
                      <a href="product_details?pdd=<?php echo dt_enc($ft_sel_c_one['product_id']);?>"><img style="width: 260px;height: 200px;" src="images/products/<?php echo $img_name;?>" alt=""></a>
                    <?php
                }
                echo "</center></div>";
            }
        }




        function requested_products_reg(){      // ===================DISPLAYING PRODUCTS REGISTRATION REQUESTS
            $conn = parent::connect();
            $sel_req_pr = $conn->prepare("SELECT egura_products.*,egura_users.* FROM egura_products,egura_users WHERE egura_products.product_adder=egura_users.user_id AND egura_products.product_status='NY' order by egura_products.product_id DESC");
            $sel_req_pr->execute();
            if ($sel_req_pr->rowCount()>=1) {
                ?>
                           <table class="table table-striped table-hover">
                            <thead>
                              <tr>
                                <th>User name:</th>
                                <th>Phone </th>
                                <th>Product</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Shipping</th>
                                <th colspan="4"> Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                <?php
                while ($ft_sel_req_pr = $sel_req_pr->fetch(PDO::FETCH_ASSOC)) {
                    $pr_shp=0;
                    switch ($ft_sel_req_pr['product_chipping']) {
                        case $ft_sel_req_pr['product_chipping']<1:
                            $pr_shp = "Free";
                            break;
                        
                        default:
                            $pr_shp = $ft_sel_req_pr['product_chipping'];
                            break;
                    }
                    ?>
                            
                              <tr>
                                <td><?php echo strtoupper($ft_sel_req_pr['user_fname'])." ".ucfirst(strtolower($ft_sel_req_pr['user_lname']));?></td>
                                <td><?php echo $ft_sel_req_pr['user_phone'];?></td>
                                <td><?php echo ucfirst(strtolower($ft_sel_req_pr['product_name']));?></td>
                                <td> <img style="width: 60px;height: 60px" src="../images/products/<?php echo $ft_sel_req_pr['product_file'];?>"> </td>
                                <td><?php echo $ft_sel_req_pr['product_price'];?></td>
                                <td><?php echo $pr_shp;?></td>
                                <input type="hidden" id="pridd" value="<?php echo $ft_sel_req_pr['product_id'];?>">
                                <td colspan="2"><button class="btn btn-success" onclick="return confirmProduct(<?php echo $ft_sel_req_pr['product_id']?>,true);">Confirm</button></td>
                                <td colspan="2"><a href="req_details?prd=<?php echo dt_enc($ft_sel_req_pr['product_id']);?>&adder=<?php echo dt_enc($ft_sel_req_pr['user_id']);?>" target="__blank"><button class="btn btn-primary">View</button></a></td>
                              </tr>
                    <?php
                }
                ?>
                            </tbody>
                          </table>
                <?php
            }else{
                echo "<table class='table table-striped table-hover'>
                <thead><tr><th>User name:</th><th>Phone </th><th>Product</th><th>Image</th><th>Price</th><th>Shipping</th><th colspan='4'> Actions</th></tr></thead><tbody><tr><td colspan='10'> <center> No Request Available ... </center> </td></tr></tbody></table>";
            }
        }


        function all_available_products(){      // =================== DISPLAYING ALL AVAILABLE PRODUCTS
            $conn = parent::connect();
            $sel_req_pr = $conn->prepare("SELECT egura_products.*,egura_users.* FROM egura_products,egura_users WHERE egura_products.product_adder=egura_users.user_id AND egura_products.product_status != 'NY' order by egura_products.product_id DESC");
            $sel_req_pr->execute();
            if ($sel_req_pr->rowCount()>=1) {
                $cnttt=1;
                ?>
                           <table class="table table-striped table-hover">
                            <thead>
                              <tr>
                                <th>User name:</th>
                                <th>Phone </th>
                                <th>Product</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Shipping</th>
                                <th colspan="4"> Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                <?php
                while ($ft_sel_req_pr = $sel_req_pr->fetch(PDO::FETCH_ASSOC)) {
                    $pr_shp=0;
                    switch ($ft_sel_req_pr['product_chipping']) {
                        case $ft_sel_req_pr['product_chipping']<1:
                            $pr_shp = "Free";
                            break;
                        
                        default:
                            $pr_shp = $ft_sel_req_pr['product_chipping'];
                            break;
                    }
                    switch ($ft_sel_req_pr['user_status']) {
                        case 'A':
                            $ft_sel_req_pr['user_fname'] = "Sys - ".$ft_sel_req_pr['user_fname'];
                            break;
                        
                        default:
                            $ft_sel_req_pr['user_fname'] = $ft_sel_req_pr['user_fname'];
                            break;
                    }
                    ?>
                            
                              <tr>
                                <td><?php echo $cnttt.". ".strtoupper($ft_sel_req_pr['user_fname'])." ".ucfirst(strtolower($ft_sel_req_pr['user_lname']));?></td>
                                <td><?php echo $ft_sel_req_pr['user_phone'];?></td>
                                <td><?php echo ucfirst(strtolower($ft_sel_req_pr['product_name']));?></td>
                                <td> <img style="width: 60px;height: 60px" src="../images/products/<?php echo $ft_sel_req_pr['product_file'];?>"> </td>
                                <td><?php echo $ft_sel_req_pr['product_price'];?></td>
                                <td><?php echo $pr_shp;?></td>
                                <input type="hidden" id="pridd" value="<?php echo $ft_sel_req_pr['product_id'];?>">
                                <td colspan="2"><button class="btn btn-danger" onclick="return deleteProduct(<?php echo $ft_sel_req_pr['product_id']?>,true);">Delete</button></td>
                                <td colspan="2"><a href="upd_products?prd=<?php echo dt_enc($ft_sel_req_pr['product_id']);?>&adder=<?php echo dt_enc($ft_sel_req_pr['user_id']);?>"><button class="btn btn-primary">Update</button></a></td>
                              </tr>
                    <?php
                    $cnttt++;
                }
                ?>
                            </tbody>
                          </table>
                <?php
            }else{
                echo "<table class='table table-striped table-hover'>
                <thead><tr><th>User name:</th><th>Phone </th><th>Product</th><th>Image</th><th>Price</th><th>Shipping</th><th colspan='4'> Actions</th></tr></thead><tbody><tr><td colspan='10'> <center> No Request Available ... </center> </td></tr></tbody></table>";
            }
        }


        function count_all_images(){        //------------------------------------ RETURN ALL Enabled images
            $conn = parent::connect();
            $sel_c_one = $conn->prepare("SELECT count(egura_products.product_id) AS all_imgs FROM egura_products WHERE egura_products.product_status='E'");
            $ok_sel_c_one = $sel_c_one->execute();
            if ($ok_sel_c_one) {
                $ft_sel_c_one = $sel_c_one->fetch(PDO::FETCH_ASSOC);
                return $ft_sel_c_one['all_imgs'];
            }else{
                return null;
            }

        }

        function disp_pagination_nums($aa){
            $bb = 18;
            if ($aa>18) {
                $iinn = $aa-18;
                $pprev = 18;
                echo "<a href='index.php?pag_ini=$iinn'> <&nbsp;Previous</a>";
            }
            
            for ($i=0; $i <(self::count_all_images()/18) ; $i++) { 
                $start = $i*18;
                $end = 18;
                $to_prnt =$i+1;
                
                echo "<a href='index.php?pag_ini=$start'>&nbsp; $to_prnt &nbsp;</a>";
                
            }
                if (($aa/18)<(self::count_all_images()/18)) {
                    $iinni = $aa+18;
                    echo "<a href='index.php?pag_ini=$iinni'> Next&nbsp;></a>";
                }
                
        }

        function to_chk_get_pagination_init(){
            if (isset($_GET['pag_ini'])) {
                return $_GET['pag_ini'];
            }else{
                return 0;
            }
        }

//==================================================================================================== DISPLAYING CATEGORIES
        function pro_cat_list(){
            $conn = parent::connect();
            $sell_catt = $conn->prepare("SELECT * FROM pro_categories WHERE cat_status='E'");
            $sell_catt->execute();
            if ($sell_catt->rowCount()>=1) {
                ?>
                <div class="panel panel-default">
                    <?php
                    while ($ft_sell_catt = $sell_catt->fetch(PDO::FETCH_ASSOC)) {
                        $cat_id = $ft_sell_catt['cat_id'];
                        ?>
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordian" href="#sportswear<?php echo $cat_id?>">
                                    <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                    <?php echo $ft_sell_catt['cat_name'];?>
                                </a>
                            </h4>
                        </div>
                        <div id="sportswear<?php echo $cat_id?>" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul>
                                    <?php 
                                    $sel_subcat = $conn->prepare("SELECT * FROM prod_sub_cat WHERE sub_cat_status='E' AND sub_cat_category='$cat_id'");
                                    $sel_subcat->execute();
                                    if ($sel_subcat->rowCount()>=1) {
                                        while ($ft_sel_subcat = $sel_subcat->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                            <li><a style="font-weight: bolder;" href="#" onclick="return searchProductCategory('<?php echo $ft_sel_subcat['sub_cat_id'];?>');"><?php echo $ft_sel_subcat['sub_cat_name'];?> </a></li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <?php
            }
        }

//==================================================================================================== MOBILE DISPLAYING CATEGORIES
        function mob_pro_cat_list(){
            $conn = parent::connect();
            $sell_catt = $conn->prepare("SELECT * FROM pro_categories WHERE cat_status='E'");
            $sell_catt->execute();
            if ($sell_catt->rowCount()>=1) {

                    while ($ft_sell_catt = $sell_catt->fetch(PDO::FETCH_ASSOC)) {
                        $cat_id = $ft_sell_catt['cat_id'];
                        $cat_name = $ft_sell_catt['cat_name'];
                        $cat_icon = $ft_sell_catt['cat_icon'];
                        $cat_idd = dt_enc($cat_id);
                        ?>
    <a href="category.php?cat=<?php echo $cat_idd?>">
    <div class="category">
      <div class="thumb">
        <img style="width: 100%;height: 60px" src="img/categories/<?php echo $cat_icon; ?>">
      </div>
      <span style="word-wrap:break-word;font-size: 8px;font-weight: bolder"><?php echo $cat_name;?></span>
    </div></a>


<!--                             <a href="category.php?cat=<?php echo $cat_idd?>">
                            <div class="category">
                                <div class="thumb">
                                    <img style="width: 100%;height: 60px" src="img/categories/<?php echo $cat_icon; ?>">
                                </div>
                                <span style="font-size: 10px;font-weight: bolder;word-wrap:break-word;"><?php echo $cat_name;?></span>
                            </div></a> -->
                        <?php
                    }

            }
        }

//======================================================================================= MOBILE DISPLAYING CATEGORIES VERTICALLY ON LIST
        function mob_pro_cat_list_vertically(){
            $conn = parent::connect();
            $sell_catt = $conn->prepare("SELECT * FROM pro_categories WHERE cat_status='E'");
            $sell_catt->execute();
            if ($sell_catt->rowCount()>=1) {

                    while ($ft_sell_catt = $sell_catt->fetch(PDO::FETCH_ASSOC)) {
                        $cat_id = $ft_sell_catt['cat_id'];
                        $cat_name = $ft_sell_catt['cat_name'];
                        $cat_icon = $ft_sell_catt['cat_icon'];
                        $cat_idd = dt_enc($cat_id);
                        ?>

             <a href="category.php?cat=<?php echo $cat_idd?>">
                <li>
                <div class="thumb cat">
                    <img style="width: 100%;height: 60px" src="img/categories/<?php echo $cat_icon; ?>">
                </div>
                        <?php echo "<span style='font-weight:bolder;font-size:20px;'>".$cat_name."</span>";?>
                    </li>
                </a>
        <?php
                    }

            }
        }



//==================================================================================== SYSTEM VISITS
function count_sys_visits(){
    $conn = parent::connect();
    $sel_count = $conn->prepare("SELECT SUM(visit_counts) as all_visits FROM egura_visits WHERE visit_status='E'");
    $sel_count->execute();
    if ($sel_count->rowCount()>=1) {
        $ft_sel_count = $sel_count->fetch(PDO::FETCH_ASSOC);
        return number_format($ft_sel_count['all_visits']);
    }else{
        return 0;
    }
}
//==================================================================================== SYSTEM ORDERS
function count_sys_orders(){
    $conn = parent::connect();
    $sel_ords = $conn->prepare("SELECT count(order_id) as all_orders FROM egura_orders WHERE order_status='E'");
    $sel_ords->execute();
    if ($sel_ords->rowCount()>=1) {
        $ft_sel_ords = $sel_ords->fetch(PDO::FETCH_ASSOC);
        return number_format($ft_sel_ords['all_orders']);
    }else{
        return 0;
    }
}

//========================================================================================= SYSTEM SELLS 
function count_sys_sells(){
    $conn = parent::connect();
    $sel_sells = $conn->prepare("SELECT COUNT(product_id) AS all_sells FROM egura_products WHERE product_adder IS NOT null AND (product_status='E' OR product_status='NY')");
    $sel_sells->execute();
    if ($sel_sells->rowCount()>=1) {
        $ft_sel_sells = $sel_sells->fetch(PDO::FETCH_ASSOC);
        return number_format($ft_sel_sells['all_sells']);
    }else{
        return 0;
    }
}

//==================================================================================== SYSTEM PENDING ORDERS
function count_sys_pendings(){
    $conn = parent::connect();
    $sel_ords = $conn->prepare("SELECT count(order_id) as all_orders FROM egura_orders WHERE order_tr_status='Pending' AND order_status='E'");
    $sel_ords->execute();
    if ($sel_ords->rowCount()>=1) {
        $ft_sel_ords = $sel_ords->fetch(PDO::FETCH_ASSOC);
        return number_format($ft_sel_ords['all_orders']);
    }else{
        return 0;
    }
}

function sys_low_price(){               //===================================== SYSTEM  LOWEST PRICE
    $conn = parent::connect();
    $sel_pr_price = $conn->prepare("SELECT MIN(product_price) AS min_price FROM egura_products");
    $sel_pr_price->execute();
    if ($sel_pr_price->rowCount()>=1) {
        $ft_sel_pr_price = $sel_pr_price->fetch(PDO::FETCH_ASSOC);
        return $ft_sel_pr_price['min_price'];
    }else{
        return 0;
    }
}

function sys_high_price(){              //===================================== SYSTEM  HIGHEST PRICE
    $conn = parent::connect();
    $sel_pr_price = $conn->prepare("SELECT MAX(product_price) AS max_price FROM egura_products");
    $sel_pr_price->execute();
    if ($sel_pr_price->rowCount()>=1) {
        $ft_sel_pr_price = $sel_pr_price->fetch(PDO::FETCH_ASSOC);
        return $ft_sel_pr_price['max_price'];
    }else{
        return 0;
    }
}

function brands_high_store(){       //======================================= brand new in high Store
    $conn = parent::connect();
    $sel_brand = $conn->prepare("SELECT egura_products.*,prod_sub_cat.sub_cat_name,prod_sub_cat.sub_cat_id FROM egura_products,prod_sub_cat WHERE egura_products.product_cat=prod_sub_cat.sub_cat_id GROUP BY egura_products.product_cat ORDER BY egura_products.product_qnty DESC LIMIT 7");
    $sel_brand->execute();
    if ($sel_brand->rowCount()>=1) {
        while ($ft_sel_brand = $sel_brand->fetch(PDO::FETCH_ASSOC)) {
            $sub_cat_name = $ft_sel_brand['sub_cat_name'];
            $sub_cat_qnty = $ft_sel_brand['product_qnty'];
            $pro_cat = $ft_sel_brand['product_cat'];
            ?>
            <li><a href="#" onclick="return searchProductCategory('<?php echo $pro_cat;?>');"> <span class="pull-right">(<?php echo $sub_cat_qnty;?>)</span><?php echo $sub_cat_name;?></a></li>
            <?php





        }
    }else{
        
    }
}


function brand_new_items_slide_one(){   //==================================== BRAND NEW ITEMS SLIDES TWO
    $conn = parent::connect();
    $sel_br_nw = $conn->prepare("SELECT * FROM egura_products WHERE product_status='E' ORDER BY product_id DESC LIMIT 3");
    $sel_br_nw->execute();
    if ($sel_br_nw->rowCount()>=1) {
        while ($ft_sel_br_nw = $sel_br_nw->fetch(PDO::FETCH_ASSOC)) {
            $pr_id = $ft_sel_br_nw['product_id'];
            ?>
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products" style="width: 200px;height: 160px">
                                                <div class="productinfo text-center">
                                                    <img src="images/products/<?php echo self::image_name($pr_id)?>" alt="<?php echo self::product_descr($pr_id)?>" /><br><br><br>
                                                    <h2><?php echo number_format(self::product_price($pr_id))?></h2>
                                                    <p><?php echo self::product_name($pr_id)?></p>
                                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Buy / Gura</a>
                                                </div>
                                                <div class="product-overlay">
                                                    <div class="overlay-content">
                                                        <h2><?php echo number_format(self::product_price($pr_id))?></h2>
                                                        <p><?php echo self::product_descr($pr_id)?></p>
                                                        <?php
                                                        if (isset($_COOKIE['egura_user_email'])) {
                                                            ?>
                                                                <a href="product_details?pdd=<?php echo dt_enc($pr_id);?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Buy / Gura</a>
                                                            <?php
                                                        }else{
                                                            ?>
                                                                <a href="login" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Buy / Gura</a>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-image-wrapper">
                                            <center style="text-transform: capitalize;">
                                                    <label>
                                                <?php echo strtolower(self::product_name($pr_id));?>
                                                    </label>
                                            </center>
                                        </div>
                                    </div>
            <?php

        }
    }
}


function brand_new_items_slide_two(){   //==================================== BRAND NEW ITEMS SLIDES TWO
    $conn = parent::connect();
    $sel_br_nw = $conn->prepare("SELECT * FROM egura_products WHERE product_status='E' ORDER BY product_id DESC LIMIT 3,3");
    $sel_br_nw->execute();
    if ($sel_br_nw->rowCount()>=1) {
        while ($ft_sel_br_nw = $sel_br_nw->fetch(PDO::FETCH_ASSOC)) {
            $pr_id = $ft_sel_br_nw['product_id'];
            ?>
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products" style="width: 200px;height: 160px">
                                                <div class="productinfo text-center">
                                                    <img src="images/products/<?php echo self::image_name($pr_id)?>" alt="<?php echo self::product_descr($pr_id)?>" />
                                                    <br><br><br>
                                                    <h2><?php echo number_format(self::product_price($pr_id))?></h2>
                                                    <p><?php echo self::product_name($pr_id)?></p>
                                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Buy / Gura</a>
                                                </div>
                                                <div class="product-overlay">
                                                    <div class="overlay-content">
                                                        <h2><?php echo number_format(self::product_price($pr_id))?></h2>
                                                        <p><?php echo self::product_descr($pr_id)?></p>
                                                        <?php
                                                        if (isset($_COOKIE['egura_user_email'])) {
                                                            ?>
                                                                <a href="product_details?pdd=<?php echo dt_enc($pr_id);?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Buy / Gura</a>
                                                            <?php
                                                        }else{
                                                            ?>
                                                                <a href="login" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Buy / Gura</a>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-image-wrapper">
                                            <center style="text-transform: capitalize;">
                                                    <label>
                                                <?php echo strtolower(self::product_name($pr_id));?>
                                                    </label>
                                            </center>
                                        </div>
                                    </div>
            <?php

        }
    }
}

function if_has_color($prod){       //=================================  IF HAS COLOR
    $conn = parent::connect();
    $sel_if_cl = $conn->prepare("SELECT * FROM egura_products WHERE product_id='$prod'");
    $sel_if_cl->execute();
    if ($sel_if_cl->rowCount()==1) {
        $ft_sel_if_cl = $sel_if_cl->fetch(PDO::FETCH_ASSOC);
        $pro_color = $ft_sel_if_cl['product_color'];
        if (!empty($pro_color)) {
            return "<p>Color: <b>$pro_color</b></p>";
        }else{
            return null;
        }
    }
}

function if_has_sex($prod){     //=================================  IF HAS SEX
    $conn = parent::connect();
    $sel_if_cl = $conn->prepare("SELECT * FROM egura_products WHERE product_id='$prod'");
    $sel_if_cl->execute();
    if ($sel_if_cl->rowCount()==1) {
        $ft_sel_if_cl = $sel_if_cl->fetch(PDO::FETCH_ASSOC);
        $pro_color = $ft_sel_if_cl['product_sex'];
        if (!empty($pro_color)) {
            return "<p>Gender: <b>$pro_color</b></p>";
        }else{
            return null;
        }
    }
}


function if_has_size($prod){        //=================================  IF HAS SIZE
    $conn = parent::connect();
    $sel_if_cl = $conn->prepare("SELECT * FROM egura_products WHERE product_id='$prod'");
    $sel_if_cl->execute();
    if ($sel_if_cl->rowCount()==1) {
        $ft_sel_if_cl = $sel_if_cl->fetch(PDO::FETCH_ASSOC);
        $pro_color = $ft_sel_if_cl['product_size'];
        if (!empty($pro_color)) {
            return "<p>Size: <b>$pro_color</b></p>";
        }else{
            return null;
        }
    }
}


function new_clients_orders(){      //=================================================== NEW CLIENS ORDERS
    $conn = parent::connect();
    $sel_orders = $conn->prepare("SELECT egura_users.*,egura_orders.*,egura_products.* FROM egura_users,egura_orders,egura_products WHERE egura_orders.order_user=egura_users.user_id AND egura_orders.order_product=egura_products.product_id AND egura_orders.order_tr_status='Pending'");
    $sel_orders->execute();
    if ($sel_orders->rowCount()>=1) {
        ?>
        <table style="width: 99%">
            <thead>
                <th>#</th>
                <th>Client</th>
                <th>Product</th>
                <th>Price</th>
                <th>Shiping</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Location</th>
                <th>Date</th>
            </thead>
            <tbody>
                <?php
                $cnnt = 1;
                while ($ft_sel_orders = $sel_orders->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td><?php echo $cnnt.". ";?></td>
                        <td><?php echo strtoupper($ft_sel_orders['user_fname'])." ".ucfirst(strtolower($ft_sel_orders['user_lname']));?></td>
                        <td><?php echo $ft_sel_orders['product_name'];?></td>
                        <td><?php echo number_format($ft_sel_orders['product_price']);?></td>
                        <td><?php echo number_format($ft_sel_orders['product_chipping']);?></td>
                        <td><?php echo number_format($ft_sel_orders['order_quantity']);?></td>
                        <td><?php
                            $ttl_on_ord = ($ft_sel_orders['product_price']*$ft_sel_orders['order_quantity'])+$ft_sel_orders['product_chipping'];
                         echo number_format($ttl_on_ord);?></td>
                         <td><?php echo ucfirst(strtolower($ft_sel_orders['order_district']))."-".ucfirst(strtolower($ft_sel_orders['order_sector']))."".ucfirst(strtolower($ft_sel_orders['order_cell']))."".ucfirst(strtolower($ft_sel_orders['order_street']));?></td>
                        <td style="font-size: 10px"><?php echo $ft_sel_orders['order_date'];?></td>
                    </tr>
                    <?php
                    $cnnt++;
                }
                ?>
            </tbody>
        </table>
        <?php
    }else{
        echo "<table class='table table-striped table-hover'>
                <thead><tr><th>#</th><th>Client</th><th>Product</th><th>Price</th><th>Shiping</th><th>Quantity</th><th>Total Price</th><th>Location</th><th>Date</th></tr></thead><tbody><tr><td colspan='9'> <center> No Order Available ... </center> </td></tr></tbody></table>";
    }
}


function all_clients_orders(){      //===================================================================== ALL ORDERS
    $conn = parent::connect();
    $sel_orders = $conn->prepare("SELECT egura_users.*,egura_orders.*,egura_products.* FROM egura_users,egura_orders,egura_products WHERE egura_orders.order_user=egura_users.user_id AND egura_orders.order_product=egura_products.product_id");
    $sel_orders->execute();
    if ($sel_orders->rowCount()>=1) {
        ?>
        <table style="width: 99%">
            <thead>
                <th>#</th>
                <th>Client</th>
                <th>Product</th>
                <th>Price</th>
                <th>Shiping</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Location</th>
                <th>Date</th>
            </thead>
            <tbody>
                <?php
                $cnnt = 1;
                while ($ft_sel_orders = $sel_orders->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td><?php echo $cnnt.". ";?></td>
                        <td><?php echo strtoupper($ft_sel_orders['user_fname'])." ".ucfirst(strtolower($ft_sel_orders['user_lname']));?></td>
                        <td><?php echo $ft_sel_orders['product_name'];?></td>
                        <td><?php echo number_format($ft_sel_orders['product_price']);?></td>
                        <td><?php echo number_format($ft_sel_orders['product_chipping']);?></td>
                        <td><?php echo number_format($ft_sel_orders['order_quantity']);?></td>
                        <td><?php
                            $ttl_on_ord = ($ft_sel_orders['product_price']*$ft_sel_orders['order_quantity'])+$ft_sel_orders['product_chipping'];
                         echo number_format($ttl_on_ord);?></td>
                         <td><?php echo ucfirst(strtolower($ft_sel_orders['order_district']))."-".ucfirst(strtolower($ft_sel_orders['order_sector']))."".ucfirst(strtolower($ft_sel_orders['order_cell']))."".ucfirst(strtolower($ft_sel_orders['order_street']));?></td>
                        <td style="font-size: 10px"><?php echo $ft_sel_orders['order_date'];?></td>
                    </tr>
                    <?php
                    $cnnt++;
                }
                ?>
            </tbody>
        </table>
        <?php
    }else{
        echo "<table class='table table-striped table-hover'>
                <thead><tr><th>#</th><th>Client</th><th>Product</th><th>Price</th><th>Shiping</th><th>Quantity</th><th>Total Price</th><th>Location</th><th>Date</th></tr></thead><tbody><tr><td colspan='9'> <center> No Order Available ... </center> </td></tr></tbody></table>";
    }
}




function system_orders(){       //===================================================================== SYSTEM ORDERS
    $conn = parent::connect();
    $sel_orders = $conn->prepare("SELECT egura_users.*,egura_orders.*,egura_products.* FROM egura_users,egura_orders,egura_products WHERE egura_orders.order_user=egura_users.user_id AND egura_orders.order_product=egura_products.product_id AND egura_users.user_status='A'");
    $sel_orders->execute();
    if ($sel_orders->rowCount()>=1) {
        ?>
        <table style="width: 99%">
            <thead>
                <th>#</th>
                <th>Client</th>
                <th>Product</th>
                <th>Price</th>
                <th>Shiping</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Location</th>
                <th>Date</th>
            </thead>
            <tbody>
                <?php
                $cnnt = 1;
                while ($ft_sel_orders = $sel_orders->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td><?php echo $cnnt.". ";?></td>
                        <td><?php echo strtoupper($ft_sel_orders['user_fname'])." ".ucfirst(strtolower($ft_sel_orders['user_lname']));?></td>
                        <td><?php echo $ft_sel_orders['product_name'];?></td>
                        <td><?php echo number_format($ft_sel_orders['product_price']);?></td>
                        <td><?php echo number_format($ft_sel_orders['product_chipping']);?></td>
                        <td><?php echo number_format($ft_sel_orders['order_quantity']);?></td>
                        <td><?php
                            $ttl_on_ord = ($ft_sel_orders['product_price']*$ft_sel_orders['order_quantity'])+$ft_sel_orders['product_chipping'];
                         echo number_format($ttl_on_ord);?></td>
                         <td><?php echo ucfirst(strtolower($ft_sel_orders['order_district']))."-".ucfirst(strtolower($ft_sel_orders['order_sector']))."".ucfirst(strtolower($ft_sel_orders['order_cell']))."".ucfirst(strtolower($ft_sel_orders['order_street']));?></td>
                        <td style="font-size: 10px"><?php echo $ft_sel_orders['order_date'];?></td>
                    </tr>
                    <?php
                    $cnnt++;
                }
                ?>
            </tbody>
        </table>
        <?php
    }else{
        echo "<table class='table table-striped table-hover'>
                <thead><tr><th>#</th><th>Client</th><th>Product</th><th>Price</th><th>Shiping</th><th>Quantity</th><th>Total Price</th><th>Location</th><th>Date</th></tr></thead><tbody><tr><td colspan='9'> <center> No Order Available ... </center> </td></tr></tbody></table>";
    }
}




function user_orders(){     //===================================================================== USER ORDERS
    $conn = parent::connect();
    $sel_orders = $conn->prepare("SELECT egura_users.*,egura_orders.*,egura_products.* FROM egura_users,egura_orders,egura_products WHERE egura_orders.order_user=egura_users.user_id AND egura_orders.order_product=egura_products.product_id AND egura_users.user_status='E'");
    $sel_orders->execute();
    if ($sel_orders->rowCount()>=1) {
        ?>
        <table style="width: 99%">
            <thead>
                <th>#</th>
                <th>Client</th>
                <th>Product</th>
                <th>Price</th>
                <th>Shiping</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Location</th>
                <th>Date</th>
            </thead>
            <tbody>
                <?php
                $cnnt = 1;
                while ($ft_sel_orders = $sel_orders->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td><?php echo $cnnt.". ";?></td>
                        <td><?php echo strtoupper($ft_sel_orders['user_fname'])." ".ucfirst(strtolower($ft_sel_orders['user_lname']));?></td>
                        <td><?php echo $ft_sel_orders['product_name'];?></td>
                        <td><?php echo number_format($ft_sel_orders['product_price']);?></td>
                        <td><?php echo number_format($ft_sel_orders['product_chipping']);?></td>
                        <td><?php echo number_format($ft_sel_orders['order_quantity']);?></td>
                        <td><?php
                            $ttl_on_ord = ($ft_sel_orders['product_price']*$ft_sel_orders['order_quantity'])+$ft_sel_orders['product_chipping'];
                         echo number_format($ttl_on_ord);?></td>
                         <td><?php echo ucfirst(strtolower($ft_sel_orders['order_district']))."-".ucfirst(strtolower($ft_sel_orders['order_sector']))."".ucfirst(strtolower($ft_sel_orders['order_cell']))."".ucfirst(strtolower($ft_sel_orders['order_street']));?></td>
                        <td style="font-size: 10px"><?php echo $ft_sel_orders['order_date'];?></td>
                    </tr>
                    <?php
                    $cnnt++;
                }
                ?>
            </tbody>
        </table>
        <?php
    }else{
        echo "<table class='table table-striped table-hover'>
                <thead><tr><th>#</th><th>Client</th><th>Product</th><th>Price</th><th>Shiping</th><th>Quantity</th><th>Total Price</th><th>Location</th><th>Date</th></tr></thead><tbody><tr><td colspan='9'> <center> No Order Available ... </center> </td></tr></tbody></table>";
    }
}





function available_users(){
    $conn = parent::connect();
    $sel_av_users = $conn->prepare("SELECT * FROM egura_users WHERE user_status='E' ORDER BY user_date DESC");
    $sel_av_users->execute();
    if ($sel_av_users->rowCount()>=1) {
        ?>
        <table style="width: 99%">
            <thead>
                <th>#</th>
                <th>Names</th>
                <th>Phone</th>
                <th>Email</th>
                <th>District</th>
                <th>Sector</th>
                <th>Cell</th>
                <th>Street</th>
                <th>Date</th>
            </thead>
            <tbody>
                <?php
                $cnt = 1;
                while ($ft_sel_av_users = $sel_av_users->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $cnt.". ";?>
                        </td>
                        <td>
                            <?php echo strtoupper($ft_sel_av_users['user_fname'])." ".ucfirst(strtolower($ft_sel_av_users['user_lname']));?>
                        </td>
                        <td>
                            <?php echo $ft_sel_av_users['user_phone'];?>
                        </td>
                        <td style="font-size: 10px">
                            <?php echo strtolower($ft_sel_av_users['user_email']);?>
                        </td>
                        <td>
                            <?php echo ucfirst(strtolower($ft_sel_av_users['user_district']));?>
                        </td>
                        <td>
                            <?php echo ucfirst(strtolower($ft_sel_av_users['user_sector']));?>
                        </td>
                        <td>
                            <?php echo ucfirst(strtolower($ft_sel_av_users['user_cell']));?>
                        </td>
                        <td>
                            <?php echo $ft_sel_av_users['user_street'];?>
                        </td>
                        <td style="font-size: 10px">
                            <?php echo $ft_sel_av_users['user_date'];?>
                        </td>
                    </tr>
                    <?php
                    $cnt++;
                }
                ?>
            </tbody>
        </table>
        <?php
    }else{
        echo "<table class='table table-striped table-hover'>
                <thead><tr><th>#</th><th>Names</th><th>Phone</th><th>Email</th><th>District</th><th>Sector</th><th>Cell</th><th>Street</th><th>Date</th></tr></thead><tbody><tr><td colspan='9'> <center> No User Available ... </center> </td></tr></tbody></table>";
    }
}

//=========================================================================================================== ANDROID HOME IMAGES

function and_products_imgs(){
    $conn = parent::connect();
    $sel_prod = $conn->prepare("SELECT *  FROM egura_products ORDER BY RAND()");
    $sel_prod->execute();
    if ($sel_prod->rowCount() >=1) {
        $cntt = 0;
        while ($ft_sel_prod = $sel_prod->fetch(PDO::FETCH_ASSOC)) {
            $mmnmn['and_products_imgs'][$cntt] = ($mani_array[]=$ft_sel_prod);

            $pr_id = $ft_sel_prod['product_id'];
            $sel_pro_category = $conn->prepare("SELECT egura_products.product_cat,prod_sub_cat.sub_cat_category,pro_categories.cat_name AS p_cat FROM egura_products,prod_sub_cat,pro_categories WHERE egura_products.product_id='$pr_id' AND egura_products.product_cat=prod_sub_cat.sub_cat_id AND prod_sub_cat.sub_cat_category=pro_categories.cat_id");
            $sel_pro_category->execute();
            if ($sel_pro_category->rowCount()>=1) {
                $ft_sel_pro_category = $sel_pro_category->fetch(PDO::FETCH_ASSOC);
                $mmnmn['and_products_imgs'][$cntt]['product_category'] = $ft_sel_pro_category['p_cat'];
            }else{
                $mmnmn['and_products_imgs'][$cntt]['product_category'] = $sel_pro_category->rowCount();
            }
            
            $mmnmn['and_products_imgs'][$cntt]['product_file'] ="https://e-gura.com/images/products/".$ft_sel_prod['product_file'];
            $mmnmn['and_products_imgs'][$cntt]['product_file_2'] ="https://e-gura.com/images/products/".$ft_sel_prod['product_file_2'];
            $mmnmn['and_products_imgs'][$cntt]['product_file_3'] ="https://e-gura.com/images/products/".$ft_sel_prod['product_file_3'];
            $cntt++;
        }
        return print(json_encode($mmnmn));
    }
}



//================================================================= MOBILE VERSION 

        //================================================== DISPLAYING PRODUCTS    
    function mob_products_images()
    {
        $conn = parent::connect();
         $se_alpr = $conn->prepare("SELECT * FROM egura_products WHERE product_status='E' GROUP BY product_cat  order by RAND()");
         $se_alpr->execute();
         $ar_cat = array();
         $ar = 0;
         while ($ft_se_alpr = $se_alpr->fetch(PDO::FETCH_ASSOC)) {
             $ar_cat[$ar] = $ft_se_alpr['product_cat'];
             $ar++;
         }
        // $sel_pros = $conn->prepare("SELECT * FROM egura_products WHERE product_status='E' order by RAND() DESC LIMIT $st,$end");
        $cat_rand = $ar_cat[0];
        $sel_pros = $conn->prepare("SELECT * FROM egura_products WHERE product_status='E' AND product_cat='$cat_rand' order by RAND()");
        $sel_pros->execute();
       // $not_sel_pros = $conn->prepare("SELECT * FROM egura_products WHERE product_cat<>'$cat_rand' AND product_status='E' order by product_cat LIMIT $st,$end");
        $not_sel_pros = $conn->prepare("SELECT * FROM egura_products WHERE product_status='E' AND product_cat<>'$cat_rand' order by product_cat LIMIT 10");
        $not_sel_pros->execute();
        if ($sel_pros->rowCount()>=1) {
            while ($ftsel_pros = $sel_pros->fetch(PDO::FETCH_ASSOC)) {
                $pr_id = $ftsel_pros['product_id'];
                $pr_nmae = $ftsel_pros['product_name'];
                $pr_desc = $ftsel_pros['product_descr'];
                $pr_qnty = $ftsel_pros['product_qnty'];
                $pr_prc = $ftsel_pros['product_price'];
                $pro_fl1 = $ftsel_pros['product_file'];
                $pro_fl2 = $ftsel_pros['product_file_2'];
                $pro_fl3 = $ftsel_pros['product_file_3'];

                $snd_prid = dt_enc($pr_id);

                $sel_bought = $conn->prepare("SELECT COUNT(egura_bought.bought_qnty) AS bt_qt FROM egura_bought WHERE egura_bought.bought_pro=?");
                $sel_bought->bindValue(1,$pr_id);
                $sel_bought->execute();

                //====================== BOUGHT QUANTITY
               $pr_bt = 0;
               if (($sel_bought->rowCount())>0) {
                    $ft_sel_bought = $sel_bought->fetch(PDO::FETCH_ASSOC);
                    $pr_bt = $ft_sel_bought['bt_qt'];
               }

                ?>
                    <a href="item.php?pro=<?php echo $snd_prid;?>">
                    <div class="proHodler" style="width: ;height: 240px;width:  46%;">
                      <div class="thumb pro">
                        <img style="width: 100%;height: 120px" src="https://e-gura.com/images/products/<?php echo $pro_fl1; ?>">
                      </div>
                      <div class="proinfo index">
                        <b><?php echo ucfirst(strtolower($pr_nmae)); ?></b> <br>
                      <p><?php echo substr(ucfirst(strtolower($pr_desc)), 0,20)."...";?></p>
                      <b>RWF <?php echo number_format($pr_prc); ?></b> <br>
                      <i> <?php echo "<ss style='color:#019409'>".$pr_bt." </ss>Sold in <ss style='color:#016d94'>".$pr_qnty."</ss>"; ?></i>
                      </div>
                    </div>
                    </a>
                <?php
                 }
            while ($ftsel_pros = $not_sel_pros->fetch(PDO::FETCH_ASSOC)) {
                $pr_id = $ftsel_pros['product_id'];
                $pr_nmae = $ftsel_pros['product_name'];
                $pr_desc = $ftsel_pros['product_descr'];
                $pr_qnty = $ftsel_pros['product_qnty'];
                $pr_prc = $ftsel_pros['product_price'];
                $pro_fl1 = $ftsel_pros['product_file'];
                $pro_fl2 = $ftsel_pros['product_file_2'];
                $pro_fl3 = $ftsel_pros['product_file_3'];

                $snd_prid = dt_enc($pr_id);

                $sel_bought = $conn->prepare("SELECT COUNT(egura_bought.bought_qnty) AS bt_qt FROM egura_bought WHERE egura_bought.bought_pro=?");
                $sel_bought->bindValue(1,$pr_id);
                $sel_bought->execute();

                //====================== BOUGHT QUANTITY
               $pr_bt = 0;
               if (($sel_bought->rowCount())>0) {
                    $ft_sel_bought = $sel_bought->fetch(PDO::FETCH_ASSOC);
                    $pr_bt = $ft_sel_bought['bt_qt'];
               }

                ?>
                    <a href="item.php?pro=<?php echo $snd_prid;?>">
                    <div class="proHodler" style="width: ;height: 240px;width:  46%;">
                      <div class="thumb pro">
                        <img style="width: 100%;height: 120px" src="https://e-gura.com/images/products/<?php echo $pro_fl1; ?>">
                      </div>
                      <div class="proinfo index">
                        <b><?php echo ucfirst(strtolower($pr_nmae)); ?></b> <br>
                      <p><?php echo substr(ucfirst(strtolower($pr_desc)), 0,20)."...";?></p>
                      <b>RWF <?php echo number_format($pr_prc); ?></b> <br>
                      <i> <?php echo "<ss style='color:#019409'>".$pr_bt." </ss>Sold in <ss style='color:#016d94'>".$pr_qnty."</ss>"; ?></i>
                      </div>
                    </div>
                    </a>
                <?php
                 }
            }
        }

                //=============================================================== ANDROID DISPLAY CATEGORIES
        function mob_pro_cat_list_vertically_andr_2(){
            $conn = parent::connect();
            $sell_catt = $conn->prepare("SELECT * FROM pro_categories WHERE cat_status='E'");
            $sell_catt->execute();
            if ($sell_catt->rowCount()>=1) {
                    while ($ft_sell_catt = $sell_catt->fetch(PDO::FETCH_ASSOC)) {
                        $cat_id = $ft_sell_catt['cat_id'];
                        $cat_name = $ft_sell_catt['cat_name'];
                        $cat_icon = $ft_sell_catt['cat_icon'];
                        $cat_idd = dt_enc($cat_id);
                        $categories_details[] = $ft_sell_catt;
                        
                    }
                    return print(json_encode($categories_details));

            }else{
                print(json_encode(""));
            }
        }


function mob_sel_pr_cat_sub_andr_2($catt){         //======================== ANDROID 2 === FETCHING PRODUCT SUB CATEGOTRIES
        $conn = parent::connect();
        $sel_dis = $conn->prepare("SELECT prod_sub_cat.* FROM prod_sub_cat WHERE prod_sub_cat.sub_cat_category='$catt' AND prod_sub_cat.sub_cat_status='E' ORDER BY sub_cat_name ASC");
        $sel_dis->execute();
        if ($sel_dis->rowCount()) {
            while ($ft_sel_dis = $sel_dis->fetch(PDO::FETCH_ASSOC)) {
                $sub_cat_name = $ft_sel_dis['sub_cat_name'];
                $sub_cat_id = $ft_sel_dis['sub_cat_id'];
                $ssub_cat = dt_enc($sub_cat_id);
                $sub_categories_list[] = $ft_sel_dis;
            }
            print(json_encode($sub_categories_list));
        }else{
            print(json_encode(""));
        }
}

function mob_pro_cat_andr_2($pr_cat){      //======================= ANDROID 2 sub categories products
    $con = parent::connect();
    $sel_pro_cat = $con->prepare("SELECT * FROM egura_products WHERE product_cat=? ORDER BY RAND()");
    $sel_pro_cat->bindValue(1,$pr_cat);
    $sel_pro_cat->execute();
    if ($sel_pro_cat->rowCount()>=1) {
        while ($ft_sel_pro_cat = $sel_pro_cat->fetch(PDO::FETCH_ASSOC)) {
            $pro_id = $ft_sel_pro_cat['product_id'];
            $pro_name = $ft_sel_pro_cat['product_name'];
            $pro_file = $ft_sel_pro_cat['product_file'];
            $pro_desc = $ft_sel_pro_cat['product_descr'];
            $pro_prc = $ft_sel_pro_cat['product_price'];
            $snd_prid = dt_enc($pro_id);

               $sub_cats_products[] =  $ft_sel_pro_cat;
        }
        print(json_encode($sub_cats_products));
    }else{
        print(json_encode(""));
    }
}



function mob_display_my_cart_andr_2($usr_iid){         //================================ ANDROID 2 MY CART'
    $con = parent::connect();
   //@ $usr_iid = $_COOKIE['egura_user_id'];
    $sel_cart = $con->prepare("SELECT egura_cart.*,egura_products.* FROM egura_cart,egura_products WHERE egura_cart.cart_product=egura_products.product_id AND cart_user='$usr_iid'");
    $ok_sel_cart = $sel_cart->execute();
    if ($sel_cart->rowCount()>=1) {
        $ttl_qty = $ttl_prce = $ttl_shp = $ttl_ttl_shp = $ttl_ttl_price = 0;
        while ($ft_sel_cart = $sel_cart->fetch(PDO::FETCH_ASSOC)) {
                $cart_id = $ft_sel_cart['cart_id'];
                $ttl_price = ($ft_sel_cart['product_price']+$ft_sel_cart['product_chipping'])*$ft_sel_cart['cart_quantity'];

                $disp_my_cart_details[] =  $ft_sel_cart;
        }
        print(json_encode($disp_my_cart_details));
    }else{
        print(json_encode(""));
       }
}

                          //============================= RETURN MY CART NUMBER
function myCountCart_andr_2(){
    $con = parent::connect();
    @$usr_iid = $_COOKIE['egura_user_id'];
    if (isset($_COOKIE['egura_user_id'])) {
        $sel_my_cart = $con->prepare("SELECT COUNT(cart_id) AS mycart FROM  egura_cart WHERE cart_user=?");
        $sel_my_cart->bindValue(1,$usr_iid);
        $sel_my_cart->execute();
        $ft_sel_my_cart = $sel_my_cart->fetch(PDO::FETCH_ASSOC);
        $mycrt = $ft_sel_my_cart['mycart'];
        if ($mycrt==0) {
            $og_cart = "$mycrt";
        }else{
            $og_cart = "$mycrt";
        }
    }else{
        $og_cart = "0";
    }
    print(json_encode($og_cart));
}



















}

if (isset($_GET['and_products_imgs'])) {
    $main_andr = new MainSystemData();
    $main_andr-> and_products_imgs();
}
if (isset($_GET['andr_categories_list'])) {     //============ ANDROID DISPLAY CATEGORIES
    $main_andr = new MainSystemData();
    $main_andr-> mob_pro_cat_list_vertically_andr_2();
}
if (isset($_GET['andr_sub_categories_on_cat'])) {     //============ ANDROID 2 === FETCHING PRODUCT SUB CATEGOTRIES
    $main_andr = new MainSystemData();
    $main_andr-> mob_sel_pr_cat_sub_andr_2($_GET['category']);
}
if (isset($_GET['andr_products_on_sub_cat'])) {     //======================= ANDROID 2 sub categories products
    $main_andr = new MainSystemData();
    $main_andr-> mob_pro_cat_andr_2($_GET['sub_category']);
}
if (isset($_GET['andr_my_cart'])) {     //===================== ANDROID 2 MY CART'
    $main_andr = new MainSystemData();
    $main_andr-> mob_display_my_cart_andr_2($_GET['user_id']);
}
if (isset($_GET['andr_count_my_cart'])) {     //=================== RETURN MY CART NUMBER
    $main_andr = new MainSystemData();
    $main_andr-> myCountCart_andr_2();
}








/**
 * ======================================================================================================== MAIN USER CLASS
 */
class MainUser extends DbConnectt       
{
    
    function user_district($usrid){         //=============USER DISTRICT
        $conn = parent::connect();
        $sel_dis = $conn->prepare("SELECT egura_users.user_district FROM egura_users WHERE egura_users.user_id='$usrid'");
        $sel_dis->execute();
        if ($sel_dis->rowCount()==1) {
            $ft_sel_dis=$sel_dis->fetch(PDO::FETCH_ASSOC);
            $user_dis = $ft_sel_dis['user_district'];
            return $user_dis;
        }else{
            return null;
        }
    }




    function user_sector($usrid){           //=============USER SECTOR
        $conn = parent::connect();
        $sel_dis = $conn->prepare("SELECT egura_users.user_sector FROM egura_users WHERE egura_users.user_id='$usrid'");
        $sel_dis->execute();
        if ($sel_dis->rowCount()==1) {
            $ft_sel_dis=$sel_dis->fetch(PDO::FETCH_ASSOC);
            $user_dis = $ft_sel_dis['user_sector'];
            return $user_dis;
        }else{
            return null;
        }
    }




    function user_cell($usrid){         //=============USER CELL
        $conn = parent::connect();
        $sel_dis = $conn->prepare("SELECT egura_users.user_cell FROM egura_users WHERE egura_users.user_id='$usrid'");
        $sel_dis->execute();
        if ($sel_dis->rowCount()==1) {
            $ft_sel_dis=$sel_dis->fetch(PDO::FETCH_ASSOC);
            $user_dis = $ft_sel_dis['user_cell'];
            return $user_dis;
        }else{
            return null;
        }
    }



    function user_phone($usrid){            //=============USER PHONE
        $conn = parent::connect();
        $sel_dis = $conn->prepare("SELECT egura_users.user_phone FROM egura_users WHERE egura_users.user_id='$usrid'");
        $sel_dis->execute();
        if ($sel_dis->rowCount()==1) {
            $ft_sel_dis=$sel_dis->fetch(PDO::FETCH_ASSOC);
            $user_dis = $ft_sel_dis['user_phone'];
            return $user_dis;
        }else{
            return null;
        }
    }



    function user_fname($usrid){            //=============USER FNAME
        $conn = parent::connect();
        $sel_dis = $conn->prepare("SELECT egura_users.user_fname FROM egura_users WHERE egura_users.user_id='$usrid'");
        $sel_dis->execute();
        if ($sel_dis->rowCount()==1) {
            $ft_sel_dis=$sel_dis->fetch(PDO::FETCH_ASSOC);
            $user_dis = $ft_sel_dis['user_fname'];
            return $user_dis;
        }else{
            return null;
        }
    }


    function user_lname($usrid){            //=============USER LNAME
        $conn = parent::connect();
        $sel_dis = $conn->prepare("SELECT egura_users.user_lname FROM egura_users WHERE egura_users.user_id='$usrid'");
        $sel_dis->execute();
        if ($sel_dis->rowCount()==1) {
            $ft_sel_dis=$sel_dis->fetch(PDO::FETCH_ASSOC);
            $user_dis = $ft_sel_dis['user_lname'];
            return $user_dis;
        }else{
            return null;
        }
    }


    function user_email($usrid){            //=============USER EMAIL
        $conn = parent::connect();
        $sel_dis = $conn->prepare("SELECT egura_users.user_email FROM egura_users WHERE egura_users.user_id='$usrid'");
        $sel_dis->execute();
        if ($sel_dis->rowCount()==1) {
            $ft_sel_dis=$sel_dis->fetch(PDO::FETCH_ASSOC);
            $user_dis = $ft_sel_dis['user_email'];
            return $user_dis;
        }else{
            return null;
        }
    }




    function user_street($usrid){           //=============USER STREET
        $conn = parent::connect();
        $sel_dis = $conn->prepare("SELECT egura_users.user_street FROM egura_users WHERE egura_users.user_id='$usrid'");
        $sel_dis->execute();
        if ($sel_dis->rowCount()==1) {
            $ft_sel_dis=$sel_dis->fetch(PDO::FETCH_ASSOC);
            $user_dis = $ft_sel_dis['user_street'];
            return $user_dis;
        }else{
            return null;
        }
    }


function sel_pr_cat(){          //======================== FETCHING PRODUCT CATEGOTRIES
        $conn = parent::connect();
        $sel_dis = $conn->prepare("SELECT pro_categories.* FROM pro_categories WHERE pro_categories.cat_status='E' ORDER BY cat_name ASC");
        $sel_dis->execute();
        if ($sel_dis->rowCount()) {
            while ($ft_sel_cat = $sel_dis->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <option value="<?php echo $ft_sel_cat['cat_id'];?>"><?php echo $ft_sel_cat['cat_name'];?></option>
                <?php
            }
        }
}

function sel_pr_cat_sub($catt){         //======================== FETCHING PRODUCT SUB CATEGOTRIES
        $conn = parent::connect();
        $sel_dis = $conn->prepare("SELECT prod_sub_cat.* FROM prod_sub_cat WHERE prod_sub_cat.sub_cat_category='$catt' AND prod_sub_cat.sub_cat_status='E' ORDER BY sub_cat_name ASC");
        $sel_dis->execute();
        if ($sel_dis->rowCount()) {
            while ($ft_sel_dis = $sel_dis->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <option value="<?php echo $ft_sel_dis['sub_cat_id'];?>"><?php echo $ft_sel_dis['sub_cat_name'];?></option>
                <?php
            }
        }
}

function mob_sel_pr_cat_sub($catt){         //======================== MOBILE === FETCHING PRODUCT SUB CATEGOTRIES
        $conn = parent::connect();
        $sel_dis = $conn->prepare("SELECT prod_sub_cat.* FROM prod_sub_cat WHERE prod_sub_cat.sub_cat_category='$catt' AND prod_sub_cat.sub_cat_status='E' ORDER BY sub_cat_name ASC");
        $sel_dis->execute();
        if ($sel_dis->rowCount()) {
            while ($ft_sel_dis = $sel_dis->fetch(PDO::FETCH_ASSOC)) {
                $sub_cat_name = $ft_sel_dis['sub_cat_name'];
                $sub_cat_id = $ft_sel_dis['sub_cat_id'];
                $ssub_cat = dt_enc($sub_cat_id);
                ?>
                    <a href="categoryName.php?sub_cat=<?php echo $ssub_cat;?>">
                    <li>
                        <div class="thumb cat">
                            <img src="img/sub_cat_icon.jfif">
                        </div>
                        <?php echo "<span style='font-weight:bolder;font-size:20px;'>".$sub_cat_name."</span>";?>
                    </li>
                </a>
                    <?php
            }
        }
}


function mob_pro_cat($pr_cat){      //======================= mobile sub categories products
    $con = parent::connect();
    $sel_pro_cat = $con->prepare("SELECT * FROM egura_products WHERE product_cat=? ORDER BY RAND()");
    $sel_pro_cat->bindValue(1,$pr_cat);
    $sel_pro_cat->execute();
    if ($sel_pro_cat->rowCount()>=1) {
        while ($ft_sel_pro_cat = $sel_pro_cat->fetch(PDO::FETCH_ASSOC)) {
            $pro_id = $ft_sel_pro_cat['product_id'];
            $pro_name = $ft_sel_pro_cat['product_name'];
            $pro_file = $ft_sel_pro_cat['product_file'];
            $pro_desc = $ft_sel_pro_cat['product_descr'];
            $pro_prc = $ft_sel_pro_cat['product_price'];
            $snd_prid = dt_enc($pro_id);
            ?>
                <a href="item.php?pro=<?php echo $snd_prid;?>">
                <div class="categoryLine">
                    <div class="thumb Line">
                        <img src="https://e-gura.com/images/products/<?php echo $pro_file; ?>">
                    </div>
                    <div class="proinfo">
                    <p><?php echo $pro_desc;?></p>
                    <b>RWF <?php echo number_format($pro_prc); ?></b>
                    <i>Free shipping</i> <br>
                    <i><?php echo 3*0.1; ?> <span class="fa fa-star"></span> <?php echo number_format(rand(1,$pro_prc)); ?> Sold</i>
                    </div>
                </div>
            </a>
            <?php
        }
    }else{
        echo "No products available ...";
    }
}

function mob_product_details($pro_id){     //================================ mobile product details
    $con = parent::connect();
    $sel_pro = $con->prepare("SELECT * FROM egura_products WHERE product_id=?");
    $sel_pro->bindValue(1,$pro_id);
    $sel_pro->execute();
    if ($sel_pro->rowCount()==1) {
        $ft_sel_pro = $sel_pro->fetch(PDO::FETCH_ASSOC);
        $pro_nme = $ft_sel_pro['product_name'];
        $pro_prc = $ft_sel_pro['product_price'];
        $pro_qnt = $ft_sel_pro['product_qnty'];
        $pro_ship = $ft_sel_pro['product_chipping'];
        $pro_desc = $ft_sel_pro['product_descr'];
        @$usr_iid = $_COOKIE['egura_user_id'];
        switch ($ft_sel_pro['product_size']) {
            case null OR "":
                $pro_sz = "-";
                break;
            
            default:
                $pro_sz = $ft_sel_pro['product_size'];
                break;
        }
        switch ($ft_sel_pro['product_color']) {
            case null OR "":
                $pro_cl = "-";
                break;
            
            default:
                $pro_cl = $ft_sel_pro['product_color'];
                break;
        }
        switch ($ft_sel_pro['product_sex']) {
            case null OR "":
                $pro_sx = "-";
                break;
            
            default:
                $pro_sx = $ft_sel_pro['product_sex'];
                break;
        }

        $pro_fl1 = $ft_sel_pro['product_file'];
        $pro_fl2 = $ft_sel_pro['product_file_2'];
        $pro_fl3 = $ft_sel_pro['product_file_3'];
        ?>
<div class="thumb nail">
    <img src="https://e-gura.com/images/products/<?php echo $pro_fl1; ?>">
</div>
<div class="subImg">
    <div class="thumb sub">
        <img src="https://e-gura.com/images/products/<?php echo $pro_fl1; ?>">
    </div>

    <div class="thumb sub">
        <img src="https://e-gura.com/images/products/<?php echo $pro_fl2; ?>">
    </div>

    <div class="thumb sub">
        <img src="https://e-gura.com/images/products/<?php echo $pro_fl3; ?>">
    </div>
</div>
<div class="contain">
    <div class="iteminfo">
        <h1><?php echo $pro_nme?></h1>
        <b>RWF <?php echo number_format($pro_prc);?></b>
        <div class="like">
            <i class="fa fa-heart"></i>
            <span><?php echo round($pro_id*100/98);?></span>
        </div><br>
        <?php 
        $str = strval($pro_prc*54/32);
        $sub = substr($str, 0,2);

        ?>
        <i style="text-decoration: line-through;">RWF <?php echo $pro_prc+(($pro_prc*$sub)/100);?></i> <span>-<?php echo $sub?>%</span>
        <p><?php echo $pro_desc?></p>
        <i><?php echo ceil($pro_qnt/3)?> Orders</i>
        <label><spanss style="font-weight: bolder;">Product Size:</spanss> <?php echo ucfirst($pro_sz);?></label>
        <label><spanss style="font-weight: bolder;">Product Color: </spanss><?php echo ucfirst($pro_cl);?></label>
        <label><spanss style="font-weight: bolder;">Product Gnr: </spanss><?php echo ucfirst($pro_sx);?></label>
        <label><spanss style="font-weight: bolder;">Products in Stock: </spanss><?php echo number_format($pro_qnt,2);?></label>
        <label><spanss style="font-weight: bolder;">Quantity to buy: </spanss><input id="qnty_to_buy" style="width: 20%;height: 30px;font-size: 25px;font-weight: bolder;" type="number" class="form-control"></label>
    </div>
    <input type="hidden" id="pppr_usr" value="<?php echo $usr_iid;?>">
    <input type="hidden" id="pppr_id" value="<?php echo $pro_id;?>">

</div>
<div class="footer item">
    <div class="footertab">
        <i class="fa fa-store"></i>
    </div>
    <div class="footertab" onclick="return MobAddToCart()">
        add to cart
    </div>

    <div class="footertab" onclick="return MobBuyNow()">
        buy now
    </div>
</div>
        <?php
    }else{
        echo "Something Wrong ...";
    }
}


//======================================================================================== PROCEED WITH PAYMENT SINGLE PRODUCT

function proceed_with_pay_pr_details($pro,$usr,$qnt){
    $MainSystemData = new MainSystemData();
        $pro = $pro;
        $usr = $usr;
        $qnt = $qnt;
?>
            <div class="E-GURA-informations">
                <div class="row">
                            
                    <div class="col-xs-10 center-block" style="margin-left: 8%">
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
                                    <?php echo $MainSystemData->product_name($pro);?>
                                </td>
                            </tr>
                            <tr style="background-color: #dee0df;">
                                <td>
                                    Price: 
                                </td>
                                <td style="font-weight: bolder;">
                                    <?php echo number_format($MainSystemData->product_price($pro));?>
                                </td>
                                <td>
                                    &nbsp;&nbsp;&nbsp; Shipping:  
                                </td>
                                <td style="font-weight: bolder;">
                                    <?php echo $MainSystemData->product_chipping($pro);?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    Quantity: 
                                </td>
                                <td colspan="2" style="font-weight: bolder;">
                                    <?php echo $qnt;?>
                                </td>
                            </tr>
                            <tr style="background-color: #dee0df;">
                                <td colspan="2">
                                    Details: 
                                    
                                </td>
                                <td colspan="2">
                                    <?php echo "<b>#Rwf &nbsp;</b>".number_format($MainSystemData->product_price($pro))."  <b>(</b>".$qnt."<b>)</b> + ".number_format($MainSystemData->product_chipping($pro))."" ;?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="1">
                                    Total: 
                                </td>
                                <td colspan="3" style="font-weight: bolder;">
                                    <center>
                                    <?php 
                                    $total_amount = ($MainSystemData->product_price($pro)*$qnt)+$MainSystemData->product_chipping($pro);
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
                                    <?php echo strtoupper(self::user_fname($usr))." ".ucfirst(self::user_lname($usr));?>
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
                                       // $phone = self::user_phone($usr);
                                     echo self::user_phone($usr);
                                     ?>
                                    </center>
                                </td>
                                <td>
                                    Email:
                                </td>
                                <td style="font-weight: bolder;text-transform: lowercase;">
                                    <center>
                                    <?php echo strtolower(self::user_email($usr));?>
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
                                    <?php echo self::user_district($usr);?>
                                    </center>
                                </td>
                                <td>
                                    Sector:
                                </td>
                                <td style="font-weight: bolder;text-transform: lowercase;">
                                    <center>
                                    <?php echo ucfirst(strtolower(self::user_sector($usr)));?>
                                    </center>
                                </td>
                            </tr>
                            <tr style="background-color: #dee0df;">
                                <td colspan="2">
                                    Cell: 
                                </td>
                                <td style="font-weight: bolder;">
                                    <center>
                                    <?php echo ucfirst(strtolower(self::user_cell($usr)));?>
                                    </center>
                                </td>
                                <td>
                                    Street:
                                </td>
                                <td style="font-weight: bolder;text-transform: lowercase;text-align: center;">
                                    <center style="float: left;">
                                    <?php echo self::user_street($usr);?>
                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5"><br>
                                    <?php
                                    $upnm = strtoupper(self::user_fname($usr))." ".ucfirst(self::user_lname($usr));
                                        $fnm = strtoupper(self::user_fname($usr));
                                        $lnm = ucfirst(self::user_lname($usr));
                                    $pnm = $MainSystemData->product_name($pro);
                                    $qnt = $qnt;
                                    $phn = self::user_phone($usr);
                                    $dst = ucfirst(strtolower(self::user_district($usr)));
                                    $str = ucfirst(strtolower(self::user_sector($usr)));
                                    $cll = ucfirst(strtolower(self::user_cell($usr)));
                                    $amnt = $total_amount;
                                    date_default_timezone_set("Africa/Kigali");
                                    $today_date = date("Y/m/d");
                                    // $tme = date("Y/m/d - h:i:sa");
                                    $eml = self::user_email($usr);
                                    // $fnme = self::user_fname($usr);
                                    // $lnme = self::user_lname($usr);
                                    ?>
                                        <input type="hidden" id="upnm" value="<?php echo $upnm;?>">
                                        <input type="hidden" id="pnm" value="<?php echo $pnm;?>">
                                        <input type="hidden" id="qnt" value="<?php echo $qnt;?>">
                                        <input type="hidden" id="phn" value="<?php echo $phn;?>">
                                        <input type="hidden" id="dst" value="<?php echo $dst;?>">
                                        <input type="hidden" id="str" value="<?php echo $str;?>">
                                        <input type="hidden" id="cll" value="<?php echo $cll;?>">
                                        <input type="hidden" id="amnt" value="<?php echo $amnt;?>">
                                        <?php

                                        $mydt = "$pnm,$amnt,$eml,$upnm";

                                        $authToken = 'randomaccesstoken';

   
    $context = stream_context_create(array(
        'http' => array(
            'method' => 'POST',
            'header' => "Access-Token: {$authToken}\r\n".
                        "Content-Type: text/plain\r\n",
            'content' => "<?xml version='1.0' encoding='utf-8'?>
<API3G>
<CompanyToken>A745AA29-B46C-4FB1-BDED-C5A1D43C91CC</CompanyToken>
<Request>createToken</Request>
<Transaction>
<PaymentAmount>$amnt</PaymentAmount>
<PaymentCurrency>RWF</PaymentCurrency>
<CompanyRef>49FKEOA</CompanyRef>
<RedirectURL>https://www.e-gura.com?mydata=$mydt</RedirectURL>
<BackURL>https://www.e-gura.com </BackURL>
<CompanyRefUnique>0</CompanyRefUnique>
<PTL>15</PTL>
<PTLtype>hours</PTLtype>
<customerFirstName>$fnm</customerFirstName>
<customerLastName>$lnm</customerLastName>
<customerZip>250</customerZip>
<customerCity>$dst</customerCity>
<customerCountry>RW</customerCountry>
<customerEmail></customerEmail>
</Transaction>
<Services>
 <Service>
   <ServiceType>31816</ServiceType>
   <ServiceDescription>Buy $pnm</ServiceDescription>
   <ServiceDate>$today_date</ServiceDate>
 </Service>
</Services>
</API3G>")
    ));
   
    $response = file_get_contents('https://secure.3gdirectpay.com/API/v6/', FALSE, $context);
   
        if($response === FALSE){
            die('Error');
        }



$xml = simplexml_load_string($response);
if( $xml ){
    ?>

    <script type="text/javascript">
        window.location = "https://secure.3gdirectpay.com/pay.asp?ID=<?=$xml->TransToken?>";
    </script>


    <?php

}else{
    var_dump($result);
}


                                        ?>
                                        <button class="btn btn-success" id="ssb" onclick="return proceedWithPayPrDetails();">Proceed</button>

                                </td>
                            </tr>
                         </table>
                    </div>

                    </div>
                </div>
<?php
}//======================================================================================== PROCEED WITH PAYMENT ON CART PRODUCTS

function proceed_with_pay_pr_details_cart($pro,$usr,$qnt){
    $MainSystemData = new MainSystemData();
        $pros = $pro;
        $usr = $usr;
        $total_price = $qnt;
?>
            <div class="E-GURA-informations">
                <div class="row">
                            
                    <div class="col-xs-10 center-block" style="margin-left: 8%">
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
                                    <?php echo $pros;?>
                                </td>
                            </tr>


                            <tr>
                                <td colspan="1">
                                    Total: 
                                </td>
                                <td colspan="3" style="font-weight: bolder;">
                                    <center>
                                    <?php 
                                    echo number_format($total_price)."&nbsp;Rwf";
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
                                    <?php echo strtoupper(self::user_fname($usr))." ".ucfirst(self::user_lname($usr));?>
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
                                       // $phone = self::user_phone($usr);
                                     echo self::user_phone($usr);
                                     ?>
                                    </center>
                                </td>
                                <td>
                                    Email:
                                </td>
                                <td style="font-weight: bolder;text-transform: lowercase;">
                                    <center>
                                    <?php echo strtolower(self::user_email($usr));?>
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
                                    <?php echo self::user_district($usr);?>
                                    </center>
                                </td>
                                <td>
                                    Sector:
                                </td>
                                <td style="font-weight: bolder;text-transform: lowercase;">
                                    <center>
                                    <?php echo ucfirst(strtolower(self::user_sector($usr)));?>
                                    </center>
                                </td>
                            </tr>
                            <tr style="background-color: #dee0df;">
                                <td colspan="2">
                                    Cell: 
                                </td>
                                <td style="font-weight: bolder;">
                                    <center>
                                    <?php echo ucfirst(strtolower(self::user_cell($usr)));?>
                                    </center>
                                </td>
                                <td>
                                    Street:
                                </td>
                                <td style="font-weight: bolder;text-transform: lowercase;text-align: center;">
                                    <center style="float: left;">
                                    <?php echo self::user_street($usr);?>
                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5"><br>
                                    <?php
                                    $upnm = strtoupper(self::user_fname($usr))." ".ucfirst(self::user_lname($usr));
                                        $fnm = strtoupper(self::user_fname($usr));
                                        $lnm = ucfirst(self::user_lname($usr));
                                    $pnm = $MainSystemData->product_name($pro);
                                    $qnt = $qnt;
                                    $phn = self::user_phone($usr);
                                    $dst = ucfirst(strtolower(self::user_district($usr)));
                                    $str = ucfirst(strtolower(self::user_sector($usr)));
                                    $cll = ucfirst(strtolower(self::user_cell($usr)));
                                    $amnt = $total_price;
                                    date_default_timezone_set("Africa/Kigali");
                                    $today_date = date("Y/m/d");
                                    // $tme = date("Y/m/d - h:i:sa");
                                    $eml = self::user_email($usr);
                                    // $fnme = self::user_fname($usr);
                                    // $lnme = self::user_lname($usr);
                                    ?>
                                        <input type="hidden" id="upnm" value="<?php echo $upnm;?>">
                                        <input type="hidden" id="pnm" value="<?php echo $pnm;?>">
                                        <input type="hidden" id="qnt" value="<?php echo $qnt;?>">
                                        <input type="hidden" id="phn" value="<?php echo $phn;?>">
                                        <input type="hidden" id="dst" value="<?php echo $dst;?>">
                                        <input type="hidden" id="str" value="<?php echo $str;?>">
                                        <input type="hidden" id="cll" value="<?php echo $cll;?>">
                                        <input type="hidden" id="amnt" value="<?php echo $amnt;?>">
                                        <?php

                                        $mydt = "$pnm,$amnt,$eml,$upnm";

                                        $authToken = 'randomaccesstoken';

   
    $context = stream_context_create(array(
        'http' => array(
            'method' => 'POST',
            'header' => "Access-Token: {$authToken}\r\n".
                        "Content-Type: text/plain\r\n",
            'content' => "<?xml version='1.0' encoding='utf-8'?>
<API3G>
<CompanyToken>A745AA29-B46C-4FB1-BDED-C5A1D43C91CC</CompanyToken>
<Request>createToken</Request>
<Transaction>
<PaymentAmount>$amnt</PaymentAmount>
<PaymentCurrency>RWF</PaymentCurrency>
<CompanyRef>49FKEOA</CompanyRef>
<RedirectURL>https://www.e-gura.com?mydata=$mydt</RedirectURL>
<BackURL>https://www.e-gura.com </BackURL>
<CompanyRefUnique>0</CompanyRefUnique>
<PTL>15</PTL>
<PTLtype>hours</PTLtype>
<customerFirstName>$fnm</customerFirstName>
<customerLastName>$lnm</customerLastName>
<customerZip>250</customerZip>
<customerCity>$dst</customerCity>
<customerCountry>RW</customerCountry>
<customerEmail></customerEmail>
</Transaction>
<Services>
 <Service>
   <ServiceType>31816</ServiceType>
   <ServiceDescription>Buy $pros</ServiceDescription>
   <ServiceDate>$today_date</ServiceDate>
 </Service>
</Services>
</API3G>")
    ));
   
    $response = file_get_contents('https://secure.3gdirectpay.com/API/v6/', FALSE, $context);
   
        if($response === FALSE){
            die('Error');
        }



$xml = simplexml_load_string($response);
if( $xml ){
    ?>

    <script type="text/javascript">
        window.location = "https://secure.3gdirectpay.com/pay.asp?ID=<?=$xml->TransToken?>";
    </script>


    <?php

}else{
    var_dump($result);
}


                                        ?>
                                        <button class="btn btn-success" id="ssb" onclick="return proceedWithPayPrDetails();">Proceed</button>

                                </td>
                            </tr>
                         </table>
                    </div>

                    </div>
                </div>
<?php
}
//============================================================================================= DISPLAY MY CART -- ON 'ADD ON CART PAGE'

function display_my_cart_add(){
    $con = parent::connect();
    $usr_iid = $_COOKIE['egura_user_id'];
    $sel_cart = $con->prepare("SELECT egura_cart.*,egura_products.* FROM egura_cart,egura_products WHERE egura_cart.cart_product=egura_products.product_id AND cart_user='$usr_iid'");
    $ok_sel_cart = $sel_cart->execute();
    if ($sel_cart->rowCount()>=1) {
        echo "<table style='width:100%' class='table table-striped'>";
        echo "<tr>";
            echo "<th>#</th>";
            echo "<th>Product</th>";
            echo "<th>Quantity</th>";
            echo "<th>Unity Price</th>";
            echo "<th>Shipping</th>";
            echo "<th>Total Price</th>";
            echo "<th>Actions</th>";
        echo "</tr>";
        $cntt = 1;
        $ttl_qty = $ttl_prce = $ttl_shp = $ttl_ttl_shp = $ttl_ttl_price = 0;
        while ($ft_sel_cart = $sel_cart->fetch(PDO::FETCH_ASSOC)) {
                $cart_id = $ft_sel_cart['cart_id'];
                $ttl_price = ($ft_sel_cart['product_price']+$ft_sel_cart['product_chipping'])*$ft_sel_cart['cart_quantity'];

                $ttl_qty+=$ft_sel_cart['cart_quantity'];
                $ttl_prce+=$ft_sel_cart['product_price'];
                $ttl_shp+=$ft_sel_cart['product_chipping'];
                $ttl_ttl_price+=$ttl_price;

            echo "<tbody style='font-weight:lighter'>";
            echo "<tr>";
                echo "<td>$cntt. &nbsp;</td>";
                echo "<td>".$ft_sel_cart['product_name']."</td>";
                echo "<td>".number_format($ft_sel_cart['cart_quantity'])."</td>";
                
                echo "<td>".number_format($ft_sel_cart['product_price'])."</td>";
                
                echo "<td>".number_format($ft_sel_cart['product_chipping'])."</td>";
                
                
                
                echo "<td>".number_format($ttl_price)."</td>";
                ?>
                <td><button onclick="return removeOnCart('<?php echo dt_enc($cart_id)?>')" style='border-radius:10px' class='btn  btn-danger'><i class='fa fa-window-close'></i> Remove</button></td>
                <?php
            echo "</tr>";

            

            $cntt++;

        }
            echo "<tr style='font-weight:bolder'>";
                echo "<td colspan='2'>Total (#Rwf) :</td>";
                echo "<td>".number_format($ttl_qty)."</td>";
                echo "<td>".number_format($ttl_prce)."</td>";
                echo "<td>".number_format($ttl_shp)."</td>";
                echo "<td>".number_format($ttl_ttl_price)."</td>";
            echo "</tr>";
            echo "</tbody>";
        echo "</table>";
    }else{
        echo "<center><h3> No product in your cart ...</h3></center>";
    }
}

//============================================================================================= DISPLAY MY CART -- ON 'MY CART PAGE'

function display_my_cart(){
    $con = parent::connect();
   @ $usr_iid = $_COOKIE['egura_user_id'];
    $sel_cart = $con->prepare("SELECT egura_cart.*,egura_products.* FROM egura_cart,egura_products WHERE egura_cart.cart_product=egura_products.product_id AND cart_user='$usr_iid'");
    $ok_sel_cart = $sel_cart->execute();
    if ($sel_cart->rowCount()>=1) {
        echo "<table style='width:100%' class='table table-striped'>";
        echo "<thead>";
            echo "<th>#</th>";
            echo "<th>Product</th>";
            echo "<th>Quantity</th>";
            echo "<th>Unity Price</th>";
            echo "<th>Shipping</th>";
            echo "<th>Total Price</th>";
            echo "<th>Actions</th>";
        echo "</thead>";
        $cntt = 1;
        $ttl_qty = $ttl_prce = $ttl_shp = $ttl_ttl_shp = $ttl_ttl_price = 0;
        while ($ft_sel_cart = $sel_cart->fetch(PDO::FETCH_ASSOC)) {
                $cart_id = $ft_sel_cart['cart_id'];
                $ttl_price = ($ft_sel_cart['product_price']+$ft_sel_cart['product_chipping'])*$ft_sel_cart['cart_quantity'];

                $ttl_qty+=$ft_sel_cart['cart_quantity'];
                $ttl_prce+=$ft_sel_cart['product_price'];
                $ttl_shp+=$ft_sel_cart['product_chipping'];
                $ttl_ttl_price+=$ttl_price;

            echo "<tbody style='font-weight:lighter'>";
            echo "<tr>";
                echo "<td>$cntt. &nbsp;</td>";
                echo "<td>".$ft_sel_cart['product_name']."</td>";
                echo "<td>".number_format($ft_sel_cart['cart_quantity'])."</td>";
                
                echo "<td>".number_format($ft_sel_cart['product_price'])."</td>";
                
                echo "<td>".number_format($ft_sel_cart['product_chipping'])."</td>";
                
                
                
                echo "<td>".number_format($ttl_price)."</td>";
                ?>
                <td><button onclick="return removeOnCart('<?php echo dt_enc($cart_id)?>')" style='border-radius:10px' class='btn  btn-danger'><i class='fa fa-window-close'></i> Remove</button></td>
                <?php
            echo "</tr>";

            

            $cntt++;

        }
            echo "<tr style='font-weight:bolder'>";
                echo "<td colspan='2'>Total (#Rwf) :</td>";
                echo "<td>".number_format($ttl_qty)."</td>";
                echo "<td>".number_format($ttl_prce)."</td>";
                echo "<td>".number_format($ttl_shp)."</td>";
                echo "<td>".number_format($ttl_ttl_price)."</td>";
            echo "</tr>";

            echo "<tr<td> </td><td> &nbsp;&nbsp; </td><td> &nbsp;&nbsp; </td><td> &nbsp;&nbsp; </td><td> &nbsp;&nbsp; </td><td> &nbsp;&nbsp; </td></tr>";
            echo "<tr>";
                echo "<td colspan='7'> ";
                $usr_id = $_COOKIE['egura_user_id'];

                $cart_products = dt_enc(self::my_cart_pro_names());
                $ttl_price = dt_enc($ttl_ttl_price);
                $user = dt_enc($usr_id);
                echo "<a href='https://e-gura.com/shipping.php?proos=$cart_products&usr=$user&qnt=$ttl_price'><button style='color:#fff;background-color:#3a3;font-weight:bolder' type='button' class='btn btn-success'>Proceed with payment</button></a>";

                echo" </td>";
            echo "</tr>";
            echo "</tbody>";
        echo "</table>";
    }else{
        echo "<center><h3> No product in your cart ...</h3></center>";
    }
}

//============================================================================== MOBILE ====== DISPLAY MY CART -- ON 'MY CART PAGE'

function mob_display_my_cart(){
    $con = parent::connect();
   @ $usr_iid = $_COOKIE['egura_user_id'];
    $sel_cart = $con->prepare("SELECT egura_cart.*,egura_products.* FROM egura_cart,egura_products WHERE egura_cart.cart_product=egura_products.product_id AND cart_user='$usr_iid'");
    $ok_sel_cart = $sel_cart->execute();
    if ($sel_cart->rowCount()>=1) {
        echo "<table style='width:100%' class='table table-striped'>";
        echo "<thead>";
            echo "<th>#</th>";
            echo "<th>Product</th>";
            echo "<th>Quantity</th>";
            echo "<th>Unity Price</th>";
            echo "<th>Shipping</th>";
            echo "<th>Total Price</th>";
            echo "<th>Actions</th>";
        echo "</thead>";
        $cntt = 1;
        $ttl_qty = $ttl_prce = $ttl_shp = $ttl_ttl_shp = $ttl_ttl_price = 0;
        while ($ft_sel_cart = $sel_cart->fetch(PDO::FETCH_ASSOC)) {
                $cart_id = $ft_sel_cart['cart_id'];
                $ttl_price = ($ft_sel_cart['product_price']+$ft_sel_cart['product_chipping'])*$ft_sel_cart['cart_quantity'];

                $ttl_qty+=$ft_sel_cart['cart_quantity'];
                $ttl_prce+=$ft_sel_cart['product_price'];
                $ttl_shp+=$ft_sel_cart['product_chipping'];
                $ttl_ttl_price+=$ttl_price;

            echo "<tbody style='font-weight:lighter'>";
            echo "<tr>";
                echo "<td>$cntt. &nbsp;</td>";
                echo "<td>".$ft_sel_cart['product_name']."</td>";
                echo "<td>".number_format($ft_sel_cart['cart_quantity'])."</td>";
                
                echo "<td>".number_format($ft_sel_cart['product_price'])."</td>";
                
                echo "<td>".number_format($ft_sel_cart['product_chipping'])."</td>";
                
                
                
                echo "<td>".number_format($ttl_price)."</td>";
                ?>
                <td><button onclick="return removeOnCart('<?php echo dt_enc($cart_id)?>')" style='border-radius:10px' class='btn  btn-danger'><i class='fa fa-window-close'></i> Remove</button></td>
                <?php
            echo "</tr>";

            

            $cntt++;

        }
            echo "<tr style='font-weight:bolder'>";
                echo "<td colspan='2'>Total (#Rwf) :</td>";
                echo "<td>".number_format($ttl_qty)."</td>";
                echo "<td>".number_format($ttl_prce)."</td>";
                echo "<td>".number_format($ttl_shp)."</td>";
                echo "<td>".number_format($ttl_ttl_price)."</td>";
            echo "</tr>";

            echo "<tr<td> </td><td> &nbsp;&nbsp; </td><td> &nbsp;&nbsp; </td><td> &nbsp;&nbsp; </td><td> &nbsp;&nbsp; </td><td> &nbsp;&nbsp; </td></tr>";
            echo "<tr>";
                echo "<td colspan='7'> ";
                $usr_id = $_COOKIE['egura_user_id'];

                $cart_products = dt_enc(self::my_cart_pro_names());
                $ttl_price = dt_enc($ttl_ttl_price);
                $user = dt_enc($usr_id);
                echo "<a href='shipping.php?proos=$cart_products&usr=$user&qnt=$ttl_price'><button style='color:#fff;background-color:#3a3;font-weight:bolder' type='button' class='btn btn-success'>Proceed with payment</button></a>";

                echo" </td>";
            echo "</tr>";
            echo "</tbody>";
        echo "</table>";
    }else{
        echo "<center><h3> No product in your cart ...</h3></center>";
    }
}

function my_cart_pro_names(){
    $usr_iid = $_COOKIE['egura_user_id'];
    $con = parent::connect();
    $sel_pr_nm = $con->prepare("SELECT egura_cart.*,egura_products.* FROM egura_cart,egura_products WHERE egura_cart.cart_product=egura_products.product_id AND cart_user='$usr_iid'");
    $sel_pr_nm->execute();
    if ($sel_pr_nm->rowCount()>=1) {
        $resp_pro = "";
        while ($ft_sel_pr_nm = $sel_pr_nm->fetch(PDO::FETCH_ASSOC)) {
            $pro_nmm = $ft_sel_pr_nm['product_name'];
            $pr_crt_qnt = $ft_sel_pr_nm['cart_quantity'];
            $resp_pros = $pro_nmm." (".$pr_crt_qnt.") ,";
            $resp_pro = $resp_pro." ".$resp_pros;
        }
    }else{
        $resp_pro = "-";
    }
    return rtrim($resp_pro,',');

}









//=================================================================================================================== ANDROID PAYMENT

function andr_proceed_with_pay_pr_details($pro,$usr,$qnt){
    $MainSystemData = new MainSystemData();
        $pro = $pro;
        $usr = $usr;
        $qnt = $qnt;

        $upnm = strtoupper(self::user_fname($usr))." ".ucfirst(self::user_lname($usr));
        $fnm = strtoupper(self::user_fname($usr));
        $lnm = ucfirst(self::user_lname($usr));
        $pnm = $MainSystemData->product_name($pro);
        $qnt = $qnt;
        $phn = self::user_phone($usr);
        $dst = ucfirst(strtolower(self::user_district($usr)));
        $str = ucfirst(strtolower(self::user_sector($usr)));
        $cll = ucfirst(strtolower(self::user_cell($usr)));
        $amnt = ($MainSystemData->product_price($pro)*$qnt)+$MainSystemData->product_chipping($pro);

        date_default_timezone_set("Africa/Kigali");
        $today_date = date("Y/m/d");


        $mydt = "$pnm,$amnt,$eml,$upnm";
        $authToken = 'randomaccesstoken';

   
    $context = stream_context_create(array(
        'http' => array(
            'method' => 'POST',
            'header' => "Access-Token: {$authToken}\r\n".
                        "Content-Type: text/plain\r\n",
            'content' => "<?xml version='1.0' encoding='utf-8'?>
<API3G>
<CompanyToken>A745AA29-B46C-4FB1-BDED-C5A1D43C91CC</CompanyToken>
<Request>createToken</Request>
<Transaction>
<PaymentAmount>$amnt</PaymentAmount>
<PaymentCurrency>RWF</PaymentCurrency>
<CompanyRef>49FKEOA</CompanyRef>
<RedirectURL>https://www.e-gura.com?mydata=$mydt</RedirectURL>
<BackURL>https://www.e-gura.com </BackURL>
<CompanyRefUnique>0</CompanyRefUnique>
<PTL>15</PTL>
<PTLtype>hours</PTLtype>
<customerFirstName>$fnm</customerFirstName>
<customerLastName>$lnm</customerLastName>
<customerZip>250</customerZip>
<customerCity>$dst</customerCity>
<customerCountry>RW</customerCountry>
<customerEmail></customerEmail>
</Transaction>
<Services>
 <Service>
   <ServiceType>31816</ServiceType>
   <ServiceDescription>Buy $pnm</ServiceDescription>
   <ServiceDate>$today_date</ServiceDate>
 </Service>
</Services>
</API3G>")
    ));
   
    $response = file_get_contents('https://secure.3gdirectpay.com/API/v6/', FALSE, $context);
   
        if($response === FALSE){
            die('Error');
        }



$xml = simplexml_load_string($response);
if( $xml ){

    return print("https://secure.3gdirectpay.com/pay.asp?ID=$xml->TransToken");
    ?>

<!--     <script type="text/javascript">
        window.location = "https://secure.3gdirectpay.com/pay.asp?ID=<?=$xml->TransToken?>";
    </script> -->


    <?php

}else{
    var_dump($result);
}


} //Closing function







//================================================================================================================== RETURN MY CART NUMBER

function myCountCart(){
    $con = parent::connect();
    @$usr_iid = $_COOKIE['egura_user_id'];
    if (isset($_COOKIE['egura_user_id'])) {
        $sel_my_cart = $con->prepare("SELECT COUNT(cart_id) AS mycart FROM  egura_cart WHERE cart_user=?");
        $sel_my_cart->bindValue(1,$usr_iid);
        $sel_my_cart->execute();
        $ft_sel_my_cart = $sel_my_cart->fetch(PDO::FETCH_ASSOC);
        $mycrt = $ft_sel_my_cart['mycart'];
        if ($mycrt==0) {
            $og_cart = "$mycrt";
        }else{
            $og_cart = "$mycrt";
        }
    }else{
        $og_cart = "0";
    }

    return $og_cart;

}



}

if (isset($_GET['andr_proceed_with_pay_pr_details'])) {
    $MainUser = new MainUser();
    $andr_proceed_with_pay_pr_details = $MainUser->andr_proceed_with_pay_pr_details($_GET['product_id'],$_GET['user_id'],$_GET['quantity']);
}




/**
 * ========================================================================ANDROI APIS
 */
class AndroidApis extends DbConnectt
{
    
    function all_products_categories(){         //============================ DISPLAYING ALL PRODUCT CATEGORIES
        $conn = parent::connect();
        $sel_all_cat = $conn->prepare("SELECT * FROM pro_categories order by RAND()");
        $sel_all_cat->execute();
        if ($sel_all_cat->rowCount()>=1) {
            while ($ft_sel_all_cat = $sel_all_cat->fetch(PDO::FETCH_ASSOC)) {
                $all_cat['all_categories'][] = $ft_sel_all_cat;
            }
            return print(json_encode($all_cat));
        }
    }


    function categories_products($category){        //============================ DISPLAYING CATEGORIES'S PRODUCTS 
        $conn = parent::connect();
        $sel_pro_cat = $conn->prepare("SELECT * FROM egura_products WHERE product_cat IN (SELECT sub_cat_id FROM prod_sub_cat WHERE sub_cat_category='$category') ORDER BY RAND()");
        $sel_pro_cat->execute();
        if ($sel_pro_cat->rowCount()) {
            $cntt=0;
            while ($ft_sel_prod = $sel_pro_cat->fetch(PDO::FETCH_ASSOC)) {
            //  $pro_cat['category_products'][] = $ft_sel_prod;

            $pro_cat['and_products_imgs'][$cntt] = ($mani_array[]=$ft_sel_prod);


            $pr_id = $ft_sel_prod['product_id'];
            $sel_pro_category = $conn->prepare("SELECT egura_products.product_cat,prod_sub_cat.sub_cat_category,pro_categories.cat_name AS p_cat FROM egura_products,prod_sub_cat,pro_categories WHERE egura_products.product_id='$pr_id' AND egura_products.product_cat=prod_sub_cat.sub_cat_id AND prod_sub_cat.sub_cat_category=pro_categories.cat_id");
            $sel_pro_category->execute();
            if ($sel_pro_category->rowCount()>=1) {
                $ft_sel_pro_category = $sel_pro_category->fetch(PDO::FETCH_ASSOC);
                $pro_cat['and_products_imgs'][$cntt]['product_category'] = $ft_sel_pro_category['p_cat'];
            }else{
                $pro_cat['and_products_imgs'][$cntt]['product_category'] = $sel_pro_category->rowCount();
            }

            
            $pro_cat['and_products_imgs'][$cntt]['product_file'] ="https://e-gura.com/images/products/".$ft_sel_prod['product_file'];
            $pro_cat['and_products_imgs'][$cntt]['product_file_2'] ="https://e-gura.com/images/products/".$ft_sel_prod['product_file_2'];
            $pro_cat['and_products_imgs'][$cntt]['product_file_3'] ="https://e-gura.com/images/products/".$ft_sel_prod['product_file_3'];
            $cntt++;
            }
            return print(json_encode($pro_cat));
        }else{
            $pro_cat['and_products_imgs']=[];
            return print(json_encode($pro_cat));
        }
    }







}

        //============================ DISPLAYING ALL PRODUCT CATEGORIES
if (isset($_GET['all_products_categories'])) {
    $androidApis = new AndroidApis();
    $androidApis->all_products_categories();
}
        //============================ DISPLAYING CATEGORIES'S PRODUCTS 
if (isset($_GET['categories_products'])) {
    $androidApis = new AndroidApis();
    $androidApis->categories_products($_GET['categories_products']);
}


?>