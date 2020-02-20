<?php include "configuracion.php"; ?>

<?php
//Función para conectar a la Base de Datos
function conectarBD(){
	try{
		$con = new PDO("mysql:host=".HOST.";dbname=".DBNAME.";charset=utf8", USER, PASS);
	
		$con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		echo "Error: Error al conectar la BD: ".$e->getMessage();
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $con;
}

//Función para desconectar de la base de datos
function desconectarBD($con){
	$con = NULL;
	return $con;
}

//Función para insertar producto
function insertarProducto($nombre,$introDescripcion,$descripcion,$imagen,$precio,$precioOferta,$online){
	$con=conectarBD();
	
	try{
		$sql = "INSERT INTO productos (nombre,introDescripcion,descripcion,imagen,precio) VALUES (:nombre,:introDescripcion,:descripcion,:imagen,:precio)";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':nombre',$nombre);
		$stmt->bindParam(':introDescripcion',$introDescripcion);
		$stmt->bindParam(':precio',$precio);
		$stmt->bindParam(':precioOferta',$precioOferta);
		$stmt->bindParam(':online',$online);
		
		$stmt->execute();
	}
	catch(PDOException $e){
		echo "Error: Error al insertar producto: ".$e->getMessage();
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
		exit;
	}
	
	return $con->lastInsertID();
}

//Función para actualizar producto
function actualizarProducto($idProducto,$nombre,$introDescripcion,$descripcion,$precio,$precioOferta,$online){
	$con=conectarBD();
	try{
		$sql = "UPDATE productos SET nombre=:nombre, introDescripcion=:introDescripcion, descripcion=:descripcion, precio=:precio, precioOferta=:precioOferta, online=:online WHERE idProducto=:idProducto";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':nombre',$nombre);
		$stmt->bindParam(':introDescripcion',$introDescripcion);
		$stmt->bindParam(':precio',$precio);
		$stmt->bindParam(':precioOferta',$precioOferta);
		$stmt->bindParam(':online',$online);
		
		$stmt->execute();
		
	}
	catch(PDOException $e){
		echo "Error: Error al actualizar producto: ".$e->getMessage();
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
		exit;
	}
	
	return $stmt->rowCount();
}

//Función borrar producto
function borrarProducto($idProducto){
	$con=conectarBD();
	try{
		$sql = "DELETE FROM productos WHERE idProducto=:idProducto";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':idProducto',$idProducto);
		
		$stmt->execute();
	}
	catch(PDOException $e){
		echo "Error: Error al eliminar producto: ".$e->getMessage();
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
		exit;
	}
	
	return $stmt->rowCount();
}

//Función seleccionarTodosProductos
function seleccionarTodasOfertas(){
	$con=conectarBD();
	try{
		$sql = "SELECT * FROM productos";
		
		$stmt = $con->prepare($sql);
		
		$stmt->execute();
		
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC); //usamos fetchAll cuando puede devolver más de una fila
	}
	catch(PDOException $e){
		echo "Error: Error al seleccionar todos los productos: ".$e->getMessage();
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
		exit;
	}
	
	return $rows;
}

//Función seleccionar un producto
function seleccionarProducto($idProducto){
	$con=conectarBD();
	try{
		$sql = "SELECT * FROM productos WHERE idProducto=:idProducto";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':idProducto',$idProducto);
		
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC); //usamos fetch cuando sabemos que solamente nos devolverá una fila
	}
	catch(PDOException $e){
		echo "Error: Error al seleccionar una oferta: ".$e->getMessage();
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
		exit;
	}
	
	return $row;
}

//Función seleccionarProducto
function seleccionarProductos($inicio,$productosPagina){
	$con=conectarBD();
	try{
		$sql = "SELECT * FROM productos LIMIT :inicio , :productosPagina";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':inicio',$inicio, PDO::PARAM_INT); //Cuando necesito un valor entero, hace falta el PDO::PARAM_INT
		$stmt->bindParam(':productosPagina',$productosPagina, PDO::PARAM_INT);
		
		$stmt->execute();
		
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e){
		echo "Error: Error al seleccionar productos: ".$e->getMessage();
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
		exit;
	}
	
	return $rows;
}

//Fincion seleccionar ofertas de la portada
function seleccionarOfertasPortada($numOfertas){
	$con=conectarBD();
	try{
		$sql = "SELECT * FROM productos LIMIT :numOfertas";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':numOfertas',$numOfertas, PDO::PARAM_INT);
		
		$stmt->execute();
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e){
		echo "Error: Error al seleccionar productos: ".$e->getMessage();
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $row;
}

//Función seleccionar usuario
function seleccionarUsuario($email){
	$con=conectarBD();
	try{
		$sql = "SELECT * FROM usuarios WHERE email=:email";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':email',$email);
		
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e){
		echo "Error: Error al seleccionar un usuario: ".$e->getMessage();
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $row;
}

//Función seleccionarTodosUsuarios
function seleccionarTodosUsuarios(){
	$con=conectarBD();
	try{
		$sql = "SELECT * FROM usuarios";
		
		$stmt = $con->query($sql);
		
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC); //usamos fetchAll cuando puede devolver más de una fila
	}
	catch(PDOException $e){
		echo "Error: Error al seleccionar todos los usuarios: ".$e->getMessage();
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
		exit;
	}
	
	return $rows;
}

