<?php
include('../inc/db.php');
if($_POST['id'] && !isset($_POST['bed'])){
$id=$_POST['id'];
	if($id==0){
	 echo "<option>No Room For Selected Type</option>";
	}else{
		$beds = Database::getInstance()->select_from_where_and_not('morgue_beds','status',1,'room',$id);
		var_dump($beds);
			if ($beds) {
				foreach($beds as $bed):
					$bed_id = $bed['id'];
					$bed_name = $bed['name'];	
					echo '<option value="'.$bed_id.'">'.$bed_name.'</option>';
				endforeach;
			}else{	
				echo '<option>No Bed Available</option>';
			}
	}
}else{
	$id=$_POST['id'];
	if($id == 0){
	 echo "<option>No Room For Selected Type</option>";
	}else{
		$beds = Database::getInstance()->select_from_where_and_not2('morgue_beds','id',$_POST['bed'],'room',$id);
			if (!is_null($beds)) {
				foreach($beds as $bed):
					$bed_id= $bed['id'];
					$bed_name = $bed['name'];	
					echo '<option value="'.$bed_id.'">'.$bed_name.'</option>';
				endforeach;
			}else{	
				echo '<option>No Bed Available</option>';
			}
	}
}
?>