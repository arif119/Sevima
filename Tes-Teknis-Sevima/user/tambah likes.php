<?php
    require 'userPermission.inc';
    if(isset($_GET['id_postingan'])){
        $_SESSION['id_postingan']=($_GET['id_postingan']);
        $_SESSION['temp_status']=($_GET['temp_status']);
        $temp_id=intval($_SESSION['id_postingan']);
        $temp_status=strval($_SESSION['temp_status']);
        if ($temp_status == 'Suka') {
            $dbc = new PDO('mysql:host=localhost;dbname=instaapp','root','');
    
            $statement = $dbc->prepare("INSERT INTO likes (id_user ,id_postingan)
                                        VALUES (:id_user, :id_postingan)");
            $temp_id_user=intval($_SESSION['id']);
            $statement->bindValue(':id_user', $temp_id_user);
            $statement->bindValue(':id_postingan', ($temp_id));
            $statement->execute();
            header("Location: http://{$_SERVER['HTTP_HOST']}/Tes-Teknis-SEVIMA/user/index.php");
        } else {
            $dbc = new PDO('mysql:host=localhost;dbname=instaapp','root','');
    
            $statement = $dbc->prepare("DELETE FROM likes
                                        WHERE likes.id_user = :id_user AND likes.id_postingan = :id_postingan");
            $temp_id_user=intval($_SESSION['id']);
            $statement->bindValue(':id_user', $temp_id_user);
            $statement->bindValue(':id_postingan', ($temp_id));
            $statement->execute();
            header("Location: http://{$_SERVER['HTTP_HOST']}/Tes-Teknis-SEVIMA/user/index.php");
        };
        
        };    
?>