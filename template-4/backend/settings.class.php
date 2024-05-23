<?php
include_once 'function.php';
include_once 'login.class.php';
class Settings
{
	// PROCESS FOR WEB SETTINGS
	public static function Show($dbCon, $data = ""){
		try {
			$pre = $dbCon->prepare("SELECT * FROM tb_options");
			$pre->execute();
			$res = $pre->fetchAll(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}
	public static function Add($data, $dbCon ){
		try {
			if(isset($data['token']) && $data['token'] === $_SESSION['token']){
				$pre = $dbCon->prepare("INSERT INTO tb_options VALUES (:id, :title, :nomor)");
				$ex  = $pre->execute([
					'id' => $pre->insert_id,
					'title' => $data['nametlp'],
					'nomor' => $data['nomortlp'],
				]);
				if($ex === true){
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
			$pre = $dbCon->prepare("SELECT * FROM tb_options WHERE id = :iditem");
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
				$pre = $dbCon->prepare("UPDATE tb_options SET value = :value WHERE id=:id");
				$ex  = $pre->execute([
					'value' => $data['desc'],
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
	public static function Delete($id, $dbCon){
		//print_r($data);
		try {
			$pre = $dbCon->prepare("DELETE FROM tb_options WHERE id=:id");
			$ex  = $pre->execute([ 'id' => $id ]);
			//print_r($ex);
			if($ex === true){
					backUrl(-1);
			} else {
				warnNotif();
			}
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}

	// END PROCESS FOR WEB SETTINGS

	// PROCESS FOR USER SETTINGS

	public static function UserShow($dbCon, $data = ""){
		try {
			$pre = $dbCon->prepare("SELECT id, full_name, email, level, status FROM tb_users ORDER BY full_name ASC");
			$pre->execute();
			$res = $pre->fetchAll(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}
	public static function UserAdd($data ,$dbCon){
		//print_r($data);
		try {
			if(isset($data['token']) && $data['token'] === $_SESSION['token']){
				$prepare = $dbCon->prepare("SELECT * FROM tb_users WHERE email=:email");
				$prepare->execute([ 'email' => $data['email'] ]);
				$result =  $prepare->fetch(PDO::FETCH_OBJ);

				if(!empty($result)){
					EmailfailedNotif();
				} else {
					$pre = $dbCon->prepare("INSERT INTO tb_users VALUES (:id, :nama, :email, :pass, :level, :status)");
					$ex  = $pre->execute([
						'id' => time(),
						'nama' => $data['fname'],
						'email' => $data['email'],
						'pass' => password_hash($data['password'], PASSWORD_DEFAULT),
						'level' => $data['level'],
						'status' => $data['status']
					]);
					if($ex === true){
						successNotif();
						backUrl(-2);
						$_SESSION["token"] = base64_encode(openssl_random_pseudo_bytes(32));
					} else {
						failedNotif();
					}
				}
			} else {
				warnNotif();
			}
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}
	public static function UserGetID($data, $dbCon){
		try {
			$pre = $dbCon->prepare("SELECT * FROM tb_users WHERE id = :iditem");
			$pre->execute([ 'iditem' => $data ]);
			$res = $pre->fetch(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}
	public static function UserUpdate($data, $dbCon , $id){
		try {
			if(isset($data['token']) && $data['token'] === $_SESSION['token']){
					$pre = $dbCon->prepare("UPDATE tb_users SET full_name = :fname, level = :level, status = :status  WHERE id=:id");
					$ex  = $pre->execute([
						'fname' => $data['fname'],
						'level' => $data['level'],
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
	public static function UserPassUpdate($data, $dbCon , $id){
		try {
			if(isset($data['token']) && $data['token'] === $_SESSION['token']){
					$pre = $dbCon->prepare("UPDATE tb_users SET password = :pass  WHERE id=:id");
					$ex  = $pre->execute([
						'pass' => password_hash($data['password'], PASSWORD_DEFAULT),
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
	public static function UserDelete($id, $dbCon ){
		//print_r($data);
		try {
			$pre = $dbCon->prepare("DELETE FROM tb_users WHERE id=:id");
			$ex  = $pre->execute([ 'id' => $id ]);
			//print_r($ex);
			if($ex === true){
				//deleteNotif();
				redirect(".?_pg=".$_GET['_pg']."&_act=".$_GET['_act']);
			} else {
				warnNotif();
			}
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}

	// END PROCESS FOR USER SETTINGS

	// PROCESS FOR BANNER SETTINGS

	public static function BannerShow($dbCon){
		try {
			$pre = $dbCon->prepare("SELECT * FROM tb_banners WHERE category NOT IN (3,8) ORDER BY category ASC");
			$pre->execute();
			$res = $pre->fetchAll(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}
	public static function BannerGetID($data, $dbCon){
		try {
			$pre = $dbCon->prepare("SELECT * FROM tb_banners WHERE id = :iditem");
			$pre->execute([ 'iditem' => $data ]);
			$res = $pre->fetch(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}
	public static function BannerAdd($data, $dbCon){
		try {
			if(isset($data['token']) && $data['token'] === $_SESSION['token']){
				$img = $_FILES['image']['error'];
				$fileName = 'IMAGE-BANNER-'.time().'.png';

				if($img === 0){
					$pre = $dbCon->prepare("INSERT INTO tb_banners VALUES (:id, 2, :title, :desc, :img, '1920x700' , :status)");
					$ex  = $pre->execute([
						'id' => time(),
						'title' => $data['title'],
						'desc' => $data['desc'],
						'img' => $fileName,
						'status' => $data['status'],
					]);
				}
				if($ex === true){
					if($img === 0){
						resizeImageJpeg($_FILES['image']['tmp_name'], '../images/uploads/banners/'.$fileName, 1920, 700, $_FILES['image']['type'] );
						backUrl(-2);
						successNotif();
						$_SESSION["token"] = base64_encode(openssl_random_pseudo_bytes(32));
					}
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
	public static function BannerUpdate($data, $dbCon , $id){
		try {
			if(isset($data['token']) && $data['token'] === $_SESSION['token']){
				$img = $_FILES['image']['error'];
				$fileName = 'IMAGE-BANNER-'.time().'.png';
                                
				if($img === 0){
					$pre = $dbCon->prepare("UPDATE tb_banners SET title = :title, description = :desc,  img = :img, status = :status WHERE id=:id");
					$ex  = $pre->execute([
						'title' => $data['title'],
						'desc' => $data['desc'],
						'img' => $fileName,
						'status' => $data['status'],
						'id' => $id
					]);
				} else {
					$pre = $dbCon->prepare("UPDATE tb_banners SET title = :title, description = :desc,  status = :status WHERE id=:id");
					$ex  = $pre->execute([
						'title' => $data['title'],
						'desc' => $data['desc'],
						'status' => $data['status'],
						'id' => $id
					]);
				}

                
				if($ex === true){
					if($img === 0){
                        $fileDir = '../images/uploads/banners/'.$data['imgNow'];

                        if (file_exists($fileDir)) {
                            unlink($fileDir);
                        }
                        
                        if($data['category'] === '1'){
                            resizeImagePng($_FILES['image']['tmp_name'], '../images/uploads/banners/'.$fileName, 400, 77 );
                        } else if($data['category'] === '2'){
                            resizeImageJpeg($_FILES['image']['tmp_name'], '../images/uploads/banners/'.$fileName, 1920, 700, $_FILES['image']['type'] );
                        } else if($data['category'] === '4'){
                            resizeImageJpeg($_FILES['image']['tmp_name'], '../images/uploads/banners/'.$fileName, 1920, 358, $_FILES['image']['type'] );
                        } else if($data['category'] === '6'){
                            resizeImageJpeg($_FILES['image']['tmp_name'], '../images/uploads/banners/'.$fileName, 800, 800, $_FILES['image']['type'] );
                        } else if($data['category'] === '7'){
                            resizeImagePng($_FILES['image']['tmp_name'], '../images/uploads/banners/'.$fileName, 1200, 495 );
                        } else {
                            resizeImagePng($_FILES['image']['tmp_name'], '../images/uploads/banners/'.$fileName, 555, 370 );
                        }
                        backUrl(-2);
                            
                        
                        
                        
                        
                        /*
						if($data['imgNow'] != ""){
							$fileDir = '../images/uploads/banners/'.$data['imgNow'];

							$delImg = unlink($fileDir);

							if($delImg === true ){
								//move_uploaded_file($_FILES['image']['tmp_name'], '../images/uploads/banners/'.$fileName );
								if($data['category'] === '1'){
									resizeImagePng($_FILES['image']['tmp_name'], '../images/uploads/banners/'.$fileName, 400, 77 );
								} else if($data['category'] === '2'){
									resizeImageJpeg($_FILES['image']['tmp_name'], '../images/uploads/banners/'.$fileName, 1920, 700, $_FILES['image']['type'] );
								} else if($data['category'] === '4'){
									resizeImageJpeg($_FILES['image']['tmp_name'], '../images/uploads/banners/'.$fileName, 1920, 358, $_FILES['image']['type'] );
								} else if($data['category'] === '6'){
									resizeImageJpeg($_FILES['image']['tmp_name'], '../images/uploads/banners/'.$fileName, 800, 800, $_FILES['image']['type'] );
								} else if($data['category'] === '7'){
									resizeImagePng($_FILES['image']['tmp_name'], '../images/uploads/banners/'.$fileName, 1200, 495 );
								} else {
									resizeImagePng($_FILES['image']['tmp_name'], '../images/uploads/banners/'.$fileName, 555, 370 );
								}
								backUrl(-2);
							}

						} else {
							if($data['category'] === '1'){
								resizeImagePng($_FILES['image']['tmp_name'], '../images/uploads/banners/'.$fileName, 400, 77 );
							} else if($data['category'] === '2'){
								resizeImageJpeg($_FILES['image']['tmp_name'], '../images/uploads/banners/'.$fileName, 1920, 700, $_FILES['image']['type'] );
							} else if($data['category'] === '4'){
								resizeImageJpeg($_FILES['image']['tmp_name'], '../images/uploads/banners/'.$fileName, 1920, 358, $_FILES['image']['type'] );
							} else if($data['category'] === '6'){
								resizeImageJpeg($_FILES['image']['tmp_name'], '../images/uploads/banners/'.$fileName, 800, 800, $_FILES['image']['type'] );
							} else if($data['category'] === '7'){
								resizeImagePng($_FILES['image']['tmp_name'], '../images/uploads/banners/'.$fileName, 1200, 495 );
							} else {
								resizeImagePng($_FILES['image']['tmp_name'], '../images/uploads/banners/'.$fileName, 555, 370 );
							}
							backUrl(-2);
						}
                        */
					}
					backUrl(-2);
					successNotif();
					$_SESSION["token"] = base64_encode(openssl_random_pseudo_bytes(32));
				} 
                else {
					failedNotif();
				}
			} else {
				warnNotif();
			}
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}
	public static function BannerDelete($id, $dbCon, $img ){
		//print_r($data);
		try {
			$pre = $dbCon->prepare("DELETE FROM tb_banners WHERE id=:id");
			$ex  = $pre->execute([ 'id' => $id ]);
			//print_r($ex);
			if($ex === true){
				//deleteNotif();
				if($img !== ""){
					$fileDir = '../images/uploads/banners/'.$img;
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

	// END PROCESS FOR BANNER SETTINGS

	// PROCESS FOR VIDEO SETTINGS


	public static function VideoShow($dbCon, $data = ""){
		try {
			$pre = $dbCon->prepare("SELECT * FROM tb_video ORDER BY id DESC");
			$pre->execute();
			$res = $pre->fetchAll(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}
	public static function VideoGetID($data, $dbCon){
		try {
			$pre = $dbCon->prepare("SELECT * FROM tb_video WHERE id = :iditem");
			$pre->execute([ 'iditem' => $data ]);
			$res = $pre->fetch(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}
	public static function VideoAdd($data, $dbCon ){
		try {
			if(isset($data['token']) && $data['token'] === $_SESSION['token']){
				$pre = $dbCon->prepare("INSERT INTO tb_video VALUES (:id, :title, :idvideo, :status)");
				$ex  = $pre->execute([
					'id' => time(),
					'title' => $data['title'],
					'idvideo' => $data['idvideo'],
					'status' => $data['status'],
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
	public static function VideoUpdate($data, $dbCon , $id){
		try {
			if(isset($data['token']) && $data['token'] === $_SESSION['token']){
				$pre = $dbCon->prepare("UPDATE tb_video SET title = :title, url = :idvideo, status = :status  WHERE id=:id");
				$ex  = $pre->execute([
					'title' => $data['title'],
					'idvideo' => $data['idvideo'],
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
	public static function VideoDelete($id, $dbCon){
		//print_r($data);
		try {
			$pre = $dbCon->prepare("DELETE FROM tb_video WHERE id=:id");
			$ex  = $pre->execute([ 'id' => $id ]);
			//print_r($ex);
			if($ex === true){
					backUrl(-1);
			} else {
				warnNotif();
			}
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}

	// END PROCESS FOR VIDEO SETTINGS

	// PROCESS FOR SERVICES SETTINGS

	public static function ServicesShow($dbCon, $data = ""){
		try {
			$pre = $dbCon->prepare("SELECT * FROM tb_services ORDER BY status DESC");
			$pre->execute();
			$res = $pre->fetchAll(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}
	public static function ServicesGetID($data, $dbCon){
		try {
			$pre = $dbCon->prepare("SELECT * FROM tb_services WHERE id = :iditem");
			$pre->execute([ 'iditem' => $data ]);
			$res = $pre->fetch(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}
	public static function ServicesAdd($data, $dbCon){
		$colorArr = array('#f44336','#3f51b5','#009688','#795548','#4caf50','#9e9e9e','#374046','#03a9f4');
		$random = array_rand($colorArr, 3);
		try {
			if(isset($data['token']) && $data['token'] === $_SESSION['token']){
				$pre = $dbCon->prepare("INSERT INTO tb_services(id,name,description,status,kategori_layanan,icon,colors)  VALUES(:id, :name, :descr, :status, :kategori_layanan, :icon, :color)");
				$ex  = $pre->execute([
					'id' => time(),
					'name' => $data['fname'],
					'descr' => $data['desc'],
					'status' => $data['status'],
					'kategori_layanan' => $data['kategori_layanan'],
					'icon' => $data['icon'],
					'color' => $colorArr[$random[2]],
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
	public static function ServicesUpdate($data, $dbCon , $id){
		try {
			if(isset($data['token']) && $data['token'] === $_SESSION['token']){
				$pre = $dbCon->prepare("UPDATE tb_services SET name = :fname, description = :desc, status = :status WHERE id=:id");
				$ex  = $pre->execute([
					'fname' => $data['fname'],
					'desc' => $data['desc'],
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

	public static function ServicesDelete($id, $dbCon){
		//print_r($data);
		try {
			$pre = $dbCon->prepare("DELETE FROM tb_services WHERE id=:id");
			$ex  = $pre->execute([ 'id' => $id ]);
			//print_r($ex);
			if($ex === true){
					backUrl(-1);
			} else {
				warnNotif();
			}
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}

	// END PROCESS FOR SERVICES SETTINGS

	// PROCESS FOR EMPLOYEES Settings

	public static function EmployeesShow($dbCon, $data = ""){
		try {
			$pre = $dbCon->prepare("SELECT * FROM tb_pegawai ORDER BY name ASC");
			$pre->execute();
			$res = $pre->fetchAll(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}
	public static function EmployeesAdd($data ,$dbCon){
		//print_r($data);
		try {
			if(isset($data['token']) && $data['token'] === $_SESSION['token']){
				$imgs = $_FILES['image']['error'];
				if($imgs === 0 ){
					// echo "ada gambar";
					// print_r($_FILES);
					$fileName = 'IMAGE-EMPLOYEES-'.time().'.jpg';
					$pre = $dbCon->prepare("INSERT INTO tb_pegawai VALUES (:id, :nama, :jabatan, :bagian, :tahun, :img, :status)");
					$ex  = $pre->execute([
						'id' => time(),
						'nama' => $data['fname'],
						'jabatan' => $data['jabatan'],
						'bagian' => $data['bagian'],
						'tahun' => $data['tahun'],
						'img' => $fileName,
						'status' => $data['status']
					]);
				} else {
					// echo "tidak ada gambar";
					// print_r($_FILES);
					$pre = $dbCon->prepare("INSERT INTO tb_pegawai VALUES (:id, :nama, :bagian, :jabatan, :tahun, :img, :status)");
					$ex  = $pre->execute([
						'id' => time(),
						'nama' => $data['fname'],
						'bagian' => $data['bagian'],
						'jabatan' => $data['jabatan'],
						'tahun' => $data['tahun'],
						'img' => '',
						'status' => $data['status']
					]);
				}
				if($ex === true){
					successNotif();
					backUrl(-2);
					if($imgs === 0){
						move_uploaded_file($_FILES['image']['tmp_name'], '../images/uploads/employees/'.$fileName );
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
	public static function EmployeesGetID($data, $dbCon){
		try {
			$pre = $dbCon->prepare("SELECT * FROM tb_pegawai WHERE id = :iditem");
			$pre->execute([ 'iditem' => $data ]);
			$res = $pre->fetch(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}
	public static function EmployeesUpdate($data, $dbCon , $id){
		try {
			if(isset($data['token']) && $data['token'] === $_SESSION['token']){
				$imgs = $_FILES['image']['error'];
				if($imgs === 0){
					$fileName = 'IMAGE-EMPLOYEES-'.time().'.jpg';
					$pre = $dbCon->prepare("UPDATE tb_pegawai SET name = :fname, jabatan = :jabatan, bagian = :bagian, tahun =:tahun, img = :img, status = :status WHERE id=:id");
					$ex  = $pre->execute([
						'fname' => $data['fname'],
						'jabatan' => $data['jabatan'],
						'bagian' => $data['bagian'],
						'tahun' => $data['tahun'],
						'status' => $data['status'],
						'img' => $fileName,
						'id' => $id
					]);
				} else {
					$pre = $dbCon->prepare("UPDATE tb_pegawai SET name = :fname, jabatan = :jabatan, bagian = :bagian, tahun =:tahun, status = :status WHERE id=:id");
					$ex  = $pre->execute([
						'fname' => $data['fname'],
						'jabatan' => $data['jabatan'],
						'bagian' => $data['bagian'],
						'tahun' => $data['tahun'],
						'status' => $data['status'],
						'id' => $id
					]);
				}
				if($ex === true){
					successNotif();
					//backUrl(-2);
					if($imgs === 0){
						if($data['imgNow'] !== ""){
							$fileDir = '../images/uploads/employees/'.$data['imgNow'];
							$delImg = unlink($fileDir);
							if($delImg === true ){
								move_uploaded_file($_FILES['image']['tmp_name'], '../images/uploads/employees/'.$fileName );
								backUrl(-2);

							}
						} else {
							move_uploaded_file($_FILES['image']['tmp_name'], '../images/uploads/employees/'.$fileName );
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
	public static function EmployeesDelete($id, $dbCon, $img ){
		//print_r($data);
		try {
			$pre = $dbCon->prepare("DELETE FROM tb_pegawai WHERE id=:id");
			$ex  = $pre->execute([ 'id' => $id ]);
			//print_r($ex);
			if($ex === true){
				//deleteNotif();
				if($img !== ""){
					$fileDir = '../images/uploads/employees/'.$img;
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

	// END FOR PROCCESS EMPLOYEES SETTINGS

	// PROCESS FOR DOWNLOAD Settings

	public static function DownloadShow($dbCon, $data = ""){
		try {
			$pre = $dbCon->prepare("SELECT * FROM tb_downloads");
			$pre->execute();
			$res = $pre->fetchAll(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}
	public static function DownloadAdd($data ,$dbCon){
		//print_r($data);
		try {
			if(isset($data['token']) && $data['token'] === $_SESSION['token']){
				$imgs = $_FILES['fileInput']['error'];
				$imgName = $_FILES['fileInput']['name'];
				$name = explode(".",$imgName);
				$imgType = $_FILES['fileInput']['type'];
				if($imgs === 0){
					if($imgType === 'application/msword'){
						$fileName = $name[0].'.doc';
					} else if($imgType === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'){
						$fileName = $name[0].'.docx';
					} else {
						$fileName = $name[0].'.pdf';
					}
					$pre = $dbCon->prepare("INSERT INTO tb_downloads  VALUES (:id, :fname, :desc, :file, 0)");
					$ex  = $pre->execute([
						'id' => time(),
						'fname' => $data['fname'],
						'desc' => $data['desc'],
						'file' => $fileName,
					]);
				} else {
					$pre = $dbCon->prepare("INSERT INTO tb_downloads  VALUES (:id, :fname, :desc, :file, 0 )");
					$ex  = $pre->execute([
						'id' => time(),
						'fname' => $data['fname'],
						'desc' => $data['desc'],
						'file' => '',
					]);
				}
				if($ex === true){
					successNotif();
					backUrl(-2);
					if($imgs === 0){
						move_uploaded_file($_FILES['fileInput']['tmp_name'], '../downloads/'.$fileName );
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
	public static function DownloadGetID($data, $dbCon){
		try {
			$pre = $dbCon->prepare("SELECT * FROM tb_downloads WHERE id = :iditem");
			$pre->execute([ 'iditem' => $data ]);
			$res = $pre->fetch(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}
	public static function DownloadUpdate($data, $dbCon , $id){
		//print_r($_FILES['fileInput']);
		try {
			if(isset($data['token']) && $data['token'] === $_SESSION['token']){
				$imgs = $_FILES['fileInput']['error'];
				$imgName = $_FILES['fileInput']['name'];
				$name = explode(".",$imgName);
				$imgType = $_FILES['fileInput']['type'];
				if($imgs === 0){
					if($imgType === 'application/msword'){
						$fileName = $name[0].'.doc';
					} else if($imgType === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'){
						$fileName = $name[0].'.docx';
					} else {
						$fileName = $name[0].'.pdf';
					}
					$pre = $dbCon->prepare("UPDATE tb_downloads SET title = :fname, description = :desc, file = :file WHERE id=:id");
					$ex  = $pre->execute([
						'fname' => $data['fname'],
						'desc' => $data['desc'],
						'file' => $fileName,
						'id' => $id
					]);
				} else {
					$pre = $dbCon->prepare("UPDATE tb_downloads SET title = :fname, description = :desc WHERE id=:id");
					$ex  = $pre->execute([
						'fname' => $data['fname'],
						'desc' => $data['desc'],
						'id' => $id
					]);;
				}
				if($ex === true){
					successNotif();
					//backUrl(-2);
					if($imgs === 0){
						if($data['fileNow'] !== ""){
							$fileDir = '../downloads/'.$data['fileNow'];
							$delImg = unlink($fileDir);
							if($delImg === true ){
								move_uploaded_file($_FILES['fileInput']['tmp_name'], '../downloads/'.$fileName );
								backUrl(-2);
							}
						} else {
							move_uploaded_file($_FILES['fileInput']['tmp_name'], '../downloads/'.$fileName );
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
	public static function DownloadDelete($id, $dbCon, $img ){
		//print_r($data);
		try {
			$pre = $dbCon->prepare("DELETE FROM tb_downloads WHERE id=:id");
			$ex  = $pre->execute([ 'id' => $id ]);
			//print_r($ex);
			if($ex === true){
				//deleteNotif();
				if($img !== ""){
					$fileDir = '../downloads/'.$img;
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

	// END FOR PROCCESS DOWNLOAD SETTINGS

	// PROCESS FOR APIS SETTINGS
	public static function ApiShow($dbCon, $data = ""){
		try {
			$pre = $dbCon->prepare("SELECT * FROM tb_apis");
			$pre->execute();
			$res = $pre->fetchAll(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}
	public static function ApiShowJson($dbCon, $data = ""){
		try {
			$pre = $dbCon->prepare("SELECT * FROM tb_apis WHERE category NOT IN (1,2,3,4)");
			$pre->execute();
			$res = $pre->fetchAll(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}
	public static function ApiAdd($data ,$dbCon){
		//print_r($data);
		try {
			if(isset($data['token']) && $data['token'] === $_SESSION['token']){
				$pre = $dbCon->prepare("INSERT INTO tb_apis VALUES (:id, :category, :name, :url)");
				$ex  = $pre->execute([
					'id' => time(),
					'category' => 1,
					'name' => $data['nama'],
					'url' => $data['url']
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
	public static function ApiGetID($data, $dbCon){
		try {
			$pre = $dbCon->prepare("SELECT * FROM tb_apis WHERE id = :iditem");
			$pre->execute([ 'iditem' => $data ]);
			$res = $pre->fetch(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}
	public static function ApiUpdate($data, $dbCon , $id){
		try {
			if(isset($data['token']) && $data['token'] === $_SESSION['token']){
				$pre = $dbCon->prepare("UPDATE tb_apis SET name = :name, value = :url WHERE id=:id");
				$ex  = $pre->execute([
					'name' => $data['nama'],
					'url' => $data['url'],
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
	public static function ApiDelete($id, $dbCon ){
		//print_r($data);
		try {
			$pre = $dbCon->prepare("DELETE FROM tb_apis WHERE id=:id");
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

	// END PROCESS FOR APIS SETTINGS
}
