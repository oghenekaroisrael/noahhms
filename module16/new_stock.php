<?php 
	ob_start();
	session_start();
	$pageTitle = "New Stock";
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
                                <h4 class="title">Add New Stock</h4>
                            </div>
                            <div class="content">
                                <form id="newSt">
                                     <div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="name" placeholder="Name" >
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Stock Number</label>
                                                <input type="text" class="form-control" name="stock_code" placeholder="Barcode" >
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Stock Unit Of Measurement</label>
                                                <select class="form-control" id="unit" name="unit">
													<option value="">Choose Unit</option>
													<?php
														$userDetails = Database::getInstance()->select('caf_units');
														foreach($userDetails as $row):
															$id = $row['id'];
															$name = $row['unit_name'];	
													?>
													<option value="<?php echo $id;?>"><?php echo $name;?></option>
													<?php endforeach; ?>
												</select>
                                            </div>
                                        </div>
									</div> 
									
									<div class="row">
                                       <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-date-input" class="col-form-label">Manufacturing Date</label>
                                                <input type="date" class="form-control" name="manufactured" placeholder="Manufacturing Date" id="example-date-input">
											</div>
                                        </div>
									
                                       <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-date-input" class="col-form-label">Expiring Date</label>
                                                <input type="date" id="example-date-input" class="form-control" name="expiring" placeholder="Expiring Date">
											</div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Cost Price</label>
                                                <input type="text" class="form-control" name="cost" placeholder="Cost Price">
											</div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Selling Price</label>
                                                <input type="text" class="form-control" name="price" placeholder="Selling Price">
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Quantity</label>
                                                <input type="number" class="form-control" name="quantity" placeholder="Quantity" >
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Batch Number</label>
                                                <input type="text" class="form-control" name="batch" placeholder="Batch Number" >
                                            </div>
                                        </div>
									</div>

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Add Item</button>
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
		a('#newSt').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			a.ajax({
				type: "POST",
				data: a('#newSt').serialize() + '&ins=newCStock',
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

