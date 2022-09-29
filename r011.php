<?php

$num1= "2A";

$num2= "F";

echo "Numero 1 en Hexa: $num1"."</BR>";

echo "Numero 2 en Hexa: $num2"."</BR>";

$total=hexdec($num1)+hexdec($num2);

echo hexdec($num1). " + " .hexdec($num2). " = $total";

echo "</BR>";

echo "$num1 + $num2=".dechex($total) ;

?>