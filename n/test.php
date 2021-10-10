<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include_once 'dbConnection.php';
session_start();
if(isset($_SESSION['uid']))
{
	$uid = $_SESSION['uid'];
	$hid = $_SESSION['hid'];
	$tid = $_SESSION['tid'];
	if(isset($_SESSION['etime']))
	{
		$etime = $_SESSION['etime'];
	}else
	{
		$etime = $_COOKIE['etime'];
	}
	if($etime<time())
	{
		header("location:dashboard.php?q=1&e=1");
	}
	echo '<table width="100%">';
	$q = mysqli_query($con,"SELECT * FROM question WHERE tid = '$tid'");
	$c=1;
	while($row = mysqli_fetch_array($q))
	{
		$type = $row['qtype'];
		$qid =$row['qid'];
		$qtext = $row['qtext'];
		$pve = $row['pve'];
		$nve = $row['nve'];
		$q2 = mysqli_query($con,"SELECT * FROM anslog WHERE hid = '$hid' AND qid = '$qid'");
		$cnt=mysqli_num_rows($q2);
		$row3 = mysqli_fetch_array($q2);

		echo '<tr><td>'.$c++.'.</td><td>'.$type.'</td><td>+'.$pve.'</td><td>-'.$nve.'</td></tr><tr><td>&nbsp;</td><td>Q.</td><td colspan="2">'.$qtext.'</td></tr>';
		if($type=="MCQ")
		{
			$oa = $row['oa'];
			$ob = $row['ob'];
			$oc = $row['oc'];
			$od = $row['od'];
			echo '<form method="POST" action="update.php"><tr><td>';
			if ($cnt!=0) {
				echo '<span>'.$row3['selected'].'</span><input type="hidden" name="flg" value ="1">';
			}
			echo '</td><td><input type="radio" name="select" value="a"></td><td colspan="2">'.$oa.'</td></tr><tr><td></td><td><input type="radio" name="select" value="b"></td><td colspan="2">'.$ob.'</td></tr><tr><td></td><td><input type="radio" name="select" value="c"></td><td colspan="2">'.$oc.'</td></tr><tr><td></td><td><input type="radio" name="select" value="d"></td><td colspan="2">'.$od.'</td></tr><tr><td><input type="hidden" name = "hid" value = "'.$hid.'"></td><td colspan="3"><button type = "submit" name = "button22" value ="'.$qid.'">Submit</button></td></tr>';

		}
		if($type=="TXT")
		{
			echo '<form method="POST" action="update.php"><tr><td>';
			if ($cnt!=0) {
				echo '<span>A</span>';
			}
			echo '</td></tr><tr><td></td><td colspan="3"><input type="text" name="tans" placeholder="Enter Answer"></td></tr><tr><td><input type="hidden" name = "hid" value = "'.$hid.'"></td><td colspan="3"><button type = "submit" name = "button23" value ="'.$qid.'">Submit</button></td></tr>';

		}

	}
	echo '</table><p id="time">aa</p>';
}
?>

	<script>
function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
        display.textContent = minutes + ":" + seconds;
        if (--timer < 0) {
            timer = duration;
        }
    }, 1000);
}

window.onload = function () {
    var fMinutes = <?php echo ($etime - time()); ?>;
        display = document.querySelector("#time");
    startTimer(fMinutes, display);
};
</script>


<body>

</body>


</html>





