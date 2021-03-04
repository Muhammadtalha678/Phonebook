<?php 
	require 'connection.php';
	session_start();
	$id=$_GET['delete_contact_id'];
	// var_dump($id)
	$sql="SELECT * FROM `contact_details` WHERE id = '$id' AND user_id = '".$_SESSION['contact_id']."' ";
	$result=$connection->query($sql);
		// var_dump($result);exit();
	if ($result->num_rows == 1) {
		$query="DELETE FROM `contact_details` WHERE id='$id' AND user_id = '".$_SESSION['contact_id']."'";
		$check=$connection->query($query);
		header('Location:viewall.php');
	}else{
		echo '<div class="alert alert-success alert-dismissible">
             <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Error!</strong> user not delete.
             </div>';;
	}
 ?>