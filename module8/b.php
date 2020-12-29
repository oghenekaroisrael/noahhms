<?php
include('../inc/db.php');
if($_POST['id'] && !isset($_POST['bed'])){
$id=$_POST['id'];
	if($id==0){
	 echo "<option>No Room For Selected Type</option>";
	}else{
		$beds = Database::getInstance()->select_from_where2and2('beds','status',0,'bed_type',$id);
			foreach($beds as $bed):
				$bed_id= $bed['id'];
				$bed_name = $bed['bed'];	
				echo '<option value="'.$bed_id.'">'.$bed_name.'</option>';
			endforeach;
	}
}else{
	$id=$_POST['id'];
	if($id == 0){
	 echo "<option>No Room For Selected Type</option>";
	}else{
		$beds = Database::getInstance()->select_from_where_and_not2('beds','id',$_POST['bed'],'bed_type',$id);
			foreach($beds as $bed):
				$bed_id= $bed['id'];
				$bed_name = $bed['bed'];	
				echo '<option value="'.$bed_id.'">'.$bed_name.'</option>';
			endforeach;
	}
}
?>