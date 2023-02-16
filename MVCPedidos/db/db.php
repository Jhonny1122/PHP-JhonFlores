<?php
echo "Inicio db.php"."<br>";

	$servername = "localhost";
	$username = "root";
	$password = "rootroot";
	$database = "pedidos";

	try {
		$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password); 	 	 	 	 	 	
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 	 	 	 	 	 	
	} catch (PDOException $ex) {
		echo $ex->getMessage(); 	 	 	 	 	 	
	}
	
echo "finaliza db.php"."<br>";
?>