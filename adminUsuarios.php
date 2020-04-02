<?php session_start(); ?>
<?php require_once "bbdd/bbdd.php"; ?>
<?php require_once "inc/funciones.php"; ?>
<?php 	
		if ($_SESSION["admin"]==1){
			$pagina="listaUsuarios";
			$titulo="Lista de Usuarios";
?>
<?php require_once "inc/encabezado.php"; ?>
<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Administración de usuarios</h1>
    </div>
  </div>
  <div class="container">
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
	  <th scope="col">Online</th>
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
		$online=$usu['online'];
	?>
		<tr>
			<th scope="row"><?php echo $idUsuario; ?></th>
			<td><?php echo $email; ?></td>
			<td><?php echo $nombre; ?></td>
			<td><?php echo $apellidos; ?></td>
			<td><?php echo $direccion; ?></td>
			<td><?php echo $telefono; ?></td>
			<td><?php echo $online; ?></td>
			<td>
			 <a href='adminActualizarUsuario.php?email=<?php echo $email; ?>' class='btn btn-outline-primary'>Editar</a>
			 <a href='borrarUsuario.php?email=<?php echo $email; ?>' onClick="return Confirmar('¿Realmente deseas borrar el registro?');" class='btn btn-danger'>Borrar</a>
			</td>
		</tr>
	<?php
	}
?>	
	
  </tbody>
</table>
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item <?php if ($pagina==1){echo "disabled";} ?>"><a class="page-link" href="adminUsuarios.php?pagina=<?php echo $pagina-1; ?>">Anterior</a></li>
	<?php
		for ($i=1;$i<=$paginas;$i++){
			?>
			<li class="page-item <?php if ($pagina==$i){echo "active";} ?>"><a class="page-link" href="adminUsuarios.php?pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
			<?php
		}
	
	?>
    
	
    <li class="page-item <?php if ($pagina==$paginas){echo "disabled";} ?>"><a class="page-link" href="adminUsuarios.php?pagina=<?php echo $pagina+1; ?>">Siguiente</a></li>
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