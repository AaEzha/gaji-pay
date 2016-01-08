<?php
include "../db_connection.php"; 
$id = $_GET['f'];
$q = mysql_query("select * from institute where GUID='$id'");
$d = mysql_fetch_array($q);
header("Content-Type:" . $d['MOU_MIME']);
echo $d['MOU'];
?>