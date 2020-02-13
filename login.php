<?php session_start(); ?>
<?php require_once("bbdd/bbdd.php"); ?>
<?php 	$pagina="Indetifícate";
		$titulo="login";
?>
<?php
	function mostrarFormulario(){
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
<?php require_once("inc/funciones.php"); ?>
<?php require_once("inc/encabezado.php"); ?>
<?php
	if (isset($_SESSION['usuario'])){
		header("Location:index.php");
	}
	else{
?>

<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Acceso</h1>
      <p><a href="registro.php">Crea una cuenta</a> si aún no tienes una</p>
    </div>
  </div>
  
	<div class="container">
		<?php
		if(!isset($_REQUEST['acceder'])){
			mostrarFormulario();			
		}	
		else{
			$email=recoge("email");
			$pass=recoge("pass");
			
			$fila=seleccionarUsuario($email);
			
			$usuario=$fila['nombre'];
			
			$ok=password_verify($pass,$fila["password"]);
			if($ok==FALSE){
				echo "<div class=\"alert alert-danger\" role=\"alert\">Email o Contraseña incorrectos</div>";
				mostrarFormulario();
			}
			else{
				$_SESSION["usuario"]=$usuario;
				$_SESSION["email"]=$email;
				header("Location:index.php");
			}
		}
		?>	
	</div>	
</main>
<?php require_once("inc/pie.php"); ?>
<?php
	}
?>