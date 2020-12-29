<?php
$db = mysqli_connect("localhost","root","","noahhms");
$sump = mysqli_query($db, "SELECT SUM(to_pay),patient_id FROM `accounts` WHERE company_id = 2 GROUP BY patient_id");
    while ($person = mysqli_fetch_assoc($sump)) {
    $notarray = mysqli_query($db, "SELECT * , SUM(to_pay) FROM `accounts` WHERE company_id = 2 AND patient_id =".$person['patient_id']." GROUP BY item");
    while($rowa = mysqli_fetch_assoc($notarray)){
    	echo $rowa['item']." ".$rowa['patient_id']."<br>";

    }
    echo $person['SUM(to_pay)']."<br>";
}
?>