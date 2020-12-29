<?php 
	ob_start();
	session_start();
	$pageTitle = "Update Income";
	// Include database class
	include_once '../inc/db.php';
	
	If(!isset($_SESSION['userSession'])){
		header("Location: ../index");
		exit;
	}
	elseif (isset($_SESSION['userSession'])){
		$user_id = $_SESSION['userSession'];
		$edit = $_GET['id'];
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
                                <h4 class="title">View/Edit Income</h4>
                            </div>

                            <div class="content">
                                <form id="exp">
                                	<?php
										$noarray1 = database::getInstance()->select_from_where('other_income','id',$edit);
										while ($row1 = $noarray1->fetch(PDO::FETCH_ASSOC)) {
											$staff = database::getInstance()->select_from_where('staff','user_id',$row1['added_by']);
											$type = database::getInstance()->get_name_from_id("name","income_types","id",$row1['type']);
											foreach ($staff as $staff_value) {
												$staff_nm = $staff_value['last_name']." ".$staff_value['first_name'];
											}
											$row_id = $row1['id'];
										
									?>
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Date</label>
	                                                <input type="date" class="form-control" name="date_a" placeholder="Date" value="<?php echo strftime('%Y-%m-%d',strtotime($row1['date_added']));?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Income Type</label>
	                                                <select name="type" class="form-control">
	                                                	<option value="<?php echo $row1['type'];?>"><?php echo $type;?></option>
	                                                	<option value="">Select A Type</option>
	                                                	<?php 
	                                                	$types = database::getInstance()->select('income_types');
	                                                	foreach ($types as $type) {
	                                                		echo "<option value='".$type['id']."'>".$type['name']."</option>";
	                                                	}
	                                                	?>
	                                                </select>
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Code</label>
	                                                <input type="text" class="form-control" name="code" placeholder="Code" value="<?php echo $row1['code']; ?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Description</label>
	                                                <input type="text" class="form-control" name="description" placeholder="Description" value="<?php echo $row1['description']; ?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Approver</label>
	                                                <input type="text" class="form-control" name="approver" placeholder="Approver" value="<?php echo $staff_nm; ?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Amount</label>
	                                                <input type="text" class="form-control" name="amt" placeholder="Amount" value="<?php echo $row1['amt']; ?>">
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
														<option value="<?php echo $row1['cash_bank'];?>"><?php echo $row1['cash_bank'];?></option>
														<option value="">Choose</option>
														<option value="Cash">Cash</option>
														<option value="Bank">Bank</option>
														<option value="Pos">POS</option>
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
													<textarea class="form-control" name="comment"><?php echo $row1['comment']; ?></textarea>
	                                            </div>
	                                        </div>
										</div>
									</div>
									<?php } ?>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Edit Income</button>
									<button type="reset" class="btn btn-danger btn-fill pull-left">Clear</button>
                                    <div class="clearfix"></div>

									<div style="margin-top: 20px;">
										<a class="btn btn-info btn-fill pull-left" href="oincome">Go Back</a>
									</div>
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
		a('#exp').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			
			a.ajax({
				type: "POST",
				data: a('#exp').serialize() + '&ins=editIncome&id=<?php echo $row_id; ?>',
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

