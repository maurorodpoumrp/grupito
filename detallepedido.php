<?php session_start(); ?>
<?php require_once("bbdd/bbdd.php"); ?>
<?php require_once("inc/funciones.php"); ?>
<?php
		$idPedido=recoge("idPedido");
		if($idPedido==""){
			header("Location:mispedidos.php");
			exit();
		}
		$pagina="detallepedido";
		$titulo="Detalle del pedido";
?>
<?php require_once("inc/encabezado.php"); ?>
<main role="main">
	<?php
		$email=$_SESSION["email"];
		$usu=seleccionarUsuario($email);
		$nombre=$usu["nombre"];
		
	?>
  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
    <h1 class="display-3">Detalle del pedido <?php echo $idPedido; ?></h1>
    <p class="text-left">
		<strong>Nº de pedido:</strong> <?php echo $idPedido; ?>	
	</p>
	<p class="text-left">
		<strong>Cliente:</strong> <?php echo $apellidos; ?> 
	</p>
	<p class="text-left">
		<strong>Fecha:</strong> <?php echo $direccion; ?> 		
	</p>
	<p class="text-left">
		<strong>Dirección:</strong> <?php echo $telefono; ?> 		
	</p>
	<p class="text-left">
		<strong>Estado:</strong> <?php echo $telefono; ?> 		
	</p>
    </div>
  </div>