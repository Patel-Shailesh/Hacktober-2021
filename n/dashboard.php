<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Dashboard</title>
	<link  rel="stylesheet" href="css/bootstrap.min.css"/>
 	<link  rel="stylesheet" href="css/bootstrap.rtl.min.css"/>    
 	<!-- <link rel="stylesheet" href="css/main.css">
 	<link  rel="stylesheet" href="css/font.css"> -->
 	<script src="js/jquery-3.5.1.min.js" type="text/javascript"></script>
 	<script src="js/bootstrap.bundle.min.js"  type="text/javascript"></script>
<style>
	table, th,  td {
  border: 1px solid black;
  border-collapse: collapse;
}
	
	.panel{
		align-items: center;
	}
	.selfrow{
		background-color:  #99cc32;
	}
	.answer{
		background-color: green;
	}
	.table{
		margin: 3% 3%;
		width: 94%;
		text-align: center;
	}
	
</style>
<script>
function validateForm() {var y = document.forms["form"]["name"].value;  var letters = /^[A-Za-z]+$/;if (y == null || y == "") {alert("Name must be filled out.");return false;}var z =document.forms["form"]["sub"].value;if (z == null || z == "") {alert("Subject must be filled out.");return false;}var x=document.forms["form"]["tq"].value;if (x == null || x == "") {alert("Number of Questions must be filled out.");return false;}}
</script>
<body>
	<table width="50%"><tr><th><a href="dashboard.php?q=1">1</a></th><th><a href="dashboard.php?q=2">2</a></th><th><a href="dashboard.php?q=3">3</a></th><th><a href="dashboard.php?q=4">4</a></th></tr></table>
<?php
include_once 'dbConnection.php';

