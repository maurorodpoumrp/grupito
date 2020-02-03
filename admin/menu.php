<?php session_start(); ?>
<?php require_once "inc/bbdd.php"; ?>
<?php require_once "inc/encabezado.php"; ?>
<?php
	if ($_SESSION["email"]){
?>
<main role="main" class="container">
<br/>
	<div class="alert alert-success" role="alert">
		<?php echo "BIENVENIDO ".$_SESSION["email"]; ?>
	</div>
	<h1 class="mt-5">Menú</h1>
	<br/>

	<a href='listaProductos.php' class='btn btn-info'>PRODUCTOS</a>
	
	<a href='listaUsuarios.php' class='btn btn-info'>USUARIOS</a>

	<a href='logout.php' class='btn btn-danger'>CERRAR SESIÓN</a>
</main>
<?php
	}
	else{
		header("Location:index.php");
	}
?>
<?php require_once "inc/pie.php"; ?>