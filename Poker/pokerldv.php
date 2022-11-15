<?php
include("Pokerldv_fun.php");
if (isset($_POST["submit"])){
// Variables //
$nombre1=limpiar($_POST["nombre1"]);

$nombre2=limpiar($_POST["nombre2"]);

$nombre3=limpiar($_POST["nombre3"]);

$nombre4=limpiar($_POST["nombre4"]);

$nombre5=limpiar($_POST["nombre5"]);

$nombre6=limpiar($_POST["nombre6"]);

$nombre7=limpiar($_POST["nombre7"]);

$nombre8=limpiar($_POST["nombre8"]);

$bote=limpiar($_POST["bote"]);

$correctoJugadores=false;

$baraja=array("1C1","1C2","1D1","1D2","1P1","1P2","1T1","1T2","JC1","JC2","JD1","JD2","JP1","JP2","JT1","JT2","KC1","KC2","KD1","KD2","KP1","KP2","KT1","KT2","QC1","QC2","QD1","QD2","QP1","QP2","QT1","QT2");

$cartas=array();

$jugadores=array();

// Llamar a las funciones //
$jugadores=validarJugadores($nombre1,$nombre2,$nombre3,$nombre4,$nombre5,$nombre6,$nombre7,$nombre8,$jugadores);
$correctoJugadores=validarNumJugadores($jugadores);
$cartas=poker($jugadores,$correctoJugadores,$baraja);
ganador($cartas,$bote);
}

?>