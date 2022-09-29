<HTML>
<HEAD><TITLE> EJ1-Conversion IP Decimal a Binario </TITLE></HEAD>
<BODY>
<?php
/* IP principal */
$ip="192.168.16.100/16";
echo "IP $ip"."</BR>";

/* Primer grupo */
$ip1=substr($ip,0,strpos($ip,'.'));
$ip=substr($ip,strpos($ip,'.')+1);

/* Segundo grupo */
$ip2=substr($ip,0,strpos($ip,'.'));
$ip=substr($ip,strpos($ip,'.')+1);

/* Tercero grupo */
$ip3=substr($ip,0,strpos($ip,'.'));
$ip=substr($ip,strpos($ip,'.')+1);

/* Cuarto grupo */
$ip4=substr($ip,0,strpos($ip,'/'));
$ip=substr($ip,strpos($ip,'/')+1);

/* Quinto grupo */
$ip5=$ip;

/* Cambiamos el valor de ip a como estaba antes*/
$ip="192.168.16.100/16";

/* Hay un codifo offset que incialoiza desde atras*/
$ip=strripos($ip,$ip5);
echo "$ip";

/* Organizamos */
echo "Macara $ip5"."</BR>";
echo "Direccion Red";
?>
</BODY>
</HTML>