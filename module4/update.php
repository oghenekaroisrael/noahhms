<?php
session_start();
include_once '../inc/db.php';
if (isset($_GET['b']) AND isset($_GET['id']) AND isset($_POST['return']) AND $_POST['return'] > 0) {
	$precript = $_GET['id'];
	$account = $_GET['b'];
	$notarray = database::getInstance()->select_from_where2('in_sales','id',$precript);
	foreach($notarray as $row):
		$pharm_id = $row['description'];
		$quantity = $row['quantity'];
	endforeach; 
	$notarray2 = database::getInstance()->select_from_where_Like('pharm_stock','id',$pharm_id);
	foreach($notarray2 as $row2):
	// 	$tab = $row2['tabs'];
	// 	$packs = $row2['packs'];
	// 	$cartons = $row2['cartons'];
		$opened_carton = $row2['stock'];
	endforeach;
	$stock_available = intval($opened_carton)+intval($_POST['return']);
	$new = $_POST['new'];
	$update = database::getInstance()->reconsile_stock($pharm_id,$precript,$stock_available,$_POST['return'],$account);

	if ($update == "Done") {
		header("location: return.php?a=".$precript."&b=".$account."&n=1");
	}else{
		header("location: return.php?a=".$precript."&b=".$account."&n=0");
	}
	
}elseif($_POST['return'] = 0){
	header("Location: index.html");
	exit();
}else{
	header("Location: index.html");
	exit();
}
?>