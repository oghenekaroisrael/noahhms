<?php 
	ob_start();
	session_start();
	$pageTitle = "Fluid Intake and Outake";
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
	$p_id = $_GET['id'];
	$ipid = $_GET['ipid'];
	$patient = "";
	$noarray = database::getInstance()->select_from_where_no_lim('patients','id',$p_id);
	 while ($or = $noarray->fetch(PDO::FETCH_ASSOC)) {
	 $patient = $or['first_name'].' '.$or['middle_name'].' '.$or['surname'];
	 }
	
?>

<div class="wrapper">
<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>

        <div class="content">
            <div class="container-fluid">
			<div style="padding-bottom:45px;">
			<a href="new_fluid?id=<?php echo $p_id; ?>&ipid=<?php echo $ipid; ?>" style="margin-bottom:10px;" class="btn btn-primary pull-right btn-flat btblack">
				<i class="entypo-plus-circled"></i> New Fluid
			</a>
			</div>
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
							<h4 class="title">Fluid Intake and Output Chart for <?php echo $patient; ?></h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Date</th>
                                    	<th>Time</th>
                                    	<th>Nature</th>
                                    	<th>Oral</th>
                                    	<th>Rectal</th>
                                    	<th>IV</th>
                                    	<th>Routes</th>
                                    	<th>Total</th>
                                    	<th>Urine</th>
                                    	<th>Vomit</th>
                                    	<th>Tube</th>
                                    	<th>Routes</th>
                                    	<th>Total</th>
                                    	<th>Balance</th>
                                    	<th>Chloride</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_where_ord('patient_fluid','ipd_patient_id',$ipid,'patient_fluid_id','DESC');
											foreach($notarray as $row):
											$date = date("jS M Y",strtotime($row['fdate_added']));
											$time = date("H:i",strtotime($row['fdate_added']));
											$id = $row['patient_fluid_id'];
						
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><?php echo $date;?></td>
                                        	<td><?php echo $time;?></td>
                                        	<td><?php echo $row['nature'];?></td>
                                        	<td><?php echo $row['oral'];?></td>
                                        	<td><?php echo $row['rectal'];?></td>
                                        	<td><?php echo $row['iv'];?></td>
                                        	<td><?php echo $row['intake_other'];?></td>
                                        	<td><?php echo $row['intake_total'];?></td>
                                        	<td><?php echo $row['urine'];?></td>
                                        	<td><?php echo $row['vomit'];?></td>
                                        	<td><?php echo $row['tube'];?></td>
                                        	<td><?php echo $row['output_other'];?></td>
                                        	<td><?php echo $row['output_total'];?></td>
                                        	<td><?php echo $row['balance'];?></td>
                                        	<td><?php echo $row['chloride'];?></td>
                                        	
                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">Action</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<li><a href="edit_fluid?edit=<?php echo $id; ?>">Edit</a></li>
													<li class="divider"></li>
													<li><a onclick="sure(<?php echo $id; ?>,'<?php echo $patient; ?>')">Delete</a></li>
													</ul>
												</div>
											</td>
                                        </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
                                        <th>Date</th>
                                    	<th>Time</th>
                                    	<th>Nature</th>
                                    	<th>Oral</th>
                                    	<th>Rectal</th>
                                    	<th>IV</th>
                                    	<th>Routes</th>
                                    	<th>Total</th>
                                    	<th>Urine</th>
                                    	<th>Vomit</th>
                                    	<th>Tube</th>
                                    	<th>Routes</th>
										<th>Total</th>
                                    	<th>Balance</th>
                                    	<th>Chloride</th>
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
            	message: "Are you sure you want to delete <b>"+name+"</b> From Fluid Intake AND Outake Chart ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

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
            data: "val=" + val +  '&ins=delFluid',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'fluid?id=<?php echo $p_id; ?>&ipid=<?php echo $ipid; ?>';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>
