<?php


$matriz1 = array(array(1, 2, 3, 4),
           array(5, 6, 7, 8),
           array(9, 0, 1, 3));
  
  
$transpuesta = [];

foreach ($matriz1 as $key => $valores){
	
    foreach ($valores as $subkey => $subvalores){
		
        $transpuesta [$subkey][$key] = $subvalores;
        
	}
}

print_r($transpuesta);

echo "</br>";

echo "</br>";

for ($row = 0; $row < 4; $row++){
	
	for ($col = 0; $col < 3; $col++) {
		
		echo $transpuesta[$row][$col];
		
		echo "  ";
	}
	
	echo "</br>";
}
?>
