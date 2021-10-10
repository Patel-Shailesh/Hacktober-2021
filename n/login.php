
<?php

include_once 'dbConnection.php';
include_once 'cookie.php';

session_destroy();

$ref=@$_GET['q'];
$email = $_POST['email'];
$password = $_POST['password'];
if(isset($_POST['remb']))
{
	$r = 1;
}
else
{
	$r = 0;
}

$password=$password; 
$result = mysqli_query($con,"SELECT * FROM user WHERE email = '$email' and pass = '$password'") or die('Error');
$count=mysqli_num_rows($result);
if($count==1){
	while($row = mysqli_fetch_array($result)) {
	$name = $row['name'];
	$id = $row['uid'];
	$v = $row['verified'];
}
if($v == "No"){
	header("location:$ref?w=Account Not Verified!!");
}
session_start();
$_SESSION["name"] = $name;
$_SESSION["id"] = $id;
echo $r;
if($r == '1'){
	$cookie_name = "user";
    $cookie_value = $id;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
	header("location:dashboard.php?q=1");
}else
{ 
		setcookie($cookie_name, '', time()-36000,"/");
			
}header("location:dashboard.php?q=1");


	




//}
}
else
header("location:$ref?w=Wrong Username or Password");




?>