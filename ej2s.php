<HTML>
<HEAD><TITLE> EJ1-Conversion IP Decimal a Binario </TITLE></HEAD>
<BODY>
<?php
$ip="192.18.16.204";
echo "La IP es $ip es " ;

$ip1=substr($ip,0,strpos($ip,'.'));
$ip=substr($ip,strpos($ip,'.')+1);
echo decbin($ip1) . ".";

$ip2=substr($ip,0,strpos($ip,'.'));
$ip=substr($ip,strpos($ip,'.')+1);
echo decbin ($ip2) . ".";

$ip3=substr($ip,0,strpos($ip,'.'));
$ip=substr($ip,strpos($ip,'.')+1);
echo decbin ($ip3) . ".";

echo decbin ($ip);
?>
</BODY>
</HTML>