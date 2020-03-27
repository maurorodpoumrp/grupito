<?php session_start(); ?>
<?php require_once("bbdd/bbdd.php"); ?>
<?php require_once("inc/funciones.php"); ?>
<?php
		$idPedido=recoge("idPedido");
		if($idPedido==""){
			header("Location:adminPedidos.php");
			exit();
		}
		$pagina="editarEstado";
		$titulo="Estado del pedido";
?>

<?php
	function imprimirFormulario($estado){
?>
<form method="post">
	<?php
		$estados=seleccionarEstados();
		foreach($estados as $est){
			$nom=$est["nombreEstado"];
	?>
	<div class="form-check form-check-inline">
		<input class="form-check-input" type="radio" name="estado" id="<?php echo $nom; ?>" value="<?php echo $nom; ?>" <?php if ($estado==$nom){ echo "checked='checked'"; } ?>/>
		<label class="form-check-label" for="<?php echo "$nom"; ?>"><?php echo "$nom"; ?></label>
	</div>
	<?php
		}
	?>
	<p>
		<button type="submit" class="btn btn-primary" name="guardar" value="guardar">Guardar</button>
  </p>
</form>
<?php
	}
?>

<?php require_once("inc/encabezado.php"); ?>
<main role="main">
	<?php
		$pedido=seleccionarPedido($idPedido);
		$estado=$pedido["estado"];
	?>
  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
	<h1 class="display-3">Estado del pedido <?php echo $idPedido; ?></h1>
	<p class="text-left">
		<strong>Estado actual:</strong> <?php echo $estado; ?>	
	</p>
	</div>
  </div>
  <div class="container">
	<h2>Selecciona el estado del pedido:</h2>
	<?php
	if(!isset($_REQUEST['guardar'])){
		imprimirFormulario($estado);
		?>
		<a class="btn btn-warning" href="adminDetallepedido.php?idPedido=<?php echo $idPedido; ?>" role="button">Volver atrás</a>
		<?php
	}
	else{
		$estado=recoge("estado");
		$idPedido=recoge("idPedido");
		
		$ok = actualizarEstado($estado,$idPedido);
		if($ok){
			echo "<div class=\"alert alert-success\" role=\"alert\"> Estado del pedido $idPedido puesto a $estado </div>";
			?> 
			<a class="btn btn-warning" href="adminDetallepedido.php?idPedido=<?php echo $idPedido; ?>" role="button">Volver atrás</a>
			<?php
		}
		else{
			echo "<div class=\"alert alert-danger\" role=\"alert\">ERROR: Estado NO actualizado </div>";
			imprimirFormulario($estado);
		}
	}
	?>
 </div>
  
</main>
<?php require_once "inc/pie.php"; ?>
  
 