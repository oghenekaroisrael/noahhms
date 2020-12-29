<?php
session_start();
if(isset($_GET["q"]) AND isset($_GET['p'])){
require_once("../inc/config.php");
$q = tclean($_GET["q"]);
$p = tclean($_GET["p"]);
$select = "SELECT Stock_number,name,id,cartons FROM warehouse_stock WHERE name LIKE '$q%' ORDER BY name desc LIMIT 30";

if($read = mysqli_query($con,$select)){
$num = mysqli_num_rows($read);
if($num > 0){
	?>
	<table style="font-weight:10pt;" class="table table-bordered table-hover">
	<tr>
		<th>#</th>
		<th class="text-center">Drug Name</th>
		<th class="text-center">Quantity Needed (Cartons)</th>
		<th class="text-center">Action</th>
	</tr>
		<?php
	$counter = 0;
	while($row = mysqli_fetch_array($read)){
			$counter++;
			$sn = $row["name"];
			$catt = $row["Stock_number"];
			$sid = $row["id"];
			$qua = $row["cartons"];				
			?>
			<tr>
			<td class="text-center"><?php echo $counter;?></td>
			<td class="text-center"><?php echo $sn;?></td>
			<td class="text-center"><input type="number"  id="qty" name="quantity" class="form-control" required=""></td>
			<td class="text-center">
			
			<button class="btn btn-info" onclick="var y = parseInt(document.getElementById('qty').value); window.location='process_r.php?id=<?php echo $p; ?>&s=<?php echo $sid; ?>&quantity='+ y;">Request For Stock</button>
			</td>
			</tr>
			<?php

			}
			?>
			</table>
			<?php
}else{
?>
<tr>
	<td colspan="5"><center>No Item In Warehouse With The Name <?php echo $q; ?></center></td>
</tr>
<?php
}
}else{
?>
<tr>
	<td colspan="5"><center>Failed To Get Item Info Pls Contact Developer ?></center></td>
</tr>
<?php
}
}

?>
