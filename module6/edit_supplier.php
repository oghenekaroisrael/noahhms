<?php 
	ob_start();
	session_start();
	$pageTitle = "Edit Supplier";
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
                                <h4 class="title">Edit Supplier</h4>
                            </div>
                            <div class="content">
                                <form>
								 <?php
                            $noarray = database::getInstance()->select_from_where('pharm_suppliers','Supplier_ID',$value);
                            while ($ow = $noarray->fetch(PDO::FETCH_ASSOC)) {?>
								<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Supplier's Name</label>
                                                <input type="text" class="form-control" name="supplier_name" placeholder="Supplier's Name" value="<?php echo $ow['Supplier_Name'];?>">
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Supplier's Number</label>
                                                <input type="text" class="form-control" name="supplier_number" placeholder="Supplier's Number" value="<?php echo $ow['Supplier_Number'];?>">
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Supplier's Address</label>
                                                <input type="text" class="form-control" name="supplier_addr" placeholder="Supplier's Address" value="<?php echo $ow['Address'];?>">
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-6">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" class="form-control" name="city" placeholder="Supplier's City" value="<?php echo $ow['City'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <input type="text" class="form-control" name="country" placeholder="Supplier's Country" value="<?php echo $ow['Country'];?>">
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <input type="number" class="form-control" name="phone" placeholder="Supplier's Phone Number" value="<?php echo $ow['Phone_Number'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="email" class="form-control" name="email" placeholder="Supplier's Email" value="<?php echo $ow['Email'];?>">
                                            </div>
                                        </div>
									</div>

									<div class="row">
                                       <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Contact Person</label>
                                                <input type="text" class="form-control" name="person" placeholder="Contact Person" value="<?php echo $ow['Contact_Person'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Contact's Phone Number</label>
                                                <input type="number" class="form-control" name="cphone" placeholder="Contact's Phone Number" value="<?php echo $ow['Mobile_Number'];?>">
                                            </div>
                                        </div>
									</div>
									<div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Note</label>
                                                <textarea class="form-control" name="note"><?php echo $ow['Notes'];?></textarea>
                                            </div>
                                        </div>
									</div>
							<?php } ?>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Update Supplier</button>
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

 <div class="loader" id="load" style="display:none;">
</div>
<script>	
	var s=jQuery .noConflict();
	s(document).ready(function() {
		s('form').submit(function(e){
			var id = "<?php echo $value; ?>";
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			s.ajax({
				type: "POST",
				data: s('form').serialize() + "&id=" + id + "&ins=editSupplier",
				url: "../func/edit.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					s("#get_result").html(res).fadeIn("slow");
				}
			});
		})			
	})			
</script>

