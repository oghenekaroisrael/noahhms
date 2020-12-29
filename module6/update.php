<?php
session_start();
include_once '../inc/db.php';
if (isset($_GET['b']) AND isset($_GET['id']) AND isset($_POST['return']) AND $_POST['return'] > 0) {
	$precript = $_GET['id'];
	$account = $_GET['b'];
	$notarray = database::getInstance()->select_from_where2('pharm_requests','request_id',$precript);
	foreach($notarray as $row):
		$pharm_id = $row['warehouse_stock_id'];
		$quantity = $row['quantity'];
	endforeach;
	$notarray2 = database::getInstance()->select_from_where_Like('warehouse_stock','id',$pharm_id);
	foreach($notarray2 as $row2):
		$cartons = $row2['cartons'];
	endforeach;
	$stock_available = $cartons+$_POST['return'];
	$new = $_POST['new'];
	$update = database::getInstance()->reconsile_stock2($pharm_id,$precript,$stock_available,$_POST['return'],$account);

	if ($update == "Done") {
		header("location: return.php?a=".$account."&b=".$precript."");
	}else{
		header("location: return.php?a=".$account."&b=".$precript."");
	}
	
}elseif($_POST['return'] = 0){
	header("Location: index.html");
	exit();
}else{
	header("Location: index.html");
	exit();
}
?>