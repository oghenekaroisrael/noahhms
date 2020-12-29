<?php 
	ob_start();
	session_start();
	$pageTitle = "New Vitals";
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

	$value= $_GET['add'];
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
                                <h4 class="title">Vitals</h4>
                            </div>

                            <div class="content">
                                <form id="appt">
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                
													<label>Patient's Name</label>
												
													<?php
																$userDetails = Database::getInstance()->select_from_where("patient_appointment", "id", $value);
																  foreach($userDetails as $ew):  
																    $pid = $ew['patient_id'];
																    	endforeach; 
																	$userDetails = Database::getInstance()->select_from_where("patients", "id", $pid);
																	
																foreach($userDetails as $w):
																	$c_id = $w['id'];
																	$title = $w['title'];	
																	$first = $w['surname'];	
																	$last = $w['middle_name'];
																		
																	
																$nam = $title." ".$first." ".$last;
													
															endforeach;
															?>
															<input type="text" class="form-control" name="name" placeholder="Patient's Name" value="<?php echo $nam;?>">
															
														
													</div>
												</div>
										</div>
									</div>
													
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Temperature</label>
	                                                <input type="text" class="form-control" name="temp" placeholder="Temperature" >
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="clearfix"></div>

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Weight</label>
	                                                <input type="text" class="form-control" name="weight" placeholder="Weight" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>Pulse Rate</label>
	                                                <input type="text" class="form-control" name="pulse" placeholder="Pulse Rate" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>Blood Sugar</label>
	                                                <input type="text" class="form-control" name="sug" placeholder="Blood Sugar" >
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                 <label>Blood Pressure Systolic Standing</label>
	                                                <input type="text" class="form-control" name="bpstd" placeholder="Blood Pressure Systolic Standing" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Blood Pressure Diastolic Standing</label>
	                                                <input type="text" class="form-control" name="bpsts" placeholder="Blood Pressure Systolic Standing" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Blood Pressure Systolic Sitting</label>
	                                                <input type="text" class="form-control" name="bpsis" placeholder="Blood Pressure Systolic Sitting" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                               <label>Blood Pressure Diastolic Sitting</label>
	                                                <input type="text" class="form-control" name="bpsid" placeholder="Blood Pressure Diastolic Sitting" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>History</label>
	                                                <textarea type="text" class="form-control" name="history" placeholder="History" ></textarea>
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="clearfix"></div>

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Add Vitals</button>
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

<script>	
	var s=jQuery .noConflict();
	s(document).ready(function() {
		s('form').submit(function(e){
			var id = "<?php echo $value; ?>";
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			s.ajax({
				type: "POST",
				data: s('form').serialize() + "&val=" + id + "&ins=addVitals",
				url: "../func/edit.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					s("#get_result").html(res).fadeIn("slow");
				}
			});
		})			
	})			
</script>

