<?php error_reporting(0);
include '../_db.php';

$db = new Database();
$db->connect();

$db->insert('users',array('username'=>'elya','password'=>'7fff34dae3e0516a76f363aff7c35fd6','level'=>'Admin','jabatan'=>'ec88883d-9a20-11e5-b977-843497738d6e','nama'=>'Elya','alamat'=>'Tangerang','jk'=>'P','buat'=>wkt()));
$db->insert('users',array('username'=>'direktur','password'=>'4fbfd324f5ffcdff5dbf6f019b02eca8','level'=>'Direktur','jabatan'=>'48db2ca3-9a20-11e5-b977-843497738d6e','nama'=>'Direktur','alamat'=>'Rumahnya Direktur','jk'=>'L','buat'=>wkt()));

for($i=1;$i<=5;$i++){
	$db->insert('users',array('username'=>'user'.$i,'password'=>md5('user'.$i),'level'=>'Pegawai','jabatan'=>'837e5248-9a23-11e5-b977-843497738d6e','nama'=>'Pegawai '.$i,'alamat'=>'Tangerang no.'.$i,'jk'=>'L','buat'=>wkt()));
}

eksyen('','index.php?p=user');
?>