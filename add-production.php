<!DOCTYPE html>
<html lang="en">
	<?php include('head-part.php'); ?>
	<?php 
		$edit_id	=	$_GET['edit_id'];
		if(!empty($edit_id)){
			$query 	=	$conn->query("SELECT * FROM `outwards` WHERE id = '$edit_id'");
			$record =	mysqli_fetch_assoc($query); 
			$head = "Edit";
		}else{
			$head = "Add";
		}
		
		if(isset($_POST['add_inward'])){
			$reel_number 	=	$_POST['reel_number'];
			$gsm 			=	$_POST['gsm'];
			$size			=	$_POST['size'];
			$weight			=	$_POST['weight'];
			$meel			=	$_POST['meel'];
			$Quantity		=	$_POST['Quantity'];
			$machine		=	$_POST['machine'];
			$length			=	$_POST['length'];
			$width			=	$_POST['width'];
			$remark			=	$_POST['remark'];
			$status			=	$_POST['status'];
			
			
			if($reel_number!=""){
				$randNo	=	rand(10,10000);
				$proName 	= $_FILES['sheet_img']['name'];
				$temp    	= $_FILES['sheet_img']['tmp_name'];	
				$ext 		= pathinfo($proName,PATHINFO_EXTENSION);
				$insFirst 	= $randNo.time().'.'.$ext;
				
				$path 	 	= 	'img/challan/'.$insFirst;
				$image_info	=	getimagesize($temp);			
				move_uploaded_file($temp,$path);
				
		
				$check = $conn->query("INSERT INTO `production`(`reel_number`, `gsm`, `size`, `weight`, `meel`, `quantity`, `machine`, `length`, `width`, `remark`, `sheet_img`,`status`) VALUES ('$reel_number','$gsm','$size','$weight','$meel','$Quantity','$machine','$length','$width','$remark','$insFirst','$status')");
								
				$msg = "Added";
			
				$querystatus="success&&Production ".$msg." Successfully&&view-production.php";			
				
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
								<h6 class="m-0 font-weight-bold text-primary"><?=$head;?> Production</h6>
							</div>
							<div class="card-body">
								<form action="" method="post" enctype="multipart/form-data">
									<div class="row">
										<div class="col-lg-12 pt-3">
											<select name="reel_number" class="form-control" onchange="getInwarddetails(this.value)">
												<option value="">-- Select Reel Number --</option>
												<?php 
													$query = $conn->query("SELECT * FROM `inwards_item`");
													while($fetch=mysqli_fetch_array($query)){
												?>
												<option value="<?=$fetch['reel_number'];?>"><?=$fetch['reel_number'];?></option>
												<?php } ?>
											</select>
										</div>
										<div class="inwardContent">
																						
										</div>	
										<div class="col-lg-12 pt-3">
											<select name="machine" class="form-control">
												<option value="">-- Select Machine --</option>
												<?php 
													$machine = $conn->query("SELECT * FROM `machine`");
													while($fetch2=mysqli_fetch_array($machine)){
												?>
												<option value="<?=$fetch2['id'];?>"><?=$fetch2['name'];?></option>
												<?php } ?>
											</select>
										</div>
										<div class="col-6 pt-3">
											<input type="text" name="length" value="" class="form-control" placeholder="Cut Size Length"/>
										</div>
										<div class="col-6 pt-3">
											<input type="text" name="width" value="" class="form-control" placeholder="Cut Size Width"/>
										</div>
										<div class="col-12 pt-3">
											<textarea name="remark" class="form-control" placeholder="Remark"></textarea>
										</div>
										<div class="col-6 pt-3">
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
										<div class="col-6 pt-3">
											<input type="file" name="sheet_img" value="" class="form-control" placeholder="Challan Photo">
										</div>
									</div>
									<div class="pt-3 text-right"><button type="submit" name="add_inward" class="btn btn-primary">Submit</button></div>
								</form>							
							</div>
						</div>
					</div>
				</div>
				<?php include('footer.php'); ?>
			</div>
		</div>
		<?php include('link-js.php'); ?>
		<script type="text/javascript">
			function getInwarddetails(value){				
				let payload = {
					getData: "getReelDetails",
					value: value,
					panel: 2
				}
				
				$.ajax({
					type: "POST",
					url: "ajax.php",
					data: payload,
					dataType: "html",
					success: function (response) {
						var obj = $.parseJSON(response);
						console.log(obj);
						if (obj.status === 'success') {
							$('.inwardContent').html(obj.data);
						} else {
							swal("Error", obj.data, "error");
						}
						return false;
					}
				});
			}
		</script>
	</body>
</html>