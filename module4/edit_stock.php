
<?php 
	ob_start();
	session_start();
	$pageTitle = "Edit Stock";
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
                                <h4 class="title">Edit Stock</h4>
                            </div>
                            <div class="content">
                                <form id="ediSt">
								 <?php
                            $noarray = database::getInstance()->select_from_where('pharm_stock','id',$value);
                            while ($ow = $noarray->fetch(PDO::FETCH_ASSOC)) {
                            		$u_id = $ow['units'];
                            		$ca_id = $ow['category'];
                            		$usage = $ow['s_usage'];
                            	?>
                            	<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo $ow['name'];?>">
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Select A Category</label>
                                                <select class="form-control" id="cat" name="cat">
													<?php
														$userDetails = Database::getInstance()->select_from_where('pharm_category','id',$ca_id);
														foreach($userDetails as $row):
															$cate_id = $row['id'];	
															$catName = $row['cat_name'];	

														endforeach;

													?>
													<option value="<?php echo $cate_id;?>"><?php echo $catName;?></option>
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
													<?php
														$userDetails = Database::getInstance()->select_from_where('pharm_units','id',$u_id);
														foreach($userDetails as $row):
															$id2 = $row['id'];	
															$name2 = $row['unit_name'];	

														endforeach;

													?>
													<option value="<?php echo $id2;?>"><?php echo $name2;?></option>
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
                                                <label>Select A Type</label>
                                                <select class="form-control" id="usage" name="usage">
                                                	<option disabled="disabled">Select A Type</option>
													<?php
														if ($usage == 1) {
															?>
															<option value="1">Non Consumable</option>
															<?php
														}else if($usage == 2){
															?>
															<option value="2">Consumable</option>
															<?php
														}

													?>
													<option value="1">Non Consumable</option>
													<option value="2">Consumable</option>
												</select>
                                            </div>
                                        </div>
									</div> 

								<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Purchasing Price</label>
                                                <input type="text" class="form-control" name="cost" placeholder="Purchasing Price" value="<?php echo $ow['cost_price'];?>">
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Selling Price</label>
                                                <input type="text" class="form-control" name="price" placeholder="Selling Price" value="<?php echo $ow['price'];?>">
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Stock: </label>
                                                <strong><?php echo $ow['stock'];?></strong>
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
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			s.ajax({
				type: "POST",
				data: s('#ediSt').serialize() + "&id=" + id + "&ins=editStock1",
				url: "../func/edit.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					s("#get_result").html(res).fadeIn("slow");
				}
			});
		})			
	})			
</script>

