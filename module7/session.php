<?php 
if (isset($_POST['app'])) {
	$id = $_POST['id'];
	$app = $_POST['app'];
	include_once '../inc/db.php';
		$jas = database::getInstance()->changeSession($app,$id);
		if ($jas == "Done" && $id == 2) {
			echo "Done";
		}else if ($jas == "Done" && $id == 1) {
			echo "Done2";
		}
}else{
	exit();
	header("index.php");
}
?>