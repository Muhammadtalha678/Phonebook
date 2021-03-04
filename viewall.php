<!DOCTYPE html>
<html>
<head>
	<title>Viewall</title>
	<meta charset="utf-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	 
</head>
<body class="bg-secondary">
	<?php require "menu.php";  ?>
	<div class="mt-5">
		<div class="container">
			<div class="row ">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<table class="table table-bordered text-center bg-white">
				   <tbody>
	<tr>
		<th>S.No</th>
		<th>Name</th>
		<th>Designation</th>
		<th>Phone</th>
		<th>Address</th>
		<th>Action</th>
	</tr>
	
	<?php
	$sql="SELECT * FROM `contact_details` WHERE `user_id`=".$_SESSION['contact_id'];
	$result=$connection->query($sql);
	$row=$result->num_rows;
	if ($row > 0) {
		$count=1;
		while ($rows=$result->fetch_assoc()) {
	// var_dump($rows);exit();
	?>
	
				  
				    <tr>
				      <th scope="row"><?php echo $count; ?></th>
				      <td><?php echo $rows['name']; ?></td>
				      <td><?php echo $rows['designation'];  ?></td>
				      <td><?php echo $rows['phone']; ?></td>
				      <td><?php echo $rows['address']; ?></td>
				      <td>
				      	<a href="edit_contact.php?edit_contact_id=<?php echo $rows['id']; ?>" class="text-primary text-decoration-none">Edit</a>
				      	<a href="delete.php?delete_contact_id=<?php echo $rows['id'] ?>" class="text-danger text-decoration-none ml-2" onclick="return confirm('Are you sure do you wan\'t to delete this user?')">Delete</a>
				      </td>
				    </tr>
				    <?php $count++; }
				    }else{?>
				    	<tr>
				    		<td colspan="6" class="text-center text-danger">No record found</td>
				    	</tr>
				    <?php } ?>
				  	
				  
				  </tbody>
				</table>
			</div>
			<div class="col-md-1"></div>
		</div>
		</div>
	</div>
</body>
</html>