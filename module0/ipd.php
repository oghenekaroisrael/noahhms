<?php 
	ob_start();
	session_start();
	$pageTitle = "Admission";
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

	$p_id = $_GET['id'];
?>

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
                                <h4 class="title">Patient Details</h4>
                            </div>

                            <div class="content">
                                <form id="ips">
                                	<div class="col-md-6">
										<div class="row">
											<?php
												$notarray = database::getInstance()->select_from_where('patients','id',$p_id);
												foreach($notarray as $row):
												
												$reg_num = $row['reg_num'];
												$title = $row['title'];
												$surname = $row['surname'];
												$mid = $row['middle_name'];
												endforeach;
											?>
											<div class="col-md-6">
	                                            
			                                        <div class="form-group">
			                                            <label>Registration Number</label>
			                                            <input type="text" class="form-control" name="reg_num" value="<?php echo $reg_num;?>" >
			                                        </div>
			                                   
	                                        </div>  

	                                       <div class="col-md-6">
	                                           
			                                        <div class="form-group">
			                                            <label>Title</label>
			                                            <input type="text" class="form-control" name="title" placeholder="Title" value="<?php echo $title;?>" >
			                                        </div>   
			                                    
			                                </div>

			                                
										</div>
									</div>
                                	
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-6">
	                                            <div class="form-group">
			                                        <label>Surname</label>
			                                        <input type="text" class="form-control" name="surname" placeholder="Surname" value="<?php echo $surname;?>">
			                                     </div>
	                                        </div> 

	                                       <div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>First and Middle Name</label>
	                                                <input type="text" class="form-control" name="m_name" placeholder="First and Middle Name" value="<?php echo $mid;?>">
												</div>
	                                        </div> 
										</div>
									</div>

									<div class="clearfix"></div>

									<div class="header">
		                                <h4 class="title">Admission Details</h4>
		                            </div>

		                            <div class="clearfix"></div>

		                            <div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Admission No.</label>
	                                                <input type="text" class="form-control" name="admin_no" placeholder="Admission No." >
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Admission Date</label>
	                                                <input type="date" class="form-control" name="admin_date" placeholder="Admission Date" >
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Referred From</label>
	                                                <select class="form-control" name="referred">
														<option value="">Choose Referral Type</option>
														<option value="OPD">OPD</option>
														<option value="Emergency">Emergency</option>
														<option value="External">External</option>
													</select>
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Admitting Nurse</label>
	                                                <select class="form-control" name="nurse">
													<option value="">Admitting Nurse</option>
													<?php
														
														$sev = 7;
														$userDetails = Database::getInstance()->select_from_where2('staff', 'role_id', $sev);
														foreach($userDetails as $ow):
															$did = $ow['user_id'];
															$name = $ow['first_name']." ".$ow['last_name'];	
														
													?>
													<option value="<?php echo $did;?>"><?php echo $name;?></option>
													<?php endforeach; ?>
												</select>
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Admitting Doctor</label>
	                                                <select class="form-control" name="doctor">
													<option value="">Admitting Doctor</option>
													<?php
														
														$five = 5;
														$userDetails = Database::getInstance()->select_from_where2('staff', 'role_id', $five);
														foreach($userDetails as $ow):
															$did = $ow['user_id'];
															$name = $ow['first_name']." ".$ow['last_name'];	
														
													?>
													<option value="<?php echo $did;?>"><?php echo $name;?></option>
													<?php endforeach; ?>
												</select>
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="clearfix"></div>

									<div class="header">
		                                <h4 class="title">Bed Management</h4>
		                            </div>

		                            <div class="clearfix"></div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Room Name</label>
	                                                <input type="text" class="form-control" name="room" placeholder="Room Name" >
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Ward</label>
	                                                <input type="text" class="form-control" name="ward" placeholder="Ward" >
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Bed Number</label>
	                                                <input type="text" class="form-control" name="bed_num" placeholder="Bed Number" >
	                                            </div>
	                                        </div>
										</div>
									</div>

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Submit</button>
									<button type="reset" class="btn btn-danger btn-fill pull-left">Clear</button>
                                    <div class="clearfix"></div>
                                </form>
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
		a('#ips').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			var p_id = "<?php echo $p_id;?>";
			a.ajax({
				type: "POST",
				data: a('#ips').serialize() + "&p_id=" + p_id + '&ins=newIPD',
				url: "../func/verify.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					a("#get_result").html(res).fadeIn("slow");
					console.log(res);
				}
			});
        });
    });
</script>

