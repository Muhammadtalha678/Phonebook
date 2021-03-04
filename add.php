<!DOCTYPE html>
<html>
<head>
	<title>Addnew</title>
	<meta charset="utf-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	 <style>
	 	.error{color:red;}
	 </style>
</head>
<body class="bg-secondary">
	<?php
   require "menu.php";
   $message='';
   if (isset($_POST['submit'])) {
     $name=$_POST['name'];
     $designation=$_POST['designation'];
     $phone=$_POST['phone'];
     $address=$_POST['address'];
     if ($name == '' || $phone == '') {
       $message='<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Error!</strong> Fields marked with * are required.
            </div>';
     }else{
      $sql="INSERT INTO `contact_details`(`name`,`designation`,`phone`,`address`,`user_id`)
       VALUES('$name','$designation','$phone','$address','".$_SESSION['contact_id']."')";
       $result=$connection->query($sql);
       // var_dump($result);exit();
       if ($result == TRUE) {
         $message='<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Success!</strong> Record added successfully.
            </div>';
            header ('Location:viewall.php');
       }else{
        $message='<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Error!</strong>'.$connection->error.'.
            </div>';
       }
      }
   }
   ?>
  <div class="container-fluid mt-5">
  	<div class="row">
  		<div class="col-md-4"></div>
  		<div class="col-md-4 border py-3">
  				<h4 class="text-info text-center">Add User</h4>
  			    <form class="mt-4" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
              <?php echo $message; ?>
              <div class="form-group row">
                <label for="inputname" class="col-sm-3 col-form-label">Name<span class="error">*</span></label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="inputname" placeholder="Name" name="name" required>
                </div>
              </div>
            <div class="form-group row">
              <label for="inputdesignation" class="col-sm-3 col-form-label">Designation</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="inputdesignation" placeholder="Designation" name="designation">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputname" class="col-sm-3 col-form-label">Phone<span class="error">*</span></label>
              <div class="col-sm-9">
                <input type="number" class="form-control" id="inputphone" placeholder="Phone" name="phone" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputaddress" class="col-sm-3 col-form-label">Address</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="inputaddress" placeholder="Address" name="address">
              </div>
            </div>
            <div class="input text-center">
            <button type="submit" name="submit" class="btn btn-success px-5">ADD</button>
              
            </div>
            
            </form>
  		</div>
  		<div class="col-md-4"></div>
  	</div>	
  </div>
</body>
</html>