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
<body class="bg-secondary">
	<?php 
	$message='';
		require "menu.php";
		if (isset($_POST['update'])) {
			$id=$_POST['id'];
			$name=$_POST['name'];
			$designation=$_POST['designation'];
			$phone=$_POST['phone'];
			$address=$_POST['Address'];
			if ($name == '' || $phone == '') {
				$message='<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Error!</strong> Fields marked with * are required.
            </div>';
			}else{
				$update="UPDATE `contact_details` SET name='$name',designation='$designation',phone='$phone',address='$address' WHERE id='$id' ";
				$check=$connection->query($update);
				if ($check) {
					header('Location:viewall.php');
				}else{
					$message='<div class="alert alert-success alert-dismissible">
					   <button type="button" class="close" data-dismiss="alert">&times;</button>
					     <strong>Error!</strong> "'.$connection->error.'"
					   </div>';
				}
			}
		}
		$id=$_GET['edit_contact_id'];
		$query="SELECT * FROM `contact_details` WHERE id = '$id' AND user_id = '".$_SESSION['contact_id']."'";
		// var_dump($query);exit;
		$result=$connection->query($query);	
		$row=$result->num_rows;
		if ($row == 1) {
			$data=$result->fetch_assoc();
		}else{
			header('Location:viewall.php');
		}
		
			
	 ?>
	 <div class="container-fluid mt-5">
	 	<div class="row">
	 		<div class="col-md-4"></div>
	 		<div class="col-md-4 border py-3">
	 				<h4 class="text-info text-center">Update User</h4>
	 			    <form class="mt-4" action="<?php  $_SERVER['PHP_SELF']; ?>" method="POST">
	 			    	<?php echo $message; ?>
	             <div class="form-group row">
	               <label for="inputname" class="col-sm-3 col-form-label">Name<span class="error">*</span></label>
	               <div class="col-sm-9">
	                 <input type="text" class="form-control" id="inputname" placeholder="Name" name="name" value="<?php echo $data['name'] ?>" required>
	               </div>
	             </div>
	           <div class="form-group row">
	             <label for="inputdesignation" class="col-sm-3 col-form-label">Designation</label>
	             <div class="col-sm-9">
	               <input type="text" class="form-control" id="inputdesignation" placeholder="Designation" name="designation" value="<?php echo $data['designation']  ?>" >
	             </div>
	           </div>
	           <div class="form-group row">
	             <label for="inputname" class="col-sm-3 col-form-label">Phone<span class="error">*</span></label>
	             <div class="col-sm-9">
	               <input type="number" class="form-control" id="inputphone" placeholder="Phone" name="phone" value="<?php echo $data['phone']  ?>" required>
	             </div>
	           </div>
	           <div class="form-group row">
	             <label for="inputaddress" class="col-sm-3 col-form-label">Address</label>
	             <div class="col-sm-9">
	               <input type="text" class="form-control" id="inputaddress" placeholder="Address" name="Address" value="<?php echo $data['address']  ?>">
	           <input type="HIDDEN" name="id" value="<?php echo $data['id']; ?>" >
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