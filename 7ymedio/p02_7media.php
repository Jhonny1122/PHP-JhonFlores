<?php
/* Nombre Alumno:  Jhon Flores */

include("p02func.php");

if (isset($_POST["submit"])){
	
	$nombre1=limpiar($_POST["nombre1"]);
	
	$nombre2=limpiar($_POST["nombre2"]);
	
	$nombre3=limpiar($_POST["nombre3"]);
	
	$nombre4=limpiar($_POST["nombre4"]);
	
	$numcartas=limpiar($_POST["numcartas"]);
	
	$apuesta=limpiar($_POST["apuesta"]);
	
	$arrayJugadores=array();	//Almacenar los nombres de jugadores.
	
	$correctoJugadores=false;	// Validar los numero de jugadores.
	
	$cartas=array();			//Almacenar jugadores y sus cartas.
	
	$baraja=array("1B","1C","1E","1O","2B","2C","2E","2O","3B","3C","3E","3O","4B","4C","4E","4O","5B","5C","5E","5O","6B","6C","6E","6O","7B","7C","7E","7O","CB","CC","CE","CO","RB","RC","RE","RO","SB","SC","SE","SO");

	//shuffle($baraja);
	
	$arrayJugadores=jugadores($nombre1,$nombre2,$nombre3,$nombre4,$arrayJugadores);
	
	$correctoJugadores=validarNumJugadores($arrayJugadores);
	
	$cartas=repartirCartas($arrayJugadores,$baraja,$correctoJugadores,$numcartas);
	
	ganadores($cartas,$numcartas,$apuesta);
}


?>