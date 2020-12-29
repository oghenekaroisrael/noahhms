<?php 
	ob_start();
	session_start();
	$pageTitle = "Request Lab Test";
	// Include database class
	include_once '../inc/db.php';
		if (!isset($_SESSION['test'])) {
    	$sales_id = date('Ymdhis');
    	$_SESSION['test'] = $sales_id;
	} else {
		$_SESSION['test'] = $_SESSION['test'];
	}
	if(!isset($_SESSION['userSession'])){
		header("Location: ../index");
		exit;
	}
	elseif (isset($_SESSION['userSession'])){
		$user_id = $_SESSION['userSession'];
	}
	include_once '../inc/header-index.php'; //for addding header
	$value = $_GET['id'];
	$val = Database::getInstance()->get_name_from_id("patient_id","patient_appointment","id",$value);
?>
<div class="wrapper" id="homesc">

<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>
	<?php 
	if (isset($_GET['stat']) AND $_GET['stat'] == "success") {
		unset($_SESSION['test']);
		?>
		<div class="alert alert-success">Test Sent Succesfully</div>
		<?php
	}

	 ?>
	  <!--  MAIN -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                        	<div class="header">
                                <h4 class="title">Request Lab Test</h4>
                            </div>
                            <div class="content">									
									<form id="drug_list">
										<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                       	<div class="form-group">
	                                                
													<label>Lab Test</label>
												
													<p class="toggle">Lab Test</p>			
													<div class="toggleDrop">
														<input id="myInput" onkeyup="filterFunction()" placeholder ="Filter Your Client"  name="test"/>
														<div id="myDropdown" class="chooseList">
															<?php
																$userDeails = Database::getInstance()->select("lab_test");
																foreach($userDeails as $uow):
																	$d_id = $uow['lab_test_id'];
																	$name = $uow['lab_test'];	
																
															?>
															<p href="#" id="<?php echo $d_id;?>"><?php echo $name;?></p>
															<?php endforeach; ?>
															<input class="input2" type="hidden" name="test"/>
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
									<button type="submit" class="btn btn-info pull-right">Add Test</button>
									</form>

									<form id="formed">
									<div class="content table-responsive table-full-width">
										<table class="table table-hover table-striped">
											<thead>
												<tr>
													<th>#</th>
													<th>Lab Test</th>
													<th>Delete</th>
												</tr>
											</thead>
											<tbody>
												<?php 
			                                    	$coun =1;
			                                    		$tmp_presc = database::getInstance()->select_from_where2_DESC('temp_test','pid',$_SESSION['test']);
			                                    		foreach ($tmp_presc as $vue) {
			                                    			$drug = $vue['lab_test_id'];
			                                    			$id = $vue['id'];
			                                    			$dname = database::getInstance()->get_name_from_id('lab_test','lab_test','lab_test_id',$drug);
			                                    				?>
			                                    				<tr>
			                                    					<td><?php echo $coun++; ?></td>
													<td>
														<?php echo $dname; ?>
														<input type="hidden" name="test[<?php echo $drug; ?>]" value="<?php echo $drug; ?>">
													</td>
													<td>
														<a id="sale_delete" class="btn btn-danger btblack" onclick="sure(<?php echo $id; ?>,'<?php echo $dname; ?>')"><i class="fas fa-trash"></i></a>
														</td>
												</tr>
			                                    			<?php
			                                    		}
			                                    			?>
											</tbody>
											<thead>
												<tr>
													<th>#</th>
													<th>Lab Test</th>
													<th>Delete</th>
												</tr>
											</thead>
										</table>
									</div>
									<button type="submit" class="btn btn-info btn-fill pull-right"  name="submit" >Send Request</button>
									<button type="reset" class="btn btn-danger btn-fill pull-left">Clear</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        
						</div>
                    </div>
                 </div>

				<div id="get_result"></div>
				

            </div>
			 <button onclick="goBack()"  class="btn btn-info">Go Back</button>
        </div>
		
		
		 <!-- //MAIN -->
	
	
		
		<!--  footer -->
	<?php include '../inc/footer-index.php';?>
	<!--//footer -->
        
    </div>

</div>

 <div class="loader" id="load" style="display:none;">
</div>
<script type="text/javascript">
	var a=jQuery .noConflict();
	var d_id; //to make it accessible
	a(function () {
		
		a(document).ready(function(){
			a(".chooseList p").click(function(){
				var text = a(this).text();
				d_id = a(this).attr('id');
				a(".toggle").html(text); //display teh text of the id in the textbox i.e the nam eof teh client
				a(".input2").val(d_id);
				a( ".toggleDrop" ).hide(); //removes drop down on click	
			});
		});
    });	
		a('#case').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			var value = "<?php echo $value; ?>";
			var doc_id = "<?php echo $user_id; ?>";
			var p_id = "<?php echo $p_id; ?>";
			a.ajax({
				type: "POST",
				data: a('#case').serialize()+ '&p_id=' + p_id + '&doc_id=' +doc_id + '&id=' + value + '&ins=newCaseD',
				url: "../func/verify.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					a("#get_result").html(res).fadeIn("slow");
					console.log(res);
				}
			});
        });

        a('#formed').submit(function(e){
			var id = "<?php echo $value; ?>";
			var pat = "<?php echo $val;?>"
			var doc = "<?php echo $user_id; ?>";
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			s.ajax({
				type: "POST",
				data: a('#formed').serialize() + "&val=" + pat + "&doc=" + doc + "&app=" + id + "&ins=newTestRequest_progress",
				url: "../func/verify.php",
				success: function(res) {
					if(res == "Done"){
						window.location = "request_test_progress.php?id=<?php echo $_GET['id'] ?>&stat=success&progress=true";
					}else{
						document.getElementById("load").style.display = "none";
						s("#get_result").html(res).fadeIn("slow");
					}
					
				}
			});
		});

        a('#drug_list').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			var value = "<?php echo $val; ?>";//appointment id
			var doc_id = "<?php echo $user_id; ?>";
			var p_id = "<?php echo $value; ?>";
			var did = "<?php echo $_SESSION['test']; ?>"
			a.ajax({
				type: "POST",
				data: a('#drug_list').serialize()+ '&p_id=' + p_id +'&pre='+ did + '&doc_id=' +doc_id + '&id=' + value + '&ins=newCaseTest',
				url: "../func/verify.php",
				success: function(res) {
					a("#get_result").html(res).fadeIn("slow");
					console.log(res);
					window.location = "request_test_progress.php?id=<?php echo $_GET['id'] ?>&progress=true";
				}
			});
        });

        function sure(ID,name){ 

        	a.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to delete <b>"+name+"</b> from This List ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

            },{
                type: 'danger',
                timer: 100000
            });

    	}
		function delet(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          a.ajax({
            type: 'post',
            url: '../func/del.php',
            data: "val=" + val +  '&ins=delCaseTest',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data == 'Done') {
					console.log(data);
						window.location = 'request_test.php?id=<?php echo $_GET['id'];?>';
				  }
				  else {
					   
						jQuery('#get_result'+ID).html(data).show();
				  }
            }
          });
		}
 
</script>
<script>
function goBack() {
  window.history.back();
}
</script>