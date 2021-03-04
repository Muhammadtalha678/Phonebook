<!DOCTYPE html>
<html>
<head>
	<title>Edit</title>
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
	require 'menu.php';
	
	$message='';
	if (isset($_POST['update'])) {
		$name=$_POST['name'];
		$username=$_POST['username'];
		$email=$_POST['email'];
		if ($name == '' || $username == '' || $email == '') {
			$message='<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Error!</strong> Fields marked with * are required.
            </div>';
		}
		else
		{
			$usernameexists=$connection->query("SELECT * FROM `users` WHERE id <> '".$_SESSION['contact_id']."' AND username='$username' ");
			$emailexists=$connection->query("SELECT * FROM `users` WHERE id <> '".$_SESSION['contact_id']."' AND email='$email' ");
			if ($usernameexists->num_rows == 1) {
				$message='<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Error!</strong> Username already exists.
            </div>';
			}
			elseif ($emailexists->num_rows == 1) {
				$message='<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Error!</strong> Email alresdy exists.
            </div>';
			}
			else
			{
				$query="UPDATE `users` SET name='$name', username='$username',email='$email' WHERE id= '".$_SESSION['contact_id']."'";
			// var_dump($query);exit();
				$check=$connection->query($query);
				// $row=$check->num_rows;
				// var_dump($row);exit();
					$_SESSION['username']=$username;
				if ($check) {
					$message='<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Success!</strong> Profile updated successfully.
            </div>';
				}
				else
				{
					$message='<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Error!</strong> '.$connection->error.'
            </div>';
				}

			}
		}
	}
		$sql="SELECT * FROM `users` WHERE id='".$_SESSION['contact_id']."' ";
	// var_dump($sql);exit();
	$result=$connection->query($sql);
		$data=$result->fetch_assoc();
	


 ?>
<body class="bg-secondary">
	 <div class="container-fluid mt-5">
	 	<div class="row">
	 		<div class="col-md-4"></div>
	 		<div class="col-md-4 border py-3">
	 				<h4 class="text-info text-center">Update Profile</h4>
	 			    <form class="mt-4" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
	 			    	 <?php echo $message; ?>
	             <div class="form-group row">
	               <label for="inputname" class="col-sm-3 col-form-label">Name<span class="error">*</span></label>
	               <div class="col-sm-9">
	                 <input type="text" class="form-control" id="inputname" placeholder="Name" name="name" value="<?php echo $data['name'] ?>" required>
	               </div>
	             </div>
	           <div class="form-group row">
	             <label for="inputdesignation" class="col-sm-3 col-form-label">Username<span class="error">*</span></label>
	             <div class="col-sm-9">
	               <input type="text" class="form-control" id="inputdesignation" placeholder="Username" name="username" value="<?php echo $data['username']  ?>" required>
	             </div>
	           </div>
	           <div class="form-group row">
	             <label for="inputname" class="col-sm-3 col-form-label">Email<span class="error">*</span></label>
	             <div class="col-sm-9">
	               <input type="text" class="form-control" id="inputphone" placeholder="Email" name="email" value="<?php echo $data['email']  ?>" required>
	             </div>
	           </div>
	          
	           <div class="input text-center">
	           <button type="submit" name="update" class="btn btn-success px-5">Update</button>
	             
	           </div>
	           </form>
	 		</div>
	 		<div class="col-md-4"></div>
	 	</div>	
	 </div>
</body>
</html>