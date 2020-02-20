<?php session_start(); ?>
<?php require_once("bbdd/bbdd.php"); ?>
<?php require_once("inc/funciones.php"); ?>
<?php
	$pagina = "confirmarPedido";
	$titulo = "Confirma tu pedido";
?>
<?php require_once("inc/encabezado.php"); ?>
<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Confirmar carrito de la compra</h1>
      <p><a class="btn btn-primary btn-lg" href="carrito.php" role="button">Volver al carrito »</a></p>
    </div>
  </div>
  <div class="container">
	<?php
		if (!isset($_SESSION['carrito'])){
			header("Location:index.php");
			exit();
		}
		$carrito=$_SESSION['carrito'];
		
		if(!isset($_SESSION['email'])){
			echo "<div class=\"alert alert-danger\" role=\"alert\">ERROR: No te encuentras logueado </div>";
			echo "<p><a class=\"btn btn-primary\" href=\"login.php\" role=\"button\">Ir al login</a></p>";
		}
		else{
			$email=$_SESSION['email'];
		
			$usu=seleccionarUsuario($email);
			$idUsuario=$usu['idUsuario'];
			
			$total=$_SESSION['total'];
			
			$idPedido = insertarPedido($idUsuario, $carrito, $total);
			
			if($idPedido!=0){
				unset($_SESSION['carrito']);
				echo "<div class=\"alert alert-success\" role=\"alert\">Pedido $idPedido insertado correctamente </div>";
				echo "<p><a class=\"btn btn-primary\" href=\"index.php\" role=\"button\">Volver al index</a></p>";
			}
			else{
				echo "<div class=\"alert alert-danger\" role=\"alert\">ERROR: Pedido NO insertado </div>";
			}
		}
		
	?>
  </div>
</main>
<?php require_once("inc/pie.php"); ?> 