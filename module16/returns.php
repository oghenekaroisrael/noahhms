<?php 
	ob_start();
	session_start();
	$pageTitle = "Return Inward";
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
                            <div class="header" id="here_me">
                                <h4 class="title">Return Inwards</h4>
                            </div>
                            
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Reference ID</th>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                    	<th>Date</th> 
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
										    $notarray = database::getInstance()->select_from_creturned($pn);
                                            //total pages
                                            $totalPages = database::getInstance()->count_from_creturned();
											foreach($notarray as $row):
											$id = $row['id'];
                                            $id2 = $row['id2'];
                                            $ref = $row['Sales_Number'];
                                            $acc = $row['account_status'];
											$barcode = $row['Stock_Item'];
											$quantity = $row['Sales_Quantity'];
											$date = $row['sales_date'];
											$amt = $row['Purchasing_Price'];								 
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><?php echo $ref;?></td>
                                        	<td>
                                        		<?php 
                                                    echo $pharm = Database::getInstance()->get_name_from_id('name','caf_stock','id',$barcode);
                                                ?>
                                        	</td>
											<td>
                                        		<?php 
                                                    if ($quantity > 0) {
                                                        echo $quantity;
                                                    }else{
                                                        echo "-";
                                                    }
                                                 ?>
                                        	</td>
                                        	<td>
                                        		<?php 
                                                    if ($amt > 0) {
                                                        echo $amt;
                                                    }else{
                                                        echo "-";
                                                    }
                                                 ?>
                                        	</td>
												
											<td>
												<?php echo $date; ?>
											</td>
											<td>
												<a class="btn btn-info" href="return.php?a=<?php echo $id; ?>&b=<?php echo $id2;?>" <?php if (empty($acc) OR $acc == 0 OR $quantity == 0) {echo " disabled";}else{echo "";}?>>Return</a>
											</td>
                                        </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
                                        <th>Reference ID</th>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                        <th>Date</th> 
                                        <th>Action</th>
                                    </thead>
								</table>
                                <!--Pagination Start-->
                                <nav aria-label="...">
                                    <ul class="pagination">
                                        <?php if (($pn > 1)) {
                                            ?>
                                        <li class="page-item">
                                            <a class="page-link" href="returns.php?page=<?php echo (($pn-1));?>" tabindex="-1">Previous</a>
                                        </li><?php }
                                        if (($pn - 1) > 1) {
                                            ?>
                                            <li class="page-item">
                                                <a class="page-link" href="returns.php?page=1">1</a>
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
                                            <a href="returns.php?page=<?php echo $i; ?>" class='<?php echo $class; ?>'><?php echo $i; ?></a>
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
                                            <a href="returns.php?page=<?php echo $totalPages; ?>"class='<?php echo $class; ?>'><?php echo $totalPages; ?></a>
                                        </li>
                                            <?php
                                        }
                                        ?>
                                            <?php
                                            if (($row > 1) && ($pn < $totalPages)) {
                                                ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="returns.php?page=<?php echo (($pn+1));?>"><span>Next</span></a> 
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
		function sure(drugs,tabs,dosage,duration, date,instruction){ 

        	s.notify({
            	icon: '',
            	message: 
				 "<table class='table table-bordered table-primary'><thead><th><b>Drugs</b></th><th>Number of Tabs</th><th>Dosage</th><th>Duration</th><th>Date</th><th>Instructions</th></thead><tbody><tr><td>"+drugs+"</td><td>"+tabs+"</td><td>"+dosage+"</td><td>"+duration+"</td><td>"+date+"</td><td>"+instruction+"</td></tr> </tbody></table>"
				 

            },{
                type: 'success',
                timer: 100000
            });

    	}
		
		function proce(ID,name){ 

        	s.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to process prescription of <b>"+name+"</b> ? </br><button type='button' class='btn pop-btn' onclick='proc("+ID+")'>Process</button>"

            },{
                type: 'danger',
                timer: 100000
            });

    	}
		function proc(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/edit.php',
            data: "val=" + val +  '&status=1' + '&doc=' + <?php echo $doc;?> + '&ins=processPrescription',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'prescriptions';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}
		
		function canc(ID,name){ 

        	s.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to Cancel Prescription Process of <b>"+name+"</b> ? </br><button type='button' class='btn pop-btn' onclick='cncel("+ID+")'>Process</button>"

            },{
                type: 'danger',
                timer: 100000
            });

    	}
		
		function cncel(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/edit.php',
            data: "val=" + val +  '&ins=cancelPrescription',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data == 'Done') {
					console.log(data);
						window.location = 'prescriptions';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>