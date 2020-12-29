
<?php 
	ob_start();
	session_start();
	$pageTitle = "New Injection Request";
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
				<div id="get_result"></div>
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Injection Request</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Patient</th>
                                    	<th>Doctor</th>
                                    	<th>Injection</th>
                                    	<th>Tab</th>
                                    	<th>Frequency</th>
                                    	<th>Day(s)</th>
                                    	<th>Instruction</th>
                                    	<th>Date</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_ord1('prescription1','prescription_id','DESC',$pn);
											//total pages
											$totalPages = database::getInstance()->count_from_ord2('prescription1','prescription_id','DESC');
											foreach($notarray as $row):
											$rid = $row['prescription_id'];
											$app_id = $row['appointment_id'];
											$drug = $row['pharm_stock_id'];
											$tabs = $row['stabs'];
											$dosage= $row['sdosage'];
											$dur = $row['sduration'];
											$dispense = $row['squantity_dispense'];
											$instr = $row['instruction'];
											$p_id = $row['patient_id'];
											$d_id = $row['doctor_id'];
											$status = $row['status'];
										
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td>
                                        		<?php
													$userDetails = Database::getInstance()->select_from_where('patients', 'id', $p_id);
													foreach($userDetails as $qw):
														echo $pname = $qw['title']." ".$qw['surname']." ".$qw['middle_name']." ".$qw['first_name'];
														
													endforeach; 
												?>
                                        		
                                        	</td>
                                        	
                                        	<td>
                                        		<?php
													$userDetails = Database::getInstance()->select_from_where('staff', 'user_id', $d_id);
													foreach($userDetails as $ow):
														echo $dname = $ow['first_name']." ".$ow['last_name'];	
													endforeach; 
												?>

                                        	</td>
                                        	<td>
                                        		<?php 
                                        			echo $inj =  Database::getInstance()->get_name_from_id('name','pharm_stock','id',$drug);
                                        		 ?>
                                        	</td>
                                        	<td><?php echo $tabs; ?></td>
                                        	<td><?php 
                                        		if ($dosage == 1) {
                                        			echo "Daily";
                                        		}elseif ($dosage == 2) {
                                        			echo "B.D";
                                        		}elseif ($dosage == 3) {
                                        			echo "T.D.S";
                                        		}elseif ($dosage == 4) {
                                        			echo "Q.D.S";
                                        		}
                                        	 ?></td>
                                        	<td><?php echo $dur; ?></td>
                                        	<td><?php echo $instr; ?></td>
                                        	<td>
                                        		<?php 
												$fDate = $row['date_added'];
												$dt = new DateTime($fDate); //for getting just date from timestamp
											?>
											<?php echo $dt->format('d-m-Y'); ?>
                                        	</td>
                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">...</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
														<li><a href="view_note?view=<?php echo $app_id; ?>&id=<?php echo $p_id;?>">View Case File</a></li>
														<li class="divider"></li>
														<li><a href="injection?view=<?php echo $app_id; ?>&id=<?php echo $p_id;?>&rid=<?php echo $rid; ?>">Injection Status</a></li>
													</ul>
												</div>
											</td>
                                        </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
										<th>#</th>
                                        <th>Patient</th>
                                    	<th>Doctor</th>
                                    	<th>Injection</th>
                                    	<th>Tab</th>
                                    	<th>Frequency</th>
                                    	<th>Day(s)</th>
                                    	<th>Instruction</th>
                                    	<th>Date</th>
                                    	<th>Action</th>
                                    </thead>
								</table>
<!--Pagination Start-->
								<nav aria-label="...">
									<ul class="pagination">
										<?php if (($pn > 1)) {
											?>
									    <li class="page-item">
											<a class="page-link" href="exam_request.php?page=<?php echo (($pn-1));?>" tabindex="-1">Previous</a>
										</li><?php }
										if (($pn - 1) > 1) {
										    ?>
										    <li class="page-item">
												<a class="page-link" href="exam_request.php?page=1">1</a>
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
											<a href="exam_request.php?page=<?php echo $i; ?>" class='<?php echo $class; ?>'><?php echo $i; ?></a>
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
											<a href="exam_request.php?page=<?php echo $totalPages; ?>"class='<?php echo $class; ?>'><?php echo $totalPages; ?></a>
										</li>
										    <?php
										}
										?>
										    <?php
										    if (($row > 1) && ($pn < $totalPages)) {
										        ?>
										        <li class="page-item">
													<a class="page-link" href="exam_request.php?page=<?php echo (($pn+1));?>"><span>Next</span></a> 
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
            	message: "Are you sure you want to delete <b>"+name+"</b>'s request ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

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
            data: "val=" + val +  '&ins=delExamReq',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'exam_request';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>
	
<script type="text/javascript">
		var f=jQuery .noConflict();
		f('#pro').on('change', '#status', function(e) {
			var selected = f(this).val();
			var ins = 'changeExamStatus';
			//get current row
			var currentRow = f(this).closest("tr"); 
			var app_id = currentRow.find("td:eq(1)").text(); // get value of coloumn 2
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			f.ajax({
				type: 'post',
				url: '../func/verify.php',
				data: { selected: selected, app_id: app_id, ins: ins},
				success: function(res){
					document.getElementById("load").style.display = "none";
					jQuery('#get_result').html(res).show();
						//console.log(res);
				}
			});

		});
</script>
