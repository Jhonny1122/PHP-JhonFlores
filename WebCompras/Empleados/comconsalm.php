<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="CSS/stylosprog.css">
    <title>Consulta de Almacenes</title>
</head>
<body>
    <div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <h2>Consulta de Almacenes</h2>
            <label>Localidad almacen:</label>
            <select name="loc">
				<?php
				
					$servername = "localhost";
			
					$username = "root";
					
					$password = "rootroot";
					
					$dbname = "comprasweb";
					
					try {
						
						$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
						
						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					 
						$stmt = $conn->prepare("SELECT NUM_ALMACEN , LOCALIDAD FROM ALMACEN");
							
						$stmt->execute();
							
						$stmt->setFetchMode(PDO::FETCH_ASSOC);
							
						$resultado=$stmt->fetchAll();
							 
						foreach($resultado as $row) {
								 
							$num_alm=$row["NUM_ALMACEN"];
								
							$loc=$row["LOCALIDAD"];
								
						?>
							<option value="<?php echo $num_alm?>"><?php echo $loc ?></option>
						<?php
						}
						
					}
					catch(PDOException $e) {
						
						echo "Error: " . $e->getMessage();
					}
				
				?>
			</select><br><br><br>
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
		
		$num_alm = limpiar ($_POST["loc"]);
		
		if (empty($num_alm)){
			
			echo "<h3><b>Error!!!!!!!!</b></h3>";
			
			echo "Error, el num_almacen no existe.";
		}
		else{
			
			consAlm($num_alm,conexion());
		}
	}

?>