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
		if (isset($_GET['nstat']) AND $_GET['nstat'] == 1) {
			if (isset($_GET['nid'])) {
				Database::getInstance()->notify_viewed($_GET['nid']);
			}
		}
		if (!isset($_GET['page'])) {
			$pn = 1;
		}else{
			$pn=$_GET['page'];
		}
	}
	include_once '../inc/header-index.php'; //for addding header
	$ref = $_GET['id'];
	$amo =  $_GET['amount'];
	$tariff = Database::getInstance()->get_name_from_id("tariff","patients","id",$_GET['pid']);
	$sent_t = Database::getInstance()->get_name_from_id("HMO","accounts","patient_id",$_GET['pid']);
	$tstat = Database::getInstance()->get_name_from_id("payment_status","accounts","patient_id",$_GET['pid']);
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

	if (isset($_GET['fullPayment']) AND $_GET['fullPayment'] == 1) {
		?>
		<style type="text/css">
			#fullPayment1{
				display: block;
			}
		</style>
		<?php
		$amt = $_GET['amount1'];
		$pat = $_GET['patient'];
		$oids = $_GET['oid'];
		$dstat = $_GET['stat'];
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
                            	<?php 
                            		$pnam = database::getInstance()->select_from_where2("patients","id",$_GET['pid']);
                            		foreach ($pnam as $value) {
												 $crd = $value['card_type'];
												 $fam = $value['family_id'];
												 $comp_i = $value['company_id'];
                            			$blub = $value['title']." ".$value['surname']." ".$value['first_name']." ".$value['middle_name'];
                            		}
                            	 ?>
                                <h4 class="title">View Details Of Payment for <b><?php echo $blub; ?></b></h4>
                                <?php
											if ($crd == 19) {
												?>

												<?php
											}else if($crd == 11){
												?>
												<p class="text-center" style="text-align:center">Card Type: <?php echo Database::getInstance()->get_name_from_id('name','card_types','id',$crd);?></p>
												<p class="text-center" style="text-align:center">Company Name: <?php echo Database::getInstance()->get_name_from_id('company_name','companies','id',$comp_i);?></p>
												<?php
											}else if($crd == 20){
												?>
												<p class="text-center" style="text-align:center">Card Type: <?php echo Database::getInstance()->get_name_from_id('name','card_types','id',$crd);?></p>
												<p class="text-center" style="text-align:center">Family Name: <?php echo Database::getInstance()->get_name_from_id('family_name','families','id',$fam);?></p>
												<?php
											}else{
												?>
												<p class="text-center" style="text-align:center">Card Type: <?php echo Database::getInstance()->get_name_from_id('name','card_types','id',$crd);?></p>
												<?php
											}
										?>
										<?php
											if ($tariff != 0 && $sent_t == 0 || $sent_t != 0 ) {
												?>
												<div class="row">
													<div class="right" style="margin-right: 40px;">
														<button class="btn btn-info" onclick="hmoSend(`<?php echo $_GET['pid']; ?>`,`<?php echo $tariff; ?>`,`4`)">Send To HMO</button>
													</div>
												</div>
												<?php
											}else if($tariff != 0 && $sent_t > 0 && $tstat == 4){
												?>
												<div class="row">
													<div class="right" style="margin-right: 40px;">
														<button class="btn btn-info" onclick="hmoSend(`<?php echo $_GET['pid']; ?>`,`<?php echo $tariff; ?>`,`0`)">Cancel Sent To HMO</button>
													</div>
												</div>
												<?php
											}
										?>
										
                                <div class="row">
                               	<?php 
                               	$data1 = database::getInstance()->sum_where21('accounts','amount', 'front_desk', $_GET['id'],'patient_id', $_GET['pid']);

                               	$inv = database::getInstance()->sum_where2('accounts','amount', 'front_desk', $_GET['id'],'payment_status',5);
                               	 ?>
                               	<div class="col-lg-4">
                               		 <h4>Total: <b style="color: brown;"><?php echo "&#8358;".number_format($amo); ?></b></h4>
                               	</div>
                               	
                               		<div class="col-lg-4">
                               		 	<h4>Paid: <b style="color: green;"><?php echo "&#8358;".number_format($data1); ?></b></h4>
                               		</div>

                               		<div class="col-lg-4">
                               		 	<h4>Balance: <b style="color: red;"><?php echo "&#8358;".number_format($bala =$amo - $data1 - $inv); ?></b></h4>
                               		</div>
                               </div>
                            </div>
                            <form method="POST" action="print.php?id=<?php echo $_GET['pid']; ?>&balance=<?php echo $bala; ?>&cashier=<?php echo $user_id; ?>">
                            	<div class="row">
													<div class="left" style="margin-left: 40px;">
														<button class="btn btn-info" onclick="this.submit();">Print Reciept</button>
													</div>
												</div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
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
													$notarray = database::getInstance()->select_from_where61_ord('accounts','front_desk', $ref,'patient_id',$_GET['pid'],'id',$pn);

													//total pages
													$totalPages = database::getInstance()->select_from_where61_ord('accounts','front_desk', $ref,'patient_id',$_GET['pid'],'id');

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
															$var = 1;
														$db = mysqli_connect("localhost","root","","noahhms");
														$type_n = mysqli_query($db,"SELECT * FROM payment_type WHERE payment_type_id = ".$type."");
														$type_na = mysqli_fetch_assoc($type_n);
														$type_name = $type_na['payment_type'];								
														$notarray2 = database::getInstance()->select_from_where60('patient_test', 'link_ref',$oid,'patient_test_id');
														foreach ($notarray2 as $row => $vali) {
															$lab_test_id = $vali['lab_test_id'];
															$notarray3 = database::getInstance()->select_from_where2('lab_test', 'lab_test_id',$lab_test_id );
															foreach ($notarray3 as $row2 => $a) {
																$lab_test.$var .= $a['lab_test'].",<br>";
																$fee += intval($a['fee']); 
															}
														}
														?>
															<tr>
																<td><input type="checkbox" name="pri[]" class="form-control" value="<?php echo $rid;?>"></td>
																<td><?php echo substr(trim($lab_test.$var),1,-5);$var++; ?></td>
																<td>&#x20A6;<?php echo number_format($fee);?></td>
																<td>&#x20A6;<?php echo number_format($amount);?></td>
																<td>&#x20A6;<?php echo number_format($balance);?></td>
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
																		}elseif ($status == 6) {
																			$stat = "Automatic Expenditure";
																		}else{
																			$stat = "Invalidate";
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
													<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Invalidate</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li>
															<a href="fmodal.php?oid=<?php echo $oid; ?>&stat=1&amount1=<?php echo $to_pay; ?>&amount=<?php echo $_GET['amount']; ?>&patient=<?php echo $patient_id; ?>&some_id=<?php echo $_GET['id']; ?>">Full Payment</a></li>
														<li><a onclick="exp('<?php echo $rid; ?>')">Automatic Expenditure</a></li>
														
													<?php }elseif($status == 1 || $status == 3 || $status == 4 || $status == 5 || $status == 6 && $status != 2 ){ ?>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>','<?php echo $patient_id; ?>')">Cancel Payment</a></li>
													<?php }elseif ($status == 2) {
														?>
														<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Invalidate</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a href="fmodal.php?oid=<?php echo $oid; ?>&stat=1&amount1=<?php echo $to_pay; ?>&amount=<?php echo $_GET['amount']; ?>&patient=<?php echo $patient_id; ?>&some_id=<?php echo $_GET['id']; ?>">Full Payment</a></li>
														
														<li><a onclick="exp('<?php echo $rid; ?>')">Automatic Expenditure</a></li>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>','<?php echo $patient_id; ?>')">Cancel Payment</a></li>
														<?php
													} ?>
													</ul>
												</div>
																</td>
															</tr>
													<?php
													}elseif ($type == 3) {
														//twice in db so make it appear once
														$va = 0;
															$notarray = database::getInstance()->select_from_where2('prescription', 'reference',$oid);
																foreach($notarray as $row):
															$pharm_stock_id = $row['pharm_stock_id'];
																$notarray = database::getInstance()->select_from_where2('pharm_stock', 'id',$pharm_stock_id );
																foreach($notarray as $row):
																	$name1.$va .= $row['name'].",<br>	";
																	$price = $row['price']; 
																endforeach;
															endforeach;
																	?>
																	<tr>
																		<td><input type="checkbox" name="pri[]" value="<?php echo $rid;?>" class="form-control"></td>
																		<td><?php 
																		echo substr(trim($name1.$va),1,-6);$va++;
																		?></td>
																		<td>&#x20A6;<?php echo number_format($to_pay);?></td>
																		<td>&#x20A6;<?php echo number_format($amount);?></td>
																		<td>&#x20A6;<?php echo number_format($balance);?></td>
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
																		}elseif ($status == 6) {
																			$stat = "Automatic Expenditure";
																		}else{
																			$stat = "Invalidate";
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
													<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Invalidate</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a href="fmodal.php?oid=<?php echo $oid; ?>&stat=1&amount1=<?php echo $to_pay; ?>&amount=<?php echo $_GET['amount']; ?>&patient=<?php echo $patient_id; ?>&some_id=<?php echo $_GET['id']; ?>">Full Payment</a></li>
														<li><a onclick="exp('<?php echo $rid; ?>')">Automatic Expenditure</a></li>
														
													<?php }elseif($status == 1 || $status == 3 || $status == 4 || $status == 5 || $status == 6  && $status != 2 ){ ?>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>','<?php echo $patient_id; ?>')">Cancel Payment</a></li>
													<?php }elseif ($status == 2) {
														?>
														<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Invalidate</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a href="fmodal.php?oid=<?php echo $oid; ?>&stat=1&amount1=<?php echo $to_pay; ?>&amount=<?php echo $_GET['amount']; ?>&patient=<?php echo $patient_id; ?>&some_id=<?php echo $_GET['id']; ?>">Full Payment</a></li>
														<li><a onclick="exp('<?php echo $rid; ?>')">Automatic Expenditure</a></li>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>','<?php echo $patient_id; ?>')">Cancel Payment</a></li>
														<?php
													} ?>
													</ul>
												</div>
																</td>
																	</tr>
															<?php		
													}elseif ($type == 5) {
														$notarray = database::getInstance()->select_from_where2('patients', 'id',$patient_id );
															foreach($notarray as $row):
															$card_type = $row['card_type'];

																$notarray = database::getInstance()->select_from_where2('card_types', 'id',$card_type );
																foreach($notarray as $row):
																	$name = $row['name'];
																	$price = $row['cost']; ?>
																	<tr>
																		<td><input type="checkbox" name="pri[]" value="<?php echo $rid;?>" class="form-control"></td>
																		<td><?php echo $name;?></td>
																		<td>&#x20A6;<?php echo number_format($price);?></td>
																		<td>&#x20A6;<?php echo number_format($amount);?></td>
																		<td>&#x20A6;<?php echo number_format($balance);?></td>
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
																		}elseif ($status == 6) {
																			$stat = "Automatic Expenditure";
																		}else{
																			$stat = "Invalidate";
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
													<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Invalidate</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a href="fmodal.php?oid=<?php echo $oid; ?>&stat=1&amount1=<?php echo $to_pay; ?>&amount=<?php echo $_GET['amount']; ?>&patient=<?php echo $patient_id; ?>&some_id=<?php echo $_GET['id']; ?>">Full Payment</a></li>
														<li><a onclick="exp('<?php echo $rid; ?>')">Automatic Expenditure</a></li>
														
													<?php }elseif($status == 1 || $status == 3 || $status == 4 || $status == 5 || status == 6  && $status != 2 ){ ?>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>','<?php echo $patient_id; ?>')">Cancel Payment</a></li>
													<?php }elseif ($status == 2) {
														?>
														<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Invalidate</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a href="fmodal.php?oid=<?php echo $oid; ?>&stat=1&amount1=<?php echo $to_pay; ?>&amount=<?php echo $_GET['amount']; ?>&patient=<?php echo $patient_id; ?>&some_id=<?php echo $_GET['id']; ?>">Full Payment</a></li>
														<li><a onclick="exp('<?php echo $rid; ?>')">Automatic Expenditure</a></li>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>','<?php echo $patient_id; ?>')">Cancel Payment</a></li>
														<?php
													} ?>
													</ul>
												</div>
																</td>
																	</tr>
															<?php endforeach;
															endforeach;
													}elseif ($type == 6) {
														$notarray = database::getInstance()->select_from_scan_xray('xray_requests','patient_xray_group','link','link_ref','patient_id',$_GET['pid']);
														
														$notarray2 = database::getInstance()->select_from_scan_xray('scan_requests','patient_scan_group','link','link_ref','patient_id',$_GET['pid']);

															foreach ($notarray as $ky) {
																$get_xray = database::getInstance()->get_name_from_id("name","xray","id",$ky['name']);
																			if ($ky['link'] == $oid) {
																			$xname .= $get_xray.",<br>";
																		}
															}

															foreach ($notarray2 as $ky) {
																$get_xray = database::getInstance()->get_name_from_id("name","scan","id",$ky['name']);
																		if ($ky['link'] == $oid) {
																			$xname .= $get_xray.",<br>";
																		}
															}
														
														
																	?>
																	<tr>
																		<td><input type="checkbox" name="pri[]" value="<?php echo $rid;?>" class="form-control"></td>
																		<td><?php
																			echo substr(trim($xname),0,-5);$xname="";
																		?></td>
																		<td>&#x20A6;<?php echo number_format($to_pay);?></td>

																<td>&#x20A6;<?php echo number_format($amount);?></td>
																<td>&#x20A6;<?php echo number_format($balance);?></td>
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
																		}elseif ($status == 6) {
																			$stat = "Automatic Expenditure";
																		}else{
																			$stat = "Invalidate";
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
													<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Invalidate</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a href="fmodal.php?oid=<?php echo $oid; ?>&stat=1&amount1=<?php echo $to_pay; ?>&amount=<?php echo $_GET['amount']; ?>&patient=<?php echo $patient_id; ?>&some_id=<?php echo $_GET['id']; ?>">Full Payment</a></li>
														<li><a onclick="exp('<?php echo $rid; ?>')">Automatic Expenditure</a></li>
														
													<?php }elseif($status == 1 || $status == 3 || $status == 4 || $status == 5 || status == 6  && $status != 2 ){ ?>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>','<?php echo $patient_id; ?>')">Cancel Payment</a></li>
													<?php }elseif ($status == 2) {
														?>
														<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Invalidate</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a href="fmodal.php?oid=<?php echo $oid; ?>&stat=1&amount1=<?php echo $to_pay; ?>&amount=<?php echo $_GET['amount']; ?>&patient=<?php echo $patient_id; ?>&some_id=<?php echo $_GET['id']; ?>">Full Payment</a></li>
														<li><a onclick="exp('<?php echo $rid; ?>')">Automatic Expenditure</a></li>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>','<?php echo $patient_id; ?>')">Cancel Payment</a></li>
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
																<td><input type="checkbox" name="pri[]" class="form-control" value="<?php echo $rid;?>"></td>
																<td>Physiotherapy Session</td>
																<td>&#x20A6;<?php echo number_format($fee);?></td>
																<td>&#x20A6;<?php echo number_format($amount);?></td>
																<td>&#x20A6;<?php echo number_format($balance);?></td>
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
																		}elseif ($status == 6) {
																			$stat = "Automatic Expenditure";
																		}else{
																			$stat = "Invalidate";
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
													<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Invalidate</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a href="fmodal.php?oid=<?php echo $oid; ?>&stat=1&amount1=<?php echo $to_pay; ?>&amount=<?php echo $_GET['amount']; ?>&patient=<?php echo $patient_id; ?>&some_id=<?php echo $_GET['id']; ?>">Full Payment</a></li>
														<li><a onclick="exp('<?php echo $rid; ?>')">Automatic Expenditure</a></li>
													<?php }elseif($status == 1 || $status == 3 || $status == 4 || $status == 5 || $status == 6  && $status != 2 ){ ?>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>','<?php echo $patient_id; ?>')">Cancel Payment</a></li>
													<?php }elseif ($status == 2) {
														?>
														<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Invalidate</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a href="fmodal.php?oid=<?php echo $oid; ?>&stat=1&amount1=<?php echo $to_pay; ?>&amount=<?php echo $_GET['amount']; ?>&patient=<?php echo $patient_id; ?>&some_id=<?php echo $_GET['id']; ?>">Full Payment</a></li>
														<li><a onclick="exp('<?php echo $rid; ?>')">Automatic Expenditure</a></li>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>','<?php echo $patient_id; ?>')">Cancel Payment</a></li>
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
																<td><input type="checkbox" name="pri[]" class="form-control" value="<?php echo $rid;?>"></td>
																<td><?php echo $type_name; ?></td>
																<td>&#x20A6;<?php echo number_format($fee);?></td>
																<td>&#x20A6;<?php echo number_format($amount);?></td>
																<td>&#x20A6;<?php echo number_format($balance);?></td>
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
																		}elseif ($status == 6) {
																			$stat = "Automatic Expenditure";
																		}else{
																			$stat = "Invalidate";
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
													<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Invalidate</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a href="fmodal.php?oid=<?php echo $oid; ?>&stat=1&amount1=<?php echo $to_pay; ?>&amount=<?php echo $_GET['amount']; ?>&patient=<?php echo $patient_id; ?>&some_id=<?php echo $_GET['id']; ?>">Full Payment</a></li>
														<li><a onclick="exp('<?php echo $rid; ?>')">Automatic Expenditure</a></li>
													<?php }elseif($status == 1 || $status == 3 || $status == 4 || $status == 5 || status == 6  && $status != 2 ){ ?>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>','<?php echo $patient_id; ?>')">Cancel Payment</a></li>
													<?php }elseif ($status == 2) {
														?>
														<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Invalidate</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a href="fmodal.php?oid=<?php echo $oid; ?>&stat=1&amount1=<?php echo $to_pay; ?>&amount=<?php echo $_GET['amount']; ?>&patient=<?php echo $patient_id; ?>&some_id=<?php echo $_GET['id']; ?>">Full Payment</a></li>
														<li><a onclick="exp('<?php echo $rid; ?>')">Automatic Expenditure</a></li>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>','<?php echo $patient_id; ?>')">Cancel Payment</a></li>
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
																<td><input type="checkbox" name="pri[]" class="form-control" value="<?php echo $rid;?>"></td>
																<td><?php echo $type_name; ?></td>
																<td style="color: brown;">&#x20A6;<?php echo number_format($fee);?></td>
																<td style="color: green;">&#x20A6;<?php echo number_format($amount);?></td>
																<td style="color: red;">&#x20A6;<?php echo number_format($balance);?></td>
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
																		}elseif ($status == 6) {
																			$stat = "Automatic Expenditure";
																		}else{
																			$stat = "Invalidate";
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
													<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Invalidate</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a href="fmodal.php?oid=<?php echo $oid; ?>&stat=1&amount1=<?php echo $to_pay; ?>&amount=<?php echo $_GET['amount']; ?>&patient=<?php echo $patient_id; ?>&some_id=<?php echo $_GET['id']; ?>">Full Payment</a></li>
														<li><a onclick="exp('<?php echo $rid; ?>')">Automatic Expenditure</a></li>
													<?php }elseif($status == 1 || $status == 3 || $status == 4 || $status == 5 || status == 6  && $status != 2 ){ ?>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>','<?php echo $patient_id; ?>')">Cancel Payment</a></li>
													<?php }elseif ($status === 2) {
														?>
														<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Invalidate</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a href="fmodal.php?oid=<?php echo $oid; ?>&stat=1&amount1=<?php echo $to_pay; ?>&amount=<?php echo $_GET['amount']; ?>&patient=<?php echo $patient_id; ?>&some_id=<?php echo $_GET['id']; ?>">Full Payment</a></li>
														<li><a onclick="exp('<?php echo $rid; ?>')">Automatic Expenditure</a></li>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>','<?php echo $patient_id; ?>')">Cancel Payment</a></li>
														<?php
													} ?>
													</ul>
												</div>
																</td>
															</tr>
													<?php
													}elseif($type == 10) {

														$type_name = database::getInstance()->get_name_from_id_and_id2('description','in_sales','sales_id',$oid,'type',10);
														$fee = $to_pay;
														?>
															<tr>
																<td><input type="checkbox" name="pri[]" class="form-control" value="<?php echo $rid;?>"></td>
																<td><?php echo $type_name; ?></td>
																<td>&#x20A6;<?php echo number_format($fee);?></td>
																<td>&#x20A6;<?php echo number_format($amount);?></td>
																<td>&#x20A6;<?php echo number_format($balance);?></td>
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
																		}elseif ($status == 6) {
																			$stat = "Automatic Expenditure";
																		}else{
																			$stat = "Invalidate";
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
													<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Invalidate</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a href="fmodal.php?oid=<?php echo $oid; ?>&stat=1&amount1=<?php echo $to_pay; ?>&amount=<?php echo $_GET['amount']; ?>&patient=<?php echo $patient_id; ?>&some_id=<?php echo $_GET['id']; ?>">Full Payment</a></li>
														<li><a onclick="exp('<?php echo $rid; ?>')">Automatic Expenditure</a></li>
													<?php }elseif($status == 1 || $status == 3 || $status == 4 || $status == 5 || status == 6  && $status != 2 ){ ?>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>','<?php echo $patient_id; ?>')">Cancel Payment</a></li>
													<?php }elseif ($status == 2) {
														?>
														<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Invalidate</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a href="fmodal.php?oid=<?php echo $oid; ?>&stat=1&amount1=<?php echo $to_pay; ?>&amount=<?php echo $_GET['amount']; ?>&patient=<?php echo $patient_id; ?>&some_id=<?php echo $_GET['id']; ?>">Full Payment</a></li>
														<li><a onclick="exp('<?php echo $rid; ?>')">Automatic Expenditure</a></li>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>','<?php echo $patient_id; ?>')">Cancel Payment</a></li>
														<?php
													} ?>
													</ul>
												</div>
																</td>
															</tr>
													<?php
													}elseif($type == 11) {
														$type_name = 'Immunization Bill';
														$fee = $to_pay;
														?>
															<tr>
																<td><input type="checkbox" name="pri[]" class="form-control" value="<?php echo $rid;?>"></td>
																<td><?php echo $type_name; ?></td>
																<td style="color: brown;">&#x20A6;<?php echo number_format($fee);?></td>
																<td style="color: green;">&#x20A6;<?php echo number_format($amount);?></td>
																<td style="color: red;">&#x20A6;<?php echo number_format($balance);?></td>
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
																		}elseif ($status == 6) {
																			$stat = "Automatic Expenditure";
																		}else{
																			$stat = "Invalidate";
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
													<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Invalidate</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a href="fmodal.php?oid=<?php echo $oid; ?>&stat=1&amount1=<?php echo $to_pay; ?>&amount=<?php echo $_GET['amount']; ?>&patient=<?php echo $patient_id; ?>&some_id=<?php echo $_GET['id']; ?>">Full Payment</a></li>
														<li><a onclick="exp('<?php echo $rid; ?>')">Automatic Expenditure</a></li>
													<?php }elseif($status == 1 || $status == 3 || $status == 4 || $status == 5 || status == 6  && $status != 2 ){ ?>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>','<?php echo $patient_id; ?>')">Cancel Payment</a></li>
													<?php }elseif ($status == 2) {
														?>
														<li><a onclick="accept('<?php echo $oid; ?>',5,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Invalidate</a></li>
													<li><a href="modal2.php?id=<?php echo $_GET['id']; ?>&p=<?php echo $patient_id; ?>&oid=<?php echo $oid; ?>&amount=<?php echo $_GET['amount']; ?>">Company Billing</a></li>
													<li><a onclick="accept('<?php echo $oid; ?>',4,<?php echo substr($to_pay, 0, -3); ?>,'<?php echo $patient_id; ?>')">Defer Payment</a></li>
													<li><a href="modal.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
														<li><a href="fmodal.php?oid=<?php echo $oid; ?>&stat=1&amount1=<?php echo $to_pay; ?>&amount=<?php echo $_GET['amount']; ?>&patient=<?php echo $patient_id; ?>&some_id=<?php echo $_GET['id']; ?>">Full Payment</a></li>
														<li><a onclick="exp('<?php echo $rid; ?>')">Automatic Expenditure</a></li>
														<li><a onclick="cancel('<?php echo $oid; ?>','<?php echo $type_name; ?>','<?php echo $patient_id; ?>')">Cancel Payment</a></li>
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

								<!--Pagination Start-->
								<nav aria-label="...">
									<ul class="pagination">
										<?php if (($pn > 1)) {
											?>
									    <li class="page-item">
											<a class="page-link" href="view_payment_details.php?id=<?php echo $ref; ?>&amount=<?php echo $amo;?>&page=<?php echo (($pn-1));?>" tabindex="-1">Previous</a>
										</li><?php }
										if (($pn - 1) > 1) {
										    ?>
										    <li class="page-item">
												<a class="page-link" href="view_payment_details.php?id=<?php echo $ref; ?>&amount=<?php echo $amo;?>&page=1">1</a>
											</li>
											<li class="page-item">
												<a class="page-link">...</a>
											</li>
										<?php
										}

										for ($i = ($pn - 1); $i <= ($pn + 1); $i ++) {
										    if ($i < 1)
										        continue;
										    if ($i > $totalPages)
										        break;
										    if ($i == $pn) {
										        $class = "active";
										    } else {
										        $class = "page-link";
										    }
										    ?>
										<li class="page-item">
											<a href="view_payment_details.php?id=<?php echo $ref; ?>&amount=<?php echo $amo;?>&page=<?php echo $i; ?>" class='<?php echo $class; ?>'><?php echo $i; ?></a>
										</li>
										    <?php
										}
										if (($totalPages - ($pn + 1)) >= 1) {
										    ?>
										    <li class="page-item">
												<a class="page-link">...</a>
											</li>
										<?php
										}
										if (($totalPages - ($pn + 1)) > 0) {
										    if ($pn == $totalPages) {
										        $class = "active";
										    } else {
										        $class = "page-link";
										    }
										    ?>
										    <li class="page-item">
											<a href="view_payment_details.php?id=<?php echo $ref; ?>&amount=<?php echo $amo;?>&page=<?php echo $totalPages; ?>"class='<?php echo $class; ?>'><?php echo $totalPages; ?></a>
										</li>
										    <?php
										}
										?>
										    <?php
										    if (($rowa > 1) && ($pn < $totalPages)) {
										        ?>
										        <li class="page-item">
													<a class="page-link" href="view_payment_details.php?id=<?php echo $ref; ?>&amount=<?php echo $amo;?>&page=<?php echo (($pn+1));?>"><span>Next</span></a> 
										        <?php
										    }
										    ?>
																			</ul>
																		</nav>
								<!--Pagination End-->
                            </div>
							</form>
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
						window.location.reload(true);
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

		function exp(ID){ 
		var val = ID;
		var uid = "<?php echo $user_id; ?>";
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/edit.php',
            data: "val=" + val +'&user='+uid+'&ins=autoExp',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location.reload(true);
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

		function hmoSend(pid,tariff,stat){ 
		var tariff = tariff;
		var pid = pid;
		var stat = stat;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/edit.php',
            data: "tariff=" + tariff +  '&pid='+ pid + '&stat='+ stat +'&ins=updateHmoBill',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
					window.location.reload(true);
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
					window.location.reload(true);
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
