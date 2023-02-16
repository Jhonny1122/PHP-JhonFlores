<?php

	echo "Inicio controller"."<br>";
	//Llamada al modelo -- Intermediario entre vista y modelo !!!
	require_once("models/login_model.php");

	//Valor 0 o 1.
	$accede=login($usuario,$pass);

	//Llamada a la vista -- Intermediario entre vista y modelo !!!
	require_once("views/login_views.php");
	echo "Fin controller"."<br>";


?>