<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Selamat Datang | InstaApp</title>
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
        $errorUsername = $errorEmail = $errorPw = $errorCpw = array();
        $sysUsername = $sysEmail = $sysNomor = $sysPw = $sysCpw = '';
        
        $isianForm['Username'] = "";
        $isianForm['Email']="";
        $isianForm['Nomor']="";
        $isianForm['Password'] = "";
        $isianForm['confirmPassword'] = "";
        
        if (isset($_POST['Daftar'])) {
            
            require 'validate.inc';

            foreach ($_POST as $key => $value) {
                $isianForm[$key] = $value;
            }
            #($_POST);

            // foreach ($isianForm as $key => $value) {
            //     echo "$key => $value<br>";
            // }
            
            validateUsname($errorUsername, $_POST, 'Username');
            validateMail($errorEmail, $_POST,'Email');
            validatePw($errorPw, $_POST, 'Password');
            validateCpw($errorCpw, $_POST['Password'],  $_POST['confirmPassword'], 'confirmPassword');
            if ($errorUsername || $errorEmail || $errorPw || $errorCpw) {
                foreach ($errorUsername as $field => $sysUsername);
                foreach ($errorEmail as $field => $sysEmail);
                foreach ($errorPw as $field => $sysPw);
                foreach ($errorCpw as $field => $sysCpw);
            }
            if ($sysUsername || $sysEmail || $sysPw || $sysCpw) {
                formulir($sysUsername,$sysEmail,$sysPw,$sysCpw,$isianForm);
                }
            else {
                    $dbc = new PDO('mysql:host=localhost;dbname=instaapp','root','');

                    $statement = $dbc->prepare(" INSERT INTO pengguna (username, email, nomor_handphone, jenis_kelamin, TTL, password)
                                                VALUES (:username, :email, :nomor_handphone, :jenis_kelamin, :ttl, SHA2(:password,0))");
                
                    $statement->bindValue(':username', $_POST['Username']);
                    $statement->bindValue(':email', $_POST['Email']);
                    $statement->bindValue(':nomor_handphone', $_POST['Nomor']);
                    $statement->bindValue(':password', $_POST['Password']);
                    $statement->bindValue(':jenis_kelamin', $_POST['Jenis_Kelamin']);
                    $statement->bindValue(':ttl', $_POST['TTL']);
                    $statement->execute();
                    echo '<div class="w-50 h-50 mx-auto rounded-3 border border-primary">
                        <h2 class="text-center py-2">Akun anda terdaftar</h2>
                        <div class="d-grid gap-2">
                            <a href="login.php" class="btn btn-success w-50 mx-auto mb-3">Kembali LogIn??</a>
                        </div>';
            }

        }
        else formulir('','','','',$isianForm);
    function formulir($username, $email, $pw, $cpw, $isianForm){
        echo '
        <form action="daftar.php" method="post">
            <div class="w-75 mx-auto my-auto">
            <h1 class="text-center py-3">Selamat Datang !</h1>
            <div class="w-50 h-50 mx-auto rounded-3 border border-primary">
                <h2 class="text-center py-2">Daftar Akun</h2>
                <div class="mb-3 row mx-auto w-75">
                    <label for="staticEmail" class="col-sm-5 col-form-label">Username</label>
                    <div class="col-sm-7">
                    <input type="text" class="form-control" id="Username" name="Username" value="'.$isianForm['Username'].'">
                    </div>';
        echo '<label for="staticEmail" class="alert alert-light txt-danger" role="alert">'.$username.'</label>';
        echo '</div>
        <div class="mb-3 row mx-auto w-75">
            <label for="staticEmail" class="col-sm-5 col-form-label">Email</label>
            <div class="col-sm-7">
            <input type="text" class="form-control" id="Email" name="Email" value="'.$isianForm['Email'].'">
            </div>';
        echo '<label for="staticEmail" class="alert alert-light txt-danger" role="alert">'.$email.'</label>';
        echo '</div>
            <div class="mb-3 row mx-auto w-75">
                <label for="staticEmail" class="col-sm-5 col-form-label">Nomor Handphone</label>
                <div class="col-sm-7">
                <input type="text" class="form-control" id="Nomor" name="Nomor" value="'.$isianForm['Nomor'].'">
                </div>
            </div>
            <div class="mb-3 row mx-auto w-75">
                <label for="staticEmail" class="col-sm-5 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-7">
                <select name="Jenis_Kelamin" class="form-select" aria-label="Default select example">
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                </div>
            </div>
            <div class="mb-3 row mx-auto w-75">
                <label for="staticEmail" class="col-sm-5 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-7">
                <input type="date" class="form-control" id="TTL" name="TTL">
                </div>
            </div>
        <div class="mb-3 row mx-auto w-75">
            <label for="inputPassword" class="col-sm-5 col-form-label">Password</label>
            <div class="col-sm-7">
            <input type="password" class="form-control" id="Password" name="Password" value="'.$isianForm['Password'].'">
            </div>
            <label for="staticEmail" class="alert alert-light txt-danger" role="alert">'.$pw.'</label>
        </div>
        <div class="mb-3 row mx-auto w-75">
            <label for="inputPassword" class="col-sm-5 col-form-label">Ulangi Password</label>
            <div class="col-sm-7">
            <input type="password" class="form-control" id="Password" name="confirmPassword" value="'.$isianForm['confirmPassword'].'">
            </div>
            <label for="staticEmail" class="alert alert-light txt-danger" role="alert">'.$cpw.'</label>
        </div>
        <div class="mb-3 row mx-auto w-75">
            <div class="col-sm-1">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked required>
            </div>
            <label for="inputPassword" class="col-sm-11 col-form-label">Saya setuju dengan syarat dan ketentuan yang berlaku !</label>
        </div>
        <div class="d-grid gap-2">
            <input class="btn btn-primary w-50 mx-auto mb-3" type="submit" name="Daftar" value="Daftar">
        </div>
    </div>
    </form>
        ';
    }
    ?>
    <footer class="container-fluid text-center text-secondary p-2">
        <p>InstaApp</p>
    </footer>  
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