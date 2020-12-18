<?php 
	session_start();
	$con = mysqli_connect('127.0.0.1', 'root', '', '43urok');
	$query = mysqli_query($con, "SELECT * FROM admins WHERE id={$_SESSION['admin_id']}");
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Профиль поступающего</title>
	 <style type="text/css">
        .bg-btn-dodo {
            background-color: #ff6900;
            color: white;
            font-weight: bold;
        }
        .banner {
            background-image: url(img/back.jpeg); height: 500px; background-size: 100% 100%;
        }
        .pizz {
            height: 150px;
        }
        .bsk-box {
            position: absolute; left: 74%; z-index: 100; top: 7%; display: none;
        }
    </style>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>

	<!--если студент НЕ авторизовался, то показывается эта часть, в том числе ссылка на страницу  логина-->
	<?php if ($_SESSION['admin_id'] == null) { ?>
		<div class="col-10 mx-auto">
			<h3>Войдите как университет</h3>
			<p>Вы не авторизованы</p>
			<a href="loginAdmin.php">Авторизация</a>
		</div>
	<?php } else { $stroka = $query->fetch_assoc(); ?>
		 	<!--если студент авторизовался, то показываются nav (меню) и контент всего сайта-->
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
			  <a class="navbar-brand" href="#">Привет, <?php echo $stroka['login'] ?></a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>
			  <div class="collapse navbar-collapse" id="navbarNav">
			    <ul class="navbar-nav">
			      <li class="nav-item">
			        <a href="signOutAdmin.php" class="nav-link text-danger">Выйти</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="index1.php">Главная</a>
			      </li>
			      
			    </ul>
			  </div>
			</nav>
	<?php 
	$query1 = mysqli_query($con, "SELECT * FROM admins INNER JOIN universities ON admins.id_univers = universities.id AND admins.id = {$_SESSION['admin_id']}"); 
	$stroka1 = $query1->fetch_assoc();
	?>
	<h3><?php echo $stroka1['name'] ?></h3>
	<h4>Заявки</h4>	
	<div class="row">
		<?php 
			$query3 = mysqli_query($con, "SELECT * FROM zaev INNER JOIN students ON zaev.id_student = students.id AND zaev.id_univers = {$stroka1['id_univers']}");
			for ($i=0; $i < mysqli_num_rows($query3); $i++) { 
				$stroka3 = $query3->fetch_assoc();
			 ?>
				<div class="col-4">
					<div class="col-10 mx-auto">
						<h5><?php echo $stroka3["fio"] ?></h5>
						<p><?php echo $stroka3["school"] ?></p>
						<p><?php echo $stroka3["email"] ?></p>
						<p><?php echo $stroka3["phone"] ?></p>
						<p><?php echo $stroka3["age"] ?></p>
					</div>
	            </div>  

		<?php } ?>
	</div>

	<?php } ?>

</body>
</html>