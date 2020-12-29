<meta http-equiv="refresh" content="3000">
<?php 
	ob_start();
	session_start();
	$pageTitle = "Stock";
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
				<a href="history" style="margin-bottom:10px;" class="btn btn-default pull-left btn-flat btblack">
					View Stock Update History
			</a>
			<a href="new_stock" style="margin-bottom:10px;" class="btn btn-primary pull-right btn-flat btblack">
					<i class="entypo-plus-circled"></i> New Stock
			</a>
			</div>
			
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">All Stock</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Name</th>
                                    	<th>Category</th>
                                    	<th>Unit</th>
                                    	<th>Purchasing Price</th>
                                    	<th>Selling Price</th>
                                    	<th>Stock</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_ord('pharm_stock','id','DESC',$pn);
											//total pages
											$totalPages = database::getInstance()->count_from_ord2('pharm_stock','id','DESC');
											foreach($notarray as $row):
											$id = $row['id'];
											$name = $row['name'];
											$category = $row['category'];
											$units = $row['units'];
											$cost = $row['cost_price'];
											$price = $row['price'];
											$stock = $row['stock'];
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><i class="fas fa-medkit"></i><?php echo $name;?></td>
                                        	<td><i class="fas fa-folder-o"></i>
                                        		<?php 
                                        			$userDetails = Database::getInstance()->select_from_where('pharm_category', 'id', $category);
														foreach($userDetails as $qw):
															 echo $qw['cat_name'];
															 
														endforeach; 
                                        		?>
                                        	</td>
                                        	<td><i class="fas fa-list"></i>
                                        		<?php 
                                        			$userDetails = Database::getInstance()->select_from_where('pharm_units', 'id', $units);
														foreach($userDetails as $qfw):
															 echo $qfw['unit_name'];
															 
														endforeach; 
                                        		?>
                                        	</td>                                        	
                                        	<td>&#x20A6;<?php echo number_format($cost);?></td>
                                        	<td>&#x20A6;<?php echo number_format($price);?></td>
                                        	<td><?php 
                                        		if ($stock > 0) {
                                        			echo number_format($stock);
                                        		}else{
                                        			?>
                                        			<div class="badge badge-info">Out Of Stock</div>
                                        			<?php
                                        		}
                                        	?></td>

                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">...</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<li><a href="edit_stock?edit=<?php echo $row['id']; ?>">Edit Stock</a></li>
													<li class="divider"></li>
													<?php 
                                        		if ($stock > 0) {?>
													<li><a href="edit_stock1?edit=<?php echo $row['id']; ?>">Update Quantity</a></li><?php } ?>
													<li class="divider"></li>
													<li><a onclick="sure(<?php echo $row['id']; ?>,'<?php echo $row['name']; ?>')">Delete</a></li>
													</ul>
												</div>
											</td>
                                        </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
                                        <th>Name</th>
                                    	<th>Category</th>
                                    	<th>Unit</th>
                                    	<th>Purchasing Price</th>
                                    	<th>Selling Price</th>
                                    	<th>Stock</th>
                                    	<th>Action</th>
                                    </thead>
								</table>
<!--Pagination Start-->
								<nav aria-label="...">
									<ul class="pagination">
										<?php if (($pn > 1)) {
											?>
									    <li class="page-item">
											<a class="page-link" href="stock.php?page=<?php echo (($pn-1));?>" tabindex="-1">Previous</a>
										</li><?php }
										if (($pn - 1) > 1) {
										    ?>
										    <li class="page-item">
												<a class="page-link" href="stock.php?page=1">1</a>
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
											<a href="stock.php?page=<?php echo $i; ?>" class='<?php echo $class; ?>'><?php echo $i; ?></a>
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
											<a href="stock.php?page=<?php echo $totalPages; ?>"class='<?php echo $class; ?>'><?php echo $totalPages; ?></a>
										</li>
										    <?php
										}
										?>
										    <?php
										    if (($row > 1) && ($pn < $totalPages)) {
										        ?>
										        <li class="page-item">
													<a class="page-link" href="stock.php?page=<?php echo (($pn+1));?>"><span>Next</span></a> 
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
            	message: "Are you sure you want to delete <b>"+name+"</b> from pharmacy stock ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

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
            data: "val=" + val +  '&ins=delStock',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'stock';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>