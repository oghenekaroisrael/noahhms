<?php 
if (isset($_POST['view'])) {
	$id = $_POST['id'];
	$all = $_POST['all'];
	include_once 'inc/db.php';
	if ($_POST['view'] != '') {
		database::getInstance()->set_notifications_seen($id,$all);
	}
	$load = database::getInstance()->select_new_notifications($id,$all); 
	$output = "";
	if ($load > 0) {
		foreach ($load as $n) {
			if ($n['patient_id'] == 0) {
				$name = $n['visitor'];
			}else if($n['patient_id'] > 0){
				$p = database::getInstance()->select_from_where2('patients','id',$n['patient_id']);
					foreach ($p as $e) {
						$name= $e['title']." ".$e['surname']." ".$e['middle_name']." ".$e['first_name'];
					}
			}
			$time = database::getInstance()->timeago($n["time_taken"]);
			if ($n['status'] == 0) {
				$output .='
				<li>
					<a href="'.$n['link'] .'&nid='.$n['id'].'&nstat=1">
					<strong>'.$n['message'].'</strong><br>
					<small>'.$name.'</small>
					<small class="pull-right"><em>'.$time.'</em></small>
					<div class="clearfix"></div>
					</a>
				</li>
			';
			}else{
				$output .='
				<li>
					<a href="'.$n['link'] .'&nid='.$n['id'].'&nstat=1">
					<font>'.$n['message'].'</font><br>
					<small>'.$name.'</small>
					<small class="pull-right"><em>'.$time.'</em></small>
					<div class="clearfix"></div>
					</a>
				</li>
			';
			}
		}
	}else{
		$output .='
		<li><a href="#" class="text-bold text-italic">No New Notification Found</a></li>
		';
	}
	$count = database::getInstance()->count_new_notifications($id,$all); 
	$data = array('notification' => $output,'unseen_notification' => $count);
	echo json_encode($data);
}else{
	exit();
	header("index.php");
}

?>