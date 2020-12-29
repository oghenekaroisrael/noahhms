<?php 
	ob_start();
	session_start();
	$pageTitle = "Add New Patient";
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
	$staffG = "";
	$regnum = "";
	$first = "";
	$surname = "";
	if(isset($_GET['g'])){
		$staffG = $_GET['g'];
		$stafDetails = Database::getInstance()->select_from_where('staff', 'user_id', $staffG);
		foreach($stafDetails as $st){
			$regnum = $st['reg_num'];
			$first = $st['first_name'];
			$surname = $st['last_name'];
		}
		
	}
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
                                <h4 class="title">New Patient Details</h4>
                            </div>

                           <div class="content">
                                <form id="patient">
                                	<div class="col-md-6">
										<div class="row">
										 
											
	                                       <div class="col-md-4">
	                                           
			                                        <div class="form-group">
			                                            <label>Title</label>
			                                            <input type="text" class="form-control" name="title" placeholder="Title" >
			                                        </div>   
			                                    
			                                </div>

			                                <div class="col-md-8">
	                                            <div class="form-group">
	                                                <label>First Name</label>
	                                                <input type="text" class="form-control" name="first" placeholder="First Name" value="<?php echo $first;?>">
												</div>
	                                        </div> 
											
											
										</div>
									</div>
                                	
									<div class="col-md-6">
										<div class="row">
										 <div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>Middle Name</label>
	                                                <input type="text" class="form-control" name="m_name" placeholder="Middle Name">
												</div>
	                                        </div> 
											
										
										<div class="col-md-6">
	                                            <div class="form-group">
			                                        <label>Surname</label>
			                                        <input type="text" class="form-control" name="surname" placeholder="Surname" value="<?php echo $surname;?>">
			                                     </div>
	                                        </div> 
	                                      
										  
										</div>
									</div>

									
									

									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-4">
	                                            <div class="form-group">
	                                                <label>Sex</label>
	                                                <select class="form-control" id="sex" name="sex">
														<option value="Female">Female</option>
														<option value="Male">Male</option>
														<option value="other">Other</option>
													</select>
	                                            </div>
	                                        </div>


											<div class="col-md-4">
	                                            <div class="form-group">
	                                                <label>Age Type</label>
	                                                <select class="form-control" id="ageType" name="ageType">
														<option value="Elder">Elder</option>
														<option value="Adult">Adult</option>
														<option value="Teenager">Teenager</option>
														<option value="Baby">Baby</option>
													</select>
	                                            </div>
	                                        </div>

	                                        <div class="col-md-4">
	                                            <div class="form-group">
	                                                <label>Date of Birth</label>
	                                                <input type="date" class="form-control" name="dob" placeholder="Date of Birth" >
	                                            </div>
	                                        </div>
											
										</div>
									</div>
	
							     <button type="submit" class="btn btn-info btn-fill pull-right">Add Patient</button>
									<button type="reset" class="btn btn-danger btn-fill pull-left">Clear</button>
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

<script type="text/javascript">
	 var a=jQuery .noConflict();
	 a(document).ready(function(){
	 	a(".chooseList p").click(function(){
				var text = a(this).text();
				p_id = a(this).attr('id');
				app = '<?php echo $get_last['id']+1; ?>';
				a(".toggle").html(text); //display teh text of the id in the textbox i.e the nam eof teh client
				a( ".toggleDrop" ).hide(); //removes drop down on click	
			});

        a('#patient').on('submit', function (e) {

        e.preventDefault();
		document.getElementById("load").style.display = "block";
		var formData = new FormData(a(this)[0]);
		var ins = "newAEPatient";
		 formData.append('ins',ins);
          a.ajax({
            type: 'post',
			data: formData,  
			cache: false,
			contentType: false,
			processData: false,
            url: '../func/verify.php',						
            success: function(data)
            {
				document.getElementById("load").style.display = "none";
				a("#get_result").html(data).fadeIn("slow");
            }
          });

        });

        a('#select_card'). on('change', function(e) {
        	var card = parseInt(document.getElementById("select_card").value);
        	if (card == 11) {
				document.getElementById('company_card_cont').style.display = "block";				
        		document.getElementById('family_card_cont').style.display = 'none';
        	}else if(card == 20){
        		document.getElementById('family_card_cont').style.display = 'block';
        		document.getElementById('company_card_cont').style.display = 'none';	
        	}else{        		
				document.getElementById('company_card_cont').style.display = "none";
        		document.getElementById('family_card_cont').style.display = 'none';
        	}
       

        });
      });
	function display_company_card() {
	}
</script>

