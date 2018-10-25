<?php

require ("../sources/connection.php");

session_start();

$email=$_POST['email'];
$pwd=$_POST['pwd'];

$sql="SELECT  id ,email , pwd , lastname FROM users WHERE email='$email' AND pwd='$pwd'  ";
$result=$conn->query($sql);
$row= $result->fetch_assoc();

if ($result->num_rows>0) {
	//session_start();
	$_SESSION['email']=$email;
	$_SESSION['lastname']=$row['lastname'];
	$_SESSION['id']=$row['id'];
	//echo $_SESSION['id'];
	header("Location: ../index.php");
}

else {
	echo "Invalid email or pwd please try again";
	echo "<a href=index.html>Try Again</a>";
}

