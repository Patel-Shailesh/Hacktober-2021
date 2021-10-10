
<style type="text/css">
	table, th, td {
  text-align: center;
}
</style>


<?php
		include_once 'dbConnection.php';
		$tid=$_GET['tid'];
		$result3 = mysqli_query($con,"SELECT * FROM test where tid = '$tid'") or die('Error');
		$row2 = mysqli_fetch_array($result3);
						$tid = $row2['tid'];
						$tq = $row2['totalq'];
		echo '<table width="100%">';
		$c=$_GET['qn'];
		$qt=$_GET['qt'];
		if($c<=$tq)
		{
			
			if($qt == 'MCQ')
			{	echo '<tr><form method="POST" action="update.php?qn='.$c.'"><th>'.$c.'.</th><td><button type="submit" name="button5" value="1">MCQ</button></th></form><form method="POST" action="update.php?qn='.$c.'"><td><input type= "text" name="text" placeholder="Enter Question Text" required></td></tr><tr><td><input type="hidden" name="tid" value="'.$tid.'"></td><td><input type="radio" name="option" value="a"></td><td><input type="text" name="oa" placeholder="Option A"></td></tr><tr><td></td><td><input type="radio" name="option" value="b"></td><td><input type="text" name="ob" placeholder="Option B"></td></tr><tr><td></td><td><input type="radio" name="option" value="c"></td><td><input type="text" name="oc" placeholder="Option C"></td></tr><tr><td></td><td><input type="radio" name="option" value="d"></td><td><input type="text" name="od" placeholder="Option D"></td></tr><tr><td></td><td><input type= "number" name="pve" min="1" placeholder="Positive Marks" required></td><td><input type= "number" name="nve" placeholder="Negative Marks" min="0" required></td></tr><tr><td colspan="3"><button type="submit" name="button7" value="'.$c.'">Submit</button></td></tr></form></table>';
			}
			if($qt == 'TEXT')
			{	echo '<tr><form method="POST" action="update.php?qn='.$c.'"><th>'.$c.'.</th><td><button type="submit" name="button6" value="1">TEXT</button></th></form><form method="POST" action="update.php?qn='.$c.'"><td><input type= "text" name="text" placeholder="Enter Question Text"></td></tr><tr><td><input type="hidden" name="tid" value="'.$tid.'"></td><td></td><td><input type="text" name="ans" placeholder="Answer"></td></tr><tr><td></td><td><input type= "number" name="pve" min="1" placeholder="Positive Marks" required></td><td><input type= "number" name="nve" placeholder="Negative Marks" min="0" required></td></tr><tr><td colspan="3"><button type="submit" name="button8" value="'.$c.'">Submit</button></td></tr></form></table>';
			}


		}

?>