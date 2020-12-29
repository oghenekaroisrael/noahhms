<?php 
	ob_start();
	session_start();
	$pageTitle = "Visitor Log";
	// Include database class
	include_once '../inc/db.php';
	
	if(!isset($_SESSION['userSession'])){
		header("Location: ../index");
		exit;
	}
	elseif (isset($_SESSION['userSession'])){
		$user_id = $_SESSION['userSession'];
		if (isset($_GET['nstat']) AND $_GET['nstat'] == 1) {
			if (isset($_GET['nid'])) {
				Database::getInstance()->notify_viewed($_GET['nid']);
			}
		}
	}
	$db = mysqli_connect("localhost","root","","noahhms");
	include_once '../inc/header-index.php'; //for addding header
		 $value = $_GET['id'];
?>
<style>
			@media print {
    .no-print{display: none;}
	 @page {
           margin-top: 0;
           margin-bottom: 0;
         }
         body  {
           padding-top: 30px;
           padding-bottom: 72px ;
           width:100%;
         }
         
}
			</style>
<div class="wrapper" id="homesc">

<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>
	
	   <!--  MAIN -->
        <div class="content">
            <div class="container-fluid">
				<div class="row" style="margin-bottom: 20px;">
					<div class="col-md-8">
					</div>
				</div>
				<?php 
					$notarray = database::getInstance()->select_from_where2('visitors_log','id', $value);
										foreach($notarray as $ow):	
											$name = $ow['name'];
											$s_id = $ow['staff'];
											$tel = $ow['tel'];
											$sex = $ow['sex'];
											$address = $ow['address'];
											$reason = $ow['reason'];
											$status = $ow['status'];
											$remark = $ow['remark'];
											$time = $ow['time_added'];
											$date_added =$ow['date_added'];
										endforeach; 
										$userDetails = Database::getInstance()->select_from_where('staff', 'user_id', $s_id);
											foreach($userDetails as $qw):
												 $name2 = $qw['last_name']." ".$qw['first_name'];
											endforeach; 
				 ?>

				<div class="card">
					<div class="container" style="padding-top: 50px;padding-bottom: 50px;">
						<div class="row">
							 <div class="col-md-6" style="border-right-style: solid;border-right-width: 1px;border-right-color: #ddd; ">

		                        	<div class="col-lg-12">
		                        		<div class="row text-center" style="margin-top: 16px;">
																															<div class="col-lg-6">
		                        							<h3  style="font-family:sans-serif;"><b>Visitor's Name</b></h3>
		                        							<h4><?php echo $name;?></h4>
		                        					</div>
		                        					<div class="col-lg-6">
		                        							<h3   style="font-family:sans-serif;"><b>Visiting Staff</b></h3>
		                        							<h4><?php echo $name2;?></h4>
		                        					</div>
		                        				</div>
		                        		</div>
		                     </div>
		                     <div class="col-md-6" id="detss">
		                     	<div class="row">

		                        			
		                     		<div class="col-lg-6">
		                     			<label>Sex: </label>
		                     			<strong><?php echo $sex; ?></strong>
		                     		</div>

		                     		<div class="col-lg-6">
		                     			<label>Date: </label>
		                     			<strong><?php echo $date_added; ?></strong>
		                     		</div>
		                     </div>

		                     <div class="row">
		                     	<div class="col-lg-6">
		                     			<label>Address: </label>
		                     			<strong><?php echo $address; ?></strong>
		                     		</div>
		                     		<div class="col-lg-6">
		                     			<label>status: </label>
		                     			<strong>
		                     				<?php 
		                     					if($status == 1){
                                        				?>
                                        				<div class="badge badge-success">Seen</div>
                                        				<?php
                                        			} else if($status == 2){?>
                                        				<div class="badge badge-danger">Cancelled</div><?php
                                        			} else if($status == 0){?>
                                        				<div class="badge badge-default">Pending</div><?php
                                        			}
		                     			 ?>
		                     			 </strong>
		                     		</div>		
		                     </div>
 

		                     <div class="row">
		                     		<div class="col-lg-6">
		                     			<label>Tel: </label>
		                     			<strong><?php echo $tel; ?></strong>
		                     		</div>
		                     	

		                </div>
		               </div>
		              </div>
		             </div>

		               

		                        					 <hr class="my-4">

		                <div class="col-md-6">
		                	<div class="row">
		                		<div class="col-md-12">
		                			  <h4 style="font-family:sans-serif; margin-left: 27px;"><b>Reason For Visit:</b></h4>
		                 			<div class="card" style="height: 280px; margin-left: 27px; font-size: 15px;">
		                 				<div class="card-body">
		                 					<p class="lead"  style="padding-left: 10px; font-size: 21px; padding-top: 20px; font-family: 'poppins';"  >	<?php echo $reason;?></p>
		                 				</div>
		                 				</div>
		                       
		                   	</div>
		                	</div>
		                </div>



		                <div class="col-md-6">
		                	<div class="row">
		                		<div class="col-md-12">
		                			  <h4 style="font-family:sans-serif; margin-left: 27px;"><b>Staff's Remark:</b></h4>
		                 			<div class="card" style="height: 280px; margin-left: 27px; font-size: 15px;">
		                 				<div class="card-body">
		                 					<p class="lead"  style="padding-left: 10px; font-size: 21px; padding-top: 20px; font-family: 'poppins';"  >	<?php echo $remark;?></p>
		                 				</div>
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

	s("#deletebtn").on("click",function(){

	    var pex=window.confirm("are you sure you want to delete this casenote?");
	    if(pex){
            window.location = 'lab_results.php?id=<?php echo $value;?>&p=<?php echo $_GET['p']; ?>&del=np';
        }

    });
 function sure(ID,name){ 

        	s.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to delete <b>"+name+"</b> From File List ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

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
            data: "val=" + val +  '&ins=delExtraFile',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'lab_results?id=<?php echo $value ?>';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}
		
		function reqad(){ 
		var p_id = <?php echo $pp_id ?>; 
		var val = <?php echo $value ?>;
		var doc = <?php echo $user_id ?>; 
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/verify.php',
            data: "val=" + val +  '&p_id=' + p_id +  '&doc_id=' + doc + '&ins=requestAdmission',
             success: function(data)
            {
				document.getElementById("load").style.display = "none";
				if(data == "Done"){
					document.getElementById("adres").style.display = "block";
					document.getElementById("addre").style.display = "none";
				}else{
					s("#anyres").html(data).fadeIn("slow");
				}
				
            }
          });
		}

		/*function Physiotheraphy(pid,staff,app,front_desk){ 
		var pid = pid; 
		var app = app;
		var staff = staff;
		var front_desk = front_desk;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/verify.php',
            data: "app=" + app +  '&pid=' + pid +  '&staff=' + staff + '&front=' + front_desk + '&ins=request_physiotherapy',
             success: function(data)
            {
				document.getElementById("load").style.display = "none";
				if(data == "Done"){
					document.getElementById("addre").style.display = "none";
				}else{
					s("#anyres").html(data).fadeIn("slow");
				}
				
            }
          });
		}*/
	
		function rexam(){ 
		var p_id = <?php echo $pp_id ?>;
		var val = <?php echo $value ?>;
		var doc = <?php echo $user_id ?>;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/verify.php',
            data: "val=" + val +  '&p_id=' + p_id +  '&doc_id=' + doc + '&ins=requestExam',
             success: function(data)
            {
				document.getElementById("load").style.display = "none";
				if(data == "Done"){
					document.getElementById("addre").style.display = "none";
				}else{
					s("#anyres").html(data).fadeIn("slow");
				}
				
            }
          });
		}
		 function myFunction() {
    window.print();
}
</script>

