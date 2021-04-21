<?php

	if(isset($_POST['masuk'])){
		function checkPassword($email, $password){
			$dbc = new PDO('mysql:host=localhost;dbname=instaapp','root','');	
			$query = $dbc->prepare("SELECT * FROM pengguna WHERE email = :email AND password = SHA2(:password, 0)");
			$query->bindValue(':email', $_POST['email']);
			$query->bindValue(':password', $_POST['password']);
			$query->execute();
			return $query->rowCount() > 0;
		}
		if (checkPassword($_POST['email'], $_POST['password'])){
            $dbc = new PDO('mysql:host=localhost;dbname=instaapp','root','');	
			$query = $dbc->prepare("SELECT * FROM pengguna WHERE email = :email AND password = SHA2(:password, 0)");
			$query->bindValue(':email', $_POST['email']);
			$query->bindValue(':password', $_POST['password']);
			$query->execute();
            foreach ($query as $row)    
                {
                    $id=$row['id_user'];
                }
			session_start();
            $_SESSION['id'] = intval($id);
			$_SESSION['user'] = true;
			header("Location: http://{$_SERVER['HTTP_HOST']}/Tes-Teknis-SEVIMA/user/index.php");
			exit();
		}
        else {
            header("Location: http://{$_SERVER['HTTP_HOST']}/Tes-Teknis-SEVIMA/login.php?login-gagal");
        }
	}
	
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Masuk | InstaApp</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-warning sticky-md-top">
    <div class="container">
        <a class="navbar-brand fs-3" href="index.php">InstaApp</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav text-right">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="login.php">Masuk</a>
            </li>
            <li class="nav-item">
            <a class="nav-link active" href="daftar.php">Daftar</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Tentang</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Bantuan
            </a>
            </li>
        </ul>
        </div>
    </div>
    </nav>
<?php
echo '<form action="login.php"  method="POST">';
echo ' <div class="w-75 mx-auto my-auto">
<h1 class="text-center py-3">Selamat Datang !</h1>
<div class="w-50 h-50 mx-auto rounded-3 border border-primary">
    <h2 class="text-center py-2">Masuk</h2>
    <div class="mb-3 row mx-auto w-75">
        <label for="email" class="col-sm-4 col-form-label">Email</label>
        <div class="col-sm-7">
        <input type="text" class="form-control" id="email" name="email">
        </div>
    </div>
    <div class="mb-3 row mx-auto w-75">
        <label for="password" class="col-sm-4 col-form-label">Password</label>
        <div class="col-sm-7">
        <input type="password" class="form-control" id="password" name="password">
        </div>
    </div>
    <div class="d-grid gap-2">
        <input type="submit" name="masuk" value="Masuk" class="btn btn-primary w-50 mx-auto">
        <a href="daftar.php" class="btn btn-success w-50 mx-auto mb-3">Belum Punya Akun ?</a>
    </div>
';
if (isset($_GET['login-gagal'])) {
    echo '<div class="alert alert-danger" role="alert">
            Login Gagal, Silahkan Masukkan data dengan tepat !!
        </div>';
}
echo '
</div>
</div>';
echo '';

?>
<!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
</body>
</html>