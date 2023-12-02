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
			$date		=	$_POST['date'];
			$cnumber	=	$_POST['challan_number'];
			$party		=	$_POST['party'];
			$remark		=	$_POST['remark'];
			$status		=	$_POST['status'];
			$reel_number 	=	$_POST['reel_number'];
			$gsm 			=	$_POST['gsm'];
			$size			=	$_POST['size'];
			$weight			=	$_POST['weight'];
			$reel_ream		=	$_POST['reel_ream'];
			$taxi_number		=	$_POST['taxi_number'];
			
			
			if($cnumber!=""){
				$randNo	=	rand(10,10000);
				$proName 	= $_FILES['challan_img']['name'];
				$temp    	= $_FILES['challan_img']['tmp_name'];	
				$ext 		= pathinfo($proName,PATHINFO_EXTENSION);
				$insFirst 	= $randNo.time().'.'.$ext;
				
				$path 	 	= 	'img/challan/'.$insFirst;
				$image_info	=	getimagesize($temp);			
				move_uploaded_file($temp,$path);
		
				$check = $conn->query("INSERT INTO `outwards`(`date`, `challan_number`, `challan_img`,`party`, `remark`,`status`,`reel_number`, `gsm`, `size`,`weight`,`reel_ream`,`taxi_number`) VALUES ('$date','$cnumber','$insFirst','$party','$remark','$status','$reel_number','$gsm','$size','$weight','$reel_ream','$taxi_number')");
								
				$msg = "Added";
			
				$querystatus="success&&Outwards ".$msg." Successfully&&view-outwards.php";			
				
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
								<h6 class="m-0 font-weight-bold text-primary"><?=$head;?> Outwards</h6>
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
										<div class="col-6 pt-3">
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
										<div class="col-lg-6 pt-3">
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
										<div class="inwards">
																						
										</div>
										<div class="col-12 pt-3">
											<textarea name="remark" class="form-control" placeholder="Remark"></textarea>
										</div>
										<div class="col-6 pt-3">
											<input type="text" name="taxi_number" value="" class="form-control" placeholder="Taxi Number"/>
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
			$(document).ready(function() {
				$(".add-more").click(function(){ 					
					var html = $(".copy-fields").html();
					$(".append_div").append(html);    
				});
				$("body").on("click",".remove",function(){ 
					$(this).parents(".remove_row").remove();
				});
			});
			
			function getInwarddetails(value){
				let payload = {
					getData: "getReelDetails",
					value: value,
					panel: 1
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
							$('.inwards').html(obj.data);
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