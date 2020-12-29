
<?php 
	ob_start();
	session_start();
	$pageTitle = "Patients";
	// Include database class
	include_once '../inc/db.php';
	
	If(!isset($_SESSION['userSession'])){
		header("Location: ../index");
		exit;
	}
	elseif (isset($_SESSION['userSession'])){
		$user_id = $_SESSION['userSession'];
		if (!isset($_GET['page'])) {
			$pn = 1;
		}else{
			$pn=$_GET['page'];
		}
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
				<div id="anyres">
					<?php 
						if (isset($_GET['res']) AND $_GET['res'] == 'Done') {
							?>
							<div class="alert alert-success">
								<strong>Physiotherapy Request</strong> Was Successful
							</div>
							<?php
						}elseif($_GET['stat'] && $_GET['stat'] == 'success'){
							?>
							<div class="alert alert-success">
								<strong>Request</strong> Was Successful
							</div>
							<?php
						}
					?>
				</div>
			<a href="new_patient" style="margin-bottom:10px;" class="btn btn-primary pull-right btn-flat btblack">
					<i class="entypo-plus-circled"></i> New Patient
			</a>
			</div>
			
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">All Patients </h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                    	<th>Reg Num</th>
                                        <th>Name</th>
                                        <th>Sex</th>
										<th>Age</th>
										<th>Address</th>
										<th>Blood Group</th>
										<th>Status</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_ord('patients','id','DESC',$pn);
											//total pages
											$totalPages = database::getInstance()->count_from_ord2('patients','id','DESC');
											foreach($notarray as $row):
											$id = $row['id'];
											$name = $row['title']." ".$row['surname']." ".$row['first_name'];
											$dob = $row['dob'];
											$reg_num = $row['reg_num'];
											$add = $row['address'];
											$sex = $row['sex'];
											$bg = $row['blood_group'];
											$status = 0;
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><?php echo $reg_num;?></td>
                                        	<td><?php echo $name;?></td>
                                        	<td><?php echo $sex;?></td>
                                        	<td><?php echo $dob;?></td>
											<td width="23%"><?php echo $add;?></td>      	
                                        	<td><?php echo $bg;?></td>       
                                        	<td>
                                        		<?php 
                                        			if ($status == 0) {
                                        				?>
                                        				<div class="badge badge-default">Not Admitted</div>
                                        				<?php
                                        			}else if ($status == 1){
                                        				?>
                                        				<div class="badge badge-info">Reffered</div>
                                        				<?php
                                        			}else if ($status == 2){
                                        				?>
                                        				<div class="badge badge-info">Discharged</div>
                                        				<?php
                                        			}else if ($status == 3){
                                        				?>
                                        				<div class="badge badge-danger">Deceased</div>
                                        				<?php
                                        			}else if($status == 4){
                                        				?>
                                        				<div class="badge badge-warning">SAMA</div>
                                        				<?php
                                        			}
                                        		?>
                                        	</td>
                                        	<td width="12%">
												<div class="btn-group">
													<button type="button" class="btn btn-info">...</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<li><a href="edit_patient?edit=<?php echo $row['id']; ?>">Edit</a></li>
													<li class="divider"></li>
													<li><a onclick="sure(<?php echo $row['id']; ?>,'<?php echo $row['surname']; ?>')">Delete</a></li>
													</ul>
												</div>
											</td>
                                        </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
										<th>#</th>
                                    	<th>Reg Num</th>
                                        <th>Name</th>
                                        <th>Sex</th>
										<th>Age</th>
										<th>Address</th>
										<th>Blood Group</th>
										<th>Status</th>
                                    	<th>Action</th>
                                    </thead>
								</table>
<!--Pagination Start-->
								<nav aria-label="...">
									<ul class="pagination">
										<?php if (($pn > 1)) {
											?>
									    <li class="page-item">
											<a class="page-link" href="patients.php?page=<?php echo (($pn-1));?>" tabindex="-1">Previous</a>
										</li><?php }
										if (($pn - 1) > 1) {
										    ?>
										    <li class="page-item">
												<a class="page-link" href="patients.php?page=1">1</a>
											</li>
											<li class="page-item">
												<a class="page-link">...</a>
											</li>
										<?php
										}

										for ($i = ($pn - 1); $i <= ($pn + 1); $i ++) {
										    if ($i < 1)
										        continue;
										    if ($i > $totalPages)
										        break;
										    if ($i == $pn) {
										        $class = "active";
										    } else {
										        $class = "page-link";
										    }
										    ?>
										<li class="page-item">
											<a href="patients.php?page=<?php echo $i; ?>" class='<?php echo $class; ?>'><?php echo $i; ?></a>
										</li>
										    <?php
										}
										if (($totalPages - ($pn + 1)) >= 1) {
										    ?>
										    <li class="page-item">
												<a class="page-link">...</a>
											</li>
										<?php
										}
										if (($totalPages - ($pn + 1)) > 0) {
										    if ($pn == $totalPages) {
										        $class = "active";
										    } else {
										        $class = "page-link";
										    }
										    ?>
										    <li class="page-item">
											<a href="patients.php?page=<?php echo $totalPages; ?>"class='<?php echo $class; ?>'><?php echo $totalPages; ?></a>
										</li>
										    <?php
										}
										?>
										    <?php
										    if (($row > 1) && ($pn < $totalPages)) {
										        ?>
										        <li class="page-item">
													<a class="page-link" href="patients.php?page=<?php echo (($pn+1));?>"><span>Next</span></a> 
										        <?php
										    }
										    ?>
																			</ul>
																		</nav>
								<!--Pagination End-->
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
            	message: "Are you sure you want to delete <b>"+name+"</b> From bank list ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

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
            data: "val=" + val +  '&ins=delPatient',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'patients';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>
