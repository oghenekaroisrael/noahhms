
<?php 
	ob_start();
	session_start();
	$pageTitle = "Return Inward";
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
        ?>
        <script>
                $(document).ready(function() {
                    rem('<?php echo $name ?>',<?php echo $rem ?>);
                });
        </script>
        <?php
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
                                <h4 class="title">Return Inwards</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Requesting Staff's Name</th>
                                        <th>Drug Name</th>
                                        <th>Quantity</th>
                                        <th>Stock Number</th>
                                        <th>Amount</th>
                                    	<th>Date</th> 
                                    	<th>Action</th> 
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
										    $notarray = database::getInstance()->warehouse_returns();
											foreach($notarray as $row):
											$id = $row['id1'];
                                            $id2 = $row['id2'];
											$sales = $row['staff_id'];
											$barcode = $row['Stock_number'];
											$quantity = $row['quantity'];
											$date = $row['date'];
											$amt = $row['amount'];								 
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td>
                                        		<?php 
                                        			$patient_det = Database::getInstance()->select_from_where2('staffs_login', 'id', $sales);
													foreach($patient_det as $qw):
														echo $patient = $qw['last_name']." ".$qw['first_name'];
														
													endforeach; 
													
                                        		?>	
                                        	</td>
                                        	<td>
                                        		<?php 
                                                    $pharm = Database::getInstance()->select_from_where2('warehouse_stock', 'Stock_number', $barcode);
                                                    foreach($pharm as $drug):
                                                        if (empty($drug['Stock_number']) OR $drug['Stock_number'] == 0) {
                                                            echo "";
                                                        }else{
                                                            echo $drug['name'];
                                                        }
                                                        
                                                    endforeach; 
                                                ?>
                                        	</td>
											<td>
                                        		<?php echo $quantity; ?>
                                        	</td>
											<td>
                                        		<?php echo $barcode; ?>
                                        	</td>
                                        	<td>
                                        		<?php echo $amt; ?>
                                        	</td>
												
											<td>
												<?php echo $date; ?>
											</td>
											<td>
												<a class="btn btn-info" href="return.php?a=<?php echo $id; ?>&b=<?php echo $id2; ?>" <?php if (empty($barcode) OR $barcode == 0) {echo " disabled";}else{echo "";}?>>Return</a>
											</td>
                                        </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
                                       <th>#</th>
                                        <th>Requesting Staff's Name</th>
                                        <th>Drug Name</th>
                                        <th>Quantity</th>
                                        <th>Stock Number</th>
                                        <th>Amount</th>
                                        <th>Date</th> 
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
    function rem(name,rem){ 

            s.notify({
                icon: 'pe-7s-drawer',
                message: "<b>"+name+"</b> Is Almost Out Of Stock ("+rem+" Remaining)"

            },{
                type: 'info',
                timer: 300000
            });

        }
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
            	message: "Are you sure you want to Cancel Prescription Process of <b>"+name+"</b> ? </br><button type='button' class='btn pop-btn' onclick='cncel("+ID+")'>Process</button>"

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
            data: "val=" + val +  '&ins=cancelPrescription',
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