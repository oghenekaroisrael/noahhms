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
                                                <label>ERP ID</label>
                                                <input type="text" class="form-control" name="erp" placeholder="ERP ID" >
                                            </div>
                                        </div>
									</div>
                                     <div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Drug Name</label>
                                                <input type="text" class="form-control" name="name" placeholder="Name" >
                                            </div>
                                        </div>
									</div>

									 <div class="row">
                                       <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Manufacturer's Name</label>
                                                <input type="text" class="form-control" name="mname" placeholder="Manufacturer's Name" >
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Generic Name</label>
                                                <input type="text" class="form-control" name="gname" placeholder="Generic Name" >
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Bar Code</label>
                                                <input type="text" class="form-control" name="stock_code" placeholder="Bar Code" >
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Generic Category</label>
                                                <select class="form-control" id="cat" name="cat">
													<option value="">Choose Category</option>
													<?php
														$userDetails = Database::getInstance()->select('pharm_category');
														foreach($userDetails as $row):
															$id = $row['id'];
															$name = $row['cat_name'];	
													?>
													<option value="<?php echo $id;?>"><?php echo $name;?></option>
													<?php endforeach; ?>
												</select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Generic Form</label>
                                                <select class="form-control" id="form" name="form">
													<option value="">Choose Form</option>
													<?php
														$userDetails = Database::getInstance()->select('pharm_form');
														foreach($userDetails as $row):
															$id = $row['id'];
															$name = $row['form_name'];	
													?>
													<option value="<?php echo $id;?>"><?php echo $name;?></option>
													<?php endforeach; ?>
												</select>
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
														$userDetails = Database::getInstance()->select('pharm_units');
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
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Purchasing Price</label>
                                                <input type="text" class="form-control" name="cost" placeholder="Purchase Price">
											</div>
                                        </div>
									</div>
									
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Tab Per Pack</label>
                                                <input type="number" class="form-control" name="tabs" placeholder="Tabs Per Pack" >
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Packs Per Carton</label>
                                                <input type="number" class="form-control" name="packs" placeholder="Packs Per Carton" >
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Cartons Bought</label>
                                                <input type="number" class="form-control" name="cartons" placeholder="Cartons Bought" >
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

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Select Usage</label>
                                                <select class="form-control" id="usage" name="usage">
													<option value="">Choose Usage</option>
													<?php
														$userDetails = Database::getInstance()->select('pharm_usage');
														foreach($userDetails as $row):
															$id = $row['id'];
															$name = $row['usage_name'];	
													?>
													<option value="<?php echo $id;?>"><?php echo $name;?></option>
													<?php endforeach; ?>
												</select>
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
				data: a('#newSt').serialize() + '&ins=newStock',
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

