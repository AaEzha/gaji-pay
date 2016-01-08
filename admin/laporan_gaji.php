<?php
if(isset($_POST['bulan'])){
	$bulan = $db->escapeString($_POST['bulan']);
	$tahun = $db->escapeString($_POST['tahun']);
	$db->select('gaji','*',null,"tipe='Bulanan' and bulan='$bulan' and tahun='$tahun'",'iduser asc');
	$tipe = prosesgaji($tahun."-".$bulan);
}else{
	$db->select('gaji','*',null,"tipe='Bulanan'",'iduser asc'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
	$tipe = "Seluruh Data";
}
?>
<div class="col-lg-12">
    <h1 class="page-header">Laporan Gaji Bulanan <small><?=$tipe;?></small></h1>
</div>
<form action="" method="POST" class="form-inline page-header" role="form">

	<div class="form-group">
		<label class="sr-only" for="">bulan</label>
		<select name="bulan" id="inputBulan" class="form-control" required="required">
		<?php
		$arbulan = array('01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember');
		foreach ($arbulan as $key => $value) {
			echo "<option value=\"$key\">$value</option>\n";
		}
		?>				
		</select>
	</div>

	<div class="form-group">
		<label class="sr-only" for="">tahun</label>
		<select name="tahun" id="inputTahun" class="form-control" required="required">
		<?php
		for($t=2016;$t<=2020;$t++){
			echo "<option value=\"$t\">$t</option>\n";
		}
		?>
		</select>
	</div>

	<button type="submit" class="btn btn-primary">Submit</button>
	<a href="?p=laporan_gaji" class="btn btn-default">Refresh</a>
</form>
<table class="table table-hover" id="tbl">
	<thead>
		<tr>
			<th class="col-lg-1 text-center">No</th>
			<th>Nama</th>
			<th class="col-lg-2 text-center">Periode</th>
			<th class="col-lg-2 text-center">Gaji</th>
		</tr>
	</thead>
	<tbody>
	<?php $res = $db->getResult(); $i=1; $total=0; foreach($res as $data){ ?>
		<tr>
			<td class="text-center"><?=$i;?></td>
			<td><?=konvert('users',$data['iduser'],'nama');?></td>
			<td class="text-center"><?=prosesgaji($data['tahun']."-".$data['bulan']);?></td>
			<td class="text-center">Rp.<?=number_format($data['total'],0,',','.');?></td>
		</tr>
	<?php $i++; $total=$total+$data['total']; } ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="3" class="text-right">Total</td>
			<td class="text-center">Rp.<?=number_format($total,0,',','.');?></td>
		</tr>
	</tfoot>
</table>