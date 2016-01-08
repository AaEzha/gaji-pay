<?php session_start(); error_reporting(0);
include '../_db.php';

$db = new Database();
$db->connect();

if(isset($_POST['tahun'])){

	$tahun = $_POST['tahun'];
	$bulan = $_POST['bulan'];

	$_SESSION['proses_gaji'] = "$tahun-$bulan";


	for($d=1;$d<=25;$d++){		// 25 hari kerja
		$sql = "insert into absen(iduser,tanggal,masuk,keluar,idstaff,tanggal_proses) values";
		$db->select('users','id');
		$res = $db->getResult();
		foreach($res as $key=>$dd){
		//for($i=1;$i<=7;$i++){	// jumlah pegawai : 1 admin, 1 direktur, 7 pegawai
			//$db->insert('absen',array('iduser'=>$i,'tanggal'=>'2016-01-'.$d,'masuk'=>'2016-01-'.$d.' 07:'.$i.':'.$d,'keluar'=>'2016-01-'.$d.' 17:'.$i.':'.$d,'idstaff'=>'1','tanggal_proses'=>wkt()));
			$sql .= "('".$dd['id']."','".$tahun."-".$bulan."-".$d."','".$tahun."-".$bulan."-".$d." 07:".$dd['id'].":".$d."','".$tahun."-".$bulan."-".$d." 17:".$dd['id'].":".$d."','1',now())";
			if ( end( array_keys( $res ) ) != $key ){ $sql .= ","; }
		}
		$db->sql($sql);
	}

	echo $sql; // debug

	eksyen('','index.php?p=proses_gaji');
}
?>

<form action="" method="POST" role="form">
	<legend>Input Gaji</legend>

	<div class="form-group">
		<label for="">bulan</label>
		<select name="bulan" id="inputBulan" class="form-control" required="required">
		<?php
		$arbulan = array('01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember');
		foreach ($arbulan as $key => $value) {
			echo "<option value=\"$key\">$value</option>\n";
		}
		?>				
		</select>
		<select name="tahun" id="inputTahun" class="form-control" required="required">
		<?php
		for($t=2016;$t<=2020;$t++){
			echo "<option value=\"$t\">$t</option>\n";
		}
		?>
		</select>
	</div>

	

	<button type="submit" class="btn btn-primary">Submit</button>
</form>