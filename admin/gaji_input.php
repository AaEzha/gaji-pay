<h1 class="page-header">Input Gaji Bulanan</h1>
<?php
error_reporting(0);
if(isset($_POST['bulan'])){
	echo '<script type="text/javascript">NProgress.start();</script>';
	$bulan = $db->escapeString($_POST['bulan']);
	$tahun = $db->escapeString($_POST['tahun']);
	$tahunbulan = "$tahun-$bulan";
	$idstaff = $_SESSION['userid'];
	$berkas = $_FILES['berkas']['tmp_name'];
	$tipe = $_FILES['berkas']['type'];
	$handle = fopen($berkas, "r");
	$row = 1;
	$n=1;
	while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
	{
		if($row == 1){ $row++; continue; }
		$iduser = $filesop[0];
		$tanggal = $filesop[1];
		$masuk = $filesop[2];
		$keluar = $filesop[3];

		$tgl = explode("-", $tanggal);
		$tgl2 = $tgl[0]."-".$tgl[1];
		if($tahunbulan == $tgl2){
			$db->insert('absen',array('iduser'=>$iduser,'tanggal'=>$tanggal,'masuk'=>$masuk,'keluar'=>$keluar,'idstaff'=>$idstaff,'tanggal_proses'=>wkt()));
			$n++;
		}
	}

	// debug
	$no = $n-1;
	if($no>0){
		echo '<div class="alert alert-success" role="alert">'.$no.' data berhasil diinput. Lihat data <a href="?p=proses_gaji" class="alert-link">disini</a>.</div>';
		$_SESSION['proses_gaji'] = $tahunbulan;
	}else{
		echo '<div class="alert alert-danger" role="alert">Tidak ada data yang diinput.</div>';
	}
	echo '<script type="text/javascript">NProgress.done();</script>';
}
?>
<form action="" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">

	<div class="form-group">
		<label for="inputBulan" class="col-sm-2 control-label">Periode :</label>
		<div class="col-sm-2">
			<select name="bulan" id="inputBulan" class="form-control" required="required">
			<?php
			$arbulan = array('01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember');
			foreach ($arbulan as $key => $value) {
				echo "<option value=\"$key\">$value</option>\n";
			}
			?>				
			</select>
		</div>
		<div class="col-sm-2">
			<select name="tahun" id="inputTahun" class="form-control" required="required">
			<?php
			for($t=2016;$t<=2020;$t++){
				echo "<option value=\"$t\">$t</option>\n";
			}
			?>
			</select>
		</div>
	</div>

	<div class="form-group">
		<label for="inputBerkas" class="col-sm-2 control-label">Berkas Absen :</label>
		<div class="col-sm-10">
			<input type="file" name="berkas" required>
			<p class="help-block">Pastikan formatnya seperti gambar dan ekstensi filenya .csv.<br><img class="form-control-static" src="gbr/berkas.JPG"></p>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
			<button type="submit" class="btn btn-primary">Submit</button>
			<button type="reset" class="btn btn-default">Reset</button>
		</div>
	</div>
</form>