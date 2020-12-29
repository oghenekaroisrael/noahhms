<?php 
	ob_start();
	session_start();
	$pageTitle = "Progress Note";
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
	
	$value = $_GET['id'];	
	$value2 = $_GET['pid2'];
	$ip = $_GET['ipid'];
	$pp_id = $value;
	if (isset($_POST) AND !empty($_POST) AND !empty($_POST['note'])) {
		$insert = database::getInstance()->insert_progress($_POST['note'], $value, $user_id);
		if ($insert == 'Done') {
			header("Location: progress.php?id=".$value."&pid2=".$value2."&ipid=".$ip."&status=done");
			unset($_POST);
		} else {
			header("Location: progress.php?id=".$value."&pid2=".$value2."&ipid=".$ip."&status=error");
			unset($_POST);
		}
		
	} else {
		unset($_POST);
	}
	$reqpat = Database::getInstance()->count_from('ipd_patients','appointment_id', $value2);
	$reqpat2 = Database::getInstance()->count_from('admission_request','appointment_id', $value2);
	$reqpat3 = Database::getInstance()->count_from('exam_request','appointment_id', $value2);
	
?>
<div class="wrapper">
<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>
<?php 
	if (isset($_GET['status']) AND $_GET['status'] == "done") {
		?>
		<div class="alert alert-success">Progress Note Added Successfully</div>
		<?php
	}else if (isset($_GET['status']) AND $_GET['status'] == "error") {
		?>
		<div class="alert alert-danger">Progress Note Could Not be Added</div>
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
                                <h4 class="title">Progress Note</h4>
                                <?php
                             $pid = database::getInstance()->get_name_from_id('patient_id','ipd_patients','id',$ip);
								 $userDetails = Database::getInstance()->select_from_where('patients', 'id', $pid);
											foreach($userDetails as $qw):
												 $name2 = $qw['title']." ".$qw['surname']." ".$qw['middle_name']." ".$qw['first_name'];
												 $sex = $qw['sex'];
												 $reg = $qw['reg_num'];
											endforeach; 
										?>	
										<div class="header text-center" style="text-align:center;">
			                               <h4 class="text-center" style="text-align:center"><strong>Patient's Name: <?php echo $name2;?></strong></h4>
										<p class="text-center" style="text-align:center">Reg No: <?php echo $reg;?></p>
			                            </div>
                            </div>
                             <div class="container">
                             	<div class="row">
			<div class="col-md-12">
				<h4>All Results</h4>
				<?php
					$count = 1; 
					$ntray =Database::getInstance()->select_from_where_ord('patient_test_group','patient_appointment_id', $value2,'patient_test_group_id','DESC');
					foreach($ntray as $rw):
					$res = $rw['awaiting_result'];
					$poiid = $rw['link_ref'];
					$vclas = "waiBtn";
					$statem = "Awaiting ".date('Y-m-d',strtotime($rw['date_added']))." Result";
					if($res == 1){
						$vclas = "waiSuc";
						$statem = "View ".date('Y-m-d',strtotime($rw['date_added']))." Result";
					}
				?>
			        <a style="color:#fff;" href = "view_test?id=<?php echo $poiid;?>&n=<?php echo $name2;?>&s=<?php echo $sex; ?>&a=<?php echo $age; ?>&pid=<?php echo $pp_id; ?>&did=<?php echo $doc_id; ?>"class="btn btn-primary pull-right btn-flat no-print <?php echo $vclas++;?>">
					<?php echo $statem;?>
				</a>
							
				<?php endforeach;?>
				<?php
					$count = 1; 
					$ntray =Database::getInstance()->select_from_where_ord('patient_xray_group','patient_appointment_id', $value2,'patient_xray_group_id','DESC');
					foreach($ntray as $rw):
					$res = $rw['awaiting_result'];
					$poiid = $rw['link_ref'];
					$vclas = "waiBtn2";
					$statem = "Awaiting ".date('Y-m-d',strtotime($rw['date_added']))." Xray";
					if($res == 1){
						$vclas = "waiSuc2";
						$statem = "View ".date('Y-m-d',strtotime($rw['date_added']))." Xray";
					}
					?>
			        <a style="color:#fff;" href="view_xray?id=<?php echo $poiid;?>&n=<?php echo $name2;?>&s=<?php echo $sex; ?>&a=<?php echo $age; ?>&pid=<?php echo $pp_id; ?>&did=<?php echo $doc_id; ?>" class="btn btn-primary pull-right btn-flat no-print <?php echo $vclas++;?>">
						<?php echo $statem;?>
					</a>
					
					<?php endforeach;?>
					<?php
					$count = 1; 
					$ntray =Database::getInstance()->select_from_where_ord('patient_scan_group','patient_appointment_id', $value2,'patient_scan_group_id','DESC');
					foreach($ntray as $rw):
					$res = $rw['awaiting_result'];
					$poiid = $rw['link_ref'];
					$vclas = "waiBtn2";
					$statem = "Awaiting ".date('Y-m-d',strtotime($rw['date_added']))." Scans";
					if($res == 1){
						$vclas = "waiSuc2";
						$statem = "View ".date('Y-m-d',strtotime($rw['date_added']))." Scans";
					}
					?>
			        <a style="color:#fff;" href="view_scans?id=<?php echo $poiid;?>&n=<?php echo $name2;?>&s=<?php echo $sex; ?>&a=<?php echo $age; ?>&pid=<?php echo $pp_id; ?>&did=<?php echo $doc_id; ?>" class="btn btn-primary pull-right btn-flat no-print <?php echo $vclas++;?>">
						<?php echo $statem;?>
					</a>
					
					<?php endforeach;?>
					<?php
					//SENT FROM FRONT DESK Specific Doctor
					$count = 1; 
					$ptid = $_GET['p'];
					$db =mysqli_connect("localhost","root","","noahhms");
					$send_test = mysqli_query($db, "SELECT * FROM `send_test` WHERE `staff_to` = $user_id AND patient_id = $ptid");
					while ($rw = mysqli_fetch_assoc($send_test)) {
						$pat = $rw['patient_id'];
						$link2 = $rw['link']; 
						$vclas = "sentlab";
						$statem = "Lab Test From Front Desk ".$rw['time'];
						if($rw['status'] == 1){
						$vclas = "sentlab2";
						$statem = "View Lab Result From Front Desk ".$rw['time'];
						}
					?>
			        <a style="color:#fff;" href = "view_test_front?id=<?php echo $link2;?>&pid=<?php echo $patient_id; ?>&did=<?php echo $user_id; ?>&stat=1"class="btn btn-primary pull-right btn-flat no-print <?php echo $vclas++;?>">
						<?php echo $statem;?>
					</a>
					
				<?php }?>
				<!--<?php
				//SENT FROM FRONT DESK All Doctors
					$count = 1; 
					$ntray2 = Database::getInstance()->select_from_front_desk_id($value2,$pp_id,$user_id);
					foreach($ntray2 as $rw2):
						$pat = $rw2['patient_id'];
						$link = $rw2['link_ref']; 
						$vclas = "sentlab";
						$db =mysqli_connect("localhost","root","","noahhms");
						$gt = mysqli_query($db, "SELECT * FROM patients WHERE id = ".$pp_id." LIMIT 1");
						$name = mysqli_fetch_assoc($gt);
						if($rw2['seen_result'] == 1){
						$vclas = "sentlab2";
						$statem = "View Lab Result From Front Desk For ".$name['surname']." ".$name['first_name'];
					}
						$statem = "Requested Lab Test From Front Desk For ".$name['surname']." ".$name['first_name'];
				?>
			    <a style="color:#000;" href = "view_test_front?id=<?php echo $link;?>&pid=<?php echo $pat; ?>&did=<?php echo $user_id; ?>&stat=1&front=<?php echo $rw2['front_desk']; ?>"class="btn btn-primary pull-right btn-flat no-print <?php echo $vclas++;?>">
					<?php echo $statem;?>
				</a>
				<?php endforeach;?>-->
			</div>
	    </div>
		<!--<div class="content">
			<div class="row">
				<div class="col-md-12">
				<div class="no-print"style="padding-bottom:45px;">
					<?php ?>
					
					
					<?php if($reqpat < 1 && $reqpat2 < 1){?>
															<button type="button" class="btn btn-primary pull-left btn-flat btblack" onclick="reqad();"><i class="entypo-plus-circled"></i>Request For Admission</button>
					<?php } ?>
					
					<?php if($reqpat2 >= 1){
						$ift = Database::getInstance()->get_name_from_id('status','admission_request','appointment_id', $value2);
						if($ift == 1){
							$hclas = "waiSuc";
							$wors = "Successful";
						}else{					
							$hclas = "waiBtn";
							$wors = "Pending";
						}
					
					?>
					
					<a  style="margin-bottom:10px;" class="btn btn-primary pull-left btn-flat <?php echo $hclas;?>" id="addre">
						Admission Request <?php echo $wors;?>
					</a>
					<?php } ?>
					<?php if($reqpat3 < 1){?>
					<button type="button" class="btn btn-primary pull-left btn-flat btblack" onclick="rexam();"><i class="entypo-plus-circled"></i>Request Examination</button>
					<?php } ?>
						
					<?php if($reqpat3 >= 1){
						$ift = Database::getInstance()->get_name_from_id('status','exam_request','appointment_id', $value2);
						if($ift == 1){
							$hclas = "waiSuc";
							$wors = "Successful";
						}else{
							$hclas = "waiBtn";
							$wors = "Pending";
						}
					
					?>
					<a  style="margin-bottom:10px;" class="btn btn-primary pull-left btn-flat <?php echo $hclas;?>" id="addre">
						Examination Request <?php echo $wors;?>
					</a>
					<?php } ?>
					
					
					
					</div>
					<div id="anyres">
						<?php 
							if ($_GET['res'] == 'Done') {
								?>
								<div class="alert alert-success">
									<strong>Physiotherapy</strong> Request Was Successful!
								</div>
								<?php
							}
						?>
					</div>
					<div id="adres" style="display: none;">
						<div class="alert alert-success">
							<strong>Admission</strong> Request Was Successful!
						</div>
					</div>	
				</div>
			</div>
		</div>-->
    </div>
						
	<!--------- MANAGEMENT and INVESTIGATION  ---->	
	    <div class="content no-print">
            <div class="container-fluid">
                
				<?php 
					$db = mysqli_connect("localhost","root","","noahhms");
					$get_pat = mysqli_query($db,"SELECT * FROM accounts WHERE item = 5 AND  patient_id = ".$pp_id." LIMIT 1");
					$get_pati = mysqli_fetch_assoc($get_pat);
					$font = mysqli_query($db, "SELECT front_desk FROM patients WHERE id = ".$pp_id." LIMIT 1");
					$front = mysqli_fetch_assoc($font);
				?>
							
                <div class="content">
					<div class="col-lg-12">
						<div class="row">
	                       	<div class="col-lg-6">
							   <h4 class="title">INVESTIGATION</h4>
								<div class="btn-group">
									<button type="button" class="btn btn-info">Investigation</button>
									<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
									<span class="caret"></span>
									<span class="sr-only">Toggle Dropdown</span>
									</button>
									<ul class="dropdown-menu" role="menu" >
										<li><a href="request_test_progress.php?id=<?php echo $value2;?>&progress=true">Request Test</a></li>
										
										<li class="divider"></li>
										<li >
										
										<a href="request_physiotherapy.php?pid=<?php echo $pp_id; ?>&staff=<?php echo $user_id; ?>&app=<?php echo $value2; ?>&front=<?php echo $front['front_desk']; ?>">Request Physiotheraphy</a></li>
									
										<!--<li class="divider"></li>
										<li><a>Request ECG</a></li>
										
										<li class="divider"></li>
										<li><a>Request ECHO</a></li>-->
										
										<li class="divider"></li>
										<li><a href="xray_request_progress.php?id=<?php echo $value2; ?>&pid=<?php echo $pp_id; ?>&doc=<?php echo $user_id; ?>&ipid=<?php echo $ip; ?>&progress=true">Request Xray</a></li>
										<li class="divider"></li>
														<li><a href="scan_request_progress.php?id=<?php echo $value2; ?>&pid=<?php echo $pp_id; ?>&doc=<?php echo $user_id; ?>&progress=true">Request Scan</a></li>
										
										<!--<li class="divider"></li>
										<li><a>Request Ultrasound</a></li>-->													
									</ul>
								</div> 
	                        </div>
	                        <div class="col-lg-6">
                    			<h4 class="title">MANAGEMENT</h4>
	                           	<div class="btn-group">
									<button type="button" class="btn btn-info">Management</button>
									<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
									<span class="caret"></span>
									<span class="sr-only">Toggle Dropdown</span>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li><a href="patient_details_progress.php?id=<?php echo $value2;?>&progress=true">Prescription</a></li>
										<li class="divider"></li>
										<!--<li><a>Request Injection</a></li>
										<li class="divider"></li>
										<li><a>Dressing</a></li>
									
										<li class="divider"></li>-->
									</ul>
								</div> 
	                        </div>
						</div>
					</div>						
				</div>            
            </div>			 
        </div>
                             </div>
			                            <div class="row">
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
										</table>

                            
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