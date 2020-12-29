<?php 
	ob_start();
	session_start();
	$pageTitle = "Account Details";
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
	$value= $_GET['id'];
?>
 
<div class="wrapper" id="homesc">
<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>
	  <!--  MAIN -->
        <div class="content">
            <div class="container-fluid">
				
				
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                           
                            <div class="content">
                            	<?php

                            		$noarray = database::getInstance()->select_from_where('accounts','app_id',$value);
		                            foreach($noarray as $ow){
			                             $patient_id = $ow['patient_id'];
		                            		
										$userDetails = Database::getInstance()->select_from_where('patients', 'id', $patient_id);
											foreach($userDetails as $oow):
											$name = $oow['title']." ".$oow['surname']." ".$oow['middle_name'];	
											endforeach;	
									}	
                            	?>


		                            <div class="header">
		                                <h4 class="title">Account Details For <?php echo $name;?></h4>
		                            </div>
 									
                            	
                            	 <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Order ID</th>
                                        <th>Item</th>
                                    	<th>Amount</th>
                                    	<th>Status</th>
                                    </thead>
                                    <tbody>
                                    <?php	
                                    	$count = 1;
                                    	$sum=0; 
									  	$noarray = database::getInstance()->select_from_where2('accounts', 'app_id', $value);
		                            foreach($noarray as $row){
		                            		$date_added = $row['date_added'];
		                            		
		                            		$status = $row['payment_status'];
		                            		$order_id = $row['order_id'];
		                            		
			                            	$to_pay = $row['to_pay'];
			                            	$item = $row['item'];
 
		                            ?>
		                            	
 									
		                            <div class="clearTwenty"></div>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        
                                        <td><p><?php echo $order_id;?></p></td>	                            	
										<td><p><?php echo $item;?></p></td>
										
                            			<td><p>&#x20A6;<?php echo $to_pay;?></p></td>
                            		
										
                            			<td>					    
                            				<form>
													<select id="statusss" class="form-control" name="status">
													<option value="<?php echo $status;?>">
													<?php
														switch ($status) {
															case 0:
															echo 'Pending';
															break;
															
															case 1:
															echo 'Paid';
															break;
															
															default:
															echo 'Pending';
														}
													?>
												</option>
												<option value="0">Pending</option>
												<option value="1">Paid</option>
											</select>		
												</form>
										
                            			</td>
                                        </tr>
										
										
					 
										<?php 
											$sum += $to_pay;
											} 

										?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
                                        <th>Order ID</th>
                                        <th>Item</th>
                                    	<th>Amount</th>
                                    	<th>Status</th>
                                    </thead>
								</table>
								<p>Total: <strong>&#x20A6;<?php echo $sum;?></strong>
                            		</p>

                            </div>

                            </div>
                        
						</div>
                    </div>
                 </div>

				<div id="get_result"></div>

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
	var f=jQuery .noConflict();
	f('form').on('change', '#statusss', function(e) {
		var selected = f(this).val();
		var ins = 'changeOrderStatus';
		var app_id ='<?php echo $value;?>';
		var patient_id ='<?php echo $patient_id;?>';
		//get current row
			var currentRow = f(this).closest("tr"); 
			var order_id = currentRow.find("td:eq(1)").text(); // get value of coloumn 2
		e.preventDefault();
		document.getElementById("load").style.display = "block";
		f.ajax({
			type: 'post',
			url: '../func/verify.php',
			data: { selected: selected, app_id: app_id, patient_id: patient_id, order_id: order_id, ins: ins},
			success: function(res){
				document.getElementById("load").style.display = "none";
				jQuery('#get_result').html(res).show();
				console.log(res);
			}
		});
	});
</script>

