<?php
session_start();
include_once '../inc/db.php';
include_once '../inc/config.php';
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$usr = $_SESSION['userSession'];
	$notarray2 = database::getInstance()->select_from_where_Like('pharm_stock','id',$_GET['s']);
	foreach($notarray2 as $row2):
		$drug = $row2['id'];
		$use = $row2['s_usage'];
	endforeach;
		$ins = mysqli_query($con,"INSERT INTO `in_sales`(`sales_id`,`drug`, `s_usage`,`dispenser`,`date`) VALUES ('$id',$drug,$use,$usr,NOW())");

		if ($ins) {
			header("Location: in-sales.php?status=done");
		}else{
			header("Location: in-sales.php?status=error3");
		}
}elseif($_GET['s'] == 0){
	header("Location: in-sales?status=error31");
	exit();
}else{
	header("Location: in-sales?status=error4");
	exit();
}
?>