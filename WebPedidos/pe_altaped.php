<?php
	session_start();
	/*Guardamos la fecha del sistema*/
	$fechaActual = date('d/m/y'); 
	
	$aCarrito = array();
	
	$sHTML = "";
	
	if(isset($_SESSION['carrito'])) {
		
		$aCarrito = $_SESSION['carrito'];
	
	}
	
	if(isset($_POST["anadir"])){
		
		$iUltimaPos = count($aCarrito);
		
		$aCarrito[$iUltimaPos]['id_producto'] = $_POST["id_prod"];
		
		$aCarrito[$iUltimaPos]['f_pedido'] = $fechaActual;
		
		$aCarrito[$iUltimaPos]['f_solicitud'] = $fechaActual;
		
		$aCarrito[$iUltimaPos]['f_envio'] = $_POST["f_envio"];
		
		$aCarrito[$iUltimaPos]['pago'] = $_POST["num_pago"];	
	
	}
	
	$_SESSION['carrito']=$aCarrito;
	
	foreach ($aCarrito as $key => $value) {
		
		$sHTML .= '-> ' . $value['id_producto'] . ' ' . $value['f_pedido'] . ' ' . $value['pago'] . '<br>';
	
	}

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Compra Pedidos</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
  		<?php
		/*Codigo que permite visualizar el contenido siempre y cuando haya inciado login/sesion*/
			if(!isset($_SESSION["usuario"])){
				
				header("location:pe_login.php");
			}
		?>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <h2>Pedidos</h2>
            <label>Nombre Producto:</label>
            <select name="id_prod">
				<?php
				
					$servername = "localhost";
			
					$username = "root";
					
					$password = "rootroot";
					
					$dbname = "pedidos";
					
					try {
						
						$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
						
						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					 
						$stmt = $conn->prepare("SELECT productCode,productName FROM products WHERE quantityInStock > 0");
							
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
			<label>Fecha Pedido:</label>
			<input type="text" name="f_pedido" placeholder="<?php echo $fechaActual ?>" readonly/><br><br>
			<label>Fecha Solicirud:</label>
			<input type="text" name="f_solicitud" placeholder="<?php echo $fechaActual ?>" readonly/><br><br>
			<label>Fecha Envio:</label>
			<input type="text" name="f_envio"/><br><br>
			<label>Pago:</label>
			<input type="text" name="num_pago" maxlength=7/>
			<input type="text" readonly placeholder="Formato:AA99999"/>
			<br><br>
            <input type="submit" name="anadir" value="Añadir"/>
			<input type="submit" name="comprar" value="Comprar"/><br><br>
        </form>
		<a href="pe_inicio.php">Volver Opciones</a><br><br>
		
		<p>
			<?php echo $sHTML ; var_dump($aCarrito);?>
		</p>
  </body>
</html>

<?php

if(isset($_POST["anadir"])){
	
	$bien_letras=false;
	
	$bien_num = false;
	
	$cont_num=0;
	
	$num_pago = $_POST["num_pago"];
	
	if(empty($num_pago)){
		
		echo "Porfavor , introduzca el numero de pago";
	}
	else{
		
		$p_primera=substr($num_pago, 0 , 2);
		
		$p_segunda=substr($num_pago, 2, 7);
		
		for ($i = 0 ; $i < strlen($p_primera) ; $i++){
			
			if (is_numeric($p_primera[$i])) {
			
				$cont_num++;
			}
		}
		
		if($cont_num == 0)
			
			$bien_letras=true;
			
		if (is_numeric($p_segunda)) {
			
			$bien_num=true;
		}
		
		if($bien_letras == true && $bien_num == true){
			
			echo "El formato de pago estan bien";
		
		}
		else{
			
			echo "El numero de pago es incorrecto";
		}
	}
	
	
}
	
	
	
	
	
	
?>