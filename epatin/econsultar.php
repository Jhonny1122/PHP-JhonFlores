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
	
	$sHTML="";
	
	
	// Boton Volver //
	if(isset($_POST["Volver"])){
		
		header("location:einicio.php");
	}
	
	if(isset($_POST["Consultar"])){
		
		$fecha_Desde=$_POST["fechadesde"];
		
		$fecha_Hasta=$_POST["fechahasta"];
		
		$sHTML = consultar($dni,$fecha_Desde,$fecha_Hasta,conexion());
		
	}
	
?>


<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Bienvenido a MovilMAD</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
  </head>
   
 <body>
    <h1>Servicio de ALQUILER PATINETES ELÉCTRICOS</h1> 

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú Usuario - CONSULTA ALQUILERES </div>
		<div class="card-body">
	  
	  	
	   

	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
				
		<B>Bienvenido/a: <?php echo $nombre ?></B>    <BR><BR>
		<B>Saldo Cuenta: <?php echo $saldo ?></B>    <BR><BR>
		     
			 Fecha Desde: <input type='date' name='fechadesde' value='' size=10 placeholder="fechadesde" class="form-control">
			 Fecha Hasta: <input type='date' name='fechahasta' value='' size=10 placeholder="fechahasta" class="form-control"><br><br>
			 
		<div>
			<?php echo $sHTML ;?>
		</div>		
		<div>
			<input type="submit" value="Consultar" name="Consultar" class="btn btn-warning disabled">
		
			<input type="submit" value="Volver" name="Volver" class="btn btn-warning disabled">
		
		</div>		
	</form>
	<!-- FIN DEL FORMULARIO -->
    <a href = "edestruir.php">Cerrar Sesion</a>

  </body>
   
</html>
