<HTML>
<HEAD><TITLE> EJ5B – Tabla multiplicar con TD</TITLE></HEAD>
<BODY>
	<table border="1">
		<?php

		$numero=8;

		for ($i = 0 ; $i <= 10 ; $i++){
	
			$total=0;
	
			$total=$numero*$i;
			
			echo "<tr>";
	
			echo "<td>"."$numero x $i"."</td>"."<td>"." $total</td>"."</BR>";
			
			echo "</tr>";

		}

		?>
	</table>
</BODY>
</HTML>