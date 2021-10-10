<?php
include_once 'dbConnection.php';
?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<title>Colleges</title>
	</head>
	<body>
		<div align="center">
			<h1>College</h1>
			<form method="post" action="add.php?q=index.php">
				<input type="text" name="Name" placeholder="Name" id="Name">
				<input type="text" name="Sname" placeholder="Short Name" id="sname">
				<input type="text" name="City" placeholder="City" id="City">
	    		<input type="text" name="State" placeholder="State" id="State">
	    		<input type="hidden" name="ind1" id="ind1" value="1">
	    		<button type="submit" name="submit" id="submit">Submit</button>
			</form>	
		</div>
		<hr>
		<div align="center">
			<h1>Program</h1>
			<form method="post" action="add.php?q=index.php">
				<select placeholder="College" name="college" id="college">
				<?php 
					$q=mysqli_query($con,"SELECT * FROM colleges" )or die('Error223');
					echo  
					$c=0;
					while($row=mysqli_fetch_array($q) )
					{
					$name=$row['name'];
					$cid=$row['cid'];
					$sname=$row['shortname'];

					$c++;
					echo '<option value="'.$cid.'">'.$sname.'</option>';
					}

				?>
			    </select>
				<input type="text" name="Name" placeholder="Name" id="Name">
				<input type="text" name="Group" placeholder="Group" id="Group">
				<input type="hidden" name="ind1" id="ind1" value="2">
	    		<button type="submit" name="submit" placeholder="Submit" id="submit">Submit</button>
			</form>	
		</div>
		<hr>
		<div align="center">
			<h1>Cutoffs</h1>
			<form method="post" action="add.php?q=index.php">
				<select placeholder="College" name="college" id="college">
				<?php 
					$q1=mysqli_query($con,"SELECT * FROM colleges" )or die('Error223'); 
					$c=0;
					while($row=mysqli_fetch_array($q) )
					{
					$name=$row['name'];
					$cid=$row['cid'];
					$sname=$row['shortname'];

					$c++;
					echo '<option value="'.$cid.'">'.$sname.'</option>';
					}
					echo '</select><select placeholder="Program" name="pgm" id="pgm">'
					$q2=mysqli_query($con,"SELECT * FROM program" )or die('Error223'); 
					$c=0;
					while($row=mysqli_fetch_array($q) )
					{
					$name=$row['name'];
					$cid=$row['cid'];
					$sname=$row['shortname'];

					$c++;
					echo '<option value="'.$cid.'">'.$sname.'</option>';
					}

				?>
			    </select>
				<input type="text" name="Name" placeholder="Name" id="Name">
				<input type="text" name="Group" placeholder="Group" id="Group">
				<input type="hidden" name="ind1" id="ind1" value="2">
	    		<button type="submit" name="submit" placeholder="Submit" id="submit">Submit</button>
			</form>	
		</div>
	</body>
	</html>

