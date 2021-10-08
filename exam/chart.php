<?php
 include_once 'dbConnection.php';
 session_start();
  if(!(isset($_SESSION['email']))){
header("location:index.php");

}
else
{
$name = $_SESSION['name'];
$email=$_SESSION['email'];
}
?>
<!DOCTYPE HTML>
<html>
<head>
 <meta charset="utf-8">
 <title>TechJunkGigs</title>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <script type="text/javascript">
 google.load("visualization", "1", {packages:["corechart"]});
 google.setOnLoadCallback(drawChart);
 function drawChart() {
 var data = google.visualization.arrayToDataTable([

 ['Title','Score'],
 <?php 
			$query = "SELECT * from history where email = '$email'";

			 $exec = mysqli_query($con,$query);
			 while($row = mysqli_fetch_array($exec)){
$eid=$row['eid'];
$s=$row['score'];
$w=$row['wrong'];
$r=$row['sahi'];
$qa=$row['level'];
$q23=mysqli_query($con,"SELECT title FROM quiz WHERE  eid='$eid' " )or die('Error208');
while($row=mysqli_fetch_array($q23) )
{
$title=$row['title'];
}
			 echo "['".$title."',".$s."],";
			 }
			 ?> 
 
 ]);

 var options = {
 title: 'Distribution of Total Score :',
  is3D : true,
          pieSliceTextStyle: {
            color: 'black',
          },
          legend: {position : 'right'}
 };
 var chart = new google.visualization.PieChart(document.getElementById("columnchart12"));
 chart.draw(data,options);
 }
	

  
	
    </script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {


 
 var data2= google.visualization.arrayToDataTable([

 ['Title','Right','Wrong','Score'],
 <?php 
 $query = "SELECT * from history where email = '$email'";

			 $exec = mysqli_query($con,$query);
			 while($row = mysqli_fetch_array($exec)){
$eid=$row['eid'];
$s=$row['score'];
$w=$row['wrong'];
$r=$row['sahi'];
$qa=$row['level'];
$q23=mysqli_query($con,"SELECT title FROM quiz WHERE  eid='$eid' " )or die('Error208');
while($row=mysqli_fetch_array($q23) )
{
$title=$row['title'];
}
			 echo "['".$title."',".$r.",".$w.",".$s."],";
			 }
			 ?> 
 
 ]);
       var options2 = {
          title: 'Performance',
          hAxis: {title: 'Tests',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0},
          legend : {position : 'bottom'}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data2, options2);
      }
	




</script>
 <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data3 = google.visualization.arrayToDataTable([
          ['Title', 'Aggregate'],
<?php 
			$query = "SELECT * from history where email = '$email'";

			 $exec = mysqli_query($con,$query);
			 while($row = mysqli_fetch_array($exec)){
$eid=$row['eid'];
$s=$row['score'];
$q23=mysqli_query($con,"SELECT * FROM quiz WHERE  eid='$eid' " )or die('Error208');
while($row2=mysqli_fetch_array($q23) )
{
$title=$row2['title'];
$r=$row2['sahi'];
$t=$row2['total'];
}
            $temp=($s*100)/($r*$t);
            $agg=round($temp);
			 echo "['".$title."',".$agg."],";
			 }
			 ?> 
 
        ]);

        var options3 = {
          title: 'Test-Aggregate Performance Chart',
          curveType: 'function',
          legend: { position: 'right' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data3, options3);
      }
    </script>

</head>
<body>
<div class="container-fluid jumbotron">
<div id="curve_chart" style="width: 100%; height: 500px"></div></div>
 <div class="container-fluid jumbotron">
 <div id="columnchart12" style="width: 100%; height: 500px;"></div>
 </div>
 <div class="container-fluid jumbotron">
 <div id="chart_div" style="width: 100%; height: 500px;"></div>
 </div>

</body>
</html>