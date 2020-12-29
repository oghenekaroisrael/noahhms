<?php 
	ob_start();
	session_start();
	$pageTitle = "Process Sales";
	// Include database class
	include_once '../inc/db.php';
	
	If(!isset($_SESSION['userSession'])){
		header("Location: ../index");
		exit;
	}
	elseif (isset($_SESSION['userSession'])){
		$user_id = $_SESSION['userSession'];
	}

	if (!isset($_SESSION['sale'])) {
		$sales = Database::getInstance()->count_sales() +1;
    	$sales_id = date('Ymd')."$sales";
    	$_SESSION['sale'] = $sales_id;
	} else {
		$_SESSION['sale'] = $_SESSION['sale'];
	}
	include_once '../inc/header-index.php'; //for addding header
if(isset($_GET['status']) AND $_GET['status'] == 'done') {
		?>
		<script>
				$(document).ready(function() {
					suc();
				});
		</script>
		<?php
	}elseif(isset($_GET['status']) AND $_GET['status'] == 'error2'){
		?>
		<script>
				$(document).ready(function() {
					nosuc();
				});
		</script>
		<?php
	}elseif(isset($_GET['status']) AND $_GET['status'] == 'error3'){
		?>
		<script>
				$(document).ready(function() {
					nosuc();
				});
		</script>
		<?php
	}
?>
 <script src="JsBarcode.all.min.js"></script>
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
                            <div class="content">
	                           <div>
	                            	<div class="header">
	                                <h4 class="title">Scan Items To Dispense</h4>
	                            </div>
								<div id="sections">
									<div class="section">
										<fieldset>

                                <form id="processPharm" autocomplete="off">
										<div class="row">
												<div class="col-lg-3"></div>
										<div class="col-lg-6">
		                            		<div class="row">
		                                       <div class="col-md-12">
		                                            <div class="form-group">
		                                                <label>Scan Barcode </label>
		                                                <input type="text" class="form-control" id="proName" placeholder="Scan Barcode " onkeyup="return saler_next(this.value)" autofocus>
		                                            </div>
		                                        </div>
											</div>
										</div>
										<div class="col-lg-3">
											
										</div>
										</div>
                                </form>
										</fieldset>
									</div><!--end class section-->	
                                </div><!--end id-->
                                <div class="row">
									<div class="col-lg-12">
										<div class="content table-responsive table-full-width">
	                                		<table id="pro"class="table table-hover table-striped">
			                                    <thead>
													<th>#</th>
			                                    	<th>Drug Name</th>
			                                    	<th>Quantity In Stock</th>
			                                    	<th>Quantity Taken</th>
			                                    	<th>Action</th>
			                                    </thead>
			                                    <tbody>
			                                    	<tr id="search">
			                                    		
			                                    	</tr>
			                                    	<form method="POST" action="dispense.php">
			                                    	<?php 
			                                    	$coun =1;
			                                    		$in_sales = database::getInstance()->select_from_where2('in_sales','sales_id',$_SESSION['sale']);
			                                    		foreach ($in_sales as $vue) {

			                                    		$count_it = database::getInstance()->count_from_where('in_sales','sales_id',$_SESSION['sale']);
			                                    			$drug = $vue['drug'];
			                                    			$use = $vue['s_usage'];
			                                    			$sale_id = $vue['sales_id'];
			                                    			$id = $vue['id'];
			                                    			?>
			                                    			<input type="hidden" name="count" value="<?php echo $count_it;?>">
			                                    			<tr>
			                                    				<td><?php echo $count_i = $coun++; ?></td>
			                                    				<td><?php echo $dname = database::getInstance()->get_name_from_id('name','pharm_stock','id',$drug);?></td>
			                                    				<td><?php $quan = database::getInstance()->select_from_where2('pharm_stock','id',$drug);
			                                    					foreach ($quan as $su) {
			                                    						$quantity = ($su['tabs']*$su['packs']*$su['cartons'])+$su['c_carton'];
			                                    					}
			                                    					echo $quantity;
			                                    				?></td>
			                                    				<td><input type="number" name="quantity[]" class="form-control" placeholder="Quantity Taken">
			                                    					<input type="hidden" name="stock[]"  value ="<?php echo $drug; ?>">
			                                    					<input type="hidden" name="id"  value ="<?php echo $_SESSION['sale']; ?>">
			                                    					<input type="hidden" name="ids[]"  value ="<?php echo $id; ?>">
			                                    				</td>
			                                    				
																<td><a class="btn btn-danger btn-flat" id="sale_delete" onclick="sure(<?php echo $id; ?>,'<?php echo $dname; ?>')"><i class="fas fa-trash"></i></a></td>
			                                    			</tr>
			                                    			<?php
			                                    		}
			                                    		$num = $in_sales = database::getInstance()->count_sales('in_sales');
			                                    	 ?>	
			                                    	 <tr style="display: <?php if($num > 0){echo "contents";}else{echo "none";} ?>;">
			                                    	 	<td colspan="7">
			                                    	 		<div class="clearTwenty"></div>
			                                    	 		<a class="btn btn-danger btn-flat pull-right" id="sale_delete" onclick="cancel_all(<?php echo $_SESSION['sale']; ?>);"><i class="fas fa-times"></i>Cancel In-Sale</a>
			                                    	 		<div class="clearfix"></div>
			                                    	 		<div class="clearTwenty"></div>
																	
			                                    	 		<div class="form-group">
			                                    	 			<label>Collector's Name</label>
			                                    	 			<input type="text" name="collector" class="form-control" placeholder="Collector's Name" required>
			                                    	 		</div>
			                                    	 		<div class="form-group">
			                                    	 			<label>Reason For Collection</label>
			                                    	 			<textarea name="reason" class="form-control" required></textarea>
			                                    	 		</div>
			                                    	 		<button type="submit" class="btn btn-info" onclick="this.form.submit();">Dispense</button>
			                                    	 	</td>
			                                    	 </tr>
			                                    	 </form>		                                    	
			                                    </tbody>
											</div>
										</div>

	                            </div>
                                <div class="clearfix"></div>

                                <div class="clearTwenty"></div>
                            </div>
                        
						</div>
                    </div>
                 </div>

				<div id="get_result"></div>
				<div id="error"></div>
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
	var a=jQuery .noConflict();
	//define template
	var template = a('#sections .section:first').clone();

	//define counter
	var sectionsCount = 1;

	//add new section
	a('body').on('click', '.addsection', function() {

		//increment
		sectionsCount++;

		//loop through each input
		var section = template.clone().find(':input').each(function(){
				
			//set id to store the updated section number
			var newId = this.id + sectionsCount;

			//update for label
			a(this).prev().attr('for', newId);

			//update id
			this.id = newId;
		}).end()

		//inject new section
		.appendTo('#sections');
		return false;
	});

