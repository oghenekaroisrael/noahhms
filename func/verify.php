<?php
	include('../inc/db.php');
	require_once('../inc/formvalidator.php');

	$functionto = $_POST['ins'];

	switch ($functionto) {
		case "changePass":
		   changePass();
			break;
		case "newUser":
		   newUser();
			break;
		case 'newPreCheckList':
			newPreCheckList();
			break;
		case "login":
		   login();
			break;
		case "newForm":
		   newForm();
			break;
		case 'newLog':
			newLog();
			break;
		case 'newBRequest':
			newBRequest();
			break;
		case "therapyPlan":
		   therapyPlan();
			break;
		case "payStaff":
			payStaff();
			break;
		case 'EditpayStaff':
			EditpayStaff();
			break;
		case 'newBill_prep2d':
			newBill_prep2d();
			break;
		case "newTax":
		   newTax();
			break;
		case "newFamily":
		   newFamily();
			break;
		case 'newMCharge':
			newMCharge();
			break;
		case "newCompany":
		   newCompany();
			break;
		case "newInvoice":
		   newInvoice();
			break;

		case "newBill_prep":
			newBill_prep();

		case "update_therapyPlan":
		   update_therapyPlan();
			break;
		case "newXrayRequest":
			newXrayRequest();
			break;
		case "newXrayRequest_progress":
			newXrayRequest_progress();
			break;

		case "newScanRequest":
			newScanRequest();
			break;

		case "newScanRequest_progress":
			newScanRequest_progress();
			break;

		case "newXrayRequest_front":
			newXrayRequest_front();
			break;

		case "newScanRequest_front":
			newScanRequest_front();
			break;

		case "request_physiotherapy":
			request_physiotherapy();
			break;
		case "newPatient":
		   newPatient();
			break;

		case "newAEPatient":
		   newAEPatient();
			break;
			
		case "newDoc":
		   newDoc();
			break;

		case "newSchedule":
		   newSchedule();
			break;
		
		case "newAppointment":
		   newAppointment();
			break;	
		
		case "extraFile":
		   extraFile();
			break;

		case "xrayFiles":
		   xrayFiles();
			break;	

		case "scanFiles":
		   scanFiles();
			break;	
		
		case "newCase":
		   newCase();
			break;

		case "edit_Presc":
		   edit_Presc();
			break;

		case "newSupplier":
		   newSupplier();
			break;

		case 'addABOGroup':
			addABOGroup();
			break;

		case 'addRhDType':
			addRhDType();
			break;

		case 'addSerum':
			addSerum();
			break;
		
		case "labRes":
		   labRes();
			break;

		case "newTestType":
		   newTestType();
			break;

		case 'newTreatment_i':
			newTreatment_i();
			break;

		case 'newTreatment':
			newTreatment();
			break;

		case 'newBloodGroup':
			newBloodGroup();
			break;

		case 'newSample':
			newSample();
			break;

		case 'newTGroup':
			newTGroup();
			break;

		case 'newExpType':
			newExpType();
			break;
		case 'newIncomeType':
			newIncomeType();
			break;
		case 'newRevenueType':
			newRevenueType();
			break;
		case 'newCapFee':
			newCapFee();
			break;
		case "newTariff":
			newTariff();
			break;

		case 'newTariffClone':
			newTariffClone();
			break;

		case "newCategory":
		   newCategory();
			break;

		case "newCategory1":
		   newCategory1();
			break;
			
		case "newTest":
		   newTest();
			break;

		case "newDonor":
		   newDonor();
			break;	

		case 'newDonation':
				newDonation();
				break;	

		case "newXray":
		   newXray();
			break;

		case "newScan":
		   newScan();
			break;
			
		case "newTestRequest":
		   newTestRequest();
			break;

		case "newTestRequest_progress":
		   newTestRequest_progress();
			break;
		
		case "newTestRequestFront":
		   newTestRequestFront();
			break;
			
		case "newCat":
		   newCat();
			break;

		case "newUnit":
		   newUnit();
			break;

		case "newCUnit":
		   newCUnit();
			break;

		case "newStock":
		   newStock();
			break;

		case 'newCStock':
			newCStock();
			break;
			
		case "newAdminStock":
		   newAdminStock();
			break;

		case "get_price":
		   get_price();
			break;

		case 'addBlabel':
			addBlabel();
			break;

		case 'addBStatus':
			addBStatus();
			break;

		case "sendToAcc":
		   sendToAcc();
			break;
		case "changeOrderStatus":
			changeOrderStatus();
			break;
		case "sendTestAcc":
		   sendTestAcc();
			break;
		case "newIPD":
		   newIPD();
			break;	
			
		case "newIPDF":
		   newIPDF();
			break;	
			
		case "newObs":
		   newObs();
			break;

		case 'newLabour':
			newLabour();
			break;

		case 'newAnteNote':
			newAnteNote();
			break;	

		case 'processBRequest':
			processBRequest();
			break;
			
		case 'newAnteRecord':
			newAnteRecord();
			break;

		case "newDis":
		   newDis();
			break;	
			
		case "newFluid":
		   newFluid();
			break;	
			
		case "newSurgery":
		   newSurgery();
			break;	
			
		case "requestAdmission":
		   requestAdmission();
			break;	
			
			
		case "newCard":
		   newCard();
			break;

		case "customResult":
		   customResult();
			break;

		case "addDiagnosis":
		   addDiagnosis();
			break;	
			
		case "newBed":
		   newBed();
			break;

		case 'newBedType':
				newBedType();
				break;	
		
		case "newDuty":
		   newDuty();
			break;

		case "newAnte":
		   newAnte();
			break;
		
		case 'newAntenatal':
			newAntenatal();
			break;

		case "newExpi":
		   newExpi();
			break;

		case 'sendtoAccount2':
			sendtoAccount2();
			break;

		case "newIncome":
		   newIncome();
			break;

		case 'newCaseD':
			newCaseD();
			break;

		case 'newCaseD1':
			newCaseD1();
			break;

		case 'newCaseD_progress':
			newCaseD_progress();
			break;

		case 'newCaseInj2':
			newCaseInj2();
			break;

		case 'newCaseDrug':
			newCaseDrug();
			break;

		case 'newCaseDrug1':
			newCaseDrug1();
			break;

		case 'newCaseTest':
			newCaseTest();
			break;

		case 'newCaseInj':
			newCaseInj();
			break;

		case "newCost":
			newCost();
			break;
			
		case "newCBal":
		   newCBal();
			break;
		
		case "newMonth":
		   newMonth();
			break;
		
		case "newTestResTemp":
		   newTestResTemp();
			break;
		
		case "getFields":
		   getFields();
			break;
			
		case "insertRes":
		   insertRes();
			break;
		
		case "changeAdmiStatus":
		   changeAdmiStatus();
			break;

		case "changePrescriptionStatus":
		  changePrescriptionStatus();
			break;

		case "requestExam":
		   requestExam();
			break;

		case "newUsage":
		   newUsage();
			break;
			
		case "changeExamStatus":
		   changeExamStatus();
			break;
			
		case "changeAppStatus":
		   changeAppStatus();
			break;
			
		case "add_more_fields":
		   add_more_fields();
			break;

		case "newStock_w":
		   newStock_w();
			break;
		
		default:
			echo '<div class="alert alert-danger">
					Function does not Exist
				  </div>';
	}
	function newStock_w(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim($_POST['name']));

		$code = ucfirst(htmlspecialchars($_POST['stock_code']));
		$code = ucfirst(stripslashes($_POST['stock_code']));
		$code = ucfirst(trim($_POST['stock_code']));

		$cat = ucfirst(htmlspecialchars($_POST['cat']));
		$cat = ucfirst(stripslashes($_POST['cat']));
		$cat = ucfirst(trim($_POST['cat']));

		$unit = ucfirst(htmlspecialchars($_POST['unit']));
		$unit = ucfirst(stripslashes($_POST['unit']));
		$unit = ucfirst(trim($_POST['unit']));

		$unitb = ucfirst(htmlspecialchars($_POST['unitb']));
		$unitb = ucfirst(stripslashes($_POST['unitb']));
		$unitb = ucfirst(trim($_POST['unitb']));

		$cartons = ucfirst(htmlspecialchars($_POST['cartons']));
		$cartons = ucfirst(stripslashes($_POST['cartons']));
		$cartons = ucfirst(trim($_POST['cartons']));

		$manu = ucfirst(htmlspecialchars($_POST['manufactured']));
		$manu = ucfirst(stripslashes($_POST['manufactured']));
		$manu = ucfirst(trim($_POST['manufactured']));

		$exp = ucfirst(htmlspecialchars($_POST['expiring']));
		$exp = ucfirst(stripslashes($_POST['expiring']));
		$exp = ucfirst(trim($_POST['expiring']));

		$mname = ucfirst(htmlspecialchars($_POST['mname']));
		$mname = ucfirst(stripslashes($_POST['mname']));
		$mname = ucfirst(trim($_POST['mname']));

		$gname = ucfirst(htmlspecialchars($_POST['gname']));
		$gname = ucfirst(stripslashes($_POST['gname']));
		$gname = ucfirst(trim($_POST['gname']));

		$form = ucfirst(htmlspecialchars($_POST['form']));
		$form = ucfirst(stripslashes($_POST['form']));
		$form = ucfirst(trim($_POST['form']));

		$batch = ucfirst(htmlspecialchars($_POST['batch']));
		$batch = ucfirst(stripslashes($_POST['batch']));
		$batch = ucfirst(trim($_POST['batch']));

		$usage = ucfirst(htmlspecialchars($_POST['usage']));
		$usage = ucfirst(stripslashes($_POST['usage']));
		$usage = ucfirst(trim($_POST['usage']));

		$cost = ucfirst(htmlspecialchars($_POST['cost']));
		$cost = ucfirst(stripslashes($_POST['cost']));
		$cost = ucfirst(trim($_POST['cost']));

		$supplier = ucfirst(htmlspecialchars($_POST['supplier']));
		$supplier = ucfirst(stripslashes($_POST['supplier']));
		$supplier = ucfirst(trim($_POST['supplier']));

		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please enter name of item");
		$validator->addValidation("unit","req","Please enter unit of item");
		$validator->addValidation("cost","req","Please enter cost price of item");	
		$validator->addValidation("cartons","req","Please enter Cartons of item");		
		$validator->addValidation("stock_code","req","Please enter Stock Number of item");		
		$validator->addValidation("usage","req","Please enter Usage of item");

									
		if($validator->ValidateForm()){
			if (EMPTY($name)) {
				$error ='Name cannot be empty';
			}

			if (EMPTY($code)) {
				$error ='Stock Number cannot be empty';
			}

			if (EMPTY($unit)) {
				$error ='Unit cannot be empty';
			}

			if (EMPTY($cartons)) {
				$error ='Cartons cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_stock_w($name,$code, $cat, $unit, $unitb,$cartons,$manu, $exp,$mname,$gname,$form,$batch,$usage,$cost,$supplier);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Stock entered successfully					
						</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function sendtoAccount2(){			
		$value = $_POST['val'];
		$p_id = $_POST['patient'];
		$opd = $_POST['opd'];
		$app = $_POST['app'];

		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("patient","req","Please pick a patient to bill");
		
		if($validator->ValidateForm()){
			
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_sendtoAccount($value,$p_id,$opd,$app);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Bill Was Sent Successfully
						</div>';
						session_start();
						unset($_SESSION['sale']);
					}else{
						echo $insert;
					}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					' . $inp_err . '
				</div>';
			}
		}
	}
	function newCaseD(){
		$diagnosis = $_POST['diagnosis'];
		$pharm = $_POST['drugs'];
		$dosage = $_POST['frequency'];
		$tabz = $_POST['tabz'];
		$instruction = $_POST['instruction'];
		$quantity = $_POST['quantity'];
		$duration = $_POST['duration'];		
		$price = $_POST['price'];
		$sdosage = $_POST['sfrequency'];
		$stabs = $_POST['stabs'];
		$squantity = $_POST['squantity'];
		$sduration = $_POST['sduration'];

		$error = '';

		$id = $_POST['id'];
		$doc_id = $_POST['doc_id'];
		$p_id = $_POST['p_id'];
		$c = $_POST['count'];

		$validator = new FormValidator();									
		if($validator->ValidateForm()){

					$insert = Database::getInstance()->insert_case_d($diagnosis,$pharm,$_POST['tabz'],$dosage,$duration,$quantity,$instruction,$price, $doc_id, $id, $p_id,$stabs,$squantity,$sdosage,$sduration,$c);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
					<strong>Prescription Added Successfully!</strong>
				</div>';
				session_start();
				unset($_SESSION['presc']);
				} else {
					echo $insert;
				}
			
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newCaseD1(){
		$diagnosis = $_POST['diagnosis'];
		$pharm = $_POST['drugs'];
		$dosage = $_POST['frequency'];
		$tabz = $_POST['tabz'];
		$instruction = $_POST['instruction'];
		$quantity = $_POST['quantity'];
		$duration = $_POST['duration'];		
		$price = $_POST['price'];
		$sdosage = $_POST['sfrequency'];
		$stabs = $_POST['stabs'];
		$squantity = $_POST['squantity'];
		$sduration = $_POST['sduration'];

		$error = '';

		$id = $_POST['id'];
		$doc_id = $_POST['doc_id'];
		$p_id = $_POST['p_id'];
		$c = $_POST['count'];

		$validator = new FormValidator();									
		if($validator->ValidateForm()){

					$insert = Database::getInstance()->insert_case_d($diagnosis,$pharm,$_POST['tabz'],$dosage,$duration,$quantity,$instruction,$price, $doc_id, $id, $p_id,$stabs,$squantity,$sdosage,$sduration,$c);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
					<strong>Prescription Added Successfully!</strong>
				</div>';
				session_start();
				unset($_SESSION['presc']);
				} else {
					echo $insert;
				}
			
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newCaseD_progress(){
		$diagnosis = $_POST['diagnosis'];
		$pharm = $_POST['drugs'];
		$dosage = $_POST['frequency'];
		$tabz = $_POST['tabz'];
		$instruction = $_POST['instruction'];
		$quantity = $_POST['quantity'];
		$duration = $_POST['duration'];
		$price = $_POST['price'];
		$sdosage = $_POST['sfrequency'];
		$stabs = $_POST['stabs'];
		$squantity = $_POST['squantity'];
		$sduration = $_POST['sduration'];

		$error = '';

		$id = $_POST['id'];
		$doc_id = $_POST['doc_id'];
		$p_id = $_POST['p_id'];
		$c = $_POST['count'];

		$validator = new FormValidator();									
		if($validator->ValidateForm()){

					$insert = Database::getInstance()->insert_case_d2($diagnosis,$pharm,$_POST['tabz'],$dosage,$duration,$quantity,$instruction,$price, $doc_id, $id, $p_id,$stabs,$squantity,$sdosage,$sduration,$c);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
					<strong>Prescription Added Successfully!</strong>
				</div>';
				session_start();
				unset($_SESSION['presc']);
				} else {
					echo $insert;
				}
			
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newCaseInj2(){
		$diagnosis = $_POST['diagnosis'];
		$pharm = $_POST['drugs'];
		$dosage = $_POST['frequency'];
		$tabz = $_POST['tabz'];
		$instruction = $_POST['instruction'];
		$quantity = $_POST['quantity'];
		$duration = $_POST['duration'];
		$sdosage = $_POST['sfrequency'];
		$stabs = $_POST['stabs'];
		$squantity = $_POST['squantity'];
		$sduration = $_POST['sduration'];

		$error = '';

		$id = $_POST['id'];
		$doc_id = $_POST['doc_id'];
		$p_id = $_POST['p_id'];
		$c = $_POST['count'];

		$validator = new FormValidator();									
		if($validator->ValidateForm()){
				$insert = Database::getInstance()->insert_case_inj2($diagnosis,$pharm,$_POST['tabz'],$dosage,$duration,$quantity,$instruction, $doc_id, $id, $p_id,$stabs,$squantity,$sdosage,$sduration,$c);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
					<strong>Injection Added Successfully!</strong>
				</div>';
				session_start();
				unset($_SESSION['presc']);
				} else {
					echo $insert;
				}
			
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}
	function newAntenatal(){
		$surname = ucfirst(htmlspecialchars($_POST['surname']));
		$surname = ucfirst(stripslashes($_POST['surname']));
		$surname = ucfirst(trim($_POST['surname']));
		
		$first_name = ucfirst(htmlspecialchars($_POST['first_name']));
		$first_name = ucfirst(stripslashes($_POST['first_name']));
		$first_name = ucfirst(trim($_POST['first_name']));
		
		$hosp_num = lcfirst(htmlspecialchars($_POST['hosp_num']));
		$hosp_num = lcfirst(stripslashes($_POST['hosp_num']));
		$hosp_num = lcfirst(trim($_POST['hosp_num']));
		
		$instruction = lcfirst(htmlspecialchars($_POST['instructions']));
		$instruction = lcfirst(stripslashes($_POST['instructions']));
		$instruction = lcfirst(trim($_POST['instructions']));
		
		$address = htmlspecialchars($_POST['address']);
		$address = stripslashes($_POST['address']);
		$address = trim($_POST['address']);
		
		$preg_duration = htmlspecialchars($_POST['preg_duration']);
		$preg_duration = stripslashes($_POST['preg_duration']);
		$preg_duration = trim($_POST['preg_duration']);
		
		$age = htmlspecialchars($_POST['age']);
		$age = stripslashes($_POST['age']);
		$age = trim($_POST['age']);
		
		$marriage_age = htmlspecialchars($_POST['marriage_age']);
		$marriage_age = stripslashes($_POST['marriage_age']);
		$marriage_age = trim($_POST['marriage_age']);
		
		$lmp = htmlspecialchars($_POST['lmp']);
		$lmp = stripslashes($_POST['lmp']);
		$lmp = trim($_POST['lmp']);

		$tribe = htmlspecialchars($_POST['tribe']);
		$tribe = stripslashes($_POST['tribe']);
		$tribe = trim($_POST['tribe']);

		$occupation = htmlspecialchars($_POST['occupation']);
		$occupation = stripslashes($_POST['occupation']);
		$occupation = trim($_POST['occupation']);

		$edd = htmlspecialchars($_POST['edd']);
		$edd = stripslashes($_POST['edd']);
		$edd = trim($_POST['edd']);
		
		$added_by = $_POST['staff'];
		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("surname","req","Please fill in Surname");
		$validator->addValidation("first_name","req","Please fill in First Name");
									
		if($validator->ValidateForm()){
						
			if (EMPTY($surname)) {
				$error ='Surname cannot be empty';
			}
			
			if (EMPTY($first_name)) {
				$error ='First Name cannot be empty';
			}						
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_antenatal($surname,$first_name,$hosp_num,$instruction,$address,$preg_duration,$age,$marriage_age,$lmp,$tribe,$occupation,$edd,$added_by);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
						Antenatal Booked successfully					
					</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newCaseDrug(){
		
		$pharm = $_POST['select_drug'];
		$type = $_POST['select_type'];

		$error = '';

		$id = $_POST['id'];//app id
		$doc_id = $_POST['doc_id'];
		$p_id = $_POST['p_id'];
		$did = $_POST['pre'];

		$validator = new FormValidator();
						
		$validator->addValidation("p_id","req","Please select A Patient");
									
		if($validator->ValidateForm()){
				$insert = Database::getInstance()->insert_case_drug($pharm, $type,$doc_id, $id, $p_id,$did);
				if($insert == 'Done'){
					echo $insert;
				} else {
					echo $insert;
				}
			
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newCaseDrug1(){
		
		$pharm = $_POST['select_drug'];
		$type = $_POST['select_type'];

		$error = '';

		$id = $_POST['id'];//app id
		$doc_id = $_POST['doc_id'];
		$p_id = $_POST['p_id'];
		$did = $_POST['pre'];

		$validator = new FormValidator();
						
		$validator->addValidation("p_id","req","Please select A Patient");
									
		if($validator->ValidateForm()){
				$insert = Database::getInstance()->insert_case_drug1($pharm, $type,$doc_id, $id, $p_id,$did);
				if($insert == 'Done'){
					echo $insert;
				} else {
					echo $insert;
				}
			
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newCaseTest(){
		
		$pharm = $_POST['test'];

		$error = '';

		$id = $_POST['id'];//app id
		$doc_id = $_POST['doc_id'];
		$p_id = $_POST['p_id'];
		$did = $_POST['pre'];

		$validator = new FormValidator();
						
		$validator->addValidation("p_id","req","Please select A Patient");
									
		if($validator->ValidateForm()){
				$insert = Database::getInstance()->insert_case_test($pharm,$doc_id, $id, $p_id,$did);
				if($insert == 'Done'){
					echo $insert;
				} else {
					echo $insert;
				}
			
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newCaseInj(){
		
		$pharm = $_POST['select_drug'];
		//$type = $_POST['select_type'];

		$error = '';

		$id = $_POST['id'];//app id
		$doc_id = $_POST['doc_id'];
		$p_id = $_POST['p_id'];
		$did = $_POST['pre'];

		$validator = new FormValidator();
						
		$validator->addValidation("p_id","req","Please select A Patient");
									
		if($validator->ValidateForm()){
				$insert = Database::getInstance()->insert_case_inj($pharm,$doc_id, $id, $p_id,$did);
				if($insert == 'Done'){
					echo $insert;
				} else {
					echo $insert;
				}
			
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}
	function newForm(){
		$form_name = ucfirst(htmlspecialchars($_POST['form_name']));
		$form_name = ucfirst(stripslashes($_POST['form_name']));
		$form_name = ucfirst(trim($_POST['form_name']));
		
		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("form_name","req","Please enter Form");
									
		if($validator->ValidateForm()){
			if (EMPTY($form_name)) {
				$error ='Form cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_form($form_name);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Form entered successfully					
						</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newLog(){
		$vname = ucfirst(htmlspecialchars($_POST['vname']));
		$vname = ucfirst(stripslashes($_POST['vname']));
		$vname = ucfirst(trim($_POST['vname']));

		$vtel = ucfirst(htmlspecialchars($_POST['vtel']));
		$vtel = ucfirst(stripslashes($_POST['vtel']));
		$vtel = ucfirst(trim($_POST['vtel']));

		$vsex = ucfirst(htmlspecialchars($_POST['vsex']));
		$vsex = ucfirst(stripslashes($_POST['vsex']));
		$vsex = ucfirst(trim($_POST['vsex']));

		$vaddress = ucfirst(htmlspecialchars($_POST['vaddress']));
		$vaddress = ucfirst(stripslashes($_POST['vaddress']));
		$vaddress = ucfirst(trim($_POST['vaddress']));

		$vreason = ucfirst(htmlspecialchars($_POST['vreason']));
		$vreason = ucfirst(stripslashes($_POST['vreason']));
		$vreason = ucfirst(trim($_POST['vreason']));

		$s_id = ucfirst(htmlspecialchars($_POST['s_id']));
		$s_id = ucfirst(stripslashes($_POST['s_id']));
		$s_id = ucfirst(trim($_POST['s_id']));

		$user = $_POST['user'];
		
		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("vname","req","Please enter Visitor's Name");
		$validator->addValidation("vsex","req","Please select Visitor's Sex");
		$validator->addValidation("vtel","req","Please enter Visitor's telephone");
		$validator->addValidation("vreason","req","Please enter Reason For Visit");
									
		if($validator->ValidateForm()){
			if (EMPTY($vname)) {
				$error ='Name cannot be empty';
			}

			if (EMPTY($vreason)) {
				$error ='Reason For Visit cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_log($vname,$vsex,$vtel,$vaddress,$vreason,$s_id,$user);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Log entered successfully					
						</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newFamily(){
	
		
		$name = $_POST['name'];
		$validator = new FormValidator();
						
		$validator->addValidation("name","req","No Family Name Entered");

							
		if($validator->ValidateForm()){
			

				$insert = Database::getInstance()->insert_family($name);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Family Was Successfully Added!
						</div>';
				} else {
					echo $insert;
				}
					//$notify = Database::getInstance()->notify_nurse2($val,$doc,$p_id); 
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newMCharge(){
	
		
		$name = $_POST['name'];
		$amt = $_POST['amt'];
		$user = $_POST['staff'];
		$validator = new FormValidator();
						
		$validator->addValidation("name","req","No Charge Entered");

							
		if($validator->ValidateForm()){
			

				$insert = Database::getInstance()->insert_mcharge($name,$amt,$user);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Charge Was Successfully Added!
						</div>';
				} else {
					echo $insert;
				}
					//$notify = Database::getInstance()->notify_nurse2($val,$doc,$p_id); 
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newUsage(){
		$usage_name = ucfirst(htmlspecialchars($_POST['usage_name']));
		$usage_name = ucfirst(stripslashes($_POST['usage_name']));
		$usage_name = ucfirst(trim($_POST['usage_name']));
		
		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("usage_name","req","Please enter usage");
									
		if($validator->ValidateForm()){
			if (EMPTY($usage_name)) {
				$error ='usage cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_usage($usage_name);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Usage entered successfully					
						</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function processBRequest(){
		$label = ucfirst(htmlspecialchars($_POST['label']));
		$label = ucfirst(stripslashes($_POST['label']));
		$label = ucfirst(trim($_POST['label']));
		
		$id = $_POST['id'];
		$val = $_POST['edit'];
		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("label","req","Please enter Label Given");
									
		if($validator->ValidateForm()){
			if (EMPTY($label)) {
				$error ='Label cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->process_BRequest($label,$id,$val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Request Processed Successfully					
						</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newSupplier(){
		$name = ucfirst(htmlspecialchars($_POST['supplier_name']));
		$name = ucfirst(stripslashes($_POST['supplier_name']));
		$name = ucfirst(trim($_POST['supplier_name']));

		$code = ucfirst(htmlspecialchars($_POST['supplier_number']));
		$code = ucfirst(stripslashes($_POST['supplier_number']));
		$code = ucfirst(trim($_POST['supplier_number']));

		$addr = ucfirst(htmlspecialchars($_POST['supplier_addr']));
		$addr = ucfirst(stripslashes($_POST['supplier_addr']));
		$addr = ucfirst(trim($_POST['supplier_addr']));

		$city = ucfirst(htmlspecialchars($_POST['city']));
		$city = ucfirst(stripslashes($_POST['city']));
		$city = ucfirst(trim($_POST['city']));

		$country = ucfirst(htmlspecialchars($_POST['country']));
		$country = ucfirst(stripslashes($_POST['country']));
		$country = ucfirst(trim($_POST['country']));

		$phone = ucfirst(htmlspecialchars($_POST['phone']));
		$phone = ucfirst(stripslashes($_POST['phone']));
		$phone = ucfirst(trim($_POST['phone']));

		$email = ucfirst(htmlspecialchars($_POST['email']));
		$email = ucfirst(stripslashes($_POST['email']));
		$email = ucfirst(trim($_POST['email']));

		$person = ucfirst(htmlspecialchars($_POST['person']));
		$person = ucfirst(stripslashes($_POST['person']));
		$person = ucfirst(trim($_POST['person']));

		$mobile = ucfirst(htmlspecialchars($_POST['cphone']));
		$mobile = ucfirst(stripslashes($_POST['cphone']));
		$mobile = ucfirst(trim($_POST['cphone']));

		$notes = ucfirst(htmlspecialchars($_POST['notes']));
		$notes = ucfirst(stripslashes($_POST['notes']));
		$notes = ucfirst(trim($_POST['notes']));

		$error = '';

		$val = $_POST['id'];

		$validator = new FormValidator();
						
		$validator->addValidation("supplier_name","req","Please enter name of Supplier");
							
		if($validator->ValidateForm()){
			if (EMPTY($name)) {
				$error ='Supplier Name cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_supplier($name,$code, $addr, $city,$country, $phone, $email,$person,$mobile, $notes, $val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Supplier Added successfully					
						</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newInvoice(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim($_POST['name']));

		$supplier = ucfirst(htmlspecialchars($_POST['supplier']));
		$supplier = ucfirst(stripslashes($_POST['supplier']));
		$supplier = ucfirst(trim($_POST['supplier']));

		$lot = ucfirst(htmlspecialchars($_POST['lot']));
		$lot = ucfirst(stripslashes($_POST['lot']));
		$lot = ucfirst(trim($_POST['lot']));

		$batch = ucfirst(htmlspecialchars($_POST['batch']));
		$batch = ucfirst(stripslashes($_POST['batch']));
		$batch = ucfirst(trim($_POST['batch']));

		$unit = ucfirst(htmlspecialchars($_POST['unit']));
		$unit = ucfirst(stripslashes($_POST['unit']));
		$unit = ucfirst(trim($_POST['unit']));

		$exp = ucfirst(htmlspecialchars($_POST['expiring']));
		$exp = ucfirst(stripslashes($_POST['expiring']));
		$exp = ucfirst(trim($_POST['expiring']));

		$quantity = ucfirst(htmlspecialchars($_POST['quantity']));
		$quantity = ucfirst(stripslashes($_POST['quantity']));
		$quantity = ucfirst(trim($_POST['quantity']));

		$price = ucfirst(htmlspecialchars($_POST['price']));
		$price = ucfirst(stripslashes($_POST['price']));
		$price = ucfirst(trim($_POST['price']));

		$total = ucfirst(htmlspecialchars($_POST['total']));
		$total = ucfirst(stripslashes($_POST['total']));
		$total = ucfirst(trim($_POST['total']));

		$destination = ucfirst(htmlspecialchars($_POST['destination']));
		$destination = ucfirst(stripslashes($_POST['destination']));
		$destination = ucfirst(trim($_POST['destination']));

		$staff = $_POST['staff'];
		$invoice = $_POST['invoice'];
		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please enter name of item");
		$validator->addValidation("unit","req","Please enter unit of item");
		$validator->addValidation("price","req","Please enter price of item");
		$validator->addValidation("supplier","req","Please enter Supplier of item");
		$validator->addValidation("quantity","req","Please enter Quantity of item");		
		$validator->addValidation("total","req","Please enter Total of item");		
		$validator->addValidation("destination","req","Please enter Destination of item");		
		$validator->addValidation("expiring","req","Please enter Expiring Date of item");
		$validator->addValidation("batch","req","Please enter Batch of item");

									
		if($validator->ValidateForm()){
			if (EMPTY($name)) {
				$error ='Name cannot be empty';
			}

			if (EMPTY($supplier)) {
				$error ='Supplier cannot be empty';
			}

			if (EMPTY($unit)) {
				$error ='Unit cannot be empty';
			}

			if (EMPTY($destination)) {
				$error ='Destination cannot be empty';
			}

			if (EMPTY($quantity)) {
				$error ='Quantity cannot be empty';
			}

			if (EMPTY($total)) {
				$error ='Total cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_invoice($staff,$name,$supplier, $lot, $unit,$quantity, $price,$exp,$batch,$destination,$total,$invoice);
				if($insert == 'Done'){
					echo $insert;
					session_start();
					$_SESSION['invoices'] = $invoice;
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newBill_prep(){
		$fee = $_POST['fee'];
		$desc = $_POST['description'];

		$error = '';

		$aid = $_POST['id'];
		$staff = $_POST['s'];
		$validator = new FormValidator();
						
		$validator->addValidation("fee","req","Please Enter Fee");
		$validator->addValidation("description","req","Please Enter Description");
		
									
		if($validator->ValidateForm()){
			
			if (EMPTY($fee)) {
				$error ='Fee cannot be empty';
			}
			if (EMPTY($desc)) {
				$error ='Description cannot be empty';
			}
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>'; 
			}else{
					$insert = Database::getInstance()->insert_bill($aid,$fee,$desc,$staff);
				if($insert == 'Done'){
						echo '<div class="alert alert-success">
							Bill Added Successfully	 				
						</div>';
						unset($_POST);
				} else {
					echo $insert;
					unset($_POST);
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}	
	function newUser(){
		$first_name = trim(ucfirst($_POST['first_name']));
		$first_name = htmlspecialchars(ucfirst($_POST['first_name']));
		$first_name = stripslashes(ucfirst($_POST['first_name']));
			
		$last_name = trim(ucfirst($_POST['last_name']));
		$last_name = htmlspecialchars(ucfirst($_POST['last_name']));
		$last_name = stripslashes(ucfirst($_POST['last_name']));

		$other_names = trim(ucfirst($_POST['other_names']));
		$other_names = htmlspecialchars(ucfirst($_POST['other_names']));
		$other_names = stripslashes(ucfirst($_POST['other_names']));
			
		$username = trim(lcfirst($_POST['username']));
		$username = htmlspecialchars(lcfirst($_POST['username']));
		$username = stripslashes(lcfirst($_POST['username']));

		$address = trim(lcfirst($_POST['address']));
		$address = htmlspecialchars(lcfirst($_POST['address']));
		$address = stripslashes(lcfirst($_POST['address']));

		$phone = trim(lcfirst($_POST['phone']));
		$phone = htmlspecialchars(lcfirst($_POST['phone']));
		$phone = stripslashes(lcfirst($_POST['phone']));

		$dob = trim(lcfirst($_POST['dob']));
		$dob = htmlspecialchars(lcfirst($_POST['dob']));
		$dob = stripslashes(lcfirst($_POST['dob']));

		$sex = trim(lcfirst($_POST['sex']));
		$sex = htmlspecialchars(lcfirst($_POST['sex']));
		$sex = stripslashes(lcfirst($_POST['sex']));

		$username = trim(lcfirst($_POST['username']));
		$username = htmlspecialchars(lcfirst($_POST['username']));
		$username = stripslashes(lcfirst($_POST['username']));

		$pob = trim(lcfirst($_POST['pob']));
		$pob = htmlspecialchars(lcfirst($_POST['pob']));
		$pob = stripslashes(lcfirst($_POST['pob']));

		$mstatus = trim(lcfirst($_POST['mstatus']));
		$mstatus = htmlspecialchars(lcfirst($_POST['mstatus']));
		$mstatus = stripslashes(lcfirst($_POST['mstatus']));

		$religion = trim(lcfirst($_POST['religion']));
		$religion = htmlspecialchars(lcfirst($_POST['religion']));
		$religion = stripslashes(lcfirst($_POST['religion']));

		$nok = trim(lcfirst($_POST['nok']));
		$nok = htmlspecialchars(lcfirst($_POST['nok']));
		$nok = stripslashes(lcfirst($_POST['nok']));

		$pnok = trim(lcfirst($_POST['pnok']));
		$pnok = htmlspecialchars(lcfirst($_POST['pnok']));
		$pnok = stripslashes(lcfirst($_POST['pnok']));

		$state = trim(lcfirst($_POST['state']));
		$state = htmlspecialchars(lcfirst($_POST['state']));
		$state = stripslashes(lcfirst($_POST['state']));

		$lga = trim(lcfirst($_POST['lga']));
		$lga = htmlspecialchars(lcfirst($_POST['lga']));
		$lga = stripslashes(lcfirst($_POST['lga']));

		$doe = trim(lcfirst($_POST['doe']));
		$doe = htmlspecialchars(lcfirst($_POST['doe']));
		$doe = stripslashes(lcfirst($_POST['doe']));

		$salary = trim(lcfirst($_POST['salary']));
		$salary = htmlspecialchars(lcfirst($_POST['salary']));
		$salary = stripslashes(lcfirst($_POST['salary']));
 
		$salary = trim(lcfirst($_POST['salary']));
		$salary = htmlspecialchars(lcfirst($_POST['salary']));
		$salary = stripslashes(lcfirst($_POST['salary']));

		$weight = trim(lcfirst($_POST['weight']));
		$weight = htmlspecialchars(lcfirst($_POST['weight']));
		$weight = stripslashes(lcfirst($_POST['weight']));
		
		$position = trim(lcfirst($_POST['position']));
		$position = htmlspecialchars(lcfirst($_POST['position']));
		$position = stripslashes(lcfirst($_POST['position']));
			
		$role = lcfirst(htmlspecialchars($_POST['role']));
		$role = lcfirst(stripslashes($_POST['role']));
		$role = lcfirst(trim($_POST['role']));

		$ward = lcfirst(htmlspecialchars($_POST['ward']));
		$ward = lcfirst(stripslashes($_POST['ward']));
		$ward = lcfirst(trim($_POST['ward']));
			
		$password = htmlspecialchars($_POST['password']);
		$password = stripslashes($_POST['password']);
		$password = trim($_POST['password']);
		
		$cpass = htmlspecialchars($_POST['cpass']);
		$cpass = stripslashes($_POST['cpass']);
		$cpass = trim($_POST['cpass']);

		$noc = htmlspecialchars($_POST['noc']);
		$noc = stripslashes($_POST['noc']);
		$noc = trim($_POST['noc']);

		$child1 = htmlspecialchars($_POST['child1']);
		$child1 = stripslashes($_POST['child1']);
		$child1 = trim($_POST['child1']);

		$child2 = htmlspecialchars($_POST['child2']);
		$child2 = stripslashes($_POST['child2']);
		$child2 = trim($_POST['child2']);

		$child3 = htmlspecialchars($_POST['child3']);
		$child3 = stripslashes($_POST['child3']);
		$child3 = trim($_POST['child3']);

		$child4 = htmlspecialchars($_POST['child4']);
		$child4 = stripslashes($_POST['child4']);
		$child4 = trim($_POST['child4']);

		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("first_name","req","Please fill in first name");
		$validator->addValidation("last_name","req","Please fill in last name");
									
		if($validator->ValidateForm()){
			if (!preg_match("/^[A-Z][a-zA-Z -]+$/",$first_name)) {
				$error = 'First Name must contain only letters.';
			}
										
			if (!preg_match("/^[A-Z][a-zA-Z -]+$/",$last_name)) {
				$error ='Last Name must contain only letters.';
			}
			
			if (EMPTY($first_name)) {
				$error ='First name cannot be empty';
			}

			if (EMPTY($last_name)) {
				$error ='Last name cannot be empty';
			}
			
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$hash = password_hash($password, PASSWORD_DEFAULT);

				if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
					$timee = time();
					$file_name = $_FILES['file']['name'];
					$temp_dir = $_FILES["file"]["tmp_name"];
					$ext_str = "jpg,jpeg,png";
					$ext = substr($file_name, strrpos($file_name, '.') + 1);
					$timee = time();
					$fullname = $timee.'.'.$ext;
					$target_dir = "../module0/staff_img/".$fullname;
					$allowed_extensions=explode(',',$ext_str);
					if (move_uploaded_file($temp_dir, $target_dir)) {
								$insert = Database::getInstance()->insert_user($first_name, $last_name,$other_names,$address,$phone,$dob,$pob,$sex,$mstatus,$nok,$pnok,$state,$lga,$doe,$salary,$noc,$child1,$child2,$child3,$child4,$weight,$fullname, $username, $role, $hash, $position,$ward,$religion);
									if($insert == 'Done'){
										echo '<div class="alert alert-success">
											User Added Successfully				
										</div>';
									} else {
										echo $insert;
									}	
						} else {
							database::getInstance()->delete_things('staff','staff_img',$fullname);
							echo '<div class="alert alert-danger">
										<strong>Error!</strong> There was an error while Uploading Image
									</div>';
						}
				}else{
					$img = "1558244160.jpg";
					$insert = Database::getInstance()->insert_user($first_name, $last_name,$other_names,$address,$phone,$dob,$pob,$sex,$mstatus,$nok,$pnok,$state,$lga,$doe,$salary,$noc,$child1,$child2,$child3,$child4,$weight,$img, $username, $role, $hash, $position,$ward,$religion);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
						User Added Successfully	
					</div>';
				} else {
					echo $insert;
				}	
				}
				
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function login(){
		$uperror = '';
		
		$username = lcfirst(htmlspecialchars($_POST['username']));
		$username = lcfirst(stripslashes($_POST['username']));
		$username = lcfirst(trim($_POST['username']));
		
		$password = htmlspecialchars($_POST['password']);
		$password = stripslashes($_POST['password']);
		$password = trim($_POST['password']);
		
		$validator = new FormValidator();
						
		$validator->addValidation("username","req","Please fill in your username");
		$validator->addValidation("password","req","Please fill in Your password");
									
		if($validator->ValidateForm()){
		
			if (empty($password)) {
				$uperror = '<div class="alert alert-danger">
					<strong>Warning!</strong> Please fill in password.
				</div>';
			}
			if (empty($username)) {
				$uperror = '<div class="alert alert-danger">
					<strong>Warning!</strong> Please fill in username.
				</div>';
			}
			
			if (!empty($username) && !empty($password)) {
				Database::getInstance()->check_pass($username, $password);
			}
		
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		} 			
	}

	function newBill_prep2d(){
		$type = $_POST['type'];
		$pharm = $_POST['pharm'];
		$pharm_qty = $_POST['drug_quantity'];
		$description = $_POST['description'];
		$quantity = $_POST['quantity'];
		$amount = $_POST['amount'];
		$unit =  $_POST['unit'];

		$error = '';

		$id = $_POST['id'];
		$staff = $_POST['s'];
		$validator = new FormValidator();
						
		$validator->addValidation("type","req","Please choose Sales Type");
		
									
		if($validator->ValidateForm()){
			
			if (EMPTY($type)) {
				$error ='Sales Type cannot be empty';
			}
			if ($type == 3) {
				$amount1 = database::getInstance()->get_name_from_id('price','pharm_stock','id',$_POST['pharm']);
				$quantity = $pharm_qty;
				$amount = $amount1 * $quantity;
				$description = $pharm;
			}elseif ($type == 10) {
				$amount = $quantity * $amount;
				$quantity = $quantity;
				$description = $description;

			}
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>'; 
			}else{
					$insert = Database::getInstance()->insert_bill2($unit,$type,$description,$quantity, $amount,$staff,$id);
				if($insert == 'Done'){
						echo '<div class="alert alert-success">
							Item Added Successfully	 				
						</div>';
						unset($_POST);
						session_start();
						$_SESSION['sale'] = $id;
				} else {
						echo $insert;
						unset($_POST);
						session_start();
						$_SESSION['sale'] = $id;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}	
	
	function newAEPatient(){
					
		$title = ucfirst(htmlspecialchars($_POST['title']));
		$title = ucfirst(stripslashes($_POST['title']));
		$title = ucfirst(trim($_POST['title']));
		
		
		$first = ucfirst(htmlspecialchars($_POST['first']));
		$first = ucfirst(stripslashes($_POST['first']));
		$first = ucfirst(trim($_POST['first']));
		
		$surname = ucfirst(htmlspecialchars($_POST['surname']));
		$surname = ucfirst(stripslashes($_POST['surname']));
		$surname = ucfirst(trim($_POST['surname']));
		
		$m_name = ucfirst(htmlspecialchars($_POST['m_name']));
		$m_name = ucfirst(stripslashes($_POST['m_name']));
		$m_name = ucfirst(trim($_POST['m_name']));
		
		$sex = htmlspecialchars($_POST['sex']);
		$sex = stripslashes($_POST['sex']);
		$sex = trim($_POST['sex']);
		
		
		
		$dob = htmlspecialchars($_POST['dob']);
		$dob = stripslashes($_POST['dob']);
		$dob = trim($_POST['dob']);

   
		
		$ageType = htmlspecialchars($_POST['ageType']);
		$ageType = stripslashes($_POST['ageType']);
		$ageType = trim($_POST['ageType']);
		
	

		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("title","req","Please fill in title");
		$validator->addValidation("first","req","Please fill in First Name");
		$validator->addValidation("surname","req","Please fill in surname");
		

		if($validator->ValidateForm()){
			
			if (EMPTY($first)) {
				$error ='First Name cannot be empty';
			}
			
			if (EMPTY($surname)) {
				$error ='Surname cannot be empty';
			}
			
			
		
			if($dob ==""){
				$age = "Elderly";
			}else{
				$tz  = new DateTimeZone('Africa/Lagos');
				$age = DateTime::createFromFormat('Y-m-d', $dob, $tz)->diff(new DateTime('now', $tz))->y;
			}

    			$fullname = "";
    			$insert = Database::getInstance()->insert_aepatient($first,$surname, $m_name, $title, $sex, $age, $ageType, $dob);
    			if($insert == 'yesi'){
    				echo '<div class="alert alert-success">
    					Patient Added Successfully
    				</div>';
    			} else {
    				echo $insert;
    			}	
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
}

function newPatient(){
		
				if(!isset($_FILES['file'])){
							echo '<div class="alert alert-warning">
									Please Choose Photo
								  </div>';
				}else{
					
		$title = ucfirst(htmlspecialchars($_POST['title']));
		$title = ucfirst(stripslashes($_POST['title']));
		$title = ucfirst(trim($_POST['title']));
		
		$reg_num = ucwords(htmlspecialchars($_POST['reg_num']));
		$reg_num = ucwords(stripslashes($_POST['reg_num']));
		$reg_num = ucwords(trim($_POST['reg_num']));
		
		$first = ucfirst(htmlspecialchars($_POST['first']));
		$first = ucfirst(stripslashes($_POST['first']));
		$first = ucfirst(trim($_POST['first']));
		
		$surname = ucfirst(htmlspecialchars($_POST['surname']));
		$surname = ucfirst(stripslashes($_POST['surname']));
		$surname = ucfirst(trim($_POST['surname']));
		
		$m_name = ucfirst(htmlspecialchars($_POST['m_name']));
		$m_name = ucfirst(stripslashes($_POST['m_name']));
		$m_name = ucfirst(trim($_POST['m_name']));
		
		$sex = htmlspecialchars($_POST['sex']);
		$sex = stripslashes($_POST['sex']);
		$sex = trim($_POST['sex']);
		
		$blood = htmlspecialchars($_POST['blood']);
		$blood = stripslashes($_POST['blood']);
		$blood = trim($_POST['blood']);

		$card_type = htmlspecialchars($_POST['card_type']);
		$card_type = stripslashes($_POST['card_type']);
		$card_type = trim($_POST['card_type']);

		$address = ucfirst(htmlspecialchars($_POST['address']));
		$address = ucfirst(stripslashes($_POST['address']));
		$address = ucfirst(trim($_POST['address']));

		$city = ucfirst(htmlspecialchars($_POST['city']));
		$city = ucfirst(stripslashes($_POST['city']));
		$city = ucfirst(trim($_POST['city']));

		$state = ucfirst(htmlspecialchars($_POST['state']));
		$state = ucfirst(stripslashes($_POST['state']));
		$state = ucfirst(trim($_POST['state']));

		$nationality = ucfirst(htmlspecialchars($_POST['nationality']));
		$nationality = ucfirst(stripslashes($_POST['nationality']));
		$nationality = ucfirst(trim($_POST['nationality']));
		
		$natid = ucfirst(htmlspecialchars($_POST['natid']));
		$natid = ucfirst(stripslashes($_POST['natid']));
		$natid = ucfirst(trim($_POST['natid']));
		
		$enr = ucfirst(htmlspecialchars($_POST['enr']));
		$enr = ucfirst(stripslashes($_POST['enr']));
		$enr = ucfirst(trim($_POST['enr']));
		
		$religion = ucfirst(htmlspecialchars($_POST['religion']));
		$religion = ucfirst(stripslashes($_POST['religion']));
		$religion = ucfirst(trim($_POST['religion']));
		
		$ethnic = htmlspecialchars($_POST['ethnic']);
		$ethnic = stripslashes($_POST['ethnic']);
		$ethnic = trim($_POST['ethnic']);
		
		$dob = htmlspecialchars($_POST['dob']);
		$dob = stripslashes($_POST['dob']);
		$dob = trim($_POST['dob']);

		$tel1 = htmlspecialchars($_POST['tel1']);
		$tel1 = stripslashes($_POST['tel1']);
		$tel1 = trim($_POST['tel1']);

		$tel2 = htmlspecialchars($_POST['tel2']);
		$tel2 = stripslashes($_POST['tel2']);
		$tel2 = trim($_POST['tel2']);

		$mobile = htmlspecialchars($_POST['mobile']);
		$mobile = stripslashes($_POST['mobile']);
		$mobile = trim($_POST['mobile']);

		$email = htmlspecialchars($_POST['email']);
		$email = stripslashes($_POST['email']);
		$email = trim($_POST['email']);
		
		$insurance = htmlspecialchars($_POST['insurance']);
		$insurance = stripslashes($_POST['insurance']);
		$insurance = trim($_POST['insurance']);
		
		$nhis = htmlspecialchars($_POST['nhis']);
		$nhis = stripslashes($_POST['nhis']);
		$nhis = trim($_POST['nhis']);
		
		$ageType = htmlspecialchars($_POST['ageType']);
		$ageType = stripslashes($_POST['ageType']);
		$ageType = trim($_POST['ageType']);
		
		$ntel = htmlspecialchars($_POST['ntel']);
		$ntel = stripslashes($_POST['ntel']);
		$ntel = trim($_POST['ntel']);

		$relationship = htmlspecialchars($_POST['relationship']);
		$relationship = stripslashes($_POST['relationship']);
		$relationship = trim($_POST['relationship']);

		$nname = htmlspecialchars($_POST['nname']);
		$nname = stripslashes($_POST['nname']);
		$nname = trim($_POST['nname']);
		
		$nadd = htmlspecialchars($_POST['nadd']);
		$nadd = stripslashes($_POST['nadd']);
		$nadd = trim($_POST['nadd']);
		
		$pre = htmlspecialchars($_POST['pre']);
		$pre = stripslashes($_POST['pre']);
		$pre = trim($_POST['pre']);

		$company = htmlspecialchars($_POST['company']);
		$company = stripslashes($_POST['company']);
		$company = trim($_POST['company']);

		$family = htmlspecialchars($_POST['family']);
		$family = stripslashes($_POST['family']);
		$family = trim($_POST['family']);

		if (!empty($family)) {
			$family1 = $family;
		}else{
			$family1 = 0;
		}

		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("title","req","Please fill in title");
		$validator->addValidation("reg_num","req","Please fill in patient's registration number");
		$validator->addValidation("first","req","Please fill in First Name");
		$validator->addValidation("surname","req","Please fill in surname");
		

		if($validator->ValidateForm()){
		    if (EMPTY($title)) {
				$error ='Title cannot be empty';
			}

			if (strlen($mobile) < 11) {
				$error ='Mobile must be 11 Numbers';
			}

			if (strlen($ntel) < 11) {
				$error ='Next Of Kins Phone Number must be 11 Numbers';
			}
			if (strlen($tel1) < 11) {
				$error ='Telephone 1 must be 11 Numbers';
			}
			if (strlen($tel2) < 11) {
				$error ='Telephone 2 must be 11 Numbers';
			}
			
			if (EMPTY($first)) {
				$error ='First Name cannot be empty';
			}
			
			if (EMPTY($surname)) {
				$error ='Surname cannot be empty';
			}
			
			if (EMPTY($reg_num)) {
				$error ='Registration number cannot be empty';
			}
		
			if($dob ==""){
				$age = "Elderly";
			}else{
				$tz  = new DateTimeZone('Africa/Lagos');
				$age = DateTime::createFromFormat('Y-m-d', $dob, $tz)->diff(new DateTime('now', $tz))->y;
			}

			$timee = time();
			$file_name = $_FILES['file']['name'];
			$temp_dir = $_FILES["file"]["tmp_name"];
			$ext_str = "jpg,jpeg,png";
			$ext = substr($file_name, strrpos($file_name, '.') + 1);
			$timee = time();
			$fullname = $timee.'.'.$ext;
			$target_dir = "../photo/".$fullname;
			$allowed_extensions=explode(',',$ext_str);
			$check = filesize($temp_dir);
			if(!$check){
    			$fullname = "";
    			$insert = Database::getInstance()->insert_patient($first,$surname, $m_name, $title, $reg_num, $sex, $blood, $address, $city, $state, $religion, $ethnic, $nationality, $natid, $insurance, $nhis, $enr, $age, $ageType, $dob, $tel1, $tel2, $mobile, $email, $ntel, $nadd, $pre, $fullname, $card_type,$company,$family1,$nname,$relationship);
    			if($insert == 'yesi'){
    				echo '<div class="alert alert-success">
    					Patient Added Successfully
    				</div>';
    			} else {
    				echo $insert;
    			}	
			}else{
				
				if (file_exists($target_dir)) {
					$error = "Image already exist";
				}

				if($error){
					echo '<div class="alert alert-danger">
						<strong>Warning!</strong> '. $error .' 
					</div>';
				}else{
					
					$insert = Database::getInstance()->insert_patient($first,$surname, $m_name, $title, $reg_num, $sex, $blood, $address, $city, $state, $religion, $ethnic, $nationality, $natid, $insurance, $nhis, $enr, $age, $ageType, $dob, $tel1, $tel2, $mobile, $email, $ntel, $nadd, $pre, $fullname, $card_type,$company,$family1,$nname,$relationship);
					if($insert != 'yesi'){
						echo $insert;
					}else{
						if (move_uploaded_file($temp_dir, $target_dir)) {
									echo '<div class="alert alert-success">
												Patient Added Successfully
										</div>';
						} else {
							database::getInstance()->delete_things('patients','photo',$fullname);
							echo '<div class="alert alert-danger">
										<strong>Error!</strong> There was an error while Uploading Photo
									</div>';
						}
					}
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
				}
}

	function newTest(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim($_POST['name']));
		
		$fee = ucfirst(htmlspecialchars($_POST['fee']));
		$fee = ucfirst(stripslashes($_POST['fee']));
		$fee = ucfirst(trim($_POST['fee']));
		
		$type = ucfirst(htmlspecialchars($_POST['type']));
		$type = ucfirst(stripslashes($_POST['type']));
		$type = ucfirst(trim($_POST['type']));
		
		$nvalue = ucfirst(htmlspecialchars($_POST['nvalue']));
		$nvalue = ucfirst(stripslashes($_POST['nvalue']));
		$nvalue = ucfirst(trim($_POST['nvalue']));
		
		$nrange = lcfirst(htmlspecialchars($_POST['nrange']));
		$nrange = lcfirst(stripslashes($_POST['nrange']));
		$nrange = lcfirst(trim($_POST['nrange']));
		
		$rrange = lcfirst(htmlspecialchars($_POST['rrange']));
		$rrange = lcfirst(stripslashes($_POST['rrange']));
		$rrange = lcfirst(trim($_POST['rrange']));
		
		$error = "";
		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please fill in Test name");
								
		if($validator->ValidateForm()){
			
			if (EMPTY($name)) {
				$error ='Test Name cannot be empty';
			}
			
					
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_test($name, $fee, $type, $nvalue, $nrange, $rrange);
				if($insert == 'Done'){
						echo '<div class="alert alert-success">
							Test Added Successfully					
						</div>';
					} else {
						echo $insert;
					}
				}
				
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newDonor(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim($_POST['name']));
		
		$father = ucfirst(htmlspecialchars($_POST['father_name']));
		$father = ucfirst(stripslashes($_POST['father_name']));
		$father = ucfirst(trim($_POST['father_name']));
		
		$type = $_POST['sex'];
		
		$dob = ucfirst(htmlspecialchars($_POST['dob']));
		$dob = ucfirst(stripslashes($_POST['dob']));
		$dob = ucfirst(trim($_POST['dob']));
		
		$weight = lcfirst(htmlspecialchars($_POST['weight']));
		$weight = lcfirst(stripslashes($_POST['weight']));
		$weight = lcfirst(trim($_POST['weight']));
		
		$blood_group = lcfirst(htmlspecialchars($_POST['type']));
		$blood_group = lcfirst(stripslashes($_POST['type']));
		$blood_group = lcfirst(trim($_POST['type']));

		$address = ucfirst(htmlspecialchars($_POST['address']));
		$address = ucfirst(stripslashes($_POST['address']));
		$address = ucfirst(trim($_POST['address']));

		$email = ucfirst(htmlspecialchars($_POST['email']));
		$email = ucfirst(stripslashes($_POST['email']));
		$email = ucfirst(trim($_POST['email']));

		$phone = ucfirst(htmlspecialchars($_POST['phone']));
		$phone = ucfirst(stripslashes($_POST['phone']));
		$phone = ucfirst(trim($_POST['phone']));
		
		$error = "";
		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please fill in Full name");
								
		if($validator->ValidateForm()){
			
			if (EMPTY($name)) {
				$error ='Full Name cannot be empty';
			}
			
					
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_donor($name, $father, $type, $dob, $weight, $blood_group,$address,$email,$phone);
				if($insert == 'Done'){
						echo '<div class="alert alert-success">
							Donor Added Successfully					
						</div>';
					} else {
						echo $insert;
					}
				}
				
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newDonation(){
		$pint = ucfirst(htmlspecialchars($_POST['pint']));
		$pint = ucfirst(stripslashes($_POST['pint']));
		$pint = ucfirst(trim($_POST['pint']));

		$type = $_POST['type'];
		$val = $_POST['val'];
		$doc = $_POST['doc'];
		
		$error = "";
		$validator = new FormValidator();
						
		$validator->addValidation("pint","req","Please fill in Pints Donated");
		$validator->addValidation("type","req","Please Select Type");
								
		if($validator->ValidateForm()){
			
			if (EMPTY($pint)) {
				$error ='Pints cannot be empty';
			}		
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_donation($pint,$type,$val,$doc);
				if($insert == 'Done'){
						echo '<div class="alert alert-success">
							Donation Added Successfully					
						</div>';
					} else {
						echo $insert;
					}
				}
				
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function addRhDType(){
		$result = ucfirst(htmlspecialchars($_POST['result']));
		$result = ucfirst(stripslashes($_POST['result']));
		$result = ucfirst(trim($_POST['result']));

		$observation = ucfirst(htmlspecialchars($_POST['observation']));
		$observation = ucfirst(stripslashes($_POST['observation']));
		$observation = ucfirst(trim($_POST['observation']));
		
		$val = $_POST['val'];
		$staff = $_POST['id'];
		
		$error = "";
		$validator = new FormValidator();
						
		$validator->addValidation("result","req","Please fill in Result");
								
		if($validator->ValidateForm()){
			
			if (EMPTY($result)) {
				$error ='Result cannot be empty';
			}		
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				 echo $insert = Database::getInstance()->insert_rhd($result,$observation,$staff,$val);
			}
				
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function addABOGroup(){
		$result = ucfirst(htmlspecialchars($_POST['result']));
		$result = ucfirst(stripslashes($_POST['result']));
		$result = ucfirst(trim($_POST['result']));

		$observation = ucfirst(htmlspecialchars($_POST['observation']));
		$observation = ucfirst(stripslashes($_POST['observation']));
		$observation = ucfirst(trim($_POST['observation']));
		
		$val = $_POST['val'];
		$staff = $_POST['id'];
		
		$error = "";
		$validator = new FormValidator();
						
		$validator->addValidation("result","req","Please fill in Result");
								
		if($validator->ValidateForm()){
			
			if (EMPTY($result)) {
				$error ='Result cannot be empty';
			}		
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				 echo $insert = Database::getInstance()->insert_abo($result,$observation,$staff,$val);
			}
				
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function addSerum(){
		$result = ucfirst(htmlspecialchars($_POST['result']));
		$result = ucfirst(stripslashes($_POST['result']));
		$result = ucfirst(trim($_POST['result']));

		$observation = ucfirst(htmlspecialchars($_POST['observation']));
		$observation = ucfirst(stripslashes($_POST['observation']));
		$observation = ucfirst(trim($_POST['observation']));
		
		$val = $_POST['val'];
		$staff = $_POST['id'];
		
		$error = "";
		$validator = new FormValidator();
						
		$validator->addValidation("result","req","Please fill in Result");
								
		if($validator->ValidateForm()){
			
			if (EMPTY($result)) {
				$error ='Result cannot be empty';
			}		
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				 echo $insert = Database::getInstance()->insert_serum($result,$observation,$staff,$val);
			}
				
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newScan(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim($_POST['name']));
		
		$fee = ucfirst(htmlspecialchars($_POST['fee']));
		$fee = ucfirst(stripslashes($_POST['fee']));
		$fee = ucfirst(trim($_POST['fee']));
		
		$type = ucfirst(htmlspecialchars($_POST['type']));
		$type = ucfirst(stripslashes($_POST['type']));
		$type = ucfirst(trim($_POST['type']));
				
		$error = "";
		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please fill in Scan name");
								
		if($validator->ValidateForm()){
			
			if (EMPTY($name)) {
				$error ='Scan cannot be empty';
			}
			
					
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_scan($name, $fee, $type);
				if($insert == 'Done'){
						echo '<div class="alert alert-success">
							Scan Added Successfully					
						</div>';
					} else {
						echo $insert;
					}
				}
				
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newXray(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim($_POST['name']));
		
		$fee = ucfirst(htmlspecialchars($_POST['fee']));
		$fee = ucfirst(stripslashes($_POST['fee']));
		$fee = ucfirst(trim($_POST['fee']));
		
		$type = ucfirst(htmlspecialchars($_POST['type']));
		$type = ucfirst(stripslashes($_POST['type']));
		$type = ucfirst(trim($_POST['type']));
				
		$error = "";
		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please fill in Xray name");
								
		if($validator->ValidateForm()){
			
			if (EMPTY($name)) {
				$error ='Xray cannot be empty';
			}
			
					
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_xray($name, $fee, $type);
				if($insert == 'Done'){
						echo '<div class="alert alert-success">
							Xray Added Successfully					
						</div>';
					} else {
						echo $insert;
					}
				}
				
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newTestRequest_progress(){
                
                $val = $_POST['val'];
                $doc = $_POST['doc'];
                $app = $_POST['app'];
                $test='n';
				if (isset($_POST["test"])){
						$test= $_POST['test'];
				}
				
								
				if($test == 'n'){
						echo '<div class="alert alert-danger">
									Please select at least one Test
								</div>';
				}else{
						echo database::getInstance()->insert_test_request2($test,$doc,$val,$app);
						//database::getInstance()->notify_lab($val);
				}
								
									

}

function newTestRequest(){
                
                $val = $_POST['val'];
                $doc = $_POST['doc'];
                $app = $_POST['app'];
                $test='n';
				if (isset($_POST["test"])){
						$test= $_POST['test'];
				}
				
								
				if($test == 'n'){
						echo '<div class="alert alert-danger">
									Please select at least one Test
								</div>';
				}else{
							echo database::getInstance()->insert_test_request($test,$doc,$val,$app);
						//database::getInstance()->notify_lab($val);
				}
								
									

}

function newXrayRequest(){
                
                $val = $_POST['val'];
                $doc = $_POST['doc'];
                $pat = $_POST['pat'];
                $xray='n';
				if (isset($_POST["xray"])){
						$xray= $_POST['xray'];
				}
				
								
				if($xray == 'n'){
						echo '<div class="alert alert-danger">
									Please select at least one Xray
								</div>';
				}else{
						echo database::getInstance()->insert_xray_request($xray,$doc,$val);
						//database::getInstance()->notify_xray($val,$doc,$pat);
				}
								
									

}

function newXrayRequest_progress(){
                
                $val = $_POST['val'];
                $doc = $_POST['doc'];
                $pat = $_POST['pat'];
                $xray='n';
				if (isset($_POST["xray"])){
						$xray= $_POST['xray'];
				}
				
								
				if($xray == 'n'){
						echo '<div class="alert alert-danger">
									Please select at least one Xray
								</div>';
				}else{
						echo database::getInstance()->insert_xray_request2($xray,$doc,$val);
						//database::getInstance()->notify_xray($val,$doc,$pat);
				}
								
									

}

function newScanRequest(){
                
                $val = $_POST['val'];
                $doc = $_POST['doc'];
                $pat = $_POST['pat'];
                $xray='n';
				if (isset($_POST["xray"])){
						$xray= $_POST['xray'];
				}
				
								
				if($xray == 'n'){
						echo '<div class="alert alert-danger">
									Please select at least one Xray
								</div>';
				}else{
						echo database::getInstance()->insert_scan_request($xray,$doc,$val);
						//database::getInstance()->notify_xray($val,$doc,$pat);
				}
								
									

}

function newScanRequest_progress(){
                
                $val = $_POST['val'];
                $doc = $_POST['doc'];
                $pat = $_POST['pat'];
                $xray='n';
				if (isset($_POST["xray"])){
						$xray= $_POST['xray'];
				}
				
								
				if($xray == 'n'){
						echo '<div class="alert alert-danger">
									Please select at least one Xray
								</div>';
				}else{
						echo database::getInstance()->insert_scan_request2($xray,$doc,$val);
						//database::getInstance()->notify_xray($val,$doc,$pat);
				}
								
									

}
function newXrayRequest_front(){
                
                $val = $_POST['val'];
                $pat = $_POST['doc'];
                $xray='n';
				if (isset($_POST["xray"])){
						$xray= $_POST['xray'];
				}
				
								
				if($xray == 'n'){
						echo '<div class="alert alert-danger">
									Please select at least one Xray
								</div>';
				}else{
						echo database::getInstance()->insert_xray_request_front($xray,$pat,$val);
						//database::getInstance()->notify_xray($val,$doc,$pat);
				}
								
									

}

function newScanRequest_front(){
                
                $val = $_POST['val'];
                $pat = $_POST['doc'];
                $xray='n';
				if (isset($_POST["xray"])){
						$xray= $_POST['xray'];
				}
				
								
				if($xray == 'n'){
						echo '<div class="alert alert-danger">
									Please select at least one Scan
								</div>';
				}else{
						echo database::getInstance()->insert_scan_request_front($xray,$pat,$val);
						//database::getInstance()->notify_xray($val,$doc,$pat);
				}
								
									

}

function newTestRequestFront(){
                
                $val = $_POST['val'];
                $doc = $_POST['pat'];
                $test='n';
				if (isset($_POST["test"])){
						$test= $_POST['test'];
				}
				
								
				if($test == 'n'){
						echo '<div class="alert alert-danger">
									Please select at least one Test
								</div>';
				}else{
						echo database::getInstance()->insert_test_request_front($test,$doc,$val);
						//database::getInstance()->notify_lab($val);
				}
								
									

}

function newBed(){
		$bed = ucfirst(htmlspecialchars($_POST['bed']));
		$bed = ucfirst(stripslashes($_POST['bed']));
		$bed = ucfirst(trim($_POST['bed']));

		$type = ucfirst(htmlspecialchars($_POST['type']));
		$type = ucfirst(stripslashes($_POST['type']));
		$type = ucfirst(trim($_POST['type']));

		$charge = ucfirst(htmlspecialchars($_POST['charge']));
		$charge = ucfirst(stripslashes($_POST['charge']));
		$charge = ucfirst(trim($_POST['charge']));

		$description = ucfirst(htmlspecialchars($_POST['description']));
		$description = ucfirst(stripslashes($_POST['description']));
		$description = ucfirst(trim($_POST['description']));
		$val = $_POST['val'];
		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("bed","req","Please fill in Bed Number");
		$validator->addValidation("type","req","Please select Bed Type");
		$validator->addValidation("charge","req","Please fill in Bed Charge");
									
		if($validator->ValidateForm()){
			
			
				$insert = Database::getInstance()->insert_bed($bed,$type,$charge,$description,$val);
				
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}


	function newBedType(){
		$bed = ucfirst(htmlspecialchars($_POST['bed']));
		$bed = ucfirst(stripslashes($_POST['bed']));
		$bed = ucfirst(trim($_POST['bed']));

		$val = $_POST['val'];
		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("bed","req","Please fill in Bed Type");
									
		if($validator->ValidateForm()){
			
			
				$insert = Database::getInstance()->insert_bed_type($bed,$val);
				
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	
	function newDoc(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim($_POST['name']));
		
		$phone = ucfirst(htmlspecialchars($_POST['phone']));
		$phone = ucfirst(stripslashes($_POST['phone']));
		$phone = ucfirst(trim($_POST['phone']));
		
		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please fill in name");
		$validator->addValidation("phone","req","Please fill in phone");
									
		if($validator->ValidateForm()){
			
										
			if (strlen($phone) < 11) {
				$error ='Phone number must be 11 characters';
			}
			
			if (EMPTY($name)) {
				$error ='Name cannot be empty';
			}
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_doc($name, $phone);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Doctor Added Successfully					
						</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newSchedule(){
		$doctor = ucfirst(htmlspecialchars($_POST['doctor']));
		$doctor = ucfirst(stripslashes($_POST['doctor']));
		$doctor = ucfirst(trim($_POST['doctor']));
		
		$dayofweek = ucfirst(htmlspecialchars($_POST['dayofweek']));
		$dayofweek = ucfirst(stripslashes($_POST['dayofweek']));
		$dayofweek = ucfirst(trim($_POST['dayofweek']));

		$timein = ucfirst(htmlspecialchars($_POST['timein']));
		$timein = ucfirst(stripslashes($_POST['timein']));
		$timein = ucfirst(trim($_POST['timein']));

		$timeout = ucfirst(htmlspecialchars($_POST['timeout']));
		$timeout = ucfirst(stripslashes($_POST['timeout']));
		$timeout = ucfirst(trim($_POST['timeout']));
		
		$dateday = ucfirst(htmlspecialchars($_POST['dateday']));
		$dateday = ucfirst(stripslashes($_POST['dateday']));
		$dateday = ucfirst(trim($_POST['dateday']));

		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("doctor","req","Please choose doctor");
		$validator->addValidation("dayofweek","req","Please choose day of week");
		$validator->addValidation("timein","req","Please enter time in");
		$validator->addValidation("timeout","req","Please enter time out");
		$validator->addValidation("dateday","req","Please enter date");
									
		if($validator->ValidateForm()){
			if (EMPTY($dayofweek)) {
				$error ='Day of week cannot be empty';
			}

			if (EMPTY($timein)) {
				$error ='Time in cannot be empty';
			}

			if (EMPTY($timeout)) {
				$error ='Time out cannot be empty';
			}

			if (EMPTY($dateday)) {
				$error ='Date cannot be empty';
			}
			
			if (EMPTY($doctor)) {
				$error ='Doctor cannot be empty';
			}
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_schedule($doctor, $dayofweek, $timein, $timeout, $dateday);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Schedule Successfully					
						</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newAppointment(){
		$doctor = ucfirst(htmlspecialchars($_POST['doctor']));
		$doctor = ucfirst(stripslashes($_POST['doctor']));
		$doctor = ucfirst(trim($_POST['doctor']));
		

		$fee = ucfirst(htmlspecialchars($_POST['consult']));
		$fee = ucfirst(stripslashes($_POST['consult']));
		$fee = ucfirst(trim($_POST['consult']));

		$date = ucfirst(htmlspecialchars($_POST['date']));
		$date = ucfirst(stripslashes($_POST['date']));
		$date = ucfirst(trim($_POST['date']));

		$specialty = ucfirst(htmlspecialchars($_POST['specialty']));
		$specialty = ucfirst(stripslashes($_POST['specialty']));
		$specialty = ucfirst(trim($_POST['specialty']));

		$error = '';

		$p_id = $_POST['p_id'];
		$app = $_POST['app'];
		$validator = new FormValidator();
						
		$validator->addValidation("doctor","req","Please choose doctor");
		$validator->addValidation("consult","req","Please Enter A Consultation Fee");
		$validator->addValidation("date","req","Please Choose A Date");
		
									
		if($validator->ValidateForm()){
			
			if (EMPTY($doctor)) {
				$error ='Doctor cannot be empty';
			}
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>'; 
			}else{
					$insert = Database::getInstance()->insert_app($specialty,$doctor, $p_id,$fee,$date);
				
				//$acc = Database::getInstance()->notify_account($p_id);
				if($insert == 'Done'){
						echo 'Done';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newBRequest(){
		$sample = ucfirst(htmlspecialchars($_POST['sample']));
		$sample = ucfirst(stripslashes($_POST['sample']));
		$sample = ucfirst(trim($_POST['sample']));		

		$facility_name = ucfirst(htmlspecialchars($_POST['facility_name']));
		$facility_name = ucfirst(stripslashes($_POST['facility_name']));
		$facility_name = ucfirst(trim($_POST['facility_name']));

		$fphone_number = ucfirst(htmlspecialchars($_POST['fphone_number']));
		$fphone_number = ucfirst(stripslashes($_POST['fphone_number']));
		$fphone_number = ucfirst(trim($_POST['fphone_number']));

		$physician = ucfirst(htmlspecialchars($_POST['physician']));
		$physician = ucfirst(stripslashes($_POST['physician']));
		$physician = ucfirst(trim($_POST['physician']));

		$patient_name = ucfirst(htmlspecialchars($_POST['patient_name']));
		$patient_name = ucfirst(stripslashes($_POST['patient_name']));
		$patient_name = ucfirst(trim($_POST['patient_name']));

		$patient_id = ucfirst(htmlspecialchars($_POST['patient_id']));
		$patient_id = ucfirst(stripslashes($_POST['patient_id']));
		$patient_id = ucfirst(trim($_POST['patient_id']));

		$address = ucfirst(htmlspecialchars($_POST['address']));
		$address = ucfirst(stripslashes($_POST['address']));
		$address = ucfirst(trim($_POST['address']));

		$pphone_number = ucfirst(htmlspecialchars($_POST['pphone_number']));
		$pphone_number = ucfirst(stripslashes($_POST['pphone_number']));
		$pphone_number = ucfirst(trim($_POST['pphone_number']));

		$patient_dob = ucfirst(htmlspecialchars($_POST['patient_dob']));
		$patient_dob = ucfirst(stripslashes($_POST['patient_dob']));
		$patient_dob = ucfirst(trim($_POST['patient_dob']));

		$diagnosis = ucfirst(htmlspecialchars($_POST['diagnosis']));
		$diagnosis = ucfirst(stripslashes($_POST['diagnosis']));
		$diagnosis = ucfirst(trim($_POST['diagnosis']));

		$inquiry = ucfirst(htmlspecialchars($_POST['inquiry']));
		$inquiry = ucfirst(stripslashes($_POST['inquiry']));
		$inquiry = ucfirst(trim($_POST['inquiry']));

		$inquiry_reason = ucfirst(htmlspecialchars($_POST['inquiry_reason']));
		$inquiry_reason = ucfirst(stripslashes($_POST['inquiry_reason']));
		$inquiry_reason = ucfirst(trim($_POST['inquiry_reason']));

		$rbc = ucfirst(htmlspecialchars($_POST['rbc']));
		$rbc = ucfirst(stripslashes($_POST['rbc']));
		$rbc = ucfirst(trim($_POST['rbc']));

		$date_lknas = ucfirst(htmlspecialchars($_POST['date_lknas']));
		$date_lknas = ucfirst(stripslashes($_POST['date_lknas']));
		$date_lknas = ucfirst(trim($_POST['date_lknas']));

		$cmeds = ucfirst(htmlspecialchars($_POST['cmeds']));
		$cmeds = ucfirst(stripslashes($_POST['cmeds']));
		$cmeds = ucfirst(trim($_POST['cmeds']));

		$info = ucfirst(htmlspecialchars($_POST['info']));
		$info = ucfirst(stripslashes($_POST['info']));
		$info = ucfirst(trim($_POST['info']));

		$transfusion = ucfirst(htmlspecialchars($_POST['transfusion']));
		$transfusion = ucfirst(stripslashes($_POST['transfusion']));
		$transfusion = ucfirst(trim($_POST['transfusion']));

		$urgency = ucfirst(htmlspecialchars($_POST['urgency']));
		$urgency = ucfirst(stripslashes($_POST['urgency']));
		$urgency = ucfirst(trim($_POST['urgency']));

		$volume = ucfirst(htmlspecialchars($_POST['volume']));
		$volume = ucfirst(stripslashes($_POST['volume']));
		$volume = ucfirst(trim($_POST['volume']));


		$error = '';

		$id = $_POST['id'];
		$validator = new FormValidator();
						
		$validator->addValidation("sample","req","Please choose sample");
		$validator->addValidation("facility_name","req","Please Enter A Facilit Name");
		
									
		if($validator->ValidateForm()){
			
			if (EMPTY($facility_name)) {
				$error ='Facility Name cannot be empty';
			}
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>'; 
			}else{
					$insert = Database::getInstance()->insert_brequest($sample,$facility_name,$fphone_number,$physician,$patient_name,$patient_id,$address,$pphone_number,$patient_dob,$diagnosis,$inquiry,$rbc,$date_lknas,$cmeds,$info,$transfusion,$urgency,$volume,$id);
					echo $insert;
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}
	
	function extraFile(){
	
				if(!isset($_FILES['file'])){
							echo '<div class="alert alert-warning">
									Please Choose a File
								  </div>';
				}else{
								$patient = $_POST['patient'];
								$name = $_POST['namea'];
								$val = $_POST['val'];
								$uploaderror ='';
								
								$validator = new FormValidator();
						
								$validator->addValidation("patient","req","Please choose Patient");
								$validator->addValidation("namea","req","Please insert Name");
								$validator->addValidation("val","req","Please Login");
								if($validator->ValidateForm()){
								$timee = time();
								$file_name = $_FILES['file']['name'];
								$temp_dir = $_FILES["file"]["tmp_name"];
								$ext_str = "jpg,jpeg,png,docx,doc,pdf";
								$ext = substr($file_name, strrpos($file_name, '.') + 1);
								$timee = time();
								$fullname = $timee.'.'.$ext;
								$target_dir = "../extrafile/".$fullname;
								$allowed_extensions=explode(',',$ext_str);
								$check = filesize($temp_dir);
								if(!$check){
									echo '<div class="alert alert-danger">
													<strong>Warning!</strong> no file
												</div>';
								}else{
									
									if (file_exists($target_dir)) {
												
												$uploaderror = "File already exist";
									}
											
											
									if(!in_array($ext, $allowed_extensions)) {
	
														$uploaderror = "File type not allowed";
									}
													
											
									if($uploaderror){
										echo '<div class="alert alert-danger">
													<strong>Warning!</strong> '. $uploaderror .' 
												</div>';
											
									}else{
										
										$insert = database::getInstance()-> insert_extra_file($name,$patient,$val,$fullname);
											
										if($insert != 'yesi'){
											 echo $insert;
										 }else{
											if (move_uploaded_file($temp_dir, $target_dir)) {
													echo '<div class="alert alert-success">
																File Uploaded Successfully
															</div>';
											} else {
														database::getInstance()->delete_things('extra_file','extra_file',$fullname);
														echo '<div class="alert alert-danger">
																<strong>Error!</strong> There was an error while Uploading File
															</div>';
													}
										}
									}
								}
								
								}else{
									$error_hash = $validator->GetErrors();
									foreach($error_hash as $inpname => $inp_err){
									echo '<div class="alert alert-danger">
											<strong>Warning!</strong> ' . $inp_err . '
									</div>';
					}
				}
								
							
				}
				
				
				
				
}


function xrayFiles(){
	
				if(!isset($_FILES['scan'])){
							echo '<div class="alert alert-warning">
									Please Choose a File
								  </div>';
				}else{
								$patient = $_POST['patient'];
								$app_id = $_POST['id'];
								$name = $_POST['comment'];
								$xname = $_POST['x_name'];
								$xid = $_POST['xray_id'];
								$ref = $_POST['ref'];
								$category = $_POST['category'];
								$uploaderror ='';
								
								$validator = new FormValidator();
						
								$validator->addValidation("patient","req","Please choose Patient");
								$validator->addValidation("comment","req","Please insert Comment");
								$validator->addValidation("x_name","req","no Xray Name Found");
								$validator->addValidation("xray_id","req","no Xray Id Found");
								$validator->addValidation("ref","req","no Reference Found");
								$validator->addValidation("category","req","no Category Found");
								$validator->addValidation("id","req","no Appointment ID");
								if($validator->ValidateForm()){
								$timee = time();
								$file_name = $_FILES['scan']['name'];
								$temp_dir = $_FILES["scan"]["tmp_name"];
								$ext_str = "jpg,jpeg,png,docx,doc,pdf";
								$ext = substr($file_name, strrpos($file_name, '.') + 1);
								$timee = time();
								$fullname = $timee.'.'.$ext;
								$target_dir = "../extrafile/".$fullname;
								$allowed_extensions=explode(',',$ext_str);
								$check = filesize($temp_dir);
								if(!$check){
									$fullname = "noimg.png";
									$insert = database::getInstance()-> insert_xray_ress($patient, $app_id, $xid, $ref,$fullname, $name, $xname, $category);
										
											
										if($insert != 'yesi'){
											 echo $insert;
										 }else{
										 	echo '<div class="alert alert-success">
																Scan Comment Uploaded Successfully
															</div>';										}
								}else{
									
									if (file_exists($target_dir)) {
												
												$uploaderror = "File already exist";
									}
											
											
									if(!in_array($ext, $allowed_extensions)) {
	
														$uploaderror = "File type not allowed";
									}
													
											
									if($uploaderror){
										echo '<div class="alert alert-danger">
													<strong>Warning!</strong> '. $uploaderror .' 
												</div>';
											
									}else{
										
										$insert = database::getInstance()-> insert_xray_ress($patient, $app_id, $xid, $ref,$fullname, $name, $xname, $category);
										
											
										if($insert != 'yesi'){
											 echo $insert;
										 }else{
											if (move_uploaded_file($temp_dir, $target_dir)) {
													echo '<div class="alert alert-success">
																File Uploaded Successfully
															</div>';
											} else {
														database::getInstance()->delete_things('patient_xray_result','file',$fullname);
														echo '<div class="alert alert-danger">
																<strong>Error!</strong> There was an error while Uploading File
															</div>';
													}
										}
									}
								}
								
								}else{
									$error_hash = $validator->GetErrors();
									foreach($error_hash as $inpname => $inp_err){
									echo '<div class="alert alert-danger">
											<strong>Warning!</strong> ' . $inp_err . '
									</div>';
					}
				}
								
							
				}
				
				
				
				
}

function scanFiles(){
	
				if(empty($_FILES['scan'])){
							echo '<div class="alert alert-warning">
									Please Choose a File
								  </div>';
				}else{
								$patient = $_POST['patient'];
								$app_id = $_POST['id'];
								$name = $_POST['comment'];
								$xname = $_POST['x_name'];
								$xid = $_POST['xray_id'];
								$ref = $_POST['ref'];
								$category = $_POST['category'];
								$uploaderror ='';
								
								$validator = new FormValidator();
						
								$validator->addValidation("patient","req","Please choose Patient");
								$validator->addValidation("comment","req","Please insert Comment");
								$validator->addValidation("x_name","req","no Scan Name Found");
								$validator->addValidation("xray_id","req","no Scan Id Found");
								$validator->addValidation("ref","req","no Reference Found");
								$validator->addValidation("category","req","no Category Found");
								$validator->addValidation("id","req","no Appointment ID");
								if($validator->ValidateForm()){
								$timee = time();
								$file_name = $_FILES['scan']['name'];
								$temp_dir = $_FILES["scan"]["tmp_name"];
								$ext_str = "jpg,jpeg,png,docx,doc,pdf";
								$ext = substr($file_name, strrpos($file_name, '.') + 1);
								$timee = time();
								$fullname = $timee.'.'.$ext;
								$target_dir = "../extrafile/".$fullname;
								$allowed_extensions=explode(',',$ext_str);
								$check = filesize($temp_dir);
								if(!$check){
									$fullname = "noimg.png";
									$insert = database::getInstance()->insert_scan_ress($patient, $app_id, $xid, $ref,$fullname, $name, $xname, $category);
										
											
										if($insert != 'yesi'){
											 echo $insert;
										 }else{
										 	echo '<div class="alert alert-success">
																Scan Comment Uploaded Successfully
															</div>';										}
								}else{
									
									if (file_exists($target_dir)) {
												
												$uploaderror = "File already exist";
									}
											
											
									if(!in_array($ext, $allowed_extensions)) {
	
														$uploaderror = "File type not allowed";
									}
													
											
									if($uploaderror){
										echo '<div class="alert alert-danger">
													<strong>Warning!</strong> '. $uploaderror .' 
												</div>';
											
									}else{
										
										$insert = database::getInstance()-> insert_scan_ress($patient, $app_id, $xid, $ref,$fullname, $name, $xname, $category);
										
											
										if($insert != 'yesi'){
											 echo $insert;
										 }else{
											if (move_uploaded_file($temp_dir, $target_dir)) {
													echo '<div class="alert alert-success">
																File Uploaded Successfully
															</div>';
											} else {
														database::getInstance()->delete_things('patient_scan_result','file',$fullname);
														echo '<div class="alert alert-danger">
																<strong>Error!</strong> There was an error while Uploading File
															</div>';
													}
										}
									}
								}
								
								}else{
									$error_hash = $validator->GetErrors();
									foreach($error_hash as $inpname => $inp_err){
									echo '<div class="alert alert-danger">
											<strong>Warning!</strong> ' . $inp_err . '
									</div>';
					}
				}
								
							
				}
				
				
				
				
}


	function newCase(){
	
		$diagnosis = ucfirst(htmlspecialchars($_POST['diagnosis']));
		$diagnosis = ucfirst(stripslashes($_POST['diagnosis']));
		$diagnosis = ucfirst(trim($_POST['diagnosis']));
		
		$pharm = ucfirst(htmlspecialchars($_POST['pharm']));
		$pharm = ucfirst(stripslashes($_POST['pharm']));
		$pharm = ucfirst(trim($_POST['pharm']));
		
		$dosage = ucfirst(htmlspecialchars($_POST['frequency']));
		$dosage = ucfirst(stripslashes($_POST['frequency']));
		$dosage = ucfirst(trim($_POST['frequency']));
		
		$tabs = ucfirst(htmlspecialchars($_POST['tabs']));
		$tabs = ucfirst(stripslashes($_POST['tabs']));
		$tabs = ucfirst(trim($_POST['tabs']));
		
		$instruction = ucfirst(htmlspecialchars($_POST['instruction']));
		$instruction = ucfirst(stripslashes($_POST['instruction']));
		$instruction = ucfirst(trim($_POST['instruction']));

		$quantity = ucfirst(htmlspecialchars($_POST['quantity']));
		$quantity = ucfirst(stripslashes($_POST['quantity']));
		$quantity = ucfirst(trim($_POST['quantity']));
		
		$duration = ucfirst(htmlspecialchars($_POST['duration']));
		$duration = ucfirst(stripslashes($_POST['duration']));
		$duration = ucfirst(trim($_POST['duration']));

		$sdosage = ucfirst(htmlspecialchars($_POST['sfrequency']));
		$sdosage = ucfirst(stripslashes($_POST['sfrequency']));
		$sdosage = ucfirst(trim($_POST['sfrequency']));
		
		$stabs = ucfirst(htmlspecialchars($_POST['stabs']));
		$stabs = ucfirst(stripslashes($_POST['stabs']));
		$stabs = ucfirst(trim($_POST['stabs']));

		$squantity = ucfirst(htmlspecialchars($_POST['squantity']));
		$squantity = ucfirst(stripslashes($_POST['squantity']));
		$squantity = ucfirst(trim($_POST['squantity']));
		
		$sduration = ucfirst(htmlspecialchars($_POST['sduration']));
		$sduration = ucfirst(stripslashes($_POST['sduration']));
		$sduration = ucfirst(trim($_POST['sduration']));

		$error = '';

		$id = $_POST['id'];
		$doc_id = $_POST['doc_id'];
		$p_id = $_POST['p_id'];

		$validator = new FormValidator();
						
		$validator->addValidation("pharm","req","Please select drug");
									
		if($validator->ValidateForm()){
				
				//$amount = Database::getInstance()->get_name_from_id("price","pharm_stock","id",$pharm);
				$insert = Database::getInstance()->insert_case($diagnosis,$pharm, $tabs,$dosage,$duration,$quantity,$instruction, $doc_id, $id, $p_id,$stabs,$squantity,$sdosage,$sduration);
				if($insert == 'Done'){
					//Database::getInstance()->notify_pharm($p_id);
					echo '<div class="alert alert-success">
							Successful					
						</div>';
				} else {
					echo $insert;
				}
			
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function payStaff(){
	
		$basic = ucfirst(htmlspecialchars($_POST['basic']));
		$basic = ucfirst(stripslashes($_POST['basic']));
		$basic = ucfirst(trim($_POST['basic']));
		
		$housing = ucfirst(htmlspecialchars($_POST['housing']));
		$housing = ucfirst(stripslashes($_POST['housing']));
		$housing = ucfirst(trim($_POST['housing']));
		
		$transport = ucfirst(htmlspecialchars($_POST['transport']));
		$transport = ucfirst(stripslashes($_POST['transport']));
		$transport = ucfirst(trim($_POST['transport']));
		
		$cduty = ucfirst(htmlspecialchars($_POST['cduty']));
		$cduty = ucfirst(stripslashes($_POST['cduty']));
		$cduty = ucfirst(trim($_POST['cduty']));

		$hazard = ucfirst(htmlspecialchars($_POST['hazard']));
		$hazard = ucfirst(stripslashes($_POST['hazard']));
		$hazard = ucfirst(trim($_POST['hazard']));

		$feeding = ucfirst(htmlspecialchars($_POST['feeding']));
		$feeding = ucfirst(stripslashes($_POST['feeding']));
		$feeding = ucfirst(trim($_POST['feeding']));

		$medicals = ucfirst(htmlspecialchars($_POST['medicals']));
		$medicals = ucfirst(stripslashes($_POST['medicals']));
		$medicals = ucfirst(trim($_POST['medicals']));

		$pholiday = ucfirst(htmlspecialchars($_POST['pholiday']));
		$pholiday = ucfirst(stripslashes($_POST['pholiday']));
		$pholiday = ucfirst(trim($_POST['pholiday']));

		$others = ucfirst(htmlspecialchars($_POST['others']));
		$others = ucfirst(stripslashes($_POST['others']));
		$others = ucfirst(trim($_POST['others']));

		$total_income = ucfirst(htmlspecialchars($_POST['total_income']));
		$total_income = ucfirst(stripslashes($_POST['total_income']));
		$total_income = ucfirst(trim($_POST['total_income']));

		$paye = ucfirst(htmlspecialchars($_POST['paye']));
		$paye = ucfirst(stripslashes($_POST['paye']));
		$paye = ucfirst(trim($_POST['paye']));

		$pension = ucfirst(htmlspecialchars($_POST['pension']));
		$pension = ucfirst(stripslashes($_POST['pension']));
		$pension = ucfirst(trim($_POST['pension']));

		$loan = ucfirst(htmlspecialchars($_POST['loan']));
		$loan = ucfirst(stripslashes($_POST['loan']));
		$loan = ucfirst(trim($_POST['loan']));

		$thrift = ucfirst(htmlspecialchars($_POST['thrift']));
		$thrift = ucfirst(stripslashes($_POST['thrift']));
		$thrift = ucfirst(trim($_POST['thrift']));

		$advance = ucfirst(htmlspecialchars($_POST['advance']));
		$advance = ucfirst(stripslashes($_POST['advance']));
		$advance = ucfirst(trim($_POST['advance']));

		$daycare = ucfirst(htmlspecialchars($_POST['daycare']));
		$daycare = ucfirst(stripslashes($_POST['daycare']));
		$daycare = ucfirst(trim($_POST['daycare']));

		$pharmacy = ucfirst(htmlspecialchars($_POST['pharmacy']));
		$pharmacy = ucfirst(stripslashes($_POST['pharmacy']));
		$pharmacy = ucfirst(trim($_POST['pharmacy']));

		$welfare = ucfirst(htmlspecialchars($_POST['welfare']));
		$welfare = ucfirst(stripslashes($_POST['welfare']));
		$welfare = ucfirst(trim($_POST['welfare']));

		$dothers = ucfirst(htmlspecialchars($_POST['dothers']));
		$dothers = ucfirst(stripslashes($_POST['dothers']));
		$dothers = ucfirst(trim($_POST['dothers']));

		$total_deductions = ucfirst(htmlspecialchars($_POST['total_deductions']));
		$total_deductions = ucfirst(stripslashes($_POST['total_deductions']));
		$total_deductions = ucfirst(trim($_POST['total_deductions']));

		$staff = ucfirst(htmlspecialchars($_POST['staff']));
		$staff = ucfirst(stripslashes($_POST['staff']));
		$staff = ucfirst(trim($_POST['staff']));

		$error = '';
		session_start();
		$id = $_SESSION['userSession'];

		$validator = new FormValidator();
						
		$validator->addValidation("basic","req","Please Enter Basic Salary");
		$validator->addValidation("staff","req","Please Select A Staff");
									
		if($validator->ValidateForm()){
				$insert = Database::getInstance()->insert_pay($basic,$housing,$hazard,$transport,$cduty,$feeding,$medicals,$pholiday,$others,$total_income,$paye,$pension,$loan,$thrift,$advance,$daycare,$pharmacy,$welfare,$dothers,$total_deductions,$staff,$id);
				if($insert == 'Done'){
					//Database::getInstance()->notify_pharm($p_id);
					echo '<div class="alert alert-success">
							Successful			
						</div>';
				} else {
					echo $insert;
				}
			
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function EditpayStaff(){
	
		$basic = ucfirst(htmlspecialchars($_POST['basic']));
		$basic = ucfirst(stripslashes($_POST['basic']));
		$basic = ucfirst(trim($_POST['basic']));
		
		$housing = ucfirst(htmlspecialchars($_POST['housing']));
		$housing = ucfirst(stripslashes($_POST['housing']));
		$housing = ucfirst(trim($_POST['housing']));
		
		$transport = ucfirst(htmlspecialchars($_POST['transport']));
		$transport = ucfirst(stripslashes($_POST['transport']));
		$transport = ucfirst(trim($_POST['transport']));
		
		$cduty = ucfirst(htmlspecialchars($_POST['cduty']));
		$cduty = ucfirst(stripslashes($_POST['cduty']));
		$cduty = ucfirst(trim($_POST['cduty']));

		$hazard = ucfirst(htmlspecialchars($_POST['hazard']));
		$hazard = ucfirst(stripslashes($_POST['hazard']));
		$hazard = ucfirst(trim($_POST['hazard']));

		$feeding = ucfirst(htmlspecialchars($_POST['feeding']));
		$feeding = ucfirst(stripslashes($_POST['feeding']));
		$feeding = ucfirst(trim($_POST['feeding']));

		$medicals = ucfirst(htmlspecialchars($_POST['medicals']));
		$medicals = ucfirst(stripslashes($_POST['medicals']));
		$medicals = ucfirst(trim($_POST['medicals']));

		$pholiday = ucfirst(htmlspecialchars($_POST['pholiday']));
		$pholiday = ucfirst(stripslashes($_POST['pholiday']));
		$pholiday = ucfirst(trim($_POST['pholiday']));

		$others = ucfirst(htmlspecialchars($_POST['others']));
		$others = ucfirst(stripslashes($_POST['others']));
		$others = ucfirst(trim($_POST['others']));

		$total_income = ucfirst(htmlspecialchars($_POST['total_income']));
		$total_income = ucfirst(stripslashes($_POST['total_income']));
		$total_income = ucfirst(trim($_POST['total_income']));

		$paye = ucfirst(htmlspecialchars($_POST['paye']));
		$paye = ucfirst(stripslashes($_POST['paye']));
		$paye = ucfirst(trim($_POST['paye']));

		$pension = ucfirst(htmlspecialchars($_POST['pension']));
		$pension = ucfirst(stripslashes($_POST['pension']));
		$pension = ucfirst(trim($_POST['pension']));

		$loan = ucfirst(htmlspecialchars($_POST['loan']));
		$loan = ucfirst(stripslashes($_POST['loan']));
		$loan = ucfirst(trim($_POST['loan']));

		$thrift = ucfirst(htmlspecialchars($_POST['thrift']));
		$thrift = ucfirst(stripslashes($_POST['thrift']));
		$thrift = ucfirst(trim($_POST['thrift']));

		$advance = ucfirst(htmlspecialchars($_POST['advance']));
		$advance = ucfirst(stripslashes($_POST['advance']));
		$advance = ucfirst(trim($_POST['advance']));

		$daycare = ucfirst(htmlspecialchars($_POST['daycare']));
		$daycare = ucfirst(stripslashes($_POST['daycare']));
		$daycare = ucfirst(trim($_POST['daycare']));

		$pharmacy = ucfirst(htmlspecialchars($_POST['pharmacy']));
		$pharmacy = ucfirst(stripslashes($_POST['pharmacy']));
		$pharmacy = ucfirst(trim($_POST['pharmacy']));

		$welfare = ucfirst(htmlspecialchars($_POST['welfare']));
		$welfare = ucfirst(stripslashes($_POST['welfare']));
		$welfare = ucfirst(trim($_POST['welfare']));

		$dothers = ucfirst(htmlspecialchars($_POST['dothers']));
		$dothers = ucfirst(stripslashes($_POST['dothers']));
		$dothers = ucfirst(trim($_POST['dothers']));

		$total_deductions = ucfirst(htmlspecialchars($_POST['total_deductions']));
		$total_deductions = ucfirst(stripslashes($_POST['total_deductions']));
		$total_deductions = ucfirst(trim($_POST['total_deductions']));

		$staff = ucfirst(htmlspecialchars($_POST['staff']));
		$staff = ucfirst(stripslashes($_POST['staff']));
		$staff = ucfirst(trim($_POST['staff']));

		$error = '';
		session_start();
		$id = $_SESSION['userSession'];
		$edit = $_POST['edit'];

		$validator = new FormValidator();
						
		$validator->addValidation("basic","req","Please Enter Basic Salary");
		$validator->addValidation("staff","req","Please Select A Staff");
									
		if($validator->ValidateForm()){
				$insert = Database::getInstance()->insert_edit_pay($basic,$housing,$hazard,$transport,$cduty,$feeding,$medicals,$pholiday,$others,$total_income,$paye,$pension,$loan,$thrift,$advance,$daycare,$pharmacy,$welfare,$dothers,$total_deductions,$staff,$id,$edit);
				if($insert == 'Done'){
					//Database::getInstance()->notify_pharm($p_id);
					echo '<div class="alert alert-success">
							Successful			
						</div>';
				} else {
					echo $insert;
				}
			
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function edit_Presc(){
	
		$diagnosis = ucfirst(htmlspecialchars($_POST['diagnosis']));
		$diagnosis = ucfirst(stripslashes($_POST['diagnosis']));
		$diagnosis = ucfirst(trim($_POST['diagnosis']));
		
		$pharm = ucfirst(htmlspecialchars($_POST['pharm']));
		$pharm = ucfirst(stripslashes($_POST['pharm']));
		$pharm = ucfirst(trim($_POST['pharm']));
		
		$dosage = ucfirst(htmlspecialchars($_POST['frequency']));
		$dosage = ucfirst(stripslashes($_POST['frequency']));
		$dosage = ucfirst(trim($_POST['frequency']));
		
		$tabs = ucfirst(htmlspecialchars($_POST['tabs']));
		$tabs = ucfirst(stripslashes($_POST['tabs']));
		$tabs = ucfirst(trim($_POST['tabs']));
		
		$instruction = ucfirst(htmlspecialchars($_POST['instruction']));
		$instruction = ucfirst(stripslashes($_POST['instruction']));
		$instruction = ucfirst(trim($_POST['instruction']));

		$quantity = ucfirst(htmlspecialchars($_POST['quantity']));
		$quantity = ucfirst(stripslashes($_POST['quantity']));
		$quantity = ucfirst(trim($_POST['quantity']));
		
		$duration = ucfirst(htmlspecialchars($_POST['duration']));
		$duration = ucfirst(stripslashes($_POST['duration']));
		$duration = ucfirst(trim($_POST['duration']));

		$sdosage = ucfirst(htmlspecialchars($_POST['sfrequency']));
		$sdosage = ucfirst(stripslashes($_POST['sfrequency']));
		$sdosage = ucfirst(trim($_POST['sfrequency']));
		
		$stabs = ucfirst(htmlspecialchars($_POST['stabs']));
		$stabs = ucfirst(stripslashes($_POST['stabs']));
		$stabs = ucfirst(trim($_POST['stabs']));

		$squantity = ucfirst(htmlspecialchars($_POST['squantity']));
		$squantity = ucfirst(stripslashes($_POST['squantity']));
		$squantity = ucfirst(trim($_POST['squantity']));
		
		$sduration = ucfirst(htmlspecialchars($_POST['sduration']));
		$sduration = ucfirst(stripslashes($_POST['sduration']));
		$sduration = ucfirst(trim($_POST['sduration']));

		$error = '';

		$id = $_POST['id'];
		$p = $_POST['p'];

		$validator = new FormValidator();
						
		$validator->addValidation("pharm","req","Please select drug");
									
		if($validator->ValidateForm()){
				
				//$amount = Database::getInstance()->get_name_from_id("price","pharm_stock","id",$pharm);
				$insert = Database::getInstance()->edit_presc_case($diagnosis,$pharm, $tabs,$dosage,$duration,$quantity,$instruction, $id,$stabs,$squantity,$sdosage,$sduration,$p);
				if($insert == 'Done'){
					//Database::getInstance()->notify_pharm($p_id);
					echo '<div class="alert alert-success">
							Successful					
						</div>';
				} else {
					echo $insert;
				}
			
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

function newPreCheckList(){
		$q1 = $_POST['q1'];
		$q2 = $_POST['q2'];
		$q3 = $_POST['q3'];
		$q4 = $_POST['q4'];
		$q5 = $_POST['q5'];
		$q6 = $_POST['q6'];
		$q7 = $_POST['q7'];
		$q8 = $_POST['q8'];
		$q9 = $_POST['q9'];
		$q10 = $_POST['q10'];
		$q11 = $_POST['q11'];
		$q12 = $_POST['q12'];
		$q13 = $_POST['q13'];
		$q14 = $_POST['q14'];
		$q15 = $_POST['q15'];
		$q16 = $_POST['q16'];
		$q17 = $_POST['q17'];
		
		$val = $_POST['id'];
		$doc = $_POST['doc_id'];
		$p_id = $_POST['pid'];
		
		$validator = new FormValidator();
						
		$validator->addValidation("doc_id","req","Please Login");
		$validator->addValidation("id","req","Please select Appointment");
							
		if($validator->ValidateForm()){
			

				echo $insert = Database::getInstance()->insert_precheck_list($q1, $q2, $q3, $q4, $q5, $q6, $q7, $q8, $q9, $q10, $q11, $q12, $q13, $q14, $q15, $q16, $q17,$val,$doc, $p_id);
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function requestAdmission(){
	
		
		$val = $_POST['val'];
		$doc = $_POST['doc_id'];
		$p_id = $_POST['p_id'];
		$ward = $_POST['ward'];
		
		$validator = new FormValidator();
						
		$validator->addValidation("doc_id","req","Please Login");
		$validator->addValidation("val","req","Please select Appointment");
							
		if($validator->ValidateForm()){
			

				echo $insert = Database::getInstance()->insert_admission_request($val,$doc, $p_id,$ward);
					$notify = Database::getInstance()->notify_nurse2($val,$doc,$p_id); 
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function request_physiotherapy(){
		$app = $_POST['app'];
		$staff = $_POST['staff'];
		$pid = $_POST['pid'];
		$front_desk = $_POST['front'];
		
		$validator = new FormValidator();
						
		$validator->addValidation("staff","req","Please Login");
		$validator->addValidation("app","req","No Appointment");
		$validator->addValidation("front","req","No Front Desk");
		$validator->addValidation("pid","req","No Patient");
							
		if($validator->ValidateForm()){
			

				echo $insert = Database::getInstance()->insert_physiotherapy_request($app,$staff,$pid,$front_desk);
					//$notify = Database::getInstance()->notify_nurse2($val,$doc,$p_id); 
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function therapyPlan(){
	
		
		$val = $_POST['val'];
		$app = $_POST['app'];
		$p_id = $_POST['patient'];
		$link = $_POST['link_ref'];
		$comment = $_POST['comment'];
		$validator = new FormValidator();
						
		$validator->addValidation("patient","req","Please Login");
		$validator->addValidation("val","req","Please select Appointment");
							
		if($validator->ValidateForm()){
			

				$insert = Database::getInstance()->insert_therapy_plan($val,$app,$p_id,$link,$comment);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Therapy Plan Was Successfully Added!
						</div>';
				} else {
					echo $insert;
				}
					//$notify = Database::getInstance()->notify_nurse2($val,$doc,$p_id); 
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newCompany(){
	
		
		$name = $_POST['name'];
		$addr = $_POST['address'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$branch = $_POST['branch'];
		$staff_no = $_POST['staff_no'];
		$validator = new FormValidator();
						
		$validator->addValidation("name","req","No Company Name Entered");
		$validator->addValidation("address","req","No Address Entered");
		$validator->addValidation("phone","req","No Phone Entered");
		$validator->addValidation("email","req","No Email Entered");
		$validator->addValidation("branch","req","No Branch Number Entered");
		$validator->addValidation("staff_no","req","No Staff  Number Entered");

							
		if($validator->ValidateForm()){
			

				$insert = Database::getInstance()->insert_company($name,$addr,$phone,$email,$branch,$staff_no);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Company Was Successfully Added!
						</div>';
				} else {
					echo $insert;
				}
					//$notify = Database::getInstance()->notify_nurse2($val,$doc,$p_id); 
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function therapyPlan_front(){
	
		
		$val = $_POST['val'];
		$app = $_POST['app'];
		$p_id = $_POST['patient'];
		$link = $_POST['link_ref'];
		$comment = $_POST['comment'];
		$validator = new FormValidator();
						
		$validator->addValidation("patient","req","Please Login");
		$validator->addValidation("val","req","Please select Appointment");
							
		if($validator->ValidateForm()){
			

				$insert = Database::getInstance()->insert_therapy_plan2($val,$app,$p_id,$link,$comment);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Therapy Plan Was Successfully Added!
						</div>';
				} else {
					echo $insert;
				}
					//$notify = Database::getInstance()->notify_nurse2($val,$doc,$p_id); 
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function update_therapyPlan(){
	
		
		$val = $_POST['edit'];
		$comment = $_POST['comment'];
		$validator = new FormValidator();
						
		$validator->addValidation("edit","req","Please Login");
		$validator->addValidation("comment","req","Please Enter Comment");
							
		if($validator->ValidateForm()){
			

				$insert = Database::getInstance()->edit_therapy_plan($val,$comment);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Therapy Plan Was Updated Successfully!
						</div>';
				} else {
					echo $insert;
				}
					//$notify = Database::getInstance()->notify_nurse2($val,$doc,$p_id); 
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}
	

	function newTestType(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim(ucfirst($_POST['name'])));
		
		$error = '';
		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please ENTER Lab Test Type");
									
		if($validator->ValidateForm()){
			if (EMPTY($name)) {
				$error ='Lab Test Type cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_test_type($name);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Lab Test Type Added
						</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newTreatment_i(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim(ucfirst($_POST['name'])));

		$fee = ucfirst(htmlspecialchars($_POST['fee']));
		$fee = ucfirst(stripslashes($_POST['fee']));
		$fee = ucfirst(trim(ucfirst($_POST['fee'])));
		$user = $_POST['val'];
		
		$error = '';
		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please ENTER Treatment Name");
		$validator->addValidation("fee","req","Please ENTER Treatment Fee");
									
		if($validator->ValidateForm()){
			if (EMPTY($name)) {
				$error ='Treatment Name cannot be empty';
			}
			if (EMPTY($fee)) {
				$error ='Treatment Fee cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_treatment_i($name,$fee,$user);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Treatment Added Successfully
						</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newTreatment(){
		$disease = ucfirst(htmlspecialchars($_POST['disease']));
		$disease = ucfirst(stripslashes($_POST['disease']));
		$disease = ucfirst(trim(ucfirst($_POST['disease'])));

		$date = ucfirst(htmlspecialchars($_POST['date']));
		$date = ucfirst(stripslashes($_POST['date']));
		$date = ucfirst(trim(ucfirst($_POST['date'])));

		$symptom = ucfirst(htmlspecialchars($_POST['symptom']));
		$symptom = ucfirst(stripslashes($_POST['symptom']));
		$symptom = ucfirst(trim(ucfirst($_POST['symptom'])));

		$note = ucfirst(htmlspecialchars($_POST['note']));
		$note = ucfirst(stripslashes($_POST['note']));
		$note = ucfirst(trim(ucfirst($_POST['note'])));

		$user = $_POST['val'];
		$ipd = $_POST['ipd'];
		$pid = $_POST['pid'];
		
		$error = '';
		$validator = new FormValidator();
						
		$validator->addValidation("disease","req","Please Choose Ailment / Disease");
		$validator->addValidation("date","req","Please Choose Date");
		$validator->addValidation("symptom","req","Please Enter Symptom");
									
		if($validator->ValidateForm()){
			if (EMPTY($disease)) {
				$error ='Disease cannot be empty';
			}

			if (EMPTY($date)) {
				$error ='Date cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_treatment($pid,$disease,$date,$symptom,$note,$ipd,$user);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Treatment Added Successfully
						</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function addBlabel(){
		$label = ucfirst(htmlspecialchars($_POST['label']));
		$label = ucfirst(stripslashes($_POST['label']));
		$label = ucfirst(trim(ucfirst($_POST['label'])));
		$id = $_POST['val'];
		$error = '';
		$validator = new FormValidator();
						
		$validator->addValidation("label","req","Please ENTER A Label");
									
		if($validator->ValidateForm()){
			if (EMPTY($label)) {
				$error ='Label cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				echo $insert = Database::getInstance()->insert_label($label,$id);
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function addBStatus(){
		$label = ucfirst(htmlspecialchars($_POST['status']));
		$label = ucfirst(stripslashes($_POST['status']));
		$label = ucfirst(trim(ucfirst($_POST['status'])));
		$id = $_POST['val'];
		$error = '';
		$validator = new FormValidator();
						
		$validator->addValidation("status","req","Please Select A Status");
									
		if($validator->ValidateForm()){
			if (EMPTY($label)) {
				$error ='Status cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				echo $insert = Database::getInstance()->insert_status($label,$id);
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newBloodGroup(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim(ucfirst($_POST['name'])));
		$val = $_POST['val'];
		$error = '';
		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please ENTER Blood Group");
									
		if($validator->ValidateForm()){
			if (EMPTY($name)) {
				$error ='Blood Group cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_blood_group($name,$val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Blood Group Added
						</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newSample(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim(ucfirst($_POST['name'])));
		$val = $_POST['val'];
		$error = '';
		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please ENTER Sample");
									
		if($validator->ValidateForm()){
			if (EMPTY($name)) {
				$error ='Sample cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_sample($name,$val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Sample Added
						</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newTGroup(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim(ucfirst($_POST['name'])));
		
		$error = '';
		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please ENTER Group title");
									
		if($validator->ValidateForm()){
			if (EMPTY($name)) {
				$error ='Group cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_tgroup($name);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Group Added
						</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newExpType(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim(ucfirst($_POST['name'])));
		$usr = $_POST['user'];
		$error = '';
		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please ENTER Expense Type");
									
		if($validator->ValidateForm()){
			if (EMPTY($name)) {
				$error ='Expense Type cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_exp_type($name,$usr);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Expense Type Added
						</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newIncomeType(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim(ucfirst($_POST['name'])));
		$usr = $_POST['user'];
		$error = '';
		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please ENTER Income Type");
									
		if($validator->ValidateForm()){
			if (EMPTY($name)) {
				$error ='Income Type cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_income_type($name,$usr);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Income Type Added
						</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}


	function newRevenueType(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim(ucfirst($_POST['name'])));

		$error = '';
		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please ENTER Revenue Type");
									
		if($validator->ValidateForm()){
			if (EMPTY($name)) {
				$error ='Revenue Type cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_revenue_type($name);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Revenue Type Added
						</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newCapFee(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim(ucfirst($_POST['name'])));
		
		$error = '';
		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please ENTER Amount");
									
		if($validator->ValidateForm()){
			if (EMPTY($name)) {
				$error ='Amount cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_cap_fee($name);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Amount  Added Successfully
						</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newTariff(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim(ucfirst($_POST['name'])));
		
		$error = '';
		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please Input A Tariff's Name");
									
		if($validator->ValidateForm()){
			if (EMPTY($name)) {
				$error ='Tariff Name cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_tariff($name);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Tariff Added
						</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newTariffClone(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim(ucfirst($_POST['name'])));

		$clone = $_POST['clone_me'];
		
		$error = '';
		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please Input A Tariff's Name");
									
		if($validator->ValidateForm()){
			if (EMPTY($name)) {
				$error ='Tariff Name cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->clone_tariff($name,$clone);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Tariff Added
						</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}
	
	function newCategory(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim(ucfirst($_POST['name'])));
		
		$error = '';
		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please ENTER Category");
									
		if($validator->ValidateForm()){
			if (EMPTY($name)) {
				$error ='Category cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_category($name);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Category Added
						</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newCategory1(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim(ucfirst($_POST['name'])));
		
		$error = '';
		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please ENTER Category");
									
		if($validator->ValidateForm()){
			if (EMPTY($name)) {
				$error ='Category cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_category1($name);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Category Added
						</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}
	
	function labRes(){
		
		$error = '';

		$app_id = $_POST['app_id'];
		$doc_id = $_POST['doc_id'];
		$p_id = $_POST['p_id'];
		$tech_id = $_POST['tech_id'];
				
		$test = $_POST['test'];
		$result = $_POST['result'];
		$flag = $_POST['flag'];
		$units = $_POST['units'];
		$ref = $_POST['ref'];
		$range = $_POST['range'];
		$mainArray = [
			$test, 
			$result, 
			$flag, 
			$units,
			$ref,
			$range
		];
		//all of thsi is done so each line of array will be for one line of input fields
		foreach( $test as $key => $n ) {
			$DataArr[] = ($n." ".$result[$key]." ".$flag[$key]." ".$units[$key]." ".$ref[$key]." ".$range[$key]);
		}

		$validator = new FormValidator();
									
		if($validator->ValidateForm()){
			

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_lab_res($DataArr,$doc_id, $app_id, $p_id, $tech_id);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Lab result sent successfully					
						</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}
	
	function newCat(){
		$cat_name = ucfirst(htmlspecialchars($_POST['cat_name']));
		$cat_name = ucfirst(stripslashes($_POST['cat_name']));
		$cat_name = ucfirst(trim($_POST['cat_name']));
		
		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("cat_name","req","Please enter name of category");
									
		if($validator->ValidateForm()){
			if (EMPTY($cat_name)) {
				$error ='Category cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_cat($cat_name);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Category entered successfully					
						</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newUnit(){
		$unit_name = ucfirst(htmlspecialchars($_POST['unit_name']));
		$unit_name = ucfirst(stripslashes($_POST['unit_name']));
		$unit_name = ucfirst(trim($_POST['unit_name']));
		
		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("unit_name","req","Please enter unit");
									
		if($validator->ValidateForm()){
			if (EMPTY($unit_name)) {
				$error ='Unit cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_unit($unit_name);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Unit entered successfully					
						</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newCUnit(){
		$unit_name = ucfirst(htmlspecialchars($_POST['unit_name']));
		$unit_name = ucfirst(stripslashes($_POST['unit_name']));
		$unit_name = ucfirst(trim($_POST['unit_name']));
		
		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("unit_name","req","Please enter unit");
									
		if($validator->ValidateForm()){
			if (EMPTY($unit_name)) {
				$error ='Unit cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_cunit($unit_name);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Unit entered successfully					
						</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}	
	function addDiagnosis(){
		$diagnosis = ucfirst(htmlspecialchars($_POST['diagnosis']));
		$diagnosis = ucfirst(stripslashes($_POST['diagnosis']));
		$diagnosis = ucfirst(trim($_POST['diagnosis']));
		
		$complaint = ucfirst(htmlspecialchars($_POST['complaint']));
		$complaint = ucfirst(stripslashes($_POST['complaint']));
		$complaint = ucfirst(trim($_POST['complaint']));
		
		$exam = ucfirst(htmlspecialchars($_POST['exam']));
		$exam = ucfirst(stripslashes($_POST['exam']));
		$exam = ucfirst(trim($_POST['exam']));
		
		$patients_note = ucfirst(htmlspecialchars($_POST['patients_note']));
		$patients_note = ucfirst(trim($_POST['patients_note']));
		$patients_note = str_replace("\n", "<br/>", $patients_note);

		$adm_note = ucfirst(htmlspecialchars($_POST['adm_note']));
		$adm_note = ucfirst(trim($_POST['adm_note']));
		$adm_note = str_replace("\n", "<br/>", $adm_note);

		$val = $_POST['val'];
		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("diagnosis","req","Please enter Diagnosis");
		$validator->addValidation("complaint","req","Please enter Complaint");
		$validator->addValidation("exam","req","Please enter Examinantion");
		
		if($validator->ValidateForm()){
			if (EMPTY($diagnosis)) {
				$error ='field cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_diagnosis($diagnosis,$complaint,$exam, $patients_note,$adm_note,$val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
						Doctor,s note entered successfully</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}
	
	function newAdminStock(){
		$stock = ucfirst(htmlspecialchars($_POST['stock']));
		$stock = ucfirst(stripslashes($_POST['stock']));
		$stock = ucfirst(trim($_POST['stock']));

		$quantity = ucfirst(htmlspecialchars($_POST['quantity']));
		$quantity = ucfirst(stripslashes($_POST['quantity']));
		$quantity = ucfirst(trim($_POST['quantity']));

		$taken = ucfirst(htmlspecialchars($_POST['taken']));
		$taken = ucfirst(stripslashes($_POST['taken']));
		$taken = ucfirst(trim($_POST['taken']));
		
		$patient = ucfirst(htmlspecialchars($_POST['patient']));
		$patient = ucfirst(stripslashes($_POST['patient']));
		$patient = ucfirst(trim($_POST['patient']));

		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("stock","req","Please select Stock");
		$validator->addValidation("quantity","req","Please enter quantity");
		$validator->addValidation("taken","req","Please enter Taken By");
		$validator->addValidation("patient","req","Please Select Patient");
		
		if($validator->ValidateForm()){
			$quantityBefore = Database::getInstance()->get_name_from_id('stock','pharm_stock','id',$stock);
			$quantityLeft = $quantityBefore - $quantity;
			if (EMPTY($stock)) {
				$error ='Stock cannot be empty';
			}

			if (EMPTY($patient)) {
				$error ='Patient cannot be empty';
			}
			
			if (EMPTY($quantity)) {
				$error ='Quantity cannot be empty';
			}

			if (EMPTY($taken)) {
				$error ='Taken By cannot be empty';
			}
			
			if ($quantityLeft < 0) {
				$error ='Stock is not enough for the quantity required';
			}
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				
				$insert = Database::getInstance()->insert_admin_stock($stock, $quantity, $taken, $patient, $quantityLeft);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Stock Removed successfully					
						</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	
	function newStock(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim($_POST['name']));

		$cat = ucfirst(htmlspecialchars($_POST['cat']));
		$cat = ucfirst(stripslashes($_POST['cat']));
		$cat = ucfirst(trim($_POST['cat']));

		$unit = ucfirst(htmlspecialchars($_POST['unit']));
		$unit = ucfirst(stripslashes($_POST['unit']));
		$unit = ucfirst(trim($_POST['unit']));

		$cprice = ucfirst(htmlspecialchars($_POST['cost']));
		$cprice = ucfirst(stripslashes($_POST['cost']));
		$cprice = ucfirst(trim($_POST['cost']));

		$price = ucfirst(htmlspecialchars($_POST['price']));
		$price = ucfirst(stripslashes($_POST['price']));
		$price = ucfirst(trim($_POST['price']));

		$stock = ucfirst(htmlspecialchars($_POST['stock']));
		$stock = ucfirst(stripslashes($_POST['stock']));
		$stock = ucfirst(trim($_POST['stock']));
		
		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please enter name of item");
		$validator->addValidation("cat","req","Please enter cat of item");
		$validator->addValidation("unit","req","Please enter unit of item");
		$validator->addValidation("cost","req","Please enter cost price of item");
		$validator->addValidation("price","req","Please enter price of item");
		$validator->addValidation("stock","req","Please enter stock of item");
									
		if($validator->ValidateForm()){
			if (EMPTY($name)) {
				$error ='Name cannot be empty';
			}

			if (EMPTY($cat)) {
				$error ='Category cannot be empty';
			}

			if (EMPTY($unit)) {
				$error ='Unit cannot be empty';
			}

			if (EMPTY($price)) {
				$error ='Price cannot be empty';
			}

			if (EMPTY($stock)) {
				$error ='Stock cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_stock($name, $cat,$unit,$cprice, $price, $stock);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Stock entered successfully					
						</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newCStock(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim($_POST['name']));

		$manufactured = ucfirst(htmlspecialchars($_POST['manufactured']));
		$manufactured = ucfirst(stripslashes($_POST['manufactured']));
		$manufactured = ucfirst(trim($_POST['manufactured']));

		$exp = ucfirst(htmlspecialchars($_POST['expiring']));
		$exp = ucfirst(stripslashes($_POST['expiring']));
		$exp = ucfirst(trim($_POST['expiring']));		

		$unit = ucfirst(htmlspecialchars($_POST['unit']));
		$unit = ucfirst(stripslashes($_POST['unit']));
		$unit = ucfirst(trim($_POST['unit']));

		$cprice = ucfirst(htmlspecialchars($_POST['cost']));
		$cprice = ucfirst(stripslashes($_POST['cost']));
		$cprice = ucfirst(trim($_POST['cost']));

		$price = ucfirst(htmlspecialchars($_POST['price']));
		$price = ucfirst(stripslashes($_POST['price']));
		$price = ucfirst(trim($_POST['price']));

		$quantity = ucfirst(htmlspecialchars($_POST['quantity']));
		$quantity = ucfirst(stripslashes($_POST['quantity']));
		$quantity = ucfirst(trim($_POST['quantity']));

		$batch = ucfirst(htmlspecialchars($_POST['batch']));
		$batch = ucfirst(stripslashes($_POST['batch']));
		$batch = ucfirst(trim($_POST['batch']));

		$stock = ucfirst(htmlspecialchars($_POST['stock_code']));
		$stock = ucfirst(stripslashes($_POST['stock_code']));
		$stock = ucfirst(trim($_POST['stock_code']));


		
		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please enter name of item");
		$validator->addValidation("unit","req","Please enter unit of item");
		$validator->addValidation("cost","req","Please enter cost price of item");
		$validator->addValidation("price","req","Please enter price of item");
		$validator->addValidation("stock_code","req","Please enter Stock Code / Barcode of item");
									
		if($validator->ValidateForm()){
			if (EMPTY($name)) {
				$error ='Name cannot be empty';
			}

			if (EMPTY($unit)) {
				$error ='Unit cannot be empty';
			}

			if (EMPTY($price)) {
				$error ='Price cannot be empty';
			}

			if (EMPTY($stock)) {
				$error ='Stock cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_cstock($name,$manufactured,$exp,$unit,$cprice, $price,$quantity,$batch, $stock);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Stock entered successfully					
						</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function get_price(){			
		$proName = lcfirst(htmlspecialchars($_POST['proName']));
		$proName = lcfirst(stripslashes($_POST['proName']));
		$proName = lcfirst(trim($_POST['proName']));

		$proQty = lcfirst(htmlspecialchars($_POST['proQty']));
		$proQty = lcfirst(stripslashes($_POST['proQty']));
		$proQty = lcfirst(trim($_POST['proQty']));
		
				
		$error = '';

		Database::getInstance()->get_the_price($proName, $proQty);	
	}

	function sendToAcc(){
		$app_id = $_POST['app_id'];
		$p_id = $_POST['p_id'];
		$code = rand(1000,100000);

		$name = $_POST['name'];
		$qty = $_POST['qty'];
		$intake = $_POST['intake'];
		$duration = $_POST['duration'];
		$price = $_POST['price'];
		$mainArray = [
			$name, 
			$qty, 
			$intake, 
			$duration,
			$price
		];
		
		foreach( $name as $key => $n ) {
			$DataArr[] = ($n." ".$qty[$key]." ".$intake[$key]." ".$duration[$key]." ".$price[$key]);
		}

		
		$error = '';

		$validator = new FormValidator();
							
		if($validator->ValidateForm()){
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->send_acc($DataArr, $app_id, $p_id, $code);
				echo $insert;
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function changeOrderStatus(){			
		$status = htmlspecialchars($_POST['selected']);
		$status = stripslashes($_POST['selected']);
		$status = $_POST['selected'];
		
		$app_id = $_POST['app_id'];
		
		$patient_id = $_POST['patient_id'];

		$order_id = $_POST['order_id'];

		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("selected","req","Please pick a status");
		
		if($validator->ValidateForm()){
			
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->change_status($status, $app_id, $patient_id, $order_id);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Payment status updated
						</div>';
					}else{
						echo $insert;
					}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					' . $inp_err . '
				</div>';
			}
		}
	}

	function sendTestAcc(){
		
		$app_id = $_POST['app_id'];
		$p_id = $_POST['p_id'];

		$code = rand(1000,100000);

		$test = $_POST['test'];
		$amt = $_POST['amt'];
		$mainArray = [
			$test, 
			$amt
		];
		
		foreach( $test as $key => $n ) {
			$DataArr[] = ($n." ".$amt[$key]);
		}

		
		$error = '';

		$validator = new FormValidator();
					
		if($validator->ValidateForm()){
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->send_test_acc($DataArr, $app_id, $p_id, $code);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Successful					
						</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newTax(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim($_POST['name']));
		
		$percentage = lcfirst(htmlspecialchars($_POST['percentage']));
		$percentage = lcfirst(stripslashes($_POST['percentage']));
		$percentage = lcfirst(trim($_POST['percentage']));
		
		
		$status = htmlspecialchars($_POST['status']);
		$status = stripslashes($_POST['status']);
		$status = trim($_POST['status']);
		
		$user = $_POST['val'];

		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please fill in Tax Name");
		$validator->addValidation("percentage","req","Please fill in a Percentage");
									
		if($validator->ValidateForm()){
						
			if (EMPTY($name)) {
				$error ='Tax Name cannot be empty';
			}
			
			if (EMPTY($percentage)) {
				$error ='Percentage cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_tax($name,$percentage,$status,$user);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
						Tax added successfully					
					</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}
	
	function newIPDF(){
		$company = ucfirst(htmlspecialchars($_POST['company']));
		$company = ucfirst(stripslashes($_POST['company']));
		$company = ucfirst(trim($_POST['company']));

		$breakfast = ucfirst(htmlspecialchars($_POST['breakfast']));
		$breakfast = ucfirst(stripslashes($_POST['breakfast']));
		$breakfast = ucfirst(trim($_POST['breakfast']));

		$lunch = ucfirst(htmlspecialchars($_POST['lunch']));
		$lunch = ucfirst(stripslashes($_POST['lunch']));
		$lunch = ucfirst(trim($_POST['lunch']));

		$dinner = ucfirst(htmlspecialchars($_POST['dinner']));
		$dinner = ucfirst(stripslashes($_POST['dinner']));
		$dinner = ucfirst(trim($_POST['dinner']));

		$amount = ucfirst(htmlspecialchars($_POST['amount']));
		$amount = ucfirst(stripslashes($_POST['amount']));
		$amount = ucfirst(trim($_POST['amount']));
		
		$error = '';
		$val = $_POST['val'];

		$validator = new FormValidator();
						
		$validator->addValidation("company","req","Please enter name of Company");
		$validator->addValidation("breakfast","req","Please enter Breakfast");
		$validator->addValidation("lunch","req","Please enter Lunch");
		$validator->addValidation("dinner","req","Please enter Dinner");
		$validator->addValidation("amount","req","Please enter Amount");
									
		if($validator->ValidateForm()){
			
				$insert = Database::getInstance()->insert_ipdf($company, $breakfast, $lunch, $dinner, $amount, $val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Food entered successfully					
						</div>';
				} else {
					echo $insert;
				}

		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}
	
	function newObs(){
		$temp = ucfirst(htmlspecialchars($_POST['temp']));
		$temp = ucfirst(stripslashes($_POST['temp']));
		$temp = ucfirst(trim($_POST['temp']));

		$resr = ucfirst(htmlspecialchars($_POST['resr']));
		$resr = ucfirst(stripslashes($_POST['resr']));
		$resr = ucfirst(trim($_POST['resr']));

		$pulse = ucfirst(htmlspecialchars($_POST['pulse']));
		$pulse = ucfirst(stripslashes($_POST['pulse']));
		$pulse = ucfirst(trim($_POST['pulse']));

		$bp = ucfirst(htmlspecialchars($_POST['bp']));
		$bp = ucfirst(stripslashes($_POST['bp']));
		$bp = ucfirst(trim($_POST['bp']));

		$intake = ucfirst(htmlspecialchars($_POST['intake']));
		$intake = ucfirst(stripslashes($_POST['intake']));
		$intake = ucfirst(trim($_POST['intake']));
		
		$output = ucfirst(htmlspecialchars($_POST['output']));
		$output = ucfirst(stripslashes($_POST['output']));
		$output = ucfirst(trim($_POST['output']));
		
		$error = '';
		$by = $_POST['by'];
		$ipd = $_POST['ipid'];

		$validator = new FormValidator();
						
		$validator->addValidation("temp","req","Please enter Temp");
		$validator->addValidation("resr","req","Please enter Resr");
		$validator->addValidation("pulse","req","Please enter Pulse");
		$validator->addValidation("bp","req","Please enter BP");
		$validator->addValidation("intake","req","Please enter Intake");
		$validator->addValidation("output","req","Please enter Output");
		$validator->addValidation("by","req","Please Login");
		$validator->addValidation("ipid","req","Please select a patient");
									
		if($validator->ValidateForm()){
			
				$insert = Database::getInstance()->insert_obs($temp, $resr, $pulse, $bp, $intake, $output, $by, $ipd);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Observation sent					
						</div>';
				} else {
					echo $insert;
				}

		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					 ' . $inp_err . '
				</div>';
			}
		}
	}

	function newLabour(){
		$surname = ucfirst(htmlspecialchars($_POST['surname']));
		$surname = ucfirst(stripslashes($_POST['surname']));
		$surname = ucfirst(trim($_POST['surname']));

		$fname = ucfirst(htmlspecialchars($_POST['fname']));
		$fname = ucfirst(stripslashes($_POST['fname']));
		$fname = ucfirst(trim($_POST['fname']));

		$par = ucfirst(htmlspecialchars($_POST['par']));
		$par = ucfirst(stripslashes($_POST['par']));
		$par = ucfirst(trim($_POST['par']));

		$hn = ucfirst(htmlspecialchars($_POST['hn']));
		$hn = ucfirst(stripslashes($_POST['hn']));
		$hn = ucfirst(trim($_POST['hn']));

		$age = ucfirst(htmlspecialchars($_POST['age']));
		$age = ucfirst(stripslashes($_POST['age']));
		$age = ucfirst(trim($_POST['age']));
		
		$nlc = ucfirst(htmlspecialchars($_POST['nlc']));
		$nlc = ucfirst(stripslashes($_POST['nlc']));
		$nlc = ucfirst(trim($_POST['nlc']));

		$poh = ucfirst(htmlspecialchars($_POST['poh']));
		$poh = ucfirst(stripslashes($_POST['poh']));
		$poh = ucfirst(trim($_POST['poh']));

		$lmp = ucfirst(htmlspecialchars($_POST['lmp']));
		$lmp = ucfirst(stripslashes($_POST['lmp']));
		$lmp = ucfirst(trim($_POST['lmp']));

		$edd = ucfirst(htmlspecialchars($_POST['edd']));
		$edd = ucfirst(stripslashes($_POST['edd']));
		$edd = ucfirst(trim($_POST['edd']));

		$ah = ucfirst(htmlspecialchars($_POST['ah']));
		$ah = ucfirst(stripslashes($_POST['ah']));
		$ah = ucfirst(trim($_POST['ah']));

		$onset = ucfirst(htmlspecialchars($_POST['onset']));
		$onset = ucfirst(stripslashes($_POST['onset']));
		$onset = ucfirst(trim($_POST['onset']));

		$h = ucfirst(htmlspecialchars($_POST['h']));
		$h = ucfirst(stripslashes($_POST['h']));
		$h = ucfirst(trim($_POST['h']));

		$state = ucfirst(htmlspecialchars($_POST['state']));
		$state = ucfirst(stripslashes($_POST['state']));
		$state = ucfirst(trim($_POST['state']));

		$mrh = ucfirst(htmlspecialchars($_POST['mrh']));
		$mrh = ucfirst(stripslashes($_POST['mrh']));
		$mrh = ucfirst(trim($_POST['mrh']));

		$amni = ucfirst(htmlspecialchars($_POST['amni']));
		$amni = ucfirst(stripslashes($_POST['amni']));
		$amni = ucfirst(trim($_POST['amni']));

		$cont = ucfirst(htmlspecialchars($_POST['cont']));
		$cont = ucfirst(stripslashes($_POST['cont']));
		$cont = ucfirst(trim($_POST['cont']));

		$oxi = ucfirst(htmlspecialchars($_POST['oxi']));
		$oxi = ucfirst(stripslashes($_POST['oxi']));
		$oxi = ucfirst(trim($_POST['oxi']));

		$condition = ucfirst(htmlspecialchars($_POST['condition']));
		$condition = ucfirst(stripslashes($_POST['condition']));
		$condition = ucfirst(trim($_POST['condition']));

		$fh = ucfirst(htmlspecialchars($_POST['fh']));
		$fh = ucfirst(stripslashes($_POST['fh']));
		$fh = ucfirst(trim($_POST['fh']));

		$type = ucfirst(htmlspecialchars($_POST['type']));
		$type = ucfirst(stripslashes($_POST['type']));
		$type = ucfirst(trim($_POST['type']));

		$lie = ucfirst(htmlspecialchars($_POST['lie']));
		$lie = ucfirst(stripslashes($_POST['lie']));
		$lie = ucfirst(trim($_POST['lie']));

		$pres = ucfirst(htmlspecialchars($_POST['pres']));
		$pres = ucfirst(stripslashes($_POST['pres']));
		$pres = ucfirst(trim($_POST['pres']));

		$pos = ucfirst(htmlspecialchars($_POST['pos']));
		$pos = ucfirst(stripslashes($_POST['pos']));
		$pos = ucfirst(trim($_POST['pos']));

		$desc = ucfirst(htmlspecialchars($_POST['desc']));
		$desc = ucfirst(stripslashes($_POST['desc']));
		$desc = ucfirst(trim($_POST['desc']));

		$fhr = ucfirst(htmlspecialchars($_POST['fhr']));
		$fhr = ucfirst(stripslashes($_POST['fhr']));
		$fhr = ucfirst(trim($_POST['fhr']));

		$vul = ucfirst(htmlspecialchars($_POST['vul']));
		$vul = ucfirst(stripslashes($_POST['vul']));
		$vul = ucfirst(trim($_POST['vul']));

		$vag = ucfirst(htmlspecialchars($_POST['vag']));
		$vag = ucfirst(stripslashes($_POST['vag']));
		$vag = ucfirst(trim($_POST['vag']));

		$cer = ucfirst(htmlspecialchars($_POST['cer']));
		$cer = ucfirst(stripslashes($_POST['cer']));
		$cer = ucfirst(trim($_POST['cer']));

		$pp = ucfirst(htmlspecialchars($_POST['pp']));
		$pp = ucfirst(stripslashes($_POST['pp']));
		$pp = ucfirst(trim($_POST['pp']));

		$os = ucfirst(htmlspecialchars($_POST['os']));
		$os = ucfirst(stripslashes($_POST['os']));
		$os = ucfirst(trim($_POST['os']));

		$rup = ucfirst(htmlspecialchars($_POST['rup']));
		$rup = ucfirst(stripslashes($_POST['rup']));
		$rup = ucfirst(trim($_POST['rup']));

		$int = ucfirst(htmlspecialchars($_POST['int']));
		$int = ucfirst(stripslashes($_POST['int']));
		$int = ucfirst(trim($_POST['int']));

		$ppo = ucfirst(htmlspecialchars($_POST['ppo']));
		$ppo = ucfirst(stripslashes($_POST['ppo']));
		$ppo = ucfirst(trim($_POST['ppo']));

		$ip = ucfirst(htmlspecialchars($_POST['ip']));
		$ip = ucfirst(stripslashes($_POST['ip']));
		$ip = ucfirst(trim($_POST['ip']));

		$cap = ucfirst(htmlspecialchars($_POST['cap']));
		$cap = ucfirst(stripslashes($_POST['cap']));
		$cap = ucfirst(trim($_POST['cap']));

		$mould = ucfirst(htmlspecialchars($_POST['mould']));
		$mould = ucfirst(stripslashes($_POST['mould']));
		$mould = ucfirst(trim($_POST['mould']));

		$pap = ucfirst(htmlspecialchars($_POST['pap']));
		$pap = ucfirst(stripslashes($_POST['pap']));
		$pap = ucfirst(trim($_POST['pap']));

		$psc = ucfirst(htmlspecialchars($_POST['psc']));
		$psc = ucfirst(stripslashes($_POST['psc']));
		$psc = ucfirst(trim($_POST['psc']));

		$f = ucfirst(htmlspecialchars($_POST['f']));
		$f = ucfirst(stripslashes($_POST['f']));
		$f = ucfirst(trim($_POST['f']));

		$is = ucfirst(htmlspecialchars($_POST['is']));
		$is = ucfirst(stripslashes($_POST['is']));
		$is = ucfirst(trim($_POST['is']));

		$nurse = $_POST['by'];
		
		$error = '';
		$by = $_POST['by'];
		$ipd = $_POST['ipid'];

		$validator = new FormValidator();
						
		$validator->addValidation("surname","req","Please enter Surname");
		$validator->addValidation("fname","req","Please enter First Name");
		$validator->addValidation("by","req","Please Login");
									
		if($validator->ValidateForm()){
			
				$insert = Database::getInstance()->insert_labour($surname,$fname,$par,$hn,$age,$nlc,$poh,$lmp,$edd,$ah,$onset,$h,$state,$mrh,$amni,$cont,$oxi,$condition,$fh,$type,$lie,$pres,$pos,$desc,$fhr,$vul,$vag,$cer,$pp,$os,$rup,$int,$ppo,$ip,$cap,$mould,$pap,$psc,$f,$is,$nurse);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Labour Record Created					
						</div>';
				} else {
					echo $insert;
				}

		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					 ' . $inp_err . '
				</div>';
			}
		}
	}

	function newAnteNote(){
		$dob = ucfirst(htmlspecialchars($_POST['dob']));
		$dob = ucfirst(stripslashes($_POST['dob']));
		$dob = ucfirst(trim($_POST['dob']));

		$duration = ucfirst(htmlspecialchars($_POST['duration']));
		$duration = ucfirst(stripslashes($_POST['duration']));
		$duration = ucfirst(trim($_POST['duration']));

		$weight = ucfirst(htmlspecialchars($_POST['weight']));
		$weight = ucfirst(stripslashes($_POST['weight']));
		$weight = ucfirst(trim($_POST['weight']));

		$cp = ucfirst(htmlspecialchars($_POST['cp']));
		$cp = ucfirst(stripslashes($_POST['cp']));
		$cp = ucfirst(trim($_POST['cp']));

		$cl = ucfirst(htmlspecialchars($_POST['cl']));
		$cl = ucfirst(stripslashes($_POST['cl']));
		$cl = ucfirst(trim($_POST['cl']));

		$puerperium = ucfirst(htmlspecialchars($_POST['puerperium']));
		$puerperium = ucfirst(stripslashes($_POST['puerperium']));
		$puerperium = ucfirst(trim($_POST['puerperium']));
		
		$death_age = ucfirst(htmlspecialchars($_POST['death_age']));
		$death_age = ucfirst(stripslashes($_POST['death_age']));
		$death_age = ucfirst(trim($_POST['death_age']));

		$cod = ucfirst(htmlspecialchars($_POST['cod']));
		$cod = ucfirst(stripslashes($_POST['cod']));
		$cod = ucfirst(trim($_POST['cod']));
		
		$error = '';
		$by = $_POST['by'];
		$id = $_POST['id'];

		$validator = new FormValidator();
						
		$validator->addValidation("dob","req","Please enter Date Of Birth");
		$validator->addValidation("by","req","Please Login");
		$validator->addValidation("id","req","Please select a patient");
									
		if($validator->ValidateForm()){
			
				$insert = Database::getInstance()->insert_anteNote($dob,$duration,$weight,$cp,$cl,$puerperium,$death_age,$cod, $by, $id);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Note Added					
						</div>';
				} else {
					echo $insert;
				}

		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					 ' . $inp_err . '
				</div>';
			}
		}
	}


	function newAnteRecord(){
		$ega = ucfirst(htmlspecialchars($_POST['ega']));
		$ega = ucfirst(stripslashes($_POST['ega']));
		$ega = ucfirst(trim($_POST['ega']));

		$sfh = ucfirst(htmlspecialchars($_POST['sfh']));
		$sfh = ucfirst(stripslashes($_POST['sfh']));
		$sfh = ucfirst(trim($_POST['sfh']));

		$pres = ucfirst(htmlspecialchars($_POST['pres']));
		$pres = ucfirst(stripslashes($_POST['pres']));
		$pres = ucfirst(trim($_POST['pres']));

		$pos = ucfirst(htmlspecialchars($_POST['pos']));
		$pos = ucfirst(stripslashes($_POST['pos']));
		$pos = ucfirst(trim($_POST['pos']));

		$fh = ucfirst(htmlspecialchars($_POST['fh']));
		$fh = ucfirst(stripslashes($_POST['fh']));
		$fh = ucfirst(trim($_POST['fh']));

		$o = ucfirst(htmlspecialchars($_POST['o']));
		$o = ucfirst(stripslashes($_POST['o']));
		$o = ucfirst(trim($_POST['o']));
		
		$u = ucfirst(htmlspecialchars($_POST['u']));
		$u = ucfirst(stripslashes($_POST['u']));
		$u = ucfirst(trim($_POST['u']));

		$p = ucfirst(htmlspecialchars($_POST['p']));
		$p = ucfirst(stripslashes($_POST['p']));
		$p = ucfirst(trim($_POST['p']));
		
		$w = ucfirst(htmlspecialchars($_POST['w']));
		$w = ucfirst(stripslashes($_POST['w']));
		$w = ucfirst(trim($_POST['w']));

		$bp = ucfirst(htmlspecialchars($_POST['bp']));
		$bp = ucfirst(stripslashes($_POST['bp']));
		$bp = ucfirst(trim($_POST['bp']));

		$error = '';
		$by = $_POST['by'];
		$id = $_POST['id'];

		$validator = new FormValidator();
						
		$validator->addValidation("by","req","Please Login");
		$validator->addValidation("id","req","Please select a patient");
									
		if($validator->ValidateForm()){
			
				$insert = database::getInstance()->insert_anteRecord($ega,$sfh,$pres,$pos,$fh,$o,$u,$p,$w,$bp,$by,$id);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Record Added					
						</div>';
				} else {
					echo $insert;
				}

		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					 ' . $inp_err . '
				</div>';
			}
		}
	}

	function newDis(){
		$pharm = ucfirst(htmlspecialchars($_POST['pharm']));
		$pharm = ucfirst(stripslashes($_POST['pharm']));
		$pharm = ucfirst(trim($_POST['pharm']));

		$dosage = ucfirst(htmlspecialchars($_POST['dosage']));
		$dosage = ucfirst(stripslashes($_POST['dosage']));
		$dosage = ucfirst(trim($_POST['dosage']));

		$meth = ucfirst(htmlspecialchars($_POST['meth']));
		$meth = ucfirst(stripslashes($_POST['meth']));
		$meth = ucfirst(trim($_POST['meth']));

		$remark = ucfirst(htmlspecialchars($_POST['remark']));
		$remark = ucfirst(stripslashes($_POST['remark']));
		$remark = ucfirst(trim($_POST['remark']));

		$error = '';
		$by = $_POST['by'];
		$ipd = $_POST['ipid'];

		$validator = new FormValidator();
						
		$validator->addValidation("pharm","req","Please select drug");
		$validator->addValidation("dosage","req","Please enter dosage");
		$validator->addValidation("meth","req","Please enter Method Of Administration");
		$validator->addValidation("by","req","Please Login");
		$validator->addValidation("ipid","req","Please select a patient");
									
		if($validator->ValidateForm()){
			
				$insert = Database::getInstance()->insert_dis($pharm, $dosage, $meth, $remark, $by, $ipd);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Dispensing chart sent					
						</div>';
				} else {
					echo $insert;
				}

		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					 ' . $inp_err . '
				</div>';
			}
		}
	}

	function newFluid(){
		$nature = ucfirst(htmlspecialchars($_POST['nature']));
		$nature = ucfirst(stripslashes($_POST['nature']));
		$nature = ucfirst(trim($_POST['nature']));

		$oral = ucfirst(htmlspecialchars($_POST['oral']));
		$oral = ucfirst(stripslashes($_POST['oral']));
		$oral = ucfirst(trim($_POST['oral']));

		$rectal = ucfirst(htmlspecialchars($_POST['rectal']));
		$rectal = ucfirst(stripslashes($_POST['rectal']));
		$rectal = ucfirst(trim($_POST['rectal']));

		$iv = ucfirst(htmlspecialchars($_POST['iv']));
		$iv = ucfirst(stripslashes($_POST['iv']));
		$iv = ucfirst(trim($_POST['iv']));
		
		$other1 = ucfirst(htmlspecialchars($_POST['other1']));
		$other1 = ucfirst(stripslashes($_POST['other1']));
		$other1 = ucfirst(trim($_POST['other1']));
		
		$total1 = ucfirst(htmlspecialchars($_POST['total1']));
		$total1 = ucfirst(stripslashes($_POST['total1']));
		$total1 = ucfirst(trim($_POST['total1']));
		
		$urine = ucfirst(htmlspecialchars($_POST['urine']));
		$urine = ucfirst(stripslashes($_POST['urine']));
		$urine = ucfirst(trim($_POST['urine']));
		
		$vomit = ucfirst(htmlspecialchars($_POST['vomit']));
		$vomit = ucfirst(stripslashes($_POST['vomit']));
		$vomit = ucfirst(trim($_POST['vomit']));
		
		$tube = ucfirst(htmlspecialchars($_POST['tube']));
		$tube = ucfirst(stripslashes($_POST['tube']));
		$tube = ucfirst(trim($_POST['tube']));
		
		$other2 = ucfirst(htmlspecialchars($_POST['other2']));
		$other2 = ucfirst(stripslashes($_POST['other2']));
		$other2 = ucfirst(trim($_POST['other2']));
		
		$total2 = ucfirst(htmlspecialchars($_POST['total2']));
		$total2 = ucfirst(stripslashes($_POST['total2']));
		$total2 = ucfirst(trim($_POST['total2']));
		
		$balance = ucfirst(htmlspecialchars($_POST['balance']));
		$balance = ucfirst(stripslashes($_POST['balance']));
		$balance = ucfirst(trim($_POST['balance']));
		
		$chloride = ucfirst(htmlspecialchars($_POST['chloride']));
		$chloride = ucfirst(stripslashes($_POST['chloride']));
		$chloride = ucfirst(trim($_POST['chloride']));

		$error = '';
		$ipd = $_POST['ipid'];

		$validator = new FormValidator();
						
		$validator->addValidation("nature","req","Please enter Nature Of Fluid");
		$validator->addValidation("oral","req","Please enter Oral");
		$validator->addValidation("rectal","req","Please enter Rectal");
		$validator->addValidation("iv","req","Please enter IV");
		$validator->addValidation("other1","req","Please enter Intake Other Routes");
		$validator->addValidation("total1","req","Please enter Intake Total");
		$validator->addValidation("urine","req","Please enter Urine");
		$validator->addValidation("vomit","req","Please enter Vomit");
		$validator->addValidation("tube","req","Please enter Tube");
		$validator->addValidation("other2","req","Please enter Output Other Routes");
		$validator->addValidation("total2","req","Please enter Output Total");
		$validator->addValidation("balance","req","Please enter Balance");
		$validator->addValidation("chloride","req","Please enter Chloride in Urine");
		$validator->addValidation("ipid","req","Please select a patient");
									
		if($validator->ValidateForm()){
			
				$insert = Database::getInstance()->insert_fluid($nature, $oral, $rectal, $iv, $other1, $total1, $urine, $vomit, $tube, $other2, $total2, $balance, $chloride, $ipd);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Fluid Chart sent					
						</div>';
				} else {
					echo $insert;
				}

		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					 ' . $inp_err . '
				</div>';
			}
		}
	}
	
	function newSurgery(){
		$sur_name = ucfirst(htmlspecialchars($_POST['sur_name']));
		$sur_name = ucfirst(stripslashes($_POST['sur_name']));
		$sur_name = ucfirst(trim($_POST['sur_name']));

		$sur_date = htmlspecialchars($_POST['sur_date']);
		$sur_date = stripslashes($_POST['sur_date']);
		$sur_date = trim($_POST['sur_date']);

		$sur_time = ucfirst(htmlspecialchars($_POST['sur_time']));
		$sur_time = ucfirst(stripslashes($_POST['sur_time']));
		$sur_time = ucfirst(trim($_POST['sur_time']));

		$sur_remark = ucfirst(htmlspecialchars($_POST['sur_remark']));
		$sur_remark = ucfirst(stripslashes($_POST['sur_remark']));
		$sur_remark = ucfirst(trim($_POST['sur_remark']));

		$patient = $_POST['patient'];
		$doc = $_POST['doc'];

		$validator = new FormValidator();
						
		$validator->addValidation("patient","req","No Patient Indicated");
		$validator->addValidation("sur_name","req","Please enter Surgery Name/Title");
		$validator->addValidation("sur_date","req","Please enter Surgery Date");
		$validator->addValidation("sur_time","req","Please enter Surgery Time");
		$validator->addValidation("sur_remark","req","Please enter Surgery Remark");
									
		if($validator->ValidateForm()){
			
				$insert = Database::getInstance()->insert_surgery($sur_name,$sur_date,$sur_time,$sur_remark, $patient, $doc);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Sugery Request Sent					
						</div>';
				} else {
					echo $insert;
				}

		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					 ' . $inp_err . '
				</div>';
			}
		}
	}

	
	function newIPD(){
		$admin_no = ucfirst(htmlspecialchars($_POST['admin_no']));
		$admin_no = ucfirst(stripslashes($_POST['admin_no']));
		$admin_no = ucfirst(trim($_POST['admin_no']));
		
		$referred = ucfirst(htmlspecialchars($_POST['referred']));
		$referred = ucfirst(stripslashes($_POST['referred']));
		$referred = ucfirst(trim($_POST['referred']));
		
		$doctor = ucfirst(htmlspecialchars($_POST['doctor']));
		$doctor = ucfirst(stripslashes($_POST['doctor']));
		$doctor = ucfirst(trim($_POST['doctor']));
		
		$ward = htmlspecialchars($_POST['ward']);
		$ward = stripslashes($_POST['ward']);
		$ward = trim($_POST['ward']);

		$bed_num = htmlspecialchars($_POST['bed_num']);
		$bed_num = stripslashes($_POST['bed_num']);
		$bed_num = trim($_POST['bed_num']);

		$p_id = trim($_POST['p_id']);
		$adr = trim($_POST['adr']);
		$code = rand(1000,100000);

		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("admin_no","req","Please fill in admission number");
		$validator->addValidation("referred","req","Please fill in referral");
		$validator->addValidation("doctor","req","Please fill in doctor");
		$validator->addValidation("ward","req","Please fill in ward");
		$validator->addValidation("bed_num","req","Please fill in bed number");	
		if($validator->ValidateForm()){
									
													
			if (EMPTY($admin_no)) {
				$error ='Admission number cannot be empty';
			}
			
			if (EMPTY($referred)) {
				$error ='Referral cannot be empty';
			}
			
			if (EMPTY($doctor)) {
				$error ='Doctor cannot be empty';
			}

			if (EMPTY($ward)) {
				$error ='Ward cannot be empty';
			}
										
			if (EMPTY($bed_num)) {
				$error ='Bed number cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
					
					$insert = Database::getInstance()->insert_ipd_patient($admin_no, $referred, $doctor, $ward, $bed_num, $p_id, $code, $adr);
					if($insert == 'Done'){
						echo '<div class="alert alert-success">
							Patient Added Successfully					
						</div>';
					} else {
						echo $insert;
					}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newCard(){			
		$name = htmlspecialchars($_POST['name']);
		$name = stripslashes($_POST['name']);
		$name = $_POST['name'];
		
		$cost = htmlspecialchars($_POST['cost']);
		$cost = stripslashes($_POST['cost']);
		$cost = $_POST['cost'];
		
		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please enter card type");
		$validator->addValidation("cost","req","Please enter cost");
		
		if($validator->ValidateForm()){
			
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_card($name, $cost);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Card type entered successfully
						</div>';
					}else{
						echo $insert;
					}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					' . $inp_err . '
				</div>';
			}
		}
	}
	

	function customResult(){			
		$res = htmlspecialchars($_POST['result']);
		$res = stripslashes($_POST['result']);
		$res = str_replace("\n", "<br/>", $res);
		
		$val = $_POST['val'];
		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("result","req","Please Enter result");
		
		if($validator->ValidateForm()){
			
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_custom_result($res,$val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Custom Result entered successfully
						</div>';
					}else{
						echo $insert;
					}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					' . $inp_err . '
				</div>';
			}
		}
	}
	
	function newDuty(){			
		$morn = htmlspecialchars($_POST['morn']);
		$morn = stripslashes($_POST['morn']);
		$morn = trim($_POST['morn']);
		
		$bed = htmlspecialchars($_POST['bed']);
		$bed = stripslashes($_POST['bed']);
		$bed = trim($_POST['bed']);
		
		$v_bed = htmlspecialchars($_POST['v_bed']);
		$v_bed = stripslashes($_POST['v_bed']);
		$v_bed = trim($_POST['v_bed']);
		
		$t_pt = htmlspecialchars($_POST['t_pt']);
		$t_pt = stripslashes($_POST['t_pt']);
		$t_pt = trim($_POST['t_pt']);
		
		$adm = htmlspecialchars($_POST['adm']);
		$adm = stripslashes($_POST['adm']);
		$adm = trim($_POST['adm']);
		
		$disc = htmlspecialchars($_POST['disc']);
		$disc = stripslashes($_POST['disc']);
		$disc = trim($_POST['disc']);
		
		$delivery = htmlspecialchars($_POST['delivery']);
		$delivery = stripslashes($_POST['delivery']);
		$delivery = trim($_POST['delivery']);
		
		$cs = htmlspecialchars($_POST['cs']);
		$cs = stripslashes($_POST['cs']);
		$cs = trim($_POST['cs']);
		
		$labour = htmlspecialchars($_POST['labour']);
		$labour = stripslashes($_POST['labour']);
		$labour = trim($_POST['labour']);
		
		$trans = htmlspecialchars($_POST['trans']);
		$trans = stripslashes($_POST['trans']);
		$trans = trim($_POST['trans']);
		
		$death = htmlspecialchars($_POST['death']);
		$death = stripslashes($_POST['death']);
		$death = trim($_POST['death']);
		
		$comment = htmlspecialchars($_POST['comment']);
		$comment = stripslashes($_POST['comment']);
		$comment = trim($_POST['comment']);
		
		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("morn","req","Please enter duty time");
		$validator->addValidation("bed","req","Please enter bed");
		$validator->addValidation("v_bed","req","Please enter v bed");
		$validator->addValidation("t_pt","req","Please enter tpt");
		$validator->addValidation("adm","req","Please enter adm");
		$validator->addValidation("disc","req","Please enter disc");
		$validator->addValidation("delivery","req","Please enter delivery");
		$validator->addValidation("cs","req","Please enter cs");
		$validator->addValidation("labour","req","Please enter labour");
		$validator->addValidation("trans","req","Please enter trans");
		$validator->addValidation("death","req","Please enter death");
		
		if($validator->ValidateForm()){
		
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_stat($morn, $bed, $v_bed, $t_pt, $adm, $disc, $delivery, $cs, $labour, $trans, $death, $comment);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Duty check entered successfully
						</div>';
					}else{
						echo $insert;
					}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					' . $inp_err . '
				</div>';
			}
		}
	}
	
	function newAnte(){			
		$name = htmlspecialchars($_POST['name']);
		$name = stripslashes($_POST['name']);
		$name = trim($_POST['name']);
		
		$pos = htmlspecialchars($_POST['pos']);
		$pos = stripslashes($_POST['pos']);
		$pos = trim($_POST['pos']);
		
		$sex = htmlspecialchars($_POST['sex']);
		$sex = stripslashes($_POST['sex']);
		$sex = trim($_POST['sex']);
		
		$dob = htmlspecialchars($_POST['dob']);
		$dob = stripslashes($_POST['dob']);
		$dob = trim($_POST['dob']);
		
		$house_num = htmlspecialchars($_POST['house_num']);
		$house_num = stripslashes($_POST['house_num']);
		$house_num = trim($_POST['house_num']);
		
		$town = htmlspecialchars($_POST['town']);
		$town = stripslashes($_POST['town']);
		$town = trim($_POST['town']);

		$village = htmlspecialchars($_POST['village']);
		$village = stripslashes($_POST['village']);
		$village = trim($_POST['village']);
		
		$ward = htmlspecialchars($_POST['ward']);
		$ward = stripslashes($_POST['ward']);
		$ward = trim($_POST['ward']);
		
		$state = htmlspecialchars($_POST['state']);
		$state = stripslashes($_POST['state']);
		$state = trim($_POST['state']);
		
		$lga = htmlspecialchars($_POST['lga']);
		$lga = stripslashes($_POST['lga']);
		$lga = trim($_POST['lga']);
		
		$mother_name = htmlspecialchars($_POST['mother_name']);
		$mother_name = stripslashes($_POST['mother_name']);
		$mother_name = trim($_POST['mother_name']);
		
		$mother_phone = htmlspecialchars($_POST['mother_phone']);
		$mother_phone = stripslashes($_POST['mother_phone']);
		$mother_phone = trim($_POST['mother_phone']);
		
		$father_phone = htmlspecialchars($_POST['father_phone']);
		$father_phone = stripslashes($_POST['father_phone']);
		$father_phone = trim($_POST['father_phone']);
		
		$father_name = htmlspecialchars($_POST['father_name']);
		$father_name = stripslashes($_POST['father_name']);
		$father_name = trim($_POST['father_name']);
		
		$cg = htmlspecialchars($_POST['cg']);
		$cg = stripslashes($_POST['cg']);
		$cg = trim($_POST['cg']);
		
		$cg_phone = htmlspecialchars($_POST['cg_phone']);
		$cg_phone = stripslashes($_POST['cg_phone']);
		$cg_phone = trim($_POST['cg_phone']);
		
		$c_year = $_POST['c_year'];
		$c_health = $_POST['c_health'];
		$c_sex = $_POST['c_sex'];
		$mainArray = [
			$c_year, 
			$c_health, 
			$c_sex
		];
		
		//all of thsi is done so each line of array will be for one line of input fields
		foreach( $c_year as $key => $n ) {
			$DataArr[] = ($n." ".$c_health[$key]." ".$c_sex[$key]);
		}
		
		$weigh = htmlspecialchars($_POST['weigh']);
		$weigh = stripslashes($_POST['weigh']);
		$weigh = trim($_POST['weigh']);
		
		$twin = htmlspecialchars($_POST['twin']);
		$twin = stripslashes($_POST['twin']);
		$twin = trim($_POST['twin']);
		
		$fed = htmlspecialchars($_POST['fed']);
		$fed = stripslashes($_POST['fed']);
		$fed = trim($_POST['fed']);
		
		$support = htmlspecialchars($_POST['support']);
		$support = stripslashes($_POST['support']);
		$support = trim($_POST['support']);

		$underweight = htmlspecialchars($_POST['underweight']);
		$underweight = stripslashes($_POST['underweight']);
		$underweight = trim($_POST['underweight']);
		
		$exta_care = htmlspecialchars($_POST['exta_care']);
		$exta_care = stripslashes($_POST['exta_care']);
		$exta_care = trim($_POST['exta_care']);
		
		$bnum1 = htmlspecialchars($_POST['bnum1']);
		$bnum1 = stripslashes($_POST['bnum1']);
		$bnum1 = trim($_POST['bnum1']);

		$v1 = htmlspecialchars($_POST['v1']);
		$v1 = stripslashes($_POST['v1']);
		$v1 = trim($_POST['v1']);
		
		$dg1 = htmlspecialchars($_POST['dg1']);
		$dg1 = stripslashes($_POST['dg1']);
		$dg1 = trim($_POST['dg1']);
		
		$dn1 = htmlspecialchars($_POST['dn1']);
		$dn1 = stripslashes($_POST['dn1']);
		$dn1 = trim($_POST['dn1']);
		
		$cm1 = htmlspecialchars($_POST['cm1']);
		$cm1 = stripslashes($_POST['cm1']);
		$cm1 = trim($_POST['cm1']);
		
		$bnum2 = htmlspecialchars($_POST['bnum2']);
		$bnum2 = stripslashes($_POST['bnum2']);
		$bnum2 = trim($_POST['bnum2']);
		
		$v2 = htmlspecialchars($_POST['v2']);
		$v2 = stripslashes($_POST['v2']);
		$v2 = trim($_POST['v2']);
		
		$dg2 = htmlspecialchars($_POST['dg2']);
		$dg2 = stripslashes($_POST['dg2']);
		$dg2 = trim($_POST['dg2']);
		
		$dn2 = htmlspecialchars($_POST['dn2']);
		$dn2 = stripslashes($_POST['dn2']);
		$dn2 = trim($_POST['dn2']);
		
		$cm2 = htmlspecialchars($_POST['cm2']);
		$cm2 = stripslashes($_POST['cm2']);
		$cm2 = trim($_POST['cm2']);
		
		$bnum3 = htmlspecialchars($_POST['bnum3']);
		$bnum3 = stripslashes($_POST['bnum3']);
		$bnum3 = trim($_POST['bnum3']);
		
		$v3 = htmlspecialchars($_POST['v3']);
		$v3 = stripslashes($_POST['v3']);
		$v3 = trim($_POST['v3']);
		
		$dg3 = htmlspecialchars($_POST['dg3']);
		$dg3 = stripslashes($_POST['dg3']);
		$dg3 = trim($_POST['dg3']);
		
		$dn3 = htmlspecialchars($_POST['dn3']);
		$dn3 = stripslashes($_POST['dn3']);
		$dn3 = trim($_POST['dn3']);
		
		$cm3 = htmlspecialchars($_POST['cm3']);
		$cm3 = stripslashes($_POST['cm3']);
		$cm3 = trim($_POST['cm3']);
		
		$bnum4 = htmlspecialchars($_POST['bnum4']);
		$bnum4 = stripslashes($_POST['bnum4']);
		$bnum4 = trim($_POST['bnum4']);
		
		$v4 = htmlspecialchars($_POST['v4']);
		$v4 = stripslashes($_POST['v4']);
		$v4 = trim($_POST['v4']);
		
		$dg4 = htmlspecialchars($_POST['dg4']);
		$dg4 = stripslashes($_POST['dg4']);
		$dg4 = trim($_POST['dg4']);
		
		$dn4 = htmlspecialchars($_POST['dn4']);
		$dn4 = stripslashes($_POST['dn4']);
		$dn4 = trim($_POST['dn4']);
		
		$cm4 = htmlspecialchars($_POST['cm4']);
		$cm4 = stripslashes($_POST['cm4']);
		$cm4 = trim($_POST['cm4']);
		
		$bnum5 = htmlspecialchars($_POST['bnum5']);
		$bnum5 = stripslashes($_POST['bnum5']);
		$bnum5 = trim($_POST['bnum5']);
		
		$v5 = htmlspecialchars($_POST['v5']);
		$v5 = stripslashes($_POST['v5']);
		$v5 = trim($_POST['v5']);
		
		$dg5 = htmlspecialchars($_POST['dg5']);
		$dg5 = stripslashes($_POST['dg5']);
		$dg5 = trim($_POST['dg5']);
		
		$dn5 = htmlspecialchars($_POST['dn5']);
		$dn5 = stripslashes($_POST['dn5']);
		$dn5 = trim($_POST['dn5']);
		
		$cm5 = htmlspecialchars($_POST['cm5']);
		$cm5 = stripslashes($_POST['cm5']);
		$cm5 = trim($_POST['cm5']);
		
		$bnum6 = htmlspecialchars($_POST['bnum6']);
		$bnum6 = stripslashes($_POST['bnum6']);
		$bnum6 = trim($_POST['bnum6']);
		
		$v6 = htmlspecialchars($_POST['v6']);
		$v6 = stripslashes($_POST['v6']);
		$v6 = trim($_POST['v6']);
		
		$dg6 = htmlspecialchars($_POST['dg6']);
		$dg6 = stripslashes($_POST['dg6']);
		$dg6 = trim($_POST['dg6']);
		
		$dn6 = htmlspecialchars($_POST['dn6']);
		$dn6 = stripslashes($_POST['dn6']);
		$dn6 = trim($_POST['dn6']);
		
		$cm6 = htmlspecialchars($_POST['cm6']);
		$cm6 = stripslashes($_POST['cm6']);
		$cm6 = trim($_POST['cm6']);
		
		$bnum7 = htmlspecialchars($_POST['bnum7']);
		$bnum7 = stripslashes($_POST['bnum7']);
		$bnum7 = trim($_POST['bnum7']);
		
		$v7 = htmlspecialchars($_POST['v7']);
		$v7 = stripslashes($_POST['v7']);
		$v7 = trim($_POST['v7']);
		
		$dg7 = htmlspecialchars($_POST['dg7']);
		$dg7 = stripslashes($_POST['dg7']);
		$dg7 = trim($_POST['dg7']);
		
		$dn7 = htmlspecialchars($_POST['dn7']);
		$dn7 = stripslashes($_POST['dn7']);
		$dn7 = trim($_POST['dn7']);
		
		$cm7 = htmlspecialchars($_POST['cm7']);
		$cm7 = stripslashes($_POST['cm7']);
		$cm7 = trim($_POST['cm7']);
		
		$bnum8 = htmlspecialchars($_POST['bnum8']);
		$bnum8 = stripslashes($_POST['bnum8']);
		$bnum8 = trim($_POST['bnum8']);
		
		$v8 = htmlspecialchars($_POST['v8']);
		$v8 = stripslashes($_POST['v8']);
		$v8 = trim($_POST['v8']);
		
		$dg8 = htmlspecialchars($_POST['dg8']);
		$dg8 = stripslashes($_POST['dg8']);
		$dg8 = trim($_POST['dg8']);
		
		$dn8 = htmlspecialchars($_POST['dn8']);
		$dn8 = stripslashes($_POST['dn8']);
		$dn8 = trim($_POST['dn8']);
		
		$cm8 = htmlspecialchars($_POST['cm8']);
		$cm8 = stripslashes($_POST['cm8']);
		$cm8 = trim($_POST['cm8']);
		
		$bnum9 = htmlspecialchars($_POST['bnum9']);
		$bnum9 = stripslashes($_POST['bnum9']);
		$bnum9 = trim($_POST['bnum9']);
		
		$v9 = htmlspecialchars($_POST['v9']);
		$v9 = stripslashes($_POST['v9']);
		$v9 = trim($_POST['v9']);
		
		$dg9 = htmlspecialchars($_POST['dg9']);
		$dg9 = stripslashes($_POST['dg9']);
		$dg9 = trim($_POST['dg9']);
		
		$dn9 = htmlspecialchars($_POST['dn9']);
		$dn9 = stripslashes($_POST['dn9']);
		$dn9 = trim($_POST['dn9']);
		
		$cm9 = htmlspecialchars($_POST['cm9']);
		$cm9 = stripslashes($_POST['cm9']);
		$cm9 = trim($_POST['cm9']);
		
		$bnum10 = htmlspecialchars($_POST['bnum10']);
		$bnum10 = stripslashes($_POST['bnum10']);
		$bnum10 = trim($_POST['bnum10']);
		
		$v10 = htmlspecialchars($_POST['v10']);
		$v10 = stripslashes($_POST['v10']);
		$v10 = trim($_POST['v10']);
		
		$dg10 = htmlspecialchars($_POST['dg10']);
		$dg10 = stripslashes($_POST['dg10']);
		$dg10 = trim($_POST['dg10']);
		
		$dn10 = htmlspecialchars($_POST['dn10']);
		$dn10 = stripslashes($_POST['dn10']);
		$dn10 = trim($_POST['dn10']);
		
		$cm10 = htmlspecialchars($_POST['cm10']);
		$cm10 = stripslashes($_POST['cm10']);
		$cm10 = trim($_POST['cm10']);
		
		$bnum11 = htmlspecialchars($_POST['bnum11']);
		$bnum11 = stripslashes($_POST['bnum11']);
		$bnum11 = trim($_POST['bnum11']);
		
		$v11 = htmlspecialchars($_POST['v11']);
		$v11 = stripslashes($_POST['v11']);
		$v11 = trim($_POST['v11']);
		
		$dg11 = htmlspecialchars($_POST['dg11']);
		$dg11 = stripslashes($_POST['dg11']);
		$dg11 = trim($_POST['dg11']);
		
		$dn11 = htmlspecialchars($_POST['dn11']);
		$dn11 = stripslashes($_POST['dn11']);
		$dn11 = trim($_POST['dn11']);
		
		$cm11 = htmlspecialchars($_POST['cm11']);
		$cm11 = stripslashes($_POST['cm11']);
		$cm11 = trim($_POST['cm11']);
		
		$bnum12 = htmlspecialchars($_POST['bnum12']);
		$bnum12 = stripslashes($_POST['bnum12']);
		$bnum12 = trim($_POST['bnum12']);
		
		$v12 = htmlspecialchars($_POST['v12']);
		$v12 = stripslashes($_POST['v12']);
		$v12 = trim($_POST['v12']);
		
		$dg12 = htmlspecialchars($_POST['dg12']);
		$dg12 = stripslashes($_POST['dg12']);
		$dg12 = trim($_POST['dg12']);
		
		$dn12 = htmlspecialchars($_POST['dn12']);
		$dn12 = stripslashes($_POST['dn12']);
		$dn12 = trim($_POST['dn12']);
		
		$cm12 = htmlspecialchars($_POST['cm12']);
		$cm12 = stripslashes($_POST['cm12']);
		$cm12 = trim($_POST['cm12']);
		
		
		$bnum13 = htmlspecialchars($_POST['bnum13']);
		$bnum13 = stripslashes($_POST['bnum13']);
		$bnum13 = trim($_POST['bnum13']);
		
		$v13 = htmlspecialchars($_POST['v13']);
		$v13 = stripslashes($_POST['v13']);
		$v13 = trim($_POST['v13']);
		
		$dg13 = htmlspecialchars($_POST['dg13']);
		$dg13 = stripslashes($_POST['dg13']);
		$dg13 = trim($_POST['dg13']);
		
		$dn13 = htmlspecialchars($_POST['dn13']);
		$dn13 = stripslashes($_POST['dn13']);
		$dn13= trim($_POST['dn13']);
		
		$cm13 = htmlspecialchars($_POST['cm13']);
		$cm13 = stripslashes($_POST['cm13']);
		$cm13 = trim($_POST['cm13']);
		
		$bnum14 = htmlspecialchars($_POST['bnum14']);
		$bnum14 = stripslashes($_POST['bnum14']);
		$bnum14 = trim($_POST['bnum14']);
		
		$v14 = htmlspecialchars($_POST['v14']);
		$v14 = stripslashes($_POST['v14']);
		$v14 = trim($_POST['v14']);
		
		$dg14 = htmlspecialchars($_POST['dg14']);
		$dg14 = stripslashes($_POST['dg14']);
		$dg14 = trim($_POST['dg14']);
		
		$dn14 = htmlspecialchars($_POST['dn14']);
		$dn14 = stripslashes($_POST['dn14']);
		$dn14 = trim($_POST['dn14']);
		
		$cm14 = htmlspecialchars($_POST['cm14']);
		$cm14 = stripslashes($_POST['cm14']);
		$cm14= trim($_POST['cm14']);
		
		$bnum15 = htmlspecialchars($_POST['bnum15']);
		$bnum15 = stripslashes($_POST['bnum15']);
		$bnum15 = trim($_POST['bnum15']);
		
		$v15 = htmlspecialchars($_POST['v15']);
		$v15 = stripslashes($_POST['v15']);
		$v15 = trim($_POST['v15']);
		
		$dg15 = htmlspecialchars($_POST['dg15']);
		$dg15 = stripslashes($_POST['dg15']);
		$dg15 = trim($_POST['dg15']);
		
		$dn15 = htmlspecialchars($_POST['dn15']);
		$dn15 = stripslashes($_POST['dn15']);
		$dn15 = trim($_POST['dn15']);
		
		$cm15 = htmlspecialchars($_POST['cm15']);
		$cm15 = stripslashes($_POST['cm15']);
		$cm15 = trim($_POST['cm15']);
		
		$bnum16 = htmlspecialchars($_POST['bnum16']);
		$bnum16 = stripslashes($_POST['bnum16']);
		$bnum16 = trim($_POST['bnum16']);
		
		$v16 = htmlspecialchars($_POST['v16']);
		$v16 = stripslashes($_POST['v16']);
		$v16 = trim($_POST['v16']);
		
		$dg16 = htmlspecialchars($_POST['dg16']);
		$dg16 = stripslashes($_POST['dg16']);
		$dg16 = trim($_POST['dg16']);
		
		$dn16 = htmlspecialchars($_POST['dn16']);
		$dn16 = stripslashes($_POST['dn16']);
		$dn16 = trim($_POST['dn16']);
		
		$cm16 = htmlspecialchars($_POST['cm16']);
		$cm16 = stripslashes($_POST['cm16']);
		$cm16 = trim($_POST['cm16']);
		
		$bnum17 = htmlspecialchars($_POST['bnum17']);
		$bnum17 = stripslashes($_POST['bnum17']);
		$bnum17  = trim($_POST['bnum17']);
		
		$v17 = htmlspecialchars($_POST['v17']);
		$v17 = stripslashes($_POST['v17']);
		$v17 = trim($_POST['v17']);
		
		$dg17 = htmlspecialchars($_POST['dg17']);
		$dg17 = stripslashes($_POST['dg17']);
		$dg17 = trim($_POST['dg17']);
		
		$dn17 = htmlspecialchars($_POST['dn17']);
		$dn17 = stripslashes($_POST['dn17']);
		$dn17 = trim($_POST['dn17']);
		
		$cm17 = htmlspecialchars($_POST['cm17']);
		$cm17 = stripslashes($_POST['cm17']);
		$cm17 = trim($_POST['cm17']);
		
		$bnum18 = htmlspecialchars($_POST['bnum18']);
		$bnum18 = stripslashes($_POST['bnum18']);
		$bnum18 = trim($_POST['bnum18']);
		
		$v18 = htmlspecialchars($_POST['v18']);
		$v18 = stripslashes($_POST['v18']);
		$v18 = trim($_POST['v18']);
		
		$dg18 = htmlspecialchars($_POST['dg18']);
		$dg18 = stripslashes($_POST['dg18']);
		$dg18 = trim($_POST['dg18']);
		
		$dn18 = htmlspecialchars($_POST['dn18']);
		$dn18 = stripslashes($_POST['dn18']);
		$dn18 = trim($_POST['dn18']);
		
		$cm18 = htmlspecialchars($_POST['cm18']);
		$cm18 = stripslashes($_POST['cm18']);
		$cm18 = trim($_POST['cm18']);
		
		$bnum19 = htmlspecialchars($_POST['bnum19']);
		$bnum19 = stripslashes($_POST['bnum19']);
		$bnum19 = trim($_POST['bnum19']);
		
		$v19 = htmlspecialchars($_POST['v19']);
		$v19 = stripslashes($_POST['v19']);
		$v19 = trim($_POST['v19']);
		
		$dg19 = htmlspecialchars($_POST['dg19']);
		$dg19 = stripslashes($_POST['dg19']);
		$dg19 = trim($_POST['dg19']);
		
		$dn19 = htmlspecialchars($_POST['dn19']);
		$dn19 = stripslashes($_POST['dn19']);
		$dn19 = trim($_POST['dn19']);
		
		$cm19 = htmlspecialchars($_POST['cm19']);
		$cm19 = stripslashes($_POST['cm19']);
		$cm19 = trim($_POST['cm19']);
		
		$bnum20 = htmlspecialchars($_POST['bnum20']);
		$bnum20 = stripslashes($_POST['bnum20']);
		$bnum20 = trim($_POST['bnum20']);
		
		$v20 = htmlspecialchars($_POST['v20']);
		$v20 = stripslashes($_POST['v20']);
		$v20 = trim($_POST['v20']);
		
		$dg20 = htmlspecialchars($_POST['dg20']);
		$dg20 = stripslashes($_POST['dg20']);
		$dg20 = trim($_POST['dg20']);
		
		$dn20 = htmlspecialchars($_POST['dn20']);
		$dn20 = stripslashes($_POST['dn20']);
		$dn20 = trim($_POST['dn20']);
		
		$cm20 = htmlspecialchars($_POST['cm20']);
		$cm20 = stripslashes($_POST['cm1']);
		$cm20 = trim($_POST['cm20']);
		
		$bnum21 = htmlspecialchars($_POST['bnum21']);
		$bnum21 = stripslashes($_POST['bnum21']);
		$bnum21 = trim($_POST['bnum21']);
		
		$v21 = htmlspecialchars($_POST['v21']);
		$v21 = stripslashes($_POST['v21']);
		$v21 = trim($_POST['v21']);
		
		$dg21 = htmlspecialchars($_POST['dg21']);
		$dg21 = stripslashes($_POST['dg21']);
		$dg21 = trim($_POST['dg21']);
		
		$dn21 = htmlspecialchars($_POST['dn21']);
		$dn21 = stripslashes($_POST['dn21']);
		$dn21 = trim($_POST['dn21']);
		
		$cm21 = htmlspecialchars($_POST['cm21']);
		$cm21 = stripslashes($_POST['cm21']);
		$cm21 = trim($_POST['cm21']);
		
		$d_year = $_POST['d_year'];
		$complaint = $_POST['complaint'];
		$types = $_POST['types'];
		$manag = $_POST['manag'];
		$mainArray = [
			$d_year, 
			$complaint, 
			$types, 
			$manag
		];
		
		//all of thsi is done so each line of array will be for one line of input fields
		foreach( $d_year as $key => $n ) {
			$DataArr2[] = ($n." ".$complaint[$key]." ".$types[$key]." ".$manag[$key]);
		}
		
		$error = '';

		$validator = new FormValidator();
		
		
		if($validator->ValidateForm()){
		
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_ante($name, $pos, $sex, $dob, $house_num, $town, $village, $ward, $state, $lga, $mother_name,$mother_phone,$father_name, $father_phone, $cg, $cg_phone,
		$DataArr, $weigh, $twin, $fed, $support, $underweight, $exta_care, $bnum1, $v1, $dg1, $dn1, $cm1,$bnum2, $v2, $dg2, $dn2, $cm2,
		$bnum3, $v3, $dg3, $dn3, $cm3,$bnum4, $v4, $dg4, $dn4, $cm4, $bnum5, $v5, $dg5, $dn5, $cm5, $bnum6, $v6, $dg6, $dn6, $cm6, $bnum7, $v7, $dg7, $dn7, $cm7,
		$bnum8, $v8, $dg8, $dn8, $cm8, $bnum9, $v9, $dg9, $dn9, $cm9, $bnum10, $v10, $dg10, $dn10, $cm10, $bnum11, $v11, $dg11, $dn11, $cm11,
		$bnum12, $v12, $dg12, $dn12, $cm12, $bnum13, $v13, $dg13, $dn13, $cm13, $bnum15, $v15, $dg15, $dn15, $cm15, $bnum16, $v16, $dg16, $dn16, $cm16,
		$bnum17, $v17, $dg17, $dn17, $cm17, $bnum18, $v18, $dg18, $dn18, $cm18, $bnum19, $v19, $dg19, $dn19, $cm19, $bnum20, $v20, $dg20, $dn20, $cm20,
		$bnum21, $v21, $dg21, $dn21, $cm21,$DataArr2);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Immunization entered successfully
						</div>';
					}else{
						echo $insert;
					}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					' . $inp_err . '
				</div>';
			}
		}
	}
	
	function newExpi(){
		$date_a = ucfirst(htmlspecialchars($_POST['date_a']));
		$date_a = ucfirst(stripslashes($_POST['date_a']));
		$date_a = ucfirst(trim($_POST['date_a']));
		
		$code = ucfirst(htmlspecialchars($_POST['code']));
		$code = ucfirst(stripslashes($_POST['code']));
		$code = ucfirst(trim($_POST['code']));
		
		$description = lcfirst(htmlspecialchars($_POST['description']));
		$description = lcfirst(stripslashes($_POST['description']));
		$description = lcfirst(trim($_POST['description']));
		
		$approver = lcfirst(htmlspecialchars($_POST['approver']));
		$approver = lcfirst(stripslashes($_POST['approver']));
		$approver = lcfirst(trim($_POST['approver']));
		
		$recipient = htmlspecialchars($_POST['recipient']);
		$recipient = stripslashes($_POST['recipient']);
		$recipient = trim($_POST['recipient']);
		
		$qty = htmlspecialchars($_POST['qty']);
		$qty = stripslashes($_POST['qty']);
		$qty = trim($_POST['qty']);
		
		$amt = htmlspecialchars($_POST['amt']);
		$amt = stripslashes($_POST['amt']);
		$amt = trim($_POST['amt']);
		
		$cash = htmlspecialchars($_POST['cash']);
		$cash = stripslashes($_POST['cash']);
		$cash = trim($_POST['cash']);
		
		$comment = htmlspecialchars($_POST['comment']);
		$comment = stripslashes($_POST['comment']);
		$comment = trim($_POST['comment']);

		$bk = $_POST['bank_used'];

		$type = $_POST['type'];
		
		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("date_a","req","Please fill in date");
		$validator->addValidation("code","req","Please fill in code");
		$validator->addValidation("description","req","Please fill in description");
		$validator->addValidation("approver","req","Please fill in approver");
		$validator->addValidation("recipient","req","Please fill in recipient");
		$validator->addValidation("qty","req","Please fill in qty");
		$validator->addValidation("amt","req","Please fill in amt");
		$validator->addValidation("cash","req","Please fill in cash");		
		$validator->addValidation("type","req","Please Select A Type");
									
		if($validator->ValidateForm()){
						
			if (EMPTY($qty)) {
				$error ='Qty cannot be empty';
			}
			
			if (EMPTY($amt)) {
				$error ='Amount cannot be empty';
			}

			if (EMPTY($recipient)) {
				$error ='Recipient cannot be empty';
			}

			if (EMPTY($approver)) {
				$error ='Approver cannot be empty';
			}
			
			if (EMPTY($description)) {
				$error ='Description cannot be empty';
			}
			
			if (EMPTY($code)) {
				$error ='Code cannot be empty';
			}
			
			if (EMPTY($date_a)) {
				$error ='Date cannot be empty';
			}

			if (EMPTY($type)) {
				$error ='Expense Type cannot be Null';
			}
										
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_expi($date_a, $code, $description, $approver, $recipient, $qty, $amt, $cash,$bk, $comment,$type);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
						Expense added successfully					
					</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newIncome(){
		$date_a = ucfirst(htmlspecialchars($_POST['date_a']));
		$date_a = ucfirst(stripslashes($_POST['date_a']));
		$date_a = ucfirst(trim($_POST['date_a']));
		
		$code = ucfirst(htmlspecialchars($_POST['code']));
		$code = ucfirst(stripslashes($_POST['code']));
		$code = ucfirst(trim($_POST['code']));
		
		$description = lcfirst(htmlspecialchars($_POST['description']));
		$description = lcfirst(stripslashes($_POST['description']));
		$description = lcfirst(trim($_POST['description']));
		
		$approver = lcfirst(htmlspecialchars($_POST['approver']));
		$approver = lcfirst(stripslashes($_POST['approver']));
		$approver = lcfirst(trim($_POST['approver']));

		$amt = htmlspecialchars($_POST['amt']);
		$amt = stripslashes($_POST['amt']);
		$amt = trim($_POST['amt']);
		
		$cash = htmlspecialchars($_POST['cash']);
		$cash = stripslashes($_POST['cash']);
		$cash = trim($_POST['cash']);
		
		$comment = htmlspecialchars($_POST['comment']);
		$comment = stripslashes($_POST['comment']);
		$comment = trim($_POST['comment']);

		$type= $_POST['type'];
		
		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("date_a","req","Please fill in date");
		$validator->addValidation("code","req","Please fill in code");
		$validator->addValidation("description","req","Please fill in description");
		$validator->addValidation("approver","req","Please fill in approver");
		$validator->addValidation("amt","req","Please fill in amount");
		$validator->addValidation("cash","req","Please fill in Payment Type");
		$validator->addValidation("type","req","Please Select Income Type");
									
		if($validator->ValidateForm()){
			
			if (EMPTY($amt)) {
				$error ='Amount cannot be empty';
			}

			if (EMPTY($approver)) {
				$error ='Approver cannot be empty';
			}
			
			if (EMPTY($description)) {
				$error ='Description cannot be empty';
			}
			
			if (EMPTY($code)) {
				$error ='Code cannot be empty';
			}
			
			if (EMPTY($date_a)) {
				$error ='Date cannot be empty';
			}

			if (EMPTY($type)) {
				$error = 'Income Type Cannot Be Empty';
			}
										
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_income($date_a, $code, $description, $approver, $amt, $cash, $comment,$type);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
						Income added successfully					
					</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function newCost(){
		$date_a = ucfirst(htmlspecialchars($_POST['date_a']));
		$date_a = ucfirst(stripslashes($_POST['date_a']));
		$date_a = ucfirst(trim($_POST['date_a']));
		
		$code = ucfirst(htmlspecialchars($_POST['code']));
		$code = ucfirst(stripslashes($_POST['code']));
		$code = ucfirst(trim($_POST['code']));
		
		$description = lcfirst(htmlspecialchars($_POST['description']));
		$description = lcfirst(stripslashes($_POST['description']));
		$description = lcfirst(trim($_POST['description']));
		
		$approver = lcfirst(htmlspecialchars($_POST['approver']));
		$approver = lcfirst(stripslashes($_POST['approver']));
		$approver = lcfirst(trim($_POST['approver']));
		
		$recipient = htmlspecialchars($_POST['recipient']);
		$recipient = stripslashes($_POST['recipient']);
		$recipient = trim($_POST['recipient']);
		
		$qty = htmlspecialchars($_POST['qty']);
		$qty = stripslashes($_POST['qty']);
		$qty = trim($_POST['qty']);
		
		$amt = htmlspecialchars($_POST['amt']);
		$amt = stripslashes($_POST['amt']);
		$amt = trim($_POST['amt']);
		
		$cash = htmlspecialchars($_POST['cash']);
		$cash = stripslashes($_POST['cash']);
		$cash = trim($_POST['cash']);
		
		$comment = htmlspecialchars($_POST['comment']);
		$comment = stripslashes($_POST['comment']);
		$comment = trim($_POST['comment']);

		$type = $_POST['type'];
		
		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("date_a","req","Please fill in date");
		$validator->addValidation("code","req","Please fill in code");
		$validator->addValidation("description","req","Please fill in description");
		$validator->addValidation("approver","req","Please fill in approver");
		$validator->addValidation("recipient","req","Please fill in recipient");
		$validator->addValidation("qty","req","Please fill in quantity");
		$validator->addValidation("amt","req","Please fill in amount");
		$validator->addValidation("cash","req","Please Select A Payment Method");
		$validator->addValidation("type","req","Please Select A Type");
									
		if($validator->ValidateForm()){
						
			if (EMPTY($qty)) {
				$error ='Qty cannot be empty';
			}
			
			if (EMPTY($amt)) {
				$error ='Amount cannot be empty';
			}

			if (EMPTY($recipient)) {
				$error ='Recipient cannot be empty';
			}

			if (EMPTY($approver)) {
				$error ='Approver cannot be empty';
			}
			
			if (EMPTY($description)) {
				$error ='Description cannot be empty';
			}
			
			if (EMPTY($code)) {
				$error ='Code cannot be empty';
			}
			
			if (EMPTY($date_a)) {
				$error ='Date cannot be empty';
			}

			if (EMPTY($type)) {
				$error ='Select A Cost Type cannot be empty';
			}
										
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_cost($date_a, $code, $description, $approver, $recipient, $qty, $amt, $cash, $comment,$type);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
						Cost added successfully					
					</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}
	
	function newCBal(){
		$c_date = ucfirst(htmlspecialchars($_POST['c_date']));
		$c_date = ucfirst(stripslashes($_POST['c_date']));
		$c_date = ucfirst(trim($_POST['c_date']));
		
		$type = ucfirst(htmlspecialchars($_POST['type']));
		$type = ucfirst(stripslashes($_POST['type']));
		$type = ucfirst(trim($_POST['type']));
		
		$description = lcfirst(htmlspecialchars($_POST['description']));
		$description = lcfirst(stripslashes($_POST['description']));
		$description = lcfirst(trim($_POST['description']));
		
		$amt = htmlspecialchars($_POST['amt']);
		$amt = stripslashes($_POST['amt']);
		$amt = trim($_POST['amt']);
		
		$cash = htmlspecialchars($_POST['cash']);
		$cash = stripslashes($_POST['cash']);
		$cash = trim($_POST['cash']);
		
		$comment = htmlspecialchars($_POST['comment']);
		$comment = stripslashes($_POST['comment']);
		$comment = trim($_POST['comment']);
		
		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("c_date","req","Please fill in date");
		$validator->addValidation("amt","req","Please fill in amt");
		$validator->addValidation("cash","req","Please fill in cash");
		$validator->addValidation("type","req","Please fill in type");
									
		if($validator->ValidateForm()){
			
			if (EMPTY($type)) {
				$error ='Type cannot be empty';
			}
			
			if (EMPTY($amt)) {
				$error ='Amount cannot be empty';
			}

						
			if (EMPTY($c_date)) {
				$error ='Date cannot be empty';
			}
										
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_c_bal($c_date, $description, $amt, $cash, $comment, $type);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
						Balance added successfully					
					</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}
	
	function newMonth(){
		$from_date = ucfirst(htmlspecialchars($_POST['from_date']));
		$from_date = ucfirst(stripslashes($_POST['from_date']));
		$from_date = ucfirst(trim($_POST['from_date']));
		
		$to_date = ucfirst(htmlspecialchars($_POST['to_date']));
		$to_date = ucfirst(stripslashes($_POST['to_date']));
		$to_date = ucfirst(trim($_POST['to_date']));
		
		$error = '';
		
		$val = $_POST['val'];

		$validator = new FormValidator();
						
		$validator->addValidation("from_date","req","Please fill in from date");
		$validator->addValidation("to_date","req","Please fill in to date");
								
		if($validator->ValidateForm()){
			
			if (EMPTY($from_date)) {
				$error ='From date cannot be empty';
			}
										
			if (EMPTY($to_date)) {
				$error ='To date cannot be empty';
			}
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->month_date($from_date, $to_date, $val);
				
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}
		
	function newTestResTemp(){
		
		$error = '';
		
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim($_POST['name']));
		
		
		$fields = $_POST['fieldss'];
		
		$mainArray = [
			$fields
		];
		//all of thsi is done so each line of array will be for one line of input fields
		foreach( $fields as $key => $n ) {
			$DataArr[] = ($n." ".$fields[$key]);
		}

		$validator = new FormValidator();
									
		if($validator->ValidateForm()){
			

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->insert_lab_temp($DataArr,$name);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Successful					
						</div>';
				} else {
					echo $insert;
				}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}
	
	
	function getFields(){		
		$error = '';
		
		$temp = $_POST['temp'];
		$temp = $_POST['temp'];
		$temp = $_POST['temp'];

		$validator = new FormValidator();
						
							
		if($validator->ValidateForm()){																	
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			} else{
				$insert = Database::getInstance()->get_fields($temp);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
						Gift Card Form added						
					</div>';
				} else {
					echo $insert;
				}
			}

		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}
	
	function insertRes(){	

		$test = $_POST['test'];

		$id = $_POST['id'];

		$p_id = $_POST['app_id'];

		$temp = $_POST['temp']; 
		$error = '';
		
		$cardDets = Database::getInstance()->select_from_where2('lab_temps', 'label_id', $test);	
		foreach($cardDets as $row):
			$name = $row['temp_name'];
			$name_id = $row['id'];
			$value = $_POST[$name]; 
			$insert = Database::getInstance()->insert_ress($p_id, $test, $id, $value, $temp, $name_id);	
		endforeach;	
		if($insert === 'Done'){
			echo '<div class="alert alert-success">
				Result Entered
			</div>';
		} else {
			echo $insert;
		}
	}

	function insertXray_Res(){	

		$test = $_POST['test'];

		$id = $_POST['id'];

		$p_id = $_POST['p_id'];

		$temp = $_POST['temp'];
		
		$error = '';
		
		$cardDets = Database::getInstance()->select_from_where2('xray', 'id', $temp);	
		foreach($cardDets as $row):
			$name = $row['name'];
			$name_id = $row['id'];
			$value = !empty($_POST[$name]);
			
			$insert = Database::getInstance()->insert_xray_ress($p_id, $test, $id, $value, $temp, $name_id);	
		endforeach;	
		if($insert === 'Done'){
			echo '<div class="alert alert-success">
				Result Entered
			</div>';
		} else {
			echo $insert;
		}
	}
	
	function changeAdmiStatus(){			
		$status = htmlspecialchars($_POST['selected']);
		$status = stripslashes($_POST['selected']);
		$status = $_POST['selected'];
	
		$app_id = $_POST['app_id'];
		
		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("selected","req","Please pick a status");
		
		if($validator->ValidateForm()){
			
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->change_admi_status($status, $app_id);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Status updated
						</div>';
						
						?>	
			<script>
			
			location.reload();
			</script>
								
								<?php
					}else{
						echo $insert;
					}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					' . $inp_err . '
				</div>';
			}
		}
	}
	
	function changePrescriptionStatus(){			
		$status = htmlspecialchars($_POST['selected']);
		$status = stripslashes($_POST['selected']);
		$status = $_POST['selected'];
		
		$pre_id = $_POST['pre_id'];
		
		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("selected","req","Please pick a status");
		
		if($validator->ValidateForm()){
			
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->change_prescription_status($status, $pre_id);
						echo $insert;
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					' . $inp_err . '
				</div>';
			}
		}
		
	}
	
	
	
	function requestExam(){
	
		
		$val = trim($_POST['val']);
		$doc = $_POST['doc_id'];
		$p_id = $_POST['p_id'];
		
		$validator = new FormValidator();
						
		$validator->addValidation("doc_id","req","Please Login");
		$validator->addValidation("val","req","Please select Appointment");
							
		if($validator->ValidateForm()){
			

				echo $insert = Database::getInstance()->insert_exam_request($val,$doc, $p_id);
				//$notify = Database::getInstance()->notify_nurse3($val,$doc,$p_id); 
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}
	
	function changeExamStatus(){			
		$status = htmlspecialchars($_POST['selected']);
		$status = stripslashes($_POST['selected']);
		$status = $_POST['selected'];
		
		$app_id = $_POST['app_id'];
		
		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("selected","req","Please pick a status");
		
		if($validator->ValidateForm()){
			
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->change_exam_status($status, $app_id);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Status updated
						</div>';
					}else{
						echo $insert;
					}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					' . $inp_err . '
				</div>';
			}
		}
	}
	
	function changeAppStatus(){			
		$status = htmlspecialchars($_POST['selected']);
		$status = stripslashes($_POST['selected']);
		$status = $_POST['selected'];
		
		$staff_id = $_POST['staff_id'];
		
		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("selected","req","Please pick a status");
		
		if($validator->ValidateForm()){
			
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->change_staff_status($status, $staff_id);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Status updated
						</div>';
					}else{
						echo $insert;
					}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					' . $inp_err . '
				</div>';
			}
		}
	}
	
	
	function add_more_fields(){			
		
		$val = $_POST['val'];
		
		$error = '';
		$fieldsst = $_POST['fieldsst'];
		$mainArray = [
			$fieldsst
		];
		//all of thsi is done so each line of array will be for one line of input fields
		foreach( $fieldsst as $key => $n ) {
			$DataArr[] = ($n." ".$fieldsst[$key]);
		}

		$validator = new FormValidator();
		
		if($validator->ValidateForm()){
			
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->add_fields($val, $DataArr);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Fields added
						</div>';
					}else{
						echo $insert;
					}
			}
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					' . $inp_err . '
				</div>';
			}
		}
	}
?>