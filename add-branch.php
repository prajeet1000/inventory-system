<!DOCTYPE html>
<html lang="en">
	<?php include('head-part.php'); ?>
	<?php 
		$edit_id	=	$_GET['edit_id'];
		if(!empty($edit_id)){
			$query 	=	$conn->query("SELECT * FROM `branch` WHERE id = '$edit_id'");
			$record =	mysqli_fetch_assoc($query); 
			$head = "Edit";
		}else{
			$head = "Add";
		}
		
		if(isset($_POST['add_branch'])){
			$name		=	$_POST['name'];
			$address	=	$_POST['address'];
			$status		=	$_POST['status'];
		
			if($name!="" && $address!=""){		
				if(!empty($edit_id)){
					$check = $conn->query("UPDATE `branch` SET `name`='$name', `address`='$address',`status`='$status' where `id` = '$edit_id'");
					$msg = "Updated";
				}else{
					$check = $conn->query("INSERT INTO `branch`(`name`, `address`,`status`) VALUES ('$name','$address','$status')");
					$msg = "Added";
				}	
				$querystatus="success&&Branch ".$msg." Successfully&&view-branch.php";			
			}else{
				$querystatus="error&&Required Filed Missing&&#";			
			}
		}
	?>
	<body id="page-top">
		<div id="wrapper">
			<?php include('sidebar.php'); ?>
			<div id="content-wrapper" class="d-flex flex-column">
				<div id="content">
					<?php include('topbar.php'); ?>
					<div class="container-fluid">
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary"><?=$head;?> Branch</h6>
							</div>
							<div class="card-body">
								<form action="" method="post">
									<div class="row">
										<div class="col">
											<input type="text" name="name" value="<?=$record['name'];?>" class="form-control" placeholder="Branch Name" required>
										</div>
									</div>
									<div class="row">
										<div class="col pt-3">
											<textarea name="address" rows="4" class="form-control" placeholder="Branch Address"required><?=$record['address'];?></textarea>
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
									<div class="pt-3 text-right"><button type="submit" name="add_branch" class="btn btn-primary">Submit</button></div>
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