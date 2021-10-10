<?php
include_once 'dbConnection.php';

$q=mysqli_query($con,"SELECT * FROM user WHERE role = 'Student'") or die('Errord');
while($row = mysqli_fetch_array($q))
{
	$uid = $row['uid'];
	$r=mysqli_query($con,"SELECT SUM(marks),SUM(tmarks) FROM testlog WHERE uid = '$uid'") or die('Errord');
	$row2=mysqli_fetch_array($r);
	$o=$row2['SUM(marks)'];
	$t=$row2['SUM(tmarks)'];
	$y=mysqli_query($con,"SELECT * FROM rank WHERE uid='$uid'");
	$cnt=mysqli_num_rows($y);
	if($t==0)
	{
		$agg=0;
	}
	else
	{
		$agg=($o/$t)*100;
	}
	if($cnt==0 && $t!=0)
	{
		$x=mysqli_query($con,"INSERT INTO `rank`(`uid`, `obtained`, `total`, `agg`) VALUES ('$uid','$o',$t,'$agg')") or die('Errord');
	}
	
	
	$z=mysqli_query($con,"UPDATE `rank` SET `obtained`='$o',`total`='$t',`agg`='$agg' WHERE uid = '$uid'") or die('Errord');
}


?>