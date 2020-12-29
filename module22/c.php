<?php 
if (isset($_POST['id'])) {
	include_once '../inc/db.php';
	echo $userDetails = database::getInstance()->get_name_from_id('amount', 'morgue_charges','id',$_POST['id']);
}else{
	exit();
	header("index.php");
}

?>
