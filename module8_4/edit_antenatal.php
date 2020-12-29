<?php 
	ob_start();
	session_start();
	$pageTitle = "Edit Antenatal";
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
                                <form id="change_ante">
									<?php
										$noarray = database::getInstance()->select_from_where('antenatal','id',$id);
										while ($row = $noarray->fetch(PDO::FETCH_ASSOC)) {
										
									?>
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-6">
	                                           <div class="form-group">
			                                        <label>Child's Name</label>
			                                        <input type="text" class="form-control" name="name" placeholder="Child's Name" value="<?php echo $row['name'];?>">
			                                    </div>   
			                                </div>

			                                <div class="col-md-4">
	                                            <div class="form-group">
	                                                <label>Position</label>
	                                                <input type="text" class="form-control" name="pos" placeholder="Position" value="<?php echo $row['pos'];?>">
												</div>
	                                        </div> 
											
											<div class="col-md-2">
	                                             <div class="form-group">
	                                                <label>Sex</label>
	                                                <select class="form-control" name="sex">
														<option value="<?php echo $row['sex'];?>"><?php echo $row['sex'];?></option>
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
	                                                <input type="Date" class="form-control" name="dob" placeholder="Date of Birth" value="<?php echo $row['dob'];?>">
												</div>
	                                        </div> 
											
										
										<div class="col-md-4">
	                                        <div class="form-group">
			                                    <label>House Number</label>
			                                    <input type="text" class="form-control" name="house_num" placeholder="House Number" value="<?php echo $row['house_num'];?>" >
			                                </div>
	                                    </div> 
											
										<div class="col-md-4">
										<div class="form-group">
	                                               <label>Village Settlement</label>
			                                        <input type="text" class="form-control" name="village" placeholder="Village Settlement" value="<?php echo $row['village'];?>">
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
	                                                <input type="text" class="form-control" name="town" placeholder="Town/City" value="<?php echo $row['town'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>


									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-6">
	                                           <div class="form-group">
	                                                <label>Ward</label>
	                                                <input type="text" class="form-control" name="ward" placeholder="Ward" value="<?php echo $row['ward'];?>" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>LGA</label>
	                                                <input type="text" class="form-control" name="lga" placeholder="LGA" value="<?php echo $row['lga'];?>" >
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="row">
											<div class="col-md-4">
	                                            <div class="form-group">
	                                                <label>State</label>
	                                                <input type="text" class="form-control" name="state" placeholder="State" value="<?php echo $row['state'];?>" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-4">
	                                            <div class="form-group">
	                                                 <label>Mother's Name</label>
	                                                <input type="text" class="form-control" name="mother_name" placeholder="Mother's Name" value="<?php echo $row['mother_name'];?>" >
	                                            </div>
	                                        </div>
											
											<div class="col-md-4">
	                                            <div class="form-group">
	                                                 <label>Mother's GSM</label>
	                                                <input type="text" class="form-control" name="mother_phone" placeholder="Mother's GSM" value="<?php echo $row['mother_phone'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Father's Name</label>
	                                                <input type="text" class="form-control" name="father_name" placeholder="Father's Name" value="<?php echo $row['father_name'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Father's GSM</label>
	                                                <input type="text" class="form-control" name="father_phone" placeholder="Father's GSM" value="<?php echo $row['father_phone'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Care Giver's Name</label>
	                                                <input type="text" class="form-control" name="cg" placeholder="Care Giver's Name" value="<?php echo $row['cg'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Care Giver's GSM</label>
	                                                <input type="text" class="form-control" name="cg_phone" placeholder="Care Giver's GSM"  value="<?php echo $row['cg_phone'];?>">
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
														<option value="<?php echo $row['weight'];?>"><?php echo $row['weight'];?></option>
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
														<option value="<?php echo $row['twin'];?>"><?php echo $row['twin'];?></option>
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
														<option value="<?php echo $row['fed'];?>"><?php echo $row['fed'];?></option>
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
														<option value="<?php echo $row['support'];?>"><?php echo $row['support'];?></option>
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
														<option value="<?php echo $row['underweight'];?>"><?php echo $row['underweight'];?></option>
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
														<option value="<?php echo $row['extra_care'];?>"><?php echo $row['extra_care'];?></option>
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
	                                                <input type="text" class="form-control" name="bnum1" placeholder="Batch Number" value="<?php echo $row['bnum1'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine Hep B 0</label>
	                                                <input type="text" class="form-control" name="v1" placeholder="Vaccine Hep B 0" value="<?php echo $row['v1'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg1" placeholder="Date Given" value="<?php echo $row['dg1'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn1" placeholder="Date of Next Visit" value="<?php echo $row['dn1'];?>">
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm1" placeholder="Comment" ><?php echo $row['cm1'];?></textarea>
											</div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="row">
											
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum2" placeholder="Batch Number" value="<?php echo $row['bnum2'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine OPV 0</label>
	                                                <input type="text" class="form-control" name="v2" placeholder="Vaccine OPV 0" value="<?php echo $row['v2'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg2" placeholder="Date Given" value="<?php echo $row['dg2'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn2" placeholder="Date of Next Visit" value="<?php echo $row['dg2'];?>">
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm2" placeholder="Comment" ><?php echo $row['cm2'];?></textarea>
											</div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="row">
											
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum3" placeholder="Batch Number" value="<?php echo $row['bnum3'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine BCG</label>
	                                                <input type="text" class="form-control" name="v3" placeholder="Vaccine BCG" value="<?php echo $row['v3'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg3" placeholder="Date Given" value="<?php echo $row['dg3'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn3" placeholder="Date of Next Visit" value="<?php echo $row['dn3'];?>">
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm3" placeholder="Comment" ><?php echo $row['cm3'];?></textarea>
											</div>
										</div>
									</div>

									
									<div class="col-md-12">
										<div class="row">
											<p class="text-center">6 Weeks</p>
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum4" placeholder="Batch Number" value="<?php echo $row['bnum4'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine OPV 1</label>
	                                                <input type="text" class="form-control" name="v4" placeholder="Vaccine OPV 1" value="<?php echo $row['v4'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg4" placeholder="Date Given" value="<?php echo $row['dg4'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn4" placeholder="Date of Next Visit" value="<?php echo $row['dn4'];?>">
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm4" placeholder="Comment" ><?php echo $row['cm4'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum5" placeholder="Batch Number" value="<?php echo $row['bnum5'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine Penta 1</label>
	                                                <input type="text" class="form-control" name="v5" placeholder="Vaccine Penta 1" value="<?php echo $row['v5'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg5" placeholder="Date Given" value="<?php echo $row['dg5'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn5" placeholder="Date of Next Visit" value="<?php echo $row['dn5'];?>">
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm5" placeholder="Comment" ><?php echo $row['cm5'];?></textarea>
											</div>
										</div>
									</div>
									
									
									<div class="col-md-12">
										<div class="row">
											
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum6" placeholder="Batch Number" value="<?php echo $row['bnum6'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine PCV 1</label>
	                                                <input type="text" class="form-control" name="v6" placeholder="Vaccine PCV 1" value="<?php echo $row['v6'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg6" placeholder="Date Given" value="<?php echo $row['dg6'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn6" placeholder="Date of Next Visit" value="<?php echo $row['dn6'];?>">
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm6" placeholder="Comment" ><?php echo $row['cm6'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum7" placeholder="Batch Number" value="<?php echo $row['bnum7'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine Rota 1</label>
	                                                <input type="text" class="form-control" name="v7" placeholder="Vaccine Rota 1" value="<?php echo $row['v7'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg7" placeholder="Date Given" value="<?php echo $row['dg7'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn7" placeholder="Date of Next Visit" value="<?php echo $row['dn7'];?>">
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm7" placeholder="Comment" ><?php echo $row['cm7'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<p class="text-center">10 Weeks</p>
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum8" placeholder="Batch Number" value="<?php echo $row['bnum8'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine OPV 2</label>
	                                                <input type="text" class="form-control" name="v8" placeholder="Vaccine OPV 1" value="<?php echo $row['v8'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg8" placeholder="Date Given" value="<?php echo $row['dg8'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn8" placeholder="Date of Next Visit" value="<?php echo $row['dn8'];?>">
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm8" placeholder="Comment" ><?php echo $row['cm8'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum9" placeholder="Batch Number" value="<?php echo $row['bnum9'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine Penta 2</label>
	                                                <input type="text" class="form-control" name="v9" placeholder="Vaccine Penta 2" value="<?php echo $row['v9'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg9" placeholder="Date Given" value="<?php echo $row['dg9'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn9" placeholder="Date of Next Visit" value="<?php echo $row['dn9'];?>">
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm9" placeholder="Comment" ><?php echo $row['cm9'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum10" placeholder="Batch Number" value="<?php echo $row['bnum10'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine PCV 2</label>
	                                                <input type="text" class="form-control" name="v10" placeholder="Vaccine PCV 2" value="<?php echo $row['v10'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg10" placeholder="Date Given" value="<?php echo $row['dg10'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn10" placeholder="Date of Next Visit" value="<?php echo $row['dn10'];?>">
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm10" placeholder="Comment" ><?php echo $row['cm10'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum11" placeholder="Batch Number" value="<?php echo $row['bnum11'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine Rota 2</label>
	                                                <input type="text" class="form-control" name="v11" placeholder="Vaccine OPV 1" value="<?php echo $row['v11'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg11" placeholder="Date Given" value="<?php echo $row['dg11'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn11" placeholder="Date of Next Visit" value="<?php echo $row['dn11'];?>">
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm11" placeholder="Comment" ><?php echo $row['cm11'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<p class="text-center">14 Weeks</p>
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum12" placeholder="Batch Number" value="<?php echo $row['bnum12'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine OPV 3</label>
	                                                <input type="text" class="form-control" name="v12" placeholder="Vaccine OPV 3" value="<?php echo $row['v12'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg12" placeholder="Date Given" value="<?php echo $row['dg12'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn12" placeholder="Date of Next Visit" value="<?php echo $row['dn12'];?>">
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm12" placeholder="Comment" ><?php echo $row['cm12'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum13" placeholder="Batch Number" value="<?php echo $row['bnum13'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine Penta 3</label>
	                                                <input type="text" class="form-control" name="v13" placeholder="Vaccine Penta 3" value="<?php echo $row['v13'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg13" placeholder="Date Given" value="<?php echo $row['dg13'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn13" placeholder="Date of Next Visit" value="<?php echo $row['dn13'];?>">
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm13" placeholder="Comment" ><?php echo $row['cm13'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum14" placeholder="Batch Number" value="<?php echo $row['bnum14'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine PCV 3</label>
	                                                <input type="text" class="form-control" name="v14" placeholder="Vaccine PCV 3" value="<?php echo $row['v14'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg14" placeholder="Date Given" value="<?php echo $row['dg14'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn14" placeholder="Date of Next Visit" value="<?php echo $row['dn14'];?>">
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm14" placeholder="Comment" ><?php echo $row['cm14'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum15" placeholder="Batch Number" value="<?php echo $row['bnum15'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine 1PV</label>
	                                                <input type="text" class="form-control" name="v15" placeholder="Vaccine IPV" value="<?php echo $row['v15'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg15" placeholder="Date Given" value="<?php echo $row['dg15'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn15" placeholder="Date of Next Visit" value="<?php echo $row['dn15'];?>">
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm15" placeholder="Comment" ><?php echo $row['cm15'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<p class="text-center">6 Months</p>
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum16" placeholder="Batch Number" value="<?php echo $row['bnum16'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine Vitamin A</label>
	                                                <input type="text" class="form-control" name="v16" placeholder="Vaccine Vitamin A" value="<?php echo $row['v16'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg16" placeholder="Date Given" value="<?php echo $row['dg16'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn16" placeholder="Date of Next Visit" value="<?php echo $row['dn16'];?>">
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm16" placeholder="Comment" ><?php echo $row['cm16'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<p class="text-center">9 Months</p>
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum17" placeholder="Batch Number" value="<?php echo $row['bnum17'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine Measles 1</label>
	                                                <input type="text" class="form-control" name="v17" placeholder="Vaccine Measles 1" value="<?php echo $row['v17'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg17" placeholder="Date Given" value="<?php echo $row['dg17'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn17" placeholder="Date of Next Visit" value="<?php echo $row['dn17'];?>">
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm17" placeholder="Comment" ><?php echo $row['cm17'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum18" placeholder="Batch Number" value="<?php echo $row['bnum18'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine Yellow Fever</label>
	                                                <input type="text" class="form-control" name="v18" placeholder="Vaccine Yellow Fever" value="<?php echo $row['v18'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg18" placeholder="Date Given" value="<?php echo $row['dg18'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn18" placeholder="Date of Next Visit" value="<?php echo $row['dn18'];?>">
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm18" placeholder="Comment" ><?php echo $row['cm18'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum19" placeholder="Batch Number" value="<?php echo $row['bnum19'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine Conjugate A CSM</label>
	                                                <input type="text" class="form-control" name="v19" placeholder="Vaccine Conjugate A CSM" value="<?php echo $row['v19'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg19" placeholder="Date Given" value="<?php echo $row['dg19'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn19" placeholder="Date of Next Visit" value="<?php echo $row['dn19'];?>">
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm19" placeholder="Comment" ><?php echo $row['cm19'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<p class="text-center">12 Months</p>
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum20" placeholder="Batch Number" value="<?php echo $row['bnum20'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine Vitamin A Dose 2</label>
	                                                <input type="text" class="form-control" name="v20" placeholder="Vaccine Vitamin A Dose 2" value="<?php echo $row['v20'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg20" placeholder="Date Given" value="<?php echo $row['dg20'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn20" placeholder="Date of Next Visit" value="<?php echo $row['dn20'];?>">
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm20" placeholder="Comment" ><?php echo $row['cm20'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
										
											<div class="col-md-3">
												
	                                            <div class="form-group">
	                                                 <label>Batch Number</label>
	                                                <input type="text" class="form-control" name="bnum21" placeholder="Batch Number" value="<?php echo $row['bnum21'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                 <label>Vaccine Measles 2</label>
	                                                <input type="text" class="form-control" name="v21" placeholder="Vaccine Measles 2" value="<?php echo $row['v21'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date Given</label>
	                                                <input type="date" class="form-control" name="dg21" placeholder="Date Given" value="<?php echo $row['dg21'];?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Date of Next Visit</label>
	                                                <input type="date" class="form-control" name="dn21" placeholder="Date of Next Visit" value="<?php echo $row['dn21'];?>">
	                                            </div>
	                                        </div>
											
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<label>Comment</label>
												<textarea class="form-control" name="cm21" placeholder="Comment" ><?php echo $row['cm21'];?></textarea>
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
									<?php } ?>
									<div class="clearTwenty"></div>
									
									<div class="clearTwenty"></div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Update Antenatal</button>
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

		a('#change_ante').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			var id = "<?php echo $id; ?>";
			a.ajax({
				type: "POST",
				data: a('#change_ante').serialize()  + "&id=" + id + '&ins=editAnte',
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