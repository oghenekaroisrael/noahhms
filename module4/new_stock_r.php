<?php 
	ob_start();
	session_start();
	$pageTitle = "Request For Stock From Warehouse";
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
	if (!isset($_SESSION['req'])) {
		$sales = Database::getInstance()->count_sales() +1;
    	$sales_id = date('Ymd')."$sales";
    	$_SESSION['req'] = $sales_id;
	} else {
		$_SESSION['req'] = $_SESSION['req'];
	}
$value = $_SESSION['req'];
if(isset($_GET['status']) AND $_GET['status'] == 'done') {
		?>
		<script>
				$(document).ready(function() {
					rem();
				});
		</script>
		<?php
	}elseif(isset($_GET['status']) AND $_GET['status'] == 'error1') {
		?>
		<script>
				$(document).ready(function() {
					norem();
				});
		</script>
		<?php
	}elseif(isset($_GET['status']) AND $_GET['status'] == 'error3') {
		?>
		<script>
				$(document).ready(function() {
					norem2();
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
                           <div class="header">
                                <h4 class="title">New Stock Request</h4>
                            </div>
                            <div class="content">
                                 <div>
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
		                                                <label>Search Warehouse </label>
		                                                <input type="text" class="form-control" id="proName" placeholder="Scan Barcode " onkeyup="return saler_next(this.value,`<?php echo $value;?>`)" autofocus >
		                                            </div>
		                                        </div>
											</div>
										</div>
										<div class="col-lg-3">
											
										</div>
										</div>
                                </form>
										<div class="row">
											<div class="col-lg-12">
												<div id="search">
											</div>
											</div>
										</div>
										</fieldset>
									</div><!--end class section-->	
                                </div><!--end id-->
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
	//Lets ajaxify this part on keyup
	var f=jQuery .noConflict();

	function saler_next(str,id){

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
document.getElementById("search").style.display="block";
document.getElementById("search").innerHTML=xmlhttp.responseText;
}

}



}
var url = "spot_re.php?q=" + str +"&p=" + id+"&st="+<?php echo $user_id; ?>;

xmlhttp.open("GET",url ,true);
xmlhttp.send();

}

	s(document).ready(function() {
		s('form').submit(function(e){
			var val = document.getElementById('proName').value;
			e.preventDefault();
			return saler_next(val,<?php echo $value;?>);
		})			
	})

	function rem(){ 

        	s.notify({
            	icon: 'pe-7s-check',
            	message: "Request For Stock Was Successful!"

            },{
                type: 'success',
                timer: 300000
            });

    	}

   function norem(){ 

        	s.notify({
            	icon: 'pe-7s-info',
            	message: "Request Was Unable To Send!"

            },{
                type: 'warning',
                timer: 300000
            });

    	}
    	function norem(){ 

        	s.notify({
            	icon: 'pe-7s-info',
            	message: "Item Has No Stock Number In Warehouse Or Is Out Of Stock!"

            },{
                type: 'warning',
                timer: 300000
            });

    	}
</script>

