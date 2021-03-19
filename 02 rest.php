<?php 
    include_once "01 dbcontrol.php";
    include_once "util.php";
    $debug = false;
    if(isset($_POST["row"])){
        
    }
    if($_SERVER['REQUEST_METHOD']=='GET'){
        echo json_encode(get_data($debug));
    } else if($_SERVER['REQUEST_METHOD']=='POST'){
        echo "POST may be next time<br>", $debug;
        //echo json_encode("{'Message':"+print_r($_POST)+"}");
        if(isset($_POST["new_id"]) && isset($_POST["new_name"])){
            $new_id = $_POST["new_id"];
            $new_name = $_POST["new_name"];
            insert_newdata($new_id,$new_name,$debug);
            echo json_encode(get_data($debug));
        }
    } else {
        http_response_code(405); // ERROR unsupport by current version
    }
    function get_data($debug){
        $my_db = new db("root","","book",$debug);
        $data = $my_db->sel_query("SELECT * FROM user");
        $my_db->close();
        return $data;
    }

    function insert_newdata($new_id,$new_name,$debug){
        $my_db = new db("root","","book",$debug);
        $sql = "INSERT INTO user (id,name) VALUES ({$new_id}, {$new_name})";
        $data = $my_db->query_only($sql);
        $my_db->close();
    }
?>
