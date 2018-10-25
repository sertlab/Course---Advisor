<?php

require $_SERVER['DOCUMENT_ROOT'].'/diploma/sources/connection.php';


	$id=$_GET['id'];

	$sql="DELETE  FROM courses WHERE id='$id'";
	if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
	}

	$conn->close();
	
	header('Location: view.php?delete=1');