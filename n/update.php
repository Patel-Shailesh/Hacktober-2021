<?php
include_once 'dbConnection.php';
	function updatetest($a,$con)
	{
		$q=mysqli_query($con,"SELECT SUM(marks), SUM(qmark) FROM anslog WHERE hid = '$a'");
		$r=mysqli_fetch_array($q);
		$m=$r['SUM(marks)'];
		$tm=$r['SUM(qmark)'];
		$s=mysqli_query($con,"UPDATE testlog SET marks='$m', tmarks='$tm' WHERE hid = '$a'");
		include 'rank.php';
	}
	if(isset($_POST['button1'])) 
	{ 
		$x = $_POST['button1'];
		$q=mysqli_query($con,"UPDATE `user` SET `verified` = 'Yes' WHERE `user`.`uid` = $x ")or die('Error124');
		header("location:dashboard.php?q=1");
	}
	
	if(isset($_POST['button3'])) 
	{ 

		$x = $_POST['button3'];
		echo '<div><h1>Do you want to delete the User?</h1><br><form method="post" action="update.php?u=3"><button type="submit" name="button4"  value="'.$x.'">Delete</button></form><form method="post" action="dashboard.php?q=1"><button type="submit">Cancel</button></form></div>';
	}
	if(isset($_POST['deny'])) 
	{ 
		echo '<div><h2>Access Denied!</h2><h3>Deleting Admin Not Allowed</h3><br><form method="post" action="dashboard.php?q=1"><button type="submit">OK</button></form></div>';
	}
	if(isset($_POST['button4'])) 
	{
		$x = $_POST['button4'];
		$q=mysqli_query($con,"SELECT * FROM `testlog` WHERE `testlog`.`uid` = $x")or die('Error124');
		while($row = mysqli_fetch_array($q)) {
				$hid = $row['hid'];
				$q=mysqli_query($con,"DELETE FROM `anslog` WHERE `anslog`.`hid` = $hid")or die('Error124');
				$q=mysqli_query($con,"DELETE FROM `testlog` WHERE `testlog`.`hid` = $hid")or die('Error124');
		}
		$q=mysqli_query($con,"DELETE FROM `rank` WHERE `uid` = $x")or die('Error124');
		$q=mysqli_query($con,"DELETE FROM `user` WHERE `user`.`uid` = $x")or die('Error124');
		$q=mysqli_query($con,"UPDATE `test` SET `cid`='1' WHERE `cid`=$x");


		header("location:dashboard.php?q=1");
	}
	if(isset($_POST['button5'])) 
	{
		$qn = $_GET['qn'];
		header("location:add.php?qn=$qn&qt=TEXT");
	}
	if(isset($_POST['button6'])) 
	{
		$qn = $_GET['qn'];
		header("location:add.php?qt=MCQ&qn=$qn");
	}
	if(isset($_POST['button7'])) 
	{
		$c = $_POST['button7'];
		$text = $_POST['text'];
		$oa = $_POST['oa'];
		$ob = $_POST['ob'];
		$oc = $_POST['oc'];
		$od = $_POST['od'];
		$pve = $_POST['pve'];
		$nve = $_POST['nve'];
		$tid = $_POST['tid'];
		$ans = $_POST['option'];
		$q=mysqli_query($con,"INSERT INTO `question`(`qid`, `qtext`, `qtype`, `tid`, `oa`, `ob`, `oc`, `od`, `ans`, `tans`, `pve`, `nve`) VALUES (NULL,'$text','MCQ','$tid','$oa','$ob','$oc','$od','$ans',NULL,'$pve','$nve')")or die('Error124');
		$c++;
		header("location:add.php?tid=$tid&qn=$c&qt=MCQ");

	}
	if(isset($_POST['button8'])) 
	{
		$c = $_POST['button8'];
		$text = $_POST['text'];
		$pve = $_POST['pve'];
		$nve = $_POST['nve'];
		$tid = $_POST['tid'];
		$ans = $_POST['ans'];
		$q=mysqli_query($con,"INSERT INTO `question`(`qid`, `qtext`, `qtype`, `tid`, `oa`, `ob`, `oc`, `od`, `ans`, `tans`, `pve`, `nve`) VALUES (NULL,'$text','TXT','$tid',NULL,NULL,NULL,NULL,NULL,'$ans','$pve','$nve')")or die('Error124');
		$c++;
		header("location:add.php?tid=$tid&qn=$c&qt=MCQ");

	}
	if(isset($_POST['button15'])) 
	{
		$cid = $_POST['button15'];
		$tname = $_POST['name'];
		$sub = $_POST['sub'];
		$tq = $_POST['tq'];
		$st = $_POST['stime'];
		$et = $_POST['etime'];
		$time = $_POST['time'];

		$q=mysqli_query($con,"INSERT INTO `test`(`tid`, `tname`, `sub`, `cid`, `time`, `stime`, `etime`, `totalq`) VALUES (NULL,'$tname','$sub','$cid','$time','$st','$et','$tq')")or die('Error124');
		$result3 = mysqli_query($con,"SELECT * FROM test order by tid desc") or die('Error');
		$row2 = mysqli_fetch_array($result3);
						$tid = $row2['tid'];
		header("location:add.php?tid=$tid&qn=1&qt=MCQ");
		
		
	}
	if(isset($_POST['button17'])) 
	{
		$hid=$_POST['button17'];
		$marks=$_POST['marks'];
		$qid=$_POST['qid'];
		$tmarks=$_POST['qmarks'];
		$result = mysqli_query($con,"SELECT * FROM testlog where hid='$hid'") or die('Error');
		$row = mysqli_fetch_array($result);
		$cmarks = $row['marks'];
		$cmarks = $cmarks+$marks;
		$ctmarks = $row['tmarks'];
		$ctmarks=$ctmarks+$tmarks;
		
		$q=mysqli_query($con,"UPDATE `testlog` SET `marks`=$cmarks,`tmarks`=$ctmarks WHERE `hid`=$hid");
		$r=mysqli_query($con,"UPDATE `anslog` SET `eval`='Yes',`marks`=$marks,`qmark`=$tmarks WHERE `hid`=$hid and `qid`=$qid")or die('Error009');
		header("location:dashboard.php?q=3");
		
		
	}
	if(isset($_POST['button11'])) 
	{
		$email=$_POST['email'];
		$mob=$_POST['mob'];
		$result1 = mysqli_query($con,"SELECT * FROM user where email='$email' or mob = '$mob'");
		$count=mysqli_num_rows($result1);
		if($count>=1)
		{
			header("location:index.php?err=1");
		}else
		{
				$name=$_POST['name'];
				$pass=$_POST['pass'];
				$role =$_POST['role'];
				
				$q=mysqli_query($con,"INSERT INTO `user`(`uid`, `name`, `email`, `pass`, `role`, `mob`, `verified`) VALUES (NULL,'$name','$email','$pass','$role','$mob','No')")or die('Error009');
				header("location:index.php?s=1");
				
		}
	
		
	}
	if(isset($_POST['button12'])) 
	{
		$email=$_POST['email'];
		$name=$_POST['name'];
		$sub=$_POST['sub'];
		$feed =$_POST['feed'];
		$q=mysqli_query($con,"INSERT INTO `feedback`(`fid`, `mail`, `name`, `sub`, `text`) VALUES (NULL,'$email','$name','$sub','$feed')")or die('Error009');
		header("location:index.php?s=1");
		
	}

	if(isset($_POST['button21']))
	{
		$tid =$_POST['button21'];
		$uid = $_POST['uid'];
		$ttime = $_POST['ttime'];
		$res2 = mysqli_query($con,"SELECT * FROM testlog ORDER BY hid DESC");
		$row2 = mysqli_fetch_array($res2);
		$hid = $row2['hid'] + 1;
		$q=mysqli_query($con,"INSERT INTO `testlog`(`hid`, `tid`, `uid`, `marks`, `tmarks`) VALUES ('$hid', '$tid', '$uid', '0', '0')");
		session_start();
		$_SESSION["uid"] = $uid;
		$_SESSION["hid"] = $hid;
		$_SESSION["tid"] = $tid;
		$etime = time() + ($ttime*60);
		$_SESSION["etime"] = $etime;
		setcookie("etime", $etime , time() + 86400 , "/"); // 86400 = 1 day
		header("location:test.php");
	}
	if(isset($_POST['button22']))
	{
		$qid =$_POST['button22'];
		$hid = $_POST['hid'];
		$select =$_POST['select'];
		if(isset($_POST['flg'])){$flg = $_POST['flg'];}else{$flg==0;}
		if($flg==1)
		{
			$c = mysqli_query($con,"DELETE FROM anslog WHERE $qid = '$qid' AND hid ='$hid'");
		}
		$res2 = mysqli_query($con,"SELECT * FROM question WHERE $qid = '$qid'");
		$row2 = mysqli_fetch_array($res2);
		$tid = $row2['tid'];
		$ans = $row2['ans'];
		$pve = $row2['pve'];
		$nve = $row2['nve'];
		$qm=-$nve;
		$tm=$pve;
		if($select==$ans)
		{

			$qm=$pve;
		}
			$a=mysqli_query($con, "INSERT INTO `anslog`(`hid`, `tid`, `qid`, `selected`, `txtans`, `marks`, `qmark`, `eval`) VALUES ('$hid','$tid','$qid','$select',NULL,$qm,$tm,'Yes')");
		$b = updatetest($hid,$con);
		header("location:test.php");
	}
	if(isset($_POST['button23']))
	{
		$qid =$_POST['button23'];
		$hid = $_POST['hid'];
		$tans =$_POST['tans'];
		$res2 = mysqli_query($con,"SELECT * FROM question WHERE $qid = '$qid'");
		$row2 = mysqli_fetch_array($res2);
		$tid = $row['tid'];
		$pve = $row['pve'];
		$tm=$pve;
		$a=mysqli_query($con, "INSERT INTO `anslog`(`hid`, `tid`, `qid`, `selected`, `txtans`, `marks`, `qmark`, `eval`) VALUES ('$hid','$tid','$qid',NULL,'$tans','0','$tm','No')");
		header("location:test.php");
	}


?>