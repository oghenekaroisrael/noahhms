<?php 
	ob_start();
	session_start();
	$pageTitle = "Add New Patient";
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
	$staffG = "";
	$regnum = "";
	$first = "";
	$surname = "";
	if(isset($_GET['g'])){
		$staffG = $_GET['g'];
		$stafDetails = Database::getInstance()->select_from_where('staff', 'user_id', $staffG);
		foreach($stafDetails as $st){
			$regnum = $st['reg_num'];
			$first = $st['first_name'];
			$surname = $st['last_name'];
		}
		
	}
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
                                <h4 class="title">New Patient Details</h4>
                            </div>

                           <div class="content">
                                <form id="patient">
                                	<div class="col-md-6">
										<div class="row">
										
											<div class="col-md-6">
	                                            
			                                        <div class="form-group">
			                                            <label>Registration Number</label>
			                                            <input type="text" class="form-control" name="reg_num" placeholder="Registration Number" value="<?php echo $regnum;?>">
			                                        </div>
			                                   
	                                        </div>  
											
	                                       <div class="col-md-2">
	                                           
			                                        <div class="form-group">
			                                            <label>Title</label>
			                                            <input type="text" class="form-control" name="title" placeholder="Title" >
			                                        </div>   
			                                    
			                                </div>

			                                <div class="col-md-4">
	                                            <div class="form-group">
	                                                <label>First Name</label>
	                                                <input type="text" class="form-control" name="first" placeholder="First Name" value="<?php echo $first;?>">
												</div>
	                                        </div> 
											
											
										</div>
									</div>
                                	
									<div class="col-md-6">
										<div class="row">
										 <div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>Middle Name</label>
	                                                <input type="text" class="form-control" name="m_name" placeholder="Middle Name">
												</div>
	                                        </div> 
											
										
										<div class="col-md-6">
	                                            <div class="form-group">
			                                        <label>Surname</label>
			                                        <input type="text" class="form-control" name="surname" placeholder="Surname" value="<?php echo $surname;?>">
			                                     </div>
	                                        </div> 
	                                      
										  
										</div>
									</div>

									<div class="clearfix"></div>
									<div class="col-md-3">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Card Type</label>
	                                                <select class="form-control" name="card_type" id="select_card">
													<option>Card Type</option>
													<?php
														$userDetails = Database::getInstance()->select('card_types');
														foreach($userDetails as $ow):
															$ictd = $ow['id'];
															$namee = $ow['name'];	
														
													?>
													<option value="<?php echo $ictd;?>"><?php echo $namee;?></option>
													<?php endforeach; ?>
												</select>
	                                            </div>
	                                        </div>
										</div>
									</div>
									<div class="col-md-3"  style="display: none;" id="company_card_cont">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
	                                                <label>Companies</label>
	                                                <select class="form-control" name="company"  id="company_card">
													<option>Select Company</option>
													<?php
														$userDetails = Database::getInstance()->select('companies');
														foreach($userDetails as $ow):
															$ictd2 = $ow['id'];
															$namee2 = $ow['company_name'];	
														
													?>
													<option value="<?php echo $ictd2;?>"><?php echo $namee2;?></option>
													<?php endforeach; ?>
												</select>
	                                            </div>
											</div>
										</div>
									</div>

									<div class="col-md-3"  style="display: none;" id="family_card_cont">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
	                                                
													<label>Families</label>
												
													<p class="toggle">Families</p>
						
														
													<div class="toggleDrop">
														<input id="myInput" onkeyup="filterFunction()" placeholder ="Filter Your Client" />
													
														<div id="myDropdown" class="chooseList">
															<?php
																$userDetails = Database::getInstance()->select("families");
																foreach($userDetails as $row):
																	$c_id = $row['id'];
																	$fname = $row['family_name'];
																
															?>
															<p href="#" id="<?php echo $c_id;?>"><?php echo $fname;?></p>
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
	                                                <label>Sex</label>
	                                                <select class="form-control" id="sex" name="sex">
														<option value="Female">Female</option>
														<option value="Male">Male</option>
														<option value="other">Other</option>
													</select>
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Blood Group</label>
	                                                <input type="text" class="form-control" name="blood" placeholder="Blood Group" >
	                                            </div>
	                                        </div>
										</div>
									</div>

	                                       <div class="col-md-3">
	                                           <div class="form-group">
	                                                <label>Insurance</label>
	                                                <select class="form-control" id="insurance" name="insurance">
														<option value="">Select Insurance</option>
														<?php 
														$notarray = database::getInstance()->select_from_ord1('insurance_type','insurance_type_id','DESC');
														foreach($notarray as $row):?>
                                            
														<option value="<?php echo $row['insurance_type_id'];?>"><?php echo $row['insurance_type'];?></option>
														<?php endforeach; ?>
													</select>
	                                            </div>
	                                        </div>
											
											<div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>NHIS Number</label>
	                                                <input type="text" class="form-control" name="nhis" placeholder="NHIS Number" >
	                                            </div>
	                                        </div>

									<div class="col-md-6">
										<div class="row">
											<div class="col-md-8">
	                                            <div class="form-group">
	                                                <label>Address</label>
	                                                <input type="text" class="form-control" name="address" placeholder="Address" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-4">
	                                            <div class="form-group">
	                                                 <label>City</label>
	                                                <input type="text" class="form-control" name="city" placeholder="City" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>State</label>
	                                                <input type="text" class="form-control" name="state" placeholder="State" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>Ethnic Group</label>
	                                                <input type="text" class="form-control" name="ethnic" placeholder="Ethnic Group" >
	                                            </div>
	                                        </div>
											
	                                    </div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>Religion</label>
	                                                <input type="text" class="form-control" name="religion" placeholder="Religion" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>Nationality</label>
	                                                <input type="text" class="form-control" name="nationality"  Value="Nigerian" >
	                                            </div>
	                                        </div>
											
	                                    </div>
									</div>
									
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-5">
	                                            <div class="form-group">
	                                                <label>National ID</label>
	                                                <input type="text" class="form-control" name="natid" placeholder="National ID" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-4">
	                                            <div class="form-group">
	                                                <label>HMO/Enrollee Number</label>
	                                                <input type="text" class="form-control" name="enr" placeholder="HMO/Enrollee Number" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Age Type</label>
	                                                <select class="form-control" id="ageType" name="ageType">
														<option value="Elder">Elder</option>
														<option value="Adult">Adult</option>
														<option value="Teenager">Teenager</option>
														<option value="Baby">Baby</option>
													</select>
	                                            </div>
	                                        </div>
											
											
	                                    </div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>Date of Birth</label>
	                                                <input type="date" class="form-control" name="dob" placeholder="Date of Birth" >
	                                            </div>
	                                        </div>
											
											
											<div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>Photo</label>
	                                                <input type="file" class="form-control" name="file" placeholder="Photo" >
	                                            </div>
	                                        </div>
											
	                                    </div>
									</div>
									
									
									<div class="clearfix"></div>

									<div class="header">
		                                <h4 class="title">Contact Details</h4>
		                            </div>

		                            <div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Telephone(1)</label>
	                                                <input type="tel" class="form-control" name="tel1" placeholder="Telephone(1)" >
	                                            </div>
	                                        </div>
										</div>
									</div>

									 <div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Telephone(2)</label>
	                                                <input type="tel" class="form-control" name="tel2" placeholder="Telephone(2)" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Mobile</label>
	                                                <input type="tel" class="form-control" name="mobile" placeholder="Mobile" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>Email</label>
	                                                <input type="text" class="form-control" name="email" placeholder="Email" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>Prefered Contact Method</label>
	                                                <select class="form-control" id="pre" name="pre">
														<option value="">Select Contact Method</option>
														<?php 
														$contt = Database::getInstance()->select_from_ord1('contact_method', 'contact_method_id','DESC');
														foreach($contt as $ow){
														?>
														<option value="<?php echo $ow['contact_method_id']?>"><?php echo $ow['contact_method']?></option>
														<?php } ?>
														
													</select>
	                                            </div>
	                                        </div>
											
	                                    </div>
									</div>
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Next Of kin Fullname</label>
	                                                <input type="text" class="form-control" name="nname" placeholder="Next Of kin Telephone" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Relationship With Patient</label>
	                                                <input type="text" class="form-control" name="relationship" placeholder="Next Of kin Address" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Next Of kin Telephone</label>
	                                                <input type="number" class="form-control" name="ntel" placeholder="Next Of kin Telephone" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Next Of kin Address</label>
	                                                <input type="text" class="form-control" name="nadd" placeholder="Next Of kin Address" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Add Patient</button>
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
	 a(document).ready(function(){
	 	a(".chooseList p").click(function(){
				var text = a(this).text();
				p_id = a(this).attr('id');
				app = '<?php echo $get_last['id']+1; ?>';
				a(".toggle").html(text); //display teh text of the id in the textbox i.e the nam eof teh client
				a( ".toggleDrop" ).hide(); //removes drop down on click	
			});

        a('#patient').on('submit', function (e) {

        e.preventDefault();
		document.getElementById("load").style.display = "block";
		var formData = new FormData(a(this)[0]);
		var ins = "newPatient";
		 formData.append('ins',ins);
          a.ajax({
            type: 'post',
			data: formData,  
			cache: false,
			contentType: false,
			processData: false,
            url: '../func/verify.php',						
            success: function(data)
            {
				document.getElementById("load").style.display = "none";
				a("#get_result").html(data).fadeIn("slow");
            }
          });

        });

        a('#select_card'). on('change', function(e) {
        	var card = parseInt(document.getElementById("select_card").value);
        	if (card == 11) {
				document.getElementById('company_card_cont').style.display = "block";				
        		document.getElementById('family_card_cont').style.display = 'none';
        	}else if(card == 20){
        		document.getElementById('family_card_cont').style.display = 'block';
        		document.getElementById('company_card_cont').style.display = 'none';	
        	}else{        		
				document.getElementById('company_card_cont').style.display = "none";
        		document.getElementById('family_card_cont').style.display = 'none';
        	}
       

        });
      });
	function display_company_card() {
	}
</script>

