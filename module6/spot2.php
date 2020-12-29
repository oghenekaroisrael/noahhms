<?php
session_start();
if(isset($_GET["q"])){
require_once("../inc/config.php");

	include_once '../inc/db.php';
$q = tclean($_GET["q"]);
$select = "SELECT Stock_number,name,id,tabs,packs,cartons,c_carton FROM pharm_stock WHERE name LIKE '$q%' OR Stock_number='$q' ORDER BY name desc LIMIT 30";

if($read = mysqli_query($con,$select)){
$num = mysqli_num_rows($read);
if($num > 0){
	$counter = 0;
	while($row = mysqli_fetch_array($read)){
			$counter++;
			$sn = $row["name"];
			$sid = $row["id"];
			$qua = ($row["tabs"]*$row["packs"]*$row["cartons"])+$row['c_carton'];
			?>
			<tr>
			<td class="text-center"><?php echo $counter;?></td>
			<td class="text-center"><?php echo $sn;?></td>
			<td class="text-center"><?php echo $qua;?></td>
			<td class="text-center"><input type="number" name="quant" placeholder="Quantity Taken" class="form-control"></td>
			<td class="text-center">
				<div class="row">
					<div class="col-lg-12">
						<select name="patient" class="form-control">
					<?php
						$userDetails = Database::getInstance()->select("patients");
						foreach($userDetails as $row):
						$c_id = $row['id'];
						$title = $row['title'];	
						$surname = $row['surname'];	
						$middle = $row['middle_name'];
						$first = $row['first_name'];
						$name = $title." ".$surname." ".$middle." ".$first;
						?>										
					<option value="<?php echo $c_id; ?>"><?php echo $name; ?></option>
				<?php endforeach; ?>
				</select>
					</div>
				</div>
			</td>
			<td class="text-center"><input type="text" name="staff" placeholder="Taken By" class="form-control"></td>
			</tr>
			<?php

			}
			?>
			<?php
}else{?>
<tr>
<td> <?php echo "No product found for $q"; ?>
</tr>
<?php }
}else{
?>
<tr>
<td> <?php echo "Failed to get product info!"; ?>
</tr>
<?php
}
}

?>
