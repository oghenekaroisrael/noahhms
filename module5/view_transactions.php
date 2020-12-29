<?php 
	ob_start();
	session_start();
	$pageTitle = "Company Bills";
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
	$comp_id = $_GET['id'];
    $db = mysqli_connect("localhost","root","","noahhms");
    if (isset($_POST['search_param'])) {
    $from_date = $_POST['from'];
    $to_date = $_POST['to'];
    $search_param1 = "date_added BETWEEN '".$from_date."' AND '".$to_date."'";
    $search_param2 = "date_added BETWEEN '".$from_date."' AND '".$to_date."' AND company_id = ".$comp_id."";
}else{
    $from_date = "";
    $to_date = "";
    $search_param1 = "company_id = ".$comp_id." GROUP BY patient_id";
    $search_param2 = "company_id = ".$comp_id."";
    unset($_POST);
}
	$sql = mysqli_query($db, "SELECT * FROM company_bill WHERE company_id = ".$comp_id."");
	$sql2 = mysqli_query($db, "SELECT SUM(amount) FROM company_bill WHERE company_id = ".$comp_id."");    
    $sql3 = mysqli_query($db, "SELECT * FROM company_bill WHERE company_id = ".$comp_id." AND status = 0");
    $sql4 = mysqli_query($db, "SELECT * FROM company_bill WHERE company_id = ".$comp_id." AND status = 1");
	$count_all = mysqli_num_rows($sql);
	while ($amount_al = mysqli_fetch_assoc($sql2)) {
		$amount_all += $amount_al['SUM(amount)'];
	}
    while ($amount_al2 = mysqli_fetch_assoc($sql3)) {
        $pending_all += $amount_al2['amount'];
    }
    while ($amount_al3 = mysqli_fetch_assoc($sql4)) {
        $paid_all += $amount_al3['amount'];
    }

?>
<style>
            @media print {
    .no-print{display: none;}
     @page {
           margin-top: 0;
           margin-bottom: 0;
         }
         body  {
           padding-top: 30px;
           padding-bottom: 72px ;
         }
}
            </style>
<div class="wrapper">
<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>

        <div class="content">
            <div class="container-fluid">
				<div class="row no-print">
					 <div class="col-md-4">
					 	<center>
					 			<div class="company_boxes">
					 				<div class="row">
					 					<div class="col-md-4 comp-light-blue">
					 						<i class="fas fa-money"  style="font-size: 60px;position: relative;top: 30%;left: -15%;"></i>
					 					</div>
					 					<div class="col-md-8">
					 						<h3>Total Expected</h3>
					 						<b>&#x20A6;<?php if (empty($amount_all)) {
                                                echo "0";
                                            }else{
                                                echo $amount_all;
                                            } 
                                            ?></b>
					 					</div>
					 				</div>
					 			</div>
					 	</center>
					 </div>
					 <div class="col-md-4">
					 	<center>
					 			<div class="company_boxes">
					 				<div class="row">
					 					<div class="col-md-4 comp-blue">
					 						<i class="fas fa-money"  style="font-size: 60px;position: relative;top: 30%;left: -15%;"></i>
					 					</div>
					 					<div class="col-md-8">
					 						<h3>Total Paid</h3>
					 						<b>&#x20A6;<?php if (empty($paid_all)) {
                                                echo "0";
                                            }else{
                                                echo $paid_all;
                                            } 
                                            ?></b>
					 					</div>
					 				</div>
					 			</div>
					 	</center>
					 </div>
					 <div class="col-md-4">
					 	<center>
					 			<div class="company_boxes">
					 				<div class="row">
					 					<div class="col-md-4" style="background:#6a0505;">
					 						<i class="fas fa-money" style="font-size: 60px;position: relative;top: 30%;left: -15%;"></i>
					 					</div>
					 					<div class="col-md-8">
					 						<h3>Total Unpaid</h3>
					 						<b>&#x20A6;<?php if (empty($pending_all)) {
                                                echo "0";
                                            }else{
                                                echo $pending_all;
                                            } 
                                            ?></b>
					 					</div>
					 				</div>
					 			</div>					 			
					 	</center>
					 </div>
                 </div>
                 <div class="row no-print" style="margin-top: 30px;">
                     <div class="col-md-12">
                         <form action="" method="POST" name="search_date">
                             <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date From</label>
                                            <input type="date" class="form-control" name="from" placeholder="Date From" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date To</label>
                                            <input type="date" class="form-control" name="to" placeholder="Date To" >
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button name="search_param" type="submit" class="btn btn-info" style="margin-top: 20px;"><i class="fas fa-search"></i>Search</button>
                                    </div>
                             </div>
                         </form>
                     </div>
                     <div class="col-md-2"></div>
                     <div class="col-md-4">
                        <button  type="button" id="submitEP" class="btn btn-info btn-lg no-print" onclick="myFunction()"> Print Invoice</button>
                     </div>
                     <div class="col-md-4">
                         <div class="btn-group right" style="margin-right: 20px;">
                                                    <button type="button" class="btn btn-info btn-lg">Make Payment</button>
                                                    <button type="button" class="btn btn-info btn-lg dropdown-toggle" data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                    <?php
                                                    $arr = array();
                                                    $get_stat = mysqli_query($db, "SELECT DISTINCT status FROM company_bill WHERE company_id = ".$comp_id."");
                                                    while ($status1 = mysqli_fetch_assoc($get_stat)) {
                                                        $r += array_push($arr, $status1['status']);
                                                    }
                                                     if(in_array(0, $arr)){ ?>
                                                        <li><a onclick="accept(1,<?php echo $comp_id; ?>)">Full Payment</a></li>
                                                        
                                                    <?php }elseif(in_array(1, $arr)){ ?>
                                                        <li><a onclick="accept(0,<?php echo $comp_id; ?>)">Cancel Payment</a></li>
                                                    <?php }/*elseif ($status == 2) {
                                                        ?>
                                                    <li><a href="modal-comp.php?id=<?php echo $oid; ?>&pid=<?php echo $patient_id; ?>&ref=<?php echo $ref; ?>&amount=<?php echo $_GET['amount']; ?>&row=<?php echo $rid; ?>">Part Payment</a></li>
                                                        <li><a onclick="accept(1,<?php echo $comp_id; ?>)">Full Payment</a></li>
                                                        <li><a onclick="accept(0,<?php echo $comp_id; ?>)">Cancel Payment</a></li>
                                                        <?php
                                                    }*/ ?>
                                                    </ul>
                                                </div>
                     </div>
                     <div class="col-md-2"></div>
                 </div>
