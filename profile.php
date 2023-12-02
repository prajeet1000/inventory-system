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
								<h6 class="m-0 font-weight-bold text-primary">Profile</h6>
							</div>
							<div class="card-body">
								<form action="" method="post">
									<div class="row">
										<div class="col-12">
											<input type="text" name="name" value="" class="form-control" placeholder="Name">
										</div>
										<div class="col-12 pt-3">
											<input type="text" name="name" value="" class="form-control" placeholder="Mobile">
										</div>
										<div class="col-12 pt-3">
											<input type="text" name="name" value="" class="form-control" placeholder="Password">
										</div>
									</div>
									<div class="pt-3 text-right"><button type="submit" class="btn btn-primary">Submit</button></div>
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