<?php
session_start();
include_once '../inc/db.php';
if (isset($_GET['b']) AND isset($_GET['id']) AND isset($_POST['return']) AND $_POST['return'] > 0) {
	$sales = $_GET['id'];
	$account = $_GET['b'];
	$notarray = database::getInstance()->select_from_where2('caf_sales_detail','Sales_ID',$sales);
	foreach($notarray as $row):
		$stock_id = $row['Stock_Item'];
		$quantity = $row['Sales_Quantity'];
	endforeach;
	$notarray2 = database::getInstance()->select_from_where_Like('caf_stock','id',$stock_id);
	foreach($notarray2 as $row2):
		$stock_available = $row['quantity'];
	endforeach;
	$new = $_POST['new'];
	$update = database::getInstance()->reconsile_cstock($stock_id,$sales,$stock_available,$_POST['return'],$account);

	if ($update == "Done") {
		header("location: return.php?a=".$sales."&b=".$account."&n=1");
	}else{
		echo $update;
	}
	
}elseif($_POST['return'] = 0){
	header("Location: index.html");
	exit();
}else{
	header("Location: index.html");
	exit();
}
?>