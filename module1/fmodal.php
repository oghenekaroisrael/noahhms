<?php 
if (isset($_GET['oid']) && !empty($_GET['oid'])) {
	echo "<script>window.open('view_payment_details.php?fullPayment=1&amount=".$_GET['amount']."&pid=".$_GET['patient']."&amount1=".$_GET['amount1']."&oid=".$_GET['oid']."&stat=".$_GET['stat']."&id=".$_GET['some_id']."','_self');</script>";
			exit();
}
/*accept('<?php echo $oid; ?>','1','<?php echo substr($to_pay, 0, -3); ?>','<?php echo $patient_id; ?>')"


<?php echo substr($to_pay, 0, -3); ?>
*/
?>