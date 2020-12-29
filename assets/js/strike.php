<?php 
include '../../inc/db.php';

$id = $_POST['id'];
database::getInstance()->strikes($id);
 ?>