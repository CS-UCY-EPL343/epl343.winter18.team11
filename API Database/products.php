<?php

require_once 'database_behaviour.php';
$db = new database_behaviour();

$response = array("error" => FALSE);

if(isset($_POST['products'])){
      $product =  $db->getProducts();
      echo json_encode($product);

}else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Something went wrong";
    echo json_encode($response);
}

?>
