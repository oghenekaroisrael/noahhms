<?php 
	ob_start();
	session_start();
	$pageTitle = "In-Patient Bill";
	// Include database class
	include_once '../inc/db.php';
	
	If(!isset($_SESSION['userSession'])){
		header("Location: ../index");
		exit;
	}
	elseif (isset($_SESSION['userSession'])){
		$user_id = $_SESSION['userSession'];
	}
	$aid = $_GET['id'];
if (isset($_POST) AND !empty($_POST['fee']) AND $_POST['fee'] != 0 AND !empty($_POST['name'])) {
	$insert = database::getInstance()->insert_bill($aid,$_POST['fee'],$_POST['name'],$user_id);
if ($insert === 'Done') {
	unset($_POST);
}else{
	unset($_POST);
}
}else{
	unset($_POST);
}
	include_once '../inc/header-index.php'; //for addding header
if(isset($_GET['status']) AND $_GET['status'] == 'cleared'){
    	echo "<script>
                alert('Bill Has Been Cleared From System');
        </script>";
    }
?>

<div class="wrapper" id="homesc">

<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>
	
	  <!--  MAIN -->
        <div class="content">
            <div class="container-fluid">
	
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                           <div class="header">
                                <h4 class="title">In-Patient Billing</h4>
                            </div>
                            <div class="content">
                                <form method="POST" action="prepare_bill.php?id=<?php echo $_GET['id']; ?>">
                                     <div class="row">
                                       <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <input type="text" class="form-control" name="name" placeholder="Description" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Fee</label>
                                                <input type="number" class="form-control" name="fee" placeholder="Fee" >
                                            </div>
                                        </div>
									</div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Add Item</button>
									<button type="reset" class="btn btn-danger btn-fill pull-left">Clear</button>	
                                </form>
                            </div>
                        
						</div>
                    </div>
                 </div>

                 <div class="row">
						<div class="col-lg-2"></div>
						<div class="col-lg-8">
							<div class="content table-responsive table-full-width">
								<table class="table table-hover table-striped">
									<thead>
										<th>#</th>
										<th>Item</th>
										<th>Amount</th>
										<th>Remove From List</th>
									</thead>
									<tbody>
			                                    	<?php 
			                                    	$coun =1;
			                                    		$tmp_sales = database::getInstance()->select_from_where2('`in-patients`','app_id',$_GET['id']);
			                                    		foreach ($tmp_sales as $vue) {

			                                    		$count_it = database::getInstance()->select_from_where2('`in-patients`','app_id',$_GET['id']);
			                                    			$amount = $vue['to_pay'];
			                                    			$dname = $vue['item'];
			                                    			$id = $vue['id'];                                    			
			                                    			?>
			                                    			<input type="hidden" name="count" value="<?php echo $count_it;?>">
			                                    			<tr>
			                                    				<td><?php echo $count_i = $coun++; ?></td>
			                                    				<td><?php echo $dname; ?></td> 
			                                    				<td><?php echo $amount; ?></td>                             
			                                    				<td><a class="btn btn-danger btn-flat" id="sale_delete" onclick="sure(<?php echo $id; ?>,'<?php echo $dname; ?>')"><i class="fas fa-trash"></i></a></td>
			                                    			</tr>
			                                    			<?php
			                                    		}
			                                    		$num = $tmp_sales = database::getInstance()->count_bill($aid);
			                                    	 ?>	
			                                    	 <tr style="display: <?php if($num > 0){echo "contents";}else{echo "none";} ?>;">
			                                    	 	<td colspan="2">
			                                    	 		<button class="btn btn-danger btn-flat pull-left" id="sale_delete" onclick="cancel_all(`<?php echo $aid; ?>`);">Cancel This Transaction</button>
			                                    	 	</td>
			                                    	 	<td colspan="2">

			                                    	 		<button type="submit" class="btn btn-success pull-right" onclick="sure2(<?php echo $aid; ?>,`<?php echo $names; ?>`);">SEND TO ACCOUNT</button><!--vlue == 1 -->
			                                    	 	</td>
			                                    	 </tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>

				<div id="get_result"></div>
				

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

<script>
	var a=jQuery .noConflict();
	
	function cancel_all(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          a.ajax({
            type: 'post',
            url: '../func/del.php',
            data: "val=" + val +  '&ins=delInpatient_all',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'prepare_bill.php?id=<?php echo $aid; ?>&status=cleared';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}
function sure(ID,name){ 

        	a.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to delete <b>"+name+"</b> from This Prepared  List ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

            },{
                type: 'danger',
                timer: 100000
            });

    	}
function cleared(){ 

        	a.notify({
            	icon: 'pe-7s-check',
            	message: "Bill Was Cleared Out Successfully"

            },{
                type: 'success',
                timer: 3000
            });

    	}
		function delet(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          a.ajax({
            type: 'post',
            url: '../func/del.php',
            data: "val=" + val +  '&ins=delInpatientDet',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'prepare_bill.php?id=<?php echo $aid; ?>&status=deleted';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

		function sure2(ID,name){ 

        	a.notify({
            	icon: 'pe-7s-info',
            	message: "Are you sure you want to Send Bill To Account<b>"+name+"</b> from This Prepared  List ? </br><button type='button' class='btn pop-btn' onclick='pay("+ID+")'>Send To Account  </button>"

            },{
                type:'info',
                timer: 100000
            });

    	}

		function pay(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          a.ajax({
            type: 'post',
            url: '../func/edit.php',
            data: "val=" + val + '&ins=SendtoAcc',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'prepare_bill.php?id=<?php echo $aid; ?>&status=done2';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}
</script>