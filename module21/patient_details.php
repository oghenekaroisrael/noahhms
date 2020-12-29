<?php 
	ob_start();
	session_start();
	$pageTitle = "Case Note";
	// Include database class
	include_once '../inc/db.php';
		if (!isset($_SESSION['presc'])) {
    	$sales_id = date('Ymdhis');
    	$_SESSION['presc'] = $sales_id;
	} else {
		$_SESSION['presc'] = $_SESSION['presc'];
	}
	if(!isset($_SESSION['userSession'])){
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
function myFunction(tabs,freq,dur,val) {
 	
  var y = parseFloat(document.getElementById(tabs).value);
  if(document.getElementById(freq).value == "5" || document.getElementById(freq).value == "6"){
  	var z = 1;
  }else{
	  var z = parseFloat(document.getElementById(freq).value);
  }
  var w = parseFloat(document.getElementById(dur).value);
  var x= (y*z)*w;
	
 document.getElementById(val).value = x;
}

function check_value(tabs,freq,dur,val){
 	
  var y = parseFloat(document.getElementById(tabs).value);
  var z = parseFloat(document.getElementById(freq).value);
  var w = parseFloat(document.getElementById(dur).value);
  if (z == "6" || z == "5"){
  	document.getElementById(dur).value = "1";
  }
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
														<p><strong>Diagnosis: </strong><?php echo $diagnosis?>
														</p>
													
		                                            </div>
		                                        </div>
											</div>
										</div>
										

                            <div class="content">									
									<form id="drug_list">
										<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                       	<div class="form-group">
	                                                
													<label>Drug</label>
												
													<p class="toggle">Drug</p>
						
														
													<div class="toggleDrop">
														<input id="myInput" onkeyup="filterFunction()" placeholder ="Filter Your Client"  name="select_drug" />
													
														<div id="myDropdown" class="chooseList">
															<?php
																$userDeails = Database::getInstance()->select("pharm_stock");
																foreach($userDeails as $uow):
																	$d_id = $uow['id'];
																	$name = $uow['name'];	
																
															?>
															<p href="#" id="<?php echo $d_id;?>"><?php echo $name;?></p>
															<?php endforeach; ?>
															<input class="input2" type="hidden" name="select_drug"/>
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
	                                                
													<label>Drug Type</label>
													<select class="form-control" name="select_type">
														<option value="Tablet/Capsule">Tablet/Capsule</option>
														<option value="Injections/Syrup/IV Fluid">Injections/Syrup/IV Fluid</option>
														<option value="Cream">Cream</option>
														<option value="Custom">Custom Priced</option>
													</select>
	                                            </div>
	                                        </div>
										</div>
									</div>
									<button type="submit" class="btn btn-info pull-right">Add Drug</button>
									</form>

									<form id="case">
									<div class="content table-responsive table-full-width">
										<table class="table table-hover table-striped">
											<thead>
												<tr>
													<th>Drug</th>
													<th>Type</th>
													<th>Tabs/Mls</th>
													<th>Frequency</th>
													<th>Duration</th>
													<th>Quantity To Dispense</th>
													<th>Custom Price / Unit</th>
													<th>Instruction</th>
													<th>Delete</th>
												</tr>
											</thead>
											<tbody>
												<?php 
			                                    	$coun =0;
			                                    		$tmp_presc = database::getInstance()->select_from_where2_DESC('temp_presc','pid',$_SESSION['presc']);
			                                    		foreach ($tmp_presc as $vue) {
			                                    			$type = $vue['type'];
			                                    			$drug = $vue['drug'];
			                                    			$id = $vue['id'];
			                                    			$dname = database::getInstance()->get_name_from_id('name','pharm_stock','id',$drug);
			                                    			
			                                    			if ($type == "Tablet" || $type == "Tablet/Capsule") {
			                                    				?>
			                                    				<tr>
													<td>
														<?php echo $dname; ?>
														<input type="hidden" name="drugs[]" value="<?php echo $drug; ?>">
													</td>
													<td><?php echo $type ?></td>
													<td>
														<div class="row">
						                                    <div class="col-md-12">
						                                        <div class="form-group">
						                                            <input type="text" class="form-control" name="tabz[]" id="tabs<?php echo $coun; ?>" placeholder="Enter tabs"/>
						                                        </div>
						                                    </div>
														</div>
													</td>
													<td>
															<div class="row">
						                                       <div class="col-md-12">
						                                            <div class="form-group">
																		 <select name="frequency[]" onchange="check_value('tabs<?php echo $coun; ?>','frequency<?php echo $coun; ?>','duration<?php echo $coun; ?>','quantity<?php echo $coun; ?>');" id="frequency<?php echo $coun; ?>" class="form-control">
																		 	<option disabled="disabled">Select Frequency</option>
																		 	<option value="4">Q.D.S</option>
																		 	<option value="2">B.D</option>
																		 	<option value="1">DLY</option>
																		 	<option value="3">T.D.S</option>
																		 	<option value="5">STAT</option>
																		 	<option value="6">NOCT</option>
																		 </select>
						                                            </div>
						                                        </div>
															</div>
													</td>
													<td>
															<div class="row">
						                                       <div class="col-md-12">
						                                            <div class="form-group">
						                                                <input type="text" name="duration[]" class="form-control" id="duration<?php echo $coun; ?>" placeholder="Times Per Day">
						                                            </div>
						                                        </div>
															</div>
													</td>
													<td>
															<div class="row">
						                                       <div class="col-md-12">
						                                            <div class="form-group">
						                                                <input type="text" class="form-control" id="quantity<?php echo $coun; ?>" name="quantity[]"  onkeyup="myFunction('tabs<?php echo $coun; ?>','frequency<?php echo $coun; ?>','duration<?php echo $coun; ?>','quantity<?php echo $coun; ?>');"/>
						                                            </div>
						                                        </div>
															</div>
													</td>
													<td>
															<div class="row">
						                                       <div class="col-md-12">
						                                            <div class="form-group">
						                                                <input type="number" class="form-control" id="price1" name="price[]"  />
						                                            </div>
						                                        </div>
															</div>
													</td>
													<td>
														<div class="row">
						                                       <div class="col-md-12">
						                                            <div class="form-group">
						                                                <textarea class="form-control" name="instruction[]"></textarea>
						                                            </div>
						                                        </div>
															</div>
													</td>

													<td>
														<a id="sale_delete" class="btn btn-danger btblack" onclick="sure(<?php echo $id; ?>,'<?php echo $dname; ?>')"><i class="fas fa-trash"></i></a>
														<input type="hidden" name="stabs[]">
														<input type="hidden" name="sfrequency[]">
														<input type="hidden" name="sduration[]">
														<input type="hidden" name="squantity[]">
														</td>
												</tr>
			                                    				<?php
			                                    			}else if($type == "Injections/Syrup/IV Fluid" OR $type == "Cream"){
			                                    				?>
			                                    				<tr>
													<td>
														<?php echo $dname; ?>
														<input type="hidden" name="drugs[]" value="<?php echo $drug; ?>">
													</td>
													<td><?php echo $type ?></td>
													<td>
														<div class="row">
						                                    <div class="col-md-12">
						                                        <div class="form-group">
						                                            <input type="text" class="form-control" name="stabs[]" id="tabs1" placeholder="Enter tabs"/>
						                                        </div>
						                                    </div>
														</div>
													</td>
													<td>
															<div class="row">
						                                       <div class="col-md-12">
						                                            <div class="form-group">
																		 <select name="sfrequency[]" id="frequency1" class="form-control">
																		 	<option disabled="disabled">Select Frequency</option>
																		 	<option value="4">Q.D.S</option>
																		 	<option value="2">B.D</option>
																		 	<option value="1">DLY</option>
																		 	<option value="3">T.D.S</option>
																		 	<option value="5">STAT</option>
																		 	<option value="6">NOCT</option>
																		 </select>
						                                            </div>
						                                        </div>
															</div>
													</td>
													<td>
															<div class="row">
						                                       <div class="col-md-12">
						                                            <div class="form-group">
						                                                <input type="text" name="sduration[]" class="form-control" id="duration1" placeholder="Times Per Day">
						                                            </div>
						                                        </div>
															</div>
													</td>
													<td>
															<div class="row">
						                                       <div class="col-md-12">
						                                            <div class="form-group">
						                                                <input type="text" class="form-control" id="quantity1" name="squantity[]" />
						                                            </div>
						                                        </div>
															</div>
													</td>
													<td>
															<div class="row">
						                                       <div class="col-md-12">
						                                            <div class="form-group">
						                                                <input disabled="disabled" type="number" class="form-control" id="price1" name="price[]" />
						                                            </div>
						                                        </div>
															</div>
													</td>
													<td>
														<div class="row">
						                                       <div class="col-md-12">
						                                            <div class="form-group">
						                                                <textarea class="form-control" name="instruction[]"></textarea>
						                                            </div>
						                                        </div>
															</div>
													</td>

													<td>
														<a id="sale_delete" class="btn btn-danger btblack" onclick="sure(<?php echo $id; ?>,'<?php echo $dname; ?>')"><i class="fas fa-trash"></i></a>
														<input type="hidden" name="tabz[]">
														<input type="hidden" name="frequency[]">
														<input type="hidden" name="duration[]">
														<input type="hidden" name="quantity[]">
														</td>
												</tr>
			                                    				<?php
			                                    			}else if($type == "Custom"){
			                                    				?>
			                                    				<tr>
													<td>
														<?php echo $dname; ?>
														<input type="hidden" name="drugs[]" value="<?php echo $drug; ?>">
													</td>
													<td><?php echo $type ?></td>
													<td>
														<div class="row">
						                                    <div class="col-md-12">
						                                        <div class="form-group">
						                                            <input type="text" class="form-control" name="stabs[]" id="tabs1" placeholder="Enter tabs"/>
						                                        </div>
						                                    </div>
														</div>
													</td>
													<td>
															<div class="row">
						                                       <div class="col-md-12">
						                                            <div class="form-group">
																		 <select name="sfrequency[]" id="frequency1" class="form-control">
																		 	<option disabled="disabled">Select Frequency</option>
																		 	<option value="4">Q.D.S</option>
																		 	<option value="2">B.D</option>
																		 	<option value="1">DLY</option>
																		 	<option value="3">T.D.S</option>
																		 	<option value="5">STAT</option>
																		 	<option value="6">NOCT</option>
																		 </select>
						                                            </div>
						                                        </div>
															</div>
													</td>
													<td>
															<div class="row">
						                                       <div class="col-md-12">
						                                            <div class="form-group">
						                                                <input type="text" name="sduration[]" class="form-control" id="duration1" placeholder="Times Per Day">
						                                            </div>
						                                        </div>
															</div>
													</td>
													<td>
															<div class="row">
						                                       <div class="col-md-12">
						                                            <div class="form-group">
						                                                <input type="text" class="form-control" id="quantity1" name="squantity[]" />
						                                            </div>
						                                        </div>
															</div>
													</td>
													<td>
															<div class="row">
						                                       <div class="col-md-12">
						                                            <div class="form-group">
						                                                <input type="number" class="form-control" id="price1" name="price[]" />
						                                            </div>
						                                        </div>
															</div>
													</td>
													<td>
														<div class="row">
						                                       <div class="col-md-12">
						                                            <div class="form-group">
						                                                <textarea class="form-control" name="instruction[]"></textarea>
						                                            </div>
						                                        </div>
															</div>
													</td>

													<td>
														<a id="sale_delete" class="btn btn-danger btblack" onclick="sure(<?php echo $id; ?>,'<?php echo $dname; ?>')"><i class="fas fa-trash"></i></a>
														<input type="hidden" name="tabz[]">
														<input type="hidden" name="frequency[]">
														<input type="hidden" name="duration[]">
														<input type="hidden" name="quantity[]">
														</td>
												</tr>
			                                    				<?php
			                                    			}
			                                    			$coun++;
			                                    			?>
			                                    			<?php
			                                    		}
			                                    			?>
			                                    			<input type="hidden" name="diagnosis" value="<?php echo $diagnosis;?>">
			                                    			<input type="hidden" name="count" value="<?php echo $coun;?>">
											</tbody>
											<thead>
												<tr>
													<th>Drug</th>
													<th>Type</th>
													<th>Tabs/Mls</th>
													<th>Frequency</th>
													<th>Duration</th>
													<th>Quantity To Dispense</th>
													<th>Custom Price / Unit</th>
													<th>Instruction</th>
													<th>Delete</th>
												</tr>
											</thead>
										</table>
									</div>
									<button type="submit" class="btn btn-info btn-fill pull-right"  name="submit" >Send to Pharmacy</button>
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

 <div class="loader" id="load" style="display:none;">
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
				a(".input2").val(d_id);
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
				data: a('#case').serialize()+ '&p_id=' + p_id + '&doc_id=' +doc_id + '&id=' + value + '&ins=newCaseD',
				url: "../func/verify.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					a("#get_result").html(res).fadeIn("slow");
					console.log(res);
				}
			});
        });

        a('#drug_list').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			var value = "<?php echo $value; ?>";//appointment id
			var doc_id = "<?php echo $user_id; ?>";
			var p_id = "<?php echo $p_id; ?>";
			var did = "<?php echo $_SESSION['presc']; ?>"
			a.ajax({
				type: "POST",
				data: a('#drug_list').serialize()+ '&p_id=' + p_id +'&pre='+ did + '&doc_id=' +doc_id + '&id=' + value + '&ins=newCaseDrug',
				url: "../func/verify.php",
				success: function(res) {
					a("#get_result").html(res).fadeIn("slow");
					console.log(res);
					window.location = "patient_details.php?id=<?php echo $_GET['id'] ?>";
				}
			});
        });

        function sure(ID,name){ 

        	a.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to delete <b>"+name+"</b> from This List ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

            },{
                type: 'danger',
                timer: 100000
            });

    	}
		function delet(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          a.ajax({
            type: 'post',
            url: '../func/del.php',
            data: "val=" + val +  '&ins=delCaseDrug',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data == 'Done') {
					console.log(data);
						window.location = 'patient_details.php?id=<?php echo $_GET['id'];?>';
				  }
				  else {
					   
						jQuery('#get_result'+ID).html(data).show();
				  }
            }
          });
		}
 
</script>
<script>
function goBack() {
  window.history.back();
}
</script>