<!DOCTYPE html>
<html lang="en">
	<?php include('head-part.php'); ?>
	<body id="page-top">
		<div id="wrapper">
			<?php include('sidebar.php'); ?>
			<?php 
				$edit_id	=	$_GET['edit_id'];
				if(!empty($edit_id)){
					$query 	=	$conn->query("SELECT * FROM `party` WHERE id = '$edit_id'");
					$record =	mysqli_fetch_assoc($query); 
					$head = "Edit";
				}else{
					$head = "Add";
				}
				
				
				if(isset($_POST['add_party'])){
					$name		=	$_POST['name'];
					$address	=	$_POST['address'];
					$gstin		=	$_POST['gstin'];
					$cpName		=	$_POST['cpName'];
					$cpNumber	=	$_POST['cpNumber'];
					$status	=	$_POST['status'];
				
					if($name!="" && $address!="" && $gstin!="" && $cpName!="" && $cpNumber!=""){
						if(!empty($edit_id)){
							$check = $conn->query("UPDATE `party` SET `name`='$name',`address`='$address',`gstin`='$gstin',`person_name`='$cpName',`person_number`='$cpNumber',`status` = '$status' WHERE `id` = '$edit_id'");
							
							$msg = "Updated";
						}else{
							$check = $conn->query("INSERT INTO `party`(`name`,`address`,`gstin`,`person_name`,`person_number`,`status`) VALUES ('$name','$address','$gstin','$cpName','$cpNumber','$status')");
							
							$msg = "Added";
						}
						
						$querystatus="success&&Party ".$msg." Successfully&&view-party.php";			
					}else{
						$querystatus="error&&Required Filed Missing&&#";			
					}
				}
			?>
			<div id="content-wrapper" class="d-flex flex-column">
				<div id="content">
					<?php include('topbar.php'); ?>
					<div class="container-fluid">
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary"><?=$head;?> Party</h6>
							</div>
							<div class="card-body">
								<form action="" method="post">
									<div class="row">
										<div class="col-12">
											<input type="text" name="name" value="<?=$record['name'];?>" class="form-control" placeholder="Party Name">
										</div>
										<div class="col-12 pt-3">
											<textarea name="address" rows="4" class="form-control" placeholder="Address"><?=$record['address'];?></textarea>
										</div>
										<div class="col-12 pt-3">
											<input type="text" name="gstin" value="<?=$record['gstin'];?>" class="form-control" placeholder="GSTIN">
										</div>
										<div class="col-12 pt-3">
											<input type="text" name="cpName" value="<?=$record['person_name'];?>" class="form-control" placeholder="Contact Person Name">
										</div>
										<div class="col-12 pt-3">
											<input type="text" name="cpNumber" value="<?=$record['person_number'];?>" class="form-control" placeholder="Contact Person Number">
										</div>
										<div class="col-12 pt-3">
											<?php 
												if($record['status']=='1'){
													$inSelect = 'Selected';
												}else{
													$aSelect = 'Selected';
												}
											?>
											<select name="status" class="form-control" required>
												<option value="">-- Select Status --</option>
												<option value="0" <?=$aSelect;?>>Active</option>
												<option value="1" <?=$inSelect;?>>Inactive</option>
											</select>
										</div>
									</div>
									<div class="pt-3 text-right"><button type="submit" name="add_party" class="btn btn-primary">Submit</button></div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php include('footer.php'); ?>
			</div>
		</div>
		<?php include('link-js.php'); ?>
	</body>
</html>