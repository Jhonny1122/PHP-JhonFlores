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
	
	$sHTML="";

	// Boton Volver //
	if(isset($_POST["volver"])){
		
		header("location:einicio.php");
	}
	
	// Devolver //
	if(isset($_POST["devolver"])){
		
		//Guardamos algunas variables
		$matricula=$_POST["patinetes"];
		
		$tiempo=rand(1,12);
		
		$precio_total=get_PrecioTotal($tiempo,$matricula,conexion());
		
		//Actualizamos algunas tablas.
		actualizar_alquileres($matricula,$fecha,$precio_total,conexion());
		
		actualizar_saldos($dni,$saldo,$precio_total,conexion());
		
		actualizar_patinesS($matricula,conexion());
		
		// Imprimimos algunos mensajes
		$sHTML .= "<b>Recibo patin: " . $matricula ."</b>" . "<br>";
		
		$sHTML .= "Tiempo: " . $tiempo . "<br>";
		
		$sHTML .= "Precio Total: " . $precio_total . "<br>";
		
		$sHTML .= "Saldo Restante: " . ($saldo-$precio_total) . "<br>";
		
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
		<div class="card-header">Menú Usuario - APARCAR PATINETE </div>
		<div class="card-body">
	  
	   

	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
	
		<B>Bienvenido/a: <?php echo $nombre ?></B>    <BR><BR>
		<B>Saldo Cuenta: <?php echo $saldo ?></B>    <BR><BR>
				
			<B>PATINETES ALQUILADOS: <?php echo $fecha ?></B>
			<select name="patinetes" class="form-control">
			
			<?php
			
				$conn = conexion();
				
				try {
					
					$stmt = $conn->prepare("SELECT matricula FROM ealquileres WHERE fecha_devolucion IS NULL AND dni=:dni");
					
					$stmt-> bindParam(":dni",$dni);
							
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
				
			</select>
			<div>
				<?php echo $sHTML; ?>
			</div>
		<BR><BR>
		<div>
			<input type="submit" value="Aparcar Patinete" name="devolver" class="btn btn-warning disabled">
			<input type="submit" value="Volver" name="volver" class="btn btn-warning disabled">
		</div>		
	</form>
	<!-- FIN DEL FORMULARIO -->
	<a href = "edestruir.php">Cerrar Sesion</a>
	
  </body>
   
</html>



