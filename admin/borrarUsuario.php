<?php session_start(); ?>
<?php require_once "inc/bbdd.php"; ?>
<?php require_once "inc/funciones.php"; ?>
<?php require_once "inc/encabezado.php"; ?>
<?php 
	if (isset($_SESSION["email"])){
?>
<main role="main" class="container">
    <h1 class="mt-5">Borrar usuario</h1>
<?php
	$email=recoge("email");
	
	if($email==""){
		header("Location: listaUsuarios.php");
		exit(); //die();
	}
	
	$ok=borrarUsuario($email);
	
	if ($ok){
		echo "<div class=\"alert alert-success\" role=\"alert\"> Usuario con email $email borrado correctamente </div>";
	}
	else{
		echo "<div class=\"alert alert-danger\" role=\"alert\">ERROR: Usuario NO borrado </div>";
	}
	echo "<p><a href='listaUsuarios.php' class='btn btn-primary'>Volver al listado</a></p>";	
		
	}
	else{
		header("Location:index.php");
	}	
?>
</main>
<?php require_once "inc/pie.php"; ?>