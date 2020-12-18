<?php
	session_start();
	$folder = 'img/';
	$file_upload = $folder . basename($_FILES['file']['name']);
	move_uploaded_file($_FILES['file']['tmp_name'], $file_upload );

	$connect = mysqli_connect("127.0.0.1", "root", "", "43urok");
	$ins = "INSERT INTO raboti (text, img, id_student) VALUES ('{$_POST['desc']}', '{$file_upload}', '{$_SESSION['student_id']}')";
	mysqli_query($connect, $ins);
	header('Location: accountStudent.php');
?>