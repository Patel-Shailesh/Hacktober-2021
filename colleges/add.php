<?php
include_once 'dbConnection.php';
	$ind1=$_POST['ind1'];
	if($ind1==1)
	{
		$ref=@$_GET['q'];
		$name=$_POST['Name'];
		$sname=$_POST['Sname'];
		$city=$_POST['City'];
		$state=$_POST['State'];
		$q=mysqli_query($con,"INSERT INTO colleges VALUES  ('' , '$name', '$sname' , '$city', '$state')")or die ("Error");
	}
	else if($ind1==2)
	{
		$ref=@$_GET['q'];
		$cid=$_POST['college'];
		$name=$_POST['Name'];
		$grp=$_POST['Group'];
		$q=mysqli_query($con,"INSERT INTO program VALUES  ('' , $cid, '$name', '$grp')")or die ("Error");	
	}

//header("location:$ref");

?>