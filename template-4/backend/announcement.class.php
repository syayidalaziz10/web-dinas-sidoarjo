<?php
include_once 'function.php';
class Announcement
{
	public static function Show($dbCon){
		try {
			$pre = $dbCon->prepare("SELECT a.id as idnews, a.iduser , a.title, a.description , a.date, a.datex, a.status, b.id, b.full_name FROM tb_pengumuman a LEFT JOIN tb_users b ON a.iduser = b.id ORDER BY date DESC");
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
        $pre = $dbCon->prepare("INSERT INTO tb_pengumuman VALUES (:id, :idusr, :title, :desc, :tgl, :datex, :status)");
        $ex  = $pre->execute([
          'id' => time(),
          'idusr' => $_SESSION['UID'],
          'title' => $data['title'],
					'desc' => $data['desc'],
          'tgl' => $data['date'],
					'datex' => $data['datex'],
          'status' => $data['status']
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
			$pre = $dbCon->prepare("SELECT * FROM tb_pengumuman WHERE id = :iditem");
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
        $pre = $dbCon->prepare("UPDATE tb_pengumuman SET title = :title, description = :desc, date = :date1, datex = :datex, status =:status WHERE id=:id");
        $ex  = $pre->execute([
					'title' => $data['title'],
					'desc' => $data['desc'],
					'date1' => $data['date'],
          'datex' => $data['datex'],
					'status' => $data['status'],
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
			$pre = $dbCon->prepare("DELETE FROM tb_pengumuman WHERE id=:id");
			$ex  = $pre->execute([ 'id' => $id ]);
			//print_r($ex);
			if($ex === true){
				//deleteNotif();
        backUrl(-1);
			} else {
				warnNotif();
			}
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}
}
