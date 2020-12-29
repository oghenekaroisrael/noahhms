<?php
include '../inc/db.php';
$db = mysqli_connect("localhost", "root", "", "noahhms");
if (isset($_GET['id']) AND !empty($_GET['id'])) {
		
		if (isset($_GET['pid']) AND !empty($_GET['pid'])) {
			$chk = mysqli_query($db, "SELECT to_pay, amount,cash,bank  FROM accounts WHERE patient_id = ".$_GET['pid']." AND id = ".$_GET['id']." AND payment_status = 0");

			$chk2 = mysqli_query($db, "SELECT to_pay, amount,cash,bank  FROM accounts WHERE patient_id = ".$_GET['pid']." AND id = ".$_GET['id']." AND payment_status = 1");

			$chk3 = mysqli_query($db, "SELECT to_pay, amount,cash,bank  FROM accounts WHERE patient_id = ".$_GET['pid']." AND id = ".$_GET['id']." AND payment_status = 2");

		$get_chk = mysqli_fetch_assoc($chk);

		$get_chk2 = mysqli_fetch_assoc($chk2);

		$get_chk3 = mysqli_fetch_assoc($chk3);

		$amt = intval($get_chk['amount']);

		$pay = intval($get_chk['to_pay']);

		$cash = intval($get_chk['cash']);

		$bank = intval($get_chk['bank']);

		$amt2 = intval($get_chk2['amount']);

		$pay2 = intval($get_chk2['to_pay']);

		$cash2 = intval($get_chk['cash']);

		$bank2 = intval($get_chk['bank']);

		$amt3 = intval($get_chk3['amount']);

		$pay3 = intval($get_chk3['to_pay']);

		$cash3 = intval($get_chk['cash']);

		$bank3 = intval($get_chk['bank']);
		
		$cash_paid = $_POST['cash'];
		$bank_paid = $_POST['bank'];
		$bank_used = $_POST['bank_used'];
		$amount = $cash_paid+$bank_paid;
		$i1 = ($amount) + ($amt);

		$i3 = ($amount) + ($amt3);
		$sql_itm = mysqli_query($db,"SELECT item FROM accounts WHERE patient_id = ".$_GET['pid']." AND id = ".$_GET['id']."");
$get_item = mysqli_fetch_assoc($sql_itm);
$itm = intval($get_item['item']);

		if (mysqli_num_rows($chk) > 0) {

			if ($pay > $amount AND $pay -  $amount != 0) {
				$sql = mysqli_query($db, "UPDATE accounts SET payment_status = 2, amount = '$i1', cash = '$cash_paid', bank = '$bank_paid', bank_used = '$bank_used' WHERE patient_id = ".$_GET['pid']." AND id = ".$_GET['id']."");
				$itm = database::getInstance()->get_name_from_id2("item","accounts","id",$_GET['id']);
		if ($itm == "3" || $itm == 3) {
			database::getInstance()->notify_lab2($_GET['pid']);
		}
				if ($sql) {
					echo "here";
						$run = mysqli_query($db, "SELECT to_pay, amount,cash,bank, payment_status  FROM accounts WHERE patient_id = ".$_GET['pid']." AND id = ".$_GET['id']."");
							if ($run_it = mysqli_fetch_assoc($run)) {
								if ($run_it['to_pay'] === $run_it['amount']) {
									$final = mysqli_query($db, "UPDATE accounts SET payment_status = 1, cash = '".($cash + $run_it['cash'])."', bank = '".($bank + $run_it['bank'])."', bank_used = '".$bank_used."',date_paid = NOW() WHERE patient_id = ".$_GET['pid']." AND id = ".$_GET['id']."");
									$update_payment = mysqli_query($db, "UPDATE payment SET payment_status = ? WHERE appointment_id = ?");
									$update_prescription = mysqli_query($db, "UPDATE prescription SET status = ? WHERE appointment_id = ?");
									if ($final) {
										header("Location: index.php?part_pay=paid");
										$itm = database::getInstance()->get_name_from_id2("item","accounts","order_id",$_GET['link']);
											if ($itm == "3" || $itm == 3) {
												database::getInstance()->notify_lab2($_GET['pid']);
											}
										exit();
									}
								}else{
									header("Location: index.php?part_pay=error");
										exit();
								}
							}
				}
			}elseif ($pay == $amount AND $pay - $amount == 0) {
				$sql = mysqli_query($db, "UPDATE accounts SET payment_status = 1, amount = '".$i1."', cash = '".($cash + $run_it['cash'])."', bank = '".($bank + $run_it['bank'])."', bank_used = '".$bank_used."',date_paid = NOW() WHERE patient_id = ".$_GET['pid']." AND id = ".$_GET['id']."");
				if ($sql) {
							header("Location: index.php?part_pay=paid");
							$itm = database::getInstance()->get_name_from_id2("item","accounts","order_id",$_GET['link']);
							if ($itm == "3" || $itm == 3) {
								database::getInstance()->notify_lab2($_GET['pid']);
							}
							exit();
				}
			}else{
							header("Location: index.php?part_pay=error1");
							exit();
			}
		}
		elseif (mysqli_num_rows($chk3) > 0) 
			{
				if ($pay3 > $amount AND $pay3 - $amount != 0) {
						$sql = mysqli_query($db, "UPDATE accounts SET payment_status = 2, amount = '".$i3."', cash = '".($cash + $run_it['cash'])."', bank = '".($bank + $run_it['bank'])."', bank_used = '".$bank_used."',date_paid = NOW() WHERE patient_id = ".$_GET['pid']." AND id = ".$_GET['id']."");
						if ($sql) {
									$run = mysqli_query($db, "SELECT to_pay, amount, payment_status  FROM accounts WHERE patient_id = ".$_GET['pid']." AND id = ".$_GET['id']."");
							if ($run_it = mysqli_fetch_assoc($run)) {
								if ($run_it['to_pay'] == $run_it['amount']) {
									$final = mysqli_query($db, "UPDATE accounts SET payment_status = 1, cash = '".($cash + $run_it['cash'])."', bank = '".($bank + $run_it['bank'])."', bank_used = '".$bank_used."',date_paid = NOW() WHERE patient_id = ".$_GET['pid']." AND id = ".$_GET['id']."");
									if ($final) {
										header("Location: index.php?part_pay=paid");
										$itm = database::getInstance()->get_name_from_id2("item","accounts","order_id",$_GET['link']);
										if ($itm == "3" || $itm == 3) {
											database::getInstance()->notify_lab2($_GET['pid']);
										}
										exit();
									}
								}else{
									$update_payment = mysqli_query($db, "UPDATE payment SET payment_status = 1 WHERE patient_id = ".$_GET['pid']." AND reference LIKE '".$_GET['link']."'");
									$update_prescription = mysqli_query($db, "UPDATE prescription SET status = 1 WHERE patient_id = ".$_GET['pid']." AND reference LIKE '".$_GET['link']."'");
									if ($update_prescription AND $update_payment) {
										header("Location: index.php?part_pay=paid");
										$itm = database::getInstance()->get_name_from_id2("item","accounts","order_id",$_GET['link']);
										if ($itm == "3" || $itm == 3) {
											database::getInstance()->notify_lab2($_GET['pid']);
										}
										exit();
									}
								}
							}
						}
				}elseif($pay3 == $amount AND $pay3 -$amount == 0){
						$sql = mysqli_query($db, "UPDATE accounts SET payment_status = 1, amount = '".$i3."', cash = '".($cash + $run_it['cash'])."', bank = '".($bank + $run_it['bank'])."', bank_used = '".$bank_used."',date_paid = NOW() WHERE patient_id = ".$_GET['pid']." AND id = ".$_GET['id']."");
						if ($sql) {
									header("Location: index.php?part_pay=paid");
									$itm = database::getInstance()->get_name_from_id2("item","accounts","order_id",$_GET['link']);
									if ($itm == "3" || $itm == 3) {
										database::getInstance()->notify_lab2($_GET['pid']);
									}
									exit();
						}
				}else{
					header("Location: index.php?part_pay=error3");
									exit();
				}
		}else{
			header("Location: index.php?part_pay?error4");
						exit();
		}
	}
}
?>
