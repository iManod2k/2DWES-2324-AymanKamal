<?php

	include '../funciones.php';
	echo "<h1>Calculadora</h1>";
	echo "metodo usado -> ".$_SERVER["REQUEST_METHOD"];
	
	$num1 = limpiar_data($_POST['op1']);
	$num2= limpiar_data($_POST['op2']);
	$resul;
	
	$tipo_operacion = $_POST['tipo_op'];
	switch($tipo_operacion){
		case "s" : printf("<h4>El valor de %u + %u = %u</h4>", $num1, $num2, ($num1+$num2)); break;
		case "r" : printf("<h4>El valor de %u - %u = %u</h4>", $num1, $num2, ($num1-$num2)); break;
		case "m" : printf("<h4>El valor de %u * %u = %u</h4>", $num1, $num2, ($num1*$num2)); break;
		case "d" : printf("<h4>El valor de %u / %u = %u</h4>", $num1, $num2, ($num1/$num2)); break;
	}
	
?>