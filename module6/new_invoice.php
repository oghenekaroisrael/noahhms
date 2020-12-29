<?php
	ob_start();
	session_start();
	$pageTitle = "New Invoice";
	// Include database class
	include_once '../inc/db.php';
	
	If(!isset($_SESSION['userSession'])){
		header("Location: ../index");
		exit;
	}
	elseif (isset($_SESSION['userSession'])){
		$user_id = $_SESSION['userSession'];
	}

if(!isset($_SESSION['invoices'])) {
        $_SESSION['invoices'] = "IN-".date('YmdHis');
        $invoice = $_SESSION['invoices'];
    }else{
        $invoice = $_SESSION['invoices'];
    }
	include_once '../inc/header-index.php'; //for addding header
?>
<!----Quantity dispense Calculation>  ---->

<script>
var a=jQuery .noConflict(); 
function myFunction() {
    
  var y = parseInt(document.getElementById("quantity").value);
  var z = parseInt(document.getElementById("price").value);
  var w = parseInt(document.getElementById("total").value);
 var x=y*z;
 



  document.getElementById("total").value = x;

}
</script>
<div class="wrapper" id="homesc">
<?php include_once 'inc/admin_header.php';?>
    <div class="main-panel">
 <?php include 'inc/main_header.php';?>
	
	  <!--  MAIN -->
        <div class="content">
            <div class="container-fluid">
	<?php if(isset($_GET['status']) AND $_GET['status'] == 'done') {
        ?>
           <div class="alert alert-success">Item Was Added Successfully!</div>
        <?php
    } ?>
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                           <div class="header">
                                <h4 class="title">Generate New Invoice</h4>
                            </div>

                                <form id="newSt">
                            <div class="content">
                                <div class="right">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                    <label>Destination</label>
                                                    <select class="form-control" id="name" name="destination" required>
                                                        <option value="">Select Destination</option>
                                                        <option value="4">Warehouse</option>
                                                        <option value="3">Pharmacy</option>
                                                        <option value="1">Lab</option>
                                                        <option value="2">Nurses Station</option>
                                                    </select>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content">
                                    <table class="table table-hovered">
                                        <tr>
                                            <td width="15%">
                                                <div class="form-group">
                                                    <label>Drug Name</label>
                                                    <select class="form-control" id="name" name="name">
                                                        <option value="">Choose Drug</option>
                                                        <?php
                                                            $userDetails = Database::getInstance()->select('warehouse_stock');
                                                            foreach($userDetails as $row):
                                                                $id = $row['id'];
                                                                $name = $row['name'];  
                                                        ?>
                                                        <option value="<?php echo $id;?>"><?php echo $name;?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label>Suppliers</label>
                                                    <select class="form-control" id="name" name="supplier">
                                                        <option value="">Supplier</option>
                                                        <?php
                                                            $userDetails = Database::getInstance()->select('pharm_suppliers');
                                                            foreach($userDetails as $row):
                                                                $id = $row['Supplier_ID'];
                                                                $name = $row['Supplier_Name'];  
                                                        ?>
                                                        <option value="<?php echo $id;?>"><?php echo $name;?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td width="11.1%">
                                                <div class="form-group">
                                                    <label>Batch</label>
                                                    <input type="text" class="form-control" name="batch" placeholder="Batch Number">
                                                </div>
                                            </td>
                                            <td width="11.1%">
                                                <div class="form-group">
                                                    <label>LOT</label>
                                                    <input type="text" class="form-control" name="lot" placeholder="LOT" >
                                                </div>
                                            </td>
                                            <td width="11.1%">
                                                <div class="form-group">
                                                    <label>Stock Unit Of Measurement</label>
                                                    <select class="form-control" id="unit" name="unit">
                                                        <option value="">Choose Unit</option>
                                                        <?php
                                                            $userDetails = Database::getInstance()->select('pharm_units');
                                                            foreach($userDetails as $row):
                                                                $id = $row['id'];
                                                                $name = $row['unit_name'];  
                                                        ?>
                                                        <option value="<?php echo $id;?>"><?php echo $name;?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td width="5%">
                                                <div class="form-group">
                                                    <label for="example-date-input" class="col-form-label">Expiring Date</label>
                                                    <input type="date" id="example-date-input" class="form-control" name="expiring" placeholder="Expiring Date" style="width: 150px;">
                                                </div>
                                            </td>
                                            <td width="8%">
                                                <div class="form-group">
                                                    <label>Quantity</label>
                                                    <input type="number" class="form-control" onkeyup="myFunction()" id="quantity" name="quantity" placeholder="Cartons Bought" >
                                                </div>
                                            </td>
                                            <td width="8%">
                                                <div class="form-group">
                                                    <label>Price</label>
                                                    <input type="text" class="form-control" onkeyup="myFunction()" id="price" name="price" placeholder="Price" >
                                                </div>
                                            </td>
                                            <td width="11.1%">
                                                 <div class="form-group">
                                                    <label>Total</label>
                                                    <input type="text" class="form-control" name="total" id="total" placeholder="Total" >
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Add Item</button>
									<button type="reset" class="btn btn-danger btn-fill pull-left">Clear</button>
                                    <div class="clearfix"></div>
                            </div>
                        </form>
						</div>
                    </div>
                 </div>

                 <div class="row">
                     <div class="col-lg-12">
                         <table class="table table-hovered">
                             <thead>
                                <th>#</th>
                                <th>Destination</th>
                                <th>Drug Name</th>
                                <th>Supplier</th>
                                <th>Batch</th>
                                <th>LOT</th>
                                <th>U O M</th>
                                <th>Expiring Date</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Remove</th>
                             </thead>
                             <tbody>
                                <?php 
                                    $count=1;
                                    $get_invoice = database::getInstance()->select_from_where2_some('invoices','invoice_id',$invoice,'prep_mode',0);
                                    foreach ($get_invoice as $invoice_data) {
                                        $drug = database::getInstance()->get_name_from_id('name','warehouse_stock','id',$invoice_data['drug']);
                                        $supp = database::getInstance()->get_name_from_id('Supplier_Name','pharm_suppliers','Supplier_ID',$invoice_data['supplier']);
                                        $batch = $invoice_data['batch'];
                                        $lot = $invoice_data['lot'];
                                        $unit = $invoice_data['unit'];
                                        $exp = $invoice_data['expiring'];
                                        $qty = $invoice_data['quantity'];
                                        $price = $invoice_data['price'];
                                        $total = $invoice_data['total'];
                                        $dest = $invoice_data['destination'];
                                        $inv_id = $invoice_data['id'];
                                        if ($dest == 1) {
                                            $destination = "Lab";
                                        }elseif ($dest ==2) {
                                            $destination = "Nurses Station";
                                        }elseif($dest ==3){
                                            $destination = "Pharmacy";
                                        }elseif ($dest == 4) {
                                            $destination = "Warehouse";
                                        }else{
                                            $destination = "No Destination Selected";
                                        }
                                        $tot += $total;
                                ?>
                                 <tr>
                                    <td><?php echo $count++; ?></td>
                                    <td><?php echo $destination; ?></td>
                                     <td><?php echo $drug; ?></td>
                                     <td><?php echo $supp; ?></td>
                                     <td><?php echo $batch; ?></td>
                                     <td><?php echo $lot; ?></td>
                                     <td><?php echo $unit; ?></td>  
                                     <td><?php echo $exp; ?></td>
                                     <td><?php echo $qty; ?></td>  
                                     <td><?php echo $price; ?></td>
                                     <td><?php echo $total ?></td>
                                     <td>
                                         <a id="sale_delete" class="btn btn-danger text-center" onclick="del(<?php echo $inv_id; ?>,`<?php echo $drug; ?>`)"><i class="fas fa-trash-o"></i></a>
                                     </td>
                                 </tr>
                                 <?php 
                                    }?>
                                    <tr>
                                        <td colspan="10"></td>
                                        <td colspan="2"><b class="title h4">&#8358;<?php echo $tot; ?>.00</b></td>
                                    </tr>
                             </tbody>
                         </table>
                         <a onclick="genre(`<?php echo $invoice; ?>`)" class="btn btn-success btn-fill pull-right">Generate Invoice</a>
                         <a onclick="del_all(`<?php echo $invoice; ?>`)" id="sale_delete" class="btn btn-danger btn-fill pull-left">Clear All Items</a>
                                    <div class="clearfix"></div>
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

