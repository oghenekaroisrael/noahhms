<?php 
	ob_start();
	session_start();
	$pageTitle = "Process Corpse";
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

	$value= $_GET['id'];
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
                                <h4 class="title">Process Deceased</h4>
                            </div>
                            <div class="content">
                                <form>
								 <?php
                            $noarray = database::getInstance()->select_from_where('ipd_patients','id',$value);
                            while ($row = $noarray->fetch(PDO::FETCH_ASSOC)) {
                            	$p_id = $row['patient_id'];
                            	$doctor_id = $row['doctor_id'];
                            	?>
								<div class="col-md-6">
										<div class="row">

											<div class="col-md-6">
	                                            
			                                        <div class="form-group">
			                                            <label>Admission Number</label>
			                                            <input type="text" class="form-control" name="admin_no" disabled value="<?php echo $row['admin_no'];?>" />
			                                        </div>
			                                   
	                                        </div>  
	                                        <?php 
                                        		$userDetails = Database::getInstance()->select_from_where('patients', 'id', $p_id);
														foreach($userDetails as $ow):
															
															$title = $ow['title'];
															$surname = $ow['surname'];
															$middle_name = $ow['middle_name'];
															$first_name = $ow['first_name'];

															$gender = $ow['sex'];
															$kname = $ow['next_of_kin'];
															$krel = $ow['rel_of_kin'];
															$kphone = $ow['next_kin_phone'];
															$kaddress = $ow['next_kin_address'];	
														endforeach; 
													
                                        	?>
                                        	<input type="hidden" name="name" value="<?php echo $title.' '.$surname.' '.$middle_name.' '.$first_name; ?>">
                                        	<input type="hidden" name="sex" value="<?php echo $gender; ?>">
                                        	<input type="hidden" name="kname" value="<?php echo $kname; ?>">
                                        	<input type="hidden" name="krel" value="<?php echo $krel; ?>">
                                        	<input type="hidden" name="kphone" value="<?php echo $kphone; ?>">
                                        	<input type="hidden" name="kaddress" value="<?php echo $kaddress; ?>">
	                                       <div class="col-md-6">
	                                           	
			                                        <div class="form-group">
			                                            <label>Title</label>
			                                            <input type="text" class="form-control" name="title" disabled value="<?php echo $title;?>">
			                                        </div>   
			                                    
			                                </div>

			                                
										</div>
									</div>
                                	
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-6">
	                                            <div class="form-group">
			                                        <label>Surname</label>
			                                        <input type="text" class="form-control" name="surname" disabled value="<?php echo $surname;?>" >
			                                     </div>
	                                        </div> 

	                                       <div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>First and Middle Name</label>
	                                                <input type="text" class="form-control" name="m_name" disabled value="<?php echo $first_name.' '.$middle_name;?>">
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
			                                            <input type="text" class="form-control" name="admin_no" disabled value="<?php echo $row['admin_no'];?>"/>
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Death Date</label>
	                                                <input type="date" class="form-control" name="dis_date" disabled value="<?php echo $row['admission_status_date'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>


									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Admitting Doctor</label><?php

														$userDetails = Database::getInstance()->select_from_where('staff', 'user_id', $doctor_id);
														foreach($userDetails as $ow){
															$did = $ow['user_id'];
															$name = $ow['first_name']." ".$ow['last_name'];	
														}
														
													?>
	                                                <input type="text" class="form-control" disabled value="<?php echo $name; ?>">
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="clearfix"></div>

									<div class="header">
		                                <h4 class="title">Bed / Room Assignment</h4>
		                            </div>

		                            <div class="clearfix"></div>

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Room Type</label>
	                                                <select class="form-control" name="room" id="room_type">
													<?php
														
														
														$wards = Database::getInstance()->select('morgue_bed_types');
														foreach($wards as $ward):

															$ward_id= $ward['id'];
															$ward = $ward['types'];	
														
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
												</select>
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Tag Number</label>
	                                                 <input class="form-control" name="tag">
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Serial Number</label>
	                                                 <input class="form-control" name="serial">
	                                            </div>
	                                        </div>
										</div>
									</div>
								
							<?php } ?>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Process</button>
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
				data: s('form').serialize() + "&id=" + id + "&ins=processDeceased&staff=<?php echo $user_id; ?>",
				url: "../func/edit.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					s("#get_result").html(res).fadeIn("slow");
				}
			});
		})	
		s("#room_type").change(function(){
			var id = s(this).val();
			var post_id = 'id='+ id + '&bed=<?php echo $bed; ?>';
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

