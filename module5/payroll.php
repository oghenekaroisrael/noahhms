<?php 
	ob_start();
	session_start();
	$pageTitle = "Payroll";
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
			<div id="get_resultw"></div>
			<?php 
				if (isset($_GET['delete']) && $_GET['delete'] == "successful") {
					?>
						<div class="alert alert-success">Payroll Slip Erased Successfully</div>
					<?php
				}else if(isset($_GET['delete']) && $_GET['delete'] == "unsuccessful"){
					?>
						<div class="alert alert-danger">Payroll Slip Could Not Be Erased Successfully</div>
					<?php
				}

			 ?>
			<div style="padding-bottom:45px;">
			<a href="pay_staff" style="margin-bottom:10px;" class="btn btn-primary pull-right btn-flat btblack">
					<i class="entypo-plus-circled"></i> Pay Staff
			</a>
			</div>
			
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">All Paid Staff</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
                                        <th>#</th>
                                        <th>Name</th>
                                    	<th>Role</th>
                                    	<th>Email</th>
                                    	<th>Phone Number</th>
                                    	<th>Salary</th>
                                    	<th>Date Paid</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_ord1('payroll','id','DESC');
											foreach($notarray as $row):
											$id = $row['staff_id'];
											$payroll_id = $row['id'];
											$salary = $row['net_salary'];
											$notarray2 = database::getInstance()->select_from_where2('staff','user_id',$id);
											foreach ($notarray2 as $row2) {
												$img = $row2['image'];		
												$first = $row2['first_name'];
												$last = $row2['last_name'];
												$row_id = $row2['role_id'];
												$status = $row2['status'];
												$name = $first." ".$last;
												$email = $row2['email'];
												$phone = $row2['phone'];
											}
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><?php echo $name;?></td>
                                        	
                                        	<?php
											
												$noarray = database::getInstance()->select_from_where('user_roles','id',$row_id);
												while ($ow = $noarray->fetch(PDO::FETCH_ASSOC)) {?>	
													<td><?php echo $ow['name'];?></td>
											<?php } ?>
											<td><?php echo $email; ?></td>
											<td><?php echo $phone; ?></td>
											<td>&#8358;<?php echo $salary; ?></td>
                                        	<td>
                                        		<?php 
												$fDate = $ow['date_paid'];
												$dt = new DateTime($fDate); //for getting just date from timestamp
											?>
											<?php echo $dt->format('d-M-Y'); ?>
                                        	</td>
							
                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">...</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
														<li><a href="edit_slip?id=<?php echo $payroll_id;?>">Edit Slip</a></li>
														<li class="divider"></li>
														<li><a href="slip?id=<?php echo $payroll_id;?>">Generate Slip</a></li>
														<li class="divider"></li>
														<li><a onclick="delet(<?php echo $payroll_id; ?>);">Delete Slip</a></li>
													</ul>
												</div>
											</td>
                                        </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
                                        <th>Name</th>
                                    	<th>Role</th>
                                    	<th>Email</th>
                                    	<th>Phone Number</th>
                                    	<th>Salary</th>
                                    	<th>Date Paid</th>
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
            	message: "Are you sure you want to delete <b>"+name+"</b> From user list ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

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
            data: "val=" + val +  '&ins=delPayroll',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'payroll?delete=successful';
				  }
				  else {
					   
						window.location = 'payroll?delete=unsuccessful';
				  }
            }
          });
		}

    </script>
	
	
<script type="text/javascript">
		var f=jQuery .noConflict();
		f('#pro').on('change', '#status', function(e) {
			var selected = f(this).val();
			var ins = 'changeAppStatus';
			//get current row
			var currentRow = f(this).closest("tr"); 
			var staff_id = currentRow.find("td:eq(1)").text(); // get value of coloumn 2
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			f.ajax({
				type: 'post',
				url: '../func/verify.php',
				data: { selected: selected, staff_id: staff_id, ins: ins},
				success: function(res){
					document.getElementById("load").style.display = "none";
					jQuery('#get_resultw').html(res).show();
						//console.log(res);
				}
			});

		});
</script>
	
