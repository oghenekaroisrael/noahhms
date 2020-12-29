<?php
session_start();
$id = $_GET['id'];
unset($_SESSION['req']);

// Include database class
	include_once '../inc/db.php';
?>
<html>
<head>
 <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<title>NOAH-Transaction printing</title>
<script src="../js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="../js/shortcut.js"></script>
<script type="text/javascript" src="../js/custom.js"></script>

<!-- Required scripts -->
<script type="text/javascript" src="../js/dependencies/rsvp-3.1.0.min.js"></script>
<script type="text/javascript" src="../js/dependencies/sha-256.min.js"></script>
<script type="text/javascript" src="../js/qz-tray.js"></script>

<!-- Page styling -->
<script type="text/javascript" src="../js/additional/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../js/additional/bootstrap.min.js"></script>
<button style="padding:8px;" onclick="parent.location='pos.php'">Go Back</button>
<br/>
<div style="margin-left:10pt;margin-right:10pt;color:purple"  id="content">

<?php
$select = database::getInstance()->select_from_where("hospital_info","id",2);
foreach ($select as $get) {
$name = $get["name"];
$addr = $get["address"];
$mobile = $get["phone"];
$email = $get["email"];
?>
<div style="color:purple">
	<h2 style="text-align:center;font-size:30pt;text-transform:uppercase;"><?php echo $name;?></h2>

<center>
<p><?php echo "<b><span class='fas fa-home'></span> Address:</b> ".$addr;?>;&nbsp;
<?php echo "<b><span class='fas fa-phone'></span> Mobile:</b> ".$mobile."; &nbsp;";?></p>
</center>
<p>
</p>
</div>
<?php } ?>

<table cellspacing="0px" border="1px"  style="font-size:10pt;color:purple;" cellpadding="10px">
<tr>
<td style="font-weight:bold;">Receipt No.</td>
<td style="font-weight:none;"><?php echo $id;?></td>
<td style="font-weight:bold;">Timestamp</td>
<td style="font-weight:none;"><?php 
$datetime = new DateTime('now',new DateTimeZone("Africa/Lagos"));
echo $datetime->format("Y-m-d h:i:s a");
?></td>
</tr>

<tr>
<td style="font-weight:bold;">Customer ID</td>
<td style="font-weight:none;"><?php echo $cus;?></td>
<td style="font-weight:bold;">Cashier</td>
<td style="font-weight:none;"><?php 
$userDetails = Database::getInstance()->select_from_where2('staff','user_id',$_SESSION["userSession"]);
                foreach($userDetails as $row):
                    echo $name = $row['last_name']." ".$row['first_name'];
                endforeach;  

?></td>
</tr>

</table>


