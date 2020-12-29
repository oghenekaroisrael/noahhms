<?php 
	ob_start();
	session_start();
	$pageTitle = "Edit Test Result Template";
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
?>

<div class="wrapper" id="homesc">

<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>
	
	  <!--  MAIN -->
        <div class="content">
            <div class="container-fluid">
	<div id="get_resultt"></div>
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                           <div class="header">
                                <h4 class="title">Edit Test Result Template</h4>
                            </div>

                            <div class="content">
                                <form id="editResu">
									<?php
										$noarray = database::getInstance()->select_from_where('lab_temp_name','id',$value);
										while ($ow = $noarray->fetch(PDO::FETCH_ASSOC)) {
										$t_id = $ow['id'];
										$temp_name = $ow['name'];
									?>
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Template Name</label>
	                                                <p class="form-control"><?php echo $temp_name;?></p>
	                                            </div>
	                                        </div>
										</div>
									</div>
								</form>	
								<?php } ?>
									<div class="clearTwenty"></div>
									<div class="header">
										<h4 class="title">Edit Fields</h4>
									</div>
									<div id="get_result"></div>
									<div class="clearTwenty"></div>
									
									<form id="moreFields">									
									<div class="evenShorter">
										<div id="evenShorter">
											<div class="row">
											   <div class="col-md-12">
													<div class="form-group">
														<label>Add More Field</label>
														<div class="shorter"><input class="form-control" placeholder="Result Field" name="fieldsst[]" type="text" /></div>
														<div class="clear"></div>
														
													</div>
												</div>
											</div>
										</div>
										<p class="addUp"><i class="fas fa-plus"></i> Add More</p>
									</div>
									<div class="clearFifty"></div>	
									<div id="get_resulter"></div>
									
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Submit</button>
									<button type="reset" class="btn btn-danger btn-fill pull-left">Clear</button>
                                    <div class="clearfix"></div>
                               
                            </div>
                        
						</div>
                    </div>
                 </div>

				

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
<?php $code = rand(1000,100000); ?>

<script type="text/javascript">
	var n=jQuery .noConflict();
	var wrapper = n("#evenShorter"); //Fields wrapper
	var add_button = n(".addUp"); //Add button ID
					
	var x = 1; //initlal text box count
	n(add_button).click(function(e){ //on add input button click
		e.preventDefault();
		x++; //text box increment
		n(wrapper).append('<div class="shorter"><div class="form-group"><input placeholder="Result Field" name="fieldss[]" class="form-control" type="text" /><a href="#" class="removeUpBtn"><i class="fas fa-times"></i></a></div></div>'); //add input box
	});
					
	n(wrapper).on("click",".removeUpBtn", function(e){ //user click on remove text
		e.preventDefault(); n(this).parent('div').remove(); x--;
	})
</script>

<script type="text/javascript">
	var a=jQuery .noConflict();			
	a(function () {
		a('#editResu').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			var val = "<?php echo $value; ?>";
			a.ajax({
				type: "POST",
				data: a('#editResu').serialize() + "&val=" + val + '&ins=editTestResTemp',
				url: "../func/verify.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					a("#get_result").html(res).fadeIn("slow");
				}
			});
        });
    });
</script>

<script type="text/javascript">
	var a=jQuery .noConflict();			
	a(function () {
		document.getElementById("load").style.display = "block";
		a.ajax({
			type: "POST",
			data: a('#schedule').serialize() + '&ins=getFieldsEdit' + '&temp=<?php echo $t_id; ?>',
			url: "../func/edit.php",
			success: function(res) {
				document.getElementById("load").style.display = "none";
				a("#get_result").html(res).fadeIn("slow");
				console.log(res);
			}
		});
    });
</script>

<script type="text/javascript">
	var a=jQuery .noConflict();			
	a(function () {
		a('#moreFields').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			var val = "<?php echo $value; ?>";
			a.ajax({
				type: "POST",
				data: a('#moreFields').serialize() + "&val=" + val + '&ins=add_more_fields',
				url: "../func/verify.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					a("#get_resulter").html(res).fadeIn("slow");
				}
			});
        });
    });
</script>



