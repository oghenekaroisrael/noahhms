<?php
session_start();
if(isset($_GET["q"]) AND isset($_GET['p'])){
require_once("../inc/config.php");
$q = tclean($_GET["q"]);
$p = tclean($_GET["p"]);
$select = "SELECT Stock_number,name,id,cartons FROM warehouse_stock WHERE name LIKE '$q%' OR Stock_number='$q' ORDER BY name desc LIMIT 30";

if($read = mysqli_query($con,$select)){
$num = mysqli_num_rows($read);
if($num > 0){
	?><table style="font-weight:10pt;" class="table table-bordered table-hover">
	<tr>
		<th>#</th>
		<th class="text-center">Stock Number</th>
		<th class="text-center">Drug Name</th>
		<th class="text-center">Quantity Available</th>
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
			
			$check_me = "SELECT a.quantity_needed as quant, b.cartons as avail FROM pharm_requests a left join warehouse_stock b on a.warehouse_stock_id = b.id WHERE a.request_id = ".$p." &&  a.status =0";
			if($query = mysqli_query($con,$check_me)){
				$num = mysqli_num_rows($query);
				//var_dump($num);
				$get = mysqli_fetch_assoc($query);
			if(empty($num)){				
			?>
			<tr>
			<td class="text-center"><?php echo $counter;?></td>
			<td class="text-center"><?php echo $catt;?></td>
			<td class="text-center"><?php echo $sn;?></td>
			<td class="text-center"><?php echo $qua;?></td>
			<td class="text-center">
			<button class="btn btn-success" onclick='alert("Prescription <?php echo $sn;?> Has Already Been Removed From Stock!");window.location="process_prescription.php?id=<?php echo $p; ?>";'><span class="glyphicon glyphicon-check"></span> Processed</button>
			</td>
			</tr>
			<?php
			}elseif($num > 0 AND intval($get['avail']) >= intval($get['quant'])){
			?>
			<tr>
			<td class="text-center"><?php echo $counter;?></td>
			<td class="text-center"><?php echo $catt;?></td>
			<td class="text-center"><?php echo $sn;?></td>
			<td class="text-center"><?php echo $qua;?></td>
			<td class="text-center">
			
			<button value="<?php echo $catt;?>" class="btn btn-info" onclick="window.location='process.php?id=<?php echo $p; ?>&s=<?php echo $catt; ?>';"><span class="fas fa-minus"></span> Remove From Stock</button>
			</td>
			</tr>
			<?php
			}elseif($num > 0 AND intval($get['quant']) < $get['avail']){				
			?> 
			<tr>
			<td class="text-center"><?php echo $counter;?></td>
			<td class="text-center"><?php echo $catt;?></td>
			<td class="text-center"><?php echo $sn;?></td>
			<td class="text-center"><?php echo $qua;?></td>
			<td class="text-center">
			<button class="btn btn-danger" onclick='alert("Prescription <?php echo $sn;?> Is Currently Out Of Stock!");window.location="process_prescription.php?id=<?php echo $p; ?>";'></span> Out Of Stock</button>
			</td>
			</tr>
			<?php
			}
				
			}else{
				
			echo "Failed to query db for count #counter with stock name <b>$sn</b>";
			}

			}
			?>
			</table>
			<?php
}else{
/*
echo "No product found for $q";
*/
}
}else{
echo "Failed to get product info!";
}
}

?>
