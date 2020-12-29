<?php
	ob_start();
	session_start();
	$pageTitle = "Payments";
	// Include database class
	include_once '../inc/db.php';

	If(!isset($_SESSION['userSession'])){
		header("Location: ../index");
		exit;
	}
	elseif (isset($_SESSION['userSession'])){
		$user_id = $_SESSION['userSession'];
	}
	include_once '../inc/header-index.php'; //for addding header
	$ref = $_GET['id'];
	$amo =  $_GET['amount'];

	$j = explode(",", $ref);
		if (isset($_GET['part_pay']) AND $_GET['part_pay'] == 1) {
		?>
		<style type="text/css">
			#Part_payment{
				display: block;
			}
		</style>
		<?php
		$tatp = $_GET['top'];
		$cps = $_GET['payst'];
		$pypat_id = $_GET['pid'];
		$bal = $_GET['ccah'];
		$ppid = $_GET['pid'];
		$link = $_GET['tlink'];
	}

		if (isset($_GET['company_bill']) AND $_GET['company_bill'] == 1) {
		?>
		<style type="text/css">
			#company_bill{
				display: block;
			}
		</style>
		<?php
		$comp_pay = $_GET['amount'];
		$comp_stat = $_GET['payst'];
		$comp_pid = $_GET['pid'];
		$comp_oid = $_GET['oid'];
		$comp_front_desk = $_GET['id'];
	}
