<h1 class="page-header">Input THR</h1>
<?php
error_reporting(0);
if(isset($_POST['tahun'])){
	error_reporting(0);
	echo '<script type="text/javascript">NProgress.start();</script>';
	$bulan = 12;
	$tahun = $db->escapeString($_POST['tahun']);
	$idstaff = $_SESSION['userid'];

	// tabel gaji
	$jumlah = 1;
	$q = mysql_query("select id,jabatan from users");
	while($d = mysql_fetch_array($q)){
		$iduser = $d['id'];
		$idjabatan = $d['jabatan'];
		$jabatan = konvert('jabatan',$idjabatan,'nama');
		$tot_gaji = $_POST[$idjabatan];
		$db->insert('gaji',array('iduser'=>$iduser,'tipe'=>'THR','bulan'=>$bulan,'tahun'=>$tahun,'total'=>$tot_gaji,'idstaff'=>$idstaff,'tanggal_proses'=>wkt()));
		$jumlah++;
	} $jumlah = $jumlah-1;

	// selesai
	echo '<div class="alert alert-success" role="alert">'.$jumlah.' data berhasil diinput. Lihat data <a href="?p=laporan_thr" class="alert-link">disini</a>.</div>';
	echo '<script type="text/javascript">NProgress.done();</script>';
}else{
?>
<form action="" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">

	<div class="form-group">
		<label for="inputBulan" class="col-sm-2 control-label">Periode :</label>
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
		<label for="inputBerkas" class="col-sm-2 control-label">Jumlah THR :</label>
		<div class="col-sm-10">
			<table class="table table-hover">
				<thead>
					<tr>
						<th class="col-lg-1 text-center">No</th>
						<th>Jabatan</th>
						<th class="col-lg-2">THR</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$i = 1;
				$db->select('jabatan','*',null,null,'nama asc');
				$res = $db->getResult();
				foreach($res as $data){ ?>
					<tr>
						<td class="text-center"><?=$i;?></td>
						<td><?=$data['nama'];?></td>
						<td>
							<input type="text" name="<?=$data['id'];?>" id="inputTotal<?=$i;?>" class="form-control" value="<?=$data['thr'];?>" required="required" <?=angka();?> maxlength="20">
						</td>
					</tr>
				<?php $i++; } $i=$i-1; ?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
			<button type="submit" class="btn btn-primary">Submit</button>
			<button type="reset" class="btn btn-default">Reset</button>
		</div>
	</div>
</form>
<?php } ?>