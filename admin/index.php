<?php session_start(); ?>
<?php require_once "inc/bbdd.php"; ?>
<?php require_once "inc/funciones.php"; ?>
<?php require_once "inc/encabezado.php"; ?>
<?php
	if (isset($_SESSION["email"])){
		header("Location:menu.php");
	}
?>
<?php 
	function imprimirFormulario(){
?>
<form method="post">
  <div class="form-group">
    <label for="email">Email: </label>
    <input type="text" class="form-control" id="email" name="email"/>

  </div>
  <div class="form-group">
    <label for="pass">Contraseña: </label>
    <input type="password" class="form-control" id="pass" name="pass"/>
  </div>
  <button type="submit" class="btn btn-primary" name="acceder" value="acceder">Acceder</button>
</form>
<?php
	}
?>
<main role="main" class="container">
    <h1 class="mt-5">Acceso</h1>
	<?php
		if(!isset($_REQUEST['acceder'])){
			imprimirFormulario();			
		}	
		else{
			$email=recoge("email");
			$pass=recoge("pass");
			
			$fila=seleccionarUsuario($email);
			$ok=password_verify($pass,$fila["password"]);
			if($ok==FALSE){
				echo "<div class=\"alert alert-danger\" role=\"alert\">Email o Contraseña incorrectos</div>";
				imprimirFormulario();
			}
			else{
				$_SESSION["email"]=$email;
				header("Location:menu.php");
			}
		}
	?>

</main>
<?php require_once "inc/pie.php"; ?>