<?php 
	ob_start();
	session_start();
	$pageTitle = "Edit Tax";
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
                                <h4 class="title">Update Tax</h4>
                            </div>

                            <div class="content">
                                <form id="exp">
									<?php
										$noarray = database::getInstance()->select_from_where('taxes','id',$id);
										while ($row = $noarray->fetch(PDO::FETCH_ASSOC)) {
										
									?>
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Tax Name</label>
	                                                <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>" placeholder="Tax Title" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Amount</label>
	                                                <input type="number" class="form-control" name="percentage" value="<?php echo $row['percentage'];?>" placeholder="Percentage" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Status</label>
													<select class="form-control" name="status">
														<option value="<?php echo $row['status'];?>"><?php if($row['status'] == 1){echo "Active";}else{echo "Inactive";}?></option>
														<option value="1">Active</option>
														<option value="0">Inactive</option>
													</select>
	                                              
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									
									<?php } ?>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Update Tax</button>
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

		a('#exp').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			var id = "<?php echo $id; ?>";
			a.ajax({
				type: "POST",
				data: a('#exp').serialize()  + "&id=" + id +'&val=<?php echo $user_id; ?>'+'&ins=editTax',
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

