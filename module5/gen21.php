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
		$report = $_POST['report'];
        $payment_type = $_POST['type'];
        $dept1 = $_POST['dept'];
        if ($dept1 == 'all') {
            $dept = "";
        }else{
            $dept = $dept1;
        }
        if ($dept1 == 3) {
            $depts = "PHARMACY DEPARTMENT";
        }elseif ($dept1 == 2) {
            $depts = "LABORATORY DEPARTMENT";
        }elseif ($dept1 == 8) {
            $depts = "CONSULTATIONS";
        }elseif ($dept1 == 9) {
            $depts = "IN-PATIENTS DEPARTMENT";
        }elseif ($dept1 == 5) {
            $depts = "FRONT DESK DEPARTMENT";
        }
        if ($payment_type == 'all') {
            $join = "";
        }else{
            $join = "AND payment_status = ".$payment_type;
        }

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
<?php if ($report == "full") {?>
        <div class="content">
            <div class="container-fluid">
                 <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
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
                            <div class="head-cont" style="width: 900px;">
                                SALES REPORT FOR    <b><?php echo $depts; ?></b> FROM <?php echo $date_from; ?> TO <?php echo $date_from; ?>
                            </div>
                            </center>
                            </div>
                            <div class="content" style="padding-bottom: 100px;">
                                <h1 class="title">Total Transaction Details</h1>
                                <div class="row">
                                    <table class="table table-stripped">
                                        <thead>
                                            <th>#</th>
                                            <th>Payment Type</th>
                                            <th>Total Expected</th>
                                            <th>Total Recieved</th>
                                        </thead>
                                        <?php
                                            $pending1 = mysqli_query($db, "SELECT SUM(to_pay),SUM(amount) FROM accounts WHERE item = ".$dept." AND date_added BETWEEN '".$date_from."' AND '".$date_to."' AND payment_status = 0");
                                            while ($pending2  = mysqli_fetch_assoc($pending1)) {
                                                $expected += intval($pending2['SUM(to_pay)']);
                                                $recieved += intval($pending2['SUM(amount)']);
                                            }
                                            

                                             $full1 = mysqli_query($db, "SELECT SUM(to_pay),SUM(amount) FROM accounts WHERE item = ".$dept." AND date_paid BETWEEN '".$date_from."' AND '".$date_to."' AND payment_status = 1");
                                            while ($full2  = mysqli_fetch_assoc($full1)) {
                                                $expected1 += intval($full2['SUM(to_pay)']);
                                                $recieved1 += intval($full2['SUM(amount)']);
                                            }

                                             $part1 = mysqli_query($db, "SELECT SUM(to_pay),SUM(amount) FROM accounts WHERE item = ".$dept." AND date_paid BETWEEN '".$date_from."' AND '".$date_to."' AND payment_status = 2");
                                            while ($part2  = mysqli_fetch_assoc($part1)) {
                                            $expected2 = $part2['SUM(to_pay)'];
                                            $recieved2 = $part2['SUM(amount)'];
                                            }


                                             $comp = mysqli_query($db, "SELECT SUM(status),SUM(amount) FROM company_bill WHERE item = ".$dept." AND  date_added BETWEEN '".$date_from."' AND '".$date_to."'");
                                            while ($comp2  = mysqli_fetch_assoc($comp)) {
                                            $expected5 = $comp2['SUM(amount)'];
                                            $recieved5 = $comp2['SUM(status)'];
                                            }

                                             $wave1 = mysqli_query($db, "SELECT SUM(to_pay),SUM(amount) FROM accounts WHERE item = ".$dept." AND date_paid BETWEEN '".$date_from."' AND '".$date_to."' AND payment_status = 5");
                                            while ($wave2  = mysqli_fetch_assoc($wave1)) {
                                            $expected3 = $wave2['SUM(to_pay)'];
                                            $recieved3 = $wave2['SUM(amount)'];
                                            }

                                             $def1 = mysqli_query($db, "SELECT SUM(to_pay),SUM(amount) FROM accounts WHERE item = ".$dept." AND date_paid BETWEEN '".$date_from."' AND '".$date_to."' AND payment_status = 4");
                                            while ($def2  = mysqli_fetch_assoc($def1)) {
                                            $expected4 = $def2['SUM(to_pay)'];
                                            $recieved4 = $def2['SUM(amount)'];
                                            }
                                        ?>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Pending Transactions</td>
                                                <td><?php echo $expected; ?></td>
                                                <td><?php echo $recieved; ?></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Fully Paid Transactions </td>
                                                <td><?php echo $expected1; ?></td>
                                                <td><?php echo $recieved1; ?></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Part Paid Transactions</td>
                                                <td><?php echo $expected2; ?></td>
                                                <td><?php echo $recieved2; ?></td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Waved Transactions</td>
                                                <td><?php echo $expected3; ?></td>
                                                <td><?php echo $recieved3; ?></td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Deffered Transactions</td>
                                                <td><?php echo $expected4; ?></td>
                                                <td><?php echo $recieved4; ?></td>
                                            </tr>

                                            <tr>
                                                <td>5</td>
                                                <td>Company Transactions</td>
                                                <td><?php echo $expected5; ?></td>
                                                <td><?php echo $recieved5; ?></td>
                                            </tr>

                                            <tr>
                                                <td colspan="2">
                                                    <b style="float: right;">Total: </b>
                                                </td>
                                                <td><?php 
                                                    echo $expected+$expected1+$expected2+$expected3+$expected4;
                                                ?></td>
                                                <td><?php 
                                                    echo $recieved+$recieved1+$recived2+$expected3+$recieved4;
                                                    ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <thead>
                                            <th>#</th>
                                            <th>Payment Type</th>
                                            <th>Total Expected</th>
                                            <th>Total Recieved</th>
                                        </thead>
                                    </table>
                                </div>
                                <h1 class="title">Services Rendered</h1>
                                	<div class="row">
                                		<table class="table table-stripped">
                                      <thead>
                                          <th>#</th>
                                          <th>Patient's Name</th>
                                          <th>Item</th>    
                                          <th>Cost</th>  
                                          <th>Balance</th>
                                          <th>Payment Status</th>
                                          <th>Pay Date</th>
                                      </thead>
                                        <tbody>
                                             
                                         <?php 
                                                    $count = 1; 
                                                    $notarray = mysqli_query($db, "SELECT * FROM accounts WHERE item = ".$dept." AND  date_paid BETWEEN '".$date_from."' AND '".$date_to."' ".$join."");
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
                                                        $c= 1;                                       
                                                        if($type == 2) {
                                                        $db = mysqli_connect("localhost","root","","noahhms");
                                                        $type_n = mysqli_query($db,"SELECT * FROM payment_type WHERE payment_type_id = ".$type."");
                                                        $type_na = mysqli_fetch_assoc($type_n);
                                                        $type_name = $type_na['payment_type'];                              
                                                        $notarray2 = database::getInstance()->select_from_where60('patient_test', 'link_ref',$oid,'patient_test_id');
                                                        foreach ($notarray2 as $row => $vali) {
                                                            $lab_test_id = $vali['lab_test_id'];
                                                            $notarray3 = database::getInstance()->select_from_where2('lab_test', 'lab_test_id',$lab_test_id );
                                                            foreach ($notarray3 as $row2 => $a) {
                                                                $lab_test.$c .= $a['lab_test'].",<br>";
                                                                $fee.$c += intval($a['fee']); 
                                                            }
                                                        }
                                                        $Total += $fee.$c;
                                                        $all_balance += $balance;
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $count++;?></td>
                                                                <td><?php
                                                                    $nam = mysqli_query($db, "SELECT * FROM patients WHERE id = ".$patient_id."");
                                                                    $get_name =mysqli_fetch_assoc($nam);
                                                                    echo $get_name['surname']." ".$get_name['first_name'];
                                                                ?></td>
                                                                <td><?php echo substr(trim($lab_test.$c), 1,-5); ?></td>
                                                                <td>&#x20A6;<?php echo $fee.$c-1;?></td>
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
                                                    <?php
                                                    }elseif ($type == 3) {
                                                        $notarray = database::getInstance()->select_from_where2('prescription', 'reference',$oid);
                                                            foreach($notarray as $row):
                                                            $pharm_stock_id = $row['pharm_stock_id'];
                                                            $status = $row['status'];
                                                                $notarray = database::getInstance()->select_from_where2('pharm_stock', 'id',$pharm_stock_id );
                                                                foreach($notarray as $row):
                                                                    $name = $row['name'];
                                                                    $price = $row['price']; 
                                                                    $Total += $price;
                                                                    $all_balance += $balance;
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $count++;?></td>
                                                                        <td><?php
                                                                    $nam = mysqli_query($db, "SELECT * FROM patients WHERE id = ".$patient_id."");
                                                                    $get_name =mysqli_fetch_assoc($nam);
                                                                    echo $get_name['surname']." ".$get_name['first_name'];
                                                                ?></td>
                                                                        <td><?php echo $name;?></td>
                                                                        <td>&#x20A6;<?php echo $to_pay;?></td>
                                                                        <td>&#x20A6;<?php echo $amount;?></td>
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
                                                                        <td><?php
                                                                    $nam = mysqli_query($db, "SELECT * FROM patients WHERE id = ".$patient_id."");
                                                                    $get_name =mysqli_fetch_assoc($nam);
                                                                    echo $get_name['surname']." ".$get_name['first_name'];
                                                                ?></td>
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
                                                                        <td><?php
                                                                    $nam = mysqli_query($db, "SELECT * FROM patients WHERE id = ".$patient_id."");
                                                                    $get_name =mysqli_fetch_assoc($nam);
                                                                    echo $get_name['surname']." ".$get_name['first_name'];
                                                                ?></td>
                                                                        <td><?php
                                                                            foreach ($notarray as $ky) {
                                                                                $get_xray = database::getInstance()->select_from_where2("xray","id",$ky['name']);
                                                                                foreach ($get_xray as $ke) {            
                                                                                $xname .= $ke['name'].",<br>";
                                                                                }
                                                                            }
                                                                            echo substr(trim($xname), 0, -5);
                                                                        ?></td>
                                                                        <td>&#x20A6;<?php echo $to_pay; $Total += $to_pay;?></td>

                                                                <td>&#x20A6;<?php echo $amount;?></td>
                                                                <td>&#x20A6;<?php echo $balance; $all_balance += $balance;?></td>
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
                                                            <?php
                                                    }elseif($type == 7) {
                                                        $db = mysqli_connect("localhost","root","","noahhms");
                                                        $type_n = mysqli_query($db,"SELECT * FROM payment_type WHERE payment_type_id = ".$type."");
                                                        $type_na = mysqli_fetch_assoc($type_n);
                                                        $type_name = $type_na['payment_type'];                              
                                                        $fee = 2500;
                                                        $Total += $fee;
                                                        $all_balance += $balance;
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $count++;?></td>
                                                                <td><?php
                                                                    $nam = mysqli_query($db, "SELECT * FROM patients WHERE id = ".$patient_id."");
                                                                    $get_name =mysqli_fetch_assoc($nam);
                                                                    echo $get_name['surname']." ".$get_name['first_name'];
                                                                ?></td>
                                                                <td>Physiotherapy Session</td>
                                                                <td>&#x20A6;<?php echo $fee;?></td>
                                                                <td>&#x20A6;<?php echo $amount;?></td>
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
                                                    <?php
                                                    }elseif($type == 8) {
                                                        $db = mysqli_connect("localhost","root","","noahhms");
                                                        $type_n = mysqli_query($db,"SELECT * FROM payment_type WHERE payment_type_id = ".$type."");
                                                        $type_na = mysqli_fetch_assoc($type_n);
                                                        $type_name = $type_na['payment_type'];                              
                                                        $fee = $to_pay;
                                                        $Total += $to_pay;
                                                        $all_balance += $balance;
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $count++;?></td>
                                                                <td><?php
                                                                    $nam = mysqli_query($db, "SELECT * FROM patients WHERE id = ".$patient_id."");
                                                                    $get_name =mysqli_fetch_assoc($nam);
                                                                    echo $get_name['surname']." ".$get_name['first_name'];
                                                                ?></td>
                                                                <td>Consultation Fee</td>
                                                                <td>&#x20A6;<?php echo $fee;?></td>
                                                                <td>&#x20A6;<?php echo $amount;?></td>
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
                                                    <?php
                                                    }elseif($type == 9) {                             
                                                        $fee = $to_pay;
                                                        $Total += $to_pay;
                                                        $all_balance += $balance;
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $count++;?></td>
                                                                <td><?php
                                                                    $nam = mysqli_query($db, "SELECT * FROM patients WHERE id = ".$patient_id."");
                                                                    $get_name =mysqli_fetch_assoc($nam);
                                                                    echo $get_name['surname']." ".$get_name['middle_name']." ".$get_name['first_name'];
                                                                ?></td>
                                                                <td>In-Patient Bill</td>
                                                                <td>&#x20A6;<?php echo $fee;?></td>
                                                                <td>&#x20A6;<?php echo $amount;?></td>
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
                                                    <?php
                                                    }
                                                endforeach;
                                            
                                            ?>
                                            <tr>
                                                <td colspan="3"><b style="float: right;">Total:</b> </td>
                                                <td><b>&#x20A6;<?php echo $Total; ?></b></td>
                                                <td><?php echo $all_balance; ?></td>
                                            </tr>
                                    </tbody>
                                 <thead>
                                           <th>#</th>
                                          <th>Patient's Name</th>
                                          <th>Item</th>    
                                          <th>Cost</th>  
                                          <th>Balance</th>
                                          <th>Payment Status</th>
                                          <th>Pay Date</th>
                                      </thead>
                                        </table>
                                	</div>

                            </div>
                        </div>
                    </div>
                 </div>

            </div>
        </div>
    <?php }elseif($report == "minimal"){
        ?>
        <div class="content">
            <div class="container-fluid">
                 <div class="row">
                     <div class="col-md-12">
                        <div class="card1">
                            <div class="header">
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
                            <div class="head-cont" style="width: 500px;">
                                SALES REPORT FROM <?php echo $date_from; ?> TO <?php echo $date_from; ?>
                            </div>
                            </center>
                            </div>
                            <style type="text/css">
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
                                #minimal-1{
                                    border:solid #30952a 1px;
                                    color: #30952a;
                                    background: #fff;
                                    border-radius: 5px;
                                    box-shadow: #333 1px 1px 6px;
                                    height: 200px;
                                    margin-left: 25px;
                                    font-family: calibri;
                                    font-weight: lighter;
                                }
                                #minimal-2{
                                    border:solid #06f 1px;
                                    color: #06f;
                                    height: 200px;
                                    background: #fff;
                                    border-radius: 5px;
                                    box-shadow: #333 1px 1px 6px;
                                    margin-left: 25px;
                                    font-family: calibri;
                                    font-weight: lighter;
                                }
                                #minimal-3{
                                    border:solid #a0230d 1px;
                                    color: #a0230d;
                                    background: #fff;
                                    border-radius: 5px;
                                    box-shadow: #333 1px 1px 6px;
                                    height: 200px;
                                    margin-left: 25px;
                                    font-family: calibri;
                                    font-weight: lighter;
                                }
                                #minimal-4{
                                    border:solid #60f 1px;
                                    color: #60f;
                                    background: #fff;
                                    border-radius: 5px;
                                    box-shadow: #333 1px 1px 6px;
                                    height: 200px;
                                    margin-left: 25px;
                                    font-family: calibri;
                                    font-weight: lighter;
                                }
                                #minimal-5{
                                    border:solid #ff4a00 1px;
                                    color: #ff4a00;
                                    height: 200px;
                                    margin-left: 25px;
                                    background: #fff;
                                    border-radius: 5px;
                                    box-shadow: #333 1px 1px 6px;
                                    font-family: calibri;
                                    font-weight: lighter;
                                }
                                #minimal-6{
                                    border:solid #26ff00 1px;
                                    color: #26ff00;
                                    height: 200px;
                                    margin-left: 25px;
                                    background: #fff;
                                    border-radius: 5px;
                                    box-shadow: #333 1px 1px 6px;
                                    font-family: calibri;
                                    font-weight: lighter;
                                }
                                #minimal-1 > center > h2, #minimal-2 > center > h2,#minimal-3 > center > h2,#minimal-4 > center > h2,#minimal-5 > center > h2,#minimal-6 > center > h2{
                                    color: #333;
                                    font-family: calibri;
                                    font-weight: bold;
                                }

                                #minimal-1 > center > h4, #minimal-2 > center > h4,#minimal-3 > center > h4,#minimal-4 > center > h4,#minimal-5 > center > h4,#minimal-6 > center > h4{
                                    font-family: calibri;
                                    font-weight: lighter;
                                }

                            </style>
                            <?php
                                            $pending1 = mysqli_query($db, "SELECT SUM(to_pay),SUM(amount) FROM accounts WHERE  item = 2 AND  date_added BETWEEN '".$date_from."' AND '".$date_to."'");
                                            while ($pending2  = mysqli_fetch_assoc($pending1)) {
                                                $expected += intval($pending2['SUM(to_pay)']);
                                                $recieved += intval($pending2['SUM(amount)']);
                                            }
                                            

                                             $full1 = mysqli_query($db, "SELECT SUM(to_pay),SUM(amount) FROM accounts WHERE  item = 3 AND  date_paid BETWEEN '".$date_from."' AND '".$date_to."'");
                                            while ($full2  = mysqli_fetch_assoc($full1)) {
                                                $expected1 += intval($full2['SUM(to_pay)']);
                                                $recieved1 += intval($full2['SUM(amount)']);
                                            }

                                             $part1 = mysqli_query($db, "SELECT SUM(to_pay),SUM(amount) FROM accounts WHERE item = 8 AND  date_paid BETWEEN '".$date_from."' AND '".$date_to."'");
                                            while ($part2  = mysqli_fetch_assoc($part1)) {
                                            $expected2 = $part2['SUM(to_pay)'];
                                            $recieved2 = $part2['SUM(amount)'];
                                            }


                                             $comp = mysqli_query($db, "SELECT SUM(status),SUM(amount) FROM company_bill WHERE  item = 9 AND date_added BETWEEN '".$date_from."' AND '".$date_to."'");
                                            while ($comp2  = mysqli_fetch_assoc($comp)) {
                                            $expected5 = $comp2['SUM(amount)'];
                                            $recieved5 = $comp2['SUM(status)'];
                                            }

                                             $wave1 = mysqli_query($db, "SELECT SUM(to_pay),SUM(amount) FROM accounts WHERE  item = 8 AND  date_paid BETWEEN '".$date_from."' AND '".$date_to."'");
                                            while ($wave2  = mysqli_fetch_assoc($wave1)) {
                                            $expected3 = $wave2['SUM(to_pay)'];
                                            $recieved3 = $wave2['SUM(amount)'];
                                            }

                                             $def1 = mysqli_query($db, "SELECT SUM(to_pay),SUM(amount) FROM accounts WHERE date_paid BETWEEN '".$date_from."' AND '".$date_to."' AND payment_status = 4");
                                            while ($def2  = mysqli_fetch_assoc($def1)) {
                                            $expected4 = $def2['SUM(to_pay)'];
                                            $recieved4 = $def2['SUM(amount)'];
                                            }
                                        ?>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-md-1"></div>
                                <div class="col-md-3" id="minimal-1">
                                    <center>
                                        <h2>&#x20A6;<?php if ($expected1 != "") {echo $expected1;}else{echo "0"; } ?></h2>
                                        <h4>Paid: &#x20A6;<?php if ($recieved1 != "") {echo $recieved1;}else{echo "0"; } ?></h4>
                                        <h4>Pharmacy Department</h4>
                                    </center>
                                </div>
                                <div class="col-md-3" id="minimal-2">
                                    <center>
                                        <h2>&#x20A6;<?php echo $expected; ?></h2>
                                        <h4>Paid: &#x20A6;<?php if ($recieved != "") {echo $recieved;}else{echo "0"; } ?></h4>
                                        <h4>Laboratory Department</h4>
                                    </center>
                                </div>
                                <div class="col-md-3" id="minimal-3">
                                    <center>
                                        <h2>&#x20A6;<?php echo $expected5; ?></h2>
                                        <h4>Paid: &#x20A6;<?php if ($recieved5 != "") {echo $recieved5;}else{echo "0"; } ?></h4>
                                        <h4>In-patients</h4>
                                    </center>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <div class="row" style="margin-top: 20px;">                                
                                <div class="col-md-1"></div>
                                <div class="col-md-3" id="minimal-4">
                                    <center>
                                        <h2>&#x20A6;<?php echo $expected3; ?></h2>
                                        <h4>Paid: &#x20A6;<?php if ($recieved3 != "") {echo $recieved3;}else{echo "0"; } ?></h4>
                                        <h4>Consulations</h4>
                                    </center>
                                </div>
                                <div class="col-md-3" id="minimal-5">
                                    <center>
                                        <h2></h2>
                                        <h4></h4>
                                    </center>
                                </div>                                
                                <div class="col-md-1"></div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        <?php
    }elseif ($report == "semi") {?>
        <div class="content">
            <div class="container-fluid">
                 <div class="row">
                     <div class="col-md-12">
                        <div class="card">
                            <div class="header">
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
                            <div class="head-cont" style="width: 500px;">
                                SALES REPORT FOR <b><?php echo $depts; ?></b> FROM <?php echo $date_from; ?> TO <?php echo $date_from; ?>
                            </div>
                            </center>
                            </div>
                            <div class="content" style="padding-bottom: 100px;">
                                <h1 class="title">Services Rendered</h1>
                                    <div class="row">
                                        <table class="table table-stripped">
                                      <thead>
                                          <th>#</th>
                                          <th>Patient's Name</th>
                                          <th>Item</th>    
                                          <th>Cost</th>  
                                          <th>Balance</th>
                                          <th>Payment Status</th>
                                          <th>Pay Date</th>
                                      </thead>
                                        <tbody>
                                             
                                         <?php 
                                                    $count = 1; 
                                                    $notarray = mysqli_query($db, "SELECT *, SUM(to_pay) FROM accounts WHERE  item = ".$dept." AND date_paid BETWEEN '".$date_from."' AND '".$date_to."' ".$join." GROUP BY item");
                                                    $Total = 0;
                                                    $all_balance = 0;
                                                    foreach($notarray as $rowa):
                                                        $type = $rowa['item'];
                                                        $to_pay = $rowa['SUM(to_pay)'];
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
                                                        $c=1;                                     
                                                        if($type == 2) {
                                                        $db = mysqli_connect("localhost","root","","noahhms");
                                                        $type_n = mysqli_query($db,"SELECT * FROM payment_type WHERE payment_type_id = ".$type."");
                                                        $type_na = mysqli_fetch_assoc($type_n);
                                                        $type_name = $type_na['payment_type'];                              
                                                        $notarray2 = database::getInstance()->select_from_where60('patient_test', 'link_ref',$oid,'patient_test_id');
                                                        foreach ($notarray2 as $row => $vali) {
                                                            $lab_test_id = $vali['lab_test_id'];
                                                            $notarray3 = database::getInstance()->select_from_where2('lab_test', 'lab_test_id',$lab_test_id );
                                                            foreach ($notarray3 as $row2 => $a) {
                                                                $fee.$c += intval($a['fee']); 
                                                            }
                                                        }
                                                        $Total += $fee.$c;
                                                        $all_balance += $balance;
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $count++;?></td>
                                                                <td><?php
                                                                    $nam = mysqli_query($db, "SELECT * FROM patients WHERE id = ".$patient_id."");
                                                                    $get_name =mysqli_fetch_assoc($nam);
                                                                    echo $get_name['surname']." ".$get_name['first_name'];
                                                                ?></td>
                                                                <td><?php echo "Lab Test"?></td>
                                                                <td>&#x20A6;<?php echo $to_pay;?></td>
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
                                                    <?php
                                                    }elseif ($type == 3) {
                                                        $notarray = database::getInstance()->select_from_where2('prescription', 'reference',$oid);
                                                            foreach($notarray as $row):
                                                            $pharm_stock_id = $row['pharm_stock_id'];
                                                            $status = $row['status'];
                                                                $notarray = database::getInstance()->select_from_where2('pharm_stock', 'id',$pharm_stock_id );
                                                                foreach($notarray as $row):
                                                                    $name = $row['name'];
                                                                    $price = $row['price']; 
                                                                    $Total += $price;
                                                                    $all_balance += $balance;
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $count++;?></td>
                                                                        <td><?php
                                                                    $nam = mysqli_query($db, "SELECT * FROM patients WHERE id = ".$patient_id."");
                                                                    $get_name =mysqli_fetch_assoc($nam);
                                                                    echo $get_name['surname']." ".$get_name['first_name'];
                                                                ?></td>
                                                                        <td><?php echo "Drugs";?></td>
                                                                        <td>&#x20A6;<?php echo $to_pay;?></td>
                                                                        <td>&#x20A6;<?php echo $amount;?></td>
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
                                                                        <td><?php
                                                                    $nam = mysqli_query($db, "SELECT * FROM patients WHERE id = ".$patient_id."");
                                                                    $get_name =mysqli_fetch_assoc($nam);
                                                                    echo $get_name['surname']." ".$get_name['first_name'];
                                                                ?></td>
                                                                        <td><?php echo "Card"?></td>
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
                                                                        <td><?php
                                                                    $nam = mysqli_query($db, "SELECT * FROM patients WHERE id = ".$patient_id."");
                                                                    $get_name =mysqli_fetch_assoc($nam);
                                                                    echo $get_name['surname']." ".$get_name['first_name'];
                                                                ?></td>
                                                                        <td><?php echo "Xrays";
                                                                        ?></td>
                                                                        <td>&#x20A6;<?php echo $to_pay;?></td>

                                                                <td>&#x20A6;<?php echo $amount;?></td></td>
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
                                                            <?php
                                                    }elseif($type == 7) {
                                                        $db = mysqli_connect("localhost","root","","noahhms");
                                                        $type_n = mysqli_query($db,"SELECT * FROM payment_type WHERE payment_type_id = ".$type."");
                                                        $type_na = mysqli_fetch_assoc($type_n);
                                                        $type_name = $type_na['payment_type'];                              
                                                        $fee = 2500;
                                                        $Total += $fee;
                                                        $all_balance += $balance;
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $count++;?></td>
                                                                <td><?php
                                                                    $nam = mysqli_query($db, "SELECT * FROM patients WHERE id = ".$patient_id."");
                                                                    $get_name =mysqli_fetch_assoc($nam);
                                                                    echo $get_name['surname']." ".$get_name['first_name'];
                                                                ?></td>
                                                                <td>Physiotherapy Session</td>
                                                                <td>&#x20A6;<?php echo $to_pay;?></td>
                                                                <td>&#x20A6;<?php echo $amount;?></td>
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
                                                    <?php
                                                    }elseif($type == 8) {
                                                        $db = mysqli_connect("localhost","root","","noahhms");
                                                        $type_n = mysqli_query($db,"SELECT * FROM payment_type WHERE payment_type_id = ".$type."");
                                                        $type_na = mysqli_fetch_assoc($type_n);
                                                        $type_name = $type_na['payment_type'];                              
                                                        $fee = $to_pay;
                                                        $Total += $to_pay;
                                                        $all_balance += $balance;
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $count++;?></td>
                                                                <td><?php
                                                                    $nam = mysqli_query($db, "SELECT * FROM patients WHERE id = ".$patient_id."");
                                                                    $get_name =mysqli_fetch_assoc($nam);
                                                                    echo $get_name['surname']." ".$get_name['first_name'];
                                                                ?></td>
                                                                <td>Consultation Fee</td>
                                                                <td>&#x20A6;<?php echo $fee;?></td>
                                                                <td>&#x20A6;<?php echo $amount;?></td>
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
                                                    <?php
                                                    }elseif($type == 9) {                            
                                                        $fee = $to_pay;
                                                        $Total += $to_pay;
                                                        $all_balance += $balance;
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $count++;?></td>
                                                                <td><?php
                                                                    $nam = mysqli_query($db, "SELECT * FROM patients WHERE id = ".$patient_id."");
                                                                    $get_name =mysqli_fetch_assoc($nam);
                                                                    echo $get_name['surname']." ".$get_name['first_name'];
                                                                ?></td>
                                                                <td>In-Patient Bill</td>
                                                                <td>&#x20A6;<?php echo $fee;?></td>
                                                                <td>&#x20A6;<?php echo $amount;?></td>
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
                                                    <?php
                                                    }
                                                endforeach;
                                            
                                            ?>
                                            <tr>
                                                <td colspan="3"><b style="float: right;">Total:</b> </td>
                                                <td><b>&#x20A6;<?php echo $Total; ?></b></td>
                                                <td><?php echo $all_balance; ?></td>
                                            </tr>
                                    </tbody>
                                 <thead>
                                           <th>#</th>
                                          <th>Patient's Name</th>
                                          <th>Item</th>    
                                          <th>Cost</th>  
                                          <th>Balance</th>
                                          <th>Payment Status</th>
                                          <th>Pay Date</th>
                                      </thead>
                                        </table>
                                    </div>

                            </div>
                        </div>
                    </div>
                 </div>

            </div>
        </div>
    <?php }?>
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
    
