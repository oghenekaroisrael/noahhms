<div class="container-fluid" id="Part_payment">
	<div class="container">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-center text-primary">
					Part Payment
				</h5>
				<button type="button" class="close" onclick="part_pay()">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="container">
				<div class="row" id="jumbotron-bg">
					<div class="col-lg-6 jumbotron text-center">
								<h4 style="color: #fff; font-family: calibri; font-weight: lighter; font-size: 48px;">To Pay</h4><p></p><br>
								<b>&#8358; <?php echo $tatp;?></b>
					</div>
					<div class="col-lg-6 jumbotron text-center">
								<h4  style="color: #fff; font-family: calibri; font-weight: lighter; font-size: 38px;">Balance</h4><p></p><br>
								<b>&#8358; 
									<span id="balance_val">
									<?php 
										if ($cps == 0) {
											echo $tatp - $bal;
										}elseif ($cps ==2 ) {
											echo $tatp - $bal;
										}
										else{
											echo "Fully Paid";
										}
									?>										
									</span>
								</b>
					</div>
				</div>
				<p></p>
				<div class="row" style="padding-bottom: 20px;">
					<div class="col-md-12">
						<form method="POST" action="update_part_pay.php?pid=<?php echo $pypat_id; ?>&id=<?php echo $_GET['row']; ?>&link=<?php echo $link; ?>">
							<input type="text" name="part_of_payment" class="form-control" placeholder="Enter Amount To Pay" style="width: 560px;"><br>
							<center><button style="position: relative;right: 600px; border:solid 1px #000;" type="submit" class="btn btn-success btn-lg right <?php if($cps == 1){ echo 'disabled';}else{echo'';} ?>">Make Payment</button></center>
						</form>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<div class="container-fluid" id="company_bill">
	<div class="container">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-primary">
					Company Billing
				</h5>
				<button type="button" class="close" onclick="company_bill()">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="container">
				<div class="row" id="jumbotron-bg2">
					<div class="col-md-12 jumbotron text-center">
						<form method="POST" action="../func/pay.php?val=<?php echo $_GET['pid']; ?>&ins=company_bill2&oid=<?php echo $comp_oid; ?>&amount=<?php echo $_GET['amount']; ?>">
						<select class="form-control" name="company">
							<option class="disabled" >Select Company</option>
														<?php
															$db = mysqli_connect("localhost","root","","noahhms");
															$sql = mysqli_query($db,"SELECT company_id FROM patients WHERE id = ".$comp_pid."");
															$get_comp_id = mysqli_fetch_assoc($sql);
															if ($get_comp_id['company_id'] == 0) {
																$sql_select = mysqli_query($db,"SELECT * FROM companies ORDER BY id DESC");

															foreach($sql_select as $ow):
																$ictd = $ow['id'];
																$namee = $ow['company_name'];	
															
																?>
																<option value="<?php echo $ictd;?>"><?php echo $namee;?></option>
																<?php endforeach; 
															}else{
																$get_pat = mysqli_query($db,"SELECT * FROM patients WHERE id = ".$comp_pid." LIMIT 1");
																$get_pat_it = mysqli_fetch_assoc($get_pat);
																$get_it = mysqli_query($db, "SELECT * FROM companies WHERE id = ".$get_pat_it['company_id']." LIMIT 1");
																$get_comp = mysqli_fetch_assoc($get_it);
																?>
																<option value="<?php echo $get_comp['id']; ?>" selected><?php echo $get_comp['company_name']; ?></option>
																<?php
															}
														?>
						</select><br>
						<input type="text" name="position" style="text-align: center;font-size: 18px;" class="form-control" placeholder="Position In Company">
				<p></p>
						
							<center style="margin-bottom: 15px;"><button type="submit" style="background-color: #fff;color: #17a2b8;border-color: #17a2b8;" class="btn btn-info btn-lg <?php if($cps == 1){ echo 'disabled';}else{echo'';} ?>">Send Bill</button></center>
						</form>
					</div>
				</div>
						
			</div>
		</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	function part_pay(){
			var x = document.getElementById("Part_payment");
			if (x.style.display === "none") {
				x.style.display = "block";
			}else{
				x.style.display = "none";
			}
		}
		function company_bill(){
			var x = document.getElementById("company_bill");
			if (x.style.display === "none") {
				x.style.display = "block";
			}else{
				x.style.display = "none";
			}
		}
</script>