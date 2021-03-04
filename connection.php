<?php 
	$servername="localhost";
	$username="root";
	$password="";
	$database="phonebook";

	$connection=new mysqli($servername,$username,$password,$database);
	if ($connection->connect_error) {
		echo "conection failed".$connection->connect_error;
	};

	
 ?>