<script type="text/javascript">

	var s=jQuery .noConflict();
	s(document).ready(function() {
		s('#diag').submit(function(e){
			var id = "<?php echo $value; ?>";
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			s.ajax({
				type: "POST",
				data: s('#diag').serialize() + "&val=" + id + "&ins=addDiagnosis",
				url: "../func/verify.php",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					s("#get_result3").html(res).fadeIn("slow");
				}
			});
		})			
	})			
</script>
<script type="text/javascript">
		var f=jQuery .noConflict();
		function todoSession(app,id) {
                    f.ajax({
                        url: 'session.php',
                        method: 'POST',
                        data: "app="+app+"&id="+id,
                        success: function (res) {
                            if (res == "Done" || res == "Done2"){
                            					window.location = "lab_results?p=<?php echo $_GET['p']; ?>&id=<?php echo $_GET['id']; ?>";
                            }
                        }
                    })
                }
		f('#pro').on('change', '#status', function(e) {
			var selected = f(this).val();
			var ins = 'changePrescriptionStatus';
			var pre_id = "<?php echo $pre_id; ?>";
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			f.ajax({
				type: 'post',
				url: '../func/verify.php',
				data: { selected: selected, pre_id: pre_id, ins: ins},
				success: function(res){
					document.getElementById("load").style.display = "none";
					if (res == "Done") {
						location.reload();
					}
						//console.log(res);
				}
			});

		});
		
function goBack() {
  window.history.back();
}
</script>