<?php 
	ob_start();
	session_start();
	$pageTitle = "Physiotherapy";
	// Include database class
	include_once '../inc/db.php';
	
	If(!isset($_SESSION['userSession'])){
		header("Location: ../index");
		exit;
	}
	elseif (isset($_SESSION['userSession'])){
		$user_id = $_SESSION['userSession'];
		$user_id = $_SESSION['userSession'];
		if (!isset($_GET['page'])) {
			$pn = 1;
		}else{
			$pn=$_GET['page'];
		}
		$db = mysqli_connect("localhost","root","","noahhms");
		$noti = mysqli_query($db, "SELECT * FROM notifications WHERE staff_id = ".$user_id." AND strikes <= 3 AND `timer_notify` <=  '".date("Y-m-d H:i:s")."' ORDER BY id DESC");
		$noti2 = mysqli_query($db, "SELECT * FROM notifications WHERE staff_id= 'all_physiotherapy' AND status = 0  ORDER BY id DESC");
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
							<a class="btn btn-link left" onclick="notify_me(<?php echo $here['id']; ?>)">Cancel</a> <a href= "<?php echo $here['link']; ?>&nstat=1&nid=<?php echo $here['id']; ?>&pid=<?php echo $here['patient_id']; ?>" class="btn btn-info right">View</a>
						</div>
					</div>
					<audio id="notify_sound" autoplay=true>
				  <source src="../ping/alarm.ogg" type="audio/ogg">
				  <source src="../ping/alarm.mp3" type="audio/mp3">
				  Your browser does not support the audio element.
				</audio>
				</div>
				<?php
			}elseif (mysqli_num_rows($noti2) > 0) {
				$here2 = mysqli_fetch_assoc($noti2);
		?>
				<div class="container-fluid" id="notify_me" style="display: block;">
					<div class="notify_box">
						<div class="notify_icon">
							<i class="fas fa-bell-o"></i>	
						</div>
						<div class="notify_content">
							<h4 class="text-center"><?php echo $here2['message']; ?></h4>
							<p class="text-center" style="font-weight: bolder; font-size: 18px;">(<?php 
								$name_p = mysqli_query($db,"SELECT * FROM patients WHERE id = ".$here2['patient_id']."");
								$name_k = mysqli_fetch_assoc($name_p);
									echo $name_k['surname']." ".$name_k['first_name']." ".$name_k['middle_name'];
								?>)</p>
						</div>
						<div class="notify_actions">
							<a class="btn btn-link left" onclick="notify_me(<?php echo $here2['id']; ?>)">Cancel</a> <a href= "<?php echo $here2['link']; ?>&nstat=1&nid=<?php echo $here2['id']; ?>&pid=<?php echo $here2['patient_id']; ?>" class="btn btn-info right">View</a>
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
                                <h4 class="title">All Physiotherapy Requests </h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Doctor</th>
                                    	<th>Patient Name</th>
                                    	<th>Date Requested</th>
                                    	<th>Payment</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
									  $count = 1;
											$notarray = database::getInstance()->select_from_ord1('physiotherapy_requests','physiotherapy_id','DESC',$pn);

											//total pages
											$totalPages = database::getInstance()->count_from_ord2('physiotherapy_requests','physiotherapy_id','DESC');
											foreach($notarray as $row):
											$id = $row['patient_id'];
											if ($row['patient_appointment_id'] == 0) {
												$front = $row['front_desk'];
											}else{
												$front = $row['patient_appointment_id'];
											}
											$d_id = $row['staff_id'];
											$date_added = $row['date_added'];
											$statusS = Database::getInstance()->get_name_from_id('payment_status', 'accounts','order_id', $row['link_ref']);
											$surname = "";
										?>
                                        <tr>
                                        	<td style="width: 8%;"><?php echo $count++;?></td>
                                        	<td><i class="fas fa-user-md"></i>
                                        		<?php 
                                        			$doc = mysqli_query($db,"SELECT * FROM staff WHERE user_id = ".$d_id."");
                                        		$doct = mysqli_fetch_assoc($doc);
                                        		echo $doct['last_name']." ".$doct['first_name'];
                                        		?>                                        			
                                        		</td>
                                        	<td style="width: 20%;">
                                        		<i class="fas fa-user"></i>
                                        		<?php
                                        		$p = mysqli_query($db,"SELECT * FROM patients WHERE id = ".$id."");
                                        		$pi = mysqli_fetch_assoc($p);
												echo $name = $pi['title']." ".$pi['surname']." ".$pi['middle_name'];
												?>
                                        		
                                        	</td>
                                        	<td><i class="fas fa-clock-o"></i>
                                        		<?php 
                                        			echo $row['date_added'];
                                        		?>
                                        	</td>
                                        	<td>
                                        		<?php 
                                        			if ($statusS > 0) {
                                        				?>
                                        					<div class="badge badge-success">Paid</div>
                                        				<?php
                                        			}else{
                                        				?>
                                        					<div class="badge badge-info">Pending</div>
                                        				<?php
                                        			}
                                        		 ?>
                                        	</td>
                                        	
                                        	
                                        
                                        	<td  style="width: 12%;">
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
													<li><a href="lab_results?id=<?php echo $front; ?>&pid=<?php echo $id; ?>&ref=<?php echo $row['link_ref']; ?>">View Case File</a></li>
														<div class="divider"></div>
														<li><a href="upload_doc?id=<?php echo $front; ?>&pid=<?php echo $id; ?>&ref=<?php echo $row['link_ref']; ?>">Add Therapy Plan</a></li>
													<?php } else { ?>
													<li>Payment Not Made</li>
													<?php } ?>
														
													</ul>
												</div>
											</td>
                                        </tr>
                                        
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
                                       <th>#</th>
                                        <th>Doctor</th>
                                    	<th>Patient Name</th>
                                    	<th>Date Requested</th>
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
