<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Consulta Compras , Ejercicio 7</title>
  </head>
  <body>
    <header>
      <nav>
      </nav>
    </header>
    <main>
		<?php
		session_start();
		
		if(!isset($_SESSION["usuario"])){
			
			header("location:pe_login.php");
		}
		?>
		<h1>Consulta Compras , Ejercicio 7</h1>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <label>Cliente:</label>
            <select name="id_cliente">
				<?php
				
					$servername = "localhost";
			
					$username = "root";
					
					$password = "rootroot";
					
					$dbname = "pedidos";
					
					try {
						
						$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
						
						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					 
						$stmt = $conn->prepare("SELECT customerNumber,customername FROM customers");
							
						$stmt->execute();
							
						$stmt->setFetchMode(PDO::FETCH_ASSOC);
							
						$resultado=$stmt->fetchAll();
							 
						foreach($resultado as $row) {
								 
							$code=$row["customerNumber"];
							
							$name=$row["customername"];	
						?>
							<option value="<?php echo $code?>"><?php echo $name ?></option>
						<?php
						}
						
					}
					catch(PDOException $e) {
						
						echo "Error: " . $e->getMessage();
					}				
				?>
			</select><br><br>
			<label>Fecha Inicio:</label>
			<input type="date" name="f_inicio" /><br><br>
			<label>Fecha Fin:</label>
			<input type="date" name="f_fin" /><br><br><br>
            <input type="submit" name="submit" value="Consultar"/><br>
		</form>
    </main>
    <footer>
      <a href="pe_inicio.php">Volver Opciones</a><br>
    </footer>
  </body>
</html>
<?php

	include("funciones.php");

	if(isset($_POST["submit"])){
		
		$number=limpiar($_POST["id_cliente"]);
		
		$f_inicio=limpiar($_POST["f_inicio"]);
		
		$f_fin=limpiar($_POST["f_fin"]);
		
		//echo $number;
		
		if(empty($f_inicio) && empty($f_fin)){
			
			consultar_todo($number,conexion());
		}
		else{
			
			consultar_compras($number,$f_inicio,$f_fin,conexion());
		}
	}

?>
