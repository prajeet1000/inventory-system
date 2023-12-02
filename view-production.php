<!DOCTYPE html>
<html lang="en">
	<?php include('head-part.php'); ?>
	<body id="page-top">
		<div id="wrapper">
			<?php include('sidebar.php'); ?>
			<div id="content-wrapper" class="d-flex flex-column">
				<div id="content">
					<?php include('topbar.php'); ?>
					<div class="container-fluid">
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary">View Publication</h6>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>S. No.</th>
												<th>Name</th>
												<th>Position</th>
												<th>Office</th>
												<th>Age</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php for($i=1; $i<=20; $i++){ ?>
											<tr>
												<td><?=$i;?></td>
												<td>Tiger Nixon</td>
												<td>System Architect</td>
												<td>Edinburgh</td>
												<td>61</td>
												<td>
													Active
												</td>
												<td>
													<i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
													<i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-400"></i>
												</td>
											</tr>
											<?php } ?>
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