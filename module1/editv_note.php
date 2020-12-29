<?php 
	ob_start();
	session_start();
	$pageTitle = "Update Visitor's Log";
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
	$db = mysqli_connect("localhost","root","","noahhms");
	$value = $_GET['edit'];
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
                                <h4 class="title">Update Visitor's Log</h4>
                            </div>
                            	<?php 
                            	$data = database::getInstance()->select_from_where("visitors_log","id",$value); 
                            	foreach ($data as $row) {
                            	?>
                            <div class="content">
                                <form id="appt">
									<div class="col-md-5">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
													<label>Visitor's Name</label>
													<input type="text" name="vname" class="form-control" placeholder="Visitor's Name" value="<?php echo $row['name']; ?>">
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-4">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
													<label>Visitor's Tel</label>
													<input type="tel" name="vtel" class="form-control" placeholder="Visitor's Tel" value="<?php echo $row['tel']; ?>">
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
													<label>Sex</label>
													<select class="form-control" name="vsex">
														<option disabled selected>Select</option>
														<option value="Male">Male</option>
														<option value="Female">Female</option>
													</select>
	                                            </div>
	                                        </div>
										</div>
									</div>

										<div class="col-md-6">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
												<label>Visitor's Address</label>
												<input type="text" name="vaddress" class="form-control" placeholder="Visitor's Address" value="<?php echo $row['address']; ?>">
												</div>
											</div>
										</div>
									</div>



                               <div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                
													<label>staff</label>
												
													<p class="toggle">staff</p>
						
														
													<div class="toggleDrop">
														<input id="myInput" onkeyup="filterFunction()" placeholder ="Filter Your Client" />
													
														<div id="myDropdown" class="chooseList">
															<?php
																$userDetails = Database::getInstance()->select("staff");
																foreach($userDetails as $row):
																	$c_id = $row['user_id'];
																	$last = $row['last_name'];
																	$first = $row['first_name'];
																		
																	
																	$name = $last." ".$first;
																
															?>
															<p href="#" id="<?php echo $c_id;?>"><?php echo $name;?></p>
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

								

									<div class="col-md-6">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
												<label>Reason For Visiting</label>
												<textarea name="vreason" class="form-control" style="height: 100px; font-size: 18px; text-align: left;"><?php echo $row['reason']; ?></textarea>
												</div>
											</div>
										</div>
									</div>

									<div class="clearfix"></div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Edit Log</button>
									<button type="reset" class="btn btn-danger btn-fill pull-left">Clear</button>
                                    <div class="clearfix"></div>
                                	<?php  } ?>
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
		var s_id; //to make it accessible
		a(document).ready(function(){
			a(".chooseList p").click(function(){
				var text = a(this).text();
				s_id = a(this).attr('id');
				a(".toggle").html(text); //display teh text of the id in the textbox i.e the nam eof teh client
				a( ".toggleDrop" ).hide(); //removes drop down on click	
			});


		a('#appt').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			
			a.ajax({
				type: "POST",
				data: a('#appt').serialize() + '&s_id=' + s_id + '&ins=editLog&user=<?php echo $user_id; ?>&edit=<?php echo $value; ?>',
				url: "../func/edit.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					if (res == "Done") {
						 console.log(res);
							window.location = "Visitor";
					}else{
						a("#get_result").html(res).fadeIn("slow");
					}
				}
			});
        });
    })
});
</script>

