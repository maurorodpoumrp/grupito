<?php session_start(); ?>
<?php require_once "bbdd/bbdd.php"; ?>
<?php require_once "inc/funciones.php"; ?>
<?php 	
		$pagina="borrarUsuario";
		$titulo="Borrar Usuario";
?>
<?php require_once "inc/encabezado.php"; ?>
<main role="main">
  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Borrar usuario</h1>
    </div>
  </div>
  <div class="container">
<?php
	$email=recoge("email");
	
	if($email==""){
		header("Location: adminUsuarios.php");
		exit(); //die();
	}
	
	$ok=borrarUsuario($email);
	
	if ($ok){
		echo "<div class=\"alert alert-success\" role=\"alert\"> Usuario con email $email borrado correctamente </div>";
	}
	else{
		echo "<div class=\"alert alert-danger\" role=\"alert\">ERROR: Usuario NO borrado </div>";
	}
	echo "<p><a href='adminUsuarios.php' class='btn btn-primary'>Volver al listado</a></p>";	
?>
</main>
<?php require_once "inc/pie.php"; ?>