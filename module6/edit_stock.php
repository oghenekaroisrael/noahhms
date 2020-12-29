
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
                                    $use = $ow['s_usage'];
                            	?>
                            	<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>ERP ID</label>
                                                <input type="text" class="form-control" name="erp" placeholder="ERP ID"  value="<?php echo $ow['erp'];?>">
                                            </div>
                                        </div>
									</div>

                            	<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Drug Name</label>
                                                <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo $ow['name'];?>">
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Manufacturer's Name</label>
                                                <input type="text" class="form-control" name="mname" placeholder="Manufacturer's Name"  value="<?php echo $ow['manufacturer'];?>">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Generic Name</label>
                                                <input type="text" class="form-control" name="gname" placeholder="Generic Name"  value="<?php echo $ow['generic'];?>">
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Bar Code</label>
                                                <input type="text" class="form-control" name="stock_code" placeholder="Bar Code" value="<?php echo $ow['Stock_number']; ?>">
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Generic Category</label>
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
                                       <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Select A Unit</label>
                                                <select class="form-control" id="form" name="unit">
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
                                       <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-date-input" class="col-form-label">Manufactured Date</label>
                                                <input type="date" class="form-control" name="manufactured" placeholder="Manufacturing Date" id="example-date-input" value="<?php echo date('Y-m-d',strtotime($ow['manufactured']));?>">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-date-input" class="col-form-label">Expiring Date</label>
                                                <input type="date" class="form-control" name="expiring" placeholder="Expiring Date" id="example-date-input" value="<?php echo date('Y-m-d',strtotime($ow['expiring']));?>">
                                            </div>
                                        </div>
									</div>
								<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Purchasing Price</label>
                                                <input type="text" class="form-control" name="cost" placeholder="Purchase Price"  value="<?php echo $ow['price'];?>">
											</div>
                                        </div>
									</div>
									
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Tab Per Pack</label>
                                                <input type="number" class="form-control" name="tabs" placeholder="Tabs Per Pack"  value="<?php echo $ow['tabs'];?>">
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Packs Per Carton</label>
                                                <input type="number" class="form-control" name="packs" placeholder="Packs Per Carton"  value="<?php echo $ow['packs'];?>">
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Cartons Bought</label>
                                                <input type="number" class="form-control" name="cartons" placeholder="Cartons Bought"  value="<?php echo $ow['cartons'];?>">
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Batch Number</label>
                                                <input type="text" class="form-control" name="batch" placeholder="Batch Number"  value="<?php echo $ow['batch'];?>">
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Usage</label>
                                                <select class="form-control" id="usage" name="usage">
                                                    <?php
                                                        $userDetails = Database::getInstance()->select_from_where('pharm_usage','id',$use);
                                                        foreach($userDetails as $row):
                                                            $id2 = $row['id'];  
                                                            $name2 = $row['usage_name']; 

                                                        endforeach;

                                                    ?>
                                                    <option value="<?php echo $id2;?>"><?php echo $name2;?></option>
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
				data: s('#ediSt').serialize() + "&id=" + id + "&ins=editStock",
				url: "../func/edit.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					s("#get_result").html(res).fadeIn("slow");
				}
			});
		})			
	})			
</script>

