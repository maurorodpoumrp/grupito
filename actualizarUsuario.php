<?php session_start(); ?>
<?php require_once "bbdd/bbdd.php"; ?>
<?php require_once "inc/funciones.php"; ?>
<?php 	
		$email=recoge("email");
		if($email==""){
				header("Location: index.php");
				exit(); //die();
		}
		$pagina="actualizarUsuario";
		$titulo="Actualiza tu usuario";
?>
<?php require_once "inc/encabezado.php"; ?>
<?php
function imprimirFormulario($email,$nombre,$apellidos,$direccion,$telefono){
?>
<form method="post">
  <div class="form-group">
    <label for="email">Email</label>
    <input type="text" class="form-control" id="email" name="email" value='<?php echo "$email";?>'  readonly="readonly"/>
  </div>
  <div class="form-group">
    <label for="nombre">Nombre: </label>
    <input type="text" class="form-control" id="nombre" name="nombre" value='<?php echo "$nombre"; ?>'/>
  </div>
  <div class="form-group">
    <label for="apellidos">Apellidos: </label>
    <input type="text" class="form-control" id="apellidos" name="apellidos" value='<?php echo "$apellidos"; ?>'/>
  </div>
  <div class="form-group">
    <label for="direccion">Direccion: </label>
    <input type="text" class="form-control" id="direccion" name="direccion" value='<?php echo "$direccion"; ?>'/>
  </div>
  <div class="form-group">
    <label for="telefono">Telefono: </label>
    <input type="text" class="form-control" id="telefono" name="telefono" value='<?php echo "$telefono"; ?>'/>
  </div>
  <p>
	<button type="submit" class="btn btn-primary" name="guardar" value="guardar">Guardar</button>
	<a class="btn btn-warning" href="misdatos.php" role="button">Volver atrás</a>
  </p>
</form>
<?php
}
?>
<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Edita tus datos</h1>
      <p>Datos del usuario <?php echo $email; ?></p>
    </div>
  </div>
  
  <div class="container">
	<?php
		if(!isset($_REQUEST['guardar'])){
	
			$usu = seleccionarUsuario($email);
			$nombre=$usu['nombre'];
			$apellidos=$usu['apellidos'];
			$direccion=$usu['direccion'];
			$telefono=$usu['telefono'];
			
			if (empty($usu)){ 
				header("Location: index.php");
				exit();
			}
			imprimirFormulario($email,$nombre,$apellidos,$direccion,$telefono);	
		}
		else{
			$email=recoge("email");
			$usu = seleccionarUsuario($email);
			$nombre=recoge("nombre");
			$apellidos=recoge("apellidos");
			$direccion=recoge("direccion");
			$telefono=recoge("telefono");
			
			$errores = "";
			
			if ($nombre==""){
				$errores=$errores."<li>No puedes dejar el nombre vacío</li>";
			}		
			if ($apellidos==""){
				$errores=$errores."<li>No puedes dejar los apellidos vacíos</li>";
			}
			if ($direccion==""){
				$errores=$errores."<li>No puedes dejar la dirección vacía</li>";
			}
			if ($telefono==""){
				$errores=$errores."<li>No puedes dejar el telefono vacío</li>";
			}
			
			if($errores!=""){
				echo "<ul>$errores</ul>";
				imprimirFormulario($email,$nombre,$apellidos,$direccion,$telefono);
			}
			else{
				$ok = actualizarUsuario($email,$nombre,$apellidos,$direccion,$telefono);
				
				if ($ok){
					echo "<div class=\"alert alert-success\" role=\"alert\"> Usuario con email $email actualizado correctamente </div>";
					$_SESSION['usuario']=$nombre;
					header("Location:misdatos.php");
				}
				else{
					echo "<div class=\"alert alert-danger\" role=\"alert\">ERROR: Usuario NO actualizado </div>";
					imprimirFormulario($email,$nombre,$apellidos,$direccion,$telefono);
				}
			}
		}
	?>
  </div>
  
</main>
<?php require_once "inc/pie.php"; ?>