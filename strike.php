<?php 
	include_once 'inc/db.php';
	if (isset($_POST['id']) && $_POST['view'] == "") {
	$id = $_POST['id'];
	$all = $_POST['all'];
	$loaded = database::getInstance()->select_new_strikes($id,$all); 
		foreach ($loaded as $n) {
			if ($n['patient_id'] == 0) {
				$name = $n['visitor'];
				$nid = $n['id'];
				$link = $n['link'].'&nid='.$n['id'].'&nstat=1';
				$msg = $n['message'];
			}else if($n['patient_id'] > 0) {
				$p = database::getInstance()->select_from_where2('patients','id',$n['patient_id']);
					foreach ($p as $e) {
						$name= $e['title']." ".$e['surname']." ".$e['middle_name']." ".$e['first_name'];
					}
				$nid = $n['id'];
				$link = $n['link'].'&nid='.$n['id'].'&nstat=1';
				$msg = $n['message'];
			}
		}
		$count = database::getInstance()->count_new_strikes($id,$all);
	$data = array('id' => $nid,'msg' => $msg,'link' =>$link,'patient'=>$name,'count'=>$count);
	echo json_encode($data);
}else if ($_POST['view'] != '' && !isset($_POST['id'])) {
		database::getInstance()->set_strike_seen($_POST['id']);
}else{
	exit();
	header("index.php");
}

?>