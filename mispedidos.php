<?php session_start(); ?>
<?php require_once("bbdd/bbdd.php"); ?>
<?php require_once("inc/funciones.php"); ?>
<?php
		$email=$_SESSION['email'];	
		$usu = seleccionarUsuario($email);
		$idUsuario=$usu['idUsuario'];
		
		$pagina="mispedidos";
		$titulo="Mis pedidos";
?>
<?php require_once("inc/encabezado.php"); ?>
<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Mis pedidos</h1>
      <p>Pedidos del usuario <?php echo $email; ?></p>
    </div>
  </div>
  <?php
		$pedidos = seleccionarPedidos($idUsuario);
		if (empty($pedidos)){
			$mensaje="No has realizado todavía ningún pedido";
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
      <th scope="col" class="text-center">Fecha</th>
      <th scope="col" class="text-center">Estado</th>
	  <th scope="col" class="text-center">Total</th>
    </tr>
  </thead>
  <tbody>
  <?php
	foreach ($pedidos as $pedido){
		$idPedido=$pedido["idPedido"];
		$fecha=$pedido["fecha"];
		$estado=$pedido["estado"];
		$total=$pedido["total"];
  ?>
	<tr>
		<td scope="col"><?php echo $idPedido; ?></td>
		<td scope="col" class="text-center"><?php echo $fecha; ?></td>
		<td scope="col" class="text-center"><?php echo $estado; ?></td>
		<td scope="col" class="text-center"><?php echo $total."€"; ?></td>
		<td scope="col" class="text-center"><a class="btn btn-outline-secondary" href="detallepedido.php?idPedido=<?php echo $idPedido; ?>" role="button">Ver pedido</a></td>
	</tr>
	<?php
	}
		}
  ?>
  </tbody>
  </table>
  </div>
  </div>
</main>
<?php require_once("inc/pie.php"); ?>