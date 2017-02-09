<?php 
@session_start();
require_once("conn.php");

$sql="SELECT * FROM `gc_log` WHERE from_unixtime(`date`,'%Y-%m-%d') =curdate()";
$res = mysql_query($sql) or mysql_error();

$row = mysql_fetch_row($res);
$num_row = mysql_num_rows($res);
echo "<strong>Number of clicks for today - ".$num_row."</strong>";
$out="";
$vendor="";
$sql="SELECT count(*), from_unixtime(`date`,'%d-%m-%Y') FROM `gc_log` WHERE from_unixtime(`date`,'%m') = month(curdate()) and from_unixtime(`date`,'%Y') = year(curdate()) group by from_unixtime(`date`,'%d-%m-%Y') order by log_id asc";

$res = mysql_query($sql) or die(mysql_error());
echo "<br><br>";
while($row = mysql_fetch_row($res))
{	
	$out .= "['".$row[1]."', ".$row[0]."],";
}
$sql="SELECT count(*), vendor FROM `gc_log` WHERE from_unixtime(`date`,'%m') = month(curdate()) and from_unixtime(`date`,'%Y') = year(curdate()) group by vendor order by vendor asc";
$res = mysql_query($sql) or die(mysql_error());
while($row = mysql_fetch_row($res))
{	
	
	$vendor .= "['".$vendor_name[$row[1]]."', ".$row[0]."],";
}
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Date', 'Clicks'],
          
		  <?php 

		echo substr($out,0,-1);
		  ?>
        ]);

        var options = {
          title: 'Clicks Performance'
		  //curveType: 'function',
		 // legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

        chart.draw(data, options);
      }
    </script>
	
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Vendor', 'Clicks'],
          <?php   

			echo substr($vendor,0,-1);
		  ?> 
        ]);

        var options = {
          title: 'Click according to vendor',
		  is3D: true,
		  pieStartAngle: 100,
		  slices: { 
                    1: {offset: 0.2},
                    2: {offset: 0.5},
                    3: {offset: 0.3},
                    
          },
		 // pieHole: 0.4
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
  
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>