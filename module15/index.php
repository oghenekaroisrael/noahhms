<?php
	ob_start();
	session_start();
	$pageTitle = "Blood Bank";
	// Include database class
	include_once '../inc/db.php';

	If(!isset($_SESSION['userSession'])){
		header("Location: ../index");
		exit;
	}
	elseif (isset($_SESSION['userSession'])){
		$user_id = $_SESSION['userSession'];
		if (!isset($_GET['page'])) {
			$pn = 1;
		}else{
			$pn=$_GET['page'];
		}
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
					 <div class="col-md-12">
                            <div class="header">
                                <h4 class="title">Dashboard </h4>
                            </div>

                            <div class="col-lg-4">
									<div class="card" id="cards" style="background-color: rgb(12, 58, 125);">
										<p>Total Registered Donors</p><br>
										<span><?php echo database::getInstance()->count_from_ord3("donors","donor_id","desc"); ?></span>
									</div><!--end card-->
								</div>


								<div class="col-lg-4">
									<div class="card" id="cards" style="background-color: rgb(12, 58, 125);">
										<p>Today's Donations</p><br>
										<span><?php echo database::getInstance()->count_from_where("donations","DATE(date_added)",date("Y-m-d")); ?></span>
									</div><!--end card-->
								</div>

								<div class="col-lg-4">
									<div class="card" id="cards" style="background-color: rgb(12, 58, 125);">
										<p>Today's Requests</p><br>
										<span><?php echo database::getInstance()->count_from_where("blood_requests","DATE(date_added)",date("Y-m-d")); ?></span>
									</div><!--end card-->
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
<?php include 'notify.php'; ?>
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