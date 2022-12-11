<html>
	<head>
		<title>Alta Empleado</title>
	</head>
	<body>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
			<h1>Alta Empleado</h1>
			<label>DNI Empleado</label>
			<input type="text" name="dni_emple" /><br><br>
			<label>Nombre Empleado</label>
			<input type="text" name="nomb_emple" /><br><br>
			<label>Salario Empleado</label>
			<input type="text" name="salario_emple" /><br><br>
			<label>Fecha Nacimiento Empleado</label>
			<input type="text" name="fnac_emple" /><br><br>
			<label>Lista Departamento</label>
			<select name="dpto">
				<?php
					//Conexion a la base de datos(Puedes abreviarlo con una funcion).
				    $servername = "localhost";
					
					$username = "root";
					
					$password = "rootroot";
					
					$dbname = "empleadosnn";
					
					try {
						
						$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
						
						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						
						$stmt = $conn->prepare("SELECT id , nombre FROM dpto");
						
						$stmt->execute();
						
						$stmt->setFetchMode(PDO::FETCH_ASSOC);
						
						 $resultado=$stmt->fetchAll();
						 
						 foreach($resultado as $row) {
							 
							$iddpto=$row["id"];
							
							$dptonomb=$row["nombre"];
							
						?>
							<option value="<?php echo $iddpto?>"><?php echo $dptonomb ?></option>
						<?php
						}
					}
					catch(PDOException $e) {
						
						echo "Error: " . $e->getMessage();
					}		
				?>
			</select><br><br>
			<input type="submit" name="submit" value="Enviar"/>
		</form>
	</body>
</html>

<?php

include("funciones.php");

if (isset($_POST["submit"])){
	
	$dni_emple = limpiar($_POST["dni_emple"]);
	
	$nomb_emple = limpiar ($_POST["nomb_emple"]);
	
	$salario_emple = limpiar ($_POST["salario_emple"]);
	
	$fnac_emple = limpiar ($_POST["fnac_emple"]);
	
	$id_dpto= limpiar ($_POST["dpto"]);
	
	altaempleado($dni_emple,$nomb_emple,$salario_emple,$fnac_emple,$id_dpto);
	
};

?>