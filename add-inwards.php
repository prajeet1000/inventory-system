<!DOCTYPE html>
<html lang="en">
	<?php include('head-part.php'); ?>
	<?php 
		$edit_id	=	$_GET['edit_id'];
		if(!empty($edit_id)){
			$query 	=	$conn->query("SELECT * FROM `inwards` WHERE id = '$edit_id'");
			$record =	mysqli_fetch_assoc($query); 
			$head = "Edit";
		}else{
			$head = "Add";
		}
		
		if(isset($_POST['add_inward'])){
			$date		=	$_POST['date'];
			$cnumber	=	$_POST['challan_number'];
			$party		=	$_POST['party'];
			$remark		=	$_POST['remark'];
			$status		=	$_POST['status'];
			
			
			if($cnumber!=""){				
				if(!empty($edit_id)){
					$check = $conn->query("UPDATE `inwards` SET `date`='$date', `challan_number`='$cnumber', `party`='$party', `remark`='$remark',`status`='$status' where `id` = '$edit_id'");
					
					$msg = "Updated";
				}else{
					$randNo	=	rand(10,10000);
					$proName 	= $_FILES['challan_img']['name'];
					$temp    	= $_FILES['challan_img']['tmp_name'];	
					$ext 		= pathinfo($proName,PATHINFO_EXTENSION);
					$insFirst 	= $randNo.time().'.'.$ext;
					
					$path 	 	= 	'img/challan/'.$insFirst;
					$image_info	=	getimagesize($temp);			
					move_uploaded_file($temp,$path);
			
			
					$check = $conn->query("INSERT INTO `inwards`(`date`, `challan_number`, `challan_img`,`party`, `remark`,`status`) VALUES ('$date','$cnumber','$insFirst','$party','$remark','$status')");
					
					$last_id = $conn->insert_id;
					
					$reel_number 	=	$_POST['reel_number'];
					$gsm 			=	$_POST['gsm'];
					$size			=	$_POST['size'];
					$qty			=	$_POST['qty'];
					$weight			=	$_POST['weight'];
					$meel			=	$_POST['meel'];
					$reel_ream		=	$_POST['reel_ream'];
					

					for($i = 0; $i < count($reel_number); $i++){
						$conn->query("INSERT INTO `inwards_item`(`inwards_id`, `reel_number`, `gsm`, `size`,`quantity`,`weight`,`meel`,`reel_ream`) VALUES ('$last_id','$reel_number[$i]','$gsm[$i]','$size[$i]','$qty[$i]','$weight[$i]','$meel[$i]','$reel_ream[$i]')");
					}
					$msg = "Added";
				}
				
				$querystatus="success&&Inwards ".$msg." Successfully&&view-inwards.php";			
				
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
								<h6 class="m-0 font-weight-bold text-primary"><?=$head;?> Inwards</h6>
							</div>
							<div class="card-body">
								<form action="" method="post" enctype="multipart/form-data">
									<div class="row">
										<div class="col-12">
											<input type="date" name="date" value="<?=date('Y-m-d');?>" class="form-control" placeholder="Inwards Date">
										</div>
										<div class="col-6 pt-3">
											<input type="text" name="challan_number" value="<?=$record['mobile'];?>" class="form-control" placeholder="Challan Number">
										</div>
										<div class="col-6 pt-3">
											<input type="file" name="challan_img" value="<?=$record['mobile'];?>" class="form-control" placeholder="Challan Photo">
										</div>
										<div class="col-12 pt-3">
											<select name="party" class="form-control">
												<option value="">-- Select Party</option>
												<?php 
													$query = $conn->query("SELECT * FROM `party` where status = '0'");
													while($fetch=mysqli_fetch_array($query)){
												?>
												<option value="<?=$fetch['id'];?>"><?=$fetch['name'];?></option>
												<?php } ?>
											</select>
										</div>
										<div class="inwards">
											<div class="append_div"></div>
											<div class="row mx-0">												
												<div class="col-lg-3 pt-3">
													<input type="text" name="reel_number[]" value="" class="form-control" placeholder="Reel Number">
												</div>
												<div class="col-lg-3 pt-3">
													<input type="text" name="gsm[]" value="" class="form-control" placeholder="GSM">
												</div>
												<div class="col-lg-3 pt-3">
													<input type="text" name="size[]" value="" class="form-control" placeholder="Size">
												</div>
												<div class="col-lg-3 pt-3">
													<input type="text" name="qty[]" value="" class="form-control" placeholder="Quantity">
												</div>
												<div class="col-lg-3 pt-3">
													<input type="text" name="weight[]" value="" class="form-control" placeholder="Weight">
												</div>
												<div class="col-lg-3 pt-3">
													<select name="meel[]" class="form-control">
														<option value="">-- Select Meel--</option>
														<?php 
															$query = $conn->query("SELECT * FROM `meel` where status = '0'");
															while($fetch=mysqli_fetch_array($query)){
														?>
														<option value="<?=$fetch['id'];?>"><?=$fetch['name'];?></option>
														<?php } ?>
													</select>
												</div>
												<div class="col-lg-3 pt-3">
													<input type="text" name="reel_ream[]" value="" class="form-control" placeholder="Reel / Ream"/>
												</div>
												<div class="col-lg-3 pt-3">
													<button type="button" class="btn btn-primary add-more">Add</button>
												</div>
											</div>
											
										</div>
										
										
										<div class="col-12 py-3">
											<textarea name="remark" class="form-control" placeholder="Remark"></textarea>
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
									<div class="pt-3 text-right"><button type="submit" name="add_inward" class="btn btn-primary">Submit</button></div>
								</form>
								
								<div style="display:none" class="copy-fields">
									<div class="remove_row">
										<div class="row mx-0 pb-3" style="border-bottom:solid 1px #000;">												
											<div class="col-lg-3 pt-3">
												<input type="text" name="reel_number[]" value="" class="form-control" placeholder="Reel Number">
											</div>
											<div class="col-lg-3 pt-3">
												<input type="text" name="gsm[]" value="" class="form-control" placeholder="GSM">
											</div>
											<div class="col-lg-3 pt-3">
												<input type="text" name="size[]" value="" class="form-control" placeholder="Size">
											</div>
											<div class="col-lg-3 pt-3">
												<input type="text" name="qty[]" value="" class="form-control" placeholder="Quantity">
											</div>
											<div class="col-lg-3 pt-3">
												<input type="text" name="weight[]" value="" class="form-control" placeholder="Weight">
											</div>
											<div class="col-lg-3 pt-3">
												<select name="party[]" class="form-control">
													<option value="">-- Select Meel--</option>
													<?php 
														$query = $conn->query("SELECT * FROM `meel` where status = '0'");
														while($fetch=mysqli_fetch_array($query)){
													?>
													<option value="<?=$fetch['id'];?>"><?=$fetch['name'];?></option>
													<?php } ?>
												</select>
											</div>
											<div class="col-lg-3 pt-3">
												<input type="text" name="reel_ream[]" value="" class="form-control" placeholder="Reel / Ream"/>
											</div>
											<div class="col-lg-3 pt-3">
												<button type="button" class="remove btn btn-danger">Remove</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php include('footer.php'); ?>
			</div>
		</div>
		<?php include('link-js.php'); ?>
		<script type="text/javascript">
			$(document).ready(function() {
				$(".add-more").click(function(){ 					
					var html = $(".copy-fields").html();
					$(".append_div").append(html);    
				});
				$("body").on("click",".remove",function(){ 
					$(this).parents(".remove_row").remove();
				});
			});
		</script>
	</body>
</html>