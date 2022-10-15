<?php
// Zona de variables //
$ip = limpiar($_POST["ip"]);

echo "<h1>IPs</h1>";

echo "IP notación decimal: " . $ip;

echo "<br>";

echo "<br>";

echo validar($ip);

// Zona de Funciones //
function validar ($a){
	// Variable donde almacenamos la ip para luego utilizarlo.
	$ipRecuperar=$a;
	
	//Primera parte de la ip ___.xxx.xxx.xxx  .
	$ip1=substr($a,0,strpos($a,'.'));
	
	$a=substr($a,strpos($a,'.')+1);
	//Segunda parte de la ip xxx.___.xxx.xxx  .
	$ip2=substr($a,0,strpos($a,'.'));
	
	$a=substr($a,strpos($a,'.')+1);
	// Tercera parte de la ip xxx.xxx.___.xxx  .
	$ip3=substr($a,0,strpos($a,'.'));
	
	$a=substr($a,strpos($a,'.')+1);
	// Cuarta parte de la ip xxx.xxx.xxx.___  .
	$ip4=$a;
	
	// Variables para verificar que cada aprte esta bien.
	$ip1OK = false;
	
	$ip2OK = false;
	
	$ip3OK = false;
	
	$ip4OK = false;
	
	if($ip1 >= 0 && $ip1 <= 255){

		$ip1OK=true;	
	}
	
	if ($ip2 >= 0 && $ip2 <= 255){
		
		$ip2OK=true;
	}
	
	if ($ip3 >= 0 && $ip3 <= 255){
		
		$ip3OK=true;
	}
	
	if ($ip4 >= 0 && $ip4 <= 255){
		
		$ip4OK=true;
	}
	// Si toda las variables son TRUE , hara la funcion convertir.
	if ($ip1OK == true && $ip2OK == true && $ip3OK == true && $ip4OK == true ){
		
		echo "IP Binario: "; 
		
		convertir($ipRecuperar);
		
		echo "<br>";
		
		echo "<br>";
		
		return "La IP es valida";
	}
	// Si no son TRUE, no hara la funcion convertir y mandara mensaje de error.
	else {
		
		return "La IP tiene algun apartado mal";
	}
}

function convertir ($a){
	// Guardara en la variable desde la posicion 0 hasta el primer punto.
	$ip1=substr($a,0,strpos($a,'.'));
	// El resto lo guardara de nuevo en $a .
	$a=substr($a,strpos($a,'.')+1);
	// Convertimos decimal a binario.
	printf ("%b.",$ip1);

	$ip2=substr($a,0,strpos($a,'.'));
	
	$a=substr($a,strpos($a,'.')+1);
	
	printf ("%b.",$ip2);

	$ip3=substr($a,0,strpos($a,'.'));
	
	$a=substr($a,strpos($a,'.')+1);
	
	printf ("%08b.",$ip3);

	printf ("%08b",$a);
	
	return ;
}
// El parametro puede ser cualquier nombre.
function limpiar($ip){
	
	$ip = trim($ip);
	
	$ip = stripslashes($ip);
	
	$ip = htmlspecialchars($ip);
	
	return $ip;
}

?>