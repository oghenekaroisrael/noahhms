<?php 
	ob_start();
	session_start();
	$pageTitle = "daily_report";
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
    if (isset($_POST['submit']) AND !empty($_POST['from']) AND !empty($_POST['to'])) {
        $_SESSION['date_from_d'] = $_POST['from'];
        $_SESSION['date_to_d'] = $_POST['to'];
        unset($_POST);
    }else{
        $_SESSION['date_from_d'] = date("Y-m-d");
        $_SESSION['date_to_d'] = date("Y-m-d");
        unset($_POST);

    }
    
?>

<div class="wrapper">
<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>

        <div class="content">
            <div class="container-fluid">
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-12">
                        <form method="POST" action="" name="range">
                            <div class="col-lg-4">
                                <label>Date From</label>
                                    <input type="date" name="from" class="form-control">
                            </div>
                            <div class="col-lg-4">
                                <label>Date To</label>
                                <input type="date" name="to" class="form-control">
                            </div>
                            <div class="col-lg-4">
                                <button type="submit" name="submit" class="btn btn-lg btblack pull-right">Search</button>
                            </div>
                        </form>
                    </div>
            </div>			
                <div class="row">
                    
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><?php if (isset($_POST['submit']) && $_POST['from'] == $_POST['to']) {
                                    echo "Today's";
                                } ?> Report</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>Drug</th>
                                        <th>Quantity Dispensed</th>
                                    	<th>Patient Given</th>
                                    	<th>Date Time</th>
                                    </thead>
                                    <tbody>
									  <?php
									  $date = date("Y-m-d");
											$notarray = database::getInstance()->select_from_where_ord31('prescription','pres_status',1,'pdate_added',$_SESSION['date_from_d'],$_SESSION['date_to_d'],'prescription_id','DESC');
											foreach($notarray as $row):
											$pid = $row['patient_id'];
											$qty1 = $row['quantity_dispense'];
											$qty2 = $row['squantity_dispense'];
											$drug = $row['pharm_stock_id'];
											$date_a = $row['pdate_added'];
										?>
                                        <tr>
                                        	<td><i class="fas fa-medkit"></i><?php echo database::getInstance()->get_name_from_id("name","pharm_stock","id",$drug);?></td>
                                        	<td>
                                        		<?php 
                                        			if (!empty($qty1) AND $qty1 != 0) {
                                        				echo number_format($qty1);
                                        			}else if (!empty($qty2)  AND $qty2 != 0) {
                                        				echo number_format($qty2);
                                        			}
                                        		?>
                                        	</td>
                                        	<td><i class="fas fa-user"></i>
                                        		<?php 
                                        			$pat = Database::getInstance()->select_from_where('patients', 'id', $pid);
														foreach($pat as $row):
															 echo $row['title']." ".$row['surname']." ".$row['first_name']." ".$row['middle_name'];
															 
														endforeach; 
                                        		?>
                                        	</td> 
                                        	<td><i class="fas fa-clock-o"></i><?php echo $date_a; ?></td>                                       	
                                        </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
                                        <th>Drug</th>
                                    	<th>Quantity Dispensed</th> 
                                    	<th>Patient Given</th>                                	
                                    	<th>Date Time</th>
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