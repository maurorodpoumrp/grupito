<?php session_start(); ?>
<?php require_once "inc/bbdd.php"; ?>
<?php require_once "inc/funciones.php"; ?>
<?php require_once "inc/encabezado.php"; ?>

<?php
function imprimirFormulario($email,$nombre,$apellidos,$direccion,$telefono){
?>
<form method="post">
  <div class="form-group">
    <label for="email">Email: </label>
    <input type="email" class="form-control" id="email" name="email" value='<?php echo "$email"; ?>'/>
  </div>
  <div class="form-group">
    <label for="password">Password: </label>
    <input type="password" class="form-control" id="password" name="password"/>
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
  <button type="submit" class="btn btn-primary" name="guardar" value="guardar">Guardar</button>
</form>
<?php
}
?>

<?php
	if ($_SESSION["email"]){
?>
<main role="main" class="container">
	<br/>
	<div class="alert alert-success" role="alert">
		<?php echo "BIENVENIDO ".$_SESSION["email"]; ?>
	</div><br/>
    <h1 class="mt-5">Insertar nuevo usuario</h1>
<?php
	if(!isset($_REQUEST['guardar'])){
		$email = "";
		$nombre = "";
		$apellidos = "";
		$direccion = "";
		$telefono = "";
		imprimirFormulario($email,$nombre,$apellidos,$direccion,$telefono);
		echo "<p><a href='listaUsuarios.php' class='btn btn-primary'>Volver al listado</a></p>";
	}
	else{
		$email=recoge("email");
		$password=recoge("password");
		$nombre=recoge("nombre");
		$apellidos=recoge("apellidos");
		$direccion=recoge("direccion");
		$telefono=recoge("telefono");
		
		$errores = "";
		
		if ($email==""){
			$errores=$errores."<li>No puedes dejar el email vacío</li>";
		}
		if ($password==""){
			$errores=$errores."<li>No puedes dejar la password vacía</li>";
		}
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
			imprimirFormulario($email,$nombre,$apellidos,$direccion,$telefono);
			echo "<p><a href='listaUsuarios.php' class='btn btn-primary'>Volver al listado</a></p>";
		}
		else{
			$emailok = seleccionarUsuario($email);
			if ($emailok){
				echo "<div class=\"alert alert-danger\" role=\"alert\">ERROR: Usuario NO insertado, ya existe uno con el mismo email </div>";
				$email="";
				imprimirFormulario($email,$nombre,$apellidos,$direccion,$telefono);
				echo "<p><a href='listaUsuarios.php' class='btn btn-primary'>Volver al listado</a></p>";
			}
			$verificar=insertarUsuario($email,$password,$nombre,$apellidos,$direccion,$telefono);
			if ($verificar!=0){
				echo "<div class=\"alert alert-success\" role=\"alert\"> Usuario añadido correctamente </div>";
				echo "<p><a href='listaUsuarios.php' class='btn btn-primary'>Volver al listado</a></p>";
			}
			else{
				echo "<div class=\"alert alert-danger\" role=\"alert\">ERROR: Usuario NO insertado </div>";
				imprimirFormulario($email,$nombre,$apellidos,$direccion,$telefono);
				echo "<p><a href='listaUsuarios.php' class='btn btn-primary'>Volver al listado</a></p>";
			}
			
		}
		}
		}
	else{
		header("Location:menu.php");
	}
?>
<br/>
<a href='logout.php' class='btn btn-danger float-right'>CERRAR SESIÓN</a>
</main>
<?php require_once "inc/pie.php"; ?>