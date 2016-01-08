<h1 class="page-header">Proses Penggajian <small>Periode <?=prosesgaji($_SESSION['proses_gaji']);?></small></h1>

<?php
if(isset($_POST['jumlah'])){
	error_reporting(0);
	echo '<script type="text/javascript">NProgress.start();</script>';
	$jumlah = $db->escapeString($_POST['jumlah']);
	$periode = $db->escapeString($_POST['periode']);
	$idstaff = $_SESSION['userid'];
		$ex = explode("-", $periode);
		$tahun = $ex[0];
		$bulan = $ex[1];
	$row = 1;
	$sql = "insert into hitung(iduser,bulan,tahun,pokok,idstaff,tanggal_proses) values";
	for($i=1;$i<=$jumlah;$i++){
		$idabsen = $_POST['id'.$i];
		if(!empty($idabsen)){
			$iduser = konvert('absen',$idabsen,'iduser');
			$idjabatan = konvert('users',$iduser,'jabatan');
			$pokok = konvert('jabatan',$idjabatan,'pokok');
			$tunjangan = konvert('jabatan',$idjabatan,'tunjangan');
			//$db->insert('hitung',array('iduser'=>$iduser,'bulan'=>$bulan,'tahun'=>$tahun,'pokok'=>$pokok,'idstaff'=>$_SESSION['userid'],'tanggal_proses'=>wkt()));
			$sql .= "('$iduser','$bulan','$tahun','$pokok','$idstaff',now())";
			$row++;
			if($i!=$jumlah){ $sql .= ","; }
		}
	}
	$db->sql($sql);
	unset($_SESSION['proses_gaji']);	
	$total = $row-1;

	// tabel gaji
	$q = mysql_query("select iduser from hitung where bulan='$bulan' and tahun='$tahun' group by iduser");
	while($d = mysql_fetch_array($q)){
		$a = mysql_query("select sum(pokok) as pokok from hitung where bulan='$bulan' and tahun='$tahun' and iduser='".$d['iduser']."'");
		$b = mysql_fetch_array($a);
		$pokok = $b['pokok'];
		$iduser = $d['iduser'];
		$idjabatan = konvert('users',$iduser,'jabatan');
		$tunjangan = konvert('jabatan',$idjabatan,'tunjangan');
		$tot_gaji = $pokok + $tunjangan;
		$db->insert('gaji',array('iduser'=>$iduser,'tipe'=>'Bulanan','bulan'=>$bulan,'tahun'=>$tahun,'total'=>$tot_gaji,'idstaff'=>$idstaff,'tanggal_proses'=>wkt()));
	}

	// selesai
	echo '<div class="alert alert-success" role="alert">'.$total.' dari '.$jumlah.' data berhasil diinput. Lihat data <a href="?p=laporan_gaji" class="alert-link">disini</a>.</div>';
	echo '<script type="text/javascript">NProgress.done();</script>';
}else{
?>
<script type="text/javascript">NProgress.start();</script>
<form action="" method="post">
<table class="table table-hover">
	<thead>
		<tr>
			<th class="col-lg-1 text-center">No</th>
			<th>Nama</th>
			<th class="col-lg-2 text-center">Tanggal</th>
			<th class="col-lg-2 text-center">Datang</th>
			<th class="col-lg-2 text-center">Pulang</th>
			<th class="col-lg-1 text-center">OK</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$db->select('absen','*',null,"tanggal like '".$_SESSION['proses_gaji']."-%'",'id asc'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
		$res = $db->getResult();
		$i = 1;
		foreach($res as $d){
			$exm = explode(" ", $d['masuk']); $exk = explode(" ", $d['keluar']); 
		?>
		<tr>
			<td class="text-center"><?=$i;?></td>
			<td><?=konvert('users',$d['iduser'],'nama');?></td>
			<td class="text-center"><?=tanggalIndo($d['tanggal']);?></td>
			<td class="text-center<?php if(cekmasuk($d['tanggal'],$exm[1])!='checked'){ echo " danger";}?>"><?=jam($d['masuk']);?></td>
			<td class="text-center<?php if(cekkeluar($d['tanggal'],$exk[1])!='checked'){ echo " danger";}?>"><?=jam($d['keluar']);?></td>
			<td class="text-center" align="center"><input type="checkbox" name="id<?=$i;?>" class="checkbox" value="<?=$d['id'];?>" <?php if(cekmasuk($d['tanggal'],$exm[1])=='checked' and cekkeluar($d['tanggal'],$exk[1])=='checked'){ ?>checked="true"<?php } ?> /></td>
		</tr>
		<?php $i++;} ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="6"><button type="submit" class="btn btn-primary btn-block">Simpan</button></td>
		</tr>
	</tfoot>
</table>
<input type="hidden" name="jumlah" id="inputJumlah" class="form-control" value="<?=$i-1;?>">
<input type="hidden" name="periode" id="inputPeriode" class="form-control" value="<?=$_SESSION['proses_gaji'];?>">
</form>
<script type="text/javascript">NProgress.done();</script>
<?php
}
?>