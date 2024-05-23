<?php
include_once 'function.php';
class Events
{
	public static function Show($dbCon, $data = ""){
		try {
			$pre = $dbCon->prepare("SELECT a.id as idevents, a.iduser , a.title, a.description , a.img, a.date, b.id, b.full_name FROM tb_events a LEFT JOIN tb_users b ON a.iduser = b.id ORDER BY a.datesubmit DESC");
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
					$fileName = 'IMAGE-EVENTS-'.time().'.jpg';
					$pre = $dbCon->prepare("INSERT INTO tb_events VALUES (:id, :idusr, :title, :desc, :dates, :img, now())");
					$ex  = $pre->execute([
						'id' => time(),
						'idusr' => $_SESSION['UID'],
						'title' => $data['title'],
						'desc' => $data['desc'],
						'dates' => $data['date'],
						'img' => $fileName,
					]);
				} else {
					// echo "tidak ada gambar";
					// print_r($_FILES);
					$pre = $dbCon->prepare("INSERT INTO tb_events VALUES (:id, :idusr, :title, :desc, :dates, :img, now())");
					$ex  = $pre->execute([
						'id' => time(),
						'idusr' => $_SESSION['UID'],
						'title' => $data['title'],
						'desc' => $data['desc'],
						'dates' => $data['date'],
						'img' => '',
					]);
				}
				if($ex === true){
					successNotif();
					backUrl(-2);
					if($imgs === 0){
						resizeImageJpeg($_FILES['image']['tmp_name'], '../images/uploads/events/'.$fileName, 847, 564, $_FILES['image']['type'] );
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
			$pre = $dbCon->prepare("SELECT * FROM tb_events WHERE id = :iditem");
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
					$fileName = 'IMAGE-EVENTS-'.time().'.jpg';
					$pre = $dbCon->prepare("UPDATE tb_events SET title = :title, description = :desc, date = :dates, img = :img WHERE id=:id");
					$ex  = $pre->execute([
						'title' => $data['title'],
						'desc' => $data['desc'],
						'dates' => $data['date'],
						'img' => $fileName,
						'id' => $id
					]);
				} else {
					$pre = $dbCon->prepare("UPDATE tb_events SET title = :title, description = :desc, date = :dates WHERE id=:id");
					$ex  = $pre->execute([
						'title' => $data['title'],
						'desc' => $data['desc'],
						'dates' => $data['date'],
						'id' => $id
					]);
				}
				if($ex === true){
					successNotif();
					backUrl(-2);
					if($imgs === 0){
						if($data['imgNow'] !== ""){
							$fileDir = '../images/uploads/events/'.$data['imgNow'];
							$delImg = unlink($fileDir);
							if($delImg === true ){
								list($w, $h) = getimagesize($_FILES['image']['tmp_name']);
								resizeImageJpeg($_FILES['image']['tmp_name'], '../images/uploads/events/'.$fileName, $w, $h, $_FILES['image']['type'] );
							}
						} else {
							list($w, $h) = getimagesize($_FILES['image']['tmp_name']);
							resizeImageJpeg($_FILES['image']['tmp_name'], '../images/uploads/events/'.$fileName, $w, $h, $_FILES['image']['type'] );
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
			$pre = $dbCon->prepare("DELETE FROM tb_events WHERE id=:id");
			$ex  = $pre->execute([ 'id' => $id ]);
			//print_r($ex);
			if($ex === true){
				if($img !== ""){
					$fileDir = '../images/uploads/events/'.$img;
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
