
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
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <h6 class="text-center title" style="padding-top: 20px;">All Stock</h6>
                            <ul class="nav nav-tabs nav-tabs-bottom">
                                <li class="nav-item"><a class="nav-tab active" href="#bottom-tab1" data-toggle="tab" role="tab">Update Stock</a></li>
                                <li class="nav-item"><a class="nav-tab" href="#bottom-tab2" data-toggle="tab" role="tab">Damaged / Expired Stock List</a></li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="bottom-tab1" role="tabpanel">
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Name</th>
                                    	<th>Category</th>
                                    	<th>Unit</th>
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
                                        	<td>
                                        		<?php 
                                        			$userDetails = Database::getInstance()->select_from_where('pharm_units', 'id', $units);
														foreach($userDetails as $qfw):
															 echo $qfw['unit_name'];
															 
														endforeach; 
                                        		?>
                                        	</td>
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
													<button type="button" class="btn btn-info">Action</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<?php 
                                                        if ($stock > 0) {
                                                            ?>
                                                            <li><a href="update_stock?edit=<?php echo $row['id']; ?>">Update Stock</a></li>
                                                            <?php
                                                        }
                                                    ?>
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
                                            <a class="page-link" href="de_stock.php?page=<?php echo (($pn-1));?>" tabindex="-1">Previous</a>
                                        </li><?php }
                                        if (($pn - 1) > 1) {
                                            ?>
                                            <li class="page-item">
                                                <a class="page-link" href="de_stock.php?page=1">1</a>
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
                                            <a href="de_stock.php?page=<?php echo $i; ?>" class='<?php echo $class; ?>'><?php echo $i; ?></a>
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
                                            <a href="de_stock.php?page=<?php echo $totalPages; ?>"class='<?php echo $class; ?>'><?php echo $totalPages; ?></a>
                                        </li>
                                            <?php
                                        }
                                        ?>
                                            <?php
                                            if (($row > 1) && ($pn < $totalPages)) {
                                                ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="de_stock.php?page=<?php echo (($pn+1));?>"><span>Next</span></a> 
                                                <?php
                                            }
                                            ?>
                                                                            </ul>
                                                                        </nav>
                                <!--Pagination End-->
                            </div>
                                </div>
                                <div class="tab-pane" id="bottom-tab2" role="tabpanel">
                                	<div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Name</th>
                                    	<th>Quantity</th>
                                    	<th>Status</th>
                                    	<th>Updated By</th>
                                    	<th>Date Upated</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count1 = 1; 
											$notarray2 = database::getInstance()->select_from_ord('pharm_stock1','id','DESC',$pn);
                                            //total pages
                                            $totalPages1 = database::getInstance()->count_from_ord2('pharm_stock','id','DESC');
											foreach($notarray2 as $row2):
											$id1 = $row2['id'];
											$name1 = $row2['pharm_id'];
											$qty = $row2['qty'];
											$status = $row2['status'];
											$staff = $row2['staff'];
											$date_added = $row2['date_added'];
										?>
                                        <tr>
                                        	<td><?php echo $count1++;?></td>
                                        	<td><i class="fas fa-medkit"></i>
                                        		<?php 
                                        			$userDetails1 = Database::getInstance()->select_from_where('pharm_stock', 'id', $name1);
														foreach($userDetails1 as $qw1):
															 echo $qw1['name'];
															 
														endforeach; 
                                        		?>
                                        	</td>
                                        	<td><?php echo $qty;?></td>
                                        	
                                        	<td>
                                        		<?php if ($status == 1) {
                                        			echo "Damaged";
                                        		}else if($status == 2){
                                        			echo "Expired";
                                        		}else{
                                        			echo "No Status Selected";
                                        		} ?>
                                        	</td>
                                        	<td><i class="fas fa-user"></i>
                                        		<?php 
                                        			$userDetails3 = Database::getInstance()->select_from_where('staff', 'user_id', $staff);
														foreach($userDetails3 as $qw3):
															 echo $qw3['last_name']." ".$qw3['first_name']." ".$qw3['other_names'];
															 
														endforeach; 
                                        		?>
                                        	</td>
                                            <td><i class="fas fa-clock-o"></i><?php echo $date_added; ?></td>
                                        </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
										<th>#</th>
                                        <th>Name</th>
                                    	<th>Quantity</th>
                                    	<th>Status</th>
                                    	<th>Updated By</th>
                                    	<th>Date Upated</th>
                                    </thead>
								</table>
<!--Pagination Start-->
                                <nav aria-label="...">
                                    <ul class="pagination">
                                        <?php if (($pn > 1)) {
                                            ?>
                                        <li class="page-item">
                                            <a class="page-link" href="de_stock.php?page=<?php echo (($pn-1));?>" tabindex="-1">Previous</a>
                                        </li><?php }
                                        if (($pn - 1) > 1) {
                                            ?>
                                            <li class="page-item">
                                                <a class="page-link" href="de_stock.php?page=1">1</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link">...</a>
                                            </li>
                                        <?php
                                        }

                                        for ($i = ($pn - 1); $i <= ($pn + 1); $i ++) {
                                            if ($i < 1)
                                                continue;
                                            if ($i > $totalPages1)
                                                break;
                                            if ($i == $pn) {
                                                $class = "active";
                                            } else {
                                                $class = "page-link";
                                            }
                                            ?>
                                        <li class="page-item">
                                            <a href="de_stock.php?page=<?php echo $i; ?>" class='<?php echo $class; ?>'><?php echo $i; ?></a>
                                        </li>
                                            <?php
                                        }
                                        if (($totalPages1 - ($pn + 1)) >= 1) {
                                            ?>
                                            <li class="page-item">
                                                <a class="page-link">...</a>
                                            </li>
                                        <?php
                                        }
                                        if (($totalPages1 - ($pn + 1)) > 0) {
                                            if ($pn == $totalPages1) {
                                                $class = "active";
                                            } else {
                                                $class = "page-link";
                                            }
                                            ?>
                                            <li class="page-item">
                                            <a href="de_stock.php?page=<?php echo $totalPages1; ?>"class='<?php echo $class; ?>'><?php echo $totalPages1; ?></a>
                                        </li>
                                            <?php
                                        }
                                        ?>
                                            <?php
                                            if (($row > 1) && ($pn < $totalPages1)) {
                                                ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="de_stock.php?page=<?php echo (($pn+1));?>"><span>Next</span></a> 
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