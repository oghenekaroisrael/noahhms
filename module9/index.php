<?php
	ob_start();
	session_start();
	$pageTitle = "OPD";
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
						<div class="col-lg-8 pull-left widthLeft">
							<div class="card">
								
							</div><!--end content-->
							</div><!--end card-->

						</div><!--ed col 8-->
						<!--sidebar-->
						<div class="col-lg-4 pull-right widthRight">
							<?php //empty side bar fro now?>
						</div>
						<!--end col-lg-4-->
						<div class="clear"></div>
						
						</div>
					</div><!--end row-->
				</div>
			</div>
			
			<?php 
				include_once 'inc/footer-member.php';
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