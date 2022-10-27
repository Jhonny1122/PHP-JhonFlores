<html>
<head>
	<title>Ejercicio 3</title>
</head>
	<h1>Consulta operacion Bolsa</h1>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
		<label>Valores</label>
		<select name="valor">
			<option value="ACCIONA">ACCIONA</option>
			<option value="ACERINOX">ACERINOX</option>
			<option value="ACS">ACS</option>
			<option value="AENA">AENA</option>
			<option value="AMADEUS IT GROUP">AMADEUS IT GROUP</option>
			<option value="ARCELORMITTAL">ARCELORMITTAL</option>
			<option value="BANCO SABADELL">BANCO SABADELL</option>
			<option value="BANKIA">BANKIA</option>
			<option value="BANKINTER">BANKINTER</option>
			<option value="BBVA">BBVA</option>
			<option value="CAIXABANK">CAIXABANK</option>
			<option value="CELLNEX TELECOM">CELLNEX TELECOM</option>
			<option value="CIE. AUTOMOTIVE">CIE. AUTOMOTIVE</option>
			<option value="COLONIAL">COLONIAL</option>
			<option value="DIA">DIA</option>
			<option value="ENAGAS">ENAGAS</option>
			<option value="ENDESA">ENDESA</option>
			<option value="FERROVIAL">FERROVIAL</option>
			<option value="GRIFOLS">GRIFOLS</option>
			<option value="IAG">IAG</option>
			<option value="IBERDROLA">IBERDROLA</option>
			<option value="INDITEX">INDITEX</option>
			<option value="INDRA">INDRA</option>
			<option value="MAPFRE">MAPFRE</option>
			<option value="MEDIASET">MEDIASET</option>
		</select>
		<br><br>
		<label>Mostar</label>
		<select name="mostrar">
			<option value="ultimo">Ultimo Valor</option>
			<option value="variacion1">Variacion %</option>
			<option value="variacion2">Variacion</option>
			<option value="anual">Ac%Anual</option>
			<option value="maximo">Maximo</option>
			<option value="minimo">Minimo</option>
			<option value="volumen">Volumen</option>
			<option value="capital">Capitalizacion</option>
			<option value="hora">Hora</option>
		</select>
		<br><br>
		<input type="submit" name="submit" value="Visualizar"/>
		<input type="reset" name="reset" value="Borrar"/>
	</form>
</html>
<?php
include("funciones_bolsa.php");
if (isset($_POST["submit"])){
	$valor = limpiar($_POST["valor"]);
	$mostrar = limpiar($_POST["mostrar"]);
	echo mostarOpcion($valor,$mostrar);
};
?>