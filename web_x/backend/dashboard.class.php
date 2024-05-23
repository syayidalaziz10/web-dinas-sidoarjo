<?php
class Dashboard
{
	public static function CountNews($dbCon){
		try {
			$pre = $dbCon->prepare("SELECT COUNT(category) AS total FROM tb_news WHERE category = 1");
			$pre->execute();
			$res = $pre->fetch(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}
	public static function CountEvents($dbCon){
		try {
			$pre = $dbCon->prepare("SELECT COUNT(id) AS total FROM tb_events");
			$pre->execute();
			$res = $pre->fetch(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}
	public static function CountServices($dbCon){
		try {
			$pre = $dbCon->prepare("SELECT COUNT(id) AS total FROM tb_services");
			$pre->execute();
			$res = $pre->fetch(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}
	public static function CountUsers($dbCon){
		try {
			$pre = $dbCon->prepare("SELECT COUNT(id) AS total FROM tb_users");
			$pre->execute();
			$res = $pre->fetch(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}
	public static function ListUsers($dbCon){
		try {
			$pre = $dbCon->prepare("SELECT full_name, email, status FROM tb_users");
			$pre->execute();
			$res = $pre->fetchAll(PDO::FETCH_OBJ);
			return $res;
		} catch (Exception $e) {
			echo "Error ".$e;
		}
	}
}
