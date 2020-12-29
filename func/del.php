<?php
	include('../inc/db.php');

	$functionto = $_POST['ins'];

	switch ($functionto) {
		
		
		case "delUser":
        delUser();
		break;

		case "delPayroll":
			delPayroll();
			break;

		case "delRevenue":
			 delRevenue();
			 break;

		case "delPatient":
        delPatient();
		break;


		case 'delAntenatal':
			delAntenatal();
			break;

		case 'delBloodGroup':
			delBloodGroup();
			break;

		case 'delSample':
			delSample();
			break;

		case 'delLabour':
			delLabour();
			break;

		case "delTax":
        delTax();
		break;

		case "delFamily":
        delFamily();
		break;

		case "delTariff":
			delTariff();
			break;

		case "delInpatient_all":
		delInpatient_all();
		break;

		case "deltherapyPlan":
        deltherapyPlan();
		break;

		
		case "delappt":
        delappt();
		break;
		
		case "delPatientVital":
        delPatientVital();
		break;
		
		case "delTestType":
        delTestType();
		break;

		case 'delTreatment':
			delTreatment();
			break;

		case 'delTGroup':
			delTGroup();
			break;

		case "delCategory":
        delCategory();
		break;

		case "delCategory1":
        delCategory1();
		break;

		case "delTest":
        delTest();
		break;

		case "delDonor":
        delDonor();
		break;

		case 'delDonation':
			delDonation();
			break;

		case "delCaseTest":
        delCaseTest();
		break;
		
		case "delExtraFile":
        delExtraFile();
		break;

		case "delXrayFile":
        delXrayFile();
		break;

		case "delScanFile":
        delScanFile();
		break;

		case "delXray":
        delXray();
		break;

		case "delScan":
        delScan();
		break;
		
		case "delIPDFood":
        delIPDFood();
		break;
		
		case "delObs":
        delObs();
		break;
		
		case "delDis":
        delDis();
		break;
		
		case "delFluid":
        delFluid();
		break;
		
		case "delSurgery":
        delSurgery();
		break;
		
		case "delDoc":
        delDoc();
		break;
		
		case "delBed":
        delBed();
		break;

		case 'delMBill':
			delMBill();
			break;

		case 'delMBills':
			delMBills();
			break;

		case 'delCStock':
			delCStock();
			break;

		case 'delMBed':
			delMBed();
			break;

		case 'delMCharges':
			delMCharges();
			break;
		
		case "delDocSche":
        delDoc();
		break;

		case "delCat":
        delCat();
		break;
		
		case "delStock":
        delStock();
		break;

		case 'delStock_w':
			delStock_w();
			break;

		case "delUnits":
        delUnits();
		break;

		case 'delCUnits':
			delCUnits();
			break;

		case "delForm":
        delForm();
		break;

		case "delSupplier":
        delSupplier();
		break;

		case "delSale":
        delSale();
		break;

		case "delInvoice_item":
		delInvoice_item();
		break;

		case "delInvoice_all":
		delInvoice_all();
		break;

		case "delSale_all":
        delSale_all();
		break;

		case "delSaleDet":
        delSaleDet();
		break;

		case "delSaleDet_all":
        delSaleDet_all();
		break;

		case "delDispense":
        delDispense();
		break;

		case "delDispense_all":
        delDispense_all();
		break;

		case "delUsage":
        delUsage();
		break;

		case "delCard":
        delCard();
		break;
		
		case "delDuty":
        delDuty();
		break;
		
		case "delInpatientDet":
        delInpatientDet();
		break;

		case "delExp":
        delExp();
		break;

		case "delIncome":
		delIncome();
		break;

		case "delCost":
		delCost();
		break;

		case "delBall":
        delBall();
		break;

		case "delCompany":
        delCompany();
		break;

		case "delCaseDrug":
        delCaseDrug();
		break;

		case "delCaseDrug1":
        delCaseDrug1();
		break;

		case "delExamReq":
        delExamReq();
		break;
		
		case "delAdminReq":
        delAdminReq();
		break;
		
		case "delTempp":
        delTempp();
		break;

		case "delDispenseDet":
        delDispenseDet();
		break;

		case "delDispenseDet_all":
        delDispenseDet_all();
		break;

		case "del_lab_test_names":
        del_lab_test_names();
		break;

		default:
			echo '<div class="alert alert-danger">
				Function does not Exist
			</div>';
	}

	function delUser(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('staff','user_id',$value);
		echo"Done";
	}

	function delBloodGroup(){
		$value = $_POST['val'];
		database::getInstance()->deactivate('blood_groups','status',0,'blood_group_id',$value);
		echo"Done";
	}

	function delSample(){
		$value = $_POST['val'];
		database::getInstance()->deactivate('samples','status',0,'id',$value);
		echo"Done";
	}

	function delPayroll(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('payroll','id',$value);
		echo"Done";
	}

	function delCaseTest(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('temp_test','id',$value);
		echo"Done";
	}

	function delCaseDrug(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('temp_presc','id',$value);
		echo"Done";
	}

	function delCaseDrug1(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('temp_presct','id',$value);
		echo"Done";
	}
	
	function delBed(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('beds','id',$value);
		echo"Done";
	}

	function delMBill(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('morgue_bills','id',$value);
		echo"Done";
	}

	function delMBills(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('morgue_bills','corpse_id',$value);
		echo"Done";
	}

	function delMBed(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('morgue_beds','id',$value);
		echo"Done";
	}

	function delMCharges(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('morgue_charges','id',$value);
		echo"Done";
	}

	
	function delExtraFile(){
		$value = $_POST['val'];
		$file = database::getInstance()->get_name_from_id('extra_file','extra_file','extra_file_id',$value);
		unlink('../extrafile/'.$file);
		database::getInstance()->delete_things('extra_file','extra_file_id',$value);
		echo"Done";
	}

	function delXrayFile(){
		$value = $_POST['val'];
		$file = database::getInstance()->get_name_from_id('file','patient_xray_result','id',$value);
		unlink('../extrafile/'.$file);
		database::getInstance()->delete_things('patient_xray_result','id',$value);
		echo"Done";
	}

	function delScanFile(){
		$value = $_POST['val'];
		$file = database::getInstance()->get_name_from_id('file','patient_scan_result','id',$value);
		unlink('../extrafile/'.$file);
		database::getInstance()->delete_things('patient_scan_result','id',$value);
		echo"Done";
	}
	
	function delForm(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('pharm_form','id',$value);
		echo"Done";
	}

	function delSupplier(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('pharm_suppliers','Supplier_ID',$value);
		echo"Done";
	}

	function delDispenseDet(){
		$value = $_POST['val'];
		database::getInstance()->update_pos($value);
		database::getInstance()->delete_things('caf_sales_detail','Sales_ID',$value);
		echo"Done";
	}

	function delDispenseDet_all(){
		$value = $_POST['val'];
		database::getInstance()->update_pos2($value);
		database::getInstance()->delete_things('caf_sales_detail','Sales_Number',$value);
		echo"Done";
	}

	function delSale(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('in_sales','id',$value);
		echo"Done";
	}

	function delInvoice_item(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('invoices','id',$value);
		echo"Done";
	}

	function delInvoice_all(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('invoices','invoice_id',$value);
		echo"Done";
	}

	function delSale_all(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('in_sales','sales_id',$value);
		echo"Done";
	}

	function delSaleDet(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('accounts','id',$value);
		echo"Done";
	}

	function delSaleDet_all(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('accounts','order_id',$value);
		echo"Done";
	}

	function delDispense(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('pharm_sales_detail','Sales_ID',$value);
		echo"Done";
	}

	function delDispense_all(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('pharm_sales_detail','Sales_ID',$value);
		echo"Done";
	}

	function delUsage(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('pharm_usage','id',$value);
		echo"Done";
	}

	function delTax(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('taxes','id',$value);
		echo"Done";
	}
	
	function delPatient(){
		$value = $_POST['val'];
		$file = database::getInstance()->get_name_from_id('photo','patients','id',$value);
		unlink('../photo/'.$file);
		database::getInstance()->delete_things('patients','id',$value);
		echo"Done";
	}

	function delAntenatal(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('antenatal1','id',$value);
		echo"Done";
	}

	function delLabour(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('labour','id',$value);
		echo"Done";
	}

	function delInpatient_all(){
		$value = $_POST['val'];
		$main = database::getInstance()->delete_things_where2('accounts','app_id',$value,'item',9);
		if ($main == 'Done') {
			$first = database::getInstance()->delete_things('`in-patients`','app_id',$value);
		}else{
			$first = database::getInstance()->delete_things('`in-patients`','app_id',$value);
		}
		echo"Done";
	}

	function deltherapyPlan(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('therapy_plans','id',$value);
		echo"Done";
	}

	function delappt(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('patient_appointment','id',$value);
		echo"Done";
	}

	function delFamily(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('families','id',$value);
		echo"Done";
	}
	
	function delTestType(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('lab_test_type','lab_test_type_id',$value);
		echo"Done";
	}

	function delTreatment(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('treatment_list','id',$value);
		echo"Done";
	}

	function delTGroup(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('tgroup','id',$value);
		echo"Done";
	}

	function delTariff(){
		$value = $_POST['val'];
		$name = $_POST['name'];
		database::getInstance()->delete_things1('tariffs','id',$value,$name);
		echo"Done";
	}
	
	function delXray(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('xray','id',$value);
		echo"Done";
	}

	function delScan(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('scan','id',$value);
		echo"Done";
	}

	function delCategory(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('xray_types','xray_cat_id',$value);
		echo"Done";
	}

	function delCategory1(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('scan_types','scan_cat_id',$value);
		echo"Done";
	}
	
	function delTest(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('lab_test','lab_test_id',$value);
		echo"Done";
	}

	function delDonor(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('donors','donor_id',$value);
		echo"Done";
	}

	function delDonation(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('donations','id',$value);
		echo "Done";
	}

	function delRevenue(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('payment_type','payment_type_id',$value);
		echo"Done";
	}
	
	function delPatientVital(){
		$value = $_POST['val'];
		$bpsis = ""; $bpsid = ""; $bpsts = ""; $bpstd = ""; $pulse = ""; $sug = ""; $history = ""; $temp = ""; $weight = "";$height = "";$bmi = "";$spo2 = "";$allergies="";$rbp = "";$complaints="";$resp = "";$sixt = "";
		database::getInstance()->edit_vitals($bpsis, $bpsid, $bpsts, $bpstd, $pulse, $sug, $history, $temp,$height,$resp,$complaints,$rsp,$allergies, $weight,$sixt,$value);
		echo"Done";
	}
	
	function delInpatientDet(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('`in-patients`','id',$value);
		echo"Done";
	}

	function delDoc(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('doctors','id',$value);
		echo"Done";
	}
	
	function delIPDFood(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('ipd_food','ipd_food_id',$value);
		echo"Done";
	}
	
	function delObs(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('patient_obs','patient_obs_id',$value);
		echo"Done";
	}
	
	function delDis(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('dispensing_chart','dispensing_chart_id',$value);
		echo"Done";
	}
	
	function delFluid(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('patient_fluid','patient_fluid_id',$value);
		echo"Done";
	}

	function delSurgery(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('surgery_perm','surgery_perm_id',$value);
		echo"Done";
	}
	
	function delDocSche(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('doctor_schedule','id',$value);
		echo"Done";
	}

	function delCat(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('pharm_category','id',$value);
		echo"Done";
	}

	function delStock(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('pharm_stock','id',$value);
		echo"Done";
	}

	function delCStock(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('caf_stock','id',$value);
		echo"Done";
	}

	function delStock_w(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('warehouse_stock','id',$value);
		echo"Done";
	}

	function delUnits(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('pharm_units','id',$value);
		echo"Done";
	}

	function delCUnits(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('caf_units','id',$value);
		echo"Done";
	}
	
	function delCard(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('card_types','id',$value);
		echo"Done";
	}
	
	function delDuty(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('duty_check','id',$value);
		echo"Done";
	}
	
	function delExp(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('daily_expense','id',$value);
		echo"Done";
	}

	function delIncome(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('other_income','id',$value);
		echo"Done";
	}

	function delCost(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('costs','id',$value);
		echo"Done";
	}
	
	function delBall(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('credit_balance','id',$value);
		echo"Done";
	}
	function delCompany(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('companies','id',$value);
		database::getInstance()->delete_things('accounts','company_id',$value);
		database::getInstance()->delete_things('payment','company_id',$value);
		database::getInstance()->delete_things('prescription','company_id',$value);
		database::getInstance()->delete_things('company_bill','company_id',$value);

		echo"Done";
	}
	
	
	function delExamReq(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('exam_request','id',$value);
		echo"Done";
	}
	
	function delAdminReq(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('admission_request','admission_request_id',$value);
		echo"Done";
	}
	
	function delTempp(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('lab_temps','id',$value);
		echo"Done";
	}
	
	
	function del_lab_test_names(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('lab_temp_name','id',$value);
		echo"Done";
	}
?>