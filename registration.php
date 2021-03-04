<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	 <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	  <style>
	  	.error{color: red}
	  </style>
	  <?php session_start(); 
	  require 'connection.php';
	  	$message='';
	  
	  if (isset($_POST['submit'])) {
	  	$name=$_POST['name'];
	  	$username=$_POST['username'];
	  	$email=$_POST['email'];
	  	$password=$_POST['password'];
	  	$confirm_password=$_POST['confirmpassword'];
	  	if ($name == '' || $username == '' || $email == '' || $password == '' || $confirm_password == '') {
	  		$message='<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Error!</strong>Fields marked with * are required
					  </div>';
	  	}
	  	elseif ($password != $confirm_password) {
	  		$message='<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Error!</strong> Passwords donot match.
					  </div>';

	  	}else{
	  		$usernameexists=$connection->query("SELECT * FROM `users` WHERE username='$username'");
	  		$emailexists=$connection->query("SELECT * FROM `users` WHERE email='$email'");
	  		// var_dump($usernameexists->fetch_assoc());exit();
	  		if ($usernameexists->num_rows == 1) {
	  			$message='<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Error!</strong> Username already exists.
					  </div>';
	  		}
	  		// var_dump($emailexists);exit();
	  		elseif ($emailexists->num_rows == 1) {
	  			$message='<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Error!</strong> Email already exists.
					  </div>';
	  		}
	  		else{
	  			$sql="INSERT INTO `users`(`name`,`username`,`email`,`password`) VALUES ('$name','$username','$email','$password')";
	  			$result=$connection->query($sql);
	  			// var_dump($result);exit;
	  			if ($result == TRUE) {
	  				// $_SESSION['mail']=$email;
	  				$message='<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Success!</strong> Record added successfully.
					  </div>';
	  			}
	  			else{
	  				$message='<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Error!</strong>'.$connection->error.'.
					  </div>';
	  			}
	  		}
	  	}
	  }
	  ?>
</head>
<body class="bg-secondary">
	<div class="container-fluid border-white mt-5">
			<div class="row">
				<div class="col-sm-4 col-md-4 col-lg-4"></div>
				<div class="col-md-4 col-sm-4 col-lg-4 border py-3">
					<h4 class="text-info text-center">Registration</h4>
					<form class="mt-4" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
						<?php echo $message; ?>
					  <div class="form-group row">
					    <label for="inputname" class="col-sm-3 col-form-label">Name<span class="error">*</span></label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" id="inputname" placeholder="Name" name="name" required>
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="username" class="col-sm-3 col-form-label">Username<span class="error">*</span></label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" id="username" placeholder="Username" name="username" required>
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="staticEmail" class="col-sm-3 col-form-label">Email<span class="error">*</span></label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" id="staticEmail" placeholder="Email" name="email" required>
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="inputpassword" class="col-sm-3 col-form-label">Password<span class="error">*</span></label>
					    <div class="col-sm-9">
					      <input type="password" class="form-control" id="inputpassword" placeholder="Password" name="password" required>
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="confirmpassword" class="col-sm-3 col-form-label">Confirm<br>Password<span class="error">*</span></label>
					    <div class="col-sm-9">
					      <input type="password" class="form-control" id="confirmpassword" placeholder="Confirm password" name="confirmpassword" required>
					    </div>
					  </div>
					<div class="input text-center">
					<input type="submit" class="btn btn-success rounded-0 px-5 ml-2" name="submit" value="REGISTER">
					<p class="mt-3 text-info">Already have an account? Please login <a href="login.php" class="text-white"> Here</a></p>
					</div>
					</form>
				</div>
				<div class="col-md-4 col-sm-4 col-lg-4"></div>
			</div>
		</div>
</body>
</html>