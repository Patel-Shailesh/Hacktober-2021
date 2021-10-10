<?php
include_once 'dbConnection.php';
session_start();
$cookie_name = "user";
if(!isset($_COOKIE[$cookie_name])) {
	
} else
 {
  	$uid = $_COOKIE[$cookie_name];

	$result = mysqli_query($con,"SELECT * FROM user WHERE uid = '$uid'") or die('Errord');
	$count=mysqli_num_rows($result);
	if($count==1)
	{
		while($row = mysqli_fetch_array($result)) {
			$name = $row['name'];
			$id = $row['uid'];
		}
		$_SESSION["name"] = $name;
		$_SESSION["id"] = $id;
	}
}

?>