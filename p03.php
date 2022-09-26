<HTML>
<HEAD><TITLE> EJ1-Conversion IP Decimal a Binario </TITLE></HEAD>
<BODY>
<?php
/* Convertimos la IP en binario */
$ip="192.168.16.100/16";
echo "La IP es $ip es " ;
/* Primera parte */
$ip1=substr($ip,0,strpos($ip,'.'));
$ip=substr($ip,strpos($ip,'.')+1);
printf ("%b.",$ip1);
/* Segunda parte */
$ip2=substr($ip,0,strpos($ip,'.'));
$ip=substr($ip,strpos($ip,'.')+1);
printf ("%08b.",$ip2);
/* Tercera parte */
$ip3=substr($ip,0,strpos($ip,'.'));
$ip=substr($ip,strpos($ip,'.')+1);
printf ("%08b.",$ip3);
/* Cuarta parte */
$ip4=$ip;
printf("%08b",$ip4);
echo "</BR>";
/* Juntamos todos los trozos de la ip en binario */
$ipBin=printf("%08b",$ip1).printf("%08b",$ip2).printf("%08b",$ip3).printf("%08b",$ip4);
echo "</BR>";
echo "$ipBin";
echo "</BR>";


/* Volvemos a su forma original la ip */
$ip="192.168.16.100/16";
/* Nos posicionzmos despues de la barra  */
$ip5=substr($ip,0,strpos($ip,'/'));
$ip=substr($ip,strpos($ip,'/')+1);
/*En la variable mascara le asignamos lo que haya en ip, en este caso el 16 */
$mascara=$ip;

/* Recorremos hacia atras */


/* Organizamos */
echo "Mascara $mascara"."</BR>";
echo "Direccion Red";
?>
</BODY>
</HTML>