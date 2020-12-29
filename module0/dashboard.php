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
	}
	include_once '../inc/header-index.php'; //for addding header
?>
<div class="wrapper">
	<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
		<?php include 'inc/main_header.php';?>
			<div class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<div class="row">
								<div class="col-lg-12">
									<h2 class="left">Welcome To NOAH Hospital Management System <span style="font-weight: lighter;"><?php echo date("d M Y"); ?></span></h2>
								</div>
							</div>


							<div class="row">

								<div class="col-lg-12" style="padding-bottom: 20px">
									<a class="btn btn-info right" href="../sync.php">
									<i class="fas fa-refresh"></i> Backup Data
								</a>
								</div>

								<div class="col-lg-4">
									<div class="card" id="cards" style="background-color: rgb(12, 58, 125);">
										<p>Total Doctors</p><br>
										<span><?php echo database::getInstance()->count_from_where("staff","role_id",5); ?></span>
									</div><!--end card-->
								</div>

								<div class="col-lg-4">
									<div class="card" id="cards" style="background-color: rgb(12, 58, 125);">
										<p>Total Staff</p><br>
										<span><?php echo database::getInstance()->count_admin("staff"); ?></span>
									</div><!--end card-->
								</div>

								<div class="col-lg-4">
									<div class="card" id="cards" style="background-color: rgb(12, 58, 125);">
										<p>Total Patients</p><br>
										<span><?php echo database::getInstance()->count_admin("patients"); ?></span>
									</div><!--end card-->
								</div>

								<div class="col-lg-4">
									<div class="card" id="cards" style="background-color: rgb(12, 58, 125);">
										<p>Currently Active Staff</p><br>
										<span><?php echo database::getInstance()->count_from_where("staff","logged_in",1); ?></span>
									</div><!--end card-->
								</div>

								<div class="col-lg-4">
									<div class="card" id="cards" style="background-color: rgb(12, 58, 125);">
										<p>Total Occupancy</p><br>
										<span><?php echo database::getInstance()->count_from_where("ipd_patients","admission_status_id",0); ?></span>
									</div><!--end card-->
								</div>



								<div class="col-lg-4">
									<div class="card" id="cards" style="background-color: rgb(12, 58, 125);">
										<p>Total Discharged</p><br>
										<span><?php echo database::getInstance()->count_from_where("ipd_patients","admission_status_id",2); ?></span>
									</div><!--end card-->
								</div>

								<div class="col-lg-4">
									<div class="card" id="cards" style="background-color: rgb(12, 58, 125);">
										<p>Total Appointments</p><br>
										<span><?php echo database::getInstance()->count_admin("patient_appointment"); ?></span>
									</div><!--end card-->
								</div>

								<div class="col-lg-4">
									<div class="card" id="cards" style="background-color: rgb(12, 58, 125);">
										<p>Today's Appointments</p><br>
										<span><?php echo database::getInstance()->count_from_where_like("patient_appointment","date_added",date('Y-m-d')); ?></span>
									</div><!--end card-->
								</div>

								<div class="col-lg-4">
									<div class="card" id="cards" style="background-color: rgb(12, 58, 125);">
										<p>Today's Blood Donations</p><br>
										<span><?php echo database::getInstance()->count_from_where("donations","DATE(date_added)",date("Y-m-d")); ?></span>
									</div><!--end card-->
								</div>

								<div class="col-lg-4">
									<div class="card" id="cards" style="background-color: rgb(12, 58, 125);">
										<p>Total Surgeries</p><br>
										<span><?php echo database::getInstance()->count_admin("surgery_perm"); ?></span>
									</div><!--end card-->
								</div>

								<div class="col-lg-4">
									<div class="card" id="cards" style="background-color: rgb(12, 58, 125);">
										<p>Total Deaths</p><br>
										<span><?php echo database::getInstance()->count_from_where("ipd_patients","admission_status_id",3); ?></span>
									</div><!--end card-->
								</div>
							</div>
							</div><!--end card-->

						</div><!--ed col 8-->
						
						<div class="clear"></div>
						
						</div>
					</div><!--end row-->
				</div>
			</div>
			
			<?php 
				
				ob_end_flush(); 
			?>
			
		</div>
	</div>
<script type="text/javascript">
		var s=jQuery .noConflict();
		s(function () {
		s("#pro").DataTable();
	  });
  
		function sure(ID,name){ 

        	s.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to delete <b>"+name+"</b> From states to deliver to? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

            },{
                type: 'danger',
                timer: 100000
            });

    	}
		
		function delet(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/del.php',
            data: "val=" + val +  '&ins=delState',
             success: function(data)
            {
				document.getElementById("load").style.display = "none";
				if (data === 'Done') {
					console.log(data);
						window.location = 'states';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>