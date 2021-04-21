<?php
  // Create database connection
  require 'userPermission.inc';
  $db = mysqli_connect("localhost", "root", "", "instaapp");

  // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['Upload'])) {
  	// Get image name
  	$image = $_FILES['image']['name'];
  	// Get text
  	$image_text = mysqli_real_escape_string($db, $_POST['Caption']);

  	// image file directory
  	$target = "images_post/".basename($image);
    $id = $_SESSION['id'];

  	$sql = "INSERT INTO postingan (gambar, id_user, postingan, jml_like) VALUES ('$target','$id','$image_text',0)";
  	// execute query
  	mysqli_query($db, $sql);

  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Foto telah diupload";
  	}else{
  		$msg = "Foto gagal diupload";
  	}
    header("Location: http://{$_SERVER['HTTP_HOST']}/Tes-Teknis-SEVIMA/user/index.php");

  };
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <script type='text/javascript'>
        function preview_image(event) 
        {
        var reader = new FileReader();
        reader.onload = function()
        {
        var output = document.getElementById('output_image');
        output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    <title>Buat Postingan | InstaApp</title>
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
    <form action="buat postingan.php" method="post" enctype="multipart/form-data">
        <div class="w-75 mx-auto my-auto">
            <h1 class="text-center py-3">Buat Postingan</h1>
            <div class="w-50 h-50 mx-auto rounded-3 border border-primary">
                <h2 class="text-center py-2">Upload Foto</h2>
            <div class="mb-3 row mx-auto w-75">
                <label for="staticEmail" class="col-sm-5 col-form-label">Pilih Foto</label>
                <img style="width: 250px;" id="output_image"/>
                <div class="col-sm-7">
                <input class="form-control form-control-sm" type="file" accept="image/*" onchange="preview_image(event)" name="image">
                </div>
                <label for="staticEmail" class="col-sm-10 col-form-label">Tulis Caption</label>
                <textarea class="form-control" id="Caption" name="Caption" rows="5"></textarea>
            </div>
            <div class="d-grid gap-2">
                <input class="btn btn-primary w-50 mx-auto mb-3" type="submit" name="Upload" value="Upload">
            </div>
        </div>
    </form>

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