<?php session_start(); ?>
<?php require_once("bbdd/bbdd.php"); ?>
<?php require_once("inc/funciones.php"); ?>
<?php
	$pagina = "carrito";
	$titulo = "Tu compra";
?>
<?php require_once("inc/encabezado.php"); ?>
<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Tu carrito de la compra</h1>
      <p><a class="btn btn-primary btn-lg" href="productos.php" role="button">Seguir comprando »</a></p>
    </div>
  </div>
  <?php
		if (empty($_SESSION['carrito'])){
			$mensaje="El carrito de la compra está vacío";
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
	foreach($_SESSION['carrito'] as $id=>$cantidad){
		$producto = seleccionarProducto($id);	
		$nombre = $producto['nombre'];
		$precio = $producto['precioOferta'];
		$subTotal= $precio*$cantidad;
		$total=$total+$subTotal;
	?>
		<tr>
			<td scope="col"><a href="producto.php?id=<?php echo $id; ?>" class="text-light"><?php echo $nombre; ?></a></td>
			<td scope="col" class="text-center"><a href="procesarCarrito.php?id=<?php echo $id; ?>&op=remove" class="text-light"><i class="fas fa-minus fa-xs"></i></a>  <?php echo $cantidad; ?>  <a href="procesarCarrito.php?id=<?php echo $id; ?>&op=add" class="text-light"><i class="fas fa-plus fa-xs"></a></i></td>
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
	<a href="procesarCarrito.php?id=<?php echo $id; ?>&op=empty" class="btn btn-danger">Vaciar carrito</a>
	<a href="confirmarPedido.php" class="btn btn-success ml-3">Confirmar pedido</a>
 </div>

 </div>
 <?php
	$_SESSION['total']=$total;
		}//Llave else
 ?>
</main>
<?php require_once("inc/pie.php"); ?> 