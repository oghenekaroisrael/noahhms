<?php 
	ob_start();
	session_start();
	$pageTitle = "Edit Patient";
	// Include database class
	include_once '../inc/db.php';
	
	If(!isset($_SESSION['userSession'])){
		header("Location: ../index");
		exit;
	}
	elseif (isset($_SESSION['userSession'])){
		$user_id = $_SESSION['userSession'];
	}
	include_once '../inc/header-index.php'; //for addding header

	$value= $_GET['edit'];
?>
 
<div class="wrapper" id="homesc">
<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>
	  <!--  MAIN -->
        <div class="content">
            <div class="container-fluid">
				
				
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                           <div class="header">
                                <h4 class="title">Edit Patient Details</h4>
                            </div>
                            <div class="content">
                                <form id="patient">
								 <?php
                            $noarray = database::getInstance()->select_from_where('patients','id',$value);
                            while ($ow = $noarray->fetch(PDO::FETCH_ASSOC)) {
                            $photo = $ow['photo'];
							$card_type = $ow['card_type'];
							$middle_name = $ow['middle_name'];
							$sex = $ow['sex'];
							$blood = $ow['blood_group'];
							$nhis = $ow['nhis_num'];
							$add = $ow['address'];
							$city = $ow['city'];
							$state = $ow['state'];
							$religion = $ow['religion'];
							$ethnic = $ow['ethnic'];
							$nationality = $ow['nationality'];
							$national_id = $ow['national_id'];
							$enrol = $ow['enrollee_num'];
							$age = $ow['age'];
							$tel1 = $ow['tel_one'];
							$tel2 = $ow['tel_two'];
							$email = $ow['email'];
							$photo = $ow['photo'];
							$dob = $ow['dob'];
							$kin1 = $ow['next_kin_phone'];
							$kin2 = $ow['next_kin_address'];
							$company = $ow['company_id'];
							$family = $ow['family_id'];
							$insurance = database::getInstance()->get_name_from_id('insurance_type','insurance_type','insurance_type_id',$ow['insurance_type_id']);
							$contact = database::getInstance()->get_name_from_id('contact_method','contact_method','contact_method_id',$ow['contact_method_id']);
							
							?>
							    <?php if($photo != ""){ ?>
								<div class="header">
                                    <div class="pinshure"><img src="../photo/<?php echo $photo; ?>"/></div>
                                </div>
                                <?php } ?>
								<div class="col-md-6">
										
										<div class="row">

									
	                                         
											
	                                       <div class="col-md-4">
	                                           
			                                        <div class="form-group">
			                                            <label>Title</label>
			                                            <input type="text" class="form-control" name="title" placeholder="Title" value="<?php echo $ow['title'];?>">
			                                        </div>   
			                                    
			                                </div>

			                                <div class="col-md-8">
	                                            <div class="form-group">
	                                                <label>First Name</label>
	                                                <input type="text" class="form-control" name="first" placeholder="First Name" value="<?php echo $ow['first_name'];?>">
												</div>
	                                        </div> 
											
											
										</div>
										
									</div>
                                	
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-6">
	                                            <div class="form-group">
			                                        <label>Surname</label>
			                                        <input type="text" class="form-control" name="surname" placeholder="Surname" value="<?php echo $ow['surname'];?>" >
			                                     </div>
	                                        </div> 

	                                       <div class="col-md-6">
	                                            <div class="form-group">
	                                                <label> Middle Name</label>
	                                                <input type="text" class="form-control" name="m_name" placeholder="Middle Name" value="<?php echo $middle_name;?>">
												</div>
	                                        </div> 
										</div>
									</div>

									

									

							
									<div class="col-md-12">
										<div class="row">
	                                       <div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Sex</label>
	                                                
	                                                <select class="form-control" id="sex" name="sex">
														<option value="<?php if($sex != ""){ echo $sex; } ?>"><?php if($sex != ""){ echo $sex; } ?></option>
														<option value="Female">Female</option>
														<option value="Male">Male</option>
														<option value="Other">Other</option>
													</select>
	                                            </div>
	                                        </div>
									

	                                       <div class="col-md-4">
	                                            <div class="form-group">
	                                                <label>Blood Group</label>
	                                                <input type="text" class="form-control" name="blood" placeholder="Blood Group" value="<?php echo $blood;?>">
	                                            </div>
	                                        </div>
									
									
	                                       <div class="col-md-3">
	                                           <div class="form-group">
	                                                <label>Insurance</label>
	                                                <select class="form-control" id="insurance" name="insurance">
														<option value="<?php echo $ow['insurance_type_id'];?>"><?php echo $insurance;?></option>
														<?php 
														$notarray = database::getInstance()->select_from_wherenot_ord('insurance_type','insurance_type_id',$ow['insurance_type_id'],'insurance_type_id','DESC');
														foreach($notarray as $row):?>
                                            
														<option value="<?php echo $row['insurance_type_id'];?>"><?php echo $row['insurance_type'];?></option>
														<?php endforeach; ?>
													</select>
	                                            </div>
	                                        </div>
											
											<div class="col-md-2">
	                                            <div class="form-group">
	                                                <label>NHIS Number</label>
	                                                <input type="text" class="form-control" name="nhis" placeholder="NHIS Number" value="<?php echo $nhis;?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-8">
	                                            <div class="form-group">
	                                                <label>Address</label>
	                                                <input type="text" class="form-control" name="address" placeholder="Address" value="<?php echo $add;?>">
	                                            </div>
	                                        </div>
											                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
											<div class="col-md-4">
	                                            <div class="form-group">
	                                                 <label>City</label>
	                                                <input type="text" class="form-control" name="city" placeholder="City" value="<?php echo $city;?>" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>State</label>
	                                                <input type="text" class="form-control" name="state" placeholder="State" value="<?php echo $state;?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>Ethnic Group</label>
	                                                <input type="text" class="form-control" name="ethnic" placeholder="Ethnic Group" value="<?php echo $ethnic;?>">
	                                            </div>
	                                        </div>
											
	                                    </div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>Religion</label>
	                                                <input type="text" class="form-control" name="religion" placeholder="Religion" value="<?php echo $religion;?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>Nationality</label>
	                                                <input type="text" class="form-control" name="nationality" placeholder="Nationality" value="<?php echo $nationality;?>">
	                                            </div>
	                                        </div>
											
	                                    </div>
									</div>
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-5">
	                                            <div class="form-group">
	                                                <label>National ID</label>
	                                                <input type="text" class="form-control" name="natid" placeholder="National ID" value="<?php echo $national_id;?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-4">
	                                            <div class="form-group">
	                                                <label>HMO/Enrollee Number</label>
	                                                <input type="text" class="form-control" name="enr" placeholder="HMO/Enrollee Number" value="<?php echo $enrol;?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Age Type</label>
	                                                <select class="form-control" id="ageType" name="ageType">
														<?php
															if (!empty($ow['age_type'])) {
																echo '<option value="'.$ow['age_type'].'">'.$ow['age_type'].'</option>';
															}
														?>
														<option value="Elder">Elder</option>
														<option value="Adult">Adult</option>
														<option value="Teenager">Teenager</option>
														<option value="Baby">Baby</option>
													</select>
	                                            </div>
	                                        </div>
											
											
	                                    </div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>Date of Birth</label>
	                                                <input type="date" class="form-control" name="dob" placeholder="Date of Birth" value="<?php echo $dob;?>">
	                                            </div>
	                                        </div>
											
											
											<div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>Photo(<?php echo $photo;?>)</label>
	                                                <input type="file" class="form-control" name="file" placeholder="Photo" value="<?php echo $photo;?>">
	                                            </div>
	                                        </div>
											
	                                    </div>
									</div>
									
									

									<div class="clearfix"></div>

									<div class="header">
		                                <h4 class="title">Contact Details</h4>
		                            </div>

		                            <div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Telephone(1)</label>
	                                                <input type="number" class="form-control" name="tel1" placeholder="Telephone(1)" value="<?php echo $tel1;?>" >
	                                            </div>
	                                        </div>
										</div>
									</div>

									 <div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Telephone(2)</label>
	                                                <input type="number" class="form-control" name="tel2" placeholder="Telephone(2)" value="<?php echo $tel2;?>">
	                                            </div>
	                                        </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Mobile</label>
	                                                <input type="number" class="form-control" name="mobile" placeholder="Mobile" value="<?php echo $mobile;?>" >
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>Email</label>
	                                                <input type="text" class="form-control" name="email" placeholder="Email" value="<?php echo $email;?>">
	                                            </div>
	                                        </div>
											
											<div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>Prefered Contact Method</label>
	                                                <select class="form-control" id="pre" name="pre">
														<option value="<?php echo $ow['contact_method_id'];?>"><?php echo $contact;?></option>
														<?php 
														$contt = Database::getInstance()->select_from_wherenot_ord('contact_method', 'contact_method_id',$ow['contact_method_id'], 'contact_method_id','DESC');
														foreach($contt as $row){
														?>
														<option value="<?php echo $row['contact_method_id']?>"><?php echo $row['contact_method']?></option>
														<?php } ?>
														
													</select>
	                                            </div>
	                                        </div>
											
	                                    </div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Next Of kin Telephone</label>
	                                                <input type="number" class="form-control" name="ntel" placeholder="Next Of kin Telephone" value="<?php echo $kin1;?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="row">
	                                       <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Next Of kin Address</label>
	                                                <input type="text" class="form-control" name="nadd" placeholder="Next Of kin Address" value="<?php echo $kin2;?>">
	                                            </div>
	                                        </div>
										</div>
									</div>
									
									
							
							<?php } ?>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Edit Patient Details</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        
						</div>
                    </div>
                 </div>

				<div id="get_result"></div>

			</div>
        </div>
	 <!-- //MAIN -->
		<!--  footer -->
	<?php include '../inc/footer-index.php';?>
	<!--//footer -->
        
    </div>

