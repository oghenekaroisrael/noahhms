<?php 
	ob_start();
	session_start();
	$pageTitle = "New Appointment";
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
                                <h4 class="title">Today's Appointments</h4>
                            </div>

                            <div class="content">
                                <form id="appt">
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Choose Doctor</label>
	                                                <select class="form-control" name="doctor">
													<option value="">Choose Doctor</option>
													<?php
														$userDetails = Database::getInstance()->select_from_cur_date();
														foreach($userDetails as $row):
															$doc_id = $row['doctor_id'];
															$name = $row['name'];	

														$userDetails = Database::getInstance()->select_from_where('staff', 'user_id', $doc_id);
														foreach($userDetails as $ow):
															$id = $ow['user_id'];
															$name = $ow['first_name']." ".$ow['last_name'];	
														endforeach; 
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
	                                                
													<label>Patient's Name</label>
												
													<p class="toggle">Patient's Name</p>
						
														
													<div class="toggleDrop">
														<input id="myInput" onkeyup="filterFunction()" placeholder ="Filter Your Client" />
													
														<div id="myDropdown" class="chooseList">
															<?php
																$userDetails = Database::getInstance()->select("patients");
																foreach($userDetails as $row):
																	$c_id = $row['id'];
																	$title = $row['title'];	
																	$first = $row['surname'];	
																	$last = $row['middle_name'];
																		
																	
																	$name = $title." ".$first." ".$last;
																
															?>
															<p href="#" id="<?php echo $c_id;?>"><?php echo $name;?></p>
															<?php endforeach; ?>
														</div>
													</div>
											
												
													<script type="text/javascript">
														var a=jQuery .noConflict();
														a(document).ready(function(){
														  a(".toggle").click(function(){
														    a(".toggleDrop").fadeToggle("slow");
														  });
														});
													</script>
													<script type="text/javascript">
													function filterFunction() {
														var input, filter, ul, li, a, i;
														input = document.getElementById("myInput");
														filter = input.value.toUpperCase();
														div = document.getElementById("myDropdown");
														a = div.getElementsByTagName("p");
														for (i = 0; i < a.length; i++) {
															if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
																a[i].style.display = "";
															} else {
																a[i].style.display = "none";
															}
														}						
													}				
												</script>
	                                            </div>
	                                        </div>
										</div>
									</div>
													

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Time</label>
	                                                <input type="time" class="form-control" name="time" placeholder="Time In" >
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Date</label>
	                                                <input type="date" class="form-control" name="dateday" placeholder="Date" >
	                                            </div>
	                                        </div>
										</div>
									</div>

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Add Appointment</button>
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
		var p_id; //to make it accessible
		a(document).ready(function(){
			a(".chooseList p").click(function(){
				var text = a(this).text();
				p_id = a(this).attr('id');
				a(".toggle").html(text); //display teh text of the id in the textbox i.e the nam eof teh client
				a( ".toggleDrop" ).hide(); //removes drop down on click	
			});
		});


		a('#appt').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			
			a.ajax({
				type: "POST",
				data: a('#appt').serialize() + '&p_id=' + p_id + '&ins=newAppointment',
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

