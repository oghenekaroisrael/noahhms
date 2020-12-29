<?php 
	ob_start();
	session_start();
	$pageTitle = "Staff";
	// Include database class
	include_once '../inc/db.php';
	
	if(!isset($_SESSION['userSession'])){
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
			<div id="get_resultw"></div>
			
			<div style="padding-bottom:45px;">
			<a href="new_staff" style="margin-bottom:10px;" class="btn btn-primary pull-right btn-flat btblack">
					<i class="entypo-plus-circled"></i> New Staff
			</a>
			</div>
			
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">All Staff</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Staff ID</th>
                                        <th>Name</th>
                                    	<th>Role</th>
                                    	<th>Date Added</th>
										<th>Contact Number</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_ord1('staff','user_id','DESC',$pn);
											$totalPages = database::getInstance()->select_from_ord1("staff","user_id","DESC");
											foreach($notarray as $row):
											$id = $row['user_id'];
											$img = $row['staff_img'];
											$first = $row['first_name'];
											$last = $row['last_name'];
											$phone = $row['phone_number'];
											$row_id = $row['role_id'];
											$status = $row['status'];
											$name = $first." ".$last;
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><img src="staff_img/<?php echo $img;?>" class="img img-circle" height="80" width="80"></td>
                                        	<td><i class="fas fa-user"></i><?php echo $name;?></td>
                                        	
                                        	<?php
											
												$noarray = database::getInstance()->select_from_where('user_roles','id',$row_id);
												while ($ow = $noarray->fetch(PDO::FETCH_ASSOC)) {?>	
													<td><?php echo $ow['name'];?></td>
											<?php } ?>
                                        	<td><i class="fas fa-clock-o"></i>
                                        		<?php 
												$fDate = $ow['date_added'];
												$dt = new DateTime($fDate); //for getting just date from timestamp
											?>
											<?php echo $dt->format('d-m-Y'); ?>
                                        	</td>
											<td><i class="fas fa-mobile-phone"></i>
												<?php echo $phone; ?>
											</td>
											
                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">...</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<li><a href="view_staff?id=<?php echo $row['user_id']; ?>">View Staff</a></li>
													<li class="divider"></li>
													<li><a href="edit_staff?id=<?php echo $row['user_id']; ?>">Edit</a></li>
													<li class="divider"></li>
													<li><a onclick="sure(<?php echo $row['user_id']; ?>,'<?php echo $row['first_name']; ?>')">Delete</a></li>
													</ul>
												</div>
											</td>
                                        </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
										 <th>Staff ID</th>
                                        <th>Name</th>
                                    	<th>Role</th>
                                    	<th>Date Added</th>
										<th>Contact Number</th>
                                    	<th>Action</th>
                                    </thead>
								</table>
<!--Pagination Start-->
								<nav aria-label="...">
									<ul class="pagination">
										<?php if (($pn > 1)) {
											?>
									    <li class="page-item">
											<a class="page-link" href="staff.php?page=<?php echo (($pn-1));?>" tabindex="-1">Previous</a>
										</li><?php }
										if (($pn - 1) > 1) {
										    ?>
										    <li class="page-item">
												<a class="page-link" href="staff.php?page=1">1</a>
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
											<a href="staff.php?page=<?php echo $i; ?>" class='<?php echo $class; ?>'><?php echo $i; ?></a>
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
											<a href="staff.php?page=<?php echo $totalPages; ?>"class='<?php echo $class; ?>'><?php echo $totalPages; ?></a>
										</li>
										    <?php
										}
										?>
										    <?php
										    if (($value > 1) && ($pn < $totalPages)) {
										        ?>
										        <li class="page-item">
													<a class="page-link" href="staff.php?page=<?php echo (($pn+1));?>"><span>Next</span></a> 
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
		
	<?php include '../inc/footer-staff.php';?>
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
            data: "val=" + val +  '&ins=delUser',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'staff';
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
	
