<!DOCTYPE html>

<?php

	if(isset($_COOKIE["nif_cliente"])){
					
		$nif_cliente=$_COOKIE["nif_cliente"];
		
	}

?>
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
            <input type="submit" name="anadir" value="Añadir" />
			<input type="submit" name="comprar" value="Comprar" />
        </form>
    </div>
</body>
</html>

<?php

include("funciones.php");

if (isset($_POST["anadir"])){	
	
	$producto=limpiar($_POST["prod"]);
	
	$fecha=$_POST["fech_comp"];
	
	$cantidad=limpiar($_POST["cant"]);
	
	/*Guardamos en la variable contador la suma de lo que haya de valor en la cookie con nombre num_contador + 1*/
	$contador=$_COOKIE["num_contador"]+1;
	/*Cambiamos el valor de la cookie por el resultado que tengamos en la varible contador*/
	setcookie("num_contador","$contador",time()+30000);
	
	$lista=array();
	
	$array=array($producto,$cantidad);
	
	$lista[$contador]=array($producto,$cantidad);
	
	/*De momento hemos conseguido guardar 3 datos en las cookies , nombre usuario, dni y una especie de contador que espero te sirva
	Ahora queda saber como agregar las diferntes comrpas del cliente(nif)en un array asociativo
	Estas pensado en guardar cada array en una cookie , intentalo y sino va ,a pensar una nueva
	*/
	
	var_dump($lista);
}

if (isset($_POST["comprar"])){
	
	
}

?>


$cars = array (
  array("Volvo",22,18),
  array("BMW",15,13),
  array("Saab",5,2),
  array("Land Rover",17,15)
);

