<?php 
	ob_start();
	session_start();
	$pageTitle = "Invoice";
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
	if (!isset($_POST['generate'])) {
		unset($_POST);
	}else{
		$date_to = $_POST['date_to'];
        $date_from = $_POST['date_from'];
	}
$db =  mysqli_connect("localhost","root","","noahhms");
$tariff = $_POST['tariff'];
$pat = $_POST['pat'];
if ($tariff != "") {
    $tariff_name = database::getInstance()->get_name_from_id('name','tariffs','id',$tariff);
$tariff_name = strtolower($tariff_name);
$tariff_name = str_replace(" ", "_", $tariff_name);
}else if ($pat != "") {
    $tariff = database::getInstance()->get_name_from_id("tariff","patients","id",$pat);
    $tariff_name = database::getInstance()->get_name_from_id('name','tariffs','id',$tariff);
$tariff_name = strtolower($tariff_name);
$tariff_name = str_replace(" ", "_", $tariff_name);
}
?>
<style>
            @media print {
    .no-print{display: none;}
    .content{width: 100%;}
     @page {
           margin:0;

         }
         body  {
           padding-top: 20px;
           padding-bottom: 20px ;
         }
    }
}
            </style>
<div class="wrapper">
<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>
        <div class="content">
            <div class="container-fluid">
                 <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                               <center>
                                <?php
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
                            <div class="head-cont" style="width: 500px;">
                                CLAIMS FORM <?php echo $date_from; ?> TO <?php echo $date_to; ?>
                            </div>
                            </center>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="left">
                                         <div style="margin-left: 80px;">
                                             <h5><b>Tariff: </b><?php if(empty($tariff)){echo "All Tariffs";}else{echo ucwords(database::getInstance()->get_name_from_id('name','tariffs','id',$tariff)); }?></h5>
                                         </div>
                                    </div>


                                    <div class="right">
                                         <div style="margin-right: 80px;">
                                             <h5><b>Enrollee's Name: </b><?php 
                                             if(empty($pat)){
                                                echo "All Enrollees";
                                             }else{
                                                $e_name = database::getInstance()->select_from_where('patients','id',$pat);
                                             foreach ($e_name as $efull) {
                                                 $Enrollee_name = $efull['title']." ".$efull['surname']." ".$efull['first_name']." ".$efull['middle_name'];
                                             }
                                             echo ucwords($Enrollee_name);
                                             }
                                                 ?></h5>
                                         </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content" style="padding-bottom: 100px;">
                                <h1 class="title">Services Rendered</h1>
                                	<div class="row">
                                		<table class="table table-stripped">
                                      <thead>
                                          <th>#</th>
                                          <th>Enrollee</th>
                                          <th>Item</th>    
                                          <th>Cost</th>  
                                          <th>Balance</th>
                                          <th>Payment Status</th>
                                          <th>Date</th>
                                      </thead>
                                        <tbody>
                                             
                                         <?php 
                                                    $count = 1; 
                                                    if ($pat == "") {
                                                        $notarray = mysqli_query($db, "SELECT * FROM `accounts` WHERE  HMO = ".$tariff." AND date_paid BETWEEN '".$date_from."' AND ADDDATE('".$date_to."',1)");
                                                    }elseif ($pat != "") {
                                                        $notarray = mysqli_query($db, "SELECT * FROM `accounts` WHERE patient_id = ".$pat." AND date_paid BETWEEN '".$date_from."' AND ADDDATE('".$date_to."',1)");
                                                    }
                                                    $Total = 0;
                                                    $all_balance = 0;
                                                    foreach($notarray as $rowa):
                                                        $type = $rowa['item'];
                                                        $to_pay = $rowa['to_pay'];
                                                        $amount = $rowa['amount'];
                                                        $balance = intval($to_pay) - intval($amount);
                                                        $patient_id = $rowa['patient_id'];
                                                        $appointment_id = $rowa['app_id'];
                                                        $status = $rowa['payment_status']; 
                                                        $date = $rowa['date_paid'];
                                                        $oid = $rowa['order_id'];   
                                                        if ($appointment_id != 0) {
                                                            $frnt =$oid;
                                                        }else{
                                                            $frnt = $ref;
                                                        }    
                                                        $enr = database::getInstance()->select_from_where("patients","id",$patient_id);
                                                        foreach ($enr as $Enrollee) {
                                                            $Enrollee_name = $Enrollee['title']." ".$Enrollee['surname']." ".$Enrollee['middle_name']." ".$Enrollee['first_name'];
                                                        }

                                                        $c= 1;                                    
                                                        if($type == 2) {
                                                        $type_n = mysqli_query($db,"SELECT * FROM payment_type WHERE payment_type_id = ".$type."");
                                                    $type_na = mysqli_fetch_assoc($type_n);
                                                    $type_name = $type_na['payment_type'];
                                                    $notarray2 = database::getInstance()->select_from_where_Like('patient_test','link_ref',$oid);
                                                    foreach ($notarray2 as $row => $vali) {
                                                            $lab_test_id = $vali['lab_test_id'];
                                                            $notarray3 = database::getInstance()->select_from_where2('lab_test', 'lab_test_id',$lab_test_id );
                                                            foreach ($notarray3 as $row2 => $a) {
                                                                $lab_test.$c .= $a['lab_test'].",<br>";
                                                                    $tariff_name = database::getInstance()->  get_name_from_id('name','tariffs','id',$tariff);
                                                                    $tariff_name = strtolower($tariff_name);
                                                                    $tariff_name = str_replace(" ", "_", $tariff_name);
                                                                    $fee1 += intval($a[$tariff_name]);
                                                            }
                                                        }
                                                        $Total += $fee1;
                                                        $all_balance += $balance;
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $count++;?></td>
                                                                <td><?php echo $Enrollee_name;?></td>
                                                                <td><?php echo substr(trim($lab_test.$c), 1,-5); ?></td>
                                                                <td>&#x20A6;<?php echo $fee1;$fee1=0;?></td>
                                                                <td>&#x20A6;<?php echo $balance;?></td>
                                                                <td>
                                                                    <?php 
                                                                        if ($status == 1) {
                                                                            $stat = "Paid";
                                                                        }elseif ($status == 2) {
                                                                            $stat = "Paid Part";
                                                                        }elseif ($status == 3) {
                                                                            $stat = "Company Bill";
                                                                        }elseif ($status == 4) {
                                                                            $stat = "Deffered Payment";
                                                                        }elseif($status == 5){
                                                                            $stat = "Waved";
                                                                        }else{
                                                                            $stat = "Pending";
                                                                        }
                                                                        echo $stat;
                                                                        ?>                                                                  
                                                                </td>
                                                                <td><?php echo $date; ?></td>
                                                            </tr>
                                                    <?php
                                                    }elseif ($type == 3) {
                                                        $notarray = database::getInstance()->select_from_where2('prescription', 'reference',$oid);
                                                            foreach($notarray as $row):
                                                            $pharm_stock_id = $row['pharm_stock_id'];
                                                            $status = $row['status'];
                                                                $notarray = database::getInstance()->select_from_where2('pharm_stock', 'id',$pharm_stock_id );
                                                                foreach($notarray as $row):
                                                                    $name = $row['name'];
                                                                    $Total += $to_pay;
                                                                    $all_balance += $balance;
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $count++;?></td>
                                                                        <td><?php echo $Enrollee_name;?></td>
                                                                        <td><?php echo $name;?></td>
                                                                        <td>&#x20A6;<?php echo $to_pay;?></td>
                                                                        <td>&#x20A6;<?php echo $balance;?></td>
                                                                        <td>
                                                                    <?php 
                                                                        if ($status == 1) {
                                                                            $stat = "Paid";
                                                                        }elseif ($status == 2) {
                                                                            $stat = "Paid Part";
                                                                        }elseif ($status == 3) {
                                                                            $stat = "Company Bill";
                                                                        }elseif ($status == 4) {
                                                                            $stat = "Deffered Payment";
                                                                        }elseif($status == 5){
                                                                            $stat = "Waved";
                                                                        }else{
                                                                            $stat = "Pending";
                                                                        }
                                                                        echo $stat;
                                                                    ?>                                                                  
                                                                </td>
                                                                <td><?php echo $date; ?></td>
                                                                    </tr>
                                                            <?php endforeach;
                                                            endforeach;
                                                    }elseif ($type == 5) {
                                                        $notarray = database::getInstance()->select_from_where2('patients', 'id',$patient_id);
                                                            foreach($notarray as $row):
                                                            $card_type = $row['card_type'];

                                                                $notarray = database::getInstance()->select_from_where2('card_types', 'id',$card_type );
                                                                foreach($notarray as $row):
                                                                    $name = $row['name'];
                                                                    $price = $row['cost']; 
                                                                    $Total += $price;
                                                                    $all_balance += $balance;
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $count++;?></td>
                                                                        <td><?php echo $Enrollee_name;?></td>
                                                                        <td><?php echo $name;?></td>
                                                                        <td>&#x20A6;<?php echo $price;?></td>
                                                                        <td>&#x20A6;<?php echo $balance;?></td>
                                                                        <td>
                                                                    <?php 
                                                                        if ($status == 0) {
                                                                            $stat = "Pending";
                                                                        }elseif ($status == 1) {
                                                                            $stat = "Paid";
                                                                        }elseif ($status == 2) {
                                                                            $stat = "Paid Part";
                                                                        }elseif ($status == 3) {
                                                                            $stat = "Company Bill";
                                                                        }elseif ($status == 4) {
                                                                            $stat = "Deffered Payment";
                                                                        }else{
                                                                            $stat = "Waved";
                                                                        }
                                                                        echo $stat;
                                                                    ?>                                                                  
                                                                </td>
                                                                <td><?php echo $date; ?></td>
                                                                </tr>
                                                            <?php endforeach;
                                                            endforeach;
                                                    }elseif ($type == 6) {
                                                        $notarray = database::getInstance()->select_from_where2("xray_requests","link",$frnt);
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $count++;?></td>
                                                                        <td><?php echo $Enrollee_name;?></td>
                                                                        <td><?php
                                                                            foreach ($notarray as $ky) {
                                                                                $get_xray = database::getInstance()->select_from_where2("xray","id",$ky['name']);
                                                                                foreach ($get_xray as $ke) {            
                                                                                $xname.$c .= $ke['name'].",<br>";
                                                                                $fee2 += intval($ke[$tariff_name]);
                                                                                }
                                                                            }
                                                                            echo substr(trim($xname.$c), 1, -5);
                                                                        ?></td>
                                                                        <td>&#x20A6;<?php echo $to_pay; $Total += $to_pay;?></td>
                                                                <td>&#x20A6;<?php echo $balance; $all_balance += $balance;?></td>
                                                                        <td>
                                                                    <?php 
                                                                        if ($status == 1) {
                                                                            $stat = "Paid";
                                                                        }elseif ($status == 2) {
                                                                            $stat = "Paid Part";
                                                                        }elseif ($status == 3) {
                                                                            $stat = "Company Bill";
                                                                        }elseif ($status == 4) {
                                                                            $stat = "Deffered Payment";
                                                                        }elseif($status == 5){
                                                                            $stat = "Waved";
                                                                        }else{
                                                                            $stat = "Pending";
                                                                        }
                                                                        echo $stat;
                                                                    ?>                                                                  
                                                                </td>
                                                                <td><?php echo $date; ?></td>
                                                                    </tr>                                               
                                                            <?php
                                                    }elseif($type == 7) {
                                                        $db = mysqli_connect("localhost","root","","noahhms");
                                                        $type_n = mysqli_query($db,"SELECT * FROM payment_type WHERE payment_type_id = ".$type."");
                                                        $type_na = mysqli_fetch_assoc($type_n);
                                                        $type_name = $type_na['payment_type'];                              
                                                        $fee = 2500;
                                                        $Total += $to_pay;
                                                        $all_balance += $balance;
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $count++;?></td>
                                                                <td><?php echo $Enrollee_name;?></td>
                                                                <td>Physiotherapy Session</td>
                                                                <td>&#x20A6;<?php echo $fee;?></td>
                                                                <td>&#x20A6;<?php echo $balance;?></td>
                                                                <td>
                                                                    <?php 
                                                                        if ($status == 1) {
                                                                            $stat = "Paid";
                                                                        }elseif ($status == 2) {
                                                                            $stat = "Paid Part";
                                                                        }elseif ($status == 3) {
                                                                            $stat = "Company Bill";
                                                                        }elseif ($status == 4) {
                                                                            $stat = "Deffered Payment";
                                                                        }elseif($status == 5){
                                                                            $stat = "Waved";
                                                                        }else{
                                                                            $stat = "Pending";
                                                                        }
                                                                        echo $stat;
                                                                        ?>                                                                  
                                                                </td>
                                                                <td><?php echo $date; ?></td>
                                                            </tr>
                                                    <?php
                                                    }elseif($type == 8) {
                                                        $db = mysqli_connect("localhost","root","","noahhms");
                                                        $type_n = mysqli_query($db,"SELECT * FROM payment_type WHERE payment_type_id = ".$type."");
                                                        $type_na = mysqli_fetch_assoc($type_n);
                                                        $type_name = $type_na['payment_type'];                              
                                                        $fee = $to_pay;
                                                        $Total += $fee;
                                                        $all_balance += $balance;
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $count++;?></td>
                                                                <td><?php echo $Enrollee_name;?></td>
                                                                <td>Consultation Fee</td>
                                                                <td>&#x20A6;<?php echo $fee;?></td>
                                                                <td>&#x20A6;<?php echo $balance;?></td>
                                                                <td>
                                                                    <?php 
                                                                        if ($status == 1) {
                                                                            $stat = "Paid";
                                                                        }elseif ($status == 2) {
                                                                            $stat = "Paid Part";
                                                                        }elseif ($status == 3) {
                                                                            $stat = "Company Bill";
                                                                        }elseif ($status == 4) {
                                                                            $stat = "Deffered Payment";
                                                                        }elseif($status == 5){
                                                                            $stat = "Waved";
                                                                        }else{
                                                                            $stat = "Pending";
                                                                        }
                                                                        echo $stat;
                                                                        ?>                                                                  
                                                                </td>
                                                                <td><?php echo $date; ?></td>
                                                            </tr>
                                                    <?php
                                                    }elseif($type == 9) {                             
                                                        $fee = $to_pay;
                                                        $Total += $fee;
                                                        $all_balance += $balance;
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $count++;?></td>
                                                                <td><?php echo $Enrollee_name;?></td>
                                                                <td><?php
                                                                    $nam = mysqli_query($db, "SELECT * FROM patients WHERE id = ".$patient_id."");
                                                                    $get_name =mysqli_fetch_assoc($nam);
                                                                    echo $get_name['surname']." ".$get_name['middle_name']." ".$get_name['first_name'];
                                                                ?></td>
                                                                <td>In-Patient Bill</td>
                                                                <td>&#x20A6;<?php echo $fee;?></td>
                                                                <td>&#x20A6;<?php echo $balance;?></td>
                                                                <td>
                                                                    <?php 
                                                                        if ($status == 1) {
                                                                            $stat = "Paid";
                                                                        }elseif ($status == 2) {
                                                                            $stat = "Paid Part";
                                                                        }elseif ($status == 3) {
                                                                            $stat = "Company Bill";
                                                                        }elseif ($status == 4) {
                                                                            $stat = "Deffered Payment";
                                                                        }elseif($status == 5){
                                                                            $stat = "Waved";
                                                                        }else{
                                                                            $stat = "Pending";
                                                                        }
                                                                        echo $stat;
                                                                        ?>                                                                  
                                                                </td>
                                                                <td><?php echo $date; ?></td>
                                                            </tr>
                                                    <?php
                                                    }
                                                endforeach;
                                            
                                            ?>
                                            <tr>
                                                <td colspan="2"><b style="float: right;">Expected:</b> </td>
                                                <td><b>&#x20A6;<?php echo $Total; ?></b></td>
                                                <td><b>Balance: </b>&#8358;<?php echo $all_balance; ?></td>
                                            </tr>
                                    </tbody>
                                 <thead>
                                           <th>#</th>
                                            <th>Enrollee</th>
                                          <th>Item</th>    
                                          <th>Cost</th>  
                                          <th>Balance</th>
                                          <th>Payment Status</th>
                                          <th>Date</th>
                                      </thead>
                                        </table>
                                	</div>

                            </div>
                        </div>
                    </div>
                 </div>

            </div>
        </div>
	 <!-- //MAIN -->
     <div class="container" style="margin-bottom: 40px;">
         <a class="btn btn-info  no-print" style="padding-left: 40px; padding-right: 40px;" onclick="myFunction()">Print</a>
     </div>
		<!--  footer -->
		
	<?php include '../inc/footer-index.php';?>
	<!--//footer -->
        
    </div>

</div>


<div class="loader" id="load" style="display:none ">
</div>

	<script type="text/javascript">
	var s=jQuery .noConflict();
	 function myFunction() {
    window.print();
}
    </script>
    
