<?php
include '../_db.php';
	if(!isset($_POST['idgaji'])) echo "<script>window.close();</script>";
$db = new Database();
$db->connect();
$idgaji = $db->escapeString($_POST['idgaji']);
$db->select('gaji','*',null,"id='$idgaji'");
$res = $db->getResult();
ob_start(); // mulai cetak 
foreach($res as $d){
	// ambil jumlah hari
	$qh = mysql_query("select count(bulan) as jumhari from hitung where bulan='".$d['bulan']."' and tahun='".$d['tahun']."' and iduser='".$d['iduser']."'");
	$dh = mysql_fetch_array($qh);
?>
<h1 style="text-align:center;">SLIP GAJI</h1><hr><h2 align="center">PT. Sri Rejeki Fertilizer</h2><p align="center">Jl. Raya Serpong, Serpong Utara, Tangerang Selatan, Banten 15325, Indonesia<br />Telp: +62 21 53125141 # Website: www.pamafert.com</p>
<table style="text-align: center; border: solid 0px black; background: #fff;width: 100%; cellpadding: 5px; cellspacing: 0px" align="center">
	<tbody>
		<tr>
			<td style="border: solid 0px #000;width: 10%">Nama</td>
			<td style="border: solid 0px #000;width: 30%">: <?=konvert('users',$d['iduser'],'nama');?></td>
			<td style="border: solid 0px #000;width: 20%"></td>
			<td style="border: solid 0px #000;width: 10%">Jabatan</td>
			<td style="border: solid 0px #000;width: 30%">: <?php $idjabatan=konvert('users',$d['iduser'],'Jabatan'); echo konvert('jabatan',$idjabatan,'nama');?></td>
		</tr>
		<tr>
			<td style="border: solid 0px #000;width: 10%">Tipe</td>
			<td style="border: solid 0px #000;width: 30%">: <?=$d['tipe'];?></td>
			<td style="border: solid 0px #000;width: 20%"></td>
			<td style="border: solid 0px #000;width: 10%">Periode</td>
			<td style="border: solid 0px #000;width: 30%">: <?php if($d['tipe']=='Bulanan'){ echo prosesgaji($d['tahun']."-".$d['bulan']); }else{ echo $d['tahun'];} ?></td>
		</tr>
	</tbody>
</table>
<h1>&nbsp;</h1>
<table style="text-align: center; border: solid 2px black; background: #fff;width: 100%; cellpadding: 5px; cellspacing: 0px" align="center">
	<thead>
		<tr>
			<th style="border: solid 1px #000;width: 15%">No</th>
			<th style="border: solid 1px #000;width: 45%">Jenis</th>
			<th style="border: solid 1px #000;width: 20%">Nominal</th>
			<th style="border: solid 1px #000;width: 20%">Jumlah</th>
		</tr>
	</thead>
	<tbody>
	<?php if($d['tipe']=='Bulanan'){ ?>
		<tr>
			<td style="border: solid 1px #000" align="center">1</td>
			<td style="border: solid 1px #000">Gaji Pokok (<?=$dh['jumhari'];?> Hari)</td>
			<td style="border: solid 1px #000" align="center">Rp.<?=number_format(konvert('jabatan',$idjabatan,'pokok'),0,',','.');?></td>
			<td style="border: solid 1px #000" align="center">Rp.<?=number_format(konvert('jabatan',$idjabatan,'pokok')*$dh['jumhari'],0,',','.');?></td>
		</tr>
		<tr>
			<td style="border: solid 1px #000" align="center">2</td>
			<td style="border: solid 1px #000">Gaji Tunjangan Jabatan</td>
			<td style="border: solid 1px #000" align="center">Rp.<?=number_format(konvert('jabatan',$idjabatan,'tunjangan'),0,',','.');?></td>
			<td style="border: solid 1px #000" align="center">Rp.<?=number_format(konvert('jabatan',$idjabatan,'tunjangan'),0,',','.');?></td>
		</tr>
		<tr style="font-size:25;">
			<td style="border: solid 1px #000" colspan="3" align="right">Total</td>
			<td style="border: solid 1px #000" align="center">Rp.<?=number_format(konvert('jabatan',$idjabatan,'pokok')*$dh['jumhari']+konvert('jabatan',$idjabatan,'tunjangan'),0,',','.');?></td>
		</tr>
	<?php }else{ ?>
		<tr>
			<td style="border: solid 1px #000" align="center">1</td>
			<td style="border: solid 1px #000">Tunjangan Hari Raya</td>
			<td style="border: solid 1px #000" align="center">Rp.<?=number_format(konvert('jabatan',$idjabatan,'thr'),0,',','.');?></td>
			<td style="border: solid 1px #000" align="center">Rp.<?=number_format(konvert('jabatan',$idjabatan,'thr'),0,',','.');?></td>
		</tr>
		<tr style="font-size:25;">
			<td style="border: solid 1px #000" colspan="3" align="right">Total</td>
			<td style="border: solid 1px #000" align="center">Rp.<?=number_format(konvert('jabatan',$idjabatan,'thr'),0,',','.');?></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<h1>&nbsp;</h1>
		<p align="center">Dikeluarkan pada <?=tanggalIndo($d['tanggal_proses']);?></p>
		<p>&nbsp;</p>
		<p align="center"><?=konvert('users',$d['idstaff'],'nama');?></p>
<?php
	$content = ob_get_clean();

    // convert to PDF
    require_once('../bower_components/pdf/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4','en',array(40, 30, 30, 20));
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content);
        $html2pdf->Output("Slip_Gaji-".$d['tipe']."-".prosesgaji($d['tahun']."-".$d['bulan']).".pdf",'D');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
}
?>
<script>//window.close();</script>
