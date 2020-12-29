<?php
session_start();
include_once '../inc/db.php';
include_once '../inc/config.php';
if (isset($_GET['id']) AND isset($_GET['s']) AND $_GET['id'] != "" AND $_GET['s'] != 0) {
	$barcode = $_GET['s'];
	$id = $_GET['id'];
	$qty = $_GET['quantity'];
	$usr = $_SESSION['userSession'];
	$notarray2 = database::getInstance()->select_from_where_Like('caf_stock','id',$barcode);
	foreach($notarray2 as $row2):
		$price = $row2['price'];
		$stock = $row2['quantity'];
	endforeach;
	$bill = $qty * $price;
	$user = $_SESSION['userSession'];
	if (!empty($qty)) {
		$ins = mysqli_query($con,"INSERT INTO `caf_sales_detail`(`Sales_Number`,`account_status`,`Stock_Item`, `Sales_Quantity`,`Purchasing_Price`,`sales_date`,`addedby`) VALUES ('$id',0,$barcode,$qty,$bill,NOW(),$usr)");

		if ($ins){
			$update1 = $stock - $qty;
			if ($stock > 0 AND $stock >= $qty) {
				$ins1 = mysqli_query($con, "UPDATE caf_stock SET quantity = $update1 WHERE id = $barcode");
				if ($ins1) {
					header("Location: pos.php?status=done");
				} else {
					header("Location: pos.php?status=error1");
				}
				
			}else{
				header("Location: pos.php?status=OOS");
				//Out Of Stock
			}
			
		} else {
					header("Location: pos.php?status=error3");
					unset($_SESSION['req']);
		}
		
	}
}elseif($_GET['s'] = 0){
	header("Location: index.html");
	exit();
}else{
	header("Location: index.html");
	exit();
}
?>