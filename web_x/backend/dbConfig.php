<?php
class DB
{
	public static function Connect(){
		try {
			$db = new PDO("mysql:host=localhost;dbname=perikana_dbsite","perikana_usrsite","5gy&Cxy{@5ap");
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			return $db;
		} catch (Exception $e) {
			echo "Error, koneksi kedatabase gagal.";
			exit();
		}
	}
}
?>
