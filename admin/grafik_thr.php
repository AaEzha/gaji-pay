<?php
if(isset($_POST['tahun'])){
	$tahun = $db->escapeString($_POST['tahun']);
	$sql = "select tahun from gaji where tipe='THR' and tahun='$tahun' group by tahun";
	$tipe = "Periode $tahun";
}else{
	$sql = "select tahun from gaji where tipe='THR' group by tahun";
	$tipe = "Seluruh Data";
}
?>
<div class="col-lg-12">
    <h1 class="page-header">Grafik THR <small><?=$tipe;?></small></h1>
</div>
<form action="" method="POST" class="form-inline page-header" role="form">

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
	<a href="?p=grafik_gaji" class="btn btn-default">Refresh</a>
</form>
<div id="myChart" style="height: 250px;"></div>

<script>
	new Morris.Bar({
	  // ID of the element in which to draw the chart.
	  element: 'myChart',
	  // Chart data records -- each entry in this array corresponds to a point on
	  // the chart.
	  data: [
	    // { year: '2008', value: 20 },
	    //{ year: 'Januari 2016', value: 27125000 },
		//{ year: 'Februari 2016', value: 27125000 },
	    <?php
		    $qt = mysql_query($sql);
		    while($dt = mysql_fetch_array($qt)){
		    	$qb = mysql_query("select bulan from gaji where tipe='THR' and tahun='".$dt['tahun']."' group by bulan");
		    	while($dbl = mysql_fetch_array($qb)){
		    		$q = mysql_query("select sum(total) as total from gaji where tipe='THR' and tahun='".$dt['tahun']."'");
		    		while($d = mysql_fetch_array($q)){
		    			echo "{ year: '".prosesgaji($dt['tahun']."-".$dbl['bulan'])."', value: ".$d['total']." },\n";
		    			//echo "{ year: '".$dbl['bulan']."', value: ".$d['total']." },\n";
		    		}
		    	}
		    }
	    ?>
	  ],
	  // The name of the data record attribute that contains x-values.
	  xkey: 'year',
	  // A list of names of data record attributes that contain y-values.
	  ykeys: ['value'],
	  // Labels for the ykeys -- will be displayed when you hover over the
	  // chart.
	  labels: ['Value']
	});
</script>

