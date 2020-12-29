<?php 
	ob_start();
	session_start();
	$pageTitle = "Surgeries";
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
			<div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">All Surgeries </h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Patient</th>
                                    	<th>Doctor</th>
                                    	<th>Time</th>
                                    	<th>Date</th>
                                    	<th>Pre Operations Checklist Status</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_ord1('surgery_perm','surgery_perm_id','DESC',$pn);

                                            //total pages
                                            $totalPages = database::getInstance()->count_from_ord2('surgery_perm','surgery_perm_id','DESC');
											foreach($notarray as $row):
											$p_id = $row['patient_id'];
											$d_id = $row['added_by'];
											$date_added = $row['surgery_date'];
											$time_added = $row['surgery_time'];
											$treated = $row['prechecklist'];
											$surname = "";
											$app = $row['appointment_id'];

										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td>
                                        		<?php
													$userDetails = Database::getInstance()->select_from_where('patients', 'id', $p_id);
													foreach($userDetails as $qw):
														echo $name = $qw['title']." ".$qw['middle_name']." ".$qw['surname'];
														$surname = $qw['surname'];
													endforeach; 
												?>
                                        		
                                        	</td>
                                        	
                                        	<td>
                                        		<?php
													$userDetails = Database::getInstance()->select_from_where('staff', 'user_id', $d_id);
													foreach($userDetails as $ow):
														echo $name = $ow['first_name']." ".$ow['last_name'];	
													endforeach; 
												?>

                                        	</td>
                                        	
                                        	<td>
											<?php echo $time_added; ?>
                                        	</td>

                                        	<td>
                                        		<?php echo $date_added;?>
                                        	</td>
                                        	<td>
                                        		<center>
                                        			<?php 
                                        			if($treated == 1){
                                        				?>
                                                        <div class="badge badge-success">Processed</div>
                                                        <?php
                                        			} else{
                                        				?>
                                                        <div class="badge badge-warning">Pending</div>
                                                        <?php
                                        			}
                                        		?>
                                        		</center>
                                        	</td>
                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">...</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<li><a href="surgery?id=<?php echo $app; ?>&pid=<?php echo $p_id; ?>">View</a></li>
													</ul>
												</div>
											</td>
                                        </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
										<th>#</th>
                                        <th>Patient</th>
                                    	<th>Doctor</th>
                                    	<th>Time</th>
                                    	<th>Date</th>
                                    	<th>Pre Operations Checklist Status</th>
                                    	<th>Action</th>
                                    </thead>
								</table>
<!--Pagination Start-->
                                <nav aria-label="...">
                                    <ul class="pagination">
                                        <?php if (($pn > 1)) {
                                            ?>
                                        <li class="page-item">
                                            <a class="page-link" href="surgeries.php?page=<?php echo (($pn-1));?>" tabindex="-1">Previous</a>
                                        </li><?php }
                                        if (($pn - 1) > 1) {
                                            ?>
                                            <li class="page-item">
                                                <a class="page-link" href="surgeries.php?page=1">1</a>
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
                                            <a href="surgeries.php?page=<?php echo $i; ?>" class='<?php echo $class; ?>'><?php echo $i; ?></a>
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
                                            <a href="surgeries.php?page=<?php echo $totalPages; ?>"class='<?php echo $class; ?>'><?php echo $totalPages; ?></a>
                                        </li>
                                            <?php
                                        }
                                        ?>
                                            <?php
                                            if (($row > 1) && ($pn < $totalPages)) {
                                                ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="surgeries.php?page=<?php echo (($pn+1));?>"><span>Next</span></a> 
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
