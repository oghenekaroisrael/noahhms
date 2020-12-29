<?php 
	ob_start();
	session_start();
	$pageTitle = "New Labour";
	// Include database class
	include_once '../inc/db.php';
	
	If(!isset($_SESSION['userSession'])){
		header("Location: ../index");
		exit;
	}
	elseif (isset($_SESSION['userSession'])){
		$user_id = $_SESSION['userSession'];
	}
	$p_id = $_GET['id'];
	$ipid = $_GET['ipid'];
	
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
                                <h4 class="title">New Labour</h4>
                            </div>

                            <div class="content">
                                <form id="appt">
											

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Surname</label>
	                                                <input type="text" class="form-control" name="surname" placeholder="Surname" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>First Name</label>
	                                                <input type="text" class="form-control" name="fname" placeholder="First Name" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Parity</label>
	                                                <input type="text" class="form-control" name="par" placeholder="Parity" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Hospital Number</label>
	                                                <input type="text" class="form-control" name="hn" placeholder="Hospital Number" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Age</label>
	                                                <input type="number" class="form-control" name="age" placeholder="Age" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Number Of Living Children</label>
	                                                <input type="number" class="form-control" name="nlc" placeholder="Number Of Living Children" >
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Past Obstetic History</label>
	                                                <textarea class="form-control" name="poh"></textarea>
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>L.M.P.</label>
	                                                <input type="text" class="form-control" name="lmp" placeholder="L.M.P" >
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>E.D.D.</label>
	                                                <input type="text" class="form-control" name="edd" placeholder="E.D.D" >
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Antenatal History</label>
	                                                <textarea name="ah" class="form-control"></textarea>
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Onset</label>
	                                                <input type="text" class="form-control" name="onset" placeholder="Onset" >
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Hours</label>
	                                                <input type="text" class="form-control" name="h" placeholder="Hours" >
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label><input type="radio" name="state" value="Spontaneous"> Spontaneous</label>
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label><input type="radio" name="state" value="Reduced"> Reduced</label>
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-7">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Membranes Ruptured (Hours)</label>
	                                                <input type="text" class="form-control" name="mrh" placeholder="Membranes Ruptured (Hours)" >
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-5">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <input type="radio" name="amni" value="Yes">Amniotomy
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-7">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Contraction (Painful) Begins At</label>
	                                                <input type="text" class="form-control" name="cont" placeholder="Contraction (Painful) Begins At">
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-5">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label><input type="radio" name="oxi" value="Yes"> Oxytocics</label>
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
					                                                <label><input type="radio" name="condition" value="Excellent"> Excellent</label>
					                                            </div>
					                                        </div>
														</div>
													</div>

													<div class="col-md-3">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label><input type="radio" name="condition" value="Good"> Good</label>
					                                            </div>
					                                        </div>
														</div>
													</div>

													<div class="col-md-3">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label><input type="radio" name="condition" value="Fair"> Fair</label>
					                                            </div>
					                                        </div>
														</div>
													</div>

													<div class="col-md-3">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label><input type="radio" name="condition" value="Poor"> Poor</label>
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
												<label>Abdomen</label>
												<div class="row">
													<div class="col-md-4">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label>Fundal Height</label>
					                                                <input type="text" name="fh" class="form-control" placeholder="Fundal Height">
					                                            </div>
					                                        </div>
														</div>
													</div>

													<div class="col-md-3">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label><input type="radio" name="type" value="Multiple"> Multiple</label>
					                                            </div>
					                                        </div>
														</div>
													</div>


													<div class="col-md-4">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label><input type="radio" name="type" value="Singleton"> Singleton</label>
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
					                                                <input type="text" name="lie" class="form-control" placeholder="LIE">
					                                            </div>
					                                        </div>
														</div>
													</div>

													<div class="col-md-4">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label>Presentation</label>
					                                                <input type="text" name="pres" class="form-control" placeholder="Presentation">
					                                            </div>
					                                        </div>
														</div>
													</div>

													<div class="col-md-4">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label>Position</label>
					                                                <input type="text" name="pos" class="form-control" placeholder="Position">
					                                            </div>
					                                        </div>
														</div>
													</div>

													<div class="col-md-4">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label>Descent (Fifths)</label>
					                                                <input type="text" name="desc" class="form-control" placeholder="Descent (Fifths)">
					                                            </div>
					                                        </div>
														</div>
													</div>

													<div class="col-md-4">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label>Foetal Heart Rate (Minute)</label>
					                                                <input type="text" name="fhr" class="form-control" placeholder="Foetal Heart Rate (Minute)">
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
					                                                <input type="text" name="vul" class="form-control" placeholder="Vulva">
					                                            </div>
					                                        </div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label>Vagina</label>
					                                                <input type="text" name="vag" class="form-control" placeholder="Vagina">
					                                            </div>
					                                        </div>
														</div>
													</div>

													<div class="col-md-7">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label>Cervix (% Offaced)</label>
					                                                <input type="text" name="cer" class="form-control" placeholder="Cervix (% Offaced)">
					                                            </div>
					                                        </div>
														</div>
													</div>

													<div class="col-md-5">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label><input type="radio" name="pp" value="applied"> Well/Loosely Applied to P.P </label>
					                                            </div>
					                                        </div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label>Os (cm dilated)</label>
					                                                <input type="text" name="os" class="form-control" placeholder="Os (cm dilated)">
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
					                                                <input type="text" name="rup" class="form-control" placeholder="Ruptured">
					                                            </div>
					                                        </div>
					                                        <div class="col-md-3">
					                                        	<div class="form-group">
					                                        		<input type="text" name="int" class="form-control" placeholder="Intact">
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
					                                                <input type="text" name="ppo" class="form-control" placeholder="P.P at O (Station)">
					                                            </div>
					                                        </div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label>in ________________________Position</label>
					                                                <input type="text" name="ip" class="form-control" placeholder="in ________________________Position">
					                                            </div>
					                                        </div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label>Caput</label>
					                                                <input type="text" name="cap" class="form-control" placeholder="Caput">
					                                            </div>
					                                        </div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="row">
					                                       <div class="col-md-12">
					                                            <div class="form-group">
					                                                <label>Moulding</label>
					                                                <input type="text" name="mould" class="form-control" placeholder="Moulding">
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
					                                <input type="text" name="pap" class="form-control" placeholder="Pelvis AP (cms	)">
					                            </div>
					                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
					                        <div class="col-md-12">
					                            <div class="form-group">
					                                <label>Pelvis Sacral Curve</label>
					                                <input type="text" name="psc" class="form-control" placeholder="Pelvis Sacral Curve">
					                            </div>
					                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
					                        <div class="col-md-12">
					                            <div class="form-group">
					                                <label>Forecast</label>
					                                <input type="text" name="f" class="form-control" placeholder="Forecast">
					                            </div>
					                        </div>
										</div>
									</div>



									<div class="col-md-6">
										<div class="row">
					                        <div class="col-md-12">
					                            <div class="form-group">
					                                <label>Ischial Spine</label>
					                                <input type="text" name="is" class="form-control" placeholder="Ischial Spine">
					                            </div>
					                        </div>
										</div>
									</div>

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Add Labour</button>
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
		var by = "<?php echo $user_id;?>"; 
		a('#appt').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			
			a.ajax({
				type: "POST",
				data: a('#appt').serialize() + '&by=' + by + '&ins=newLabour',
				url: "../func/verify.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					a("#get_result").html(res).fadeIn("slow");
					console.log(res);
				}
			});
        });
    });
</script>

