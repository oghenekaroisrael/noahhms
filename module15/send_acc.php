<?php 
	ob_start();
	session_start();
	$pageTitle = "Lab Payment";
	// Include database class
	include_once '../inc/db.php';
	
	If(!isset($_SESSION['userSession'])){
		header("Location: ../index");
		exit;
	}
	elseif (isset($_SESSION['userSession'])){
		$user_id = $_SESSION['userSession'];
	}

	$value = $_GET['id']; 

	include_once '../inc/header-index.php'; //for addding header
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
                                <h4 class="title">Lab Request</h4>
                            </div>
                            <div class="content">

                            	<div class="content table-responsive table-full-width">
	                                <table id="pro"class="table table-hover table-striped">
	                                    <thead>
											<th>#</th>
	                                    	<th>Request</th>
	                                    </thead>
	                                    <tbody>
										  <?php
												$count = 1; 
												$notarray = database::getInstance()->select_from_where2('lab_notifications','appointment_id',$value);
												foreach($notarray as $row):
												
												$p_id = $row['patient_id'];
												$pres = $row['request'];
											?>
	                                        <tr>
	                                        	<td><?php echo $count++;?></td>
	                                        	
	                                        	<td><?php echo $pres;?></td>
	                                        	
	                                        </tr>
											
											
						 
											<?php endforeach;?>
	                                    </tbody>
	                                 <thead>
	                                        <th>#</th>
	                                    	<th>Request</th>
	                                    </thead>
									</table>

	                            </div>

	                            <div class="clearTwenty"></div>

	                            <div class="header">
	                                <h4 class="title">Compute</h4>
	                            </div>
                                <form id="processTest">
								<div id="sections">
									<div class="section">
										<fieldset>	
										<div class="col-md-6">
		                            		<div class="row">
		                                       <div class="col-md-12">
		                                            <div class="form-group">
		                                                <label>Test</label>
		                                                <input type="text" class="form-control" name="test[]" placeholder="Test" >
		                                            </div>
		                                        </div>
											</div>
										</div>

										<div class="col-md-6">
											<div class="row">
		                                       <div class="col-md-12">
		                                            <div class="form-group">
		                                                <label>Amount</label>
		                                                <input type="text" class="form-control" name="amt[]" placeholder="Amount" >
		                                            </div>
		                                        </div>
											</div>
										</div>
										<p><a href="#" class='removee'><i class="fas fa-times"></i></a></p>
										</fieldset>		
									</div>
								</div>	
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

<script>	
	var s=jQuery .noConflict();
	s(document).ready(function() {
		s('#processTest').submit(function(e){
			e.preventDefault();
			document.getElementById("load").style.display = "block";

			var app_id = "<?php echo $value; ?>";
			var p_id = "<?php echo $p_id; ?>";
			var ins = 'sendTestAcc';
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
				}
			});
		})			
	})			
</script>