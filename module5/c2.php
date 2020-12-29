<?php
$db = mysqli_connect("localhost","root","","greenhousehms");
$get = mysqli_query($db, "SELECT SUM(amt) as amt FROM daily_expense WHERE MONTH(date_added) = ".date('m')."");
$cost = mysqli_fetch_assoc($get);


echo $c = $cost['amt'];
?>