<script type="text/javascript">
	var a=jQuery .noConflict();	
    function suc(){ 

            a.notify({
                icon: 'pe-7s-check',
                message: "Item Has Been Added Successfully"

            },{
                type: 'success',
                timer: 3000
            });

        }		
	a(function () {
		a('#newSt').on('submit', function (e) {
			e.preventDefault();
			document.getElementById("load").style.display = "block";
			a.ajax({
				type: "POST",
				data: a('#newSt').serialize() + '&ins=newInvoice' + "&staff=" + <?php echo $user_id; ?> + '&invoice=' + '<?php echo $invoice; ?>',
				url: "../func/verify.php",
				success: function(res) {
					if (res == 'Done') {
                        document.getElementById("load").style.display = "none";
                        console.log(res);
                        window.location = "new_invoice.php?status=done";
                }else{                    
                    a("#get_result").html(res).fadeIn("slow");
                }
				}
			});
        });
        
    });
    function del(ID,name){ 

            a.notify({
                icon: 'pe-7s-trash',
                message: "Are you sure you want to delete <b>"+name+"</b> from This List ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

            },{
                type: 'danger',
                timer: 100000
            });

        }
        
        function delet(ID){ 
        var val = ID;
         document.getElementById("load").style.display = "block";
          a.ajax({
            type: 'post',
            url: '../func/del.php',
            data: "val=" + val +  '&ins=delInvoice_item',
             success: function(data)
            {
                document.getElementById("load").style.display = "block";
                if (data === 'Done') {
                    console.log(data);
                        window.location = 'new_invoice';
                  }
                  else {                       
                        jQuery('#get_det'+ID).html(data).show();
                  }
            }
          });
        }
