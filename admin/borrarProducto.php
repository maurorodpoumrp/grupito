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
	$idProducto=recoge("idProducto");
	
	if($idProducto==""){
		header("Location: listaProductos.php");
		exit(); //die();
	}
	
	$ok=borrarProducto($idProducto);
	
	if ($ok){
		echo "<div class=\"alert alert-success\" role=\"alert\"> Producto $idProducto borrado correctamente (puesto en offline) </div>";
	}
	else{
		echo "<div class=\"alert alert-danger\" role=\"alert\">ERROR: Producto NO borrado </div>";
	}
	echo "<p><a href='listaProductos.php' class='btn btn-primary'>Volver al listado</a></p>";	
		
	}
	else{
		header("Location:index.php");
	}	
?>
</main>
<?php require_once "inc/pie.php"; ?>