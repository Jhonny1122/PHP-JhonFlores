<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="CSS/stylosprog.css">
    <title>Aprovisionar Productos</title>
</head>
<body>
    <div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <h2>Aprovisionar Productos</h2>
            <label>Localidad Almacen:</label>
            <select name="loc_alm">
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
								
							$nomb_loc=$row["LOCALIDAD"];
								
						?>
							<option value="<?php echo $num_alm?>"><?php echo $nomb_loc ?></option>
						<?php
						}
						
					}
					catch(PDOException $e) {
						
						echo "Error: " . $e->getMessage();
					}
				
				?>
			</select><br><br>
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
			</select><br><br>
            <label>Cantidad:</label>
            <input type="text" name="cant_alm"/><br><br><br>
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
		
		$num_alm = limpiar ($_POST["loc_alm"]);
		
		$id_prod = limpiar ($_POST["nomb_prod"]);
		
		$cant_alm = limpiar ($_POST["cant_alm"]);
		
		if (empty($num_alm) || empty($id_prod) || empty($cant_alm)){
			
			echo "<h3><b>Error!!!!!!!!</b></h3>";
			
			echo "Necesitas rellenar los campos.";
		}
		else{
			
			aprovProd($num_alm,$id_prod,$cant_alm,conexion());
		}
	}





?>