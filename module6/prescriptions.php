<?php 
	ob_start();
	session_start();
	$pageTitle = "Pharmacy Requests";
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
	
	$finish = database::getInstance()->stock_finish_w();
	foreach ($finish as $values) {
		$name = $values['name'];
		$rem = intval($values['cartons']);
		if ($rem == 0) {
			
		}elseif ($rem >= 50) {
			
		}else{
			?>
		<script>
				$(document).ready(function() {
					rem('<?php echo $name ?>',<?php echo $rem ?>);
				});
		</script>
		<?php
		}
	}
	
	
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
                            <div class="header" id="here_me">
                                <h4 class="title">Pharmacy Requests</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Requesting Staff</th>
                                        <th>Drug  Name</th>
                                        <th>Stock Number</th>
                                        <th>Batch Number</th>
										<th>Quantity</th>
										<th>Status</th>
                                    	<th>Approval Status</th>                                    	
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
										    $notarray = database::getInstance()->select_from_warehouse_requests();
											foreach($notarray as $row):
											$id = $row['request_id'];
											$p_id = $row['staff_id'];
											$status = $row['status'];
											$approved = $row['request_status'];

											if ($approved== 0) {
												$given1 = "yellow";
												$color = 'warning';
											}else if($approved == 1){
												$given1 = "green";
												$color = 'success';
											}else{
												$given1 = "red";
												$color = "danger";
											}

											if ($status == 0) {
												$given2 = "yellow";
												$color2 = 'primary';
											}else if($approved == 1){
												$given2 = "green";
												$color2 = 'success';
											}else{
												$given2 = "red";
												$color2 = "danger";
											}
											$drugs =  $row['warehouse_stock_id'];
											$quantity = $row['quantity_needed'];
											$date = $row['pdate_added'];
											$doc = $row['staff_id'];
											$patient ="";
											
									 
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><i class="fas fa-user"></i>
                                        		<?php 
                                        			$userDetails = Database::getInstance()->select_from_where('staff', 'user_id', $p_id);
													foreach($userDetails as $qw):
														echo $patient = $qw['last_name']." ".$qw['first_name'];
														
													endforeach; 
													
                                        		?>
                                        		
                                        	</td>
                                        	<td><i class="fas fa-medkit"></i>
                                        		<?php 
                                        			$pharm = Database::getInstance()->select_from_where('warehouse_stock', 'id', $drugs);
													foreach($pharm as $drug):
														echo $drug['name'];
														
													endforeach; 
                                        		?>
                                        	</td>
                                        	<td>
                                        		<?php 
                                        			echo $barcode = Database::getInstance()->get_name_from_id('Stock_number','pharm_requests', 'request_id', $id);
                                        		?>
                                        	</td>
                                        	<td>
                                        		<?php  
                                        			echo $batch = Database::getInstance()->get_name_from_id('batch','pharm_requests', 'request_id', $id);
                                        		?>
                                        	</td>
											<td>
                                        		<?php 
                                        			echo $quantity;
                                        		?>
                                        	</td>
                                        	<td>
                                        		<div class="label label-<?php if (isset($given2) AND !empty($given2)){echo $color2;}?>">
                                        			<?php 
                                        			if($status == 1){
                                        				echo "Dispensed";
                                        			} else if($status == 0){
                                        				echo "Waiting";
                                        			}else{
                                                        echo "Not Dispensed";
                                        			}
                                        		?>
                                        		</div>
                                        	</td>
											
											<td>
                                        		<div class="label label-<?php if (isset($given1) AND !empty($given1)){echo $color;}?>">
                                        			<?php 
                                        			if($approved== 0){
                                        				echo "Pending";
                                        			} else if($approved == 1) {
                                        				echo "Approved";
                                        			}else{
                                        				echo "Not Approved";
                                        			}
                                        		?>
                                        		</div>
                                        	</td>
											<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">...</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													</button>
													<ul class="dropdown-menu" role="menu">
														<?php
															if($status == 0 && $approved == 1){	?>
															<li><a href="process_request.php?id=<?php echo $id; ?>">Issue Drug</a></li>
															<?php }elseif($approved == 2 && $role_id == 16){	?>
															<li><p>Not Approved</p></li>
															<?php }elseif($approved == 1){	?>
															<li><a onclick="canc(<?php echo $id; ?>,'<?php echo $patient; ?>')">Cancel Drug Issue</a></li>
															<?php }

															if($approved == 0 && $role_id == 15 OR $role_id == 1 OR $role_id == 9){	?>
															<li><a onclick="approv(<?php echo $id; ?>,`<?php echo $re; ?>`)">Approve Request</a></li>
															<?php }else if( $approved == 1 && $role_id == 15 OR $role_id == 1 OR $role_id == 9){	?>
															<li><a onclick="cancl(<?php echo $id; ?>,'<?php echo $re; ?>')">Cancel Approval</a></li>
															<?php }?>
													</ul>
												</div>
											</td>
                                        </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
                                        <th>Requesting Staff</th>
                                        <th>Drug  Name</th>
                                        <th>Stock Number</th>
                                        <th>Batch Number</th>
										<th>Quantity</th>
										<th>Status</th>
                                    	<th>Approval Status</th>                                    	
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


