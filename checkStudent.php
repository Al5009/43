<?php 
	session_start();
	$con = mysqli_connect('127.0.0.1', 'root', '', '43urok');
	$query = mysqli_query($con, "SELECT * FROM students WHERE phone='{$_POST['phone']}' AND password='{$_POST['password']}'");
	$num = mysqli_num_rows($query);
	if($num == true){
		$stroka = $query->fetch_assoc();
		$_SESSION['student_id'] = $stroka['id'];
		header("Location: accountStudent.php");
	} else{
		header("Location: loginStudent.php?lol=Nein");
	}
?>