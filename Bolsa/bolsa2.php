<?php

include("funciones_bolsa.php");

if (isset($_POST["submit"])){

	$valor = limpiar($_POST["valor"]);
	
	$fichero = fopen ("ibex35.txt","r");
	
	echo mostrarValor($fichero,$valor);
};

?>