<?php 
	ob_start();
	session_start();
	$pageTitle = "Patient Chart";
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
			
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Patient's Chart For <?php echo $patient; ?></h4>
                            </div>
                            <div class="container-fluid">
                            	<div id="accordion">
                            		<button type="button" class="btn btn-info btn-large" type="button" data-toggle="collapse" data-target="#obs" aria-expanded="false" aria-controls="obs" style="width: 100%;margin-bottom: 20px;">
                            			Observations</button>
                            		<div class="collapse" id="obs">
                            			<div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Date</th>
                                    	<th>Time</th>
                                    	<th>Temp</th>
                                    	<th>Resr</th>
                                    	<th>Pulse</th>
                                    	<th>B/P</th>
                                    	<th>Intake</th>
                                    	<th>Output</th>
                                    	<th>By</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_obs1($ipid);
											foreach($notarray as $row):
											$date = date("jS M Y",strtotime($row['odate_added']));
											$time = date("H:i",strtotime($row['odate_added']));
											$id = $row['patient_obs_id'];
											$by = $row['first_name'].' '.$row['last_name'];
						
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><?php echo $date;?></td>
                                        	<td><?php echo $time;?></td>
                                        	<td><?php echo $row['temp'];?></td>
                                        	<td><?php echo $row['resr'];?></td>
                                        	<td><?php echo $row['pulse'];?></td>
                                        	<td><?php echo $row['bp'];?></td>
                                        	<td><?php echo $row['intake'];?></td>
                                        	<td><?php echo $row['output'];?></td>
                                        	<td><?php echo $by;?></td>
                                        </tr>
			                         <?php endforeach;?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
                                        <th>Date</th>
                                    	<th>Time</th>
                                    	<th>Temp</th>
                                    	<th>Resr</th>
                                    	<th>Pulse</th>
                                    	<th>B/P</th>
                                    	<th>Intake</th>
                                    	<th>Output</th>
                                    	<th>By</th>
                                    </thead>
								</table>

                            </div>
                            		</div>

                            		<button type="button" class="btn btn-info btn-large" type="button" data-toggle="collapse" data-target="#med" aria-expanded="false" aria-controls="med" style="width: 100%;margin-bottom: 20px;">
                            			Medication</button>
                            		<div class="collapse" id="med">
                            			<div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Date</th>
                                    	<th>Time</th>
                                    	<th>Drug</th>
                                    	<th>Dosage</th>
                                    	<th>Method</th>
                                    	<th>Remark</th>
                                    	<th>By</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_dis($ipid);
											foreach($notarray as $row):
											$date = date("jS M Y",strtotime($row['ddate_added']));
											$time = date("H:i",strtotime($row['ddate_added']));
											$id = $row['dispensing_chart_id'];
											$by = $row['first_name'].' '.$row['last_name'];
						
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><?php echo $date;?></td>
                                        	<td><?php echo $time;?></td>
                                        	<td><?php echo $row['name'];?></td>
                                        	<td><?php echo $row['dosage'];?></td>
                                        	<td><?php echo $row['meth_administration'];?></td>
                                        	<td><?php echo $row['remark'];?></td>
                                        	<td><?php echo $by;?></td>
                                        </tr>
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
                                        <th>Date</th>
                                    	<th>Time</th>
                                    	<th>Drug</th>
                                    	<th>Dosage</th>
                                    	<th>Method</th>
                                    	<th>Remark</th>
                                    	<th>By</th>
                                    </thead>
								</table>

                            </div>
                            		</div>

                            		<button type="button" class="btn btn-info btn-large" type="button" data-toggle="collapse" data-target="#flu" aria-expanded="false" aria-controls="flu" style="width: 100%;margin-bottom: 20px;">
                            			Fluid Intake/Output</button>
                            		<div class="collapse" id="flu">
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
                                    </thead>
								</table>

                            </div>
                            		</div>
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
            	message: "Are you sure you want to delete <b>"+name+"</b> From In-Patient Observation List ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

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
            data: "val=" + val +  '&ins=delObs',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'obs?id=<?php echo $p_id; ?>&ipid=<?php echo $ipid; ?>';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>