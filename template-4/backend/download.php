<?php
include_once 'dbConfig.php';
$dbCon = DB::Connect();
try {
  if(isset($_POST['token']) && !empty($_POST['token'])){
    $pre = $dbCon->prepare("UPDATE tb_downloads SET totdown = totdown + 1  WHERE id=:id");
    $ex  = $pre->execute(['id' => $_POST['id'] ]);
    if($ex === true){
      echo "Success";
    } else {
      echo "Failed";
    }
  } else {
    echo "Forbidden action";
  }
} catch (Exception $e) {
  echo "Error ".$e;
}
