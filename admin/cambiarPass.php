<?php session_start(); ?>
<?php require_once "inc/bbdd.php"; ?>
<?php require_once "inc/funciones.php"; ?>
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
  <button type="submit" class="btn btn-primary" name="guardar" value="guardar">Guardar</button>
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
    <h1 class="mt-5">Cambiar contraseña</h1>
<?php
	if(!isset($_REQUEST['guardar'])){
		
		$email=recoge("email");
		
		
		if($email==""){
			header("Location: listaUsuarios.php");
			exit(); //die();
		}
		
		$usu=seleccionarUsuario($email);	
		$email=$usu['email'];
		
		if (empty($email)){ 
			header("Location: listaUsuarios.php");
			exit();
		}
		imprimirFormulario($email);
	echo "<p><a href='listaUsuarios.php' class='btn btn-primary'>Volver al listado</a></p>";
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
			$ok = actualizarPassword($email,$NewPassword1);
			
			if ($ok){
				echo "<div class=\"alert alert-success\" role=\"alert\"> Contraseña de $email actualizada correctamente </div>";
				echo "<p><a href='listaUsuarios.php' class='btn btn-primary'>Volver al listado</a></p>";
			}
			else{
				echo "<div class=\"alert alert-danger\" role=\"alert\">ERROR: Usuario NO actualizada </div>";
				imprimirFormulario($email);
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