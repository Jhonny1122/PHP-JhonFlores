<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="CSS/stylosprog.css">
    <title>Consulta de Compras</title>
</head>
<body>
    <div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <h2>Consulta de Compras</h2>
            <label>NIF Cliente:</label>
            <select name="nif">
				<?php
				
					$servername = "localhost";
			
					$username = "root";
					
					$password = "rootroot";
					
					$dbname = "comprasweb";
					
					try {
						
						$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
						
						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					 
						$stmt = $conn->prepare("SELECT NIF FROM CLIENTE");
							
						$stmt->execute();
							
						$stmt->setFetchMode(PDO::FETCH_ASSOC);
							
						$resultado=$stmt->fetchAll();
							 
						foreach($resultado as $row) {
								 
							$nif_cliente=$row["NIF"];
								
						?>
							<option value="<?php echo $nif_cliente?>"><?php echo $nif_cliente ?></option>
						<?php
						}
						
					}
					catch(PDOException $e) {
						
						echo "Error: " . $e->getMessage();
					}
				
				?>
			</select><br><br>
			<label>Fecha desde:</label>
			<input type="text" name="fecha_desde"/><br><br>
			<label>Fecha hasta:</label>
			<input type="text" name="fecha_hasta"/><br><br><br>
			<input type="submit" name="submit"/>
        </form>
		<br><br><br>
		<a href="inicio.html">Inicio</a>
    </div>
</body>
</html>

<?php

	include("funciones.php");

	if (isset($_POST["submit"])){
		
		$nif_cliente = limpiar ($_POST["nif"]);
		
		$fecha_desde = limpiar ($_POST["d¡fecha_desde"]);
		
		$fecha_hasta = limpiar ($_POST["fecha_hasta"]);
		
		if (empty($nif_cliente) || empty($fecha_desde) || empty($fecha_hasta)){
			
			echo "<h3><b>Error!!!!!!!!</b></h3>";
			
			echo "Necesitas rellenar los datos";
		}
		else {
			
			
		}
	}

?>