</script>

<script type="text/javascript">
	/*
	window.onload = function() {
		var input = document.getElementById('proName').focus();
	}*/
//get the title of ecurrency choosen
	//Lets ajaxify this part on keyup
	var f=jQuery .noConflict();
	f(document).ready(function(){
		var p_id; //to make it accessible
			f(".chooseList p").click(function(){
				var text = f(this).text();
				p_id = f(this).attr('id');
				f(".toggle").html(text); //display teh text of the id in the textbox i.e the nam eof teh client
				f( ".toggleDrop" ).hide(); //removes drop down on click	
			});
		function Update_stock(str) {
			
			var proName = str;
			
			//get users acc
			f.ajax({
				type: 'post',
				url: "../func/verify.php",				
				data: "proName=" + proName + '&ins=get_price',
				dataType: "json",
				success: function(data){
					
					if(data.value === "Done"){
						document.getElementById("pricee").style.display = "block";
						f('#price').val(data.value2);
						f('#error').val(data.error);
					} else if(data.value === "no"){
						document.getElementById("pricee").style.display = "block";
					}
				}	
			});
		}

	});
	function saler_next2(str){

if(str.length == 0){
document.getElementById("search").style.display="none";
document.getElementById("search").innerHTML=xmlhttp.responseText;
document.getElementById("search").style.border="0px";

}
var xmlhttp;
if(window.XMLHttpRequest){

xmlhttp = new XMLHttpRequest();

}
else{
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

}
xmlhttp.onreadystatechange=function(){
if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
	
if(xmlhttp.responseText.length == 0){
document.getElementById("search").style.display="none";
document.getElementById("search").innerHTML=xmlhttp.responseText;
document.getElementById("search").style.border="0px";
}else{
document.getElementById("search").style.display="contents";
document.getElementById("search").innerHTML=xmlhttp.responseText;
window.location = 'in-sales.php';

}

}



}
var url = "spot3.php?q=" + str + '&dispenser=<?php echo $user_id; ?>&id=' + <?php echo $_SESSION['sale']; ?>;

xmlhttp.open("GET",url ,true);
xmlhttp.send();

}
function sure(ID,name){ 

        	f.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to delete <b>"+name+"</b> from This List ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

            },{
                type: 'danger',
                timer: 100000
            });

    	}
		function suc(){ 

        	s.notify({
            	icon: 'pe-7s-check',
            	message: "Item Has Been Dispensed Successfully"

            },{
                type: 'success',
                timer: 300000
            });

    	}

    	function nosuc(){ 

        	s.notify({
            	icon: 'pe-7s-check',
            	message: "Item Could Not Be Dispensed From Stock"

            },{
                type: 'warning',
                timer: 300000
            });

    	}
		function delet(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          f.ajax({
            type: 'post',
            url: '../func/del.php',
            data: "val=" + val +  '&ins=delSale',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'in-sales';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

		function cancel_all(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          f.ajax({
            type: 'post',
            url: '../func/del.php',
            data: "val=" + val +  '&ins=delSale_all',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'in-sales';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

	f(document).ready(function() {
		f('form').submit(function(e){
			var val = document.getElementById('proName').value;
			e.preventDefault();
			return saler_next2(val);
		})	
		f('#processSale').submit(function(e){
			var id = "<?php echo $value; ?>";
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			f.ajax({
				type: "POST",
				data: f('#processSale').serialize() + "&id=" + id + "&ins=editForm",
				url: "dispense",
				success: function(res) {
					document.getElementById("load").style.display = "none";
					f("#get_result").html(res).fadeIn("slow");
				}
			});
		})		
	})
</script>

