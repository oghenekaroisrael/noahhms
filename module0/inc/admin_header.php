 <div class="sidebar" data-color=""  data-image="../assets/img/sidebar-5.jpg">


    	<div class="sidebar-wrapper">
		
			<?php
				$userDetails = Database::getInstance()->select_from_where2('staff','user_id',$user_id);
				foreach($userDetails as $row):
					$name = $row['last_name']." ".$row['first_name'];
                    $urole = Database::getInstance()->get_name_from_id("name","user_roles","id",$row['role_id']);
				endforeach;				
			?>
			<div class="clearTwenty"></div>
			<div id="nav-login">
                <center>
                    <img width="80" height="80" src="staff_img/<?php echo $row['staff_img']; ?>" class="img img-circle"><br>
                    <b><?php echo $name; ?></b>
                    <br>
                    <span><?php echo $urole; ?></span>
                </center>
            </div>
			<div class="clearfix"></div>
           <ul class="nav" id="my-nav">
               <li class="<?php if ($active_page == 'dashboard') echo 'active'; ?> ">
                    <a href="#">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'appointment') echo 'active'; ?> ">
                    <a href="../module1/appointment.php" target="_blank">
                        <i class="fas fa-user-tie"></i>
                        <p>Front Desk</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'appointment') echo 'active'; ?> ">
                    <a href="../module8/vitals.php" target="_blank">
                        <i class="fas fa-user-nurse"></i>
                        <p>Nurse</p>
                    </a>
                </li>
				
				<li class="<?php if ($active_page == 'patients') echo 'active'; ?> ">
                    <a href="../module11/patients.php" target="_blank">
                        <i class="fas fa-procedures"></i>
                        <p>In Patient Department</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'patients') echo 'active'; ?> ">
                    <a href="../module18/patients.php" target="_blank">
                        <i class="fas fa-users"></i>
                        <p>Out Patient Department</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'patients') echo 'active'; ?> ">
                    <a href="../module17/patients.php" target="_blank">
                        <i class="fas fa-ambulance"></i>
                        <p>Accident & Emergencies</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'in_patient') echo 'active'; ?> ">
                    <a href="in_patient">
                        <i class="fas fa-credit-card"></i>
                        <p>In-Patient Bill</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'index') echo 'active'; ?> ">
                    <a href="../module7/index.php" target="_blank">
                        <i class="fas fa-user-md"></i>
                        <p>Doctors</p>
                    </a>
                </li>
                
                 <li class="<?php if ($active_page == 'index')echo 'active'; ?>">
                    <a href="../module3/index.php" target="_blank">
                        <i class="fas fa-flask"></i>
                        <p>Laboratory</p>
                    </a>
                </li>
				
								
				
                <li class="<?php if ($active_page == 'prescriptions.php') echo 'active'; ?> ">
                    <a href="../module4/prescriptions.php" target="_blank">
                        <i class="fas fa-prescription-bottle-alt"></i>
                        <p>Pharmacy</p>
                    </a>
                </li>

                 <li class="<?php if ($active_page == 'prescriptions.php') echo 'active'; ?> ">
                    <a href="../module20/index.php" target="_blank">
                        <i class="fas fa-teeth-open"></i>
                        <p>Dentistry</p>
                    </a>
                </li>

                 <li class="<?php if ($active_page == 'prescriptions.php') echo 'active'; ?> ">
                    <a href="../module21/index.php" target="_blank">
                        <i class="fas fa-baby"></i>
                        <p>Pediatrics</p>
                    </a>
                </li>



                <li class="<?php if ($active_page == 'pos.php') echo 'active'; ?> ">
                    <a href="../module16/pos.php" target="_blank">
                        <i class="fas fa-utensils"></i>
                        <p>Cafeteria</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'index.php') echo 'active'; ?> ">
                    <a href="../module15/index.php" target="_blank">
                        <i class="fas fa-tint"></i>
                        <p>Blood Bank</p>
                    </a>
                </li>

               <li class="<?php if ($active_page == 'prescriptions.php') echo 'active'; ?> ">
                    <a href="../module6/prescriptions.php" target="_blank">
                        <i class="fas fa-warehouse"></i>
                        <p>Warehouse       </p>
                    </a>
                </li>
                
                 <li class="<?php if ($active_page == 'index.php') echo 'active'; ?> ">
                    <a href="../module5/index.php" target="_blank">
                        <i class="fas fa-file-invoice-dollar"></i>
                        <p>Accounts</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'index.php') echo 'active'; ?> ">
                    <a href="../module2/index.php" target="_blank">
                        <i class="fas fa-heartbeat"></i>
                        <p>NHIS</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'index') echo 'active'; ?> ">
                    <a href="../module13/index.php" target="_blank">
                        <i class="fas fa-x-ray"></i>
                        <p>Xray</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'scans') echo 'active'; ?> ">
                    <a href="../module19/scans.php" target="_blank">
                        <i class="fas fa-search"></i>
                        <p>Scan</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'index') echo 'active'; ?> ">
                    <a href="../module14/index.php" target="_blank">
                        <i class="fas fa-wheelchair"></i>
                        <p>Physiotherapy</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'index') echo 'active'; ?> ">
                    <a href="../module22/index.php" target="_blank">
                        <i class="fas fa-book-dead"></i>
                        <p>Morgue</p>
                    </a>
                </li>
                
                 <li class="<?php if ($active_page == 'staff.php' || $active_page == 'edit_staff' || $active_page == 'new_staff') echo 'active'; ?> ">
                    <a href="staff">
                        <i class="fas fa-users"></i>
                        <p>Manage Staff</p>
                    </a>
                </li>
                
            </ul>
    	</div>
    </div>