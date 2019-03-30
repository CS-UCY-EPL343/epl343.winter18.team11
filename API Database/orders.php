<?php
require_once 'database_behaviour.php';
$db = new database_behaviour();

  $response = array("error" => FALSE);
  $email = array_pop($_POST);
  $user = $db->findUser($email);
  $keys =   array_keys($_POST);
  $values = $_POST;
  $i = 0 ;

  foreach( $values as $val ) {
      $db->saveOrder($user["UserID"],$keys[$i],$val);
      $i=$i+1;
  }
  $response["error"] = FALSE;
  echo json_encode($response);

?>
