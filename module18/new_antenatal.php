<?php 
	ob_start();
	session_start();
	$pageTitle = "New Immunization";
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
                                <h4 class="title">Immunization</h4>
                            </div>

                            <div class="content">
                                <form id="ante">
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-6">
	                                           <div class="form-group">
			                                        <label>Child's Name</label>
			                                        <input type="text" class="form-control" name="name" placeholder="Child's Name" >
			                                    </div>   
			                                </div>

			                                <div class="col-md-4">
	                                            <div class="form-group">
	                                                <label>Position</label>
	                                                <input type="text" class="form-control" name="pos" placeholder="Position">
												</div>
	                                        </div> 
											
											<div class="col-md-2">
	                                             <div class="form-group">
	                                                <label>Sex</label>
	                                                <select class="form-control" name="sex">
														<option value="">Choose</option>
														<option value="Male">Male</option>
														<option value="Female">Female</option>
													</select>
	                                            </div>
	                                        </div>  
										</div>
									</div>
                                	
									<div class="col-md-12">
										<div class="row">
										 <div class="col-md-4">
	                                            <div class="form-group">
	                                                <label>Date of Birth</label>
	                                                <input type="Date" class="form-control" name="dob" placeholder="Date of Birth">
												</div>
	                                        </div> 
											
										
										<div class="col-md-4">
	                                        <div class="form-group">
			                                    <label>House Number</label>
			                                    <input type="text" class="form-control" name="house_num" placeholder="House Number" >
			                                </div>
	                                    </div> 
											
										<div class="col-md-4">
										<div class="form-group">
	                                               <label>Village Settlement</label>
			                                        <input type="text" class="form-control" name="village" placeholder="Village Settlement" >
	                                            </div>
	                                        </div>
									</div>
											
										</div>
									</div>

									<div class="clearfix"></div>

									

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Town/City</label>
	                                                <input type="text" class="form-control" name="town" placeholder="Town/City" >
	                                            </div>
	                                        </div>
										</div>
									</div>


									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-6">
	                                           <div class="form-group">
	                                                <label>Ward</label>
	                                                <input type="text" class="form-control" name="ward" placeholder="Ward" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>LGA</label>
	                                                <input type="text" class="form-control" name="lga" placeholder="LGA" >
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="row">
											<div class="col-md-4">
	                                            <div class="form-group">
	                                                <label>State</label>
	                                                <input type="text" class="form-control" name="state" placeholder="State" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-4">
	                                            <div class="form-group">
	                                                 <label>Mother's Name</label>
	                                                <input type="text" class="form-control" name="mother_name" placeholder="Mother's Name" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-4">
	                                            <div class="form-group">
	                                                 <label>Mother's GSM</label>
	                                                <input type="text" class="form-control" name="mother_phone" placeholder="Mother's GSM" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Father's Name</label>
	                                                <input type="text" class="form-control" name="father_name" placeholder="Father's Name" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Father's GSM</label>
	                                                <input type="text" class="form-control" name="father_phone" placeholder="Father's GSM" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Care Giver's Name</label>
	                                                <input type="text" class="form-control" name="cg" placeholder="Care Giver's Name" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Care Giver's GSM</label>
	                                                <input type="text" class="form-control" name="cg_phone" placeholder="Care Giver's GSM" >
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<div id="sections">
													
													<p><strong>Mother's Other Children</strong></p>
													<div class="section">
														<fieldset style="padding:20px;">  
															<div class="col-md-3">
																<div class="form-group">
																	<label>Year of Birth</label>
																	<input class="form-control" type="date" name="c_year[]" placeholder="Year of Birth" autocomplete = "off" />
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<label>Sex</label>
																	<input class="form-control" type="text" name="c_sex[]"  placeholder="Sex" autocomplete = "off" />
																</div>
															</div>

															<div class="col-md-6">
																<div class="form-group">
																	<label>State of Health</label>
																	<input class="form-control" type="text"  name="c_health[]" placeholder="State of Health" autocomplete = "off"/>
																</div>
															</div>

															<p><a href="#" class='remove'><i class="fas fa-times"></i></a></p>
														</fieldset>					
												  </div>				  
												</div>

												<p><a href="#" class='addsection'><i class="fas fa-plus"></i> Add More Items</a></p>
											</div>	
										</div>	
									</div>	
									
									<div class="clearTwenty"></div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label>Did the baby weight less than 2.5KG at birth?</label>
													<select class="form-control" name="weigh">
														<option value="">Choose</option>
														<option value="Yes">Yes</option>
														<option value="No">No</option>
													</select>
												</div>
	                                        </div>
										</div>
									</div>	
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label>Is this baby a twin?</label>
													<select class="form-control" name="twin">
														<option value="">Choose</option>
														<option value="Yes">Yes</option>
														<option value="No">No</option>
													</select>
												</div>
	                                        </div>
										</div>
									</div>	
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label>Is this baby bottle fed?</label>
													<select class="form-control" name="fed">
														<option value="">Choose</option>
														<option value="Yes">Yes</option>
														<option value="No">No</option>
													</select>
												</div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label>Does the mother need more family support?</label>
													<select class="form-control" name="support">
														<option value="">Choose</option>
														<option value="Yes">Yes</option>
														<option value="No">No</option>
													</select>
												</div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label>Are any brothers and sisters underweight?</label>
													<select class="form-control" name="underweight">
														<option value="">Choose</option>
														<option value="Yes">Yes</option>
														<option value="No">No</option>
													</select>
												</div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label>Are there any other reasons for taking extra care (e.g tuberculosis or leprosy or social problems etc)?</label>
													<select class="form-control" name="exta_care">
														<option value="">Choose</option>
														<option value="Yes">Yes</option>
														<option value="No">No</option>
													</select>
												</div>
	                                        </div>
										</div>
									</div>	
									
									<div class="col-md-12">
										<div class="row">
											<p class="text-center">Birth</p>
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum1" placeholder="Batch Number" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine Hep B 0</label>
	                                                <input type="text" class="form-control" name="v1" placeholder="Vaccine Hep B 0" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg1" placeholder="Date Given" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn1" placeholder="Date of Next Visit" >
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm1" placeholder="Comment" ></textarea>
											</div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="row">
											
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum2" placeholder="Batch Number" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine OPV 0</label>
	                                                <input type="text" class="form-control" name="v2" placeholder="Vaccine OPV 0" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg2" placeholder="Date Given" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn2" placeholder="Date of Next Visit" >
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm2" placeholder="Comment" ></textarea>
											</div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="row">
											
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum3" placeholder="Batch Number" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine BCG</label>
	                                                <input type="text" class="form-control" name="v3" placeholder="Vaccine BCG" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg3" placeholder="Date Given" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn3" placeholder="Date of Next Visit" >
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm3" placeholder="Comment" ></textarea>
											</div>
										</div>
									</div>

									
									<div class="col-md-12">
										<div class="row">
											<p class="text-center">6 Weeks</p>
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum4" placeholder="Batch Number" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine OPV 1</label>
	                                                <input type="text" class="form-control" name="v4" placeholder="Vaccine OPV 1" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg4" placeholder="Date Given" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn4" placeholder="Date of Next Visit" >
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm4" placeholder="Comment" ></textarea>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum5" placeholder="Batch Number" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine Penta 1</label>
	                                                <input type="text" class="form-control" name="v5" placeholder="Vaccine Penta 1" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg5" placeholder="Date Given" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn5" placeholder="Date of Next Visit" >
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm5" placeholder="Comment" ></textarea>
											</div>
										</div>
									</div>
									
									
									<div class="col-md-12">
										<div class="row">
											
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum6" placeholder="Batch Number" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine PCV 1</label>
	                                                <input type="text" class="form-control" name="v6" placeholder="Vaccine PCV 1" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg6" placeholder="Date Given" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn6" placeholder="Date of Next Visit" >
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm6" placeholder="Comment" ></textarea>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum7" placeholder="Batch Number" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine Rota 1</label>
	                                                <input type="text" class="form-control" name="v7" placeholder="Vaccine Rota 1" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg7" placeholder="Date Given" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn7" placeholder="Date of Next Visit" >
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm7" placeholder="Comment" ></textarea>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<p class="text-center">10 Weeks</p>
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum8" placeholder="Batch Number" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine OPV 2</label>
	                                                <input type="text" class="form-control" name="v8" placeholder="Vaccine OPV 1" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg8" placeholder="Date Given" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn8" placeholder="Date of Next Visit" >
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm8" placeholder="Comment" ></textarea>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum9" placeholder="Batch Number" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine Penta 2</label>
	                                                <input type="text" class="form-control" name="v9" placeholder="Vaccine Penta 2" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg9" placeholder="Date Given" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn9" placeholder="Date of Next Visit" >
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm9" placeholder="Comment" ></textarea>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum10" placeholder="Batch Number" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine PCV 2</label>
	                                                <input type="text" class="form-control" name="v10" placeholder="Vaccine PCV 2" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg10" placeholder="Date Given" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn10" placeholder="Date of Next Visit" >
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm10" placeholder="Comment" ></textarea>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum11" placeholder="Batch Number" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine Rota 2</label>
	                                                <input type="text" class="form-control" name="v11" placeholder="Vaccine OPV 1" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg11" placeholder="Date Given" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn11" placeholder="Date of Next Visit" >
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm11" placeholder="Comment" ></textarea>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<p class="text-center">14 Weeks</p>
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum12" placeholder="Batch Number" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine OPV 3</label>
	                                                <input type="text" class="form-control" name="v12" placeholder="Vaccine OPV 3" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg12" placeholder="Date Given" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn12" placeholder="Date of Next Visit" >
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm12" placeholder="Comment" ></textarea>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum13" placeholder="Batch Number" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine Penta 3</label>
	                                                <input type="text" class="form-control" name="v13" placeholder="Vaccine Penta 3" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg13" placeholder="Date Given" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn13" placeholder="Date of Next Visit" >
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm13" placeholder="Comment" ></textarea>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum14" placeholder="Batch Number" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine PCV 3</label>
	                                                <input type="text" class="form-control" name="v14" placeholder="Vaccine PCV 3" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg14" placeholder="Date Given" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn14" placeholder="Date of Next Visit" >
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm14" placeholder="Comment" ></textarea>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum15" placeholder="Batch Number" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine 1PV</label>
	                                                <input type="text" class="form-control" name="v15" placeholder="Vaccine IPV" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg15" placeholder="Date Given" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn15" placeholder="Date of Next Visit" >
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm15" placeholder="Comment" ></textarea>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<p class="text-center">6 Months</p>
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum16" placeholder="Batch Number" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine Vitamin A</label>
	                                                <input type="text" class="form-control" name="v16" placeholder="Vaccine Vitamin A" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg16" placeholder="Date Given" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn16" placeholder="Date of Next Visit" >
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm16" placeholder="Comment" ></textarea>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<p class="text-center">9 Months</p>
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum17" placeholder="Batch Number" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine Measles 1</label>
	                                                <input type="text" class="form-control" name="v17" placeholder="Vaccine Measles 1" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg17" placeholder="Date Given" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn17" placeholder="Date of Next Visit" >
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm17" placeholder="Comment" ></textarea>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum18" placeholder="Batch Number" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine Yellow Fever</label>
	                                                <input type="text" class="form-control" name="v18" placeholder="Vaccine Yellow Fever" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg18" placeholder="Date Given" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn18" placeholder="Date of Next Visit" >
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm18" placeholder="Comment" ></textarea>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum19" placeholder="Batch Number" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine Conjugate A CSM</label>
	                                                <input type="text" class="form-control" name="v19" placeholder="Vaccine Conjugate A CSM" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg19" placeholder="Date Given" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn19" placeholder="Date of Next Visit" >
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm19" placeholder="Comment" ></textarea>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<p class="text-center">12 Months</p>
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum20" placeholder="Batch Number" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine Vitamin A Dose 2</label>
	                                                <input type="text" class="form-control" name="v20" placeholder="Vaccine Vitamin A Dose 2" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg20" placeholder="Date Given" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn20" placeholder="Date of Next Visit" >
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm20" placeholder="Comment" ></textarea>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
										
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum21" placeholder="Batch Number" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine Measles 2</label>
	                                                <input type="text" class="form-control" name="v21" placeholder="Vaccine Measles 2" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg21" placeholder="Date Given" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn21" placeholder="Date of Next Visit" >
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm21" placeholder="Comment" ></textarea>
											</div>
										</div>
									</div>
									
									<div class="clearTwenty"></div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<div id="sections2">
													
													<p>Note here if the child has had anu adverse or negative reactions to vaccines (AEFI) or any other special contraindications. Note symptom and vaccine responsibe if known</p>
													<div class="section2">
														<fieldset style="padding:20px;">  
															<div class="col-md-12">
																<div class="form-group">
																	<label>Date of Onset</label>
																	<input class="form-control" type="date" name="d_year[]" placeholder="Date of Onset" autocomplete = "off" />
																</div>
															</div>

															<div class="col-md-12">
																<div class="form-group">
																	<label>Complaint</label>
																	<textarea class="form-control" name="complaint[]"  placeholder="Complaint"></textarea>
																</div>
															</div>

															<div class="col-md-12">
																<div class="form-group">
																	<label>Types</label>
																	 <select class="form-control" name="types[]]">
																		<option value="">Choose</option>
																		<option value="Mild">Mild</option>
																		<option value="Serious">Serious</option>
																	</select>
																</div>
															</div>
															
															<div class="col-md-12">
																<div class="form-group">
																	<label>Management Status</label>
																	<textarea class="form-control" name="manag[]"  placeholder="Management Status"></textarea>
																</div>
															</div>

															<p><a href="#" class='remove2'><i class="fas fa-times"></i></a></p>
														</fieldset>					
												  </div>				  
												</div>

												<p><a href="#" class='addsection2'><i class="fas fa-plus"></i> Add More Items</a></p>
											</div>	
										</div>	
									</div>	
									
									<div class="clearTwenty"></div>
									
									<div class="clearTwenty"></div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Add Immunization</button>
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

		a('#ante').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			
			a.ajax({
				type: "POST",
				data: a('#ante').serialize()  + '&ins=newAnte',
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

<script type="text/javascript">
			var a=jQuery .noConflict();
			//define template
			var template = a('#sections .section:first').clone();

			//define counter
			var sectionsCount = 1;

			//add new section
			a('body').on('click', '.addsection', function() {

				//increment
				sectionsCount++;

				//loop through each input
				var section = template.clone().find(':input').each(function(){
				
					//set id to store the updated section number
					var newId = this.id + sectionsCount;

					//update for label
					a(this).prev().attr('for', newId);

					//update id
					this.id = newId;
				}).end()

				//inject new section
				.appendTo('#sections');
				return false;
			});

			//remove section
			a('#sections').on('click', '.remove', function() {
				//fade out section
				a(this).parent().fadeOut(300, function(){
					//remove parent element (main section)
					a(this).parent().parent().empty();
					return false;
				});
				return false;
			});
		</script>

		<script type="text/javascript">
			var a=jQuery .noConflict();
			//define template
			var template = a('#sections2 .section2:first').clone();

			//define counter
			var sectionsCount = 1;

			//add new section
			a('body').on('click', '.addsection2', function() {

				//increment
				sectionsCount++;

				//loop through each input
				var section = template.clone().find(':input').each(function(){
				
					//set id to store the updated section number
					var newId = this.id + sectionsCount;

					//update for label
					a(this).prev().attr('for', newId);

					//update id
					this.id = newId;
				}).end()

				//inject new section
				.appendTo('#sections2');
				return false;
			});

			//remove section
			a('#sections2').on('click', '.remove', function() {
				//fade out section
				a(this).parent().fadeOut(300, function(){
					//remove parent element (main section)
					a(this).parent().parent().empty();
					return false;
				});
				return false;
			});
		</script>