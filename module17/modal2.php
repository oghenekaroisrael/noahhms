<?php
	if (isset($_GET['id']) AND !empty($_GET['id'])) {
		$db = mysqli_connect("localhost", "root", "", "noahhms");
		$sql = mysqli_query($db, "SELECT * FROM accounts WHERE patient_id = ".$_GET['p']." AND order_id = '".$_GET['oid']."'");
		while ($get = mysqli_fetch_assoc($sql)) {
			echo "<script>window.open('view_payment_details.php?company_bill=1&amount=".$get['to_pay']."&pid=".$get['patient_id']."&payst=".$get['payment_status']."&oid=".$_GET['oid']."&id=".$get['front_desk']."','_self');</script>";
			exit();
		}
	}
?>