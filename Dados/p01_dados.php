<?php
include("funciones.php");
if (isset($_POST["tirar"])){
	$jug1=limpiar($_POST["jug1"]);
	$jug2=limpiar($_POST["jug2"]);
	$jug3=limpiar($_POST["jug3"]);
	$jug4=limpiar($_POST["jug4"]);
	$numdados=limpiar($_POST["numdados"]);
	
	$arrayJugadores=array();
	$dados=array(1,2,3,4,5,6);
	$correctoJugadores=false;
	$correctoDados=false;
	
	$arrayJugadores = validarJugadores($jug1,$jug2,$jug3,$jug4,$arrayJugadores);
	$correctoJugadores = validarLongitud($arrayJugadores);
	$correctoDados=validarDados($numdados);
	jugar($correctoDados,$correctoJugadores,$arrayJugadores,$numdados,$dados);
	
};
?>