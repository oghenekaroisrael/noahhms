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
                                <h4 class="title">New Stock Details</h4>
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
                                                <label>Select A Category</label>
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
									</div> 

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Select A Unit</label>
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
                                                <label>Selling Price</label>
                                                <input type="text" class="form-control" name="price" placeholder="Selling Price">
											</div>
                                        </div>
									</div>
									
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Stock</label>
                                                <input type="text" class="form-control" name="stock" placeholder="Stock" >
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