?> 
<style type="text/css">
	.jumbotron{
  background: none;
}
#jumbotron-bg{
  background-color: green;
}
</style>
<div class="wrapper">
	<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
    	 <?php include 'inc/main_header.php';?>

		<div class="content">
            <div class="container-fluid">
			
			
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">View Details Of Payment </h4>
                               <div class="row">
                               	<?php 
                               	$data1 = database::getInstance()->sum_where2('accounts','amount', 'front_desk', $ref,'patient_id', $_GET['pid']);
                               	 ?>
                               	<div class="col-lg-4">
                               		 <h4>Total: <b style="color: brown;"><?php echo $amo; ?></b></h4>
                               	</div>
                               	
                               		<div class="col-lg-4">
                               		 	<h4>Paid: <b style="color: green;"><?php echo $data1; ?></b></h4>
                               		</div>

                               		<div class="col-lg-4">
                               		 	<h4>Pending: <b style="color: red;"><?php echo $amo - $data1; ?></b></h4>
                               		</div>
                               </div>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                    	<th>Item</th>
                                    	<th>Amount To Be Paid</th>
                                    	<th>Amount Paid</th>
                                    	<th>Balance</th>
                                    	<th>Status</th>
                                    	<th>Last Pay Date</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									 		<?php 
									 				$count = 1; 
													$notarray = database::getInstance()->select_from_where60('accounts','patient_id', $_GET['pid'],'id');
													foreach($notarray as $rowa):
														$type = $rowa['item'];
														$to_pay = $rowa['to_pay'];
														$amount = $rowa['amount'];
														$balance = intval($to_pay) - intval($amount);
														$patient_id = $rowa['patient_id'];
														$appointment_id = $rowa['app_id'];
														$status = $rowa['payment_status']; 
														$date = $rowa['date_paid'];
														$oid = $rowa['order_id'];
														$rid = $rowa['id'];	
														if ($appointment_id != 0) {
															$frnt =$oid;
														}else{
															$frnt = $ref;
														}										
														if($type == 2) {
														$db = mysqli_connect("localhost","root","","noahhms");
														$type_n = mysqli_query($db,"SELECT * FROM payment_type WHERE payment_type_id = ".$type."");
														$type_na = mysqli_fetch_assoc($type_n);
														$type_name = $type_na['payment_type'];								
														$notarray2 = database::getInstance()->select_from_where60('patient_test', 'link_ref',$oid,'patient_test_id');
														foreach ($notarray2 as $row => $vali) {
															$lab_test_id = $vali['lab_test_id'];
															$notarray3 = database::getInstance()->select_from_where2('lab_test', 'lab_test_id',$lab_test_id );
															foreach ($notarray3 as $row2 => $a) {
																$lab_test .= $a['lab_test'].",<br>";
															}
														}
														
														?>
															<tr>
																<td><?php echo $count++;?></td>
																<td><?php echo substr(trim($lab_test), 0,-5); ?></td>
																<td style="color: brown;">&#x20A6;<?php echo $to_pay;?></td>
																<td style="color: green;">&#x20A6;<?php echo $amount;?></td>
																<td style="color: red;">&#x20A6;<?php echo $balance;?></td>
																<td>
																	<?php 
																		if ($status == 0) {
																			$stat = "Pending";
																		}elseif ($status == 1) {
																			$stat = "Paid";
																		}elseif ($status == 2) {
																			$stat = "Paid Part";
																		}elseif ($status == 3) {
																			$stat = "Company Bill";
																		}elseif ($status == 4) {
																			$stat = "Deffered Payment";
																		}else{
																			$stat = "Waved";
																		}
																		echo $stat;
																		?>																	
																</td>
																<td><?php echo $date; ?></td>
																<td>
																	<div class="btn-group right" style="margin-right: 20px;">
													<button type="button" class="btn btn-info">Make Payment</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<?php if($status == 0){ ?>
													<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Wave Payment</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a onclick="accept('<?php echo $oid; ?>','1','<?php echo substr($to_pay, 0, -3); ?>','<?php echo $patient_id; ?>')">Full Payment</a></li>
														
													<?php }elseif($status == 1 || $status == 3 || $status == 4 || $status == 5){ ?>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>',<?php echo $patient_id; ?>)">Cancel Payment</a></li>
													<?php }elseif ($status == 2) {
														?>
														<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Wave Payment</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a onclick="accept('<?php echo $oid; ?>','1','<?php echo substr($to_pay, 0, -3); ?>','<?php echo $patient_id; ?>')">Full Payment</a></li>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>',<?php echo $patient_id; ?>)">Cancel Payment</a></li>
														<?php
													} ?>
													</ul>
												</div>
																</td>
															</tr>
													<?php
													}elseif ($type == 3) {
														$notarray = database::getInstance()->select_from_where2('prescription', 'reference',$oid);
															foreach($notarray as $row):
															$pharm_stock_id = $row['pharm_stock_id'];
															$status = $row['status'];
																$notarray = database::getInstance()->select_from_where2('pharm_stock', 'id',$pharm_stock_id );
																foreach($notarray as $row):
																	$name = $row['name']; 
																	?>
																	<tr>
																		<td><?php echo $count++;?></td>
																		<td><?php echo $name;?></td>
																<td style="color: brown;">&#x20A6;<?php echo $to_pay;?></td>
																<td style="color: green;">&#x20A6;<?php echo $amount;?></td>
																<td style="color: red;">&#x20A6;<?php echo $balance;?></td>
																		<td>
																	<?php 
																		if ($status == 0) {
																			$stat = "Pending";
																		}elseif ($status == 1) {
																			$stat = "Paid";
																		}elseif ($status == 2) {
																			$stat = "Paid Part";
																		}elseif ($status == 3) {
																			$stat = "Company Bill";
																		}elseif ($status == 4) {
																			$stat = "Deffered Payment";
																		}else{
																			$stat = "Waved";
																		}
																		echo $stat;
																	?>																	
																</td>
																<td><?php echo $date; ?></td>
																<td>
																	<div class="btn-group right" style="margin-right: 20px;">
													<button type="button" class="btn btn-info">Make Payment</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<?php if($status == 0){ ?>
													<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Wave Payment</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a onclick="accept('<?php echo $oid; ?>','1','<?php echo substr($to_pay, 0, -3); ?>','<?php echo $patient_id; ?>')">Full Payment</a></li>
														
													<?php }elseif($status == 1 || $status == 3 || $status == 4 || $status == 5){ ?>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>',<?php echo $patient_id; ?>)">Cancel Payment</a></li>
													<?php }elseif ($status == 2) {
														?>
														<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Wave Payment</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a onclick="accept('<?php echo $oid; ?>','1','<?php echo substr($to_pay, 0, -3); ?>','<?php echo $patient_id; ?>')">Full Payment</a></li>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>',<?php echo $patient_id; ?>)">Cancel Payment</a></li>
														<?php
													} ?>
													</ul>
												</div>
																</td>
																	</tr>
															<?php endforeach;
															endforeach;
													}elseif ($type == 5) {
														$notarray = database::getInstance()->select_from_where2('patients', 'id',$patient_id );
															foreach($notarray as $row):
															$card_type = $row['card_type'];

																$notarray = database::getInstance()->select_from_where2('card_types', 'id',$card_type );
																foreach($notarray as $row):
																	$name = $row['name'];
																	$price = $row['cost']; ?>
																	<tr>
																		<td><?php echo $count++;?></td>
																		<td><?php echo $name;?></td>
																<td style="color: brown;">&#x20A6;<?php echo $price;?></td>
																<td style="color: green;">&#x20A6;<?php echo $amount;?></td>
																<td style="color: red;">&#x20A6;<?php echo $balance;?></td>
																		<td>
																	<?php 
																		if ($status == 0) {
																			$stat = "Pending";
																		}elseif ($status == 1) {
																			$stat = "Paid";
																		}elseif ($status == 2) {
																			$stat = "Paid Part";
																		}elseif ($status == 3) {
																			$stat = "Company Bill";
																		}elseif ($status == 4) {
																			$stat = "Deffered Payment";
																		}else{
																			$stat = "Waved";
																		}
																		echo $stat;
																	?>																	
																</td>
																<td><?php echo $date; ?></td>
																<td>
																	<div class="btn-group right" style="margin-right: 20px;">
													<button type="button" class="btn btn-info">Make Payment</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<?php if($status == 0){ ?>
													<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Wave Payment</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a onclick="accept('<?php echo $oid; ?>','1','<?php echo substr($to_pay, 0, -3); ?>','<?php echo $patient_id; ?>')">Full Payment</a></li>
														
													<?php }elseif($status == 1 || $status == 3 || $status == 4 || $status == 5){ ?>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>',<?php echo $patient_id; ?>)">Cancel Payment</a></li>
													<?php }elseif ($status == 2) {
														?>
														<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Wave Payment</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a onclick="accept('<?php echo $oid; ?>','1','<?php echo substr($to_pay, 0, -3); ?>','<?php echo $patient_id; ?>')">Full Payment</a></li>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>',<?php echo $patient_id; ?>)">Cancel Payment</a></li>
														<?php
													} ?>
													</ul>
												</div>
																</td>
																	</tr>
															<?php endforeach;
															endforeach;
													}elseif ($type == 6) {
														$notarray = database::getInstance()->select_from_where2("xray_requests","link",$frnt);
																	?>
																	<tr>
																		<td><?php echo $count++;?></td>
																		<td><?php
																			foreach ($notarray as $ky) {
																				$get_xray = database::getInstance()->select_from_where2("xray","id",$ky['name']);
																				foreach ($get_xray as $ke) {			
																				$xname .= $ke['name'].",<br>";
																				}
																			}
																			echo substr(trim($xname), 0, -5);
																		?></td>
																<td style="color: brown;">&#x20A6;<?php echo $to_pay;?></td>
																<td style="color: green;">&#x20A6;<?php echo $amount;?></td>
																<td style="color: red;">&#x20A6;<?php echo $balance;?></td>
																		<td>
																	<?php 
																		if ($status == 0) {
																			$stat = "Pending";
																		}elseif ($status == 1) {
																			$stat = "Paid";
																		}elseif ($status == 2) {
																			$stat = "Paid Part";
																		}elseif ($status == 3) {
																			$stat = "Company Bill";
																		}elseif ($status == 4) {
																			$stat = "Deffered Payment";
																		}else{
																			$stat = "Waved";
																		}
																		echo $stat;
																	?>																	
																</td>
																<td><?php echo $date; ?></td>
																<td>
																	<div class="btn-group right" style="margin-right: 20px;">
													<button type="button" class="btn btn-info">Make Payment</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<?php if($status == 0){ ?>
													<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Wave Payment</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a onclick="accept('<?php echo $oid; ?>','1','<?php echo substr($to_pay, 0, -3); ?>','<?php echo $patient_id; ?>')">Full Payment</a></li>
														
													<?php }elseif($status == 1 || $status == 3 || $status == 4 || $status == 5){ ?>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>',<?php echo $patient_id; ?>)">Cancel Payment</a></li>
													<?php }elseif ($status == 2) {
														?>
														<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Wave Payment</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a onclick="accept('<?php echo $oid; ?>','1','<?php echo substr($to_pay, 0, -3); ?>','<?php echo $patient_id; ?>')">Full Payment</a></li>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>',<?php echo $patient_id; ?>)">Cancel Payment</a></li>
														<?php
													} ?>
													</ul>
												</div>
																</td>
																	</tr>												
															<?php
													}elseif($type == 7) {
														$db = mysqli_connect("localhost","root","","noahhms");
														$type_n = mysqli_query($db,"SELECT * FROM payment_type WHERE payment_type_id = ".$type."");
														$type_na = mysqli_fetch_assoc($type_n);
														$type_name = $type_na['payment_type'];								
														$fee = 2500;
														?>
															<tr>
																<td><?php echo $count++;?></td>
																<td>Physiotherapy Session</td>
																<td style="color: brown;">&#x20A6;<?php echo $fee;?></td>
																<td style="color: green;">&#x20A6;<?php echo $amount;?></td>
																<td style="color: red;">&#x20A6;<?php echo $balance;?></td>
																<td>
																	<?php 
																		if ($status == 0) {
																			$stat = "Pending";
																		}elseif ($status == 1) {
																			$stat = "Paid";
																		}elseif ($status == 2) {
																			$stat = "Paid Part";
																		}elseif ($status == 3) {
																			$stat = "Company Bill";
																		}elseif ($status == 4) {
																			$stat = "Deffered Payment";
																		}else{
																			$stat = "Waved";
																		}
																		echo $stat;
																		?>																	
																</td>
																<td><?php echo $date; ?></td>
																<td>
																	<div class="btn-group right" style="margin-right: 20px;">
													<button type="button" class="btn btn-info">Make Payment</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<?php if($status == 0){ ?>
													<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Wave Payment</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a onclick="accept('<?php echo $oid; ?>','1','<?php echo substr($to_pay, 0, -3); ?>','<?php echo $patient_id; ?>')">Full Payment</a></li>
														
													<?php }elseif($status == 1 || $status == 3 || $status == 4 || $status == 5){ ?>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>',<?php echo $patient_id; ?>)">Cancel Payment</a></li>
													<?php }elseif ($status == 2) {
														?>
														<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Wave Payment</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a onclick="accept('<?php echo $oid; ?>','1','<?php echo substr($to_pay, 0, -3); ?>','<?php echo $patient_id; ?>')">Full Payment</a></li>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>',<?php echo $patient_id; ?>)">Cancel Payment</a></li>
														<?php
													} ?>
													</ul>
												</div>
																</td>
															</tr>
													<?php
													}elseif($type == 8) {
														$db = mysqli_connect("localhost","root","","noahhms");
														$type_n = mysqli_query($db,"SELECT * FROM payment_type WHERE payment_type_id = ".$type."");
														$type_na = mysqli_fetch_assoc($type_n);
														$type_name = $type_na['payment_type'];
	
														$fee = $to_pay;
														?>
															<tr>
																<td><?php echo $count++;?></td>
																<td><?php echo $type_name; ?></td>
																<td style="color: brown;">&#x20A6;<?php echo $fee;?></td>
																<td style="color: green;">&#x20A6;<?php echo $amount;?></td>
																<td style="color: red;">&#x20A6;<?php echo $balance;?></td>
																<td>
																	<?php 
																		if ($status == 0) {
																			$stat = "Pending";
																		}elseif ($status == 1) {
																			$stat = "Paid";
																		}elseif ($status == 2) {
																			$stat = "Paid Part";
																		}elseif ($status == 3) {
																			$stat = "Company Bill";
																		}elseif ($status == 4) {
																			$stat = "Deffered Payment";
																		}else{
																			$stat = "Waved";
																		}
																		echo $stat;
																		?>																	
																</td>
																<td><?php echo $date; ?></td>
																<td>
																	<div class="btn-group right" style="margin-right: 20px;">
													<button type="button" class="btn btn-info">Make Payment</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<?php if($status == 0){ ?>
													<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Wave Payment</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a onclick="accept('<?php echo $oid; ?>','1','<?php echo substr($to_pay, 0, -3); ?>','<?php echo $patient_id; ?>')">Full Payment</a></li>
														
													<?php }elseif($status == 1 || $status == 3 || $status == 4 || $status == 5){ ?>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>',<?php echo $patient_id; ?>)">Cancel Payment</a></li>
													<?php }elseif ($status == 2) {
														?>
														<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Wave Payment</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a onclick="accept('<?php echo $oid; ?>','1','<?php echo substr($to_pay, 0, -3); ?>','<?php echo $patient_id; ?>')">Full Payment</a></li>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>',<?php echo $patient_id; ?>)">Cancel Payment</a></li>
														<?php
													} ?>
													</ul>
												</div>
																</td>
															</tr>
													<?php
													}elseif($type == 9) {
														$type_name = 'In-patient Bill';
														$fee = $to_pay;
														?>
															<tr>
																<td><?php echo $count++;?></td>
																<td><?php echo $type_name; ?></td>
																<td style="color: brown;">&#x20A6;<?php echo $fee;?></td>
																<td style="color: green;">&#x20A6;<?php echo $amount;?></td>
																<td style="color: red;">&#x20A6;<?php echo $balance;?></td>
																<td>
																	<?php 
																		if ($status == 0) {
																			$stat = "Pending";
																		}elseif ($status == 1) {
																			$stat = "Paid";
																		}elseif ($status == 2) {
																			$stat = "Paid Part";
																		}elseif ($status == 3) {
																			$stat = "Company Bill";
																		}elseif ($status == 4) {
																			$stat = "Deffered Payment";
																		}else{
																			$stat = "Waved";
																		}
																		echo $stat;
																		?>																	
																</td>
																<td><?php echo $date; ?></td>
																<td>
																	<div class="btn-group right" style="margin-right: 20px;">
													<button type="button" class="btn btn-info">Make Payment</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<?php if($status == 0){ ?>
													<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Wave Payment</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a onclick="accept('<?php echo $oid; ?>','1','<?php echo substr($to_pay, 0, -3); ?>','<?php echo $patient_id; ?>')">Full Payment</a></li>
														
													<?php }elseif($status == 1 || $status == 3 || $status == 4 || $status == 5){ ?>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>',<?php echo $patient_id; ?>)">Cancel Payment</a></li>
													<?php }elseif ($status == 2) {
														?>
														<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Wave Payment</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a onclick="accept('<?php echo $oid; ?>','1','<?php echo substr($to_pay, 0, -3); ?>','<?php echo $patient_id; ?>')">Full Payment</a></li>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>',<?php echo $patient_id; ?>)">Cancel Payment</a></li>
														<?php
													} ?>
													</ul>
												</div>
																</td>
															</tr>
													<?php
													}elseif($type == 11) {
														$type_name = 'Immunization';
														$fee = $to_pay;
														?>
															<tr>
																<td><?php echo $count++;?></td>
																<td><?php echo $type_name; ?></td>
																<td style="color: brown;">&#x20A6;<?php echo $fee;?></td>
																<td style="color: green;">&#x20A6;<?php echo $amount;?></td>
																<td style="color: red;">&#x20A6;<?php echo $balance;?></td>
																<td>
																	<?php 
																		if ($status == 0) {
																			$stat = "Pending";
																		}elseif ($status == 1) {
																			$stat = "Paid";
																		}elseif ($status == 2) {
																			$stat = "Paid Part";
																		}elseif ($status == 3) {
																			$stat = "Company Bill";
																		}elseif ($status == 4) {
																			$stat = "Deffered Payment";
																		}else{
																			$stat = "Waved";
																		}
																		echo $stat;
																		?>																	
																</td>
																<td><?php echo $date; ?></td>
																<td>
																	<div class="btn-group right" style="margin-right: 20px;">
													<button type="button" class="btn btn-info">Make Payment</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<?php if($status == 0){ ?>
													<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Wave Payment</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a onclick="accept('<?php echo $oid; ?>','1','<?php echo substr($to_pay, 0, -3); ?>','<?php echo $patient_id; ?>')">Full Payment</a></li>
														
													<?php }elseif($status == 1 || $status == 3 || $status == 4 || $status == 5){ ?>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>',<?php echo $patient_id; ?>)">Cancel Payment</a></li>
													<?php }elseif ($status == 2) {
														?>
														<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Wave Payment</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a onclick="accept('<?php echo $oid; ?>','1','<?php echo substr($to_pay, 0, -3); ?>','<?php echo $patient_id; ?>')">Full Payment</a></li>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>',<?php echo $patient_id; ?>)">Cancel Payment</a></li>
														<?php
													} ?>
													</ul>
												</div>
																</td>
															</tr>
													<?php
													}elseif($type == 12) {
														$type_name = 'Family Card';
														$fee = $to_pay;
														?>
															<tr>
																<td><?php echo $count++;?></td>
																<td><?php echo $type_name; ?></td>
																<td style="color: brown;">&#x20A6;<?php echo $fee;?></td>
																<td style="color: green;">&#x20A6;<?php echo $amount;?></td>
																<td style="color: red;">&#x20A6;<?php echo $balance;?></td>
																<td>
																	<?php 
																		if ($status == 0) {
																			$stat = "Pending";
																		}elseif ($status == 1) {
																			$stat = "Paid";
																		}elseif ($status == 2) {
																			$stat = "Paid Part";
																		}elseif ($status == 3) {
																			$stat = "Company Bill";
																		}elseif ($status == 4) {
																			$stat = "Deffered Payment";
																		}else{
																			$stat = "Waved";
																		}
																		echo $stat;
																		?>																	
																</td>
																<td><?php echo $date; ?></td>
																<td>
																	<div class="btn-group right" style="margin-right: 20px;">
													<button type="button" class="btn btn-info">Make Payment</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<?php if($status == 0){ ?>
													<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Wave Payment</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a onclick="accept('<?php echo $oid; ?>','1','<?php echo substr($to_pay, 0, -3); ?>','<?php echo $patient_id; ?>')">Full Payment</a></li>
														
													<?php }elseif($status == 1 || $status == 3 || $status == 4 || $status == 5){ ?>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>',<?php echo $patient_id; ?>)">Cancel Payment</a></li>
													<?php }elseif ($status == 2) {
														?>
														<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Wave Payment</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,<?php echo $patient_id; ?>)">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a onclick="accept('<?php echo $oid; ?>','1','<?php echo substr($to_pay, 0, -3); ?>','<?php echo $patient_id; ?>')">Full Payment</a></li>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>',<?php echo $patient_id; ?>)">Cancel Payment</a></li>
														<?php
													} ?>
													</ul>
												</div>
																</td>
															</tr>
													<?php
													}
												endforeach;
									 		
									 		?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
                                    	<th>Item</th>
                                    	<th>Amount To Be Paid</th>
                                    	<th>Amount Paid</th>
                                    	<th>Balance</th>
                                    	<th>Status</th>
                                    	<th>Last Pay Date</th>
                                    	<th>Action</th>
                                    </thead>
								</table>

                            </div>
                        </div>
                    </div>
                 </div>



            </div>
        </div>
	 <!-- //MAIN -->
		<!--  footer -->
		
	<?php include '../inc/footer-index.php';?>
	<!--//footer -->
        
    </div>

