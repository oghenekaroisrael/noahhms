<?php 
	ob_start();
	session_start();
	$pageTitle = "Surgery";
	// Include database class
	include_once '../inc/db.php';
	
	if(!isset($_SESSION['userSession'])){
		header("Location: ../index");
		exit;
	}
	elseif (isset($_SESSION['userSession'])){
		$user_id = $_SESSION['userSession'];
	}
	include_once '../inc/header-index.php'; //for addding header
	
	$value2 = $_GET['id'];	
	$value = $_GET['pid'];
	if (isset($_GET['nstat']) AND $_GET['nstat'] == 1) {
			if (isset($_GET['nid'])) {
				Database::getInstance()->notify_viewed($_GET['nid']);
			}
		}
	if (isset($_POST) AND !empty($_POST) AND !empty($_POST['note'])) {
		$insert = database::getInstance()->insert_operations_note($_POST['note'], $value2, $user_id);
		if ($insert == 'Done') {
			header("Location: surgery.php?id=".$value2."&pid=".$value."&status=done");
			unset($_POST);
		} else {
			header("Location: surgery.php?id=".$value2."&pid=".$value."&status=error");
			unset($_POST);
		}
		
	} else {
		unset($_POST);
	}
?>
<div class="wrapper">
<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>
<?php 
	if (isset($_GET['status']) AND $_GET['status'] == "done") {
		?>
		<div class="alert alert-success">Action Successful</div>
		<?php
	}else if (isset($_GET['status']) AND $_GET['status'] == "error") {
		?>
		<div class="alert alert-danger">Action Was Unsuccessful</div>
		<?php
	}
 ?>
        <div class="content">
            <div class="container-fluid">
				<div id="get_result"></div>
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Surgery Details</h4>
                                <?php
                             $pid = database::getInstance()->get_name_from_id('patient_id','ipd_patients','id',$value);
                             $date = database::getInstance()->get_name_from_id('surgery_date','surgery_perm','appointment_id',$value2);
								 $userDetails = Database::getInstance()->select_from_where('patients', 'id', $value);
											foreach($userDetails as $qw):
												 $name2 = $qw['title']." ".$qw['surname']." ".$qw['middle_name']." ".$qw['first_name'];
												 $sex = $qw['sex'];
												 $reg = $qw['reg_num'];
											endforeach; 
										?>	
										<div class="header text-center" style="text-align:center;">
			                               <h4 class="text-center" style="text-align:center"><strong>Patient's Name: <?php echo $name2;?></strong></h4>
										<p class="text-center" style="text-align:center">Reg No: <?php echo $reg;?></p>
										<p class="text-center" style="text-align:center">Scheduled Date: <b><?php echo $date;?></b></p>
			                            </div>
                            </div><!--end of header -->

                            <div class="card-body">
                            	<div id="accordion">
                            		<button type="button" class="btn btn-info btn-large" type="button" data-toggle="collapse" data-target="#pre-check" aria-expanded="false" aria-controls="pre-check" style="width: 100%;margin-bottom: 20px;">
                            			Pre-Operative Checklist</button>
                            		<div class="collapse" id="pre-check">
                            	<?php
                            	$get_answers = Database::getInstance()->select_from_where('prechecklist','appointment_id',$value2);
                            		foreach ($get_answers as $answer) {
                            			$q1 = $answer['q1'];
										$q2 = $answer['q2'];
										$q3 = $answer['q3'];
										$q4 = $answer['q4'];
										$q5 = $answer['q5'];
										$q6 = $answer['q6'];
										$q7 = $answer['q7'];
										$q8 = $answer['q8'];
										$q9 = $answer['q9'];
										$q10 = $answer['q10'];
										$q11 = $answer['q11'];
										$q12 = $answer['q12'];
										$q13 = $answer['q13'];
										$q14 = $answer['q14'];
										$q15 = $answer['q15'];
										$q16 = $answer['q16'];
										$q17 = $answer['q17'];
                            		}
                            ?>
                            <div class="container">
                            	<div class="row">
                                        <div class="col col-md-8"><label class=" form-control-label">Has patient been assessed by the anaesthesiologist? </label></div>
                                        <div class="col col-md-4">
                                          <?php echo $q1; ?>
                                     </div>
                                </div>

                                <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Was premedicant prescribe? </label></div>
                                        <div class="col col-md-4">
                                         
                                          <?php echo $q2; ?>
                                     </div>
                                </div>

                                <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">If yes, has it been glven [YES /NO] Any reaction? </label></div>
                                        <div class="col col-md-4">
                                         
                                          <?php echo $q3; ?>
                                     </div>
                                </div>

                                <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Was blood or blood product prescribed?</label></div>
                                        <div class="col col-md-4">
                                         
                                          <?php echo $q4; ?>
                                     </div>
                                </div>

                                <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">if yes, is blood available now?</label></div>
                                        <div class="col col-md-4">
                                          
                                          <?php echo $q5; ?>
                                     </div>
                                </div>

                                <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">If yes, has Patient accepted to receive blood?</label></div>
                                        <div class="col col-md-4">
                                          
                                          <?php echo $q6; ?>
                                     </div>
                                </div>

                                <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Are patient's Laboratory results availabile?</label></div>
                                        <div class="col col-md-4">
                                        
                                          <?php echo $q7; ?>
                                     </div>
                                </div>

                                 <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Has informed consent been taken and form signed?</label></div>
                                        <div class="col col-md-4">
                                          
                                          <?php echo $q8; ?>
                                     </div>
                                </div>

                                 <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Is Patient starved appropriately?</label></div>
                                        <div class="col col-md-4">
                                         
                                          <?php echo $q9; ?>
                                     </div>
                                </div>

                                 <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Is Patient shaved?</label></div>
                                        <div class="col col-md-4">
                                          
                                          <?php echo $q10; ?>
                                     </div>
                                </div>



                                 <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Is Patient changed into Operating Theatre outfit?</label></div>
                                        <div class="col col-md-4">
                                          
                                          <?php echo $q11; ?>
                                     </div>
                                </div>

                                 <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Are Patient's vital signs checked and recorded?</label></div>
                                        <div class="col col-md-4">
                                          
                                          <?php echo $q12; ?>
                                     </div>
                                </div>

                                 <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Are All pre-operative requests e.g Drugs,Fluids, Instruments,Drapes,e.t.c Ready?</label></div>
                                        <div class="col col-md-4">
                                          
                                          <?php echo $q13; ?>
                                     </div>
                                </div>

                                 <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Has the Patient Dentures?</label></div>
                                        <div class="col col-md-4">
                                          
                                          <?php echo $q14; ?>
                                     </div>
                                </div>	

                                 <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Has it Been removed?</label></div>
                                        <div class="col col-md-4">
                                          
                                          <?php echo $q15; ?>
                                     </div>
                                </div>

                                 <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Has the Patient's Jewelry been removed?</label></div>
                                        <div class="col col-md-4">
                                          
                                          <?php echo $q16; ?>
                                     </div>
                                </div>

                                 <div class="row form-group">
                                        <div class="col col-md-8"><label class=" form-control-label">Has Catether been passed?</label></div>
                                        <div class="col col-md-4">
                                          
                                          <?php echo $q17; ?>
                                     </div>
                                </div>
                               </div>
                            </div>
                        </div><!--end of precheck list-->
                        <div id="accordion">
                        <button type="button" class="btn btn-info btn-large" type="button" data-toggle="collapse" data-target="#op_note" aria-expanded="false" aria-controls="op_note" style="width: 100%;margin-bottom: 20px;">
                            			Operation Note</button>
                        <div class="collapse" id="op_note">
                        	<form method="POST">
			                            		<div class="col-lg-1"></div>
			                            	<div class="col-lg-8">
			                            		<div class="form-group">
			                            			<label>New Note</label>
			                            			<textarea name="note" class="form-control"></textarea>
			                            		</div>
			                            	</div>
			                            	<div class="col-lg-3">
			                            		<button class="btn btn-info" type="submit" style="margin-top: 40px;">Upload</button>
			                            	</div>
			                            	</form>
										<table class="table table-stripped">
											<thead>
												<th>#</th>
												<th>Operations Note</th>
												<th>Doctor</th>
												<th>Date Added</th>
											</thead>
											<tbody>
												<?php $notarray =Database::getInstance()->select_from_where_ord('operations','appointment_id', $value2,'date_added',"DESC");
										$count = 1;
										foreach($notarray as $ow):
											$note = $ow['note'];
											$date_added =$ow['date_added'];
											$added_by =$ow['added_by'];

											$staff = database::getInstance()->select_from_where2('staff','user_id',$added_by);
											foreach ($staff as $emp) {
												$Doctor = $emp['last_name']. " ".$emp['first_name'];
											}
											?>
											<tr>
												<td><?php echo $count++; ?></td>
												<td><?php echo $note; ?></td>
												<td><?php echo $Doctor; ?></td>
												<td><?php echo $date_added; ?></td>
											</tr>
											<?php
										endforeach; ?>
											</tbody>
											<thead>
												<th>#</th>
												<th>Operations Note</th>
												<th>Doctor</th>
												<th>Date Added</th>
											</thead>
										</table>
                        </div><!--end of Operations Note-->
	    </div>
    </div>

                             </div>
			                            <!--<div class="row">
			                            	<form method="POST">
			                            		<div class="col-lg-1"></div>
			                            	<div class="col-lg-8">
			                            		<div class="form-group">
			                            			<label>New Note</label>
			                            			<textarea name="note" class="form-control"></textarea>
			                            		</div>
			                            	</div>
			                            	<div class="col-lg-3">
			                            		<button class="btn btn-info" type="submit" style="margin-top: 40px;">Upload</button>
			                            	</div>
			                            	</form>
			                            </div>
										<table class="table table-stripped" style="overflow-y: scroll;height: 700px;">
											<thead>
												<th>#</th>
												<th>Progress</th>
												<th>Doctor</th>
												<th>Date Added</th>
											</thead>
											<tbody>
												<?php $notarray =Database::getInstance()->select_from_where_ord('progress','ipd_numb', $value,'date_added',"DESC");
										$count = 1;
										foreach($notarray as $ow):
											$note = $ow['note'];
											$date_added =$ow['date_added'];
											$added_by =$ow['added_by'];

											$staff = database::getInstance()->select_from_where2('staff','user_id',$added_by);
											foreach ($staff as $emp) {
												$Doctor = $emp['last_name']. " ".$emp['first_name'];
											}
											?>
											<tr>
												<td><?php echo $count++; ?></td>
												<td><?php echo $note; ?></td>
												<td><?php echo $Doctor; ?></td>
												<td><?php echo $date_added; ?></td>
											</tr>
											<?php
										endforeach; ?>
											</tbody>
											<thead>
												<th>#</th>
												<th>Progress</th>
												<th>Doctor</th>
												<th>Date Added</th>
											</thead>
										</table>-->

                            
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
            	message: "Are you sure you want to delete <b>"+name+"</b> from list ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

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
            data: "val=" + val +  '&ins=delAdminReq',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'new_request';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>
	
<script type="text/javascript">
		var f=jQuery .noConflict();
		f('#pro').on('change', '#status', function(e) {
			var selected = f(this).val();
			var ins = 'changeAdmiStatus';
			//get current row
			var currentRow = f(this).closest("tr"); 
			var app_id = currentRow.find("td:eq(1)").text(); // get value of coloumn 2
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			f.ajax({
				type: 'post',
				url: '../func/verify.php',
				data: { selected: selected, app_id: app_id, ins: ins},
				success: function(res){
					document.getElementById("load").style.display = "none";
					jQuery('#get_result').html(res).show();
						//console.log(res);
				}
			});

		});
</script>