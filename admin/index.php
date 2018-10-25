<?php
session_start();
//echo $_SESSION['username'];
if ($_SESSION['uid']!='admin') {
	header('Location: pages/login.php');

}



?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="refresh" content="0;url=pages/index.php">
<title>Course Advisor Dashboard</title>
<script language="javascript">
    window.location.href = "pages/index.php"
</script>
</head>
<body>
Go to <a href="pages/index.html">/pages/index.php</a>
</body>
</html>
