<?php

	if(isset($_COOKIE["nif_cliente"])){
					
		$nif_cliente=$_COOKIE["nif_cliente"];
	}

?>

<?php
	
	include("funciones.php");
	
	/*** Zona crear lista cesta ***/
	
	$aCarrito = array(); 
	
	$sHTML = '';
	
	$mensaje = '';
	
	// Obtenemos los productos anteriores
	if(isset($_COOKIE['carrito'])) {
		
		$aCarrito = unserialize($_COOKIE['carrito']);
	
	}
	
	//Comprobamos si ha dado click en anadir.
	if(isset($_POST["anadir"])){
		
		//Condicion donde comprobamos que no ha dejado los campos vacios.
		if(empty($_POST['prod']) || empty($_POST['cant']) || empty($_POST['fech_comp'])){
			
			//Imprimimos mensajes de error.
			$mensaje .= "<h4>Se necesita rellenar todos los campos</h4>";
		}
		else{
			//Variable que guarda true o false , dependiendo de la funcion(Comprueba si la cantidad solicitada es mayor o menos a la almacenada).
			$ok=comprobar_cant($_POST['prod'],$_POST['cant'],conexion());
			
			//Si la variable es true hacemos lo siguiente.
			if($ok == true){
				
				$iUltimaPos = count($aCarrito);
		
				$aCarrito[$iUltimaPos]['producto'] = $_POST['prod'];
				
				$nomb_prod = obtener_nombre($_POST['prod'],conexion());
				
				$aCarrito[$iUltimaPos]['nombre'] = $nomb_prod;
				
				$aCarrito[$iUltimaPos]['cantidad'] = $_POST['cant'];
				
				$precio_prod = obtener_precio($_POST['prod'],conexion());
				
				$aCarrito[$iUltimaPos]['precio/unidad'] = $precio_prod;
				
				$aCarrito[$iUltimaPos]['fecha'] = $_POST['fech_comp'];
				
				$precio_total=obtener_precio_total($_POST['prod'],$_POST['cant'],conexion());
				
				$aCarrito[$iUltimaPos]['precio/total'] = $precio_total;
				
				//Creamos la cookie (serializamos)
				setcookie('carrito', serialize($aCarrito), time() + (120 * 80));
				
				//var_dump($aCarrito);
				
				//Imprimimos el contenido del array
				foreach ($aCarrito as $key => $value) {
					
					$sHTML .= '<h4>' . $value['nombre'] . '</h4>' . 
									   'Unidades: ' . $value['cantidad'] . '<br>' .  
									   'Precio/u: ' . $value['precio/unidad'] . '$' . '<br>' . 
									   'Fecha ' . $value['fecha'] . '<br>' .
									   'Precio/total= ' . $value['precio/total'] . '<br>';	
				}	
			}
		}	
	}
	/*** Fin zona crear cesta ***/
	
	
	
	/*** Zona vaciar cesta compra ***/

	//Vaciamos el carrito
	if(isset($_POST['vaciar'])) {
		
		setcookie('carrito','',time()-100);
		
		$sHTML = '';
		
	}

	/*** Fin ona vaciar cesta compra ***/
	
	
	
	/*** Zona comprar ***/
	
	$sHTML2 = '';
	
	$fPrecioTotal = 0;
	
	if(isset($_POST['comprar'])){
		
		foreach ($aCarrito as $key => $value) {
			
			$fPrecioTotal += $value['precio/total'];
		}
		
		$sHTML2 .= '<br>------------------<br>Precio total: ' . $fPrecioTotal . '$';
		
	}
	
	/*** Fin zona comprar***/
	
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra de Productos</title>
</head>
<body>
    <div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <h2>Compra de Productos</h2>
			<label>Producto:</label>
            <select name="prod">
				<?php
				
					$servername = "localhost";
			
					$username = "root";
					
					$password = "rootroot";
					
					$dbname = "comprasweb";
					
					try {
						
						$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
						
						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					 
						$stmt = $conn->prepare("SELECT ID_PRODUCTO , NOMBRE FROM PRODUCTO");
							
						$stmt->execute();
							
						$stmt->setFetchMode(PDO::FETCH_ASSOC);
							
						$resultado=$stmt->fetchAll();
							 
						foreach($resultado as $row) {
								 
							$id_prod=$row["ID_PRODUCTO"];
								
							$nomb_prod=$row["NOMBRE"];
								
						?>
							<option value="<?php echo $id_prod?>"><?php echo $nomb_prod ?></option>
						<?php
						}
						
					}
					catch(PDOException $e) {
						
						echo "Error: " . $e->getMessage();
					}
				
				?>
			</select><br><br>
			<label>Fecha Compra</label>
			<input type="date" name="fech_comp"/><br><br>
			<label>Cantidad</label>
			<input type="text" name="cant"/><br><br><br>
            <input type="submit" name="anadir" value="Añadir" />
			<input type="submit" name="comprar" value="Comprar" />
			<input type="submit" name="vaciar" value="Vaciar" />
        </form>
    </div>
	<div>
		<?php 
			echo "<h2>Lista de Compras </h2>";
			
			echo $sHTML;  
			
			echo $sHTML2; 
			
			echo $mensaje;		
		?>
	</div>
</body>
</html>
