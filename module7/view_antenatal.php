<?php 
	ob_start();
	session_start();
	$pageTitle = "Antenatal Case Note";
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
<style type="text/css">
	.row{
		margin-bottom: 15px;
	}
</style>
<div class="wrapper" id="homesc">

<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>
	
	  <!--  MAIN -->
        <div class="content">
            <div class="container-fluid">
	
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                           <div class="header">
                                <h4 class="title">Antenatal</h4>
                            </div>

                            <div class="content">
									<?php
										$noarray = database::getInstance()->select_from_where('antenatal1','id',$id);
										while ($row = $noarray->fetch(PDO::FETCH_ASSOC)) {
										
									?>

									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-3">
			                                        <label>Surname:</label>
			                                        <p><?php echo $row['surname']; ?></p>
			                                </div>

			                                <div class="col-md-3">
			                                        <label>First Name:</label>
			                                        <p><?php echo $row['first_name']; ?></p>
			                                </div>

			                                <div class="col-md-1">
			                                        <label>Age:</label>
			                                        <p><?php echo $row['age']; ?></p>
			                                </div>

			                                <div class="col-md-2">
			                                        <label>Age Of Marriage:</label>
			                                        <p><?php echo $row['marriage_age']; ?></p>
			                                </div>

			                                <div class="col-md-3">
			                                        <label>Hospital Number:</label>
			                                        <p><?php echo $row['hospital_number']; ?></p>
			                                </div> 
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
			                                        <label>Special Points / Instructions:</label>
			                                        <p><?php echo $row['instructions']; ?></p>
			                                </div>
									</div>	

									<div class="row">
										<div class="col-lg-6">
											<label>Address</label>
	                                        <p><?php echo $row['address']; ?></p>
										</div>

										<div class="col-lg-3">
											<label>Duration of Pregnancy At Booking</label>
	                                                <p><?php echo $row['preg_duration']; ?></p>
										</div>
										<div class="col-lg-3">
											<label>Tribe</label>
	                                        <p><?php echo $row['tribe']; ?></p>
										</div>
									</div>

									<div class="row">
										
										<div class="col-lg-4">
											<label>Occupation</label>
	                                        <p><?php echo $row['occupation']; ?></p>
										</div>

										<div class="col-lg-4">
											<label>L.M.P</label>
	                                        <p><?php echo $row['lmp']; ?></p>
										</div>
										<div class="col-lg-4">
											<label>E.D.D</label>
	                                        <p><?php echo $row['edd']; ?></p>
										</div>
									</div>
										</div>
									</div>

									<div class="card">
										<div class="header">
		                                <h4 class="title">Previous Medical History</h4>
		                            </div>
                            		<div class="content">
											<div class="row">
												<div class="col-lg-3">
													<div class="form-group">
		                                                <label>Hypertension</label>
		                                                <p><?php echo $row['hypertension']; ?></p>
													</div>
												</div>

												<div class="col-lg-3">
													<div class="form-group">
		                                                <label>Chest Diseases</label>
		                                                <p><?php echo $row['chest']; ?></p>
													</div>
												</div>

												<div class="col-lg-3">
													<div class="form-group">
		                                                <label>Anaemia</label>
		                                                <p><?php echo $row['anaemia']; ?></p>
													</div>
												</div>

												<div class="col-lg-3">
													<div class="form-group">
		                                                <label>Heart Diseases</label>
		                                                <p><?php echo $row['heart']; ?></p>
													</div>
												</div>

												<div class="col-lg-3">
													<div class="form-group">
		                                                <label>Kidney Disease</label>
		                                                <p><?php echo $row['kidney']; ?></p>
													</div>
												</div>

												<div class="col-lg-3">
													<div class="form-group">
		                                                <label>Blood Transfusion</label>
		                                                <p><?php echo $row['blood']; ?></p>
													</div>
												</div>

												<div class="col-lg-3">
													<div class="form-group">
		                                                <label>GIT Disease</label>
		                                                <p><?php echo $row['git']; ?></p>
													</div>
												</div>

												<div class="col-lg-3">
													<div class="form-group">
		                                                <label>Diabetes</label>
		                                                <p><?php echo $row['diabetes']; ?></p>
													</div>
												</div>

												<div class="col-lg-3">
													<div class="form-group">
		                                                <label>Operation</label>
		                                                <p><?php echo $row['operation']; ?></p>
													</div>
												</div>

												<div class="col-lg-3">
													<div class="form-group">
		                                                <label>Admission In Last Pregnancy</label>
		                                                <p><?php echo $row['admission']; ?></p>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-2">
													<div class="form-group">
		                                                <label>G</label>
		                                                <p><?php echo $row['G']; ?></p>
													</div>
												</div>

												<div class="col-lg-2">
													<div class="form-group">
		                                                <label>P</label>
		                                                <p><?php echo $row['P1']; ?></p>
													</div>
												</div>

												<div class="col-lg-2">
													<div class="form-group">
		                                                <label>F</label>
		                                                <p><?php echo $row['F']; ?></p>
													</div>
												</div>

												<div class="col-lg-2">
													<div class="form-group">
		                                                <label>P</label>
		                                                <p><?php echo $row['P2']; ?></p>
													</div>
												</div>

												<div class="col-lg-2">
													<div class="form-group">
		                                                <label>A</label>
		                                                <p><?php echo $row['A']; ?></p>
													</div>
												</div>

												<div class="col-lg-2">
													<div class="form-group">
		                                                <label>L</label>
		                                                <p><?php echo $row['L']; ?></p>
													</div>
												</div>
											</div>
									</div>
									</div>

									<?php } ?>
									<div class="card">
										<div class="header">
                                <h4 class="title">Antenatal Notes</h4>
                            </div>

										<div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Date Of Birth</th>
                                    	<th>Duration Of Pregnancy</th>
                                    	<th>Birth Weight</th>
                                    	<th>Complication In Pregnancy</th>
                                    	<th>Complication In Labour</th>
                                    	<th>Puerperium</th>
                                    	<th>Age At Death</th>
                                    	<th>Cause Of Death</th>
                                    	<th>Added By</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_where_ord("antenatal_note","antenatal_id",$_GET['id'],"id","DESC");
											foreach($notarray as $row):
											$date = date("jS M Y",strtotime($row['date_added']));
											$time = $row['preg_duration'];
											$id = $row['patient_obs_id'];
											$by1 = database::getInstance()->select_from_where("staff","user_id",$row['added_by']);
											foreach ($by1 as $y) {
												$by = $y['last_name']." ".$y['first_name'];
											}
						
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><?php echo $date;?></td>
                                        	<td><?php echo $time;?></td>
                                        	<td><?php echo $row['weight'];?></td>
                                        	<td><?php echo $row['complication_p'];?></td>
                                        	<td><?php echo $row['complication_l'];?></td>
                                        	<td><?php echo $row['puerperium'];?></td>
                                        	<td><?php echo $row['death_age'];?></td>
                                        	<td><?php echo $row['cause_of_death'];?></td>
                                        	<td><?php echo $by;?></td>
                                        </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
										<th>#</th>
                                        <th>Date Of Birth</th>
                                    	<th>Duration Of Pregnancy</th>
                                    	<th>Birth Weight</th>
                                    	<th>Complication In Pregnancy</th>
                                    	<th>Complication In Labour</th>
                                    	<th>Puerperium</th>
                                    	<th>Age At Death</th>
                                    	<th>Cause Of Death</th>
                                    	<th>Added By</th>
                                    </thead>
								</table>

                            </div>
									</div><!--antenatal notes-->
								<div class="row">
	              <div class="col-md-4">
																			 <div class="btn-group">
																				<button type="button" class="btn btn-info">Investigative Requests</button>
																				<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
																				<span class="caret"></span>
																				<span class="sr-only">Toggle Dropdown</span>
																				</button>
																				<ul class="dropdown-menu" role="menu">
																					<li><a href="request_test?id=<?php echo $value;?>">Request Test</a></li>
																					<li class="divider"></li>
																					<li><a href="xray_request.php?id=<?php echo $value; ?>&pid=<?php echo $pp_id; ?>&doc=<?php echo $user_id; ?>">Request Xray</a></li>

																					<li class="divider"></li>
																					<li><a href="scan_request.php?id=<?php echo $value; ?>&pid=<?php echo $pp_id; ?>&doc=<?php echo $user_id; ?>">Request Scan</a></li>
																				
																				</ul>
																			</div> 
	               </div>
	               
	               <div class="col-md-4">
	               			<div class="btn-group">
													<button type="button" class="btn btn-info">Management Requests</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu"  style="">
														<li><a href="patient_details?id=<?php echo $value;?>">Prescription</a></li>
														
													
														<li class="divider"></li>
														<li><a href="new_surgery?id=<?php echo $value; ?>&pid=<?php echo $pp_id; ?>">Request Surgery</a></li>
													</ul>
												</div>                          	
	               </div>
	           </div>
									<div class="card">
										<div class="header">
                                <h4 class="title">Antenatal Records</h4>
                            </div>	
                            <a href="new_record?id=<?php echo $_GET['id']; ?>" style="margin:10px 10px;" class="btn btn-primary pull-right btn-flat btblack">
											<i class="entypo-plus-circled"></i> New Record
										</a>
										<div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Date</th>
                                    	<th>EGA (Wks)</th>
                                    	<th>SFH (cm)</th>
                                    	<th>Presentation</th>
                                    	<th>Position</th>
                                    	<th>Foetal Heart</th>
                                    	<th>Oedema</th>
                                    	<th>Weight</th>
                                    	<th>BP</th>
                                    	<th>Doctor</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_where_ord("antenatal_record","antenatal_id",$_GET['id'],"id","DESC");
											foreach($notarray as $row):
											$date = date("jS M Y",strtotime($row['date_added']));
											$id = $row['id'];
											$by1 = database::getInstance()->select_from_where("staff","user_id",$row['added_by']);
											foreach ($by1 as $y) {
												$by = $y['last_name']." ".$y['first_name'];
											}
						
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><?php echo $date;?></td>
                                        	<td><?php echo $row['ega'];?></td>
                                        	<td><?php echo $row['sfh'];?></td>
                                        	<td><?php echo $row['pres'];?></td>
                                        	<td><?php echo $row['pos'];?></td>
                                        	<td><?php echo $row['fh'];?></td>
                                        	<td><?php echo $row['o'];?></td>
                                        	<td><?php echo $row['w'];?></td>
                                        	<td><?php echo $row['bp'];?></td>
                                        	<td><?php echo $by;?></td>
                                        </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
										<th>#</th>
                                        <th>Date</th>
                                    	<th>EGA (Wks)</th>
                                    	<th>SFH (cm)</th>
                                    	<th>Presentation</th>
                                    	<th>Position</th>
                                    	<th>Foetal Heart</th>
                                    	<th>Oedema</th>
                                    	<th>Weight</th>
                                    	<th>BP</th>
                                    	<th>Doctor</th>
                                    </thead>
								</table>

                            </div>
									</div><!--antenatal Records-->
									
                            </div>
                        
						</div>
                    </div>
                 </div>

				<div id="get_result"></div>
				

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
	var a=jQuery .noConflict();			
	a(function () {

		a('#change_ante').on('submit', function (e) {
			var ID = "<?php echo $_GET['id']; ?>";
			var staff = "<?php echo $user_id; ?>";
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			var id = "<?php echo $id; ?>";
			a.ajax({
				type: "POST",
				data: a('#change_ante').serialize()  + "&id=" + id + '&ins=editAntenatal_N&edit='+ ID + '&staff='+staff,
				url: "../func/edit.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					a("#get_result").html(res).fadeIn("slow");
					console.log(res);
				}
			});
        });
    });
</script>