<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Consultas</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
	<?php
		session_start();
		/*Codigo que permite visualizar el contenido siempre y cuando haya inciado login/sesion*/
		if(!isset($_SESSION["usuario"])){
			
			header("location:pe_login.php");
		}
	?>
	
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <h2>Consultar , Ejercicio 3</h2>
            <label>Nombre Cliente:</label>
            <select name="id_cliente">
				<?php
				
					$servername = "localhost";
			
					$username = "root";
					
					$password = "rootroot";
					
					$dbname = "pedidos";
					
					try {
						
						$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
						
						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					 
						$stmt = $conn->prepare("SELECT customerNumber,customerName FROM customers");
							
						$stmt->execute();
							
						$stmt->setFetchMode(PDO::FETCH_ASSOC);
							
						$resultado=$stmt->fetchAll();
							 
						foreach($resultado as $row) {
								 
							$id_cliente=$row["customerNumber"];
								
							$nomb_cliente=$row["customerName"];
								
						?>
							<option value="<?php echo $id_cliente?>"><?php echo $nomb_cliente ?></option>
						<?php
						}
						
					}
					catch(PDOException $e) {
						
						echo "Error: " . $e->getMessage();
					}				
				?>
			</select><br><br>
			<input type="submit" name="submit" value="Consultar" />
		</form>
		<a href="pe_inicio.php">Volver Opciones</a><br>
  </body>
</html>
<?php

	include("funciones.php");


	if (isset($_POST["submit"])){
		
		$id_cliente = limpiar($_POST["id_cliente"]);
	
		//echo $id_cliente;
		
		consultas_ejer3($id_cliente,conexion());
	}


?>

