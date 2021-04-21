<?php
	session_start();
	if (!isset($_SESSION['user'])){
		//user akan diarahkan ke halaman login untuk authorization
		header("Location: http://{$_SERVER['HTTP_HOST']}/Tes-Teknis-SEVIMA/login.php");
		exit();
}
?>