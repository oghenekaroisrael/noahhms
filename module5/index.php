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
	}
	include_once '../inc/header-index.php'; //for addding header

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
<?php 
if ($_GET['full_pay'] == "paid") {
	?>
	<div class="alert alert-success">Payment Successful</div>
	<?php
}

 ?>

 <?php 
if ($_GET['part_pay'] == "paid") {
	?>
	<div class="alert alert-success">Payment Successful</div>
	<?php
}

 ?>

 <?php 
if ($_GET['full_pay'] == "error") {
	?>
	<div class="alert alert-danger">Payment Unsuccessful</div>
	<?php
}

 ?>

  <?php 
if ($_GET['part_pay'] == "error") {
	?>
	<div class="alert alert-danger">Payment Unsuccessful</div>
	<?php
}

 ?>
		<div class="content">
            <div class="container-fluid">
			<div class="row">
				<div class="col-lg-3">
					<h3  class="text-center"><b>Today's Income</b></h3>
				</div>
				<div class="col-lg-3">
					<h1 class="left">&#8358; 
						<?php 
							include "tot.php";
						?>
							
						</h1>
				</div>
				<div class="col-lg-3">
					<h3  class="text-center">Balances</h3>
				</div>
				<div class="col-lg-3">
					<h1 class="left">&#8358; 
						<?php 
							include "pend.php";
						?>
							
						</h1>
				</div>
			</div>
			
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Payments </h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                    	<th>Patient</th>
										<th>Status</th>
										<th>Balance</th>										
										<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_payment4();
											foreach($notarray as $row):
											
											$id = $row['id'];
											if (is_string($row['front_desk'])) {
												$frnt = $row['front_desk'];
											}else{
												$frnt = $row['patient_id'];
											}
											$reference = $row['order_id'];
											$appointment_id = $row['app_id'];
											$p_id = $row['patient_id'];
											$to_pay = $row['to_pay_sum'];
											$paid_val = $row['amount_sum'];
											$arrays = array();
											$statuses = explode(",", $row['GROUP_CONCAT(payment_status)']);
											foreach ($statuses as $status) {
											array_push($arrays, $status);							
											}
											
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><i class="fas fa-user"></i><?php
											if ($p_id !=0) {
													$notarray = database::getInstance()->select_from_where2('patients', 'id',$p_id );
											$type2 = "";
											foreach($notarray as $row):
											echo $name = $row['title']." ".$row['surname']." ".$row['middle_name']." ".$row['first_name'];
											endforeach;
												}else{
													$notarray = database::getInstance()->get_name_from_id('full_name','in_sales', 'sales_id',$reference);
													$type2 = "";
													echo $notarray;
												}
											?></td>
                                        	<td>
                                        		<?php 
											if (in_array(0, $arrays) AND in_array(1, $arrays)) {
												?>
												<div class="badge badge-info">Part Paid
												</div>
												<?php
											}elseif (in_array(0, $arrays) AND in_array(2, $arrays)) {
												?>
												<div class="badge badge-info">Part Paid
												</div>
												<?php
											}elseif (in_array(0, $arrays) AND in_array(3, $arrays)) {
												?>
												<div class="badge badge-info">Part Paid
												</div>
												<?php
											}elseif (in_array(0, $arrays) AND in_array(4, $arrays)) {
												?>
												<div class="badge badge-info">Part Paid
												</div>
												<?php
											}elseif (in_array(0, $arrays) AND in_array(5, $arrays)) {
												?>
												<div class="badge badge-info">Part Paid
												</div>
												<?php
											}elseif (in_array(0, $arrays) AND !in_array(5, $arrays) AND !in_array(1, $arrays) AND !in_array(3, $arrays) AND !in_array(4, $arrays) AND !in_array(2, $arrays)) {
												?>
												<div class="badge badge-danger">Not Paid
												</div>
												<?php
											}elseif (in_array(1, $arrays) AND !in_array(5, $arrays) AND !in_array(0, $arrays) AND !in_array(3, $arrays) AND !in_array(4, $arrays) AND !in_array(2, $arrays)) {
												?>
												<div class="badge badge-success">Fully Paid
												</div>
												<?php
											}elseif (in_array(3, $arrays) AND !in_array(5, $arrays) AND !in_array(1, $arrays) AND !in_array(0, $arrays) AND !in_array(4, $arrays) AND !in_array(2, $arrays)) {
												?>
												<div class="badge badge-info">Company Bill
												</div>
												<?php
											}elseif(in_array(4, $arrays) AND !in_array(5, $arrays) AND !in_array(1, $arrays) AND !in_array(3, $arrays) AND !in_array(0, $arrays) AND !in_array(2, $arrays)) {
												?>
												<div class="badge badge-danger">Deffered Payments
												</div>
												<?php
											}elseif(in_array(5, $arrays) AND !in_array(0, $arrays) AND !in_array(1, $arrays) AND !in_array(3, $arrays) AND !in_array(4, $arrays) AND !in_array(2, $arrays)) {
												?>
												<div class="badge badge-secondary">Invalidate
												</div>
												<?php
											} ?>
                                        	</td>

											<td>&#x20A6;<?php echo number_format(intval($to_pay) - intval($paid_val));?></td>
                                        	                 
                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">...</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
														<li><a href="view_payment_details?id=<?php echo $frnt;?>&amount=<?php echo $to_pay;?>&pid=<?php echo $p_id; ?>">View Details</a></li>
													</ul>
												</div>
											</td>
                                        </tr>
										
										
	

										<?php endforeach;?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
                                    	<th>Patient</th>
										<th>Status</th>
										<th>Balance</th>										
										<th>Action</th>
                                    </thead>
								</table>

                            </div>
                        </div>
                    </div>
                 </div>
<?php include 'pay.php'; ?>
            </div>
        </div>
	 <!-- //MAIN -->
		<!--  footer -->
		
	<?php include '../inc/footer-index.php';?>
	<!--//footer -->
        
    </div>

</div>
<?php include '../notify.php'; ?>

<div class="loader" id="load" style="display:none ">
</div>
	<script type="text/javascript">
	var s=jQuery .noConflict();
	s(function () {
    s("#pro").DataTable();
  });
  
		function update(ID,name){ 

        	s.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to accept payment of <b>"+name+"</b> ? </br><button type='button' class='btn pop-btn' onclick='accept("+ID+")'>Accept</button>"

            },{
                type: 'info',
                timer: 100000
            });

    	}
		
		function accept(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/edit.php',
            data: "val=" + val +  '&ins=acceptPayment'+'&status=1',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'index';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}
		
		function cancel(ID,name){ 

        	s.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to cancel payment of <b>"+name+"</b> ? </br><button type='button' class='btn pop-btn' onclick='canc("+ID+")'>Accept</button>"

            },{
                type: 'danger',
                timer: 100000
            });

    	}
		
		function canc(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/edit.php',
            data: "val=" + val +  '&ins=acceptPayment'+'&status=0',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'index';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}
    </script>
