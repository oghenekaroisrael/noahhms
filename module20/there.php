<?php 
include_once '../inc/db.php';
$value = $_GET['id'];	
$value2 = $_GET['pid2'];
$ip = $_GET['ipid'];

if (isset($_POST) AND !empty($_POST['note'])) {
		$insert = database::getInstance()->insert_progress($_POST['note'], $value, $user_id);
		if ($insert == 'Done') {
			header("Location: progress.php?id=".$value."&pid2=".$value2."&ipid=".$ip."&status=done");
			unset($_POST);
		} else {
			header("Location: progress.php?id=".$value."&pid2=".$value2."&ipid=".$ip."&status=error");
			unset($_POST);
		}
		
	} else {
		unset($_POST);
	}
?>