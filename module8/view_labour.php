<?php 
	ob_start();
	session_start();
	$pageTitle = "Labour Record";
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
                           	<?php $noarray1 = database::getInstance()->select_from_where('labour','id',$id);
										foreach ($noarray1 as $alue) {
											$my_name = $alue['surname']." ".$alue['first_name'];
										} ?>
                                <h4 class="text-center">Labour Record For <?php echo $my_name; ?></h4>

                            <div class="content">
                            	<?php
								$noarray = database::getInstance()->select_from_where('labour','id',$id);
										while ($row = $noarray->fetch(PDO::FETCH_ASSOC)) {
										
									?>
								<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-6">
			                                        <label>Surname:</label> <?php echo $row['surname']; ?>
			                                </div>

			                                <div class="col-md-6">
			                                        <label>Hospital Number:</label> <?php echo $row['hospital_number']; ?>
			                                </div>

			                                <div class="col-md-6">
			                                        <label>First Name:</label> <?php echo $row['first_name']; ?>
			                                </div>

			                                <div class="col-md-6">
			                                        <label>Age:</label> <?php echo $row['age']; ?>
			                                </div>

			                                <div class="col-md-6">
			                                        <label>Parity:</label> <?php echo $row['parity']; ?>
			                                </div>

			                                <div class="col-md-6">
			                                        <label>No Of Living Children:</label> <?php echo $row['living_children']; ?>
			                                </div>

			                                <div class="col-md-12">
			                                        <label>Past Obstetric History:</label> <?php echo $row['past_obstetic_history']; ?>
			                                </div>
			                                
	                                       <div class="col-md-6">
			                                        <label>Onset:</label> <?php echo $row['onset']; ?>
			                                </div>

			                                <div class="col-md-6">
			                                        <label>Hours:</label> <?php echo $row['hours']; ?>
			                                </div>

			                                <div class="col-md-6">
			                                        <label>Time:</label> <?php echo $row['state']; ?>
			                                </div>

			                                <div class="col-md-6">
			                                        <label>Membrane Ruptured At:</label> <?php echo $row['membrane_ruptured']; ?> Hour
			                                </div>

			                                <div class="col-md-6">
			                                        <label>Amniotomy:</label> <?php echo $row['amnitomy']; ?>
			                                </div>

			                                <div class="col-md-6">
			                                        <label>Contractions (Painful) Beigns At:</label> <?php echo $row['contractions']; ?>
			                                </div>

			                                <div class="col-md-6">
			                                        <label>Oxylocics:</label> <?php echo $row['oxytocics']; ?>
			                                </div>

			                                <div class="col-md-12">
			                                        <label>General Condition:</label> <?php echo $row['condition']; ?>
			                                </div>

			                                <div class="col-md-6">
			                                        <label>Fundal Height:</label> <?php echo $row['fundal_height']; ?>
			                                </div>

			                                <div class="col-md-6">
			                                        <label>Type:</label> <?php echo $row['type']; ?>
			                                </div>

			                                <div class="col-md-6">
			                                        <label>LIE:</label> <?php echo $row['lie']; ?>
			                                </div>
			                                <div class="col-md-6">
			                                        <label>Presentation:</label> <?php echo $row['presentation']; ?>
			                                </div>
			                                <div class="col-md-6">
			                                        <label>Position:</label> <?php echo $row['position']; ?>
			                                </div>
			                                <div class="col-md-6">
			                                        <label>Descent:</label> <?php echo $row['descent']; ?>
			                                </div>
			                                <div class="col-md-6">
			                                        <label>Foetal Heart Rate (Minutes):</label> <?php echo $row['foetal_heart_rate']; ?>
			                                </div>
			                                <div class="col-md-6">
			                                        <label>Vulva:</label> <?php echo $row['vulva']; ?>
			                                </div>
			                                <div class="col-md-6">
			                                        <label>Vagina:</label> <?php echo $row['vagina']; ?>
			                                </div>
			                                <div class="col-md-6">
			                                        <label>Well / Loosely applied to P.P.:</label> <?php echo $row['pp_state']; ?>
			                                </div>
			                                <div class="col-md-6">
			                                        <label>Os (cm):</label> <?php echo $row['os']; ?>
			                                </div>
			                                <div class="col-md-6">
			                                        <label>Vulva:</label> <?php echo $row['vulva']; ?>
			                                </div>
			                                <div class="col-md-6">
			                                        <label>Membranes (Ruptured):</label> <?php echo $row['ruptured']; ?>
			                                </div>
			                                <div class="col-md-6">
			                                        <label>Membrane (Intact):</label> <?php echo $row['intact']; ?>
			                                </div>
			                                <div class="col-md-6">
			                                        <label>P.P at O:</label> <?php echo $row['ppo']; ?>
			                                </div>
			                                <div class="col-md-6">
			                                        <label>Position (in):</label> <?php echo $row['in_position']; ?>
			                                </div>
			                                <div class="col-md-6">
			                                        <label>Caput:</label> <?php echo $row['caput']; ?>
			                                </div>
			                                <div class="col-md-6">
			                                        <label>Moulding:</label> <?php echo $row['moulding']; ?>
			                                </div>
			                                <div class="col-md-6">
			                                        <label>Pelvis (AP):</label> <?php echo $row['pelvis_ap']; ?>
			                                </div>
			                                <div class="col-md-6">
			                                        <label>Sacral Curve:</label> <?php echo $row['pelvis_sacral_curve']; ?>
			                                </div>
			                                <div class="col-md-6">
			                                        <label>Forecast:</label> <?php echo $row['forecast']; ?>
			                                </div>
			                                <div class="col-md-6">
			                                        <label>Ischial Spine:</label> <?php echo $row['ischial_spine']; ?>
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