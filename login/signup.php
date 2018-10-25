<?php 
require ("../sources/connection.php");

$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$email=$_POST['email'];
$pwd=$_POST['pwd'];

$sql = "INSERT INTO users (firstname , lastname , email, pwd)
				VALUES ('$firstname', '$lastname' , '$email' , '$pwd')";

$conn->query($sql);
echo "New record created succesfully";
$conn=null;
//header("Location :login/index.html");
?>
