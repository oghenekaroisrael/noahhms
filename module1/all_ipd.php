
<?php 
	ob_start();
	session_start();
	$pageTitle = "IPD";
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
                                <h4 class="title">All IPD</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Admitting Doctor</th>
                                    	<th>Patient Name</th>
                                    	<th>Date Admitted</th>
                                    	<th>Ward</th>
                                    	<th>Bed Number</th>
                                    	<th>Status</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_ord1('ipd_patients','id','DESC',$pn);

											//total pages
											$totalPages = database::getInstance()->count_from_ord2('ipd_patients','id','DESC');

											foreach($notarray as $row):
											//$ipid = $row['id'];
											$p_id = $row['patient_id'];
											$doc_id = $row['doctor_id'];
											
											$nurse = $row['nurse'];
											$admin_no = $row['admin_no'];
											$admin_date = $row['admin_date'];
											$ref = $row['ref'];
											$room = $row['room'];
											$ward = $row['ward'];
											$bed_no = $row['bed_no'];
											$admission_status_id = $row['admission_status_id'];
											$status = database::getInstance()->get_name_from_id('admission_status','admission_status','admission_status_id',$row['admission_status_id']);
											$ipi = database::getInstance()->select_from_where('admission_request','patient_id',$p_id);
											foreach ($ipi as $kue) {
												$ipid = $kue['appointment_id'];
											}
											$surname = "";
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><?php 
                                        		$userDetails = Database::getInstance()->select_from_where('staff', 'user_id', $doc_id);
														foreach($userDetails as $ow):
															$id = $ow['user_id'];
															$name = $ow['first_name']." ".$ow['last_name'];	
														endforeach; 
													echo $name;
                                        	?>
                                        		
                                        	</td>
                                        	
                                        	<td>
                                        		<?php 
                                        		$userDetails = Database::getInstance()->select_from_where('patients', 'id', $p_id);
														foreach($userDetails as $ow):
															
															$p_name = $ow['title']." ".$ow['surname']." ".$ow['middle_name'];
															$surname = $ow['surname'];															
														endforeach; 
													echo $p_name." ".$surname;
                                        	?>
                                        	</td>
                                        	
                                        	<td>
                                        		<?php echo $admin_date;?>
											</td>

											<td>
                                        		<?php 
                                        			if ($row['ward'] == 1) {
	                                                			echo "Semi 1 Ward";
	                                                		}elseif ($row['ward'] == 2) {
	                                                			echo "Semi Private Ward 1";
	                                                		}elseif ($row['ward'] == 3) {
	                                                			echo "Semi Private Ward 2";
	                                                		}elseif ($row['ward'] == 4) {
	                                                			echo "Semi Private Ward 3";
	                                                		}elseif ($row['ward'] == 5) {
	                                                			echo "Children's Ward";
	                                                		}elseif ($row['ward'] == 6) {
	                                                			echo "Main Ward";
	                                                		}elseif ($row['ward'] == 7) {
	                                                			echo "Neo-Natal Ward";
	                                                		}elseif ($row['ward'] == 8) {
	                                                			echo "Private Ward";
	                                                		}elseif ($row['ward'] == 9) {
	                                                			echo "ICU Ward";
	                                                		}else{
	                                                			echo "No Ward Selected";
	                                                		}
                                        		?>
											</td>

											<td>
                                        		<?php echo $bed_no;?>
											</td>
											<td>
												<?php 
                                        			if ($admission_status_id == 0) {
                                        				?>
                                        				<div class="badge badge-success">Admitted</div>
                                        				<?php
                                        			}else if ($admission_status_id == 1){
                                        				?>
                                        				<div class="badge badge-info">Reffered</div>
                                        				<?php
                                        			}else if ($admission_status_id == 2){
                                        				?>
                                        				<div class="badge badge-info">Discharged</div>
                                        				<?php
                                        			}else if ($admission_status_id == 3){
                                        				?>
                                        				<div class="badge badge-danger">Deceased</div>
                                        				<?php
                                        			}else if($admission_status_id == 4){
                                        				?>
                                        				<div class="badge badge-warning">SAMA</div>
                                        				<?php
                                        			}
                                        		?>
											</td>

                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">...</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<li><a href="view_note?view=<?php echo $ipid; ?>&id=<?php echo $p_id; ?>">View Case File</a></li>
													</ul>
												</div>
											</td>
                                        </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
                                        <th>Admitting Doctor</th>
                                    	<th>Patient Name</th>
                                    	<th>Date Admitted</th>
                                    	<th>Ward</th>
                                    	<th>Bed Number</th>
                                    	<th>Status</th>
                                    	<th>Action</th>
                                    </thead>
								</table>
<!--Pagination Start-->
								<nav aria-label="...">
									<ul class="pagination">
										<?php if (($pn > 1)) {
											?>
									    <li class="page-item">
											<a class="page-link" href="all_ipd.php?page=<?php echo (($pn-1));?>" tabindex="-1">Previous</a>
										</li><?php }
										if (($pn - 1) > 1) {
										    ?>
										    <li class="page-item">
												<a class="page-link" href="all_ipd.php?page=1">1</a>
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
											<a href="all_ipd.php?page=<?php echo $i; ?>" class='<?php echo $class; ?>'><?php echo $i; ?></a>
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
											<a href="all_ipd.php?page=<?php echo $totalPages; ?>"class='<?php echo $class; ?>'><?php echo $totalPages; ?></a>
										</li>
										    <?php
										}
										?>
										    <?php
										    if (($row > 1) && ($pn < $totalPages)) {
										        ?>
										        <li class="page-item">
													<a class="page-link" href="all_ipd.php?page=<?php echo (($pn+1));?>"><span>Next</span></a> 
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
