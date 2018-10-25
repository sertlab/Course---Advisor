<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/diploma/sources/connection.php';
	$title=$_POST['title'];
	$content=$_POST['content'];
	$course_code=$_POST['code'];
	$website=$_POST['url'];
	$category=$_POST['category'];

	$id=$_GET['id'];



	$sql = "UPDATE courses SET title='$title' , content='$content' ,course_code='$course_code' ,website='$website', category='$category'
			 WHERE id='$id'";

	$stmt = $conn->prepare($sql);

    // execute the query
    $stmt->execute();

    $conn=null;

	header('Location: view.php?update=1');

