<?php session_start(); ?>
<?php require_once "bbdd/bbdd.php"; ?>
<?php require_once "inc/funciones.php"; ?>
<?php 	
		$pagina="borrarProducto";
		$titulo="Borrar producto";
?>
<?php require_once "inc/encabezado.php"; ?>
<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Que deseas administrar</h1>
    </div>
  </div>
  <div class="container">
<?php
	$idProducto=recoge("idProducto");
	
	if($idProducto==""){
		header("Location: adminProductos.php");
		exit(); //die();
	}
	
	$ok=borrarProducto($idProducto);
	
	if ($ok){
		echo "<div class=\"alert alert-success\" role=\"alert\"> Producto $idProducto borrado correctamente (puesto en offline) </div>";
	}
	else{
		echo "<div class=\"alert alert-danger\" role=\"alert\">ERROR: Producto NO borrado </div>";
	}
	echo "<p><a href='adminProductos.php' class='btn btn-primary'>Volver al listado</a></p>";	
	
?>
</div>
</main>
<?php require_once "inc/pie.php"; ?>