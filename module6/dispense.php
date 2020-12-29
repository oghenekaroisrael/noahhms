<?php
session_start();
include_once '../inc/db.php';
if (isset($_POST)) {
	$order = $_POST['id'];
	$percent = database::getInstance()->get_name_from_id('percentage','percentage','id',2);
	$count = database::getInstance()->count_from_where('in_sales','sales_id',$order);
	$reason = $_POST['reason'];
	$staff = $_POST['collector'];
	$patient = $_POST['patient'];
	$quantit = $_POST['quantity'];
	$stock = $_POST['stock'];
	$j =0;
		for ($i=0; $i < $count; $i++) { 
			$notarray2 = database::getInstance()->select_from_where2('pharm_stock','id',$stock[$i]);
		foreach($notarray2 as $row2):
			$tab = $row2['tabs'];
			$packs = $row2['packs'];
			$cartons = $row2['cartons'];
			$opened_carton = $row2['c_carton'];
			$pri = $row2['price'];
		endforeach;
	$stock_available = intval($opened_carton);
	$quantity = $quantit[$i];
	$update = $stock_available - $quantity;
	if (!empty($quantity)) {
		 $price1 += $pri * $quantity;
		
		if ($stock_available >= $quantity) {
			$ins = database::getInstance()->update_stock($update,$stock[$i],$patient,$staff,$reason,$quantit[$i],$order);
			if ($ins != "Done") {
				header("Location: in-sales.php?status=error2");
			}else{
				echo $quantit[$i];
				echo "<br>";
			}
			}
			
		}else{
			return "no";
		}	
	}//for loop end


	$adet = database::getInstance()->select_from_val2('patient_appointment','patient_id','id',$patient);
	$app_id = $adet[0]['id'];
	/*if (intval($j) > 0) {
	$ins = database::getInstance()->insert_insale($price1,$patient,$app_id,$order);
	if ($ins == "Done") {
		header("Location: in-sales.php?status=done");
		unset($_SESSION['sale']);
	} else {
		header("Location: in-sales.php?status=error1");
		unset($_SESSION['sale']);
	}
	}else{
		header("Location: in-sales.php?status=error3");
		unset($_SESSION['sale']);
	}
	*/
	

}else{
	header("Location: index.html");
	exit();
}
?>