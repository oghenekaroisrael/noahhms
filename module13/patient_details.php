<?php 
	ob_start();
	session_start();
	$pageTitle = "Case Note";
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
	$value = $_GET['id'];
	$diagnosis = Database::getInstance()->get_name_from_id('diagnosis','patient_appointment','id', $value);
?>


<!----Quantity dispense Calculation>  ---->
			<script>
function myFunction() {
 
  var y = parseInt(document.getElementById("tabs").value);
  var z = parseInt(document.getElementById("dosage").value);
 var x= y*z;
 



  document.getElementById("quantity").value = x;

}
</script>		

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
                           
                            <?php
                            		$lab = "";
                            		$comp = "";
                            		$pres = "";
                            		$bpst ="";
									$bpsi ="";
							        $notarray = Database::getInstance()->select_from_where2('patient_appointment','id', $value);
										foreach($notarray as $row):
										$p_id = $row['patient_id'];
										$temp = $row['temperature'];
										$weight = $row['weight'];
										if($row['blood_press_sit_s'] != ""){
											$bpst = '('.$row['blood_press_stand_s'].'/Sistolic) ('.$row['blood_press_stand_d'].'/Diastolic)';
											$bpsi = '('.$row['blood_press_sit_s'].'/Sistolic) ('.$row['blood_press_sit_d'].'/Diastolic)';											
											}
										$pres = $row['prescription'];
										$lab = $row['lab'];
										$comp = $row['complaint'];
										$userDetails = Database::getInstance()->select_from_where('patients', 'id', $p_id);
											foreach($userDetails as $qw):
												 $name = $qw['title']." ".$qw['surname']." ".$qw['middle_name'];
												 $sex = $qw['sex'];
												 $blood = $qw['blood_group'];
												 $age = $qw['age'];
												 $reg = $qw['reg_num'];
											endforeach; 
										endforeach; 	
										?>
										<div class="header">
			                               <h4 class="text-center"><strong>Prescription for <?php echo $name;?></strong></h4>
										<p class="text-center">Reg No. <?php echo $reg;?></p>
			                            </div>
										

										<div class="clearTwenty"></div>
											<div class="col-md-12">
											<div class="row">
		                                       <div class="col-md-12">
		                                            <div class="form-group">
		                                                <p><strong>Age:</strong> <?php echo $age;?></p>
														<p><strong>Sex:</strong> <?php echo $sex;?></p>
													
		                                            </div>
		                                        </div>
											</div>
										</div>
										

                            <div class="content">
                            	
                                <form id="case">
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Diagnosis</label>
	                                                <input class="form-control" name="diagnosis" placeholder="Enter Diagnosis" value="<?php echo $diagnosis?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                
													<label>Drug</label>
												
													<p class="toggle">Drug</p>
						
														
													<div class="toggleDrop">
														<input id="myInput" onkeyup="filterFunction()" placeholder ="Filter Your Client" />
													
														<div id="myDropdown" class="chooseList">
															<?php
																$userDeails = Database::getInstance()->select("pharm_stock");
																foreach($userDeails as $uow):
																	$d_id = $uow['id'];
																	$name = $uow['name'];	
																
															?>
															<p href="#" id="<?php echo $d_id;?>"><?php echo $name;?></p>
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




									
									<div class="col-md-3">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Tabs</label>
	                                                <input type="text" class="form-control" name="tabs" id="tabs" onkeyup="myFunction()" placeholder="Enter tabs"/>
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									
									
									<div class="col-md-3">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Dosage</label>
	                                                <input type="text" class="form-control" name="dosage" id="dosage" onkeyup="myFunction()"
													 placeholder="Enter dosage" />
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									
								
									<div class="col-md-3">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Duration</label>
	                                                <select class="form-control" id="duration" name="duration">
													  <option selected="selected" disabled>Choose Duration</option>
														<option value="dayly">Daily</option>
														<option value="weekly">Weekly</option>
														<option value="monthly">Monthly</option>
														<option value="bid">B.I.D</option>
														<option value="dqs">Q.D.S</option>
														<option value="bd">B.D</option>
														<option value="dly">DLY</option>
														<option value="tds">T.D.S</option>
													</select>
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									
									
									
									<div class="col-md-3">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Quantity to Despense</label>
	                                                <input type="text" class="form-control" id="quantity" name="quantity" />
	                                            </div>
	                                        </div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Instruction</label>
	                                                <textarea class="form-control" name="instruction" placeholder="Instruction"></textarea> 
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									

                                    <button type="submit" class="btn btn-info btn-fill pull-right"  name="submit" >Send</button>
									<button type="reset" class="btn btn-danger btn-fill pull-left">Clear</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        
						</div>
                    </div>
                 </div>

				<div id="get_result"></div>
				

            </div>
			 <button onclick="goBack()"  class="btn btn-info">Go Back</button>
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
	var d_id; //to make it accessible
	a(function () {
		
		a(document).ready(function(){
			a(".chooseList p").click(function(){
				var text = a(this).text();
				d_id = a(this).attr('id');
				a(".toggle").html(text); //display teh text of the id in the textbox i.e the nam eof teh client
				a( ".toggleDrop" ).hide(); //removes drop down on click	
			});
		});
    });	
		a('#case').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			var value = "<?php echo $value; ?>";
			var doc_id = "<?php echo $user_id; ?>";
			var p_id = "<?php echo $p_id; ?>";
			a.ajax({
				type: "POST",
				data: a('#case').serialize() + '&pharm=' + d_id + '&p_id=' + p_id + '&doc_id=' +doc_id + '&id=' + value + '&ins=newCase',
				url: "../func/verify.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					a("#get_result").html(res).fadeIn("slow");
					console.log(res);
				}
			});
        });
 
</script>
<script>
function goBack() {
  window.history.back();
}
</script>