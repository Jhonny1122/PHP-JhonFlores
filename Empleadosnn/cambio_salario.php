<html>
	<head>
		<title>Cambio Salario</title>
	</head>
	<body>
		<h2><b>Cambio Salario</b></h2>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
			<label>DNI Empleado:</label>
			<select name="dni_emple">
				<?php
					$servername = "localhost";
					$username = "root";			
					$password = "rootroot";				
					$dbname = "empleadosnn";
					
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);			
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);				
					$stmt = $conn->prepare("SELECT DNI FROM emple");
					$stmt->execute();
							
					$stmt->setFetchMode(PDO::FETCH_ASSOC);		
					$resultado=$stmt->fetchAll();
							 
					foreach($resultado as $row) {						 
						$dni=$row["DNI"];
					
					?>
						<option value="<?php echo $dni?>"><?php echo $dni ?></option>
				<?php
					
					}
				?>
			</select><br><br>
			<label>Sueldo Nuevo:</label>
			<input type="text" name="sueldo_nuevo"/><br><br><br>
			<input type="submit" name="submit"/>
		</form>
	</body>
</html>

<?php

	include("funciones.php");

	if (isset($_POST["submit"])){
		
		$dni_emple= limpiar ($_POST["dni_emple"]);
		
		$sueldo_nuevo = limpiar ($_POST["sueldo_nuevo"]);
		
		cambioSalario($dni_emple,$sueldo_nuevo);
	}

?>