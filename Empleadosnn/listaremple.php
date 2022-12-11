<html>
	<head>
		<title>Lstar Empleados</title>
	</head>
	<body>
		<h2><b>Listar Empleados</b></h2>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
			<label>Departamento:</label>
			<select name="dpto">
				<?php
				
					$servername = "localhost";
					
					$username = "root";
					
					$password = "rootroot";
					
					$dbname = "empleadosnn";
				
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
						
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						
					$stmt = $conn->prepare("SELECT ID , NOMBRE FROM DPTO");
						
					$stmt->execute();
						
					$stmt->setFetchMode(PDO::FETCH_ASSOC);
						
					 $resultado=$stmt->fetchAll();
						 
					 foreach($resultado as $row) {
							 
						$iddpto=$row["ID"];
							
						$dptonomb=$row["NOMBRE"];
							
				?>
						<option value="<?php echo $iddpto?>"><?php echo $dptonomb ?></option>
				<?php
					}
				?>
			</select><br><br>
			<input type="submit" name="submit"/>
		</form>
	</body>
</html>

<?php

include("funciones.php");

if (isset($_POST["submit"])){
	
	$id_dpto= limpiar ($_POST["dpto"]);
	
	listarEmple($id_dpto);
}



?>