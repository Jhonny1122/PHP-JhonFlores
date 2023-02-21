<html>
	<head>
		<title>Consulta Producto</title>
	</head>
	<body>
		<?php
		
		session_start();
		
		if(!isset($_SESSION["usuario"])){
			
			header("location:pe_login.php");
		}
		
		?>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <h2>Consulta de Stock , Ejercicio 4</h2>
            <label>Nombre Producto:</label>
            <select name="nomb_prod">
				<?php
				
					$servername = "localhost";
			
					$username = "root";
					
					$password = "rootroot";
					
					$dbname = "pedidos";
					
					try {
						
						$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
						
						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					 
						$stmt = $conn->prepare("SELECT productCode,productName FROM products");
							
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
			</select><br><br><br>
            <input type="submit" name="submit"/><br>
        </form>
		<a href="pe_inicio.php">Volver Opciones</a><br>
	</body>
</html>

<?php

	include("funciones.php");

	if (isset($_POST["submit"])){
		
		$id_prod = $_POST["nomb_prod"];
		
		consultaStock($id_prod,conexion());
		
	}

?>