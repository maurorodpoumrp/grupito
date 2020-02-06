<?php session_start(); ?>
<?php require_once "inc/bbdd.php"; ?>
<?php require_once "inc/funciones.php"; ?>
<?php require_once "inc/encabezado.php"; ?>
<?php
function imprimirFormulario($email,$nombre,$apellidos,$direccion,$telefono,$online){
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
  <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="online" id="si" value="1" <?php if ($online=="1"){ echo "checked='checked'"; } ?>/>
  <label class="form-check-label" for="si">Online</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="online" id="no" value="0" <?php if ($online=="0"){ echo "checked='checked'"; } ?>/> 
  <label class="form-check-label" for="no">Offline</label>
</div>
  <p><button type="submit" class="btn btn-primary" name="guardar" value="guardar">Guardar</button></p>
</form>
<?php
}
?>
<?php
	if($_SESSION["email"]){
?>
<main role="main" class="container">
<br/>
<div class="alert alert-success" role="alert">
		<?php echo "BIENVENIDO ".$_SESSION["email"]; ?>
	</div><br/>
    <h1 class="mt-5">Actualizar usuario</h1>
<?php
	if(!isset($_REQUEST['guardar'])){
		$email=recoge("email");
		
		
		if($email==""){
			header("Location: listaUsuarios.php");
			exit(); //die();
		}
		
		$usu=seleccionarUsuario($email);	
		$email=$usu['email'];
		$nombre=$usu['nombre'];
		$apellidos=$usu['apellidos'];
		$direccion=$usu['direccion'];
		$telefono=$usu['telefono'];
		$online=$usu['online'];
		
		if (empty($usu)){ 
			header("Location: listaUsuarios.php");
			exit();
		}
		imprimirFormulario($email,$nombre,$apellidos,$direccion,$telefono,$online);
		echo "<p><a href='listaUsuarios.php' class='btn btn-primary'>Volver al listado</a></p>";
	}
	else{
		$email=recoge("email");
		$usu=seleccionarUsuario($email);
		$nombre=recoge("nombre");
		$apellidos=recoge("apellidos");
		$direccion=recoge("direccion");
		$telefono=recoge("telefono");
		$online=recoge("online");
			
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
			echo "<h2>Errores</h2> <ul>$errores</ul>";
			imprimirFormulario($email,$nombre,$apellidos,$direccion,$telefono,$online);
			echo "<p><a href='listaUsuarios.php' class='btn btn-primary'>Volver al listado</a></p>";
		}
		else{
			$ok = actualizarUsuario($email,$nombre,$apellidos,$direccion,$telefono,$online);
			
			if ($ok){
				echo "<div class=\"alert alert-success\" role=\"alert\"> Usuario con email $email actualizado correctamente </div>";
				echo "<p><a href='listaUsuarios.php' class='btn btn-primary'>Volver al listado</a></p>";
			}
			else{
				echo "<div class=\"alert alert-danger\" role=\"alert\">ERROR: Tarea NO actualizada </div>";
				imprimirFormulario($email,$nombre,$apellidos,$direccion,$telefono,$online);
				echo "<p><a href='listaUsuarios.php' class='btn btn-primary'>Volver al listado</a></p>";
			}
		}
	}
	}
	else{
		header("Location:index.php");
	}
?>
<br/>
<a href='logout.php' class='btn btn-danger float-right'>CERRAR SESIÓN</a>
</main>
<?php require_once "inc/pie.php"; ?>