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
                                <h4 class="title"><?php if (isset($_GET['i']) AND $_GET['i'] = 1) {echo "Processed";}else{echo "Process";} ?> Prescription</h4>
                            </div>
                            <div class="content">

                            	<div class="content table-responsive table-full-width" style="height: 245px;overflow-y: scroll;">
	                                <table id="pro"class="table table-hover table-striped">
	                                    <thead>
											<th>#</th>
	                                    	<th>Prescriptions</th>
	                                    	<th>Tabs</th>
	                                    	<th>Dosages</th>
	                                    	<th>Durations (Days)</th>
	                                    	<th>Quantity To Dispense</th>
	                                    	<th>Instructions</th>
	                                    	<th>Stock Given</th>
	                                    </thead>
	                                    <tbody>
										  <?php
												$count = 1; 
												$notarray = database::getInstance()->select_from_where2('prescription','prescription_id',$value);
												foreach($notarray as $row):
												$app_id = $row['appointment_id'];
												$p_id = $row['patient_id'];
												$diag = $row['diagnosis'];
												$tabs = $row['tabs'];
												$stabs = $row['stabs'];
												$dos = $row['dosage'];
												if ($dos == 1) {
													$dosage = "DLY";
												}elseif ($dos == 2) {
													$dosage = "B.D";
												}elseif ($dos == 3) {
													$dosage = "T.D.S";
												}elseif ($dos ==4) {
													$dosage = "Q.D.S";
												}else{
													$dosage = "None Selected";
												}
												$sdos = $row['sdosage'];
												if ($sdos == 1) {
													$sdosage = "DLY";
												}elseif ($sdos == 2) {
													$sdosage = "B.D";
												}elseif ($sdos == 3) {
													$sdosage = "T.D.S";
												}elseif ($sdos ==4) {
													$sdosage = "Q.D.S";
												}else{
													$sdosage = "None Selected";
												}
												$dur = $row['duration'];
												$quantity = $row['quantity_dispense'];
												$sdur = $row['sduration'];
												$squantity = $row['squantity_dispense'];
												$instructions = $row['instruction'];
												$presc = $row['pharm_stock_id'];
												$given = $row['pres_status'];
												$bcode = $row['Stock_number'];
											?>
	                                        <tr style="border-left-width: 10px;border-left-color: <?php if ($given == 1) {echo "green";}else{echo "orange";} ?>;border-left-style: solid;">
	                                        	<td><?php echo $count++;?></td>
	                                        	
	                                        	<td>
	                                        		<?php 
                                        			$userDetails = Database::getInstance()->select_from_where('pharm_stock', 'id', $presc);
													foreach($userDetails as $qw):
														echo ucwords($qw['name']);
														
													endforeach; 
													
                                        		?>
	                                        	</td>
	                                        	<td><?php if (!empty($tabs)) {echo $tabs;}else{echo $stabs;} ?></td>
												<td><?php if (!empty($dosage)) {echo $dosage;}else{echo $sdosage;} ?></td>
												<td><?php if (!empty($dur)) {echo $dur;}else{echo $sdur;} ?></td>
												<td><?php if (!empty($quantity)) {echo $quantity;}else{echo $squantity;} ?></td>	 
												<td><?php echo $instructions;?></td> 
												<td>
													<?php echo $bcode; ?>
												</td>           	
	                                        </tr>
											
											
						 
											<?php endforeach;?>
	                                    </tbody>
	                                 <thead>
	                                        <th>#</th>
	                                    	<th>Prescriptions</th>
	                                    	<th>Tabs</th>
	                                    	<th>Dosages</th>
	                                    	<th>Durations (Days)</th>
	                                    	<th>Quantity TO Dispense</th>
	                                    	<th>Instructions</th>
	                                    	<th>Stock Given</th>
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
		                                                <input type="text" class="form-control" id="proName" placeholder="Scan Barcode " onkeydown="return saler_next(this.value,<?php echo $value;?>)" autofocus <?php if($given == 1) {echo "disabled";}else{echo "";} ?>>
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
		
		function Update_stock(str) {
			
			var proName = str;
			
			//get users acc
			f.ajax({
				type: 'post',
				url: "../func/verify.php",				
				data: "proName=" + proName + '&ins=get_price',
				dataType: "json",
				success: function(data){
					
					if(data.value === "Done"){
						document.getElementById("pricee").style.display = "block";
						f('#price').val(data.value2);
						f('#error').val(data.error);
					} else if(data.value === "no"){
						document.getElementById("pricee").style.display = "block";
					}
				}	
			});
		}

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
</script>

