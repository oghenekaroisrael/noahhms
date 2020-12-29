<?php 
	ob_start();
	session_start();
	$pageTitle = "Edit Balance";
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
                                <h4 class="title">Balance</h4>
                            </div>

                            <div class="content">
                                <form id="duty">
									<?php
										$noarray = database::getInstance()->select_from_where('credit_balance','id',$id);
										while ($row = $noarray->fetch(PDO::FETCH_ASSOC)) {
										
									?>
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Balance Type</label>
													<select class="form-control" name="type">
														<option value="<?php echo $row['bal_type'];?>"><?php echo $row['bal_type'];?></option>
														<option value="Credit">Credit</option>
														<option value="Debit">Debit</option>
													</select>
	                                              
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Date</label>
	                                                <input type="date" class="form-control" name="c_date" placeholder="Date" value="<?php echo $row['c_date'];?>" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Particulars</label>
	                                                <input type="text" class="form-control" name="description" placeholder="Description" value="<?php echo $row['particulars'];?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Ammount</label>
	                                                <input type="text" class="form-control" name="amt" placeholder="Amount" value="<?php echo $row['amount'];?>">
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
				data: a('#duty').serialize()  + "&id=" + id + '&ins=editBall',
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