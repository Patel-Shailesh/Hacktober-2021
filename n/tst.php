<form method="post" action="tst.php">
	<input type="checkbox" name="check" >
	<input type="submit" name="submit" placeholder="submit">
</form>

<?php

if (isset($_POST['check'])) {
	// echo $_POST['check'];
	echo '1';
}

?>