</div>

<?php include 'pay.php'; ?>
<div class="loader" id="load" style="display:none ">
</div>

	<script type="text/javascript">
	var s=jQuery .noConflict();
	s(function () {
    s("#pro").DataTable();
  });
  
		
		function update(ID,stat){ 

        	s.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to accept payment of <b>"+name+"</b> ? </br><button type='button' class='btn pop-btn' onclick='accept("+ID+")'>Accept</button>"

            },{
                type: 'danger',
                timer: 100000
            });

    	}
		
		function accept(ID,stat,amount,pid){ 
		var val = ID;
		var status = stat;
		var amount = amount;
		var pid = pid;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/edit.php',
            data: "val=" + val +  '&pid='+ pid +'&ins=acceptPayment'+'&status='+ status + '&amount=' + amount,
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'payment_daily';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}
		
		function cancel(ID,name,pid){ 

        	s.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to cancel payment for <b>"+name+"</b> ? </br><button type='button' class='btn pop-btn' onclick='accept(`"+ID+"`,0,0,"+pid+")'>Accept</button>"

            },{
                type: 'danger',
                timer: 100000
            });

    	}
		
		function canc(ID,pid){ 
		var val = ID;
		var pid = pid;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/edit.php',
            data: "val=" + val +  '&ins=acceptPayment2'+'pid=' + pid,
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data == 'Done') {
					console.log(data);
						window.location = 'payment_daily';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}
