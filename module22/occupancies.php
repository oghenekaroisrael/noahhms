
<?php 
	ob_start();
	session_start();
	$pageTitle = "Occupancies";
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
			<a href="new_corpse" style="margin-bottom:10px;" class="btn btn-primary pull-right btn-flat btblack">
					<i class="entypo-plus-circled"></i> Out Corpse
			</a>
			</div>
			
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">All Occupancies </h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Name</th>
                                        <th>Sex</th>
                                    	<th>Tag Number</th>
                                    	<th>Serial Number</th>
                                    	<th>Bed Type</th>
                                    	<th>Bed</th>
                                    	<th>Status</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_ord('morgue_index','id','DESC',$pn);
											//total pages
											$totalPages = database::getInstance()->count_from_ord2('morgue_index','id','DESC');
											foreach($notarray as $row):
											$id = $row['id'];
											$fname = $row['fullname'];
											$sex = $row['sex'];
											$tag = $row['tag_number'];
											$serial = $row['serial_number'];
											$room = $row['room'];
											$bed = $row['bed'];
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><i class="fas fa-user"></i>
                                        		<?php
													echo $fname;
												?>
                                        		
                                        	</td>
                                        	
                                        	<td>
                                        		<?php
													echo $sex; 
												?>

                                        	</td>

                                        	<td>
                                        		<?php echo $tag;?>
                                        	</td>
                                        	
                                        	<td>
                                        		<?php echo $serial; ?>
                                        	</td>
                                        	<td><i class="fas fa-folder-o"></i>
                                        		<?php echo database::getInstance()->get_name_from_id("types","morgue_bed_types",'id',$room); ?>
                                        	</td>
                                        	<td><i class="fas fa-bed"></i>
                                        		<?php echo database::getInstance()->get_name_from_id("name","morgue_beds",'id',$bed); ?>
                                        	</td>
                                        	<td>
                                        		<?php 
                                        			if($treated == 1){
                                        				?>
                                        				<div class="badge badge-success">Claimed</div>
                                        				<?php
                                        			} else{?>
                                        				<div class="badge badge-info">In Room</div><?php
                                        			}
                                        		?>
                                        	</td>
                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">...</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<li>
														<a href="prepare_bill?id=<?php echo $id; ?>">Prepare Bill</a>
													</li>
													<li class="divider"></li>
													<li>
														<a href="view_bill?id=<?php echo $id; ?>">View Bill</a>
													</li>
													<li class="divider"></li>
													<li><a onclick="sure(<?php echo $id; ?>,'<?php echo $surname; ?>')">Delete</a></li>
													</ul>
												</div>
											</td>
                                        </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
										<th>#</th>
                                        <th>Name</th>
                                        <th>Sex</th>
                                    	<th>Tag Number</th>
                                    	<th>Serial Number</th>
                                    	<th>Bed Type</th>
                                    	<th>Bed</th>
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
											<a class="page-link" href="appointment.php?page=<?php echo (($pn-1));?>" tabindex="-1">Previous</a>
										</li><?php }
										if (($pn - 1) > 1) {
										    ?>
										    <li class="page-item">
												<a class="page-link" href="appointment.php?page=1">1</a>
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
											<a href="appointment.php?page=<?php echo $i; ?>" class='<?php echo $class; ?>'><?php echo $i; ?></a>
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
											<a href="appointment.php?page=<?php echo $totalPages; ?>"class='<?php echo $class; ?>'><?php echo $totalPages; ?></a>
										</li>
										    <?php
										}
										?>
										    <?php
										    if (($ow > 1) && ($pn < $totalPages)) {
										        ?>
										        <li class="page-item">
													<a class="page-link" href="appointment.php?page=<?php echo (($pn+1));?>"><span>Next</span></a> 
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
            data: "val=" + val +  '&ins=delappt',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'appointment';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>
