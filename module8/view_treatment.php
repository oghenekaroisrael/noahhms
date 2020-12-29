<?php 
	ob_start();
	session_start();
	$pageTitle = "View Treatment";
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
	$id = $_GET['id'];
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
                           	<?php $pid = database::getInstance()->get_name_from_id('patient_id','treatments','id',$id);
                           	$noarray1 = database::getInstance()->select_from_where('patients','id',$pid);
										foreach ($noarray1 as $alue) {
											$my_name = $alue['title']." ".$alue['surname']." ".$alue['middle_name']." ".$alue['first_name'];
											$pic = $alue['photo'];
											$reg = $alue['reg_num'];
											$crd = $alue['card_type'];
										} ?>
                                <h4 class="text-center">Treatment Record</h4>

                            <div class="content">
                            	<?php
								$noarray = database::getInstance()->select_from_where('treatments','id',$id);
										while ($row = $noarray->fetch(PDO::FETCH_ASSOC)) {
										
									?>
								<div class="card">
					<div class="container" style="padding-top: 50px;padding-bottom: 50px;">
									<div class="col-md-6" style="border-right-style: solid;border-right-width: 1px;border-right-color: #ddd; ">
		                        		<div class="col-lg-4">
		                        			<center>
		                        				<img  width="150" height="150" class="img img-circle" src="../photo/<?php echo $pic; ?>">
		                        			</center>
		                        		</div>

		                        	<div class="col-lg-8">
		                        		<div class="row">
																															<h3 class="h3"><?php echo $my_name; ?></h3>
		                        					<div class="col-lg-6">
		                        						<center>
		                        							<h4><?php echo $reg;?></h4>
		                        							<span>Reg Number</span>
		                        						</center>
		                        					</div>

		                        					<div class="col-lg-6">
		                        						<center>
		                        								<?php 
		                        							 		if ($crd == 19) { ?>
		                        							 			<h4><?php echo Database::getInstance()->get_name_from_id('name','card_types','id',$crd);?></h4>
																																													<span>HMO Tariff: <?php echo Database::getInstance()->get_name_from_id('name','tariffs','id',$tariff);?></span>
																																													<?php
																																												}else if($crd == 11){
																																													?><h4>
																																													Card Type: <?php echo Database::getInstance()->get_name_from_id('name','card_types','id',$crd);?></h4>
																																													<span>Company Name: <?php echo Database::getInstance()->get_name_from_id('company_name','companies','id',$comp_i);?></span>
																																													<?php
																																												}else if($crd == 20){
																																													?>
																																													<h4>Card Type: <?php echo Database::getInstance()->get_name_from_id('name','card_types','id',$crd);?></h4>
																																													<span>Family Name: <?php echo Database::getInstance()->get_name_from_id('family_name','families','id',$fam);?></span>

																																													<?php
																																												}else{
																																													?>
																																													<h4><?php echo Database::getInstance()->get_name_from_id('name','card_types','id',$crd);?></h4><span>Card Type</span>
																																													<?php
																																												} ?>
		                        							 </h4>
		                        						</center>
		                        					</div>

		                        				</div>
		                        			</center>
		                        		</div>
		                     </div>

									<div class="col-md-6" id="detss">
										<div class="row">
											<div class="col-md-6">
						                        <label>Ailment / Disease:</label> 
						                        <?php echo database::getInstance()->get_name_from_id("name","treatment_list","id",$row['disease']); ?>
						                    </div>

						                    <div class="col-md-6">
						                        <label>Symptom:</label> 
						                        <?php echo $row['symptom']; ?>
						                    </div>
										</div>

			                    		<div class="row">
			                    			<div class="col-md-6">
			                        <label>Next Checkup Date:</label> 
			                        <?php echo Date("d M Y",strtotime($row['next_checkup'])); ?>
			                    </div>

			                    <div class="col-md-6">
			                        <label>Extra Note:</label> 
			                        <?php echo $row['extra_note']; ?>
			                    </div>
			                    		</div>

									</div>
								</div>
							</div>
						<?php } ?>

								</div>
						</div>
                    </div>
                 </div>
				<div id="get_result"></div>      
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
	a(function () {

		a('#change_ante').on('submit', function (e) {
			var ID = "<?php echo $_GET['id']; ?>";
			var staff = "<?php echo $user_id; ?>";
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			var id = "<?php echo $id; ?>";
			a.ajax({
				type: "POST",
				data: a('#change_ante').serialize()  + "&id=" + id + '&ins=editAntenatal_N&edit='+ ID + '&staff='+staff,
				url: "../func/edit.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					a("#get_result").html(res).fadeIn("slow");
					console.log(res);
				}
			});
        });
    });
</script>