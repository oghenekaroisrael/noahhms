<?php
include('../inc/db.php');
require_once('../inc/formvalidator.php');

$functionto = $_POST['ins'];

switch ($functionto) {
    
	case "editProfile":
		editProfile();
        break;

    case 'updateVLog':
    		updateVLog();
    		break;	

    case 'editLabour':
    	editLabour();
    	break;

    case 'actSample':
    	actSample();
    	break;

    case 'actBloodGroup':
    	actBloodGroup();
    	break;

    case 'editDonor':
    	editDonor();
    	break;

    case 'editDonation':
    	editDonation();
    	break;

    case "changeRoom":
		changeRoom();
        break;
        
    case 'editIncome':
    	editIncome();
    	break;

    case 'editRevenueType':
    	editRevenueType();
    	break;
	
	case "editPatient":
		editPatient();
        break;
    case 'assignTariff':
    	assignTariff();
    	break;
    case 'updateInject':
    	updateInject();
    	break;
    case "processInvoice";
    	processInvoice();
    	break;

    case "editCompany":
		editCompany();
        break;

    case "editUsage":
    	editUsage();
    	break;

    case "editDoc":
		editDoc();
        break; 

     case "editSupplier":
		editSupplier();
        break;

	case "editStock_w":
		editStock_w();
        break; 

     case "editFamily":
		editFamily();
        break;

     case 'editMCharge':
     		editMCharge();
     		break;	
		
	case "editTax":
		editTax();
		break;    

    case "SendtoAcc":
	   SendtoAcc();
       break;

    case "SendtoAcc2":
	   SendtoAcc2();
       break;

    case "editSche":
		editSche();
        break;
     
    case "addVitals":
		addVitals();
        break; 
		
	case "extraTest":
		extraTest();
        break; 

	case "editTestType":
		editTestType();
        break;

    case 'editTreatment_i':
    	editTreatment_i();
    	break;

    case 'editBloodGroup':
    	editBloodGroup();
    	break;

    case 'editSample':
    	editSample();
    	break;

    case 'editTGroup':
    	editTGroup();
    	break;

    case "changeCstatus":
    	changeCstatus();
    	break; 

    case "editTariff":
    	editTariff();
    	break;

    case "editCategory":
		editCategory();
        break;

    case "editCategory1":
		editCategory1();
        break; 
		
	case "editTest":
		editTest();
        break; 

    case "editTest2":
		editTest2();
        break; 
		
	case "editXray":
		editXray();
        break; 

    case "editScan":
		editScan();
        break; 
		
	case "newTestResult":
		  newTestResult();
		break;
			
    case "editCat":
		editCat();
        break; 

    case "editUnit":
		editUnit();
        break; 

    case "editCUnit":
		editCUnit();
        break; 

    case "editForm":
		editForm();
        break; 

	case "editStock":
		editStock();
        break;

    case 'editLog':
    	editLog();
    	break;

    case 'editCStock':
    	editCStock();
    	break;

    case 'editStock1':
    	editStock1();
    	break;

    case "UpdateStock":
		UpdateStock();
        break;

    case "editStock2":
		editStock2();
        break; 
    
    case "editIPD":
		editIPD();
        break;

	case 'processDeceased':
		processDeceased();
		break;

	case "editObs":
		  editObs();
		break;	
			
	case "editDis":
	   editDis();
	   break;	
			
	case "editFluid":
	   editFluid();
       break;	
	   
	case "processPrescription":
	   processPrescription();
       break;	
	   
	case "editBed":
		   editBed();
			break;

	case 'editMBed':
		editMBed();
		break;

	case "editBedType":
		   editBedType();
			break;
			
	case "acceptPayment":
	   acceptPayment();
       break;

    case 'endVitals':
    	endVitals();
    	break;

    case 'autoExp':
    	autoExp();
    	break;

    case 'updateHmoBill':
    	updateHmoBill();
    	break;

    case "acceptPayment_company":
	   acceptPayment_company();
       break;

	case "acceptPayment2":
	   acceptPayment2();
       break;
	   
	case "editAdmissionStatus":
	   editAdmissionStatus();
       break;	
			
    case "editStaff":
		editStaff();
        break;
     
    case "editCard":
		editCard();
        break; 
	
	case "editStat":
		editStat();
        break; 
		
	case "editAnte":
		editStat();
        break; 

    case 'editAntenatal':
    		editAntenatal();
    		break;

    case 'editAntenatal_N':
    		editAntenatal_N();
    		break;	
	
	case "editExp":
		editExp();
        break; 

    case "editCost":
    	editCost();
    	break;	
		
	case "editBall":
		editBall();
        break; 

    case "editCharge":
		editCharge();
        break; 
		
	case "getFieldsEdit":
		getFieldsEdit();
        break; 
	
	case "editTestResTemp":
		editTestResTemp();
        break; 
		
	case "editTempy":
		editTempy();
        break; 
	
	case "editTempa":
		editTempa();
        break;

    case "approve_request":
		approve_request();
        break;

    case 'bedStatus':
    	bedStatus();
    	break;

    case "cancel_request":
		cancel_request();
        break;

     case "cancelIssue":
	   cancelIssue();
       break;
	
   default:
        echo '<div class="alert alert-danger">
				Function does not Exist
			  </div>';
}
function editLog(){
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
		$val = $_POST['edit'];
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
				$insert = Database::getInstance()->edit_log($vname,$vsex,$vtel,$vaddress,$vreason,$s_id,$user,$val);
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
function editIncome(){
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
		$id = $_POST['id'];
		
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
				$insert = Database::getInstance()->edit_income($date_a, $code, $description, $approver, $amt, $cash, $comment,$type,$id);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
						Income Updated successfully					
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

	function updateVLog(){
		$reason = htmlspecialchars($_POST['reason']);
		$reason = stripslashes($_POST['reason']);
		$reason = trim($_POST['reason']);

		$val = $_POST['val'];
		$user = $_POST['user'];
		$error = '';
		$validator = new FormValidator();
						
		$validator->addValidation("val","req","Please Select A Visit");
		$validator->addValidation("reason","req","Enter A Response");
									
		if($validator->ValidateForm()){
			
				$insert = Database::getInstance()->update_VLog($reason,$val,$user);
				if ($insert == "Done") {
					echo '<div class="alert alert-success">
							Remark Sent Successfully
						</div>';
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

	function endVitals(){
		$val = $_POST['val'];
		$error = '';
		$validator = new FormValidator();
						
		$validator->addValidation("val","req","Please Select An Appointment To End");
									
		if($validator->ValidateForm()){
			
				echo $insert = Database::getInstance()->end_vitals($val);
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}
function cancelIssue(){
		
		$val = $_POST['val'];
		$status = 0;
		$doc = $_POST['doc'];

		$error = '';
		$validator = new FormValidator();
						
		$validator->addValidation("val","req","Please Select Prescription");
									
		if($validator->ValidateForm()){
			$quantity = "";
			$pharm = Database::getInstance()->get_name_from_id('pharm_stock_id','prescription','prescription_id',$val);
			$stocquantity = Database::getInstance()->get_name_from_id('c_carton','pharm_stock','id',$pharm);
			$presquantity1 = Database::getInstance()->get_name_from_id('quantity_dispense','prescription','prescription_id',$val);
			$presquantity2 = Database::getInstance()->get_name_from_id('squantity_dispense','prescription','prescription_id',$val);
			if (empty($presquantity1)) {
				$dispense = $presquantity2;
			}else{
				$dispense = $presquantity1;
			}
			$quantity = $stocquantity + $dispense;
			echo $insert = Database::getInstance()->cancel_prescription_w($val,$status,$quantity,$pharm,$doc);	
				
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function bedStatus(){
		
		$val = $_POST['val'];
		$status = $_POST['status'];

		$error = '';
		$validator = new FormValidator();
						
		$validator->addValidation("val","req","Please Select A Bed");
									
		if($validator->ValidateForm()){
			$quantity = "";
			echo $insert = Database::getInstance()->changeBedStatus($val,$status);	
				
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

function approve_request(){
		
		$val = $_POST['val'];
		$status = 1;

		$error = '';
		$validator = new FormValidator();
						
		$validator->addValidation("val","req","Please Select Prescription");
									
		if($validator->ValidateForm()){
			$quantity = "";
			echo $insert = Database::getInstance()->approve_request($val,$status);	
				
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}
	function assignTariff(){
		$price = ucfirst(htmlspecialchars($_POST['tariff']));
		$price = ucfirst(stripslashes($_POST['tariff']));
		$price = ucfirst(trim($_POST['tariff']));
		$error = '';

		$val = $_POST['id'];

		$validator = new FormValidator();
						
		$validator->addValidation("tariff","req","Please select a Tariff");						
		if($validator->ValidateForm()){

			if (EMPTY($price)) {
				$error ='Tariff cannot be empty';
			}
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->assign_tariff($price, $val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Tariff Assigned successfully!					
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

	function updateInject(){
		$error = '';
		$val = $_POST['val'];

		$validator = new FormValidator();
						
		$validator->addValidation("val","req","Please Click Again");						
		if($validator->ValidateForm()){

			if (EMPTY($val)) {
				$error ='Box cannot be empty';
			}
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->update_inject($val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Injection Given successfully!					
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


	function cancel_request(){
		
		$val = $_POST['val'];
		$status = 2;

		$error = '';
		$validator = new FormValidator();
						
		$validator->addValidation("val","req","Please Select Prescription");
									
		if($validator->ValidateForm()){
			$quantity = "";
			echo $insert = Database::getInstance()->approve_request($val,$status);	
				
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

function processInvoice(){
		
		$val = $_POST['val'];

		$error = '';
		$validator = new FormValidator();
						
		$validator->addValidation("val","req","Please Select Invoice ID");
									
		if($validator->ValidateForm()){
			
			echo $insert = Database::getInstance()->process_invoice($val);
				
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function editUsage(){
		$usage_name = ucfirst(htmlspecialchars($_POST['usage_name']));
		$usage_name = ucfirst(stripslashes($_POST['usage_name']));
		$usage_name = ucfirst(trim($_POST['usage_name']));
		
		$error = '';

		$val = $_POST['id'];

		$validator = new FormValidator();
						
		$validator->addValidation("usage_name","req","Please enter name of Usage");
									
		if($validator->ValidateForm()){
			
										
			if (EMPTY($usage_name)) {
				$error ='Usage cannot be empty';
			}
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->edit_usage($usage_name, $val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Usage edited successfully					
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
	
	function processPrescription(){
		
		$vals = $_POST['val'];
		$status = $_POST['status'];
		$doc = $_POST['doc'];

		$error = '';
		$validator = new FormValidator();
						
		$validator->addValidation("val","req","Please Select Prescription");
									
		if($validator->ValidateForm()){
			$quantity = "";
			$all = database::getInstance()->select_from_where_Like("prescription","reference",$vals);
			foreach ($all as $pres) {
				$pharm = $pres['pharm_stock_id'];
				$val = $pres['prescription_id'];
			$stocquantity = Database::getInstance()->get_name_from_id('stock','pharm_stock','id',$pharm);
			$presquantity1 = Database::getInstance()->get_name_from_id('quantity_dispense','prescription','prescription_id',$val);
			$presquantity2 = Database::getInstance()->get_name_from_id('squantity_dispense','prescription','prescription_id',$val);
			if ($presquantity1 != 0 AND !empty($presquantity1)) {
				$presquantity = $presquantity1;
			}else{
				$presquantity = $presquantity2;
			}
				if($status ==1){
					$quantity = $stocquantity - $presquantity;
					if($quantity < 0){
						$quantity = 0;
					}
					
				}else{
					$quantity = $stocquantity + $presquantity;
				}
				$insert = Database::getInstance()->process_prescription($val,$status,$quantity,$pharm,$doc);
				$r = "Done";
			}
				echo $r;
		//here		
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}
	 
	function editLabour(){
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

		$val = $_POST['lid'];
		
		$error = '';
		$by = $_POST['by'];
		$ipd = $_POST['ipid'];

		$validator = new FormValidator();
						
		$validator->addValidation("surname","req","Please enter Surname");
		$validator->addValidation("fname","req","Please enter First Name");
		$validator->addValidation("by","req","Please Login");
									
		if($validator->ValidateForm()){
			
				$insert = Database::getInstance()->edit_labour($surname,$fname,$par,$hn,$age,$nlc,$poh,$lmp,$edd,$ah,$onset,$h,$state,$mrh,$amni,$cont,$oxi,$condition,$fh,$type,$lie,$pres,$pos,$desc,$fhr,$vul,$vag,$cer,$pp,$os,$rup,$int,$ppo,$ip,$cap,$mould,$pap,$psc,$f,$is,$val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Labour Record Updated					
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


	function editSupplier(){
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
				$insert = Database::getInstance()->edit_supplier($name,$code, $addr, $city,$country, $phone, $email,$person,$mobile, $notes, $val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Supplier edited successfully					
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

	function editStock_w(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim($_POST['name']));

		$code = ucfirst(htmlspecialchars($_POST['stock_code']));
		$code = ucfirst(stripslashes($_POST['stock_code']));
		$code = ucfirst(trim($_POST['stock_code']));

		$batch = ucfirst(htmlspecialchars($_POST['batch']));
		$batch = ucfirst(stripslashes($_POST['batch']));
		$batch = ucfirst(trim($_POST['batch']));

		$cat = ucfirst(htmlspecialchars($_POST['cat']));
		$cat = ucfirst(stripslashes($_POST['cat']));
		$cat = ucfirst(trim($_POST['cat']));

		$unit = ucfirst(htmlspecialchars($_POST['unit']));
		$unit = ucfirst(stripslashes($_POST['unit']));
		$unit = ucfirst(trim($_POST['unit']));

		$bunit = ucfirst(htmlspecialchars($_POST['bunit']));
		$bunit = ucfirst(stripslashes($_POST['bunit']));
		$bunit = ucfirst(trim($_POST['bunit']));

		$cprice = ucfirst(htmlspecialchars($_POST['cost']));
		$cprice = ucfirst(stripslashes($_POST['cost']));
		$cprice = ucfirst(trim($_POST['cost']));

		$cartons = ucfirst(htmlspecialchars($_POST['cartons']));
		$cartons = ucfirst(stripslashes($_POST['cartons']));
		$cartons = ucfirst(trim($_POST['cartons']));

		$manu = ucfirst(htmlspecialchars($_POST['manufactured']));
		$manu = ucfirst(stripslashes($_POST['manufactured']));
		$manu = ucfirst(trim($_POST['manufactured']));

		$exp = ucfirst(htmlspecialchars($_POST['expiring']));
		$exp = ucfirst(stripslashes($_POST['expiring']));
		$exp = ucfirst(trim($_POST['expiring']));

		$supplier = ucfirst(htmlspecialchars($_POST['supplier']));
		$supplier = ucfirst(stripslashes($_POST['supplier']));
		$supplier = ucfirst(trim($_POST['supplier']));

		$error = '';

		$val = $_POST['id'];

		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please enter name of item");
		$validator->addValidation("unit","req","Please enter unit of item");
		$validator->addValidation("cost","req","Please enter cost price of item");	
		$validator->addValidation("cartons","req","Please enter Cartons of item");		
		$validator->addValidation("stock_code","req","Please enter Stock Number of item");
							
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
				$insert = Database::getInstance()->edit_stock_w($name,$code,$batch, $cat, $unit,$cprice,$cartons,$manu, $exp,$supplier,$bunit, $val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Stock edited successfully					
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

	function editCStock(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim($_POST['name']));

		$code = ucfirst(htmlspecialchars($_POST['stock_code']));
		$code = ucfirst(stripslashes($_POST['stock_code']));
		$code = ucfirst(trim($_POST['stock_code']));

		$batch = ucfirst(htmlspecialchars($_POST['batch']));
		$batch = ucfirst(stripslashes($_POST['batch']));
		$batch = ucfirst(trim($_POST['batch']));

		$price = ucfirst(htmlspecialchars($_POST['price']));
		$price = ucfirst(stripslashes($_POST['price']));
		$price = ucfirst(trim($_POST['price']));

		$unit = ucfirst(htmlspecialchars($_POST['unit']));
		$unit = ucfirst(stripslashes($_POST['unit']));
		$unit = ucfirst(trim($_POST['unit']));

		$cprice = ucfirst(htmlspecialchars($_POST['cost']));
		$cprice = ucfirst(stripslashes($_POST['cost']));
		$cprice = ucfirst(trim($_POST['cost']));

		$quantity = ucfirst(htmlspecialchars($_POST['quantity']));
		$quantity = ucfirst(stripslashes($_POST['quantity']));
		$quantity = ucfirst(trim($_POST['quantity']));

		$manu = ucfirst(htmlspecialchars($_POST['manufactured']));
		$manu = ucfirst(stripslashes($_POST['manufactured']));
		$manu = ucfirst(trim($_POST['manufactured']));

		$exp = ucfirst(htmlspecialchars($_POST['expiring']));
		$exp = ucfirst(stripslashes($_POST['expiring']));
		$exp = ucfirst(trim($_POST['expiring']));

		$error = '';

		$val = $_POST['id'];

		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please enter name of item");
		$validator->addValidation("unit","req","Please enter unit of item");
		$validator->addValidation("cost","req","Please enter cost price of item");	
		$validator->addValidation("quantity","req","Please enter Quantity of item");		
		$validator->addValidation("stock_code","req","Please enter Stock Number of item");
							
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
			if (EMPTY($quantity)) {
				$error ='Quantity cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->edit_cstock($name,$code,$batch,$unit,$cprice,$price,$quantity,$manu,$exp,$val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Stock edited successfully					
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

	function acceptPayment2(){
		
		$val = $_POST['val'];
		$pid = $_POST['pid'];
		$error = '';
		$validator = new FormValidator();
						
		$validator->addValidation("val","req","No Order Id Found");
		$validator->addValidation("pid","req","No Patient Id Found");
									
		if($validator->ValidateForm()){
			
			echo $insert = Database::getInstance()->process_cpayment($val,$pid);	
				//Database::getInstance()->notify_lab3($pid);
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

function autoExp(){
		
		$val = $_POST['val'];
		$user = $_POST['user'];
		$error = '';
		$validator = new FormValidator();
						
		$validator->addValidation("val","req","No account ID Found");
									
		if($validator->ValidateForm()){
			
			echo $insert = Database::getInstance()->process_expMove($val,$user);	
				//Database::getInstance()->notify_lab3($pid);
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}	
	function updateHmoBill(){
		$tariff = $_POST['tariff'];
		$pid = $_POST['pid'];
		$stat = $_POST['stat'];
		$error = '';
		$validator = new FormValidator();
		$validator->addValidation("tariff","req","No tariff");
		$validator->addValidation("pid","req","Please Select Payment");
									
		if($validator->ValidateForm()){
			
				echo $insert = Database::getInstance()->move_to_hmo($pid,$tariff,$stat);	
				//Database::getInstance()->notify_lab2($pid);
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}
	function acceptPayment(){
		$val = $_POST['val'];
		$status = $_POST['status'];
		$amount = $_POST['amount'];
		$pid = $_POST['pid'];
		$error = '';
		$validator = new FormValidator();
						
		$validator->addValidation("val","req","Please Select Payment");
		$validator->addValidation("status","req","Please Select Payment");
		$validator->addValidation("pid","req","Please Select Payment");
		$validator->addValidation("amount","req","Please Select Payment");
									
		if($validator->ValidateForm()){
			
				echo $insert = Database::getInstance()->process_payment($val,$status,$amount);	
				//Database::getInstance()->notify_lab2($pid);
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function acceptPayment_company(){
		$status = $_POST['status'];
		$pid = $_POST['pid'];
		$error = '';
		$validator = new FormValidator();

		$validator->addValidation("status","req","Please Select Payment");
		$validator->addValidation("pid","req","Please Select Payment");
									
		if($validator->ValidateForm()){
			
				echo $insert = Database::getInstance()->process_payment_company($status,$pid);	
				//Database::getInstance()->notify_lab2($pid);
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}
	
	function deferPayment_all(){
		
		$val = $_POST['val'];
		$status = $_POST['status'];
		$insert = Database::getInstance()->process_payment_defer_all($val, $status);
				if($insert === 'Done'){
					echo '<div class="alert alert-success">
							Payment status updated
						</div>';
					}else{
						echo $insert;
					}	
	}

	function editProfile(){
		$first = ucfirst(htmlspecialchars($_POST['fname']));
		$first = ucfirst(stripslashes($_POST['fname']));
		$first = ucfirst(trim($_POST['fname']));
				
		$last = ucfirst(htmlspecialchars($_POST['lname']));
		$last = ucfirst(stripslashes($_POST['lname']));
		$last = ucfirst(trim($_POST['lname']));
		
		$email = lcfirst(htmlspecialchars($_POST['email']));
		$email = lcfirst(stripslashes($_POST['email']));
		$email = lcfirst(trim($_POST['email']));
		
		$address = ucfirst(htmlspecialchars($_POST['address']));
		$address = ucfirst(stripslashes($_POST['address']));
		$address = ucfirst(trim($_POST['address']));
		
		$city = ucfirst(htmlspecialchars($_POST['city']));
		$city = ucfirst(stripslashes($_POST['city']));
		$city = ucfirst(trim($_POST['city']));
		
		$state = ucfirst(htmlspecialchars($_POST['state']));
		$state = ucfirst(stripslashes($_POST['state']));
		$state = ucfirst(trim($_POST['state']));
		
		$country = ucfirst(htmlspecialchars($_POST['country']));
		$country = ucfirst(stripslashes($_POST['country']));
		$country = ucfirst(trim($_POST['country']));
		
		$dob = ucfirst(htmlspecialchars($_POST['dob']));
		$dob = ucfirst(stripslashes($_POST['dob']));
		$dob = ucfirst(trim($_POST['dob']));
		
		$bitcoinn = htmlspecialchars($_POST['bitcoin']);
		$bitcoinn = stripslashes($_POST['bitcoin']);
		$bitcoinn = trim($_POST['bitcoin']);
		
		$litecoinn = htmlspecialchars($_POST['litecoin']);
		$litecoinn = stripslashes($_POST['litecoin']);
		$litecoinn = trim($_POST['litecoin']);
		
		$ethereumm = htmlspecialchars($_POST['ethereum']);
		$ethereumm = stripslashes($_POST['ethereum']);
		$ethereumm = trim($_POST['ethereum']);
		
		$rmbb = htmlspecialchars($_POST['rmb']);
		$rmbb = stripslashes($_POST['rmb']);
		$rmbb = trim($_POST['rmb']);
		
		$mypassword = htmlspecialchars($_POST['password']);
		$mypassword = stripslashes($_POST['password']);
		$mypassword = trim($_POST['password']);
		
		$cpassword = htmlspecialchars($_POST['cpassword']);
		$cpassword = stripslashes($_POST['cpassword']);
		$cpassword = trim($_POST['cpassword']);
		
		$error = '';		
		$user_id = $_POST['val'];
		$validator = new FormValidator();
									
		if($validator->ValidateForm()){
			if (!preg_match("/^[A-Z][a-zA-Z -]+$/",$first)) {
				$error = 'First Name must contain only letters.';
			}
										
			if (!preg_match("/^[A-Z][a-zA-Z -]+$/",$last)) {
				$error ='Last Name must contain only letters.';
			}
			
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			  $error = 'Please enter a valid email address!';
			} 
									
			if($mypassword != $cpassword){
				$error ='Password does not match Confirm Password.';
			}
			
			//for password
			$hash = password_hash($mypassword, PASSWORD_DEFAULT);

			//encrypt ecurrencies account
			if($bitcoinn != ""){
				$bitcoin = my_simple_crypt( $bitcoinn, 'e' );
			} else {
				$bitcoin = "";
			}
				
			if($litecoinn != ""){
				$litecoin = my_simple_crypt( $litecoinn, 'e' );
			} else {
				$litecoin = "";
			}
				
			if($ethereumm != ""){
				$ethereum = my_simple_crypt( $ethereumm, 'e' );
			} else {
				$ethereum = "";
			}
				
			if($rmbb != ""){
				$rmb = my_simple_crypt( $rmbb, 'e' );
			} else {
				$rmb = "";
			}
			
			//for poa upload
			if($validator->ValidateForm()){
				$allowed_image_extension = array(
					"png",
					"jpg",
					"jpeg"
				);
				$image = $_FILES['profile']['name'];
				$temp_dir = $_FILES["profile"]["tmp_name"];
				$check = filesize($temp_dir);
	
				if(!$check){
					$insert = Database::getInstance()->editProfileUser($first, $last, $email,$address, $city, $state, $country, $dob, $bitcoin, $ethereum, $litecoin, $rmb, $hash, $user_id);
					if($insert == 'Done'){
						echo '<div class="alert alert-success">
							Profile updated
					</div>';
					} else {
						echo $insert;
					}
				} else{
					// Get image file extension
					$file_extension = pathinfo($image, PATHINFO_EXTENSION);
			
					if($_FILES["profile"]["type"] == "application/msword") {
						echo "<div class='alert-danger'> Invalid image type, use (e.g. png, jpg)</div>";
					} else if(isset($_SERVER['CONTENT_LENGTH']) && (int) $_SERVER['CONTENT_LENGTH'] > 2000000) {
					  echo "<div class='alert alert-danger'> Image is too large, it must be less than 2mb</div>";
					} else if (! in_array($file_extension, $allowed_image_extension)) {
						echo "<div class='alert alert-danger'> Upload valid images. Only PNG, JPG and JPEG are allowed</div>";
					} else if( $_FILES["profile"]["error"] > 0 ) {
						echo "<div class='alert alert-danger'> Oops sorry, seems there is an error uploading your image, please try again later</div>";
					} else{
						// strip file slashes in uploaded file, although it will not happen but just in case 
						$filename = stripslashes( $image );
						$ext = end(explode( ".", $filename ));
						$ext = strtolower( $ext );
						
						$uploaded_file = $_FILES['profile']['tmp_name'];
						if( $ext == "jpg" || $ext == "jpeg" )
							$source = imagecreatefromjpeg( $uploaded_file );
						else if ( $ext == "png" )
							$source = imagecreatefrompng( $uploaded_file );
						
						$thumb_width = 50;
						$thumb_height = 50;

						$width = imagesx($source);
						$height = imagesy($source);

						$original_aspect = $width / $height;
						$thumb_aspect = $thumb_width / $thumb_height;
						
						if ( $original_aspect >= $thumb_aspect ){
						   // If image is wider than thumbnail (in aspect ratio sense)
						   $new_height = $thumb_height;
						   $new_width = $width / ($height / $thumb_height);
						} else {
						   // If the thumbnail is wider than the image
						   $new_width = $thumb_width;
						   $new_height = $height / ($width / $thumb_width);
						}

						$thumb = imagecreatetruecolor( $thumb_width, $thumb_height );
						$white = imagecolorallocate($thumb, 255, 255, 255); 
						imagefill($thumb,0,0,$white); 
						
						// Resize and crop
						imagecopyresampled($thumb,
										   $source,
										   0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
										   0 - ($new_height - $thumb_height) / 2, // Center the image vertically
										   0, 0,
										   $new_width, $new_height,
										   $width, $height);
										   //filling with white removed the white background for me.
						
						$fullname = 'profile'.uniqid(mt_rand(10, 15)).'_'.$filename;
										
						//upload file
						imagejpeg( $thumb, '../assets/images/profiles/'.$fullname, 70 );
						// I think that's it we're good to clear our created images
						imagedestroy( $source );
						imagedestroy( $thumb );
						
						if($error){
							echo '<div class="alert alert-danger">
								<strong>Warning!</strong> '. $error .' 
							</div>';
						} else {
							$ins = Database::getInstance()->editProfileUser_img($first, $last, $email,$address, $city, $state, $country, $dob, $bitcoin, $ethereum, $litecoin, $rmb, $hash, $fullname, $user_id);
							if($ins == 'Done'){
								echo '<div class="alert alert-success">
									Profile updated
							</div>';
							} else {
								echo $ins;
							}
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

function editFamily(){
		
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim($_POST['name']));

		$error = '';

		$val = $_POST['val'];

		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please fill in Company Name");

									
		if($validator->ValidateForm()){
			
		
				echo Database::getInstance()->edit_family($name,$val);
				
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function editMCharge(){
		
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim($_POST['name']));

		$amt = ucfirst(htmlspecialchars($_POST['amt']));
		$amt = ucfirst(stripslashes($_POST['amt']));
		$amt = ucfirst(trim($_POST['amt']));

		$error = '';

		$val = $_POST['val'];
		$user = $_POST['staff'];

		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please fill in Charge Name");
		$validator->addValidation("amt","req","Please fill in Charge Amount");

									
		if($validator->ValidateForm()){
			
		
				echo Database::getInstance()->edit_mcharge($name,$amt,$val,$staff);
				
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}
	
	function editPatient(){
		
				if(!isset($_FILES['file'])){
							echo '<div class="alert alert-warning">
									Please Choose Photo
								  </div>';
				}else{
					
		$title = ucfirst(htmlspecialchars($_POST['title']));
		$title = ucfirst(stripslashes($_POST['title']));
		$title = ucfirst(trim($_POST['title']));
		
		$reg_num = ucfirst(htmlspecialchars($_POST['reg_num']));
		$reg_num = ucfirst(stripslashes($_POST['reg_num']));
		$reg_num = ucfirst(trim($_POST['reg_num']));
		
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

		$address = htmlspecialchars($_POST['address']);
		$address = stripslashes($_POST['address']);
		$address = trim($_POST['address']);

		$city = htmlspecialchars($_POST['city']);
		$city = stripslashes($_POST['city']);
		$city = trim($_POST['city']);

		$state = htmlspecialchars($_POST['state']);
		$state = stripslashes($_POST['state']);
		$state = trim($_POST['state']);

		$nationality = htmlspecialchars($_POST['nationality']);
		$nationality = stripslashes($_POST['nationality']);
		$nationality = trim($_POST['nationality']);
		
		$natid = ucfirst(htmlspecialchars($_POST['natid']));
		$natid = ucfirst(stripslashes($_POST['natid']));
		$natid = ucfirst(trim($_POST['natid']));
		
		$enr = ucfirst(htmlspecialchars($_POST['enr']));
		$enr = ucfirst(stripslashes($_POST['enr']));
		$enr = ucfirst(trim($_POST['enr']));
		
		$religion = htmlspecialchars($_POST['religion']);
		$religion = stripslashes($_POST['religion']);
		$religion = trim($_POST['religion']);
		
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
		
		$nadd = htmlspecialchars($_POST['nadd']);
		$nadd = stripslashes($_POST['nadd']);
		$nadd = trim($_POST['nadd']);
		
		$pre = htmlspecialchars($_POST['pre']);
		$pre = stripslashes($_POST['pre']);
		$pre = trim($_POST['pre']);

		$card_type = htmlspecialchars($_POST['card_type']);
		$card_type = stripslashes($_POST['card_type']);
		$card_type = trim($_POST['card_type']);

		$company = htmlspecialchars($_POST['company']);
		$company = stripslashes($_POST['company']);
		$company = trim($_POST['company']);

		$family = htmlspecialchars($_POST['family']);
		$family = stripslashes($_POST['family']);
		$family = trim($_POST['family']);

		$error = '';
		$val = $_POST['val'];

		$validator = new FormValidator();
						
		$validator->addValidation("title","req","Please fill in title");
		$validator->addValidation("reg_num","req","Please fill in patient's registration number");
		$validator->addValidation("first","req","Please fill in First Name");
		$validator->addValidation("surname","req","Please fill in surname");
		$validator->addValidation("m_name","req","Please fill in first name and middle name");
		

		if($validator->ValidateForm()){
									
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
			
								
				if (EMPTY($title)) {
					$error ='Title cannot be empty';
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

				if (EMPTY($m_name)) {
					$error ='First and middle names cannot be empty';
				}
				
				
				
			if(!$check){
					if($error){
							echo '<div class="alert alert-danger">
									'. $error .' 
									</div>';
									
					}else{
						if($dob ==""){
						$age = "Elderly";
						}else{
						$tz  = new DateTimeZone('Africa/Lagos');
						$age = DateTime::createFromFormat('Y-m-d', $dob, $tz)->diff(new DateTime('now', $tz))->y;
						}
						$filee = database::getInstance()->get_name_from_id('photo','patients','id',$val);
						$oldfile = "none";
						$insert = database::getInstance()-> edit_patient($first,$surname, $m_name, $title, $reg_num, $sex, $blood, $address, $city, $state, $religion, $ethnic, $nationality, $natid, $insurance, $nhis, $enr, $age, $ageType, $dob, $tel1, $tel2, $mobile, $email, $ntel, $nadd, $pre, $filee,$oldfile, $card_type, $company,$family,$val);
						if($insert != 'yesi'){
							echo $insert;
						}else{
							echo '<div class="alert alert-success">
												Patient Updated Successfully
									</div>';
						}
					}
			}else{
				
					if (file_exists($target_dir)) {
						$error = "Image already exist";
					}
				
					if(!in_array($ext, $allowed_extensions)) {
						$error = "Image type not allowed";
					}
						
					if($error){
					echo '<div class="alert alert-danger">
						<strong>Warning!</strong> '. $error .' 
					</div>';
				}else{
					if($dob ==""){
						$age = "Elderly";
					}else{
						$tz  = new DateTimeZone('Africa/Lagos');
						$age = DateTime::createFromFormat('Y-m-d', $dob, $tz)->diff(new DateTime('now', $tz))->y;
					}
					$oldfile = database::getInstance()->get_name_from_id('photo','patients','id',$val);
					$insert = Database::getInstance()->edit_patient($first,$surname, $m_name, $title, $reg_num, $sex, $blood, $address, $city, $state, $religion, $ethnic, $nationality, $natid, $insurance, $nhis, $enr, $age, $ageType, $dob, $tel1, $tel2, $mobile, $email, $ntel, $nadd, $pre, $fullname,$oldfile, $card_type, $company,$family,$val);
					if($insert != 'yesi'){
						echo $insert;
					}else{
						if (move_uploaded_file($temp_dir, $target_dir)) {
									echo '<div class="alert alert-success">
												Patient Updated Successfully
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

function SendtoAcc2(){
		$cash = ucfirst(htmlspecialchars($_POST['cash']));
		$cash = ucfirst(stripslashes($_POST['cash']));
		$cash = ucfirst(trim($_POST['cash']));

		$pos = ucfirst(htmlspecialchars($_POST['pos']));
		$pos = ucfirst(stripslashes($_POST['pos']));
		$pos = ucfirst(trim($_POST['pos']));

		$transfer = ucfirst(htmlspecialchars($_POST['transfer']));
		$transfer = ucfirst(stripslashes($_POST['transfer']));
		$transfer = ucfirst(trim($_POST['transfer']));

		$bank_used = ucfirst(htmlspecialchars($_POST['bank']));
		$bank_used = ucfirst(stripslashes($_POST['bank']));
		$bank_used = ucfirst(trim($_POST['bank']));

		$change = ucfirst(htmlspecialchars($_POST['change']));
		$change = ucfirst(stripslashes($_POST['change']));
		$change = ucfirst(trim($_POST['change']));

		$discount = ucfirst(htmlspecialchars($_POST['discount']));
		$discount = ucfirst(stripslashes($_POST['discount']));
		$discount = ucfirst(trim($_POST['discount']));

		$val = $_POST['val'];
		$sum = $_POST['sum'];
		$error = '';
		$validator = new FormValidator();
						
		$validator->addValidation("val","req","Please Select Payment");
									
		if($validator->ValidateForm()){
			if (($cash+$pos+$transfer+$discount-$change) > $sum) {
				$error ='Entered Amount Is More Than Bill';
			}

			if (($cash+$pos+$transfer+$discount-$change) < $sum) {
				$error ='Entered Amount Is Lesser Than Bill';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->SendtoAcc2($val,$transfer,$pos,$cash,$bank_used,$change,$discount);
				if ($insert =='Done') {
						echo $insert;
						unset($_SESSION['req']);
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

function actSample(){
		$value = $_POST['val'];
		database::getInstance()->activate('samples','status',1,'id',$value);
		echo"Done";
	}

function actBloodGroup(){
		$value = $_POST['val'];
		database::getInstance()->activate('blood_groups','status',1,'blood_group_id',$value);
		echo"Done";
	}

function SendtoAcc(){
		$val = $_POST['val'];
		//$bill = $_POST['bill'];
		$error = '';
		$validator = new FormValidator(); 
						
		$validator->addValidation("val","req","Please Select Payment");
									
		if($validator->ValidateForm()){
			
				$insert = Database::getInstance()->SendtoAcc($val);
				if ($insert =='Done') {
						echo $insert;
						unset($_POST);
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

	function SendMBilltoAcc(){
		$val = $_POST['val'];
		//$bill = $_POST['bill'];
		$error = '';
		$validator = new FormValidator(); 
						
		$validator->addValidation("val","req","Please Select Payment");
									
		if($validator->ValidateForm()){
			
				$insert = Database::getInstance()->SendMBilltoAcc($val);
				if ($insert =='Done') {
						echo $insert;
						unset($_POST);
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

	function editDonor(){
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
		$value = $_POST['val'];
		
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
				$insert = Database::getInstance()->edit_donor($name, $father, $type, $dob, $weight, $blood_group,$address,$email,$phone,$value);
				if($insert == 'Done'){
						echo '<div class="alert alert-success">
							Donor Updated Successfully					
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

	function editDonation(){
		$pint = ucfirst(htmlspecialchars($_POST['pint']));
		$pint = ucfirst(stripslashes($_POST['pint']));
		$pint = ucfirst(trim($_POST['pint']));
		
		$type = $_POST['type'];
		$val = $_POST['val'];
		$doc = $_POST['doc'];
		$edit = $_POST['edit'];
		
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
				$insert = Database::getInstance()->edit_donation($pint, $type,$val,$doc,$edit);
				if($insert == 'Done'){
						echo '<div class="alert alert-success">
							Donation Updated Successfully					
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

	function editTest(){
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

		$template = lcfirst(htmlspecialchars($_POST['template']));
		$template = lcfirst(stripslashes($_POST['template']));
		$template = lcfirst(trim($_POST['template']));
		
		$error = "";
		$val = $_POST['val'];
		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please fill in Test name");
		$validator->addValidation("fee","req","Please fill in Test Fee");
		$validator->addValidation("val","req","Please select Test");
								
		if($validator->ValidateForm()){
			
			if (EMPTY($name)) {
				$error ='Test Name cannot be empty';
			}
			
			if (EMPTY($fee)) {
				$error ='Test Fee cannot be empty';
			}
			
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->edit_test($name, $fee, $type,$template, $nvalue, $nrange, $rrange, $val);
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

	function editTest2(){
		$fee = ucfirst(htmlspecialchars($_POST['fee']));
		$fee = ucfirst(stripslashes($_POST['fee']));
		$fee = ucfirst(trim($_POST['fee']));
		
		
		$error = "";
		$tname = $_POST['tname'];
		$val = $_POST['val'];
		$validator = new FormValidator();
						
		$validator->addValidation("fee","req","Please fill in Test Fee");
		$validator->addValidation("val","req","Please select Test");
								
		if($validator->ValidateForm()){
			
			
			if (EMPTY($fee)) {
				$error ='Test Fee cannot be empty';
			}
			
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->edit_test2($fee, $tname, $val);
				if($insert == 'Done'){
						echo '<div class="alert alert-success">
							Test Updated Successfully					
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

	function editScan(){
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
		$val = $_POST['val'];
		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please fill in Scan name");
		$validator->addValidation("fee","req","Please fill in Scan Fee");
		$validator->addValidation("type","req","Please select Scan Category");
								
		if($validator->ValidateForm()){
			
			if (EMPTY($name)) {
				$error ='Scan Name cannot be empty';
			}
			
			if (EMPTY($fee)) {
				$error ='Scan Fee cannot be empty';
			}
			
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->edit_scan($name, $fee, $type, $val);
				if($insert == 'Done'){
						echo '<div class="alert alert-success">
							Scan Updated Successfully					
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

	function editXray(){
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
		$val = $_POST['val'];
		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please fill in Xray name");
		$validator->addValidation("fee","req","Please fill in Xray Fee");
		$validator->addValidation("type","req","Please select Xray Category");
								
		if($validator->ValidateForm()){
			
			if (EMPTY($name)) {
				$error ='Xray Name cannot be empty';
			}
			
			if (EMPTY($fee)) {
				$error ='Xray Fee cannot be empty';
			}
			
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->edit_xray($name, $fee, $type, $val);
				if($insert == 'Done'){
						echo '<div class="alert alert-success">
							Xray Updated Successfully					
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


	function newTestResult(){
		$result = ucfirst(htmlspecialchars($_POST['result']));
		$result = ucfirst(stripslashes($_POST['result']));
		$result = ucfirst(trim($_POST['result']));
		
		$o = ucfirst(htmlspecialchars($_POST['o']));
		$o = ucfirst(stripslashes($_POST['o']));
		$o = ucfirst(trim($_POST['o']));
		
		$h = ucfirst(htmlspecialchars($_POST['h']));
		$h = ucfirst(stripslashes($_POST['h']));
		$h = ucfirst(trim($_POST['h']));
		
		$remark = lcfirst(htmlspecialchars($_POST['remarks']));
		$remark = lcfirst(stripslashes($_POST['remarks']));
		$remark = lcfirst(trim($_POST['remarks']));
		
		$val = $_POST['val'];
		$link = $_POST['link'];
		$error = "";
		$validator = new FormValidator();

		$validator->addValidation("val","req","Please select Test");
		$validator->addValidation("link","req","Please select Test Group");
								
		if($validator->ValidateForm()){
			
			if ((EMPTY($result)) && (EMPTY($o)) && (EMPTY($h))) {
				$error ='Result, O or H field cannot be empty, one must be filled';
			}
			
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$stat =1;
				$insert = Database::getInstance()->insert_test_result($result, $o, $h, $remark, $stat, $val, $link);
				if($insert == 'Done'){
						echo '<div class="alert alert-success">
							Test result Updated Successfully					
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

	
	function my_simple_crypt( $string, $action = 'e' ) {
			// you may change these values to your own
			$secret_key = '123456789876543212';
			$secret_iv = 'abcdefrgthytujkloinbvfd';
		 
			$output = false;
			$encrypt_method = "AES-256-CBC";
			$key = hash( 'sha256', $secret_key );
			$iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
		 
			if( $action == 'e' ) {
				$output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
			}
			else if( $action == 'd' ){
				$output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
			}
		 
			return $output;
	}
	function editTax(){
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
		$val = $_POST['id'];
		$error = '';
			
		$insert = Database::getInstance()->edit_tax($name,$percentage,$status,$user,$val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
						Tax Updated successfully					
					</div>';
				} else {
					echo $insert;
				}
	}

	function editDoc(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim($_POST['name']));
		
		$phone = ucfirst(htmlspecialchars($_POST['phone']));
		$phone = ucfirst(stripslashes($_POST['phone']));
		$phone = ucfirst(trim($_POST['phone']));
		
		$error = '';

		$val = $_POST['val'];

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
				$insert = Database::getInstance()->edit_doc($name, $phone, $val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Doctor Edited Successfully					
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
	
	function editBed(){
		
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
		
		$error = '';

		$val = $_POST['val'];

		$validator = new FormValidator();
						
		$validator->addValidation("bed","req","Please fill in Bed Number");
		$validator->addValidation("type","req","Please fill in Bed Type");
		$validator->addValidation("charge","req","Please fill in Bed Charge");
									
		if($validator->ValidateForm()){
			
		
				echo Database::getInstance()->edit_bed($bed,$type,$charge,$description, $val);
				
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function editMBed(){
		
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
		
		$error = '';

		$val = $_POST['val'];

		$validator = new FormValidator();
						
		$validator->addValidation("bed","req","Please fill in Bed Number");
		$validator->addValidation("type","req","Please fill in Bed Type");
		$validator->addValidation("charge","req","Please fill in Bed Charge");
									
		if($validator->ValidateForm()){
			
		
				echo Database::getInstance()->edit_mbed($bed,$type,$charge,$description, $val);
				
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function editBedType(){
		
		$bed = ucfirst(htmlspecialchars($_POST['bed']));
		$bed = ucfirst(stripslashes($_POST['bed']));
		$bed = ucfirst(trim($_POST['bed']));
		
		$error = '';

		$val = $_POST['val'];

		$validator = new FormValidator();
						
		$validator->addValidation("bed","req","Please fill in Bed Number");
									
		if($validator->ValidateForm()){
			
		
				echo Database::getInstance()->edit_bed($bed, $val);
				
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}

	function editCompany(){
		
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim($_POST['name']));

		$addr = ucfirst(htmlspecialchars($_POST['address']));
		$addr = ucfirst(stripslashes($_POST['address']));
		$addr = ucfirst(trim($_POST['address']));
		
		$phone = ucfirst(htmlspecialchars($_POST['phone']));
		$phone = ucfirst(stripslashes($_POST['phone']));
		$phone = ucfirst(trim($_POST['phone']));

		$email = ucfirst(htmlspecialchars($_POST['email']));
		$email = ucfirst(stripslashes($_POST['email']));
		$email = ucfirst(trim($_POST['email']));

		$branch = ucfirst(htmlspecialchars($_POST['branch']));
		$branch = ucfirst(stripslashes($_POST['branch']));
		$branch = ucfirst(trim($_POST['branch']));

		$staff_no = ucfirst(htmlspecialchars($_POST['staff_no']));
		$staff_no = ucfirst(stripslashes($_POST['staff_no']));
		$staff_no = ucfirst(trim($_POST['staff_no']));

		$error = '';

		$val = $_POST['val'];

		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please fill in Company Name");
		$validator->addValidation("address","req","Please fill in Company Address");
		$validator->addValidation("phone","req","Please fill in Company Phone");
		$validator->addValidation("email","req","Please fill in Company Email");
		$validator->addValidation("branch","req","Please fill in Branch Number");
		$validator->addValidation("staff_no","req","Please fill in Branch Staff Number");

									
		if($validator->ValidateForm()){
			
		
				echo Database::getInstance()->edit_company($name,$addr,$phone,$email,$branch,$staff_no,$val);
				
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}
	
	function changeRoom(){
		$doc = $_POST['val'];
		$room = $_POST['room'];
		$error = '';
		$validator = new FormValidator();
						
		$validator->addValidation("val","req","Pls Login Again");
		$validator->addValidation("room","req","Pls Select A Consulting Room");
									
		if($validator->ValidateForm()){
			
				echo $insert = Database::getInstance()->change_room($doc,$room);
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}
	function editAdmissionStatus(){
		
		$status = ucfirst(htmlspecialchars($_POST['status']));
		$status = ucfirst(stripslashes($_POST['status']));
		$status = ucfirst(trim($_POST['status']));
		
		$error = '';

		$val = $_POST['val'];

		$validator = new FormValidator();
						
		$validator->addValidation("status","req","Please Select Status");
									
		if($validator->ValidateForm()){
			
		
				echo Database::getInstance()->edit_admission_status($status, $val);
				
		} else {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> ' . $inp_err . '
				</div>';
			}
		}
	}
	
	function editSche(){
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

		$val = $_POST['val'];

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
				$insert = Database::getInstance()->edit_shce($dayofweek, $timein, $timeout, $dateday, $doctor, $val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Schedule Edited Successfully					
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

	function addVitals(){
		$temp = ucfirst(htmlspecialchars($_POST['temp']));
		$temp = ucfirst(stripslashes($_POST['temp']));
		$temp = ucfirst(trim($_POST['temp']));
	
		$height = ucfirst(htmlspecialchars($_POST['height']));
		$height = ucfirst(stripslashes($_POST['height']));
		$height = ucfirst(trim($_POST['height']));
		
		
		$weight = ucfirst(htmlspecialchars($_POST['weight']));
		$weight = ucfirst(stripslashes($_POST['weight']));
		$weight = ucfirst(trim($_POST['weight']));

		$bpsis = ucfirst(htmlspecialchars($_POST['sssit']));
		$bpsis = ucfirst(stripslashes($_POST['sssit']));
		$bpsis = ucfirst(trim($_POST['sssit']));
		
		$dssit = ucfirst(htmlspecialchars($_POST['dssit']));
		$dssit = ucfirst(stripslashes($_POST['dssit']));
		$dssit = ucfirst(trim($_POST['dssit']));
		
		$bpsts = ucfirst(htmlspecialchars($_POST['ssstand']));
		$bpsts = ucfirst(stripslashes($_POST['ssstand']));
		$bpsts = ucfirst(trim($_POST['ssstand']));
		
		$bpstd = ucfirst(htmlspecialchars($_POST['dsstand']));
		$bpstd = ucfirst(stripslashes($_POST['dsstand']));
		$bpstd = ucfirst(trim($_POST['dsstand']));
		
		$pulse = ucfirst(htmlspecialchars($_POST['pulse']));
		$pulse = ucfirst(stripslashes($_POST['pulse']));
		$pulse = ucfirst(trim($_POST['pulse']));
		
		$bmi = ucfirst(htmlspecialchars($_POST['bmi']));
		$bmi = ucfirst(stripslashes($_POST['bmi']));
		$bmi = ucfirst(trim($_POST['bmi']));
		
		$spo2 = ucfirst(htmlspecialchars($_POST['spo2']));
		$spo2 = ucfirst(stripslashes($_POST['spo2']));
		$spo2 = ucfirst(trim($_POST['spo2']));
		
		
		$rbp = ucfirst(htmlspecialchars($_POST['rbp']));
		$rbp = ucfirst(stripslashes($_POST['rbp']));
		$rbp = ucfirst(trim($_POST['rbp']));
		
		
		$rds = ucfirst(htmlspecialchars($_POST['rds']));
		$rds = ucfirst(stripslashes($_POST['rds']));
		$rds = ucfirst(trim($_POST['rds']));
		
		$respiratory = ucfirst(htmlspecialchars($_POST['respiratory']));
		$respiratory = ucfirst(stripslashes($_POST['respiratory']));
		$respiratory = ucfirst(trim($_POST['respiratory']));
		
		
		
		$complaint = ucfirst(htmlspecialchars($_POST['complaint']));
		$complaint = ucfirst(stripslashes($_POST['complaint']));
		$complaint = ucfirst(trim($_POST['complaint']));
		
		
		$allergies = ucfirst(htmlspecialchars($_POST['allergies']));
		$allergies = ucfirst(stripslashes($_POST['allergies']));
		$allergies = ucfirst(trim($_POST['allergies']));
		$error = '';
		if (isset($_POST['edit'])) {
			$edit = $_POST['edit'];
		}else{
			$edit = 0;
		}

		$val = $_POST['val'];
		$nurse = $_POST['me'];

		$validator = new FormValidator();
						
		
									
		if($validator->ValidateForm()){
			
		
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->edit_vitals($bpsts, $bpstd, $bpsis, $dssit, $pulse, $rds, $temp,$height, $weight,$bmi,$spo2, $allergies, $rbp,  $complaint, $respiratory, $val,$nurse,$edit);
				if($insert == 'Done'){
					if ($edit == 1) {
						echo '<div class="alert alert-success">
							Vitals Updated successfully					
						</div>';
					}else{
						echo '<div class="alert alert-success">
							Vitals Added successfully					
						</div>';
					}
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

	function extraTest(){
		$ecg = ucfirst(htmlspecialchars($_POST['ecg']));
		$ecg = ucfirst(stripslashes($_POST['ecg']));
		$ecg = ucfirst(trim($_POST['ecg']));
		
		$ech = ucfirst(htmlspecialchars($_POST['ech']));
		$ech = ucfirst(stripslashes($_POST['ech']));
		$ech = ucfirst(trim($_POST['ech']));
		$val = $_POST['val'];
		$error = "";
			if ((EMPTY($ecg)) && (EMPTY($ech))) {
				$error ='One test as to be taken before field can be submitted';
			}
			if (EMPTY($val)) {
				$error ='Please choose Patient';
			}
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->extra_test($ecg, $ech, $val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Extra Test added Successfully					
						</div>';
				} else {
					echo $insert;
				}
			}
		
	}
	
	
	function editTGroup(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim(ucfirst($_POST['name'])));
		$val = $_POST['val'];
		
		$error = '';
		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please ENTER Group Name");
									
		if($validator->ValidateForm()){
			if (EMPTY($name)) {
				$error ='Group Name cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->edit_tgroup($name,$val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Group Updated
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

	
	function editBloodGroup(){
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
				$insert = Database::getInstance()->edit_blood_group($name,$val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Blood Group Updated Successfully
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


	function editSample(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim(ucfirst($_POST['name'])));
		$id = $_POST['id'];
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
				$insert = Database::getInstance()->edit_sample($name,$id,$val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Sample Updated Successfully
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


	function editTestType(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim(ucfirst($_POST['name'])));
		$val = $_POST['val'];
		
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
				$insert = Database::getInstance()->edit_test_type($name,$val);
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

	function editTreatment_i(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim(ucfirst($_POST['name'])));

		$fee = ucfirst(htmlspecialchars($_POST['fee']));
		$fee = ucfirst(stripslashes($_POST['fee']));
		$fee = ucfirst(trim(ucfirst($_POST['fee'])));

		$val = $_POST['val'];
		$user = $_POST['user'];
		
		$error = '';
		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please ENTER Treatment Name");
									
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
				$insert = Database::getInstance()->edit_treatment_i($name,$fee,$val,$user);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Treatment Updated Successfully
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

	function changeCstatus(){
		$name = ucfirst(htmlspecialchars($_POST['status']));
		$name = ucfirst(stripslashes($_POST['status']));
		$name = ucfirst(trim(ucfirst($_POST['status'])));

		$staff = $_POST['staff'];
		$val = $_POST['val'];
		
		$error = '';
		$validator = new FormValidator();
						
		$validator->addValidation("status","req","Please Select Status");
		$validator->addValidation("staff","req","Please Enter Number Of Enrollees");
									
		if($validator->ValidateForm()){

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->changeCstatus($staff,$name,$val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Status Changed
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

	function editTariff(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim(ucfirst($_POST['name'])));

		$group = $_POST['group'];
		$val = $_POST['val'];
		
		$error = '';
		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please Input Tariff");
									
		if($validator->ValidateForm()){
			if (EMPTY($name)) {
				$error ='Tariff cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->edit_tariff($name,$group,$val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Tariff Name Updated Successfully!
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

	function editRevenueType(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim(ucfirst($_POST['name'])));
		
		$val = $_POST['val'];
		
		$error = '';
		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please Input Type");
									
		if($validator->ValidateForm()){
			if (EMPTY($name)) {
				$error ='Type cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->edit_revenue($name,$val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Revenue Type Updated Successfully!
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

	function editCategory(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim(ucfirst($_POST['name'])));
		$val = $_POST['val'];
		
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
				$insert = Database::getInstance()->edit_Category($name,$val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Category Updated
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

	function editCategory1(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim(ucfirst($_POST['name'])));
		$val = $_POST['val'];
		
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
				$insert = Database::getInstance()->edit_Category1($name,$val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Category Updated
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
	
	
	function editCat(){
		$cat_name = ucfirst(htmlspecialchars($_POST['cat_name']));
		$cat_name = ucfirst(stripslashes($_POST['cat_name']));
		$cat_name = ucfirst(trim($_POST['cat_name']));
		
		$error = '';

		$val = $_POST['id'];

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
				$insert = Database::getInstance()->edit_cat($cat_name, $val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Category edited successfully					
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

	function editUnit(){
		$unit_name = ucfirst(htmlspecialchars($_POST['unit_name']));
		$unit_name = ucfirst(stripslashes($_POST['unit_name']));
		$unit_name = ucfirst(trim($_POST['unit_name']));
		
		$error = '';

		$val = $_POST['id'];

		$validator = new FormValidator();
						
		$validator->addValidation("unit_name","req","Please enter name of unit");
									
		if($validator->ValidateForm()){
			
										
			if (EMPTY($unit_name)) {
				$error ='Unit cannot be empty';
			}
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->edit_unit($unit_name, $val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Unit edited successfully					
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

	function editCUnit(){
		$unit_name = ucfirst(htmlspecialchars($_POST['unit_name']));
		$unit_name = ucfirst(stripslashes($_POST['unit_name']));
		$unit_name = ucfirst(trim($_POST['unit_name']));
		
		$error = '';

		$val = $_POST['id'];

		$validator = new FormValidator();
						
		$validator->addValidation("unit_name","req","Please enter name of unit");
									
		if($validator->ValidateForm()){
			
										
			if (EMPTY($unit_name)) {
				$error ='Unit cannot be empty';
			}
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->edit_cunit($unit_name, $val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Unit edited successfully					
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

	function editForm(){
		$form_name = ucfirst(htmlspecialchars($_POST['form_name']));
		$form_name = ucfirst(stripslashes($_POST['form_name']));
		$form_name = ucfirst(trim($_POST['form_name']));
		
		$error = '';

		$val = $_POST['id'];

		$validator = new FormValidator();
						
		$validator->addValidation("form_name","req","Please enter name of Form");
									
		if($validator->ValidateForm()){
			
										
			if (EMPTY($form_name)) {
				$error ='Form cannot be empty';
			}
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->edit_form($form_name, $val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Form edited successfully					
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

	function editStock1(){
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
		$usage = $_POST['usage'];
		$error = '';

		$val = $_POST['id'];

		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please enter name of item");
		$validator->addValidation("cat","req","Please enter cat of item");
		$validator->addValidation("unit","req","Please enter unit of item");
		$validator->addValidation("cost","req","Please enter cost of item");
		$validator->addValidation("price","req","Please enter price of item");						
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
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->edit_stock1($name, $cat, $unit,$usage,$cprice, $price, $val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Stock edited successfully					
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

	function editStock(){
		$stock = ucfirst(htmlspecialchars($_POST['stock']));
		$stock = ucfirst(stripslashes($_POST['stock']));
		$stock = ucfirst(trim($_POST['stock']));
		
		$error = '';

		$val = $_POST['id'];
		$staff = $_POST['staff'];

		$validator = new FormValidator();
		$validator->addValidation("stock","req","Please enter stock of item");							
		if($validator->ValidateForm()){

			if (EMPTY($stock)) {
				$error ='Stock cannot be empty';
			}
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->edit_stock($stock, $val,$staff);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Stock edited successfully					
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

	function UpdateStock(){
		$qty = ucfirst(htmlspecialchars($_POST['qty']));
		$qty = ucfirst(stripslashes($_POST['qty']));
		$qty = ucfirst(trim($_POST['qty']));

		$status = $_POST['status'];
		
		$error = '';

		$val = $_POST['id'];
		$staff = $_POST['staff'];

		$validator = new FormValidator();
						
		$validator->addValidation("status","req","Please enter status of item");
		$validator->addValidation("qty","req","Please enter quantity of item");						
		if($validator->ValidateForm()){							
			
			if (EMPTY($status)) {
				$error ='Status cannot be empty';
			}

			if (EMPTY($qty)) {
				$error ='quantity cannot be empty';
			}
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->update_stock($qty, $status,$val,$staff);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Stock Updated successfully					
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

	function editStock2(){
		$price = ucfirst(htmlspecialchars($_POST['price']));
		$price = ucfirst(stripslashes($_POST['price']));
		$price = ucfirst(trim($_POST['price']));
		$error = '';

		$val = $_POST['id'];
		$tname = $_POST['tname'];

		$validator = new FormValidator();
						
		$validator->addValidation("price","req","Please enter price of item");						
		if($validator->ValidateForm()){

			if (EMPTY($price)) {
				$error ='Price cannot be empty';
			}
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->edit_stock2($price, $tname, $val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Stock Updated successfully!					
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

	function editIPD(){
		$admin_no = ucfirst(htmlspecialchars($_POST['admin_no']));
		$admin_no = ucfirst(stripslashes($_POST['admin_no']));
		$admin_no = ucfirst(trim($_POST['admin_no']));
		
		$referred = ucfirst(htmlspecialchars($_POST['referred']));
		$referred = ucfirst(stripslashes($_POST['referred']));
		$referred = ucfirst(trim($_POST['referred']));
		
		$doctor = ucfirst(htmlspecialchars($_POST['doctor']));
		$doctor = ucfirst(stripslashes($_POST['doctor']));
		$doctor = ucfirst(trim($_POST['doctor']));

		$nurse = ucfirst(htmlspecialchars($_POST['nurse']));
		$nurse = ucfirst(stripslashes($_POST['nurse']));
		$nurse = ucfirst(trim($_POST['nurse']));
		
		$ward = htmlspecialchars($_POST['ward']);
		$ward = stripslashes($_POST['ward']);
		$ward = trim($_POST['ward']);

		$bed_num = htmlspecialchars($_POST['bed_num']);
		$bed_num = stripslashes($_POST['bed_num']);
		$bed_num = trim($_POST['bed_num']);

		$dis_date = htmlspecialchars($_POST['dis_date']);
		$dis_date = stripslashes($_POST['dis_date']);
		$dis_date = trim($_POST['dis_date']);

		$id = trim($_POST['id']);

		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("admin_no","req","Please fill in admission number");
		$validator->addValidation("referred","req","Please fill in referral");
		$validator->addValidation("doctor","req","Please fill in doctor");
		$validator->addValidation("ward","req","Please fill in ward");
		$validator->addValidation("bed_num","req","Please fill in bed number");	
		$validator->addValidation("nurse","req","Please fill in nurse");

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

			if (EMPTY($nurse)) {
				$error ='Nurse cannot be empty';
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
				
					$insert = Database::getInstance()->edit_ipd($admin_no, $referred, $doctor, $ward, $bed_num, $nurse, $dis_date, $id);
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

	function processDeceased(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim($_POST['name']));
		
		$sex = ucfirst(htmlspecialchars($_POST['sex']));
		$sex = ucfirst(stripslashes($_POST['sex']));
		$sex = ucfirst(trim($_POST['sex']));
		
		$kname = ucfirst(htmlspecialchars($_POST['kname']));
		$kname = ucfirst(stripslashes($_POST['kname']));
		$kname = ucfirst(trim($_POST['kname']));

		$kphone = ucfirst(htmlspecialchars($_POST['kphone']));
		$kphone = ucfirst(stripslashes($_POST['kphone']));
		$kphone = ucfirst(trim($_POST['kphone']));

		$kaddress = ucfirst(htmlspecialchars($_POST['kaddress']));
		$kaddress = ucfirst(stripslashes($_POST['kaddress']));
		$kaddress = ucfirst(trim($_POST['kaddress']));		

		$krel = ucfirst(htmlspecialchars($_POST['krel']));
		$krel = ucfirst(stripslashes($_POST['krel']));
		$krel = ucfirst(trim($_POST['krel']));
		
		$room = htmlspecialchars($_POST['room']);
		$room = stripslashes($_POST['room']);
		$room = trim($_POST['room']);

		$bed_num = htmlspecialchars($_POST['bed_num']);
		$bed_num = stripslashes($_POST['bed_num']);
		$bed_num = trim($_POST['bed_num']);

		$tag = htmlspecialchars($_POST['tag']);
		$tag = stripslashes($_POST['tag']);
		$tag = trim($_POST['tag']);

		$serial = htmlspecialchars($_POST['serial']);
		$serial = stripslashes($_POST['serial']);
		$serial = trim($_POST['serial']);

		$id = trim($_POST['id']);
		$staff = trim($_POST['staff']);
		$type = $_POST['type'];

		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("bed_num","req","Please Select Bed");

		if($validator->ValidateForm()){
										
			if (EMPTY($bed_num)) {
				$error ='Bed number cannot be empty';
			}
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				
					$insert = Database::getInstance()->process_deceased($name, $sex, $kname, $kaddress,$kphone,$krel,$room, $bed_num, $tag, $serial,$type, $id,$staff);
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
	
	function editObs(){
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
		$val = $_POST['val'];

		$validator = new FormValidator();
						
		$validator->addValidation("temp","req","Please enter Temp");
		$validator->addValidation("resr","req","Please enter Resr");
		$validator->addValidation("pulse","req","Please enter Pulse");
		$validator->addValidation("bp","req","Please enter BP");
		$validator->addValidation("intake","req","Please enter Intake");
		$validator->addValidation("output","req","Please enter Output");
		$validator->addValidation("val","req","Please select Chart");
									
		if($validator->ValidateForm()){
			
				$insert = Database::getInstance()->edit_obs($temp, $resr, $pulse, $bp, $intake, $output, $val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Observation updated					
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

	function editDis(){
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
		$val = $_POST['val'];

		$validator = new FormValidator();
						
		$validator->addValidation("pharm","req","Please select drug");
		$validator->addValidation("dosage","req","Please enter dosage");
		$validator->addValidation("meth","req","Please enter Method Of Administration");
		$validator->addValidation("val","req","Please select a Chart");
									
		if($validator->ValidateForm()){
			
				$insert = Database::getInstance()->edit_dis($pharm, $dosage, $meth, $remark, $val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Dispensing chart updated					
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

	function editFluid(){
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
		$val = $_POST['val'];

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
		$validator->addValidation("val","req","Please select a Chart");
									
		if($validator->ValidateForm()){
			
				$insert = Database::getInstance()->edit_fluid($nature, $oral, $rectal, $iv, $other1, $total1, $urine, $vomit, $tube, $other2, $total2, $balance, $chloride, $val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Fluid Chart updated					
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

	function editStaff(){	
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

		$img = htmlspecialchars($_POST['image']);
		$img = stripslashes($_POST['image']);
		$img = trim($_POST['image']);

		$val = $_POST['val'];
		$uploaderror = "";
		
		$validator = new FormValidator();
								
		$validator->addValidation("first_name","req","Please fill in first name");
		$validator->addValidation("last_name","req","Please fill in last name");
		$validator->addValidation("username","req","Please fill in username");
		$validator->addValidation("role","req","Please fill in role");
		
									
		if($validator->ValidateForm()){
			if (!preg_match("/^[A-Z][a-zA-Z -]+$/",$first_name)) {
				$error = 'First Name must contain only letters.';
			}
										
			if (!preg_match("/^[A-Z][a-zA-Z -]+$/",$last_name)) {
				$error ='Last Name must contain only letters.';
			}
			
			
			//for password
			//check if password is empty
			if($password == "" || $cpass == ""){
				//get teh value from db
				$hash = Database::getInstance()->select_pass($val);
			} else {
				$hash = password_hash($password, PASSWORD_DEFAULT);
			}
			
			$insert =  Database::getInstance()->edit_staff($first_name, $last_name,$other_names,$address,$phone,$dob,$pob,$sex,$mstatus,$nok,$pnok,$state,$lga,$doe,$salary,$noc,$child1,$child2,$child3,$child4,$weight,$img, $username, $role, $hash, $position,$ward,$val);
				
			if($insert == 'Done'){
				echo '<div class="alert alert-success">
						Staff updated
						</div>';
			}else{
				echo $insert;
			}
	
		}else{
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				echo '<div class="alert alert-danger">
						' . $inp_err . '
				</div>';
			}
		}
	}

	function editCard(){
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim($_POST['name']));
		
		$cost = ucfirst(htmlspecialchars($_POST['cost']));
		$cost = ucfirst(stripslashes($_POST['cost']));
		$cost = ucfirst(trim($_POST['cost']));
		
		$error = '';

		$val = $_POST['id'];

		$validator = new FormValidator();
						
		$validator->addValidation("name","req","Please enter card type");
		$validator->addValidation("cost","req","Please enter cost");
						
		if($validator->ValidateForm()){
										
			if (EMPTY($name)) {
				$error ='Card type cannot be empty';
			}

			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->edit_card($name, $cost, $val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Card type edited successfully					
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
	
	function editAntenatal(){
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
		
		$val = $_POST['edit'];
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
				$insert = Database::getInstance()->edit_antenatal($surname,$first_name,$hosp_num,$instruction,$address,$preg_duration,$age,$marriage_age,$lmp,$tribe,$occupation,$edd,$val);
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

	function editAntenatal_N(){
		$hypertension = ucfirst(htmlspecialchars($_POST['hypertension']));
		$hypertension = ucfirst(stripslashes($_POST['hypertension']));
		$hypertension = ucfirst(trim($_POST['hypertension']));
		
		$chest = ucfirst(htmlspecialchars($_POST['chest_disease']));
		$chest = ucfirst(stripslashes($_POST['chest_disease']));
		$chest = ucfirst(trim($_POST['chest_disease']));
		
		$anaemia = lcfirst(htmlspecialchars($_POST['anaemia']));
		$anaemia = lcfirst(stripslashes($_POST['anaemia']));
		$anaemia = lcfirst(trim($_POST['anaemia']));
		
		$heart = lcfirst(htmlspecialchars($_POST['heart_disease']));
		$heart = lcfirst(stripslashes($_POST['heart_disease']));
		$heart = lcfirst(trim($_POST['heart_disease']));
		
		$kidney = htmlspecialchars($_POST['kidney_disease']);
		$kidney = stripslashes($_POST['kidney_disease']);
		$kidney = trim($_POST['kidney_disease']);
		
		$blood = htmlspecialchars($_POST['blood_transfusion']);
		$blood = stripslashes($_POST['blood_transfusion']);
		$blood = trim($_POST['blood_transfusion']);
		
		$git = htmlspecialchars($_POST['git_disease']);
		$git = stripslashes($_POST['git_disease']);
		$git = trim($_POST['git_disease']);
		
		$diabetes = htmlspecialchars($_POST['diabetes']);
		$diabetes = stripslashes($_POST['diabetes']);
		$diabetes = trim($_POST['diabetes']);
		
		$operation = htmlspecialchars($_POST['operation']);
		$operation = stripslashes($_POST['operation']);
		$operation = trim($_POST['operation']);

		$adm = htmlspecialchars($_POST['adm_lst_preg']);
		$adm = stripslashes($_POST['adm_lst_preg']);
		$adm = trim($_POST['adm_lst_preg']);

		$g = htmlspecialchars($_POST['g']);
		$g = stripslashes($_POST['g']);
		$g = trim($_POST['g']);

		$p1 = htmlspecialchars($_POST['p1']);
		$p1 = stripslashes($_POST['p1']);
		$p1 = trim($_POST['p1']);

		$f = htmlspecialchars($_POST['f']);
		$f = stripslashes($_POST['f']);
		$f = trim($_POST['f']);

		$p2 = htmlspecialchars($_POST['p2']);
		$p2 = stripslashes($_POST['p2']);
		$p2 = trim($_POST['p2']);

		$a = htmlspecialchars($_POST['a']);
		$a = stripslashes($_POST['a']);
		$a = trim($_POST['a']);

		$l = htmlspecialchars($_POST['l']);
		$l = stripslashes($_POST['l']);
		$l = trim($_POST['l']);
		
		$val = $_POST['edit'];
		$staff = $_POST['staff'];
		$error = '';

		$validator = new FormValidator();
						
		$validator->addValidation("edit","req","Please form");
									
		if($validator->ValidateForm()){
						
			if (EMPTY($val)) {
				$error ='form cannot be empty';
			}						
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->edit_antenatal_N($hypertension,$chest,$anaemia,$heart,$kidney,$blood,$git,$diabetes,$operation,$adm,$g,$p1,$f,$p2,$a,$l,$staff,$val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
						Previous Medical History Successfully Updated				
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
	
	function editAnte(){			
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
		
		$val = $_POST['id'];
		
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
				$insert = Database::getInstance()->edit_ante($name, $pos, $sex, $dob, $house_num, $town, $village, $ward, $state, $lga, $mother_name,$mother_phone,$father_name, $father_phone, $cg, $cg_phone,
		$DataArr, $weigh, $twin, $fed, $support, $underweight, $exta_care, $bnum1, $v1, $dg1, $dn1, $cm1,$bnum2, $v2, $dg2, $dn2, $cm2,
		$bnum3, $v3, $dg3, $dn3, $cm3,$bnum4, $v4, $dg4, $dn4, $cm4, $bnum5, $v5, $dg5, $dn5, $cm5, $bnum6, $v6, $dg6, $dn6, $cm6, $bnum7, $v7, $dg7, $dn7, $cm7,
		$bnum8, $v8, $dg8, $dn8, $cm8, $bnum9, $v9, $dg9, $dn9, $cm9, $bnum10, $v10, $dg10, $dn10, $cm10, $bnum11, $v11, $dg11, $dn11, $cm11,
		$bnum12, $v12, $dg12, $dn12, $cm12, $bnum13, $v13, $dg13, $dn13, $cm13, $bnum15, $v15, $dg15, $dn15, $cm15, $bnum16, $v16, $dg16, $dn16, $cm16,
		$bnum17, $v17, $dg17, $dn17, $cm17, $bnum18, $v18, $dg18, $dn18, $cm18, $bnum19, $v19, $dg19, $dn19, $cm19, $bnum20, $v20, $dg20, $dn20, $cm20,
		$bnum21, $v21, $dg21, $dn21, $cm21,$DataArr2, $val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Antenatal updated successfully
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
	
	function editExp(){
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
		
		$error = '';

		$val = $_POST['id'];

		$insert = Database::getInstance()->edit_expi($date_a, $code, $description, $approver, $recipient, $qty, $amt, $cash, $comment, $val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Expense updated successfully					
						</div>';
				} else {
					echo $insert;
				}
	}

	function editCost(){
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
		
		$error = '';

		$val = $_POST['id'];

		$insert = Database::getInstance()->edit_cost($date_a, $code, $description, $approver, $recipient, $qty, $amt, $cash, $comment, $val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Cost updated successfully					
						</div>';
				} else {
					echo $insert;
				}
	}
	
	
	function editBall(){
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
		
		$val = $_POST['id'];

		$validator = new FormValidator();
						
		
		if($validator->ValidateForm()){
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->edit_c_bal($c_date, $description, $amt, $cash, $comment, $type, $val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
						Balance updated successfully					
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

	function editCharge(){		
		$amt = htmlspecialchars($_POST['amt']);
		$amt = stripslashes($_POST['amt']);
		$amt = trim($_POST['amt']);
		
		$name = htmlspecialchars($_POST['name']);
		$name = stripslashes($_POST['name']);
		$name = trim($_POST['name']);
		
		$error = '';
		
		$val = $_POST['id'];

		$validator = new FormValidator();
						
		
		if($validator->ValidateForm()){
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->edit_charge($amt, $name, $val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
						Charge updated successfully					
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
	
	function editStat(){
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

		$val = $_POST['id'];

		$validator = new FormValidator();
					
		if($validator->ValidateForm()){
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->edit_stat($morn, $bed, $v_bed, $t_pt, $adm, $disc, $delivery, $cs, $labour, $trans, $death, $comment, $val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
							Duty check edited successfully					
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
	
	function getFieldsEdit(){		
		$error = '';
		
		$t_id = ucfirst(htmlspecialchars($_POST['temp']));
		$t_id = ucfirst(stripslashes($_POST['temp']));
		$t_id = ucfirst(trim($_POST['temp']));

		$validator = new FormValidator();
										
		if($validator->ValidateForm()){																	
			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			} else{
				$insert = Database::getInstance()->get_fields_edit($t_id);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
						Form added						
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
	
	function editTestResTemp(){
		
		$error = '';
		
		$name = ucfirst(htmlspecialchars($_POST['name']));
		$name = ucfirst(stripslashes($_POST['name']));
		$name = ucfirst(trim($_POST['name']));
		
		
		$temp = $_POST['val'];
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
				$cardDets = Database::getInstance()->select_from_where2('lab_temps', 'label_id', $temp);	
				foreach($cardDets as $row):
					$name = strtolower($row['temp_name']);
					$name_id = strtolower($row['id']);
					$value = strtolower(htmlspecialchars($_POST[$name]));
					$value = strtolower(stripslashes($_POST[$name]));
					$value = strtolower(trim($_POST[$name]));
					$value = strtolower(preg_replace("/[^A-Za-z0-9]/", "", $_POST[$name]));
					$value = strtolower(str_replace(" ", "_", $_POST[$name]));
					$insert = Database::getInstance()->insert_ress($p_id, $test, $id, $value, $temp, $name_id);	
				endforeach;	
				
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
	
	function editTempy(){
		$error = '';
		
		$name = $_POST['name'];
		
		
		$val = $_POST['val'];
		
		$validator = new FormValidator();

		if($validator->ValidateForm()){			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->edit_tempy($name, $val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
						Updated successfully					
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
	
	function editTempa(){
		$error = '';
		
		$temp_name = ucfirst(htmlspecialchars($_POST['temp_name']));
		$temp_name = ucfirst(stripslashes($_POST['temp_name']));
		$temp_name = ucfirst(trim($_POST['temp_name']));
		
		$val = $_POST['val'];
		
		$validator = new FormValidator();

		if($validator->ValidateForm()){			
			if($error){
				echo '<div class="alert alert-danger">
					<strong>Warning!</strong> '. $error .' 
				</div>';
			}else{
				$insert = Database::getInstance()->edit_tempa($temp_name, $val);
				if($insert == 'Done'){
					echo '<div class="alert alert-success">
						Updated successfully					
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
?>