<?php 
	ob_start();
	session_start();
	$pageTitle = "Contact Warehouse";
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
					<div style="padding-bottom:45px;">
            <a href="new_stock_r" style="margin-bottom:10px;" class="btn btn-primary pull-right btn-flat btblack">
                    <i class="entypo-plus-circled"></i> New Request
            </a>
            </div>	
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header" id="here_me">
                                <h4 class="title">Stock From Warehouse</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Requesting Staff's Name</th>
                                        <th>Drug Name</th>
                                        <th>Quantity Needed</th>
                                        <th>Stock Number</th>
                                        <th>Status</th>
                                    	<th>Date</th> 
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
										    $notarray = database::getInstance()->requests_to_warehouse();
											foreach($notarray as $row):
											$id = $row['user_id'];
                                            $id2 = $row['request_id'];
											$sales = $row['staff_id'];
											$barcode = $row['warehouse_stock_id'];
											$quantity = $row['quantity_needed'];
                                            $stock_given = $row['Stock_number'];
                                            $status = $row['request_status'];
                                            $ret = $row['returned'];
                                            $left = $quantity - $ret;
                                            $date = $row['pdate_added'];
											$amt = $row['to_pay'];	
                                            if ($status == 1) {
                                                $color = "success";
                                            } else if($status == 2){
                                            $color = "danger";
                                           }else(
                                           	$color = "warning"
                                           )
                                                                         							 
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><i class="fas fa-user"></i>
                                        		<?php 
                                        			$staff_det = Database::getInstance()->select_from_where2('staff', 'user_id', $sales);
													foreach($staff_det as $qw):
														echo $staff = ucwords($qw['last_name']." ".$qw['first_name']);
													endforeach; 
													
                                        		?>	
                                        	</td>
                                        	<td><i class="fas fa-medkit"></i>
                                        		<?php 
                                                    $pharm = Database::getInstance()->select_from_where2('warehouse_stock', 'id', $barcode);
                                                    foreach($pharm as $drug):
                                                            echo $drug['name'];
                                                    endforeach; 
                                                ?>
                                        	</td>
											<td>
                                        		<?php echo $quantity; ?>
                                        	</td>
											<td>
                                        		<?php echo $stock_given; ?>
                                        	</td>
											<td>
                                                    <div class="label label-<?php echo $color;?>">
                                                    <?php 
                                                    if($status == 0){
                                                        echo "Pending";
                                                    } else if($status == 2){
                                                        echo "Not Approved";
                                                    }else{
                                                    	echo "Approved";
                                                    }
                                                ?>
                                                </div>
                                            </td>
											<td><i class="fas fa-clock-o"></i>
												<?php echo $date; ?>
											</td>
											<td>
												<a class="btn btn-info" <?php if ($left <= 0) {echo " disabled style='color:#000;'";}else{echo "href='return_w.php?a=$id&b=$id2'";}?>>Return</a>
											</td>
                                        </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
                                       
                                        <th>#</th>
                                        <th>Requesting Staff's Name</th>
                                        <th>Drug Name</th>
                                        <th>Quantity Needed</th>
                                        <th>Stock Number</th>
                                        <th>Status</th>
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