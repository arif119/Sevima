<?php
    require 'userPermission.inc';
    function komentar($id_postingan,$conn){
        $jawaban=$conn->prepare("SELECT komentar, username FROM postingan, komentar, pengguna 
                                 WHERE komentar.id_postingan = :id_postingan AND komentar.id_user=pengguna.id_user AND komentar.id_postingan=postingan.id_postingan");
        $jawaban->bindValue(':id_postingan',$id_postingan);
        $jawaban->execute();
        return $jawaban;
       
    }
    function jml_like($id_postingan,$conn){
        $jml_like=$conn->prepare("SELECT COUNT(likes.id_user) as jml FROM postingan, likes 
                                 WHERE likes.id_postingan = :id_postingan AND likes.id_postingan=postingan.id_postingan");
        $jml_like->bindValue(':id_postingan',$id_postingan);
        $jml_like->execute();
        foreach ($jml_like as $row3) {
            $temp_like = $row3['jml'];
                if (is_null($temp_like)) {
                    $temp_like = 0;
                } else {
                    $temp_like = intval($temp_like);
                };            
            };
        return intval($temp_like);
       
    }
    function status_like($id_postingan,$id_user,$conn){
        $stats_like=$conn->prepare("SELECT  likes.id_like FROM postingan, likes, pengguna
                                 WHERE likes.id_postingan = :id_postingan AND likes.id_user = :id_user AND likes.id_postingan=postingan.id_postingan AND likes.id_user = pengguna.id_user");
        $stats_like->bindValue(':id_postingan',$id_postingan);
        $stats_like->bindValue(':id_user',$id_user);
        $stats_like->execute();
        $temp_stats='Suka';
        foreach ($stats_like as $row4) {
            $temp_stats = $row4['id_like'];
                if (isset($temp_stats)) {
                    $temp_stats = 'Disukai';
                };            
            };
        return ($temp_stats);
       
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
    <h2 class="text-center py-3">Beranda</h2>
    <div class="container text-center w-50 mx-auto">
    <?php
    $dbc = new PDO('mysql:host=localhost;dbname=instaapp','root','');	
    $query = $dbc->prepare("SELECT username, id_postingan, gambar, postingan FROM pengguna, postingan 
                            WHERE pengguna.id_user = postingan.id_user ORDER BY id_postingan DESC");
    $query->execute();
    if ($query->rowCount()>0) {
        foreach ($query as $row) {
            $temp_like = jml_like($row['id_postingan'], $dbc);
            $temp_id = intval($_SESSION['id']);
            $id_postingan=intval($row['id_postingan']);
            $temp_status = status_like($row['id_postingan'],$temp_id,$dbc);
            echo "<div class='border border-dark my-3 bg-light'>";
            echo "<div class='my-2 fs-4'><b> {$row['username']}</b></div>";
            echo "<img src='{$row['gambar']}' style='width: 250px;'><br>";
            echo "<p>  {$row['postingan']}</p>";
            echo "<div class='my-3'>
            <a href='tambah likes.php?id_postingan=$id_postingan&temp_status=$temp_status' class='btn btn-outline-danger'>
            $temp_like $temp_status
            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-hand-thumbs-up' viewBox='0 0 16 16'>
            <path d='M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z'></path>
            </svg>
            </a>";
            //$bidang=$row['bidang'];
            $usname=$row['username'];
            $per=$row['postingan'];
            $respon = komentar($row['id_postingan'], $dbc);
            echo "<div class='container3'>";
            echo "<p class='fs-5'> Komentar :</p>";
            if ($respon->rowCount() >= 1 ) {
                foreach ($respon as $row2) {
                    echo "<b>{$row2['username']}</b>";
                    echo "<p> {$row2['komentar']}</p>";
                }
                //echo "<a href='tambah_jawaban.php?kode_dis=$kode_dis&bidang=$bidang&usname=$usname&per=$per'>Jawab Pertanyaan</a>";
                echo "</button>
                <a href='tambah komentar.php?id_postingan=$id_postingan&temp_status=$temp_status' class='btn btn-outline-secondary'>
                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-chat-square' viewBox='0 0 16 16'>
                <path d='M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-2.5a2 2 0 0 0-1.6.8L8 14.333 6.1 11.8a2 2 0 0 0-1.6-.8H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z'></path>
                </svg>
                Komentari
                </a>
                </div>
                </div>";
                
            } 
            else {
                echo "
                <p>
                Belum ada komentar
                </p>
                </button>
                <a href='tambah komentar.php?id_postingan=$id_postingan' class='btn btn-outline-secondary'>
                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-chat-square' viewBox='0 0 16 16'>
                <path d='M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-2.5a2 2 0 0 0-1.6.8L8 14.333 6.1 11.8a2 2 0 0 0-1.6-.8H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z'></path>
                </svg>
                Komentari
                </a>
                </div>
                </div>";;
            }
            echo "</div><br>";
        }
    } else {
        echo 'Belum ada postingan'; 
    }


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