<?php 
	ob_start();
	session_start();
	$pageTitle = "Update Labour";
	// Include database class
	include_once '../inc/db.php';
	
	If(!isset($_SESSION['userSession'])){
		header("Location: ../index");
		exit;
	}
	elseif (isset($_SESSION['userSession'])){
		$user_id = $_SESSION['userSession'];
	}
	$lid = $_GET['id'];
	
	include_once '../inc/header-index.php'; //for addding header
?>

<div class="wrapper" id="homesc">

<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>
	
	  <!--  MAIN -->
        <div class="content">
            <div class="container-fluid">
			<?php
				$notarray = database::getInstance()->select_from_where('labour','id',$lid);
					foreach($notarray as $row):
						$name = $row['surname']." ".$row['first_name'];
				?>
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                           <div class="header">
                                <h4 class="title">Labour For <?php echo $name; ?></h4>
                            </div>

                            <div class="content">
                                <form id="appt">
											

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Surname</label>
	                                                <input type="text" class="form-control" name="surname" placeholder="Surname" value="<?php echo $row['surname']; ?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>First Name</label>
	                                                <input type="text" class="form-control" name="fname" placeholder="First Name"  value="<?php echo $row['first_name']; ?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Parity</label>
	                                                <input type="text" class="form-control" name="par" placeholder="Parity"  value="<?php echo $row['parity']; ?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Hospital Number</label>
	                                                <input type="text" class="form-control" name="hn" placeholder="Hospital Number" value="<?php echo $row['hospital_number']; ?>" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Age</label>
	                                                <input type="number" class="form-control" name="age" placeholder="Age"  value="<?php echo $row['age']; ?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Number Of Living Children</label>
	                                                <input type="number" class="form-control" name="nlc" placeholder="Number Of Living Children"  value="<?php echo $row['living_children']; ?>">
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Past Obstetic History</label>
	                                                <textarea class="form-control" name="poh">
	                                                	 <?php echo $row['past_obstetic_history']; ?>
	                                                </textarea>
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>L.M.P.</label>
	                                                <input type="text" class="form-control" name="lmp" placeholder="L.M.P" value="<?php echo $row['lmp']; ?>" >
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>E.D.D.</label>
	                                                <input type="text" class="form-control" name="edd" placeholder="E.D.D" value="<?php echo $row['edd']; ?>" >
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Antenatal History</label>
	                                                <textarea name="ah" class="form-control">
	                                                	 <?php echo $row['antenatal_history']; ?>
	                                                </textarea>
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Onset</label>
	                                                <input type="text" class="form-control" name="onset" placeholder="Onset" value="<?php echo $row['onset']; ?>" >
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Hours</label>
	                                                <input type="text" class="form-control" name="h" placeholder="Hours" value="<?php echo $row['hours']; ?>" >
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label><input type="radio" name="state" value="Spontaneous"  <?php if ($row['state'] == "Spontaneous") {
	                                                	echo "checked";
	                                                } ?>> Spontaneous</label>
	                                            </div>
	                                        </div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label><input type="radio" name="state" value="Reduced" <?php if ($row['state'] == "Reduced") {
	                                                	echo "checked";
	                                                } ?>> Reduced</label>
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-7">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Membranes Ruptured (Hours)</label>
	                                                <input type="text" class="form-control" name="mrh" placeholder="Membranes Ruptured (Hours)" value="<?php echo $row['membrane_ruptured']; ?>">
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-5">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <input type="radio" name="amni" value="Yes"  <?php if ($row['amnitomy'] == "Yes") {
	                                                	echo "checked";
	                                                } ?>>Amniotomy
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-7">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Contraction (Painful) Begins At</label>
	                                                <input type="text" class="form-control" name="cont" placeholder="Contraction (Painful) Begins At" value="<?php echo $row['contractions']; ?>">
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-5">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label><input type="radio" name="oxi" value="Yes"  <?php if ($row['oxytocics'] == "Yes") {
	                                                	echo "checked";
	                                                } ?>> Oxytocics</label>
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<div class="container">
												<label>General Condition</label>
												<div class="row">
													<div class="col-md-3">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label><input type="radio" name="condition" value="Excellent"  <?php if ($row['condition'] == "Excellent") {
	                                                	echo "checked";
	                                                } ?>> Excellent</label>
					                                            </div>
					                                        </div>
														</div>
													</div>

													<div class="col-md-3">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label><input type="radio" name="condition" value="Good"  <?php if ($row['condition'] == "Good") {
	                                                	echo "checked";
	                                                } ?>> Good</label>
					                                            </div>
					                                        </div>
														</div>
													</div>

													<div class="col-md-3">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label><input type="radio" name="condition" value="Fair"   <?php if ($row['condition'] == "Fair") {
	                                                	echo "checked";
	                                                } ?>> Fair</label>
					                                            </div>
					                                        </div>
														</div>
													</div>

													<div class="col-md-3">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label><input type="radio" name="condition" value="Poor"  <?php if ($row['condition'] == "Poor") {
	                                                	echo "checked";
	                                                } ?>> Poor</label>
					                                            </div>
					                                        </div>
														</div>
													</div>


												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<div class="container">
												<div class="row">
													<div class="col-md-4">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label>Fundal Height</label>
					                                                <input type="text" name="fh" class="form-control" placeholder="Fundal Height" value="<?php echo $row['fundal_height']; ?>">
					                                            </div>
					                                        </div>
														</div>
													</div>

													<div class="col-md-3">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label><input type="radio" name="type" value="Multiple"  <?php if ($row['type'] == "Multiple") {
	                                                	echo "checked";
	                                                } ?>> Multiple</label>
					                                            </div>
					                                        </div>
														</div>
													</div>


													<div class="col-md-4">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label><input type="radio" name="type" value="Singleton"  <?php if ($row['type'] == "Singleton") {
	                                                	echo "checked";
	                                                } ?>> Singleton</label>
					                                            </div>
					                                        </div>
														</div>
													</div>

													<div class="clearfix"></div>
													<div class="col-md-4">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label>LIE</label>
					                                                <input type="text" name="lie" class="form-control" placeholder="LIE" value="<?php echo $row['lie']; ?>">
					                                            </div>
					                                        </div>
														</div>
													</div>

													<div class="col-md-4">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label>Presentation</label>
					                                                <input type="text" name="pres" class="form-control" placeholder="Presentation" value="<?php echo $row['presentation']; ?>">
					                                            </div>
					                                        </div>
														</div>
													</div>

													<div class="col-md-4">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label>Position</label>
					                                                <input type="text" name="pos" class="form-control" placeholder="Position" value="<?php echo $row['position']; ?>">
					                                            </div>
					                                        </div>
														</div>
													</div>

													<div class="col-md-4">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label>Descent (Fifths)</label>
					                                                <input type="text" name="desc" class="form-control" placeholder="Descent (Fifths)" value="<?php echo $row['descent']; ?>">
					                                            </div>
					                                        </div>
														</div>
													</div>

													<div class="col-md-4">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label>Foetal Heart Rate (Minute)</label>
					                                                <input type="text" name="fhr" class="form-control" placeholder="Foetal Heart Rate (Minute)" value="<?php echo $row['foetal_heart_rate']; ?>">
					                                            </div>
					                                        </div>
														</div>
													</div>


												</div>
											</div>
										</div>
									</div>


									<div class="row">
										<div class="col-md-12">
											<div class="container">
												<label>P.V.</label>
												<div class="row">
													<div class="col-md-6">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label>Vulva</label>
					                                                <input type="text" name="vul" class="form-control" placeholder="Vulva" value="<?php echo $row['vulva']; ?>">
					                                            </div>
					                                        </div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label>Vagina</label>
					                                                <input type="text" name="vag" class="form-control" placeholder="Vagina" value="<?php echo $row['vagina']; ?>">
					                                            </div>
					                                        </div>
														</div>
													</div>

													<div class="col-md-7">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label>Cervix (% Offaced)</label>
					                                                <input type="text" name="cer" class="form-control" placeholder="Cervix (% Offaced)" value="<?php echo $row['cervix']; ?>">
					                                            </div>
					                                        </div>
														</div>
													</div>

													<div class="col-md-5">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label><input type="radio" name="pp" value="Applied"  <?php if ($row['pp_state'] == "Applied") {
	                                                	echo "checked";
	                                                } ?>> Well/Loosely Applied to P.P </label>
					                                            </div>
					                                        </div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label>Os (cm dilated)</label>
					                                                <input type="text" name="os" class="form-control" placeholder="Os (cm dilated)" value="<?php echo $row['os']; ?>">
					                                            </div>
					                                        </div>
														</div>
													</div>

													<div class="col-md-6">
														<label>Membrane</label>
														<div class="row">
															<div class="container">
					                                       <div class="col-md-3">
					                                            <div class="form-group">
					                                                <input type="text" name="rup" class="form-control" placeholder="Ruptured" value="<?php echo $row['ruptured']; ?>">
					                                            </div>
					                                        </div>
					                                        <div class="col-md-3">
					                                        	<div class="form-group">
					                                        		<input type="text" name="int" class="form-control" placeholder="Intact" value="<?php echo $row['intact']; ?>">
					                                        	</div>
					                                        </div>
														</div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label>P.P at O (Station)</label>
					                                                <input type="text" name="ppo" class="form-control" placeholder="P.P at O (Station)" value="<?php echo $row['ppo']; ?>">
					                                            </div>
					                                        </div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label>in ________________________Position</label>
					                                                <input type="text" name="ip" class="form-control" placeholder="in ________________________Position" value="<?php echo $row['in_position']; ?>">
					                                            </div>
					                                        </div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label>Caput</label>
					                                                <input type="text" name="cap" class="form-control" placeholder="Caput" value="<?php echo $row['caput']; ?>">
					                                            </div>
					                                        </div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label>Moulding</label>
					                                                <input type="text" name="mould" class="form-control" placeholder="Moulding" value="<?php echo $row['mould']; ?>">
					                                            </div>
					                                        </div>
														</div>
													</div>


												</div>
											</div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
					                        <div class="col-md-12">
					                            <div class="form-group">
					                                <label>Pelvis AP (cms)</label>
					                                <input type="text" name="pap" class="form-control" placeholder="Pelvis AP (cms	)" value="<?php echo $row['pelvis_ap']; ?>">
					                            </div>
					                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
					                        <div class="col-md-12">
					                            <div class="form-group">
					                                <label>Pelvis Sacral Curve</label>
					                                <input type="text" name="psc" class="form-control" placeholder="Pelvis Sacral Curve" value="<?php echo $row['pelvis_sacral_curve']; ?>">
					                            </div>
					                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
					                        <div class="col-md-12">
					                            <div class="form-group">
					                                <label>Forecast</label>
					                                <input type="text" name="f" class="form-control" placeholder="Forecast" value="<?php echo $row['forecast']; ?>">
					                            </div>
					                        </div>
										</div>
									</div>



									<div class="col-md-6">
										<div class="row">
					                        <div class="col-md-12">
					                            <div class="form-group">
					                                <label>Ischial Spine</label>
					                                <input type="text" name="is" class="form-control" placeholder="Ischial Spine" value="<?php echo $row['ischial_spine']; ?>">
					                            </div>
					                        </div>
										</div>
									</div>

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Update Labour</button>
									<button type="reset" class="btn btn-danger btn-fill pull-left">Clear</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        
						</div>
                    </div>
                 </div>
            <?php 
        			endforeach;
            ?>
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
		var by = "<?php echo $user_id;?>"; 
		var lid = "<?php echo $lid; ?>";
		a('#appt').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			
			a.ajax({
				type: "POST",
				data: a('#appt').serialize() + '&by=' + by + '&lid=' +lid+ '&ins=editLabour',
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

