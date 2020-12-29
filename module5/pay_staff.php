<?php 
	ob_start();
	session_start();
	$pageTitle = "Staff";
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

<!----Income Total Calculation ---->
			<script>
function AddIncome(){
 	
  var a = parseInt(document.getElementById("I1").value);
  var b = parseInt(document.getElementById("I2").value);
  var c = parseInt(document.getElementById("I3").value);
  var d = parseInt(document.getElementById("I4").value);
  var e = parseInt(document.getElementById("I5").value);
  var f = parseInt(document.getElementById("I6").value);
  var g = parseInt(document.getElementById("I7").value);
  var h = parseInt(document.getElementById("I8").value);
  var i = parseInt(document.getElementById("I9").value);
 var x = a+b+c+d+e+f+g+h+i;
  document.getElementById("TI").value = x;

}

function AddDeductions(){
 	
  var a = parseInt(document.getElementById("D1").value);
  var b = parseInt(document.getElementById("D2").value);
  var c = parseInt(document.getElementById("D3").value);
  var d = parseInt(document.getElementById("D4").value);
  var e = parseInt(document.getElementById("D5").value);
  var f = parseInt(document.getElementById("D6").value);
  var g = parseInt(document.getElementById("D7").value);
  var h = parseInt(document.getElementById("D8").value);
  var i = parseInt(document.getElementById("D9").value);
 var x = a+b+c+d+e+f+g+h+i;
  document.getElementById("TDD").value = x;

}

document.getElementById('netpay').innerHTML = AddIncome() - AddDeductions();
</script>
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
                                <h4 class="title">Pay Staff</h4>
                            </div>
                            <div class="content">
                                <form id="staff">
									<div class="row">
                                       <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Select A Staff</label>
                                                <select class="form-control" id="user" name="staff">
													<option value="">Select Staff</option>
													<?php
														$userDetails = Database::getInstance()->select_from_ord1('staff','user_id','DESC');
														foreach($userDetails as $row):
															$id = $row['user_id'];
															$name = $row['last_name']." ".$row['first_name'];	
													?>
													<option value="<?php echo $id;?>"><?php echo $name;?></option>
													<?php endforeach; ?> 
												</select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                        	<div class="form-group">
                                                <label>Designation</label>
                                                <input type="text" class="form-control" name="designation" placeholder="Designation"><!--auto fill-->
                                            </div>
                                        </div>
									</div> 
									
									<div class="row">
										<div class="col-lg-1"></div>
										<div class="col-lg-5"><!-- Income -->
											<div class="header">
										<h4 class="title"><b>INCOME</b></h4>
									</div>
									
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Basic</label>
                                                <input type="text" class="form-control"  onkeyup="AddIncome()" name="basic" id="I1" placeholder="Basic" value="0">
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Housing</label>
                                                <input type="text" class="form-control"  onkeyup="AddIncome()" name="housing" id="I2" placeholder="Housing" value="0">
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Transport</label>
                                                <input type="text" class="form-control"  onkeyup="AddIncome()" name="transport" id="I3" placeholder="Transport" value="0">
                                            </div>
                                        </div>
									</div>
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Call Duty</label>
                                                <input type="text" class="form-control"  onkeyup="AddIncome()" name="cduty" id="I4" placeholder="Call Duty" value="0">
                                            </div>
                                        </div>
									</div>
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Hazard</label>
                                                <input type="text" class="form-control"  onkeyup="AddIncome()" name="hazard" id="I5" placeholder="Hazard" value="0">
                                            </div>
                                        </div>
									</div>
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Feeding</label>
                                                <input type="text" class="form-control"  onkeyup="AddIncome()" name="feeding" id="I6" placeholder="Feeding" value="0">
                                            </div>
                                        </div>
									</div>
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Medicals</label>
                                                <input type="text" class="form-control"  onkeyup="AddIncome()" name="medicals" id="I7" placeholder="Medicals" value="0">
                                            </div>
                                        </div>
									</div>
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Public Holiday</label>
                                                <input type="text" class="form-control"  onkeyup="AddIncome()" name="pholiday" id="I8" placeholder="Public Holiday" value="0">
                                            </div>
                                        </div>
									</div>
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Others</label>
                                                <input type="text" class="form-control"  onkeyup="AddIncome()" name="others" id="I9" placeholder="Others" value="0">
                                            </div>
                                        </div>
									</div>
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Total Income</label>
                                                <input type="text" class="form-control" name="total_income" id="TI"  placeholder="Total Income">
                                            </div>
                                        </div>
									</div>
										</div><!-- / Income -->
										<div class="col-lg-5"><!--Deductions -->
												<div class="header">
													<h4 class="title"><b>DEDUCTIONS</b></h4>
												</div>
									
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>P.A.Y.E</label>
                                                <input type="text" class="form-control" id="D1" onkeyup="AddDeductions()" name="paye" placeholder="P.A.Y.E" value="0">
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Pension (8% of BHT)</label>
                                                <input type="text" class="form-control" name="pension" id="D2" onkeyup="AddDeductions()" placeholder="Pension" value="0">
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Loan Repayment</label>
                                                <input type="text" class="form-control" name="loan" id="D3" onkeyup="AddDeductions()" placeholder="Loan Repayment" value="0">
                                            </div>
                                        </div>
									</div>
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Thrift</label>
                                                <input type="text" class="form-control" name="thrift" id="D4" onkeyup="AddDeductions()" placeholder="Thrift" value="0">
                                            </div>
                                        </div>
									</div>
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Salary Advance</label>
                                                <input type="text" class="form-control" name="advance" id="D5" onkeyup="AddDeductions()" placeholder="Salary Advance" value="0">
                                            </div>
                                        </div>
									</div>
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Daycare</label>
                                                <input type="text" class="form-control" name="daycare" id="D6" onkeyup="AddDeductions()" placeholder="Daycare" value="0">
                                            </div>
                                        </div>
									</div>
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Pharmacy</label>
                                                <input type="text" class="form-control" name="pharmacy" id="D7" onkeyup="AddDeductions()" placeholder="Pharmacy" value="0">
                                            </div>
                                        </div>
									</div>
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Welfare</label>
                                                <input type="text" class="form-control" name="welfare" id="D8" onkeyup="AddDeductions()" placeholder="Welfare" value="0">
                                            </div>
                                        </div>
									</div>
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Others</label>
                                                <input type="text" class="form-control" name="dothers" id="D9" onkeyup="AddDeductions()" placeholder="Others"  value="0">
                                            </div>
                                        </div>
									</div>
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Total Deductions</label>
                                                <input type="text" class="form-control" id="TDD" name="total_deductions"  placeholder="Total Deductions">
                                            </div>
                                        </div>
									</div>
										</div><!-- /Deductions -->

										<div class="col-lg-1"></div>
									</div>
									<div class="row">
										<div class="col-lg-10">
											<div class="header">
													<h4 class="title pull-right">NET PAY: <font id="netpay"> 
                            <script>
                              document.getElementById("netpay").innerHTML = parseInt(document.getElementById("TI").value) - parseInt(document.getElementById("TDD").value);
                            </script>
                          </font></h4>
												</div>
										</div>
										<div class="col-lg-2"></div>
									</div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Pay Staff</button>
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
		a('#staff').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			a.ajax({
				type: "POST",
				data: a('#staff').serialize() + '&ins=payStaff',
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

