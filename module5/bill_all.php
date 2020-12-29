<?php
	if (isset($_GET['val']) AND !empty($_GET['val'])) {
		$db = mysqli_connect("localhost", "root", "", "noahhms");
		$sql = mysqli_query($db, "SELECT id,amount, patient_id, to_pay, payment_status FROM accounts WHERE patient_id = ".$_GET['id']."");
		$get = mysqli_fetch_assoc($sql);

		if ($get) {
			?>
			<script>document.getElementByID("company_bill").style.display = "block";</script>
			<?php
			exit();
		}
	}
?>