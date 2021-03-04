<!DOCTYPE html>
<html>
<head>
	<title>View</title>
	<meta charset="utf-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body class="bg-secondary">
	<?php require "menu.php"; 
		$sql="SELECT * FROM `users` WHERE `username` = '".$_SESSION['username']."' ";
		$result=$connection->query($sql);
		$row=$result->fetch_assoc();
		// var_dump($row);exit();
	?>
	<h4 class="text-info text-center mt-4">User Profile</h4>
	<div class="container mt-5">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<table class="table table-bordered text-center">
				  <tbody>
				    	 <tr>
				    	 <th>name</th>
				    	 <th>Username</th>
				    	 <th>Email</th>
				    	 <th>Action</th>
				    	 </tr>

				    	 <tr>
				    	 <td><?php echo $row['name']; ?></td>
				    	 <td><?php echo $row['username'] ?></td>
				    	 <td><?php echo $row['email']; ?></td>
				    	 <td>
				    	<a href='edit_profile.php' class='text-white'>Edit</a>&nbsp;
				    	</td>
				    	 </tr>
				     
				  </tbody>
				</table>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
</body>
</html>