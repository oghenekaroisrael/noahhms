
<?php 
	ob_start();
	session_start();
	$pageTitle = "Patients";
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
                                <h4 class="title">All In-Patients </h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Patient</th>
                                    	<th>Ward</th>
                                    	<th>Payment Status</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_ord1('ipd_patients','id','DESC',$pn);

											//total pages
											$totalPages = database::getInstance()->count_from_ord2('ipd_patients','id','DESC');
											foreach($notarray as $row):
											$ipid = $row['id'];
											$id = $row['id'];
											$aid = $row['appointment_id'];
											$p_id = $row['patient_id'];
											$d_id = $row['doctor_id'];
											$date_added = $row['date_added'];
											$time_added = $row['time_added'];
											$treated = $row['treated'];
											if ($row['ward'] == 1) {
	                                                			$diagnosis = "Semi 1 Ward";
	                                                		}elseif ($row['ward'] == 2) {
	                                                			$diagnosis = "Semi Private Ward 1";
	                                                		}elseif ($row['ward'] == 3) {
	                                                			$diagnosis = "Semi Private Ward 2";
	                                                		}elseif ($row['ward'] == 4) {
	                                                			$diagnosis = "Semi Private Ward 3";
	                                                		}elseif ($row['ward'] == 5) {
	                                                			$diagnosis = "Children's Ward";
	                                                		}elseif ($row['ward'] == 6) {
	                                                			$diagnosis = "Main Ward";
	                                                		}elseif ($row['ward'] == 7) {
	                                                			$diagnosis = "Neo-Natal Ward";
	                                                		}elseif ($row['ward'] == 8) {
	                                                			$diagnosis = "Private Ward";
	                                                		}elseif ($row['ward'] == 9) {
	                                                			$diagnosis = "ICU Ward";
	                                                		}else{
	                                                			$diagnosis = "No Ward Selected";
	                                                		}
											$surname = "";
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td>
                                        		<?php
													$userDetails = Database::getInstance()->select_from_where('patients', 'id', $p_id);
													foreach($userDetails as $qw):
														echo $name = $qw['title']." ".$qw['surname']." ".$qw['middle_name'];
														$surname = $qw['surname'];
													endforeach; 
												?>
                                        		
                                        	</td>
                                        	
                                        	<td><?php echo $diagnosis;?></td>
                                        	<td><?php 
                                        		$arrays = Database::getInstance()->get_name_from_id3('payment_status','accounts','app_id',$aid,'patient_id',$p_id,'id');
											if ($arrays == 2) {
												echo $array = "Part Paid";
											}elseif ($arrays == 1) {
												echo $array = "Fully Paid";
											}elseif ($arrays == 3) {
												echo $array = "Company Billed";
											}elseif($arrays == 4) {
												echo $array = "Deffered Payments";
											}elseif($arrays == 5) {
												echo $array = "Invalidate";
											}elseif($arrays == 0){
												echo $array = "Not Paid";

											} ?>
                                        	</td>
                                        
                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">...</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
														<li><a href="prepare_bill.php?id=<?php echo $aid; ?>">Prepare Bill</a></li>
														<li class="divider"></li>
														<li><a href="view_bill?id=<?php echo $aid; ?> ">View Prepared Bill</a></li>
													</ul>
												</div>
											</td>
                                        </tr>
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
										<th>#</th>
                                        <th>Patient</th>
                                    	<th>Ward</th>
                                    	<th>Payment Status</th>
                                    	<th>Action</th>
                                    </thead>
								</table>
<!--Pagination Start-->
								<nav aria-label="...">
									<ul class="pagination">
										<?php if (($pn > 1)) {
											?>
									    <li class="page-item">
											<a class="page-link" href="in_patient.php?page=<?php echo (($pn-1));?>" tabindex="-1">Previous</a>
										</li><?php }
										if (($pn - 1) > 1) {
										    ?>
										    <li class="page-item">
												<a class="page-link" href="in_patient.php?page=1">1</a>
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
											<a href="in_patient.php?page=<?php echo $i; ?>" class='<?php echo $class; ?>'><?php echo $i; ?></a>
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
											<a href="in_patient.php?page=<?php echo $totalPages; ?>"class='<?php echo $class; ?>'><?php echo $totalPages; ?></a>
										</li>
										    <?php
										}
										?>
										    <?php
										    if (($row > 1) && ($pn < $totalPages)) {
										        ?>
										        <li class="page-item">
													<a class="page-link" href="in_patient.php?page=<?php echo (($pn+1));?>"><span>Next</span></a> 
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
