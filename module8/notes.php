<?php 
	ob_start();
	session_start();
	$pageTitle = "View Nurse's Note";
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
	
	$value = $_GET['id'];
	if (isset($_POST) AND !empty($_POST) AND !empty($_POST['note'])) {
		$insert = database::getInstance()->insert_note($_POST['note'], $value, $user_id);
		if ($insert == 'Done') {
			header("Location: notes.php?id=$value&status=done");
			unset($_POST);
		} else {
			header("Location: notes.php?id=$value&status=error");
			unset($_POST);
		}
		
	} else {
		unset($_POST);
	}
	
?>
<style type="text/css">
	#notes > .col-lg-2 > center{
		position: relative;
		top: -40px;
	}
	#notes > .col-lg-9 > .card{
		height: 100px;
		padding: 20px;
	}
	#notes > .col-lg-9 > .card > font{
		color: #BCBABA;
		position: absolute;
		top: 55%;
		left: 5%;
	}

</style>
<div class="wrapper">
<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>

        <div class="content">
            <div class="container-fluid">
				<div id="get_result"></div>
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Nurse's Notes</h4>
                            </div>
                             <?php
                             $pid = database::getInstance()->get_name_from_id('patient_id','ipd_patients','id',$value);
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
			                            <div class="row">
			                            	<form method="POST" action="notes.php?id=<?php echo $value; ?>">
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
										<?php $notarray =Database::getInstance()->select_from_where2('notes','ipd_numb', $value);
										$count = 1;
										foreach($notarray as $ow):
											$note = $ow['note'];
											$date_added =$ow['date_added'];
											$added_by =$ow['added_by'];
											$staff = database::getInstance()->select_from_where2('staff','user_id',$added_by);
											foreach ($staff as $emp) {
												$nurse = $emp['last_name']. " ".$emp['first_name'];
											}
											?>
											<div class="row" id="notes">
											<div class="col-lg-2">
												<center>
												<h1><?php echo date("d",strtotime($date_added)); ?></h1>
												<h3><?php echo date("M",strtotime($date_added)); ?></h3>
												</center>
											</div>
											<div class="col-lg-9">
												<div class="card"><?php echo $note; ?>
												<font><?php echo $nurse; ?></font>
												</div>
											</div>
											<div class="col-lg-1"></div>
										</div>
											<?php
										endforeach; ?>
											
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