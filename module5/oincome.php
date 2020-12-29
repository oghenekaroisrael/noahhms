<?php 
	ob_start();
	session_start();
	$pageTitle = "Other Income";
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
			<div style="padding-bottom:45px;">
				<a href="new_income_t" style="margin-bottom:10px;" class="btn btn-primary pull-left btn-flat btblack">
						<i class="entypo-plus-circled"></i> New Income Type
				</a>
				
				<a href="revenue_list" style="margin-bottom:10px;background-color: #0f57c8;color: #fff;border-color:#0f57c8;" class="btn pull-left btn-flat">
				 View Revenue List
				</a>

				<a href="new_income" style="margin-bottom:10px;" class="btn btn-primary pull-right btn-flat btblack">
						<i class="entypo-plus-circled"></i> New Income
				</a>
			</div>
			
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">All Other Income </h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                    	<th>Date</th>
										<th>Amount</th>										
                                    	<th>Description</th>
                                    	<th>Added By</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_ord1('other_income','id','DESC');
											foreach($notarray as $row):
											$id = $row['id'];
											$amt = $row['amt'];
											$desc = $row['description'];
											$exp_date = strtotime($row['date_added']);
											$approver1 = $row['added_by'];

											$appro = database::getInstance()->select_from_where2('staff','user_id',$approver1);
											foreach ($appro as $lue) {
												$approver = $lue['last_name']." ".$lue['first_name']." ".$lue['other_names'];
											}
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	
											<td><i class="fas fa-clock-o"></i>
                                        		<?php echo date('d-m-Y', $exp_date);?>

                                        	</td>
											<td>&#x20A6;<?php echo number_format($amt); ?></td>
    										<td><i class="fas fa-file-text-o"></i><?php echo $desc; ?></td>
                                        	<td>
                                        	<i class="fas fa-user"></i>
											<?php echo $approver; ?>
                                        	</td>

                                        	
                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">...</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<li><a href="edit_income?id=<?php echo $id; ?>">View/Edit</a></li>
													<div class="divider"></div>
													<li><a onclick="sure(<?php echo $id; ?>,'<?php echo $amt; ?>')">Delete</a></li>
													</ul>
												</div>
											</td>
                                        </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
                                        <th>Amount</th>
										<th>Date</th>										
                                    	<th>Description</th>
                                    	<th>Added By</th>
                                    	<th>Action</th>
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
            data: "val=" + val +  '&ins=delIncome',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'oincome';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>
