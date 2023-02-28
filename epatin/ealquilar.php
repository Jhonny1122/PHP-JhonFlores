<?php
	include("efunciones.php");
	
	//Reanudamos la sesion
	session_start();
	
	//Comprobamos que se ha logueado el usuario, sino se ha logueado le manda de nuevo al index.php
	if(!isset($_SESSION["usuario"])){	
	
		header("location:elogin.php");
	}
	
	//Obtenemos algunos valores mediante funciones.
	$dni=$_SESSION["usuario"];
	
	$nombre=get_Nombre($dni,conexion());
	
	$saldo=get_Saldo($dni,conexion());
	
	$fecha=date("Y-m-d h:i:s");
	
	$mensaje="";
	
	$mensajeError="";
	
	// Añadir Patinetes a la cesta //
	if(isset($_POST["agregar"])){
		
		//Guardamos algunos valores dentro de las siguiente variables.
		$matricula=$_POST["patinetes"];
		
		$bateria=get_Bateria($matricula,conexion());
		
		$precio_base=get_Precio($matricula,conexion());
	
		//Comprobamos si no se ha creado la sesion carrito o si no hay nada.
		if(!isset($_SESSION["carrito"])){
			
			
			$producto = array ("Matricula"=>$matricula,"Bateria"=>$bateria,"PrecioBase"=>$precio_base,"Fecha"=>$fecha);
			
			
			$_SESSION["carrito"][0]=$producto;
		}
		
		//Por otro lado , si ya se ha creado o tiene algo.
		else{
			
			$contador = count($_SESSION["carrito"]);
			
			$producto = array ("Matricula"=>$matricula,"Bateria"=>$bateria,"PrecioBase"=>$precio_base,"Fecha"=>$fecha);
			
			$_SESSION["carrito"][$contador]=$producto;
		}
		
		//Mostramos un vardump del carrito.
		var_dump($_SESSION["carrito"]);	
		
		foreach ($_SESSION["carrito"] as $key => $value) {
				$mensaje .= 'Matricula Patin: ' . $value['Matricula'] . '<br>' .
						  'Bateria: ' . $value['Bateria'] . '<br>' .
						  'PrecioBase: ' . $value['PrecioBase'] . '<br><br>';
		}		
	}
	
	// Vaciar Patinetes //
	if(isset($_POST["vaciar"])){
		
		unset($_SESSION["carrito"]);
	}
	
	
	// Realizar Alquiler //
	if(isset($_POST["alquilar"])){
		
		if($saldo >= 10){
			
			set_patines($_SESSION["carrito"],$dni,conexion());
			
			update_dispo($_SESSION["carrito"],conexion());
			
			unset($_SESSION["carrito"]);
		}
		else{
			
			$mensajeError = "<h5>Error , El saldo es inferior a 10 . Porfavor recargue su saldo</h5>";
		}
		
	}

?>


<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Bienvenido a EPATIN</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
 </head>
   
 <body>
    <h1>Servicio de ALQUILER PATINETES ELÉCTRICOS</h1> 

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú Usuario - ALQUILAR PATINETES</div>
		<div class="card-body">
	  	  

	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
	
		<B>Bienvenido/a: <?php echo $nombre ?></B>    <BR><BR>
		<B>Saldo Cuenta: <?php echo $saldo ?></B>    <BR><BR>
		
		<B>PATINETES disponibles: <?php echo $fecha ?></B>  <BR>
		
			<select name="patinetes" class="form-control">
			
			<?php
			
				$conn = conexion();
				
				try {
					
					$stmt = $conn->prepare("SELECT matricula FROM epatines WHERE disponible = 'S'");
							
					$stmt->execute();
							
					$stmt->setFetchMode(PDO::FETCH_ASSOC);
								
					$resultado=$stmt->fetchAll();
								 
					foreach($resultado as $row) {
									 
						$matricula=$row["matricula"];
						
			?>
			<option value="<?php echo $matricula?>"><?php echo $matricula ?></option>
			<?php
					}
						
				}
				catch(PDOException $e) {
						
					echo "Error: " . $e->getMessage();
				}				
			?>			
				
			</select><br>
		<div>
			<?php
			
				echo "<h4>Listado Patines Agregados</h4>";
			
				echo $mensaje;
				
				echo $mensajeError;
			
			?>
		</div>
			
		<BR><BR><BR>
		<div>
			<input type="submit" value="Agregar a Cesta" name="agregar" class="btn btn-warning disabled">
			<input type="submit" value="Realizar Alquiler" name="alquilar" class="btn btn-warning disabled">
			<input type="submit" value="Vaciar Cesta" name="vaciar" class="btn btn-warning disabled">
			<a href="einicio.php">Volver</a>
		</div>		
	</form>
	<!-- FIN DEL FORMULARIO -->
  </body>
   
</html>

