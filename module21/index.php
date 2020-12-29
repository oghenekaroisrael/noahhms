<?php 
	ob_start();
	session_start();
	$pageTitle = "Dashboard";
	// Include database class
	include_once '../inc/db.php';
	
	If(!isset($_SESSION['userSession'])){
		header("Location: ../index");
		exit;
	}
	elseif (isset($_SESSION['userSession'])){

	
		$user_id = $_SESSION['userSession'];
		$db = mysqli_connect("localhost","root","","noahhms");
		$noti = mysqli_query($db, "SELECT * FROM notifications WHERE staff_id = ".$user_id." AND strikes <= 3 AND `timer_notify` <=  '".date("Y-m-d H:i:s")."' ORDER BY id DESC");
		if (mysqli_num_rows($noti) > 0){
		$here = mysqli_fetch_assoc($noti);
		?>
				<div class="container-fluid" id="notify_me" style="display: block;">
					<div class="notify_box">
						<div class="notify_icon">
							<i class="fas fa-bell-o"></i>	
						</div>
						<div class="notify_content">
							<h4 class="text-center"><?php echo $here['message']; ?></h4>
							<p class="text-center" style="font-weight: bolder; font-size: 18px;">(<?php 
								$name_p = mysqli_query($db,"SELECT * FROM patients WHERE id = ".$here['patient_id']."");
								$name_k = mysqli_fetch_assoc($name_p);
									echo $name_k['surname']." ".$name_k['first_name']." ".$name_k['middle_name'];
								?>)</p>
						</div>
						<div class="notify_actions">
							<a class="btn btn-link" onclick="notify_me(<?php echo $here['id']; ?>)">Cancel</a> <a href= "<?php echo $here['link']; ?>&nstat=1&nid=<?php echo $here['id']; ?>" class="btn btn-info right">View</a>
						</div>
					</div>
					<audio id="notify_sound" autoplay=true>
				  <source src="../ping/alarm.ogg" type="audio/ogg">
				  <source src="../ping/alarm.mp3" type="audio/mp3">
				  Your browser does not support the audio element.
				</audio>
				</div>
				<?php
			}
	} 
	include_once '../inc/header-index.php'; //for addding header
	if ($_GET['status'] === 'changed') {
		$_SESSION['next'] = 1;
		?>
		<script>
				$(document).ready(function() {
					rem2();
				});
		</script>
		<?php
	}
?>

<div class="wrapper">
<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>

        <div class="content">
            <div class="container-fluid">
			
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="row">
                            	<div class="col-lg-1"></div>
                            	<div class="col-lg-10">
                            		<div class="form-group">
                            			<?php $c_room = database::getInstance()->select_last_consult($user_id);
							            		if ($c_room[0]['room'] == 1) {
							            			$room = 'Consulting Room 1';
							            		}elseif ($c_room[0]['room'] == 2) {
							            			$room = 'Consulting Room 2';
							            		}elseif ($c_room[0]['room'] == 3) {
							            			$room = 'Consulting Room 3';
							            		}else{
							            			$room = 'None';
							            		}
							            	?>
										<label>Consulting Room Being Used: <font style="font-family: raleway; font-weight: lighter;"><?php echo $room; ?></font></label>
										<select id="consult" class="form-control" onchange="room();">
											<option value="0">Select Consulting Room</option>
											<option value="1">Consulting Room 1</option>	
											<option value="2">Consulting Room 2</option>
											<option value="3">Consulting Room 3</option>
										</select>
									</div>
                            	</div>
                            	<div class="col-lg-1"></div>
                            </div>
                            <div class="row">
                            	<div class="header">
                            		<h3>Today's Schedule</h3>
                            	</div>
                            	<div class="col-lg-6">
									<div class="card" id="cards" style="background-color: rgb(12, 58, 125);">
										<p>Appointments</p><br>
										<span><?php echo database::getInstance()->count_from_where_col1_col2("patient_appointment","doctor_id",$user_id,"treated","1"); ?></span>
									</div><!--end card-->
								</div>
                            	<div class="col-lg-6">
									<div class="card" id="cards" style="background-color: rgb(19, 80, 168);">
										<p>Admission</p>
										<span><?php echo database::getInstance()->count_from_where("ipd_patients","admission_status_id",0); ?></span>
									</div><!--end card-->
								</div>
                            	
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

	<script type="text/javascript">
	var s=jQuery .noConflict();
	s(function () {
    s("#pro").DataTable();
  });
  
		function sure(ID,name){ 

        	s.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to delete <b>"+name+"</b> From bank list ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

            },{
                type: 'danger',
                timer: 100000
            });

    	}
    	function rem2(name){ 

        	s.notify({
            	icon: 'pe-7s-door-lock',
            	message: "Consulting Room Changed"

            },{
                type: 'success',
                timer: 3000
            });

    	}

    	function room(){ 
		var val = <?php echo $user_id; ?>;
		var room = parseInt(document.getElementById("consult").value);
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/edit.php',
            data: "val=" + val + "&room=" + room + '&ins=changeRoom',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data == 'Done') {
					console.log(data);
						window.location = 'index.php?status=changed';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}
		
		function delet(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/del.php',
            data: "val=" + val +  '&ins=delPatient',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'patients';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}
    </script>
