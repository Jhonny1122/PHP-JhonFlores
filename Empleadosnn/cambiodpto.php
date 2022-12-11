<html>
	<head>
		<title>Cambio Departamento</title>
	</head>
	<body>
		<h2>Cambio Departamento</h2>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
			<label>DNI Empleados:</label>
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
			<label>Departamento Nuevo:</label>
			<select name="dpto_nuevo">
				<?php
					$servername = "localhost";
					$username = "root";			
					$password = "rootroot";				
					$dbname = "empleadosnn";
					
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);			
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);				
					$stmt = $conn->prepare("SELECT ID, NOMBRE FROM dpto");
					$stmt->execute();
							
					$stmt->setFetchMode(PDO::FETCH_ASSOC);		
					$resultado=$stmt->fetchAll();
							 
					foreach($resultado as $row) {
						$id_dpto=$row["ID"];
						$nomb_dpto=$row["NOMBRE"];
					
					?>
						<option value="<?php echo $id_dpto?>"><?php echo $nomb_dpto?></option>
				<?php
					
					}
				?>
			</select><br><br><br>
			<input type="submit" name="submit">
		</form>
	</body>
</html>

<?php

include("funciones.php");

if (isset($_POST["submit"])){
	
	$dni_emple= limpiar ($_POST["dni_emple"]);
	
	$id_dpto_nuevo = limpiar ($_POST["dpto_nuevo"]);
	
	cambiodpto($dni_emple,$id_dpto_nuevo);
}



?>