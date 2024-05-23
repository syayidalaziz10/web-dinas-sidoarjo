<?php
include_once 'dbConfig.php';
$dbCon = DB::Connect();
try {
  if(isset($_POST['token']) && !empty($_POST['token'])){
    $sel = $dbCon->prepare("SELECT * FROM tb_counter WHERE idnews = :id");
    $sel->execute(['id' => $_POST['idnews'] ]);
    $res = $sel->fetch(PDO::FETCH_OBJ);
    if(empty($res)){
      $pre = $dbCon->prepare("INSERT INTO tb_counter VALUES (:id, :idnews, 1)");
      $ex  = $pre->execute([
        'id' => time(),
        'idnews' => $_POST['idnews']
      ]);

      if($ex === true){
        echo "Success insert";
      } else {
        echo "Failed insert";
      }
    } else {
      $pre = $dbCon->prepare("UPDATE tb_counter SET total = total + 1  WHERE idnews = :id");
      $ex  = $pre->execute(['id' => $_POST['idnews'] ]);
      if($ex === true){
        echo "Success update";
      } else {
        echo "Failed update";
      }
    }
  } else {
    echo "Forbidden action";
  }
} catch (Exception $e) {
  echo "Error ".$e;
}
