
<?php 
	ob_start();
	session_start();
	$pageTitle = "Requests";
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
			<div style="padding-bottom:45px;">
			<a href="new_request" style="margin-bottom:10px;" class="btn btn-primary pull-right btn-flat btblack">
					<i class="entypo-plus-circled"></i> New Request
			</a>
			</div>
			
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">All Requests</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Requesting Clinician</th>
                                        <th>Patient's Name</th>
                                        <th>Age</th>
                                        <th>Sample Type</th>
                                        <th>Diagnosis</th>
                                        <th>Volume</th>
										<th>status</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_ord1('blood_requests','id','DESC');
											foreach($notarray as $row):
											$id = $row['id'];
											$diff = abs(strtotime($row['patient_dob']) - strtotime(date("Y-m-d")));
											$age = floor($diff/(365*60*60*24));
											$name = $row['patient_name'];
											$diag = $row['diagnosis'];
											$volume = $row['volume'];
											$sample_type = $row['sample_type'];
											$staff = $row['facility_clinician'];
									        ?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><i class="fas fa-user-md"></i><?php echo $staff; ?>
									        </td>
									        <td>
									        	<i class="fas fa-user"></i>
									        	<?php echo $name; ?>
									        </td>
									        <td><?php echo $age; ?></td>
                                        	<td>
                                        		<?php echo database::getInstance()->get_name_from_id("sample","samples","id",$sample_type); ?>
                                        			
                                        		</td>

                                        	<td>
                                        		<?php echo $diag; ?>
                                        			
                                        		</td>
                                        	<td><?php echo $volume; ?></td>
                                        	<td>
                                        		<?php 
                                        			if ($row['status'] == 1) {
                                        				?>
                                        					<div class="badge badge-success"> Processed</div>
                                        				<?php
                                        			}else{
                                        				?>
                                        					<div class="badge badge-warning"> Pending</div>
                                        				<?php
                                        			}
                                        		?>		
                                        	</td>
                                        	
                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">...</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
                                                    <li><a href="view_requests?id=<?php echo $id; ?>">View Details</a></li>
                                                    <li class="divider"></li>
													<li><a href="process_request?edit=<?php echo $id; ?>">Process</a></li>
													</ul>
												</div>
											</td>
                                        </tr>
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
										<th>#</th>
                                        <th>Requesting Clinician</th>
                                        <th>Patient's Name</th>
                                        <th>Age</th>
                                        <th>Sample Type</th>
                                        <th>Diagnosis</th>
                                        <th>Volume</th>
										<th>status</th>
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
            	message: "Are you sure you want to delete <b>"+name+"</b> From Donor List ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

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
            data: "val=" + val +  '&ins=delDonor',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>
