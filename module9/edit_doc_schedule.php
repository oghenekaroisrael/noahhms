<?php 
	ob_start();
	session_start();
	$pageTitle = "Edit Doctor's Schedule";
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
                                <h4 class="title">Edit Doctor's Schedule</h4>
                            </div>

                            <div class="content">
                                <form id="edit_sche">
                                	<?php
			                            $noarray = database::getInstance()->select_from_where('doctor_schedule','id',$value);
			                            while ($ow = $noarray->fetch(PDO::FETCH_ASSOC)) {
			                            		$docy_id = $ow['doctor_id'];
			                            	?>
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Choose Doctor</label>
	                                                <select class="form-control" name="doctor">
	                                                <?php
														$userDetails = Database::getInstance()->select_from_where('staff', 'id', $docy_id);
														foreach($userDetails as $row):
															$id = $row['id'];
															$name = $row['name'];	
													?>
													<option value="<?php echo $id;?>"><?php echo $name;?></option>
													<?php endforeach; ?>
													<option value="">Choose Doctor</option>
													<?php
														
														$five = 5;
														$userDetails = Database::getInstance()->select_from_where2('staff', 'role_id', $five);
														foreach($userDetails as $row):
															$id = $row['id'];
															$name = $row['first_name']." ".$row['last_name'];	
													?>
													<option value="<?php echo $id;?>"><?php echo $name;?></option>
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
	                                                <label>Choose Day of the Week</label>
	                                                <select class="form-control" name="dayofweek">
														<option value="Sunday"><?php echo $ow['day_of_week'];?></option>
														<option value="Sunday">Sunday</option>
														<option value="Monday">Monday</option>
														<option value="Tuesday">Tuesday</option>
														<option value="Wednesday">Wednesday</option>
														<option value="Thursday">Thursday</option>
														<option value="Friday">Friday</option>
														<option value="Saturday">Saturday</option>
													</select>
	                                            </div>
	                                        </div>
										</div>
									</div>


									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Time In</label>
	                                                <input type="time" class="form-control" name="timein" placeholder="Time In" value="<?php echo $ow['time_in'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Time Out</label>
	                                                <input type="time" class="form-control" name="timeout" placeholder="Time In" value="<?php echo $ow['time_out'];?>" >
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Date</label>
	                                                <input type="date" class="form-control" name="dateday" placeholder="Date" value="<?php echo $ow['day_date'];?>" >
	                                            </div>
	                                        </div>
										</div>
									</div>
								<?php } ?>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Edit Schedule</button>
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
	var s=jQuery .noConflict();
	s(document).ready(function() {
		s('form').submit(function(e){
			var id = "<?php echo $value; ?>";
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			s.ajax({
				type: "POST",
				data: s('form').serialize() + "&val=" + id + "&ins=editSche",
				url: "../func/edit.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					s("#get_result").html(res).fadeIn("slow");
				}
			});
		})			
	})			
</script>

