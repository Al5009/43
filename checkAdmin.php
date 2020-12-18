<?php 
	session_start();
	$con = mysqli_connect('127.0.0.1', 'root', '', '43urok');
	$query = mysqli_query($con, "SELECT * FROM admins WHERE login='{$_POST['login']}' AND password='{$_POST['password']}'");
	$num = mysqli_num_rows($query);
	if($num == true){
		$stroka = $query->fetch_assoc();
		$_SESSION['admin_id'] = $stroka['id'];
		header("Location: accountUnivers.php");
	} else{
		header("Location: loginAdmin.php?lol=Nein");
	}
?>