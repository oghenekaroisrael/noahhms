<div class="container-fluid" id="notify_me">
					<div class="notify_box">
						<div class="notify_icon">
							<i class="fas fa-bell-o"></i>	
						</div>
						<div class="notify_content">
							<h4 class="text-center"><?php echo $notify['message']; ?></h4>
							<p class="text-center">
								<?php 
									 $notarray = database::getInstance()->select_from_where2('patients', 'id',$notify['patient_id'] );
											foreach($notarray as $row):
											echo $name = $row['title']." ".$row['surname']." ".$row['first_name'];
											endforeach;
								?>
							</p>
						</div>
						<div class="notify_actions">
							<a class="btn btn-link left" onclick="notify_me(<?php echo $here['id']; ?>)">Cancel</a> <a href="view" class="btn btn-info right">View</a>
						</div>
					</div>
					<audio id="notify_sound" autoplay=true>
				  <source src="../ping/alarm.ogg" type="audio/ogg">
				  <source src="../ping/alarm.mp3" type="audio/mp3">
				  Your browser does not support the audio element.
				</audio>
				</div>