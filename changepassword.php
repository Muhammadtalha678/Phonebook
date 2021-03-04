<!DOCTYPE html>
<html>
<head>
	<title>Changepassword</title>
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
	
<?php
require "menu.php"; 
$message='';
  if (isset($_POST['update'])) {
    $old_password=$_POST['old_password'];
    $new_password=$_POST['new_password'];
    $confirm_password=$_POST['confirm_password'];
    if ($old_password == '' || $new_password == '' || $confirm_password == '') {
      $message='<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Error!</strong> Fields marked with * are required.
            </div>';
    }
    else{
      $sql="SELECT * FROM `users` WHERE id='".$_SESSION['contact_id']."' AND password='$old_password'";
      $result=$connection->query($sql);
      $row=$result->num_rows;
      if ($row == 1) {
        if ($new_password == $confirm_password) {
          $query="UPDATE `users` SET password='$new_password' WHERE id='".$_SESSION['contact_id']."' ";
          $check=$connection->query($query);
          if ($check) {
            $message='<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Success!</strong> Password change successfully.
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
        else
        {
          $message='<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Error!</strong> Passwords donot match.
            </div>';
        }
      }
      else
      {
        $message='<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Error!</strong> Old password donot match.
            </div>';
      }
    }


  }
 ?>
<body class="bg-secondary">
  <div class="container-fluid mt-5">
  	<div class="row text">
  		<div class="col-md-4"></div>
  		<div class="col-md-4 border py-3">
  			<h4 class="text-center text-info">Change Password</h4>
  			         <form class="mt-4" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                  <?php echo $message;  ?>
                  <div class="form-group row">
                    <label for="inputname" class="col-sm-3 col-form-label" style="margin-top: -10px">Old Password<span class="error">*</span></label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="inputname" placeholder="Password" name="old_password" required>
                    </div>
                  </div>
                   <div class="form-group row">
                    <label for="inputname" class="col-sm-3 col-form-label" style="margin-top: -10px">New Password<span class="error">*</span></label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="inputname" placeholder="Password" name="new_password" required>
                    </div>
                  </div>
                   <div class="form-group row">
                    <label for="inputname" class="col-sm-3 col-form-label" style="margin-top: -10px">Confirm Password<span class="error">*</span></label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="inputname" placeholder="Password" name="confirm_password" required>
                    </div>
                  </div>
                  <div class="input text-center">
                  <button type="submit" name="update" class="btn btn-success px-5">CHANGE</button>

  		</div>
                 </form>
  		<div class="col-md-4"></div>
  	</div>	
  </div>
</body>
</html>