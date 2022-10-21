<html>
<head>
	<title>Fichero 6</title>
</head>
<body>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
		<center>
		<h1>Operaciones Ficheros</h1>
		<label>Fichero(Path/Nombre): </label>
		<input type="text" name="fichero"/>
		<br><br>
		<input type="submit" name="submit" value="Ver Datos Ficheros"/>
		<input type="reset" name="reset" value="borrar"/>
		</center>
	</form>
</body>
</html>
<?php
/*

	Nos quedamos en como verificar la ruta, el getcwd nos dice la ruta pero aun no sabemos 
	el nombre del fichero txt, estamso pensando en hacer tipo la ip. O busca una funcion si puedes.

*/
if (isset($_POST["submit"])){
	
	$fichero = $_POST["fichero"] ;
	
	echo "<h2>Operaciones Ficheros</h2>";
	
	echo $fichero . "<br>";
	
};

/*function deshacer ($a){
	$signo = "";
	//Primer parte antes del \
	$a1=substr($a,0,strpos($a,$signo));
	
	$a=substr($a,strpos($a,'$signo')+1);
	
	return $signo;
	
};
*/
function limpiar($data){
	
	$data = trim($data);
	
	$data = stripslashes($data);
	
	$data = htmlspecialchars($data);
	
	return $data;
};

?>