function suc(){ 

            a.notify({
                icon: 'pe-7s-check',
                message: "Item Has Been Added Successfully"

            },{
                type: 'success',
                timer: 3000
            });

        }
function genre(ID){ 
        var val = ID;
         document.getElementById("load").style.display = "block";
          a.ajax({
            type: 'post',
            url: '../func/edit.php',
            data: "val=" + val + '&ins=processInvoice',
             success: function(data)
            {
                document.getElementById("load").style.display = "block";
                if (data === 'Done') {
                    console.log(data);
                        window.location = 'reciept.php?status=done1';
                        <?php unset($_SESSION['invoices']); ?>
                  }
                  else {
                        jQuery('#get_det'+ID).html(data).show();
                  }
            }
          });
        }

 function del_all(ID){ 

            a.notify({
                icon: 'pe-7s-trash',
                message: "Are you sure you want to delete All Items from This List ? </br><button type='button' class='btn pop-btn' onclick='delet_all(`"+ID+"`)'>Delete</button>"

            },{
                type: 'danger',
                timer: 100000
            });

        }
        
        function delet_all(ID){ 
        var val = ID;
         document.getElementById("load").style.display = "block";
          a.ajax({
            type: 'post',
            url: '../func/del.php',
            data: "val=" + val +  '&ins=delInvoice_all',
             success: function(data)
            {
                document.getElementById("load").style.display = "block";
                if (data === 'Done') {
                    console.log(data);
                        window.location = 'new_invoice';
                        <?php $_SESSION['invoices'] =  $_SESSION['invoices']; ?>
                  }
                  else {
                        <?php $_SESSION['invoices'] =  $_SESSION['invoices']; ?>
                        jQuery('#get_det'+ID).html(data).show();
                  }
            }
          });
        }
</script>