<div class="card" style="padding: 30px; margin-top: 40px;">
    <div class="row">
        <div class="col-md-12">
            <center>
                                <?php
                                $db =  mysqli_connect("localhost","root","","noahhms");
                                $info = mysqli_query($db, "SELECT * FROM hospital_info WHERE id = 1");
                                $get_hospital_info = mysqli_fetch_assoc($info);
                                $name = $get_hospital_info['name'];
                                $address = $get_hospital_info['address'];
                                $phone = $get_hospital_info['phone'];
                                $email =  $get_hospital_info['email'];
                                ?>
                                <h2><b><?php echo $name; ?></b></h2>
                            <?php echo $address; ?><br>
                            <?php echo $phone; ?> <?php echo $email; ?>
                            <br>
                            </center>
        </div>
    </div>
    <div class="row">
    <?php
    $comp_details_sql = mysqli_query($db, "SELECT * FROM companies WHERE id = ".$comp_id." LIMIT 1");
    $get_details = mysqli_fetch_assoc($comp_details_sql);
    $company_name = $get_details['company_name'];
    $company_address = $get_details['company_addr'];
    $company_phone = $get_details['company_pn'];
    $company_email = $get_details['email'];
     ?>
    <div class="col-md-4">
            <h3><b>INVOICED TO: </b></h3>
            <h3 style="line-height: 0;margin-bottom: -10px;font-family: calibri; font-weight: lighter;"><?php echo  $company_name; ?></h3>
            <h4 style="font-family: calibri; font-weight: lighter;"><?php echo  $company_address; ?></h4>
            <h5 style="font-family: calibri; font-weight: lighter;"><?php echo  $company_phone; ?></h5>
            <h5 style="font-family: calibri; font-weight: lighter;"><?php echo $company_email; ?></h5>
    </div>
    <div class="col-md-4"><span style="padding: 200px;"></span></div>
    <div class="col-md-4">
        <div style="position: relative;top: 30px;">
           <p>Invoice From : <?php echo $from_date; ?></p>
           <p>Invoice To : <?php echo $to_date; ?></p>
           <br>
        </div>
    </div>
