<?php

include("funciones_bolsa.php");

if (isset($_POST["submit"])){

	$valor = limpiar($_POST["valor"]);
	
	echo mostrarValor($valor);
};

?>