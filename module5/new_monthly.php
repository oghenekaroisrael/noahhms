<?php 
	ob_start();
	session_start();
	$pageTitle = "New Monthly Summary";
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
                                <h4 class="title">Monthly Summary</h4>
                            </div>

                            <div class="content">
                                <form id="mo_bal">
									<?php
										$userDetails = Database::getInstance()->select('accounts');
										foreach($userDetails as $row):
											$ictd = $row['id'];
											$patient_id = $row['patient_id'];	
									
											$userDetails = Database::getInstance()->select_from_where2('patients', 'id', $patient_id );
											foreach($userDetails as $ow):
												$card_type = $ow['card_type'];
												
												$userDetails = Database::getInstance()->select_from_where2('card_types', 'id', $card_type );
												foreach($userDetails as $ow):
													
													echo $card_name = $ow['name'];
											endforeach;
									
									 endforeach; 
									endforeach; ?>
									
									
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Date</label>
	                                                <input type="date" class="form-control" name="c_date" placeholder="Date" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Particulars</label>
	                                                <input type="text" class="form-control" name="description" placeholder="Description" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Ammount</label>
	                                                <input type="text" class="form-control" name="amt" placeholder="Amount" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Cash/Bank</label>
													<select class="form-control" name="cash">
														<option value="">Choose</option>
														<option value="Cash">Cash</option>
														<option value="Bank">Bank</option>
													</select>
	                                              
	                                            </div>
	                                        </div>
										</div>
									</div>
	
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Comment</label>
													<textarea class="form-control" name="comment"></textarea>
	                                            </div>
	                                        </div>
										</div>
									</div>
									
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Add Expense</button>
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
		a('#c_bal').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			
			a.ajax({
				type: "POST",
				data: a('#c_bal').serialize() + '&ins=newCBal',
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

