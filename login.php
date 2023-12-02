<?php include('connection.php'); ?>
<!DOCTYPE html>
<html lang="en">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Inventory System</title>
	<link href="img/undraw_profile.svg" rel="icon" type="image/x-icon"/>
	<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link
		href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
		rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="css/sb-admin-2.min.css" rel="stylesheet">
	<?php 
		if(isset($_POST['submit'])){
			$mobile		=	$_POST['mobile'];
			$password	=	$_POST['password'];
			
			if($mobile!="" && $password!=""){
				$pass = md5($password);
				$check = $conn->query("select * from `users` where `mobile` = '$mobile' && `password` = '$pass'");
				$fetch = mysqli_fetch_assoc($check);
				$row   = mysqli_num_rows($check);
				
				if($row==1){
					$_SESSION['INVENTORY'] = $fetch['id'];
					$querystatus="success&&Login Successfully&&".SITE_URL;			
				}else{
					$querystatus="error&&Username & Password Does not match&&".SITE_URL;			
				}
			}else{
				$querystatus="error&&Required Filed Missing&&#";			
			}
		}
	?>
	<body class="bg-gradient-primary">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xl-6 col-lg-12 col-md-9">
					<div class="card o-hidden border-0 shadow-lg my-5">
						<div class="card-body p-0">
							<div class="row">
								<!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
								<div class="col-lg-12">
									<div class="p-5">
										<div class="text-center">
											<h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
										</div>
										<form class="user" action="" method="post">
											<div class="form-group">
												<input type="mobile" class="form-control form-control-user"
													id="exampleInputEmail" name="mobile" value="" placeholder="Enter Mobile Number" required>
											</div>
											<div class="form-group">
												<input type="password" class="form-control form-control-user"
													id="exampleInputPassword" name="password" value="" placeholder="Password" required>
											</div>
											<div class="form-group">
												<div class="custom-control custom-checkbox small">
													<input type="checkbox" class="custom-control-input" id="customCheck">
													<label class="custom-control-label" for="customCheck">Remember
														Me</label>
												</div>
											</div>
											<button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
												Login
											</button>
											<hr>
										</form>
										
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>

			</div>

		</div>
		<?php include('link-js.php'); ?>
	</body>
</html>