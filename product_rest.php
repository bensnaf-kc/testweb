<?php
    session_start();
    $_SESSION['cus_id']=1234;
?>

<?php
    include_once("class.db.php");
    if ($_SERVER["REQUEST_METHOD"]=='GET') {
        echo json_encode(product_list(),JSON_UNESCAPED_UNICODE);
    }else if($_SERVER["REQUEST_METHOD"]=='POST'){
        create_bill($_POST);
        echo json_encode($_POST);
    }
    
    function product_list(){
        $db = new database();
        $db->connect();
        $sql = "SELECT product_id, Product_code, Product_Name,
                brand.Brand_name, unit.Unit_name,
                product.Cost, product.Stock_Quantity
                FROM product,brand,unit
                WHERE product.Brand_ID = brand.Brand_ID
                and product.Unit_ID = unit.Unit_id";
        $result = $db->query($sql);
        $db->close();
        return $result;
    }

    function create_bill($post){
        $db = new database();
        $db->connect();
        $result = $db->exec("SELECT Bill_id, Cus_id, Bill_Status FROM bill WHERE Cus_id=1 and Bill_Status=0");
        if($result->num_rows == 0){
            $result = $db->exec("SELECT Bill_id FROM bill order by Bill_id DESC limit 1");
            echo sizeof($result);

            if(sizeof($result)==0){
                $db->exec("INSERT INTO bill(Bill_id, Cus_id, Bill_Status) VALUES (1,123,0)");
                $result = $db->query("SELECT Bill_id FROM bill WHERE cus_id = 1 order by Bill_id DESC limit 1");
            }else{

            }
            $db->exec("INSERT INTO bill_detail(Bill_id, Product_ID, Quantity, Unit_Price)
                        VALUES {$result[0]},{$post['pid']},{$post['qty']},{$post['price']}");
        }
        $db->close();
        return $result;
    }
?>