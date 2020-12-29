<?php
session_start();
$con = mysqli_connect('localhost','root','','noahhms');
if (isset($_GET['id']) AND isset($_GET['s']) AND $_GET['s'] != 0 AND $_GET['quantity'] > 0) {
	$barcode = $_GET['s'];
	$id = $_GET['id'];
	$qty = $_GET['quantity'];
	$staff = $_GET['st'];
	$ins = mysqli_query($con,"INSERT INTO pharm_requests(warehouse_stock_id,staff_id,reference,quantity_needed,request_status,pdate_added) VALUES('$barcode','$staff','$id','$qty',0,NOW())");
	
	if ($ins) {
		header("Location: new_stock_r.php?status=done");
		unset($_SESSION['req']);
	}else{
		header("Location: new_stock_r.php?status=error1");
	}
	
}elseif($_GET['s'] = 0){
	header("Location: new_stock_r.php?status=error4"); 
	exit();
}else{
	header("Location: new_stock_r.php?status=error3");
	exit();
}
?>