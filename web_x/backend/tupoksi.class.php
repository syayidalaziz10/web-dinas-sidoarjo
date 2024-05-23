<?php
include_once 'function.php';
class Tupoksi
{
	public static function Show($dbCon, $data = ""){
		try {
			$pre = $dbCon->prepare("SELECT a.id as idnews, a.iduser , a.title, a.description , a.img, a.date, b.id, b.full_name FROM tb_news a LEFT JOIN tb_users b ON a.iduser = b.id WHERE category IN (2) ORDER BY date DESC");
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
        $pre = $dbCon->prepare("INSERT INTO tb_news VALUES (:id, :idusr, :category, :title, :desc, now(), :img)");
        $ex  = $pre->execute([
          'id' => time(),
          'idusr' => $_SESSION['UID'],
          'category' => 2,
          'title' => $data['title'],
          'desc' => $data['desc'],
          'img' => ''
        ]);
				if($ex === true){
					successNotif();
					backUrl(-2);
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
			$pre = $dbCon->prepare("SELECT * FROM tb_news WHERE id = :iditem");
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
        $pre = $dbCon->prepare("UPDATE tb_news SET title = :title, description = :desc WHERE id=:id");
        $ex  = $pre->execute([
          'title' => $data['title'],
          'desc' => $data['desc'],
          'id' => $id
        ]);
				if($ex === true){
					successNotif();
					backUrl(-2);
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
	public static function Delete($id, $dbCon ){
		//print_r($data);
		try {
			$pre = $dbCon->prepare("DELETE FROM tb_news WHERE id=:id");
			$ex  = $pre->execute([ 'id' => $id ]);
			//print_r($ex);
			if($ex === true){
				//deleteNotif();
        backUrl(-2);
			} else {
				warnNotif();
			}
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}
}
