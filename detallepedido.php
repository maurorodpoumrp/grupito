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
		$apellidos=$usu["apellidos"];
		$direccion=$usu["direccion"];
		$telefono=$usu["telefono"];
		$pedido=seleccionarPedido($idPedido);
		$fecha=$pedido["fecha"];
		$estado=$pedido["estado"];
		
	?>
  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
    <h1 class="display-3">Detalle del pedido <?php echo $idPedido; ?></h1>
    <p class="text-left">
		<strong>Nº de pedido:</strong> <?php echo $idPedido; ?>	
	</p>
	<p class="text-left">
		<strong>Cliente:</strong> <?php echo "$nombre $apellidos"; ?> 
	</p>
	<p class="text-left">
		<strong>Dirección:</strong> <?php echo $direccion; ?> 		
	</p>
	<p class="text-left">
		<strong>Telefono:</strong> <?php echo $telefono; ?> 		
	</p>
	<p class="text-left">
		<strong>Fecha:</strong> <?php echo $fecha; ?> 		
	</p>
	<p class="text-left">
		<strong>Estado:</strong> <?php echo $estado; ?> 		
	</p>
	<p><a class="btn btn-info btn-lg" href="mispedidos.php" role="button">Volver a mis pedidos »</a></p>
    </div>
  </div>
  
	<?php
		$factura=seleccionarDetallePedido($idPedido);
		if (empty($factura)){
			$mensaje="No tiene ningún producto en este pedido";
			mostrarMensaje($mensaje);
		}
		else{
	?>
	<div class="container">
	
  <div class="row px-5">

  <table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col" class="text-center">Cantidad</th>
      <th scope="col" class="text-center">Precio</th>
	  <th scope="col" class="text-center">Subtotal</th>
    </tr>
  </thead>
  <tbody>
  <?php
	$total=0;
	foreach($factura as $detalle){
		$precio=$detalle["precio"];
		$cantidad=$detalle["cantidad"];
		$idProducto=$detalle["idProducto"];
		$producto=seleccionarProducto($idProducto);
		$nombre = $producto['nombre'];
		$subTotal= $precio*$cantidad;
		$total=$total+$subTotal;	
  ?>  
		<tr>
			<td scope="col"><a href="producto.php?id=<?php echo $idProducto; ?>" class="text-light"><?php echo $nombre; ?></a></td>
			<td scope="col" class="text-center"> <?php echo $cantidad; ?>  </td>
			<td scope="col" class="text-center"><?php echo $precio."€"; ?></td>
			<td scope="col" class="text-center"><?php echo $subTotal."€"; ?></td>
		</tr>
	<?php
	}
	?>
	</tbody>
	<tfoot>
	<tr>
		<td scope="row" colspan="3" class="text-right">Total</td>
		<th scope="row" class="text-center"><?php echo $total; ?>€</th>
	</tr>
	</tfoot>
	</table>
	<?php
		}
	?>
</main> 
<?php require_once("inc/pie.php"); ?>