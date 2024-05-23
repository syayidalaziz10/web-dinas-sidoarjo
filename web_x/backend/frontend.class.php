<?php
include_once 'function.php';
class FrontEnd
{
  public static function NewsShow($dbCon){
    try {
      $pre = $dbCon->prepare("SELECT a.id as idnews, a.iduser , a.title, a.description , a.img, a.date, b.id, b.full_name FROM tb_news a LEFT JOIN tb_users b ON a.iduser = b.id WHERE category IN (1) ORDER BY date DESC");
      $pre->execute();
      $res = $pre->fetchAll(PDO::FETCH_OBJ);
      return $res;
    } catch (Exception $e) {
      echo "Error ".$e;
    }
  }

  public static function GetID($data, $dbCon){
    try {
      $pre = $dbCon->prepare("SELECT a.id as idnews, a.iduser , a.title, a.description , a.img, a.date, b.id, b.full_name FROM tb_news a LEFT JOIN tb_users b ON a.iduser = b.id WHERE category IN (1) AND a.id = :iditem");
      $pre->execute([ 'iditem' => $data ]);
      $res = $pre->fetch(PDO::FETCH_OBJ);
      return $res;
    } catch (Exception $e) {
      echo "Error ".$e;
    }
  }

  public static function EventShow($dbCon){
		try {
			$pre = $dbCon->prepare("SELECT a.id as idevents, a.iduser , a.title, a.description , a.img, a.date, b.id, b.full_name FROM tb_events a LEFT JOIN tb_users b ON a.iduser = b.id ORDER BY a.datesubmit DESC");
			$pre->execute();
			$res = $pre->fetchAll(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}

  public static function EventGetID($data, $dbCon){
		try {
			$pre = $dbCon->prepare("SELECT * FROM tb_events WHERE id = :iditem");
			$pre->execute([ 'iditem' => $data ]);
			$res = $pre->fetch(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}

  public static function OptionShow($dbCon){
    try {
      $pre = $dbCon->prepare("SELECT * FROM tb_options");
      $pre->execute();
      $res = $pre->fetchAll(PDO::FETCH_OBJ);
      return $res;
    } catch (Exception $e) {
      echo "Error ".$e;
    }
  }

  public static function BannerShow($dbCon){
    try {
      $pre = $dbCon->prepare("SELECT * FROM tb_banners WHERE category NOT IN (2,3,8) AND status = 1 ORDER BY category ASC ");
      $pre->execute();
      $res = $pre->fetchAll(PDO::FETCH_OBJ);
      return $res;
    } catch (Exception $e) {
      echo "Error ".$e;
    }
  }
  public static function BannerSliderShow($dbCon){
    try {
      $pre = $dbCon->prepare("SELECT * FROM tb_banners WHERE category IN (2) AND status = 1 ");
      $pre->execute();
      $res = $pre->fetchAll(PDO::FETCH_OBJ);
      return $res;
    } catch (Exception $e) {
      echo "Error ".$e;
    }
  }

  public static function VideoShow($dbCon){
		try {
			$pre = $dbCon->prepare("SELECT * FROM tb_video WHERE status = 1 ORDER BY id DESC");
			$pre->execute();
			$res = $pre->fetchAll(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}

  public static function ServicesShow($dbCon){
		try {
			$pre = $dbCon->prepare("SELECT * FROM tb_services WHERE status = 1 ORDER BY status DESC");
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

  public static function EmployeesShow($dbCon){
		try {
			$pre = $dbCon->prepare("SELECT * FROM tb_pegawai WHERE status = 1 ORDER BY name ASC");
			$pre->execute();
			$res = $pre->fetchAll(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}

  public static function VisiMisiShow($dbCon){
		try {
			$pre = $dbCon->prepare("SELECT a.id as idnews, a.iduser , a.title, a.description , a.img, a.date, b.id, b.full_name FROM tb_news a LEFT JOIN tb_users b ON a.iduser = b.id WHERE category IN (3) ORDER BY date DESC");
			$pre->execute();
			$res = $pre->fetchAll(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}

  public static function TupoksiShow($dbCon){
		try {
			$pre = $dbCon->prepare("SELECT a.id as idnews, a.iduser , a.title, a.description , a.img, a.date, b.id, b.full_name FROM tb_news a LEFT JOIN tb_users b ON a.iduser = b.id WHERE category IN (2) ORDER BY date DESC");
			$pre->execute();
			$res = $pre->fetchAll(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}

  public static function DownloadShow($dbCon){
		try {
			$pre = $dbCon->prepare("SELECT * FROM tb_downloads");
			$pre->execute();
			$res = $pre->fetchAll(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}

  public static function DasarHukumShow($dbCon){
		try {
			$pre = $dbCon->prepare("SELECT a.id as idnews, a.iduser , a.title, a.description , a.img, a.date, b.id, b.full_name FROM tb_news a LEFT JOIN tb_users b ON a.iduser = b.id WHERE category = 4 ORDER BY date DESC");
			$pre->execute();
			$res = $pre->fetchAll(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}

  public static function PrestasiShow($dbCon){
		try {
			$pre = $dbCon->prepare("SELECT a.id as idnews, a.iduser , a.title, a.description , a.img, a.date, b.id, b.full_name FROM tb_news a LEFT JOIN tb_users b ON a.iduser = b.id WHERE category = 5 ORDER BY date DESC");
			$pre->execute();
			$res = $pre->fetchAll(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}

  public static function DinasShow($dbCon){
		try {
			$pre = $dbCon->prepare("SELECT * FROM tb_dinas ORDER BY name ASC");
			$pre->execute();
			$res = $pre->fetchAll(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}

  public static function ProfilShow($dbCon){
    try {
      $pre = $dbCon->prepare("SELECT * FROM tb_profil_pimpinan WHERE status = 1 ORDER BY periode DESC");
      $pre->execute();
      $res = $pre->fetchAll(PDO::FETCH_OBJ);
      return $res;
    } catch (Exception $e) {
      echo "Error ".$e;
    }
  }
  public static function AnnouncementShow($dbCon){
		try {
			$pre = $dbCon->prepare("SELECT a.id as idnews, a.iduser , a.title, a.description , a.date, a.datex, a.status, b.id, b.full_name FROM tb_pengumuman a LEFT JOIN tb_users b ON a.iduser = b.id WHERE a.status = 1 ORDER BY idnews DESC");
			$pre->execute();
			$res = $pre->fetchAll(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}

  public static function ApiShowSosmed($dbCon){
		try {
			$pre = $dbCon->prepare("SELECT * FROM tb_apis WHERE category IN (1,2,3,4)");
			$pre->execute();
			$res = $pre->fetchAll(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}
  public static function TelpShow($dbCon){
		try {
			$pre = $dbCon->prepare("SELECT * FROM tb_options WHERE id > 100");
			$pre->execute();
			$res = $pre->fetchAll(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}
  public static function CounterShow($dbCon, $id){
		try {
			$pre = $dbCon->prepare("SELECT * FROM tb_counter WHERE idnews = :id");
			$pre->execute(['id' => $id ]);
			$res = $pre->fetchAll(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}
}
