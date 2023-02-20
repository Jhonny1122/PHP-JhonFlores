<?php
	//Reanudamos la sesion.
	session_start();
	
	include("funciones.php");
	
	$fecha=date('y/m/d');
	
	
	//*** Añadir Productos ***//
	if(isset($_POST["anadir"])){
		
		//Guardamos algunos valores dentro de las siguiente variables.
		$producto_code=$_POST["id_producto"];
		
		$cantidad=$_POST["cantidad"];
		
		$precio_unidad=get_precio($producto_code,conexion());
	
		//Comprobamos si no se ha creado la sesion carrito o si no hay nada.
		if(!isset($_SESSION["carrito"])){
			
			//Creamos y guardamos en el array los siguientes valores.
			$producto = array ("OrderLine"=>1,
								"Product_Code"=>$producto_code,
								"Cantidad"=>$cantidad,
								"Precio/Unidad"=>$precio_unidad
								);
			
			//Guardamos en la sesion carrito en la posicion 0 , el array de antes.
			$_SESSION["carrito"][0]=$producto;
		}
		
		//POr otro lado , si ya se ha creado o tiene algo.
		else{
			
			//Guardamos el el total de array que hay dentro de carrito.(Count() solo sirve para contar los arrays)
			$contador = count($_SESSION["carrito"]);
			
			//Guardamos el siguiente array.
			$producto = array ("OrderLine"=>($contador+1),
								"ID_Producto"=>$producto_code,
								"Cantidad"=>$cantidad,
								"Precio"=>$precio_unidad
								);
			
			//Guardamos en carrito en la posicion del contador el array.
			$_SESSION["carrito"][$contador]=$producto;
		}
		
		//Mostramos un vardump del carrito.
		var_dump($_SESSION["carrito"]);
	}
	
	
	//*** Vaciar Productos ***//
	if(isset($_POST["vaciar"])){
		
		unset($_SESSION["carrito"]);
	}
	
	
	//*** Confirmar Productos ***//
	if(isset($_POST["confirmar"])){
		
	}
	
	//*** Pago de Pedido ***//
	
	
	//*** Cerrar Sesion ***//
	if(isset($_POST["salir"])){
		
		destruir_sesion();
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
			if(!isset($_SESSION["usuario"])){
				
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
