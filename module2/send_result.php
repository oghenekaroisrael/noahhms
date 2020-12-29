<?php 
	ob_start();
	session_start();
	$pageTitle = "Case Note";
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
	$value = $_GET['id'];
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
                           
                            <?php
							       
                            		
							        $notarray =Database::getInstance()->select_from_where2('patient_appointment','id', $value);
										foreach($notarray as $row):
										$p_id = $row['patient_id'];
										$doc_id = $row['doctor_id'];
										$temp = $row['temperature'];
										$weight = $row['weight'];
										$bp = $row['blood_pressure'];
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
			                               <h4 class="text-center"><strong><?php echo $name;?></strong></h4>
										<p class="text-center">Reg No. <?php echo $reg;?></p>
			                            </div>
										

										<div class="clearTwenty"></div>
											<div class="col-md-12">
											<div class="row">
		                                       <div class="col-md-12">
		                                            <div class="form-group">
		                                                <p><strong>Age:</strong> <?php echo $age;?></p>
														<p><strong>Sex:</strong> <?php echo $sex;?></p>
														<p><strong>Blood Group:</strong> <?php echo $blood;?></p>

														
														<p><strong>Temperature:</strong> <?php echo $temp;?></p>
														<p><strong>Weight:</strong> <?php echo $weight;?></p>
														<p><strong>Blood Pressure:</strong> <?php echo $bp;?></p>
		                                            </div>
		                                        </div>
											</div>
										</div>
										

                            <div class="content">
                            	
                                <form id="labres">

                                	<div id="sections">
										
										<div class="section">
											<div class="itemWrap">
												<div class="clearTwenty"></div>

												<div class="col-md-4">
													<div class="row">
				                                       <div class="col-md-12">
				                                            <div class="form-group">
				                                                <label>Test</label>
				                                                <input class="form-control" type="text" name="test[]" id="test" placeholder="Add Test" autocomplete = "off" /> 
				                                            </div>
				                                        </div>
													</div>
												</div>

												<div class="col-md-4">
													<div class="row">
				                                       <div class="col-md-12">
				                                            <div class="form-group">
				                                                <label>Result</label>
				                                                <input class="form-control" type="text" name="result[]" id="result" placeholder="Add Result" autocomplete = "off" /> 
				                                            </div>
				                                        </div>
													</div>
												</div>

												<div class="col-md-4">
													<div class="row">
				                                       <div class="col-md-12">
				                                            <div class="form-group">
				                                                <label>Flag</label>
				                                                <input class="form-control" type="text" name="flag[]" id="flag" placeholder="Add Flag" autocomplete = "off" /> 
				                                            </div>
				                                        </div>
													</div>
												</div>

												<div class="col-md-4">
													<div class="row">
				                                       <div class="col-md-12">
				                                            <div class="form-group">
				                                                <label>Units</label>
				                                                <input class="form-control" type="text" name="units[]" id="units" placeholder="Add Units" autocomplete = "off" /> 
				                                            </div>
				                                        </div>
													</div>
												</div>

												<div class="col-md-4">
													<div class="row">
				                                       <div class="col-md-12">
				                                            <div class="form-group">
				                                                <label>Reference</label>
				                                                <input class="form-control" type="text" name="ref[]" id="ref" placeholder="Add Reference" autocomplete = "off" /> 
				                                            </div>
				                                        </div>
													</div>
												</div>

												<div class="col-md-4">
													<div class="row">
				                                       <div class="col-md-12">
				                                            <div class="form-group">
				                                                <label>Range</label>
				                                                <input class="form-control" type="text" name="range[]" id="range" placeholder="Add Range" autocomplete = "off" /> 
				                                            </div>
				                                        </div>
													</div>
												</div>

												<p><a href="#" class='remove'><i class="fas fa-times"></i></a></p>
											</div>				
									  	</div>	
									  			  
									</div>

									<p><a href="#" class='addsection'><i class="fas fa-plus"></i> Add More Results</a></p>
									
									<div class="clearTwenty"></div>
									
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Send</button>
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
		a('#labres').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			var app_id = "<?php echo $value; ?>";
			var doc_id = "<?php echo $doc_id; ?>";
			var p_id = "<?php echo $p_id; ?>";
			var tech_id = "<?php echo $user_id; ?>";
			a.ajax({
				type: "POST",
				data: a('#labres').serialize() + '&tech_id=' + tech_id + '&doc_id=' + doc_id + '&p_id=' + p_id + '&app_id=' + app_id + '&ins=labRes',
				url: "../func/verify.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					a("#get_result").html(res).fadeIn("slow");
					console.log(res);
				}
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


