<?php

	require '../funciones.php';
	
	$num = $_POST['num_dec'];
	
	echo "<h1>CONVERSOR BINARIO</h1>";
	echo "<label>Numero Decimal</label><input name=\"num_dec\" type=\"number\" value=".$_POST['num_dec']."></input>";
	echo "<br><br>";
	echo "<label>Numero Binario</label><input name=\"num_dec\" type=\"number\" value=".sprintf("%b",$num)."></input>";
	
/*
	include '../funciones.php';
	
	echo "metodo usado -> ".$_SERVER["REQUEST_METHOD"];
	
	$num1 = limpiar_data($_POST['op1']);
	$num2= limpiar_data($_POST['op2']);
	$resul;
*/
	
?>