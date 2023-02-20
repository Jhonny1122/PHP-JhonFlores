<?php
	
	include("funciones.php");
	
	$fecha=date('y/m/d');
	
	$aCarrito = array();
	
	//*** Añadir Productos ***//
	if(isset($_POST["anadir"])){
		
		$producto_code=$_POST["id_producto"];
		
		$cantidad=$_POST["cantidad"];
		
		$precio_unidad=get_precio($producto_code,conexion());
	
		$aCarrito = array();

		//Obtenemos los productos anteriores
		if(isset($_COOKIE['carrito'])) {
			
			$aCarrito = unserialize($_COOKIE['carrito']);
		}

		//Anyado un nuevo articulo al carrito
		if(isset($producto_code) && isset($cantidad)) {
			
			$iUltimaPos = count($aCarrito);
			
			$aCarrito[$iUltimaPos]['ID_Producto'] = $producto_code;
			
			$aCarrito[$iUltimaPos]['Cantidad'] = $cantidad;
			
			$aCarrito[$iUltimaPos]['Precio/unidad'] = $precio_unidad;
			
		}

		//Creamos la cookie (serializamos)
		
		setcookie('carrito', serialize($aCarrito), time() + (60 * 60));

		var_dump($aCarrito);

	}
	
	
	//*** Vaciar Productos ***//
	if(isset($_POST["vaciar"])){
		
		setcookie("carrito","",time() + (60 * 60));
	}
	
	
	//*** Confirmar Productos ***//
	if(isset($_POST["confirmar"])){
		
	}
	
	//*** Pago de Pedido ***//
	
	
	//*** Cerrar Sesion ***//
	if(isset($_POST["salir"])){
		
		destruir_cookie();
	}

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alta Pedido</title>
  </head>
  <body>
		<?php
			if(!isset($_COOKIE["usuario"])){
				
				header("location:index.php");
			}
		?>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
			<h2>Alta Pedidos</h2>
			
			<label>Producto</label>
			<select name="id_producto">
			<?php
			
				$conn = conexion();
				
				try {
					
					$stmt = $conn->prepare("SELECT productCode , productName FROM products WHERE quantityInStock > 0");
							
					$stmt->execute();
							
					$stmt->setFetchMode(PDO::FETCH_ASSOC);
								
					$resultado=$stmt->fetchAll();
								 
					foreach($resultado as $row) {
									 
						$code_prod=$row["productCode"];
									
						$nomb_prod=$row["productName"];
						
			?>
			<option value="<?php echo $code_prod?>"><?php echo $nomb_prod ?></option>
			<?php
					}
						
				}
				catch(PDOException $e) {
						
					echo "Error: " . $e->getMessage();
				}				
			?>			
			</select><br><br>
			
			<label>Cantidad</label>
			<input type="text" name="cantidad"/><br><br>
			
			<label>CheckPago</label>
			<input type="text" name="checkpago"/><br><br>
			
			<input type="submit" name="anadir" value="Añadir"/>
			<input type="submit" name="vaciar" value="Vaciar"/>
			<input type="submit" name="confirmar" value="Confirmar Productos"/>
			<input type="submit" name="pago" value="Pagar"/>
			<input type="submit" name="salir" value="Cerrar Sesion"/>
			
		</form>
  </body>
</html>
