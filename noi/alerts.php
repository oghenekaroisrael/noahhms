<?php
include('db.php');
extract($_REQUEST);

$h_name=htmlentities($_POST['alert']);
$in_name = mysqli_escape_string($h_name);

mysqli_query($db, "insert into alerts(message) values('$in_name')");

$alerts = mysqli_query($db, "select * from alerts order by alertId desc");
$full=mysqli_fetch_array($alerts);
?>
<div id="alerts">

<audio id="audioplayer" autoplay=true>
    <source src="sound/ping.mp3" type="audio/mpeg">
   <source src="sound/ping.ogg" type="audio/ogg">
  Your browser does not support the audio element. </audio>
<li>

<img src="icons/i.jpg" align="top" style="float:left; margin-right:2px;" />

<div><?php echo substr($full['message'],0,100)?></div>
</li>
</div>