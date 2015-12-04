<?php if(!isset($_GET['act'])){ ?>

<div class="col-lg-12">
    <h1 class="page-header">Data User</h1>
</div>
<table class="table table-hover table-bordered" id="tbl">
	<thead>
		<tr>
			<th class="col-lg-1 text-center">No</th>
			<th>Nama</th>
			<th class="col-lg-2 text-center">Jabatan</th>
			<th class="col-lg-2 text-center">Level</th>
			<th class="col-lg-1 text-center">#</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i = 1;
		$db->select('users'); 
		$res = $db->getResult();
		foreach($res as $d){
		?>
		<tr>
			<td class="text-center"><?=$i++;?></td>
			<td><?=$d['nama'];?></td>
			<td class="text-center"><?=konvert('jabatan',$d['jabatan'],'nama');?></td>
			<td class="text-center"><?=$d['level'];?></td>
			<td class="text-center"><?=tbl_ubah('?p=user&act=ubah&id='.$d['id']);?> <?=tbl_hapus('?p=user&act=hapus&id='.$d['id']);?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>

<?php }else{
	switch ($_GET['act']) {
		case 'ubah': ?>
			<?php 
			if(isset($_GET['id'])){ 
				echo '<h1 class="page-header">Ubah User</h1>';
				$id = $_GET['id'];
				$db->select('users','*',NULL,"id='$id'"); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
				$d = $db->getResult();
			}else{
				echo '<h1 class="page-header">Tambah User</h1>';
			}

			if(isset($_POST['nama'])){
				echo "Processing...";
				$nama = mysql_real_escape_string($_POST['nama']);
				$alamat = mysql_real_escape_string($_POST['alamat']);
				$jk = mysql_real_escape_string($_POST['jk']);
				$jabatan = mysql_real_escape_string($_POST['jabatan']);
				$level = mysql_real_escape_string($_POST['level']);
				$username = mysql_real_escape_string($_POST['username']);
				$password = mysql_real_escape_string(md5($_POST['password']));

				if(isset($_POST['id'])){
					$id = mysql_real_escape_string($_POST['id']);
					if($_POST['password']==''){
						$db->update('users',array('nama'=>$nama,'alamat'=>$alamat,'jk'=>$jk,'jabatan'=>$jabatan,'level'=>$level,'username'=>$username,'ubah'=>wkt()),"id='$id'");
					}else{
						$db->update('users',array('nama'=>$nama,'alamat'=>$alamat,'jk'=>$jk,'jabatan'=>$jabatan,'level'=>$level,'username'=>$username,'password'=>$password,'ubah'=>wkt()),"id='$id'");
					}
					eksyen('Data berhasil diubah','?p=user');
				}else{
					$db->insert('users',array('id'=>id(),'nama'=>$nama,'alamat'=>$alamat,'jk'=>$jk,'jabatan'=>$jabatan,'level'=>$level,'username'=>$username,'password'=>$password,'buat'=>wkt()));
					$res = $db->getResult();
					eksyen('Data berhasil diinput','?p=user');
				}
			}

			?>
			<form action="" method="POST" class="form-horizontal" role="form">
				<?php if(isset($_GET['id'])){ ?>
				<input type="hidden" name="id" id="inputId" class="form-control" value="<?=$_GET['id'];?>">
				<?php } ?>

				<div class="form-group">
					<label for="inputNama" class="col-sm-2 control-label">Nama:</label>
					<div class="col-sm-4">
						<input type="text" name="nama" id="inputNama" class="form-control" required="required" maxlength="50" <?php if(isset($_GET['id'])){ ?>value="<?=$d[0]['nama'];?>"<?php } ?>>
					</div>
				</div>

				<div class="form-group">
					<label for="inputNama" class="col-sm-2 control-label">Alamat:</label>
					<div class="col-sm-6">
						<textarea name="alamat" id="inputAlamat" class="form-control" rows="3" required="required"><?php if(isset($_GET['id'])){ echo $d[0]['alamat']; } ?></textarea>
					</div>
				</div>	

				<div class="form-group">
					<label for="inputNama" class="col-sm-2 control-label">Jenis Kelamin:</label>
					<div class="col-sm-10">
						<div class="radio">
							<label>
								<input type="radio" name="jk" id="inputJk" value="L" <?php if(isset($_GET['id'])){ cekbok($d[0]['jk'],'L'); }else{ ?>checked="checked"<?php } ?>>
								Laki-laki
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" name="jk" id="inputJk" value="P" <?php if(isset($_GET['id'])){ cekbok($d[0]['jk'],'P'); }?>>
								Perempuan
							</label>
						</div>
					</div>
				</div>	

				<div class="form-group">
					<label for="inputNama" class="col-sm-2 control-label">Jabatan:</label>
					<div class="col-sm-4">
						<select name="jabatan" id="inputJabatan" class="form-control" required="required">
							<?php
							$db->select('jabatan'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
							$jb = $db->getResult();
							foreach($jb as $jb){
							?>
							<option value="<?=$jb['id'];?>" <?php if(isset($_GET['id'])){ selek($d[0]['jabatan'],$jb['id']); }else{ ?>selected<?php } ?>><?=$jb['nama'];?></option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="input" class="col-sm-2 control-label">Level :</label>
					<div class="col-sm-4">
						<select name="level" id="inputLevel" class="form-control" required="required">
							<?php
							$level = array('Pegawai','Direktur','Admin');
							foreach($level as $level){
							?>
							<option value="<?=$level;?>" <?php if(isset($_GET['id'])){ selek($d[0]['level'],$level); }?>><?=$level;?></option>
							<?php } ?>
						</select>
					</div>
				</div>		

				<div class="form-group">
					<label for="inputUsername" class="col-sm-2 control-label">Username:</label>
					<div class="col-sm-4">
						<input type="text" name="username" id="inputUsername" class="form-control" required="required" maxlength="15" <?php if(isset($_GET['id'])){ ?>value="<?=$d[0]['username'];?>"<?php } ?>>
					</div>
				</div>	

				<div class="form-group">
					<label for="inputPassword" class="col-sm-2 control-label">Password:</label>
					<div class="col-sm-4">
						<input type="password" name="password" id="inputPassword" class="form-control" <?php if(!isset($_GET['id'])){ ?>required="required"<?php } ?> title="">
						<span class='help-block'>Kosongkan jika tidak ingin mengubah password</span>
					</div>
				</div>
			
				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<button type="submit" class="btn btn-primary">Simpan</button>
						<button type="reset" class="btn btn-default">Reset</button>
					</div>
				</div>
			</form>
<?php			
			break;

		case 'hapus':
			echo '<h1 class="page-header">Hapus User</h1>Processing...';
			$id = mysql_real_escape_string($_GET['id']);
			$db->delete('users',"id='$id'");
			$res = $db->getResult();
			eksyen('','?p=user');
			break;
?>			

<?php } ?>	

<?php } ?>	