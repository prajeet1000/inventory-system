<!DOCTYPE html>
<html lang="en">
	<?php include('head-part.php'); ?>
	<?php 
		$delID = $_GET['delid'];
		if(!empty($delID)){
			$conn->query("UPDATE `users` SET `is_deleted`='1' WHERE `id` = '$delID'");
			$querystatus="success&&Record delete Successfully&&view-user.php";	
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
								<h6 class="m-0 font-weight-bold text-primary">View User</h6>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>S. No.</th>
												<th>Name</th>
												<th>Mobile</th>
												<th>Branch</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$record = $conn->query("select * from `users` where users.is_deleted = '0'");
												$i = 1;
												while($fetch=mysqli_fetch_array($record)){
											?>
											<tr>
												<td><?=$i;?></td>
												<td><?=$fetch['name'];?></td>
												<td><?=$fetch['mobile'];?></td>
												<td>
													<?php	
														$dee = json_decode($fetch['branch'], true);
														foreach($dee as $de){
															$check  = $conn->query("SELECT * FROM `branch` where id = $de");
															$record = mysqli_fetch_assoc($check);
															echo $record['name'].", ";
														}
													?>
												</td>
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
													<a href="add-user.php?edit_id=<?=$fetch['id'];?>"><i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i></a>
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
		<?php include('link-js.php'); ?>
	</body>
</html>