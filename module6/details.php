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
	
	$id = $_GET['id'];
	
	
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
                                <h4 class="title">Invoice For <b><?php echo $id; ?></b></h4>
                                <div class="right">
                                </div>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Drug Name</th>
                                        <th>Batch</th>
                                    	<th>LOT</th>
                                        <th>UOM</th>
                                        <th>Expiring Date</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                        <th>Destination</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
										    $notarray = database::getInstance()->select_from_where2('invoices','invoice_id',$id);
											foreach($notarray as $row):
											$id = $row['id'];
											$sales = $row['staff_id'];
											$supplier = database::getInstance()->get_name_from_id('Supplier_Name','pharm_suppliers','Supplier_ID',$row['supplier']);
                                            $drug = database::getInstance()->get_name_from_id('name','warehouse_stock','id',$row['drug']);
                                            $exp = $row['expiring'];
                                            $unit = database::getInstance()->get_name_from_id('unit_name','pharm_units','id',$row['unit']);
                                            $qty = $row['quantity'];
                                            $price = $row['price'];
                                            $total = $row['total'];
											$invoice_id = $row['invoice_id'];
                                            $batch = $row['batch'];
                                            $lot = $row['lot'];	
                                            $desti = $row['destination'];
                                            if ($desti == 4) {
                                                $destination = "Warehouse";
                                            }elseif ($desti == 3) {
                                                $destination = "Pharmacy";
                                            }elseif ($desti == 1) {
                                                $destination = "Laboratory";
                                            }elseif ($desti == 2) {
                                                $destination = "Nursing Station";
                                            }						 
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                            <td>
                                                <?php echo $drug; ?>
                                            </td>
                                            <td>
                                                <?php echo $batch;  ?>
                                            </td>
                                            <td>
                                                <?php echo $lot; ?>
                                            </td>
                                            <td>
                                                <?php echo $unit; ?>
                                            </td>
                                            <td>
                                                <?php echo $exp; ?>
                                            </td>
                                            <td>
                                                <?php echo $qty; ?>
                                            </td>
                                            <td>
                                                <?php echo $price; ?>
                                            </td>
                                            <td>
                                                <?php echo $total; ?>
                                            </td>
                                            <td>
                                                <?php echo $destination; ?>
                                            </td>
                                        </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
                                        <th>Drug Name</th>
                                        <th>Batch</th>
                                        <th>LOT</th>
                                        <th>UOM</th>
                                        <th>Expiring Date</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th> 
                                        <th>Destination</th>
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
                timer: 3000
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