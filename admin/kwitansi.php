<div class="col-lg-12">
    <h1 class="page-header">Cetak Slip Gaji</h1>
</div>

<table class="table table-hover" id="tbl">
	<thead>
		<tr>
			<th class="col-lg-1 text-center">No</th>
			<th>Gaji</th>
			<th class="col-lg-2">Nominal</th>
			<th class="col-lg-2 text-center"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></th>
		</tr>
	</thead>
	<tbody>
	<?php
	$i = 1;
	$tot = 0;
	$iduser = $_SESSION['userid'];
	$db->select('gaji','*',null,"iduser='$iduser'");
	$res = $db->getResult();
	foreach($res as $d){ ?>
		<tr>
			<td class="text-center"><?=$i;?></td>
			<td><?=$d['tipe'];?> <?=prosesgaji($d['tahun']."-".$d['bulan']);?></td>
			<td>Rp.<?=number_format($d['total'],0,',','.');?></td>
			<td class="text-center">
				<form action="cetak.php?idgaji=<?=$d['id'];?>" method="post" target="_blank">
				<input type="hidden" name="idgaji" id="inputIdgaji" class="form-control" value="<?=$d['id'];?>">
				<button type="submit" class="btn btn-primary btn-block btn-xs"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Cetak</button>
				</form>
			</td>
		</tr>
	<?php $i++; $tot = $tot + $d['total']; } ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="2" class="text-right">Total</td>
			<td colspan="2">Rp.<?=number_format($tot,0,',','.');?></td>
		</tr>
	</tfoot>
</table>