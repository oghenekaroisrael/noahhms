<?php 
	ob_start();
	session_start();
	$pageTitle = "Staff";
	// Include database class
	include_once '../inc/db.php';
	
	if(!isset($_SESSION['userSession'])){
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
                                <h4 class="title">New Staff Details</h4>
                            </div>
                            <div class="content">
                                <form id="staff" action="" method="POST"  enctype="multipart/form-data">
                                      
									
									
								<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group text-center">
                                                <input type="file" name="file" class="form-control">
											</div>
                                        </div>
								</div>

								<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Surname</label>
                                                <input type="text" class="form-control" name="last_name">
											</div>
                                        </div>
								</div>

                                <div class="row">
                                    <div class="col-md-12">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" name="first_name">
                                            </div>
                                    </div>
								</div>

								<div class="row">
                                    <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Other Names</label>
                                                <input type="text" class="form-control" name="other_names">
                                            </div>
                                    </div>
								</div>
								
								<div class="row">
                                    <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Contact Address (Land Mark)</label>
                                                <textarea class="textarea form-control" name="address"></textarea>
                                            </div>
                                    </div>
								</div>

								<div class="row">
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone Number(s)</label>
                                                <input class="form-control" type="text" name="phone">
                                            </div>
                                    </div>

                                    <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="example-date-input">Date Of Birth</label>
                                                <input type="date" class="form-control" name="dob" placeholder="Manufacturing Date">
                                            </div>
                                        </div>

                                    <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Sex</label>
                                                <select class="form-control" name="sex">
                                                	<option value="Male">Male</option>
                                                	<option value="Female">Female</option>
                                                </select>
                                            </div>
                                    </div>
								</div>
								
								<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Place Of Birth</label>
                                                <input type="text" class="form-control" name="pob" placeholder="Place Of Birth">
											</div>
                                        </div>
									</div>

								<div class="row">
                                       <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Marital Status</label>
                                                <input type="text" class="form-control" name="mstatus" placeholder="Marital Status">
											</div>
                                        </div>

                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Religion</label>
                                                <input type="text" class="form-control" name="religion" placeholder="Religion">
											</div>
                                        </div>
									</div>

								<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Next Of Kin</label>
                                                <input type="text" class="form-control" name="nok" placeholder="Next Of Kin">
											</div>
                                       </div>
								</div>

								<div class="row">
                                       <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Phone Number Of Kin</label>
                                                <input type="text" class="form-control" name="pnok" placeholder="Next Of Kin">
											</div>
                                       </div>

                                       <div class="col-md-4">
                                            <div class="form-group">
                                                <label>State Of Origin</label>
                                                <input type="text" class="form-control" name="state" placeholder="Status Of Origin">
											</div>
                                       </div>

                                       <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Local Government Of Origin</label>
                                                <input type="text" class="form-control" name="lga" placeholder="lga">
											</div>
                                       </div>
								</div>

								<div class="row">
									<div class="col-md-4">
                                            <div class="form-group">
                                                <label for="example-date-input">Date Of Employment</label>
                                                <input type="date" class="form-control" name="doe" placeholder="Date Of Employment">
                                            </div>
                                    </div>

                                    <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Starting Salary</label>
                                                <input type="text" class="form-control" name="salary" placeholder="Starting Salary">
											</div>
                                    </div>

                                    <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Designation</label>
                                                <input type="text" class="form-control" name="position" placeholder="Position">
											</div>
                                    </div>
								</div>
								<div class="row">
									<div class="col-md-6">
                                            <div class="form-group">
                                                <label>Weight</label>
                                                <input type="text" class="form-control" name="weight" placeholder="Weight">
											</div>
                                    </div>

                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label>No Of Children</label>
                                                <input type="number" class="form-control" name="noc" placeholder="Number Of Children">
											</div>
                                    </div>
								</div>

								<div class="row">
									<div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name Of Child (1)</label>
                                                <input type="text" class="form-control" name="child1" placeholder="Name Of Child (1)">
											</div>
                                    </div>

                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name Of Child (2)</label>
                                                <input type="text" class="form-control" name="child2" placeholder="Name Of Child (2)">
											</div>
                                    </div>
								</div>

								<div class="row">
									<div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name Of Child (3)</label>
                                                <input type="text" class="form-control" name="child3" placeholder="Name Of Child (3)">
											</div>
                                    </div>

                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name Of Child (4)</label>
                                                <input type="text" class="form-control" name="child4" placeholder="Name Of Child (4)">
											</div>
                                    </div>
								</div>
									
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Select A Role</label>
                                                <select class="form-control" id="role" name="role">
													<?php
														$userDetails = Database::getInstance()->select('user_roles');
														foreach($userDetails as $row):
															$id = $row['id'];
															$name = $row['name'];	
													?>
													<option value="<?php echo $id;?>"><?php echo $name;?></option>
													<?php endforeach; ?>
												</select>
                                            </div>
                                        </div>
									</div> 



									<div class="row"  style="display: none;" id="ward">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Select A Ward</label>
                                                <select class="form-control"  name="ward"> 
														<option value="">Choose Ward</option>
														<option value="1">General Male Ward</option>				
														<option value="2">General Female Ward</option> 
														<option value="3">VIP Ward</option>									
														<option value="4">Maternity Ward</option>
												</select>
                                            </div>
                                        </div>
									</div>
									
									<div class="header">
										<h4 class="title">Access Control</h4>
									</div>
									
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control" name="username">
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control" name="password" placeholder="Password" >
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="password" class="form-control" name="cpass" placeholder="Confirm Password" >
                                            </div>
                                        </div>
									</div>

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Add Staff</button>
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
		a('#staff').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			var formData = new FormData(a(this)[0]);
			var ins = "newUser";
		 formData.append('ins',ins);
			a.ajax({
				type: 'post',
				data: formData,   
				cache: false,
				contentType: false,
				processData: false,
				url: '../func/verify.php',
				success: function(res) {
					document.getElementById("load").style.display = "none";
					a("#get_result").html(res).fadeIn("slow");
					console.log(res);
				}
			});
        });

        a('#role'). on('change', function(e) {
        	var role = parseInt(document.getElementById("role").value);
        	if (role == 7) {
				document.getElementById('ward').style.display = "block";
        	}else{        		
				document.getElementById('ward').style.display = "none";
        	}
       

        });
    });
</script>

