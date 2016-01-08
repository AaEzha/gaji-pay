<?php if(!isset($_GET['act'])){ ?>
<div class="col-lg-12">
    <h1 class="page-header">Data Jabatan</h1>
</div>
<table class="table table-hover table-bordered" id="tbl">
	<thead>
		<tr>
			<th class="col-lg-1 text-center">No</th>
			<th>Jabatan</th>
			<th class="col-lg-2 text-center">Pokok</th>
			<th class="col-lg-2 text-center">Tunjangan</th>
			<th class="col-lg-2 text-center">THR</th>
			<th class="col-lg-1 text-center">#</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i = 1;
		$db = new Database();
		$db->connect();
		$db->select('jabatan'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
		$res = $db->getResult();
		foreach($res as $d){
		?>
		<tr>
			<td class="text-center"><?=$i++;?></td>
			<td><?=$d['nama'];?></td>
			<td class="text-center"><?=number_format($d['pokok']);?>/hari</td>
			<td class="text-center"><?=number_format($d['tunjangan']);?></td>
			<td class="text-center"><?=number_format($d['thr']);?></td>
			<td class="text-center"><?=tbl_ubah('?p=jabatan&act=ubah&id='.$d['id']);?> <?=tbl_hapus('?p=jabatan&act=hapus&id='.$d['id']);?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>

<?php }else{

	switch ($_GET['act']) {
		case 'ubah': ?>
			<?php 
			if(isset($_GET['id'])){ 
				echo '<h1 class="page-header">Ubah Jabatan</h1>';
				$id = $_GET['id'];
				$db->select('jabatan','*',NULL,"id='$id'",null); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
				$d = $db->getResult();
			}else{
				echo '<h1 class="page-header">Tambah Jabatan</h1>';
			}

			if(isset($_POST['nama'])){
				echo "Processing...";
				$nama = mysql_real_escape_string($_POST['nama']);
				$pokok = mysql_real_escape_string($_POST['pokok']);
				$tunjangan = mysql_real_escape_string($_POST['tunjangan']);
				$thr = mysql_real_escape_string($_POST['thr']);

				if(isset($_POST['id'])){
					$id = mysql_real_escape_string($_POST['id']);
					$db->update('jabatan',array('nama'=>$nama,'pokok'=>$pokok,'tunjangan'=>$tunjangan,'thr'=>$thr,'ubah'=>wkt()),'id="'.$id.'"');
					eksyen('Data berhasil diubah','?p=jabatan');
				}else{
					$db->insert('jabatan',array('id'=>id(),'nama'=>$nama,'pokok'=>$pokok,'tunjangan'=>$tunjangan,'thr'=>$thr,'buat'=>wkt()));
					$res = $db->getResult();
					eksyen('Data berhasil diinput','?p=jabatan');
				}
			}
			?>
			<form action="" method="POST" class="form-horizontal" role="form">
				<?php if(isset($_GET['id'])){ ?>
				<input type="hidden" name="id" id="inputId" class="form-control" value="<?=$_GET['id'];?>">
				<?php } ?>
				<div class="form-group">
					<label for="inputNama" class="col-sm-2 control-label">Nama Jabatan :</label>
					<div class="col-sm-3">
						<input type="text" name="nama" id="inputNama" class="form-control" <?php if(isset($_GET['id'])){ ?>value="<?=$d[0]['nama'];?>"<?php } ?> required="required" maxlength="25">
					</div>
				</div>

				<div class="form-group">
					<label for="inputPokok" class="col-sm-2 control-label">Gaji Pokok :</label>
					<div class="col-sm-2">
						<input type="text" name="pokok" id="inputPokok" class="form-control" <?php if(isset($_GET['id'])){ ?>value="<?=$d[0]['pokok'];?>"<?php } ?> maxlength="8" required="required" onkeypress="return isNumber(event)">
					</div>
				</div>

				<div class="form-group">
					<label for="inputTunjangan" class="col-sm-2 control-label">Gaji Tunjangan :</label>
					<div class="col-sm-2">
						<input type="text" name="tunjangan" id="inputTunjangan" class="form-control" <?php if(isset($_GET['id'])){ ?>value="<?=$d[0]['tunjangan'];?>"<?php } ?> maxlength="8" required="required" onkeypress="return isNumber(event)">
					</div>
				</div>

				<div class="form-group">
					<label for="inputTunjangan" class="col-sm-2 control-label">THR :</label>
					<div class="col-sm-2">
						<input type="text" name="thr" id="inputTunjangan" class="form-control" <?php if(isset($_GET['id'])){ ?>value="<?=$d[0]['thr'];?>"<?php } ?> maxlength="8" required="required" onkeypress="return isNumber(event)">
					</div>
				</div>
			
				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<button type="submit" class="btn btn-primary">Simpan</button>
						<button type="reset" class="btn btn-default">Reset</button>
					</div>
				</div>
			</form>
			<?php break;

		case 'hapus':
			echo '<h1 class="page-header">Hapus Jabatan</h1>Processing...';
			$id = mysql_real_escape_string($_GET['id']);
			$db->delete('jabatan',"id='$id'"); 
			$res = $db->getResult();
			eksyen('','?p=jabatan');
			break;
		
		default:
			eksyen('Halaman tidak ditemukan','index.php');
			break;
	}
}