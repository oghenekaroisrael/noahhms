<?php 
if (isset($_POST['id'])) {
	include_once '../inc/db.php';
	$userDetails = database::getInstance()->select_from_where2and2('staff', 'role_id',5,'specialty',$_POST['id']);
	$output = "";
		if (!empty($userDetails)) {
			foreach ($userDetails as $n) {
				$id = $n['user_id'];
				$name = $n['first_name']." ".$n['last_name'];	
				$output .='
					<option value="'.$id.'">'.$name.'</option>
				';
			}
		}else{	
			$output .='<option>No Doctor Found</option>';
		}
	$data = array('doctors' => $output);
	echo json_encode($data);
}else{
	exit();
	header("index.php");
}

?>
