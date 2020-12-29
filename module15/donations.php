
<?php 
	ob_start();
	session_start();
	$pageTitle = "Donors";
	// Include database class
	include_once '../inc/db.php';
	
	If(!isset($_SESSION['userSession'])){
		header("Location: ../index");
		exit;
	}
	elseif (isset($_SESSION['userSession'])){
		$user_id = $_SESSION['userSession'];
        $id = $_GET['id'];

        $donor = database::getInstance()->select_from_where("donors","donor_id",$id);
        foreach ($donor as $value) {
            $donor_name = $value['name'];
            $donor_father = $value['fathers_name'];
            $blood_group = $value['blood_group'];
            $sex = $value['gender'];
            $age = date_diff(strtotime($value['dob']),date("Y-m-d"));
            $weight = $value['body_weight'];
            $phone = $value['phone'];
            $email = $value['email'];
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
			<a href="new_donation?id=<?php echo $id; ?>" style="margin-bottom:10px;" class="btn btn-primary pull-right btn-flat btblack">
					<i class="entypo-plus-circled"></i> Donate Blood
			</a>
			</div>
			
                <div class="row">
					 <div class="col-md-12">
                                <div id="donor_details">
                                <label>Full Name: </label> <span><?php echo $donor_name; ?></span>
                                <br>
                                <label>Gender: </label> <span><?php echo $sex; ?></span> 
                                <br>
                                <label>Blood Group: </label><span><?php echo database::getInstance()->get_name_from_id('blood_group','blood_groups','blood_group_id',$blood_group); ?></span>
                                <br>
                                <label>Weight: </label> <span><?php echo $weight; ?></span><br>
                                <label>Phone: </label><span><?php echo $phone; ?></span><br>
                                <label>Email: </label><span><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></span>
                                </div>
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Donation History</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="pro"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                        <th>Date</th>
                                        <th>Pint(s)</th>
                                        <th>Collector</th>
										<th>Status</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_where_ord('donations','donor_id',$id,'id','DESC');
											foreach($notarray as $row):
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><i class="fas fa-clock-o"></i><?php echo $row['date_added']; ?></td>
                                        	<td><?php echo $row['pints']; ?></td>
                                        	<td>
                                                <?php 
                                                    $staff = database::getInstance()->select_from_where("staff","user_id",$row['added_by']);
                                                    foreach ($staff as $se) {
                                                        echo $se['title']." ".$se['last_name']." ".$se['first_name'];
                                                    }
                                                ?>
                                            </td>
                                        	<td>
                                        		<?php 
                                        			if ($row['status'] == "Clean") {
                                        				?>
                                        					<div class="badge badge-success">Clean</div>
                                        				<?php
                                        			}else if ($row['status'] == "Untested") {
                                                        ?>
                                                            <div class="badge badge-default">Untested</div>
                                                        <?php
                                                    }else{
                                        				?>
                                        					<div class="badge badge-warning">Infected</div>
                                        				<?php
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
													<li><a href="edit_donation?edit=<?php echo $row['id']; ?>&id=<?php echo $id; ?>">Edit</a></li>
													<li class="divider"></li>
                                                    <li>
                                                        <a href="testing.php?id=<?php echo $id; ?>&d=<?php echo $row['id'] ;?>">Testing</a>
                                                    </li>
                                                    <li class="divider"></li>
													<li><a onclick="sure(<?php echo $row['id']; ?>,'<?php echo $row['date_added']; ?>')">Delete</a></li>
													</ul>
												</div>
											</td>
                                        </tr>
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
										<th>#</th>
                                        <th>Date</th>
                                        <th>Pint(s)</th>
                                        <th>Collector</th>
                                        <th>Status</th>
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
            	message: "Are you sure you want to delete Donation Record On <b>"+name+"</b> From Donations List ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

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
            data: "val=" + val +  '&ins=delDonation',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
                    window.Location = "donations.php?id=<?php echo $id; ?>";
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>
