<?php 
	ob_start();
	session_start();
	$pageTitle = "Charges";
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
					 <div class="col-lg-12" style="margin-bottom: 20px;">
					 	<a class="btn btn-info pull-right" href="new_charge"><i class="fas fa-plus"></i> New Charge</a>
					 </div>
                 </div>


                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">All Charges</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Date Added</th>
                                    	<th>Charge</th>
                                    	<th>Amount</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_ord1('morgue_charges','id','DESC',$pn);
											//total pages
											$totalPages = database::getInstance()->count_from_ord2('morgue_charges','id','DESC');
											foreach($notarray as $row):
											$id = $row['id'];
											$exp_date = $row['date_added'];
											$name = $row['charge'];
											$amt = $row['amount'];
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	
                                        	
                                        	<td><i class="fas fa-clock-o"></i>
                                        		<?php echo $exp_date;?>

                                        	</td>
                                        	<td><i class="fas fa-file-text-o"></i>
                                        		<?php echo ucwords($name); ?>
                                        	</td>

                                        	<td><i class="fas fa-money"></i>
                                        		<?php echo "&#8358;".number_format($amt); ?>
                                        	</td>
                                        	
                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">..</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">										
													<li><a href="edit_charge?id=<?php echo $row['id']; ?>">Edit</a></li>
													<div class="divider"></div>
													<li><a onclick="sure(<?php echo $id; ?>,'<?php echo addslashes($name); ?>')">Delete</a>
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
                                        <th>Date Added</th>
                                    	<th>Charge</th>
                                    	<th>Amount</th>
                                    	<th>Action</th>
                                    </thead>
								</table>
<!--Pagination Start-->
								<nav aria-label="...">
									<ul class="pagination">
										<?php if (($row > 1) && ($pn > 1)) {
											?>
									    <li class="page-item">
											<a class="page-link" href="charges.php?page=<?php echo (($pn-1));?>" tabindex="-1">Previous</a>
										</li><?php }
										if (($pn - 1) > 1) {
										    ?>
										    <li class="page-item">
												<a class="page-link" href="charges.php?page=1">1</a>
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
											<a href="charges.php?page=<?php echo $i; ?>" class='<?php echo $class; ?>'><?php echo $i; ?></a>
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
											<a href="charges.php?page=<?php echo $totalPages; ?>"class='<?php echo $class; ?>'><?php echo $totalPages; ?></a>
										</li>
										    <?php
										}
										?>
										    <?php
										    if (($row > 1) && ($pn < $totalPages)) {
										        ?>
										        <li class="page-item">
													<a class="page-link" href="charges.php?page=<?php echo (($pn+1));?>"><span>Next</span></a> 
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
            	message: "Are you sure you want to delete <b>"+name+"</b> From list ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

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
            data: "val=" + val +  '&ins=delMCharges',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'charges';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>
x