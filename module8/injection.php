<?php 
	ob_start();
	session_start();
	$pageTitle = "View Injections";
	// Include database class
	include_once '../inc/db.php';
	
	If(!isset($_SESSION['userSession'])){
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
	include_once '../inc/header-index.php'; //for addding header
	
	$value = $_GET['view'];
?>

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
                                <h4 class="title">Injection Status</h4>
                            </div>

                            <div class="container">
                            <div class="content table-responsive table-full-width">
                                <table id="pro" class="table table-hover table-striped">
                            			<thead>
                            				<th>#</th>
                            				<th>Injection</th>
                            				<th>Quantity</th>
                            				<th>Frequency</th>
                            				<th>Duration(Days)</th>
                            				<th>Instruction</th>
                            				<th>Status</th>
                            				<th>Action</th>
                            			</thead>
                            	<?php 
                            		$notarray2 = database::getInstance()->select_from_where2('prescription1', 'appointment_id', $value);
                            		$count = 1;
                            		foreach ($notarray2 as $injection) {
                            			$iid = $injection['prescription_id'];
                            			$inj = database::getInstance()->get_name_from_id("name","pharm_stock","id",$injection['stabs']);
                            			$dosage = $injection['sdosage'];//times per day
                            			$tabs = $injection['stabs'];//quantity per dispense
                            			$duration = $injection['sduration'];//days
                            			$instr = $injection['instruction'];//Doctor's order
                            			$status = $injection['status'];
                            			?>
                            				<tr>
                            					<td><?php echo $count++; ?></td>
                            					<td><?php echo $inj; ?></td>
                            					<td><?php echo $tabs; ?></td>
                            					<td><?php if ($dosage == 1) {
                                        			echo "Daily";
                                        		}elseif ($dosage == 2) {
                                        			echo "B.D";
                                        		}elseif ($dosage == 3) {
                                        			echo "T.D.S";
                                        		}elseif ($dosage == 4) {
                                        			echo "Q.D.S";
                                        		} ?></td>
                            					<td><?php echo $duration; ?></td>
                            					<td><?php echo $instr; ?></td>
                            					<td>
                            						<?php 
                            							if ($status == 0) {
                            								?>
                                                            <div class="badge badge-success">Completed</div>
                                                            <?php
                            							}else{?>
                            								<div class="badge badge-info"><?php echo $status." Left"; ?></div>
                                                            <?php
                            							}
                            					 	?>
                            					 	
                            					 </td>
                            					<td>
                            						<a  class="btn btn-info" <?php if ($status > 0) {?>
                            							onclick="sure1(<?php echo $iid; ?>,`<?php echo $inj; ?>`);"
                            						<?php }else{ ?> disabled <?php } ?>> Give Injection</a>
                            					</td>
                            				</tr>
                            			<?php
                            		}
                            	 ?>
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
		function sure1(ID,name){ 

        	f.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to Give <b>"+name+"</b> to this Patient?</br><button type='button' class='btn pop-btn' onclick='inject("+ID+")'>Yes</button>"

            },{
                type: 'info',
                timer: 100000
            });

    	}
    	function inject(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
         f.ajax({
                type: "POST",
                data: '&ins=updateInject' + '&val='+val,
                url: "../func/edit.php",
                success: function(res) {
                    document.getElementById("load").style.display = "none";
                    a("#get_result").html(res).fadeIn("slow");
                    window.location="injection?view=<?php echo $_GET['view']; ?>&id=<?php echo $_GET['id']; ?>&rid=<?php echo $_GET['rid']; ?>";
                }
            });
		}
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