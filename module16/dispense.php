<?php
session_start();
include_once '../inc/db.php';
include_once '../inc/config.php';
if (isset($_POST)) {
	echo $order = $_POST['id'];
	echo "<p>";
	$percent = database::getInstance()->get_name_from_id('percentage','percentage','id',2);
	$count = database::getInstance()->count_from_where('in_sales','sales_id',$order);
	$reason = $_POST['reason'];
	$staff = $_POST['collector'];
	$patient = $_POST['patient'];
	$quantit = $_POST['quantity'];
	$stock = $_POST['stock'];
	$id = $_POST['ids'];
	$j =1;
		for ($i=0; $i < $count; $i++) { 
			$notarray2 = database::getInstance()->select_from_where2('pharm_stock','id',$stock[$i]);
		foreach($notarray2 as $row2):
			$tab = $row2['tabs'];
			$packs = $row2['packs'];
			$cartons = $row2['cartons'];
			$opened_carton = $row2['c_carton'];
			$pri = $row2['price'];
			$barcode = $row2['Stock_number'];
			$batch = $row2['batch'];
		endforeach;

	$stock_available = intval($opened_carton);
	$quantity = $quantit[$i];
	$update = $stock_available - $quantity;
	if (!empty($quantity)) {
		 $price1 += $pri * $quantity;
		
		if ($stock_available >= $quantity) {
				$k = $j++;
				$join = "LIMIT $i, $k";
			$query = mysqli_query($con,"UPDATE pharm_stock SET c_carton = $update WHERE id = $stock[$i]");
			echo "<br>";
			$query2 = mysqli_query($con, "UPDATE in_sales SET quantity = $quantit[$i],patient_id = $patient,staff = '$staff',reason = '$reason',Stock_number = $barcode,batch = '$batch' WHERE id  = $id[$i]");
			if ($query AND $query2) {
				$ddone = 1;
			}else{
				header("Location: in-sales.php?status=error2");
				unset($_SESSION['sale']);	
			}
			}
			
		}else{
			return "no";
		}	
	}//for loop end


	$adet = database::getInstance()->select_from_val2('patient_appointment','patient_id','id',$patient);
	$app_id = $adet[0]['id'];
	if ($ddone != 0) {
		$front_desk = database::getInstance()->get_name_from_id('front_desk','patients','id',$patient);
		$card_type = database::getInstance()->get_name_from_id('card_type','patients','id',$patient);
		$company = database::getInstance()->get_name_from_id('company_id','patients','id',$patient);
		$p1 = database::getInstance()->get_name_from_id('percentage','percentage','id',1);
		$p2 = database::getInstance()->get_name_from_id('percentage','percentage','id',2);
		$p3 = database::getInstance()->get_name_from_id('percentage','percentage','id',3);
		if ($card_type == 11) {
				$priceToPay2 = (($p1/100)*($price1));
				$priceToPay = (($price1)+($priceToPay2));
			}elseif ($card_type == 14) {
				$priceToPay2 = (($p2/100)*($price1));
				$priceToPay = (($price1)+($priceToPay2));
			}elseif ($card_type == 19) {
				$priceToPay2 = (($p3/100)*($price1));
				$priceToPay = (($price1)+($priceToPay2));
			}else{
				$priceToPay2 = (($p2/100)*($price1));
				$priceToPay = (($price1)+($priceToPay2));
			}
		$date = date("Y-m-d");
		$test = 3;
		$code1 = $_SESSION['sale'];
		if ($card_type == 14) {
			$stmt = "INSERT INTO accounts(front_desk,item, patient_id, card_type, app_id, to_pay, order_id, date_added,payment_status) 
		VALUES ('$front_desk',$test,$patient,$card_type,$app_id,$priceToPay,'$code1','$date',0)";
		$ins = mysqli_query($con,$stmt);
		}elseif($card_type == 11){
		$stmt = "INSERT INTO accounts(front_desk,item, patient_id, card_type, app_id, to_pay, order_id, date_added,payment_status,company_id) 
		VALUES ('$front_desk',$test,$patient,$card_type,$app_id,$priceToPay,'$code1','$date',0,$company)";
		$ins = mysqli_query($con,$stmt);
		}else{			
			$stmt = "INSERT INTO accounts(front_desk,item, patient_id, card_type, app_id, to_pay, order_id, date_added,payment_status) 
		VALUES ('$front_desk',$test,$patient,$card_type,$app_id,$priceToPay,'$code1','$date',0)";
		$ins = mysqli_query($con,$stmt);
		}
	if ($ins) {
		header("Location: in-sales.php?status=done");
		unset($_SESSION['sale']);
	} else {
		echo mysqli_error($con);
	}
}else{
		header("Location: in-sales.php?status=error3");
		unset($_SESSION['sale']);
	}
	

}else{
	header("Location: index.html");
	exit();
}
?>