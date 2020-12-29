<?php
$db = mysqli_connect("localhost", "root", "", "noahhms");
if (isset($_GET['id']) AND !empty($_GET['id'])) {
		
		if (isset($_GET['pid']) AND !empty($_GET['pid'])) {

			$chk = mysqli_query($db, "SELECT to_pay, amount  FROM accounts WHERE patient_id = ".$_GET['pid']." AND id = ".$_GET['id']." AND payment_status = 0");

			$chk2 = mysqli_query($db, "SELECT to_pay, amount  FROM accounts WHERE patient_id = ".$_GET['pid']." AND id = ".$_GET['id']." AND payment_status = 1");

			$chk3 = mysqli_query($db, "SELECT to_pay, amount  FROM accounts WHERE patient_id = ".$_GET['pid']." AND id = ".$_GET['id']." AND payment_status = 2");

		$get_chk = mysqli_fetch_assoc($chk);

		$get_chk2 = mysqli_fetch_assoc($chk2);

		$get_chk3 = mysqli_fetch_assoc($chk3);

		$amt = intval($get_chk['amount']);

		$pay = intval($get_chk['to_pay']);

		$amt2 = intval($get_chk2['amount']);

		$pay2 = intval($get_chk2['to_pay']);

		$amt3 = intval($get_chk3['amount']);

		$pay3 = intval($get_chk3['to_pay']);
		
		$amount = $_POST['part_of_payment'];

		$i1 = ($amount) + ($amt);

		$i3 = ($amount) + ($amt3);
		if (mysqli_num_rows($chk) > 0) {
			if ($pay > $amount AND $pay -  $amount != 0) {
				$sql = mysqli_query($db, "UPDATE accounts SET payment_status = 2, amount = ".$i1." WHERE patient_id = ".$_GET['pid']." AND id = ".$_GET['id']."");
				$update_payment = mysqli_query($db, "UPDATE payment SET payment_status = 2 WHERE patient_id = ".$_GET['pid']." AND reference LIKE '".$_GET['link']."'");
				$update_prescription = mysqli_query($db, "UPDATE prescription SET status = 2 WHERE patient_id = ".$_GET['pid']." AND reference LIKE '".$_GET['link']."'");
				if ($sql AND $update_payment AND $update_prescription) {
						$run = mysqli_query($db, "SELECT to_pay, amount, payment_status  FROM accounts WHERE patient_id = ".$_GET['pid']." AND id = ".$_GET['id']."");
							if ($run_it = mysqli_fetch_assoc($run)) {
								if ($run_it['to_pay'] === $run_it['amount']) {
									$final = mysqli_query($db, "UPDATE accounts SET payment_status = 1 WHERE patient_id = ".$_GET['pid']." AND id = ".$_GET['id']."");
									$update_payment = mysqli_query($db, "UPDATE payment SET payment_status = 1 WHERE patient_id = ".$_GET['pid']." AND reference LIKE '".$_GET['link']."'");
									$update_prescription = mysqli_query($db, "UPDATE prescription SET status = 1 WHERE patient_id = ".$_GET['pid']." AND reference LIKE '".$_GET['link']."'");
									if ($final AND $update_prescription AND $update_payment) {
										header("Location: payment_daily.php?part_pay=paid");
										exit();
									}
								}else{
									header("Location: payment_daily.php?part_pay=error");
										exit();
								}
							}
				}
			}elseif ($pay == $amount AND $pay - $amount == 0) {
				$sql = mysqli_query($db, "UPDATE accounts SET payment_status = 1, amount = ".$i1." WHERE patient_id = ".$_GET['pid']." AND id = ".$_GET['id']."");
				$update_payment = mysqli_query($db, "UPDATE payment SET payment_status = 1 WHERE patient_id = ".$_GET['pid']." AND reference LIKE '".$_GET['link']."'");
									$update_prescription = mysqli_query($db, "UPDATE prescription SET status = 1 WHERE patient_id = ".$_GET['pid']." AND reference LIKE '".$_GET['link']."'");
				if ($sql AND $update_payment AND $update_prescription) {
							header("Location: payment_daily.php?part_pay=paid");
							exit();
				}
			}else{
							header("Location: payment_daily.php?part_pay=error1");
							exit();
			}
		}
		elseif (mysqli_num_rows($chk3) > 0) 
			{
				if ($pay3 > $amount AND $pay3 - $amount != 0) {
						$sql = mysqli_query($db, "UPDATE accounts SET payment_status = 2, amount = ".$i3." WHERE patient_id = ".$_GET['pid']." AND id = ".$_GET['id']."");
						if ($sql) {
									$run = mysqli_query($db, "SELECT to_pay, amount, payment_status  FROM accounts WHERE patient_id = ".$_GET['pid']." AND id = ".$_GET['id']."");
							if ($run_it = mysqli_fetch_assoc($run)) {
								if ($run_it['to_pay'] == $run_it['amount']) {
									$final = mysqli_query($db, "UPDATE accounts SET payment_status = 1 WHERE patient_id = ".$_GET['pid']." AND id = ".$_GET['id']."");
									$update_payment = mysqli_query($db, "UPDATE payment SET payment_status = 1 WHERE patient_id = ".$_GET['pid']." AND reference LIKE '".$_GET['link']."'");
									$update_prescription = mysqli_query($db, "UPDATE prescription SET status = 1 WHERE patient_id = ".$_GET['pid']." AND reference LIKE '".$_GET['link']."'");
									if ($final AND $update_prescription AND $update_payment) {
										header("Location: payment_daily.php?part_pay=paid");
										exit();
									}
								}else{
									$update_payment = mysqli_query($db, "UPDATE payment SET payment_status = 1 WHERE patient_id = ".$_GET['pid']." AND reference LIKE '".$_GET['link']."'");
									$update_prescription = mysqli_query($db, "UPDATE prescription SET status = 1 WHERE patient_id = ".$_GET['pid']." AND reference LIKE '".$_GET['link']."'");
									if ($update_prescription AND $update_payment) {
										header("Location: payment_daily.php?part_pay=paid");
										exit();
									}
								}
							}
						} 
				}elseif($pay3 == $amount AND $pay3 -$amount == 0){
						$sql = mysqli_query($db, "UPDATE accounts SET payment_status = 1, amount = ".$i3." WHERE patient_id = ".$_GET['pid']." AND id = ".$_GET['id']."");
						$update_payment = mysqli_query($db, "UPDATE payment SET payment_status = 1 WHERE patient_id = ".$_GET['pid']." AND reference LIKE '".$_GET['link']."'");
									$update_prescription = mysqli_query($db, "UPDATE prescription SET status = 1 WHERE patient_id = ".$_GET['pid']." AND reference LIKE '".$_GET['link']."'");
						if ($sql AND $update_payment AND $update_prescription) {
									header("Location: payment_daily.php?part_pay=paid");
									exit();
						}
				}else{
					header("Location: payment_daily.php?part_pay=error3");
									exit();
				}
		}else{
			header("Location: payment_daily.php?part_pay?error4");
						exit();
		}
	}
}
?>
