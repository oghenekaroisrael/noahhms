<?php 
	ob_start();
	session_start();
	$pageTitle = "Antenatal Case Note";
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
	$id = $_GET['id'];
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
                                <h4 class="title">Antenatal</h4>
                            </div>

                            <div class="content">
									<?php
										$noarray = database::getInstance()->select_from_where('antenatal1','id',$id);
										while ($row = $noarray->fetch(PDO::FETCH_ASSOC)) {
										
									?>

									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-3">
			                                        <label>Surname:</label>
			                                        <p><?php echo $row['surname']; ?></p>
			                                </div>

			                                <div class="col-md-3">
			                                        <label>First Name:</label>
			                                        <p><?php echo $row['first_name']; ?></p>
			                                </div>

			                                <div class="col-md-1">
			                                        <label>Age:</label>
			                                        <p><?php echo $row['age']; ?></p>
			                                </div>

			                                <div class="col-md-2">
			                                        <label>Age Of Marriage:</label>
			                                        <p><?php echo $row['marriage_age']; ?></p>
			                                </div>

			                                <div class="col-md-3">
			                                        <label>Hospital Number:</label>
			                                        <p><?php echo $row['hospital_number']; ?></p>
			                                </div> 
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
			                                        <label>Special Points / Instructions:</label>
			                                        <p><?php echo $row['instructions']; ?></p>
			                                </div>
									</div>	

									<div class="row">
										<div class="col-lg-6">
											<label>Address</label>
	                                        <p><?php echo $row['address']; ?></p>
										</div>

										<div class="col-lg-3">
											<label>Duration of Pregnancy At Booking</label>
	                                                <p><?php echo $row['preg_duration']; ?></p>
										</div>
										<div class="col-lg-3">
											<label>Tribe</label>
	                                        <p><?php echo $row['tribe']; ?></p>
										</div>
									</div>

									<div class="row">
										
										<div class="col-lg-4">
											<label>Occupation</label>
	                                        <p><?php echo $row['occupation']; ?></p>
										</div>

										<div class="col-lg-4">
											<label>L.M.P</label>
	                                        <p><?php echo $row['lmp']; ?></p>
										</div>
										<div class="col-lg-4">
											<label>E.D.D</label>
	                                        <p><?php echo $row['edd']; ?></p>
										</div>
									</div>
										</div>
									</div>

									<div class="card">
										<div class="header">
		                                <h4 class="title">Previous Medical History</h4>
		                            </div>
                            		<div class="content">
										<form id="change_ante">
											<div class="row">
												<div class="col-lg-3">
													<div class="form-group">
		                                                <label>Hypertension</label>
		                                                <input type="text" class="form-control" name="hypertension" placeholder="Hypertension" value="<?php echo $row['hypertension']; ?>">
													</div>
												</div>

												<div class="col-lg-3">
													<div class="form-group">
		                                                <label>Chest Diseases</label>
		                                                <input type="text" class="form-control" name="chest_disease" placeholder="Chest Diseases" value="<?php echo $row['chest']; ?>">
													</div>
												</div>

												<div class="col-lg-3">
													<div class="form-group">
		                                                <label>Anaemia</label>
		                                                <input type="text" class="form-control" name="anaemia" placeholder="Anaemia" value="<?php echo $row['anaemia']; ?>">
													</div>
												</div>

												<div class="col-lg-3">
													<div class="form-group">
		                                                <label>Heart Diseases</label>
		                                                <input type="text" class="form-control" name="heart_disease" placeholder="Heart Diseases" value="<?php echo $row['heart']; ?>">
													</div>
												</div>

												<div class="col-lg-3">
													<div class="form-group">
		                                                <label>Kidney Disease</label>
		                                                <input type="text" class="form-control" name="kidney_disease" placeholder="Kidney Disease" value="<?php echo $row['kidney']; ?>">
													</div>
												</div>

												<div class="col-lg-3">
													<div class="form-group">
		                                                <label>Blood Transfusion</label>
		                                                <input type="text" class="form-control" name="blood_transfusion" placeholder="Blood Transfusion" value="<?php echo $row['blood']; ?>">
													</div>
												</div>

												<div class="col-lg-3">
													<div class="form-group">
		                                                <label>GIT Disease</label>
		                                                <input type="text" class="form-control" name="git_disease" placeholder="GIT Disease"  value="<?php echo $row['git']; ?>">
													</div>
												</div>

												<div class="col-lg-3">
													<div class="form-group">
		                                                <label>Diabetes</label>
		                                                <input type="text" class="form-control" name="diabetes" placeholder="Diabetes" value="<?php echo $row['diabetes']; ?>">
													</div>
												</div>

												<div class="col-lg-3">
													<div class="form-group">
		                                                <label>Operation</label>
		                                                <input type="text" class="form-control" name="operation" placeholder="Operation" value="<?php echo $row['operation']; ?>">
													</div>
												</div>

												<div class="col-lg-3">
													<div class="form-group">
		                                                <label>Admission In Last Pregnancy</label>
		                                                <input type="text" class="form-control" name="adm_lst_preg" placeholder="Admission In Last Pregnancy" value="<?php echo $row['admission']; ?>">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-2">
													<div class="form-group">
		                                                <label>G</label>
		                                                <input type="text" class="form-control" name="g" placeholder="G"  value="<?php echo $row['G']; ?>">
													</div>
												</div>

												<div class="col-lg-2">
													<div class="form-group">
		                                                <label>P</label>
		                                                <input type="text" class="form-control" name="p1" placeholder="P"  value="<?php echo $row['P1']; ?>">
													</div>
												</div>

												<div class="col-lg-2">
													<div class="form-group">
		                                                <label>F</label>
		                                                <input type="text" class="form-control" name="f" placeholder="F"  value="<?php echo $row['F']; ?>">
													</div>
												</div>

												<div class="col-lg-2">
													<div class="form-group">
		                                                <label>P</label>
		                                                <input type="text" class="form-control" name="p2" placeholder="P"  value="<?php echo $row['P2']; ?>">
													</div>
												</div>

												<div class="col-lg-2">
													<div class="form-group">
		                                                <label>A</label>
		                                                <input type="text" class="form-control" name="a" placeholder="A" value="<?php echo $row['A']; ?>">
													</div>
												</div>

												<div class="col-lg-2">
													<div class="form-group">
		                                                <label>L</label>
		                                                <input type="text" class="form-control" name="l" placeholder="L" value="<?php echo $row['L']; ?>">
													</div>
												</div>
											</div>
											<button type="submit" class="btn btn-info btn-fill pull-right">Upload</button>
									<button type="reset" class="btn btn-danger btn-fill pull-left">Clear</button>
                                    <div class="clearfix"></div>
										</form>
									</div>
									</div>

									<?php } ?>
									<div class="card">
										<a href="new_note?id=<?php echo $_GET['id']; ?>" style="margin:10px 10px;" class="btn btn-primary pull-right btn-flat btblack">
											<i class="entypo-plus-circled"></i> New Note
										</a>
										<div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Date Of Birth</th>
                                    	<th>Duration Of Pregnancy</th>
                                    	<th>Birth Weight</th>
                                    	<th>Complication In Pregnancy</th>
                                    	<th>Complication In Labour</th>
                                    	<th>Puerperium</th>
                                    	<th>Age At Death</th>
                                    	<th>Cause Of Death</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_where_ord("antenatal_note","antenatal_id",$_GET['id'],"id","DESC");
											foreach($notarray as $row):
											$date = date("jS M Y",strtotime($row['date_added']));
											$time = $row['preg_duration'];
											$id = $row['patient_obs_id'];
											$by1 = database::getInstance()->select_from_where("staff","user_id",$row['added_by']);
											foreach ($by1 as $y) {
												$by = $row['last_name']." ".$row['first_name'];
											}
						
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><?php echo $date;?></td>
                                        	<td><?php echo $time;?></td>
                                        	<td><?php echo $row['weight'];?></td>
                                        	<td><?php echo $row['complication_p'];?></td>
                                        	<td><?php echo $row['complication_l'];?></td>
                                        	<td><?php echo $row['puerperium'];?></td>
                                        	<td><?php echo $row['death_age'];?></td>
                                        	<td><?php echo $row['cause_of_death'];?></td>
                                        	<td><?php echo $by;?></td>
                                        	
                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">Action</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<li><a href="edit_obs?edit=<?php echo $id; ?>">Edit</a></li>
													<li class="divider"></li>
													<li><a onclick="sure(<?php echo $id; ?>,'<?php echo $patient; ?>')">Delete</a></li>
													</ul>
												</div>
											</td>
                                        </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
										<th>#</th>
                                        <th>Date Of Birth</th>
                                    	<th>Duration Of Pregnancy</th>
                                    	<th>Birth Weight</th>
                                    	<th>Complication In Pregnancy</th>
                                    	<th>Complication In Labour</th>
                                    	<th>Puerperium</th>
                                    	<th>Age At Death</th>
                                    	<th>Cause Of Death</th>
                                    	<th>Action</th>
                                    </thead>
								</table>

                            </div>
									</div>
									
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

		a('#change_ante').on('submit', function (e) {
			var ID = "<?php echo $_GET['id']; ?>";
			var staff = "<?php echo $user_id; ?>";
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			var id = "<?php echo $id; ?>";
			a.ajax({
				type: "POST",
				data: a('#change_ante').serialize()  + "&id=" + id + '&ins=editAntenatal_N&edit='+ ID + '&staff='+staff,
				url: "../func/edit.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					a("#get_result").html(res).fadeIn("slow");
					console.log(res);
				}
			});
        });
    });
</script>