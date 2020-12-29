<meta http-equiv="refresh" content="3000">
<?php 
	ob_start();
	session_start();
	$pageTitle = "New Admin Stock";
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
                                <h4 class="title">New Admin Stock</h4>
                            </div>
                            <div class="content">
                                <form id="unit">
                                     <div class="row">
									 
									 <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Patient</label>
                                                 <select class="form-control" name="patient">
													<option value="">select Patient</option>
													<?php
														$userDeils = Database::getInstance()->select_from_ord('patients','id','DESC');
														foreach($userDeils as $gow):
															$id = $gow['id'];
															$name = $gow['first_name'].' '.$gow['middle_name'].' '.$gow['surname'];	
													?>
													<option value="<?php echo $id;?>"><?php echo $name;?></option>
													<?php endforeach; ?>
												</select>
                                            </div>
                                        </div>
										
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Stock</label>
                                                 <select class="form-control" name="stock">
													<option value="">select Stock</option>
													<?php
														$userDetails = Database::getInstance()->select_from_ord('pharm_stock','name','ASC');
														foreach($userDetails as $row):
															$id = $row['id'];
															$name = $row['name'];	
													?>
													<option value="<?php echo $id;?>"><?php echo $name;?></option>
													<?php endforeach; ?>
												</select>
                                            </div>
                                        </div>
										
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
                                                <label>Taken By</label>
                                                <input type="text" class="form-control" name="taken" placeholder="Taken By" >
                                            </div>
                                        </div>
									</div>

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Remove Stock</button>
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
		a('#unit').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			a.ajax({
				type: "POST",
				data: a('#unit').serialize() + '&ins=newAdminStock',
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

