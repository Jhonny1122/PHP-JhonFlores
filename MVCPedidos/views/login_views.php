<?php

	if($accede != 0){

		session_start();

		$_SESSION["usuario"]=$_POST["usuario"];

		//echo "Existe el usuario" . "<br>";
		header("location:pe_inicio.php");
	}
	else{
		
		//echo "No existe el usuario" . "<br>";
		header("location:pe_login.php");
	}


?>