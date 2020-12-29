
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
                                <h4 class="title">Process Prescription</h4>
                            </div>
                            <div class="content">

                            	<div class="content table-responsive table-full-width">
	                                <table id="pro"class="table table-hover table-striped">
	                                    <thead>
											<th>#</th>
	                                    	<th>Prescription</th>
	                                    </thead>
	                                    <tbody>
										  <?php
												$count = 1; 
												$notarray = database::getInstance()->select_from_where2('prescription','appointment_id',$value);
												foreach($notarray as $row):
												$app_id = $row['appointment_id'];
												$p_id = $row['patient_id'];
												$diag = $row['diagnosis'];
												$tabs = $row['tabs'];
												$dosage = $row['dosage'];
												$instructions = $row['instructions'];
											?>
	                                        <tr>
	                                        	<td><?php echo $count++;?></td>
	                                        	
	                                        	<td><?php echo $pres;?></td>
	                                        	<td><?php echo $tabs;?></td>
	                                        	
	                                        </tr>
											
											
						 
											<?php endforeach;?>
	                                    </tbody>
	                                 <thead>
	                                        <th>#</th>
	                                    	<th>Prescription</th>
	                                    </thead>
									</table>

	                            </div>

	                            <div class="clearTwenty"></div>

	                            <div class="header">
	                                <h4 class="title">Compute</h4>
	                            </div>
                                <form id="processPharm">
								<div id="sections">
									<div class="section">
										<fieldset>
										<div class="col-md-6">
		                            		<div class="row">
		                                       <div class="col-md-12">
		                                            <div class="form-group">
		                                                <label>Name</label>
		                                                <input type="text" class="form-control" id="proName" name="name[]" placeholder="Name" >
		                                            </div>
		                                        </div>
											</div>
										</div>

										<div class="col-md-6">
											<div class="row">
		                                       <div class="col-md-12">
		                                            <div class="form-group">
		                                                <label>Quantity</label>
		                                                <input type="text" class="form-control" id="proQty" name="qty[]" placeholder="Quantity" >
		                                            </div>
		                                        </div>
											</div>
										</div>	

										<div class="row pull-left col-md-12" id="pricee" style="display:none;">
		                                       <div class="col-md-12 ">
		                                            <div class="form-group">
		                                                <label>Price</label>
		                                                <input type="text" class="form-control" id="price" name="price[]" value="">
		                                            </div>
		                                        </div>
											</div> 

										

										<div class="col-md-6">
											<div class="row">
		                                       <div class="col-md-12">
		                                            <div class="form-group">
		                                                <label>Number of Daily Intake</label>
		                                                <input type="text" class="form-control" name="intake[]" placeholder="Number of Daily Intake">
		                                            </div>
		                                        </div>
											</div>
										</div>

										<div class="col-md-6">	
											<div class="row">
		                                       <div class="col-md-12">
		                                            <div class="form-group">
		                                                <label>Duration</label>
		                                                <input type="text" class="form-control" name="duration[]" placeholder="Duration">
		                                            </div>
		                                        </div>
											</div>
										</div>
										<p><a href="#" class='removee'><i class="fas fa-times"></i></a></p>
										</fieldset>
									</div><!--end class section-->	
                                </div><!--end id-->
                                <div class="clearfix"></div>
                                <p><a href="#" class='addsection'><i class="fas fa-plus"></i> Add More Items</a></p>

                                <div class="clearTwenty"></div>

                                <button type="submit" class="btn btn-info btn-fill pull-right">Get Total</button>
                                <div class="clearfix"></div>
                                </form>
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

	//remove section
	a('#sections').on('click', '.removee', function() {
		//fade out section
		a(this).parent().fadeOut(300, function(){
			//remove parent element (main section)
			a(this).parent().parent().empty();
			return false;
		});
		return false;
	});
</script>

<script type="text/javascript">
//get the title of ecurrency choosen
	//Lets ajaxify this part on keyup
	var f=jQuery .noConflict();
	f(document).ready(function(){
		
		f('#proQty').on("keyup", function() {
			
			var proName = f('#proName').val();
			var proQty = f('#proQty').val();
			
			//get users acc
			f.ajax({
				type: 'post',
				url: "../func/verify.php",				
				data: "proName=" + proName + "&proQty=" + proQty + '&ins=get_price',
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
		});
	});
</script>

<script>	
	var s=jQuery .noConflict();
	s(document).ready(function() {
		s('#processPharm').submit(function(e){
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			var app_id = "<?php echo $app_id; ?>";
			var p_id = "<?php echo $p_id; ?>";
			var ins = 'sendToAcc';
			var formData = new FormData(s("form")[0]);
			
			formData.append("p_id", p_id);
			formData.append("ins", ins);
			formData.append("app_id", app_id);

			
			s.ajax({
				type: "POST",
				data: formData,	
				contentType: false,
				cache: false,
				processData:false,
				url: "../func/verify.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					s("#get_result").html(res).fadeIn("slow");
					console.log(res);
				}
			});
		})			
	})			
</script>

