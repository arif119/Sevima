<?php
    require 'userPermission.inc';
    function komentar($id_postingan,$conn){
        $jawaban=$conn->prepare("SELECT komentar, username FROM postingan, komentar, pengguna 
                                 WHERE komentar.id_postingan = :id_postingan AND komentar.id_user=pengguna.id_user AND komentar.id_postingan=postingan.id_postingan");
        $jawaban->bindValue(':id_postingan',$id_postingan);
        $jawaban->execute();
        return $jawaban;
    }
    if(isset($_GET['id_postingan'])){
        $_SESSION['id_postingan']=intval($_GET['id_postingan']);
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

    <title>Beranda | InstaApp</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-warning sticky-md-top">
    <div class="container">
        <a class="navbar-brand fs-3" href="index.php">InstaApp</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Beranda</a>
            </li>
            <li class="nav-item">
            <a class="nav-link active" href="#">Profil</a>
            </li>
            <li class="nav-item">
            <a class="nav-link active" href="buat postingan.php">Buat Postingan</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Bantuan
            </a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="logout.php">Keluar</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>
    <div class="container text-center w-50 mx-auto">
    <?php
    $dbc = new PDO('mysql:host=localhost;dbname=instaapp','root','');	
    $query = $dbc->prepare("SELECT username, id_postingan, gambar, postingan FROM pengguna, postingan 
                            WHERE pengguna.id_user = postingan.id_user AND id_postingan = :id_postingan ORDER BY id_postingan DESC");
    $temp_id=intval($_SESSION['id_postingan']);
    $query->bindValue(':id_postingan', $temp_id);

    if (isset($_POST['komentar'])) {
    
        $dbc = new PDO('mysql:host=localhost;dbname=instaapp','root','');
    
        $statement = $dbc->prepare("INSERT INTO komentar (id_user ,id_postingan, komentar)
                                    VALUES (:id_user, :id_postingan, :komentar)");
        $temp_id_user=intval($_SESSION['id']);
        $statement->bindValue(':id_user', $temp_id_user);
        $statement->bindValue(':komentar', $_POST['input_komentar']);
        $statement->bindValue(':id_postingan', ($temp_id));
        $statement->execute();
        header("Location: http://{$_SERVER['HTTP_HOST']}/Tes-Teknis-SEVIMA/user/tambah komentar.php?id_postingan=$temp_id");
        };
    
    $query->execute();
    if ($query->rowCount()>0) {
        foreach ($query as $row) {
            echo "<div class='border border-dark my-3'>";
            echo "<div class='my-2 fs-4'><b> {$row['username']}</b></div>";
            echo "<img src='{$row['gambar']}' style='width: 250px;'><br>";
            echo "<p>  {$row['postingan']}</p>";
            echo '<div class="my-3">';
            //$bidang=$row['bidang'];
            $usname=$row['username'];
            $per=$row['postingan'];
            $id_postingan=intval($row['id_postingan']);
            $respon = komentar($row['id_postingan'], $dbc);
            echo "<div class='container3'>";
            echo "<p class='fs-5'> Komentar :</p>";
            if ($respon->rowCount() >= 1 ) {
                foreach ($respon as $row2) {
                    echo "<b>{$row2['username']}</b>";
                    echo "<p> {$row2['komentar']}</p>";
                }
                //echo "<a href='tambah_jawaban.php?kode_dis=$kode_dis&bidang=$bidang&usname=$usname&per=$per'>Jawab Pertanyaan</a>";
                echo "
                <div>
                <form action='tambah komentar.php' method='POST'>
                <div class='input-group mb-3 w-75 mx-auto'>
                <input type='text' class='form-control' placeholder='Tambah Komentar' name='input_komentar' id='input_komentar'>
                <input type='submit' class='btn btn-primary' name='komentar' id='komentar'>
                </div>
                </form>
                </div>
                </div>
                </div>";
                
            } 
            else {
                echo "
                <p>
                Belum ada komentar
                </p>
                <div>
                <form action='tambah komentar.php' method='POST'>
                <div class='input-group mb-3 w-75 mx-auto'>
                <input type='text' class='form-control' placeholder='Tambah Komentar' name='input_komentar' id='input_komentar'>
                <input type='submit' class='btn btn-primary' name='komentar' id='komentar'>
                </div>
                </form>
                </div>
                </div>
                </div>
                ";
            }
            echo "</div><br>";
        }
    } else {
        echo 'Postingan tidak ditemukan'; 
    };


    ?>
    </div>

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