<?php session_start(); ?>
<?php require_once "inc/bbdd.php"; ?>
<?php require_once "inc/funciones.php"; ?>
<?php require_once "inc/encabezado.php"; ?>

<?php
function imprimirFormulario($nombre,$introDescripcion,$descripcion,$imagen,$precio,$precioOferta){
?>
<form method="post">
  <div class="form-group">
    <label for="nombre">Nombre: </label>
    <input type="text" class="form-control" id="nombre" name="nombre" value='<?php echo "$nombre"; ?>'/>
  </div>
  <div class="form-group">
    <label for="introDescripcion">introDescripción: </label>
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
  <button type="submit" class="btn btn-primary" name="guardar" value="guardar">Guardar</button>
</form>
<?php
}
?>

<?php
	if ($_SESSION["email"]){
?>
<main role="main" class="container">
	<br/>
	<div class="alert alert-success" role="alert">
		<?php echo "BIENVENIDO ".$_SESSION["email"]; ?>
	</div><br/>
    <h1 class="mt-5">Insertar nuevo producto</h1>
	
<?php
	if(!isset($_REQUEST['guardar'])){
		$nombre = "";
		$introDescripcion = "";
		$descripcion = "";
		$imagen = "";
		$precio = "";
		$precioOferta = "";
		imprimirFormulario($nombre,$introDescripcion,$descripcion,$imagen,$precio,$precioOferta);
		echo "<p><a href='listaUsuarios.php' class='btn btn-primary'>Volver al listado</a></p>";
	}
	else{
		$nombre=recoge("nombre");
		$introDescripcion=recoge("introDescripcion");
		$descripcion=recoge("descripcion");
		$imagen=recoge("imagen");
		$precio=recoge("precio");
		$precioOferta=recoge("precioOferta");
		
		$errores = "";
		
		if ($nombre==""){
			$errores=$errores."<li>No puedes dejar el nombre vacío</li>";
		}
		if ($introDescripcion==""){
			$errores=$errores."<li>No puedes dejar la introDescripción vacía</li>";
		}
		if ($descripcion==""){
			$errores=$errores."<li>No puedes dejar la descripción vacío</li>";
		}		
		if ($imagen==""){
			$errores=$errores."<li>No puedes dejar la imágen vacíos</li>";
		}
		if ($precio==""){
			$errores=$errores."<li>No puedes dejar el precio vacía</li>";
		}
		if ($precioOferta==""){
			$errores=$errores."<li>No puedes dejar el precio Oferta vacío</li>";
		}
		if($errores!=""){
			echo "<h2>Errores</h2> <ul>$errores</ul>";
			imprimirFormulario($nombre,$introDescripcion,$descripcion,$imagen,$precio,$precioOferta);
			echo "<p><a href='listaUsuarios.php' class='btn btn-primary'>Volver al listado</a></p>";