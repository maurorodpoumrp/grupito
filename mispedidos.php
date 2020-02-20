<?php session_start(); ?>
<?php require_once("bbdd/bbdd.php"); ?>
<?php require_once("inc/funciones.php"); ?>
<?php
		$email=$_SESSION['email'];
		$usu = seleccionarUsuario($email);
		$idUsuario=$usu['idUsuario'];
		
		$pagina="mispedidos";
		$titulo="Mis pedidos";
?>
<?php require_once("inc/encabezado.php"); ?>
<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Mis pedidos</h1>
      <p>Pedidos del usuario <?php echo $email; ?></p>
    </div>
  </div>
  
  <div class="container">
	<?php
	
	?>
  </div>
</main>
<?php require_once("inc/pie.php"); ?>