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
    <h1 class="mt-5">Listado usuarios</h1>
	<p><a href='insertarUsuario.php' class='btn btn-success'>Nuevo usuario</a></p>
	<p><a href='menu.php' class='btn btn-warning'>Volver al menú</a></p>
	<?php
	$usuarios = seleccionarTodosUsuarios();
	$numUsuarios =  count($usuarios);
	
	$usuariosPagina = 2;
	$paginas = ceil($numUsuarios/$usuariosPagina);
	
	$pagina=recoge("pagina");
	if ($pagina==FALSE || $pagina<=0 || $pagina>$paginas){
		$pagina=1;
	}
	$inicio = ($pagina-1)*$usuariosPagina;
	
	$usuarios = seleccionarUsuarios($inicio,$usuariosPagina);
	?>
	<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Email</th>
      <th scope="col">Nombre</th>
	  <th scope="col">Apellidos</th>
	  <th scope="col">Direccion</th>
	  <th scope="col">Telefono</th>
    </tr>
  </thead>
  <tbody>
  	<?php
	foreach($usuarios as $usu){
		$idUsuario=$usu['idUsuario'];
		$email=$usu['email'];
		$nombre=$usu['nombre'];
		$apellidos=$usu['apellidos'];
		$direccion=$usu['direccion'];
		$telefono=$usu['telefono'];
	?>
		<tr>
			<th scope="row"><?php echo $idUsuario; ?></th>
			<td><?php echo $email; ?></td>
			<td><?php echo $nombre; ?></td>
			<td><?php echo $apellidos; ?></td>
			<td><?php echo $direccion; ?></td>
			<td><?php echo $telefono; ?></td>
			<td>
			 <a href='actualizarUsuario.php?email=<?php echo $email; ?>' class='btn btn-outline-primary'>Editar</a>
			 <a href='borrarUsuario.php?email=<?php echo $email; ?>' onClick="return Confirmar('¿Realmente deseas borrar el registro?');" class='btn btn-danger'>Borrar</a>
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
    <li class="page-item <?php if ($pagina==1){echo "disabled";} ?>"><a class="page-link" href="listaUsuarios.php?pagina=<?php echo $pagina-1; ?>">Anterior</a></li>
	<?php
		for ($i=1;$i<=$paginas;$i++){
			?>
			<li class="page-item <?php if ($pagina==$i){echo "active";} ?>"><a class="page-link" href="listaUsuarios.php?pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
			<?php
		}
	
	?>
    
	
    <li class="page-item <?php if ($pagina==$paginas){echo "disabled";} ?>"><a class="page-link" href="listaUsuarios.php?pagina=<?php echo $pagina+1; ?>">Siguiente</a></li>
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