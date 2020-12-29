<?php 
	ob_start();
	session_start();
	$pageTitle = "Approve Requests";
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
                                <h4 class="title">Pharmacy Requests Needing Approvals</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Requesting Staff</th>
                                        <th>Drug  Name</th>
										<th>Quantity</th>
                                    	<th>Approval Status</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
										    $notarray = database::getInstance()->select_from_warehouse_requests();
											foreach($notarray as $row):
											$id = $row['request_id'];
											$p_id = $row['staff_id'];
											$given = $row['request_status'];
											if ($given == 0) {
												$given1 = "red";
												$color = 'default';
											}else if($given == 1){
												$given1 = "green";
												$color = 'success';
											}else if ($given == 2) {
												$given1 = "red";
												$color = 'default';
											}
											$drugs =  $row['warehouse_stock_id'];
											$quantity = $row['quantity_needed'];
											$date = $row['pdate_added'];
											$doc = $row['staff_id'];
											$patient ="";
											
									 
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td>
                                        		<?php 
                                        			$userDetails = Database::getInstance()->select_from_where('staff', 'user_id', $p_id);
													foreach($userDetails as $qw):
														echo $patient = $qw['last_name']." ".$qw['first_name'];
														
													endforeach; 
													
                                        		?>
                                        		
                                        	</td>
                                        	<td>
                                        		<?php 
                                        			$pharm = Database::getInstance()->select_from_where('warehouse_stock', 'id', $drugs);
													foreach($pharm as $drug):
														echo $re = $drug['name'];
														
													endforeach; 
                                        		?>
                                        	</td>
											<td>
                                        		<?php 
                                        			echo $quantity;
                                        		?>
                                        	</td>
											
											<td>
                                        		<div class="label label-<?php if (isset($given1) AND !empty($given1)){echo $color;}?>">
                                        			<?php 
                                        			if($given == 0){
                                        				echo "Pending";
                                        			}else if($given == 1){
                                        				echo "Approved";
                                        			} else if($given == 2){
                                        				echo "Not Approved";
                                        			}
                                        		?>
                                        		</div>
                                        	</td>
                                        </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
										<th>#</th>
                                        <th>Requesting Staff</th>
                                        <th>Drug  Name</th>
										<th>Quantity</th>
                                    	<th>Approval Status</th>
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
		
		function proce(ID,name){ 

        	s.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to process prescription of <b>"+name+"</b> ? </br><button type='button' class='btn pop-btn' onclick='proc("+ID+")'>Process</button>"

            },{
                type: 'danger',
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
						window.location = 'approvals';
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
            	message: "Are you sure you want to Cancel Approval For <b>"+name+"</b> ? </br><button type='button' class='btn pop-btn' onclick='cncel("+ID+")'>Process</button>"

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
            data: "val=" + val +  '&ins=cancel_request',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data == 'Done') {
					console.log(data);
						window.location = 'approvals';
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
						window.location = 'approvals';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>