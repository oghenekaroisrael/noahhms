<?php 
	ob_start();
	session_start();
	$pageTitle = "Upload Files";
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
	$value = $_GET['id'];
	$db = mysqli_connect("localhost","root","","noahhms");
	$sql = mysqli_query($db, "SELECT patient_id FROM patient_appointment WHERE id = ".$value."");
	$get = mysqli_fetch_assoc($sql);
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
                                <h4 class="title">Test List</h4>
                            </div>

                            <div class="content">
                                <form id="form">
									
									<!--<div class="form-group">
									<label for="name" class="col-sm-2 control-label"></label>
									<div class="col-sm-8">
									<?php  
									$noarray = database::getInstance()->select_from_ord1('lab_test_type','lab_test_type','ASC');
									foreach($noarray as $opow){
										?>
										
									<h2 style="font-size:16px;font-weight: bold;text-align: center;padding-bottom: 20px;"><?php echo $opow['lab_test_type']?></h2>
									<div class="row">
									<?php 
										$not = database::getInstance()->select_test_to($opow['lab_test_type_id']);
										foreach($not as $row){
								  ?>
								 
								 
								<span class="pal" style="padding-bottom: 10px;">
									 <input name="test[<?php echo $row['lab_test_id'] ;?>]" type="checkbox" class="chkbox"> <?php echo $row['lab_test'] ;?>
								</span>
								
								
									<?php } ?>
									</div>
									
									<?php } ?>
							
						
							</div>		
								</div>-->




								<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                       	<div class="form-group">
	                                                
													<label>Lab Tests</label>
												
													<p class="toggle">Lab Tests</p>
						
														
													<div class="toggleDrop">
														<input id="myInput" onkeyup="filterFunction()" placeholder ="Filter Your Client"  name="test" />
													
														<div id="myDropdown" class="chooseList">
															<?php
																$userDeails = Database::getInstance()->select("lab_test");
																foreach($userDeails as $uow):
																	$d_id = $uow['lab_test_id'];
																	$name = $uow['lab_test'];	
																
															?>
															<p href="#" id="<?php echo $d_id;?>"><?php echo $name;?></p>
															<?php endforeach; ?>
															<input class="input2" type="hidden" name="test[<?php echo $d_id;?>]"/>
														</div>
													</div>
											
												
													<script type="text/javascript">
														var a=jQuery .noConflict();
														a(document).ready(function(){
														  a(".toggle").click(function(){
														    a(".toggleDrop").fadeToggle("slow");
														  });
														});
													</script>
													<script type="text/javascript">
													function filterFunction() {
														var input, filter, ul, li, a, i;
														input = document.getElementById("myInput");
														filter = input.value.toUpperCase();
														div = document.getElementById("myDropdown");
														a = div.getElementsByTagName("p");
														for (i = 0; i < a.length; i++) {
															if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
																a[i].style.display = "";
															} else {
																a[i].style.display = "none";
															}
														}						
													}				
												</script>
	                                            </div>
	                                        </div>
										</div>
									</div>





								<div class="col-sm-12">
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Send Request</button>
									<button type="reset" class="btn btn-danger btn-fill pull-left">Clear</button>
								</div>
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
	
		var s=jQuery .noConflict();
		s(function () {
		
		s(document).ready(function(){
			s(".chooseList p").click(function(){
				var text = s(this).text();
				d_id = s(this).attr('id');
				s(".toggle").html(text); //display teh text of the id in the textbox i.e the nam eof teh client
				s(".input2").val(d_id);
				s( ".toggleDrop" ).hide(); //removes drop down on click	
			});
		});
    });	
	s(document).ready(function() {
		s('form').submit(function(e){
			var id = "<?php echo $value; ?>";
			var pat = "<?php echo $get['patient_id'];?>"
			var doc = "<?php echo $user_id; ?>";
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			s.ajax({
				type: "POST",
				data: s('form').serialize() + "&val=" + pat + "&doc=" + doc + "&app=" + id + "&ins=newTestRequest",
				url: "../func/verify.php",
				success: function(res) {
					if(res == "Done"){
						window.history.back();
					}else{
						document.getElementById("load").style.display = "none";
						s("#get_result").html(res).fadeIn("slow");
					}
					
				}
			});
		})			
	})	
	$(document).ready(function(){
		$('.chkbox').click(function(){
			var text = "";
			$('.chkbox:checked').each(function(){
				text += $(this).val()+ ",";
			});
			text = text.substring(0,text.length-1);
			$('#checked_values').val(text);
			var count = $("input[type='checkbox']:checked").length;
			$('#count').val($("input[type='checkbox']:checked").length);
		});
	});		
</script>

