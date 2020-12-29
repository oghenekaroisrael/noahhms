
<?php 
	ob_start();
	session_start();
	$pageTitle = "Return Drug";
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
	$value= $_GET['b'];
	$value2 = $_GET['a'];

?>
<!----Quantity dispense Calculation>  ---->
			<script>
function myFunction() {
 	
  var y = parseInt(document.getElementById("return").value);
  var z = parseInt(document.getElementById("quantity").value);
  if (y>z) {
  	window.alert('Returns cannot Be More Than Quantity Dispensed');
  	document.getElementById("new").value = 0;
  }
 var x= (z-y);
 



  document.getElementById("new").value = x;

}
</script>
<style type="text/css">
	#return, #quantity, #new{
		width: 100px;
	}
</style>
 <script src="JsBarcode.all.min.js"></script>
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
                                <h4 class="title"><?php if (isset($_GET['i']) AND $_GET['i'] = 1) {echo "Returned";}else{echo "Return";} ?> Stock</h4>
                            </div>
                            <div class="content">

                            	<div class="content table-responsive table-full-width" style="height: 245px;overflow-y: scroll;">
	                                <table id="pro"class="table table-hover table-striped">
	                                    <thead>
											<th>#</th>
	                                    	<th>Staff</th>
	                                    	<th>Drug Name</th>
	                                    	<th>Quantity To Dispensed</th>
	                                    	<th>Returning</th>
	                                    	<th>Quantity Collected / Used</th>
	                                    	<th>Batch Code Given</th>
	                                    	<th>Barcode Given</th>
	                                    	<th>Returned Date</th>
	                                    	<th>Action</th>
	                                    </thead>
	                                    <tbody>
										  <?php
												$count = 1; 
												$notarray = database::getInstance()->select_from_where2('pharm_requests','request_id',$value);
												foreach($notarray as $row):
												$p_id = $row['staff_id'];
												$wh = $row['warehouse_stock_id'];
												$quantity = $row['quantity_needed'];
												$presc = $row['pharm_stock_id'];
												$given = $row['rstatus'];
												$bcode = $row['Stock_number'];
												$batch = $row['batch'];
												$rdate = $row['rdate'];
											?>
											<form method="POST" action="update.php?id=<?php echo $value; ?>&b=<?php echo $value2; ?>">
	                                        <tr style="border-left-width: 10px;border-left-color: <?php if ($given == 1) {echo "green";}else{echo "orange";} ?>;border-left-style: solid;">
	                                        	<td><?php echo $count++;?></td>
	                                        	
	                                        	<td>
	                                        		<?php 
                                        			$userDetails = Database::getInstance()->select_from_where('staffs_login', 'id', $p_id);
													foreach($userDetails as $qw):
														echo ucwords($qw['last_name']." ".$qw['first_name']);
														
													endforeach; 
													
                                        		?>
	                                        	</td>

	                                        	<td>
	                                        		<?php 
                                        			$userDetails = Database::getInstance()->select_from_where('warehouse_stock', 'id', $wh);
													foreach($userDetails as $qw):
														echo ucwords($qw['name']);
														
													endforeach; 
													
                                        		?>
	                                        	</td>
	                                        	
	                                        	<td width="5%"><input type="number" disabled id="quantity" class="form-control" onkeyup="myFunction()" value="<?php if (!empty($quantity)) {echo $quantity;}else{echo "0";} ?>">
												</td>
												<td width="5%"><input type="number" name="return" id="return" class="form-control" value="0" onkeyup="myFunction()" <?php if ($given == 1){echo "disabled";}?>></td>
												<td width="10%"><input type="number" name="new" id="new" disabled class="form-control" value="0"  onkeyup="myFunction()"></td></td>	 
												<td><?php echo $batch;?></td> 
												<td>
													<?php echo $bcode; ?>
												</td>
												<td>
													<?php echo $rdate; ?>
												</td>
												<td><button type="submit" class="btn btn-info">Return</button></td>           	
	                                        </tr>
											</form>
											
						 
											<?php endforeach;?>
	                                    </tbody>
	                                 <thead>
											<th>#</th>
	                                    	<th>Staff</th>
	                                    	<th>Drug Name</th>
	                                    	<th>Quantity To Dispensed</th>
	                                    	<th>Returning</th>
	                                    	<th>Quantity Collected / Used</th>
	                                    	<th>Batch Code Given</th>
	                                    	<th>Barcode Given</th>
	                                    	<th>Returned Date</th>
	                                    	<th>Action</th>
	                                    </thead>
									</table>
									</div>

	                            <div class="clearTwenty"></div>
                            </div>
                        
						</div>
                    </div>
                 </div>

				<div id="get_result"></div>
				<div id="error"></div>
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
	//define template
	var template = a('#sections .section:first').clone();

	//define counter
	var sectionsCount = 1;

	//add new section
	a('body').on('click', '.addsection', function() {

		//increment
		sectionsCount++;

		//loop through each input
		var section = template.clone().find(':input').each(function(){
				
			//set id to store the updated section number
			var newId = this.id + sectionsCount;

			//update for label
			a(this).prev().attr('for', newId);

			//update id
			this.id = newId;
		}).end()

		//inject new section
		.appendTo('#sections');
		return false;
	});

</script>

<script type="text/javascript">
	/*
	window.onload = function() {
		var input = document.getElementById('proName').focus();
	}*/
//get the title of ecurrency choosen
	//Lets ajaxify this part on keyup
	var f=jQuery .noConflict();
	f(document).ready(function(){
		
				
	})
</script>

