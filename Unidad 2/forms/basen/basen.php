<?php

	require "../funciones.php";
	
	
	//$valor = limpiar_data($_POST['num']);
	$valor = $_POST['num'];
	$base= $_POST['base'];
	
	
	
	$numero_base = explode("/", $valor, 2); // Maximo me lo separas 2 veces
	
	
	if(isFormatoCorrecto($numero_base)){
		$numero = convertirBase($numero_base[0], $numero_base[1]);
		$numero_nuevaBase = convertirBase($numero, $base);
		
		echo "El numero ".$numero_base[0]." en base ".$numero_base[1]." = ".$numero_nuevaBase;
	}else {
		echo "Error !";
	}
	
?>