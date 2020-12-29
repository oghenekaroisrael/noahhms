<?php
session_start();
include_once '../inc/db.php';
if (isset($_GET['b']) AND isset($_GET['id']) AND isset($_POST['return']) AND $_POST['return'] > 0) {
	$user = $_GET['id'];
	$request = $_GET['b'];
	$notarray = database::getInstance()->select_from_where2('pharm_requests','request_id',$request);
	foreach($notarray as $row):
		$w_id = $row['warehouse_stock_id'];
		$quantity = $row['quantity_needed'];
	endforeach; 
	$notarray2 = database::getInstance()->select_from_where_Like('warehouse_stock','id',$w_id);
	foreach($notarray2 as $row2):
		$opened_carton = $row2['cartons'];
	endforeach;
	$stock_available = intval($opened_carton)+intval($_POST['return']);
	$new = $_POST['new'];
	$update = database::getInstance()->reconsile_stock_w($w_id,$user,$stock_available,$_POST['return'],$request);

	if ($update == "Done") {
		header("location: return_w.php?a=".$user."&b=".$request."&n=1");
	}else{
		header("location: return_w.php?a=".$user."&b=".$request."&n=0");
	}
	
}elseif($_POST['return'] = 0){
	header("Location: index.html");
	exit();
}else{
	header("Location: index.html");
	exit();
}
?>