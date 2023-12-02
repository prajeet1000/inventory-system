<!DOCTYPE html>
<html lang="en">
	<?php include('head-part.php'); ?>
	<?php 
		$edit_id	=	$_GET['edit_id'];
		if(!empty($edit_id)){
			$query 	=	$conn->query("SELECT * FROM `users` WHERE id = '$edit_id'");
			$record =	mysqli_fetch_assoc($query); 
			$head = "Edit";
		}else{
			$head = "Add";
		}
		
		if(isset($_POST['add_user'])){
			$name		=	$_POST['name'];
			$mobile		=	$_POST['mobile'];
			$branch		=	json_encode($_POST['branch']);
			$password	=	$_POST['password'];
			
			if($name!="" && $mobile!=""){
				if(!empty($password)){
					$newPass = md5($password);
				}else{
					$newPass = md5(12345678);
				}
				
				if(!empty($edit_id)){
					$check = $conn->query("UPDATE `users` SET `name`='$name', `mobile`='$mobile', `branch`='$branch', `password`='$newPass',`status`='$status' where `id` = '$edit_id'");
					
					$msg = "Updated";
				}else{
					$check = $conn->query("INSERT INTO `users`(`name`, `mobile`, `branch`, `password`,`status`) VALUES ('$name','$mobile','$branch','$newPass','$status')");
					
					$msg = "Added";
				}
				
				$querystatus="success&&User ".$msg." Successfully&&view-user.php";			
				
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
								<h6 class="m-0 font-weight-bold text-primary"><?=$head;?> User</h6>
							</div>
							<div class="card-body">
								<form action="" method="post">
									<div class="row">
										<div class="col-12">
											<input type="text" name="name" value="<?=$record['name'];?>" class="form-control" placeholder="Name">
										</div>
										<div class="col-12 pt-3">
											<input type="text" name="mobile" value="<?=$record['mobile'];?>" class="form-control" placeholder="Mobile">
										</div>
										<div class="col-12 pt-3">
											<select name="branch[]" class="form-control select2" multiple="multiple">
												<option value="">-- Select Branch</option>
												<?php 
													$query = $conn->query("SELECT * FROM `branch` where status = '0'");
													while($fetch=mysqli_fetch_array($query)){
												?>
												<option value="<?=$fetch['id'];?>" <?php if( !empty($record['branch']) && in_array($fetch['id'],json_decode($record['branch']))){ echo "selected";} ?>><?=$fetch['name'];?></option>
												<?php } ?>
											</select>
										</div>
										<?php if(empty($edit_id)){	?>
										<div class="col-12 pt-3">
											<input type="password" name="password" value="" class="form-control" placeholder="Password">
										</div>
										<?php } ?>
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
									<div class="pt-3 text-right"><button type="submit" name="add_user" class="btn btn-primary">Submit</button></div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php include('footer.php'); ?>
			</div>
		</div>
		<?php include('link-js.php'); ?>
		<script>
			$('.select2').select2({
			  placeholder: 'Select Branch',
			  allowClear: true
			});
		</script>
	</body>
</html>