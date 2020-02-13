<?php session_start(); ?>
<?php require_once("bbdd/bbdd.php"); ?>
<?php 	$pagina="registro";
		$titulo="Regístrate";
?>
<?php require_once("inc/funciones.php"); ?>
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
   <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
  <button type="submit" class="btn btn-primary" name="guardar" value="guardar">Guardar</button>
</form>
<?php
}
?>
<?php require_once("inc/encabezado.php"); ?>
<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Regístrate</h1>
      <p>Introduzca sus datos en esta página</p>
    </div>
  </div>
  
  <div class="container">
	
	<?php
		if(!isset($_REQUEST['guardar'])){
			$email = "";
			$nombre = "";
			$apellidos = "";
			$direccion = "";
			$telefono = "";
			imprimirFormulario($email,$nombre,$apellidos,$direccion,$telefono);
		}
		else{
			$email=recoge("email");
			$password=recoge("password");
			$nombre=recoge("nombre");
			$apellidos=recoge("apellidos");
			$direccion=recoge("direccion");
			$telefono=recoge("telefono");
			
			$errores = "";
			
			$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify'; 
			$recaptcha_secret = CLAVE_SECRETA; 
			$recaptcha_response = recoge("recaptcha_response"); 
			$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response); 
			$recaptcha = json_decode($recaptcha); 

			if($recaptcha->score < 0.7){
			  $errores=$errores."<li>Detectado robot</li>";
			}
			
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
			}
			else{
				$emailok = seleccionarUsuario($email);
				if ($emailok){
					echo "<div class=\"alert alert-danger\" role=\"alert\">ERROR: Usuario NO insertado, ya existe uno con el mismo email </div>";
					$email="";
					imprimirFormulario($email,$nombre,$apellidos,$direccion,$telefono);
				}
				$verificar=insertarUsuario($email,$password,$nombre,$apellidos,$direccion,$telefono);
				if ($verificar!=0){
					echo "<div class=\"alert alert-success\" role=\"alert\"> Usuario creado correctamente (Inicia sesión arriba a la derecha) </div>";
				}
				else{
					echo "<div class=\"alert alert-danger\" role=\"alert\">ERROR: Usuario NO insertado </div>";
					imprimirFormulario($email,$nombre,$apellidos,$direccion,$telefono);
				}
			}
		}
	?>

    <hr>

  </div> <!-- /container -->
  
  
</main>
<?php require_once("inc/pie.php"); ?>