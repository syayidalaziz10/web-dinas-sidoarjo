<?php
include_once 'function.php';
class Profil
{
  public static function Show($dbCon, $data = ""){
    try {
      $pre = $dbCon->prepare("SELECT * FROM tb_profil_pimpinan ORDER BY periode DESC");
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
          $fileName = 'IMAGE-LEADER-'.time().'.jpg';
          $pre = $dbCon->prepare("INSERT INTO tb_profil_pimpinan VALUES (:id, :nama, :jabatan, :tahun, :desc , :img, :status)");
          $ex  = $pre->execute([
            'id' => time(),
            'nama' => $data['fname'],
            'jabatan' => $data['jabatan'],
            'tahun' => $data['tahun'],
            'desc' => $data['desc'],
            'img' => $fileName,
            'status' => $data['status']
          ]);
        } else {
          // echo "tidak ada gambar";
          // print_r($_FILES);
          $pre = $dbCon->prepare("INSERT INTO tb_profil_pimpinan VALUES (:id, :nama, :jabatan, :tahun, :desc , :img, :status)");
          $ex  = $pre->execute([
            'id' => time(),
            'nama' => $data['fname'],
            'jabatan' => $data['jabatan'],
            'tahun' => $data['tahun'],
            'desc' => $data['desc'],
            'img' => '',
            'status' => $data['status']
          ]);
        }
        if($ex === true){
          successNotif();
          backUrl(-2);
          if($imgs === 0){
            resizeImageJpeg($_FILES['image']['tmp_name'], '../images/uploads/leaders/'.$fileName, 330, 445, $_FILES['image']['type'] );
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
      $pre = $dbCon->prepare("SELECT * FROM tb_profil_pimpinan WHERE id = :iditem");
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
          $fileName = 'IMAGE-LEADER-'.time().'.jpg';
          $pre = $dbCon->prepare("UPDATE tb_profil_pimpinan SET name = :fname, jabatan = :jabatan, description = :desc, periode =:tahun, img = :img, status = :status WHERE id=:id");
          $ex  = $pre->execute([
            'fname' => $data['fname'],
            'jabatan' => $data['jabatan'],
            'desc' => $data['desc'],
            'tahun' => $data['tahun'],
            'status' => $data['status'],
            'img' => $fileName,
            'id' => $id
          ]);
        } else {
          $pre = $dbCon->prepare("UPDATE tb_profil_pimpinan SET name = :fname, jabatan = :jabatan, description = :desc, periode =:tahun, status = :status WHERE id=:id");
          $ex  = $pre->execute([
            'fname' => $data['fname'],
            'jabatan' => $data['jabatan'],
            'desc' => $data['desc'],
            'tahun' => $data['tahun'],
            'status' => $data['status'],
            'id' => $id
          ]);
        }
        if($ex === true){
          if($imgs === 0){
            if($data['imgNow'] !== ""){
              $fileDir = '../images/uploads/leaders/'.$data['imgNow'];
              $delImg = unlink($fileDir);
              if($delImg === true ){
                resizeImageJpeg($_FILES['image']['tmp_name'], '../images/uploads/leaders/'.$fileName, 330, 445, $_FILES['image']['type'] );
                backUrl(-2);
              }
            } else {
              resizeImageJpeg($_FILES['image']['tmp_name'], '../images/uploads/leaders/'.$fileName, 330, 445, $_FILES['image']['type'] );
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
      $pre = $dbCon->prepare("DELETE FROM tb_profil_pimpinan WHERE id=:id");
      $ex  = $pre->execute([ 'id' => $id ]);
      //print_r($ex);
      if($ex === true){
        //deleteNotif();
        if($img !== ""){
          $fileDir = '../images/uploads/leaders/'.$img;
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
