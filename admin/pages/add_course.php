<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/diploma/sources/connection.php';
	$title=$_POST['title'];
	$content=$_POST['content'];
	$course_code=$_POST['code'];
	$website=$_POST['url'];
	$category=$_POST['category'];



	$sql = "INSERT INTO courses (title , content ,course_code ,website, category)
				VALUES ('$title', '$content' ,'$course_code' ,'$website' ,'$category')";

	if ($conn->query($sql) === TRUE) {
		header("Location: blank.php?added=1");		
	}



