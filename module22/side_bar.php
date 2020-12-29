<div class="side-bar" id="dside">
	<div class="fixed-header">
		<p class="text-center" style="margin-top: 20px;color: #000;">You Have Selected (<b style="color: #fff;" id="counter">
			
		</b>) Tests</p>
	<hr>
	</div>
	<div class="content_test_list">
		<ul class="selected_test_list">
			<?php  $db = mysqli_connect("localhost", "root", "", "noahhms"); ?>
			<?php  
				$noarray = database::getInstance()->select_from_where31('patient_test','patient_id', $value);
				foreach($noarray as $checked):
			?>
				<li>
					<?php 
						$cou1  = mysqli_query($db, "SELECT lab_test FROM lab_test WHERE lab_test_id = ".$checked['lab_test_id']."");
						$row = mysqli_fetch_assoc($cou1);
						echo $row['lab_test']; ?></li>
		<?php 
			endforeach;
			?>
	</ul>
	</div>
</div>