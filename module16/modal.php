<?php
	if (isset($_GET['id']) AND !empty($_GET['id'])) {
		$db = mysqli_connect("localhost", "root", "", "noahhms");
		$sql = mysqli_query($db, "SELECT * FROM accounts WHERE front_desk LIKE '".$_GET['ref']."' AND order_id LIKE '".$_GET['id']."'");
		while ($get = mysqli_fetch_assoc($sql)) {
			echo "<script>window.open('view_payment_details.php?part_pay=1&amount=".$_GET['amount']."&pid=".$get['patient_id']."&top=".$get['to_pay']."&payst=".$get['payment_status']."&row=".$_GET['row']."&ccah=".$get['amount']."&tlink=".$_GET['id']."&id=".$_GET['ref']."','_self');</script>";
			exit();
		}
	}
?>