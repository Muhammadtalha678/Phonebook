<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	 <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	  <style>
	  	.error{color: red}
	  </style>
</head>
<?php 
	session_start();
	if (isset($_SESSION['username'])) {
		header('Location:Homepage.php');
	}
	$message='';
	require 'connection.php';
	if (isset($_POST['submit'])) {
		$username=$_POST['username'];
		$password=$_POST['password'];
		if ($username == '' || $password == '') {
			$message='<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Error!</strong> Fields marked with * are required
					  </div>';
		}
		else{
			$query="SELECT * FROM `users` WHERE username='".$username."' AND password='".$password."'";
			$result=$connection->query($query);
			$row=$result->num_rows;
			// var_dump($result) ;exit();
		if ($row == 1) {
			$member=$result->fetch_assoc();
			$_SESSION['username']=$username;
			// var_dump($_SESSION['username']);exit();
			$_SESSION['contact_id']=$member['id'];
			header('Location:Homepage.php');
		}
		else{
			$message='<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Invalid!</strong>username or password
					  </div>';
		}
		}
	}
 ?>
<body class="bg-secondary">
	<div class="container-fluid border-white mt-5">
			<div class="row text-center">
				<div class="col-sm-4 col-md-4 col-lg-4"></div>
				<div class="col-md-4 col-sm-4 col-lg-4 border py-3 mt-5">
					<h4 class="text-info">Login</h4>
					<form class="mt-4" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
						<?php echo $message; ?>
					  <div class="form-group row">
					    <label for="username" class="col-sm-3 col-form-label">Username<span class="error">*</span></label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" id="username" placeholder="Username" name="username" required>
					      <span class="error"></span>
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="inputPassword" class="col-sm-3 col-form-label">Password<span class="error">*</span></label>
					    <div class="col-sm-9">
					      <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password" required>
					    </div>
					  </div>
					<button type="submit" name="submit" class="btn btn-success rounded-0 px-5 ml-2">LOGIN</button>
					<p class="mt-3 text-info">Not a member yet? Register <a href="registration.php" class="text-white">Here</a></p>
					</form>
				</div>
				<div class="col-md-4 col-sm-4 col-lg-4"></div>
			</div>
		</div>
</body>
</html>