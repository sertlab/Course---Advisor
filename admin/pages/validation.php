<?php
session_start();
//echo $_POST['uid'];
//echo trim($_POST['password']);

if ($_POST['uid'] == 'admin' && $_POST['password'] == '123!@#') {
$_SESSION['uid'] = 'admin';
header ('Location: index.php');
}


