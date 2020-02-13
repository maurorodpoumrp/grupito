<?php session_start(); ?>
<?php require_once("bbdd/bbdd.php"); ?>
<?php require_once("inc/funciones.php"); ?>
<?php 	
		$email=$_SESSION['email'];
		$usu = seleccionarUsuario($email);
		$pagina="misdatos";
		$titulo="Regístrate";
?>
<?php require_once("inc/encabezado.php"); ?>
<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Mis datos</h1>
      <p>Datos del usuario </p>
    </div>
  </div>
  
  <div class="container">
  
  </div>
  
  <hr/>
<?php require_once("inc/pie.php"); ?>