function defer_all(ID){
	var val = ID;

	document.getElementById("load").style.display = "block";
	s.ajax({
		type: 'post',
		url: '../func/pay.php',
		data: "val=" + val + '&ins=deferPayment_all',
		success: function(data)
		{
			document.getElementById("load").style.display = "block";
			if (data == 'Done') {
				console.log(data);
				document.getElementById("Part_payment").style.display = "block";
			}else{
				jQuery('#get_det'+ID).html(data).show();
			}
		}
	});
}


function accept_all(ID){
	var val = ID;

	document.getElementById("load").style.display = "block";
	s.ajax({
		type: 'post',
		url: '../func/pay.php',
		data: "val=" + val + '&ins=acceptPayment_all',
		success: function(data)
		{
			document.getElementById("load").style.display = "block";
			if (data == 'Done') {
				console.log(data);
				document.getElementById("Part_payment").style.display = "block";
			}else{
				jQuery('#get_det'+ID).html(data).show();
			}
		}
	});
}

function cancel_all(ID){
	var val = ID;

	document.getElementById("load").style.display = "block";
	s.ajax({
		type: 'post',
		url: '../func/pay.php',
		data: "val=" + val + '&ins=cancelPayment_all',
		success: function(data)
		{
			document.getElementById("load").style.display = "block";
			if (data == 'Done') {
				console.log(data);
				document.getElementById("Part_payment").style.display = "block";
			}else{
				jQuery('#get_det'+ID).html(data).show();
			}
		}
	});
}

function company_bill_all(ID){
	var val = ID;

	document.getElementById("load").style.display = "block";
	s.ajax({
		type: 'post',
		url: '../func/pay.php',
		data: "val=" + val + '&ins=company_bill_all',
		success: function(data)
		{
			document.getElementById("load").style.display = "block";
			if (data === 'Done') {
				console.log(data);
				document.getElementById("load").style.display = "none";
			}else{
				jQuery('#get_det'+ID).html(data).show();
			}
		}
	});
}
function show_comp_all() {
	document.getElementById("company_bill").style.display = "block";
}
    </script>}
