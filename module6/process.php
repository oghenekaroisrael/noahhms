<?php
session_start();
include_once '../inc/db.php';
if (isset($_GET['id']) AND isset($_GET['s']) AND $_GET['id'] != 0 AND $_GET['s'] != 0) {
	$barcode = $_GET['s'];
	$id = $_GET['id'];
	$notarray = database::getInstance()->select_from_where2('pharm_requests','request_id',$id);
	foreach($notarray as $row):
		$pharm_id = $row['warehouse_stock_id'];
		$quantity = $row['quantity_needed'];
	endforeach;

	$notarray2 = database::getInstance()->select_from_where_Like('warehouse_stock','Stock_number',$barcode);
	foreach($notarray2 as $row2):
		$cartons = $row2['cartons'];
	endforeach;
	if (!empty($quantity)) {
		if ($cartons >= $quantity) {
			if ($cartons >= $quantity) {
				echo $cur_carton = $cartons - $quantity;
				echo "<br>";
				echo $update = database::getInstance()->update_warehouse_stock($cur_carton, $barcode,$pharm_id,$id);
				if ($update =='Done') {
					header("Location: process_request.php?id=$id&s=$barcode");
				}

		}else{
			header("Location: process_request.php?id=$id&s=");
		}
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