<div class="loader" id="load" style="display:none ">
</div>

	<script type="text/javascript">
	var s=jQuery .noConflict();
	s(function () {
    s("#pro").DataTable();
  });
		function sure(drugs,tabs,dosage,duration, date,instruction){ 

        	s.notify({
            	icon: '',
            	message: 
				 "<table class='table table-bordered table-primary'><thead><th><b>Drugs</b></th><th>Number of Tabs</th><th>Dosage</th><th>Duration</th><th>Date</th><th>Instructions</th></thead><tbody><tr><td>"+drugs+"</td><td>"+tabs+"</td><td>"+dosage+"</td><td>"+duration+"</td><td>"+date+"</td><td>"+instruction+"</td></tr> </tbody></table>"
				 

            },{
                type: 'success',
                timer: 100000
            });

    	}
		function rem(name,rem){ 

        	s.notify({
            	icon: 'pe-7s-drawer',
            	message: "<b>"+name+"</b> Is Almost Out Of Stock ("+rem+" Remaining)"

            },{
                type: 'info',
                timer: 3000
            });

    	}
		function proce(ID,name){ 

        	s.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to process prescription of <b>"+name+"</b> ? </br><button type='button' class='btn pop-btn' onclick='proc("+ID+")'>Process</button>"

            },{
                type: 'danger',
                timer: 100000
            });

    	}
		function proc(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/edit.php',
            data: "val=" + val +  '&status=1' + '&doc=' + <?php echo $doc;?> + '&ins=processPrescription',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'prescriptions';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}
		
		function canc(ID,name){ 

        	s.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to Cancel Drug Issued To <b>"+name+"</b> ? </br><button type='button' class='btn pop-btn' onclick='cncel("+ID+")'>Process</button>"

            },{
                type: 'danger',
                timer: 100000
            });

    	}
		
		function cncel(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/edit.php',
            data: "val=" + val +  '&ins=cancelIssue',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data == 'Done') {
					console.log(data);
						window.location = 'prescriptions';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

		function cancl(ID,name){ 

        	s.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to Cancel Approval For <b>"+name+"</b> ? </br><button type='button' class='btn pop-btn' onclick='cancel("+ID+")'>Process</button>"

            },{
                type: 'danger',
                timer: 100000
            });

    	}
		
		function cancel(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/edit.php',
            data: "val=" + val +  '&ins=cancel_request',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data == 'Done') {
					console.log(data);
						window.location = 'prescriptions';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

		function approv(ID,name){

        	s.notify({
            	icon: 'pe-7s-check',
            	message: "Are you sure you want to Approve Request For <b>"+name+"</b> ? </br><button type='button' class='btn pop-btn' onclick='appro("+ID+")'>Process</button>"

            },{
                type: 'info',
                timer: 100000
            });

    	}
		
function appro(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/edit.php',
            data: "val=" + val +  '&ins=approve_request',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data == 'Done') {
					console.log(data);
						window.location = 'prescriptions';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}
    </script>