<?php
require '../config/checkAccess.php';
require '../../conf/config.php';
require '../../conf/phpFunction.php';
	
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' )) {

	switch($_REQUEST['_act']){
		case 1:
				//SELECT jab_id, jab_nm, stat, _active, _cre, _cre_date, _chg, _chg_date FROM set_jabdept WHERE 1
				// fungsi untuk membuat id transaksi
				$countRec = loadRecText('count(jab_id)', 'set_jabdept', 'stat='.$_REQUEST['ka_id']);

				$jab_id	= str_pad($countRec+1, 3, "0", STR_PAD_LEFT);
				$jab_nm = isset($_REQUEST['jab_nm']) ? strval($_REQUEST['jab_nm']) : '';
				$jab_nm = ucwords($jab_nm);
				$ka_id = isset($_REQUEST['ka_id']) ? strval($_REQUEST['ka_id']) : '';

				$_active = isset($_REQUEST['_active']) ? strval($_REQUEST['_active']) : '1';
				$_cre = isset($_REQUEST['_cre']) ? strval($_REQUEST['_cre']) : '555';
				$_chg = $_cre;
			

				// perintah query untuk menyimpan data ke tabel transaksi
				$insert = $mysqli->query("INSERT INTO set_jabdept(jab_id, jab_nm, stat, _active, _cre, _cre_date, _chg, _chg_date) 
									VALUES('$jab_id','$jab_nm','$ka_id','$_active','$_cre', SYSDATE(),'$_chg',SYSDATE())")
										  or die('Ada kesalahan pada query insert : '.$mysqli->error);
				// cek query
				if ($insert) {
					// jika berhasil tampilkan pesan berhasil simpan data
					echo "sukses";
				} else {
					// jika gagal tampilkan pesan gagal simpan data
					echo "gagal";
				}
				// tutup koneksi
				$mysqli->close();
			
			break;
		case 2:
			
				if (isset($_REQUEST['jab_id'])) {
					// ambil data hasil post dari ajax
					$jab_id	= $_REQUEST['jab_id'];
					$jab_nm = isset($_REQUEST['jab_nm']) ? strval($_REQUEST['jab_nm']) : '';
					$jab_nm = ucwords($jab_nm);
					$ka_id = isset($_REQUEST['ka_id']) ? strval($_REQUEST['ka_id']) : '';

					$_active = isset($_REQUEST['_active']) ? strval($_REQUEST['_active']) : '1';
					$_cre = isset($_REQUEST['_cre']) ? strval($_REQUEST['_cre']) : '555';
					$_chg = $_cre;

					// perintah query untuk mengubah data pada tabel transaksi
					$update = $mysqli->query("UPDATE set_jabdept SET jab_nm='$jab_nm', _chg='$_chg', _chg_date=SYSDATE()
										WHERE jab_id='$jab_id'")
											  or die('Ada kesalahan pada query update : '.$mysqli->error);
					// cek query
					if ($update) {
						// jika berhasil tampilkan pesan berhasil ubah data
						echo "sukses";
					} else {
						// jika gagal tampilkan pesan gagal ubah data
						echo "gagal";
					}
				}
				// tutup koneksi
				$mysqli->close();   			
			
			
			break;
		case 3:
			
				if (isset($_REQUEST['jab_id'])) {
					// ambil data hasil post dari ajax
					$jab_id     = isset($_REQUEST['jab_id']) ? strval($_REQUEST['jab_id']) : '';

					$_active = isset($_REQUEST['_active']) ? strval($_REQUEST['_active']) : '0';
					$_cre = isset($_REQUEST['_cre']) ? strval($_REQUEST['_cre']) : '555';
					$_chg = $_cre;

					// perintah query untuk mengubah data pada tabel transaksi
					$update = $mysqli->query("UPDATE set_jabdept SET _active='0', _chg='$_chg', _chg_date=SYSDATE()
										WHERE jab_id='$jab_id'")
											  or die('Ada kesalahan pada query update : '.$mysqli->error);
					// cek query
					if ($update) {
						// jika berhasil tampilkan pesan berhasil ubah data
						echo "sukses";
					} else {
						// jika gagal tampilkan pesan gagal ubah data
						echo "gagal";
					}
				}
				// tutup koneksi
				$mysqli->close();   			
			
			break;
		case 4:
			
				if (isset($_GET['jab_id'])) {
					// ambil data get dari ajax
					$jab_id = $_GET['jab_id'];
					// perintah query untuk menampilkan data dari tabel transaksi berdasarkan id_transaksi
					$result = $mysqli->query("SELECT jab_id, jab_nm, stat, _active, _cre, _cre_date, _chg, _chg_date 
                                                FROM set_jabdept 
											WHERE _active=1 AND jab_id='$jab_id'")
											  or die('Ada kesalahan pada query tampil data transaksi: '.$mysqli->error);
					$data = $result->fetch_assoc();
				}
				// tutup koneksi
				$mysqli->close(); 

				echo json_encode($data); 			
			
			break;
		case 5:
			
				//SELECT jab_id, jab_nm, stat, _active, _cre, _cre_date, _chg, _chg_date FROM set_jabdept WHERE 1
				// nama table
				$table = 'set_jabdept';
				// Table's primary key
				$primaryKey = 'jab_id';

				$columns = array(
					array( 'db' => 'jab_id', 'dt' => 0 ),
					array( 'db' => 'jab_nm', 'dt' => 1 ),
					array( 'db' => '_active', 'dt' => 2 ),
					/*
					array(
						'db' => 'tanggal',
						'dt' => 2,
						'formatter' => function( $d, $row ) {
							return date('d-m-Y', strtotime($d));
						}
					),
					array( 'db' => 'nama_barang', 'dt' => 3 ),
					array(
						'db'        => 'harga_barang',
						'dt'        => 4,
						'formatter' => function( $d, $row ) {
							return 'Rp. '.number_format($d);
						}
					),
					array(
						'db'        => 'jumlah_beli',
						'dt'        => 5,
						'formatter' => function( $d, $row ) {
							return number_format($d);
						}
					),
					array(
						'db'        => 'total_bayar',
						'dt'        => 6,
						'formatter' => function( $d, $row ) {
							return 'Rp. '.number_format($d);
						}
					),
					*/
				);
				
				$where ="_active=1 AND stat=$_REQUEST[ka_id]";

				// ssp class
				require '../config/ssp.class.php';

				echo json_encode(
					//SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
					SSP::complex( $_GET, $con, $table, $primaryKey, $columns, null, $where )
				);
			
			break;
	}
} else {
    echo '<script>window.location="../index.php"</script>';
}
?>