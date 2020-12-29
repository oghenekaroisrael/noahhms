
<?php 
	ob_start();
	session_start();
	$pageTitle = "Update Stock";
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
	$value= $_GET['edit'];
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
                                <h4 class="title">Update Stock</h4>
                            </div>
                            <div class="content">
                                <form id="ediSt">
								 <?php
                            $noarray = database::getInstance()->select_from_where('pharm_stock','id',$value);
                            while ($ow = $noarray->fetch(PDO::FETCH_ASSOC)) {
                            		$u_id = $ow['units'];
                            		$ca_id = $ow['category'];
                            	?>
                            	<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Name: <?php echo $ow['name'];?></label>
                                            </div>
                                        </div>
									</div>

								<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                            	<?php
														$userDetails = Database::getInstance()->select_from_where('pharm_units','id',$u_id);
														foreach($userDetails as $row):
															$id2 = $row['id'];	
															$name2 = $row['unit_name'];	

														endforeach;

													?>
                                                <label>Unit: <?php echo $name2;?></label>
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control" name="status">
                                                	<option value="1">Damaged</option>
                                                	<option value="2">Expired</option>
                                                </select>
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Quantity</label>
                                                <input type="text" class="form-control" name="qty" placeholder="Stock Quantity">
                                            </div>
                                        </div>
									</div>
									
							<?php } ?>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Update Stock</button>
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
<script>	
	var s=jQuery .noConflict();
	s(document).ready(function() {
		s('#ediSt').submit(function(e){
			var id = "<?php echo $value; ?>";
			var staff = "<?php echo $user_id; ?>"
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			s.ajax({
				type: "POST",
				data: s('#ediSt').serialize() + "&id=" + id +"&staff="+staff + "&ins=UpdateStock",
				url: "../func/edit.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					s("#get_result").html(res).fadeIn("slow");
				}
			});
		})			
	})			
</script>

