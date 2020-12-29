<?php 
	ob_start();
	session_start();
	$pageTitle = "Company Bills";
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
	$db = mysqli_connect("localhost","root","","noahhms");
	$sql = mysqli_query($db, "SELECT * FROM companies");
	$sql2 = mysqli_query($db, "SELECT SUM(amount) FROM company_bill");
	$count_all = mysqli_num_rows($sql);
	while ($amount_al = mysqli_fetch_assoc($sql2)) {
		$amount_all += $amount_al['SUM(amount)'];
	}
	 $perc = mysqli_query($db,"SELECT percentage FROM `percentage` ");
    $percent1 = mysqli_fetch_assoc($perc);
    $percent = $percent1['percentage'];
?>

<div class="wrapper">
<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>

        <div class="content">
            <div class="container-fluid">
				<div class="row">
					 <div class="col-md-4">
					 	<center>
					 			<div class="company_boxes">
					 				<div class="row">
					 					<div class="col-md-4 comp-light-blue">
					 						<i class="fas fa-users" style="font-size: 64px;margin-left: 40px;margin-top: 20px;"></i>
					 					</div>
					 					<div class="col-md-8">
					 						<h3>Registered Companies</h3>
					 						<b><?php echo $count_all; ?></b>
					 					</div>
					 				</div>
					 			</div>					 			
					 	</center>
					 </div>
					 <div class="col-md-4">
					 	<center>
					 			<div class="company_boxes">
					 				<div class="row">
					 					<div class="col-md-4 comp-blue">
					 						<i class="fas fa-money" style="font-size: 64px;margin-left: 40px;margin-top: 20px;"></i>
					 					</div>
					 					<div class="col-md-8">
					 						<h3>Total Amount</h3>
					 						<b>&#x20A6;<?php echo $amount_all; ?></b>
					 					</div>
					 				</div>
					 			</div>
					 	</center>
					 </div>
					 <div class="col-md-4">
					 	<center>
					 			<div class="company_boxes">
					 				<div class="row">
					 					<div class="col-md-4" style="background: #17234d;">
					 						<i class="fas fa-percent"  style="font-size: 64px;margin-left: 40px;margin-top: 20px;"></i>
					 					</div>
					 					<div class="col-md-8">
					 						<h3>Percentage Charge</h3>
					 						<b><?php if (empty($percent)) {echo "0";}else{echo $percent;} ?></b><br>
					 						<a class="btn btn-info" href="percentage"><i class="fas fa-edit"></i>Edit</a>
					 					</div>
					 				</div>
					 			</div>
					 	</center>
					 </div>
                 </div>

<div class="row" style="margin: 20px;">
	<div class="col-md-12">
		<a class="btn btn-primary pull-right btn-flat btblack" href="new_company"><i class="entypo-plus-circled"></i> New Company</a>
	</div>
</div>
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">All Registered Companies</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
                                        <th>#</th>
                                    	<th>Company Name</th>
                                    	<th>Company Address</th>
                                    	<th>Contact Numbers</th>
                                    	<th>Branch</th>
                                    	<th>Number Of Staff</th>
                       					<th>Email</th>
                                        <th>Date</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_companies();
											foreach($notarray as $row):
											$name = $row['company_name'];
											$addr = $row['company_addr'];
											$phone = $row['company_pn'];
											$date = $row['date_added'];
											$comp_id = $row['id'];
											$email = $row['email'];
											$staff = $row['staff_no'];
											$branch = $row['branch'];
										?>
                                        <tr>
                                        	<td width="5%">
                                        		<?php echo $count++;?>
                                        	</td>
                                        	<td width="15%">
                                        		<?php echo $name;?>

                                        	</td>
                                        	<td width="15%">                                        	
											<?php echo $addr; ?>
                                        	</td>
                                        	<td width="10%">
                                        		<?php echo $phone; ?>
                                        	</td>
                                        	<td width="5%">
                                        		<?php echo $branch; ?>
                                        	</td>
                                        	<td width="5%">
                                        		<?php echo $staff; ?>
                                        	</td>
                                        	<td width="15%">
                                        		<?php echo $email; ?>
                                        	</td>

                                        	<td width="15%">
                                        		<?php echo $date; ?>
                                        	</td>
                                        	
                                        	<td width="15%">
												<div class="btn-group">
													<button type="button" class="btn btn-info">...</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<li><a href="edit_company?id=<?php echo $comp_id; ?>">Edit</a></li>
													<div class="divider"></div>
													<li><a onclick="sure(<?php echo $comp_id; ?>,'<?php echo $name; ?>')">Delete</a>
													</li>
													<div class="divider"></div>
													<li><a href="view_transactions?id=<?php echo $comp_id; ?>">View Transactions</a>
													</li>
													</ul>
												</div>
											</td>
                                        </tr>
										
										
					 
										<?php 
								endforeach;
								?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
                                    	<th>Company Name</th>
                                    	<th>Company Address</th>
                                    	<th>Contact Numbers</th>
                                    	<th>Branch</th>
                                    	<th>Number Of Staff</th>
                       					<th>Email</th>
                                        <th>Date</th>
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
            	message: "Are you sure you want to delete <b>"+name+"</b> From Company list As This Will Also Erased Any and all transactions concerning this company? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

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
            data: "val=" + val +  '&ins=delCompany',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'view_companies';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>
