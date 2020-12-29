<?php
	ob_start();
	session_start();
	$pageTitle = "Lab";
	// Include database class
	include_once '../inc/db.php';

	If(!isset($_SESSION['userSession'])){
		header("Location: ../index");
		exit;
	}
	elseif (isset($_SESSION['userSession'])){
		$user_id = $_SESSION['userSession'];
		if (!isset($_GET['page'])) {
			$pn = 1;
		}else{
			$pn=$_GET['page'];
		}
			if (isset($_GET['nstat']) AND $_GET['nstat'] == 1) {
			if (isset($_GET['nid'])) {
				Database::getInstance()->notify_viewed($_GET['nid']);
			}
		}
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
                            <div class="header">
                                <h4 class="title">All Laboratory Requests </h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
										<th>Date</th>
                                        <th>Doctor</th>
                                    	<th>Patient</th>
                                    	<th>Request</th>
                                    	<th>Status</th>
                                    	<th>Payment</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_test2($pn); 

											//total pages
											$totalPages = database::getInstance()->count_select_test();

											foreach($notarray as $row):
											$id = $row['id'];
											$doc_id = $row['doctor_id'];
											$patient_id = $row['patient_id'];
											$app_id = $row['patient_appointment_id'];
											$link = $row['link_ref'];
											$statusS = Database::getInstance()->get_name_from_id('payment_status', 'accounts','order_id', $link);
											$status = "Pending";
											$badge_status1 = "badge-warning";
											$test = "Waiting";
											$badge_status2 = "badge-info";
											$patient = $row['first_name']." ".$row['middle_name']." ".$row['surname'];
											if($statusS > 0){
												$status = "Paid";
												$badge_status1 = "badge-success";
											}
											if($row['awaiting_result'] == 1){
												$test = "Completed";
												$badge_status2 = "badge-success";
											}
											$date = date("Y-m-d",strtotime($row['date_added']));
											
											if($doc_id != 0){
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><i class="fas fa-clock-o"></i><?php echo $date; ?></td>
                                        	<td><i class="fas fa-user-md"></i>
                                        		<?php 
                                        			if($doc_id != 0){
														$userDetails = Database::getInstance()->select_from_where2('staff', 'user_id', $doc_id);
														foreach($userDetails as $ow):
															echo $name = $ow['first_name']." ".$ow['last_name'];	
														endforeach; 
													} else {
														echo "Reception";
													}
                                        		?>
                                        		
                                        	</td>
                                        	<td><i class="fas fa-user"></i><?php echo $patient;?></td>
                                        	<td><?php echo $row['test_num'];;?></td>
                                        	<td><div class="badge <?php echo $badge_status2;?>"><?php echo $test;?></div></td>
                                        	<td><div class="badge <?php echo $badge_status1;?>"><?php echo $status;?></div></td>
                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">...</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
														<?php 
															if($statusS != 0){
														?>
													<li><a href="view_test?id=<?php echo $link; ?>&app=<?php echo $app_id; ?>&pat=<?php echo $patient_id; ?>">Send Lab Result</a></li>
													<li><a href="view_test_lab.php?id=<?php echo $link; ?>&pid=<?php echo $id; ?>&n=<?php echo $patient; ?>&a=<?php echo $row['age']; ?>&s=<?php echo $row['sex']; ?>&did=<?php echo $doc_id; ?>">View Test Result</a></li>
													<li><a href="view_test_lab2.php?id=<?php echo $link; ?>&pid=<?php echo $id; ?>&n=<?php echo $patient; ?>&a=<?php echo $row['age']; ?>&s=<?php echo $row['sex']; ?>&did=<?php echo $doc_id; ?>">Custom Result</a></li>
													<?php } else { ?>
													<li>Payment Not Made</li>
													<?php } ?>
													
													</ul>
												</div>
											</td>
                                        </tr>
										
										
					 
										<?php } endforeach;?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Doctor</th>
                                    	<th>Patient</th>
                                    	<th>Request</th>
                                    	<th>Status</th>
                                    	<th>Payment</th>
                                    	<th>Action</th>
                                    </thead>
								</table>
<!--Pagination Start-->
								<nav aria-label="...">
									<ul class="pagination">
										<?php if (($pn > 1)) {
											?>
									    <li class="page-item">
											<a class="page-link" href="index.php?page=<?php echo (($pn-1));?>" tabindex="-1">Previous</a>
										</li><?php }
										if (($pn - 1) > 1) {
										    ?>
										    <li class="page-item">
												<a class="page-link" href="index.php?page=1">1</a>
											</li>
											<li class="page-item">
												<a class="page-link">...</a>
											</li>
										<?php
										}

										for ($i = ($pn - 1); $i <= ($pn + 1); $i ++) {
										    if ($i < 1)
										        continue;
										    if ($i > $totalPages)
										        break;
										    if ($i == $pn) {
										        $class = "active";
										    } else {
										        $class = "page-link";
										    }
										    ?>
										<li class="page-item">
											<a href="index.php?page=<?php echo $i; ?>" class='<?php echo $class; ?>'><?php echo $i; ?></a>
										</li>
										    <?php
										}
										if (($totalPages - ($pn + 1)) >= 1) {
										    ?>
										    <li class="page-item">
												<a class="page-link">...</a>
											</li>
										<?php
										}
										if (($totalPages - ($pn + 1)) > 0) {
										    if ($pn == $totalPages) {
										        $class = "active";
										    } else {
										        $class = "page-link";
										    }
										    ?>
										    <li class="page-item">
											<a href="index.php?page=<?php echo $totalPages; ?>"class='<?php echo $class; ?>'><?php echo $totalPages; ?></a>
										</li>
										    <?php
										}
										?>
										    <?php
										    if (($row > 1) && ($pn < $totalPages)) {
										        ?>
										        <li class="page-item">
													<a class="page-link" href="index.php?page=<?php echo (($pn+1));?>"><span>Next</span></a> 
										        <?php
										    }
										    ?>
																			</ul>
																		</nav>
								<!--Pagination End-->
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
<?php include 'notify.php'; ?>
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