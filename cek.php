<?php
include '_db.php';

$q = mysql_query("select iduser from hitung where bulan='01' and tahun='2016' group by iduser");
while($d = mysql_fetch_array($q)){
	$a = mysql_query("select sum(pokok) as pokok from hitung where bulan='01' and tahun='2016' and iduser='".$d['iduser']."'");
	$b = mysql_fetch_array($a);
	$pokok = $b['pokok'];
	$iduser = $d['iduser'];
	$idjabatan = konvert('users',$iduser,'jabatan');
	$tunjangan = konvert('jabatan',$idjabatan,'tunjangan');
	$tot_gaji = $pokok + $tunjangan;
}
?>