function hcount($b,$con,$z)
{
	if($z==1)
	{
		$res = mysqli_query($con,"SELECT * FROM testlog WHERE tid='$b'") or die('Errord');
		$cnt=mysqli_num_rows($res);
		return $cnt;
	}
	if($z==2)
	{
		$res = mysqli_query($con,"SELECT * FROM anslog WHERE tid='$b' and eval='No'") or die('Errord');
		$cnt=mysqli_num_rows($res);
		return $cnt;
	}
}
function agg($p,$q)
{	if($q==0)return 0;
	$out = round(($p/$q)*100,2);
	return $out;
}
//$q=mysqli_query($con,"INSERT INTO `user` (`uid`, `fname`, `lname`, `mail`, `pass`, `role`, `mob`, `verified`) VALUES (NULL, 'b', 'd', 'user2@gmail.com', 'user2', 'Admin', '787878778', 'Yes');");
//if($q)
session_start();
if(isset($_SESSION["id"])) {
	$id=$_SESSION["id"];
	$result = mysqli_query($con,"SELECT * FROM user WHERE uid = '$id'") or die('Errord');
	$count=mysqli_num_rows($result);
	if($count==1){
	while($row = mysqli_fetch_array($result)) {
	$name = $row['name'];
	$role = $row['role'];
	$v = $row['verified'];
		}
	if($v == 'No'){
		session_destroy();
		header("location:index.php?w=Account Not Verified");
	}
	}


	if($role == "Admin"){

		if(@$_GET['q']==1)
		{

			$result = mysqli_query($con,"SELECT * FROM user where not uid = '$id'") or die('Error');
			echo  '<div class="panel"><table class="table table-striped title1">
			<tr><th><b>S.N.</b></th><th><b>Name</b></th><th><b>Email</b></th><th><b>Role</b></th><th><b>Mobile</b></th><th><b>Verified?</b></th><th><b>Modify</b></th><th><b>Delete</b></th></tr>';
			$c=1;
			while($row = mysqli_fetch_array($result)) {
				$uid = $row['uid'];
				$uname = $row['name'];
				$email = $row['email'];
				$urole = $row['role'];
			 	$mob = $row['mob'];
			    $ver = $row['verified'];
			
			
			echo '<tr style="color:#99cc32"><th>'.$c++.'</th><td>'.$uname.'&nbsp;</td><td>'.$email.'</td><td>'.$urole.'</td><td>'.$mob.'</td><td>'.$ver;
			if($ver == "No")echo '<form method="post" action="update.php?u=dashboard.php?q=1"><button type="submit" name="button1"  value="'.$uid.'">Verify</button></form></td> ';
			if($urole == "Admin")
			{
				echo '<td><form method="post" action="update.php?u=dashboard.php?q=1"><button type="submit" name="button2"  value="'.$uid.'">Modify</button></form> </td><td><form method="post" action="update.php?u=dashboard.php?q=1"><button type="submit" name="deny" value="Deny">Delete</button></td></tr>';

			}else
			{
				echo '<td><form method="post" action="update.php?u=dashboard.php?q=1"><button type="submit" name="button2"  value="'.$uid.'">Modify</button></form> </td><td><form method="post" action="update.php?u=dashboard.php?q=1"><button type="submit" name="button3"  value="'.$uid.'">Delete</button></form> </td></tr>';
			}
			
			// if(isset($_POST['button1'])) { 
			// 	$x = $_POST['button1'];
			// 	$q=mysqli_query($con,"UPDATE `user` SET `verified` = 'Yes' WHERE `user`.`uid` = $x ")or die('Error124');
				
   //      	} 
			}
			
			$c=0;
			echo '</table></div>';

		}else if(@$_GET['q']==2)
		{
			


			if(isset($_POST['button12'])) 
			{ 
				
				$x= $_POST['button12'];
				$result2 = mysqli_query($con,"SELECT * FROM question where tid='$x' ") or die('Error');
				echo  '<div class="panel"><table width="100%" class="table table-striped title1">';
				$c=1;
				while($row = mysqli_fetch_array($result2))
				{
					$qid = $row['qid'];
					$qtext = $row['qtext'];
					$qtype = $row['qtype'];
					$ans = $row['ans'];
				 	$tans = $row['tans'];
				    $pve = $row['pve'];
					$nve = $row['nve'];
					echo '<tr style="border:#99cc32"><th>'.$c++.'.</th><td></td><td>'.$qtype.'&nbsp;</td><td>+'.$pve.'&nbsp;</td><td>-'.$nve.'&nbsp;</td></tr><tr><td></td><td colspan="4">'.$qtext.'&nbsp;</td></tr>';

					if($qtype == 'MCQ')
					{
						echo '<tr ';
						if($ans == 'a')echo 'class = "answer"';
						echo '><td>A.</td><td colspan="4">'.$row['oa'].'</td></tr><tr ';
						if($ans == 'b')echo 'class = "answer"';
						echo '><td>B.</td><td colspan="4">'.$row['ob'].'</td></tr><tr ';
						if($ans == 'c')echo 'class = "answer"';
						echo '><td>C.</td><td colspan="4">'.$row['oc'].'</td></tr><tr ';
						if($ans == 'd')echo 'class = "answer"';
						echo '><td>D.</td><td colspan="4">'.$row['od'].'</td></tr>';
					}else
					{
						echo '<tr><td></td><td></td><td colspan="4">'.$tans.'</td></tr>';
					}
					echo '<tr><td colspan="5">&nbsp;</td></tr>';

				}
			}else
			if(isset($_POST['button11'])) 
			{ 
				
				$x= $_POST['button11'];
				$result2 = mysqli_query($con,"SELECT * FROM testlog where tid='$x' order by marks desc") or die('Error');
				echo  '<div class="panel"><table width="100%" class="table table-striped title1"><tr><th><strong>S.N.</strong></th><th><strong>Name</strong></th><th><strong>Email</strong></th><th><strong>Marks Obtained</strong></th><th><strong>Total Marks</strong></th><th><strong>Percentage</strong></th></tr>';
				$c=1;
				while($row = mysqli_fetch_array($result2))
				{
					$uid = $row['uid'];
					$marks = $row['marks'];
					$tmarks = $row['tmarks'];
					$result3 = mysqli_query($con,"SELECT * FROM user where uid='$uid'") or die('Error');
					$row2 = mysqli_fetch_array($result3);
					$name = $row2['name'];
					$mail = $row2['email'];
					echo '<tr><th>'.$c++.'</th><td>'.$name.'</td><td>'.$mail.'</td><td>'.$marks.'</td><td>'.$tmarks.'</td><td>'.agg($marks,$tmarks).'</td></tr>';
				}
				$c=0;
				echo '</table></div>';

					
				
			}else
			{

				$result = mysqli_query($con,"SELECT * FROM test ") or die('Error');
				echo  '<div class="panel"><table width="100%" class="table table-striped title1">
				<tr><th><b>S.N.</b></th><th><b>Name</b></th><th><b>Subject</b></th><th><b>Created By</b></th><th><b>Total Question</b></th><th><b>Total Time</b></th><th><b>Start Time</b></th><th><b>End Time</b></th><th><b>No. of Students Appeared</b></th><th><b>View</b></th></tr>';
				$c=1;
				while($row = mysqli_fetch_array($result)) {
					$tid = $row['tid'];
					$tname = $row['tname'];
					$sub = $row['sub'];
					$totalq = $row['totalq'];
					$st = $row['stime'];
				 	$et = $row['etime'];
				    $time = $row['time'];
					$cid = $row['cid'];
					$result1 = mysqli_query($con,"SELECT * FROM user where uid = '$cid'") or die('Error');
					$row1 = mysqli_fetch_array($result1);
					$cname = $row1['name'];
				echo '<tr style="color:#99cc32"><th>'.$c++.'</th><td>'.$tname.'&nbsp;</td><td>'.$sub.'</td><td>'.$cname.'</td><td>'.$totalq.'</td><td>'.$time.'&nbsp;</td><td>'.$st.'&nbsp;</td><form method="post" action="dashboard.php?q=2"><td>'.$et.'&nbsp;</td><td><button name="button11" type="submit" value = "'.$tid.'">'.hcount($tid,$con,1).'</td><td><button name="button12" type="submit" value = "'.$tid.'">View</button></td></form></tr>';
					}




			}
			
			$c=0;
			echo '</table></div>';
		}else if(@$_GET['q']==3)
		{
			$result = mysqli_query($con,"SELECT * FROM feedback order by fid desc") or die('Error');
			echo  '<div class="panel"><table width="100%" class="table table-striped title1">';
			$c=1;
			while($row = mysqli_fetch_array($result)) {
				$uname = $row['name'];
				$email = $row['mail'];
				$sub = $row['sub'];
			 	$text = $row['text'];
			    $time = $row['time'];
			
			
			echo '<tr><th>'.$c++.'.</th><td>'.$uname.'</td><td>'.$email.'</td><td>'.$time.'</td></tr><tr><td></td><td><strong>Subject :</strong></td><td colspan="2">'.$sub.'</td><tr><td></td><td><strong>Text :</strong></td><td colspan="2">'.$text.'</td></tr><tr><td colspan="4">&nbsp;</td></tr>';
			}
			$c=0;
			echo '</table></div>';
		}else if(@$_GET['q']==4)
		{
			include 'rank.php';
			$result = mysqli_query($con,"SELECT * FROM user u,rank r where u.uid = r.uid order by agg desc") or die('Error');
			echo  '<div class="panel"><table width="100%" class="table table-striped title1"><tr><th>Rank</th><th>Name</th><th>Obtained Marks</th><th>Total Marks</th><th>Percent</th></tr>';
			$c=1;
			while($row = mysqli_fetch_array($result)) {
				$uname = $row['name'];
				$obt = $row['obtained'];
			 	$total = $row['total'];
			    $agg = $row['agg'];
			echo '<tr><td>'.$c++.'.</td><td>'.$uname.'</td><td>'.$obt.'</td><td>'.$total.'</td><td>'.round($agg,4).'</td></tr>';
			}
			$c=0;
			echo '</table></div>';
		}

		
	}else if($role == "Teacher"){

		if(@$_GET['q']==1)
		{
				if(isset($_POST['button13'])) 
				{ 
					
					$x= $_POST['button13'];
					$result2 = mysqli_query($con,"SELECT * FROM question where tid='$x' ") or die('Error');
					echo  '<div class="panel"><table width="100%" class="table table-striped title1">';
					$c=1;
					while($row = mysqli_fetch_array($result2))
					{
						$qid = $row['qid'];
						$qtext = $row['qtext'];
						$qtype = $row['qtype'];
						$ans = $row['ans'];
					 	$tans = $row['tans'];
					    $pve = $row['pve'];
						$nve = $row['nve'];
						echo '<tr style="border:#99cc32"><th>'.$c++.'.</th><td></td><td>'.$qtype.'&nbsp;</td><td>&nbsp;</td><td>+'.$pve.'&nbsp;</td><td>-'.$nve.'&nbsp;</td></tr><tr><td></td><td colspan="5">'.$qtext.'&nbsp;</td></tr>';

						if($qtype == 'MCQ')
						{
								echo '<tr ';
								if($ans == 'a')echo 'class = "answer"';
								echo '><td>A.</td><td colspan="4">'.$row['oa'].'</td></tr><tr ';
								if($ans == 'b')echo 'class = "answer"';
								echo '><td>B.</td><td colspan="4">'.$row['ob'].'</td></tr><tr ';
								if($ans == 'c')echo 'class = "answer"';
								echo '><td>C.</td><td colspan="4">'.$row['oc'].'</td></tr><tr ';
								if($ans == 'd')echo 'class = "answer"';
								echo '><td>D.</td><td colspan="4">'.$row['od'].'</td></tr>';
						}else
						{
							echo '<tr><td></td><td></td><td colspan="5">'.$tans.'</td></tr>';
						}
						echo '<tr><td colspan="6">&nbsp;</td></tr>';

					}
				}else
				if(isset($_POST['button14'])) 
				{ 
					
					$x= $_POST['button14'];
					$result2 = mysqli_query($con,"SELECT * FROM testlog where tid='$x' order by marks desc") or die('Error');
					echo  '<div class="panel"><table width="100%" class="table table-striped title1"><tr><th><strong>S.N.</strong></th><th><strong>Name</strong></th><th><strong>Email</strong></th><th><strong>Marks Obtained</strong></th><th><strong>Total Marks</strong></th><th><strong>Percentage</strong></th></tr>';
					$c=1;
					while($row = mysqli_fetch_array($result2))
					{
						$uid = $row['uid'];
						$marks = $row['marks'];
						$tmarks = $row['tmarks'];
						$result3 = mysqli_query($con,"SELECT * FROM user where uid='$uid'") or die('Error');
						$row2 = mysqli_fetch_array($result3);
						$name = $row2['name'];
						$mail = $row2['email'];
						echo '<tr><th>'.$c++.'</th><td>'.$name.'</td><td>'.$mail.'</td><td>'.$marks.'</td><td>'.$tmarks.'</td><td>'.agg($marks,$tmarks).'</td></tr>';
					}
					$c=0;
					echo '</table></div>';

						
					
				}else
				{

					$result = mysqli_query($con,"SELECT * FROM test where cid = '$id' ") or die('Error');
					echo  '<div class="panel"><table width="100%" class="table table-striped title1">
					<tr><th><b>S.N.</b></th><th><b>Name</b></th><th><b>Subject</b></th><th><b>Total Question</b></th><th><b>Test Duration</b></th><th><b>Start Time</b></th><th><b>End Time</b></th><th><b>No. of Students Appeared</b></th><th><b>View</b></th></tr>';
					$c=1;
					while($row = mysqli_fetch_array($result)) {
						$tid = $row['tid'];
						$tname = $row['tname'];
						$sub = $row['sub'];
						$totalq = $row['totalq'];
						$st = $row['stime'];
					 	$et = $row['etime'];
					    $time = $row['time'];
						
					echo '<tr style="color:#99cc32"><th>'.$c++.'</th><td>'.$tname.'&nbsp;</td><td>'.$sub.'</td><td>'.$totalq.'</td><td>'.$time.'&nbsp;</td><td>'.$st.'&nbsp;</td><form method="post" action="dashboard.php?q=1"><td>'.$et.'&nbsp;</td><td><button name="button14" type="submit" value = "'.$tid.'">'.hcount($tid,$con,1).'</td><td><button name="button13" type="submit" value = "'.$tid.'">View</button></td></form></tr>';
						}

					$c=0;
					echo '</table></div>';


				}
		}if(@$_GET['q']==2)
		{
?>

<!-- HTML BEGINS -->
			<form name="form" action="update.php?q=1" onSubmit="return validateForm()" method="POST">
				<input type = "text" name="name" id="name" placeholder="Enter Test Name"><br>
				<input type = "text" name="sub" id="sub" placeholder="Enter Subject Name"><br>
				<input type = "number" name="tq" id="tq" min="1" placeholder="Total Number of Questions"><br>
				<input type = "datetime-local" name="stime" id="stime" placeholder="Start Time"><br>
				<input type = "datetime-local" name="etime" id="etime" placeholder="End Time"><br>
				<input type = "number" name="time" id="time" step = "5" min = "5" placeholder="Test Duration (in Minutes)"><br>

<!-- HTML ENDS -->
<?php	
			echo '<button type="submit" name="button15" value="'.$id.'">Submit</button></form>';





		}if(@$_GET['q']==3)
		{
				
				if(isset($_POST['button16'])) 
				{ 
					
					$x= $_POST['button16'];
					$result1 = mysqli_query($con,"SELECT * FROM anslog where tid='$x' and eval='No'") or die('Error');
					echo  '<div class="panel"><table width="100%" class="table table-striped title1"><tr><th><strong>S.N.</strong></th><th><strong>Name</strong></th><th><strong>Question</strong></th><th><strong>Answer by  Student</strong></th><th><strong>Actual Answer</strong></th><th><strong>Marks</strong></th><th><strong>Submit</strong></th></tr>';
					$c=1;
					while($row = mysqli_fetch_array($result1))
					{
						$hid = $row['hid'];
						$qid = $row['qid'];
						$pans = $row['txtans'];
						$qmarks = $row['qmark'];
						$result2 = mysqli_query($con,"SELECT * FROM testlog where hid='$hid'") or die('Error');
						$row2 = mysqli_fetch_array($result2);
						$uid = $row2['uid'];
						$result3 = mysqli_query($con,"SELECT * FROM user where uid='$uid'") or die('Error');
						$row3 = mysqli_fetch_array($result3);
						$result4 = mysqli_query($con,"SELECT * FROM question where qid='$qid'") or die('Error');
						$row4 = mysqli_fetch_array($result4);
						$qtext = $row4['qtext'];
						$tans = $row4['tans'];
						$name = $row3['name'];
						echo '<tr><th>'.$c++.'</th><td>'.$name.'</td><td>'.$qtext.'</td><td>'.$pans.'</td><td>'.$tans.'</td><form action="update.php?q=5" method="POST"><td><input type="hidden" name="qmarks" value="'.$qmarks.'"><input type="hidden" name="qid" value="'.$qid.'"><input type="number" name="marks" min="0">/'.$qmarks.'</td><td><button type="submit" name="button17" value="'.$hid.'">Submit</button></td></tr>';
					}
					$c=0;
					echo '</table></div>';

						
					
				}else
				{

					$result = mysqli_query($con,"SELECT * FROM test where cid = '$id' ") or die('Error');
					echo  '<div class="panel"><table width="100%" class="table table-striped title1">
					<tr><th><b>S.N.</b></th><th><b>Name</b></th><th><b>Subject</b></th><th><b>Total Question</b></th><th><b>Test Duration</b></th><th><b>Start Time</b></th><th><b>End Time</b></th><th><b>Unevaluated</b></th></tr>';
					$c=1;
					while($row = mysqli_fetch_array($result)) {
						$tid = $row['tid'];
						$tname = $row['tname'];
						$sub = $row['sub'];
						$totalq = $row['totalq'];
						$st = $row['stime'];
					 	$et = $row['etime'];
					    $time = $row['time'];
						$cid = $row['cid'];
						$result1 = mysqli_query($con,"SELECT * FROM user where uid = '$cid'") or die('Error');
						$row1 = mysqli_fetch_array($result1);
						$cname = $row1['name'];
					echo '<tr style="color:#99cc32"><th>'.$c++.'</th><td>'.$tname.'&nbsp;</td><td>'.$sub.'</td><td>'.$totalq.'</td><td>'.$time.'&nbsp;</td><td>'.$st.'&nbsp;</td><form method="post" action="dashboard.php?q=3"><td>'.$et.'&nbsp;</td><td><button name="button16" type="submit" value = "'.$tid.'">'.hcount($tid,$con,2).'</td></form></tr>';
						}

					$c=0;
					echo '</table></div>';





				}
		}else if(@$_GET['q']==4)
		{
			include 'rank.php';
			$result = mysqli_query($con,"SELECT * FROM user u,rank r where u.uid = r.uid order by agg desc") or die('Error');
			echo  '<div class="panel"><table width="100%" class="table table-striped title1"><tr><th>Rank</th><th>Name</th><th>Obtained Marks</th><th>Total Marks</th><th>Percent</th></tr>';
			$c=1;
			while($row = mysqli_fetch_array($result)) {
				$uname = $row['name'];
				$obt = $row['obtained'];
			 	$total = $row['total'];
			    $agg = $row['agg'];
			echo '<tr><th>'.$c++.'.</th><td>'.$uname.'</td><td>'.$obt.'</td><td>'.$total.'</td><td>'.round($agg,4).'</td></tr>';
			}
			$c=0;
			echo '</table></div>';
		}
	

	}else if($role == "Student"){

			if(@$_GET['q']==1)
			{
					$result = mysqli_query($con,"SELECT * FROM test") or die('Error');
					echo  '<div class="panel"><table width="100%" class="table table-striped title1">
					<tr><th><b>S.N.</b></th><th><b>Name</b></th><th><b>Subject</b></th><th><b>Total Question</b></th><th><b>Test Duration</b></th><th><b>Start Time</b></th><th><b>End Time</b></th><th><b>Test Link</b></th></tr>';
					$c=1;
					while($row = mysqli_fetch_array($result)) 
					{
						$tid = $row['tid'];
						$tname = $row['tname'];
						$sub = $row['sub'];
						$totalq = $row['totalq'];
						$st = $row['stime'];
					 	$et = $row['etime'];
					    $time = $row['time'];
						$cid = $row['cid'];
						$result1 = mysqli_query($con,"SELECT * FROM testlog where uid = '$id' and tid = '$tid'") or die('Error');
						$count=mysqli_num_rows($result1);
						$sts = strtotime($st);
						$ets = strtotime($et);
						$ctime= time() + 19800;
						if(($count==0) and ($ets>$ctime))
						{
							echo '<tr style="color:#99cc32"><th>'.$c++.'</th><td>'.$tname.'&nbsp;</td><td>'.$sub.'</td><td>'.$totalq.'</td><td>'.$time.'&nbsp;</td><td>'.$st.'&nbsp;</td><form method="post" action="update.php?q=1"><input type="hidden" name="uid" value="'.$id.'"><td>'.$et.'&nbsp;</td>';
							if($sts<$ctime){echo '<td><input type="hidden" name="ttime" value = "'.$time.'"><button name="button21" type="submit" value = "'.$tid.'">Start</button></td></form></tr>';}
							else {echo '<td>Yet to Start</td></form></tr>';}
						}
					
					}

					$c=0;
					echo '</table></div>';
			}else
			if(@$_GET['q']==2)
			{
					$result = mysqli_query($con,"SELECT * FROM test") or die('Error');
					echo  '<div class="panel"><table width="100%" class="table table-striped title1">
					<tr><th><b>S.N.</b></th><th><b>Name</b></th><th><b>Subject</b></th><th><b>Total Question</b></th><th><b>Marks Obtained</b></th><th><b>Total Marks</b></th><th><b>Percentage</b></th></tr>';
					$c=1;
					while($row = mysqli_fetch_array($result)) 
					{
						$tid = $row['tid'];
						$tname = $row['tname'];
						$sub = $row['sub'];
						$totalq = $row['totalq'];
						$cid = $row['cid'];
						$result1 = mysqli_query($con,"SELECT * FROM testlog where uid = '$id' and tid = '$tid'");
						$count=mysqli_num_rows($result1);
						
						if($count>=1)
						{	
							$row2=mysqli_fetch_array($result1);
							$marks= $row2['marks'];
							$tmarks= $row2['tmarks'];
							echo '<tr style="color:#99cc32"><th>'.$c++.'</th><td>'.$tname.'&nbsp;</td><td>'.$sub.'</td><td>'.$totalq.'</td><td>'.$marks.'&nbsp;</td><td>'.$tmarks.'&nbsp;</td><td>'.agg($marks,$tmarks).'&nbsp;</td></tr>';
						}
					
					}

					$c=0;
					echo '</table></div>';
			}else if(@$_GET['q']==3)
			{
				include 'rank.php';
				$result = mysqli_query($con,"SELECT * FROM user u,rank r where u.uid = r.uid order by agg desc") or die('Error');
				echo  '<div class="panel"><table width="100%" class="table table-striped title1"><tr><th>Rank</th><th>Name</th><th>Obtained Marks</th><th>Total Marks</th><th>Percent</th></tr>';
				$c=1;
				while($row = mysqli_fetch_array($result)) {
					$uname = $row['name'];
					$uid = $row['uid'];
					$obt = $row['obtained'];
				 	$total = $row['total'];
				    $agg = $row['agg'];
				if($id==$uid)
				{
					echo '<tr class="selfrow">';
				}else
				{
					echo '<tr>';
				}
				echo '<th>'.$c++.'.</th><td>'.$uname.'</td><td>'.$obt.'</td><td>'.$total.'</td><td>'.round($agg,4).'</td></tr>';
				}
				$c=0;
				echo '</table></div>';
			}
			if(@$_GET['e']==1)
			{
?>
<script>
	var a = alert("Time Over! Test Submitted!");
</script>
<?php

			}


	}



}else{

	header("location:index.php#login");
}

?>

<html>
<body>


	
</body>


</html>





