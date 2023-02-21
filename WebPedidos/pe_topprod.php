<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Consulta Unidades , Ejercicio 6</title>
  </head>
  <body>
    <header>
      <nav>
      </nav>
    </header>
    <main>
      <h1>Consulta Unidades , Ejercicio 6</h1>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
		<label>Fecha Inicio:</label>
		<input type="date" name="f_inicio" /><br><br>
		<label>Fecha Fin:</label>
		<input type="date" name="f_fin" /><br><br><br>
		<input type="submit" name="submit" value="Consultar"/><br>
	  </form>
    </main>
    <footer>
      <a href="pe_inicio.php">Volver Opciones</a><br><br>
    </footer>
  </body>
</html>

<?php

	include("funciones.php");

	if(isset($_POST["submit"])){
		
		$f_inicio=limpiar($_POST["f_inicio"]);
		
		$f_fin=limpiar($_POST["f_fin"]);
		
		if(empty($f_inicio) && empty($f_fin)){
			
			echo "Porfavor, intoruce las fechas" . "<br>";
			
		}
		else{
			
			$infocompras=consulta_unidades($f_inicio,$f_fin,conexion());
			
			echo "<b>Informacion</b>". "<br><br>";
            
			foreach($infocompras as $row) {
				
                echo "Unidades Totales: " . $row["totalUnints"]. "<br> Cod.prod: " . $row["productCode"]. " <br> Nombre: " . $row["productName"]. "<br><br>"; 
            }
			
		}
		
	}
	



?>
