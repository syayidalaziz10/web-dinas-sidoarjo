<?php
include_once 'function.php';
class Login
{
  public static function Check($data, $dbCon){
    try {
      if(isset($data['token']) && $data['token'] === $_SESSION['token']){
        $fileName = substr(md5(time()),4,14).'.jpg';
        $pre = $dbCon->prepare("SELECT * FROM tb_users WHERE email = :email AND status = 1");
        $pre->bindParam(':email', $data['email']);
        $ex  = $pre->execute();
        $res = $pre->fetch();
        if(!empty($res)){
          $passverif = password_verify($data['password'], $res['password']);
          if($passverif === true){
            redirect(".");
            $_SESSION['UID'] = $res['id'];
            $_SESSION['FNAME'] = $res['full_name'];
            $_SESSION['EMAIL'] = $res['email'];
            $_SESSION['LEVEL'] = $res['level'];
            $_SESSION['SNAME'] = $_SERVER['SERVER_NAME'];
            unset($_SESSION['token']);
          } else {
            echo "Login gagal";
          }
        } else {
          echo "User not found / User not active";
        }
      } else {
        echo "Forbidden";
      }
    } catch (Exception $e) {
      echo "Error ".$e;
    }
  }
  public static function Logout(){
    session_destroy();
    unset($_SESSION['token']);
    unset($_SESSION['UID']);
    unset($_SESSION['FNAME']);
    unset($_SESSION['EMAIL']);
    unset($_SESSION['LEVEL']);
    unset($_SESSION['SNAME']);
    redirect("login.php");
  }
}
