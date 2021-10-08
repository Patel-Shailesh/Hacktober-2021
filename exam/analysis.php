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

?>
<!DOCTYPE html>

<html>

  <head>

   <title>Pie Chart Demo - PHPCluster</title>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    </head>

  <body>

    <div id="piechart" style="width: 900px; height: 500px;"></div>

<?php

                   include_once 'dbConnection.php';

              

               //query to get record from db

                 $query = "SELECT q.title, h.score FROM history h,quiz q WHERE h.email=$email AND h.eid = q.eid ";

                $result = mysqli_query($con,$query);
                             //get no of rows

                $rows_count = mysqli_num_rows($result);            if($rows_count>0):

                ?>

                <script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});

      google.charts.setOnLoadCallback(drawChart);

 function drawChart() {

var data = google.visualization.arrayToDataTable([

          ['Coding', 'Hours per Day'],

         <?php

                                 foreach($result as $info){

                                 extract($info);

                                 echo  "['$name', $value],";

         }  ?>

        ]);

  var options = {

          title: 'My Daily Coding Activities'

        };

 var chart = new google.visualization.PieChart(document.getElementById('piechart'));

chart.draw(data, options);

      }

    </script>

  <?php endif; ?>

  </body>

</html>
