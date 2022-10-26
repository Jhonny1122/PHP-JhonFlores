<?php

include("funciones_bolsa.php");

$fichero = fopen ("ibex35.txt" , "r");

echo leerBolsa($fichero);

?>