</div>
        <div class="row" style="margin-top: 20px;">
                     <div class="col-md-12">
                        <div class="card">
                            <div class="content" style="padding-bottom: 100px;">
                                    <div class="row">
                                        <table class="table table-stripped">
                                      <thead>
                                        <th>#</th>
                                        <th>Card No</th>
                                        <th>Patient's Name</th>
                                        <th>Sex</th>
                                        <th>Date Of Visit</th>
                                        <th>No. Of Days</th>
                                        <th>Date Of Adm</th>
                                        <th>Date Of Dischr</th>
                                        <th>Diagnosis</th>
                                        <th>Service Description</th>
                                        <th>Amount</th>
                                        <th>Cumm</th>
                                      </thead>
                                        <tbody>
                                             
                                         <?php 
                                                    $count = 1;
                                                    $total = 0;
                                                    $sump = mysqli_query($db, "SELECT *,SUM(to_pay) FROM `accounts` WHERE ".$search_param2." GROUP BY item");
                                                    while($rowa = mysqli_fetch_assoc($sump)){
                                                        $type = $rowa['item'];
                                                        $to_pay = $rowa['SUM(to_pay)'];
                                                        $amount = $rowa['amount'];
                                                        $balance = intval($to_pay) - intval($amount);
                                                        $patient_id = $rowa['patient_id'];
                                                        $appointment_id = $rowa['app_id'];
                                                        $status = $rowa['payment_status']; 
                                                        $date = $rowa['date_paid'];
                                                        $oid = $rowa['order_id']; 
                                                        $pos_sql = mysqli_query($db, "SELECT * FROM company_bill WHERE order_id LIKE '".$oid."'");
                                                        $get_pos = mysqli_fetch_assoc($pos_sql); 
                                                        $position = $get_pos['position'];
                                                        $color = $get_pos['status'];
                                                        if ($appointment_id != 0) {
                                                            $frnt =$oid;
                                                        }else{
                                                            $frnt = $ref;
                                                        } 

                                                        $nam = mysqli_query($db, "SELECT * FROM patients WHERE id = ".$patient_id."");
                                                        $get_name =mysqli_fetch_assoc($nam);
                                                        $nam2 = mysqli_query($db, "SELECT * FROM patient_appointment WHERE patient_id = ".$patient_id."");
                                                        $get_name2 =mysqli_fetch_assoc($nam2);
                                                        $nam3 = mysqli_query($db, "SELECT * FROM ipd_patients WHERE patient_id = ".$patient_id."");
                                                        $get_name3 =mysqli_fetch_assoc($nam3);
                                                        $date_of_adm = $get_name3['admin_date'];
                                                        $date_of_disch = $get_name3['admission_status_date'];
                                                        $admission_status = $get_name3['admission_status_id'];
                                                        $reg_num = $get_name['reg_num'];
                                                        $sex = $get_name['sex']; 
                                                        $date_added = $get_name2['date_added'];
                                                        $diag = $get_name2['diagnosis']; 
                                                        ?>
                                                            <tr style="border-left-width: 5px;border-left-color: <?php if ($color == 1) { echo "green"; }else{echo "orange";} ?>;border-left-style: solid;">
                                                                <td><?php echo $count++;?></td>
                                                                <td><?php if(empty($reg_num)){echo '';}else{echo $reg_num;} ?></td>
                                                                <td><?php
                                                                    echo $get_name['surname']." ".$get_name['first_name'];
                                                                ?></td>
                                                                <td><?php if(empty($sex)){echo '';}else{echo $sex;} ?></td>
                                                                <td><?php echo $date_added; ?></td>
                                                                <td >1</td>
                                                                <td><?php echo $date_of_adm; ?></td>
                                                                <td>
                                                                    <?php
                                                                        if ($admission_status == 2) {
                                                                            echo $date_of_disch;
                                                                        }
                                                                    ?>
                                                                </td>
                                                                <td><?php if(empty($diag)){echo '';}else{echo $diag;} ?></td>
                                                                <td><?php 
                                                                    if($type == 2){
                                                                        $item ="Lab Test";
                                                                    }elseif($type == 3) {
                                                                        $item ="Drugs";
                                                                    }elseif($type == 5) {
                                                                        $item ="Card";
                                                                    }elseif($type == 6) {
                                                                        $item ="Xray";
                                                                    }elseif($type == 7) {
                                                                        $item ="Physiotherapy";
                                                                    }elseif($type == 8) {
                                                                        $item ="Consultation";
                                                                    } 
                                                                        echo $item; 
                                                                    ?></td>
                                                                <td>&#x20A6;<?php echo $to_pay;
                                                                $total += $to_pay;?></td>
                                                            </tr>
                                                    <?php

                                                    // }
                                                }//end of while loop
                                                ?>
                                                <tr>
                                                <td colspan="11"></td>   
                                                    <td><b>&#x20A6;<?php echo $total; ?></b></td>
                                                </tr>
                                    </tbody>
                                 <thead>                                       
                                        <th>#</th>
                                        <th>Card No</th>
                                        <th>Patient's Name</th>
                                        <th>Sex</th>
                                        <th>Date Of Visit</th>
                                        <th>No. Of Days</th>
                                        <th>Date Of Adm</th>
                                        <th>Date Of Dischr</th>
                                        <th>Diagnosis</th>
                                        <th>Service Description</th>
                                        <th>Amount</th>
                                        <th>Cumm</th>
                                      </thead>
                                        </table>
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
            	message: "Are you sure you want to delete <b>"+name+"</b> From Company list As This Will Also Erased Any and all transactions concerning this company? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

            },{
                type: 'danger',
                timer: 100000
            });

    	}

        function accept(stat,pid){ 
        var status = stat;
        var pid = pid;
         document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/edit.php',
            data: "&pid="+ pid +'&ins=acceptPayment_company'+'&status='+ status,
             success: function(data)
            {
                document.getElementById("load").style.display = "block";
                if (data === 'Done') {
                    console.log(data);
                        window.location = 'view_transactions?id='+pid;
                  }
                  else {
                       
                        jQuery('#get_det'+ID).html(data).show();
                  }
            }
          });
        }
		
		function delet(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/del.php',
            data: "val=" + val +  '&ins=delCompany',
             success: function(data)
            {
				document.getElementById("load").style.display = "block";
				if (data === 'Done') {
					console.log(data);
						window.location = 'view_companies';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}
 function myFunction() {
    window.print();
}
    </script>
