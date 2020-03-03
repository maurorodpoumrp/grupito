<?php session_start(); ?>
<?php 	$pagina="contacto";
		$titulo="Contacta con nosotros";
?>
<?php require_once("inc/funciones.php"); ?>
<?php require_once("inc/encabezado.php"); ?>
<?php
function imprimirFormulario($email,$nombre,$asunto,$contenido){
?>
<form method="post">
  <div class="form-group">
    <label for="email">Pon tu email: </label>
    <input type="text" class="form-control" id="email" name="email" value='<?php if (isset($_SESSION["email"])){ echo $_SESSION["email"]; }else{ "$email"; }?>'/>
  </div>
  <div class="form-group">
    <label for="nombre">Nombre: </label>
    <input type="text" class="form-control" id="nombre" name="nombre" value='<?php if (isset($_SESSION["usuario"])){ echo $_SESSION["usuario"]; }else{ "$nombre"; }?>'/>
  </div>
  <div class="form-group">
    <label for="asunto">Asunto: </label>
    <input type="text" class="form-control" id="asunto" name="asunto" value='<?php echo "$asunto"; ?>'/>
  </div>
  <div class="form-group">
    <label for="contenido">Contenido: </label>
    <textarea class="form-control" id="contenido" name="contenido" value='<?php echo "$contenido"; ?>' rows="3"></textarea>
  </div>
  <p><button type="submit" class="btn btn-primary" name="enviar" value="guardar">Enviar</button></p>
</form>
<?php
}
?>
<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Contacto</h1>
      <p>Formulario de contacto</p>
    </div>
  </div>
  
  <div class="container">
	<?php
	if(!isset($_REQUEST['enviar'])){
		$email="";
		$nombre="";
		$asunto="";
		$contenido="";
		imprimirFormulario($email,$nombre,$asunto,$contenido);
	}
	else{
		$email=recoge("email");
		$nombre=recoge("nombre");
		$asunto=recoge("asunto");
		$contenido=recoge("contenido");
		
		$errores="";
		
		if ($email==""){
			$errores=$errores."<li>No puedes dejar el email vacío</li>";
		}		
		if ($nombre==""){
			$errores=$errores."<li>No puedes dejar el nombre vacío</li>";
		}
		if ($asunto==""){
			$errores=$errores."<li>No puedes dejar el asunto vacío</li>";
		}
		if ($contenido==""){
			$errores=$errores."<li>No puedes dejar el contenido vacío</li>";
		}
		
		if($errores!=""){
			echo "<ul>$errores</ul>";
			imprimirFormulario($email,$nombre,$asunto,$contenido);
		}
		else{
			$mensaje=enviarMail($email,$nombre,$asunto,$contenido);
			
			if($mensaje){
				echo "<div class=\"alert alert-success\" role=\"alert\"> Email enviado correctamente </div>";
				?>
				<a class="btn btn-primary" href="contacto.php" role="button">Enviar otro email</a>
				<?php				
			}
			else{
				echo "<div class=\"alert alert-danger\" role=\"alert\">ERROR: Email NO enviado </div>";
				imprimirFormulario($email,$nombre,$asunto,$contenido);
			}
		}
	}
	?>
  </div>
</main>
<?php require_once("inc/pie.php"); ?>