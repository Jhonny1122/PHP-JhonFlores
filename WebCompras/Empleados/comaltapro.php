<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="CSS/stylosprog.css">
    <title>Alta de Productos</title>
</head>
<body>
    <div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <h2>Alta de Productos</h2>
            <label>Nombre Producto:</label>
            <input type="text" name="nomb_prod"/><br><br>
            <label>Precio Producto:</label>
            <input type="text" name="prec_prod"/><br><br>
            <label>Categoria Producto:</label>
            <select name="id_categ">
				<?php
				
					$servername = "localhost";
			
					$username = "root";
					
					$password = "rootroot";
					
					$dbname = "comprasweb";
					
					try {
						
						$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
						
						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					 
						$stmt = $conn->prepare("SELECT ID_CATEGORIA , NOMBRE FROM CATEGORIA");
							
						$stmt->execute();
							
						$stmt->setFetchMode(PDO::FETCH_ASSOC);
							
						$resultado=$stmt->fetchAll();
							 
						foreach($resultado as $row) {
								 
							$id_categ=$row["ID_CATEGORIA"];
								
							$nomb_categ=$row["NOMBRE"];
								
						?>
							<option value="<?php echo $id_categ?>"><?php echo $nomb_categ ?></option>
						<?php
						}
						
					}
					catch(PDOException $e) {
						
						echo "Error: " . $e->getMessage();
					}
				
				?>
			</select>
			<br><br><br>
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
		
		$nomb_prod = limpiar($_POST["nomb_prod"]);
		
		$prec_prod = limpiar($_POST["prec_prod"]);
		
		$id_categ = limpiar($_POST["id_categ"]);
		
		if (empty($nomb_prod) || empty($prec_prod) || empty($id_categ)){
			
			echo "<h3><b>Error!!!!!!!!</b></h3>";
			
			echo "Necesitas rellenar todos los datos";
		}
		else{
			
			$contarProd= contProd(conexion());
	
			$incre=incremProd($contarProd); 
			
			altaProducto($nomb_prod,$prec_prod,$id_categ,$incre,conexion());
		}
		
	}


?>