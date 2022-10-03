<html>
<body>
<?php

$binario=0;

$arrayBin;

$octal=0;

$arrayOctal;

for ($i = 0 ; $i < 20 ; $i++){
	
	$binario=decbin($i);
	
	$arrayBin[$i]=$binario;
	
	$octal=decoct($i);
	
	$arrayOctal[$i]=$octal;
	
	echo "Indice=" . $i . ", Binario=" .$binario . ", Octal=" . $octal;
	
	echo "</BR>";
}


?>
</body>
</html>