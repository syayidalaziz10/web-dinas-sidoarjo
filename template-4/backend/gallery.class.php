<?php
include_once 'function.php';
class Gallery
{
  public static function Show($dbCon, $data = ""){
    try {
      $pre = $dbCon->prepare("SELECT * FROM tb_gallery ORDER BY id DESC");
      $pre->execute();
      $res = $pre->fetchAll(PDO::FETCH_OBJ);
      return $res;
    } catch (Exception $e) {
      echo "Error ".$e;
    }
  }
  public static function Add($data ,$dbCon){
    //print_r($data);
    try {
      if(isset($data['token']) && $data['token'] === $_SESSION['token']){
        $imgs = $_FILES['image']['error'];
        if($imgs === 0 ){
          // echo "ada gambar";
          // print_r($_FILES);
          $fileName = 'GALLERY-'.time().'.jpg';
          $pre = $dbCon->prepare("INSERT INTO tb_gallery VALUES (:id, :gambar, :keterangan, :kategori)");
          $ex  = $pre->execute([
            'id' => time(),
            'gambar' => $fileName,
            'keterangan' => $data['keterangan'],
            'kategori' => $data['kategori']
            
          ]);
        } else {
          // echo "tidak ada gambar";
          // print_r($_FILES);
          $pre = $dbCon->prepare("INSERT INTO tb_gallery VALUES (:id, :gambar, :keterangan, :kategori)");
          $ex  = $pre->execute([
            'id' => time(),
            'gambar' => $fileName,
            'keterangan' => $data['keterangan'],
            'kategori' => $data['kategori']
          ]);
        }
        if($ex === true){
          successNotif();
          backUrl(-2);
          if($imgs === 0){
            resizeImageJpeg($_FILES['image']['tmp_name'], '../images/uploads/gallery/'.$fileName, 330, 445, $_FILES['image']['type'] );
          }
          $_SESSION["token"] = base64_encode(openssl_random_pseudo_bytes(32));
        } else {
          failedNotif();
        }
      } else {
        warnNotif();
      }
    } catch (Exception $e) {
      echo "Error ".$e;
    }
  }
  public static function GetID($data, $dbCon){
    try {
      $pre = $dbCon->prepare("SELECT * FROM tb_gallery WHERE id = :iditem");
      $pre->execute([ 'iditem' => $data ]);
      $res = $pre->fetch(PDO::FETCH_OBJ);
      return $res;
    } catch (Exception $e) {
      echo "Error ".$e;
    }
  }
  public static function Update($data, $dbCon , $id){
    try {
      if(isset($data['token']) && $data['token'] === $_SESSION['token']){
        $imgs = $_FILES['image']['error'];
        if($imgs === 0){
          $fileName = 'GALLERY-'.time().'.jpg';
          $pre = $dbCon->prepare("UPDATE tb_gallery SET gambar = :gambar, keterangan = :keterangan, kategori = :kategori WHERE id=:id");
          $ex  = $pre->execute([
            'gambar' => $fileName,
            'keterangan' => $data['keterangan'],
            'kategori' => $data['kategori'],
            'id' => $id
          ]);
        } else {
          $pre = $dbCon->prepare("UPDATE tb_gallery SET keterangan = :keterangan, kategori = :kategori WHERE id=:id");
          $ex  = $pre->execute([
            'keterangan' => $data['keterangan'],
            'kategori' => $data['kategori'],
            'id' => $id
          ]);
        }
        if($ex === true){
          if($imgs === 0){
            if($data['imgNow'] !== ""){
              $fileDir = '../images/uploads/gallery/'.$data['imgNow'];
              $delImg = unlink($fileDir);
              if($delImg === true ){
                resizeImageJpeg($_FILES['image']['tmp_name'], '../images/uploads/gallery/'.$fileName, 330, 445, $_FILES['image']['type'] );
                backUrl(-2);
              }
            } else {
              resizeImageJpeg($_FILES['image']['tmp_name'], '../images/uploads/gallery/'.$fileName, 330, 445, $_FILES['image']['type'] );
              backUrl(-2);
            }
          }
          $_SESSION["token"] = base64_encode(openssl_random_pseudo_bytes(32));
        } else {
          failedNotif();
        }
      } else {
        warnNotif();
      }
    } catch (Exception $e) {
      echo "Error ".$e;
    }
  }
  public static function Delete($id, $dbCon, $img ){
    //print_r($data);
    try {
      $pre = $dbCon->prepare("DELETE FROM tb_gallery WHERE id=:id");
      $ex  = $pre->execute([ 'id' => $id ]);
      //print_r($ex);
      if($ex === true){
        //deleteNotif();
        if($img !== ""){
          $fileDir = '../images/uploads/gallery/'.$img;
          $delImg = unlink($fileDir);
          if($delImg === true ){
            backUrl(-1);
          }
        } else {
          backUrl(-1);
        }
      } else {
        warnNotif();
      }
    } catch (Exception $e) {
      echo "Error ".$e;
    }
  }
}
