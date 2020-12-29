<?php
session_start();
if(isset($_GET["q"]) AND isset($_GET['p'])){
require_once("../inc/config.php");
$q = tclean($_GET["q"]);
$p = tclean($_GET["p"]);
$select = "SELECT Stock_number,name,id,quantity FROM caf_stock WHERE name LIKE '$q%' OR Stock_number='$q'  ORDER BY name desc LIMIT 30";
if($read = mysqli_query($con,$select)){
$num = mysqli_num_rows($read);
if($num > 0){
	?><table style="font-weight:10pt;" class="table table-bordered table-hover">
	<tr>
		<th>#</th>
		<th class="text-center">Stock Number</th>
		<th class="text-center">Name</th>
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
			if($num > 0){
			?>
			<tr>
			<td class="text-center"><?php echo $counter;?></td>
			<td class="text-center"><?php echo $catt;?></td>
			<td class="text-center"><?php echo $sn;?></td>
			<td class="text-center"><input type="number"  id="qty" name="quantity" class="form-control" required=""></td>
			<td class="text-center">
			
			<button value="<?php echo $catt;?>" class="btn btn-info" onclick="var y = parseInt(document.getElementById('qty').value);window.location='process.php?id=<?php echo $p; ?>&s=<?php echo $sid; ?>&quantity='+ y;"> Add Item</button>
			</td>
			</tr>
			<?php
			}else{
				echo "no";
				
			}
			?>
			<?php
			}
}else{

echo "<center>No product found for $q</center>";
}
}else{
echo "<center>Failed to get product info!</center>";
}
}
?>

			</table>