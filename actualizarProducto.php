<?php session_start(); ?>
<?php require_once "bbdd/bbdd.php"; ?>
<?php require_once "inc/funciones.php"; ?>
<?php 	
		$pagina="actualizarProducto";
		$titulo="Actualizar Producto";
?>
<?php
function imprimirFormulario($idProducto,$nombre,$introDescripcion,$descripcion,$imagen,$precio,$precioOferta,$online){
?>
<form method="post">
  <div class="form-group">
    <label for="idProducto">ID</label>
    <input type="text" class="form-control" id="idProducto" name="idProducto" value='<?php echo "$idProducto";?>'  readonly="readonly"/>
  </div>
  <div class="form-group">
    <label for="nombre">Nombre: </label>
    <input type="text" class="form-control" id="nombre" name="nombre" value='<?php echo "$nombre"; ?>'/>
  </div>
  <div class="form-group">
    <label for="introDescripcion">introDescripcion: </label>
    <input type="text" class="form-control" id="introDescripcion" name="introDescripcion" value='<?php echo "$introDescripcion"; ?>'/>
  </div>
  <div class="form-group">
    <label for="descripcion">Descripción: </label>
    <input type="text" class="form-control" id="descripcion" name="descripcion" value='<?php echo "$descripcion"; ?>'/>
  </div>
  <div class="form-group">
    <label for="imagen">Imágen: </label>
    <input type="text" class="form-control" id="imagen" name="imagen" value='<?php echo "$imagen"; ?>'/>
  </div>
  <div class="form-group">
    <label for="precio">Precio: </label>
    <input type="text" class="form-control" id="precio" name="precio" value='<?php echo "$precio"; ?>'/>
  </div>
  <div class="form-group">
    <label for="precioOferta">Precio Oferta: </label>
    <input type="text" class="form-control" id="precioOferta" name="precioOferta" value='<?php echo "$precioOferta"; ?>'/>
  </div>
  <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="online" id="si" value="1" <?php if ($online=="1"){ echo "checked='checked'"; } ?>/>
  <label class="form-check-label" for="si">Online</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="online" id="no" value="0" <?php if ($online=="0"){ echo "checked='checked'"; } ?>/> 
  <label class="form-check-label" for="no">Offline</label>
</div>
  <p><button type="submit" class="btn btn-primary" name="guardar" value="guardar">Guardar</button></p>
</form>
<?php
}
?>

<?php require_once "inc/encabezado.php"; ?>
<main role="main">
  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Editar una oferta</h1>
    </div>
  </div>
  <div class="container">
<?php
	if(!isset($_REQUEST['guardar'])){
		$idProducto=recoge("idProducto");
		
		
		if($idProducto==""){
			header("Location: adminProductos.php");
			exit(); //die();
		}
		
		$producto=seleccionarProducto($idProducto);	
		$nombre=$producto['nombre'];
		$introDescripcion=$producto['introDescripcion'];
		$descripcion=$producto['descripcion'];
		$imagen=$producto['imagen'];
		$precio=$producto['precio'];
		$precioOferta=$producto['precioOferta'];
		$online=$producto['online'];
		
		if (empty($producto)){ 
			header("Location: listaProductos.php");
			exit();
		}
		imprimirFormulario($idProducto,$nombre,$introDescripcion,$descripcion,$imagen,$precio,$precioOferta,$online);
		echo "<p><a href='adminProductos.php' class='btn btn-primary'>Volver al listado</a></p>";
	}
	else{
		$idProducto=recoge("idProducto");
		$producto=seleccionarProducto($idProducto);
		$nombre=recoge("nombre");
		$introDescripcion=recoge("introDescripcion");
		$descripcion=recoge("descripcion");
		$imagen=recoge("imagen");
		$precio=recoge("precio");
		$precioOferta=recoge("precioOferta");
		$online=recoge("online");
			
		$errores = "";
		
		if ($nombre==""){
			$errores=$errores."<li>No puedes dejar el nombre vacío</li>";
		}		
		if ($introDescripcion==""){
			$errores=$errores."<li>No puedes dejar la introDescripcion vacía</li>";
		}
		if ($descripcion==""){
			$errores=$errores."<li>No puedes dejar la descripcion vacía</li>";
		}
		if ($imagen==""){
			$errores=$errores."<li>No puedes dejar la imágen vacía</li>";
		}
		if ($precio==""){
			$errores=$errores."<li>No puedes dejar el precio vacío</li>";
		}
		if ($precioOferta==""){
			$errores=$errores."<li>No puedes dejar el precio de oferta vacío</li>";
		}
		if ($precio<$precioOferta){
			$errores=$errores."<li>No puedes tener más precio que el de oferta</li>";
		}
		if($errores!=""){
			echo "<h2>Errores</h2> <ul>$errores</ul>";
			imprimirFormulario($idProducto,$nombre,$introDescripcion,$descripcion,$imagen,$precio,$precioOferta,$online);
			echo "<p><a href='adminProductos.php' class='btn btn-primary'>Volver al listado</a></p>";
		}
		else{
			$ok = actualizarProducto($nombre,$introDescripcion,$descripcion,$imagen,$precio,$precioOferta,$online,$idProducto);
			
			if ($ok){
				echo "<div class=\"alert alert-success\" role=\"alert\"> Producto actualizado correctamente </div>";
				echo "<p><a href='adminProductos.php' class='btn btn-primary'>Volver al listado</a></p>";
			}
			else{
				echo "<div class=\"alert alert-danger\" role=\"alert\">ERROR: Producto NO actualizado </div>";
				imprimirFormulario($idProducto,$nombre,$introDescripcion,$descripcion,$imagen,$precio,$precioOferta,$online);
				echo "<p><a href='adminProductos.php' class='btn btn-primary'>Volver al listado</a></p>";
			}
		}
	}
?>
</div>
</main>
<?php require_once "inc/pie.php"; ?>