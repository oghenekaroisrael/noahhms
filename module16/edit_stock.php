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
                            $noarray = database::getInstance()->select_from_where('caf_stock','id',$value);
                            while ($ow = $noarray->fetch(PDO::FETCH_ASSOC)) {
                            		$u_id = $ow['units'];
                            	?>
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo $ow['name']; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Stock Number</label>
                                                <input type="text" class="form-control" name="stock_code" placeholder="Barcode" value="<?php echo $ow['Stock_number']; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Select A Unit</label>
                                                <select class="form-control" id="form" name="unit">
                                                    <?php
                                                        $userDetails = Database::getInstance()->select_from_where('caf_units','id',$u_id);
                                                        foreach($userDetails as $row):
                                                            $id2 = $row['id'];  
                                                            $name2 = $row['unit_name']; 

                                                        endforeach;

                                                    ?>
                                                    <option value="<?php echo $id2;?>"><?php echo $name2;?></option>
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
                                    
                                    <div class="row">
                                       <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-date-input" class="col-form-label">Manufacturing Date</label>
                                                <input type="date" class="form-control" name="manufactured" placeholder="Manufacturing Date" id="example-date-input"  value="<?php echo date('Y-m-d',$ow['manufactured']); ?>">
                                            </div>
                                        </div>
                                    
                                       <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-date-input" class="col-form-label">Expiring Date</label>
                                                <input type="date" id="example-date-input" class="form-control" name="expiring" placeholder="Expiring Date" value="<?php echo date('Y-m-d',$ow['expiring']); ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                       <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Cost Price</label>
                                                <input type="text" class="form-control" name="cost" placeholder="Cost Price" value="<?php echo $ow['cost_price']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Selling Price</label>
                                                <input type="text" class="form-control" name="price" placeholder="Selling Price" value="<?php echo $ow['price']; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Quantity</label>
                                                <input type="number" class="form-control" name="quantity" placeholder="Quantity" value="<?php echo $ow['quantity']; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Batch Number</label>
                                                <input type="text" class="form-control" name="batch" placeholder="Batch Number" value="<?php echo $ow['batch']; ?>">
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
				data: s('#ediSt').serialize() + "&id=" + id + "&ins=editCStock",
				url: "../func/edit.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					s("#get_result").html(res).fadeIn("slow");
				}
			});
		})			
	})			
</script>

