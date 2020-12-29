<?php
include_once '../inc/db.php';
$p = database::getInstance()->select_from_where2and('prescription','pres_status','1',"MONTH(pdate_added)",date('m'));
$sum = 0;
foreach ($p as $pres) {
	$q1 = $pres['quantity_dispense'];
	$q2 = $pres['squantity_dispense'];
	$drug = $pres['pharm_stock_id'];
	$price = database::getInstance()->get_name_from_id("cost_price","pharm_stock","id",$drug);
	if ($q1 > 0) {
		$sum += ($q1 * $price);
	}
	if ($q2 > 0) {
		$sum += ($q2 * $price);
	}
}
echo $sum;

?>