<?php session_start(); ?>
<?php require_once "bbdd/bbdd.php"; ?>
<?php require_once "inc/funciones.php"; ?>
<?php 	
		if ($_SESSION["admin"]==1){	
			$pagina="adminProductos";
			$titulo="Admin productos";
?>
<?php require_once "inc/encabezado.php"; ?>
<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Administración de productos</h1>
    </div>
  </div>
  <div class="container">
  <?php
	$productos = seleccionarTodasOfertas();
	$numProductos =  count($productos);
	
	$productosPagina = 2;
	$paginas = ceil($numProductos/$productosPagina);
	
	$pagina=recoge("pagina");
	if ($pagina==FALSE || $pagina<=0 || $pagina>$paginas){
		$pagina=1;
	}
	$inicio = ($pagina-1)*$productosPagina;
	
	$productos = seleccionarProductos($inicio,$productosPagina);
	?>
	<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nombre</th>
      <th scope="col">intro Descripción</th>
      <th scope="col">Descripción</th>
	  <th scope="col">Imágen</th>
	  <th scope="col">Precio</th>
	  <th scope="col">Precio Oferta</th>
	  <th scope="col">Online</th>
    </tr>
  </thead>
  <tbody>
  <?php
	foreach($productos as $producto){
		$idProducto=$producto['idProducto'];
		$nombre=$producto['nombre'];
		$introDescripcion=$producto['introDescripcion'];
		$descripcion=$producto['descripcion'];
		$imagen=$producto['imagen'];
		$precio=$producto['precio'];
		$precioOferta=$producto['precioOferta'];
		$online=$producto['online'];
	?>
	<tr>
			<th scope="row"><?php echo $idProducto; ?></th>
			<td><?php echo $nombre; ?></td>
			<td><?php echo $introDescripcion; ?></td>
			<td><?php echo $descripcion; ?></td>
			<td><img src="imagenes/<?php echo $imagen; ?>" alt="<?php echo $imagen; ?>" height="128" width="128"></td>
			<td><?php echo $precio; ?></td>
			<td><?php echo $precioOferta; ?></td>
			<td><?php echo $online; ?></td>
			<td>
			 <a href='actualizarProducto.php?idProducto=<?php echo $idProducto; ?>' class='btn btn-outline-primary'>Editar</a>
			 <a href='borrarProducto.php?idProducto=<?php echo $idProducto; ?>' onClick="return Confirmar('¿Realmente deseas poner el producto en offline?');" class='btn btn-danger'>Borrar</a>
			</td>
	</tr>
	<?php
	}
	?>
  </tbody>
</table>

<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item <?php if ($pagina==1){echo "disabled";} ?>"><a class="page-link" href="adminProductos.php?pagina=<?php echo $pagina-1; ?>">Anterior</a></li>
	<?php
		for ($i=1;$i<=$paginas;$i++){
			?>
			<li class="page-item <?php if ($pagina==$i){echo "active";} ?>"><a class="page-link" href="adminProductos.php?pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
			<?php
		}
	
	?>
    
	
    <li class="page-item <?php if ($pagina==$paginas){echo "disabled";} ?>"><a class="page-link" href="adminProductos.php?pagina=<?php echo $pagina+1; ?>">Siguiente</a></li>
  </ul>
</nav>
</div>
</main>
<?php
		}
		else{
			header("Location:index.php");
		}
?>
<script>
	function Confirmar(Mensaje){
		return (confirm(Mensaje))?true:false;
	}

</script>

<?php require_once "inc/pie.php"; ?>