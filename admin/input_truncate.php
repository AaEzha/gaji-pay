<?php error_reporting(0);
include '../_db.php';

$db = new Database();
$db->connect();

$db->sql("truncate absen");
$db->sql("truncate hitung");
$db->sql("truncate gaji");

eksyen('','index.php');
?>