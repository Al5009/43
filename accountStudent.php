<?php 
	session_start();
	$con = mysqli_connect('127.0.0.1', 'root', '', '43urok');
	$query = mysqli_query($con, "SELECT * FROM students WHERE id={$_SESSION['student_id']}");
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
	<?php if ($_SESSION['student_id'] == null) { ?>
		<div class="col-10 mx-auto">
			<h3>Войдите как абитуриент</h3>
			<p>Вы не авторизованы</p>
			<a href="loginStudent.php">Авторизация абитуриента</a>
		</div>
	<?php } else { $stroka = $query->fetch_assoc(); ?>
		 	<!--если студент авторизовался, то показываются nav (меню) и контент всего сайта-->
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
			  <a class="navbar-brand" href="#">Привет, <?php echo $stroka['fio'] ?></a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>
			  <div class="collapse navbar-collapse" id="navbarNav">
			    <ul class="navbar-nav">
			      <li class="nav-item">
			        <a href="signOutStudent.php" class="nav-link text-danger">Выйти</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="index.php">Главная</a>
			      </li>
			      
			    </ul>
			  </div>
			</nav>
	
	
	<div class="col-10 mx-auto mt-5">
		<div class="row">
			<div class="col-3 border py-3 rounded">
				<h5>Добавить работу</h5>
				<form action="addWork.php" method="POST" enctype="multipart/form-data">
					<input class="mt-3 form-control" type="" placeholder="Описание" name="desc">
					<input placeholder="Выбрать файл" class="mt-3" type="file" name="file">
					<button class="btn btn-success mt-3">Загрузить работу в портфолио</button>
				</form>
			</div>
		</div>	
	</div>
	
	<h3>Мои документы</h3>
	<div class="row">
		<?php 
			$query1 = mysqli_query($con, "SELECT * FROM raboti WHERE id_student={$_SESSION['student_id']}");
			for ($i=0; $i < mysqli_num_rows($query1); $i++) { 
				$stroka = $query1->fetch_assoc();
			 ?>
				<div class="col-3">
					<div>   
	                	<img src="<?php echo $stroka["img"] ?>" class="w-100">
	                	<div class="pizz"> 
	                    	<h5><?php echo $stroka["text"] ?></h5>
	                	</div>
	                </div>      
	            </div>  

		<?php } ?>
	</div>
		<h3>Мои заявки в университеты</h3>	
		<div class="row">
			<?php 
				$query3 = mysqli_query($con, "SELECT * FROM zaev INNER JOIN universities ON zaev.id_univers = universities.id AND zaev.id_student = {$_SESSION['student_id']}");
				for ($i=0; $i < mysqli_num_rows($query3); $i++) { 
					$stroka = $query3->fetch_assoc();
				 ?>
					<div class="col-3">   
						<h5><?php echo $stroka["name"] ?></h5>
		            </div>  

			<?php } ?>
		</div>

	<?php } ?>

</body>
</html>