//Función seleccionarUsuarios
function seleccionarUsuarios($inicio,$usuariosPagina){
	$con=conectarBD();
	try{
		$sql = "SELECT * FROM usuarios LIMIT :inicio , :usuariosPagina";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':inicio',$inicio, PDO::PARAM_INT); //Cuando necesito un valor entero, hace falta el PDO::PARAM_INT
		$stmt->bindParam(':usuariosPagina',$usuariosPagina, PDO::PARAM_INT);
		
		$stmt->execute();
		
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e){
		echo "Error: Error al seleccionar usuarios: ".$e->getMessage();
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
		exit;
	}
	
	return $rows;
}

//Función añadir usuario
function insertarUsuario($email,$password,$nombre,$apellidos,$direccion,$telefono){
	$con=conectarBD();
	$password=password_hash($password,PASSWORD_DEFAULT);
	try{
		$sql = "INSERT INTO usuarios (email,password,nombre,apellidos,direccion,telefono) VALUES (:email,:password,:nombre,:apellidos,:direccion,:telefono)";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':email',$email);
		$stmt->bindParam(':password',$password);
		$stmt->bindParam(':nombre',$nombre);
		$stmt->bindParam(':apellidos',$apellidos);
		$stmt->bindParam(':direccion',$direccion);
		$stmt->bindParam(':telefono',$telefono);
		
		$stmt->execute();
		
	}
	catch(PDOException $e){
		echo "Error: Error al crear un usuario: ".$e->getMessage();
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
		exit;
	}
	
	return $stmt->rowCount();
}

//Función para actualizarContra
function actualizarContra($email,$password){
	$con=conectarBD();
	$password=password_hash($password,PASSWORD_DEFAULT);
	try{
		$sql = "UPDATE usuarios SET password=:password WHERE email=:email";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':email',$email);
		$stmt->bindParam(':password',$password);
		
		$stmt->execute();
		
	}
	catch(PDOException $e){
		echo "Error: Error al actualizar usuario: ".$e->getMessage();
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
		exit;
	}
	
	return $stmt->rowCount();
}

//Función para actualizarUsuario
function actualizarUsuario($email,$nombre,$apellidos,$direccion,$telefono){
	$con=conectarBD();
	
	try{
		$sql = "UPDATE usuarios SET nombre=:nombre, apellidos=:apellidos, direccion=:direccion, telefono=:telefono WHERE email=:email";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':email',$email);
		$stmt->bindParam(':nombre',$nombre);
		$stmt->bindParam(':apellidos',$apellidos);
		$stmt->bindParam(':direccion',$direccion);
		$stmt->bindParam(':telefono',$telefono);
		
		$stmt->execute();
		
	}
	catch(PDOException $e){
		echo "Error: Error al actualizar usuario: ".$e->getMessage();
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
		exit;
	}
	
	return $stmt->rowCount();
}

//Función BorrarTarea
function borrarUsuario($email){
	$con=conectarBD();
	try{
		$sql = "DELETE FROM usuarios WHERE email=:email";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':email',$email);
		
		$stmt->execute();
	}
	catch(PDOException $e){
		echo "Error: Error al eliminar usuario: ".$e->getMessage();
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
		exit;
	}
	
	return $stmt->rowCount();
}

//Funcion insertarPedido
function insertarPedido($idUsuario, $detallePedido, $total){
	$con=conectarBD();
	try{
		$con -> beginTransaction();
		$sql = "INSERT INTO pedidos(idUsuario,total) VALUES(:idUsuario,:total)";
		$sentencia = $con->prepare($sql);
		$sentencia->bindParam(':idUsuario',$idUsuario);
		$sentencia->bindParam(':total',$total);
		$sentencia->execute();
		
		$idPedido = $con->lastInsertID();
		foreach ($detallePedido as $idProducto=>$cantidad){
			$producto=seleccionarProducto($idProducto);
			$precio=$producto['precioOferta'];
			$sql2="INSERT INTO detallepedido(idPedido,idProducto,cantidad,precio) VALUES(:idPedido,:idProducto,:cantidad,:precio)";
			$sentencia= $con->prepare($sql2);
			$sentencia->bindParam(':idPedido',$idPedido);
			$sentencia->bindParam(':idProducto',$idProducto);
			$sentencia->bindParam(':cantidad',$cantidad);
			$sentencia->bindParam(':precio',$precio);
			
			$sentencia->execute();
		}
		$con->commit();
	}
	catch(PDOException $e){
		
		$con->rollback();
		echo "Error: Error al insertar pedido: ".$e->getMessage();
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
		exit;
		
	}
	return $idPedido;
}

//Funcion seleccionarPedidos
function seleccionarPedidos($idUsuario){
	$con=conectarBD();
	try{
		$sql = "SELECT * FROM pedidos WHERE idUsuario=:idUsuario";
		
		$stmt = $con->prepare($sql);
		$stmt->bindParam(':idUsuario',$idUsuario);
		$stmt->execute();
		
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e){
		echo "Error: Error al seleccionar pedidos: ".$e->getMessage();
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $rows;
}
?>