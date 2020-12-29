<?php 
	ob_start();
	session_start();
	$pageTitle = "Edit Expense";
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
                                <h4 class="title">Daily Expense</h4>
                            </div>

                            <div class="content">
                                <form id="duty">
									<?php
										$noarray = database::getInstance()->select_from_where('daily_expense','id',$id);
										while ($row = $noarray->fetch(PDO::FETCH_ASSOC)) {
										
									?>
									<div class="col-md-12">
										<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Date</label>
	                                                <input type="date" class="form-control" name="date_a" placeholder="Date" value="<?php echo $row['exp_date'];?>" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Code</label>
	                                                <input type="text" class="form-control" name="code" placeholder="Code" value="<?php echo $row['code'];?>" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Description</label>
	                                                <input type="text" class="form-control" name="description" placeholder="Description" value="<?php echo $row['description'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Approver</label>
	                                                <input type="text" class="form-control" name="approver" placeholder="Approver" value="<?php echo $row['approver'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Recipient</label>
	                                                <input type="text" class="form-control" name="recipient" placeholder="Recipient" value="<?php echo $row['recipient'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Quantity</label>
	                                                <input type="text" class="form-control" name="qty" placeholder="Quantity" value="<?php echo $row['qty'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Amount</label>
	                                                <input type="text" class="form-control" name="amt" placeholder="Amount" value="<?php echo $row['amt'];?>">
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
														<option value="<?php echo $row['cash_bank'];?>"><?php echo $row['cash_bank'];?></option>
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
													<textarea class="form-control" name="comment"><?php echo $row['comment'];?></textarea>
	                                            </div>
	                                        </div>
										</div>
									</div>
									<?php } ?>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Udate Expense</button>
									<button type="reset" class="btn btn-danger btn-fill pull-left">Clear</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        
						</div>
                    </div>
                 </div>
<div class="clearfix"></div>
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

		a('#duty').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			var id = "<?php echo $id; ?>";
			a.ajax({
				type: "POST",
				data: a('#duty').serialize()  + "&id=" + id + '&ins=editExp',
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