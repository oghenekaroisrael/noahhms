<?php
error_reporting(0);
	class Database {
		
    private $db;
    private static $instance;
    private $limit = 10;

	// private constructor
    private function __construct() {
		$servername = "localhost";
		$username = "root";
		$password = "";


		try {
			$this->db = new PDO("mysql:host=$servername;dbname=noahhms;", $username, $password);
			// set the PDO error mode to exception
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//echo "Connected successfully";
			// I won't echo thsi message but use it to for checking if you connected to the db
			//incase you don't get an error message
			}
		catch(PDOException $e){
			echo "Connection failed: " . $e->getMessage();
		}
    }
	
    //This method must be static, and must return an instance of the object if the object
    //does not already exist.
    public static function getInstance() {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    // The clone and wakeup methods prevents external instantiation of copies of the Singleton class,
    // thus eliminating the possibility of duplicate objects.
    public function __clone() {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

    public function __wakeup() {
        trigger_error('Deserializing is not allowed.', E_USER_ERROR);
    }
	
	public function get_name_from_id_ord($tab,$col,$whe,$id,$ord_id,$ord){
		try{
			$que= $this->db->prepare("SELECT $tab FROM $col where $whe =? ORDER BY $ord_id $ord");
			$que->execute([$id]);
			$SingleVar = $que->fetchColumn();
			return $SingleVar;
			$que = null;			
		} catch(PDOException $e){
			echo 'Error: ' . $e->getMessage();
		}	
	}

	public function deleteCategory($id,$table){

        try {
          
          $stmt = $this->db->prepare("delete from ".$table." where id = ?");
            $stmt->execute([$id]);
            $stmt = null;
            $success = 'Done';
            return $success;
        } catch (PDOException $e) {
            // For handling error
            echo '<div class="alert alert-danger">
					Delete Failed
				  </div>: ' . $e->getMessage();
        }
    }

    //count Dispense
	public function count_dispense(){
		try {
				$que= $this->db->prepare("SELECT * FROM caf_sales_detail");
				$que->execute();
				$arr = $que->rowCount();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	  //count Dispense 2
	public function count_dispense2($val){
		try {
				$que= $this->db->prepare("SELECT * FROM caf_sales_detail WHERE Sales_Number LIKE ?");
				$que->execute([$val]);
				$arr = $que->rowCount();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function get_name_from_id($tab,$col,$whe,$id){
		try{
			$que= $this->db->prepare("SELECT $tab FROM $col where $whe =?");
			$que->execute([$id]);
			$SingleVar = $que->fetchColumn();
			return $SingleVar;
			$que = null;			
		} catch(PDOException $e){
			echo 'Error: ' . $e->getMessage();
		}	
	}

	public function get_last_day($date){
		try{
			$que= $this->db->prepare("SELECT LAST_DAY(?)");
			$que->execute([$date]);
			$SingleVar = $que->fetchColumn();
			return $SingleVar;
			$que = null;			
		} catch(PDOException $e){
			echo 'Error: ' . $e->getMessage();
		}	
	}

	public function get_first_day($date){
		try{
			$que= $this->db->prepare("SELECT DATEADD(DAY,1,EOMONTH(?,-1))");
			$que->execute([$date]);
			$SingleVar = $que->fetchColumn();
			return $SingleVar;
			$que = null;			
		} catch(PDOException $e){
			echo 'Error: ' . $e->getMessage();
		}	
	}

	public function get_last_date($col,$table,$month){
		try{
			//SELECT MAX(date_ref) FROM `ledger_temp` WHERE MONTH(date_ref) = 01
			$que= $this->db->prepare("SELECT MAX($col) FROM $table WHERE MONTH($col) = ?");
			$que->execute([$month]);
			$SingleVar = $que->fetchColumn();
			return $SingleVar;
			$que = null;			
		} catch(PDOException $e){
			echo 'Error: ' . $e->getMessage();
		}	
	}

	public function get_last_date_id($col,$table,$month){
		try{
			//SELECT MAX(date_ref) FROM `ledger_temp` WHERE MONTH(date_ref) = 01
			$que= $this->db->prepare("SELECT id FROM $table WHERE MONTH($col) = ? order by id desc limit 1");
			$que->execute([$month]);
			$SingleVar = $que->fetchColumn();
			return $SingleVar;
			$que = null;			
		} catch(PDOException $e){
			echo 'Error: ' . $e->getMessage();
		}	
	}

	public function get_first_date($col,$table,$month){
		try{
			//SELECT MAX(date_ref) FROM `ledger_temp` WHERE MONTH(date_ref) = 01
			$que= $this->db->prepare("SELECT MIN($col) FROM $table WHERE MONTH($col) = ?");
			$que->execute([$month]);
			$SingleVar = $que->fetchColumn();
			return $SingleVar;
			$que = null;			
		} catch(PDOException $e){
			echo 'Error: ' . $e->getMessage();
		}	
	}

	public function get_month($col,$table,$date){
		try{
			//SELECT MAX(date_ref) FROM `ledger_temp` WHERE MONTH(date_ref) = 01
			$que= $this->db->prepare("SELECT MONTH($col) FROM $table WHERE $col = ?;");
			$que->execute([$date]);
			$SingleVar = $que->fetchColumn();
			return $SingleVar;
			$que = null;			
		} catch(PDOException $e){
			echo 'Error: ' . $e->getMessage();
		}	
	}

	



	public function select_name_from_limit_range($tab,$col,$id,$ord,$fro,$to){
		try{
			$que= $this->db->prepare("SELECT $tab FROM $col ORDER BY $id $ord LIMIT $fro, $to");
			$que->execute([$id]);
			$SingleVar = $que->fetchColumn();
			return $SingleVar;
			$que = null;			
		} catch(PDOException $e){
			echo 'Error: ' . $e->getMessage();
		}	
	}

	public function select_new_notifications($id,$all){
		try{
			$que= $this->db->prepare("SELECT * FROM notifications WHERE staff_id = ? OR staff_id = ? ORDER BY status, time_taken DESC LIMIT 5 ");
			$que->execute([$id,$all]);
			$SingleVar = $que->fetchAll();
			return $SingleVar;
			$que = null;			
		} catch(PDOException $e){
			echo 'Error: ' . $e->getMessage();
		}	
	}

	public function count_new_notifications($id,$all=""){
		try{
			if ($all != "") {
					$que= $this->db->prepare("SELECT * FROM notifications WHERE staff_id = ? OR staff_id = ? AND status = 0");
					$que->execute([$id,$all]);
					$SingleVar = $que->rowCount();
					return $SingleVar;
					$que = null;
				}else{
					$que= $this->db->prepare("SELECT * FROM notifications WHERE staff_id = ? AND status = 0");
					$que->execute([$id]);
					$SingleVar = $que->rowCount();
					return $SingleVar;
					$que = null;
				}			
		} catch(PDOException $e){
			echo 'Error: ' . $e->getMessage();
		}	
	}

	public function select_new_strikes($id,$all){
		try{
			$que= $this->db->prepare("SELECT * FROM notifications WHERE staff_id = ? OR staff_id = ? AND strikes = 0 ORDER BY strikes, time_taken ASC LIMIT 1 ");
			$que->execute([$id,$all]);
			$SingleVar = $que->fetchAll();
			return $SingleVar;
			$que = null;	
		} catch(PDOException $e){
			echo 'Error: ' . $e->getMessage();
		}	
	}

	public function count_new_strikes($id,$all=""){
		try{
			if ($all != "") {
					$que= $this->db->prepare("SELECT * FROM notifications WHERE staff_id = ? AND staff_id = ? OR strikes = 0");
					$que->execute([$id,$all]);
					$SingleVar = $que->rowCount();
					return $SingleVar;
					$que = null;
				}else{
					$que= $this->db->prepare("SELECT * FROM notifications WHERE staff_id = ? AND strikes = 0");
					$que->execute([$id]);
					$SingleVar = $que->rowCount();
					return $SingleVar;
					$que = null;
				}			
		} catch(PDOException $e){
			echo 'Error: ' . $e->getMessage();
		}	
	}

	public function timeago($date) {
	   $timestamp = new DateTime($date);
	   $currentTime = new DateTime("NOW");	
	   $strTime = array("second", "minute", "hour", "day", "month", "year");

			$diff = $timestamp->diff($currentTime);

			if ($diff->s >= 0 && $diff->i == 0 && $diff->h == 0 && $diff->d == 0 && $diff->m == 0 && $diff->y == 0) {
				return $diff->s . " " . $strTime[0] . "(s) ago ";
			}else if ($diff->s >= 0 && $diff->i >= 0 && $diff->h == 0 && $diff->d == 0 && $diff->m == 0 && $diff->y == 0) {
				if ($diff->i ==1) {
					return "1 minute ago";
				}else{
					return $diff->i . " " . $strTime[1] . "(s) ago ";
				}
			}else if ($diff->s >= 0 && $diff->i >= 0 && $diff->h >= 0 && $diff->d == 0 && $diff->m == 0 && $diff->y == 0) {
				if ($diff->h ==1) {
					return "1 hour ago";
				}else{
					return $diff->h . " " . $strTime[2] . "(s) ago ";
				}
			}else if ($diff->s >= 0 && $diff->i >= 0 && $diff->h >= 0 && $diff->d >= 0 && $diff->m == 0 && $diff->y == 0) {
				if ($diff->h ==1) {
					return "Yesterday";
				}else{
					return $diff->d . " " . $strTime[3] . "(s) ago ";
				}
			}else if ($diff->s >= 0 && $diff->i >= 0 && $diff->h >= 0 && $diff->d >= 0 && $diff->m >= 0 && $diff->y == 0) {
				if ($diff->m == 1) {
					return "1 month ago";
				}else{
					return $diff->m . " " . $strTime[4] . "(s) ago ";
				}
			}else if ($diff->s >= 0 && $diff->i >= 0 && $diff->h >= 0 && $diff->d >= 0 && $diff->m >= 0 && $diff->y >= 0) {
				if ($diff->y ==1) {
					return "1 year ago";
				}else{
					return $diff->y . " " . $strTime[5] . "(s) ago ";
				}
			}
			
	}

	public function set_notifications_seen($id,$all){
		try{
			$que= $this->db->prepare("UPDATE notifications SET status = 1 WHERE staff_id = ? OR staff_id = ?");
			$que->execute([$id,$all]);
			return 'Done';
			$que = null;			
		} catch(PDOException $e){
			echo 'Error: ' . $e->getMessage();
		}	
	}

	public function set_strike_seen($id){
		try{
			$que= $this->db->prepare("UPDATE notifications SET strikes = 1 WHERE id = ?");
			$que->execute([$id]);
			return 'Done';
			$que = null;			
		} catch(PDOException $e){
			echo 'Error: ' . $e->getMessage();
		}	
	}

	public function strike($id){
		try{
			$que= $this->db->prepare("UPDATE notifications SET strikes = 1 WHERE id = ?");
			$que->execute([$id]);
			return 'Done';
			$que = null;			
		} catch(PDOException $e){
			echo 'Error: ' . $e->getMessage();
		}	
	}

	public function changeSession($app,$id){
		try{
			$que= $this->db->prepare("UPDATE patient_appointment SET treated = ? WHERE id = ?");
			$que->execute([$id,$app]);
			return 'Done';
			$que = null;			
		} catch(PDOException $e){
			echo 'Error: ' . $e->getMessage();
		}	
	}



	public function get_name_from_id2($tab,$col,$whe,$id){
		try{
			$que= $this->db->prepare("SELECT $tab FROM $col WHERE $whe LIKE '%".$id."%'");
			$que->execute([$id]);
			$SingleVar = $que->fetchColumn();
			return $SingleVar;
			$que = null;			
		} catch(PDOException $e){
			echo 'Error: ' . $e->getMessage();
		}	
	}

	public function get_name_from_id3($tab,$col,$whe,$id,$col2,$id2,$ord){
		try{
			$que= $this->db->prepare("SELECT $tab FROM $col where $whe =? AND $col2 = ? ORDER BY $ord DESC");
			$que->execute([$id,$id2]);
			$SingleVar = $que->fetchColumn();
			return $SingleVar;
			$que = null;			
		} catch(PDOException $e){
			echo 'Error: ' . $e->getMessage();
		}	
	}

	//sum from anywhere for just one where and a between
	public function sum_where1_between($col,$table,$col2,$val,$dates,$from,$to){
		$stmt = $this->db->prepare("SELECT SUM($col) AS totalAmt FROM $table WHERE $col2 = ? AND $dates BETWEEN ? AND ?");
		$stmt->execute([$val,$from,$to]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row['totalAmt'];
		$stmt = null;
	}

	//sum from anywhere for just one where and a between
	public function sum_no_where_between($col,$table,$dates,$from,$to){
		$stmt = $this->db->prepare("SELECT SUM($col) AS totalAmt FROM $table WHERE $dates BETWEEN ? AND ?");
		$stmt->execute([$from,$to]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row['totalAmt'];
		$stmt = null;
	}

	//For Reconsile Stock
	public function reconsile_stock($id1, $id2, $quantity,$returned,$account){
		try {
		$stmt = $this->db->prepare("UPDATE pharm_stock SET stock = ? WHERE id = ?");
		$stmt->execute([$quantity,$id1]);
		$stmt = null;

		$que = $this->db->prepare("SELECT * FROM in_sales WHERE id = ?");
		$que->execute([$id2]);
		$row = $que->fetch(PDO::FETCH_OBJ);
		$q1 = $row->quantity;
		$ref = $row->sales_id;
		$c_qty = $row->returned;
		$que = null;

		$que= $this->db->prepare("SELECT price FROM pharm_stock WHERE id = ?");
		$que->execute([$id1]);
		$row = $que->fetch(PDO::FETCH_OBJ);
		$price = $row->price;
		$que = null;

		$priceToPay = intval($q) * intval($price);
		
		$q = intval($q1)-intval($returned);
		$pp = intval($q)*intval($price);
		$c_qty1 =0;
		$c_qty1  += $c_qty;
		$c_qty1 += $returned;
		$stmt = $this->db->prepare("UPDATE in_sales SET returned = ?,rstatus = 1, quantity = ?,amount = ?, rdate = NOW() WHERE id = ?");
		$stmt->execute([$c_qty1,$q,$pp,$id2]);
		$stmt = null;

		$stmt = $this->db->prepare("UPDATE accounts SET amount = ?, to_pay = ? WHERE id = ?");
		$stmt->execute([$pp,$pp,$account]);
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	//For Reconsile Stock
	public function reconsile_stock_w($id1, $id2, $quantity,$returned,$request){
		try {
		$stmt = $this->db->prepare("UPDATE warehouse_stock SET cartons = ? WHERE id = ?");
		$stmt->execute([$quantity,$id1]);
		$stmt = null;
 
		$que = $this->db->prepare("SELECT * FROM pharm_requests WHERE request_id = ?");
		$que->execute([$request]);
		$row = $que->fetch(PDO::FETCH_OBJ);
		$q1 = $row->quantity_needed;
		$c_qty = $q1-$returned;
		$ref = $row->reference;
		$que = null;

		$que= $this->db->prepare("SELECT cost FROM warehouse_stock WHERE id = ?");
		$que->execute([$id1]);
		$row = $que->fetch(PDO::FETCH_OBJ);
		$price = $row->cost;
		$que = null;

		$que= $this->db->prepare("SELECT stock,id FROM pharm_stock WHERE reference2 = ?");
		$que->execute([$ref]);
		$row = $que->fetch(PDO::FETCH_OBJ);
		$stock = $row->stock;
		$que = null;
		
		$cq = $stock - $returned;

		$stmt = $this->db->prepare("UPDATE pharm_requests SET returned = ?,rstatus = 1, rdate = NOW() WHERE request_id = ?");
		$stmt->execute([$returned,$request]);
		$stmt = null;

		$stmt = $this->db->prepare("UPDATE pharm_stock SET stock=? WHERE reference2 = ?");
		$stmt->execute([$cq,$ref]);
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function reconsile_cstock($id1, $id2, $quantity=0,$returned,$account){
		try {

		$que = $this->db->prepare("SELECT * FROM caf_sales_detail WHERE Sales_ID = ?");
		$que->execute([$id2]);
		$row = $que->fetch(PDO::FETCH_OBJ);
		$q1 = $row->Sales_Quantity;
		$c_qty = $row->returned;
		$que = null;

		$que= $this->db->prepare("SELECT price,quantity FROM caf_stock WHERE id = ?");
		$que->execute([$id1]);
		$row = $que->fetch(PDO::FETCH_OBJ);
		$price = $row->price;
		$cquantity = intval($row->quantity);
		$que = null;

		$priceToPay = intval($q) * intval($price);
		
		$q = intval($q1)-intval($returned);
		$pp = intval($q)*intval($price);
		$c_qty1 =0;
		$c_qty1  += $c_qty;
		$c_qty1 += $returned;
		$stmt = $this->db->prepare("UPDATE caf_sales_detail SET returned = ?,rstatus = 1, Sales_Quantity = ?,Purchasing_Price = ?, rdate = NOW() WHERE Sales_ID = ?");
		$stmt->execute([$c_qty1,$q,$pp,$id2]);
		$stmt = null;
		$cquantity += $returned;
		$stmt = $this->db->prepare("UPDATE caf_stock SET quantity = ? WHERE id = ?");
		$stmt->execute([$cquantity,$id1]);
		$stmt = null;

		$stmt = $this->db->prepare("UPDATE caf_accounts SET amount = ?, to_pay = ? WHERE id = ?");
		$stmt->execute([$pp,$pp,$account]);
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}


	//sum from anywhere for just one where and a between
	public function sum_where_greater_between($col,$table,$col2,$val,$date,$from,$to){
		$stmt = $this->db->prepare("SELECT SUM($col) AS totalAmt FROM $table WHERE $col2 > ? AND $date BETWEEN ? AND ?");
		$stmt->execute([$val,$from,$to]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row['totalAmt'];
		$stmt = null;
	}

	//count Warehouse Requests
	public function count_sales(){
		try {
			$que = $this->db->prepare("SELECT request_id FROM pharm_requests");
			$que->execute();
			$arr = $que->rowCount();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	//For Family registration
	public function insert_family($name){
		try {
		$stmt = $this->db->prepare("INSERT INTO families(family_name,date_added) 
		VALUES (?,NOW())");
		$stmt->execute([$name]);
		
		$stmt = null;
		$oid = uniqid();
		$item = 12;
		$ct = 20;
		$t = 0;
		$amount = 2000;
		$dt = date('Y-m-d');
		$stmt = $this->db->prepare("INSERT INTO accounts(patient_id,order_id,item,card_type,to_pay,payment_status,date_added) 
		VALUES (?,?,?,?,?,?,?)");
		$stmt->execute([$name,$oid,$item,$ct,$amount,$t,$dt]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}


	public function insert_mcharge($name,$amt,$user){
		try {
		$stmt = $this->db->prepare("INSERT INTO morgue_charges(charge,amount,date_added,added_by) 
		VALUES (?,?,NOW(),?)");
		$stmt->execute([$name,$amt,$user]);
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}


	public function insert_bill2($unit,$type,$description,$quantity, $amount,$staff,$id){
		try {
			$stmt = $this->db->prepare("INSERT INTO `in_sales`(unit,sales_id,type,description,quantity,amount,dispenser,date_added,time_stamp) 
			VALUES (?,?,?,?,?,?,?,NOW(),NOW())");
			$stmt->execute([$unit,$id,$type,$description,$quantity, $amount,$staff]);			
			$stmt = null;
			return "Done";
				
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function insert_brequest($sample,$facility_name,$phone_number,$physician,$patient_name,$patient_id,$address,$pphone_number,$patient_dob,$diagnosis,$inquiry,$rbc,$date_lknas,$cmeds,$info,$transfusion,$urgency,$volume,$id){
		try {
			$stmt = $this->db->prepare("INSERT INTO `blood_requests`(`sample_type`,`facility`, `phone`, `facility_clinician`,`patient_name`,`patient_adm_no`, `patient_address`,`patient_phone`,`patient_dob`,`diagnosis`, `reason`,`rbc`, `date_lknas`, `cmeds`,`info`,`transfusion`,`added_by`,`urgency`,`volume`,`date_added`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())");
			$stmt->execute([$sample,$facility_name,$phone_number,$physician,$patient_name,$patient_id,$address,$pphone_number,$patient_dob,$diagnosis,$inquiry,$rbc,$date_lknas,$cmeds,$info,$transfusion,$urgency,$volume,$id]);			
			$stmt = null;
			return "<div  class='alert alert-success'>Request Sent Successfully!</div>";
				
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function fresh_ledger(){
		try {
			$stmt = $this->db->prepare("TRUNCATE `ledger_temp`;
				INSERT INTO `ledger_temp` (`ref`, `jmt`, `description`, `debit`,`credit`, `balance`, `date_ref`) SELECT DISTINCT order_id, item,patient_id, SUM(amount),(SUM(to_pay) - SUM(amount)),(SUM(to_pay) - SUM(amount)),date_added FROM `accounts` GROUP BY date_added, patient_id;
				INSERT INTO `ledger_temp` (`ref`, `jmt`, `description`, `credit`, `balance`, `date_ref`) SELECT DISTINCT code,type,description, SUM(amt),SUM(amt),exp_date FROM `daily_expense` GROUP BY `exp_date`;
				INSERT INTO `ledger_temp` (`ref`, `jmt`, `description`, `debit`, `balance`, `date_ref`) SELECT DISTINCT code,type,GROUP_CONCAT(description), SUM(amt),0,date_added FROM `other_income` GROUP BY `date_added`;");
			$stmt->execute();			
			$stmt = null;
			return "Done";
				
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	//For family editing
	public function edit_family($name,$val){
		try {
		$stmt = $this->db->prepare("UPDATE families SET family_name = ?,date_added = NOW() WHERE id = ?");
		$stmt->execute([$name,$val]);
		
		$stmt = null;
		return "<div class='alert alert-success'> Family Updated Successfully!</div>";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function edit_mcharge($name,$amt,$val,$staff){
		try {
		$stmt = $this->db->prepare("UPDATE morgue_charges SET charge = ?,amount = ? ,date_updated = NOW(),updatedby = ? WHERE id = ?");
		$stmt->execute([$name,$amt,$staff,$val]);
		
		$stmt = null;
		return "<div class='alert alert-success'> Charge Updated Successfully!</div>";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	//sum from anywhere for just one where
	public function sum_where1($col,$table,$col2,$val){
		$stmt = $this->db->prepare("SELECT SUM($col) AS totalAmt FROM $table WHERE $col2 = ?");
		$stmt->execute([$val]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row['totalAmt'];
		$stmt = null;
	}

	//sum from anywhere for just no where
	public function sum_no_where($col,$table){
		$stmt = $this->db->prepare("SELECT SUM($col) AS totalAmt FROM $table");
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row['totalAmt'];
		$stmt = null;
	}

	//sum from anywhere for just no where
	public function sum_no_where_acct($col,$col2,$table){
		$stmt = $this->db->prepare("SELECT SUM($col * $col2) AS totalAmt FROM $table WHERE $col2 > 0");
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row['totalAmt'];
		$stmt = null;
	}

	//sum from daily expenses
	public function sum_where($table, $col, $col2,$val1, $col3, $val2){
		$stmt = $this->db->prepare("SELECT SUM($col) AS totalAmt FROM $table WHERE $col2 = ? AND $col3 = ? LIMIT 10");
		$stmt->execute([$val1, $val2]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row['totalAmt'];
		$stmt = null;
	}

	//sum from account with Or
	public function sum_where_with_or($table, $col, $col2,$val1, $col3, $val2,$col4,$val3){
		$stmt = $this->db->prepare("SELECT SUM($col) AS totalAmt FROM $table WHERE $col2 = ? AND  $col3 = ? OR $col4 = ?");
		$stmt->execute([$val1, $val2,$val3]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row['totalAmt'];
		$stmt = null;
	}

	//sum from daily expenses
	public function sum_where2($table, $col, $col2,$val1, $col3, $val2){
		$stmt = $this->db->prepare("SELECT SUM($col) AS totalAmt FROM $table WHERE $col2 = ? AND $col3 = ? LIMIT 1");
		$stmt->execute([$val1, $val2]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row['totalAmt'];
		$stmt = null;
	}

	//sum from daily expenses
	public function sum_where21($table, $col, $col2,$val1, $col3, $val2){
		$stmt = $this->db->prepare("SELECT SUM($col) AS totalAmt FROM $table WHERE $col2 = ? AND $col3 = ? AND payment_status != 5 LIMIT 1");
		$stmt->execute([$val1, $val2]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row['totalAmt'];
		$stmt = null;
	}
	
	//For admin
	public function sum_admin($col, $table, $trans, $val){
		$stmt = $this->db->prepare("SELECT SUM($col) AS totalAmt FROM $table WHERE admin_status = ? AND trans_type = ?");
		$stmt->execute([$trans, $val]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row['totalAmt'];
		$stmt = null;
	}
	//asign tarigg to hmo
	public function assign_tariff($price, $val){
		try {
		
		$stmt = $this->db->prepare("UPDATE patients SET tariff = ? WHERE id = ?");
			$stmt->execute([$price,$val]);
			
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	//give injections
	public function update_inject($val){
		try {
		$que= $this->db->prepare("SELECT status FROM `prescription1` WHERE prescription_id = ?");
		$que->execute([$val]);
		$row = $que->fetch(PDO::FETCH_OBJ);
		$init_status = $row->status;
		$que = null;

		if ($init_status > 0) {
			$status = intval($init_status) - 1;

		$stmt = $this->db->prepare("UPDATE prescription1 SET status = ? WHERE prescription_id = ?");
			$stmt->execute([$status,$val]);
			
		$stmt = null;
		}else{
			$status = 0;

		$stmt = $this->db->prepare("UPDATE prescription1 SET status = ? WHERE prescription_id = ?");
			$stmt->execute([$status,$val]);
			
		$stmt = null;
		}
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	//delete
	public function delete_from_where($table, $col, $id){
		try {
			$stmt = $this->db->prepare("DELETE FROM $table WHERE $col = ?");
			$stmt->execute([$id]);
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
		
	//delete from users
	public function delete_from_where_user($del){
		try {
			$stmt = $this->db->prepare("DELETE FROM users WHERE email = ?");
			$stmt->execute([$del]);
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	//delete from users
	public function delete_from_where_gen($del, $table, $col){
		try {
			$stmt = $this->db->prepare("DELETE FROM $table WHERE $col = ?");
			$stmt->execute([$del]);
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	//delete
	public function delete_things($tab,$col,$value) {
		try{
			$stmt = $this->db->prepare("DELETE FROM $tab WHERE $col=?");		
			$stmt->execute([$value]);
			$success = 'Done';
			return $success;
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}	
	}

	public function deactivate($tab,$status,$val,$col,$value) {
		try{
			$stmt = $this->db->prepare("UPDATE $tab SET $status =? WHERE $col=?");		
			$stmt->execute([$val,$value]);
			$success = 'Done';
			return $success;
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}	
	}

	public function activate($tab,$status,$val,$col,$value) {
		try{
			$stmt = $this->db->prepare("UPDATE $tab SET $status =? WHERE $col=?");		
			$stmt->execute([$val,$value]);
			$success = 'Done';
			return $success;
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}	
	}

	//delete
	public function delete_things1($tab,$col,$value,$name) {
		try{
			$stmt = $this->db->prepare("DELETE FROM $tab WHERE $col=?");		
			$stmt->execute([$value]);
			$stmt = null;

			$new_name = strtolower($name);
			$new_name = str_replace(" ", "_", $new_name);

			$stmt = $this->db->prepare("ALTER TABLE `lab_test` DROP `$new_name`;");		
			$stmt->execute();
			$success = 'Done';
			return $success;
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}	
	}

	//delete
	public function delete_things_where2($tab,$col,$value,$col2,$value2) {
		try{
			$stmt = $this->db->prepare("DELETE FROM $tab WHERE $col=? AND $col2 = ?");		
			$stmt->execute([$value,$value2]);
			$success = 'Done';
			return $success;
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}	
	}
	
	//alter
	public function alter_things($tab,$col,$where, $value) {
		try{
			$empty = "";
			$stmt = $this->db->prepare("UPDATE $tab SET $col = ? WHERE $where = ?")->execute([$empty, $value]);
			$stmt = null;
			$success = 'Done';
			return $success;
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}	
	}

	public function select_from_cur_date(){
		try {
			$que= $this->db->prepare("SELECT * FROM doctor_schedule WHERE CURDATE() = day_date");
			$que->execute([]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	//select order
	public function select_from_where_no($table,$col,$valEmp){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col != ?");
			$que->execute([$valEmp]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function select_from_where_ord_0_1($tab,$col,$whe,$tab_id,$ord){
		try {
			$stmt = $this->db->prepare("SELECT id FROM $tab WHERE $col = $whe ORDER BY $tab_id $ord LIMIT 0, 1");
			$stmt->execute([$whe]);
			$arr = $stmt->fetchColumn();
			return $arr;
			$stmt = null;	
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}		
	}

	public function get_last_p($whe){
		try {
			$stmt = $this->db->prepare("SELECT a.id FROM patient_appointment a LEFT JOIN patients b ON a.patient_id = b.id WHERE got = 0 AND b.surname LIKE '%$whe%' OR b.middle_name LIKE '%$whe%' OR b.first_name LIKE '%$whe%' ORDER BY a.date_time_added ASC LIMIT 0,1
				");
			$stmt->execute();
			$arr = $stmt->fetchColumn();
			return $arr;
			$stmt = null;	
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}		
	}
	
	public function end_vitals($val){
		try {
		$stat = 1;
		$stmt = $this->db->prepare("UPDATE patient_appointment SET got =? WHERE id =?");
		$stmt->execute([$stat,$val]);
		$stmt = null;
		return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function update_VLog($reason,$val,$user){
		try {
		$stmt = $this->db->prepare("UPDATE visitors_log SET remark =?,status = 1 WHERE id =?");
		$stmt->execute([$reason,$val]);
		$stmt = null;
		$goto = "visitor_note?id=".$val."&";
		$vname = $this->get_name_from_id('name','visitors_log','id',$val);
		$this->notify("front_desk",$vname,"Remark Made Concerning Visit",$goto);

		return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	
	public function select_last_person2($pn=1){
		try {
			$startFrom = ($pn - 1) * $this->limit;
			$que= $this->db->prepare("SELECT * FROM `patient_appointment` WHERE got = 0 ORDER BY got DESC LIMIT 0, 1");
			$que->execute();
			$row = $que->fetch(PDO::FETCH_OBJ);
			$id = $row->patient_id;
			$que = null;
			
			$que= $this->db->prepare("SELECT title,surname,middle_name,first_name, id FROM `patients`  WHERE id = ? LIMIT $startFrom,$this->limit");
			$que->execute([$id]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function select_last_person2_count(){
		try {
			$que= $this->db->prepare("SELECT * FROM `patient_appointment` WHERE got = 0 ORDER BY got DESC LIMIT 0, 1");
			$que->execute();
			$row = $que->fetch(PDO::FETCH_OBJ);
			$id = $row->patient_id;
			$que = null;
			
			$que= $this->db->prepare("SELECT title,surname,middle_name,first_name FROM `patients` WHERE id = ?");
			$que->execute([$id]);
			$arr = ceil($que->rowCount() / $this->limit);
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function select_last_person(){
		try {
			$que= $this->db->prepare("SELECT * FROM `patient_appointment` WHERE got = 0 ORDER BY got DESC LIMIT 1, 1");
			$que->execute();
			$row = $que->fetch(PDO::FETCH_OBJ);
			$id = $row->patient_id;
			$que = null;
			
			$que= $this->db->prepare("SELECT title,surname,middle_name,first_name FROM `patients` WHERE id = ?");
			$que->execute([$id]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	
	public function select_from_group($table,$group, $id,$ord){
		try {
			$que = $this->db->prepare("SELECT * FROM $table GROUP BY $group ORDER BY $id $ord");
			$que->execute();
			$arr = $que->fetchAll();
			return $arr;
			$que = null;		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_from_group_acc($value){
		try {
			$que = $this->db->prepare("SELECT * FROM accounts WHERE app_id = ? GROUP BY order_id ORDER BY id DESC");
			$que->execute([$value]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}
	
	//Select url
	public function select_url($col){
		try {
			$que = $this->db->prepare("SELECT $col FROM site_url");
			$que->execute();
			$count = $que->fetch(PDO::FETCH_COLUMN);
			return $count;
			$que = null;		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}
	
	public function select_count($col, $table){
		$stmt = $this->db->prepare("SELECT COUNT($col) FROM $table");
		$stmt->execute([]);
		$count = $stmt->fetch(PDO::FETCH_COLUMN);
		echo $count;
		$stmt = null;
	}
	
	public function count_all_user_id($table, $where, $user_id){
		$stmt = $this->db->prepare("SELECT COUNT(*) FROM $table WHERE $where = ?");
		$stmt->execute([$user_id]);
		$count = $stmt->fetch(PDO::FETCH_COLUMN);
		echo $count;
		$stmt = null;
	}
	
	public function count_not_empty($table, $where, $where2){
		$stmt = $this->db->prepare("SELECT COUNT(*) FROM $table WHERE $where <> '' AND $where2 <> ''");
		$stmt->execute([]);
		$count = $stmt->fetch(PDO::FETCH_COLUMN);
		echo $count;
		$stmt = null;
	}
	
	public function count_is_empty($table, $where, $where2){
		$stmt = $this->db->prepare("SELECT COUNT(*) FROM $table WHERE $where = '' AND $where2 = ''");
		$stmt->execute([]);
		$count = $stmt->fetch(PDO::FETCH_COLUMN);
		echo $count;
		$stmt = null;
	}
	
	public function count_partial($table, $where, $where2){
		$stmt = $this->db->prepare("SELECT COUNT(*) FROM $table WHERE $where <> '' OR $where2 <> ''");
		$stmt->execute([]);
		$count = $stmt->fetch(PDO::FETCH_COLUMN);
		echo $count;
		$stmt = null;
	}
	
	public function count_where_userid($user_id){
		$transaction = 1;
		$stmt = $this->db->prepare("SELECT COUNT(*) FROM referrals WHERE user_id = ? AND transaction = ? ");
		$stmt->execute([$user_id, $transaction]);
		$count = $stmt->fetch(PDO::FETCH_COLUMN);
		return $count;
		$stmt = null;
	}
	
	public function select_trans_limit($table){
		try {
			$que= $this->db->prepare("SELECT * FROM $table"); //using LIMIt fro optimization purpose
			$que->execute();
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}
	
	public function select_from_where_limit_user($table,$col,$user_id){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col = ? LIMIT 20");
			$que->execute([$user_id]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function select_from_where_amt_limit($table,$col,$amt, $col2, $val, $col3, $val2){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col = ? AND $col2 = ? AND $col3 = ? LIMIT 20");
			$que->execute([$amt, $val, $val2]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function select_from_where_amt_limit1($table,$col,$amt, $col2, $val){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col = ? AND $col2 = ? LIMIT 1");
			$que->execute([$amt, $val]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function get_notify($id){
		try {
			$que= $this->db->prepare("SELECT * FROM notifications WHERE staff_id = ? AND strikes = 0 ORDER BY status, time_taken DESC LIMIT 1");
			$que->execute([$id]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function select_from_where_limit1($table, $col, $val){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col = ? LIMIT 1");
			$que->execute([$val]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function select_from_where_limit1_ord($table, $col, $val,$ord, $id){
		try {
			$que= $this->db->prepare("SELECT id FROM $table WHERE $col = ? ORDER BY $ord $id LIMIT 1");
			$que->execute([$val]);
			$arr = $que->fetchColumn();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function select_from_where_amt_limit1_LIKE($table,$col,$amt, $col2, $val){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col LIKE ? AND $col2 = ? LIMIT 1");
			$que->execute([$amt, $val]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function show_notification($staff_id, $status){
		try {
			$que= $this->db->prepare("SELECT * FROM notifications WHERE staff_id = $staff_id AND status = $status");
			$que->execute();
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function select_from_where_amt_limit2($table,$col,$amt, $col2, $val){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col = ? AND $col2 = ? LIMIT 20");
			$que->execute([$amt, $val]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	
	//Admin Login
	public function admin_login($username, $password){
		try {
			$que= $this->db->prepare("SELECT admin_id, username, password FROM admin WHERE username= ?");
			$que->execute([$username]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$admin_id = $row->admin_id;
			$name = $row->username;
			$pass = $row->password;
			
			if(password_verify($password, $pass)){
				$_SESSION['admin_id'] = $admin_id;
				header("Location:staff.php");
			} else{
				echo "Invalid username or password";
			}	
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function count_all($table, $user_id){
		$stmt = $this->db->prepare("SELECT COUNT(*) FROM $table WHERE user_id = ?");
		$stmt->execute([$user_id]);
		$count = $stmt->fetch(PDO::FETCH_COLUMN);
		return $count;
		$stmt = null;
	}
	
	public function count_textmsgs_sent($user_id){
		$flag = 1;
		$stmt = $this->db->prepare("SELECT COUNT(*) FROM extra_inv_details WHERE user_id = ? AND text_msg_sent = ? AND MONTH(date_added) = MONTH(CURRENT_DATE) AND YEAR(date_added) = YEAR(CURRENT_DATE)");
		$stmt->execute([$user_id, $flag]);
		$count = $stmt->fetch(PDO::FETCH_COLUMN);
		return $count;
		$stmt = null;
	}
	
	public function count_admin($table){
		$stmt = $this->db->prepare("SELECT COUNT(*) FROM $table ");
		$stmt->execute();
		$count = $stmt->fetch(PDO::FETCH_COLUMN);
		return $count;
		$stmt = null;
	}
	

	public function count_where_admin($table,$col, $id, $col2, $id2){
		$stmt = $this->db->prepare("SELECT COUNT(*) FROM $table WHERE $col = ? AND $col2 = ?");
		$stmt->execute([$id, $id2]);
		$count = $stmt->fetch(PDO::FETCH_COLUMN);
		return $count;
		$stmt = null;
	}
	
	public function count_from($table,$col, $id){
		$stmt = $this->db->prepare("SELECT COUNT(*) FROM $table WHERE $col = ?");
		$stmt->execute([$id]);
		$count = $stmt->fetch(PDO::FETCH_COLUMN);
		return $count;
		$stmt = null;
	}
	
	public function count_where_not($table, $id){
		$stmt = $this->db->prepare("SELECT COUNT(*) FROM $table WHERE id < ? ORDER BY id DESC");
		$stmt->execute([$id]);
		$count = $stmt->fetch(PDO::FETCH_COLUMN);
		return $count;
		$stmt = null;
	}
	
	public function count_limit_admin($table){
		$stmt = $this->db->prepare("SELECT COUNT(*) FROM $table");
		$stmt->execute();
		$count = $stmt->fetch(PDO::FETCH_COLUMN);
		return $count;
		$stmt = null;
	}
	
	//This method is for general select
	public function select($table){
		$stmt = $this->db->prepare("SELECT * FROM $table");
		$stmt->execute();
		$arr = $stmt->fetchAll();
		return $arr;
		$stmt = null;	
	}//end class
	
	//This method is for general select account
	public function select_gen_monthly(){
		$stmt = $this->db->prepare("SELECT * FROM accounts WHERE MONTH(date_paid) = ".date('m')."");
		$stmt->execute();
		$arr = $stmt->fetchAll();
		return $arr;
		$stmt = null;	
	}//end class

	//This method is for general select account
	public function select_deferred(){
		$stmt = $this->db->prepare("SELECT * FROM accounts WHERE payment_status = 4");
		$stmt->execute();
		$arr = $stmt->fetchAll();
		return $arr;
		$stmt = null;	
	}//end class

	//This method is for general select account
	public function select_waved(){
		$stmt = $this->db->prepare("SELECT * FROM accounts WHERE payment_status = 5");
		$stmt->execute();
		$arr = $stmt->fetchAll();
		return $arr;
		$stmt = null;	
	}//end class

	public function get_material(){
		$stmt = $this->db->prepare("SELECT a.name,a.cost_price,b.quantity_dispense as quantity_dispense, b.squantity_dispense as squantity_dispense, c.date_paid FROM pharm_stock a LEFT JOIN prescription b ON a.id = b.pharm_stock_id LEFT JOIN accounts c ON c.order_id = b.reference WHERE a.s_usage = 2 ORDER BY c.date_paid  DESC");
		$stmt->execute();
		$arr = $stmt->fetchAll();
		return $arr;
		$stmt = null;
	}

	//This method is for general select account
	public function select_comp(){
		$stmt = $this->db->prepare("SELECT * FROM accounts a LEFT JOIN companies b ON a.company_id = b.id  WHERE a.payment_status = 3 ORDER BY a.id DESC");
		$stmt->execute();
		$arr = $stmt->fetchAll();
		return $arr;
		$stmt = null;	
	}//end class


	//This method is for general select account
	public function select_comp_id($val){
		$stmt = $this->db->prepare("SELECT * FROM company_bill WHERE company_id = ?  ORDER BY id DESC");
		$stmt->execute($val);
		$arr = $stmt->fetchAll();
		return $arr;
		$stmt = null;	
	}//end class

	//This method is for general select account
	public function select_companies(){
		$stmt = $this->db->prepare("SELECT * FROM companies  ORDER BY id DESC");
		$stmt->execute();
		$arr = $stmt->fetchAll();
		return $arr;
		$stmt = null;	
	}//end class


	//This method is for general select credit
	public function select_gen_credit(){
		$stmt = $this->db->prepare("SELECT * FROM accounts WHERE MONTH(date_paid) = ".date('m')." AND payment_status = 1");
		$stmt->execute();
		$arr = $stmt->fetchAll();
		return $arr;
		$stmt = null;	
	}//end class

	//This method is for general select debit
	public function select_gen_debit(){
		$stmt = $this->db->prepare("SELECT * FROM accounts WHERE MONTH(date_paid) = ".date('m')." AND payment_status != 1 ");
		$stmt->execute();
		$arr = $stmt->fetchAll();
		return $arr;
		$stmt = null;	
	}//end class

	//I am using this function with 2 cos I chnaged $id to $user_id
	public function select_from_where2($table,$col,$user_id){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col= ?");
			$que->execute([$user_id]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	//I am using this function with 2 cos I chnaged $id to $user_id
	public function select_from_where2or($table,$col,$user_id,$od){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col= ? OR $col = ?");
			$que->execute([$user_id,$od]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function select_from_where2and2($table,$col,$user_id,$col2,$od){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col= ? AND $col2 = ?");
			$que->execute([$user_id,$od]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	


	
	//I am using this function with 2 cos I chnaged $id to $user_id
	public function select_from_where2_pres($table,$col,$user_id){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col= ? ORDER BY prescription_id DESC");
			$que->execute([$user_id]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	//I am using this function with 2 cos I chnaged $id to $user_id
	public function select_from_where2_DESC($table,$col,$user_id){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col= ? ORDER BY id DESC");
			$que->execute([$user_id]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	//I am using this function with 3 cos I chnaged $id to $user_id and this displays just the appointment for each doctor
	public function select_from_where2_DESC3($table,$doc){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE treated= 0 AND doctor_id = $doc ORDER BY id DESC");
			$que->execute([$doc]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}


	//I am using this function with 3 cos I chnaged $id to $user_id and this displays just the appointment for each doctor
	public function select_from_where2_DESC5($table,$col,$doc,$col2,$doc2,$col3,$doc3){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE  $col2 = $doc2 AND $col LIKE '".$doc."' AND $col3 = $doc3 ORDER BY id DESC");
			$que->execute([$doc2,$doc,$doc3]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

		public function select_from_where2_DESC4($table,$col,$doc,$col2,$doc2,$col3,$doc3){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE  $col2 = $doc2 AND $col = '$doc' AND $col3 = $doc3 ORDER BY id DESC");
			$que->execute([$doc2,$doc,$doc3]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}


	public function select_from_credit($table,$col,$user_id){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col != ? OR  $col != 3 OR   $col != 4");
			$que->execute([$user_id]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function select_from_debit($table,$col,$user_id){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col = ? OR $col = 3 OR $col = 4");
			$que->execute([$user_id]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function select_distinct_test_name(){
		try {
			$que= $this->db->prepare("SELECT GROUP_CONCAT(test_name),COUNT(test_name) c FROM patient_test_result GROUP by test_name HAVING  c > 1");
			$que->execute();
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

		public function select_distinct_test_name2(){
		try {
			$que= $this->db->prepare("SELECT DISTINCT test_name FROM patient_test_result");
			$que->execute();
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function select_distinct_doc($ref){
		try {
			$que= $this->db->prepare("SELECT DISTINCT staff_id FROM xray_requests WHERE link = '$ref'");
			$que->execute([$ref]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	public function select_invoice(){
		try {
			$que= $this->db->prepare("SELECT DISTINCT invoice_id, staff_id, supplier FROM invoices WHERE prep_mode = 1");
			$que->execute();
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	public function insert_supplier($name,$code, $addr, $city,$country, $phone, $email,$person,$mobile, $notes){
		try {
		$stmt = $this->db->prepare("INSERT INTO pharm_suppliers(Supplier_Name, Supplier_Number, Address, City, Country, Phone_Number, Email, Contact_Person,Mobile_Number,Notes,Date_Added) 
		VALUES (?,?,?,?,?,?,?,?,?,?,NOW())");
		$stmt->execute([$name,$code, $addr, $city,$country, $phone, $email,$person,$mobile, $notes]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

		public function edit_supplier($name,$code, $addr, $city,$country, $phone, $email,$person,$mobile, $notes, $val){
		try {
		
		$stmt = $this->db->prepare("UPDATE pharm_suppliers SET Supplier_Name = ?, Supplier_Number = ?, Address =?, City=?, Country=?, Phone_Number=?,Email=?,Contact_Person=?,Mobile_Number=?,Notes=? WHERE Supplier_ID = ?");
			$stmt->execute([$name,$code, $addr, $city,$country, $phone, $email,$person,$mobile, $notes, $val]);
			
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}


	public function edit_stock_w($name,$code,$batch, $cat, $unit,$cprice, $cartons,$manu, $exp,$supplier,$bunit, $val){
		try {
		
		$stmt = $this->db->prepare("UPDATE warehouse_stock SET name = ?, Stock_number = ?,batch = ?, category =?, units=?, cost=?, cartons=?,manufactured=?,expiring=?,Supplier = ?,bunit= ? WHERE id = ?");
			$stmt->execute([$name,$code,$batch, $cat, $unit,$cprice,$cartons,$manu,$exp,$supplier,$bunit,$val]);
			
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function edit_cstock($name,$code,$batch,$unit,$cprice,$price,$quantity,$manu,$exp,$val){
		try {
		
		$stmt = $this->db->prepare("UPDATE caf_stock SET name = ?, Stock_number = ?,batch = ?, units=?, cost_price=?, price=?, quantity = ?,manufactured=?,expiring=? WHERE id = ?");
			$stmt->execute([$name,$code,$batch,$unit,$cprice,$price,$quantity,$manu,$exp,$val]);
			
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
		public function insert_stock_w($name,$code, $cat, $unit,$unitb,$cartons,$manu, $exp,$mname,$gname,$form,$batch,$usage,$price,$supplier){
		try {
		$stmt = $this->db->prepare("INSERT INTO warehouse_stock(name, Stock_number, category, units,unitb,cartons,manufactured,expiring,manufacturer,generic,form,batch,s_usage,cost,Supplier) 
		VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$stmt->execute([$name,$code, $cat, $unit,$unitb,$cartons,$manu, $exp,$mname,$gname,$form,$batch,$usage,$price,$supplier]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
		//I am using this function with 2 cos I chnaged $id to $user_id
	public function select_from_where2_some($table,$col,$user_id,$col2,$id2){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col = ? AND $col2 = ?");
			$que->execute([$user_id,$id2]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	public function process_invoice($val){
		try {
		$stmt = $this->db->prepare("UPDATE invoices SET prep_mode = 1 WHERE invoice_id = ?");
		$stmt->execute([$val]);			
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function process_BRequest($label,$id,$edit){
		try {
		$stmt = $this->db->prepare("UPDATE `blood_requests` SET `status` = 1, `label_given` = ?, `given_by` = ?, date_given = NOW() WHERE `id` = ?");
		$stmt->execute([$label,$id,$edit]);			
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function insert_invoice($staff,$name,$supplier, $lot, $unit,$quantity, $price,$exp,$batch,$destination,$total,$invoice){
		try {
		$stmt = $this->db->prepare("INSERT INTO invoices(staff_id,drug,supplier,lot,batch,destination,expiring,unit,quantity, price,total,date_added,invoice_id) 
		VALUES (?,?,?,?,?,?,?,?,?,?,?,NOW(),?)");
		$stmt->execute([$staff,$name,$supplier, $lot,$batch,$destination, $exp,$unit,$quantity,$price,$total,$invoice]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	//count Dispense
	public function count_invoice(){
		try {
			$que= $this->db->prepare("SELECT DISTINCT invoice_id FROM invoices");
			$que->execute();
			$arr = $que->rowCount();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	public function requests_to_warehouse(){
		try {
			$que= $this->db->prepare("SELECT * FROM pharm_requests a 
										left join staff b on a.staff_id = b.user_id 
										ORDER BY a.request_id DESC");
			$que->execute();
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}
public function insert_form($form_name){
		try {
		$stmt = $this->db->prepare("INSERT INTO pharm_form(form_name) 
		VALUES (?)");
		$stmt->execute([$form_name]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

public function update_pos($value){
		try {
		$stmt = $this->db->prepare("SELECT Sales_Quantity,Stock_Item FROM caf_sales_detail WHERE Sales_ID = ?");
		$stmt->execute([$value]);
		$row = $stmt->fetch(PDO::FETCH_OBJ);
		$qty = $row->Sales_Quantity;
		$itm = $row->Stock_Item;
		$stmt = null;

		$stmt = $this->db->prepare("SELECT quantity FROM caf_stock WHERE id = ?");
		$stmt->execute([$itm]);
		$row = $stmt->fetch(PDO::FETCH_OBJ);
		$qty1 = $row->quantity;
		$stmt = null;
		$q = $qty + $qty1;

		$stmt = $this->db->prepare("UPDATE caf_stock SET quantity = ? WHERE id = ?");
		$stmt->execute([$q,$itm]);
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function update_pos2($value){
		try {
		$stmt = $this->db->prepare("SELECT Sales_Quantity,Stock_Item FROM caf_sales_detail WHERE Sales_Number = ?");
		$stmt->execute([$value]);
		$rowq = $stmt->fetchAll();
		foreach ($rowq as $row) {
			$qty = $row['Sales_Quantity'];
			$itm = $row['Stock_Item'];
			$stmt = null;

			$stmt = $this->db->prepare("SELECT quantity FROM caf_stock WHERE id = ?");
			$stmt->execute([$itm]);
			$row = $stmt->fetch(PDO::FETCH_OBJ);
			$qty1 = $row->quantity;
			$stmt = null;
			$q = $qty + $qty1;

			$stmt = $this->db->prepare("UPDATE caf_stock SET quantity = ? WHERE id = ?");
			$stmt->execute([$q,$itm]);
			$stmt = null;
		}
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function edit_form($form_name, $val){
		try {
		
		$stmt = $this->db->prepare("UPDATE pharm_form SET form_name = ? WHERE id = ?");
			$stmt->execute([$form_name, $val]);
			
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	public function edit_usage($usage_name, $val){
		try {
		
		$stmt = $this->db->prepare("UPDATE pharm_usage SET usage_name = ? WHERE id = ?");
			$stmt->execute([$usage_name, $val]);
			
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}


		public function insert_usage($usage_name){
		try {
		$stmt = $this->db->prepare("INSERT INTO pharm_usage(usage_name) 
		VALUES (?)");
		$stmt->execute([$usage_name]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

		public function warehouse_returns(){
		try {
			$que= $this->db->prepare("SELECT a.id as id1,b.request_id as id2, a.order_id as ref, a.to_pay as amount, a.to_pay as to_pay, a.date_paid as date, b.staff_id as staff_id, b.quantity_needed as quantity, b.Stock_number as Stock_number FROM accounts a left join pharm_requests b on a.order_id = b.reference WHERE a.item = 9 ORDER BY a.id DESC");
			$que->execute();
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}
	public function update_warehouse_stock($val, $barcode,$id,$id2){		
		try {
			$stmt = $this->db->prepare("UPDATE warehouse_stock SET cartons = ?,Stock_number=? WHERE id = ?");
			$stmt->execute([$val,$barcode,$id]);
			$stmt = null;

			$stmt = $this->db->prepare("SELECT * FROM warehouse_stock WHERE id = ?");
			$stmt->execute([$id]);
			$row = $stmt->fetch(PDO::FETCH_OBJ);
			$batch = $row->batch;
			$sn = $row->Stock_number;
			$mdate = $row->manufactured;
			$exp = $row->expiring;
			$name = $row->name;
			$cat = $row->category;
			$un = $row->units;
			$cart = $row->cartons;
			$pric = $row->cost;
			$mname = $row->manufacturer;
			$gname = $row->generic;
			$form = $row->form;
			$ssuse = $row->s_usage;
			$stmt = null;

			$stmt = $this->db->prepare("SELECT quantity_needed,reference FROM pharm_requests WHERE request_id = ?");
			$stmt->execute([$id2]);
			$row = $stmt->fetch(PDO::FETCH_OBJ);
			$qty = $row->quantity_needed;
			$refe = $row->reference;
			$stmt = null;

			$status = 1;
			$stmt = $this->db->prepare("UPDATE pharm_requests SET request_status = ?,Stock_number = ?,batch = ?,status = 1 WHERE request_id = ?");
			$stmt->execute([$status,$barcode,$batch,$id2]);
			$stmt = null;

			$stmt = $this->db->prepare("INSERT INTO `pharm_stock` (`reference2`,`Stock_number`, `manufactured`, `expiring`, `name`, `category`, `units`, `stock`, `cost_price`, `manufacturer`, `generic`, `batch`, `s_usage`, `date_added`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())");
			$stmt->execute([$refe,$sn,$mdate,$exp,$name,$cat,$un,$qty,$pric,$mname,$gname,$batch,$ssuse]);
			$stmt = null;


			$success = "Done";
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Stock could not be updated
				  </div>: ' . $e->getMessage();
		}
	}
public function cancel_prescription_w($val,$status,$quantity,$pharm,$doc){
		try {
		$this->db->beginTransaction();
		
		$stmt = $this->db->prepare("UPDATE prescription SET pres_status = ? WHERE prescription_id = ?");
		$stmt->execute([$status, $val]);
		
		$stmt = $this->db->prepare("UPDATE pharm_stock SET c_carton = ? WHERE id = ?" );
		$stmt->execute([$quantity,$pharm]);
		
		
		$this->db->commit();
			
		$stmt = null;

		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	public function update_opened_stock2($val, $barcode,$id,$s,$id2){		
		try {
			$que= $this->db->prepare("SELECT cartons FROM pharm_stock WHERE id = ?");
			$que->execute([$id]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$ncartons = $row->cartons;
			$cartons = intval($ncartons - 1);
			$que = null;



			$stmt = $this->db->prepare("UPDATE pharm_stock SET c_carton = ?,Stock_number=?,cartons = ? WHERE id = ?");
			$stmt->execute([$val,$barcode,$cartons,$id]);
			$stmt = null;

			$status = 1;
			$stmt = $this->db->prepare("UPDATE prescription SET pres_status = ? ,Stock_number = ? WHERE prescription_id = ?");
			$stmt->execute([$status,$barcode,$id2]);
			$stmt = null;

			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Stock could not be updated
				  </div>: ' . $e->getMessage();
		}
	}

	public function approve_request($val,$status){
		try {
		if ($status == 2) {
			$this->db->beginTransaction();
		
		$stmt = $this->db->prepare("UPDATE pharm_requests SET request_status = ?,status = ? WHERE request_id = ?");
		$stmt->execute([$status,$status, $val]);
		
		
		$this->db->commit();
			
		$stmt = null;

		}else{
			$this->db->beginTransaction();
		
		$stmt = $this->db->prepare("UPDATE pharm_requests SET request_status = ? WHERE request_id = ?");
		$stmt->execute([$status,$val]);
		
		
		$this->db->commit();
			
		$stmt = null;

		}
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function changeBedStatus($val,$status){
		try {
			$this->db->beginTransaction();
		
		$stmt = $this->db->prepare("UPDATE beds SET status = ? WHERE id = ?");
		$stmt->execute([$status, $val]);
		
		
		$this->db->commit();
			
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
public function edit_stock($stock1, $val,$staff){
		try {

		$que= $this->db->prepare("SELECT stock FROM pharm_stock WHERE id = ?");
			$que->execute([$val]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$s1 = $row->stock;
			$que = null;

		$stock = intval($s1) + intval($stock1);
		
		$stmt = $this->db->prepare("UPDATE pharm_stock SET stock=? WHERE id = ?");
			$stmt->execute([$stock, $val]);
		$stmt = null;

		$stmt = $this->db->prepare("INSERT INTO pharm_updates(pharm_id,quantity,staff,date_added) VALUES(?,?,?,NOW())");
			$stmt->execute([$val,$stock1,$staff]);
		$stmt = null;

		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function select_from_scan_xray($table,$table2,$col1,$col2,$col,$id){ 
		
		try {
			$que= $this->db->prepare("SELECT a.name,a.link FROM $table a LEFT JOIN $table2 b ON a.".$col1." = b.".$col2." WHERE a.".$col." = ? "); //using LIMIt fro optimization purpose
			$que->execute([$id]);
			$row =  $que->fetchAll();
			return $row;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	public function select_from_where_Like($table,$col,$id){ 
		
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col LIKE ?"); //using LIMIt fro optimization purpose
			$que->execute([$id]);
			$row =  $que->fetchAll();
			return $row;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function select_injections(){ 
		
		try {
			$que= $this->db->prepare("SELECT a.name,a.id FROM `pharm_stock` a LEFT JOIN `pharm_category` b ON b.id = a.category WHERE b.cat_name LIKE '%Inj%'"); //using LIMIt fro optimization purpose
			$que->execute();
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	public function select_from_warehouse_requests(){
		try {
			$que= $this->db->prepare("SELECT * FROM pharm_requests a 
										left join staff b on a.staff_id = b.user_id 
										left join warehouse_stock c on a.warehouse_stock_id = c.id
										ORDER BY a.request_id DESC");
			$que->execute();
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}

	public function stock_finish_w(){
		try {
			$que= $this->db->prepare("SELECT name,cartons FROM warehouse_stock WHERE cartons <= 10");
			$que->execute();
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function select_distinct_from_where($col,$col2,$tab){
		try {
			$que= $this->db->prepare("SELECT DISTINCT $col,$col2, FROM $tab");
			$que->execute();
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function select_from_where2_some_val($value){
		try {
			$que= $this->db->prepare("SELECT * FROM patient_test_result WHERE ref_id= ? AND value != ''");
			$que->execute([$value]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function select_for_docy($user_id){
		try {
			$val = 0;
			$que= $this->db->prepare("SELECT * FROM patient_appointment WHERE treated = ? AND doctor_id = ?");
			$que->execute([$val, $user_id]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	
	public function select_pass($val){
		try {
			$que= $this->db->prepare("SELECT password FROM staff WHERE user_id = ?");
			$que->execute([$val]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$pass = $row->password;
			return $pass;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function select_from_lab(){
		try {
			$awat =1;
			$seen =0;
			$que= $this->db->prepare("SELECT * FROM patient_test_group WHERE awaiting_result =? and seen_result =? ");
			$que->execute([$awat,$seen]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	//I am using this function with 2 cos I chnaged $id to $user_id
	public function select_from_where3($table,$col,$user_id){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col= ? ORDER BY id DESC");
			$que->execute([$user_id]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	

	public function select_from_where31($table,$col,$user_id){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col= ? ORDER BY patient_test_id DESC");
			$que->execute([$user_id]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function select_title($table,$col,$title){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col= ?");
			$que->execute([$title]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
		
	//select order
	public function select_order($table,$col,$inv_num){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col= ?");
			$que->execute([$inv_num]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	public function select_from_where2_ord($table,$col,$user_id,$id,$pn=1){
		try {
			$startFrom = ($pn - 1) * $this->limit;
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col= ? $id $ord LIMIT $startFrom,$this->limit");
			$que->execute([$user_id]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function select_last_consult($doc){
		try {
			$que= $this->db->prepare("SELECT * FROM `consulting_rooms` WHERE doctor_id = ? ORDER BY date_added DESC LIMIT 1");
			$que->execute([$doc]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	//Consulting Room Changes
	public function change_room($doc,$room){
		try {
		$stmt = $this->db->prepare("INSERT INTO consulting_rooms(doctor_id,room,date_added) VALUES (?,?,NOW())");
		$stmt->execute([$doc,$room]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	//Select order
	public function select_from_ord($table,$id,$ord,$pn=1){
		try {
			
			$startFrom = ($pn - 1) * $this->limit;
			$que = $this->db->prepare("SELECT * FROM $table ORDER BY $id $ord LIMIT $startFrom,$this->limit");
			$que->execute();
			$arr = $que->fetchAll();
			return $arr;
			$que = null;		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}
//na here
	public function select_from_ord_2($table,$id,$ord,$id2,$ord2,$pn=1){
		try {
			
			$startFrom = ($pn - 1) * $this->limit;
			$que = $this->db->prepare("SELECT * FROM $table ORDER BY $id $ord, $id2 $ord2 LIMIT $startFrom,$this->limit");
			$que->execute();
			$arr = $que->fetchAll();
			return $arr;
			$que = null;		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}

	public function select_from_ord_group($table,$id,$id2,$ord,$pn=1){
		try {
			
			$startFrom = ($pn - 1) * $this->limit;
			$que = $this->db->prepare("SELECT * FROM $table GROUP BY $id ORDER BY $id2 $ord  LIMIT $startFrom,$this->limit");
			$que->execute();
			$arr = $que->fetchAll();
			return $arr;
			$que = null;		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}

	public function select_from_where2_ord_group($table,$col,$data,$id,$id2,$ord,$pn=1){
		try {
			
			$startFrom = ($pn - 1) * $this->limit;
			$que = $this->db->prepare("SELECT * FROM $table WHERE $col = ? GROUP BY $id ORDER BY $id2 $ord  LIMIT $startFrom,$this->limit");
			$que->execute([$data]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}

	public function select_from_where2_ord_groupa($table,$col,$data,$id,$id2,$ord,$pn=1){
		try {
			
			$startFrom = ($pn - 1) * $this->limit;
			$que = $this->db->prepare("SELECT * FROM $table WHERE $col = ? OR doctor_id = 2 GROUP BY $id ORDER BY $id2 $ord  LIMIT $startFrom,$this->limit");
			$que->execute([$data]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}

	//Select order
	public function select_from_ord1($table,$id,$ord){
		try {
			$que = $this->db->prepare("SELECT * FROM $table ORDER BY $id $ord");
			$que->execute();
			$arr = $que->fetchAll();
			return $arr;
			$que = null;		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}

	//Selecet order
	public function select_ledger_monthly(){
		try {
			$que = $this->db->prepare("SELECT SUM(debit) as debit, SUM(credit) as credit, SUM(balance) as balance,id,MONTHNAME(date_ref) as month,YEAR(date_ref) as year FROM `ledger_temp` GROUP BY MONTH(date_ref) ORDER BY date_ref ASC");
			$que->execute();
			$arr = $que->fetchAll();
			return $arr;
			$que = null;		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}

	//Selecet order
	public function select_distinct_from_two_tables_ord($table,$table2,$col,$col2,$id,$ord){
		try {
			$que = $this->db->prepare("SELECT * FROM $table a LEFT JOIN $table2 b ON $col = $col2 ORDER BY $id $ord");
			$que->execute();
			$arr = $que->fetchAll();
			return $arr;
			$que = null;		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}
	
	public function select_from_ord2($table,$ord){
		try {
			$que = $this->db->prepare("SELECT * FROM $table ORDER BY id $ord");
			$que->execute();
			$arr = $que->fetchAll();
			return $arr;
			$que = null;		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}
	
	public function select_from_ord3($table,$doc,$id,$ord){
		try {
			$que = $this->db->prepare("SELECT * FROM $table WHERE doctor_id = $doc ORDER BY $id $ord");
			$que->execute();
			$arr = $que->fetchAll();
			return $arr;
			$que = null;		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}
	public function select_from_where_ord($tab,$col,$whe,$tab_id,$ord){
		try {
			
			$stmt = $this->db->prepare("SELECT * FROM $tab WHERE $col = $whe ORDER BY $tab_id $ord");
			$stmt->execute([$whe]);
			$arr = $stmt->fetchAll();
			return $arr;
			$stmt = null;	
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}		
	}
	
	public function select_from_where_ord2($tab,$col,$whe, $col2, $whe2,$tab_id,$ord){
		try {
			
			$stmt = $this->db->prepare("SELECT * FROM $tab WHERE $col = $whe AND $col2 = '".$whe2."' ORDER BY $tab_id $ord");
			$stmt->execute([$whe,$whe2]);
			$arr = $stmt->fetchAll();
			return $arr;
			$stmt = null;	
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}		
	}

	public function select_from_where_ord_pn($tab,$col,$whe,$tab_id,$ord,$pn=1){
		try {
			$startFrom = ($pn - 1) * $this->limit;
			$stmt = $this->db->prepare("SELECT * FROM $tab WHERE $col = $whe ORDER BY $tab_id $ord LIMIT $startFrom,$this->limit");
			$stmt->execute([$whe,$whe2]);
			$arr = $stmt->fetchAll();
			return $arr;
			$stmt = null;	
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}		
	}

	public function search_ord_pn($whe,$pn=1){
		try {
			$startFrom = ($pn - 1) * $this->limit;
			$stmt = $this->db->prepare("SELECT a.id,a.got,a.temperature,a.patient_id,a.blood_press_stand_s,a.blood_press_stand_d,a.blood_press_sit_d,a.blood_press_sit_s,a.weight,a.pulse_rate,a.history,a.date_added,b.surname,b.first_name,b.middle_name FROM patient_appointment a LEFT JOIN patients b ON a.patient_id = b.id WHERE b.surname LIKE '%$whe%' OR b.middle_name LIKE '%$whe%' OR b.first_name LIKE '%$whe%' ORDER BY a.got ASC,a.date_time_added ASC LIMIT $startFrom,$this->limit");
			$stmt->execute();
			$arr = $stmt->fetchAll();
			return $arr;
			$stmt = null;	
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}		
	}

	public function select_from_where_ord_count($tab,$col,$whe,$tab_id,$ord){
		try {
			$stmt = $this->db->prepare("SELECT * FROM $tab WHERE $col = $whe ORDER BY $tab_id $ord");
			$stmt->execute([$whe,$whe2]);
			$arr = ceil($stmt->rowCount() / $this->limit);
			return $arr;
			$stmt = null;	
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}		
	}
	

	public function select_from_where_ord31($tab,$col,$whe, $col2, $whe2,$whe3,$tab_id,$ord){
		try {
			
			$stmt = $this->db->prepare("SELECT * FROM $tab WHERE $col = $whe AND date($col2) BETWEEN '$whe2' AND '$whe3' ORDER BY $tab_id $ord");
			$stmt->execute();
			return $stmt;
			$stmt = null;	
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}		
	}


	public function select_from_where_ord3($tab,$col,$whe, $col2, $whe2,$tab_id,$ord){
		try {
			
			$stmt = $this->db->prepare("SELECT * FROM $tab WHERE $col = '$whe' AND $col2 = '".$whe2."' ORDER BY $tab_id $ord");
			$stmt->execute([$whe,$whe2]);
			$arr = $stmt->fetchAll();
			return $arr;
			$stmt = null;	
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}		
	}

	public function select_from_where_ord4($tab,$col,$whe, $col2,$tab_id,$ord){
		try {
			
			$stmt = $this->db->prepare("SELECT * FROM $tab WHERE $col = $whe AND $col2 = '' ORDER BY $tab_id $ord");
			$stmt->execute([$whe]);
			$arr = $stmt->fetchAll();
			return $arr;
			$stmt = null;	
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}		
	}

	public function select_from_where_ord5($tab,$col,$whe,$col2,$ord){
		try {
			
			$stmt = $this->db->prepare("SELECT * FROM $tab WHERE $col = $whe AND $col2 = '' ORDER BY patient_test_group_id $ord");
			$stmt->execute();
			$arr = $stmt->fetchAll();
			return $arr;
			$stmt = null;	
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}		
	}

	public function select_from_val($table,$col,$val){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col= ? LIMIT 1");
			$que->execute([$val]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function select_from_val_ord($table,$col,$val,$id,$ord){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col= ? ORDER BY $id $ord LIMIT 1");
			$que->execute([$val]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function select_from_no_limit($table,$col,$value){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col= ?");
			$que->execute([$value]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function select_for_cart($table,$col,$value){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col= ?");
			$que->execute([$value]);
			$arr = $que->fetchAll(PDO::FETCH_ASSOC);
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function select_while_user_id($user_id, $col){
		try {
			$que= $this->db->prepare("SELECT * FROM users WHERE $col = ?");
			$que->execute([$user_id]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function select_from_payment($table,$col,$ref){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col= ?");
			$que->execute([$ref]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function select_from_where($table,$col,$id){ 
		
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col= ? LIMIT 1"); //using LIMIt fro optimization purpose
			$que->execute([$id]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
		public function select_from_where6($table,$col,$id){ 
		
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col LIKE '%".$id."%' LIMIT 1"); //using LIMIt fro optimization purpose
			$que->execute([$id]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function select_from_where60($table,$col,$id,$order){  
		
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col = '".$id."' ORDER BY $order DESC"); //using LIMIt fro optimization purpose
			$que->execute([$id]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function next_cost_of_drugs($id){  
		
		try {

			$que= $this->db->prepare("select date_paid from accounts WHERE item = 3 ORDER BY date_paid ASC LIMIT $id,1");
			$que->execute();
			$SingleVar = $que->fetchColumn();
			return $SingleVar;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}


public function get_name_from_id_and_id2($tab,$col,$whe,$id,$whe2,$id2){
		try{
			$que= $this->db->prepare("SELECT $tab FROM $col where $whe =? AND $whe2 = ?");
			$que->execute([$id,$id2]);
			$SingleVar = $que->fetchColumn();
			return $SingleVar;
			$que = null;			
		} catch(PDOException $e){
			echo 'Error: ' . $e->getMessage();
		}	
	}
	public function select_from_where61($table,$col,$id,$col2,$id2,$order){ 
		
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col LIKE '".$id."' AND $col2 LIKE '".$id2."' ORDER BY $order DESC"); //using LIMIt fro optimization purpose
			$que->execute([$id,$id2]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function select_from_where61_ord($table,$col,$id,$col2,$id2,$order,$pn=1){ 
		
		try {
			$startFrom = ($pn - 1) * $this->limit;
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col LIKE '".$id."' AND $col2 LIKE '".$id2."' ORDER BY $order DESC LIMIT $startFrom,$this->limit"); //using LIMIt fro optimization purpose
			$que->execute([$id,$id2]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function select_from_where61_count($table,$col,$id,$col2,$id2,$order){ 
		
		try {
			$startFrom = ($pn - 1) * $this->limit;
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col LIKE '".$id."' AND $col2 LIKE '".$id2."' ORDER BY $order DESC"); //using LIMIt fro optimization purpose
			$que->execute([$id,$id2]);
			$arr = $que->rowCount();
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function select_from_where8($id){ 
		
		try {
			$que= $this->db->prepare("SELECT DISTINCT patient_id , GROUP_CONCAT(order_id) FROM accounts WHERE order_id = ".$id."");
			$que->execute([$id]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
		public function select_from_where7($table,$col,$id){ 
		
		try {
			$que= $this->db->prepare("SELECT *, SUM(amount) FROM $table WHERE $col LIKE '%".$id."%' LIMIT 1"); //using LIMIt fro optimization purpose
			$que->execute([$id]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}


	public function select_from_where_no_lim($table,$col,$id){
		
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col= ?"); //using LIMIt fro optimization purpose
			$que->execute([$id]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function select_from_while($table,$col,$val){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col= ?");
			$que->execute([$val]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function select_from_double($table,$col,$val, $col2, $val2){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col= ? AND $col2 = ?");
			$que->execute([$val, $val2]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function select_table($table){
		$stmt = $this->db->prepare("SELECT * FROM $table");
		$stmt->execute();			
		return $stmt;
		$stmt = null;	
	}//end class

	
	public function select_from_user($table, $user_id){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE id = ?");
			$que->execute([$user_id]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	//selecet limit
	public function select_from_where_limit($table, $user_id, $offset, $limit){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE user_id = ? ORDER BY id DESC LIMIT $offset, $limit");
			$que->execute([$user_id]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function select_from_where_limit_admin($table, $col, $offset, $limit){
		try {
			$que= $this->db->prepare("SELECT * FROM $table ORDER BY $col DESC LIMIT $offset, $limit");
			$que->execute([]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	
	public function select_from_where_limit_where($val, $offset, $limit){
		try {		
			$val2 = 0;
			$que= $this->db->prepare("SELECT * FROM extra_inv_details WHERE client_id= ? AND invoice_sent != ? ORDER BY id DESC LIMIT $offset, $limit");
			$que->execute([$val, $val2]);
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error			
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function select_from_front_desk_id($pat,$doc){
		try {		
			$val2 = 0;
			$que= $this->db->prepare("SELECT * FROM patient_test_group WHERE patient_id = ? AND patient_appointment_id = 0 AND front_desk != '' AND doctor_id = ? ORDER BY patient_test_group_id DESC");
			$que->execute([$pat,$doc]);
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error			
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function select_from_where_limit_draft( $val, $offset, $limit){
		try {		
			$val2 = 0;
			$que= $this->db->prepare("SELECT * FROM extra_inv_details WHERE client_id= ? AND invoice_sent = ? ORDER BY id DESC LIMIT $offset, $limit");
			$que->execute([$val, $val2]);
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error			
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function select_from_where_limit_all( $val, $offset, $limit){
		try {		
			$que= $this->db->prepare("SELECT * FROM extra_inv_details WHERE client_id= ? ORDER BY id DESC LIMIT $offset, $limit");
			$que->execute([$val]);
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error			
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function select_from_wherenot_ord($table,$col,$id,$orid,$ord){
		try {
			$que= $this->db->prepare("SELECT * FROM $table where $col!=? ORDER BY $orid $ord");
			$que->execute([$id]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function select_from_where_and_not($table,$col,$id,$col2,$id2){
		try {
			$que= $this->db->prepare("SELECT * FROM $table where $col !=? AND $col2 =?");
			$que->execute([$id,$id2]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function select_from_where_and_not2($table,$col,$id,$col2,$id2){
		try {
			$que= $this->db->prepare("SELECT * FROM $table where $col !=? AND $col2 =? AND status != 1");
			$que->execute([$id,$id2]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function select_from_where_and_not3($table,$col,$id,$id2,$col2,$id3){
		try {
			$que= $this->db->prepare("SELECT * FROM $table where $col !=? AND $col != 2 AND $col2 =?");
			$que->execute([$id,$id2,$id3]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	//Method to check if user exists before registration
	public function check_email($username){
			
		try {
			$stmt= $this->db->prepare("SELECT username FROM staff WHERE username= ?");
			$stmt->execute([$username]);
			$row=$stmt->fetch(PDO::FETCH_OBJ);
			return $row;			
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	

	//For Payroll
	public function insert_pay($basic,$housing,$hazard,$transport,$cduty,$feeding,$medicals,$pholiday,$others,$total_income,$paye,$pension,$loan,$thrift,$advance,$daycare,$pharmacy,$welfare,$dothers,$total_deductions,$staff,$id){
		try {
		$net_salary = $total_income - $total_deductions;
		$stmt = $this->db->prepare("INSERT INTO `payroll`(`basic`, `housing`, `transport`, `cduty`, `hazard`, `feeding`, `medicals`, `pholiday`, `others`, `total_income`, `paye`,`pension`, `loan`, `thrift`, `advance`, `daycare`, `pharmacy`, `welfare`, `dothers`, `total_deductions`, `net_salary`, `staff_id`,`added_by`, `date_paid`,`date_added`) 
		VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW(),NOW())");
		$stmt->execute([$basic,$housing,$transport,$cduty,$hazard,$feeding,$medicals,$pholiday,$others,$total_income,$paye,$pension,$loan,$thrift,$advance,$daycare,$pharmacy,$welfare,$dothers,$total_deductions,$net_salary,$staff,$id]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	//For Payroll  Edit
	public function insert_edit_pay($basic,$housing,$hazard,$transport,$cduty,$feeding,$medicals,$pholiday,$others,$total_income,$paye,$pension,$loan,$thrift,$advance,$daycare,$pharmacy,$welfare,$dothers,$total_deductions,$staff,$id,$edit){
		try {
		$net_salary = $total_income - $total_deductions;
		$stmt = $this->db->prepare("UPDATE `payroll` SET `basic` = ?, `housing` = ?, `transport` = ?, `cduty` = ?, `hazard` = ?, `feeding` =?, `medicals` =?, `pholiday` = ?, `others` = ?, `total_income` = ?, `paye` = ?,`pension` = ?, `loan` = ?, `thrift` = ?, `advance` = ?, `daycare` = ?, `pharmacy` = ?, `welfare` = ?, `dothers` = ?, `total_deductions` = ?, `net_salary` = ?, `staff_id` = ?,`added_by` = ?, `date_paid` = NOW(), `date_added` = NOW() WHERE `id` = ?");
		$stmt->execute([$basic,$housing,$transport,$cduty,$hazard,$feeding,$medicals,$pholiday,$others,$total_income,$paye,$pension,$loan,$thrift,$advance,$daycare,$pharmacy,$welfare,$dothers,$total_deductions,$net_salary,$staff,$id,$edit]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	//For user registration
	public function insert_user($first_name, $last_name,$other_names,$address,$phone,$dob,$pob,$sex,$mstatus,$nok,$pnok,$state,$lga,$doe,$salary,$noc,$child1,$child2,$child3,$child4,$weight,$img, $username, $role, $hash, $position,$ward,$religion){
		try {
		$stmt = $this->db->prepare("INSERT INTO staff(first_name,last_name,other_names,contact_address,phone_number,dob,pob,sex,mstatus,nok,phone_nok,state,lga,date_of_emp,starting_salary,no_of_children,child1,child2,child3,child4,weight,staff_img, username, role_id, password, position,ward_id,religion) 
		VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$stmt->execute([$first_name, $last_name,$other_names,$address,$phone,$dob,$pob,$sex,$mstatus,$nok,$pnok,$state,$lga,$doe,$salary,$noc,$child1,$child2,$child3,$child4,$weight,$img, $username, $role, $hash, $position,$ward,$religion]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function SendtoAcc2($val,$transfer,$pos,$cash,$bank_used,$change,$discount){		
		try {
			//Details
				$que= $this->db->prepare("SELECT Sales_ID,SUM(Purchasing_Price) As Purchasing_Price, addedby FROM caf_sales_detail WHERE Sales_Number = ?");
				$que->execute([$val]);
				$row = $que->fetch(PDO::FETCH_OBJ);
					$id = $row->Sales_ID;
					$pri = $row->Purchasing_Price;
					$staff = $row->addedby;
					$que = null;

					$dateDay = date("Y-m-d");
					$stmt = $this->db->prepare("INSERT INTO caf_accounts(`order_id`,`to_pay`,`dispenser`,`date_added`,`cash`,`pos`,`transfer`,`bank_used`,`bchange`,`discount`) 
					VALUES (?,?,?,?,?,?,?,?,?,?)");
					$stmt->execute([$val,$pri,$staff,$dateDay,$cash,$pos,$transfer,$bank_used,$change,$discount]);			
					$stmt = null;
					$stmt = $this->db->prepare("UPDATE caf_sales_detail SET account_status = 1 WHERE Sales_ID = ?"); 
					$stmt->execute([$id]);
					$stmt = null;

				

				$success = 'Done';
				return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					Items Could Not be Sent To account
				  </div>: ' . $e->getMessage();
		}
	}

	public function SendtoAcc($val){		
		try {
			//Details
				$que= $this->db->prepare("SELECT * FROM `in-patients` WHERE app_id = ?");
				$que->execute([$val]);
				$num = $que->rowCount();
				$que = null;

				$que= $this->db->prepare("SELECT card_type FROM accounts WHERE app_id = ? AND card_type != 0 LIMIT 1");
				$que->execute([$val]);
				$row = $que->fetch(PDO::FETCH_OBJ);
				$card = $row->card_type;
				$que = null;

				$que= $this->db->prepare("SELECT SUM(to_pay) as refund FROM `in-patients` WHERE app_id = ? AND nature = 1");
				$que->execute([$val]);
				$row = $que->fetch(PDO::FETCH_OBJ);
				$deposit = $row->refund;
				$que = null;

				$que= $this->db->prepare("SELECT SUM(to_pay) as discount FROM `in-patients` WHERE app_id = ? AND nature = 4");
				$que->execute([$val]);
				$row = $que->fetch(PDO::FETCH_OBJ);
				$discount = $row->discount;
				$que = null;

				$que= $this->db->prepare("SELECT SUM(to_pay) as sum FROM `in-patients` WHERE app_id = ?");
				$que->execute([$val]);
				$row = $que->fetch(PDO::FETCH_OBJ);
				$pri = $row->sum;
				$que = null;

				$que= $this->db->prepare("SELECT * FROM `patient_appointment` WHERE id = ?");
				$que->execute([$val]);
				$row = $que->fetch(PDO::FETCH_OBJ);
				$p_id = $row->patient_id;
				$front_desk = $row->front_desk;
				$que = null;

				$type = 9;
				$code = rand(1000,100000);
				$adm = 1;
				$dateDay = date("Y-m-d");
				$stmt = $this->db->prepare("INSERT INTO accounts(`order_id`,`card_type`,`item`,`patient_id`,`front_desk`,`app_id`,`adm`,`to_pay`,`date_added`) 
				VALUES (?,?,?,?,?,?,?,?,?)");
				$stmt->execute([$code,$card,$type,$p_id,$front_desk,$val,$adm,$pri,$dateDay]);			
				$stmt = null;

				$stmt = $this->db->prepare("UPDATE `in-patients` SET status = 1 WHERE app_id = ? AND nature != 1 OR nature != 4"); 
				$stmt->execute([$val]);
				$stmt = null;
				//send to debit balance
				$type = 3;
				$item = "In Patient Deposit Refund";
				$pat = Database::getInstance()->select_from_where("patients","id",$p_id);
				foreach ($pat as $e) {
				 	$patient = $e['surname']." ".$e['first_name']." ".$e['middle_name'];
				 }

				if ($deposit > $pri) {
					$refund = intval($deposit) - intval($pri) - intval($disco);
					$stmt = $this->db->prepare("INSERT INTO daily_expense(`code`,`type`,`description`,`recipient`,`qty`,`amt`,`cash_bank`,`comment`,`date_added`,`approver`) 
				VALUES (?,?,?,?,1,?,'Cash',?,?,?)");
				$stmt->execute([$code,$type,$item,$patient,$refund,$item,$dateDay,$user_id]);			
				$stmt = null;
				}
				$success = 'Done';
				return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					Items Could Not be Sent To account
				  </div>: ' . $e->getMessage();
		}
	}

	//count in-patient_bill
	public function count_bill($aid){
		try {
			$que= $this->db->prepare("SELECT * FROM `in-patients` WHERE app_id = ?");
			$que->execute([$aid]);
			$arr = $que->rowCount();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	//count column
	public function count_it($tab,$col,$aid){
		try {
			$que= $this->db->prepare("SELECT * FROM $tab WHERE $col = ?");
			$que->execute([$aid]);
			$arr = $que->rowCount();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	public function insert_bill($aid,$fee,$desc,$nat,$staff){
		try {
			if ($nat == 2 || $nat  == 3) {
				$fee1 = intval("-".$fee);
				$stmt = $this->db->prepare("INSERT INTO `in-patients`(app_id,item,nature,to_pay,prepared_by,date_added) 
			VALUES (?,?,?,?,?,NOW())");
			$stmt->execute([$aid,$desc,$nat,$fee1,$staff]);			
			$stmt = null;
			}else{
				$stmt = $this->db->prepare("INSERT INTO `in-patients`(app_id,item,nature,to_pay,prepared_by,date_added) 
			VALUES (?,?,?,?,?,NOW())");
			$stmt->execute([$aid,$desc,$nat,$fee,$staff]);			
			$stmt = null;
			}
			return "Done";
				
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function insert_mbill($aid,$charge,$staff){
		try {
			$que= $this->db->prepare("SELECT amount FROM morgue_charges WHERE id = ?");
			$que->execute([$charge]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$amt = $row->amount;

			$que = NULL;

			$stmt = $this->db->prepare("INSERT INTO `morgue_bills`(corpse_id,charge,amount,addedby,date_added) 
			VALUES (?,?,?,?,NOW())");
			$stmt->execute([$aid,$charge,$amt,$staff]);			
			$stmt = null;
			return "Done";
				
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}


	//For Company registration
	public function insert_company($name,$addr,$phone,$email,$branch,$staff_no){
		try {
		$stmt = $this->db->prepare("INSERT INTO companies(company_name,company_addr,company_pn,email,branch,staff_no,date_added) 
		VALUES (?,?,?,?,?,?,NOW())");
		$stmt->execute([$name,$addr,$phone,$email,$branch,$staff_no]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	//For Company editing
	public function edit_company($name,$addr,$phone,$email,$branch,$staff_no,$val){
		try {
		$stmt = $this->db->prepare("UPDATE companies SET company_name = ?,company_addr = ?,company_pn = ?,email = ?,branch = ?,staff_no = ?,date_added = NOW() WHERE id = ?");
		$stmt->execute([$name,$addr,$phone,$email,$branch,$staff_no,$val]);
		
		$stmt = null;
		return "<div class='alert alert-success'> Company Updated Successfully!</div>";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function edit_staff($first_name, $last_name,$other_names,$address,$phone,$dob,$pob,$sex,$mstatus,$nok,$pnok,$state,$lga,$doe,$salary,$noc,$child1,$child2,$child3,$child4,$weight,$img, $username, $role, $hash, $position,$ward,$val){		
		try {
			$stmt = $this->db->prepare("UPDATE staff SET first_name = ?, last_name =?, other_names =?,contact_address=?,phone_number=?,dob=?,pob=?,sex=?,mstatus=?,nok=?,phone_nok=?,state=?,lga=?,date_of_emp=?,starting_salary=?,no_of_children=?,child1=?,child2=?,child3=?,child4=?,weight=?,staff_img=?, username = ?, role_id=?, password=?, position=?,ward_id=? WHERE user_id = ?");
			$stmt->execute([$first_name, $last_name,$other_names,$address,$phone,$dob,$pob,$sex,$mstatus,$nok,$pnok,$state,$lga,$doe,$salary,$noc,$child1,$child2,$child3,$child4,$weight,$img, $username, $role, $hash, $position,$ward,$val]);
			$stmt = null;
			return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	//user login
	public function check_pass($username,$password){	
		if(Empty($username)){
			$sign = 'emptyUsername';
			$loc = '';
			echo json_encode(array("value" => $sign, "value2" => $loc));
		} else if(Empty($password)){
			$sign = 'emptyPass';
			$loc = '';
			echo json_encode(array("value" => $sign, "value2" => $loc));
		} else{
			$stmt= $this->db->prepare("SELECT username FROM staff WHERE username = ? LIMIT 1");
			$stmt->execute([$username]);
			$arr = $stmt->fetchAll();
			if(!$arr){
				$sign = 'no';
				$loc = '';
				echo json_encode(array("value" => $sign, "value2" => $loc));
			} else{
				$stmt= $this->db->prepare("SELECT user_id, username, password, role_id,ward_id FROM staff WHERE username = ? LIMIT 1");
				$stmt->execute([$username]);
				$row=$stmt->fetch(PDO::FETCH_OBJ);
				$realusername = $row->username;
				$realpassword = $row->password;
				$user_id = $row->user_id;
				$role_id = $row->role_id;
				$ward = $row->ward_id;
		
				if(password_verify($password, $realpassword)){
					//add value for loggedin user
					$logged_in = 1;
							
					$stmt2 = $this->db->prepare("UPDATE staff SET logged_in = ? WHERE username = ? ")->execute([$logged_in, $username]);
					$stmt2 = null;
							
					$sign = 'Login';
					$page_id = '';
					$loc='';
					session_start();
					$_SESSION['userSession'] = $user_id;

					//lets get the role and the page to open on login

					if($role_id == 2 || $role_id == 17){
						$page = "module1/appointment.php";
					} else if($role_id == 18){
						$page = "module5/index.php";
					} else if($role_id == 3){
						$page = "module3/index.php";
					} else if($role_id == 5){
						$page = "module7/index.php";
					} else if($role_id == 4){
						$page = "module4/prescriptions.php";
					} else if($role_id == 6){
						$page = "module5/index.php";
					} else if($role_id == 1){
						$page = "module0/dashboard.php";
					} else if($role_id == 7 AND $ward == 0){
						$page = "module8/vitals.php";
					} else if($role_id == 7 AND $ward == 1){
						$page = "module8_1/vitals.php";
					}else if($role_id == 7 AND $ward == 2){
						$page = "module8_2/vitals.php";
					}else if($role_id == 7 AND $ward == 3){
						$page = "module8_3/vitals.php";
					}else if($role_id == 7 AND $ward == 4){
						$page = "module8_4/vitals.php";
					} else if($role_id == 8){
						$page = "module9/appointment.php";
					} else if($role_id == 9){
						$page = "module12/index.php";
					} else if($role_id == 11){
						$page = "module13/index.php";
					} else if($role_id == 12){
						$page = "module14/index.php";
					} else if($role_id == 13){
						$page = "module2/index.php";
					} else if($role_id == 14){
						$page = "module7/index.php";
					} else if($role_id == 15){
						$page = "module6/approvals.php";
					} else if($role_id == 16){
						$page = "module6/prescriptions.php";
					} else if($role_id == 19){
						$page = "module13/index.php";
					} else if($role_id == 20){
						$page = "module19/scans.php";
					} else if($role_id == 21){
						$page = "module16/pos.php";
					} else if($role_id == 22){
						$page = "module22/index.php";
					} else if($role_id == 23){
						$page = "module15/index.php";
					}

					echo json_encode(array("value" => $sign, "value2" => $loc, "value3" => $user_id, "page" => $page));
				} else {
					$result = "<div class='alert alert-danger'>Please enter correct password</div>";
					$sign = 'false';
					echo json_encode(array("value" => $sign, "value2" => $result, "value3" => $user_id));
				} 
	
			}
			$stmt = null;
		}	
	}
	
	//update db fro when a user logs
	public function logout_user($user_id){
		try{
			$logout = 0;
			$stmt = $this->db->prepare("UPDATE staff SET logged_in = ? WHERE user_id = ?")->execute([$logout, $user_id]);
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	//update db fro when a user logs
	public function notify_viewed($id){
		$stmt = $this->db->prepare("UPDATE notifications SET status = 1,strikes = 1  WHERE id = ?")->
		execute([$id]);
		$stmt = null;
	}


	//notification strikes
	public function strikes($id){
		try{
			$que= $this->db->prepare("SELECT * FROM notifications WHERE id = ?");
			$que->execute([$id]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$strike = $row->strikes;
			$timer = $row->time_taken;

			if ($strike <= 3) {
				$new_time = date("Y-m-d H:i:s", strtotime($timer)+1800);
				$new_strike = $strike +1;
			}
			
			$que = null;

			$stmt = $this->db->prepare("UPDATE notifications SET strikes = ?,timer_notify = ? WHERE id = ?")->execute([$new_strike,$new_time,$id]);
			$stmt = null;
			return "Done";
		}catch(PDOException $e){
			echo "Error: ". $e->getMessage();
		}
	}

	

	//update db fro when a user logs output_add_rewrite_var
	public function logout($admin_id){
		try{
			unset($_SESSION['admin_id']);
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	//insert patient
	public function insert_patient($first,$surname, $m_name, $title, $reg_num, $sex, $blood, $address, $city, $state
	, $religion, $ethnic, $nationality, $natid, $insurance, $nhis, $enr, $age, $ageType, $dob, $tel1, $tel2, $mobile, $email, $ntel, $nadd, $pre, $photo, $card_type,$company,$family,$nname,$relationship){
		try {
			$front = uniqid();
			if (!empty($card_type) AND $card_type == 11) {
				$comp = $company;
			}else{
				$comp = 0;
			}
		$stmt = $this->db->prepare("INSERT INTO patients(front_desk,first_name,surname,middle_name,title, reg_num, sex, blood_group, address, city, state, religion, ethnic, nationality
		, national_id, insurance_type_id, nhis_num, enrollee_num, contact_method_id, age, age_type, dob, tel_one, tel_two, mobile, email, next_kin_phone, next_kin_address, photo, card_type,company_id,family_id,name_of_kin,rel_of_kin) 
		VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$stmt->execute([$front,$first,$surname, $m_name, $title, $reg_num, $sex, $blood, $address, $city, $state, $religion, $ethnic, $nationality, $natid, $insurance, $nhis, $enr, $pre, 
		$age, $ageType, $dob, $tel1, $tel2, $mobile, $email, $ntel, $nadd, $photo, $card_type,$comp,$family,$nname,$relationship]);
		$stmt = null;
		
		//get id
		$last = $this->db->lastInsertId();
		//lets now pay for card
		$pay = 1;
		$stmt = $this->db->prepare("UPDATE patients SET card_pay = ? WHERE id = ?")->execute([$pay, $last]);
		$stmt = null;
		
		//send to accounts
		$test = 5;
		$app_id = 0;
		
		$que= $this->db->prepare("SELECT * FROM card_types WHERE id = ?");
		$que->execute([$card_type]);
		$row = $que->fetch(PDO::FETCH_OBJ);
		$cost = $row->cost;
		
		$que = null;

		$que= $this->db->prepare("SELECT front_desk FROM patients WHERE id = ?");
		$que->execute([$last]);
		$row = $que->fetch(PDO::FETCH_OBJ);
		$front2 = $row->front_desk;
		
		$que = null;
		
		$code = rand(1000,100000);
		$date = date("Y-m-d");

		if ($card_type == 14) {
			$stmt = $this->db->prepare("INSERT INTO accounts(front_desk,item, patient_id, card_type, app_id, to_pay, order_id, date_added,amount,payment_status) 
		VALUES (?,?,?,?,?,?,?,?,0,0)");
		$stmt->execute([$front2,$test, $last, $card_type, $app_id, $cost, $code, $date]);
		}elseif($card_type == 11){
			$stmt = $this->db->prepare("INSERT INTO accounts(front_desk,item, patient_id, card_type, app_id, to_pay,amount,payment_status, order_id, date_added,company_id) 
		VALUES (?,?,?,?,?,?,0,1,?,?,?)");
		$stmt->execute([$front2,$test, $last, $card_type, $app_id, $cost, $code, $date,$company]);
		}elseif ($card_type == 27) {
			$stmt = $this->db->prepare("INSERT INTO accounts(front_desk,item, patient_id, card_type, app_id, to_pay, order_id, date_added,amount,payment_status) 
		VALUES (?,?,?,?,?,?,?,?,0,1)");
		$stmt->execute([$front2,$test, $last, $card_type, $app_id, $cost, $code, $date]);
		}else{			
			$stmt = $this->db->prepare("INSERT INTO accounts(front_desk,item, patient_id, card_type, app_id, to_pay, order_id, date_added) 
		VALUES (?,?,?,?,?,?,?,?)");
		$stmt->execute([$front2,$test, $last, $card_type, $app_id, $cost, $code, $date]);
		}
		
		$stmt = null;
		
		return "yesi";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

public function insert_aepatient($first,$surname, $m_name, $title, $sex, $age, $ageType, $dob){
		try {
			$front = uniqid();
			$reg = "A".date("is");
			if (!empty($card_type) AND $card_type == 11) {
				$comp = $company;
			}else{
				$comp = 0;
			}
		$stmt = $this->db->prepare("INSERT INTO patients(a_and_e,first_name,surname,middle_name,title, sex,age, age_type, dob,reg_num) 
		VALUES (?,?,?,?,?,?,?,?,?,?)");
		$stmt->execute([$front,$first,$surname, $m_name, $title, $sex, $age, $ageType, $dob,$reg]);
		$stmt = null;
		
		//get id
		$last = $this->db->lastInsertId();
		
		//send to accounts
		$test = 5;
		$app_id = 0;
		
		$que= $this->db->prepare("SELECT * FROM card_types WHERE id = 31");
		$que->execute();
		$row = $que->fetch(PDO::FETCH_OBJ);
		$cost = $row->cost;
		$card_type = 31;
		
		$que = null;
		
		$que = null;
		
		$code = rand(1000,100000);
		$date = date("Y-m-d");
		
		$stmt = $this->db->prepare("INSERT INTO accounts(front_desk,item, patient_id, card_type, app_id, to_pay, order_id, date_added) 
		VALUES (?,?,?,?,?,?,?,?)");
		$stmt->execute([$front,$test, $last, $card_type, $app_id, $cost, $code, $date]);
		
		$stmt = null;
		
		return "yesi";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function insert_case_d($diagnosis,$pharm, $tabs,$dosage,$duration,$quantity,$instruction,$custom_price, $doc_id, $id, $p_id,$stabs,$squantity,$sdosage,$sduration,$c){		
		try {
			
			$status = 0;
			$type = 1;
			$ref = rand(1000,100000);
			$que= $this->db->prepare("SELECT * FROM patients WHERE id = ?");
			$que->execute([$p_id]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$front = $row->front_desk;
			$comp = $row->company_id;
			$tariff = $row->tariff;

			if (empty($stabs)) {
				$stabs = "";
			}

			if (empty($squantity)) {
				$squantity = "";
			}

			if (empty($sdosage)) {
				$sdosage = "";
			}

			if (empty($sduration)) {
				$sduration = "";
			}
			$tp =0;
			for($i = intval($c)-1;$i >= 0;$i--) {
				$stmt = $this->db->prepare("INSERT INTO prescription(company_id,front_desk,reference,diagnosis,pharm_stock_id, tabs,dosage, duration, quantity_dispense,stabs,sdosage, sduration, squantity_dispense,instruction,doctor_id,appointment_id,patient_id) 
			VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
			$stmt->execute([$comp,$front,$ref,$diagnosis,$pharm[$i], $tabs[$i],$dosage[$i], $duration[$i], $quantity[$i],$stabs[$i],$sdosage[$i], $sduration[$i], $squantity[$i], $instruction[$i], $doc_id, $id, $p_id]);
			$stmt = null;
			$val = $this->db->lastInsertId();
			
			$stmt2 = $this->db->prepare("UPDATE patient_appointment SET diagnosis = ?, treated = ? WHERE id = ?" );
			$stmt2->execute([$diagnosis,$type,$id]);
			$stmt2 = null;
			
			$pharm_stock_id = $pharm[$i];
			$que= $this->db->prepare("SELECT * FROM prescription WHERE prescription_id = ?");
			$que->execute([$val]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$p_id = $row->patient_id;
			$app_id = $row->appointment_id;
			$que = null;

			if ($tariff > 0) {
					$tariff_name = $this->get_name_from_id('name','tariffs','id',$tariff);
					$tariff_name = strtolower($tariff_name);
					$tariff_name = str_replace(" ", "_", $tariff_name);

					$que= $this->db->prepare("SELECT * FROM pharm_stock WHERE id = ?");
					$que->execute([$pharm[$i]]);
					$row = $que->fetch(PDO::FETCH_OBJ);
					$price = $row->$tariff_name;
					$que = null;
				}else{
					$que= $this->db->prepare("SELECT * FROM pharm_stock WHERE id = ?");
					$que->execute([$pharm[$i]]);
					$row = $que->fetch(PDO::FETCH_OBJ);
					$price = $row->price;
					$que = null;
				}	
			

			//lets do the maths
			if ($custom_price[$i] > 0) {
				$priceToPay1 = $custom_price[$i];
				$tp += $priceToPay1;
			}else{
					if ($quantity[$i] > 0) {
						$priceToPay1 = $quantity[$i] * $price;
						$tp+=$priceToPay1;
					}

					if ($squantity[$i] > 0) {
						$priceToPay1 = $squantity[$i] * $price;
						$tp+=$priceToPay1;
					}
			}
			
					
			//get card_type
			$que= $this->db->prepare("SELECT * FROM patients WHERE id = ?");
			$que->execute([$p_id]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$card_type = $row->card_type;			
			$front2 = $row->front_desk;
			$que = null;
					
			$type = 3;
			
			$stmt2 = $this->db->prepare("INSERT INTO payment(company_id,front_desk,reference,patient_id,appointment_id,payment_type_id,amount,pdate_added) 
			VALUES (?,?,?,?,?,?,?,NOW())");
			$stmt2->execute([$comp,$front2,$ref,$p_id,$app_id,$type,$priceToPay1]);
			$stmt2 = null;
			}// end of for loop
			
			$name = 3;					
			$date = date("Y-m-d");
			$stmt = $this->db->prepare("INSERT INTO accounts(company_id,front_desk,item, patient_id, app_id,  to_pay, order_id, date_added, card_type) 
			VALUES (?,?,?,?,?,?,?,?,?)");
			$stmt->execute([$comp,$front2,$name, $p_id, $app_id, $tp, $ref, $date, $card_type]);

			$this->notify('pharm',$p_id,'Prescription Made For: ','presc.php?pid=".$p_id."&');
			return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Prescription could not be added
				  </div>: ' . $e->getMessage();
		}
	}

	public function insert_case_d1($diagnosis,$pharm, $tabs,$dosage,$duration,$quantity,$instruction,$custom_price, $doc_id, $id, $p_id,$stabs,$squantity,$sdosage,$sduration,$c){		
		try {
			
			$status = 0;
			$type = 1;
			$ref = rand(1000,100000);
			$que= $this->db->prepare("SELECT * FROM patients WHERE id = ?");
			$que->execute([$p_id]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$front = $row->front_desk;
			$comp = $row->company_id;
			$tariff = $row->tariff;

			if (empty($stabs)) {
				$stabs = "";
			}

			if (empty($squantity)) {
				$squantity = "";
			}

			if (empty($sdosage)) {
				$sdosage = "";
			}

			if (empty($sduration)) {
				$sduration = "";
			}
			$tp =0;
			for($i = intval($c)-1;$i >= 0;$i--) {
				$stmt = $this->db->prepare("INSERT INTO prescription(company_id,front_desk,reference,diagnosis,pharm_stock_id, tabs,dosage, duration, quantity_dispense,stabs,sdosage, sduration, squantity_dispense,instruction,doctor_id,appointment_id,patient_id) 
			VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
			$stmt->execute([$comp,$front,$ref,$diagnosis,$pharm[$i], $tabs[$i],$dosage[$i], $duration[$i], $quantity[$i],$stabs[$i],$sdosage[$i], $sduration[$i], $squantity[$i], $instruction[$i], $doc_id, $id, $p_id]);
			$stmt = null;
			$val = $this->db->lastInsertId();
			
			$stmt2 = $this->db->prepare("UPDATE patient_appointment SET diagnosis = ?, treated = ? WHERE id = ?" );
			$stmt2->execute([$diagnosis,$type,$id]);
			$stmt2 = null;
			
			$pharm_stock_id = $pharm[$i];
			$que= $this->db->prepare("SELECT * FROM prescription WHERE prescription_id = ?");
			$que->execute([$val]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$p_id = $row->patient_id;
			$app_id = $row->appointment_id;
			$que = null;

			if ($tariff > 0) {
					$tariff_name = $this->get_name_from_id('name','tariffs','id',$tariff);
					$tariff_name = strtolower($tariff_name);
					$tariff_name = str_replace(" ", "_", $tariff_name);

					$que= $this->db->prepare("SELECT * FROM pharm_stock WHERE id = ?");
					$que->execute([$pharm[$i]]);
					$row = $que->fetch(PDO::FETCH_OBJ);
					$price = $row->$tariff_name;
					$que = null;
				}else{
					$que= $this->db->prepare("SELECT * FROM pharm_stock WHERE id = ?");
					$que->execute([$pharm[$i]]);
					$row = $que->fetch(PDO::FETCH_OBJ);
					$price = $row->price;
					$que = null;
				}	
			

			//lets do the maths
			if ($custom_price[$i] > 0) {
				$priceToPay1 = $custom_price[$i];
				$tp += $priceToPay1;
			}else{
					if ($quantity[$i] > 0) {
						$priceToPay1 = $quantity[$i] * $price;
						$tp+=$priceToPay1;
					}

					if ($squantity[$i] > 0) {
						$priceToPay1 = $squantity[$i] * $price;
						$tp+=$priceToPay1;
					}
			}
			
					
			//get card_type
			$que= $this->db->prepare("SELECT * FROM patients WHERE id = ?");
			$que->execute([$p_id]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$card_type = $row->card_type;			
			$front2 = $row->front_desk;
			$que = null;
					
			$type = 3;
			
			$stmt2 = $this->db->prepare("INSERT INTO payment(company_id,front_desk,reference,patient_id,appointment_id,payment_type_id,amount,pdate_added) 
			VALUES (?,?,?,?,?,?,?,NOW())");
			$stmt2->execute([$comp,$front2,$ref,$p_id,$app_id,$type,$priceToPay1]);
			$stmt2 = null;
			}// end of for loop
			
			$name = 3;					
			$date = date("Y-m-d");
			$stmt = $this->db->prepare("INSERT INTO accounts(company_id,front_desk,item, patient_id, app_id,  to_pay, order_id, date_added, card_type) 
			VALUES (?,?,?,?,?,?,?,?,?)");
			$stmt->execute([$comp,$front2,$name, $p_id, $app_id, $tp, $ref, $date, $card_type]);
			$stmt = null;

			$this->notify('pharm',$p_id,'Prescription Made For: ','presc.php?pid=".$id."&');
			return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Prescription could not be added
				  </div>: ' . $e->getMessage();
		}
	}

	public function insert_case_d2($diagnosis,$pharm, $tabs,$dosage,$duration,$quantity,$instruction,$custom_price, $doc_id, $id, $p_id,$stabs,$squantity,$sdosage,$sduration,$c){		
		try {
			$this->db->beginTransaction();
			$status = 0;
			$type = 1;
			$ref = rand(1000,100000);
			$que= $this->db->prepare("SELECT * FROM patients WHERE id = ?");
			$que->execute([$p_id]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$front = $row->front_desk;
			$comp = $row->company_id;

			if (empty($stabs)) {
				$stabs = "";
			}

			if (empty($squantity)) {
				$squantity = "";
			}

			if (empty($sdosage)) {
				$sdosage = "";
			}

			if (empty($sduration)) {
				$sduration = "";
			}
			$tp =0;
			for($i = intval($c)-1;$i >= 0;$i--) {
				$stmt = $this->db->prepare("INSERT INTO prescription(company_id,front_desk,reference,diagnosis,pharm_stock_id, tabs,dosage, duration, quantity_dispense,stabs,sdosage, sduration, squantity_dispense,instruction,doctor_id,appointment_id,patient_id) 
			VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
			$stmt->execute([$comp,$front,$ref,$diagnosis,$pharm[$i], $tabs[$i],$dosage[$i], $duration[$i], $quantity[$i],$stabs[$i],$sdosage[$i], $sduration[$i], $squantity[$i], $instruction[$i], $doc_id, $id, $p_id]);
			$stmt = null;
			$val = $this->db->lastInsertId();
			
			$stmt2 = $this->db->prepare("UPDATE patient_appointment SET diagnosis = ?, treated = ? WHERE id = ?" );
			$stmt2->execute([$diagnosis,$type,$id]);
			$stmt2 = null;
			
			$pharm_stock_id = $pharm[$i];
			$que= $this->db->prepare("SELECT * FROM prescription WHERE prescription_id = ?");
			$que->execute([$val]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$p_id = $row->patient_id;
			$app_id = $row->appointment_id;
			$que = null;


			
			$que= $this->db->prepare("SELECT * FROM pharm_stock WHERE id = ?");
			$que->execute([$pharm[$i]]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$price = $row->price;
			$que = null;	
			

			//lets do the maths
			if ($custom_price[$i] > 0) {
				$priceToPay1 = $squantity[$i]*$custom_price[$i];
				$tp += $priceToPay1;
			}else{
					if ($quantity[$i] > 0) {
						$priceToPay1 = $quantity[$i] * $price;
						$tp+=$priceToPay1;
					}

					if ($squantity[$i] > 0) {
						$priceToPay1 = $squantity[$i] * $price;
						$tp+=$priceToPay1;
					}
			}
					
			//get card_type
			$que= $this->db->prepare("SELECT * FROM patients WHERE id = ?");
			$que->execute([$p_id]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$card_type = $row->card_type;			
			$front2 = $row->front_desk;
			$que = null;
					
			$type = 3;
			}// end of for loop
			
			$que22 = $this->db->prepare("INSERT INTO `in-patients`(`app_id`,`item`,`nature`,`to_pay`,`prepared_by`,`date_added`) VALUES(?,'Drugs',2,?,?,NOW())");
			$que22->execute([$app_id,"-".$tp,$doc_id]);
			$this->db->commit();			
			$que22 = null;

			$this->notify('pharm',$p_id,'Prescription Made For: ','presc.php?pid='.$id.'&');
			return "Done";
			
		
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Prescription could not be added
				  </div>: ' . $e->getMessage();
		}
	}


	public function insert_case_inj2($diagnosis,$pharm, $tabs,$dosage,$duration,$quantity,$instruction, $doc_id, $id, $p_id,$stabs,$squantity,$sdosage,$sduration,$c){		
		try {
			
			$status = 0;
			$type = 1;
			$ref = rand(1000,100000);
			$que= $this->db->prepare("SELECT * FROM patients WHERE id = ?");
			$que->execute([$p_id]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$front = $row->front_desk;
			$comp = $row->company_id;

			if (empty($stabs)) {
				$stabs = "";
			}

			if (empty($squantity)) {
				$squantity = "";
			}

			if (empty($sdosage)) {
				$sdosage = "";
			}

			if (empty($sduration)) {
				$sduration = "";
			}

			for($i = intval($c)-1;$i >= 0;$i--) {
				$stmt = $this->db->prepare("INSERT INTO prescription1(company_id,front_desk,reference,diagnosis,pharm_stock_id, tabs,dosage, duration, quantity_dispense,stabs,sdosage, sduration, squantity_dispense,instruction,doctor_id,appointment_id,patient_id,status) 
			VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
			$stmt->execute([$comp,$front,$ref,$diagnosis,$pharm[$i], $tabs[$i],$dosage[$i], $duration[$i], $quantity[$i],$stabs[$i],$sdosage[$i], $sduration[$i], $squantity[$i], $instruction[$i], $doc_id, $id, $p_id, $squantity[$i]]);
			$stmt = null;
			$val = $this->db->lastInsertId();

			$pharm_stock_id = $pharm[$i];
			$que= $this->db->prepare("SELECT * FROM prescription1 WHERE prescription_id = ?");
			$que->execute([$val]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$p_id = $row->patient_id;
			$app_id = $row->appointment_id;
			$que = null;
			
			$que= $this->db->prepare("SELECT * FROM pharm_stock WHERE id = ?");
			$que->execute([$pharm[$i]]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$price = $row->price;
			$que = null;	
			

			//lets do the maths
			if ($quantity[$i] > 0) {
				$priceToPay1 = $quantity[$i] * $price;
			}

			if ($squantity[$i] > 0) {
				$priceToPay1 = $squantity[$i] * $price;
			}
					
			//get card_type
			$que= $this->db->prepare("SELECT * FROM patients WHERE id = ?");
			$que->execute([$p_id]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$card_type = $row->card_type;			
			$front2 = $row->front_desk;
			$que = null;
			}

		
			$this->notify('nurses',$p_id,'Injection Request Made For: ','exam_request?');

			header("Refresh:1; Location: ../module4/prescriptions");



			return "Done";
			
		
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Prescription could not be added
				  </div>: ' . $e->getMessage();
		}
	}

public function insert_antenatal($surname,$first_name,$hosp_num,$instruction,$address,$preg_duration,$age,$marriage_age,$lmp,$tribe,$occupation,$edd,$added_by){
		try {
		$stmt = $this->db->prepare("INSERT INTO antenatal1(surname,first_name,hospital_number,instructions,address,preg_duration,age,marriage_age,lmp,tribe,occupation,edd,added_by,date_added) 
		VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())");
		$stmt->execute([$surname,$first_name,$hosp_num,$instruction,$address,$preg_duration,$age,$marriage_age,$lmp,$tribe,$occupation,$edd,$added_by]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function edit_antenatal($surname,$first_name,$hosp_num,$instruction,$address,$preg_duration,$age,$marriage_age,$lmp,$tribe,$occupation,$edd,$val){
		try {
		$stmt = $this->db->prepare("UPDATE antenatal1 SET surname = ?,first_name =?,hospital_number = ?,instructions = ?,address = ?,preg_duration = ?,age = ?,marriage_age = ?,lmp = ?,tribe = ?,occupation = ?,edd = ? WHERE id = ?");
		$stmt->execute([$surname,$first_name,$hosp_num,$instruction,$address,$preg_duration,$age,$marriage_age,$lmp,$tribe,$occupation,$edd,$val]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function edit_antenatal_N($hypertension,$chest,$anaemia,$heart,$kidney,$blood,$git,$diabetes,$operation,$adm,$g,$p1,$f,$p2,$a,$l,$staff,$val){
		try {
		$stmt = $this->db->prepare("UPDATE antenatal1 SET hypertension = ?,chest =?,anaemia = ?,heart = ?,kidney = ?,blood = ?,git = ?,diabetes = ?,operation = ?,admission = ?,G = ?,P1 = ?,F = ?,P2 = ?,A = ?,L = ?,nurse = ?  WHERE id = ?");
		$stmt->execute([$hypertension,$chest,$anaemia,$heart,$kidney,$blood,$git,$diabetes,$operation,$adm,$g,$p1,$f,$p2,$a,$l,$staff,$val]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	

	public function insert_case_drug($pharm, $type,$doc_id, $id, $p_id,$p){		
		try {
				$stmt = $this->db->prepare("INSERT INTO temp_presc(drug,type,patient,doc,app_id,date_added,pid) 
			VALUES (?,?,?,?,?,NOW(),?)");
			$stmt->execute([$pharm, $type,$p_id,$doc_id, $id,$p]);
			$stmt = null;
			return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Drug could not be added
				  </div>: ' . $e->getMessage();
		}
	}

	public function insert_case_drug1($pharm, $type,$doc_id, $id, $p_id,$p){		
		try {
				$stmt = $this->db->prepare("INSERT INTO temp_presct(drug,type,patient,doc,app_id,date_added,pid) 
			VALUES (?,?,?,?,?,NOW(),?)");
			$stmt->execute([$pharm, $type,$p_id,$doc_id, $id,$p]);
			$stmt = null;

			$stmt = $this->db->prepare("UPDATE treatments SET reference = ? WHERE id = ?");
			$stmt->execute([$p,$id]);
			$stmt = null;
			return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Drug could not be added
				  </div>: ' . $e->getMessage();
		}
	}

	public function insert_case_test($pharm,$doc_id, $id, $p_id,$p){		
		try {
				$stmt = $this->db->prepare("INSERT INTO temp_test(lab_test_id,patient_id,doc,app_id,date_added,pid) 
			VALUES (?,?,?,?,NOW(),?)");
			$stmt->execute([$pharm, $p_id,$doc_id, $id,$p]);
			$stmt = null;
			return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 test could not be added
				  </div>: ' . $e->getMessage();
		}
	}

	public function insert_case_inj($pharm,$doc_id, $id, $p_id,$p){		
		try {
				$stmt = $this->db->prepare("INSERT INTO temp_presc1(drug,patient,doc,app_id,date_added,pid) 
			VALUES (?,?,?,?,NOW(),?)");
			$stmt->execute([$pharm,$p_id,$doc_id, $id,$p]);
			$stmt = null;
			return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Injection could not be added
				  </div>: ' . $e->getMessage();
		}
	}

	public function edit_patient($first,$surname, $m_name, $title, $reg_num, $sex, $blood, $address, $city, $state, $religion, $ethnic, $nationality, $natid, $insurance, $nhis, 
								$enr, $age, $ageType, $dob, $tel1, $tel2, $mobile, $email, $ntel, $nadd, $pre, $photo,$oldfile, $card_type,$company,$family, $val){
		try {
			$stmt = $this->db->prepare("UPDATE patients SET first_name = ?, surname = ?,middle_name=?,title=?, reg_num=?, sex=?, blood_group=?, address=?, city=?, state=?
			, religion=?, ethnic=?,  nationality=?, national_id= ?, insurance_type_id= ?, nhis_num= ?, enrollee_num= ?, contact_method_id= ?, age=?, age_type=?, dob=?, tel_one=?, 
			tel_two=?, mobile=?, email=?, next_kin_phone= ?, next_kin_address= ?, photo= ?, card_type=?, company_id =?,family_id = ? WHERE id = ?");
			$stmt->execute([$first,$surname, $m_name, $title, $reg_num, $sex, $blood, $address, $city, $state, $religion, $ethnic, $nationality, $natid, $insurance, $nhis, $enr, $pre, 
			$age, $ageType, $dob, $tel1, $tel2, $mobile, $email, $ntel, $nadd, $photo, $card_type,$company,$family,$val]);
			$stmt = null;
			if($oldfile != "none"){
				$success = 'yesi';
				unlink('../photo/'.$oldfile);
			}
			return "yesi";
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Patient details could not be updated
				  </div>: ' . $e->getMessage();
		}
	}

	//For user registration
	public function insert_doc($name, $phone){
		try {
		$stmt = $this->db->prepare("INSERT INTO doctors(name,phone) 
		VALUES (?,?)");
		$stmt->execute([$name, $phone]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	//For donation
	public function insert_donation($pint,$type,$val,$doc){
		try {
		$stmt = $this->db->prepare("INSERT INTO donations(pints,type,donor_id,date_added,added_by) 
		VALUES (?,?,?,NOW(),?)");
		$stmt->execute([$pint,$type,$val,$doc]); 
		$stmt = null;
		$last = $this->db->lastInsertId();

		$stmt = $this->db->prepare("UPDATE donors SET status = 1 WHERE donor_id= ?");
		$stmt->execute([$val]);
		$stmt = NULL;

		$que= $this->db->prepare("SELECT quantity FROM blood_stock WHERE sample_id = ?");
		$que->execute([$type]);
		$row = $que->fetch(PDO::FETCH_OBJ);
		$qty = $row->quantity;
		$quantity = $qty +$pint;
		$que= NULL;

		$stmt = $this->db->prepare("UPDATE blood_stock SET quantity = ? WHERE sample_id= ?");
		$stmt->execute([$quantity,$type]);
		$stmt = NULL;

		$tests = array(3,23,45,48,49,50,64);
		$link = uniqid();

		$stmt = $this->db->prepare("INSERT INTO blood_test_group(a_and_e,donor_id,link_ref,test_num)  
			VALUES (?,?,?,7)");
		$stmt->execute([$last,$val,$link]);
		$stmt = NULL;

		$stmt = $this->db->prepare("UPDATE donations SET lab_ref = ? WHERE id= ?");
		$stmt->execute([$link,$last]);
		$stmt = NULL;

		foreach ($tests as $test) {
			$type = $this->get_name_from_id('lab_test_type_id','lab_test',"lab_test_id",$test);
			$stmt = $this->db->prepare("INSERT INTO blood_test(donor_id,link_ref,lab_test_id,lab_test_type_id,date_added,added_by)
			VALUES (?,?,?,?,NOW(),?)");
			$stmt->execute([$val,$link,$test,$type,$doc]);
			$stmt = NULL;
		}
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	//For donation
	public function edit_donation($pint, $type,$val,$doc,$id){
		try {

		$que= $this->db->prepare("SELECT pints FROM donations WHERE id = ?");
		$que->execute([$id]);
		$row = $que->fetch(PDO::FETCH_OBJ);
		$qty2 = $row->pints;
		$que= NULL;

		$que= $this->db->prepare("SELECT quantity FROM blood_stock WHERE sample_id = ?");
		$que->execute([$type]);
		$row = $que->fetch(PDO::FETCH_OBJ);
		$qty = $row->quantity;
		$quantity = $qty - $qty2;
		$que= NULL;

		$stmt = $this->db->prepare("UPDATE donations SET pints =?,type =?,donor_id = ?,date_updated = NOW(),updated_by = ? WHERE id =?");
		$stmt->execute([$pint, $type,$val,$doc,$id]);
		
		$stmt = null;

		$quantity += $pint;
		$stmt = $this->db->prepare("UPDATE blood_stock SET quantity = ? WHERE sample_id =?");
		$stmt->execute([$quantity,$type]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function edit_doc($name, $phone, $val){		
		try {
			$stmt = $this->db->prepare("UPDATE doctors SET name = ?,phone=? WHERE id = ?");
			$stmt->execute([$name, $phone,$val]);
			$stmt = null;
			$success = '<div class="alert alert-success">
							Doctor details updated
						</div>';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Doctor details could not be updated
				  </div>: ' . $e->getMessage();
		}
	}

	public function insert_schedule($doctor, $dayofweek, $timein, $timeout, $dateday){
		try {
		$stmt = $this->db->prepare("INSERT INTO doctor_schedule(doctor_id,day_of_week,time_in, time_out, day_date) 
		VALUES (?,?,?,?,?)");
		$stmt->execute([$doctor, $dayofweek, $timein, $timeout, $dateday]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function insert_abo($result,$observation,$staff,$val){
		try {
		$stmt = $this->db->prepare("UPDATE donations SET abo_result = ?, abo_observation = ?, abo_added_by = ?, abo_date_added = NOW() WHERE id =?");
		$stmt->execute([$result,$observation,$staff,$val]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function insert_rhd($result,$observation,$staff,$val){
		try {
		$stmt = $this->db->prepare("UPDATE donations SET rhd_result = ?, rhd_observation = ?, rhd_added_by = ?, rhd_date_added = NOW() WHERE id =?");
		$stmt->execute([$result,$observation,$staff,$val]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function insert_serum($result,$observation,$staff,$val){
		try {
		$stmt = $this->db->prepare("UPDATE donations SET serum_result = ?, serum_observation = ?, serum_added_by = ?, serum_date_added = NOW() WHERE id =?");
		$stmt->execute([$result,$observation,$staff,$val]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function edit_shce($dayofweek, $timein, $timeout, $dateday, $doctor, $val){		
		try {
			$stmt = $this->db->prepare("UPDATE doctor_schedule SET day_of_week=?, time_in=?,time_out=?,day_date=?, doctor_id =? WHERE id = ?");
			$stmt->execute([$dayofweek, $timein, $timeout, $dateday, $doctor, $val]);
			$stmt = null;
			$success = '<div class="alert alert-success">
							Schedule details updated
						</div>';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Schedule details could not be updated
				  </div>: ' . $e->getMessage();
		}
	}
	
	
	public function notify_account($p_id){
		try {
			$que= $this->db->prepare("SELECT id FROM patient_appointment WHERE patient_id = ?");
			$que->execute([$p_id]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$app = $row->id;
			$this->notify('front_desk',$p_id,'Payment Needed For: ','payment_daily.php?');
			$this->notify('account',$p_id,'Payment Needed For: ','payment_daily.php?');
			
			$stmt = null;
			return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}



	public function notify($to, $about,$header,$l){
		try {
			if(is_string($about)){
				$stmt = $this->db->prepare("INSERT INTO notifications (staff_id,visitor, message, status, time_taken) VALUES (?,?,?,'0',NOW())");
				$stmt->execute([$to, $about,$header]);
				$nid = $this->db->lastInsertId();
				$stmt = null;
			}else{
				$stmt = $this->db->prepare("INSERT INTO notifications (staff_id,patient_id, message, status, time_taken) VALUES (?,?,?,'0',NOW())");
				$stmt->execute([$to, $about,$header]);
				$nid = $this->db->lastInsertId();
				$stmt = null;
			}

			$lin = $l."nid=".$nid."&nstat=1";
			$stmt = $this->db->prepare("UPDATE notifications SET link = '$lin' WHERE id = ?");
			$stmt->execute([$nid]);
			$stmt = null;
			return $lin;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function notify2($doctor, $p_id,$app){
		try {
			$dateDay = date("Y-m-d");
			$time = date("h:i");
			$stmt = $this->db->prepare("INSERT INTO notifications (staff_id,patient_id,link, message, status, time_taken) VALUES (".$doctor.", ".$p_id.",'lab_results?id=".$app."&', 'You Have A New Appointment', '0', NOW())");
			$stmt->execute([$doctor, $p_id,$time, $dateDay]);
			
			$stmt = null;
			return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function notify_nurse($nurse, $p_id){
		try {
			$dateDay = date("Y-m-d");
			$time = date("h:i");
			$stmt = $this->db->prepare("INSERT INTO notifications (staff_id,patient_id,link, message, status, time_taken) VALUES (".$nurse.", ".$p_id.",'new_request?', 'You Have An Admission Request For: ', '0', NOW())");
			$stmt->execute([$nurse, $p_id,$time, $dateDay]);
			
			$stmt = null;
			return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function notify_nurse2($val,$nurse, $p_id){
		try {
			$dateDay = date("Y-m-d");
			$time = date("h:i");
			$stmt = $this->db->prepare("INSERT INTO notifications (staff_id,patient_id,link, message, status, time_taken) VALUES ('all_nurses_ad', ".$p_id.",'view_note?view=".$val."&', 'You Have An Admission Request For: ', '0', NOW())");
			$stmt->execute([$val,$nurse, $p_id,$time, $dateDay]);
			
			$stmt = null;
			return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function notify_nurse3($val,$nurse, $p_id){
		try {
			$dateDay = date("Y-m-d");
			$time = date("h:i");
			$stmt = $this->db->prepare("INSERT INTO notifications (staff_id,patient_id,link, message, status, time_taken) VALUES ('all_nurses_ex', ".$p_id.",'view_note?view=".$val."&', 'You Have An Examination Request For: ', '0', NOW())");
			$stmt->execute([$val,$nurse, $p_id,$time, $dateDay]);
			
			$stmt = null;
			return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function notify_xray($val,$doc, $p_id){ 
		try {
			$dateDay = date("Y-m-d");
			$time = date("h:i");
			$stmt = $this->db->prepare("INSERT INTO notifications (staff_id,patient_id,link, message, status, time_taken) VALUES ('all_xray', ".$p_id.",'lab_results?id=".$val."&', 'You Have An Xray Request For: ', '0', NOW())");
			$stmt->execute([$val,$doc, $p_id,$time, $dateDay]);
			
			$stmt = null;
			return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function notify_lab($app){
		try {
			$que= $this->db->prepare("SELECT patient_id FROM patient_appointment WHERE id = $app");
			$que->execute([$app]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$p_id = $row->patient_id;


			$dateDay = date("Y-m-d");
			$time = date("h:i");
			$this->notify('all_lab',$p_id,'Lab Tests Requested For: ','index.php?');
			return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function notify_lab2($pid){
		try {
			$this->notify('all_lab',$pid,'Payment Has Been Made For: ','index?');
						return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}




	public function notify_lab3($pid){
		try {
				$db = mysqli_connect("localhost","root","","noahhms");
					$sql = mysqli_query($db, "SELECT * FROM notifications WHERE patient_id = ".$pid." AND staff_id = 'all_lab' AND message = 'Payment Was Cancelled: ' AND status = 0");
					$num = mysqli_num_rows($sql);
					if ($num  > 1) {
						$dateDay = date("Y-m-d");
						$time = date("h:i");
						$stmt = $this->db->prepare("UPDATE notifications SET staff_id = 'all_lab', patient_id = ".$pid.",status = 0, time_taken = NOW()");
						$stmt->execute([$pid]);
						
						$stmt = null;
						return "Done";
					}else{
							$dateDay = date("Y-m-d");
								$time = date("h:i");
								$stmt = $this->db->prepare("INSERT INTO notifications (staff_id,patient_id,link, message, status, time_taken) VALUES ('all_lab', ".$pid.",'index?', 'Payment Was Cancelled: ', '0', NOW())");
								$stmt->execute([$pid]);
								
								$stmt = null;
								return "Done";
							}
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}


	public function notify_pharm($p_id){
		try {
			$dateDay = date("Y-m-d");
			$time = date("h:i");
			$stmt = $this->db->prepare("INSERT INTO notifications (staff_id,patient_id,link, message, status,time_taken) VALUES ('pharm', ".$p_id.",'presc.php?pid=".$p_id."&', 'Doctor Prescribed Drugs For: ', '0', NOW())");
			$stmt->execute();
			
			$stmt = null;
			return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function insert_app($spec,$doctor, $p_id,$fee,$date){
		try {
			$link = uniqid();
			$dateDay = $date;
			$time = date("H:i:s");
			$que= $this->db->prepare("SELECT * FROM patients WHERE id = ?");
			$que->execute([$p_id]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$front2 = $row->front_desk;
			$name = $row->title." ".$row->surname." ".$row->middle_name." ".$row->first_name;
			$sex = $row->sex;
			$age = $row->age;
			$card_type = $row->card_type;
			$company = $row->company_id;
			if (!empty($company) AND $company != 0) {
					$comp = $company;
				}else{
					$comp = 0;
				}	
			$que = null;
			$stmt = $this->db->prepare("INSERT INTO patient_appointment(front_desk,specialty,doctor_id,patient_id,time_added, date_added) 
			VALUES (?,?,?,?,NOW(),?)");
			$stmt->execute([$front2,$spec,$doctor, $p_id, $dateDay]);
			
			$stmt = null;

			$app_id = $this->db->lastInsertId();
				
			$code = rand(1000,100000);
			$date = date("Y-m-d");
			$test = 8;			
			$amount = 0;
			$sta = 0;
			if ($fee == 0) {
				$sta = 1;
			}
			$stmt = $this->db->prepare("INSERT INTO accounts(front_desk,item, patient_id, card_type, app_id, to_pay, order_id, date_added,amount,payment_status,company_id) 
				VALUES (?,?,?,?,?,?,?,?,?,?,?)");
			$stmt->execute([$front2,$test,$p_id,$card_type,$app_id, $fee, $code, $date,$amount,$sta,$comp]);			
			$stmt = null;

		//Notify Nurses
		$status = 0;
		$goto = "vitals?";
		$this->notify("Nurses",$p_id,"New Appointment Created: ",$goto);
					return "Done";
				
				} catch (PDOException $e) {
					// For handling error
					echo 'Error: ' . $e->getMessage();			
				}
	}

	public function edit_vitals($bpsts, $bpstd, $bpsis, $dssit, $pulse, $rds, $temp,$height, $weight,$bmi,$spo2, $allergies, $rbp,  $complaint, $respiratory, $val,$nurse,$edit){		
		try {
			$stmt = $this->db->prepare("UPDATE patient_appointment SET blood_press_stand_s = ?,blood_press_stand_d = ?,blood_press_sit_s = ?,blood_press_sit_d = ?,pulse_rate = ?
			,blood_sugar = ?, temperature=?, height=?,weight=?, bmi=?,spo2=?, allergies=?, routine_blood_pressure=?,  nurse_complaint=?, respiratory=?, vital_nurse = ?  WHERE id = ?");
			$stmt->execute([$bpsts, $bpstd, $bpsis, $dssit, $pulse, $rds, $temp,$height, $weight,$bmi,$spo2, $allergies, $rbp,  $complaint, $respiratory,$nurse, $val]);
			$stmt = null;

			$que= $this->db->prepare("SELECT doctor_id,patient_id FROM patient_appointment WHERE id = ?");
			$que->execute([$val]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$doctor = $row->doctor_id;
			$p_id = $row->patient_id;
			$goto = "lab_results?id=".$val."&p=".$p_id."&";
			if ($edit == 1) {
				$this->notify($doctor,$p_id,"Vitals Updated",$goto);
			}else{
				$this->notify($doctor,$p_id,"You Have A New Appointment",$goto);
			}
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Vitals could not be added
				  </div>: ' . $e->getMessage();
		}
	}
	
	public function extra_test($ecg, $ech, $val){		
		try {
			$stmt = $this->db->prepare("UPDATE patient_appointment SET ecg_result = ?,echo_result = ? WHERE id = ?");
			$stmt->execute([$ecg,$ech,$val]);
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Extra Test could not be added
				  </div>: ' . $e->getMessage();
		}
	}
	
	public function seen_result($val){
		try {
		$seen =1;
		$stmt = $this->db->prepare("UPDATE patient_test_group SET seen_result = ? WHERE link_ref = ?");
		$stmt->execute([$seen,$val]);
		$stmt = null;
		return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	
	public function insert_treatment_i($name,$fee,$user){
		try {
		$stmt = $this->db->prepare("INSERT INTO treatment_list(name,fee,addedby,date_added) 
		VALUES (?,?,?,NOW())");
		$stmt->execute([$name,$fee,$user]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function insert_treatment($pid,$disease,$date,$symptom,$note,$ipd,$user){
		try {
		$stmt = $this->db->prepare("INSERT INTO treatments(patient_id,admission_id,disease,symptom,extra_note,next_checkup,date_added,added_by) 
		VALUES (?,?,?,?,?,?,NOW(),?)");
		$stmt->execute([$pid,$ipd,$disease,$symptom,$note,$date,$user]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function insert_label($val,$id){
		try {
		$stmt = $this->db->prepare("UPDATE donations SET label = ? WHERE id = ?");
		$stmt->execute([$val,$id]);
		$stmt = null;
		return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function insert_status($val,$id){
		try {
		$stmt = $this->db->prepare("UPDATE donations SET status = ? WHERE id = ?");
		$stmt->execute([$val,$id]);
		$stmt = null;
		return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function insert_blood_group($name,$val){
		try {
		$stmt = $this->db->prepare("INSERT INTO blood_groups(blood_group) 
		VALUES (?)");
		$stmt->execute([$name]);
		$last = $this->db->lastInsertId();
		$stmt = null;

		$stmt = $this->db->prepare("INSERT INTO blood_stock(name,sample_id,quantity,added_by,date_added) 
		VALUES (?,?,0,?,NOW())");
		$stmt->execute([$name,$last,$val]);
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function insert_sample($name,$val){
		try {
		$stmt = $this->db->prepare("INSERT INTO samples(sample,added_by,date_added) 
		VALUES (?,?,NOW())");
		$stmt->execute([$name,$val]);
		$last = $this->db->lastInsertId();
		$stmt = null;

		$stmt = $this->db->prepare("INSERT INTO blood_stock(name,blood_group,quantity,added_by,date_added) 
		VALUES (?,?,0,?,NOW())");
		$stmt->execute([$name,$last,$val]);
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}


	public function edit_sample($name,$id,$val){
		try {
		$stmt = $this->db->prepare("UPDATE samples SET sample= ? , updated_by = ?, date_updated = NOW()
		WHERE id = ?");
		$stmt->execute([$name,$id,$val]);
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}




	public function insert_tgroup($name){
		try {
		$stmt = $this->db->prepare("INSERT INTO tgroup(name) 
		VALUES (?)");
		$stmt->execute([$name]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function insert_exp_type($name,$usr){
		try {
		$stmt = $this->db->prepare("INSERT INTO expenses_types(name,date_added,added_by) 
		VALUES (?,NOW(),?)");
		$stmt->execute([$name,$usr]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function insert_income_type($name,$usr){
		try {
		$stmt = $this->db->prepare("INSERT INTO income_types(name,`date`,added_by) 
		VALUES (?,NOW(),?)");
		$stmt->execute([$name,$usr]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function insert_revenue_type($name){
		try {
		$stmt = $this->db->prepare("INSERT INTO payment_type(payment_type) 
		VALUES (?)");
		$stmt->execute([$name]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}


	public function insert_cap_fee($name){
		try {
			session_start();
		$us = $_SESSION['userSession'];
		$stmt = $this->db->prepare("INSERT INTO capitations(amount,date_added,added_by) 
		VALUES (?,NOW(),?)");
		$stmt->execute([$name,$us]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function insert_tariff($name){
		try {
			$hex = "#".substr(md5(mt_rand()), 0,6);
		$stmt = $this->db->prepare("INSERT INTO tariffs(name,color) 
		VALUES (?,?)");
		$stmt->execute([$name,$hex]);
		
		$stmt = null;

		$new_name = strtolower($name);
		$new_name = str_replace(" ", "_", $new_name);
		$stmt = $this->db->prepare("ALTER TABLE `lab_test` ADD `$new_name` TEXT NOT NULL AFTER `fee`;")->execute();
		$stmt = null;

		$new_name = strtolower($name);
		$new_name = str_replace(" ", "_", $new_name);
		$stmt = $this->db->prepare("ALTER TABLE `pharm_stock` ADD `$new_name` TEXT NOT NULL AFTER `price`;")->execute();
		$stmt = null;

		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function clone_tariff($name,$clone){
		try {
			$hex = "#".substr(md5(mt_rand()), 0,6);
		$stmt = $this->db->prepare("INSERT INTO tariffs(name,color) 
		VALUES (?,?)");
		$stmt->execute([$name,$hex]);
		$stmt = null;

		$new_name = strtolower($name);
		$new_name = str_replace(" ", "_", $new_name);
		$stmt = $this->db->prepare("INSERT INTO `lab_test`(`$new_name`) (SELECT `$clone` FROM `lab_test`)")->execute();
		$stmt = null;

		$new_name = strtolower($name);
		$new_name = str_replace(" ", "_", $new_name);
		$stmt = $this->db->prepare("INSERT INTO `pharm_stock`(`$new_name`) (SELECT `$clone` FROM `pharm_stock`)")->execute();
		$stmt = null;

		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function insert_category($name){
		try {
		/*
			1.  SELECT id,wellness FROM `pharm_stock`";
			2.  ALTER TABLE `lab_test` ADD `$new_name` TEXT NOT NULL AFTER `fee`;
			3.  



		*/
		$stmt = $this->db->prepare("INSERT INTO xray_types(category)  VALUES (?)");
		$stmt->execute([$name]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function insert_category1($name){
		try {
		$stmt = $this->db->prepare("INSERT INTO scan_types(category) 
		VALUES (?)");
		$stmt->execute([$name]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function edit_test_type($name, $val){		
		try {
			$stmt = $this->db->prepare("UPDATE lab_test_type SET lab_test_type = ? WHERE lab_test_type_id = ?");
			$stmt->execute([$name, $val]);
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Test Type could not be added
				  </div>: ' . $e->getMessage();
		}
	}

	public function edit_treatment_i($name,$fee,$val,$user){		
		try {
			$stmt = $this->db->prepare("UPDATE treatment_list SET name = ?, fee = ?,updated_by = ?, date_updated = NOW() WHERE id = ?");
			$stmt->execute([$name,$fee,$user,$val]);
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Treatment could not be updated
				  </div>: ' . $e->getMessage();
		}
	}

	public function edit_blood_group($name, $val){		
		try {
			$stmt = $this->db->prepare("UPDATE `blood_groups` SET `blood_group` = ? WHERE `blood_group_id` = ?");
			$stmt->execute([$name, $val]);
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Blood Group Could Not Be Updated
				  </div>: ' . $e->getMessage();
		}
	}

	public function edit_revenue($name, $val){		
		try {
			$stmt = $this->db->prepare("UPDATE payment_type SET payment_type = ? WHERE payment_type_id = ?");
			$stmt->execute([$name, $val]);
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Revenue Type could not be Updated
				  </div>: ' . $e->getMessage();
		}
	}

	public function edit_tgroup($name, $val){		
		try {
			$stmt = $this->db->prepare("UPDATE tgroup SET name = ? WHERE id = ?");
			$stmt->execute([$name, $val]);
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Group could not be Updated
				  </div>: ' . $e->getMessage();
		}
	}

	public function changeCstatus($staff,$name, $val){		
		try {
			$stmt = $this->db->prepare("UPDATE capitations SET status = ?,enrollees = ? WHERE id = ?");
			$stmt->execute([$name,$staff, $val]);
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Status could not be Updated
				  </div>: ' . $e->getMessage();
		}
	}

	public function edit_tariff($name,$group, $val){		
		try {
			$stmt = $this->db->prepare("UPDATE tariffs SET name = ?,tgroup = ? WHERE id = ?");
			$stmt->execute([$name,$group, $val]);
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Tariff could not be Updated
				  </div>: ' . $e->getMessage();
		}
	}
	public function edit_Category($name, $val){		
		try {
			$stmt = $this->db->prepare("UPDATE xray_types SET category = ? WHERE xray_cat_id = ?");
			$stmt->execute([$name, $val]);
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Category could not be updated
				  </div>: ' . $e->getMessage();
		}
	}
	public function edit_Category1($name, $val){		
		try {
			$stmt = $this->db->prepare("UPDATE scan_types SET category = ? WHERE scan_cat_id = ?");
			$stmt->execute([$name, $val]);
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Category could not be updated
				  </div>: ' . $e->getMessage();
		}
	}
	public function insert_test($name, $fee, $type, $nvalue, $nrange, $rrange){
		try {
		$stmt = $this->db->prepare("INSERT INTO lab_test(lab_test,fee,lab_test_type_id,normal_value,normal_range,reference_range) 
		VALUES (?,?,?,?,?,?)");
		$stmt->execute([$name, $fee, $type, $nvalue, $nrange, $rrange]);
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function insert_donor($name, $father_name, $sex, $dob, $weight, $blood_group,$address,$email,$phone){
		try {
		$stmt = $this->db->prepare("INSERT INTO donors(name,fathers_name,gender,dob,body_weight,blood_group,address,email,phone) 
		VALUES (?,?,?,?,?,?,?,?,?)");
		$stmt->execute([$name, $father_name, $sex, $dob, $weight, $blood_group,$address,$email,$phone]);
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function edit_donor($name, $father_name, $sex, $dob, $weight, $blood_group,$address,$email,$phone,$value){
		try {
		$stmt = $this->db->prepare("UPDATE `donors` SET `name`= ?,`fathers_name`=?,`gender`=?,`dob`=?,`body_weight`=?,`blood_group`=?,`address`=?,`email`=?,`phone` = ? WHERE `donor_id` = ?");
		$stmt->execute([$name, $father_name, $sex, $dob, $weight, $blood_group,$address,$email,$phone,$value]);
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function insert_xray($name, $fee, $type){
		try {
		$stmt = $this->db->prepare("INSERT INTO xray(name,fee,category) 
		VALUES (?,?,?)");
		$stmt->execute([$name, $fee, $type]);
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function insert_scan($name, $fee, $type){
		try {
		$stmt = $this->db->prepare("INSERT INTO scan(name,fee,category) 
		VALUES (?,?,?)");
		$stmt->execute([$name, $fee, $type]);
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function insert_note($note,$ipd,$by){
		try {
		$stmt = $this->db->prepare("INSERT INTO notes(note,ipd_numb,added_by,date_added) 
		VALUES (?,?,?,NOW())");
		$stmt->execute([$note,$ipd,$by]);
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function insert_progress($note,$ipd,$by){
		try {
		$stmt = $this->db->prepare("INSERT INTO progress(note,ipd_numb,added_by,date_added) 
		VALUES (?,?,?,NOW())");
		$stmt->execute([$note,$ipd,$by]);
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	
	public function insert_operations_note($note,$ipd,$by){
		try {
		$surgery = $this->get_name_from_id('surgery_perm_id','surgery_perm','appointment_id',$ipd);
		$stmt = $this->db->prepare("INSERT INTO operations(note,surgery_id,appointment_id,added_by,date_added) 
		VALUES (?,?,?,?,NOW())");
		$stmt->execute([$note,$surgery,$ipd,$by]);
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function edit_test($name, $fee, $type, $template, $nvalue, $nrange, $rrange, $val){		
		try {
			$stmt = $this->db->prepare("UPDATE lab_test SET lab_test = ?,fee = ?,lab_test_type_id = ?,template = ?, normal_value = ?,normal_range = ?,reference_range = ? WHERE lab_test_id = ?");
			$stmt->execute([$name, $fee, $type, $template, $nvalue, $nrange, $rrange, $val]);
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Test could not be added
				  </div>: ' . $e->getMessage();
		}
	}

	public function edit_test2($fee, $tname, $val){		
		try {
			$stmt = $this->db->prepare("UPDATE lab_test SET $tname = ? WHERE lab_test_id = ?");
			$stmt->execute([$fee, $val]);
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Test could not be Updated
				  </div>: ' . $e->getMessage();
		}
	}

	public function edit_xray($name, $fee, $type,$val){		
		try {
			$stmt = $this->db->prepare("UPDATE xray SET name = ?,fee = ?,category = ? WHERE id = ?");
			$stmt->execute([$name, $fee, $type, $val]);
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Xray could not be added
				  </div>: ' . $e->getMessage();
		}
	}

	public function edit_scan($name, $fee, $type,$val){		
		try {
			$stmt = $this->db->prepare("UPDATE scan SET name = ?,fee = ?,category = ? WHERE id = ?");
			$stmt->execute([$name, $fee, $type, $val]);
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Scan could not be added
				  </div>: ' . $e->getMessage();
		}
	}
	
	public function insert_test_request($test,$doctor,$val,$app) {
		try {
			$link = uniqid();
			$this->db->beginTransaction();
			$allfee = 0;
			$type = 2;
			$rows_inserted = 0;

			//get card_type
			$que= $this->db->prepare("SELECT * FROM patients WHERE id = ?");
			$que->execute([$val]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$card_type = $row->card_type;
			$front = $row->front_desk;
			$tariff = $row->tariff;
			$que = null;
			$ray = "";

			$stmt = $this->db->prepare("INSERT INTO patient_test(front_desk,patient_id, patient_appointment_id,link_ref,lab_test_id,lab_test_type_id,staff_id) 
			VALUES (?,?,?,?,?,?,?)");
			foreach($test as $row => $value){

				if ($tariff > 0) {
					$tariff_name = $this->get_name_from_id('name','tariffs','id',$tariff);
					$tariff_name = strtolower($tariff_name);
					$tariff_name = str_replace(" ", "_", $tariff_name);
					$fee = $this->get_name_from_id($tariff_name,'lab_test','lab_test_id',$row);
					$ray .= $tariff;
				}else{
					$fee = $this->get_name_from_id('fee','lab_test','lab_test_id',$row);
				}

				$type = $this->get_name_from_id('lab_test_type_id','lab_test','lab_test_id',$row);
				$stmt->execute(array($front,$val,$app,$link,$row,$type,$doctor));
				$rows_inserted++;
				$allfee1+=$fee;
			}
			
			//get percentage for company
			$que= $this->db->prepare("SELECT * FROM `percentage`  WHERE id = 1");
			$que->execute();
			$row = $que->fetch(PDO::FETCH_OBJ);
			$percentage = $row->percentage;
			$que = null;
			
			if ($card_type == 11) {
				$priceToPay2 = (($percentage/100)*($allfee1));
				$allfee = (($allfee1)+($priceToPay2));
			}else{
				$allfee = $allfee1;
			}
			//query 2	
			$stmt = $this->db->prepare("INSERT INTO patient_test_group(front_desk,patient_id,doctor_id,link_ref,test_num,patient_appointment_id,total_fee)  
			VALUES (?,?,?,?,?,?,?)");
			$stmt->execute([$front,$val,$doctor,$link,$rows_inserted,$app,$allfee]);
			
			
			
			//query 3
			$item = 2;
			$status = 0;
			$date = date("Y-m-d");
			//$patient = $this->get_name_from_id('patient_id','patient_appointment','id',$val);
			$stmt = $this->db->prepare("INSERT INTO accounts(front_desk,order_id,patient_id,app_id,item,to_pay,payment_status, date_added, card_type)  
			VALUES (?,?,?,?,?,?,?,?,?)");
			$stmt->execute([$front,$link,$val,$app,$item,$allfee,$status, $date, $card_type]);
			
			//query 4
			$stmt = $this->db->prepare("INSERT INTO payment(front_desk,reference,patient_id,appointment_id,payment_type_id,amount,payment_status) 
			VALUES (?,?,?,?,?,?,?)");
			$stmt->execute([$front,$link,$val,$app,$type,$allfee,$status]);
			$this->db->commit();
			
			$stmt = null;
			$success = "Done";

			//get sum
			$que= $this->db->prepare("SELECT SUM(to_pay) AS tot FROM `accounts`  WHERE front_desk LIKE ?");
			$que->execute([$front]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$sum = $row->tot;
			$que = null;
			
			//Notify Account
			$status = 0;
			$stmt = $this->db->prepare("INSERT INTO notifications(staff_id,patient_id,message,link,time_taken,status)  
			VALUES ('front_desk',?,'Payment Needed For: ','view_payment_details.php?id=".$front."&amount=".$sum."&pid=".$val."&',NOW(),?)");
			$stmt->execute([$val,$status]);
			$stmt = null;

			$stmt = $this->db->prepare("INSERT INTO notifications(staff_id,patient_id,message,link,time_taken,status)  
			VALUES ('account',?,'Payment Needed For: ','view_payment_details.php?id=".$front."&amount=".$sum."&pid=".$val."&',NOW(),?)");
			$stmt->execute([$val,$status]);
			$stmt = null;
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Test could not be added
				  </div>: ' . $e->getMessage();
		}
		
    }

    public function insert_test_request2($test,$doctor,$val,$app) {
		try {
			$link = uniqid();
			$this->db->beginTransaction();
			$allfee = 0;
			$type = 2;
			$rows_inserted = 0;

			//get card_type
			$que= $this->db->prepare("SELECT * FROM patients WHERE id = ?");
			$que->execute([$val]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$card_type = $row->card_type;
			$front = $row->front_desk;
			$que = null;


			$stmt = $this->db->prepare("INSERT INTO patient_test(front_desk,patient_id, patient_appointment_id,link_ref,lab_test_id,lab_test_type_id,staff_id) 
			VALUES (?,?,?,?,?,?,?)");
			foreach($test as $row => $value){
				if ($tariff > 0) {
					$tariff_name = $this->get_name_from_id('name','tariffs','id',$tariff);
					$tariff_name = strtolower($tariff_name);
					$tariff_name = str_replace(" ", "_", $tariff_name);
					$fee = $this->get_name_from_id($tariff_name,'lab_test','lab_test_id',$row);
				}else{
					$fee = $this->get_name_from_id('fee','lab_test','lab_test_id',$row);
				}
				$type = $this->get_name_from_id('lab_test_type_id','lab_test','lab_test_id',$row);
				$stmt->execute(array($front,$val,$app,$link,$row,$type,$doctor));
				$rows_inserted++;
				$allfee1+=$fee;
			}
			
			//get percentage for company
			$que= $this->db->prepare("SELECT * FROM `percentage`  WHERE id = 1");
			$que->execute();
			$row = $que->fetch(PDO::FETCH_OBJ);
			$percentage = $row->percentage;
			$que = null;
			
			if ($card_type == 11) {
				$priceToPay2 = (($percentage/100)*($allfee1));
				$allfee = (($allfee1)+($priceToPay2));
			}else{
				$allfee = $allfee1;
			}

			//query 2	
			$stmt = $this->db->prepare("INSERT INTO patient_test_group(front_desk,patient_id,doctor_id,link_ref,test_num,patient_appointment_id,total_fee)  
			VALUES (?,?,?,?,?,?,?)");
			$stmt->execute([$front,$val,$doctor,$link,$rows_inserted,$app,$allfee]);
			$stmt = null;

		
			$que22 = $this->db->prepare("INSERT INTO `in-patients`(`app_id`,`item`,`nature`,`to_pay`,`prepared_by`,`date_added`) VALUES(?,'Lab Tests',2,?,?,NOW())");
			$que22->execute([$app,"-".$allfee,$doctor]);
			$this->db->commit();			
			$que22 = null;

			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Test could not be added
				  </div>: ' . $e->getMessage();
		}
		
    }

    public function insert_xray_request($test,$doctor,$val) {
		try {
			$link = uniqid();
			$this->db->beginTransaction(); 
			$allfee = 0;
			$type = 2;
			$rows_inserted = 0;			
			$patient = $this->get_name_from_id('patient_id','patient_appointment','id',$val);
			foreach($test as $row => $value){
				$stmt = $this->db->prepare("INSERT INTO xray_requests (patient_id,appointment_id,link,name,type, staff_id) 
			VALUES (?,?,?,?,?,$doctor)");
			
				if ($tariff > 0) {
					$tariff_name = $this->get_name_from_id('name','tariffs','id',$tariff);
					$tariff_name = strtolower($tariff_name);
					$tariff_name = str_replace(" ", "_", $tariff_name);
					$fee = $this->get_name_from_id($tariff_name,'xray','id',$row);
				}else{
					$fee = $this->get_name_from_id('fee','xray','id',$row);
				}
				$type = $this->get_name_from_id('category','xray','id',$row);
				$stmt->execute(array($patient,$val,$link,$row,$type));
				$rows_inserted++;
				$allfee+=$fee;
			}
			
			//query 2	
			$stmt = $this->db->prepare("INSERT INTO patient_xray_group(patient_id,doctor_id,link_ref,xray_num,patient_appointment_id,total_fee)  
			VALUES (?,?,?,?,?,?)");
			$stmt->execute([$patient,$doctor,$link,$rows_inserted,$val,$allfee]);
			
			//get card_type
			$que= $this->db->prepare("SELECT * FROM patients WHERE id = ?");
			$que->execute([$patient]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$card_type = $row->card_type;
			$front = $row->front_desk;
			$que = null;
			//query 3
			$item = 6;
			$status = 0;
			$date = date("Y-m-d");
			$stmt = $this->db->prepare("INSERT INTO accounts(front_desk,order_id,patient_id,app_id,item,to_pay,payment_status, date_added, card_type)  
			VALUES (?,?,?,?,?,?,?,?,?)");
			$stmt->execute([$front,$link,$patient,$val,$item,$allfee,$status, $date, $card_type]);
			
			//query 4
			$stmt = $this->db->prepare("INSERT INTO payment(front_desk,reference,patient_id,appointment_id,payment_type_id,amount,payment_status) 
			VALUES (?,?,?,?,?,?,?)");
			$stmt->execute([$front,$link,$patient,$val,$type,$allfee,$status]);
			$this->db->commit();
			
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Xray could not be added
				  </div>: ' . $e->getMessage();
		}
		
    }

    public function insert_xray_request2($test,$doctor,$val) {
		try {
			$link = uniqid();
			$this->db->beginTransaction(); 
			$allfee = 0;
			$type = 2;
			$rows_inserted = 0;			
			$patient = $this->get_name_from_id('patient_id','patient_appointment','id',$val);
			foreach($test as $row => $value){
				$stmt = $this->db->prepare("INSERT INTO xray_requests (patient_id,appointment_id,link,name,type, staff_id) 
			VALUES (?,?,?,?,?,$doctor)");
			
				if ($tariff > 0) {
					$tariff_name = $this->get_name_from_id('name','tariffs','id',$tariff);
					$tariff_name = strtolower($tariff_name);
					$tariff_name = str_replace(" ", "_", $tariff_name);
					$fee = $this->get_name_from_id($tariff_name,'xray','id',$row);
				}else{
					$fee = $this->get_name_from_id('fee','xray','id',$row);
				}
				$type = $this->get_name_from_id('category','xray','id',$row);
				$stmt->execute(array($patient,$val,$link,$row,$type));
				$rows_inserted++;
				$allfee+=$fee;
			}
			
			//query 2	
			$stmt = $this->db->prepare("INSERT INTO patient_xray_group(patient_id,doctor_id,link_ref,xray_num,patient_appointment_id,total_fee)  
			VALUES (?,?,?,?,?,?)");
			$stmt->execute([$patient,$doctor,$link,$rows_inserted,$val,$allfee]);
			
			//get card_type
			$que= $this->db->prepare("SELECT * FROM patients WHERE id = ?");
			$que->execute([$patient]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$card_type = $row->card_type;
			$front = $row->front_desk;
			$que = null;
			
			//query 3
			$que22 = $this->db->prepare("INSERT INTO `in-patients`(`app_id`,`item`,`nature`,`to_pay`,`prepared_by`,`date_added`) VALUES(?,'Xray',2,?,?,NOW())");
			$que22->execute([$val,"-".$allfee,$doctor]);
			$this->db->commit();			
			$que22 = null;

			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Xray could not be added
				  </div>: ' . $e->getMessage();
		}
		
    }

    public function insert_scan_request($test,$doctor,$val) {
		try {
			$link = uniqid();
			$this->db->beginTransaction(); 
			$allfee = 0;
			$type = 2;
			$rows_inserted = 0;			
			$patient = $this->get_name_from_id('patient_id','patient_appointment','id',$val);
			foreach($test as $row => $value){
				$stmt = $this->db->prepare("INSERT INTO scan_requests (patient_id,appointment_id,link,name,type, staff_id) 
			VALUES (?,?,?,?,?,$doctor)");
			
				if ($tariff > 0) {
					$tariff_name = $this->get_name_from_id('name','tariffs','id',$tariff);
					$tariff_name = strtolower($tariff_name);
					$tariff_name = str_replace(" ", "_", $tariff_name);
					$fee = $this->get_name_from_id($tariff_name,'scan','id',$row);
				}else{
					$fee = $this->get_name_from_id('fee','scan','id',$row);
				}
				$type = $this->get_name_from_id('category','scan','id',$row);
				$stmt->execute(array($patient,$val,$link,$row,$type));
				$rows_inserted++;
				$allfee+=$fee;
			}
			
			//query 2	
			$stmt = $this->db->prepare("INSERT INTO patient_scan_group(patient_id,doctor_id,link_ref,scan_num,patient_appointment_id,total_fee)  
			VALUES (?,?,?,?,?,?)");
			$stmt->execute([$patient,$doctor,$link,$rows_inserted,$val,$allfee]);
			
			//get card_type
			$que= $this->db->prepare("SELECT * FROM patients WHERE id = ?");
			$que->execute([$patient]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$card_type = $row->card_type;
			$front = $row->front_desk;
			$que = null;
			//query 3
			$item = 6;
			$status = 0;
			$date = date("Y-m-d");
			$stmt = $this->db->prepare("INSERT INTO accounts(front_desk,order_id,patient_id,app_id,item,to_pay,payment_status, date_added, card_type)  
			VALUES (?,?,?,?,?,?,?,?,?)");
			$stmt->execute([$front,$link,$patient,$val,$item,$allfee,$status, $date, $card_type]);
			
			//query 4
			$stmt = $this->db->prepare("INSERT INTO payment(front_desk,reference,patient_id,appointment_id,payment_type_id,amount,payment_status) 
			VALUES (?,?,?,?,?,?,?)");
			$stmt->execute([$front,$link,$patient,$val,$type,$allfee,$status]);
			$this->db->commit();
			
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Scan could not be added
				  </div>: ' . $e->getMessage();
		}
		
    }

    public function insert_scan_request2($test,$doctor,$val) {
		try {
			$link = uniqid();
			$this->db->beginTransaction(); 
			$allfee = 0;
			$type = 2;
			$rows_inserted = 0;			
			$patient = $this->get_name_from_id('patient_id','patient_appointment','id',$val);
			foreach($test as $row => $value){
				$stmt = $this->db->prepare("INSERT INTO scan_requests (patient_id,appointment_id,link,name,type, staff_id) 
			VALUES (?,?,?,?,?,$doctor)");
			
				if ($tariff > 0) {
					$tariff_name = $this->get_name_from_id('name','tariffs','id',$tariff);
					$tariff_name = strtolower($tariff_name);
					$tariff_name = str_replace(" ", "_", $tariff_name);
					$fee = $this->get_name_from_id($tariff_name,'scan','id',$row);
				}else{
					$fee = $this->get_name_from_id('fee','scan','id',$row);
				}
				$type = $this->get_name_from_id('category','scan','id',$row);
				$stmt->execute(array($patient,$val,$link,$row,$type));
				$rows_inserted++;
				$allfee+=$fee;
			}
			
			//query 2	
			$stmt = $this->db->prepare("INSERT INTO patient_scan_group(patient_id,doctor_id,link_ref,scan_num,patient_appointment_id,total_fee)  
			VALUES (?,?,?,?,?,?)");
			$stmt->execute([$patient,$doctor,$link,$rows_inserted,$val,$allfee]);
			
			//get card_type
			$que= $this->db->prepare("SELECT * FROM patients WHERE id = ?");
			$que->execute([$patient]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$card_type = $row->card_type;
			$front = $row->front_desk;
			$que = null;
			

			//query 3
			$que22 = $this->db->prepare("INSERT INTO `in-patients`(`app_id`,`item`,`nature`,`to_pay`,`prepared_by`,`date_added`) VALUES(?,'Scan',2,?,?,NOW())");
			$que22->execute([$val,"-".$allfee,$doctor]);
			$this->db->commit();			
			$que22 = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Scan could not be added
				  </div>: ' . $e->getMessage();
		}
		
    }

    public function insert_xray_request_front($test,$doctor,$val) {
		try {
			$link = uniqid();
			$this->db->beginTransaction(); 
			$allfee = 0;
			$type = 2;
			$rows_inserted = 0;			
			$patient = $val;
			$val2 = 0;
			foreach($test as $row => $value){
				$stmt = $this->db->prepare("INSERT INTO xray_requests (patient_id,appointment_id,link,name,type, staff_id) 
			VALUES (?,?,?,?,?,$doctor)");
			
				if ($tariff > 0) {
					$tariff_name = $this->get_name_from_id('name','tariffs','id',$tariff);
					$tariff_name = strtolower($tariff_name);
					$tariff_name = str_replace(" ", "_", $tariff_name);
					$fee = $this->get_name_from_id($tariff_name,'xray','id',$row);
				}else{
					$fee = $this->get_name_from_id('fee','xray','id',$row);
				}
				$type = $this->get_name_from_id('category','xray','id',$row);
				$stmt->execute(array($patient,$val2,$link,$row,$type));
				$rows_inserted++;
				$allfee+=$fee;
			}
			
			//query 2	
			$stmt = $this->db->prepare("INSERT INTO patient_xray_group(patient_id,doctor_id,link_ref,xray_num,patient_appointment_id,total_fee)  
			VALUES (?,?,?,?,?,?)");
			$stmt->execute([$patient,$doctor,$link,$rows_inserted,$val2,$allfee]);
			
			//get card_type
			$que= $this->db->prepare("SELECT * FROM patients WHERE id = ?");
			$que->execute([$patient]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$card_type = $row->card_type;
			$front = $row->front_desk;
			$que = null;
			//query 3
			$item = 6;
			$status = 0;
			$date = date("Y-m-d");
			$stmt = $this->db->prepare("INSERT INTO accounts(front_desk,order_id,patient_id,app_id,item,to_pay,payment_status, date_added, card_type)  
			VALUES (?,?,?,?,?,?,?,?,?)");
			$stmt->execute([$front,$link,$patient,$val2,$item,$allfee,$status, $date, $card_type]);
			
			//query 4
			$stmt = $this->db->prepare("INSERT INTO payment(front_desk,reference,patient_id,appointment_id,payment_type_id,amount,payment_status) 
			VALUES (?,?,?,?,?,?,?)");
			$stmt->execute([$front,$link,$patient,$val2,$type,$allfee,$status]);
			$this->db->commit();
			
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Xray could not be added
				  </div>: ' . $e->getMessage();
		}
		
    }

    public function insert_scan_request_front($test,$doctor,$val) {
		try {
			$link = uniqid();
			$this->db->beginTransaction(); 
			$allfee = 0;
			$type = 2;
			$rows_inserted = 0;			
			$patient = $val;
			$val2 = 0;
			foreach($test as $row => $value){
				$stmt = $this->db->prepare("INSERT INTO scan_requests (patient_id,appointment_id,link,name,type, staff_id) 
			VALUES (?,?,?,?,?,$doctor)");
			
				if ($tariff > 0) {
					$tariff_name = $this->get_name_from_id('name','tariffs','id',$tariff);
					$tariff_name = strtolower($tariff_name);
					$tariff_name = str_replace(" ", "_", $tariff_name);
					$fee = $this->get_name_from_id($tariff_name,'scan','id',$row);
				}else{
					$fee = $this->get_name_from_id('fee','scan','id',$row);
				}
				$type = $this->get_name_from_id('category','scan','id',$row);
				$stmt->execute(array($patient,$val2,$link,$row,$type));
				$rows_inserted++;
				$allfee+=$fee;
			}
			
			//query 2	
			$stmt = $this->db->prepare("INSERT INTO patient_scan_group(patient_id,doctor_id,link_ref,scan_num,patient_appointment_id,total_fee)  
			VALUES (?,?,?,?,?,?)");
			$stmt->execute([$patient,$doctor,$link,$rows_inserted,$val2,$allfee]);
			
			//get card_type
			$que= $this->db->prepare("SELECT * FROM patients WHERE id = ?");
			$que->execute([$patient]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$card_type = $row->card_type;
			$front = $row->front_desk;
			$que = null;
			//query 3
			$item = 6;
			$status = 0;
			$date = date("Y-m-d");
			$stmt = $this->db->prepare("INSERT INTO accounts(front_desk,order_id,patient_id,app_id,item,to_pay,payment_status, date_added, card_type)  
			VALUES (?,?,?,?,?,?,?,?,?)");
			$stmt->execute([$front,$link,$patient,$val2,$item,$allfee,$status, $date, $card_type]);
			
			//query 4
			$stmt = $this->db->prepare("INSERT INTO payment(front_desk,reference,patient_id,appointment_id,payment_type_id,amount,payment_status) 
			VALUES (?,?,?,?,?,?,?)");
			$stmt->execute([$front,$link,$patient,$val2,$type,$allfee,$status]);
			$this->db->commit();
			
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Scan could not be added
				  </div>: ' . $e->getMessage();
		}
		
    }
	
	public function insert_test_request_front($test,$doctor,$val) {
		try {
			$link = uniqid();
			$this->db->beginTransaction();
			$allfee = 0;
			$type = 2;
			$rows_inserted = 0;
			$app_id = 0;

			//get card_type
			$que= $this->db->prepare("SELECT * FROM patients WHERE id = ?");
			$que->execute([$val]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$card_type = $row->card_type;
			$front = $row->front_desk;
			$que = null;


			$stmt = $this->db->prepare("INSERT INTO patient_test(front_desk,patient_id, patient_appointment_id,link_ref,lab_test_id,lab_test_type_id) 
			VALUES (?,?,?,?,?,?)");
			foreach($test as $row => $value){
				if ($tariff > 0) {
					$tariff_name = $this->get_name_from_id('name','tariffs','id',$tariff);
					$tariff_name = strtolower($tariff_name);
					$tariff_name = str_replace(" ", "_", $tariff_name);
					$fee = $this->get_name_from_id($tariff_name,'lab_test','lab_test_id',$row);
				}else{
					$fee = $this->get_name_from_id('fee','lab_test','lab_test_id',$row);
				}
				$type = $this->get_name_from_id('lab_test_type_id','lab_test','lab_test_id',$row);
				$stmt->execute(array($front,$val,$app_id,$link,$row,$type));
				$rows_inserted++;
				$allfee+=$fee;
			}
			
			//query 2	

			$doc = 0;
			$stmt = $this->db->prepare("INSERT INTO patient_test_group(front_desk,patient_id,doctor_id,link_ref,test_num,patient_appointment_id,total_fee)  
			VALUES (?,?,?,?,?,?,?)");
			$stmt->execute([$front,$val,$doc,$link,$rows_inserted,$app_id,$allfee]);
			
			
			
			//query 3
			$item = 2;
			$status = 0;
			$date = date("Y-m-d");
			//$patient = $this->get_name_from_id('patient_id','patient_appointment','id',$val);
			$stmt = $this->db->prepare("INSERT INTO accounts(front_desk,order_id,patient_id,app_id,item,to_pay,payment_status, date_added, card_type)  
			VALUES (?,?,?,?,?,?,?,?,?)");
			$stmt->execute([$front,$link,$val,$app_id,$item,$allfee,$status, $date, $card_type]);
			
			//query 4
			$stmt = $this->db->prepare("INSERT INTO payment(front_desk,reference,patient_id,appointment_id,payment_type_id,amount,payment_status) 
			VALUES (?,?,?,?,?,?,?)");
			$stmt->execute([$front,$link,$val,$app_id,$type,$allfee,$status]);
			$this->db->commit();
			
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Test could not be added
				  </div>: ' . $e->getMessage();
		}
		
    }
	
	public function insert_test_result($result, $o, $h, $remark, $stat, $val, $link){		
		try {
			$this->db->beginTransaction();
			$stmt = $this->db->prepare("UPDATE patient_test SET lab_result = ?,o = ?,h = ?,remarks = ?,tested = ? WHERE patient_test_id = ?");
			$stmt->execute([$result, $o, $h, $remark, $stat, $val]);
			
			//query 2
			$res = 1;
			$stmt = $this->db->prepare("UPDATE patient_test_group SET awaiting_result = ? WHERE link_ref = ?" );
			$stmt->execute([$res,$link]);
			$this->db->commit();
			
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Test Result could not be updated
				  </div>: ' . $e->getMessage();
		}
	}
	
	
	public function insert_ress($p_id, $test, $id, $value, $temp, $name_id){		
		try {
			$stmt = $this->db->prepare("INSERT INTO patient_test_result(app_id,test_id,ref_id, value, test_name, lab_temp_id) 
			VALUES (?,?,?,?,?,?)");
			$stmt->execute([$p_id, $test, $id, $value, $temp, $name_id]);
			$stmt = null;
			
			//query 2
			$res = 1;
			$stmt = $this->db->prepare("UPDATE patient_test_group SET awaiting_result = ? WHERE link_ref = ?" );
			$stmt->execute([$res,$id]);
			
			
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Test Result could not be updated
				  </div>: ' . $e->getMessage();
		}
	}

	public function insert_xray_ress($p_id, $app_id, $xray_id, $ref_id,$file, $comment, $xname, $category){		
		try {
			
			$stmt = $this->db->prepare("INSERT INTO patient_xray_result(patient_id,app_id,xray_id,ref_id,file, comment, xray_name, category) 
			VALUES (?,?,?,?,?,?,?,?)");
			$stmt->execute([$p_id, $app_id, $xray_id, $ref_id,$file, $comment, $xname, $category]);
			$stmt = null;
			
			//query 2
			$res = 1;
			$stmt = $this->db->prepare("UPDATE patient_xray_group SET awaiting_result = ? WHERE link_ref = ?" );
			$stmt->execute([$res,$ref_id]);
			
			
			$stmt = null;

			$que= $this->db->prepare("SELECT * FROM patients WHERE id = ?");
			$que->execute([$p_id]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$pan = $row->title." ".$row->surname." ".$row->first_name." ".$row->middle_name;
			$psex = $row->sex;
			$page = $row->age;
			$que = null;

			$que= $this->db->prepare("SELECT * FROM patient_appointment WHERE id = ?");
			$que->execute([$app_id]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$doc_id = $row->doctor_id;
			$que = null;

			$stmt = $this->db->prepare("INSERT INTO notifications(staff_id,patient_id,message,link,time_taken,status)  
							VALUES (?,?,'Xray Are Available For: ','view_xray?id=".$ref_id."&pid=".$p_id."&n=".$pan."&a=".$page."&s=".$psex."&did=".$doc_id."&',NOW(),0)");
			$stmt->execute([$doc_id,$p_id]);
			$stmt = null;

			$success = 'yesi';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Xray Result could not be updated
				  </div>: ' . $e->getMessage();
		}
	}

	public function insert_scan_ress($p_id, $app_id, $xray_id, $ref_id,$file, $comment, $xname, $category){		
		try {
			
			$stmt = $this->db->prepare("INSERT INTO patient_scan_result(patient_id,app_id,scan_id,ref_id,file, comment, scan_name, category) 
			VALUES (?,?,?,?,?,?,?,?)");
			$stmt->execute([$p_id, $app_id, $xray_id, $ref_id,$file, $comment, $xname, $category]);
			$stmt = null;
			
			//query 2
			$res = 1;
			$stmt = $this->db->prepare("UPDATE patient_scan_group SET awaiting_result = ? WHERE link_ref = ?" );
			$stmt->execute([$res,$ref_id]);
			$stmt = null;

			$que= $this->db->prepare("SELECT * FROM patients WHERE id = ?");
			$que->execute([$p_id]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$pan = $row->title." ".$row->surname." ".$row->first_name." ".$row->middle_name;
			$psex = $row->sex;
			$page = $row->age;
			$que = null;

			$que= $this->db->prepare("SELECT * FROM patient_appointment WHERE id = ?");
			$que->execute([$app_id]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$doc_id = $row->doctor_id;
			$que = null;

			$stmt = $this->db->prepare("INSERT INTO notifications(staff_id,patient_id,message,link,time_taken,status)  
							VALUES (?,?,'Scans Are Available For: ','view_scans?id=".$ref_id."&pid=".$p_id."&n=".$pan."&a=".$page."&s=".$psex."&did=".$doc_id."&',NOW(),0)");
			$stmt->execute([$doc_id,$p_id]);
			$stmt = null;
			$success = 'yesi';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Scan Result could not be updated
				  </div>: ' . $e->getMessage();
		}
	}
	
	public function insert_extra_file($name,$patient,$val,$fullname){
		try {
		$stmt = $this->db->prepare("INSERT INTO extra_file(name,patient_id,patient_appointment_id,extra_file) 
		VALUES (?,?,?,?)");
		$stmt->execute([$name,$patient,$val,$fullname]);
		$stmt = null;
		return "yesi";
		
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					Name Already Exist
				  </div>:' . $e->getMessage();			
		}
	}

	public function insert_xray_file($name,$fullname,$link,$pid){
		try {
		$stmt = $this->db->prepare("INSERT INTO scan_files(comment,extra_file,link_ref,patient_id) 
		VALUES (?,?,?,?)");
		$stmt->execute([$name,$fullname,$link,$pid]);
		$stmt = null;
		return "yesi";
		
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					Name Already Exist
				  </div>:' . $e->getMessage();			
		}
	}

	public function insert_ipdf($company, $breakfast, $lunch, $dinner, $amount, $val){		
		try {
			$stmt = $this->db->prepare("INSERT INTO ipd_food(patient_id,company,breakfast,lunch,dinner,amount) 
			VALUES (?,?,?,?,?,?)");
			$stmt->execute([$val,$company, $breakfast, $lunch, $dinner, $amount]);
			$stmt = null;
			return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Ipd could not be added
				  </div>: ' . $e->getMessage();
		}
	}

	public function insert_log($vname,$vsex,$vtel,$vaddress,$vreason,$s_id,$user){		
		try {
			$stmt = $this->db->prepare("INSERT INTO visitors_log(name,sex,tel,address,reason,staff,added_by,date_added) 
			VALUES (?,?,?,?,?,?,?,NOW())");
			$stmt->execute([$vname,$vsex,$vtel,$vaddress,$vreason,$s_id,$user]);
			$id = $this->db->lastInsertId();
			$stmt = null;
			$goto = "vlog?id=".$id."&";
			$this->notify($s_id,$vname,"You Have A Visitor",$goto);
			//na em
			return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Log could not be added
				  </div>: ' . $e->getMessage();
		}
	}

	public function edit_log($vname,$vsex,$vtel,$vaddress,$vreason,$s_id,$user,$val){		
		try {
			$stmt = $this->db->prepare("UPDATE visitors_log SET name=?,sex=?,tel=?,address=?,reason=?,staff=?,added_by=?,date_added=NOW() WHERE id = ?");
			$stmt->execute([$vname,$vsex,$vtel,$vaddress,$vreason,$s_id,$user,$val]);
			$stmt = null;
			$goto = "vlog?id=".$val."&";
			$this->notify($s_id,$vname,"Your Visitor's Entry Was Updated",$goto);
			//na em
			return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Log could not be added
				  </div>: ' . $e->getMessage();
		}
	}
	
	public function edit_ipdf($company, $breakfast, $lunch, $dinner, $amount, $val){
		try {
		$stmt = $this->db->prepare("UPDATE ipd_food SET company = ?,breakfast = ?,lunch = ?,dinner = ?,amount = ? WHERE ipd_food_id = ?");
			$stmt->execute([$company, $breakfast, $lunch, $dinner, $amount, $val]);
			$stmt = null;
			$success = 'Done';
			return $success;
		
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					Ipd could not be updated
				  </div>:' . $e->getMessage();			
		}
	}
	
	
	public function insert_case($diagnosis, $pharm, $tabs,$dosage,$duration, $quantity, $instruction, $doc_id, $id, $p_id,$stabs,$squantity,$sdosage,$sduration){		
		try {
			
			$status = 0;
			$type = 1;
			$ref = rand(1000,100000);
			$que= $this->db->prepare("SELECT * FROM patients WHERE id = ?");
			$que->execute([$p_id]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$front = $row->front_desk;
			$comp = $row->company_id;

			if (empty($stabs)) {
				$stabs = "";
			}

			if (empty($squantity)) {
				$squantity = "";
			}

			if (empty($sdosage)) {
				$sdosage = "";
			}

			if (empty($sduration)) {
				$sduration = "";
			}

			$stmt = $this->db->prepare("INSERT INTO prescription(company_id,front_desk,reference,diagnosis,pharm_stock_id, tabs,dosage, duration, quantity_dispense,stabs,sdosage, sduration, squantity_dispense,instruction,doctor_id,appointment_id,patient_id) 
			VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
			$stmt->execute([$comp,$front,$ref,$diagnosis,$pharm, $tabs,$dosage, $duration, $quantity,$stabs,$sdosage, $sduration, $squantity, $instruction, $doc_id, $id, $p_id]);
			$stmt = null;
			$val = $this->db->lastInsertId();
			
			$stmt2 = $this->db->prepare("UPDATE patient_appointment SET diagnosis = ?, treated = ? WHERE id = ?" );
			$stmt2->execute([$diagnosis,$type,$id]);
			$stmt2 = null;
			
			$que= $this->db->prepare("SELECT * FROM prescription WHERE prescription_id = ?");
			$que->execute([$val]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$pharm_stock_id = $row->pharm_stock_id;
			$p_id = $row->patient_id;
			$app_id = $row->appointment_id;
			$tabs = $row->tabs;
			$que = null;
			
			$que= $this->db->prepare("SELECT * FROM pharm_stock WHERE id = ?");
			$que->execute([$pharm_stock_id]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$price = $row->price;
			$que = null;	
			

			//lets do the maths
			if ($quantity > 0 AND !empty($quantity)) {
				$priceToPay1 = $quantity * $price;
			}elseif ($squantity > 0 AND !empty($squantity)) {
				$priceToPay1 = $squantity * $price;
			}
					
			//get card_type
			$que= $this->db->prepare("SELECT * FROM patients WHERE id = ?");
			$que->execute([$p_id]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$card_type = $row->card_type;			
			$front2 = $row->front_desk;
			$que = null;

			//get percentage for company
			$que= $this->db->prepare("SELECT * FROM `percentage`  WHERE id = 1");
			$que->execute();
			$row = $que->fetch(PDO::FETCH_OBJ);
			$percentage = $row->percentage;
			$que = null;

			if ($card_type == 11) {
				$priceToPay2 = (($percentage/100)*($priceToPay1));
				$priceToPay = (($priceToPay1)+($priceToPay2));
			}else{
				$priceToPay = $priceToPay1;
			}	

			$name = 3;					
			$date = date("Y-m-d");
			$stmt = $this->db->prepare("INSERT INTO accounts(company_id,front_desk,item, patient_id, app_id,  to_pay, order_id, date_added, card_type) 
			VALUES (?,?,?,?,?,?,?,?,?)");
			$stmt->execute([$comp,$front2,$name, $p_id, $app_id, $priceToPay, $ref, $date, $card_type]);
					
			$type = 3;
			
			$stmt2 = $this->db->prepare("INSERT INTO payment(company_id,front_desk,reference,patient_id,appointment_id,payment_type_id,amount) 
			VALUES (?,?,?,?,?,?,?)");
			$stmt2->execute([$comp,$front2,$ref,$p_id,$app_id,$type,$priceToPay]);
			$stmt2 = null;


			//get sum
			$que= $this->db->prepare("SELECT SUM(to_pay) AS tot FROM `accounts`  WHERE front_desk LIKE ?");
			$que->execute([$front2]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$sum = $row->tot;
			$que = null;

			//Notify Account
			$status = 0;
			$stmt = $this->db->prepare("INSERT INTO notifications(staff_id,patient_id,message,link,time_taken,status)  
			VALUES ('front_desk',?,'Payment Needed For: ','view_payment_details.php?id=".$front2."&amount=".$sum."&pid=".$p_id."&',NOW(),?)");
			$stmt->execute([$p_id,$status]);
			$stmt = null;

			$stmt = $this->db->prepare("INSERT INTO notifications(staff_id,patient_id,message,link,time_taken,status)  
			VALUES ('account',?,'Payment Needed For: ','view_payment_details.php?id=".$front2."&amount=".$sum."&pid=".$p_id."&',NOW(),?)");
			$stmt->execute([$p_id,$status]);
			$stmt = null;

			//Notify Pharmacy
			$status = 0;
			$stmt = $this->db->prepare("INSERT INTO notifications(staff_id,patient_id,message,link,time_taken,status)  
			VALUES ('pharm',?,'Prescription Made For: ','presc.php?pid=".$p_id."&',NOW(),?)");
			$stmt->execute([$p_id,$status]);

			header("Refresh:1; Location: ../module4/prescriptions");



			return "Done";
			
		
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Prescription could not be added
				  </div>: ' . $e->getMessage();
		}
	}

	public function edit_presc_case($diagnosis, $pharm, $tabs,$dosage,$duration, $quantity, $instruction, $id,$stabs,$squantity,$sdosage,$sduration,$p){		
		try {
			

			if (empty($stabs)) {
				$stabs = "";
			}

			if (empty($squantity)) {
				$squantity = "";
			}

			if (empty($sdosage)) {
				$sdosage = "";
			}

			if (empty($sduration)) {
				$sduration = "";
			}

			$stmt = $this->db->prepare("UPDATE `prescription` SET `diagnosis` = ?, `tabs` = ?, `dosage` = ?, `duration` = ?, `quantity_dispense` = ?, `stabs` = ?, `squantity_dispense` = ?, `sdosage` = ?, `sduration` = ?, `instruction` = ?,`status` = 0 WHERE `prescription_id` = ?;");
			$stmt->execute([$diagnosis,$tabs,$dosage, $duration, $quantity,$stabs,$sdosage, $sduration, $squantity, $instruction,$p]);
			$stmt = null;
			
			$que= $this->db->prepare("SELECT * FROM prescription WHERE prescription_id = ?");
			$que->execute([$p]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$pharm_stock_id = $row->pharm_stock_id;
			$p_id = $row->patient_id;
			$app_id = $row->appointment_id;
			$ref = $row->reference;
			$tabs = $row->tabs;
			$que = null;
			
			$que= $this->db->prepare("SELECT * FROM pharm_stock WHERE id = ?");
			$que->execute([$pharm_stock_id]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$price = $row->price;
			$que = null;	
			

			//lets do the maths
			$priceToPay1 = $tabs * $price;
					
			//get card_type
			$que= $this->db->prepare("SELECT * FROM patients WHERE id = ?");
			$que->execute([$p_id]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$card_type = $row->card_type;			
			$front2 = $row->front_desk;
			$que = null;

			//get percentage for company
			$que= $this->db->prepare("SELECT * FROM `percentage`  WHERE id = 1");
			$que->execute();
			$row = $que->fetch(PDO::FETCH_OBJ);
			$percentage = $row->percentage;
			$que = null;

			if ($card_type == 11) {
				$priceToPay2 = (($percentage/100)*($priceToPay1));
				$priceToPay = (($priceToPay1)+($priceToPay2));
			}else{
				$priceToPay = $priceToPay1;
			}	

			$stat = 3;					
			$date = date("Y-m-d");
			$stmt = $this->db->prepare("UPDATE accounts SET to_pay = ?,payment_status = ? WHERE order_id = ?");
			$stmt->execute([$priceToPay,$stat,$ref]);
					
			$type = 0;			
			$stmt2 = $this->db->prepare("UPDATE payment SET amount = ?,payment_status = ? WHERE reference = ?");
			$stmt2->execute([$priceToPay,$type,$ref]);
			$stmt2 = null;


			//get sum
			$que= $this->db->prepare("SELECT SUM(to_pay) AS tot FROM accounts  WHERE front_desk LIKE ?");
			$que->execute([$front2]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$sum = $row->tot;
			$que = null;

			//Notify Account
			$status = 0;
			$stmt = $this->db->prepare("INSERT INTO notifications(staff_id,patient_id,message,link,time_taken,status)  
			VALUES ('front_desk',?,'Payment Needed For: ','view_payment_details.php?id=".$front2."&amount=".$sum."&pid=".$p_id."&',NOW(),?)");
			$stmt->execute([$p_id,$status]);
			$stmt = null;

			$stmt = $this->db->prepare("INSERT INTO notifications(staff_id,patient_id,message,link,time_taken,status)  
			VALUES ('account',?,'Payment Needed For: ','view_payment_details.php?id=".$front2."&amount=".$sum."&pid=".$p_id."&',NOW(),?)");
			$stmt->execute([$p_id,$status]);
			$stmt = null;

			//Notify Pharmacy
			$status = 0;
			$stmt = $this->db->prepare("INSERT INTO notifications(staff_id,patient_id,message,link,time_taken,status)  
			VALUES ('pharm',?,'Prescription Altered For: ','presc.php?pid=".$p_id."&',NOW(),?)");
			$stmt->execute([$p_id,$status]);

			return "Done";
			
		
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Prescription could not be added
				  </div>: ' . $e->getMessage();
		}
	}
	

	public function insert_lab_res($DataArr,$doc_id, $app_id, $p_id, $tech_id){
		try {
			$data_count = count($DataArr);
			for ($i=0; $i<$data_count; $i++) {
				$test = htmlspecialchars(ucfirst($_POST['test'][$i]));
				$test = stripslashes(ucfirst($_POST['test'][$i]));
				$test = trim(ucfirst($_POST['test'][$i]));
					
				$result = htmlspecialchars($_POST['result'][$i]);
				$result = stripslashes($_POST['result'][$i]);
				$result = trim($_POST['result'][$i]);
					
				$flag = htmlspecialchars($_POST['flag'][$i]);
				$flag = stripslashes($_POST['flag'][$i]);
				$flag = trim($_POST['flag'][$i]);
					
				$units = htmlspecialchars($_POST['units'][$i]);
				$units = stripslashes($_POST['units'][$i]);
				$units = trim($_POST['units'][$i]);

				$ref = htmlspecialchars($_POST['ref'][$i]);
				$ref = stripslashes($_POST['ref'][$i]);
				$ref = trim($_POST['ref'][$i]);

				$range = htmlspecialchars($_POST['range'][$i]);
				$range = stripslashes($_POST['range'][$i]);
				$range = trim($_POST['range'][$i]);

				$stmt = $this->db->prepare("INSERT INTO lab_result(lab_test, test_result, test_flag, test_units, test_ref, test_range, doctor_id, patient_id, appointment_id, lab_tech_id) 
					VALUES (?,?,?,?,?,?,?,?,?,?)");
					
				$stmt->execute(array($test, $result, $flag, $units, $ref, $range, $doc_id, $p_id, $app_id, $tech_id));					
				$stmt = null;
				
			}
			return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	

	public function insert_physiotherapy_request($app,$staff,$pid,$front_desk){
		try {
		$link = uniqid();
		$this->db->beginTransaction();
		//$status = 0;
		//$now = date("Y-m-d h:i:s");
		$stmt = $this->db->prepare("INSERT INTO `physiotherapy_requests` (`patient_id`, `staff_id`, `link_ref`, `front_desk`, `patient_appointment_id`, `status`, `date_added`) VALUES (".$pid.",".$staff.",'".$link."','".$front_desk."',".$app.",0,NOW())");
		$stmt->execute([$pid,$staff,$link,$front_desk,$app]);
		$stmt = null;
		
		//get card_type
		$stmt= $this->db->prepare("SELECT * FROM `patients` WHERE `id` = ?");
		$stmt->execute([$pid]);
		$row = $que->fetch(PDO::FETCH_OBJ);
		$card_type = $row->card_type;
		$stmt = null;

		//Bill patient	
		$test = 7;
		$cost = 2500;
		//$date = date("Y-m-d");
		$stmt = $this->db->prepare("INSERT INTO accounts(`front_desk`,`item`,`patient_id`, `card_type`, `app_id`, `to_pay`, `order_id`, `date_added`) 
		VALUES ('".$front_desk."',?,?,?,?,?,'".$link."',NOW())");
		$stmt->execute([$front_desk,$test, $pid, $card_type, $app, $cost, $link]);
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}


	public function insert_admission_request($val,$doc,$p_id,$ward){
		try {
		//get Front_desk
		$que= $this->db->prepare("SELECT * FROM patients WHERE id = ?");
		$que->execute([$p_id]);
		$row = $que->fetch(PDO::FETCH_OBJ);
		$front2 = $row->front_desk;
		$fname = $row->title." ".$row->surname." ".$row->first_name;
		$sex = $row->sex;

		$stmt = $this->db->prepare("INSERT INTO admission_request(`appointment_id`,`doctor_id`,`patient_id`,`front_desk`) 
		VALUES (?,?,?,?)");
		$stmt->execute([$val,$doc,$p_id,$front2]);

		$stmt = null;

		$que= $this->db->prepare("SELECT * FROM patients WHERE id = ?");
			$que->execute([$p_id]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$name = $row->title." ".$row->surname." ".$row->middle_name." ".$row->first_name;
			$sex = $row->sex;
			$age = $row->age;
			$front = $row->front_desk;
			$que = null;

		//Notify Nurses
		$status = 0;

		$this->notify('Nurses',$p_id,'Admission Requested For: ','view_test?id=".$front."&n=".$name."&s=".$sex."&a=".$age."&pid=".$p_id."&did=".$doc."&');
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function update_admission_request($id,$stat){
		try {
		$stmt = $this->db->prepare("UPDATE admission_request SET status = ? WHERE admission_request_id = ?");
		$stmt->execute([$stat,$id]);
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function update_bed_stat($id,$stat){
		try {
		$stmt = $this->db->prepare("UPDATE beds SET status = ? WHERE id = ?");
		$stmt->execute([$stat,$id]);
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function update_ipd_bill($app_id,$ipd,$bed){
		try {
		$stmt = $this->db->prepare("SELECT charge FROM beds WHERE id = ?");
		$stmt->execute([$bed]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$charge = '-'.$row['charge'];
		$stmt = null;

		$stmt = $this->db->prepare("INSERT INTO `in-patients`(app_id,item,nature,to_pay,prepared_by,date_added) 
			VALUES (?,'Bed Charges',2,?,?,NOW())");
		$stmt->execute([$app_id,$charge,2]);
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function update_bed_bill($app_id){
		try {
		
		$stmt = $this->db->prepare("SELECT admin_date,bed_no,DATEDIFF(admin_date,admission_status_date) AS days,admission_status_id FROM ipd_patients WHERE appointment_id = ?");
		$stmt->execute([$app_id]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$first = $row['admin_date'];
		$days = abs($row['days']);
		$bed = $row['bed_no'];
		$stmt = null;

		$stmt = $this->db->prepare("SELECT charge FROM beds WHERE id = ?");
		$stmt->execute([$bed]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$charge = '-'.$row['charge'];
		$stmt = null;

		$amt = intval($days) * intval($charge);


		$stmt = $this->db->prepare("UPDATE `in-patients` SET to_pay = ?,date_added = NOW() WHERE app_id = ? AND item = 'Bed Charges'");
		$stmt->execute([$amt,$app_id]);
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function insert_cat($cat_name){
		try {
		$stmt = $this->db->prepare("INSERT INTO pharm_category(cat_name) 
		VALUES (?)");
		$stmt->execute([$cat_name]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function edit_cat($cat_name, $val){
		try {
		
		$stmt = $this->db->prepare("UPDATE pharm_category SET cat_name = ? WHERE id = ?");
			$stmt->execute([$cat_name, $val]);
			
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	
	public function process_prescription($val,$status,$quantity,$pharm,$doc){
		try {
		$this->db->beginTransaction();
		
		$stmt = $this->db->prepare("UPDATE prescription SET pres_status = ? WHERE prescription_id = ?");
		$stmt->execute([$status, $val]);
		
		$stmt = $this->db->prepare("UPDATE pharm_stock SET stock = ? WHERE id = ?" );
		$stmt->execute([$quantity,$pharm]);
		
		
		$this->db->commit();
			
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function insert_bed($bed,$type,$charge,$description,$val){
		try {
		$stmt = $this->db->prepare("INSERT INTO beds(bed,bed_type,charge,description,added_by,date_added) 
		VALUES (?,?,?,?,?,NOW())");
		$stmt->execute([$bed,$type,$charge,$description,$val]);
		
		$stmt = null;
		$success = '<div class="alert alert-success">
					Bed Added Successfully
				  </div>';
		echo $success;
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function insert_bed_type($bed,$val){
		try {
		$stmt = $this->db->prepare("INSERT INTO bed_types(name,added_by,date_added) 
		VALUES (?,?,NOW())");
		$stmt->execute([$bed,$val]);
		
		$stmt = null;
		$success = '<div class="alert alert-success">
					Bed Type Added Successfully
				  </div>';
		echo $success;
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function edit_bed($bed,$type,$charge,$description, $val){
		try {
		
		$stmt = $this->db->prepare("UPDATE beds SET bed = ?,bed_type = ?, charge = ?,description= ? WHERE id = ?");
		$stmt->execute([$bed,$type,$charge,$description, $val]);
		$stmt = null;
		$success = '<div class="alert alert-success">
					Bed Successfully Updated
				  </div>';
		echo $success;
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function edit_mbed($bed,$type,$charge,$description, $val){
		try {
		
		$stmt = $this->db->prepare("UPDATE morgue_beds SET name = ?,room = ?, charge = ?,description= ? WHERE id = ?");
		$stmt->execute([$bed,$type,$charge,$description, $val]);
		$stmt = null;
		$success = '<div class="alert alert-success">
					Bed Successfully Updated
				  </div>';
		echo $success;
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function insert_unit($unit_name){
		try {
		$stmt = $this->db->prepare("INSERT INTO pharm_units(unit_name) 
		VALUES (?)");
		$stmt->execute([$unit_name]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function edit_unit($unit_name, $val){
		try {
		
		$stmt = $this->db->prepare("UPDATE pharm_units SET unit_name = ? WHERE id = ?");
			$stmt->execute([$unit_name, $val]);
			
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function insert_cunit($unit_name){
		try {
		$stmt = $this->db->prepare("INSERT INTO caf_units(unit_name) 
		VALUES (?)");
		$stmt->execute([$unit_name]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function edit_cunit($unit_name, $val){
		try {
		
		$stmt = $this->db->prepare("UPDATE caf_units SET unit_name = ? WHERE id = ?");
			$stmt->execute([$unit_name, $val]);
			
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	//sum from daily expenses
	public function sum_where3($table, $col, $col2,$val1, $col3, $val2){
		$stmt = $this->db->prepare("SELECT SUM($col) AS totalAmt FROM $table WHERE $col2 = ? AND $col3 = ?");
		$stmt->execute([$val1, $val2]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row['totalAmt'];
		$stmt = null;
	}

	public function join_insales_and_account($value){
		try {
			$que= $this->db->prepare("SELECT * FROM accounts a left join in_sales b on a.order_id = b.sales_id WHERE a.order_id = ? AND a.item = 3 ORDER BY  a.id DESC");
			$que->execute([$value]);
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}

	public function insert_stock($name, $cat, $unit,$cost, $price, $stock){
		try {
		$stmt = $this->db->prepare("INSERT INTO pharm_stock(name, category, units,cost_price, price, stock) 
		VALUES (?,?,?,?,?,?)");
		$stmt->execute([$name, $cat, $unit,$cost, $price, $stock]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function insert_cstock($name,$manufactured,$exp,$unit,$cprice, $price,$quantity,$batch, $stock){
		try {
		$stmt = $this->db->prepare("INSERT INTO caf_stock(name,manufactured,expiring,units,cost_price, price,quantity,batch,Stock_number) 
		VALUES (?,?,?,?,?,?,?,?,?)");
		$stmt->execute([$name,$manufactured,$exp,$unit,$cprice, $price,$quantity,$batch, $stock]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	

	public function update_stock($qty, $status, $val,$staff){
		try {
		
		$stmt = $this->db->prepare("INSERT INTO pharm_stock1(qty,status,pharm_id,staff,date_added) VALUES(?,?,?,?,NOW())");
		$stmt->execute([$qty, $status, $val,$staff]);	
		$stmt = null;

		//get current quantity
		$que= $this->db->prepare("SELECT stock FROM pharm_stock WHERE id = ?");
		$que->execute([$val]);
		$row = $que->fetch(PDO::FETCH_OBJ);
		$stock = $row->stock;
		$que = null;

		$quantity = intval($stock) - intval($qty);
		
		$stmt = $this->db->prepare("UPDATE pharm_stock SET stock=? WHERE id = ?");
		$stmt->execute([$quantity, $val]);	
		$stmt = null;

		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function edit_stock1($name, $cat, $unit,$usage,$cost, $price, $val){
		try {
		
		$stmt = $this->db->prepare("UPDATE pharm_stock SET name = ?, category =?, units=?,s_usage = ?,cost_price = ?, price=? WHERE id = ?");
			$stmt->execute([$name, $cat, $unit,$usage,$cost, $price, $val]);
			
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function edit_stock2($price, $tname, $val){
		try {
		
		$stmt = $this->db->prepare("UPDATE pharm_stock SET $tname = ? WHERE id = ?");
			$stmt->execute([$price,$val]);
			
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function get_the_price($proName, $proQty){
		try {
			$que= $this->db->prepare("SELECT price, stock FROM pharm_stock WHERE name = ?");
			$que->execute([$proName]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			if($row){
				$price = $row->price;
				$stock = $row->stock;
			
				$que = null;
				
				$sign = 'Done';

				$stock_level = "";

				$low_stock = '<div class="alert alert-danger">This product is out of stock '.$stock.' left</div>';

				if($stock < $proQty){
					echo json_encode(array("value" => $sign, "error" => $low_stock));

				} else if($stock > $proQty){
					$minVal = "";
					echo json_encode(array("value" => $sign, "value2" => $price));
				}
			} else {
				$no = "no";
				echo json_encode(array("value" => $no));
			}
						
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 An error occurred
				  </div>: ' . $e->getMessage();
		}
	}

	public function send_acc($DataArr, $app_id, $p_id, $code){
		try {
			$data_count = count($DataArr);
			for ($i=0; $i<$data_count; $i++) {
				$name = htmlspecialchars(ucfirst($_POST['name'][$i]));
				$name = stripslashes(ucfirst($_POST['name'][$i]));
				$name = trim(ucfirst($_POST['name'][$i]));
					
				$qty = htmlspecialchars($_POST['qty'][$i]);
				$qty = stripslashes($_POST['qty'][$i]);
				$qty = trim($_POST['qty'][$i]);
					
				$intake = htmlspecialchars($_POST['intake'][$i]);
				$intake = stripslashes($_POST['intake'][$i]);
				$intake = trim($_POST['intake'][$i]);
					
				$duration = htmlspecialchars($_POST['duration'][$i]);
				$duration = stripslashes($_POST['duration'][$i]);
				$duration = trim($_POST['duration'][$i]);
				
				$price = htmlspecialchars($_POST['price'][$i]);
				$price = stripslashes($_POST['price'][$i]);
				$price = trim($_POST['price'][$i]);
					
				//lets do the maths
				$toTake = ($qty * $intake) * $duration;
				$priceToPay = $toTake * $price;
				
				//get card_type
				$que= $this->db->prepare("SELECT * FROM patients WHERE id = ?");
				$que->execute([$p_id]);
				$row = $que->fetch(PDO::FETCH_OBJ);
				$card_type = $row->card_type;
				$que = null;
			
							
				$date = date("Y-m-d");
				$stmt = $this->db->prepare("INSERT INTO accounts(item, patient_id, app_id, amount, to_pay, order_id, date_added, card_type) 
				VALUES (?,?,?,?,?,?,?,?)");
				$stmt->execute([$name, $p_id, $app_id, $price, $priceToPay, $code, $date, $card_type]);
				
				$type = 1;
				$stmt2 = $this->db->prepare("INSERT INTO payment(reference,patient_id,appointment_id,payment_type_id,amount) 
				VALUES (?,?,?,?,?)");
				$stmt2->execute([$code,$p_id,$app_id,$type,$priceToPay]);
				$stmt2 = null;
			}
			
			$stmt = null;
			echo json_encode(array("value" => "Done", "value2" => $priceToPay));
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	//Change order status
	public function change_status($status, $app_id, $patient_id, $order_id){		
		try {
			$stmt = $this->db->prepare("UPDATE accounts SET payment_status = ? WHERE order_id = ? ");
			$stmt->execute([$status,$order_id]);
			$stmt = null;

			$stmt = $this->db->prepare("UPDATE pharm_notifications SET status = ? WHERE appointment_id = ? AND patient_id = ?");
			$stmt->execute([$status,$app_id, $patient_id]);
			$stmt = null;

			//lets also update lab notification payent status
			$que= $this->db->prepare("SELECT appointment_id FROM lab_notifications WHERE appointment_id= ? LIMIT 1"); 
			$que->execute([$app_id]);
			$count = $que->rowCount();
			if($count == 1){
				$stmt = $this->db->prepare("UPDATE lab_notifications SET payment = ? WHERE appointment_id = ? AND patient_id = ?");
				$stmt->execute([$status,$app_id, $patient_id]);
				$stmt = null;
			}
			
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Payment status could not be updated
				  </div>: ' . $e->getMessage();
		}
	}

	public function process_payment_defer_all($val){		
		try {
			$stmt = $this->db->prepare("UPDATE payment SET payment_status = ? WHERE patient_id = ?"); 
			$stmt->execute([$val, $status]);
			$stmt = null;
			$stmt = $this->db->prepare("UPDATE accounts SET payment_status = ? WHERE patient_id = ?");
			$stmt->execute([$status, $val]);
			$stmt = null;
			$stmt = $this->db->prepare("UPDATE prescription SET status = ? WHERE patient_id = ?");
			$stmt->execute([$status, $val]);
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					Defer payment is unsuccessful!
				  </div>: ' . $e->getMessage();
		}
	}

	public function process_payment($val,$status,$amount){		
		try {
			$stmt = $this->db->prepare("UPDATE `payment` SET `payment_status` = $status WHERE `reference` LIKE '".$val."'"); 
			$stmt->execute([$status,$val]);
			$stmt = null;
			$stmt = $this->db->prepare("UPDATE `accounts` SET `payment_status` = $status, `amount` = $amount, `date_paid` = NOW() WHERE order_id LIKE '".$val."'");
			$stmt->execute([$status,$amount,$val]);
			$stmt = null;
			$stmt = $this->db->prepare("UPDATE `prescription` SET `status` = $status WHERE `reference` LIKE '".$val."'");
			$stmt->execute([$status,$val]);
			$stmt = null;

			$stmt = $this->db->prepare("UPDATE `physiotherapy_requests` SET `status` = $status WHERE `link_ref` LIKE '".$val."'");
			$stmt->execute([$status,$val]);
			$stmt = null;

			$que= $this->db->prepare("SELECT * FROM accounts WHERE order_id LIKE ?");
			$que->execute([$val]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$item = $row->item;
			$pid = $row->patient_id;
			$app = $row->app_id;
			$front_desk = $row->front_desk;
			$que = null;

			if ($item == 2) {
				$staff = "all_lab";
				$msg = "Proceed To Enter Test Result For: ";
				$goto = "view_test?id=".$val."&app=".$app."&";
			}elseif ($item == 3) {
				$staff = "pharm";
				$msg = "Proceed To Process Drugs For: ";
				$goto = "presc.php?pid=".$pid."&";
			}elseif ($item == 4) {
				$staff = "nurses";
				$msg = "Proceed To Process Admission For: ";
				$goto = "ipd?id=".$pid."&";
			}elseif ($item == 6) {
				$staff = "all_xray";
				$msg = "Proceed To Process Xray Scans For: ";
				$goto = "lab_results?id=".$app."&pid=".$pid."&ref=".$val."&";
				
			}elseif ($item == 7) {
				$staff = "all_physiotherapy";
				$msg = "Payment Made For Therapy By: ";
				$goto = "lab_results?id=".$front_desk."ref=".$app."&pid=".$pid."&ref=".$val."&";
			}
			$this->notify($staff,$pid,$msg,$goto);
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					Dispensing chart could not be updated
				  </div>: ' . $e->getMessage();
		}
	}

	public function move_to_hmo($pid,$tariff,$stat){		
		try {
			$stmt = $this->db->prepare("UPDATE `accounts` SET `HMO` = ?, `payment_status` = ? WHERE `patient_id` = ?"); 
			$stmt->execute([$tariff,$stat,$pid]);
			$stmt = null;

			$stmt = $this->db->prepare("UPDATE `prescription` SET `status` = ? WHERE `patient_id` = ?");
			$stmt->execute([$stat,$pid]);
			$stmt = null;

			$stmt = $this->db->prepare("UPDATE `physiotherapy_requests` SET `status` = ? WHERE `patient_id` = ?");
			$stmt->execute([$stat,$pid]);
			$stmt = null;

			if ($stat == 4) {
				$que= $this->db->prepare("SELECT * FROM accounts WHERE patient_id = ?");
			$que->execute([$pid]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$item = $row->item;
			$app = $row->app_id;
			$front_desk = $row->front_desk;
			$que = null;

			if ($item == 2) {
				$staff = "all_lab";
				$msg = "Proceed To Enter Test Result For: ";
				$goto = "view_test?id=".$val."&app=".$app."&";
			}elseif ($item == 3) {
				$staff = "pharm";
				$msg = "Proceed To Process Drugs For: ";
				$goto = "presc.php?pid=".$pid."&";
			}elseif ($item == 4) {
				$staff = "nurses";
				$msg = "Proceed To Process Admission For: ";
				$link = "ipd?id=".$pid."&";
			}elseif ($item == 6) {
				$staff = "all_xray";
				$msg = "Proceed To Process Xray Scans For: ";
				$goto = "lab_results?id=".$app."&pid=".$pid."&ref=".$val."&";
			}elseif ($item == 7) {
				$staff = "all_physiotherapy";
				$msg = "Payment Made For Therapy By: ";
				$goto = "lab_results?id=".$front_desk."ref=".$app."&pid=".$pid."&ref=".$val."&";
			}
			$this->notify($staff,$pid,$msg,$goto);
			}
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					could not sent to HMO
				  </div>: ' . $e->getMessage();
		}
	}

	public function process_payment3($val,$status,$amount,$id){		
		try {
			
			$stmt = $this->db->prepare("UPDATE `payment` SET `payment_status` = $status WHERE `reference` LIKE '".$val."'"); 
			$stmt->execute([$status,$val]);
			$stmt = null;
			$stmt = $this->db->prepare("UPDATE `accounts` SET `payment_status` = $status, `amount` = $amount, `date_paid` = NOW() WHERE id LIKE '".$id."'");
			$stmt->execute();
			$stmt = null;
			$stmt = $this->db->prepare("UPDATE `prescription` SET `status` = $status WHERE `reference` LIKE '".$val."'");
			$stmt->execute([$status,$val]);
			$stmt = null;

			$stmt = $this->db->prepare("UPDATE `physiotherapy_requests` SET `status` = $status WHERE `link_ref` LIKE '".$val."'");
			$stmt->execute([$status,$val]);
			$stmt = null;

			$que= $this->db->prepare("SELECT * FROM accounts WHERE order_id LIKE ?");
			$que->execute([$val]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$item = $row->item;
			$pid = $row->patient_id;
			$app = $row->app_id;
			$front_desk = $row->front_desk;
			$que = null;

			if ($item == 2) {
				$staff = "all_lab";
				$msg = "Proceed To Enter Test Result For: ";
				$goto = "view_test?id=".$val."&app=".$app."&";
			}elseif ($item == 3) {
				$staff = "pharm";
				$msg = "Proceed To Process Drugs For: ";
				$goto = "presc.php?pid=".$pid."&";
			}elseif ($item == 4) {
				$staff = "nurses";
				$msg = "Proceed To Process Admission For: ";
				$goto = "ipd?id=".$pid."&";
			}elseif ($item == 6) {
				$staff = "all_xray";
				$msg = "Proceed To Process Xray Scans For: ";
				$goto = "lab_results?id=".$app."&pid=".$pid."&ref=".$val."&";
			}elseif ($item == 7) {
				$staff = "all_physiotherapy";
				$msg = "Payment Made For Therapy By: ";
				$goto = "lab_results?id=".$front_desk."ref=".$app."&pid=".$pid."&ref=".$val."&";
			}
			$this->notify($staff,$pid,$msg,$goto);
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					Dispensing chart could not be updated
				  </div>: ' . $e->getMessage();
		}
	}

	public function process_payment_company($status,$comp_id){		
		try {
			$stmt = $this->db->prepare("UPDATE `company_bill` SET `status` = $status WHERE `company_id` = ".$comp_id.""); 
			$stmt->execute([$status,$comp_id]);
			$stmt = null;

			$que= $this->db->prepare("SELECT * FROM accounts WHERE  company_id = ?");
			$que->execute([$comp_id]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$item = $row->item;
			$pid = $row->patient_id;
			$app = $row->app_id;
			$front_desk = $row->front_desk;
			$val = $row->order_id;
			$que = null;

			if ($item == 2) {
				$staff = "all_lab";
				$msg = "Proceed To Enter Test Result For: ";
				$goto = "view_test?id=".$val."&app=".$app."&";
			}elseif ($item == 3) {
				$staff = "pharm";
				$msg = "Proceed To Process Drugs For: ";
				$goto = "presc.php?pid=".$pid."&";
			}elseif ($item == 4) {
				$staff = "nurses";
				$msg = "Proceed To Process Admission For: ";
				$goto = "ipd?id=".$pid."&";
			}elseif ($item == 6) {
				$staff = "all_xray";
				$msg = "Proceed To Process Xray Scans For: ";
				$goto = "lab_results?id=".$app."&pid=".$pid."&ref=".$val."&";
			}elseif ($item == 7) {
				$staff = "all_physiotherapy";
				$msg = "Payment Made For Therapy By: ";
				$goto = "lab_results?id=".$front_desk."ref=".$app."&pid=".$pid."&ref=".$val."&";
			}
			$this->notify($staff,$pid,$msg,$goto);
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					Dispensing chart could not be updated
				  </div>: ' . $e->getMessage();
		}
	}

	public function process_expMove($val,$user){		
		try {
			$que= $this->db->prepare("SELECT * FROM accounts WHERE id = ?");
			$que->execute([$val]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$da = $row->date_added;
			$tp = $row->to_pay;
			$amt = $row->amount;
			$code = $row->order_id;
			$item = $row->item;
			$crd = $row->card_type;
			$pid = $row->patient_id;
			$que = null;
			$qty = 1;

			if (intval($tp)-intval($amt) == 0) {
				$amount = intval($tp);
			}else{
				$amount = intval($tp)-intval($amt);
			}

			if ($item == 2) {
				$deep = Database::getInstance()->select_from_where_Like("patient_test","link_ref",$code);
				foreach ($deep as $lab) {
					$lname = Database::getInstance()->get_name_from_id("lab_test","lab_test","lab_test_id",$lab['lab_test_id']);
					$description .= $lname.", ";
				}
			}elseif ($item == 3) {
				$deep1 = Database::getInstance()->select_from_where_Like("in_sales","sales_id",$code);
				foreach ($deep1 as $dr) {
					$drug = Database::getInstance()->get_name_from_id("name","pharm_stock","id",$dr['description']);
					$description .= $drug.", ";
				}
			}elseif ($item == 4) {
				$description = "In Patients Bill";
			}elseif ($item == 5) {
				$description = $crd; 
			}elseif ($item == 6) {
				$deep2 = Database::getInstance()->select_from_where_Like("xray_requests","link",$code);
				foreach ($deep2 as $xray) {
					$xname = Database::getInstance()->get_name_from_id("name","xray","id",$xray['name']);
					$description .= $xname.", ";
				}
			}elseif ($item == 7) {
				$description = "Physiotherapy Session";
			}elseif ($item == 8) {
				$description = "Consultation";
			}elseif ($item == 9) {
				$description = "In Patients Bill";
			}elseif ($item == 11) {
				$description = "Immunization";
			}
			
			$pat = Database::getInstance()->select_from_where("patients","id",$pid);
			foreach ($pat as $value) {
				$patient = $value['surname']." ".$value['middle_name']." ".$value['first_name'];
			}

			$st = Database::getInstance()->select_from_where("staff","user_id",$user);
			foreach ($st as $value) {
				$staff = $value['last_name']." ".$value['other_names']." ".$value['first_name'];
			}

			if ($amt == 0) {
			 	$rem = 0;
			 	$rem1 = 0;
			 }else if ($amt > 0) {
			 	$rem = $amt;
			 	$rem1 = $amt; 
			 }
			$type = 2;
			$status = 6;
			$comment = "Automatic Expenditure";
			$stmt = $this->db->prepare("INSERT INTO daily_expense(type,code,description,approver,recipient,qty,amt,cash_bank,exp_date,comment,date_added) VALUES(?,?,?,?,?,?,?,'Cash',?,?,NOW())"); 
			$stmt->execute([$type,$code,$description,$staff,$patient,$qty,$rem,$da,$comment]);
			$stmt = null;

			$stmt = $this->db->prepare("UPDATE `payment` SET `payment_status` = ?  WHERE `reference` LIKE ?"); 
			$stmt->execute([$status,$code]);
			$stmt = null;
			$stmt = $this->db->prepare("UPDATE `accounts` SET `payment_status` = ?,`amount` = ?, `to_pay` = ?, `date_paid` = NOW() WHERE order_id LIKE ?");
			$stmt->execute([$status,$rem,$rem1,$code]);
			$stmt = null;
			$stmt = $this->db->prepare("UPDATE `prescription` SET `status` = ? WHERE `reference` LIKE ? ");
			$stmt->execute([$status,$code]);
			$stmt = null;

			$stmt = $this->db->prepare("UPDATE `physiotherapy_requests` SET `status` = ? WHERE `link_ref` LIKE ? ");
			$stmt->execute([$status,$code]);
			$stmt = null;

			//finish me pls
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					Account could not be updated
				  </div>: ' . $e->getMessage();
		}
	}


	public function process_cpayment($val,$pid){		
		try {
			$stmt = $this->db->prepare("UPDATE `payment` SET `payment_status` = '0' WHERE `patient_id` = ? AND `reference` LIKE '".$val."'"); 
			$stmt->execute([$pid,$val]);
			$stmt = null;
			$stmt = $this->db->prepare("UPDATE `accounts` SET `payment_status` = '0', `amount` = '0' WHERE `patient_id` = ? AND `order_id` LIKE '".$val."'");
			$stmt->execute([$pid,$val]);
			$stmt = null;
			$stmt = $this->db->prepare("UPDATE `prescription` SET `status` = '0' WHERE `patient_id` = ? AND `reference` LIKE '".$val."'");
			$stmt->execute([$pid,$val]);
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					Dispensing chart could not be updated
				  </div>: ' . $e->getMessage();
		}
	}

	public function send_test_acc($DataArr, $app_id, $p_id, $code){
		try {
			//get card_type
			$que= $this->db->prepare("SELECT * FROM patients WHERE id = ?");
			$que->execute([$p_id]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$card_type = $row->card_type;
			$que = null;
			
			$data_count = count($DataArr);
			for ($i=0; $i<$data_count; $i++) {
				$test = htmlspecialchars(ucfirst($_POST['test'][$i]));
				$test = stripslashes(ucfirst($_POST['test'][$i]));
				$test = trim(ucfirst($_POST['test'][$i]));
					
				$amt = htmlspecialchars($_POST['amt'][$i]);
				$amt = stripslashes($_POST['amt'][$i]);
				$amt = trim($_POST['amt'][$i]);
				
				$date = date("Y-m-d");
				$stmt = $this->db->prepare("INSERT INTO accounts(item, patient_id, app_id, to_pay, order_id, date_added, card_type) 
				VALUES (?,?,?,?,?,?,?)");
				$stmt->execute([$test, $p_id, $app_id, $amt, $code, $date, $card_type]);
			
			}
			$stmt = null;
			return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function insert_ipd_patient($admin_no, $referred, $doctor, $ward, $bed_num, $p_id, $code, $adr){
		try {
		$stat = 1;
		$que= $this->db->prepare("SELECT appointment_id FROM admission_request WHERE patient_id = ? ORDER BY admission_request_id DESC LIMIT 1");
		$que->execute([$p_id]);
		$row = $que->fetch(PDO::FETCH_OBJ);
		$app_id = $row->appointment_id;

		if (empty($app_id)) {
			return "<div class='alert alert-danger'> 
					Error: An Appointment Is Needed For This Patient
					</div>";
		}

		$que2= $this->db->prepare("SELECT front_desk FROM patients WHERE id = ?");
		$que2->execute([$p_id]);
		$row = $que2->fetch(PDO::FETCH_OBJ);
		$front2 = $row->front_desk;

		$stmt = $this->db->prepare("INSERT INTO ipd_patients(front_desk,appointment_id,patient_id, order_id, admin_no,admin_date,ref, doctor_id, ward, bed_no) 
		VALUES (?,?,?,?,?,NOW(),?,?,?,?)");
		$stmt->execute([$front2,$app_id,$p_id, $code, $admin_no, $referred, $doctor, $ward, $bed_num]);
		$last = $this->db->lastInsertId();
		if($adr != 0){
			$this->update_admission_request($adr,$stat);
			$this->update_bed_stat($bed_num,1);
			$this->update_ipd_bill($app_id,$last,$bed_num); 
		}
		$stmt = null;
		return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function insert_therapy_plan($val,$app,$p_id,$link,$comment){
		try {
		$stat = 1;
		$stmt = $this->db->prepare("INSERT INTO `therapy_plans` (`patient_id`, `link_ref`, `appointment_id`, `comment`, `doctor_id`, `time_added`)
		VALUES (?,?,?,?,?,NOW())");
		$stmt->execute([$p_id,$link,$app,$comment,$val]);
		$stmt = null;
		return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	public function insert_therapy_plan2($val,$app,$p_id,$link,$comment){
		try {
		$stat = 0;
		$stmt = $this->db->prepare("INSERT INTO `therapy_plans`(`patient_id`, `link_ref`, `appointment_id`, `front_desk`, `comment`, `doctor_id`, `time_added`)
		VALUES (?,?,?,?,?,?,NOW())");
		$stmt->execute([$p_id,$link,$stat,$app,$comment,$val]);
		$stmt = null;
		return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function edit_therapy_plan($val,$comment){
		try {
		$stmt = $this->db->prepare("UPDATE `therapy_plans` SET `comment` = '".$comment."' WHERE `id` = ".$val."");
		 
		$stmt->execute([$comment,$val]);
		$stmt = null;
		return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function edit_admission_status($status, $val){		
		try {
			$date = date("Y-m-d H:i:s");
			$stmt = $this->db->prepare("UPDATE ipd_patients SET admission_status_id = ?,admission_status_date = ? WHERE id = ?");
			$stmt->execute([$status, $date, $val]);
			$stmt = null;

			$que= $this->db->prepare("SELECT bed_no FROM ipd_patients WHERE id = ?");
			$que->execute([$val]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$bed = $row->bed_no;

			$stmt = $this->db->prepare("UPDATE beds SET status = 0 WHERE id = ?");
			$stmt->execute([$bed]);
			$stmt = null;
			$success = '<div class="alert alert-success">
						status updated
					</div>';
			echo $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					status could not be updated
				  </div>: ' . $e->getMessage();
		}
	}

	
	public function insert_admin_stock($stock, $quantity, $taken, $patient, $quantityLeft){
		try {
		$this->db->beginTransaction();
		$stmt = $this->db->prepare("INSERT INTO admin_stock(pharm_stock_id, quantity, taken_by,patient_id) 
		VALUES (?,?,?,?)");
		$stmt->execute([$stock, $quantity, $taken, $patient]);
		
		$stmt = $this->db->prepare("UPDATE pharm_stock SET stock = ? WHERE id = ?");
		$stmt->execute([$quantityLeft,$stock]);
		$this->db->commit();
		$stmt = null;
		
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function edit_ipd($admin_no, $referred, $doctor, $ward, $bed_num, $nurse, $dis_date, $id){		
		try {
			$stmt = $this->db->prepare("UPDATE ipd_patients SET admin_no = ?,ref=?, doctor_id=?, ward=?, bed_no=?, nurse=?, discharged=? WHERE admin_no = ?");
			$stmt->execute([$admin_no, $referred, $doctor, $ward, $bed_num, $nurse, $dis_date, $id]);
			$stmt = null;
			$success = '<div class="alert alert-success">
							Patient details updated
						</div>';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Patient details could not be updated
				  </div>: ' . $e->getMessage();
		}
	}

	public function insert_diagnosis($diagnosis,$complaint, $exam,$patients_note,$adm_note, $val){		
		try {
			$one = 1;
			$stmt = $this->db->prepare("UPDATE patient_appointment SET diagnosis = ?, complaint=?, examination=?, patients_note = ?,adm_note = ?, treated = ? WHERE id = ?");
			$stmt->execute([$diagnosis,$complaint,$exam,$patients_note,$adm_note, $one, $val]);
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Diagnosis could not be updated
				  </div>: ' . $e->getMessage();
		}
	}

	public function insert_obs($temp, $resr, $pulse, $bp, $intake, $output, $by, $ipd){
		try {
		$stmt = $this->db->prepare("INSERT INTO patient_obs(ipd_patient_id,temp, resr, pulse,bp,intake, output, done_by) 
		VALUES (?,?,?,?,?,?,?,?)");
		$stmt->execute([$ipd,$temp, $resr, $pulse, $bp, $intake, $output, $by]);
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					Observation could not be addded
				  </div>: ' . $e->getMessage();			
		}
	}

	public function process_deceased($name, $sex, $kname, $kaddress,$kphone,$krel,$room, $bed_num, $tag, $serial,$type,$id,$staff){
		try {
		$stmt = $this->db->prepare("INSERT INTO morgue_index( `type`,`fullname`, `sex`, `tag_number`, `serial_number`, `rel_name`, `rel_phone`, `rel_address`, `rel_rel`, `room`, `bed`, `added_by`, `date_added`) 
		VALUES (?,?,?,?,?,?,?,?,?,?,?,?,NOW())");
		$stmt->execute([$type,$name, $sex,$tag, $serial, $kname, $kphone,$kaddress,$krel,$room, $bed_num,$staff]);
		$stmt = null;

		$stmt = $this->db->prepare("UPDATE ipd_patients SET deceased_status = 1 WHERE id = ?");
			$stmt->execute([$id]);
			$stmt = null;

		$stmt = $this->db->prepare("UPDATE morgue_beds SET status = 1 WHERE id = ?");
		$stmt->execute([$bed_num]);
		$stmt = null;


		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					Processing Failed
				  </div>: ' . $e->getMessage();			
		}
	}

	public function insert_anteNote($dob,$duration,$weight,$cp,$cl,$puerperium,$death_age,$cod, $by, $id){
		try {
		$stmt = $this->db->prepare("INSERT INTO antenatal_note(dob,preg_duration,weight,complication_p,complication_l,puerperium,death_age,cause_of_death,added_by,antenatal_id,date_added) 
		VALUES (?,?,?,?,?,?,?,?,?,?,NOW())");
		$stmt->execute([$dob,$duration,$weight,$cp,$cl,$puerperium,$death_age,$cod, $by, $id]);
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					Note could not be addded
				  </div>: ' . $e->getMessage();			
		}
	}

	public function insert_anteRecord($ega,$sfh,$pres,$pos,$fh,$o,$u,$p,$w,$bp,$by,$id){
		try {
		$stmt = $this->db->prepare("INSERT INTO antenatal_record(ega,sfh,pres,pos,fh,o,u,p,w,bp,added_by,antenatal_id,date_added) 
		VALUES (?,?,?,?,?,?,?,?,?,?,?,?,NOW())");
		$stmt->execute([$ega,$sfh,$pres,$pos,$fh,$o,$u,$p,$w,$bp,$by,$id]);
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					Record could not be addded
				  </div>: ' . $e->getMessage();			
		}
	}

	public function insert_labour($surname,$fname,$par,$hn,$age,$nlc,$poh,$lmp,$edd,$ah,$onset,$h,$state,$mrh,$amni,$cont,$oxi,$condition,$fh,$type,$lie,$pres,$pos,$desc,$fhr,$vul,$vag,$cer,$pp,$os,$rup,$int,$ppo,$ip,$cap,$mould,$pap,$psc,$f,$is,$nurse){
		try {
		$stmt = $this->db->prepare("INSERT INTO `labour`(`surname`, `first_name`, `parity`, `hospital_number`, `age`, `living_children`, `past_obstetic_history`, `lmp`, `edd`, `antenatal_history`, `onset`, `hours`, `state`, `membrane_ruptured`, `amnitomy`, `contractions`, `oxytocics`, `condition`, `fundal_height`, `type`, `lie`, `presentation`, `position`, `descent`, `foetal_heart_rate`, `vulva`, `vagina`, `cervix`, `pp_state`, `os`, `ruptured`, `intact`, `ppo`, `in_position`, `caput`, `mould`, `pelvis_ap`, `pelvis_sacral_curve`, `forecast`, `ischial_spine`, `added_by`, `date_added`) 
		VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())");
		$stmt->execute([$surname,$fname,$par,$hn,$age,$nlc,$poh,$lmp,$edd,$ah,$onset,$h,$state,$mrh,$amni,$cont,$oxi,$condition,$fh,$type,$lie,$pres,$pos,$desc,$fhr,$vul,$vag,$cer,$pp,$os,$rup,$int,$ppo,$ip,$cap,$mould,$pap,$psc,$f,$is,$nurse]);
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					Record could not be addded
				  </div>: ' . $e->getMessage();			
		}
	}

	public function edit_labour($surname,$fname,$par,$hn,$age,$nlc,$poh,$lmp,$edd,$ah,$onset,$h,$state,$mrh,$amni,$cont,$oxi,$condition,$fh,$type,$lie,$pres,$pos,$desc,$fhr,$vul,$vag,$cer,$pp,$os,$rup,$int,$ppo,$ip,$cap,$mould,$pap,$psc,$f,$is,$val){
		try {
		$stmt = $this->db->prepare("UPDATE  `labour` SET `surname` =?, `first_name` = ?, `parity` = ?, `hospital_number` = ?, `age` = ?, `living_children` = ?, `past_obstetic_history` = ?, `lmp` = ?, `edd` = ?, `antenatal_history` = ?, `onset` = ?, `hours` = ?, `state` = ?, `membrane_ruptured` = ?, `amnitomy` = ?, `contractions` = ?, `oxytocics` = ?, `condition` = ?, `fundal_height` = ?, `type` = ?, `lie` = ?, `presentation` = ?, `position` = ?, `descent` = ?, `foetal_heart_rate` = ?, `vulva` = ?, `vagina` = ?, `cervix` = ?, `pp_state` = ?, `os` = ?, `ruptured` = ?, `intact` = ?, `ppo` = ?, `in_position` = ?, `caput` = ?, `mould` = ?, `pelvis_ap` = ?, `pelvis_sacral_curve` = ?, `forecast` = ?, `ischial_spine` = ? WHERE id  = ?");
		$stmt->execute([$surname,$fname,$par,$hn,$age,$nlc,$poh,$lmp,$edd,$ah,$onset,$h,$state,$mrh,$amni,$cont,$oxi,$condition,$fh,$type,$lie,$pres,$pos,$desc,$fhr,$vul,$vag,$cer,$pp,$os,$rup,$int,$ppo,$ip,$cap,$mould,$pap,$psc,$f,$is,$val]);
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					Record could not be addded
				  </div>: ' . $e->getMessage();			
		}
	}
	
	public function edit_obs($temp, $resr, $pulse, $bp, $intake, $output, $val){		
		try {
			$stmt = $this->db->prepare("UPDATE patient_obs SET temp = ?, resr = ?, pulse = ? ,bp = ? ,intake = ? , output = ? WHERE patient_obs_id = ?");
			$stmt->execute([$temp, $resr, $pulse, $bp, $intake, $output, $val]);
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					Observation could not be updated
				  </div>: ' . $e->getMessage();
		}
	}

	
	public function insert_dis($pharm, $dosage, $meth, $remark, $by, $ipd){
		try {
		$stmt = $this->db->prepare("INSERT INTO dispensing_chart(ipd_patient_id,pharm_stock_id, dosage, meth_administration,given_by,remark) 
		VALUES (?,?,?,?,?,?)");
		$stmt->execute([$ipd,$pharm, $dosage, $meth, $by, $remark]);
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					Dispensing chart could not be addded
				  </div>: ' . $e->getMessage();			
		}
	}
	
	public function edit_dis($pharm, $dosage, $meth, $remark, $val){		
		try {
			$stmt = $this->db->prepare("UPDATE dispensing_chart SET pharm_stock_id = ?, dosage = ?, meth_administration = ? ,remark = ? WHERE dispensing_chart_id = ?");
			$stmt->execute([$pharm, $dosage, $meth, $remark, $val]);
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					Dispensing chart could not be updated
				  </div>: ' . $e->getMessage();
		}
	}
	
	
	public function insert_fluid($nature, $oral, $rectal, $iv, $other1, $total1, $urine, $vomit, $tube, $other2, $total2, $balance, $chloride, $ipd){
		try {
		$stmt = $this->db->prepare("INSERT INTO patient_fluid(ipd_patient_id,nature, oral,rectal,iv,intake_other,intake_total,urine,vomit,tube,output_other,output_total,
									balance,chloride) 
		VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$stmt->execute([$ipd,$nature, $oral, $rectal, $iv, $other1, $total1, $urine, $vomit, $tube, $other2, $total2, $balance, $chloride]);
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					Fluid Chart could not be addded
				  </div>: ' . $e->getMessage();			
		}
	}
	
	public function edit_fluid($nature, $oral, $rectal, $iv, $other1, $total1, $urine, $vomit, $tube, $other2, $total2, $balance, $chloride, $val){		
		try {
			$stmt = $this->db->prepare("UPDATE patient_fluid SET nature = ?, oral = ?,rectal = ?,iv = ?,intake_other = ?,intake_total = ?,urine = ?,vomit = ?,tube = ?
			,output_other = ?,output_total = ?,balance = ?,chloride = ? WHERE patient_fluid_id = ?");
			$stmt->execute([$nature, $oral, $rectal, $iv, $other1, $total1, $urine, $vomit, $tube, $other2, $total2, $balance, $chloride, $val]);
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					Fluid Chart could not be updated
				  </div>: ' . $e->getMessage();
		}
	}
	
	public function insert_surgery($sur_name,$sur_date,$sur_time,$sur_remark, $patient, $doc){
		try {
		$app = $this->get_name_from_id('id','patient_appointment','id',$patient);
		$stmt = $this->db->prepare("INSERT INTO surgery_perm(surgery_name,surgery_date,surgery_time,surgery_remark,patient_id,added_by,appointment_id,date_added) 
		VALUES (?,?,?,?,?,?,?,NOW())");
		$stmt->execute([$sur_name,$sur_date,$sur_time,$sur_remark, $patient, $doc,$app]);
		$stmt = null;

		$this->notify('nurses',$patient,'Surgery Requested For: ','surgery.php?pid=".$patient."&id=".$app."&');
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					Surgery Agreement not sent	
				  </div>: ' . $e->getMessage();			
		}
	}

	public function insert_precheck_list($q1, $q2, $q3, $q4, $q5, $q6, $q7, $q8, $q9, $q10, $q11, $q12, $q13, $q14, $q15, $q16, $q17,$val,$doc, $p_id){
		try {
		$doctor = $this->get_name_from_id('added_by','surgery_perm','appointment_id',$val);
		$pat = $this->get_name_from_id('patient_id','surgery_perm','appointment_id',$val);
		$stmt = $this->db->prepare("INSERT INTO prechecklist(q1, q2, q3, q4, q5, q6, q7, q8, q9, q10, q11, q12, q13, q14, q15, q16, q17,appointment_id,staff,patient_id,date_added) 
		VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())");
		$stmt->execute([$q1, $q2, $q3, $q4, $q5, $q6, $q7, $q8, $q9, $q10, $q11, $q12, $q13, $q14, $q15, $q16, $q17,$val,$doc,$p_id]);
		$stmt = null;

		$this->notify($doctor,$p_id,'Operative Pre-Checklist Added For: ','surgery.php?pid=".$p_id."&id=".$val."&');

		$que = $this->db->prepare("UPDATE `surgery_perm` SET `prechecklist` = '1', `status` = '1' WHERE `appointment_id` = $val;");
		$que->execute();
		$que = null;


		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					Surgery Checklist not sent	
				  </div>: ' . $e->getMessage();			
		}
	}
	
	
	public function select_test(){
		try {
			$que= $this->db->prepare("SELECT * FROM patient_test_group a 
										left join patient_appointment b on a.patient_appointment_id = b.id 
										left join patients d on b.patient_id = d.id
										left join accounts e on a.link_ref = e.order_id
										ORDER BY a.patient_test_group_id DESC");
			$que->execute();
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}

	public function select_test2($pn=1){
		try {
			$startFrom = ($pn - 1) * $this->limit;
			$que= $this->db->prepare("SELECT * FROM patient_test_group a 
										left join patient_appointment b on a.patient_appointment_id = b.id 
										left join patients d on b.patient_id = d.id
										left join accounts e on a.link_ref = e.order_id
										ORDER BY a.patient_test_group_id DESC LIMIT $startFrom,$this->limit");
			$que->execute();
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}

public function select_blood_screening($pn=1){
		try {
			$startFrom = ($pn - 1) * $this->limit;
			$que= $this->db->prepare("SELECT * FROM blood_test_group GROUP BY link_ref ORDER BY blood_test_group_id DESC LIMIT $startFrom,$this->limit");
			$que->execute();
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}


	public function count_select_test(){
		try {
			$que= $this->db->prepare("SELECT * FROM patient_test_group a 
										left join patient_appointment b on a.patient_appointment_id = b.id 
										left join patients d on b.patient_id = d.id
										left join accounts e on a.link_ref = e.order_id
										ORDER BY a.patient_test_group_id DESC");
			$que->execute();
			$arr = ceil($que->rowCount() / $this->limit);

			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function count_select_blood_test(){
		try {
			$que= $this->db->prepare("SELECT * FROM blood_test_group 
										ORDER BY blood_test_group_id DESC");
			$que->execute();
			$arr = ceil($que->rowCount() / $this->limit);

			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function count_select_blood(){
		try {
			$que= $this->db->prepare("SELECT * FROM blood_test
										ORDER BY id DESC");
			$que->execute();
			$arr = ceil($que->rowCount() / $this->limit);

			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function select_test_front(){
		try {
			$que= $this->db->prepare("SELECT * FROM patient_test_group a 
										
										left join patients d on a.patient_id = d.id
										left join accounts e on a.link_ref = e.order_id
										ORDER BY a.patient_test_group_id DESC");
			$que->execute([]);
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}

	public function select_test_front2($pn=1){
		try {
			$startFrom = ($pn - 1) * $this->limit;
			$que= $this->db->prepare("SELECT * FROM patient_test_group a 
										
										left join patients d on a.patient_id = d.id
										left join accounts e on a.link_ref = e.order_id
										ORDER BY a.patient_test_group_id DESC LIMIT $startFrom,$this->limit");
			$que->execute();
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}
	
	public function count_select_test_front(){
		try {
			$que= $this->db->prepare("SELECT * FROM patient_test_group a 
										
										left join patients d on a.patient_id = d.id
										left join accounts e on a.link_ref = e.order_id WHERE doctor_id = 0
										ORDER BY a.patient_test_group_id DESC");
			$que->execute();
			$arr = ceil($que->rowCount() / $this->limit);

			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function select_presc2($pn=1){
		try {
			$startFrom = ($pn - 1) * $this->limit;
			$que= $this->db->prepare("SELECT reference,patient_id,MAX(prescription_id) FROM prescription GROUP BY patient_id ORDER BY MAX(prescription_id) DESC LIMIT $startFrom,$this->limit");
			$que->execute();
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}

	public function count_presc(){
		try {
			$que= $this->db->prepare("SELECT reference,patient_id,MAX(prescription_id) FROM prescription GROUP BY patient_id ORDER BY MAX(prescription_id) DESC");
			$que->execute();
			$arr = ceil($que->rowCount() / $this->limit);

			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function select_test_to($value){
		try {
			$que= $this->db->prepare("SELECT * FROM lab_test a 
										left join lab_test_type b on a.lab_test_type_id = b.lab_test_type_id
										WHERE a.lab_test_type_id =? ORDER BY b.lab_test_type ASC");
			$que->execute([$value]);
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}

	public function select_xray_to($value){
		try {
			$que= $this->db->prepare("SELECT * FROM xray a left join xray_types b on a.category = b.xray_cat_id WHERE a.category = ? ORDER BY  b.category ASC");
			$que->execute([$value]);
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}

	public function select_scan_to($value){
		try {
			$que= $this->db->prepare("SELECT * FROM scan a left join scan_types b on a.category = b.scan_cat_id WHERE a.category = ? ORDER BY  b.category ASC");
			$que->execute([$value]);
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}

	public function select_all_test($value){
		try {
			$que= $this->db->prepare("SELECT * FROM patient_test a 
										left join lab_test_type b on a.lab_test_type_id = b.lab_test_type_id
										Where a.link_ref =?  group by a.lab_test_type_id ORDER BY b.lab_test_type ASC");
			$que->execute([$value]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}

	public function select_view_blood_tests($value){
		try {
			$que= $this->db->prepare("SELECT * FROM blood_test WHERE link_ref LIKE '%".$value."%' ORDER BY id DESC");
			$que->execute([$value]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}

	public function select_view_tests($value){
		try {
			$que= $this->db->prepare("SELECT * FROM patient_test WHERE link_ref LIKE '%".$value."%' ORDER BY patient_test_id DESC");
			$que->execute([$value]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}
	
	public function select_view_xrays($value){
		try {
			$que= $this->db->prepare("SELECT * FROM xray_requests WHERE link LIKE '%".$value."%' ORDER BY id DESC");
			$que->execute([$value]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}

		public function select_view_scans($value){
		try {
			$que= $this->db->prepare("SELECT * FROM scan_requests WHERE link LIKE '%".$value."%' ORDER BY id DESC");
			$que->execute([$value]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}
	

	public function select_all_test3($value,$ref){
		try {
			$que= $this->db->prepare("SELECT * FROM patient_test a 
										left join lab_test b on a.lab_test_id = b.lab_test_id
										Where a.lab_test_type_id =? AND a.link_ref =? ORDER BY b.lab_test ASC");
			$que->execute([$value,$ref]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}
	
	public function select_all_test2($value,$ref){
		try {
			$que= $this->db->prepare("SELECT * FROM patient_test a 
										left join lab_test b on a.lab_test_id = b.lab_test_id 
										left join lab_test_type c on b.lab_test_type_id = c.lab_test_type_id
										Where c.lab_test_type_id =? AND a.link_ref =? ORDER BY b.lab_test ASC");
			$que->execute([$value,$ref]);
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}
	
	public function select_from_admin_stock(){
		try {
			$que= $this->db->prepare("SELECT * FROM admin_stock a 
										left join pharm_stock b on a.pharm_stock_id = b.id 
										left join patients c on a.patient_id = c.id
										ORDER BY a.admin_stock_id DESC");
			$que->execute([]);
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}

	public function select_from_obs($value){
		try {
			$que= $this->db->prepare("SELECT * FROM patient_obs a 
										left join staff b on a.done_by = b.user_id 
										where a.ipd_patient_id = ? ORDER BY a.patient_obs_id DESC");
			$que->execute([$value]);
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}

	//I am using this function with 2 cos I chnaged $id to $user_id
	public function count_from_where($table,$col,$user_id){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col= ?");
			$que->execute([$user_id]);
			$arr = $que->rowCount();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function count_from_where_and_like($table,$col,$user_id,$col2,$id){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col= ? AND $col2 LIKE ?");
			$que->execute([$user_id,$id]);
			$arr = $que->rowCount();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function count_from_where_like($table,$col,$user_id){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col LIKE ?");
			$que->execute([$user_id]);
			$arr = $que->rowCount();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	//I am using this function with 2 cos I chnaged $id to $user_id
	public function count_from_where_col1_col2($table,$col,$user_id,$col2,$id2){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col= ? AND $col2 = ?");
			$que->execute([$user_id,$id2]);
			$arr = $que->rowCount();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function count_from_where_col1_col2_and_like($table,$col,$user_id,$col2,$id2,$col3,$id3){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col= ? AND $col2 = ? AND $col3 LIKE ?");
			$que->execute([$user_id,$id2,$id3]);
			$arr = $que->rowCount();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	//I am using this function with 2 cos I chnaged $id to $user_id
	public function count_from_where2($table,$col,$val,$col2,$val2){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col= ? ORDER BY $col2 $val2");
			$que->execute([$val]);
			$arr = $que->rowCount();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function count_from_ord_pn($table,$col,$id2){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col =?");
			$que->execute([$id2]);
			$arr = ceil($que->rowCount() / $this->limit);
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	//I am using this function with 2 cos I chnaged $id to $user_id
	public function count_from_ord($table,$id,$ord){
		try {
			$que= $this->db->prepare("SELECT * FROM $table ORDER BY $id $ord LIMIT 1");
			$que->execute();
			$arr = $que->rowCount();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	//I am using this function with 2 cos I chnaged $id to $user_id
	public function count_from_ord3($table,$id,$ord){
		try {
			$que= $this->db->prepare("SELECT * FROM $table ORDER BY $id $ord");
			$que->execute();
			$arr = $que->rowCount();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	//I am using this function with 2 cos I chnaged $id to $user_id
	public function count_from_ord2($table,$id,$ord){
		try {
			$que= $this->db->prepare("SELECT * FROM $table ORDER BY $id $ord");
			$que->execute();
			$arr = ceil($que->rowCount() / $this->limit);
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function count_from_where3_ord2($table,$col,$col2,$col3,$whe,$id,$ord){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col LIKE ? OR $col2 LIKE ? OR $col3 LIKE ? ORDER BY $id $ord");
			$que->execute([$whe,$whe,$whe]);
			$arr = ceil($que->rowCount() / $this->limit);
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	//I am using this function with 2 cos I chnaged $id to $user_id
	public function count_from_ord2_group($table,$id,$id2,$ord){
		try {
			$que= $this->db->prepare("SELECT * FROM $table GROUP BY $id2 ORDER BY $id $ord");
			$que->execute();
			$arr = ceil($que->rowCount() / $this->limit);
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function count_from_where_ord2_group($table,$col,$val,$id,$id2,$ord){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col = ? GROUP BY $id ORDER BY $id2 $ord");
			$que->execute([$val]);
			$arr = ceil($que->rowCount() / $this->limit);
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function count_from_where_ord2_groupa($table,$col,$val,$id,$id2,$ord){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col = ? GROUP BY $id ORDER BY $id2 $ord");
			$que->execute([$val]);
			$arr = ceil($que->rowCount() / $this->limit);
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function select_from_returned(){
		try {
			$que= $this->db->prepare("SELECT b.id AS id2,a.sales_id,a.id AS id,b.payment_status,a.description,a.quantity
,a.date_added,a.amount FROM in_sales a left join accounts b  on a.sales_id = b.order_id ORDER BY a.date_added DESC");
			$que->execute();
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}

	public function select_from_creturned($pn = 1){
		try {
			$startFrom = ($pn - 1) * $this->limit;
			$que= $this->db->prepare("SELECT b.id AS id2,a.Sales_ID AS id,b.payment_status,a.Stock_Item,a.Sales_Quantity
,a.sales_date,a.Purchasing_Price,a.account_status,a.Sales_ID,a.Sales_Number FROM caf_sales_detail a left join caf_accounts b  on a.Sales_Number = b.order_id ORDER BY a.sales_date DESC LIMIT $startFrom,$this->limit");
			$que->execute();
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}

	public function count_from_creturned(){
		try {
			$que= $this->db->prepare("SELECT b.id AS id2,a.sales_id,a.Sales_Id AS id,b.payment_status,a.Stock_Item,a.Sales_Quantity
,a.sales_date,a.Purchasing_Price FROM caf_sales_detail a left join caf_accounts b  on a.Sales_Number = b.order_id ORDER BY a.sales_date DESC");
			$que->execute();
			$arr = ceil($que->rowCount() / $this->limit);
			return $arr;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}

	public function insert_sendtoAccount($value,$p_id,$opd,$app)
	{
		try {		
		if (empty($p_id)) {
			$name = $opd;
			$card = 0;
			$company = 0;
			$front_desk = "";
			$val = 0;
		}else{
			$name = $p_id;
			$card = $this->get_name_from_id('card_type','patients','id',$p_id);
			$company = $this->get_name_from_id('company_id','patients','id',$p_id);
			$front_desk = $this->get_name_from_id('front_desk','patients','id',$p_id);
			$val = $this->select_from_val_ord('patient_appointment','patient_id',$p_id,'id','DESC');
		}

		$que= $this->db->prepare("SELECT sales_id,type, SUM(amount) as amount, date_added, time_stamp FROM in_sales WHERE sales_id LIKE ?");
			$que->execute([$value]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$stock_id = $row->sales_id;
			$type = $row->type;
			$amount = $row->amount;
			$date_added = $row->date_added;
			$time_stamp = $row->time_stamp;
			$que = null;

		$stmt = $this->db->prepare("INSERT INTO accounts(front_desk,company_id, patient_id, card_type,order_id, item,to_pay, date_added, date_stamp) VALUES(?,?,?,?,?,?,?,?,?)")->execute([$front_desk,$company,$name,$card,$stock_id,$type,$amount,$date_added,$time_stamp]);			
		$stmt = null;
		$stmt = $this->db->prepare("UPDATE in_sales SET full_name = ? WHERE sales_id LIKE ?")->execute([$name,$value]);			
		$stmt = null;
		if ($app) {
			$stmt = $this->db->prepare("UPDATE prescription SET sales_id = ? WHERE appointment_id = ? ")->execute([$value,$app]);			
		$stmt = null;
		}

		return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();	
		}
	}
	public function select_from_prescription_all2($pid){
		try {
			$que= $this->db->prepare("SELECT *
			 FROM prescription a 
										left join staff b on a.doctor_id = b.user_id 
										left join pharm_stock c on a.pharm_stock_id = c.id
										WHERE a.patient_id = ?
										GROUP BY a.reference ORDER BY a.pdate_added DESC");
			$que->execute([$pid]);
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}

	public function get_distinct_name_from_id($tab,$col,$whe,$id){
		try{
			$que= $this->db->prepare("SELECT DISTINCT $tab FROM $col where $whe =?");
			$que->execute([$id]);
			$SingleVar = $que->fetchColumn();
			return $SingleVar;
			$que = null;			
		} catch(PDOException $e){
			echo 'Error: ' . $e->getMessage();
		}	
	}

	public function select_distinct_patients($doc){
		try {
			$que= $this->db->prepare("SELECT DISTINCT patient_id FROM `patient_appointment` WHERE doctor_id = ? ORDER BY `id` DESC");
			$que->execute([$doc]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function select_from_prescription_all1(){
		try {
			$que= $this->db->prepare("SELECT * FROM prescription a 
										left join staff b on a.doctor_id = b.user_id 
										left join pharm_stock c on a.pharm_stock_id = c.id
										 GROUP BY a.patient_id ORDER BY a.pdate_added DESC");
			$que->execute();
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}
	public function select_from_obs1($value){
		try {
			$que= $this->db->prepare("SELECT * FROM patient_obs a 
										where a.ipd_patient_id = ? ORDER BY a.patient_obs_id DESC");
			$que->execute([$value]);
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}
	public function select_from_physiotherapy_doc(){
		try {
			$que= $this->db->prepare("SELECT * FROM physiotherapy_requests a left join staff b on a.staff_id = b.user_id WHERE b.role_id = 5 ORDER BY a.physiotherapy_id DESC");
			$que->execute([$value]);
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}

	public function select_from_physiotherapy_front(){
		try {
			$que= $this->db->prepare("SELECT * FROM physiotherapy_requests a left join staff b on a.staff_id = b.user_id WHERE b.role_id = 2 OR b.role_id = 1 ORDER BY a.physiotherapy_id DESC");
			$que->execute([$value]);
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}
	
	public function select_from_dis($value){
		try {
			$que= $this->db->prepare("SELECT * FROM dispensing_chart a 
										left join staff b on a.given_by = b.user_id 
										left join pharm_stock c on a.pharm_stock_id = c.id 
										where a.ipd_patient_id = ? ORDER BY a.dispensing_chart_id DESC");
			$que->execute([$value]);
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}
	
	public function select_from_prescription($value){
		try {
			$que= $this->db->prepare("SELECT * FROM prescription a 
										left join staff b on a.doctor_id = b.user_id 
										left join pharm_stock c on a.pharm_stock_id = c.id
										where a.appointment_id = ? ORDER BY a.prescription_id DESC");
			$que->execute([$value]);
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}
	public function select_from_prescription_all(){
		try {
			$que= $this->db->prepare("SELECT * FROM prescription a 
										left join staff b on a.doctor_id = b.user_id 
										left join pharm_stock c on a.pharm_stock_id = c.id
										ORDER BY a.prescription_id DESC");
			$que->execute();
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}
	
	public function select_add_admission(){
		try {
			$que= $this->db->prepare("SELECT * FROM admission_request a 
										left join patient_appointment b on a.appointment_id = b.id 
										left join patients c on b.patient_id = c.id 
										ORDER BY a.admission_request_id DESC");
			$que->execute();
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}
	
	public function select_payment(){
		try {
			$que= $this->db->prepare("SELECT * FROM payment a 
										left join patients b on a.patient_id = b.id 
										left join payment_type c on a.payment_type_id = c.payment_type_id 
										ORDER BY a.payment_id DESC");
			$que->execute();
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}
	
	public function select_payment2(){
		try {
			$que= $this->db->prepare("SELECT * FROM accounts ORDER BY id DESC");
			$que->execute();
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}

		public function select_payment3(){
		try {
			$que= $this->db->prepare("SELECT * , SUM(to_pay), GROUP_CONCAT(item) FROM accounts GROUP BY patient_id DESC");
			$que->execute();
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}
	//I am using this function with 2 cos I chnaged $id to $user_id
	public function count_from_acc(){
		try {
			$que= $this->db->prepare("SELECT * , SUM(to_pay) as to_pay_sum,SUM(amount) as amount_sum,GROUP_CONCAT(payment_status), GROUP_CONCAT(item), GROUP_CONCAT(order_id),MAX(date_paid) FROM accounts GROUP BY patient_id ORDER BY MAX(date_added) DESC");
			$que->execute();
			$arr = ceil($que->rowCount() / $this->limit);
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function select_payment4($pn=1){
		try {
			$startFrom = ($pn - 1) * $this->limit;
			$que= $this->db->prepare("SELECT * , SUM(to_pay) as to_pay_sum,SUM(amount) as amount_sum,GROUP_CONCAT(payment_status), GROUP_CONCAT(item), GROUP_CONCAT(order_id),MAX(date_paid) FROM accounts GROUP BY patient_id ORDER BY MAX(date_added) DESC LIMIT $startFrom,$this->limit");
			$que->execute();
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}

	public function insert_card($name, $cost){
		try {
		$stmt = $this->db->prepare("INSERT INTO card_types(name, cost) 
		VALUES (?,?)");
		$stmt->execute([$name, $cost]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function insert_custom_result($res,$val){
		try {
		$stmt = $this->db->prepare("INSERT INTO custom_result(result, ref,date_added) 
		VALUES (?,?,NOW())");
		$stmt->execute([$res,$val]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function edit_card($name, $cost, $val){
		try {
			$stmt = $this->db->prepare("UPDATE card_types SET name = ?, cost=? WHERE id = ?");
			$stmt->execute([$name, $cost, $val]);
			$stmt = null;
			$success = 'Done';
			return $success;
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	
	public function insert_stat($morn, $bed, $v_bed, $t_pt, $adm, $disc, $delivery, $cs, $labour, $trans, $death, $comment){
		try {
		$stmt = $this->db->prepare("INSERT INTO duty_check(morn, bed, v_bed, t_pt, adm, disc, delivery, cs, labour, trans, death, comment) 
		VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
		$stmt->execute([$morn, $bed, $v_bed, $t_pt, $adm, $disc, $delivery, $cs, $labour, $trans, $death, $comment]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function edit_stat($morn, $bed, $v_bed, $t_pt, $adm, $disc, $delivery, $cs, $labour, $trans, $death, $comment, $val){
		try {
			$stmt = $this->db->prepare("UPDATE duty_check SET morn = ?, bed=?, v_bed=?, t_pt=?, adm=?, disc=?, delivery=?, cs=?, labour=?, trans=?, death=?, comment=? WHERE id = ?");
			$stmt->execute([$morn, $bed, $v_bed, $t_pt, $adm, $disc, $delivery, $cs, $labour, $trans, $death, $comment, $val]);
			$stmt = null;
			$success = 'Done';
			return $success;
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function insert_ante($name, $pos, $sex, $dob, $house_num, $town, $village, $ward, $state, $lga, $mother_name,$mother_phone,$father_name, $father_phone, $cg, $cg_phone,
		$DataArr, $weigh, $twin, $fed, $support, $underweight, $exta_care, $bnum1, $v1, $dg1, $dn1, $cm1,$bnum2, $v2, $dg2, $dn2, $cm2,
		$bnum3, $v3, $dg3, $dn3, $cm3,$bnum4, $v4, $dg4, $dn4, $cm4, $bnum5, $v5, $dg5, $dn5, $cm5, $bnum6, $v6, $dg6, $dn6, $cm6, $bnum7, $v7, $dg7, $dn7, $cm7,
		$bnum8, $v8, $dg8, $dn8, $cm8, $bnum9, $v9, $dg9, $dn9, $cm9, $bnum10, $v10, $dg10, $dn10, $cm10, $bnum11, $v11, $dg11, $dn11, $cm11,
		$bnum12, $v12, $dg12, $dn12, $cm12, $bnum13, $v13, $dg13, $dn13, $cm13, $bnum15, $v15, $dg15, $dn15, $cm15, $bnum16, $v16, $dg16, $dn16, $cm16,
		$bnum17, $v17, $dg17, $dn17, $cm17, $bnum18, $v18, $dg18, $dn18, $cm18, $bnum19, $v19, $dg19, $dn19, $cm19, $bnum20, $v20, $dg20, $dn20, $cm20,
		$bnum21, $v21, $dg21, $dn21, $cm21,$DataArr2){
		try {
		$stmt = $this->db->prepare("INSERT INTO antenatal(name, pos, sex, dob, house_num, town, village, ward, state, lga, mother_name, mother_phone,
		father_name, father_phone, cg, cg_phone,
		weight, twin, fed, support, underweight, extra_care, bnum1, v1, dg1, dn1, cm1,bnum2, v2, dg2, dn2, cm2,
		bnum3, v3, dg3, dn3, cm3,bnum4, v4, dg4, dn4, cm4, bnum5, v5, dg5, dn5, cm5, bnum6, v6, dg6, dn6, cm6, bnum7, v7, dg7, dn7, cm7,
		bnum8, v8, dg8, dn8, cm8, bnum9, v9, dg9, dn9, cm9, bnum10, v10, dg10, dn10, cm10, bnum11, v11, dg11, dn11, cm11,
		bnum12, v12, dg12, dn12, cm12, bnum13, v13, dg13, dn13, cm13, bnum15, v15, dg15, dn15, cm15, bnum16, v16, dg16, dn16, cm16,
		bnum17, v17, dg17, dn17, cm17, bnum18, v18, dg18, dn18, cm18, bnum19, v19, dg19, dn19, cm19, bnum20, v20, dg20, dn20, cm20,
		bnum21, v21, dg21, dn21, cm21) 
		
		VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
		?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
		?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
		?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
		?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
		?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$stmt->execute([$name, $pos, $sex, $dob, $house_num, $town, $village, $ward, $state, $lga, $mother_name,$mother_phone,$father_name, $father_phone, $cg, $cg_phone,
		$weigh, $twin, $fed, $support, $underweight, $exta_care, $bnum1, $v1, $dg1, $dn1, $cm1,$bnum2, $v2, $dg2, $dn2, $cm2,
		$bnum3, $v3, $dg3, $dn3, $cm3,$bnum4, $v4, $dg4, $dn4, $cm4, $bnum5, $v5, $dg5, $dn5, $cm5, $bnum6, $v6, $dg6, $dn6, $cm6, $bnum7, $v7, $dg7, $dn7, $cm7,
		$bnum8, $v8, $dg8, $dn8, $cm8, $bnum9, $v9, $dg9, $dn9, $cm9, $bnum10, $v10, $dg10, $dn10, $cm10, $bnum11, $v11, $dg11, $dn11, $cm11,
		$bnum12, $v12, $dg12, $dn12, $cm12, $bnum13, $v13, $dg13, $dn13, $cm13, $bnum15, $v15, $dg15, $dn15, $cm15, $bnum16, $v16, $dg16, $dn16, $cm16,
		$bnum17, $v17, $dg17, $dn17, $cm17, $bnum18, $v18, $dg18, $dn18, $cm18, $bnum19, $v19, $dg19, $dn19, $cm19, $bnum20, $v20, $dg20, $dn20, $cm20,
		$bnum21, $v21, $dg21, $dn21, $cm21]);
		
		$stmt = null;
		
		$last_id = $this->db->lastInsertId();
		$data_count = count($DataArr);
		for ($i=0; $i<$data_count; $i++) {
			$c_year = htmlspecialchars(ucfirst($_POST['c_year'][$i]));
			$c_year = stripslashes(ucfirst($_POST['c_year'][$i]));
			$c_year = trim(ucfirst($_POST['c_year'][$i]));
					
			$c_health = htmlspecialchars($_POST['c_health'][$i]);
			$c_health = stripslashes($_POST['c_health'][$i]);
			$c_health = trim($_POST['c_health'][$i]);
					
			$c_sex = htmlspecialchars($_POST['c_sex'][$i]);
			$c_sex = stripslashes($_POST['c_sex'][$i]);
			$c_sex = trim($_POST['c_sex'][$i]);
			
			$stmt = $this->db->prepare("INSERT INTO ante_other_children(c_year, c_health, c_sex, ante_id) 
			VALUES (?,?,?,?)");
					
			$stmt->execute(array($c_year, $c_health, $c_sex, $last_id));					
			$stmt = null;
		}
		
		$data_count = count($DataArr2);
		for ($i=0; $i<$data_count; $i++) {
			$d_year = htmlspecialchars(ucfirst($_POST['d_year'][$i]));
			$d_year = stripslashes(ucfirst($_POST['d_year'][$i]));
			$d_year = trim(ucfirst($_POST['d_year'][$i]));
					
			$complaint = htmlspecialchars($_POST['complaint'][$i]);
			$complaint = stripslashes($_POST['complaint'][$i]);
			$complaint = trim($_POST['complaint'][$i]);
					
			$types = htmlspecialchars($_POST['types'][$i]);
			$types = stripslashes($_POST['types'][$i]);
			$types = trim($_POST['types'][$i]);
			
			$manag = htmlspecialchars($_POST['manag'][$i]);
			$manag = stripslashes($_POST['manag'][$i]);
			$manag = trim($_POST['manag'][$i]);
			
			$stmt = $this->db->prepare("INSERT INTO extra_effects(d_year, complaint, types, manag, ante_id) 
			VALUES (?,?,?,?,?)");
					
			$stmt->execute(array($d_year, $complaint, $types, $manag, $last_id));					
			$stmt = null;
		}

		//right
		$que = $this->db->prepare("SELECT amount FROM charges WHERE id  = 1");
		$que->execute();
		$row = $que->fetch(PDO::FETCH_OBJ);
		$allfee = $row->amount;
		$que = null;

		$date = date("Y-m-d");
		$link = uniqid();
		$front = 0;
		$item = 11;
		$status = 0;
		$stmt = $this->db->prepare("INSERT INTO accounts(patient_id,front_desk,order_id,item,to_pay,payment_status, date_added)  
			VALUES (?,?,?,?,?,?,?)");
			$stmt->execute([$last_id,$front,$link,$item,$allfee,$status, $date]);
		$stmt = null;
			
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	
	public function edit_ante($name, $pos, $sex, $dob, $house_num, $town, $village, $ward, $state, $lga, $mother_name,$mother_phone,$father_name, $father_phone, $cg, $cg_phone,
		$DataArr, $weigh, $twin, $fed, $support, $underweight, $exta_care, $bnum1, $v1, $dg1, $dn1, $cm1,$bnum2, $v2, $dg2, $dn2, $cm2,
		$bnum3, $v3, $dg3, $dn3, $cm3,$bnum4, $v4, $dg4, $dn4, $cm4, $bnum5, $v5, $dg5, $dn5, $cm5, $bnum6, $v6, $dg6, $dn6, $cm6, $bnum7, $v7, $dg7, $dn7, $cm7,
		$bnum8, $v8, $dg8, $dn8, $cm8, $bnum9, $v9, $dg9, $dn9, $cm9, $bnum10, $v10, $dg10, $dn10, $cm10, $bnum11, $v11, $dg11, $dn11, $cm11,
		$bnum12, $v12, $dg12, $dn12, $cm12, $bnum13, $v13, $dg13, $dn13, $cm13, $bnum15, $v15, $dg15, $dn15, $cm15, $bnum16, $v16, $dg16, $dn16, $cm16,
		$bnum17, $v17, $dg17, $dn17, $cm17, $bnum18, $v18, $dg18, $dn18, $cm18, $bnum19, $v19, $dg19, $dn19, $cm19, $bnum20, $v20, $dg20, $dn20, $cm20,
		$bnum21, $v21, $dg21, $dn21, $cm21,$DataArr2, $val){
		
		try {
		$stmt = $this->db->prepare("UPDATE antenatal SET name= ?, pos= ?, sex= ?, dob= ?, house_num= ?, town= ?, village= ?, ward= ?, 
		state= ?, lga= ?, mother_name= ?, mother_phone= ?,father_name= ?, father_phone= ?, cg= ?, cg_phone= ?,
		weight= ?, twin= ?, fed= ?, support= ?, underweight= ?, extra_care= ?, bnum1= ?, v1= ?, dg1= ?, dn1= ?, cm1= ?,bnum2= ?, v2= ?, dg2= ?, dn2= ?, cm2= ?,
		bnum3= ?, v3= ?, dg3= ?, dn3= ?, cm3= ?,bnum4= ?, v4= ?, dg4= ?, dn4= ?, cm4= ?, bnum5= ?, v5= ?, dg5= ?, dn5= ?, cm5= ?, bnum6= ?, v6= ?, 
		dg6= ?, dn6= ?, cm6= ?, bnum7= ?, v7= ?, dg7= ?, dn7= ?, cm7= ?,
		bnum8= ?, v8= ?, dg8= ?, dn8= ?, cm8= ?, bnum9= ?, v9= ?, dg9= ?, dn9= ?, cm9= ?, bnum10= ?, v10= ?, dg10= ?, dn10= ?, cm10= ?, 
		bnum11= ?, v11= ?, dg11= ?, dn11= ?, cm11= ?,
		bnum12= ?, v12= ?, dg12= ?, dn12= ?, cm12= ?, bnum13= ?, v13= ?, dg13= ?, dn13= ?, cm13= ?, bnum15= ?, v15= ?, dg15= ?, dn15= ?, cm15= ?, 
		bnum16= ?, v16= ?, dg16= ?, dn16= ?, cm16= ?,
		bnum17= ?, v17= ?, dg17= ?, dn17= ?, cm17= ?, bnum18= ?, v18= ?, dg18= ?, dn18= ?, cm18= ?, bnum19= ?, v19= ?, dg19= ?, dn19= ?, 
		cm19= ?, bnum20= ?, v20= ?, dg20= ?, dn20= ?, cm20= ?,
		bnum21= ?, v21= ?, dg21= ?, dn21= ?, cm21= ?");
		$stmt->execute([$name, $pos, $sex, $dob, $house_num, $town, $village, $ward, $state, $lga, $mother_name,$mother_phone,$father_name, $father_phone, $cg, $cg_phone,
		$weigh, $twin, $fed, $support, $underweight, $exta_care, $bnum1, $v1, $dg1, $dn1, $cm1,$bnum2, $v2, $dg2, $dn2, $cm2,
		$bnum3, $v3, $dg3, $dn3, $cm3,$bnum4, $v4, $dg4, $dn4, $cm4, $bnum5, $v5, $dg5, $dn5, $cm5, $bnum6, $v6, $dg6, $dn6, $cm6, $bnum7, $v7, $dg7, $dn7, $cm7,
		$bnum8, $v8, $dg8, $dn8, $cm8, $bnum9, $v9, $dg9, $dn9, $cm9, $bnum10, $v10, $dg10, $dn10, $cm10, $bnum11, $v11, $dg11, $dn11, $cm11,
		$bnum12, $v12, $dg12, $dn12, $cm12, $bnum13, $v13, $dg13, $dn13, $cm13, $bnum15, $v15, $dg15, $dn15, $cm15, $bnum16, $v16, $dg16, $dn16, $cm16,
		$bnum17, $v17, $dg17, $dn17, $cm17, $bnum18, $v18, $dg18, $dn18, $cm18, $bnum19, $v19, $dg19, $dn19, $cm19, $bnum20, $v20, $dg20, $dn20, $cm20,
		$bnum21, $v21, $dg21, $dn21, $cm21]);
		
		$stmt = null;
		
		$last_id = $this->db->lastInsertId();
		$data_count = count($DataArr);
		for ($i=0; $i<$data_count; $i++) {
			$c_year = htmlspecialchars(ucfirst($_POST['c_year'][$i]));
			$c_year = stripslashes(ucfirst($_POST['c_year'][$i]));
			$c_year = trim(ucfirst($_POST['c_year'][$i]));
					
			$c_health = htmlspecialchars($_POST['c_health'][$i]);
			$c_health = stripslashes($_POST['c_health'][$i]);
			$c_health = trim($_POST['c_health'][$i]);
					
			$c_sex = htmlspecialchars($_POST['c_sex'][$i]);
			$c_sex = stripslashes($_POST['c_sex'][$i]);
			$c_sex = trim($_POST['c_sex'][$i]);
			
			$stmt = $this->db->prepare("UPDATE ante_other_children(c_year= ?, c_health= ?, c_sex= ?, ante_id= ?) 
			VALUES (?,?,?,?)");
					
			$stmt->execute(array($c_year, $c_health, $c_sex, $last_id));					
			$stmt = null;
		}
		
		$data_count = count($DataArr2);
		for ($i=0; $i<$data_count; $i++) {
			$d_year = htmlspecialchars(ucfirst($_POST['d_year'][$i]));
			$d_year = stripslashes(ucfirst($_POST['d_year'][$i]));
			$d_year = trim(ucfirst($_POST['d_year'][$i]));
					
			$complaint = htmlspecialchars($_POST['complaint'][$i]);
			$complaint = stripslashes($_POST['complaint'][$i]);
			$complaint = trim($_POST['complaint'][$i]);
					
			$types = htmlspecialchars($_POST['types'][$i]);
			$types = stripslashes($_POST['types'][$i]);
			$types = trim($_POST['types'][$i]);
			
			$manag = htmlspecialchars($_POST['manag'][$i]);
			$manag = stripslashes($_POST['manag'][$i]);
			$manag = trim($_POST['manag'][$i]);
			
			$stmt = $this->db->prepare("UPDATE extra_effects(d_year= ?, complaint= ?, types, manag= ?, ante_id= ?) 
			VALUES (?,?,?,?,?)");
					
			$stmt->execute(array($d_year, $complaint, $types, $manag, $last_id));					
			$stmt = null;
		}
			
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	} 	

	public function insert_tax($name,$percentage,$status,$user){
		try {
		$stmt = $this->db->prepare("INSERT INTO taxes(name,percentage,status,added_by,date_added) 
		VALUES (?,?,?,?,NOW())");
		$stmt->execute([$name,$percentage,$status,$user]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function edit_tax($name,$percentage,$status,$user,$val){
		try {
			$stmt = $this->db->prepare("UPDATE taxes SET name=?, percentage=?, status=?, added_by=? WHERE id = ?");
			$stmt->execute([$name,$percentage,$status,$user,$val]);
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function insert_expi($date_a, $code, $description, $approver, $recipient, $qty, $amt, $cash, $comment,$type){
		try {
		$stmt = $this->db->prepare("INSERT INTO daily_expense(exp_date, code, description, approver, recipient, qty, amt, cash_bank, comment,type) 
		VALUES (?,?,?,?,?,?,?,?,?,?);");
		$stmt->execute([$date_a, $code, $description, $approver, $recipient, $qty, $amt, $cash, $comment,$type]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function edit_income($date_a, $code, $description, $approver, $amt, $cash, $comment,$type,$id){
		try {
			session_start();
			$user = $_SESSION['userSession'];
		$stmt = $this->db->prepare("UPDATE other_income SET date_added = ?, code= ?, description = ?, approver = ?, amt = ?, cash_bank = ?, comment = ?,added_by = ?,type = ? WHERE id = ?");
		$stmt->execute([$date_a, $code, $description, $approver, $amt, $cash, $comment,$user,$type,$id]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function insert_income($date_a, $code, $description, $approver, $amt, $cash, $comment,$type){
		try {
			session_start();
			$user = $_SESSION['userSession'];
		$stmt = $this->db->prepare("INSERT INTO other_income(date_added, code, description, approver, amt, cash_bank, comment,added_by,type) 
		VALUES (?,?,?,?,?,?,?,?,?)");
		$stmt->execute([$date_a, $code, $description, $approver, $amt, $cash, $comment,$user,$type]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function insert_cost($date_a, $code, $description, $approver, $recipient, $qty, $amt, $cash, $comment,$type){
		try {
			session_start();
		$user = $_SESSION['userSession'];
		$stmt = $this->db->prepare("INSERT INTO costs(pdate, code, description, approver, recipient, quantity, amt, method, comment,added_by,date_added,type) 
		VALUES (?,?,?,?,?,?,?,?,?,?,NOW(),?)");
		$stmt->execute([$date_a, $code, $description, $approver, $recipient, $qty, $amt, $cash, $comment,$user,$type]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function edit_expi($date_a, $code, $description, $approver, $recipient, $qty, $amount, $cash, $comment, $val){
		try {
			$stmt = $this->db->prepare("UPDATE daily_expense SET exp_date=?, code=?, description=?, approver=?, recipient=?, qty=?, amt=?, cash_bank=?, comment=? WHERE id = ?");
			$stmt->execute([$date_a, $code, $description, $approver, $recipient, $qty, $amount, $cash, $comment, $val]);
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function edit_cost($date_a, $code, $description, $approver, $recipient, $qty, $amount, $cash, $comment, $val){
		try {
			session_start();
			$user = $_SESSION['userSession'];
			$stmt = $this->db->prepare("UPDATE costs SET pdate=?, code=?, description=?, approver=?, recipient=?, quantity=?, amt=?, method=?, comment=?,added_by=?,updated= NOW() WHERE id = ?");
			$stmt->execute([$date_a, $code, $description, $approver, $recipient, $qty, $amount, $cash, $comment,$user, $val]);
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	
	public function insert_c_bal($c_date, $description, $amt, $cash, $comment, $type){
		try {
		$stmt = $this->db->prepare("INSERT INTO credit_balance(c_date, particulars, amount, cash_bank, comment, bal_type) 
		VALUES (?,?,?,?,?,?)");
		$stmt->execute([$c_date, $description, $amt, $cash, $comment, $type]);
		
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function edit_c_bal($c_date, $description, $amt, $cash, $comment, $type, $val){
		try {
			$stmt = $this->db->prepare("UPDATE credit_balance SET c_date=?, particulars=?, amount=?, cash_bank=?, comment=?, bal_type=? WHERE id = ?");
			$stmt->execute([$c_date, $description, $amt, $cash, $comment, $type, $val]);
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function edit_charge($amt, $name, $val){
		try {
			$stmt = $this->db->prepare("UPDATE charges SET amount=?, name=? WHERE id = ?");
			$stmt->execute([$amt, $name, $val]);
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}

	public function month_date($from, $to, $val){		
		try{
			$stmt = $this->db->prepare("SELECT * FROM accounts WHERE date_added >= ? AND date_added < ? AND card_type = ?");
			$stmt->execute([$from, $to, $val]);
			$arr = $stmt->fetchAll();
			return $arr;
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			
			echo 'Error: ' . $e->getMessage();			
		}
	}	
	public function insert_lab_temp($DataArr,$name){
		try {
		$stmt = $this->db->prepare("INSERT INTO lab_temp_name(name) 
		VALUES (?)");
		$stmt->execute([$name]);
		$last_id = $this->db->lastInsertId();
		$stmt = null;
		
		$data_count = count($DataArr);
		for ($i=0; $i<$data_count; $i++) {
			
			$field = htmlspecialchars(lcfirst($_POST['fieldss'][$i]));
			$field = stripslashes(lcfirst($_POST['fieldss'][$i]));
			$field = trim(lcfirst($_POST['fieldss'][$i]));
			
			$field = str_replace(' ', '_', $field); // Replaces all spaces with hyphens.
   
			$field = preg_replace('/[^A-Za-z0-9\-]/', '_', $field); // Removes special chars.

			
			$stmt2 = $this->db->prepare("INSERT INTO lab_temps(temp_name, label_id) 
				VALUES (?,?)");
					
			$stmt2->execute(array($field, $last_id));					
			
		}
		$stmt2 = null;	
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function get_fields($temp){
		try {
			$que3= $this->db->prepare("SELECT name FROM lab_temp_name WHERE id = ?");
			$que3->execute([$temp]);
			$row = $que3->fetchAll();
			foreach ($row as $title):
			$que3 = null;
			$titlee = $title['name'];
			$title = str_replace('_', ' ', $titlee);?>
			<h3><?php ucwords($title);?></h3>
			
			<?php
			$stmt= $this->db->prepare("SELECT * FROM lab_temps WHERE label_id = ?");
			$stmt->execute([$temp]);
			$row=$stmt->fetchAll();
			
			
			foreach ($row as $dets) { 
    			$name = $dets['temp_name'];
    			$name = str_replace('_', ' ', $name);
				$name = ucwords($name);
    			?>
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label><?php echo $name;?></label>
									<input type="text" class="form-control" name="<?php echo strtolower($name);?>" placeholder="<?php echo $name;?>" >
								</div>
							</div>
						</div>
					</div>
		
		<?php	} 
			endforeach;	
		} catch (PDOException $e) {
			echo 'Error: ' . $e->getMessage();			
		}
	}
		
		
	public function change_admi_status($status, $app_id){		
		try {
			$stmt = $this->db->prepare("UPDATE admission_request SET status = ? WHERE appointment_id = ?");
			$stmt->execute([$status,$app_id]);
			$stmt = null;
			
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Status could not be updated
				  </div>: ' . $e->getMessage();
		}
	}
	
	
		public function change_prescription_status($status, $pre_id){		
		try {
			$stmt = $this->db->prepare("UPDATE prescription SET prescription_status = ? WHERE prescription_id = ?");
			$stmt->execute([$status, $pre_id]);
			$stmt = null;
			
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Status could not be updated
				  </div>: ' . $e->getMessage();
		}
	}
	
	
	
	
	
	public function insert_exam_request($val,$doc, $p_id){
		try {
		$que= $this->db->prepare("SELECT front_desk FROM patients WHERE id = ?");
		$que->execute([$p_id]);
		$row = $que->fetch(PDO::FETCH_OBJ);
		$front2 = $row->front_desk;
		
		$que = null;
		$stmt = $this->db->prepare("INSERT INTO exam_request(front_desk,appointment_id,doctor_id, patient_id) 
		VALUES (?,?,?,?)");
		$stmt->execute([$front2,$val,$doc, $p_id]);
		$stmt = null;
		return "Done";
		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function change_exam_status($status, $app_id){		
		try {
			$stmt = $this->db->prepare("UPDATE exam_request SET status = ? WHERE appointment_id = ?");
			$stmt->execute([$status,$app_id]);
			$stmt = null;
			
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Status could not be updated
				  </div>: ' . $e->getMessage();
		}
	}
	
	public function change_staff_status($status, $staff_id){		
		try {
			$stmt = $this->db->prepare("UPDATE staff SET status = ? WHERE user_id = ?");
			$stmt->execute([$status,$staff_id]);
			$stmt = null;
			
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Status could not be updated
				  </div>: ' . $e->getMessage();
		}
	}
	
	public function get_fields_edit($t_id){
		try {
	
			$stmt= $this->db->prepare("SELECT * FROM lab_temps WHERE label_id = ?");
			$stmt->execute([$t_id]);
			$row=$stmt->fetchAll();
			
			
			foreach ($row as $dets) { 
    			$name = $dets['temp_name'];
    			$tn_id = $dets['id'];
    			$name = str_replace('_', ' ', $name);
				$name = ucwords($name);
    			?>
					<div class="col-md-12">
						<form id="<?php echo $tn_id;?>">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										
										<p id="<?php echo $tn_id;?>"> <?php echo $name;?></p>
										<a href="edit_temp_choose?id=<?php echo $tn_id; ?>" style="margin-bottom:10px; background:#1eb902 ! important; border-color:#1eb902  !important;" class="btn btn-primary pull-left btn-flat btblack" id="addre">Edit</a>
										<a onclick="delf(<?php echo $tn_id; ?>,'<?php echo $name; ?>')" style="margin-bottom:10px;" class="btn btn-primary pull-left btn-flat btblack">Delete</a>
									</div>
								</div>
							</div>
									
						</form>
					</div>
					<script type="text/javascript">
						var s=jQuery .noConflict();
						function delf(ID,name){ 
							s.notify({
								icon: 'pe-7s-trash',
								message: "Are you sure you want to delete <b>"+name+"</b> from templates ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"
							},{
								type: 'danger',
								timer: 100000
							});
						}
						
						function delet(ID){ 
							var val = ID;
							document.getElementById("load").style.display = "block";
							s.ajax({
								type: 'post',
								url: '../func/del.php',
								data: "val=" + val +  '&ins=delTempp',
								success: function(data){
									document.getElementById("load").style.display = "block";
									if (data === 'Done') {
										console.log(data);
										location.reload();
									} else {
										jQuery('#get_det'+ID).html(data).show();
									}
								}
							});
						}
					</script>
		<?php	} 
				
		} catch (PDOException $e) {
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function edit_tempy($name, $val){		
		try {
			$stmt = $this->db->prepare("UPDATE lab_temps SET temp_name = ? WHERE id = ?");
			$stmt->execute([$name, $val]);
			$stmt = null;
			
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Status could not be updated
				  </div>: ' . $e->getMessage();
		}
	}
	
	public function add_fields($val, $DataArr){
		$data_count = count($DataArr);
		for ($i=0; $i<$data_count; $i++) {
			$fieldsst = htmlspecialchars(ucfirst($_POST['fieldsst'][$i]));
			$fieldsst = stripslashes(ucfirst($_POST['fieldsst'][$i]));
			$fieldsst = trim(ucfirst($_POST['fieldsst'][$i]));
			
			$stmt = $this->db->prepare("INSERT INTO lab_temps(temp_name, label_id) 
			VALUES (?,?)");
					
			$stmt->execute(array($fieldsst, $val));	
			return "Done";			
			$stmt = null;
		}
	}
	
	public function edit_tempa($temp_name, $val){		
		try {
			$stmt = $this->db->prepare("UPDATE lab_temp_name SET name = ? WHERE id = ?");
			$stmt->execute([$temp_name, $val]);
			$stmt = null;
			
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Status could not be updated
				  </div>: ' . $e->getMessage();
		}
	}
}	