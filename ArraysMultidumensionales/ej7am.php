<?php


$nota = array (
	"Daniel" => array ("Ciencias" => 5 , "Latin" =>3 , "Ingles" => 8 , "Artes" => 6),
	
	"Laura" => array ("Ciencias" => 9 , "Latin" =>2 , "Ingles" => 4 , "Artes" => 5),
	
	"Aurora" => array ("Ciencias" => 3 , "Latin" =>6 , "Ingles" => 6 , "Artes" => 9),
	
	"Diego" => array ("Ciencias" => 7 , "Latin" =>4 , "Ingles" => 7 , "Artes" => 9)

);

echo "ALUMNOS Y SUS NOTAS : ";

echo "<br>";

foreach ($nota as $lineaUno => $lineaUno_valor){
	
	echo "$lineaUno => ";
	
	foreach ($lineaUno_valor as $x => $x_valor){
		
		echo "Asignatura=$x ,Nota=$x_valor" .  " ";
	}
	
	echo "<br>";
}

echo "<br>";

echo "ALUMNO CON MAYOR NOTA: ";

echo "<br>";

/* Alumno con mayor nota en Ciencias */

$mayor=0;

foreach ($nota as $x => $x_valor){
	
	foreach($x_valor as $x2 => $x2_valor){
		
		if ($x2 == "Ciencias"){
			
			if ($x2_valor > $mayor){
				
				$mayor=$x2_valor;
			}
		}
	
	}
	
}

foreach ($nota as $x => $x_valor){
	
	foreach($x_valor as $x2 => $x2_valor){
		
		if ($x2 == "Ciencias" && $x2_valor == $mayor){
			
			$alumno=$x;
		}
	}
	
}

echo "Alumno=$alumno ,Asignatura=Ciencias ,Nota=$mayor" . "<br>";

/* Alumno con mayor nota en latin */

$mayor=0;

foreach ($nota as $x => $x_valor){
	
	foreach($x_valor as $x2 => $x2_valor){
		
		if ($x2 == "Latin"){
			
			if ($x2_valor > $mayor){
				
				$mayor=$x2_valor;
			}
		}
	
	}
	
}

foreach ($nota as $x => $x_valor){
	
	foreach($x_valor as $x2 => $x2_valor){
		
		if ($x2 == "Latin" && $x2_valor == $mayor){
			
			$alumno=$x;
		}
	}
	
}

echo "Alumno=$alumno ,Asignatura=Latin ,Nota=$mayor" . "<br>";

/* Alumno con mayor nota en Ingles */

$mayor=0;

foreach ($nota as $x => $x_valor){
	
	foreach($x_valor as $x2 => $x2_valor){
		
		if ($x2 == "Ingles"){
			
			if ($x2_valor > $mayor){
				
				$mayor=$x2_valor;
			}
		}
	
	}
	
}

foreach ($nota as $x => $x_valor){
	
	foreach($x_valor as $x2 => $x2_valor){
		
		if ($x2 == "Ingles" && $x2_valor == $mayor){
			
			$alumno=$x;
		}
	}
	
}

echo "Alumno=$alumno ,Asignatura=Ingles ,Nota=$mayor" . "<br>";

/* Alumno con mayor nota en Artes */

$mayor=0;

foreach ($nota as $x => $x_valor){
	
	foreach($x_valor as $x2 => $x2_valor){
		
		if ($x2 == "Artes"){
			
			if ($x2_valor > $mayor){
				
				$mayor=$x2_valor;
			}
		}
	
	}
	
}

foreach ($nota as $x => $x_valor){
	
	foreach($x_valor as $x2 => $x2_valor){
		
		if ($x2 == "Artes" && $x2_valor == $mayor){
			
			$alumno=$x;
		}
	}
	
}

echo "Alumno=$alumno ,Asignatura=Artes ,Nota=$mayor" . "<br>";

echo "<br>";

echo "ALUMNO CON MENOR NOTA: ";

echo "<br>";

/* Alumno con menor nota en Ciencias */

$menor=10;

foreach ($nota as $x => $x_valor){
	
	foreach($x_valor as $x2 => $x2_valor){
		
		if ($x2 == "Ciencias"){
			
			if ($x2_valor < $menor){
				
				$menor=$x2_valor;
			}
		}
	
	}
	
}

foreach ($nota as $x => $x_valor){
	
	foreach($x_valor as $x2 => $x2_valor){
		
		if ($x2 == "Ciencias" && $x2_valor == $menor){
			
			$alumno=$x;
		}
	}
	
}

echo "Alumno=$alumno ,Asignatura=Ciencias ,Nota=$menor" . "<br>";

/* Alumno con menor nota en Latin */

$menor=10;

foreach ($nota as $x => $x_valor){
	
	foreach($x_valor as $x2 => $x2_valor){
		
		if ($x2 == "Latin"){
			
			if ($x2_valor < $menor){
				
				$menor=$x2_valor;
			}
		}
	
	}
	
}

foreach ($nota as $x => $x_valor){
	
	foreach($x_valor as $x2 => $x2_valor){
		
		if ($x2 == "Latin" && $x2_valor == $menor){
			
			$alumno=$x;
		}
	}
	
}

echo "Alumno=$alumno ,Asignatura=Latin ,Nota=$menor" . "<br>";

/* Alumno con menor nota en Ingles */

$menor=10;

foreach ($nota as $x => $x_valor){
	
	foreach($x_valor as $x2 => $x2_valor){
		
		if ($x2 == "Ingles"){
			
			if ($x2_valor < $menor){
				
				$menor=$x2_valor;
			}
		}
	
	}
	
}

foreach ($nota as $x => $x_valor){
	
	foreach($x_valor as $x2 => $x2_valor){
		
		if ($x2 == "Ingles" && $x2_valor == $menor){
			
			$alumno=$x;
		}
	}
	
}

echo "Alumno=$alumno ,Asignatura=Ingles ,Nota=$menor" . "<br>";

/* Alumno con menor nota en Artes */

$menor=10;

foreach ($nota as $x => $x_valor){
	
	foreach($x_valor as $x2 => $x2_valor){
		
		if ($x2 == "Artes"){
			
			if ($x2_valor < $menor){
				
				$menor=$x2_valor;
			}
		}
	
	}
	
}

foreach ($nota as $x => $x_valor){
	
	foreach($x_valor as $x2 => $x2_valor){
		
		if ($x2 == "Artes" && $x2_valor == $menor){
			
			$alumno=$x;
		}
	}
	
}

echo "Alumno=$alumno ,Asignatura=Artes ,Nota=$menor" . "<br>";

echo "<br>";

echo "PARA UN ALUMNO, MOSTRAR EN QUE MATERIA TIENE SU NOTA MAS BAJA:";

echo "<br>";

$menor=10;

$asignatura="";

foreach ($nota as $x => $x_valor){
	
	foreach($x_valor as $x2 => $x2_valor){	
	
		if ($x == "Daniel"){
			
			if ($x2_valor < $menor){
				
				$menor=$x2_valor;
			}
			
		}	
	}	
}
/* No encuentra la asignatura correspondiente a la nota*/
foreach ($nota as $x => $x_valor){
	
	foreach($x_valor as $x2 => $x2_valor){	
		
		
		
	}	
}

echo $menor;

echo $asignatura;







?>
