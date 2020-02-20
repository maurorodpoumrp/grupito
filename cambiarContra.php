<?php session_start(); ?>
<?php require_once "bbdd/bbdd.php"; ?>
<?php require_once "inc/funciones.php"; ?>
<?php
	$email=recoge("email");
	if($email==""){
		header("Location: index.php");
		exit(); //die();
	}
	$pagina="cambiarContra";
	$titulo="Actualiza tu contraseña";
?>
<?php require_once "inc/encabezado.php"; ?>
<?php
function imprimirFormulario($email){
?>
<form method="post">
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" value='<?php echo "$email";?>'  readonly="readonly"/>
  </div>
  <div class="form-group">
    <label for="OldPassword">Contraseña antigua</label>
    <input type="password" class="form-control" id="OldPassword" name="OldPassword"/>
  </div>
  <div class="form-group">
    <label for="NewPassword1">Contraseña nueva</label>
    <input type="password" class="form-control" id="NewPassword1" name="NewPassword1"/>
  </div>
  <div class="form-group">
    <label for="NewPassword2">Repite la contraseña nueva</label>
    <input type="password" class="form-control" id="NewPassword2" name="NewPassword2"/>
  </div>
  <p>
	<button type="submit" class="btn btn-primary" name="guardar" value="guardar">Guardar</button>
	<a class="btn btn-info" href="misdatos.php" role="button">Volver atrás</a>
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
			
			$usu=seleccionarUsuario($email);	
			$email=$usu['email'];
			
			if (empty($email)){ 
				header("Location: listaUsuarios.php");
				exit();
			}
			imprimirFormulario($email);
		}
		else{
			$email=recoge("email");
			$usu=seleccionarUsuario($email);	
			$OldPassword=recoge("OldPassword");
			$NewPassword1=recoge("NewPassword1");
			$NewPassword2=recoge("NewPassword2");
			
			$okuser = password_verify($OldPassword,$usu["password"]);
			$errores = "";
			
			
			
			if ($okuser==FALSE){
				$errores=$errores."<li>Tu password antigua no es correcta</li>";
			}
			if ($NewPassword1==""){
				$errores=$errores."<li>No puedes dejar la nueva password vacía</li>";
			}
			if ($NewPassword1!=$NewPassword2){
				$errores=$errores."<li>Tienen que coincidir ambas contraseñas</li>";
			}
			
			if($errores!=""){
				echo "<h2>Errores</h2> <ul>$errores</ul>";
				imprimirFormulario($email);
			}
			else{
				$ok = actualizarContra($email,$NewPassword1);
				
				if ($ok){
					echo "<div class=\"alert alert-success\" role=\"alert\"> Contraseña de $email actualizada correctamente </div>";
					header("Location:misdatos.php");
				}
				else{
					echo "<div class=\"alert alert-danger\" role=\"alert\">ERROR: Contraseña NO actualizada </div>";
					imprimirFormulario($email);
				}
			}
		}
	?>
  </div>
</main>
<?php require_once("inc/pie.php"); ?>