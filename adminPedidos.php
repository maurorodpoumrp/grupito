<?php session_start(); ?>
<?php require_once "bbdd/bbdd.php"; ?>
<?php require_once "inc/funciones.php"; ?>
<?php 	
		if ($_SESSION["admin"]==1){
			$pagina="adminPedidos";
			$titulo="Menú de pedidos";
?>
<?php require_once "inc/encabezado.php"; ?>
<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Todos los pedidos</h1>
    </div>
  </div>
  <?php
		$pedidos = seleccionarTodosPedidos();
		if (empty($pedidos)){
			$mensaje="No hay todavía ningún pedido";
			mostrarMensaje($mensaje);
		}
		else{
	?>
  <div class="container">
	<div class="row px-5">

  <table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">Nº Pedido</th>
	  <th scope="col">Nº Usuario</th>
      <th scope="col" class="text-center">Fecha</th>
      <th scope="col" class="text-center">Estado</th>
	  <th scope="col" class="text-center">Total</th>
    </tr>
  </thead>
  <tbody>
  <?php
	foreach ($pedidos as $pedido){
		$idPedido=$pedido["idPedido"];
		$idUsuario=$pedido["idUsuario"];
		$fecha=$pedido["fecha"];
		$estado=$pedido["estado"];
		$total=$pedido["total"];
  ?>
	<tr>
		<td scope="col"><?php echo $idPedido; ?></td>
		<td scope="col"><?php echo $idUsuario; ?></td>
		<td scope="col" class="text-center"><?php echo $fecha; ?></td>
		<td scope="col" class="text-center"><?php echo $estado; ?></td>
		<td scope="col" class="text-center"><?php echo $total."€"; ?></td>
		<td scope="col" class="text-center"><a class="btn btn-outline-secondary" href="adminDetallepedido.php?idPedido=<?php echo $idPedido; ?>" role="button">Ver pedido</a></td>
	</tr>
	<?php
	}
		}
		}
		else{
			header("Location:index.php");
		}
  ?>
  </tbody>
  </table>
  </div>
  </div>
</main>
<?php require_once("inc/pie.php"); ?>