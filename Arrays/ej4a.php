<html>
<body>
<?php

$binario=0;

$arrayBin;

$octal=0;

$arrayOctal;

echo "Array Orden normal" . "</BR>";

echo "============================" . "</BR>";

for ($i = 0 ; $i < 20 ; $i++){
	
	$binario=decbin($i);
	
	$arrayBin[$i]=$binario;
	
	$octal=decoct($i);
	
	$arrayOctal[$i]=$octal;
	
	echo "Indice=" . $i . ", Binario=" .$binario . ", Octal=" . $octal;
	
	echo "</BR>";
}

echo "</BR>";

echo "Array Orden inverso" . "</BR>";

echo "=============================" . "</BR>";

$arrayInvBin = array_reverse($arrayBin);

foreach ($arrayInvBin as $x => $x_valor){
	
	echo "Indice=" . $x . ", Binario=" . $x_valor;
	
	echo "</BR>";
}


?>
</body>
</html>