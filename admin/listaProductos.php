<?php session_start(); ?>
<?php require_once "inc/bbdd.php"; ?>
<?php require_once "inc/funciones.php"; ?>
<?php require_once "inc/encabezado.php"; ?>


<?php 
	if (isset($_SESSION["email"])){
?>
	<main role="main" class="container">
	<br/>
	<div class="alert alert-success " role="alert">
		<?php echo "BIENVENIDO ".$_SESSION["email"]; ?>
	</div>
	<br/>
    <h1 class="mt-5">Listado de productos</h1>
	<p><a href='insertarProducto.php' class='btn btn-success'>Nuevo producto</a></p>
	<p><a href='menu.php' class='btn btn-warning'>Volver al menú</a></p>
	<?php
	$productos = seleccionarTodosProductos();
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
	?>
	<tr>
			<th scope="row"><?php echo $idProducto; ?></th>
			<td><?php echo $nombre; ?></td>
			<td><?php echo $introDescripcion; ?></td>
			<td><?php echo $descripcion; ?></td>
			<td><img src="img/<?php echo $imagen; ?>" alt="<?php echo $imagen; ?>" height="128" width="128"></td>
			<td><?php echo $precio; ?></td>
			<td><?php echo $precioOferta; ?></td>
			<td>
			 <a href='actualizarProducto.php?idProducto=<?php echo $idProducto; ?>' class='btn btn-outline-primary'>Editar</a>
			 <a href='borrarProducto.php?idProducto=<?php echo $idProducto; ?>' onClick="return Confirmar('¿Realmente deseas borrar el registro?');" class='btn btn-danger'>Borrar</a>
			</td>
	</tr>
	<?php
	} //Fin foreach tareas
	} //Cierro if de la sesión
	else{
		header("Location:index.php");
	}
	?>
  </tbody>
</table>

<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item <?php if ($pagina==1){echo "disabled";} ?>"><a class="page-link" href="listaProductos.php?pagina=<?php echo $pagina-1; ?>">Anterior</a></li>
	<?php
		for ($i=1;$i<=$paginas;$i++){
			?>
			<li class="page-item <?php if ($pagina==$i){echo "active";} ?>"><a class="page-link" href="listaProductos.php?pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
			<?php
		}
	
	?>
    
	
    <li class="page-item <?php if ($pagina==$paginas){echo "disabled";} ?>"><a class="page-link" href="listaProductos.php?pagina=<?php echo $pagina+1; ?>">Siguiente</a></li>
  </ul>
</nav>
<a href='logout.php' class='btn btn-danger float-right'>CERRAR SESIÓN</a>
</main>

<script>
	function Confirmar(Mensaje){
		return (confirm(Mensaje))?true:false;
	}

</script>

<?php require_once "inc/pie.php"; ?>