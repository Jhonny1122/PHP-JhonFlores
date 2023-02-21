<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Consulta Stock , Ejercicio 5</title>
  </head>
  <body>
    <header>
      <nav>
      </nav>
    </header>
    <main>
    </main>
		<?php
		
		session_start();
		
		if(!isset($_SESSION["usuario"])){
			
			header("location:pe_login.php");
		}
		
		?>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <h2>Consulta de Stock , Ejercicio 5</h2>
            <label>Linea de Producto:</label>
            <select name="productline">
				<?php
				
					$servername = "localhost";
			
					$username = "root";
					
					$password = "rootroot";
					
					$dbname = "pedidos";
					
					try {
						
						$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
						
						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					 
						$stmt = $conn->prepare("SELECT productline FROM products GROUP BY productline;");
							
						$stmt->execute();
							
						$stmt->setFetchMode(PDO::FETCH_ASSOC);
							
						$resultado=$stmt->fetchAll();
							 
						foreach($resultado as $row) {
								 
							$linea_prod=$row["productline"];
								
						?>
							<option value="<?php echo $linea_prod?>"><?php echo $linea_prod ?></option>
						<?php
						}
						
					}
					catch(PDOException $e) {
						
						echo "Error: " . $e->getMessage();
					}				
				?>
			</select><br><br><br>
            <input type="submit" name="submit" value="Consultar"/><br>
		</form>
    <footer>
		<a href="pe_inicio.php">Volver Opciones</a><br>
    </footer>
  </body>
</html>

<?php

	include("funciones.php");

	if(isset($_POST["submit"])){
		
		$prod_line=limpiar($_POST["productline"]);
		
		consultaStock2($prod_line,conexion());
		
	}


?>
