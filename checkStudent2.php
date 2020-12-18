<?php 
	session_start();

	if ($_SESSION['student_id'] == null){
		header("Location: accountStudent.php");
	}

	else {
		$con = mysqli_connect('127.0.0.1', 'root', '', '43urok');
		$ins = "INSERT INTO zaev (id_student, id_univers) VALUES ('{$_SESSION['student_id']}', '{$_POST['id']}')";
		mysqli_query($con, $ins);
		header("Location: accountStudent.php");
	}
?>