<!DOCTYPE html>
<html>
<head>
	<title>MENU</title>
	<meta charset="utf-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	 <style>
	 	.color{color:white}
	 </style>
</head>
<body>
	<?php 
	session_start();
	 if (!$_SESSION) {
		header('Location:login.php');
	} 
	require 'connection.php';
	$sql="SELECT * FROM `contact_details` WHERE `user_id`=".$_SESSION['contact_id'];
	// var_dump($sql);exit();
	$result=$connection->query($sql);
	$member=$result->num_rows;
	 ?>
				<nav class="navbar navbar-expand-md bg-dark navbar-dark">
				  <!-- Brand -->
				  <ul class="navbar-nav">
				  	<li class="nav-item"><a  class="nav-link active" href="Homepage.php">Phonebook Directory</a></li>
				  </ul>
				  

				  <!-- Toggler/collapsibe Button -->
				  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
				    <span class="navbar-toggler-icon"></span>
				  </button>

				  <!-- Navbar links -->
				  <div class="collapse navbar-collapse" id="collapsibleNavbar">
				    <ul class="navbar-nav ml-auto">
				    	<li class="nav-item mr-2">
				    	  <a class="nav-link active" href="homepage.php">Home</a>
				    	</li>
				      <li class="nav-item mr-2">
				        <a class="nav-link" href="add.php">Add New</a>
				      </li>
				      <li class="nav-item mr-2">
				        <a class="nav-link" href="viewall.php">View All <span>&nbsp;<?php echo $member ; ?></span> </a>
				      </li>
				      <li class="nav-item mr-2">
				        <a class="nav-link" href="view.php">View</a>
				      </li>
				      <li class="nav-item mr-2">
				        <a class="nav-link " href="changePassword.php">Change Password</a>
				      </li>
				      <li class="nav-item mr-2">
				        <a class="nav-link " href="logout.php">Logout</a>
				      </li>
				    </ul>
				</nav>
	<p class="text-center mt-5 text-info">Logged in as <span><?php echo $_SESSION['username']  ?></span></p>
				

</body>
</html>