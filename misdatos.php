<?php session_start(); ?>
<?php require_once("bbdd/bbdd.php"); ?>
<?php require_once("inc/funciones.php"); ?>
<?php 	
		$email=$_SESSION['email'];
		$usu = seleccionarUsuario($email);
		$pagina="misdatos";
		$titulo="Mis datos";
?>
<?php require_once("inc/encabezado.php"); ?>
<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Mis datos</h1>
      <p>Datos del usuario <?php echo $email; ?></p>
    </div>
  </div>
  
  <div class="container">
	<?php
		$nombre=$usu['nombre'];
		$apellidos=$usu['apellidos'];
		$direccion=$usu['direccion'];
		$telefono=$usu['telefono'];
	?>
	<p class="text-left">
		<strong>Nombre:</strong> <?php echo $nombre; ?>	
	</p>
	<p class="text-left">
		<strong>Apellidos:</strong> <?php echo $apellidos; ?> 
	</p>
	<p class="text-left">
		<strong>Dirección:</strong> <?php echo $direccion; ?> 		
	</p>
	<p class="text-left">
		<strong>Teléfono:</strong> <?php echo $telefono; ?> 		
	</p>
	<p>
		<a class="btn btn-warning" href="actualizarUsuario.php?email=<?php echo $email; ?>" role="button">Editar perfil</a>
		<a class="btn btn-info" href="cambiarContra.php?email=<?php echo $email; ?>" role="button">Cambia tu contraseña</a>
		<a class="btn btn-danger" href="#" role="button">Eliminar cuenta</a>
	</p>
  </div>
  
  <hr/>
<?php require_once("inc/pie.php"); ?>