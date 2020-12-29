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
	$db = mysqli_connect("localhost","root","","noahhms");
	$last  = mysqli_query($db,"SELECT id FROM patient_appointment ORDER BY id DESC LIMIT 1 ");
	$get_last = mysqli_fetch_assoc($last);
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
													<option value="no">No doctor</option>
													<?php
														$userDetails = Database::getInstance()->select_from_where2or('staff', 'role_id',5,14);
														foreach($userDetails as $ow):
															$id = $ow['user_id'];
															$name = $ow['first_name']." ".$ow['last_name'];	
														
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
																	$surname = $row['surname'];	
																	$middle = $row['middle_name'];
																	$first = $row['first_name'];
																		
																	
																	$name = $title." ".$surname." ".$middle." ".$first;
																
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
													<input type="text" name="consult" class="form-control" placeholder="Consultation Fee ...">
												</div>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
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
		var app;
		a(document).ready(function(){
			a(".chooseList p").click(function(){
				var text = a(this).text();
				p_id = a(this).attr('id');
				app = '<?php echo $get_last['id']+1; ?>';
				a(".toggle").html(text); //display teh text of the id in the textbox i.e the nam eof teh client
				a( ".toggleDrop" ).hide(); //removes drop down on click	
			});
		});


		a('#appt').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			
			a.ajax({
				type: "POST",
				data: a('#appt').serialize() + '&p_id=' + p_id + '&app=' + app +'&ins=newAppointment',
				url: "../func/verify.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					if (res == "Done") {
						 console.log(res);
							window.location = "print1.php?id="+p_id+"&app="+app;
					
					}else{
						a("#get_result").html(res).fadeIn("slow");
					}
				}
			});
        });
    });
</script>

