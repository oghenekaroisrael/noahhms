<?php
	ob_start();
	session_start();
	$pageTitle = "NHIS";
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
	if (isset($_GET['status']) AND $_GET['status'] == "deleted") {
		?>
		<script>
				$(document).ready(function() {
					rem();
				});
		</script>
		<?php
	}
?>
<div class="wrapper">
	<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
    	 <?php include 'inc/main_header.php';?>

		<div class="content">
            <div class="container-fluid">
			
			
                <div class="row">
					 <div class="col-md-12">
                            <center>
                            	<h3 class="title" style="font-family: raleway;font-weight: normal;">All HMO Tariffs </h3>
                            </center>
                                <div style="padding-bottom:45px;">
                                	<a href="new_tgroup" style="margin-bottom:10px;" class="btn btn-primary pull-left btn-flat btblack">
											<i class="entypo-plus-circled"></i> Group HMO Tariff
									</a>
									<a href="new_tariff" style="margin-bottom:10px;" class="btn btn-primary pull-right btn-flat btblack">
											<i class="entypo-plus-circled"></i> New HMO Tariff
									</a>
								</div>
								<div class="clear-fix"></div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                            			<thead>
                            				<th>#</th>
                            				<th>Tariff Name</th>
                            				<th>Tariff Group</th>
                            				<th>View</th>
                            				<th>Edit</th>
                            				<th>Delete</th>
                            			</thead>
                            			<tbody>
                            				<?php 
                                		$array = database::getInstance()->select_from_ord1("tariffs","id","DESC",$pn);

                                		$totalPages = database::getInstance()->select_from_ord1("tariffs","id","DESC");
                                		foreach ($array as $value) {
                                			?>
                                			<tr style="border-left: solid 5px <?php echo $value['color']; ?>;">
                                				<td>#</td>
                                				<td>
                                					<?php echo $value['name']; ?>
                                						
                                					</td>
                                					<td>
                                						<?php 
													if ($value['tgroup'] != 0) {
														?>
															<h5 class="h5">Group Tariff: <?php echo database::getInstance()->get_name_from_id("name","tgroup","id",$value['tgroup']); ?></h5>
														<?php
													}

												 ?>
                                			
                                					</td>
                                				<td>
                                					<a class="btn btn-info" href="view_tariff.php?id=<?php echo $value['id']; ?>">View Tariff</a>
                                				</td>
                                				<td>
                                					<a class="btn btn-default" href="edit_tariff.php?edit=<?php echo $value['id']; ?>">Edit Tariff</a>
                                				</td>
                                				<td>
                                					<a class="btn btn-info" onclick="sure(<?php echo $value['id']; ?>,`<?php echo $value['name']; ?>`)">Delete</a>
                                				</td>
                                			</tr>
												<?php }?>
                            			</tbody>
                            			<thead>
                            				<th>#</th>
                            				<th>Tariff Name</th>
                            				<th>Tariff Group</th>
                            				<th>View</th>
                            				<th>Edit</th>
                            				<th>Delete</th>
                            			</thead>
                            		</table>
                            		<!--Pagination Start-->
								<nav aria-label="...">
									<ul class="pagination">
										<?php if (($pn > 1)) {
											?>
									    <li class="page-item">
											<a class="page-link" href="index.php?page=<?php echo (($pn-1));?>" tabindex="-1">Previous</a>
										</li><?php }
										if (($pn - 1) > 1) {
										    ?>
										    <li class="page-item">
												<a class="page-link" href="index.php?page=1">1</a>
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
											<a href="index.php?page=<?php echo $i; ?>" class='<?php echo $class; ?>'><?php echo $i; ?></a>
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
											<a href="index.php?page=<?php echo $totalPages; ?>"class='<?php echo $class; ?>'><?php echo $totalPages; ?></a>
										</li>
										    <?php
										}
										?>
										    <?php
										    if (($value > 1) && ($pn < $totalPages)) {
										        ?>
										        <li class="page-item">
													<a class="page-link" href="index.php?page=<?php echo (($pn+1));?>"><span>Next</span></a> 
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
	 <!-- //MAIN -->
		<!--  footer -->
		
	<?php include '../inc/footer-index.php';?>
	<!--//footer -->
        
    </div>

</div>


<div class="loader" id="load" style="display:none ">
</div>
<?php include 'notify.php'; ?>
	<script type="text/javascript">
	var s=jQuery .noConflict();
	s(function () {
    s("#pro").DataTable();
  });
  
		function sure(ID,name){ 

        	s.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to delete <b>"+name+"</b> From Tariffs list ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+",`"+name+"`)'>Delete</button>"

            },{
                type: 'danger',
                timer: 100000
            });

    	}
		function rem(){ 

        	s.notify({
            	icon: 'pe-7s-check',
            	message: "Tariff Was Deleted Successfully!"

            },{
                type: 'success',
                timer: 3000
            });

    	}
		function delet(ID,name){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/del.php',
            data: "val=" + val +  '&name=' + name +'&ins=delTariff',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'index.php?status=deleted';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}
    </script>