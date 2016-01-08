<?php
define("TITLE", "PT. Sri Rejeki Fertilizer");
date_default_timezone_set("Asia/Jakarta");

function konvert($tabel,$id,$kolom){
	$q = mysql_query("select $kolom from $tabel where id='$id'");
	$d = mysql_fetch_array($q);
	return $d[$kolom];
}

function id(){
	$q = mysql_query("select uuid() as id");
	$d = mysql_fetch_array($q);
	return $d['id'];
}

function wkt(){
	$q = mysql_query("select now() as id");
	$d = mysql_fetch_array($q);
	return $d['id'];
}

function prosesgaji($tgl){
	$a = explode("-", $tgl);
	$arbulan = array('01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember');
	$bulan = $a[1];
	$tahun = $a[0];

	return $arbulan[$bulan]. " ". $tahun;
}

function cekmasuk($tanggal,$jam){
	$val1 = "$tanggal $jam";
	$val2 = "$tanggal 08:45:00";
	$datetime1 = new DateTime($val1);
	$datetime2 = new DateTime($val2);
	if($datetime1 > $datetime2)
	  return "te"; 		// telat
	else
	  return "checked"; // tidak telat
}

function cekkeluar($tanggal,$jam){
	$val1 = "$tanggal $jam";
	$val2 = "$tanggal 17:00:00";
	$datetime1 = new DateTime($val1);
	$datetime2 = new DateTime($val2);
	if($datetime1 > $datetime2)
	  return "checked"; // tidak telat
	else
	  return "te"; // telat
}

function sesi($grup){
	if($_SESSION['grup'] != $grup){
		echo '<script>window.location.assign("inside.php");</script>';
	}
}

function cekbok($a,$b){
	if($a==$b){
		echo "checked";
	}
}

function selek($a,$b){
	if($a==$b){
		echo "selected";
	}
}

function angka(){
	echo 'onkeypress="return isNumber(event)"';
}

function yakin(){
	echo "onClick=\"return confirm('Apakah Anda yakin akan melakukan aksi ini?');\" ";
}

function eksyen($teks=false,$tujuan){ // buat pindah halaman
	if($teks){
		die("<script>alert('$teks');</script><script>window.location.assign('$tujuan');</script>");
	}else{
		die("<script>window.location.assign('$tujuan');</script>");
	}
}

function tbl_ubah($url){
	echo '<a href="'.$url.'" class="btn btn-info btn-xs" alt="ubah" title="ubah"><i class="fa fa-edit fa-fw"></i></a>';
}

function tbl_hapus($url){
	echo '<a href="'.$url.'" class="btn btn-danger btn-xs" onClick="return confirm(\'Apakah Anda yakin akan melakukan aksi ini?\')"  alt="hapus" title="hapus"><i class="fa fa-trash-o fa-fw"></i></a>';
}

function tanggal($tgl){
	$date = new DateTime($tgl);
	return $date->format('D, d M Y');	// ('D, d M Y H:i:s');
}

function jam($tgl){
	$date = new DateTime($tgl);
	return $date->format('H:i:s');	// ('D, d M Y H:i:s');
}

function TanggalIndo($date){
	$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
 
	$tahun = substr($date, 0, 4);
	$bulan = substr($date, 5, 2);
	$tgl   = substr($date, 8, 2);
 
	$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;		
	return($result);
}

function time_ago( $date )
{
    if( empty( $date ) )
    {
        return "No date provided";
    }

    $periods = array("detik", "menit", "jam", "hari", "minggu", "bulan", "tahun", "dekade");

    $lengths = array("60","60","24","7","4.35","12","10");

    $now = time();

    $unix_date = strtotime( $date );

    // check validity of date

    if( empty( $unix_date ) )
    {
        return "Bad date";
    }

    // is it future date or past date

    if( $now > $unix_date )
    {
        $difference = $now - $unix_date;
        $tense = "yang lalu";
    }
    else
    {
        $difference = $unix_date - $now;
        $tense = "dari sekarang";
    }

    for( $j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++ )
    {
        $difference /= $lengths[$j];
    }

    $difference = round( $difference );

    if( $difference != 1 )
    {
        //$periods[$j].= "s";
        $periods[$j].= "";
    }

    return "$difference $periods[$j] {$tense}";
}