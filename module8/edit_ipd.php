<?php 
	ob_start();
	session_start();
	$pageTitle = "Edit Patient";
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

	$value= $_GET['edit'];
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
                                <h4 class="title">Update IPD</h4>
                            </div>
                            <div class="content">
                                <form>
								 <?php
                            $noarray = database::getInstance()->select_from_where('ipd_patients','admin_no',$value);
                            while ($row = $noarray->fetch(PDO::FETCH_ASSOC)) {
                            	$p_id = $row['patient_id'];
                            	$doctor_id = $row['doctor_id'];
								$bedbef = Database::getInstance()->get_name_from_id('bed', 'beds','id',$row['bed_no']);
                            	?>
								<div class="col-md-6">
										<div class="row">

											<div class="col-md-6">
	                                            
			                                        <div class="form-group">
			                                            <label>Admission Number</label>
			                                            <input type="text" class="form-control" name="admin_no" placeholder="Admission Number" value="<?php echo $row['admin_no'];?>" />
			                                        </div>
			                                   
	                                        </div>  
	                                        <?php 
                                        		$userDetails = Database::getInstance()->select_from_where('patients', 'id', $p_id);
														foreach($userDetails as $ow):
															
															$title = $ow['title'];
															$surname = $ow['surname'];
															$middle_name = $ow['middle_name'];	
														endforeach; 
													
                                        	?>

	                                       <div class="col-md-6">
	                                           	
			                                        <div class="form-group">
			                                            <label>Title</label>
			                                            <input type="text" class="form-control" name="title" placeholder="Title" value="<?php echo $title;?>">
			                                        </div>   
			                                    
			                                </div>

			                                
										</div>
									</div>
                                	
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-6">
	                                            <div class="form-group">
			                                        <label>Surname</label>
			                                        <input type="text" class="form-control" name="surname" placeholder="Surname" value="<?php echo $surname;?>" >
			                                     </div>
	                                        </div> 

	                                       <div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>First and Middle Name</label>
	                                                <input type="text" class="form-control" name="m_name" placeholder="First and Middle Name" value="<?php echo $middle_name;?>">
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
	                                                <label>Admission Number</label>
			                                            <input type="text" class="form-control" name="admin_no" placeholder="Admission Number" value="<?php echo $row['admin_no'];?>" />
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Discharge Date</label>
	                                                <input type="date" class="form-control" name="dis_date" placeholder="Discharge Date" value="<?php echo $row['discharged'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>


									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Referred From</label>
	                                                <select class="form-control" name="referred">

														<option value="<?php echo $row['ref'];?>"><?php echo $row['ref'];?></option>
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
	                                                <label>Admitting Doctor</label>
	                                                <select class="form-control" name="doctor">
													<?php

														$userDetails = Database::getInstance()->select_from_where('staff', 'user_id', $doctor_id);
														foreach($userDetails as $ow){
															$did = $ow['user_id'];
															$name = $ow['first_name']." ".$ow['last_name'];	
														}
														
													?>
													<option value="<?php echo $did;?>"><?php echo $name;?></option>
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
	                                                <label>Bed Type</label>
	                                                <select class="form-control" name="ward" id="bed_type">
	                                                	<option value="<?php echo $row['ward'];?>"><?php echo database::getInstance()->get_name_from_id('name','bed_types','id',$row['ward']); ?></option>
													<?php
														
														
														$wards = Database::getInstance()->select('bed_types');
														foreach($wards as $ward):

															$ward_id= $ward['id'];
															$ward = $ward['name'];	
														
													?>
													<option value="<?php echo $ward_id;?>"><?php echo $ward;?></option>
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
	                                                <label>Bed Number</label>
	                                                 <select class="form-control" name="bed_num" id="bed">
													<option value="<?php echo $bed = $row['bed_no'];?>"><?php echo $bedbef;?></option>
												</select>
	                                            </div>
	                                        </div>
										</div>
									</div>
								
							<?php } ?>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Update Patient Details</button>
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
				data: s('form').serialize() + "&id=" + id + "&ins=editIPD&nurse=<?php echo $user_id; ?>",
				url: "../func/edit.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					s("#get_result").html(res).fadeIn("slow");
				}
			});
		})	
		s("#bed_type").change(function(){
			var id = s(this).val();
			var post_id = 'id='+ id + 'bed=<?php echo $bed; ?>';
			s.ajax({
			type: "POST",
			url: "b.php",
			data: post_id,
			cache: false,
			success: function(res){
					s("#bed").html(res).fadeIn("slow");
				} 
			});
 
		});		
	})			
</script>

