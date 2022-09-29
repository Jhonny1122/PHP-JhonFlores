<?php

$num1=10;

$num2=15;

$total=$num1+$num2;

echo "$num1 + $num2= $total";

echo "</BR>";

for ($i = $num1 ; $i <= $num2 ; $i++){
	
	echo "$i +";
	
	$total+=$i;
}

echo "=$total";


?>