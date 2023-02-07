<?php
	session_start();
	
	$fechaActual = date('d/m/y');
	
	$producto = array();
	
	$sHTML = " ";
	
	$mensaje_err = " ";
	
	if(isset($_POST["anadir"])){
		
		$pago_ok=false;
		
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
				
				$pago_ok=true;
			
			}
			else{
				
				$mensaje_err = "<b>El numero de pago es incorrecto, vuelve a introducirlo</b>";
			}
		}
		
		if($pago_ok == true ){
			
			if(!isset($_SESSION["carrito"])){
		
				$producto = array ("ID_Producto"=>$_POST["id_prod"],
									"F_pedido"=>$_POST["f_pedido"],
									"F_solicitud"=>$_POST["f_solicitud"],
									"F_Envio"=>$_POST["f_envio"],
									"Pago"=>$_POST["num_pago"]
									);
				$_SESSION["carrito"][0]=$producto;
			}
			else{
				
				$contador = count($_SESSION["carrito"]);
				
				$producto = array ("ID_Producto"=>$_POST["id_prod"],
									"F_pedido"=>$fechaActual,
									"F_solicitud"=>$fechaActual,
									"F_Envio"=>$_POST["f_envio"],
									"Pago"=>$_POST["num_pago"]
									);
				$_SESSION["carrito"][$contador]=$producto;
			}	
		}
	}
	
	
	var_dump($_SESSION["carrito"]);

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
            <h2>Pedidos , Ejercicio 2</h2>
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
			<?php  
			
				echo $mensaje_err;
			
			?> 
		<p/>
		
		<p>
			<?php  
			
				echo "<h4>Lista de productos</h4>";
				
				echo $producto[0]["Pago"];
			
			?> 
		<p/>
  </body>
</html>
