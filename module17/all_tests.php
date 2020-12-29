<?php
	ob_start();
	session_start();
	$pageTitle = "All Tests";
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
	$value = $_GET['id'];
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
                                <h4 class="title">All Laboratory Requests </h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Patient</th>
                                        <th>Number Of Tests</th>
                                    	<th>Request</th>
                                    	<th>Payment</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
                                    	
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_where2('patient_test_group', 'patient_id', $value);
											foreach($notarray as $row):
											$tid = $row['patient_test_group_id'];
											$patient_id = $row['patient_id'];
											$link = $row['link_ref'];
											$num = $row['test_num'];
											$statusS = Database::getInstance()->get_name_from_id('payment_status', 'payment','reference', $link);
											$tested = Database::getInstance()->get_name_from_id('tested', 'patient_test','link_ref', $link);
											$status = "Pending";
											if ($tested == 1) {
												$test = "Processed";
											}else{
												$test = "Waiting";
											}

											if($statusS ==1 || $statusS == 2 || $statusS == 3 || $statusS == 4 || $statusS == 5){
												$status = "Confirmed";
											}
											
											
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td>
                                        		<?php 
                                        			$userDetails = Database::getInstance()->select_from_where2('patients', 'id', $patient_id);
														foreach($userDetails as $ow):
															echo $name = $ow['title']." ".$ow['first_name']." ".$ow['middle_name']." ".$ow['surname'];	
														endforeach; 
                                        		?>
                                        		
                                        	</td>
                                        	<td><?php echo $num; ?></td>
                                        	<td><?php echo $test;?></td>
                                        	<td><?php echo $status;?></td>
                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">Action</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													
													<li><a href="view_test?id=<?php echo $link; ?>">Print Result</a></li>
													<li><a href="send_doc?id=<?php echo $link ?>"> Send To Doctor</a></li>
													
													</ul>
												</div>
											</td>
                                        </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
										<th>Patient</th>
                                        <th>Number Of Tests</th>
                                    	<th>Request</th>
                                    	<th>Payment</th>
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
  
		function sure(ID,name){ 

        	s.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to delete <b>"+name+"</b> From bank list ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

            },{
                type: 'danger',
                timer: 100000
            });

    	}
		
		function delet(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/del.php',
            data: "val=" + val +  '&ins=delPatient',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'patients';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>