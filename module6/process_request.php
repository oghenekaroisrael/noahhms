<?php 
	ob_start();
	session_start();
	$pageTitle = "Process Prescription";
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
	$value= $_GET['id'];
	if(isset($_GET['s']) AND !empty($_GET['s'])) {
		$seed = $_GET['s'];
		?>
		<script>
				$(document).ready(function() {
					rem(<?php echo $seed ?>);
				});
		</script>
		<?php
	}elseif(isset($_GET['s']) AND empty($_GET['s'])) {
		$seed = $_GET['s'];
		?>
		<script>
				$(document).ready(function() {
					norem(<?php echo $seed ?>);
				});
		</script>
		<?php
	}

?>
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
                                <h4 class="title"><?php if (isset($_GET['i']) AND $_GET['i'] = 1) {echo "Processed";}else{echo "Process";} ?> Request</h4>
                            </div>
                            <div class="content">

                            	<div class="content table-responsive table-full-width" style="height: 245px;overflow-y: scroll;">
	                                <table id="pro"class="table table-hover table-striped">
	                                    <thead>
											<th>#</th>
											<th>Requesting Staff</th>
	                                    	<th>Drug Name</th>
	                                    	<th>Quantity Needed</th>
	                                    	<th>Dispensed Stock Barcode</th>
	                                    	<th>Dispensed Stock Batch Code</th>
	                                    	<th>Date</th>
	                                    </thead>
	                                    <tbody>
										  <?php
												$count = 1; 
												$notarray = database::getInstance()->select_from_where2('pharm_requests','request_id',$value);
												foreach($notarray as $row):
												$id = $row['request_id'];
												$p_id = $row['staff_id'];
												$qty = $row['quantity_needed'];
												$batch = $row['batch'];
												$presc = $row['warehouse_stock_id'];
												$approved = $row['request_status'];
												$given = $row['status'];
												$bcode = $row['Stock_number'];
												$ddate = $row['pdate_added'];
											?>
	                                        <tr style="border-left-width: 10px;border-left-color: <?php if ($given == 1) {echo "green";}else{echo "orange";} ?>;border-left-style: solid;">
	                                        	<td><?php echo $count++;?></td>
	                                        	<td>
	                                        		<?php 
                                        			$userDetails = Database::getInstance()->select_from_where('staff', 'user_id', $p_id);
													foreach($userDetails as $qw):
														echo ucwords($qw['last_name']." ".$qw['first_name']);
														
													endforeach; 
													
                                        		?>
	                                        	</td>
	                                        	<td>
	                                        		<?php 
                                        			$userDetails = Database::getInstance()->select_from_where('warehouse_stock', 'id', $presc);
													foreach($userDetails as $qw):
														echo ucwords($qw['name']);
														
													endforeach; 
													
                                        		?>
	                                        	</td>
	                                        	<td><?php echo $qty; ?></td>
												<td><?php echo $bcode; ?></td>
												<td><?php echo $batch; ?></td>
												<td><?php echo $ddate; ?></td>
	                                        </tr>
											
											
						 
											<?php endforeach;?>
	                                    </tbody>
	                                 <thead>
	                                 	<th>#</th>
											<th>Requesting Staff</th>
	                                    	<th>Drug Name</th>
	                                    	<th>Quantity Needed</th>
	                                    	<th>Dispensed Stock Barcode</th>
	                                    	<th>Dispensed Stock Batch Code</th>
	                                    	<th>Date</th>
	                                    </thead>
									</table>

	                            </div>

	                            <div class="clearTwenty"></div>

	                            <div>
	                            	<div class="header">
	                                <h4 class="title">Scan Items Being Dispensed</h4>
	                            </div>
								<div id="sections">
									<div class="section">
										<fieldset>

                                <form id="processPharm" autocomplete="off">
										<div class="row">
												<div class="col-lg-3"></div>
										<div class="col-lg-6">
		                            		<div class="row">
		                                       <div class="col-md-12">
		                                            <div class="form-group">
		                                                <label>Scan Barcode </label>
		                                                <input type="text" class="form-control" id="proName" placeholder="Scan Barcode " onkeydown="return saler_next(this.value,<?php echo $value;?>)" autofocus <?php if($approved == 1 AND $given ==1) {echo "disabled";}else{echo "";} ?>>
		                                            </div>
		                                        </div>
											</div>
										</div>
										<div class="col-lg-3">
											
										</div>
										</div>
                                </form>
										<div class="row">
											<div class="col-lg-12">
												<div id="search">
											</div>
											</div>
										</div>
										</fieldset>
									</div><!--end class section-->	
                                </div><!--end id-->
	                            </div>
                                <div class="clearfix"></div>

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
	/*
	window.onload = function() {
		var input = document.getElementById('proName').focus();
	}*/
//get the title of ecurrency choosen
	//Lets ajaxify this part on keyup
	var f=jQuery .noConflict();
	f(document).ready(function(){
	});
	function saler_next(str,id){

if(str.length == 0){
document.getElementById("search").style.display="none";
document.getElementById("search").innerHTML=xmlhttp.responseText;
document.getElementById("search").style.border="0px";

}
var xmlhttp;
if(window.XMLHttpRequest){

xmlhttp = new XMLHttpRequest();

}
else{
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

}
xmlhttp.onreadystatechange=function(){
if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
	
if(xmlhttp.responseText.length == 0){
document.getElementById("search").style.display="none";
document.getElementById("search").innerHTML=xmlhttp.responseText;
document.getElementById("search").style.border="0px";
}else{
document.getElementById("search").style.display="block";
document.getElementById("search").innerHTML=xmlhttp.responseText;
}

}



}
var url = "spot.php?q=" + str +"&p=" + id;

xmlhttp.open("GET",url ,true);
xmlhttp.send();

}

	s(document).ready(function() {
		s('form').submit(function(e){
			var val = document.getElementById('proName').value;
			e.preventDefault();
			return saler_next(val,<?php echo $value;?>);
		})			
	})

	function rem(name){ 

        	s.notify({
            	icon: 'pe-7s-check',
            	message: "<b>"+name+"</b> HAs Been Added To Pharmacy's Stock"

            },{
                type: 'success',
                timer: 300000
            });

    	}

   function norem(){ 

        	s.notify({
            	icon: 'pe-7s-info',
            	message: "Item Could Not Be Added To Pharmacy's Stock"

            },{
                type: 'warning',
                timer: 300000
            });

    	}
</script>

