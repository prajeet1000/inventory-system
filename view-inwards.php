<!DOCTYPE html>
<html lang="en">
	<?php include('head-part.php'); ?>
	<?php 
		$delID = $_GET['delid'];
		if(!empty($delID)){
			$conn->query("UPDATE `inwards` SET `is_deleted`='1' WHERE `id` = '$delID'");
			$querystatus="success&&Record delete Successfully&&view-inwards.php";	
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
								<h6 class="m-0 font-weight-bold text-primary">View Party</h6>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>S. No.</th>
												<th>Date</th>
												<th>Challan Number</th>
												<th>Image</th>
												<th>Party</th>
												<th>Remark</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$record = $conn->query("select * from `inwards` where is_deleted = '0'");
												$i = 1;
												while($fetch=mysqli_fetch_array($record)){
											?>
											<tr>
												<td><?=$i;?></td>
												<td><?=$fetch['date'];?></td>
												<td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" data-id="<?=$fetch['id'];?>" class="cData">
													<?=$fetch['challan_number'];?></a>
												</td>												
												<td>
													<?php if(!empty($fetch['challan_img'])){ ?>
														<a href="img/challan/<?=$fetch['challan_img'];?>" target="_blank">Preview</a>
													<?php }else{ echo '-'; } ?>
												</td>												
												<td>
													<?php 
														$party = $conn->query("select name from party where id = '".$fetch['party']."'")->fetch_assoc();
														echo $party['name'];
													?>
												</td>												
												<td><?=$fetch['remark'];?></td>												
												<td>
													<?php 
													if($fetch['status']=='1'){
														echo 'Inactive';
													}else{
														echo 'Active';
													}
													?>
												</td>
												<td>
													<!--
													<a href="add-inwards.php?edit_id=<?=$fetch['id'];?>"><i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i></a>
													-->
													<a href="?delid=<?=$fetch['id'];?>"><i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-400"></i></a>
												</td>
											</tr>
											<?php $i++; } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php include('footer.php'); ?>
			</div>
		</div>
		
		<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Inwards Details</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="p-3">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th scope="col">Reel Number</th>
									<th scope="col">GSM</th>
									<th scope="col">Size</th>
									<th scope="col">Quantity</th>
									<th scope="col">Weight</th>
									<th scope="col">Meel</th>
									<th scope="col">Reel / Exam</th>
								</tr>
							</thead>
							<tbody class="inwardContent">
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<?php include('link-js.php'); ?>
		<script type="text/javascript">
			$(".cData").click(function (e) {
				e.preventDefault();
					
				dataID = $(this).attr("data-id");
				
				let payload = {
					getData: "viewInwards",
					dataID: dataID
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
			});
		</script>
	</body>
</html>