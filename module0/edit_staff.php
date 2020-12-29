<?php 
	ob_start();
	session_start();
	$pageTitle = "Edit Staff Record";
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
                                <h4 class="title">Edit Staff</h4>
                            </div>
                            <div class="content">
                                <form>
								 <?php
                            $noarray = database::getInstance()->select_from_where('staff','user_id',$value);
                            while ($ow = $noarray->fetch(PDO::FETCH_ASSOC)) {
								$role_id = $ow['role_id'];
								$ward_id = $ow['ward_id'];
								?>

								<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group text-center">
                                                <img src="staff_img/<?php echo $ow['staff_img']; ?>" class="img img-circle" height="100" width="100">
                                                <input type="file" name="image">
											</div>
                                        </div>
								</div>

								<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Surname</label>
                                                <input type="text" class="form-control" name="last_name" value="<?php echo $ow['last_name'];?>">
											</div>
                                        </div>
								</div>

                                <div class="row">
                                    <div class="col-md-12">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" name="first_name" value="<?php echo $ow['first_name'];?>" >
                                            </div>
                                    </div>
								</div>

								<div class="row">
                                    <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Other Names</label>
                                                <input type="text" class="form-control" name="other_names" value="<?php echo $ow['other_names'];?>" >
                                            </div>
                                    </div>
								</div>
								
								<div class="row">
                                    <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Contact Address (Land Mark)</label>
                                                <textarea class="textarea form-control" name="address"><?php echo $ow['contact_address']; ?></textarea>
                                            </div>
                                    </div>
								</div>

								<div class="row">
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone Number(s)</label>
                                                <input class="form-control" type="text" name="phone" value="<?php echo $ow['phone_number']; ?>">
                                            </div>
                                    </div>

                                    <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="example-date-input">Date Of Birth</label>
                                                <input type="date" class="form-control" name="dob" placeholder="Manufacturing Date" value="<?php echo date('Y-m-d',strtotime($ow['dob']));?>">
                                            </div>
                                        </div>

                                    <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Sex</label>
                                                <select class="form-control" name="sex">
													<option value="<?php echo $ow['sex'];?>"><?php echo $ow['sex'];?></option>
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
                                                <input type="text" class="form-control" name="pob" placeholder="Place Of Birth" value="<?php echo $ow['pob'];?>">
											</div>
                                        </div>
									</div>

								<div class="row">
                                       <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Marital Status</label>
                                                <input type="text" class="form-control" name="mstatus" placeholder="Marital Status" value="<?php echo $ow['mstatus'];?>">
											</div>
                                        </div>

                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Religion</label>
                                                <input type="text" class="form-control" name="religion" placeholder="Religion" value="<?php echo $ow['religion'];?>">
											</div>
                                        </div>
									</div>

								<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Next Of Kin</label>
                                                <input type="text" class="form-control" name="nok" placeholder="Next Of Kin" value="<?php echo $ow['nok'];?>">
											</div>
                                       </div>
								</div>

								<div class="row">
                                       <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Phone Number Of Kin</label>
                                                <input type="text" class="form-control" name="pnok" placeholder="Next Of Kin" value="<?php echo $ow['phone_nok'];?>">
											</div>
                                       </div>

                                       <div class="col-md-4">
                                            <div class="form-group">
                                                <label>State Of Origin</label>
                                                <input type="text" class="form-control" name="state" placeholder="Status Of Origin" value="<?php echo $ow['state'];?>">
											</div>
                                       </div>

                                       <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Local Government Of Origin</label>
                                                <input type="text" class="form-control" name="lga" placeholder="lga" value="<?php echo $ow['lga'];?>">
											</div>
                                       </div>
								</div>

								<div class="row">
									<div class="col-md-4">
                                            <div class="form-group">
                                                <label for="example-date-input">Date Of Employment</label>
                                                <input type="date" class="form-control" name="doe" placeholder="Date Of Employment" value="<?php echo date('Y-m-d',strtotime($ow['date_of_emp']));?>">
                                            </div>
                                    </div>

                                    <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Starting Salary</label>
                                                <input type="text" class="form-control" name="salary" placeholder="Starting Salary" value="<?php echo $ow['starting_salary'];?>">
											</div>
                                    </div>

                                    <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Designation</label>
                                                <input type="text" class="form-control" name="position" placeholder="Position" value="<?php echo $ow['position'];?>">
											</div>
                                    </div>
								</div>
								<div class="row">
									<div class="col-md-6">
                                            <div class="form-group">
                                                <label>Weight</label>
                                                <input type="text" class="form-control" name="weight" placeholder="Weight" value="<?php echo $ow['weight'];?>">
											</div>
                                    </div>

                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label>No Of Children</label>
                                                <input type="number" class="form-control" name="noc" placeholder="Number Of Children" value="<?php echo $ow['no_of_children'];?>">
											</div>
                                    </div>
								</div>

								<div class="row">
									<div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name Of Child (1)</label>
                                                <input type="text" class="form-control" name="child1" placeholder="Name Of Child (1)" value="<?php echo $ow['child1'];?>">
											</div>
                                    </div>

                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name Of Child (2)</label>
                                                <input type="text" class="form-control" name="child2" placeholder="Name Of Child (2)" value="<?php echo $ow['child2'];?>">
											</div>
                                    </div>
								</div>

								<div class="row">
									<div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name Of Child (3)</label>
                                                <input type="text" class="form-control" name="child3" placeholder="Name Of Child (3)" value="<?php echo $ow['child3'];?>">
											</div>
                                    </div>

                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name Of Child (4)</label>
                                                <input type="text" class="form-control" name="child4" placeholder="Name Of Child (4)" value="<?php echo $ow['child4'];?>">
											</div>
                                    </div>
								</div>
									
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Select A Role</label>
                                                <select class="form-control" id="role" name="role">
													<?php
														$userDetails = Database::getInstance()->select_from_where('user_roles', 'id', $role_id); 
														foreach($userDetails as $w):
															$idd = $w['id'];
															$named = $w['name'];
														endforeach;															
													?>
													<option value="<?php echo $idd;?>"><?php echo $named;?></option>
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
                                                <input type="text" class="form-control" name="username" value="<?php echo $ow['username'];?>" >
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

							<?php } ?>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Update Staff Details</button>
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
	var roles = parseInt(document.getElementById("role").value);
	s(document).ready(function() {
		s('form').submit(function(e){
			var val = "<?php echo $value; ?>";
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			s.ajax({
				type: "POST",
				data: s('form').serialize() + "&val=" + val + "&ins=editStaff",
				url: "../func/edit.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					s("#get_result").html(res).fadeIn("slow");
				}
			});
		})

		a('#role'). on('change', function(e) {
        	var role = parseInt(document.getElementById("role").value);
        	if (role == 7) {
				document.getElementById('ward').style.display = "block";
        	}else{        		
				document.getElementById('ward').style.display = "none";
        	}
       

        });			
	})			
</script>

