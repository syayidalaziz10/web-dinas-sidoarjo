<?php
include_once 'function.php';
class Dinas
{
	public static function Show($dbCon, $data = ""){
		try {
			$pre = $dbCon->prepare("SELECT * FROM tb_dinas ORDER BY name ASC");
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
				if($imgs === 0){
					$fileName = 'IMAGE-INST-'.time().'.png';
					$pre = $dbCon->prepare("INSERT INTO tb_dinas VALUES (:id, :name, :desc, :img )");
	        $ex  = $pre->execute([
	          'id' => time(),
	          'name' => $data['dinas'],
	          'desc' => $data['desc'],
						'img' => $fileName
	        ]);
				} else {
					$pre = $dbCon->prepare("INSERT INTO tb_dinas VALUES (:id, :name, :desc, :img )");
					$ex  = $pre->execute([
						'id' => time(),
						'name' => $data['dinas'],
						'desc' => $data['desc'],
						'img' => ''
					]);
				}
				if($ex === true){
          successNotif();
					backUrl(-2);
					if($imgs === 0){
						resizeImagePng($_FILES['image']['tmp_name'], '../images/uploads/inst/'.$fileName, 163, 149);
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
			$pre = $dbCon->prepare("SELECT * FROM tb_dinas WHERE id = :iditem");
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
					$fileName = 'IMAGE-INST-'.time().'.png';
					$pre = $dbCon->prepare("UPDATE tb_dinas SET name = :title, description = :desc, img = :img WHERE id=:id");
					$ex  = $pre->execute([
						'title' => $data['dinas'],
						'desc' => $data['desc'],
						'img' => $fileName,
						'id' => $id
					]);
				} else {
					$pre = $dbCon->prepare("UPDATE tb_dinas SET name = :title, description = :desc WHERE id=:id");
					$ex  = $pre->execute([
						'title' => $data['dinas'],
						'desc' => $data['desc'],
						'id' => $id
					]);
				}

				if($ex === true){
					successNotif();
					backUrl(-2);
					if($imgs === 0){
						if($data['imgNow'] !== ""){
							$fileDir = '../images/uploads/inst/'.$data['imgNow'];
							$delImg = unlink($fileDir);
							if($delImg === true ){
								resizeImagePng($_FILES['image']['tmp_name'], '../images/uploads/inst/'.$fileName, 163, 149 );
							}
						} else {
							resizeImagePng($_FILES['image']['tmp_name'], '../images/uploads/inst/'.$fileName, 163, 149 );
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
			$pre = $dbCon->prepare("DELETE FROM tb_dinas WHERE id=:id");
			$ex  = $pre->execute([ 'id' => $id ]);
			//print_r($ex);
			if($ex === true){
				if($img !== ""){
					$fileDir = '../images/uploads/inst/'.$img;
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
