<?php session_start(); ?>
<?php require_once "bbdd/bbdd.php"; ?>
<?php require_once "inc/funciones.php"; ?>
<?php 	
		if ($_SESSION["admin"]==1){
			$pagina="adminIndex";
			$titulo="Menú de admin";
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
	<a href='adminProductos.php' class='btn btn-info'>PRODUCTOS</a>
	<a href='adminPedidos.php' class='btn btn-info'>PEDIDOS</a>
	<a href='adminUsuarios.php' class='btn btn-info'>USUARIOS</a>
 </div>
 <?php
		}
		else{
			header("Location:index.php");
		}
 ?>
  
</main>
<?php require_once "inc/pie.php"; ?>