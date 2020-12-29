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
	$pharm = $_GET['p'];
	$diagnosis = Database::getInstance()->get_name_from_id('diagnosis','patient_appointment','id', $value);
?>


<!----Quantity dispense Calculation>  ---->
			<script>
function myFunction() {
 	
  var y = parseInt(document.getElementById("tabs").value);
  var z = parseInt(document.getElementById("frequency").value);
  var w = parseInt(document.getElementById("duration").value);
 var x= (y*z)*w;
 



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

										$notarray2 = Database::getInstance()->select_from_where2('prescription','prescription_id', $pharm);	
										foreach ($notarray2 as $row2) {
											$stock = $row2['pharm_stock_id'];
											$tabs = $row2['tabs'];
											if ($row2['dosage'] == 0) {
												$dosage = "Select Frequency";
												$dos = 0;												
											}elseif ($row2['dosage'] == 1) {
												$dosage = "Q.D.S";
												$dos = 1;												
											}elseif ($row2['dosage'] == 2) {
												$dosage = "B.D";
												$dos = 2;												
											}elseif ($row2['dosage'] == 3) {
												$dosage = "D.L.Y";
												$dos = 3;												
											}elseif ($row2['dosage'] == 4) {
												$dosage = "T.D.S";
												$dos = 4;												
											}
											$duration = $row2['duration'];
											$quantity = $row2['quantity_dispense'];
											$stabs = $row2['stabs'];
											if ($row2['sdosage'] == 0) {
												$sdosage = "Select Frequency";
												$sdos = 0;												
											}elseif ($row2['sdosage'] == 1) {
												$sdosage = "Q.D.S";
												$sdos = 1;												
											}elseif ($row2['sdosage'] == 2) {
												$sdosage = "B.D";
												$sdos = 2;												
											}elseif ($row2['sdosage'] == 3) {
												$sdosage = "D.L.Y";
												$sdos = 3;												
											}elseif ($row2['sdosage'] == 4) {
												$sdosage = "T.D.S";
												$sdos = 4;												
											}
											$sduration = $row2['sduration'];
											$squantity = $row2['squantity_dispense'];
											$instr = $row2['instruction'];

										}
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
												<?php
															$db = mysqli_connect("localhost","root","","noahhms");
																$userDeails2 = mysqli_query($db, "SELECT id,name FROM pharm_stock WHERE id = ".$stock."");
																$userDeails1 = mysqli_fetch_assoc($userDeails2);
																	$d_id1 = $userDeails1['id'];
																	$name1 = $userDeails1['name'];	
																?>
													<p class="toggle"><?php echo $name1;?></p>
						

													<div class="toggleDrop">
														<input id="myInput" onkeyup="filterFunction()" placeholder ="Filter Your Client"/>
													
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
										<h4 class="text-center" style="color: #000;">Drugs Only</h4>
										<div class="col-md-3">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Tabs</label>
	                                                <input type="text" class="form-control" name="tabs" id="tabs" onkeyup="myFunction()" placeholder="Enter tabs" value="<?php echo $tabs; ?>" />
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									
									
									<div class="col-md-3">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>frequency</label>
													 <select name="frequency" id="frequency" class="form-control" onchange="myFunction()">
													 	<option selected value="<?php echo $dos; ?>"><?php echo $dosage; ?></option>
													 	<option value="0">Select Frequency</option>
													 	<option value="4">Q.D.S</option>
													 	<option value="2">B.D</option>
													 	<option value="1">DLY</option>
													 	<option value="3">T.D.S</option>
													 </select>
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									
								
									<div class="col-md-3">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Duration (days)</label>
	                                                <input type="text" name="duration" class="form-control" id="duration" placeholder="Times Per Day" onkeyup="myFunction()" value="<?php echo $duration; ?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									
									
									
									<div class="col-md-3">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Quantity to Despense</label>
	                                                <input type="text" class="form-control" id="quantity" name="quantity" value="<?php echo $quantity; ?>"/>
	                                            </div>
	                                        </div>
										</div>
									</div>
										<h4 class="text-center" style="color: #000;">SYRUP / INJECTIONS Only</h4>
										<div class="col-md-3">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Tabs</label>
	                                                <input type="text" class="form-control" name="stabs" id="stabs" placeholder="Enter tabs" value="<?php echo $stabs; ?>"/>
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									
									
									<div class="col-md-3">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>frequency</label>
													 <select name="sfrequency" id="sfrequency" class="form-control">
													 	<option value="<?php echo $sdos; ?>"><?php echo $sdosage; ?></option>
													 	<option value="0">Select Frequency</option>
													 	<option value="4">Q.D.S</option>
													 	<option value="2">B.D</option>
													 	<option value="1">DLY</option>
													 	<option value="3">T.D.S</option>
													 </select>
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									
								
									<div class="col-md-3">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Duration (days)</label>
	                                                <input type="text" name="sduration" class="form-control" id="sduration" placeholder="Times Per Day" value="<?php echo $sduration; ?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									
									
									
									<div class="col-md-3">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Quantity to Despense</label>
	                                                <input type="text" class="form-control" id="squantity" name="squantity" value="<?php echo $squantity; ?>"/>
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Instruction</label>
	                                                <textarea class="form-control" name="instruction" placeholder="Instruction"><?php echo $instr; ?></textarea> 
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
			var val = "<?php echo $_GET['p']; ?>";
			a.ajax({
				type: "POST",
				data: a('#case').serialize() + '&pharm=' + d_id + '&id=' + value + '&p=' + val + '&ins=edit_Presc',
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