</div>

 <div class="loader" id="load" style="display:none ">
</div>
<script>	
 var a=jQuery .noConflict();
	 a(document).ready(function(){

        a('#patient').on('submit', function (e) {

        e.preventDefault();
		document.getElementById("load").style.display = "block";
		var formData =                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            new FormData(a(this)[0]);
		var ins = "editPatient";
		var val = "<?php echo $value; ?>";
		 formData.append('ins',ins);
		 formData.append('val',val);
          a.ajax({
            type: 'post',
			data: formData,  
			cache: false,
			contentType: false,
			processData: false,
            url: '../func/edit.php',						
            success: function(data)
            {
				document.getElementById("load").style.display = "none";
				a("#get_result").html(data).fadeIn("slow");
            }
          });

        });
        a('#select_card'). on('change', function(e) {
        	var card = parseInt(document.getElementById("select_card").value);
        	if (card == 11) {
				document.getElementById('company_card_cont').style.display = "block";
				document.getElementById('family_card_cont').style.display = "none";
        	}else if(card == 20){
				document.getElementById('family_card_cont').style.display = "block";
				document.getElementById('company_card_cont').style.display = "none";
        	}else{        		
				document.getElementById('company_card_cont').style.display = "none";
				document.getElementById('familyy_card_cont').style.display = "none";
        	}
       

        });
        var card = parseInt(document.getElementById("select_card").value);
        	if (card == 11) {
				document.getElementById('company_card_cont').style.display = "block";
				document.getElementById('family_card_cont').style.display = "none";
        	}else if(card == 20){
				document.getElementById('family_card_cont').style.display = "block";
				document.getElementById('company_card_cont').style.display = "none";
        	}else{        		
				document.getElementById('company_card_cont').style.display = "none";
				document.getElementById('familyy_card_cont').style.display = "none";
        	}
       
      });	
</script>