<table class="table" width="100%" border="1px" cellpadding="10px" cellspacing="0px" style="margin-top:2%;color:purple;font-size:10pt;">
<tr style="text-transform:uppercase;" align="left">
<th>Item</th>
<th>Price</th>
<th>Qty</th>
<th>Total</th>
</tr>
<?php
$counter = 0;
$sub = 0;
$notarray = database::getInstance()->select_from_where_like("caf_sales_detail","Sales_Number",$id);
		foreach ($notarray as $row) {
			$counter++;
			$id2 = $row["Sales_ID"];
			$sn = database::getInstance()->get_name_from_id("name","caf_stock","id",$row["Stock_Item"]);
			$sq = $row["Sales_Quantity"];
			$sp = database::getInstance()->get_name_from_id("price","caf_stock","id",$row["Stock_Item"]);
			$sta = $row["Purchasing_Price"];
			$sub +=$sta;
			
			?>
			<tr>
			<td><?php echo strtoupper($sn);?></td>
			<td><?php echo "&#8358;".number_format($sp,2);?></td>
			<td><?php echo $sq;?></td>
			<td><?php echo "&#8358;".number_format($sta,2);?></td>
			</tr>
			<?php
}
?>
<tr align="left">
<th></th>
<th></th>
<th>Sub.</th>
<th>
<?php echo "&#8358;".number_format($sub,2); ?>
</th>
</tr>
<tr align="left">
<th></th>
<th></th>
<th>Vat(5% inclusive)</th>
<th>
</th>
</tr>
<tr align="left">
<th></th>
<th></th>
<th>Total</th>
<th>
<?php echo "&#8358;".number_format($sub,2); ?>
</th>
</tr>
<?php
echo "</table>";
$payment = database::getInstance()->select_from_where_like("caf_accounts","order_id",$id);
foreach ($payment as $row) {
	$cash = $row['cash'];
	$bank_used = $row['bank_used'];
	$pos = $row['pos'];
	$transfer = $row['transfer'];
	$change = $row['bchange'];
	$discount = $row['discount'];
	if ($cash > 0 && $pos == 0 && $transfer == 0) {
		$paytype = " Cash";
	}else if ($cash == 0 && $pos > 0 && $transfer == 0) {
		$paytype = " POS";
	}else if ($cash == 0 && $pos == 0 && $transfer > 0) {
		$paytype = "Transfer";
	}else if ($cash > 0 && $pos > 0 && $transfer == 0) {
		$paytype = "Cash & POS";
	}else if ($cash > 0 && $pos == 0 && $transfer > 0) {
		$paytype = "Cash & Transfer";
	}else if ($cash == 0 && $pos > 0 && $transfer > 0) {
		$paytype = "POS & Transfer";
	}else if ($cash > 0 && $pos > 0 && $transfer == 0) {
		$paytype = "POS & Cash";
	}else if ($cash > 0 && $pos == 0 && $transfer > 0) {
		$paytype = "Cash & Transfer";
	}else if ($cash > 0 && $pos > 0 && $transfer > 0) {
		$paytype = "Cash, Transfer And POS";
	}
}
?>
<p style="font-weight:bold;text-align:center;color:purple;">
Cash = <?php echo "&#8358;".number_format($cash,2);?> &nbsp;||&nbsp;
Pos = <?php echo "&#8358;".number_format($pos,2);?> &nbsp;||&nbsp;
Transfer = <?php echo "&#8358;".number_format($transfer,2);?> &nbsp;||&nbsp;
Amount Tendered = 
 &nbsp;||&nbsp;Change = <?php echo "&#8358;".number_format($change,2);?>
&nbsp;||&nbsp;Discount = <?php echo "&#8358;".number_format($discount,2);?>
<br/>
<font style="text-transform:uppercase;">
Payment Type =  <font style="color:green;"><?php echo strtoupper($paytype." Payment");?></font>&nbsp;
<?php
if($_GET["bpos"] == ""){
	
}else{
	?>||&nbsp;Bank Used =  <font style="color:green;"><?php echo strtoupper($_GET["bpos"]);?></font><?php
}
?>
</font>
<br/>
<b>Thank you.Please call again.</b><br>
<b>NOAH HMS By Horseman Technologies</b>
</p>


<script type="text/javascript">
qz.websocket.connect().then(function(){
return qz.printers.find("zebra")
}).then(function(printer){
	var config = qz.configs.create(printer,{ copies: <?php if(isset($_GET['copies']) && !empty($_GET['copies'])){echo $_GET['copies'];}else{echo 1;}?> });
	  var printData = [
          { type: 'raw', data: <?php include('write.php')?>}
        ];
		return qz.print(config,printData);
})
var code = '123456789';
//convenience method
var chr = function(n) { return String.fromCharCode(n); };
var barcode = '\x1D' + 'h' + chr(80) + //barcode height
'\x1D' + 'f' + chr(0) + //font for printed number
'\x1D' + 'k' + chr(69) + chr(code.length) + code + chr(0); //code39
        var esc_init = "\x1B" + "\x40"; // initialize printer
        var esc_p = "\x1B" + "\x70" + "\x30"; // open drawer
        var gs_cut = "\x1D" + "\x56" + "\x4E"; // cut paper
        var esc_a_l = "\x1B" + "\x61" + "\x30"; // align left
        var esc_a_c = "\x1B" + "\x61" + "\x31"; // align center
        var esc_a_r = "\x1B" + "\x61" + "\x32"; // align right
        var esc_double = "\x1B" + "\x21" + "\x31"; // heading
        var font_reset = "\x1B" + "\x21" + "\x02"; // styles off
        var esc_ul_on = "\x1B" + "\x2D" + "\x31"; // underline on
        var esc_bold_on = "\x1B" + "\x45" + "\x31"; // emphasis on
        var esc_bold_off = "\x1B" + "\x45" + "\x30"; // emphasis off
</script>


</div>
</body>
</html>
