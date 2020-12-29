<?php

function connect_string(){
	 $host="localhost";$user = "root";$pass = "";$db ="noahhms";
$con = mysqli_connect($host , $user , $pass , $db) or die("Error connecting: ".mysqli_error());
return $con;
}
function tclean($chk){
				connect_string();
				$chk = @trim($chk);
				if(get_magic_quotes_gpc()){
				$chk = stripslashes($chk);

				}

				return mysqli_real_escape_string(connect_string(),$chk);
				}

function sanitizer($chk){
connect_string();
				$chk = @trim($chk);
				if(get_magic_quotes_gpc()){
				$chk = stripslashes($chk);

				}
return mysqli_real_escape_string(connect_string(),$chk);
				}
$host="localhost";$user = "root";$pass = "";$db = "noahhms";

$con = mysqli_connect($host , $user , $pass , $db);
if(!$con){
die("Connection failed to database server1:".mysqli_connect_error());
exit();
}
function remoteme($chk){
connect_string();
$read = mysqli_query(connect_string(),$chk);				
return $read;}
?>
