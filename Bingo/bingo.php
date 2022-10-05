<?php

echo "Jugador 1" . "</BR>";

$carton[0]=[];

$carton[1]=[];

$carton[2]=[];

for ($c = 0 ; $c < 3 ; $c++){
	
	echo "Carton ". ($c+1) . "</BR>";

	$carton[$c]=[];

	for ($i = 0; $i< 3; $i++) {
	
		for ($j = 0; $j < 5; $j++) {
    
			echo $carton[$c][$i][$j]=rand(1,60);
			
			echo " ";
		}
		
	echo "</BR>";	
	}
}

$bola=rand(1,10);

echo $bola;

/*$coincide=[];
echo "<br>";
for ($i = 0; $i< 3; $i++) {
   for ($j = 0; $j < 5; $j++) {
    //Buscar coincidencia
    if ($carton[$i][$j]==$bola){
       echo $coincide[$i][$j]=$bola;
    }
    echo " ";
   }
  echo "<br>";
}
*/

$clave;
  
echo "</BR>";

foreach ($carton[0] as $fila){
	
	$clave = array_search($bola, $carton[0]);
	
	foreach ($fila as $columnas){
		
		$clave = array_search($bola, $carton[0]);
	}
	
	echo "</BR>";
}


/*$bola=rand(1,60);;

  echo "<br>";
echo $bola;
  echo "<br>";
if (in_array($bola, $carton1))
  {
  echo "Match found";
  }
else
  {
  echo "Match not found";
  }
*/

/*echo "<table border=1>";
echo "<tr>";
echo "<td> Numero </td>";
echo "<td> Numero </td>";
echo "<td> Numero </td>";
echo "<td> Numero </td>";
echo "<td> Numero </td>";
echo "</tr>";

echo "<tr>";
echo "<td> Numero </td>";
echo "<td> Numero </td>";
echo "<td> Numero </td>";
echo "<td> Numero </td>";
echo "<td> Numero </td>";
echo "</tr>";

echo "<tr>";
echo "<td> Numero </td>";
echo "<td> Numero </td>";
echo "<td> Numero </td>";
echo "<td> Numero </td>";
echo "<td> Numero </td>";
echo "</tr>";

echo "</table>";
*/

?>