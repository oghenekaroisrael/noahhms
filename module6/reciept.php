<?php 
	ob_start();
	session_start();
	$pageTitle = "Invoices";
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
					<div style="padding-bottom:45px;">
            <a href="new_invoice" style="margin-bottom:10px;" class="btn btn-primary pull-right btn-flat btblack">
                    <i class="entypo-plus-circled"></i> Generate Invoice
            </a>
            </div>	
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header" id="here_me">
                                <h4 class="title">Generated Invoice</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Invoice Number</th>
                                        <th>Supplier's Name</th>
                                    	<th>Invoice Generator</th> 
                                    	<th>Action</th> 
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
										    $notarray = database::getInstance()->select_invoice();
											foreach($notarray as $row):
											$id = $row['id'];
											$sales = $row['staff_id'];
											$supplier = database::getInstance()->get_name_from_id('Supplier_Name','pharm_suppliers','Supplier_ID',$row['supplier']);
											$invoice_id = $row['invoice_id'];								 
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                            <td>
                                                <?php echo $invoice_id; ?>
                                            </td>
                                            <td>
                                                <?php echo $supplier; ?>
                                            </td>
                                        	<td>
                                        		<?php 
                                        			$patient_det = Database::getInstance()->select_from_where2('staff', 'user_id', $sales);
													foreach($patient_det as $qw):
														echo $patient = $qw['last_name']." ".$qw['first_name'];
														
													endforeach; 
													
                                        		?>	
                                        	</td>
												
											
											<td>
												<a class="btn btn-info" href="details.php?id=<?php echo $invoice_id; ?>">View Details</a>
											</td>
                                        </tr>
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
                                        <th>Generated Staff's Name</th>
                                        <th>Supplier's Name</th>
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