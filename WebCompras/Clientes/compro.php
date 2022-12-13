<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="CSS/stylosprog.css">
    <title>Compra de Productos</title>
</head>
<body>
    <div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <h2>Compra de Productos</h2>
            <label>Nombre Cliente:</label>
            <select name="nomb_cl">
				<?php
				
					$servername = "localhost";
			
					$username = "root";
					
					$password = "rootroot";
					
					$dbname = "comprasweb";
					
					try {
						
						$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
						
						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					 
						$stmt = $conn->prepare("SELECT NIF , NOMBRE FROM CLIENTE");
							
						$stmt->execute();
							
						$stmt->setFetchMode(PDO::FETCH_ASSOC);
							
						$resultado=$stmt->fetchAll();
							 
						foreach($resultado as $row) {
								 
							$nif_cl=$row["NIF"];
								
							$nomb_cl=$row["NOMBRE"];
								
						?>
							<option value="<?php echo $nif_cl?>"><?php echo $nomb_cl ?></option>
						<?php
						}
						
					}
					catch(PDOException $e) {
						
						echo "Error: " . $e->getMessage();
					}
				
				?>
			</select><br><br>
			<label>Producto:</label>
            <select name="prod">
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
			<label>Fecha Compra</label>
			<input type="date" name="fech_comp"/><br><br>
			<label>Cantidad</label>
			<input type="text" name="cant"/><br><br><br>
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
	
	$nif_cl = limpiar ($_POST["nomb_cl"]);
	
	$id_prod = limpiar ($_POST["prod"]);
	
	$fech_comp = limpiar ($_POST["fech_comp"]);
	
	$cant = limpiar ($_POST["cant"]);
	//variable que nos sevira para comprobar suficientes cantidades.
	$val_cantidad=comp_Cantidad($id_prod,$cant,conexion());	
	//Si no ha seleccionado fecha, cogera el dia que ha hecho la compra.
	if(empty($fech_comp)){
		
		$fecha=date("j-m-y");
		
		$fech_comp=$fecha;
		
	}
	
	if (empty($cant)){
		
		echo "<h3>ERROR!!!</h3>";
		
		echo "Tienes campos sin rellenar";
	}
	else{
		
		if($val_cantidad){
			
			comprar($nif_cl,$id_prod,$fech_comp,$cant,conexion());
		}
		else{
			
			echo "Cambia la cantidad del producto";
		}
	}

	
	
	
}

?>