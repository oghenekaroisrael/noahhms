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
			                                            <input type="text" class="form-control" name="reg_num" placeholder="Registration Number" >
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
	                                                <input type="text" class="form-control" name="first" placeholder="First Name">
												</div>
	                                        </div> 
											
											
										</div>
									</div>
                                	
									<div class="col-md-6">
										<div class="row">
										 <div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>Middle Name</label>
	                                                <input type="text" class="form-control" name="m_name" placeholder="First and Middle Name">
												</div>
	                                        </div> 
											
										
										<div class="col-md-6">
	                                            <div class="form-group">
			                                        <label>Surname</label>
			                                        <input type="text" class="form-control" name="surname" placeholder="Surname" >
			                                     </div>
	                                        </div> 
	                                      
										  
										</div>
									</div>

									<div class="clearfix"></div>

									<div class="col-md-6">
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

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Blood Group</label>
	                                                <input type="text" class="form-control" name="blood" placeholder="Blood Group" >
	                                            </div>
	                                        </div>
										</div>
									</div>


									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-6">
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
	                                                <input type="text" class="form-control" name="nationality" placeholder="Nationality" >
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
														<option value="Years">Years</option>
														<option value="Months">Months</option>
														<option value="Weeks">Weeks</option>
														<option value="Days">Days</option>
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
	                                                <input type="number" class="form-control" name="tel1" placeholder="Telephone(1)" >
	                                            </div>
	                                        </div>
										</div>
									</div>

									 <div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Telephone(2)</label>
	                                                <input type="number" class="form-control" name="tel2" placeholder="Telephone(2)" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Mobile</label>
	                                                <input type="number" class="form-control" name="mobile" placeholder="Mobile" >
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

      });
</script>

