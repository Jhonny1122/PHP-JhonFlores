<?php
	//Iniciamos sesion.
	session_start();
	
	//Incluimos las funciones para poder usarlas.
	include("funciones.php");
	
	//Coge la fecha actual
	$fechaActual = date('d/m/y');
	
	//Variables inciadas con el fin de ser llenadas por el camino.
	$producto = array();
	
	$params='';
	
	$signature='';
	
	$mensaje_err = " ";
	
	$sHTML = "";
	
	/*Cuando de al boton anadir*/
	if(isset($_POST["anadir"])){
			
			$precio= obtener_precio($_POST["id_prod"],conexion());
			
			if(!isset($_SESSION["carrito"])){
		
				$producto = array ("OrderLine"=>1,
									"ID_Producto"=>$_POST["id_prod"],
									"Cantidad"=>$_POST["cantidad"],
									"Precio"=>$precio,
									"F_pedido"=>$fechaActual,
									"F_solicitud"=>$fechaActual,
									"F_Envio"=>$_POST["f_envio"],
									);
				$_SESSION["carrito"][0]=$producto;
			}
			else{
				
				$contador = count($_SESSION["carrito"]);
				
				$producto = array ("OrderLine"=>($contador+1),
									"ID_Producto"=>$_POST["id_prod"],
									"Cantidad"=>$_POST["cantidad"],
									"Precio"=>$precio,
									"F_pedido"=>$fechaActual,
									"F_solicitud"=>$fechaActual,
									"F_Envio"=>$_POST["f_envio"],
									);
				$_SESSION["carrito"][$contador]=$producto;
			}
			
			var_dump($_SESSION["carrito"]);
			
			foreach ($_SESSION["carrito"] as $key => $value) {
				$sHTML .= 'Num Orden: ' . $value['OrderLine'] . '<br>' .
						  'ID_Producto: ' . $value['ID_Producto'] . '<br>' .
						  'Cantidad: ' . $value['Cantidad'] . '<br>' .
						  'F_pedido: ' . $value['F_pedido'] . '<br>' .
						  'F_solicitud: ' . $value['F_solicitud'] . '<br>' .
						  'F_Envio: ' . $value['F_Envio'] . '<br><br>';
			}
		
	}
	
	
	/*Cuando de click al boton vaciar*/
	if(isset($_POST["vaciar"])){
		
		//Vaciamos el array de la sesion carrito.
		unset($_SESSION["carrito"]);
		
		//Añadimos el comentario vacio.
		$sHTML = " ";
	}
	
	/*Cuando de click al botono cerrar*/
	if(isset($_POST["cerrar"])){
		//Destruimos la session.
		session_destroy();
		//Redirigimos hacia el login.
		header("location:pe_login.php");
	}
	
	
	/*Cuando de al boton comprar*/
	if(isset($_POST["comprar"])){
		
		//Mostramos por pantalla el array.
		var_dump($_SESSION["carrito"]);
		
		//Guardamos el id del cliente.
		$customer_numb=$_SESSION["usuario"];
		
		/*** Zona verificacion del check number ***/
		$pago_ok=false;
		
		$bien_letras=false;
	
		$bien_num = false;
		
		$cont_num=0;
		
		$num_pago = $_POST["num_pago"];
		
		if(empty($num_pago)){
			
			$mensaje_err = "Porfavor , introduzca el numero de pago";
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
		
		/*Si la verificacion es buena ejecuta el siguiente codigo.*/
		if($pago_ok == true ){
			
			/*  Variables  */
			$preciofinal=0;
			
			$preciofinal=precio_total($_SESSION["carrito"]);
			
			// Guarda en la variable true o false, depende de si hay stock suficiente.
			$ok_stock=consultar_stock($_SESSION["carrito"],conexion());
			
			//Si la variable es true ejecutamos el siguiente codigo.
			if($ok_stock){
				
				//Guardamos en la variable si la insercion fue buena.
				$ok_datos=insertar_datos($_SESSION["carrito"],$customer_numb,conexion());
				
				//Guardamos en la variable si la actualizacion fue buena.
				$ok_cant=actualizar_cantidad($_SESSION["carrito"],conexion());
				
				//Guardamos en la variable si la insercion fue buena.
				$ok_pago=insertar_pago($customer_numb,$_POST["num_pago"],$fechaActual,$preciofinal,conexion());
				
				//Si todas las variable son true ejecuta el siguiente codigo.
				if($ok_datos && $ok_cant && $ok_pago){
					
					//Vaciamos el array carrito.
					unset($_SESSION["carrito"]);
					
					//Imprimimo mensajes.
					echo "Hasta ahora todo ok" . "<br>";
					
					//Guardamos el ultimo ordernumber de la tabla orders.
					$lastOrderNumber=generarOrderNumber(conexion());
					
					/*** Codigo deTransicion de pago ***/
					
					//INTRODUCIR TARJETA DE CREDITO
					$importeSinPunto=str_replace(".", "", $preciofinal); 
					
					include './redsysHMAC256_API_PHP_7.0.0/apiRedsys.php';
					$miObj = new RedsysAPI;
					$amount = $importeSinPunto;
					$url_tpv = 'https://sis.redsys.es/sis/realizarPago';
					$clave = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';
					$code = '999008881';
					$terminal = '1';
					$order = $lastOrderNumber;
					$currency = '978';
					$transactionType = '0';
					$urlweb_ok = 'http://localhost/WebPedidos/pe_inicio.php';
					$urlweb_ko = 'http://www.prueba.com/urlKO.php';
					$miObj->setParameter("DS_MERCHANT_AMOUNT", $amount);
					$miObj->setParameter("DS_MERCHANT_CURRENCY", $currency);
					$miObj->setParameter("DS_MERCHANT_ORDER", $order);
					$miObj->setParameter("DS_MERCHANT_MERCHANTCODE", $code);
					$miObj->setParameter("DS_MERCHANT_TERMINAL", $terminal);
					$miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE", $transactionType);
					$miObj->setParameter("DS_MERCHANT_URLOK", $urlweb_ok);
					$miObj->setParameter("DS_MERCHANT_URLKO", $urlweb_ko);
					var_dump($miObj);
					$params = $miObj->createMerchantParameters();
					$signature = $miObj->createMerchantSignature($clave);
				
				}
			}
		}
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
			<label>Cantidad:</label>
			<input type="number" name="cantidad"/><br><br>
			<label>Fecha Pedido:</label>
			<input type="text" name="f_pedido" placeholder="<?php echo $fechaActual ?>" readonly/><br><br>
			<label>Fecha Solicirud:</label>
			<input type="text" name="f_solicitud" placeholder="<?php echo $fechaActual ?>" readonly/><br><br>
			<label>Fecha Envio:</label>
			<input type="text" name="f_envio"/>
			<input type="text" readonly placeholder="Rellenar Formato:01/01/23"/><br><br>
			<label>Pago:</label>
			<input type="text" name="num_pago" maxlength=7/>
			<input type="text" readonly placeholder="Formato:AA99999"/>
			<br><br>
            <input type="submit" name="anadir" value="Añadir"/>
			<input type="submit" name="vaciar" value="Vaciar"/>
			<input type="submit" name="comprar" value="Comprar"/>
			<input type="submit" name="cerrar" value="Cerrar"/><br><br>
        </form>
		<form id="realizarPago" action="https://sis-t.redsys.es:25443/sis/realizarPago" method="post">
			<input type='hidden' name='Ds_SignatureVersion' value='HMAC_SHA256_V1'>
			<input type='hidden' name='Ds_MerchantParameters' value='<?php echo $params; ?>'>
			<input type='hidden' name='Ds_Signature' value='<?php echo $signature; ?>'>
			<input type='submit' name='' value="Pagar Con tarjeta"/>
		</form>
		<a href="pe_inicio.php">Volver Opciones</a><br><br>
		<p>
			<?php  
			
				echo $mensaje_err;

			?> 
		<p/>
		
		<p>
			<?php  
			
				echo "<h4>Lista de Productos Añadidos</h4>";
				
				echo $sHTML;
	
			?> 
		<p/>
	
  </body>
</html>
