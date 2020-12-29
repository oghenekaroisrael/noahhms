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
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Payment </h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                    	<th>Patient</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_group('accounts','date_added', 'id','DESC');
											foreach($notarray as $row):
											$id = $row['id'];
											
											$patient_id = $row['patient_id'];
											$app_id = $row['app_id'];
											
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	
                                        	<td>
                                        		<?php
                                        			$userDetails = Database::getInstance()->select_from_where2('patients', 'id', $patient_id);
														foreach($userDetails as $oow):
															
															echo $name = $oow['title']." ".$oow['surname']." ".$oow['middle_name'];	
														endforeach; 
                                        		?>
                                        		
                                        	</td>
                                        	
                                        	
                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">Action</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
														<li><a href="acc_details?id=<?php echo $app_id; ?>">View Details</a></li>
													
													</ul>
												</div>
											</td>
                                        </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
                                        <th>Patient</th>
                                    	
                                    	<th>Action</th>
                                    </thead>
								</table>

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