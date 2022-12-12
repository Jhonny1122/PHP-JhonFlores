<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="CSS/stylosprog.css">
    <title>Consulta de Stock</title>
</head>
<body>
    <div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <h2>Consulta de Stock</h2>
            <label>Nombre Producto:</label>
            <select name="nomb_prod">
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
		
		$id_prod = limpiar ($_POST["nomb_prod"]);
		
		if (empty($id_prod)){
			
			echo "<h3><b>Error!!!!!!!!</b></h3>";
			
			echo "Necesitas Seleccionar un campo o no hay id del producto.";
		}
		else{
			
			consStock($id_prod,conexion());
		}
	}





?>