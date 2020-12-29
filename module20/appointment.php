<?php 
	ob_start();
	session_start();
	$pageTitle = "Appointments";
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
		$db = mysqli_connect("localhost","root","","noahhms");
		$noti = mysqli_query($db, "SELECT * FROM notifications WHERE staff_id = ".$user_id." AND strikes <= 3 AND `timer_notify` <=  '".date("Y-m-d H:i:s")."' ORDER BY id DESC");
		if (mysqli_num_rows($noti) > 0){
		$here = mysqli_fetch_assoc($noti);
		?>
				<div class="container-fluid" id="notify_me" style="display: block;">
					<div class="notify_box">
						<div class="notify_icon">
							<i class="fas fa-bell-o"></i>	
						</div>
						<div class="notify_content">
							<h4 class="text-center"><?php echo $here['message']; ?></h4>
							<p class="text-center" style="font-weight: bolder; font-size: 18px;">(<?php 
								$name_p = mysqli_query($db,"SELECT * FROM patients WHERE id = ".$here['patient_id']."");
								$name_k = mysqli_fetch_assoc($name_p);
									echo $name_k['surname']." ".$name_k['first_name']." ".$name_k['middle_name'];
								?>)</p>
						</div>
						<div class="notify_actions">
							<a class="btn btn-link" onclick="notify_me(<?php echo $here['id']; ?>)">Cancel</a> <a href= "<?php echo $here['link']; ?>&nstat=1&nid=<?php echo $here['id']; ?>" class="btn btn-info right">View</a>
						</div>
					</div>
					<audio id="notify_sound" autoplay=true>
				  <source src="../ping/alarm.ogg" type="audio/ogg">
				  <source src="../ping/alarm.mp3" type="audio/mp3">
				  Your browser does not support the audio element.
				</audio>
				</div>
				<?php
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
                                <h4 class="title">All Patients </h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Patient</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php 
											$count = 1; 
											$notarray = database::getInstance()->select_from_where2_ord_group('patient_appointment','specialty',2,'id','patient_id','DESC',$pn);

											//total pages
											$totalPages = database::getInstance()->count_from_where_ord2_group('patient_appointment','specialty',2,'id','patient_id','DESC');
											foreach($notarray as $row):
											$p_id = $row['patient_id'];
											$surname = "";
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td>
                                        		<?php
													$userDetails = Database::getInstance()->select_from_where('patients', 'id', $p_id);
													foreach($userDetails as $qw):
														echo $name = $qw['title']." ".$qw['middle_name']." ".$qw['surname']." ".$qw['first_name'];
														$surname = $qw['surname'];
													endforeach; 
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
														<li><a href="index2?id=<?php echo $p_id; ?>">View History</a></li>
													</ul>
												</div>
											</td>
                                        </tr>
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
                                        <th>Patient</th>
                                    	<th>Action</th>
                                    </thead>
								</table>
<!--Pagination Start-->
								<nav aria-label="...">
									<ul class="pagination">
										<?php if (($pn > 1)) {
											?>
									    <li class="page-item">
											<a class="page-link" href="appointment.php?page=<?php echo (($pn-1));?>" tabindex="-1">Previous</a>
										</li><?php }
										if (($pn - 1) > 1) {
										    ?>
										    <li class="page-item">
												<a class="page-link" href="appointment.php?page=1">1</a>
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
											<a href="appointment.php?page=<?php echo $i; ?>" class='<?php echo $class; ?>'><?php echo $i; ?></a>
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
											<a href="appointment.php?page=<?php echo $totalPages; ?>"class='<?php echo $class; ?>'><?php echo $totalPages; ?></a>
										</li>
										    <?php
										}
										?>
										    <?php
										    if (($row > 1) && ($pn < $totalPages)) {
										        ?>
										        <li class="page-item">
													<a class="page-link" href="appointment.php?page=<?php echo (($pn+1));?>"><span>Next</span></a> 
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
