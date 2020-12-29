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
?>
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
                                <h4>Total: <b>
                                	<?php 
                                	$con = mysqli_connect("localhost","root","","noahhms");
                                	$sum = mysqli_query($con, "SELECT SUM(to_pay) FROM accounts WHERE order_id = '".$ref."'");
                                	$sum2 = mysqli_fetch_assoc($sum);
                                	echo $sum2['SUM(to_pay)'];
                                ?>
                                </b></h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                    	<th>Item</th>
                                    	<th>Amount</th>
										
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_where6('accounts','order_id', $ref);
											foreach($notarray as $row):

											$type = $row['item'];
											$amount = $row['to_pay'];
											$patient_id = $row['patient_id'];
											
											
										?>
                                        
                                        	
                                        	<?php 
												if($type == 2){
													$notarray = database::getInstance()->select_from_where2('patient_test', 'link_ref',$ref );
													foreach($notarray as $row):
													$lab_test_id = $row['lab_test_id'];
														$notarray = database::getInstance()->select_from_where2('lab_test', 'lab_test_id',$lab_test_id );
														foreach($notarray as $row):
															$lab_test = $row['lab_test'];
															$fee = $row['fee']; ?>
															<tr>
																<td><?php echo $count++;?></td>
																<td><?php echo $lab_test;?></td>
																<td>&#x20A6;<?php echo $fee;?></td>
																
															</tr>
													<?php endforeach;
													endforeach;
												}	else if($type == 3){
															$notarray = database::getInstance()->select_from_where2('prescription', 'reference',$ref );
															foreach($notarray as $row):
															$pharm_stock_id = $row['pharm_stock_id'];
																$notarray = database::getInstance()->select_from_where2('pharm_stock', 'id',$pharm_stock_id );
																foreach($notarray as $row):
																	$name = $row['name'];
																	$price = $row['price']; ?>
																	<tr>
																		<td><?php echo $count++;?></td>
																		<td><?php echo $name;?></td>
																		<td>&#x20A6;<?php echo $price;?></td>
																		
																	</tr>
															<?php endforeach;
															endforeach;
												}	else if($type == 5){
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
																		<td>&#x20A6;<?php echo $price;?></td>
																		
																	</tr>
															<?php endforeach;
															endforeach;
												}	 
											?>
                                        	
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
                                    	<th>Item</th>
                                    	<th>Amount</th>
                                    	
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
                type: 'danger',
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
						window.location = 'payment_daily';
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
						window.location = 'payment_daily';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>