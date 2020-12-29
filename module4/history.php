<?php 
	ob_start();
	session_start();
	$pageTitle = "Stock Update History";
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
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Name</th>
                                    	<th>Quantity</th>
                                    	<th>Updating Staff</th>
                                    	<th>Date</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_ord1('pharm_updates','id','DESC');
											foreach($notarray as $row):
											$name = $row['pharm_id'];
											$tdate = $row['date_added'];
											$price = $row['staff'];
											$stock = $row['quantity'];
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><i class="fas fa-medkit"></i><?php echo Database::getInstance()->get_name_from_id("name","pharm_stock","id",$name);?></td>
                                        	<td>
                                        		<?php echo number_format($stock); ?>
                                        	</td>
                                        	<td><i class="fas fa-user"></i>
                                        		<?php 
                                        			$userDetails = Database::getInstance()->select_from_where('staff', 'user_id', $price);
														foreach($userDetails as $qw):
															 echo $qw['last_name']." ".$qw['first_name']." ".$qw['other_names'];
														endforeach; 
                                        		?>
                                        	</td>
                                        	<td><i class="fas fa-clock-o"></i><?php echo $tdate;?></td>
                                        </tr>					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
										<th>#</th>
                                        <th>Name</th>
                                    	<th>Quantity</th>
                                    	<th>Updating Staff</th>
                                    	<th>Date</th>
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